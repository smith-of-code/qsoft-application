<?php

namespace QSoft\Application;

use Closure;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Config\Repository;
use Illuminate\Container\Container;
use Illuminate\Bus\BusServiceProvider;
use Illuminate\Support\ServiceProvider;
use Illuminate\Events\EventServiceProvider;
use Illuminate\Contracts\Foundation\Application as ApplicationContract;

class Application extends Container implements ApplicationContract
{
    /**
     * The Laravel framework version.
     *
     * @var string
     */
    protected $version;

    /**
     * The base path for the Laravel installation.
     *
     * @var string
     */
    protected string $basePath;

    /**
     * Indicates if the application has "booted".
     *
     * @var bool
     */
    protected $booted = false;

    /**
     * The array of booting callbacks.
     *
     * @var array
     */
    protected $bootingCallbacks = [];

    /**
     * The array of booted callbacks.
     *
     * @var array
     */
    protected $bootedCallbacks = [];


    /**
     * All of the registered service providers.
     *
     * @var \Illuminate\Support\ServiceProvider[]
     */
    protected $serviceProviders = [];

    /**
     * The names of the loaded service providers.
     *
     * @var array
     */
    protected $loadedProviders = [];

    /**
     * Create a new Illuminate application instance.
     *
     * @param string $basePath
     * @param string|null $version
     */
    public function __construct($basePath, $version = null)
    {
        if ($version)
        {
            $this->setVersion($version);
        }

        $this->setBasePath($basePath);

        $this->registerBaseBindings();

        $this->registerBaseServiceProviders();

        $this->registerCoreContainerAliases();
    }

    /**
     * Set the base path for the application.
     *
     * @param string $basePath
     * @return ApplicationContract
     */
    public function setBasePath($basePath)
    {
        $this->basePath = rtrim($basePath, '\/');

        return $this;
    }

    /**
     * @param string $version
     * @return ApplicationContract
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get the version number of the application.
     *
     * @return string
     */
    public function version()
    {
        return $this->version;
    }

    /**
     * Get the base path of the Laravel installation.
     *
     * @param string $path
     * @return string
     */
    public function basePath($path = '')
    {
        return $this->basePath;
    }

    public function cachePath()
    {
        return $this->basePath.DIRECTORY_SEPARATOR.'bitrix'.DIRECTORY_SEPARATOR.'cache';
    }

    /**
     * Get the path to the bootstrap directory.
     *
     * @param  string  $path Optionally, a path to append to the bootstrap path
     * @return string
     */
    public function bootstrapPath($path = '')
    {
        return $this->cachePath().DIRECTORY_SEPARATOR.'bootstrap'.($path ? DIRECTORY_SEPARATOR.$path : $path);
    }

    /**
     * Get or check the current application environment.
     *
     * @return string
     */
    public function environment(...$environments)
    {
        if (func_num_args() > 0) {
            $patterns = is_array(func_get_arg(0)) ? func_get_arg(0) : func_get_args();

            foreach ($patterns as $pattern) {
                if (Str::is($pattern, $this['env'])) {
                    return true;
                }
            }

            return false;
        }

        return $this['env'];
    }

    /**
     * Determine if we are running in the console.
     *
     * @return bool
     */
    public function runningInConsole()
    {
        return php_sapi_name() == 'cli' || php_sapi_name() == 'phpdbg';
    }

    /**
     * Determine if the application is running unit tests.
     *
     * @return bool
     */
    public function runningUnitTests()
    {
        return false;
    }

    /**
     * Determine if the application is currently down for maintenance.
     *
     * @return bool
     */
    public function isDownForMaintenance()
    {
        return file_exists($this->basePath().'/down');
    }

    /**
     * Register all of the configured providers.
     *
     * @return void
     */
    public function registerConfiguredProviders()
    {

    }

    /**
     * Register a service provider with the application.
     *
     * @param \Illuminate\Support\ServiceProvider|string $provider
     * @param array $options
     * @param bool $force
     * @return \Illuminate\Support\ServiceProvider
     */
    public function register($provider, $options = [], $force = false)
    {
        if (($registered = $this->getProvider($provider)) && ! $force)
        {
            return $registered;
        }

        if (is_string($provider))
        {
            $provider = $this->resolveProvider($provider);
        }

        if (method_exists($provider, 'register'))
        {
            $provider->register();
        }

        $this->markAsRegistered($provider);

        if ($this->isBooted())
        {
            $this->bootProvider($provider);
        }

        return $provider;
    }

    /**
     * Get the registered service provider instance if it exists.
     *
     * @param  \Illuminate\Support\ServiceProvider|string  $provider
     * @return \Illuminate\Support\ServiceProvider|null
     */
    public function getProvider($provider)
    {
        return array_values($this->getProviders($provider))[0] ?? null;
    }

    /**
     * Get the registered service provider instances if any exist.
     *
     * @param  \Illuminate\Support\ServiceProvider|string  $provider
     * @return array
     */
    public function getProviders($provider)
    {
        $name = is_string($provider) ? $provider : get_class($provider);
        return Arr::where($this->serviceProviders, function ($value) use ($name) {
            return $value instanceof $name;
        });
    }

    /**
     * Resolve a service provider instance from the class name.
     *
     * @param  string  $provider
     * @return \Illuminate\Support\ServiceProvider
     */
    public function resolveProvider($provider)
    {
        return new $provider($this);
    }

    /**
     * Mark the given provider as registered.
     *
     * @param  \Illuminate\Support\ServiceProvider  $provider
     * @return void
     */
    protected function markAsRegistered($provider)
    {
        $this->serviceProviders[] = $provider;

        $this->loadedProviders[get_class($provider)] = true;
    }

    /**
     * Register a deferred provider and service.
     *
     * @param string $provider
     * @param string|null $service
     * @return void
     */
    public function registerDeferredProvider($provider, $service = null)
    {
        $this->register($instance = new $provider($this));

        if ( ! $this->isBooted())
        {
            $this->booting(function () use ($instance) {

                $this->bootProvider($instance);
            });
        }
    }

    /**
     * Boot the given service provider.
     *
     * @param  ServiceProvider  $provider
     * @return mixed
     */
    protected function bootProvider(ServiceProvider $provider): mixed
    {
        if (method_exists($provider, 'boot'))
        {
            return $this->call([$provider, 'boot']);
        }
    }

    /**
     * Determine if the application has booted.
     *
     * @return bool
     */
    public function isBooted()
    {
        return $this->booted;
    }

    /**
     * Boot the application's service providers.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->booted) {
            return;
        }

        $this->fireAppCallbacks($this->bootingCallbacks);

        array_walk($this->serviceProviders, function ($p) {

            $this->bootProvider($p);
        });

        $this->booted = true;

        $this->fireAppCallbacks($this->bootedCallbacks);
    }

    /**
     * Register a new boot listener.
     *
     * @param mixed $callback
     * @return void
     */
    public function booting($callback)
    {
        $this->bootingCallbacks[] = $callback;
    }

    /**
     * Register a new "booted" listener.
     *
     * @param mixed $callback
     * @return void
     */
    public function booted($callback)
    {
        $this->bootedCallbacks[] = $callback;

        if ($this->isBooted()) {
            $this->fireAppCallbacks([$callback]);
        }
    }

    /**
     * Get the path to the cached services.php file.
     *
     * @return string
     */
    public function getCachedServicesPath()
    {
        return $this->bootstrapPath().'/services.php';
    }

    /**
     * Get the path to the cached packages.php file.
     *
     * @return string
     */
    public function getCachedPackagesPath()
    {
        return $this->bootstrapPath().'/packages.php';
    }

    /**
     * Call the booting callbacks for the application.
     *
     * @param  array  $callbacks
     * @return void
     */
    protected function fireAppCallbacks(array $callbacks)
    {
        foreach ($callbacks as $callback)
        {
            call_user_func($callback, $this);
        }
    }

    /**
     * Register the basic bindings into the container.
     *
     * @return void
     */
    protected function registerBaseBindings()
    {
        static::setInstance($this);

        $this->instance('app', $this);

        $this->instance(Container::class, $this);

        $this->instance('config', new Repository());
    }

    /**
     * Register all of the base service providers.
     *
     * @return void
     */
    protected function registerBaseServiceProviders()
    {
        $this->register(new BusServiceProvider($this));

        $this->register(new EventServiceProvider($this));
    }

    /**
     * Register the core class aliases in the container.
     *
     * @return void
     */
    protected function registerCoreContainerAliases()
    {
        foreach ([
            'events' => [\Illuminate\Events\Dispatcher::class, \Illuminate\Contracts\Events\Dispatcher::class],
            'config' => [\Illuminate\Config\Repository::class, \Illuminate\Contracts\Config\Repository::class],
        ]as $key => $aliases) {
            foreach ($aliases as $alias) {
                $this->alias($key, $alias);
            }
        }
    }

    public function configPath($path = '')
    {
        // TODO: Implement configPath() method.
    }

    public function databasePath($path = '')
    {
        // TODO: Implement databasePath() method.
    }

    public function environmentPath()
    {
        // TODO: Implement environmentPath() method.
    }

    public function resourcePath($path = '')
    {
        // TODO: Implement resourcePath() method.
    }

    public function storagePath()
    {
        // TODO: Implement storagePath() method.
    }

    public function bootstrapWith(array $bootstrappers)
    {
        // TODO: Implement bootstrapWith() method.
    }

    public function configurationIsCached()
    {
        // TODO: Implement configurationIsCached() method.
    }

    public function detectEnvironment(Closure $callback)
    {
        // TODO: Implement detectEnvironment() method.
    }

    public function environmentFile()
    {
        // TODO: Implement environmentFile() method.
    }

    public function environmentFilePath()
    {
        // TODO: Implement environmentFilePath() method.
    }

    public function getCachedConfigPath()
    {
        // TODO: Implement getCachedConfigPath() method.
    }

    public function getCachedRoutesPath()
    {
        // TODO: Implement getCachedRoutesPath() method.
    }

    public function getLocale()
    {
        // TODO: Implement getLocale() method.
    }

    public function getNamespace()
    {
        // TODO: Implement getNamespace() method.
    }

    public function hasBeenBootstrapped()
    {
        // TODO: Implement hasBeenBootstrapped() method.
    }

    public function loadDeferredProviders()
    {
        // TODO: Implement loadDeferredProviders() method.
    }

    public function loadEnvironmentFrom($file)
    {
        // TODO: Implement loadEnvironmentFrom() method.
    }

    public function routesAreCached()
    {
        // TODO: Implement routesAreCached() method.
    }

    public function setLocale($locale)
    {
        // TODO: Implement setLocale() method.
    }

    public function shouldSkipMiddleware()
    {
        // TODO: Implement shouldSkipMiddleware() method.
    }

    public function terminate()
    {
        // TODO: Implement terminate() method.
    }
}

<?php

namespace QSoft\Queue;

use Bitrix\Main\Application;
use QSoft\Queue\ORM\FailedJobTable;
use QSoft\Queue\Console\WorkerCommand;
use QSoft\Queue\Mock\ExceptionHandler;
use QSoft\Queue\Connectors\BXDatabaseConnector;
use QSoft\Queue\Failed\BXDatabaseFailedJobProvider;

use Illuminate\Queue\Worker;
use Illuminate\Queue\QueueManager;
use Illuminate\Support\ServiceProvider;
use Illuminate\Queue\Console\RetryCommand;
use Illuminate\Queue\Console\ListFailedCommand;
use Illuminate\Queue\Console\FlushFailedCommand;
use Illuminate\Queue\Console\ForgetFailedCommand;

class QueueServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerAliases();

        $this->registerManager();

        $this->registerConnection();

        $this->registerWorker();

        $this->registerCommand();

        $this->registerFailedJobServices();
    }

    private function registerManager()
    {
        $this->app->singleton('queue', function ($app) {

            return tap(new QueueManager($app), function ($manager) {

                $this->registerConnectors($manager);
            });
        });
    }

    private function registerConnectors(QueueManager $manager)
    {
        $manager->addConnector('bx', function () {

            return new BXDatabaseConnector(Application::getInstance()->getConnectionPool());
        });
    }

    private function registerConnection()
    {
        $this->app->singleton('queue.connection', function ($app) {

            return $app['queue']->connection();
        });
    }

    private function registerWorker()
    {
        $this->app->singleton('queue.worker', function ($app) {

            return new Worker(
                $app['queue'], $app['events'], new ExceptionHandler()
            );
        });
    }

    private function registerCommand()
    {
        $this->app->singleton('command.queue.work', function ($app) {

            $command = new WorkerCommand($app['queue.worker']);
            $command->setLaravel($app);

            return $command;
        });

        $this->app->singleton('command.queue.failed', function ($app) {

            $command = new ListFailedCommand();
            $command->setLaravel($app);

            return $command;
        });

        $this->app->singleton('command.queue.forget', function ($app) {

            $command = new ForgetFailedCommand();
            $command->setLaravel($app);

            return $command;
        });

        $this->app->singleton('command.queue.flush', function ($app) {

            $command = new FlushFailedCommand();
            $command->setLaravel($app);

            return $command;
        });

        $this->app->singleton('command.queue.retry', function ($app) {

            $command = new RetryCommand();
            $command->setLaravel($app);

            return $command;
        });

        if (defined('DISPOSER_APP')) {
            \QSoft\Foundation\Disposer::addLaravel($this->app->get('command.queue.work'));
            \QSoft\Foundation\Disposer::addLaravel($this->app->get('command.queue.failed'));
            \QSoft\Foundation\Disposer::addLaravel($this->app->get('command.queue.forget'));
            \QSoft\Foundation\Disposer::addLaravel($this->app->get('command.queue.flush'));
            \QSoft\Foundation\Disposer::addLaravel($this->app->get('command.queue.retry'));
        }
    }

    /**
     * Register the failed job services.
     *
     * @return void
     */
    protected function registerFailedJobServices()
    {
        $this->app->singleton('queue.failer', function () {

            $config = $this->app['config']['queue.failed'];

            $class = $config['bx_table'] ?? FailedJobTable::class;
            $table = new $class;

            return new BXDatabaseFailedJobProvider(
                Application::getInstance()->getConnectionPool(), $table, $config['bx_connection']
            );
        });
    }

    private function registerAliases()
    {
        foreach ([
            'queue'            => [\Illuminate\Queue\QueueManager::class, \Illuminate\Contracts\Queue\Factory::class, \Illuminate\Contracts\Queue\Monitor::class],
            'queue.connection' => [\Illuminate\Contracts\Queue\Queue::class],
            'queue.failer'     => [\Illuminate\Queue\Failed\FailedJobProviderInterface::class],
        ]as $key => $aliases) {
            foreach ($aliases as $alias) {
                $this->app->alias($key, $alias);
            }
        }
    }
}

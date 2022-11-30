<?php

use Symfony\Component\Finder\Finder;

$application = getApplication();

foreach (Finder::create()->files()->name('*.php')->in(QSOFT_APPLICATION_ROOT . '/config') as $file) {
    $application->get('config')->set(basename($file->getRealPath(), '.php'), require $file->getRealPath());
}

$application->get('config')->set('queue', [
    'default' => 'bx',
    'connections' => [
        'bx' => [
            'driver' => 'bx',
            'queue' => 'default',
            'retry_after' => 60,
            'bx_connection' => 'default',
            'bx_table' => QSoft\Queue\ORM\JobTable::class,
        ],
    ],
    'failed' => [
        'bx_connection' => 'default',
        'bx_table' => QSoft\Queue\ORM\FailedJobTable::class,
    ],
]);

$application->register(new \QSoft\Queue\QueueServiceProvider($application));

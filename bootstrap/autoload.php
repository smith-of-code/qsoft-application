<?php
define('QSOFT_CORE_LOADED', true);
define('QSOFT_APPLICATION_ROOT', dirname(__DIR__));
define('QSOFT_CORE_ROOT', QSOFT_APPLICATION_ROOT . '/app/core/');

require_once dirname(__DIR__) . '/vendor/autoload.php';

new \QSoft\Application\Application(QSOFT_APPLICATION_ROOT);

app()->get('config')->set('queue', [
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

app()->register(new \QSoft\Queue\QueueServiceProvider(app()));

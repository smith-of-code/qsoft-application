<?php

namespace QSoft\Queue\Connectors;

use QSoft\Queue\ORM\JobTable;
use QSoft\Queue\BXDatabaseQueue;
use Bitrix\Main\Data\ConnectionPool;
use Illuminate\Queue\Connectors\ConnectorInterface;

class BXDatabaseConnector implements ConnectorInterface
{
    /**
     * @var ConnectionPool $connections
     */
    protected $connections;

    public function __construct(ConnectionPool $connections)
    {
        $this->connections = $connections;
    }

    /**
     * Establish a queue connection.
     *
     * @param array $config
     * @return \Illuminate\Contracts\Queue\Queue
     */
    public function connect(array $config)
    {
        $class = $config['bx_table'] ?? JobTable::class;
        $table = new $class;

        return new BXDatabaseQueue(
            $this->connections->getConnection($config['bx_connection']),
            $table,
            $config['queue'] ?? 'default',
            $config['retry_after'] ?? 60
        );
    }
}

<?php

namespace QSoft\Queue\Failed;

use Bitrix\Main\Type\DateTime;
use Bitrix\Main\ORM\Data\AddResult;
use Bitrix\Main\Data\ConnectionPool;
use Bitrix\Main\ORM\Data\DataManager;

use Illuminate\Queue\Jobs\DatabaseJobRecord;
use Illuminate\Queue\Failed\FailedJobProviderInterface;

class BXDatabaseFailedJobProvider implements FailedJobProviderInterface
{
    /**
     * @var ConnectionPool $connections
     */
    protected $connections;

    /**
     * The database table that holds the jobs.
     *
     * @var DataManager $table
     */
    protected $table;

    /**
     * @var string $connectionName
     */
    protected $connectionName;

    /**
     * Create a new database failed job provider.
     *
     * @param ConnectionPool $connections
     * @param DataManager $table
     * @param string $connectionName
     */
    public function __construct(ConnectionPool $connections, DataManager $table, string $connectionName)
    {
        $this->table = $table;

        $this->connections = $connections;

        $this->connectionName = $connectionName;
    }

    /**
     * Log a failed job into storage.
     *
     * @param string $connection
     * @param string $queue
     * @param string $payload
     * @param \Exception $exception
     * @return int|null
     * @throws \Exception
     */
    public function log($connection, $queue, $payload, $exception)
    {
        /** @var AddResult $result */
        $result = $this->table->add([
            'queue' => $queue,
            'payload' => $payload,
            'connection' => $connection,
            'failed_at' => new DateTime(),
            'exception' => (string)$exception,
        ]);

        return $result->getId();
    }

    /**
     * Get a list of all of the failed jobs.
     *
     * @return array
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     */
    public function all()
    {
        return $this->table->query()->addSelect('*')->addOrder('id', 'desc')->exec()->fetchAll();
    }

    /**
     * Get a single failed job.
     *
     * @param mixed $id
     * @return mixed
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     */
    public function find($id)
    {
        $job = $this->table->getById($id)->fetch();

        return $job ? new DatabaseJobRecord((object) $job) : null;
    }

    /**
     * Delete a single failed job from storage.
     *
     * @param mixed $id
     * @return bool
     * @throws \Exception
     */
    public function forget($id)
    {
        $result = $this->table->delete($id);

        return $result->isSuccess();
    }

    /**
     * Flush all of the failed jobs from storage.
     *
     * @return void
     */
    public function flush()
    {
        $connection = $this->connections->getConnection($this->connectionName);

        $connection->truncateTable($this->table->getTableName());
    }
}

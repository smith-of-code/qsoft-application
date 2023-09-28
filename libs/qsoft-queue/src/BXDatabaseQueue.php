<?php

namespace QSoft\Queue;

use Throwable;
use Bitrix\Main\DB\Connection;
use Bitrix\Main\ORM\Query\Query;
use QSoft\Queue\Jobs\BXDatabaseJob;
use Bitrix\Main\ORM\Data\AddResult;
use Bitrix\Main\ORM\Data\DataManager;

use Illuminate\Queue\Queue;
use Illuminate\Queue\Jobs\DatabaseJobRecord;
use Illuminate\Contracts\Queue\Queue as QueueContract;

class BXDatabaseQueue extends Queue implements QueueContract
{
    /**
     * The database table that holds the jobs.
     *
     * @var DataManager $table
     */
    protected $table;

    /**
     * The name of the default queue.
     *
     * @var string $default
     */
    protected $default;

    /**
     * The database connection instance.
     *
     * @var Connection $connection
     */
    protected $connection;

    /**
     * The expiration time of a job.
     *
     * @var int|null
     */
    protected $retryAfter;

    public function __construct(Connection $connection, DataManager $table, $default = 'default', $retryAfter = 60)
    {
        $this->table = $table;

        $this->default = $default;

        $this->retryAfter = $retryAfter;

        $this->connection = $connection;

        $this->getNextAvailableJob('');
    }

    /**
     * Get the size of the queue.
     *
     * @param string $queue
     * @return int
     */
    public function size($queue = null)
    {
        return (int)$this->table->getCount([
            '=queue' => $this->getQueue($queue),
        ]);
    }

    /**
     * Push a new job onto the queue.
     *
     * @param string|object $job
     * @param mixed $data
     * @param string $queue
     * @return mixed
     */
    public function push($job, $data = '', $queue = null)
    {
        if (count((new \ReflectionMethod($this, 'createPayload'))->getParameters()) === 3) {
            return $this->pushToDatabase($queue, $this->createPayload($job, $queue, $data));
        } else {
            return $this->pushToDatabase($queue, $this->createPayload($job, $data));
        }
    }

    /**
     * Push a raw payload onto the queue.
     *
     * @param string $payload
     * @param string $queue
     * @param array $options
     * @return mixed
     */
    public function pushRaw($payload, $queue = null, array $options = [])
    {
        return $this->pushToDatabase($queue, $payload);
    }

    /**
     * Push a new job onto the queue after a delay.
     *
     * @param \DateTimeInterface|\DateInterval|int $delay
     * @param string|object $job
     * @param mixed $data
     * @param string $queue
     * @return mixed
     */
    public function later($delay, $job, $data = '', $queue = null)
    {
        if (count((new \ReflectionMethod($this, 'createPayload'))->getParameters()) === 3) {
            return $this->pushToDatabase($queue, $this->createPayload($job, $queue, $data), $delay);
        } else {
            return $this->pushToDatabase($queue, $this->createPayload($job, $data), $delay);
        }
    }

    /**
     * Release a reserved job back onto the queue.
     *
     * @param  string  $queue
     * @param  \Illuminate\Queue\Jobs\DatabaseJobRecord  $job
     * @param  int  $delay
     * @return mixed
     */
    public function release($queue, $job, $delay)
    {
        return $this->pushToDatabase($queue, $job->payload, $delay, $job->attempts);
    }

    /**
     * Push a raw payload to the database with a given delay.
     *
     * @param  string|null  $queue
     * @param  string  $payload
     * @param  \DateTimeInterface|\DateInterval|int  $delay
     * @param  int  $attempts
     * @return mixed
     */
    protected function pushToDatabase($queue, $payload, $delay = 0, $attempts = 0)
    {
        /** @var AddResult $result */
        $result = $this->table->add($this->buildDatabaseRecord(
            $this->getQueue($queue), $payload, $this->availableAt($delay), $attempts
        ));

        return $result->getId();
    }

    /**
     * Create an array to insert for the given job.
     *
     * @param  string|null  $queue
     * @param  string  $payload
     * @param  int  $availableAt
     * @param  int  $attempts
     * @return array
     */
    protected function buildDatabaseRecord($queue, $payload, $availableAt, $attempts = 0)
    {
        return [
            'queue' => $queue,
            'attempts' => $attempts,
            'reserved_at' => null,
            'available_at' => $availableAt,
            'created_at' => $this->currentTime(),
            'payload' => $payload,
        ];
    }

    /**
     * Pop the next job off of the queue.
     *
     * @param string $queue
     * @return \Illuminate\Contracts\Queue\Job|null
     * @throws Throwable
     */
    public function pop($queue = null)
    {
        $queue = $this->getQueue($queue);

        try
        {
            $this->connection->startTransaction();

            if ($job = $this->getNextAvailableJob($queue))
            {
                return $this->marshalJob($queue, $job);
            }

            $this->connection->commitTransaction();
        }
        catch (Throwable $e)
        {
            $this->connection->rollbackTransaction();

            throw $e;
        }
    }

    /**
     * Get the next available job for the queue.
     *
     * @param  string|null  $queue
     * @return \Illuminate\Queue\Jobs\DatabaseJobRecord|null
     */
    protected function getNextAvailableJob($queue)
    {
        $expiration = strtotime("now -{$this->retryAfter} seconds");

        $query = $this->table->query()
            ->addSelect('*')
            ->where('queue', $this->getQueue($queue))
            ->where(Query::filter()
                ->logic('or')
                ->where(Query::filter()
                    ->whereNull('reserved_at')
                    ->where('available_at', '<=', $this->currentTime())
                )
                ->where('reserved_at', '<=', $expiration)
            )
            ->addOrder('id', 'asc')
        ;

        $job = $this->connection->query("{$query->getQuery()} for update")->fetch();

        return $job ? new DatabaseJobRecord((object) $job) : null;
    }

    /**
     * Marshal the reserved job into a DatabaseJob instance.
     *
     * @param string $queue
     * @param \Illuminate\Queue\Jobs\DatabaseJobRecord $job
     * @return BXDatabaseJob
     * @throws \Bitrix\Main\Db\SqlQueryException
     * @throws \Exception
     */
    protected function marshalJob($queue, $job)
    {
        $job = $this->markJobAsReserved($job);

        $this->connection->commitTransaction();

        return new BXDatabaseJob($this->container, $this, $job, $queue);
    }

    /**
     * Mark the given job ID as reserved.
     *
     * @param \Illuminate\Queue\Jobs\DatabaseJobRecord $job
     * @return \Illuminate\Queue\Jobs\DatabaseJobRecord
     * @throws \Exception
     */
    protected function markJobAsReserved($job)
    {
        $this->table->update($job->id, [
            'reserved_at' => $job->touch(),
            'attempts' => $job->increment(),
        ]);

        return $job;
    }

    /**
     * Delete a reserved job from the queue.
     *
     * @param  string  $queue
     * @param  string  $id
     * @return void
     * @throws \Exception|\Throwable
     */
    public function deleteReserved($queue, $id)
    {
        try
        {
            $this->connection->startTransaction();

            $query = $this->table->query()->where('id', '=', $id);
            $job = $this->connection->query("{$query->getQuery()} for update")->fetch();

            if ($job)
            {
                $this->table->delete($id);
            }

            $this->connection->commitTransaction();
        }
        catch (\Exception $e)
        {
            $this->connection->rollbackTransaction();

            throw $e;
        }
    }

    /**
     * Get the queue or return the default.
     *
     * @param  string|null  $queue
     * @return string
     */
    public function getQueue($queue)
    {
        return $queue ?: $this->default;
    }
}

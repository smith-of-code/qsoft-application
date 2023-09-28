<?php

namespace QSoft\Queue\Jobs;

use QSoft\Queue\BXDatabaseQueue;

use Illuminate\Queue\Jobs\Job;
use Illuminate\Container\Container;
use Illuminate\Contracts\Queue\Job as JobContract;

class BXDatabaseJob extends Job implements JobContract
{
    /**
     * The database queue instance.
     *
     * @var BXDatabaseQueue
     */
    protected $database;

    /**
     * The database job payload.
     *
     * @var \stdClass
     */
    protected $job;

    /**
     * Create a new job instance.
     *
     * @param  BXDatabaseQueue  $database
     * @param  \stdClass  $job
     * @param  string  $queue
     * @return void
     */
    public function __construct(Container $container, BXDatabaseQueue $database, $job, $queue)
    {
        $this->job = $job;

        $this->queue = $queue;

        $this->database = $database;

        $this->container = $container;
    }

    /**
     * Release the job back into the queue.
     *
     * @param  int  $delay
     * @return mixed
     */
    public function release($delay = 0)
    {
        parent::release($delay);

        $this->delete();

        return $this->database->release($this->queue, $this->job, $delay);
    }

    /**
     * Delete the job from the queue.
     *
     * @return void
     */
    public function delete()
    {
        parent::delete();

        $this->database->deleteReserved($this->queue, $this->job->id);
    }

    /**
     * Get the raw body of the job.
     *
     * @return string
     */
    public function getRawBody()
    {
        return $this->job->payload;
    }

    /**
     * Get the number of times the job has been attempted.
     *
     * @return int
     */
    public function attempts()
    {
        return (int) $this->job->attempts;
    }

    /**
     * Get the job identifier.
     *
     * @return string
     */
    public function getJobId()
    {
        return $this->job->id;
    }
}

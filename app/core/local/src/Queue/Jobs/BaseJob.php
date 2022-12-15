<?php

namespace QSoft\Queue\Jobs;

use RuntimeException;
use Throwable;

abstract class BaseJob
{
    public function fire($job, $data, $rabbit = false)
    {
        $this->handle($data);
        if (!$rabbit && !$job->isDeletedOrReleased()) {
            $job->delete();
        }
    }

    public static function pushJob($data): void
    {
        $self = new static;
        if (!$self->validateInputData($data)) {
            throw new RuntimeException($self->getQueueName() . ' queue: data is not valid');
        }
        app('queue')->push(static::class, $data, $self->getQueueName());
    }

    abstract protected function getQueueName(): string;

    abstract protected function validateInputData($data): bool;

    protected function handle($data): void
    {
        try {
            $this->process($data);
        } catch (Throwable $e) {
            $logpath = realpath($_SERVER['DOCUMENT_ROOT'] . '/../logs/') . '/queue_' . date('m_Y') . '.log';
            file_put_contents($logpath, '[' . date('d.m.Y h:i:s') . ']' . print_r($e, true) . PHP_EOL, FILE_APPEND);
        }
    }

    abstract protected function process($data);
}
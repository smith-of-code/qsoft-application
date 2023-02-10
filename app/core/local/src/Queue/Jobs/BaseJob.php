<?php

namespace QSoft\Queue\Jobs;

use Psr\Log\LogLevel;
use QSoft\Logger\Logger;
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
            $error = new RuntimeException($self->getQueueName() . ' queue: data is not valid');
            Logger::createLogger((new \ReflectionClass(__CLASS__))->getShortName(), 0, LogLevel::ERROR)
                ->setLog(
                    $error->getMessage(),
                    [
                        'message' => $error->getMessage(),
                        'namespace' => __CLASS__,
                        'file_path' => (new \ReflectionClass(__CLASS__))->getFileName(),
                    ],
                );
            throw $error;
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
            file_put_contents($logpath, '[' . date('d.m.Y h:i:s') . '][' . $this->getQueueName() . '] ' . print_r($e->getMessage() . ' FILE: ' . $e->getFile() . ', LINE ' . $e->getLine(), true) . PHP_EOL, FILE_APPEND);
        }
    }

    abstract protected function process($data);
}
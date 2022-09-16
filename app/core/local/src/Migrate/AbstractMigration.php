<?php

namespace QSoft\Migrate;

use Bitrix\Main\Application;
use QSoft\Migration\Migration;

abstract class AbstractMigration extends Migration
{
    public function up()
    {
        if (method_exists($this, 'beforeUp')) {
            $this->beforeUp();
        }

        $connection = Application::getInstance()->getConnection();
        $connection->startTransaction();

        try {
            $this->onUp();
        } catch (\Throwable $e) {
            $connection->rollbackTransaction();
            throw $e;
        }

        $connection->commitTransaction();

        if (method_exists($this, 'afterUp')) {
            $this->afterUp();
        }
    }

    public function down()
    {
        if (method_exists($this, 'beforeDown')) {
            $this->beforeDown();
        }

        $connection = Application::getInstance()->getConnection();
        $connection->startTransaction();

        try {
            $this->onDown();
        } catch (\Throwable $e) {
            $connection->rollbackTransaction();
            throw $e;
        }

        $connection->commitTransaction();

        if (method_exists($this, 'afterDown')) {
            $this->afterDown();
        }
    }

    abstract protected function onUp(): void;

    abstract protected function onDown(): void;
}

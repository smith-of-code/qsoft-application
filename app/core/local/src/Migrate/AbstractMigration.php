<?php

namespace QSoft\Migrate;

use Bitrix\Main\Application;
use Bitrix\Main\DB\Connection;
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
            $this->onUp($connection);
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
            $this->onDown($connection);
        } catch (\Throwable $e) {
            $connection->rollbackTransaction();
            throw $e;
        }

        $connection->commitTransaction();

        if (method_exists($this, 'afterDown')) {
            $this->afterDown();
        }
    }

    abstract protected function onUp(Connection $connection): void;

    abstract protected function onDown(Connection $connection): void;
}

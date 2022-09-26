<?php

namespace QSoft\Migrate;

use Bitrix\Main\Application;
use Bitrix\Main\DB\Connection;
use QSoft\Migration\Migration;

abstract class AbstractMigration extends Migration
{
    public function up()
    {
        $connection = Application::getInstance()->getConnection();
        $connection->startTransaction();

        try {
            if (method_exists($this, 'beforeUp')) {
                $this->beforeUp();
            }

            $this->onUp($connection);

            if (method_exists($this, 'afterUp')) {
                $this->afterUp();
            }
        } catch (\Throwable $e) {
            $connection->rollbackTransaction();
            throw $e;
        }

        $connection->commitTransaction();
    }

    public function down()
    {
        $connection = Application::getInstance()->getConnection();
        $connection->startTransaction();

        try {
            if (method_exists($this, 'beforeDown')) {
                $this->beforeDown();
            }

            $this->onDown($connection);

            if (method_exists($this, 'afterDown')) {
                $this->afterDown();
            }
        } catch (\Throwable $e) {
            $connection->rollbackTransaction();
            throw $e;
        }

        $connection->commitTransaction();
    }

    abstract protected function onUp(Connection $connection): void;

    abstract protected function onDown(Connection $connection): void;
}

<?php

namespace QSoft\Migrate\Traits;

use Bitrix\Main\Application;
use Bitrix\Main\GroupTable;
use Exception;
use RuntimeException;

trait AddUserGroupsTrait
{
    /**
     * @return void
     * @throws Exception
     */
    public function up()
    {
        $this->validateClass();

        $connection = Application::getConnection();
        $connection->startTransaction();

        foreach ($this->groups as $group) {
            $result = GroupTable::add($group);
            if (!$result->isSuccess()) {
                $connection->rollbackTransaction();
                throw new RuntimeException($result->getErrorMessages());
            }
        }

        $connection->commitTransaction();
    }

    /**
     * @return void
     * @throws Exception
     */
    public function down()
    {
        $this->validateClass();

        $connection = Application::getConnection();
        $connection->startTransaction();

        $groups = GroupTable::getList([
            'filter' => [
                '=STRING_ID' => array_column($this->groups, 'STRING_ID')
            ]
        ])->fetchAll();

        foreach ($groups as $group) {
            $result = GroupTable::delete($group['ID']);
            if (!$result->isSuccess()) {
                $connection->rollbackTransaction();
                throw new RuntimeException($result->getErrorMessages());
            }
        }

        $connection->commitTransaction();
    }

    /**
     * @throws Exception
     */
    private function validateClass(): void
    {
        if (!property_exists($this, 'groups')) {
            throw new Exception('Can not find $groups class property');
        }
    }
}
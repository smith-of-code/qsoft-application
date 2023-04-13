<?php

use QSoft\Migrate\AbstractMigration;
use Bitrix\Main\DB\Connection;
use Bitrix\Main\Loader;

class AddRefundOrderStatuses extends AbstractMigration
{
    const STATUSES = [
        [
            'ID' => 'PR',
            'LANG' => [
                [
                    'LID' => 'ru',
                    'NAME' => 'Частично возвращен',
                ],
            ],
        ],
        [
            'ID' => 'FR',
            'LANG' => [
                [
                    'LID' => 'ru',
                    'NAME' => 'Полностью возвращен',
                ],
            ],
        ],
    ];

    protected function onUp(Connection $connection): void
    {
        $this->loadModules();

        foreach (self::STATUSES as $status) {
            $result = CSaleStatus::Add($status);
            if (!$result) {
                throw new RuntimeException('Ошибка при добавлении статуса заказа');
            }
        }
    }

    protected function onDown(Connection $connection): void
    {
        $this->loadModules();

        foreach (self::STATUSES as $status) {
            if (!CSaleStatus::Delete($status['ID'])) {
                throw new RuntimeException('Ошибка при удалении статуса заказа');
            }
        }
    }

    private function loadModules(): void
    {
        if (!Loader::includeModule('sale')) {
            throw new RuntimeException('Не установлен модуль sale');
        }
    }
}

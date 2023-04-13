<?php

namespace QSoft\Migrate;

use Bitrix\Main\DB\Connection;

class BaseCreateIBlockTypeMigration extends AbstractMigration
{
    protected array $iBlockType = [
        'ID' => '',
        'SECTIONS' => 'Y',
        'IN_RSS' => 'N',
        'SORT' => 100,
        'LANG' => [
            'ru' => [
                'NAME' => '',
                'SECTION_NAME' => '',
                'ELEMENT_NAME' => '',
            ],
            'en' => [
                'NAME' => '',
                'SECTION_NAME' => '',
                'ELEMENT_NAME' => '',
            ],
        ],
    ];

    protected function onUp(Connection $connection): void
    {
        $this->includeIBlockModule();

        $iBlockType = new \CIBlockType();
        if (!$iBlockType->Add($this->iBlockType)) {
            throw new \RuntimeException($iBlockType->LAST_ERROR);
        }
    }

    protected function onDown(Connection $connection): void
    {
        $this->includeIBlockModule();

        if (!\CIBlockType::Delete($this->iBlockType['ID'])) {
            throw new \RuntimeException(sprintf('Не удалось удалить тип инфоблока %s', $this->iBlockType['ID']));
        }
    }

    protected function includeIBlockModule(): void
    {
        if (!\CModule::IncludeModule('iblock')) {
            throw new \RuntimeException('Не удалось подключить модуль iblock');
        }
    }
}

<?php

namespace QSoft\Migrate;

use Bitrix\Main\DB\Connection;
use QSoft\Seeder\Seederable;

class BaseCreateIBlockMigration extends AbstractMigration
{
    protected ?string $seeder = null;

    protected array $iBlockInfo = [
        'LID' => 's1',
        'IBLOCK_TYPE_ID' => '',
        'CODE' => '',
        'XML_ID' => '',
        'NAME' => '',
        'ACTIVE' => 'Y',
        'SORT' => 500,
        'DESCRIPTION_TYPE' => 'text',
        'VERSION' => 2,
        'RIGHTS_MODE' => 'S',
        'GROUP_ID' => [],
    ];

    protected array $iBlockPropertyInfo = [
        [
            'NAME' => '',
            'XML_ID' => '',
            'IBLOCK_ID' => '',
            'ACTIVE' => 'Y',
            'IS_REQUIRED' => 'Y',
            'SORT' => 500,
            'PROPERTY_TYPE' => 'S',
            'DEFAULT_VALUE' => '',
        ],
    ];

    protected function onUp(Connection $connection): void
    {
        $this->includeIBlockModule();

        $iBlock = new \CIBlock();
        $result = $iBlock->Add($this->iBlockInfo);
        if (!$result) {
            throw new \RuntimeException($iBlock->LAST_ERROR);
        }

        array_walk($this->iBlockPropertyInfo, static function ($item) use ($result) {
            $item['IBLOCK_ID'] = $result;
            $iBlockProperty = new \CIBlockProperty();
            $result = $iBlockProperty->Add($item);

            if (!$result) {
                throw new \RuntimeException($iBlockProperty->LAST_ERROR);
            }
        });

        if ($this->seeder) {
            $class = $this->seeder;
            try {
                $seeder = new $class();
                if ($seeder instanceof Seederable) {
                    $seeder::seed($iBlock['CODE']);
                }
            } catch (\Throwable $e) {
                throw new \RuntimeException(sprintf('Не удалось запустить сидер %s', $class));
            }
        }
    }

    protected function onDown(Connection $connection): void
    {
        $this->includeIBlockModule();

        $iBlock = \CIBlock::GetList([], ['CODE' => $this->iBlockInfo['CODE']])->Fetch();
        if (!$iBlock) {
            throw new \RuntimeException(sprintf('Не удалось найти инфоблок %s', $this->iBlockInfo['CODE']));
        }

        if (!\CIBlock::Delete($iBlock['ID'])) {
            throw new \RuntimeException(sprintf('Не удалось удалить инфоблок %s', $iBlock['ID']));
        }
    }

    protected function includeIBlockModule(): void
    {
        if (!\CModule::IncludeModule('iblock')) {
            throw new \RuntimeException('Не удалось подключить модуль iblock');
        }
    }
}

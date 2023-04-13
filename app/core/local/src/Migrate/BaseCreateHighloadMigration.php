<?php

namespace QSoft\Migrate;

use Bitrix\Main\Application;
use Bitrix\Main\DB\Connection;
use Bitrix\Main\Loader;
use Bitrix\Highloadblock\HighloadBlockTable;
use Bitrix\Highloadblock\HighloadBlockLangTable;
use QSoft\Migration\Migration;
use QSoft\Seeder\Seederable;

class BaseCreateHighloadMigration extends AbstractMigration
{
    protected array $blockInfo = [
        'NAME'       => '',
        'TABLE_NAME' => '',
    ];

    protected array $blockLang = [
        'LID' => 'ru',
        'NAME' => '',
    ];

    protected array $fields = [];

    protected array $enumValues = [];

    protected ?string $seeder = null;

    protected function onUp(Connection $connection): void
    {
        $this->includeHighloadModule();

        $result = HighloadBlockTable::add($this->blockInfo);
        if (!$result->isSuccess()) {
            throw new \RuntimeException(implode(PHP_EOL, $result->getErrorMessages()));
        }

        $hlBlockId = $result->getId();

        $result = HighloadBlockLangTable::add(['ID' => $hlBlockId] + $this->blockLang);
        if (!$result->isSuccess()) {
            throw new \RuntimeException(implode(PHP_EOL, $result->getErrorMessages()));
        }

        $entityManager = new \CUserTypeEntity();
        $enumManager = new \CUserFieldEnum();

        foreach ($this->fields as $field) {
            $isText = false;
            if (strtolower($field['USER_TYPE_ID']) === 'text') {
                $isText = true;
                $field['USER_TYPE_ID'] = 'string';
            }

            $fieldId = $entityManager->Add(['ENTITY_ID' => "HLBLOCK_{$hlBlockId}"] + $field);
            if (!$fieldId) {
                throw new \RuntimeException(sprintf('Не удалось добавить поле %s в hl-блок %s', $field['FIELD_NAME'], $this->blockInfo['NAME']));
            }

            if ($isText) {
                $field['USER_TYPE_ID'] = 'text';
            }

            switch (strtolower($field['USER_TYPE_ID'])) {
                case 'string':
                    $maxLength = $field['SETTINGS']['MAX_LENGTH'] ?? 255;
                    $connection->query("ALTER TABLE {$this->blockInfo['TABLE_NAME']} MODIFY {$field['FIELD_NAME']} varchar($maxLength) NOT NULL DEFAULT ''");
                    break;
                case 'enumeration':
                    $enumManager->SetEnumValues($fieldId, $this->enumValues[$field['FIELD_NAME']]);
                    break;
                case 'text':
                    $connection->query("ALTER TABLE {$this->blockInfo['TABLE_NAME']} MODIFY {$field['FIELD_NAME']} text NOT NULL DEFAULT ''");
                    break;
            }
        }

        if ($this->seeder) {
            $class = $this->seeder;
            try {
                $seeder = new $class();
                if ($seeder instanceof Seederable) {
                    $seeder::seed($this->blockInfo['NAME']);
                }
            } catch (\Throwable $e) {
                throw new \RuntimeException(sprintf('Не удалось запустить сидер %s', $class));
            }
        }
    }

    protected function onDown(Connection $connection): void
    {
        $this->includeHighloadModule();

        $hlBlock = HighloadBlockTable::getRow(['filter' => ['=NAME' => $this->blockInfo['NAME']]]);
        if (!$hlBlock) {
            throw new \RuntimeException(sprintf('Не найден hl-блок %s', $this->blockInfo['NAME']));
        }

        $result = \CUserTypeEntity::GetList([], ['ENTITY_ID' => "HLBLOCK_{$hlBlock['ID']}"]);
        if (!$result) {
            throw new \RuntimeException(sprintf('Не удалось получить список полей hl-блока %s', $this->blockInfo['NAME']));
        }

        $enumManager = new \CUserFieldEnum();

        while ($field = $result->Fetch()) {
            if ($field['USER_TYPE_ID'] === 'enumeration') {
                $enumManager->DeleteFieldEnum($field['ID']);
            }
        }

        $result = HighloadBlockTable::delete($hlBlock['ID']);
        if (!$result->isSuccess()) {
            throw new \RuntimeException(implode(PHP_EOL, $result->getErrorMessages()));
        }
    }

    protected function includeHighloadModule()
    {
        if (!Loader::includeModule('highloadblock')) {
            throw new \RuntimeException('Не удалось загрузить модуль highloadblock');
        }
    }
}

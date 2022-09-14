<?php

namespace QSoft\Migrate;

use Bitrix\Main\Application;
use Bitrix\Main\Loader;
use Bitrix\Highloadblock\HighloadBlockTable;
use Bitrix\Highloadblock\HighloadBlockLangTable;
use QSoft\Migration\Migration;

class BaseCreateHighloadMigration extends Migration
{
    protected array $HLBLOCK = [];

    protected array $HLBLOCK_LANG = [];

    protected array $FIELDS = [];

    protected array $ENUM_VALUES = [];

    public function up()
    {
        if (!Loader::includeModule('highloadblock')) {
            throw new \RuntimeException('Не удалось загрузить модуль highloadblock');
        }

        $connection = Application::getInstance()->getConnection();
        $connection->startTransaction();

        $result = HighloadBlockTable::add($this->HLBLOCK);
        if (!$result->isSuccess()) {
            throw new \RuntimeException(implode(PHP_EOL, $result->getErrorMessages()));
        }

        $hlBlockId = $result->getId();

        $result = HighloadBlockLangTable::add(['ID' => $hlBlockId] + $this->HLBLOCK_LANG);
        if (!$result->isSuccess()) {
            throw new \RuntimeException(implode(PHP_EOL, $result->getErrorMessages()));
        }

        $entityManager = new \CUserTypeEntity();
        $enumManager = new \CUserFieldEnum();

        foreach ($this->FIELDS as $field) {
            $fieldId = $entityManager->Add(['ENTITY_ID' => "HLBLOCK_{$hlBlockId}"] + $field);
            if (!$fieldId) {
                throw new \RuntimeException(sprintf('Не удалось добавить поле %s в hl-блок %s', $field['FIELD_NAME'], $this->HLBLOCK['NAME']));
            }

            switch ($field['USER_TYPE_ID']) {
                case 'string':
                    $connection->query("ALTER TABLE {$this->HLBLOCK['TABLE_NAME']} MODIFY {$field['FIELD_NAME']} varchar(255) NOT NULL DEFAULT ''");
                    break;
                case 'enumeration':
                    $enumManager->SetEnumValues($fieldId, $this->ENUM_VALUES[$field['FIELD_NAME']]);
                    break;
            }
        }

        $connection->commitTransaction();
    }

    public function down()
    {
        if (!Loader::includeModule('highloadblock')) {
            throw new \RuntimeException('Не удалось загрузить модуль highloadblock');
        }

        $connection = Application::getInstance()->getConnection();
        $connection->startTransaction();

        $hlBlock = HighloadBlockTable::getRow(['filter' => ['=NAME' => $this->HLBLOCK['NAME']]]);
        if (!$hlBlock) {
            throw new \RuntimeException(sprintf('Не найден hl-блок %s', $this->HLBLOCK['NAME']));
        }

        $result = \CUserTypeEntity::GetList([], ['ENTITY_ID' => "HLBLOCK_{$hlBlock['ID']}"]);
        if (!$result) {
            throw new \RuntimeException(sprintf('Не удалось получить список полей hl-блока %s', $this->HLBLOCK['NAME']));
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

        $connection->commitTransaction();
    }
}

<?php

namespace QSoft\Migrate;

use Bitrix\Main\Application;
use Bitrix\Main\Loader;
use Bitrix\Highloadblock\HighloadBlockTable;
use Bitrix\Highloadblock\HighloadBlockLangTable;
use QSoft\Migration\Migration;

class BaseCreateHighloadMigration extends Migration
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

    public function up()
    {
        if (method_exists($this, 'beforeUp')) {
            $this->beforeUp();
        }

        $this->includeHighloadModule();

        $connection = Application::getInstance()->getConnection();
        $connection->startTransaction();

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
            $fieldId = $entityManager->Add(['ENTITY_ID' => "HLBLOCK_{$hlBlockId}"] + $field);
            if (!$fieldId) {
                throw new \RuntimeException(sprintf('Не удалось добавить поле %s в hl-блок %s', $field['FIELD_NAME'], $this->blockInfo['NAME']));
            }

            switch ($field['USER_TYPE_ID']) {
                case 'string':
                    $connection->query("ALTER TABLE {$this->blockInfo['TABLE_NAME']} MODIFY {$field['FIELD_NAME']} varchar(255) NOT NULL DEFAULT ''");
                    break;
                case 'enumeration':
                    $enumManager->SetEnumValues($fieldId, $this->enumValues[$field['FIELD_NAME']]);
                    break;
            }
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

        $this->includeHighloadModule();

        $connection = Application::getInstance()->getConnection();
        $connection->startTransaction();

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

        $connection->commitTransaction();

        if (method_exists($this, 'afterDown')) {
            $this->afterDown();
        }
    }

    protected function includeHighloadModule()
    {
        if (!Loader::includeModule('highloadblock')) {
            throw new \RuntimeException('Не удалось загрузить модуль highloadblock');
        }
    }
}

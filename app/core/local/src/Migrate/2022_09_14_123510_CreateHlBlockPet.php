<?php

use Bitrix\Main\Application;
use Bitrix\Main\Loader;
use Bitrix\Highloadblock\HighloadBlockTable;
use Bitrix\Highloadblock\HighloadBlockLangTable;
use QSoft\Migration\Migration;

class CreateHlBlockPet extends Migration {
    const HLBLOCK = [
        'NAME'       => 'HlPets',
        'TABLE_NAME' => 'pet',
    ];

    const HLBLOCK_LANG = [
        'LID' => 'ru',
        'NAME' => 'HL-блок питомцев',
    ];

    const FIELDS = [
        [
            'FIELD_NAME' => 'UF_USER_ID',
            'USER_TYPE_ID' => 'integer',
            'XML_ID' => 'UF_USER_ID',
            'SORT' => 100,
            'EDIT_FORM_LABEL' => ['ru' => 'Идентификатор пользователя'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Идентификатор пользователя'],
            'LIST_FILTER_LABEL' => ['ru' => 'Идентификатор пользователя'],
        ],
        [
            'FIELD_NAME' => 'UF_NAME',
            'USER_TYPE_ID' => 'string',
            'XML_ID' => 'UF_NAME',
            'SORT' => 100,
            'EDIT_FORM_LABEL' => ['ru' => 'Кличка питомца'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Кличка питомца'],
            'LIST_FILTER_LABEL' => ['ru' => 'Кличка питомца'],
        ],
        [
            'FIELD_NAME' => 'UF_KIND',
            'USER_TYPE_ID' => 'enumeration',
            'MULTIPLE' => 'N',
            'XML_ID' => 'UF_NAME',
            'SORT' => 100,
            'EDIT_FORM_LABEL' => ['ru' => 'Тип питомца'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Тип питомца'],
            'LIST_FILTER_LABEL' => ['ru' => 'Тип питомца'],
        ],
        [
            'FIELD_NAME' => 'UF_BREED',
            'USER_TYPE_ID' => 'enumeration',
            'MULTIPLE' => 'N',
            'XML_ID' => 'UF_BREED',
            'SORT' => 100,
            'EDIT_FORM_LABEL' => ['ru' => 'Порода питомца'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Порода питомца'],
            'LIST_FILTER_LABEL' => ['ru' => 'Порода питомца'],
        ],
        [
            'FIELD_NAME' => 'UF_BIRTHDATE',
            'USER_TYPE_ID' => 'date',
            'MULTIPLE' => 'N',
            'XML_ID' => 'UF_BIRTHDATE',
            'SORT' => 100,
            'EDIT_FORM_LABEL' => ['ru' => 'Дата рождения питомца'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Дата рождения питомца'],
            'LIST_FILTER_LABEL' => ['ru' => 'Дата рождения питомца'],
        ],
        [
            'FIELD_NAME' => 'UF_GENDER',
            'USER_TYPE_ID' => 'enumeration',
            'MULTIPLE' => 'N',
            'XML_ID' => 'UF_GENDER',
            'SORT' => 100,
            'EDIT_FORM_LABEL' => ['ru' => 'Пол'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Пол'],
            'LIST_FILTER_LABEL' => ['ru' => 'Пол'],
        ],
    ];

    const ENUM_VALUES = [
        'UF_KIND' => [
            'n1' => [
                'XML_ID' => 'KIND_DOG',
                'VALUE' => 'собака',
                'DEF' => 'N',
                'SORT' => 10,
            ],
            'n2' => [
                'XML_ID' => 'KIND_CAT',
                'VALUE' => 'кошка',
                'DEF' => 'N',
                'SORT' => 20,
            ],
        ],
        'UF_GENDER' => [
            'n1' => [
                'XML_ID' => 'GENDER_MALE',
                'VALUE' => 'мальчик',
                'DEF' => 'N',
                'SORT' => 10,
            ],
            'n2' => [
                'XML_ID' => 'GENDER_FEMALE',
                'VALUE' => 'девочка',
                'DEF' => 'N',
                'SORT' => 20,
            ],
        ],
        // TODO: Добавить все породы в рамках этой миграции или следующей
        'UF_BREED' => [
            'n1' => [
                'XML_ID' => 'BREED_DOG_DACHSHUND',
                'VALUE' => 'Датская',
                'DEF' => 'N',
                'SORT' => 10,
            ],
        ],
    ];

    public function up()
    {
        if (!Loader::includeModule('highloadblock')) {
            throw new \RuntimeException('Не удалось загрузить модуль highloadblock');
        }

        $connection = Application::getInstance()->getConnection();
        $connection->startTransaction();

        $result = HighloadBlockTable::add(self::HLBLOCK);
        if (!$result->isSuccess()) {
            throw new \RuntimeException(implode(PHP_EOL, $result->getErrorMessages()));
        }

        $hlBlockId = $result->getId();

        $result = HighloadBlockLangTable::add(['ID' => $hlBlockId] + self::HLBLOCK_LANG);
        if (!$result->isSuccess()) {
            throw new \RuntimeException(implode(PHP_EOL, $result->getErrorMessages()));
        }

        $entityManager = new \CUserTypeEntity();
        $enumManager = new \CUserFieldEnum();

        foreach (self::FIELDS as $field) {
            $fieldId = $entityManager->Add(['ENTITY_ID' => "HLBLOCK_{$hlBlockId}"] + $field);
            if (!$fieldId) {
                throw new \RuntimeException(sprintf('Не удалось добавить поле %s в hl-блок %s', $field['FIELD_NAME'], self::HLBLOCK['NAME']));
            }

            switch ($field['USER_TYPE_ID']) {
                case 'string':
                    $tableName = self::HLBLOCK['TABLE_NAME'];
                    $connection->query("ALTER TABLE $tableName MODIFY {$field['FIELD_NAME']} varchar(255) NOT NULL DEFAULT ''");
                    break;
                case 'enumeration':
                    $enumManager->SetEnumValues($fieldId, self::ENUM_VALUES[$field['FIELD_NAME']]);
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

        $hlBlock = HighloadBlockTable::getRow(['filter' => ['=NAME' => self::HLBLOCK['NAME']]]);
        if (!$hlBlock) {
            throw new \RuntimeException(sprintf('Не найден hl-блок %s', self::HLBLOCK['NAME']));
        }

        $result = \CUserTypeEntity::GetList([], ['ENTITY_ID' => "HLBLOCK_{$hlBlock['ID']}"]);
        if (!$result) {
            throw new \RuntimeException(sprintf('Не удалось получить список полей hl-блока %s', self::HLBLOCK['NAME']));
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

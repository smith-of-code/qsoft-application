<?php
/**
 * Пример миграции для hl-блока
 */

use Bitrix\Main\Application;
use Bitrix\Main\Loader;
use Bitrix\Highloadblock\HighloadBlockTable;
use Bitrix\Highloadblock\HighloadBlockLangTable;
use QSoft\Migration\Migration;

class HlblockExampleMigration extends Migration {
    private $HLBLOCK = [
        'NAME'       => 'ExampleHlBlock',
        'TABLE_NAME' => 'hl_example_hl_block',
    ];

    private $HLBLOCK_LANG = [
        'LID' => 'ru',
        'NAME' => 'Пример hl-блока',
    ];

    private $FIELDS = [
        [
            'FIELD_NAME' => 'UF_SAP_ID',
            'USER_TYPE_ID' => 'string',
            'XML_ID' => '',
            'SORT' => '100',
            'MULTIPLE' => 'N',
            'MANDATORY' => 'Y',
            'SHOW_FILTER' => 'N',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => 'Y',
            'IS_SEARCHABLE' => 'N',
            'SETTINGS' => [
                'MIN_LENGTH' => '0',
                'MAX_LENGTH' => '20',
                'DEFAULT_VALUE' => [
                    'TYPE' => 'NONE',
                    'VALUE' => '' ,
                ]
            ],
            'EDIT_FORM_LABEL'   => [
                'ru' => 'Уникальный идентификатор типа начисления бонусов в SAP Loyalty',
                'en' => 'Bonus accrual type ID in SAP Loyalty',
            ],
            'LIST_COLUMN_LABEL' => [
                'ru' => 'Уникальный идентификатор типа начисления бонусов в SAP Loyalty',
                'en' => 'Bonus accrual type ID in SAP Loyalty',
            ],
            'LIST_FILTER_LABEL' => [
                'ru' => 'Уникальный идентификатор типа начисления бонусов в SAP Loyalty',
                'en' => 'Bonus accrual type ID in SAP Loyalty',
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

        $result = HighloadBlockTable::add($this->HLBLOCK);
        if (!$result->isSuccess()) {
            throw new \RuntimeException(implode(PHP_EOL, $result->getErrorMessages()));
        }

        $hlBlockId = $result->getId();

        $result = HighloadBlockLangTable::add(
            array_merge(
                ['ID' => $hlBlockId],
                 $this->HLBLOCK_LANG
            )
        );
        if (!$result->isSuccess()) {
            throw new \RuntimeException(implode(PHP_EOL, $result->getErrorMessages()));
        }

        $entityManager = new \CUserTypeEntity();

        foreach ($this->FIELDS as $field) {
            $fieldId = $entityManager->Add(
                array_merge(
                    ['ENTITY_ID' => "HLBLOCK_{$hlBlockId}"],
                    $field
                )
            );
            if (!$fieldId) {
                throw new \RuntimeException(sprintf('Не удалось добавить поле %s в hl-блок %s', $field['FIELD_NAME'], $this->HLBLOCK['NAME']));
            }

            if ($field['USER_TYPE_ID'] === 'string') {
                $connection->query("ALTER TABLE {$this->HLBLOCK['TABLE_NAME']} MODIFY {$field['FIELD_NAME']} varchar(255) NOT NULL DEFAULT ''");
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

        $hlblock = HighloadBlockTable::getRow(['filter' => ['=NAME' => $this->HLBLOCK['NAME']]]);
        if (!$hlblock) {
            throw new \RuntimeException(sprintf('Не найден hl-блок %s', $this->HLBLOCK['NAME']));
        }

        $result = HighloadBlockTable::delete($hlblock['ID']);
        if (!$result->isSuccess()) {
            throw new \RuntimeException(implode(PHP_EOL, $result->getErrorMessages()));
        }

        $connection->commitTransaction();
    }
}

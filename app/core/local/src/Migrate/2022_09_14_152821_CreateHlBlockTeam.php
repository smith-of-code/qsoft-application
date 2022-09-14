<?php

use QSoft\Migrate\BaseCreateHighloadMigration;

class CreateHlBlockLegalEntity extends BaseCreateHighloadMigration
{
    protected array $blockInfo = [
        'NAME'       => 'HlTeams',
        'TABLE_NAME' => 'team',
    ];

    protected array $blockLang = [
        'LID' => 'ru',
        'NAME' => 'HL-блок групп пользователей',
    ];

    // TODO: Поменять тип на привязку к блоку юзеров
    protected array $fields = [
        [
            'FIELD_NAME' => 'UF_MENTOR_ID',
            'USER_TYPE_ID' => 'integer',
            'XML_ID' => 'UF_USER_ID',
            'SORT' => 100,
            'EDIT_FORM_LABEL' => ['ru' => 'Наставник'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Наставник'],
            'LIST_FILTER_LABEL' => ['ru' => 'Наставник'],
        ],
        [
            'FIELD_NAME' => 'UF_LEVEL',
            'USER_TYPE_ID' => 'integer',
            'XML_ID' => 'UF_LEVEL',
            'SORT' => 100,
            'EDIT_FORM_LABEL' => ['ru' => 'Уровень группы'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Уровень группы'],
            'LIST_FILTER_LABEL' => ['ru' => 'Уровень группы'],
        ],
    ];
}

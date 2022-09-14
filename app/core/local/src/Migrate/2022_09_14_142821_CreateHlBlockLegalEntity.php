<?php

use QSoft\Migrate\BaseCreateHighloadMigration;

class CreateHlBlockLegalEntity extends BaseCreateHighloadMigration
{
    protected array $blockInfo = [
        'NAME'       => 'HlLegalEntities',
        'TABLE_NAME' => 'legal_entity',
    ];

    protected array $blockLang = [
        'LID' => 'ru',
        'NAME' => 'HL-блок юридических лиц',
    ];

    protected array $fields = [
        // TODO: Поменять тип на привязку к блоку юзеров
        [
            'FIELD_NAME' => 'UF_USER_ID',
            'USER_TYPE_ID' => 'integer',
            'XML_ID' => 'UF_USER_ID',
            'SORT' => 100,
            'EDIT_FORM_LABEL' => ['ru' => 'Пользователь'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Пользователь'],
            'LIST_FILTER_LABEL' => ['ru' => 'Пользователь'],
        ],
        [
            'FIELD_NAME' => 'UF_STATUS',
            'USER_TYPE_ID' => 'enumeration',
            'XML_ID' => 'UF_STATUS',
            'SORT' => 100,
            'EDIT_FORM_LABEL' => ['ru' => 'Юридический статус'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Юридический статус'],
            'LIST_FILTER_LABEL' => ['ru' => 'Юридический статус'],
        ],
    ];

    protected array $enumValues = [
        'UF_STATUS' => [
            'n1' => [
                'XML_ID' => 'STATUS_IP',
                'VALUE' => 'ИП',
                'DEF' => 'N',
                'SORT' => 10,
            ],
            'n2' => [
                'XML_ID' => 'STATUS_JURIDICAL',
                'VALUE' => 'ООО',
                'DEF' => 'N',
                'SORT' => 20,
            ],
            'n3' => [
                'XML_ID' => 'STATUS_SELF_EMPLOYED',
                'VALUE' => 'Самозанятый',
                'DEF' => 'N',
                'SORT' => 30,
            ],
        ],
    ];
}

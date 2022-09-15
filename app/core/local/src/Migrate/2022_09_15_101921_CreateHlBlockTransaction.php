<?php

use QSoft\Migrate\BaseCreateHighloadMigration;

class CreateHlBlockTransaction extends BaseCreateHighloadMigration
{
    protected array $blockInfo = [
        'NAME'       => 'HlTransaction',
        'TABLE_NAME' => 'transaction',
    ];

    protected array $blockLang = [
        'LID' => 'ru',
        'NAME' => 'HL-блок транзакций',
    ];

    protected array $fields = [
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
            'FIELD_NAME' => 'UF_CREATED_AT',
            'USER_TYPE_ID' => 'datetime',
            'XML_ID' => 'UF_CREATED_AT',
            'SORT' => 100,
            'EDIT_FORM_LABEL' => ['ru' => 'Дата создания'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Дата создания'],
            'LIST_FILTER_LABEL' => ['ru' => 'Дата создания'],
            'SETTINGS' => [
                'DEFAULT_VALUE' => [
                    'TYPE' => 'NOW',
                    'VALUE' => '',
                ],
                'USE_SECOND' => 'Y',
            ],
        ],
        [
            'FIELD_NAME' => 'UF_TYPE',
            'USER_TYPE_ID' => 'enumeration',
            'XML_ID' => 'UF_TYPE',
            'SORT' => 100,
            'EDIT_FORM_LABEL' => ['ru' => 'Тип транзакции'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Тип транзакции'],
            'LIST_FILTER_LABEL' => ['ru' => 'Тип транзакции'],
        ],
        [
            'FIELD_NAME' => 'UF_SOURCE',
            'USER_TYPE_ID' => 'enumeration',
            'XML_ID' => 'UF_SOURCE',
            'SORT' => 100,
            'EDIT_FORM_LABEL' => ['ru' => 'Источник транзакции'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Источник транзакции'],
            'LIST_FILTER_LABEL' => ['ru' => 'Источник транзакции'],
        ],
        [
            'FIELD_NAME' => 'UF_MEASURE',
            'USER_TYPE_ID' => 'enumeration',
            'XML_ID' => 'UF_MEASURE',
            'SORT' => 100,
            'EDIT_FORM_LABEL' => ['ru' => 'Мера значения суммы транзакции'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Мера значения суммы транзакции'],
            'LIST_FILTER_LABEL' => ['ru' => 'Мера значения суммы транзакции'],
        ],
    ];

    protected array $enumValues = [
        'UF_TYPE' => [
            'n1' => [
                'XML_ID' => 'TRANSACTION_TYPE_PURCHASE',
                'VALUE' => 'покупка',
                'DEF' => 'N',
                'SORT' => 10,
            ],
            'n2' => [
                'XML_ID' => 'TRANSACTION_TYPE_INVITE',
                'VALUE' => 'приглашение',
                'DEF' => 'N',
                'SORT' => 20,
            ],
            'n3' => [
                'XML_ID' => 'TRANSACTION_TYPE_REFERRAL',
                'VALUE' => 'переход',
                'DEF' => 'N',
                'SORT' => 30,
            ],
        ],
        'UF_SOURCE' => [
            'n1' => [
                'XML_ID' => 'TRANSACTION_SOURCE_PERSONAL',
                'VALUE' => 'личные',
                'DEF' => 'N',
                'SORT' => 10,
            ],
            'n2' => [
                'XML_ID' => 'TRANSACTION_SOURCE_GROUP',
                'VALUE' => 'с группы',
                'DEF' => 'N',
                'SORT' => 20,
            ],
        ],
        'UF_MEASURE' => [
            'n1' => [
                'XML_ID' => 'TRANSACTION_MEASURE_MONEY',
                'VALUE' => 'деньги',
                'DEF' => 'N',
                'SORT' => 10,
            ],
            'n2' => [
                'XML_ID' => 'TRANSACTION_MEASURE_POINTS',
                'VALUE' => 'баллы',
                'DEF' => 'N',
                'SORT' => 20,
            ],
        ],
    ];
}

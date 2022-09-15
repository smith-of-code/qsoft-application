<?php

use QSoft\Migrate\BaseCreateHighloadMigration;

final class CreateHlBlockConfirmation extends BaseCreateHighloadMigration
{
    protected array $blockInfo = [
        'NAME'       => 'HlConfirmation',
        'TABLE_NAME' => 'confirmation',
    ];

    protected array $blockLang = [
        'LID' => 'ru',
        'NAME' => 'HL-блок подтверждений',
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
            'FIELD_NAME' => 'UF_CHANNEL',
            'USER_TYPE_ID' => 'enumeration',
            'XML_ID' => 'UF_CHANNEL',
            'SORT' => 100,
            'EDIT_FORM_LABEL' => ['ru' => 'Канал'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Канал'],
            'LIST_FILTER_LABEL' => ['ru' => 'Канал'],
        ],
        [
            'FIELD_NAME' => 'UF_TYPE',
            'USER_TYPE_ID' => 'enumeration',
            'XML_ID' => 'UF_TYPE',
            'SORT' => 100,
            'EDIT_FORM_LABEL' => ['ru' => 'Тип'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Тип'],
            'LIST_FILTER_LABEL' => ['ru' => 'Тип'],
        ],
        [
            'FIELD_NAME' => 'UF_CODE',
            'USER_TYPE_ID' => 'string',
            'XML_ID' => 'UF_CODE',
            'SORT' => 100,
            'EDIT_FORM_LABEL' => ['ru' => 'Код'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Код'],
            'LIST_FILTER_LABEL' => ['ru' => 'Код'],
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
    ];

    protected array $enumValues = [
        'UF_CHANNEL' => [
            'n1' => [
                'XML_ID' => 'CONFIRMATION_CHANNEL_SMS',
                'VALUE' => 'СМС',
                'DEF' => 'N',
                'SORT' => 10,
            ],
            'n2' => [
                'XML_ID' => 'CONFIRMATION_CHANNEL_EMAIL',
                'VALUE' => 'email',
                'DEF' => 'N',
                'SORT' => 20,
            ],
        ],
        'UF_TYPE' => [
            'n1' => [
                'XML_ID' => 'CONFIRMATION_TYPE_PASSWORD_RESET',
                'VALUE' => 'сброс пароля',
                'DEF' => 'N',
                'SORT' => 10,
            ],
            'n2' => [
                'XML_ID' => 'CONFIRMATION_TYPE_EMAIL_CONFIRMATION',
                'VALUE' => 'подтверждение email',
                'DEF' => 'N',
                'SORT' => 20,
            ],
            'n3' => [
                'XML_ID' => 'CONFIRMATION_TYPE_PHONE_CONFIRMATION',
                'VALUE' => 'подтверждение телефона',
                'DEF' => 'N',
                'SORT' => 30,
            ],
        ],
    ];
}

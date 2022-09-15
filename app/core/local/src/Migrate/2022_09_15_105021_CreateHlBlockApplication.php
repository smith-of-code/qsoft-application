<?php

use QSoft\Migrate\BaseCreateHighloadMigration;
use QSoft\Seeder\ApplicationSeeder;

final class CreateHlBlockApplication extends BaseCreateHighloadMigration
{
    protected ?string $seeder = ApplicationSeeder::class;

    protected array $blockInfo = [
        'NAME'       => 'HlApplication',
        'TABLE_NAME' => 'application',
    ];

    protected array $blockLang = [
        'LID' => 'ru',
        'NAME' => 'HL-блок заявок',
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
            'FIELD_NAME' => 'UF_STATUS',
            'USER_TYPE_ID' => 'enumeration',
            'XML_ID' => 'UF_STATUS',
            'SORT' => 100,
            'EDIT_FORM_LABEL' => ['ru' => 'Статус'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Статус'],
            'LIST_FILTER_LABEL' => ['ru' => 'Статус'],
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
            'FIELD_NAME' => 'UF_COMMENT',
            'USER_TYPE_ID' => 'text',
            'XML_ID' => 'UF_COMMENT',
            'SORT' => 100,
            'EDIT_FORM_LABEL' => ['ru' => 'Комментарий'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Комментарий'],
            'LIST_FILTER_LABEL' => ['ru' => 'Комментарий'],
            'SETTINGS' => [
                'MIN_LENGTH' => 0,
                'MAX_LENGTH' => 1000,
                'DEFAULT_VALUE' => [
                    'TYPE' => 'NONE',
                    'VALUE' => '' ,
                ],
            ],
        ],
        [
            'FIELD_NAME' => 'UF_DATA',
            'USER_TYPE_ID' => 'text',
            'XML_ID' => 'UF_DATA',
            'SORT' => 100,
            'EDIT_FORM_LABEL' => ['ru' => 'Данные заявки'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Данные заявки'],
            'LIST_FILTER_LABEL' => ['ru' => 'Данные заявки'],
        ],
    ];

    protected array $enumValues = [
        'UF_TYPE' => [
            'n1' => [
                'XML_ID' => 'APPLICATION_TYPE_CHANGE_PERSONAL_DATA',
                'VALUE' => 'смена персональных данных',
                'DEF' => 'N',
                'SORT' => 10,
            ],
            'n2' => [
                'XML_ID' => 'APPLICATION_TYPE_CHANGE_MENTOR',
                'VALUE' => 'смена наставника\\контакного лица',
                'DEF' => 'N',
                'SORT' => 20,
            ],
            'n3' => [
                'XML_ID' => 'APPLICATION_TYPE_BUG',
                'VALUE' => 'неработающая функциональность',
                'DEF' => 'N',
                'SORT' => 30,
            ],
            'n4' => [
                'XML_ID' => 'APPLICATION_TYPE_RETURN_ORDER',
                'VALUE' => 'возврат заказа',
                'DEF' => 'N',
                'SORT' => 40,
            ],
            'n5' => [
                'XML_ID' => 'APPLICATION_TYPE_OTHER',
                'VALUE' => 'другое',
                'DEF' => 'Y',
                'SORT' => 50,
            ],
        ],
        'UF_STATUS' => [
            'n1' => [
                'XML_ID' => 'APPLICATION_STATUS_NEW',
                'VALUE' => 'новая',
                'DEF' => 'Y',
                'SORT' => 10,
            ],
            'n2' => [
                'XML_ID' => 'APPLICATION_STATUS_IN_PROGRESS',
                'VALUE' => 'в работе',
                'DEF' => 'N',
                'SORT' => 20,
            ],
            'n3' => [
                'XML_ID' => 'APPLICATION_STATUS_DONE',
                'VALUE' => 'выполнена',
                'DEF' => 'N',
                'SORT' => 30,
            ],
            'n4' => [
                'XML_ID' => 'APPLICATION_STATUS_REJECTED',
                'VALUE' => 'отклонена',
                'DEF' => 'N',
                'SORT' => 40,
            ],
        ],
    ];
}

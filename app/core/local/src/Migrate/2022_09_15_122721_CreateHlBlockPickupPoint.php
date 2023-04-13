<?php

use QSoft\Migrate\BaseCreateHighloadMigration;
use QSoft\Seeder\PickupPointSeeder;

final class CreateHlBlockPickupPoint extends BaseCreateHighloadMigration
{
    protected ?string $seeder = PickupPointSeeder::class;

    protected array $blockInfo = [
        'NAME'       => 'HlPickupPoint',
        'TABLE_NAME' => 'pickup_point',
    ];

    protected array $blockLang = [
        'LID' => 'ru',
        'NAME' => 'HL-блок пунктов выдачи',
    ];

    protected array $fields = [
        [
            'FIELD_NAME' => 'UF_NAME',
            'USER_TYPE_ID' => 'string',
            'XML_ID' => 'UF_NAME',
            'SORT' => 100,
            'EDIT_FORM_LABEL' => ['ru' => 'Название'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Название'],
            'LIST_FILTER_LABEL' => ['ru' => 'Название'],
        ],
        [
            'FIELD_NAME' => 'UF_DESCRIPTION',
            'USER_TYPE_ID' => 'string',
            'XML_ID' => 'UF_DESCRIPTION',
            'SORT' => 100,
            'EDIT_FORM_LABEL' => ['ru' => 'Описание'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Описание'],
            'LIST_FILTER_LABEL' => ['ru' => 'Описание'],
        ],
        [
            'FIELD_NAME' => 'UF_CITY',
            'USER_TYPE_ID' => 'enumeration',
            'XML_ID' => 'UF_CITY',
            'SORT' => 100,
            'EDIT_FORM_LABEL' => ['ru' => 'Город'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Город'],
            'LIST_FILTER_LABEL' => ['ru' => 'Город'],
        ],
        [
            'FIELD_NAME' => 'UF_WORKING_HOURS_START',
            'USER_TYPE_ID' => 'string',
            'XML_ID' => 'UF_WORKING_HOURS_START',
            'SORT' => 100,
            'EDIT_FORM_LABEL' => ['ru' => 'Часы работы с'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Часы работы с'],
            'LIST_FILTER_LABEL' => ['ru' => 'Часы работы с'],
        ],
        [
            'FIELD_NAME' => 'UF_WORKING_HOURS_END',
            'USER_TYPE_ID' => 'string',
            'XML_ID' => 'UF_WORKING_HOURS_END',
            'SORT' => 100,
            'EDIT_FORM_LABEL' => ['ru' => 'Часы работы по'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Часы работы по'],
            'LIST_FILTER_LABEL' => ['ru' => 'Часы работы по'],
        ],
        [
            'FIELD_NAME' => 'UF_ADDRESS',
            'USER_TYPE_ID' => 'string',
            'XML_ID' => 'UF_ADDRESS',
            'SORT' => 100,
            'EDIT_FORM_LABEL' => ['ru' => 'Адрес'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Адрес'],
            'LIST_FILTER_LABEL' => ['ru' => 'Адрес'],
        ],
        [
            'FIELD_NAME' => 'UF_COORDINATES',
            'USER_TYPE_ID' => 'string',
            'XML_ID' => 'UF_COORDINATES',
            'SORT' => 100,
            'EDIT_FORM_LABEL' => ['ru' => 'Координаты'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Координаты'],
            'LIST_FILTER_LABEL' => ['ru' => 'Координаты'],
        ],
    ];

    // TODO
    protected array $enumValues = [
        'UF_CITY' => [
            'n1' => [
                'VALUE' => 'Москва',
                'XML_ID' => 'PICKUP_POINT_CITY_MOSCOW',
                'DEF' => 'N',
                'SORT' => 10,
            ],
            'n2' => [
                'VALUE' => 'Санкт-Петербург',
                'XML_ID' => 'PICKUP_POINT_CITY_SPB',
                'DEF' => 'N',
                'SORT' => 20,
            ],
        ],
    ];
}

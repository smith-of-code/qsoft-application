<?php

use QSoft\Migrate\BaseCreateHighloadMigration;
use QSoft\Seeder\PetSeeder;

final class CreateHlBlockPet extends BaseCreateHighloadMigration
{
    protected ?string $seeder = PetSeeder::class;

    protected array $blockInfo = [
        'NAME'       => 'HlPets',
        'TABLE_NAME' => 'pet',
    ];

    protected array $blockLang = [
        'LID' => 'ru',
        'NAME' => 'HL-блок питомцев',
    ];

    protected array $fields = [
        // TODO: Пока оставляем так
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
            'USER_TYPE_ID' => 'integer',
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

    protected array $enumValues = [
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
    ];
}

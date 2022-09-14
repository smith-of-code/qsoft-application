<?php

use QSoft\Migrate\BaseCreateHighloadMigration;

class CreateHlBlockBreed extends BaseCreateHighloadMigration
{
    protected array $blockInfo = [
        'NAME'       => 'HlBreeds',
        'TABLE_NAME' => 'breed',
    ];

    protected array $blockLang = [
        'LID' => 'ru',
        'NAME' => 'HL-блок пород питомцев',
    ];

    protected array $fields = [
        [
            'FIELD_NAME' => 'UF_NAME',
            'USER_TYPE_ID' => 'string',
            'XML_ID' => 'UF_NAME',
            'SORT' => 100,
            'EDIT_FORM_LABEL' => ['ru' => 'Наименование породы'],
            'LIST_COLUMN_LABEL' => ['ru' => 'Наименование породы'],
            'LIST_FILTER_LABEL' => ['ru' => 'Наименование породы'],
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
}

<?php

use QSoft\Migrate\BaseCreateIBlockMigration;

final class CreateIBlockProduct extends BaseCreateIBlockMigration
{
    protected array $iBlockInfo = [
        'LID' => 's1',
        'IBLOCK_TYPE_ID' => 'catalog',
        'CODE' => 'products',
        'XML_ID' => 'products',
        'NAME' => 'Товары',
        'ACTIVE' => 'Y',
        'SORT' => 500,
        'VERSION' => 2,
        'RIGHTS_MODE' => 'S',
        'GROUP_ID' => [
            2 => 'R',
            6 => 'W',
            8 => '',
            5 => '',
            9 => 'W',
            10 => '',
            7 => '',
            1 => 'X',
        ],
        'FIELDS' => [
            'IBLOCK_SECTION' => [
                'IS_REQUIRED' => 'N',
                'DEFAULT_VALUE' => [
                    'KEEP_IBLOCK_SECTION_ID' => 'N',
                ],
            ],
            'ACTIVE' => [
                'IS_REQUIRED' => 'Y',
                'DEFAULT_VALUE' => 'Y',
            ],
            'SORT' => [
                'IS_REQUIRED' => 'Y',
            ],
            'PREVIEW_TEXT' => [
                'IS_REQUIRED' => 'Y',
            ],
            'DETAIL_TEXT_TYPE_ALLOW_CHANGE' => [
                'DEFAULT_VALUE' => 'Y',
            ],
            'DETAIL_PICTURE' => [
                'IS_REQUIRED' => 'Y',
            ],
            'DETAIL_TEXT' => [
                'IS_REQUIRED' => 'Y',
            ],
        ],
    ];

    protected array $iBlockPropertyInfo = [
        [
            'NAME' => 'Вес упаковки',
            'PROPERTY_TYPE' => 'N',
            'CODE' => 'weight',
        ],
        [
            'NAME' => 'Видео',
            'PROPERTY_TYPE' => 'S:video',
            'CODE' => 'video',
        ],
        [
            'NAME' => 'Вид животного',
            'PROPERTY_TYPE' => 'S:directory',
            'CODE' => 'pet_type',
        ],
        [
            'NAME' => 'Комплектность',
            'PROPERTY_TYPE' => 'S',
            'CODE' => 'completeness',
        ],
        [
            'NAME' => 'Материал',
            'PROPERTY_TYPE' => 'S',
            'CODE' => 'material',
        ],
        [
            'NAME' => 'Предназначение',
            'PROPERTY_TYPE' => 'S',
            'CODE' => 'purpose',
        ],
        [
            'NAME' => 'Состав',
            'PROPERTY_TYPE' => 'S',
            'CODE' => 'composition',
        ],
        [
            'NAME' => 'Рекомендации по кормлению',
            'PROPERTY_TYPE' => 'S',
            'CODE' => 'feeding_recommendations',
        ],
        [
            'NAME' => 'Лакомство',
            'PROPERTY_TYPE' => 'S',
            'CODE' => 'is_treat',
            'DEFAULT_VALUE' => 'N',
        ],
        [
            'NAME' => 'Возраст',
            'PROPERTY_TYPE' => 'S',
            'CODE' => 'age',
        ],
        [
            'NAME' => 'Порода',
            'PROPERTY_TYPE' => 'S:directory',
            'CODE' => 'breed',
        ],
        [
            'NAME' => 'Назначение',
            'PROPERTY_TYPE' => 'S',
            'CODE' => 'appointment',
        ],
        [
            'NAME' => 'Линейка',
            'PROPERTY_TYPE' => 'S:directory',
            'CODE' => 'line',
        ],
    ];
}

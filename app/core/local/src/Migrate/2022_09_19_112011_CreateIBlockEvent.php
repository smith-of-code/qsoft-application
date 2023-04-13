<?php

use QSoft\Migrate\BaseCreateIBlockMigration;

final class CreateIBlockEvent extends BaseCreateIBlockMigration
{
    protected array $iBlockInfo = [
        'LID' => 's1',
        'IBLOCK_TYPE_ID' => 'events',
        'CODE' => 'event',
        'XML_ID' => 'event',
        'NAME' => 'Мероприятия',
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
            'PREVIEW_TEXT' => [
                'IS_REQUIRED' => 'Y',
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
            'NAME' => 'Дата публикации',
            'PROPERTY_TYPE' => 'S',
            'CODE' => 'PUBLISHED_AT',
            'IS_REQUIRED' => 'Y',
            'USER_TYPE' => 'DateTime',
        ],
        [
            'NAME' => 'Дата проведения',
            'PROPERTY_TYPE' => 'S',
            'CODE' => 'EVENT_DATE',
            'IS_REQUIRED' => 'Y',
            'USER_TYPE' => 'DateTime',
        ],
        [
            'NAME' => 'Тип',
            'PROPERTY_TYPE' => 'L',
            'CODE' => 'EVENT_TYPE',
            'IS_REQUIRED' => 'Y',
            'VALUES' => [
                [
                    'VALUE' => 'Онлайн',
                    'XML_ID' => 'online',
                    'DEF' => 'N',
                    'SORT' => 500,
                ],
                [
                    'VALUE' => 'Оффлайн',
                    'XML_ID' => 'offline',
                    'DEF' => 'N',
                    'SORT' => 500,
                ],
            ],
        ],
    ];
}

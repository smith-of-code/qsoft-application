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
            'CODE' => 'published_at',
            'IS_REQUIRED' => 'Y',
            'USER_TYPE' => 'DateTime',
        ],
        [
            'NAME' => 'Дата проведения',
            'PROPERTY_TYPE' => 'S',
            'CODE' => 'event_date',
            'IS_REQUIRED' => 'Y',
            'USER_TYPE' => 'DateTime',
        ],
        [
            'NAME' => 'Тип',
            'PROPERTY_TYPE' => 'L',
            'CODE' => 'event_type',
            'IS_REQUIRED' => 'Y',
            'VALUES' => [
                [
                    'VALUE' => 'online',
                    'DEF' => 'N',
                    'SORT' => 500,
                ],
                [
                    'VALUE' => 'offline',
                    'DEF' => 'N',
                    'SORT' => 500,
                ],
            ],
        ],
    ];
}

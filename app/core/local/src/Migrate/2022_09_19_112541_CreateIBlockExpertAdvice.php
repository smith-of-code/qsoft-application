<?php

use QSoft\Migrate\BaseCreateIBlockMigration;

final class CreateIBlockExpertAdvice extends BaseCreateIBlockMigration
{
    protected array $iBlockInfo = [
        'LID' => 's1',
        'IBLOCK_TYPE_ID' => 'expert_advices',
        'CODE' => 'expert_advice',
        'XML_ID' => 'expert_advice',
        'NAME' => 'Советы эксперта',
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
            'NAME' => 'Целевая аудитория',
            'PROPERTY_TYPE' => 'S',
            'CODE' => 'TARGET_AUDIENCE',
            'IS_REQUIRED' => 'Y',
        ],
        [
            'NAME' => 'Маркер',
            'PROPERTY_TYPE' => 'L',
            'CODE' => 'MARKER',
            'LIST_TYPE' => 'L',
            'IS_REQUIRED' => 'Y',
            'VALUES' => [
                [
                    'VALUE' => 'Кошки',
                    'DEF' => 'N',
                    'XML_ID' => 'CATS',
                    'SORT' => 500,
                ],
                [
                    'VALUE' => 'Собаки',
                    'DEF' => 'N',
                    'XML_ID' => 'DOGS',
                    'SORT' => 1000,
                ],
                [
                    'VALUE' => 'Интересное',
                    'DEF' => 'N',
                    'XML_ID' => 'INTERESTING',
                    'SORT' => 1500,
                ],
                [
                    'VALUE' => 'AmeБизнес',
                    'DEF' => 'N',
                    'XML_ID' => 'AMEBUSINESS',
                    'SORT' => 2000,
                ],
            ],
        ],
    ];
}

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
            'CODE' => 'published_at',
            'IS_REQUIRED' => 'Y',
            'USER_TYPE' => 'DateTime',
        ],
        [
            'NAME' => 'Целевая аудитория',
            'PROPERTY_TYPE' => 'S',
            'CODE' => 'target_audience',
            'IS_REQUIRED' => 'Y',
        ],
    ];
}

<?php

use Bitrix\Main\DB\Connection;
use QSoft\Migrate\BaseCreateIBlockMigration;

final class CreateIBlockDiscounts extends BaseCreateIBlockMigration
{
    protected array $iBlockInfo = [
        'LID' => 's1',
        'IBLOCK_TYPE_ID' => 'discounts',
        'CODE' => 'discounts',
        'XML_ID' => 'discounts',
        'NAME' => 'Акции',
        'ACTIVE' => 'Y',
        'SORT' => 500,
        'VERSION' => 2,
        'RIGHTS_MODE' => 'S',
        'API_CODE' => 'Discounts',
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
            'ACTIVE' => [
                'IS_REQUIRED' => 'Y',
                'DEFAULT_VALUE' => 'Y',
            ],
            'NAME' => [
                'IS_REQUIRED' => 'Y',
                'DEFAULT_VALUE' => '',
            ],
            'PREVIEW_TEXT' => [
                'IS_REQUIRED' => 'Y',
            ],
            'DETAIL_PICTURE' => [
                'IS_REQUIRED' => 'Y',
            ],
        ],
    ];

    protected array $iBlockPropertyInfo = [
        [
            'NAME' => 'Размер скидки в процентах',
            'CODE' => 'DISCOUNT_VALUE',
            'PROPERTY_TYPE' => 'N',
            'IS_REQUIRED' => 'Y',
        ],
        [
            'NAME' => 'Акционный каталог',
            'CODE' => 'DISCOUNT_SECTION_ID',
            'PROPERTY_TYPE' => 'G',
            'LINK_IBLOCK_ID' => 'catalog',
            'IS_REQUIRED' => 'Y',
        ]
    ];
}

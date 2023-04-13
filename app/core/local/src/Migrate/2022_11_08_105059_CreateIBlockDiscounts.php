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
            'LINK_IBLOCK_ID' => 'product',//CODE - "product", IBLOCK_TYPE - "catalog"
            'IS_REQUIRED' => 'Y',
        ]
    ];

    //Если в новом свойстве используется поле 'LINK_IBLOCK_ID',
    //то установить данному полю числовое значение (ID инфоблока, к которому требуется привязать свойство)
    protected function beforeUp(): void
    {
        $this->includeIBlockModule();

        foreach ($this->iBlockPropertyInfo as &$property) {
            if (! $property['LINK_IBLOCK_ID']) {
                continue;
            }
            $iblockId = CIBlock::GetList([], ['CODE' => $property['LINK_IBLOCK_ID']])->Fetch()['ID'];
            if (! $iblockId) {
                throw new RuntimeException('Не найден инфоблок с кодом CODE=' . $property['LINK_IBLOCK_ID']);
            }
            $property['LINK_IBLOCK_ID'] = $iblockId;
        }
    }
}

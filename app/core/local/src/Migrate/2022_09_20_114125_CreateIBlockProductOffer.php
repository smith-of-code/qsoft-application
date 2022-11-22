<?php

use QSoft\Migrate\BaseCreateIBlockMigration;

final class CreateIBlockProductOffer extends BaseCreateIBlockMigration
{
    protected array $iBlockInfo = [
        'LID' => 's1',
        'IBLOCK_TYPE_ID' => 'offers',
        'CODE' => 'product_offer',
        'XML_ID' => 'product_offer',
        'NAME' => 'Товары (предложения)',
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
        ],
    ];

    protected array $iBlockPropertyInfo = [
        [
            'NAME' => 'Артикул',
            'PROPERTY_TYPE' => 'S',
            'CODE' => 'ARTICLE',
            'IS_REQUIRED' => 'Y',
        ],
        [
            'NAME' => 'Лейбл акционного товара',
            'PROPERTY_TYPE' => 'L',
            'CODE' => 'DISCOUNT_LABEL',
            'LIST_TYPE' => 'L',
            'VALUES' => [
                [
                    'VALUE' => 'Сезонное предложение',
                    'DEF' => 'N',
                    'XML_ID' => 'SEASONAL_OFFER',
                    'SORT' => 500,
                ],
                [
                    'VALUE' => 'Ограниченное предложение',
                    'DEF' => 'N',
                    'XML_ID' => 'LIMITED_OFFER',
                    'SORT' => 1000,
                ],
            ],
        ],
        [
            'NAME' => 'Фасовка',
            'PROPERTY_TYPE' => 'L',
            'CODE' => 'PACKAGING',
            'SMART_FILTER' => 'Y',
            'DISPLAY_TYPE' => 'F',
            'MULTIPLE' => 'Y',
        ],
        [
            'NAME' => 'Изображения',
            'PROPERTY_TYPE' => 'F',
            'CODE' => 'IMAGES',
            'MULTIPLE' => 'Y',
        ],
        [
            'NAME' => 'Хит продаж',
            'PROPERTY_TYPE' => 'L',
            'CODE' => 'IS_BESTSELLER',
            'LIST_TYPE' => 'C',
            'SMART_FILTER' => 'Y',
            'DISPLAY_TYPE' => 'F',
            'DISPLAY_EXPANDED' => 'Y',
            'VALUES' => [
                [
                    'VALUE' => 'Да',
                    'DEF' => 'N',
                    'SORT' => 500,
                ],
            ],
        ],
        [
            'NAME' => 'Цвет',
            'PROPERTY_TYPE' => 'S',
            'CODE' => 'COLOR',
            'SMART_FILTER' => 'Y',
            'DISPLAY_TYPE' => 'F',
            'USER_TYPE' => 'directory',
            'USER_TYPE_SETTINGS' => [
                'TABLE_NAME' => 'eshop_color_reference',
            ],
        ],
        [
            'NAME' => 'Размер',
            'PROPERTY_TYPE' => 'S',
            'CODE' => 'SIZE',
            'SMART_FILTER' => 'Y',
            'DISPLAY_TYPE' => 'F',
            'USER_TYPE' => 'directory',
            'USER_TYPE_SETTINGS' => [
                'TABLE_NAME' => 'size',
            ],
        ],
    ];

    protected function afterUp(): void
    {
        $this->includeCatalogModule();

        $productIblockId = (new CIBlock())->GetList([], ['CODE' => 'product'])->Fetch()['ID'];
        if (!$productIblockId) {
            throw new RuntimeException('Не найден инфоблок "Товары"');
        }

        $skuId = CIBlockPropertyTools::createProperty(
            $this->iBlockId,
            CIBlockPropertyTools::CODE_SKU_LINK,
            ['LINK_IBLOCK_ID' => $productIblockId]
        );

        $fields = [
            'IBLOCK_ID' => $this->iBlockId,
            'PRODUCT_IBLOCK_ID' => $productIblockId,
            'SKU_PROPERTY_ID' => $skuId,
        ];

        $catalog = new CCatalog();
        if (!$catalog->Add($fields)) {
            global $APPLICATION;
            throw new \RuntimeException(sprintf('Не удалось добавить каталог: %s', $APPLICATION->GetException()->GetString()));
        }
    }

    protected function beforeDown(): void
    {
        $this->includeCatalogModule();

        $productIblockId = (new CIBlock())->GetList([], ['CODE' => 'product'])->Fetch()['ID'];
        if (!$productIblockId) {
            throw new RuntimeException('Не найден инфоблок "Товары"');
        }

        CCatalog::UnLinkSKUIBlock($productIblockId);
    }

    private function includeCatalogModule(): void
    {
        if (!CModule::IncludeModule('catalog')) {
            throw new \RuntimeException('Не удалось подключить модуль catalog');
        }
    }
}

<?php

use QSoft\Migrate\BaseCreateIBlockMigration;

final class CreateIBlockAccessoryOffer extends BaseCreateIBlockMigration
{
    protected array $iBlockInfo = [
        'LID' => 's1',
        'IBLOCK_TYPE_ID' => 'offers',
        'CODE' => 'accessory_offer',
        'XML_ID' => 'accessory_offer',
        'NAME' => 'Торговые предложения (аксессуары)',
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
            'CODE' => 'article',
            'IS_REQUIRED' => 'Y',
        ],
        [
            'NAME' => 'Цена',
            'PROPERTY_TYPE' => 'N',
            'CODE' => 'price',
            'IS_REQUIRED' => 'Y',
        ],
        [
            'NAME' => 'Акционная цена',
            'PROPERTY_TYPE' => 'N',
            'CODE' => 'discounted_price',
        ],
        [
            'NAME' => 'Количество на складе',
            'PROPERTY_TYPE' => 'N',
            'CODE' => 'quantity',
            'IS_REQUIRED' => 'Y',
        ],
        [
            'NAME' => 'Баллы за заказ',
            'PROPERTY_TYPE' => 'N',
            'CODE' => 'points',
        ],
        [
            'NAME' => 'Ограниченное предложение',
            'PROPERTY_TYPE' => 'L',
            'CODE' => 'limited_offer',
            'LIST_TYPE' => 'C',
            'VALUES' => [
                [
                    'VALUE' => 'Да',
                    'DEF' => 'N',
                    'SORT' => 500,
                ],
            ],
        ],
        [
            'NAME' => 'Сезонное предложение',
            'PROPERTY_TYPE' => 'L',
            'CODE' => 'seasonal_offer',
            'LIST_TYPE' => 'C',
            'VALUES' => [
                [
                    'VALUE' => 'Да',
                    'DEF' => 'N',
                    'SORT' => 500,
                ],
            ],
        ],
        [
            'NAME' => 'Размер',
            'PROPERTY_TYPE' => 'S',
            'CODE' => 'size',
            'MULTIPLE' => 'Y',
        ],
        [
            'NAME' => 'Изображения',
            'PROPERTY_TYPE' => 'F',
            'CODE' => 'images',
            'MULTIPLE' => 'Y',
        ],
        [
            'NAME' => 'Хит продаж',
            'PROPERTY_TYPE' => 'L',
            'CODE' => 'hit',
            'LIST_TYPE' => 'C',
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
            'PROPERTY_TYPE' => 'L',
            'CODE' => 'color',
            'LIST_TYPE' => 'C',
        ],
        [
            'NAME' => 'Размер',
            'PROPERTY_TYPE' => 'L',
            'CODE' => 'size',
            'LIST_TYPE' => 'C',
        ],
    ];

    protected function afterUp(): void
    {
        $this->includeCatalogModule();

        $accessoryIblockId = (new CIBlock())->GetList([], ['CODE' => 'accessory'])->Fetch()['ID'];
        if (!$accessoryIblockId) {
            throw new RuntimeException('Не найден инфоблок "Аксессуары"');
        }

        $skuId = CIBlockPropertyTools::createProperty(
            $this->iBlockId,
            CIBlockPropertyTools::CODE_SKU_LINK,
            ['LINK_IBLOCK_ID' => $accessoryIblockId]
        );

        $fields = [
            'IBLOCK_ID' => $this->iBlockId,
            'PRODUCT_IBLOCK_ID' => $accessoryIblockId,
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

        $accessoryIblockId = (new CIBlock())->GetList([], ['CODE' => 'accessory'])->Fetch()['ID'];
        if (!$accessoryIblockId) {
            throw new RuntimeException('Не найден инфоблок "Аксессуары"');
        }

        CCatalog::UnLinkSKUIBlock($accessoryIblockId);
    }

    private function includeCatalogModule(): void
    {
        if (!CModule::IncludeModule('catalog')) {
            throw new \RuntimeException('Не удалось подключить модуль catalog');
        }
    }
}

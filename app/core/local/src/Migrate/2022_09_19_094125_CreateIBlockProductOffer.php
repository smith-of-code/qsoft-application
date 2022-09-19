<?php

use QSoft\Migrate\BaseCreateIBlockMigration;

final class CreateIBlockProductOffer extends BaseCreateIBlockMigration
{
    protected array $iBlockInfo = [
        'LID' => 's1',
        'IBLOCK_TYPE_ID' => 'catalog',
        'CODE' => 'product_offers',
        'XML_ID' => 'product_offers',
        'NAME' => 'Торговые предложения',
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
            'DETAIL_PICTURE' => [
                'IS_REQUIRED' => 'Y',
            ],
        ],
    ];

    protected array $iBlockPropertyInfo = [
        [
            'NAME' => 'Товар',
            'PROPERTY_TYPE' => 'E',
            'CODE' => 'product',
        ],
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
                [
                    'VALUE' => 'Нет',
                    'DEF' => 'Y',
                    'SORT' => 1000,
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
                [
                    'VALUE' => 'Нет',
                    'DEF' => 'Y',
                    'SORT' => 1000,
                ],
            ],
        ],
        [
            'NAME' => 'Размер',
            'PROPERTY_TYPE' => 'S',
            'CODE' => 'size',
        ],
        [
            'NAME' => 'Фасовка',
            'PROPERTY_TYPE' => 'S',
            'CODE' => 'packaging',
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
                [
                    'VALUE' => 'Нет',
                    'DEF' => 'Y',
                    'SORT' => 1000,
                ],
            ],
        ],
    ];
}

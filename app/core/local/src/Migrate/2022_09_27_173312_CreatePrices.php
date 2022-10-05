<?php

use QSoft\Migrate\BaseCreatePriceMigration;

final class CreatePrices extends BaseCreatePriceMigration
{
    protected array $userGroups = ['consultant'];

    protected array $prices = [
        [
            'NAME' => 'K1',
            'SORT' => 110,
            'XML_ID' => 'PRICE_K1',
            'USER_LANG' => [
                'ru' => 'Цена для уровня K1',
                'en' => 'Price for level K1',
            ],
        ],
        [
            'NAME' => 'K2',
            'SORT' => 120,
            'XML_ID' => 'PRICE_K2',
            'USER_LANG' => [
                'ru' => 'Цена для уровня K2',
                'en' => 'Price for level K2',
            ],
        ],
        [
            'NAME' => 'K3',
            'SORT' => 130,
            'XML_ID' => 'PRICE_K3',
            'USER_LANG' => [
                'ru' => 'Цена для уровня K3',
                'en' => 'Price for level K3',
            ],
        ],
    ];
}

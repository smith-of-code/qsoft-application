<?php

use Bitrix\Iblock\PropertyTable;
use Bitrix\Main\DB\Connection;
use QSoft\Migrate\AbstractMigration;
use Bitrix\Main\Loader;

final class AddDiscountPricesPropsToOffers extends AbstractMigration
{

    public function onUp(Connection $connection): void
    {
        if (!Loader::includeModule('iblock')) {
            throw new RuntimeException('Не удалось подключить модуль iblock');
        }

        $offersIbId = CIBlock::GetList([], ['CODE' => 'product_offer'])->Fetch()['ID'];

        if (! $offersIbId) {
            throw new RuntimeException('Не найден инфоблок "product_offer"');
        }

        $newProps = [
            [
                'IBLOCK_ID' => $offersIbId,
                'NAME' => 'Акционная цена для уровня K1',
                'PROPERTY_TYPE' => 'N',
                'CODE' => 'DISCOUNT_PRICE_K1',
                'XML_ID' => 'DISCOUNT_PRICE_K1',
                'IS_REQUIRED' => 'N',
                'FILTRABLE' => 'Y',
                'SMART_FILTER' => 'Y',
                'DISPLAY_TYPE' => 'A',
                'HINT' => 'Цена с учетом персональной скидки для уровня K1 программы лояльности. Заполняется автоматически.',
            ],
            [
                'IBLOCK_ID' => $offersIbId,
                'NAME' => 'Акционная цена для уровня K2',
                'PROPERTY_TYPE' => 'N',
                'CODE' => 'DISCOUNT_PRICE_K2',
                'XML_ID' => 'DISCOUNT_PRICE_K2',
                'IS_REQUIRED' => 'N',
                'FILTRABLE' => 'Y',
                'SMART_FILTER' => 'Y',
                'DISPLAY_TYPE' => 'A',
                'HINT' => 'Цена с учетом персональной скидки для уровня K2 программы лояльности. Заполняется автоматически.',
            ],
            [
                'IBLOCK_ID' => $offersIbId,
                'NAME' => 'Акционная цена для уровня K3',
                'PROPERTY_TYPE' => 'N',
                'CODE' => 'DISCOUNT_PRICE_K3',
                'XML_ID' => 'DISCOUNT_PRICE_K3',
                'IS_REQUIRED' => 'N',
                'FILTRABLE' => 'Y',
                'SMART_FILTER' => 'Y',
                'DISPLAY_TYPE' => 'A',
                'HINT' => 'Цена с учетом персональной скидки для уровня K3 программы лояльности. Заполняется автоматически.',
            ],
            [
                'IBLOCK_ID' => $offersIbId,
                'NAME' => 'Акционная цена для уровня B1',
                'PROPERTY_TYPE' => 'N',
                'CODE' => 'DISCOUNT_PRICE_B1',
                'XML_ID' => 'DISCOUNT_PRICE_B1',
                'IS_REQUIRED' => 'N',
                'FILTRABLE' => 'Y',
                'SMART_FILTER' => 'Y',
                'DISPLAY_TYPE' => 'A',
                'HINT' => 'Цена с учетом персональной скидки для уровня B1. Заполняется автоматически.',
            ],
            [
                'IBLOCK_ID' => $offersIbId,
                'NAME' => 'Акционная цена для уровня B2',
                'PROPERTY_TYPE' => 'N',
                'CODE' => 'DISCOUNT_PRICE_B2',
                'XML_ID' => 'DISCOUNT_PRICE_B2',
                'IS_REQUIRED' => 'N',
                'FILTRABLE' => 'Y',
                'SMART_FILTER' => 'Y',
                'DISPLAY_TYPE' => 'A',
                'HINT' => 'Цена с учетом персональной скидки для уровня B2. Заполняется автоматически.',
            ],
            [
                'IBLOCK_ID' => $offersIbId,
                'NAME' => 'Акционная цена для уровня B3',
                'PROPERTY_TYPE' => 'N',
                'CODE' => 'DISCOUNT_PRICE_B3',
                'XML_ID' => 'DISCOUNT_PRICE_B3',
                'IS_REQUIRED' => 'N',
                'FILTRABLE' => 'Y',
                'SMART_FILTER' => 'Y',
                'DISPLAY_TYPE' => 'A',
                'HINT' => 'Цена с учетом персональной скидки для уровня B3. Заполняется автоматически.',
            ],
        ];

        $iBlockProperty = new \CIBlockProperty();
        foreach ($newProps as $prop) {

            $result = $iBlockProperty->Add($prop);

            if (!$result) {
                throw new \RuntimeException($iBlockProperty->LAST_ERROR);
            }

            if ($result > 0) {
                echo 'Свойство [' . $result . '] ' . $prop['NAME'] . ' добавлено.' . PHP_EOL;
            }
        }
    }

    public function onDown(Connection $connection): void
    {
        if (!Loader::includeModule('iblock')) {
            throw new RuntimeException('Не удалось подключить модуль iblock');
        }

        $offersIbId = CIBlock::GetList([], ['CODE' => 'product_offer'])->Fetch()['ID'];

        if (! $offersIbId) {
            throw new RuntimeException('Не найден инфоблок "product_offer"');
        }

        $propsDB = PropertyTable::getList([
            'order' => [],
            'select' => ['*'],
            'filter' => [
                'IBLOCK_ID' => $offersIbId,
                '@CODE' => [
                    'DISCOUNT_PRICE_K1',
                    'DISCOUNT_PRICE_K2',
                    'DISCOUNT_PRICE_K2',
                    'DISCOUNT_PRICE_B1',
                    'DISCOUNT_PRICE_B2',
                    'DISCOUNT_PRICE_B3',
                ],
            ],
        ]);
        while ($prop = $propsDB->fetch()) {
            $res = PropertyTable::Delete($prop['ID']);
            if (!$res->isSuccess()) {
                throw new RuntimeException(implode(', ', $res->getErrorMessages()));
            } else {
                echo 'Свойство [' . $prop['ID'] . '] ' . $prop['NAME'] . ' удалено.' . PHP_EOL;
            }
        }

    }
}

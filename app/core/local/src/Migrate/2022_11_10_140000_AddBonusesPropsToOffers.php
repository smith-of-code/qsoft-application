<?php

use Bitrix\Iblock\PropertyTable;
use Bitrix\Main\DB\Connection;
use QSoft\Migrate\AbstractMigration;
use Bitrix\Main\Loader;

final class AddBonusesPropsToOffers extends AbstractMigration
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
                'NAME' => 'Бонусы для уровня K1',
                'PROPERTY_TYPE' => 'N',
                'CODE' => 'BONUSES_K1',
                'XML_ID' => 'BONUSES_K1',
                'IS_REQUIRED' => 'N',
                'FILTRABLE' => 'Y',
                'SMART_FILTER' => 'Y',
                'DISPLAY_TYPE' => 'A',
                'HINT' => 'Количество бонусов, начисляемых при покупке. Заполняется автоматически.',
            ],
            [
                'IBLOCK_ID' => $offersIbId,
                'NAME' => 'Бонусы для уровня K2',
                'PROPERTY_TYPE' => 'N',
                'CODE' => 'BONUSES_K2',
                'XML_ID' => 'BONUSES_K2',
                'IS_REQUIRED' => 'N',
                'FILTRABLE' => 'Y',
                'SMART_FILTER' => 'Y',
                'DISPLAY_TYPE' => 'A',
                'HINT' => 'Количество бонусов, начисляемых при покупке. Заполняется автоматически.',
            ],
            [
                'IBLOCK_ID' => $offersIbId,
                'NAME' => 'Бонусы для уровня K3',
                'PROPERTY_TYPE' => 'N',
                'CODE' => 'BONUSES_K3',
                'XML_ID' => 'BONUSES_K3',
                'IS_REQUIRED' => 'N',
                'FILTRABLE' => 'Y',
                'SMART_FILTER' => 'Y',
                'DISPLAY_TYPE' => 'A',
                'HINT' => 'Количество бонусов, начисляемых при покупке. Заполняется автоматически.',
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
                '@CODE' => ['BONUSES_K1', 'BONUSES_K2', 'BONUSES_K3'],
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

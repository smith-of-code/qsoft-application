<?php

use Bitrix\Iblock\Model\PropertyFeature;
use Bitrix\Iblock\PropertyTable;
use Bitrix\Main\DB\Connection;
use QSoft\Migrate\AbstractMigration;
use Bitrix\Main\Loader;

final class SetFeaturesForOfferProps extends AbstractMigration
{
    // Перечень возможных "фич"
    // "FEATURE_ID" => "MODULE_ID"
    private $featureIds = [
        'LIST_PAGE_SHOW' => 'iblock', // Показывать на странице списка элементов
        'DETAIL_PAGE_SHOW' => 'iblock', // Показывать на детальной странице элемента
        'IN_BASKET' => 'catalog', // Значение добавляется в корзину
        'OFFER_TREE' => 'catalog', // Используется для выбора торговых предложений
    ];

    private $offersProps = [
        'ARTICLE' => [
            'LIST_PAGE_SHOW' => 'Y',
            'DETAIL_PAGE_SHOW' => 'Y',
            'IN_BASKET' => 'Y',
        ],
        'DISCOUNT_LABEL' => [
            'LIST_PAGE_SHOW' => 'Y',
            'DETAIL_PAGE_SHOW' => 'Y',
        ],
        'PACKAGING' => [
            'DETAIL_PAGE_SHOW' => 'Y',
            'LIST_PAGE_SHOW' => 'Y',
            'IN_BASKET' => 'Y',
            'OFFER_TREE' => 'Y',
        ],
        'COLOR' => [
            'DETAIL_PAGE_SHOW' => 'Y',
            'LIST_PAGE_SHOW' => 'Y',
            'IN_BASKET' => 'Y',
            'OFFER_TREE' => 'Y',
        ],
        'SIZE' => [
            'DETAIL_PAGE_SHOW' => 'Y',
            'LIST_PAGE_SHOW' => 'Y',
            'IN_BASKET' => 'Y',
            'OFFER_TREE' => 'Y',
        ],
    ];

    public function onUp(Connection $connection): void
    {
        if (!Loader::includeModule('iblock')) {
            throw new RuntimeException('Не удалось подключить модуль iblock');
        }

        $offersIbId = CIBlock::GetList([], ['CODE' => 'product_offer'])->Fetch()['ID'];

        if (! $offersIbId) {
            throw new RuntimeException('Не найден инфоблок "product_offer"');
        }

        $props = $this->getProperties($offersIbId, $this->offersProps);

        foreach ($this->offersProps as $propCode => $featuresList) {
            if (! in_array($propCode, array_keys($props))) {
                continue;
            }
            foreach ($featuresList as $featureId => $flag) {
                if (! in_array($featureId, array_keys($this->featureIds), true)) {
                    continue;
                }
                if (! in_array($flag, ['Y', 'N'], true)) {
                    continue;
                }
                PropertyFeature::updateFeatures(
                    $props[$propCode],
                    [
                        [
                            "FEATURE_ID" => $featureId,
                            "IS_ENABLED" => $flag,
                            "MODULE_ID" => $this->featureIds[$featureId],
                        ]
                    ]
                );
                echo 'Для свойства ' . $propCode . '[' . $props[$propCode] . '] установлено ' . $featureId . ' = ' . $flag . PHP_EOL;
            }
        }
    }

    public function onDown(Connection $connection): void
    {

    }

    private function getProperties($iblockId, $links): array
    {
        $props = [];
        $propsDb = PropertyTable::getList([
            'order' => [],
            'select' => ['*'],
            'filter' => ['IBLOCK_ID' => $iblockId]
        ]);

        while ($prop = $propsDb->fetch()) {
            if (isset($links[$prop['CODE']]))
                $props[$prop['CODE']] = $prop['ID'];
        }
        return $props;
    }
}

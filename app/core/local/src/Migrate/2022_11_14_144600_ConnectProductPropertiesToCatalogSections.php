<?php

use Bitrix\Iblock\PropertyTable;
use Bitrix\Iblock\SectionPropertyTable;
use Bitrix\Iblock\SectionTable;
use Bitrix\Main\DB\Connection;
use QSoft\Migrate\AbstractMigration;
use Bitrix\Main\Loader;

final class ConnectProductPropertiesToCatalogSections extends AbstractMigration
{
    private $catalogPropsLinks = [
        'APPOINTMENT' => [
            'treats_for_cats',
            'treats_for_dogs',
        ],
        'FEED_TASTE' => [
            'wet_food_for_cats',
            'dry_food_for_cats',
            'wet_food_for_dogs',
            'dry_food_for_dogs',
        ],
        'AGE' => [
            'wet_food_for_cats',
            'dry_food_for_cats',
            'wet_food_for_dogs',
            'dry_food_for_dogs',
        ],
        'SPECIAL_INDICATIONS' => [
            'wet_food_for_cats',
            'dry_food_for_cats',
            'wet_food_for_dogs',
            'dry_food_for_dogs',
        ],
        'LINE' => [
            'wet_food_for_cats',
            'dry_food_for_cats',
            'wet_food_for_dogs',
            'dry_food_for_dogs',
        ],
        'MATERIAL' => [
            'accessories_for_cats',
            'accessories_for_dogs',
        ],
        'BREED' => [
            'wet_food_for_cats',
            'dry_food_for_cats',
            'wet_food_for_dogs',
            'dry_food_for_dogs',
        ],
    ];
    private $offersPropsLinks = [
        'PACKAGING' => [
            'wet_food_for_cats',
            'dry_food_for_cats',
            'wet_food_for_dogs',
            'dry_food_for_dogs',
        ],
        'COLOR' => [
            'accessories_for_cats',
            'accessories_for_dogs',
        ],
        'SIZE' => [
            'accessories_for_cats',
            'accessories_for_dogs',
        ],
    ];

    private $sectionsIDs = [];
    private $catalogProps = [];
    private $offersProps = [];

    public function onUp(Connection $connection): void
    {
        if (!Loader::includeModule('iblock')) {
            throw new RuntimeException('Не удалось подключить модуль iblock');
        }

        $catalogIbId = CIBlock::GetList([], ['CODE' => 'product'])->Fetch()['ID'];
        $offersIbId = CIBlock::GetList([], ['CODE' => 'product_offer'])->Fetch()['ID'];

        if (! $catalogIbId) {
            throw new RuntimeException('Не найден инфоблок "product"');
        }
        if (! $offersIbId) {
            throw new RuntimeException('Не найден инфоблок "product_offer"');
        }

        $sectionsIDs = $this->getSectionsIDs($catalogIbId);
        $catalogProps = $this->getProperties($catalogIbId, $this->catalogPropsLinks);
        $offersProps = $this->getProperties($offersIbId, $this->offersPropsLinks);

        // Получаем записи привязки свойств к разделам
        $linksDb = SectionPropertyTable::getList([
            'order' => [],
            'select' => ['*'],
            'filter' => ['@IBLOCK_ID' => [$catalogIbId, $offersIbId]]
        ]);

        // Отвязываем от корневого раздела свойства, которые в дальнейшем будут привязаны к разделам каталога
        while ($link = $linksDb->fetch()) {
            if ((int) $link['SECTION_ID'] == 0) {
                if (in_array($link['PROPERTY_ID'], $catalogProps)) {
                    SectionPropertyTable::delete([
                        'IBLOCK_ID' => $catalogIbId,
                        'SECTION_ID' => 0,
                        'PROPERTY_ID' => $link['PROPERTY_ID'],
                    ]);

                } elseif (in_array($link['PROPERTY_ID'], $offersProps)) {
                    SectionPropertyTable::delete([
                        'IBLOCK_ID' => $offersIbId,
                        'SECTION_ID' => 0,
                        'PROPERTY_ID' => $link['PROPERTY_ID'],
                    ]);
                }
            }
        }

        // Привязываем свойства товаров к разделам каталога
        foreach ($catalogProps as $code => $id) {
            foreach ($this->catalogPropsLinks[$code] as $sectionCode) {
                $this->addLinkToSection($catalogIbId, $sectionsIDs[$sectionCode], $id);
            }
        }

        // Привязываем свойства торговых предложений к разделам каталога
        foreach ($offersProps as $code => $id) {
            foreach ($this->offersPropsLinks[$code] as $sectionCode) {
                $this->addLinkToSection($catalogIbId, $sectionsIDs[$sectionCode], $id);
            }
        }
    }

    public function onDown(Connection $connection): void
    {
        if (!Loader::includeModule('iblock')) {
            throw new RuntimeException('Не удалось подключить модуль iblock');
        }

        $catalogIbId = CIBlock::GetList([], ['CODE' => 'product'])->Fetch()['ID'];
        $offersIbId = CIBlock::GetList([], ['CODE' => 'product_offer'])->Fetch()['ID'];

        if (! $catalogIbId) {
            throw new RuntimeException('Не найден инфоблок "product"');
        }
        if (! $offersIbId) {
            throw new RuntimeException('Не найден инфоблок "product_offer"');
        }

        $sectionsIDs = $this->getSectionsIDs($catalogIbId);
        $catalogProps = $this->getProperties($catalogIbId, $this->catalogPropsLinks);
        $offersProps = $this->getProperties($offersIbId, $this->offersPropsLinks);

        // Получаем записи привязки свойств к разделам каталога
        $linksDb = SectionPropertyTable::getList([
            'order' => [],
            'select' => ['*'],
            'filter' => ['IBLOCK_ID' => $catalogIbId]
        ]);

        // Отвязываем от всех разделов свойства каталога и ИБ Торговых предложений
        while ($link = $linksDb->fetch()) {
            if (in_array($link['PROPERTY_ID'], $catalogProps) || in_array($link['PROPERTY_ID'], $offersProps)) {
                SectionPropertyTable::delete([
                    'IBLOCK_ID' => $catalogIbId,
                    'SECTION_ID' => $link['SECTION_ID'],
                    'PROPERTY_ID' => $link['PROPERTY_ID'],
                ]);
            }
        }

        // Привязываем к корневому разделу
        foreach ($catalogProps as $code => $id) {
            $this->addLinkToSection($catalogIbId, 0, $id);
        }
        foreach ($offersProps as $code => $id) {
            $this->addLinkToSection($catalogIbId, 0, $id);
        }
    }

    private function getSectionsIDs($iblockId): array
    {
        $sectionsIDs = [];
        // Получаем разделы каталога
        $sectionsIDsDb = SectionTable::getList([
            'order' => [],
            'select' => ['*'],
            'filter' => ['IBLOCK_ID' => $iblockId]
        ]);
        while ($section = $sectionsIDsDb->fetch()) {
            $sectionsIDs[$section['CODE']] = $section['ID'];
        }
        return $sectionsIDs;
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

    private function addLinkToSection($iblockId, $sectionId, $propertyId)
    {
        $link = SectionPropertyTable::getList([
            'order' => [],
            'select' => ['*'],
            'filter' => [
                'IBLOCK_ID' => $iblockId,
                'SECTION_ID' => $sectionId,
                'PROPERTY_ID' => $propertyId,
            ],
        ])->fetch();
        if ($link) {
            SectionPropertyTable::update(
                [
                    'IBLOCK_ID' => $iblockId,
                    'SECTION_ID' => $sectionId,
                    'PROPERTY_ID' => $propertyId,
                ],
                [
                    'SMART_FILTER' => 'Y',
                    'DISPLAY_TYPE' => 'F',
                    'DISPLAY_EXPANDED' => 'N',
                    'FILTER_HINT' => '',
                ]
            );
        } else {
            SectionPropertyTable::add([
                'IBLOCK_ID' => $iblockId,
                'SECTION_ID' => $sectionId,
                'PROPERTY_ID' => $propertyId,
                'SMART_FILTER' => 'Y',
                'DISPLAY_TYPE' => 'F',
                'DISPLAY_EXPANDED' => 'N',
                'FILTER_HINT' => '',
            ]);
        }
    }
}

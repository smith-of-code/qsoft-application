<?php

namespace QSoft\Helper;

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;

class DiscountsHelper
{
    private const DISCOUNTS_LIMIT = 6;

    public static function getDiscounts(int $offset): array
    {
        self::checkModules();
        $discounts = self::getRawDiscounts($offset);
        $catalogUrl = self::getCatalogUrl(array_map(fn($discount) => $discount['CATALOG'], $discounts));
        self::addPictureAndCatalogUrl($catalogUrl, $discounts);
        return $discounts ?? [];
    }

    public static function checkModules()
    {
        if (! Loader::includeModule('iblock')) {
            throw new \Exception(Loc::GetMessage('IBLOCK_MODULE_NOT_INCLUDED'));
        }
    }

    private static function getRawDiscounts(int $offset = 0): array
    {
        $rowDiscountsResult = \CIBlockElement::GetList(
            [],
            [
                'IBLOCK_ID' => IBLOCK_DISCOUNTS
            ],
            false,
            [
                'nTopCount' => self::DISCOUNTS_LIMIT,
                'nOffset' => $offset,
            ],
            [
                'ID',
                'IBLOCK_ID',
                'PREVIEW_TEXT',
                'DETAIL_PICTURE',
                'PROPERTY_DISCOUNT_VALUE',
                'PROPERTY_DISCOUNT_SECTION_ID'
            ]
        );
        $discounts = [];
        while ($element = $rowDiscountsResult->GetNext(true, false)) {
            $discounts[] = [
                'ID' => $element['ID'],
                'TEXT' => $element['PREVIEW_TEXT'],
                'PICTURE' => $element['DETAIL_PICTURE'],
                'DISCOUNT' => $element['PROPERTY_DISCOUNT_VALUE_VALUE'],
                'CATALOG' => $element['PROPERTY_DISCOUNT_SECTION_ID_VALUE'],
            ];
        }
        return $discounts;
    }

    private static function getCatalogUrl(array $sectionIds): array
    {
        $catalogUrlResult = \CIBlockSection::GetList(
            [],
            [
                'ID' => $sectionIds
            ],
            false,
            [
                'ID',
                'SECTION_PAGE_URL'
            ],
        );
        $catalogUrl = [];
        while ($element = $catalogUrlResult->GetNext(true, false)) {
            $catalogUrl[$element['ID']] = $element['SECTION_PAGE_URL'];
        }
        return $catalogUrl;
    }

    private static function addPictureAndCatalogUrl($url, &$discounts): void
    {
        foreach ($discounts as &$discount) {
            $discount['CATALOG'] = $url[$discount['CATALOG']];
            $discount['PICTURE'] = \CFile::GetPath($discount['PICTURE']);
        }
    }
}

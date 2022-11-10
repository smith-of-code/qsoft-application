<?php

namespace QSoft\Service;

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;

class DiscountsService
{
    private const DISCOUNTS_LIMIT = 2;

    public static function getDiscounts(int $offset): array
    {
        self::checkModules();
        $discounts = self::getRawDiscounts($offset);
        $detailPageUrl = self::getDetailPageUrl(array_map(fn($discount) => $discount['PRODUCT'], $discounts));
        $discounts = self::addPictureAndUrl($detailPageUrl, $discounts);
        return $discounts;
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
                'PROPERTY_PRODUCT_ID',
            ]
        );
        $discounts = [];
        while ($element = $rowDiscountsResult->GetNext(true, false)) {
            $discount = [];
            $discount['ID'] = $element['ID'];
            $discount['TEXT'] = $element['PREVIEW_TEXT'];
            $discount['PICTURE'] = $element['DETAIL_PICTURE'];
            $discount['DISCOUNT'] = $element['PROPERTY_DISCOUNT_VALUE_VALUE'];
            $discount['PRODUCT'] = $element['PROPERTY_PRODUCT_ID_VALUE'];
            $discounts[] = $discount;
        }
        return $discounts;
    }

    private static function getDetailPageUrl(array $productsId): array
    {
        $detailPageUrlResult = \CIBlockElement::GetList(
            [],
            [
                'ID' => $productsId
            ],
            false,
            false,
            [
                'ID',
                'DETAIL_PAGE_URL'
            ]
        );
        $detailPageUrl = [];
        while ($element = $detailPageUrlResult->GetNext(true, false)) {
            $detailPageUrl[$element['ID']] = $element['DETAIL_PAGE_URL'];
        }
        return $detailPageUrl;
    }

    private static function addPictureAndUrl($url, &$discounts): void
    {
        foreach ($discounts as &$discount) {
            $discount['PRODUCT'] = $url[$discount['PRODUCT']];
            $discount['PICTURE'] = \CFile::GetPath($discount['PICTURE']);
        }
    }
}

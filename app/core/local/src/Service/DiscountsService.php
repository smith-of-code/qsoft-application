<?php

namespace QSoft\Service;

use QSoft\Common\DataSource;

class DiscountsService
{
    private const DISCOUNTS_LIMIT = 2;

    public static function getDiscounts(int $offset): array
    {
        $discounts = self::getRawDiscounts($offset);
        $detailPageUrl = self::getDetailPageUrl(array_map(fn($discount) => $discount['PRODUCT'], $discounts));
        self::addPictureAndUrl($detailPageUrl, $discounts);
        return $discounts;
    }

    private static function getRawDiscounts(int $offset = 0): array
    {
        $dataSource = new DataSource(IBLOCK_DISCOUNTS, self::DISCOUNTS_LIMIT);
        return $dataSource
            ->select([
                'ID',
                'TEXT' => 'PREVIEW_TEXT',
                'PICTURE' => 'DETAIL_PICTURE',
                'DISCOUNT' => 'DISCOUNT_VALUE.VALUE',
                'PRODUCT' => 'PRODUCT_ID.VALUE',
            ])->getElements($offset);
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

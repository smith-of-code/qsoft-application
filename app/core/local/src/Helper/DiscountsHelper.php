<?php

namespace QSoft\Helper;

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Psr\Log\LogLevel;
use QSoft\Logger\Logger;

class DiscountsHelper
{
    public static function getDiscounts(int $offset, int $limit): array
    {
        self::checkModules();
        $discounts = self::getRawDiscounts($offset, $limit);
        $catalogUrl = self::getCatalogUrl(array_map(fn($discount) => $discount['CATALOG'], $discounts));
        $discounts = self::addPictureAndCatalogUrl($catalogUrl, $discounts);
        $discounts = self::getFirstWordForAccent($discounts);
        return $discounts ?? [];
    }

    public static function checkModules()
    {
        if (! Loader::includeModule('iblock')) {
            $error = new \Exception(Loc::GetMessage('IBLOCK_MODULE_NOT_INCLUDED'));
            Logger::createFormatedLog(__CLASS__, LogLevel::ERROR, $error->getMessage());

            throw $error;
        }
    }

    private static function getRawDiscounts(int $offset = 0, int $limit = 0): array
    {
        $rowDiscountsResult = \CIBlockElement::GetList(
            [
                'created' => 'desc'
            ],
            [
                'IBLOCK_ID' => IBLOCK_DISCOUNTS
            ],
            false,
            [
                'nTopCount' => $limit,
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

    private static function addPictureAndCatalogUrl(array $url, array $discounts): array
    {
        foreach ($discounts as &$discount) {
            $discount['CATALOG'] = $url[$discount['CATALOG']];
            $discount['PICTURE'] = \CFile::GetPath($discount['PICTURE']);
        }
        return $discounts;
    }

    private static function getFirstWordForAccent(array $discounts): array
    {   $accent = [];
        foreach ($discounts as &$discount) {
            $announce = strip_tags($discount['TEXT']);
            $announce = str_replace(['&nbsp;', PHP_EOL], '', $announce);
            $announce = trim($announce);
            //получить первое слово до пробела в массив $accent
            preg_match('/^\S+/', $announce, $accent);
            $discount['ACCENT'] = $accent[0];
            $discount['TEXT'] = mb_substr($announce, mb_strlen($accent[0]));
        }
        return $discounts;
    }
}

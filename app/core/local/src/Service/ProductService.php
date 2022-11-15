<?php

namespace QSoft\Service;

use Bitrix\Catalog\GroupTable;
use Bitrix\Catalog\PriceTable;
use Bitrix\Sale\Internals\BasketTable;
use CFile;
use CIBlockElement;
use QSoft\Entity\User;

class ProductService
{
    public function getOffersByIds(array $offerIds): array
    {
        $properties = [];
        CIBlockElement::GetPropertyValuesArray($properties, IBLOCK_PRODUCT_OFFER, ['ID' => current($offerIds)]);

        $offerIterator = CIBlockElement::GetList(
            [],
            ['ID' => $offerIds],
            false,
            false,
            array_merge(
                array_map(static fn ($item) => "PROPERTY_$item", array_keys(current($properties))),
                [
                    'ID',
                    'NAME',
                    'CODE',
                    'DETAIL_PAGE_URL',
                    'PREVIEW_PICTURE',
                    'DETAIL_PICTURE',
                    'DETAIL_TEXT',
                    'DETAIL_TEXT_TYPE',
                    'PREVIEW_TEXT',
                    'PREVIEW_TEXT_TYPE',
                ]
            )
        );

        $offers = [];
        $fileIds = [];
        while ($offer = $offerIterator->Fetch()) {
            $offers[$offer['ID']] = $offer;
            if ($offer['PREVIEW_PICTURE']) {
                $fileIds[$offer['ID']] = $offer['PREVIEW_PICTURE'];
            }
        }

        if ($fileIds) {
            $fileIterator = CFile::GetList([], ['ID' => $fileIds]);
            foreach ($fileIds as $offerId => $fileId) {
                if ($file = $fileIterator->Fetch()) {
                    $offers[$offerId]['PREVIEW_PICTURE'] = CFile::GetFileSRC($file);
                }
            }
        }

        return $offers;
    }

    public static function getProductDataFromBasket(int $orderId, int $offset = 0, int $limit = 0): array
    {
        return BasketTable::getList([
            'select' => [
                'PRODUCT_ID',
                'PRICE',
                'QUANTITY',
            ],
            'filter' => [
                'ORDER_ID' => $orderId,
            ],
            'offset' => $offset,
            'limit' => $limit,
        ])->fetchAll();
    }

    public static function getProductByIds(array $productsIds): array
    {
        if (empty($productsIds)) {
            return [];
        }

        $offersResult = \CIBlockElement::GetList(
            [],
            [
                'ID' => $productsIds
            ],
            false,
            false,
            [
                'ID',
                'NAME',
                'PROPERTY_ARTICLE',
                'PROPERTY_IMAGES',
            ]
        );
        $offers = [];
        while ($offer = $offersResult->GetNext(true, false)) {
            $offers[$offer['ID']] = $offer;
        }
        return $offers;
    }

    public static function getBonusByProductIds(array $productIds): array
    {
        if (empty($productIds)) {
            return [];
        }

        $levelId = 0;

        $levels = GroupTable::GetList(
            [
                'select' => ['*'],
            ]
        )->fetchAll();

        $user = new User();

        $level = $user->loyalty->getLoyaltyProgramInfo()['CURRENT_LEVEL'];

        foreach ($levels as $lvl) {
            if ($lvl['NAME'] == $level) {
                $levelId = $lvl['ID'];
                break;
            }
        }

        $dbBonuses = PriceTable::GetList(
            [
                'select' => ['*'],
                'filter' => [
                    'PRODUCT_ID' => $productIds,
                    'CATALOG_GROUP_ID' => $levelId,
                ],
            ]
        );

        while ($row = $dbBonuses->Fetch()) {
            $bonuses[$row['PRODUCT_ID']] = $row;
        }

        return $bonuses ?? [];
    }
}
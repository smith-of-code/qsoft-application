<?php

namespace QSoft\Service;

use CFile;
use CIBlockElement;

class ProductService
{
    public function getOffers(array $productIds): array
    {
        $properties = [];
        CIBlockElement::GetPropertyValuesArray($properties, IBLOCK_PRODUCT_OFFER, ['ID' => current($productIds)]);

        $offerIterator = CIBlockElement::GetList(
            [],
            ['ID' => $productIds],
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
}
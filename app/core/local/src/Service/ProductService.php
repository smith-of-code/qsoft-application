<?php

namespace QSoft\Service;

use	Bitrix\Main\Loader;
use Bitrix\Iblock\Iblock;
use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields\Relations\Reference;
use Bitrix\Sale\Internals\BasketTable;
use CFile;
use CIBlockElement;
use Bitrix\Main\ORM\Query\Join;

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

    /**
     * @return DataManager|string
     */
    public static function getProductOfferDataClass(): string
    {
        self::includeModules();
        $basketProductIdRef = new Reference('BASKET',
            BasketTable::class,
            Join::on('this.ID', 'ref.PRODUCT_ID'));
        $offerProductEntity = IBlock::wakeUp(IBLOCK_PRODUCT_OFFER)
            ->getEntityDataClass()
            ::getEntity();
        $offerProductEntity->addField($basketProductIdRef);
        return $offerProductEntity->getDataClass();
    }

    private static function includeModules(): void
    {
        Loader::includeModule('iblock');
        Loader::includeModule('sale');
    }
}
<?php

namespace QSoft\Service;

use	Bitrix\Main\Loader;
use Bitrix\Iblock\Iblock;
use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields\Relations\Reference;
use Bitrix\Sale\Internals\BasketTable;
use CCatalogProduct;
use CIBlockElement;
use Bitrix\Main\ORM\Query\Join;
use QSoft\Entity\User;

class ProductService
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getOffersByIds(array $offerIds): array
    {
        $properties = [];
        CIBlockElement::GetPropertyValuesArray($properties, IBLOCK_PRODUCT_OFFER, ['ID' => current($offerIds)]);

        $offerIterator = CIBlockElement::GetList([], ['ID' => $offerIds], false, false, array_merge(
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
                'CATALOG_AVAILABLE',
            ],
        ));

        $offers = [];
        while ($offer = $offerIterator->Fetch()) {
            $offer['PRICES'] = CCatalogProduct::GetOptimalPrice($offer['ID']);
            if ($this->user->isAuthorized && $this->user->groups->isConsultant()) {
                $offer['BONUSES'] = (int) $offer["PROPERTY_BONUSES_{$this->user->loyaltyLevel}_VALUE"];
            }
            $offers[$offer['ID']] = $offer;
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
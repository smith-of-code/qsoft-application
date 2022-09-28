<?php

namespace QSoft\Events;

use QSoft\Service\LoyaltyService;

class OfferEventsListener
{
    private static LoyaltyService $loyaltyService;

    private static function initDependencies(): void
    {
        self::$loyaltyService = new LoyaltyService;
    }

    public static function OnPriceAdd(int $priceId, array $fields): void
    {
//        if ($fields['CATALOG_GROUP_ID'] === 1) {
//            self::initDependencies();
//            self::$loyaltyService->setOfferBonusesPrices($fields['PRODUCT_ID'], $fields);
//        }
    }

    public static function OnPriceUpdate(int $priceId, array $fields): void
    {
        if ($fields['CATALOG_GROUP_ID'] === 1) {
            self::initDependencies();
            self::$loyaltyService->setOfferBonusesPrices($fields['PRODUCT_ID'], $fields);
        }
    }
}
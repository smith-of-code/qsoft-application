<?php

namespace QSoft\Events;

use CCatalogGroup;
use QSoft\Queue\Jobs\BonusesPriceJob;

class OfferEventsListener
{
    public static function OnPriceAdd(int $priceId, array $fields): void
    {
        $basePrice = CCatalogGroup::GetList([], ['=NAME' => 'BASE'])->Fetch();
        if ($fields['CATALOG_GROUP_ID'] === (int) $basePrice['ID']) {
            BonusesPriceJob::pushJob(['offerId' => $fields['PRODUCT_ID'], 'priceValue' => $fields['PRICE']]);
        }
    }

    public static function OnPriceUpdate(int $priceId, array $fields): void
    {
        $basePrice = CCatalogGroup::GetList([], ['=NAME' => 'BASE'])->Fetch();
        if ($fields['CATALOG_GROUP_ID'] === (int) $basePrice['ID']) {
            BonusesPriceJob::pushJob(['offerId' => $fields['PRODUCT_ID'], 'priceValue' => $fields['PRICE']]);
        }
    }
}

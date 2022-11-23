<?php

namespace QSoft\Events;

use Bitrix\Catalog\Model\Price;
use Bitrix\Main\ORM\Event;
use CCatalogGroup;
use QSoft\Queue\Jobs\BonusesPriceJob;
use QSoft\Service\OffersService;

class OfferEventsListener
{
    public static function OnPriceAdd(Event $event): void
    {
        $id = $event->getParameter('id');
        $fields = $event->getParameter('fields');
        $res = Price::getList([
            'filter' => [
                '=ID' => $id,
            ]
        ])->fetch();
        $basePrice = CCatalogGroup::GetList([], ['=NAME' => 'BASE'], false, false, ['ID'])->Fetch();
        if ((int) $fields['CATALOG_GROUP_ID'] == (int) $basePrice['ID']) {
            //BonusesPriceJob::pushJob(['offerId' => $res['PRODUCT_ID'], 'priceValue' => $res['PRICE']]);

            $offersService = new OffersService();
            $offersService->setOfferBonuses($res['PRODUCT_ID'], $res['PRICE']);
            $offersService->setOfferDiscountPrices($res['PRODUCT_ID'], $res['PRICE']);
        }
    }

    public static function OnPriceUpdate(Event $event): void
    {
        $id = $event->getParameter('id');
        $fields = $event->getParameter('fields');
        $res = Price::getList([
            'filter' => [
                '=ID' => $id,
            ]
        ])->fetch();
        $basePrice = CCatalogGroup::GetList([], ['=NAME' => 'BASE'], false, false, ['ID'])->Fetch();
        if ((int) $fields['CATALOG_GROUP_ID'] == (int) $basePrice['ID']) {
            //BonusesPriceJob::pushJob(['offerId' => $res['PRODUCT_ID'], 'priceValue' => $res['PRICE']]);

            $offersService = new OffersService();
            $offersService->setOfferBonuses($res['PRODUCT_ID'], $res['PRICE']);
            $offersService->setOfferDiscountPrices($res['PRODUCT_ID'], $res['PRICE']);
        }
    }
}
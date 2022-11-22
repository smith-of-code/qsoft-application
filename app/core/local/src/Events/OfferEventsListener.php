<?php

namespace QSoft\Events;

use CCatalogGroup;
use QSoft\Queue\Jobs\BonusesPriceJob;

class OfferEventsListener
{
    public static function OnPriceAdd(\Bitrix\Main\ORM\Event $event): void
    {
        $id = $event->getParameter('id');
        $fields = $event->getParameter('fields');
        $res = \Bitrix\Catalog\Model\Price::getList([
            'filter' => [
                '=ID' => $id,
            ]
        ])->fetch();
        $basePrice = CCatalogGroup::GetList([], ['=NAME' => 'BASE'], false, false, ['ID'])->Fetch();
        if ((int) $fields['CATALOG_GROUP_ID'] == (int) $basePrice['ID']) {
            BonusesPriceJob::pushJob(['offerId' => $res['PRODUCT_ID'], 'priceValue' => $res['PRICE']]);
        }
    }

    public static function OnPriceUpdate(\Bitrix\Main\ORM\Event $event): void
    {
        $id = $event->getParameter('id');
        $fields = $event->getParameter('fields');
        $res = \Bitrix\Catalog\Model\Price::getList([
            'filter' => [
                '=ID' => $id,
            ]
        ])->fetch();
        $basePrice = CCatalogGroup::GetList([], ['=NAME' => 'BASE'], false, false, ['ID'])->Fetch();
        if ((int) $fields['CATALOG_GROUP_ID'] == (int) $basePrice['ID']) {
            BonusesPriceJob::pushJob(['offerId' => $res['PRODUCT_ID'], 'priceValue' => $res['PRICE']]);
        }
    }
}
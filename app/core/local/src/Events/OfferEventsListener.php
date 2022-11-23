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

    /**
     * Убирает из формы редактирования свойства торговых предложений, которые заполняются автоматически
     * и не должны быть доступны для редактирования
     * @param \CAdminForm $form
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     */
    public static function OnOffersEditFormShow(\CAdminForm $form): void
    {
        global $USER;
        if (
            (
                $GLOBALS['APPLICATION']->GetCurPage() == '/bitrix/admin/iblock_element_edit.php'
                || $GLOBALS['APPLICATION']->GetCurPage() == '/bitrix/admin/iblock_subelement_edit.php'
            )
            && ! $USER->isAdmin()
            && isset($_REQUEST['type'])
            && $_REQUEST['type'] === 'offers'
            && $_REQUEST['IBLOCK_ID'] > 0
        )
        {
            // Коды свойств, которые необходимо скрыть
            $propsToHide = [
                'BONUSES_K1',
                'BONUSES_K2',
                'BONUSES_K3',
                'DISCOUNT_PRICE_K1',
                'DISCOUNT_PRICE_K2',
                'DISCOUNT_PRICE_K3',
                'DISCOUNT_PRICE_B1',
                'DISCOUNT_PRICE_B2',
                'DISCOUNT_PRICE_B3',
            ];

            // Получаем ID свойств
            $propsDB = \Bitrix\Iblock\PropertyTable::getList([
                'order' => [],
                'select' => ['ID'],
                'filter' => [
                    'IBLOCK_ID' => $_REQUEST['IBLOCK_ID'],
                    '@CODE' => $propsToHide,
                ],
            ]);

            while ($prop = $propsDB->fetch()) {
                $propKey = 'PROPERTY_' . $prop['ID'];
                if (isset($form->arFields[$propKey])) {
                    unset($form->arFields[$propKey]);
                }
            }
        }
    }
}
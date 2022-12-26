<?php

namespace QSoft\Events;

use Bitrix\Catalog\Model\Price;
use Bitrix\Main\ORM\Event;
use CCatalogGroup;
use QSoft\Queue\Jobs\BonusesPriceJob;
use QSoft\Queue\Jobs\UpdateAllOffersBonusesJob;

class OfferEventsListener
{
    public static function OnPriceAdd(Event $event): void
    {
        self::UpdatePricesAndBonuses($event);
    }

    public static function OnPriceUpdate(Event $event): void
    {
        self::UpdatePricesAndBonuses($event);
    }

    public static function UpdatePricesAndBonuses(Event $event): void
    {
        $id = $event->getParameter('id');
        $fields = $event->getParameter('fields');
        $res = Price::getList([
            'filter' => [
                '=ID' => $id,
            ]
        ])->fetch();

        if ((int) $res['PRODUCT_ID'] == 0) {
            return;
        }

        // Проверим, что это ТП, а не товар
        $isOffer = \Bitrix\Iblock\ElementTable::getList([
            'select' => ['ID'],
            'filter' => ['IBLOCK_ID' => IBLOCK_PRODUCT_OFFER, '=ID' => $res['PRODUCT_ID']],
        ])->fetch();

        // Игнорируем изменения цены обычных товаров
        if (! $isOffer) {
            return;
        }

        $basePrice = CCatalogGroup::GetList([], ['=NAME' => 'BASE'], false, false, ['ID'])->Fetch();
        if ((int) $fields['CATALOG_GROUP_ID'] == (int) $basePrice['ID']) {
            BonusesPriceJob::pushJob(['offerId' => $res['PRODUCT_ID'], 'priceValue' => $res['PRICE']]);
        }
    }

    /**
     * Убирает из формы редактирования свойства торговых предложений, которые заполняются автоматически
     * и не должны быть доступны для редактирования
     * @param mixed $form
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     */
    public static function OnOffersEditFormShow($form): void
    {
        global $USER;
        if (
            (
                $GLOBALS['APPLICATION']->GetCurPage() == '/bitrix/admin/iblock_element_edit.php'
                || $GLOBALS['APPLICATION']->GetCurPage() == '/bitrix/admin/iblock_subelement_edit.php'
            )
            && $form instanceof \CAdminForm
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

    public static function UpdateBonuses(Event $event) {

        UpdateAllOffersBonusesJob::pushJob([]);
    }
}

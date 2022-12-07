<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var array $arResult
 */

use Bitrix\Sale\BasketItem;
use Bitrix\Sale\BasketPropertyItem;
use QSoft\Entity\User;
use QSoft\Helper\BasketHelper;
use QSoft\Helper\HlBlockHelper;
use QSoft\Helper\PickupPointHelper;
use QSoft\ORM\PickupPointTable;

try {
    $user = new User;

    $basket = (new BasketHelper)->getBasket(true);

    $basketBonuses = 0;
    /** @var BasketItem $basketItem */
    foreach ($basket as $basketItem) {
        /** @var BasketPropertyItem $property */
        foreach ($basketItem->getPropertyCollection() as $property) {
            if ($property->getField('CODE') === 'BONUSES') {
                $basketBonuses += $property->getField('VALUE');
                break;
            }
        }
    }

    $arResult['BASKET'] = [
        'BASKET_COUNT' => $basket->count(),
        'BASKET_PRICE' => $basket->getPrice(),
        'BASKET_BASE_PRICE'=> $basket->getBasePrice(),
        'BASKET_TOTAL_VAT' => $basket->getVatSum(),
        'TOTAL_DISCOUNT' => $basket->getBasePrice() - $basket->getPrice(),
        'BASKET_ITEMS_BONUS_SUM' => $basketBonuses,
    ];

    $arResult['USER'] = [
        'FIRST_NAME' => $user->name,
        'LAST_NAME' => $user->lastName,
        'IS_CONSULTANT' => $user->groups->isConsultant(),
        'EMAIL' => $user->email,
        'CITY' => $user->city,
        'UF_PICKUP_POINT_ID' => $user->pickupPointId,
        'PHONE' => $user->phone,
    ];
} catch (\Exception $e) {
    $arResult['USER'] = [];
}

$pickupPointHelper = new PickupPointHelper;
$arResult['CITIES'] = $pickupPointHelper->getCities();
$arResult['ADDRESSES'] = $pickupPointHelper->getPickupPoints();

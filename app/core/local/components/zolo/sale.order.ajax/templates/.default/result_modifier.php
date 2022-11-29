<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var array $arResult
 */

use QSoft\Entity\User;
use QSoft\Helper\HlBlockHelper;
use QSoft\Helper\PickupPointHelper;
use QSoft\ORM\PickupPointTable;

try {
    $user = new User;

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

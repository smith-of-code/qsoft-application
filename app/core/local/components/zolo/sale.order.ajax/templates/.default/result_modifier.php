<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var array $arResult
 */

use QSoft\Entity\User;
use QSoft\Helper\HlBlockHelper;
use QSoft\ORM\PickupPointTable;

try {
    $user = new User;

    $arResult['USER'] = [
        'FIRST_NAME' => $user->name,
        'LAST_NAME' => $user->lastName,
        'IS_CONSULTANT' => $user->groups->isConsultant(),
        'EMAIL' => $user->email,
        'CITY' => $user->city,
    ];
} catch (\Exception $e) {
    $arResult['USER'] = [];
}

$arResult['CITIES'] = HlBlockHelper::getEnumFieldValues(PickupPointTable::getTableName(), 'UF_CITY');
$arResult['ADDRESSES'] = array_column(PickupPointTable::getList(['select' => ['ID', 'UF_ADDRESS']])->fetchAll(), 'UF_ADDRESS');

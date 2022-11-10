<?php
if (! defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
/** @var array $arResult */

$APPLICATION->IncludeComponent(
    "zolo:sale.personal.order.detail",
    "",
    [
        'ORDER_ID' => $arResult['VARIABLES']['ORDER_ID']
    ],
);

<?php
if (! defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

$APPLICATION->IncludeComponent(
    "zolo:sale.personal.order.list",
    "",
    [
        'SEF_FOLDER' => $arResult["FOLDER"],
        "PATH_TO_CANCEL" => "/personal/order/#ID#",
        "PATH_TO_BASKET" => "/personal/cart/",
        "PATH_TO_COPY" => "/personal/cart/",
        "PATH_TO_PAYMENT" => "/personal/order/payment/",
        "ORDERS_PER_PAGE" => 5,
        "DEFAULT_SORT" => 'ID',
        "SET_TITLE" => "Y",
        "SAVE_IN_SESSION" => "Y",
        "NAV_TEMPLATE" => "",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600",
        "CACHE_GROUPS" => "Y",
        "HISTORIC_STATUSES" => "F",
        "ACTIVE_DATE_FORMAT" => "d.m.Y"
    ]
);
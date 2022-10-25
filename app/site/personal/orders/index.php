<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("История заказов");
?>
<?$APPLICATION->IncludeComponent("zolo:sale.personal.order.sort",
    "",
    []
);?>
<?$APPLICATION->IncludeComponent("zolo:sale.personal.order.list","",Array(
        "PATH_TO_DETAIL" => "/personal/order/#ID#",
        "PATH_TO_CANCEL" => "/personal/order/#ID#",
        "PATH_TO_BASKET" => "/personal/cart/",
        "PATH_TO_COPY" => "/personal/cart/",
        "PATH_TO_PAYMENT" => "/personal/order/payment/",
        "ORDERS_PER_PAGE" => 1,
        "SET_TITLE" => "Y",
        "SAVE_IN_SESSION" => "Y",
        "NAV_TEMPLATE" => "",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600",
        "CACHE_GROUPS" => "Y",
        "HISTORIC_STATUSES" => "F",
        "ACTIVE_DATE_FORMAT" => "d.m.Y"
    )
);?>
?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
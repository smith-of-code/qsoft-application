<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Loader;

if (!check_bitrix_sessid() || !Loader::includeModule('catalog')) {
    die();
}


if ($_REQUEST['BasketDelete']) {
    $result = CSaleBasket::DeleteAll(CSaleBasket::GetBasketUserID());
    echo json_encode([]);

    die();
}

echo $APPLICATION->IncludeComponent('zolo:update.basket', '', []);
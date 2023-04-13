<?php require("$_SERVER[DOCUMENT_ROOT]/bitrix/header.php");
$APPLICATION->SetTitle("Корзина");
$APPLICATION->IncludeComponent('zolo:sale.basket.total', '', [], false);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");

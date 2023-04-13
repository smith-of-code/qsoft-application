<?php require("$_SERVER[DOCUMENT_ROOT]/bitrix/header.php");

$APPLICATION->SetTitle('Оформление заказа');
$APPLICATION->IncludeComponent('zolo:sale.order.ajax', '');

require("$_SERVER[DOCUMENT_ROOT]/bitrix/footer.php");

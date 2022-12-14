<?php require("$_SERVER[DOCUMENT_ROOT]/bitrix/header.php");

$APPLICATION->SetTitle('Калькулятор доходности');
$APPLICATION->IncludeComponent('zolo:personal.calculator', '');

require("$_SERVER[DOCUMENT_ROOT]/bitrix/footer.php");

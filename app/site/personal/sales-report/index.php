<?php require("$_SERVER[DOCUMENT_ROOT]/bitrix/header.php");

$APPLICATION->SetTitle('Отчетность');
$APPLICATION->IncludeComponent('zolo:loyalty.sales.report', '');

require("$_SERVER[DOCUMENT_ROOT]/bitrix/footer.php");

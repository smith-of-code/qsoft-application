<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("FAQ");
?>

<?php $APPLICATION->IncludeComponent(
	"zolo:faq",
	"",
);?>

<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
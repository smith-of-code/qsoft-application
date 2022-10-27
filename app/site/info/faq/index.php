<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("FAQ");
?>

<?$APPLICATION->IncludeComponent("zolo:faq",
	"",
	[]
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
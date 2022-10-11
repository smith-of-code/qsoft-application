<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Новости");
?><?$APPLICATION->IncludeComponent("zolo:news", "", array(
	"IBLOCK_TYPE" => "news",
	"IBLOCK_ID" => "104",
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
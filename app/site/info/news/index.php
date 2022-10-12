<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Новости");
?><?$APPLICATION->IncludeComponent("bitrix:news", "", array(
	"IBLOCK_TYPE" => "news",
	"IBLOCK_ID" => IBLOCK_NEWS,
    "SEF_MODE" => "Y",
    "SEF_FOLDER" => "/info/news/",
    "SEF_URL_TEMPLATES" => [
        "list" => "index.php",
    ]
	),
	false
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
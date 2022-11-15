<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("Мероприятия");

$APPLICATION->IncludeComponent("bitrix:news", "", array(
	"IBLOCK_TYPE" => "events",
	"IBLOCK_ID" => IBLOCK_EVENT,
    "SEF_MODE" => "Y",
    "SEF_FOLDER" => "/info/events/",
    "SEF_URL_TEMPLATES" => [
        "list" => "index.php",
		"detail" => "detail/#ID#",
    ],
	"SHOW_404" => "Y",
	),
	false
);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");

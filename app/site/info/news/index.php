<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

$APPLICATION->IncludeComponent("bitrix:news", "", array(
	"IBLOCK_TYPE" => "news",
	"IBLOCK_ID" => IBLOCK_NEWS,
    "SEF_MODE" => "Y",
    "SEF_FOLDER" => "/info/news/",
    "SEF_URL_TEMPLATES" => [
        "list" => "index.php",
		"detail" => "detail/#ID#",
    ],
	"SHOW_404" => "Y",
	),
	false
);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");

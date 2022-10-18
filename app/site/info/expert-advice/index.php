<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Советы экспертов");
?><?$APPLICATION->IncludeComponent("bitrix:news", "", array(
	"IBLOCK_TYPE" => "expert_advices",
	"IBLOCK_ID" => IBLOCK_EXPERT_ADVICE,
    "SEF_MODE" => "Y",
    "SEF_FOLDER" => "/info/expert-advice/",
    "SEF_URL_TEMPLATES" => [
        "list" => "index.php",
    ]
	),
	false
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
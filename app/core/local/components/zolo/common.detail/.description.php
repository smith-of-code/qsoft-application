<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);

$arComponentDescription = array(
    "NAME" => Loc::getMessage("COMMON_DETAIL_COMPONENT_NAME"),
    "DESCRIPTION" => Loc::getMessage("COMMON_DETAIL_COMPONENT_DESCRIPTION"),
    "PATH" => array(
        "ID" => "common_detail",
        "NAME" => Loc::getMessage("COMMON_DETAIL_COMPONENT_PATH"),
    )
);
?>
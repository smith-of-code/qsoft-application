<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);

$arComponentDescription = array(
	"NAME" => Loc::getMessage("COMMON_LIST_COMPONENT_NAME"),
	"DESCRIPTION" => Loc::getMessage("COMMON_LIST_COMPONENT_DESCRIPTION"),
	"PATH" => array(
		"ID" => "common_list",
        "NAME" => Loc::getMessage("COMMON_LIST_COMPONENT_PATH"),
	)
);
?>
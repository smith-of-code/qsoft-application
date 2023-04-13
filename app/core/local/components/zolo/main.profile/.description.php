<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
    die();
}

use Bitrix\Main\Localization\Loc;

Loc::loadLanguageFile(__FILE__);

$arComponentDescription = [
    "NAME" => Loc::getMessage("USER_SETTINGS_FORM_NAME"),
    "DESCRIPTION" => Loc::getMessage("USER_SETTINGS_FORM_DESC"),
    "SORT" => 10,
    "CACHE_PATH" => "Y",
];

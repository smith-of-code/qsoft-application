<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
    die();
}

use Bitrix\Main\Localization\Loc;

Loc::loadLanguageFile(__FILE__);

$arComponentDescription = [
    "NAME" => Loc::getMessage("FAQ_NAME"),
    "DESCRIPTION" => Loc::getMessage("FAQ_DESCRIPTION"),
    "SORT" => 10,
    "CACHE_PATH" => "Y",
];

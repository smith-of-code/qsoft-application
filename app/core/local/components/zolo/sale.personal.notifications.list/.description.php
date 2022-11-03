<?php
if (! defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$arComponentDescription = [
    "NAME" => Loc::getMessage("NOTIFICATIONS_LIST_COMPONENT_NAME"),
    "DESCRIPTION" => Loc::getMessage("NOTIFICATIONS_LIST_COMPONENT_DESCRIPTION"),
    "PATH" => [
        "ID" => "notifications_list",
        "NAME" => Loc::getMessage("NOTIFICATIONS_LIST_COMPONENT_PATH"),
    ]
];
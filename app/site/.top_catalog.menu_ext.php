<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
}
global $APPLICATION;

$aMenuLinksExt = $APPLICATION->IncludeComponent(
    "bitrix:menu.sections", 
    "",
    [
        "IBLOCK_TYPE" => "catalog",
        "IBLOCK_ID" => IBLOCK_PRODUCT,
        "DEPTH_LEVEL" => "3",
        "CACHE_TYPE" => "Y",
    ],
    false,
    ['HIDE_ICONS' => 'Y']
);

$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);

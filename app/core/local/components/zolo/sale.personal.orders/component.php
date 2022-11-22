<?php
if (! defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
/** @var array $arParams */

$engine = new CComponentEngine($this);
$arVariables = [];
$componentPage = $engine->guessComponentPath(
    $arParams["SEF_FOLDER"],
    $arParams['SEF_URL_TEMPLATES'],
    $arVariables
);

if (! $componentPage) {
    $componentPage = "list";
}

CComponentEngine::initComponentVariables($componentPage, [], [], $arVariables);

$arResult = [
    "FOLDER" => $arParams["SEF_FOLDER"],
    "URL_TEMPLATES" => $arParams['SEF_URL_TEMPLATES'],
    "VARIABLES" => $arVariables,
];

$this->includeComponentTemplate($componentPage);

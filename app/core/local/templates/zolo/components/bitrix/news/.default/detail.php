<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @var CBitrixComponentTemplate $this */
/** @var CBitrixComponent $component */

?>

<?$APPLICATION->IncludeComponent(
    "zolo:common.detail",
    "",
    Array(
        "ID" => $arResult["VARIABLES"]["ID"],
        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
    ),
    $component
);?>
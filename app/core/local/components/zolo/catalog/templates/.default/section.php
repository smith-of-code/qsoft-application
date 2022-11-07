<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;

$this->setFrameMode(true);

$arParams['USE_FILTER'] = (isset($arParams['USE_FILTER']) && $arParams['USE_FILTER'] == 'Y' ? 'Y' : 'N');

$isFilter = ($arParams['USE_FILTER'] == 'Y');

if ($isFilter)
{
	$arFilter = array(
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"ACTIVE" => "Y",
		"GLOBAL_ACTIVE" => "Y",
	);
	if (0 < intval($arResult["VARIABLES"]["SECTION_ID"]))
		$arFilter["ID"] = $arResult["VARIABLES"]["SECTION_ID"];
	elseif ('' != $arResult["VARIABLES"]["SECTION_CODE"])
		$arFilter["=CODE"] = $arResult["VARIABLES"]["SECTION_CODE"];

    if (!empty($arFilter["ID"]) || !empty($arFilter["=CODE"])) {
        $obCache = new CPHPCache();
        if ($obCache->InitCache(36000, serialize($arFilter), "/iblock/catalog"))
        {
            $arCurSection = $obCache->GetVars();
        }
        elseif ($obCache->StartDataCache())
        {
            $arCurSection = array();
            if (Loader::includeModule("iblock"))
            {
                $dbRes = CIBlockSection::GetList(array(), $arFilter, false, array("ID"));

                if(defined("BX_COMP_MANAGED_CACHE"))
                {
                    global $CACHE_MANAGER;
                    $CACHE_MANAGER->StartTagCache("/iblock/catalog");

                    if ($arCurSection = $dbRes->Fetch())
                        $CACHE_MANAGER->RegisterTag("iblock_id_".$arParams["IBLOCK_ID"]);

                    $CACHE_MANAGER->EndTagCache();
                }
                else
                {
                    if(!$arCurSection = $dbRes->Fetch())
                        $arCurSection = array();
                }
            }
            $obCache->EndDataCache($arCurSection);
        }
    }
	if (!isset($arCurSection))
		$arCurSection = array();
}

// Проверяем необходимость применения сортировки
if (isset($_GET['sort'])) {
    switch ($_GET['sort']) {
        case 'price-asc':
            $arParams["ELEMENT_SORT_FIELD"] = 'catalog_PRICE_1';
            $arParams["ELEMENT_SORT_ORDER"] = 'asc';
            break;
        case 'price-desc':
            $arParams["ELEMENT_SORT_FIELD"] = 'catalog_PRICE_1';
            $arParams["ELEMENT_SORT_ORDER"] = 'desc';
            break;
        case 'date-asc':
            $arParams["ELEMENT_SORT_FIELD"] = 'timestamp_x';
            $arParams["ELEMENT_SORT_ORDER"] = 'asc';
            break;
        case 'date-desc':
            $arParams["ELEMENT_SORT_FIELD"] = 'timestamp_x';
            $arParams["ELEMENT_SORT_ORDER"] = 'desc';
            break;
        case 'popularity':
        default:
            $arParams["ELEMENT_SORT_FIELD"] = 'sort';
            $arParams["ELEMENT_SORT_ORDER"] = 'desc';
            break;
    }
}

include($_SERVER["DOCUMENT_ROOT"]."/".$this->GetFolder()."/section_vertical.php");
?>
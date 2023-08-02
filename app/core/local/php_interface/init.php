<?php
require_once __DIR__ . '/constants.php';

require_once __DIR__ . '/helpers.php';

require_once __DIR__ . '/application.php';

require_once __DIR__ . '/events.php';

define('VUEJS_DEBUG', true);

// файл /bitrix/php_interface/init.php

// регистрируем обработчик, при сохранении инфоблока, заполнаем поле "Символьный код" транслитерацией имени заголовка новости
AddEventHandler("iblock", "OnBeforeIBlockElementAdd", Array("CymCode", "OnBeforeIBlockElementAddHandler"));

class CymCode
{

// создаем обработчик события "OnBeforeIBlockElementAdd"
    function OnBeforeIBlockElementAddHandler(&$arFields)
    {
        if(strlen($arFields["CODE"])<=0)
        {
            $arFields["CODE"] = CymCode::imTranslite($arFields["NAME"])."_".date('dmY');


            return;
        }
    }

// записывает все что передадут в /bitrix/log.txt
    function log_array() {
        $arArgs = func_get_args();
        $sResult = '';
        foreach($arArgs as $arArg) {
            $sResult .= "\n\n".print_r($arArg, true);
        }

        if(!defined('LOG_FILENAME')) {
            define('LOG_FILENAME', $_SERVER['DOCUMENT_ROOT'].'/bitrix/log.txt');
        }
        AddMessage2Log($sResult, 'log_array -> ');
    }

    function imTranslite($str){
// транслитерация корректно работает на страницах с любой кодировкой
// ISO 9-95
        static $tbl= array(
            'а'=>'a', 'б'=>'b', 'в'=>'v', 'г'=>'g', 'д'=>'d', 'е'=>'e', 'ж'=>'g', 'з'=>'z',
            'и'=>'i', 'й'=>'y', 'к'=>'k', 'л'=>'l', 'м'=>'m', 'н'=>'n', 'о'=>'o', 'п'=>'p',
            'р'=>'r', 'с'=>'s', 'т'=>'t', 'у'=>'u', 'ф'=>'f', 'ы'=>'y', 'э'=>'e', 'А'=>'A',
            'Б'=>'B', 'В'=>'V', 'Г'=>'G', 'Д'=>'D', 'Е'=>'E', 'Ж'=>'G', 'З'=>'Z', 'И'=>'I',
            'Й'=>'Y', 'К'=>'K', 'Л'=>'L', 'М'=>'M', 'Н'=>'N', 'О'=>'O', 'П'=>'P', 'Р'=>'R',
            'С'=>'S', 'Т'=>'T', 'У'=>'U', 'Ф'=>'F', 'Ы'=>'Y', 'Э'=>'E', 'ё'=>"yo", 'х'=>"h",
            'ц'=>"ts", 'ч'=>"ch", 'ш'=>"sh", 'щ'=>"shch", 'ъ'=>"", 'ь'=>"", 'ю'=>"yu", 'я'=>"ya",
            'Ё'=>"YO", 'Х'=>"H", 'Ц'=>"TS", 'Ч'=>"CH", 'Ш'=>"SH", 'Щ'=>"SHCH", 'Ъ'=>"", 'Ь'=>"",
            'Ю'=>"YU", 'Я'=>"YA", ' '=>"_", '№'=>"", '«'=>"<", '»'=>">", '—'=>"-"
        );
        return strtr($str, $tbl);
    }
}


/*Version 0.3 2011-04-25*/
AddEventHandler("iblock", "OnAfterIBlockElementUpdate", "DoIBlockAfterSave");
AddEventHandler("iblock", "OnAfterIBlockElementAdd", "DoIBlockAfterSave");
AddEventHandler("catalog", "OnPriceAdd", "DoIBlockAfterSave");
AddEventHandler("catalog", "OnPriceUpdate", "DoIBlockAfterSave");

//Регистрируем обработчик OnBeforeIBlockElementAdd
AddEventHandler("iblock", "OnBeforeIBlockElementAdd",  "Deactivate_Import_Element");

function Deactivate_Import_Element($arFields)
{
    if (isset($_REQUEST['mode'])  && $_REQUEST['mode']=='import' )
    {
        $arFields['ACTIVE']='N';
    }
}



function DoIBlockAfterSave($arg1, $arg2 = false)
{
    $ELEMENT_ID = false;
    $IBLOCK_ID = false;
    $OFFERS_IBLOCK_ID = false;
    $OFFERS_PROPERTY_ID = false;
    if (CModule::IncludeModule('currency'))
        $strDefaultCurrency = CCurrency::GetBaseCurrency();

    //Check for catalog event
    if(is_array($arg2) && $arg2["PRODUCT_ID"] > 0)
    {
        //Get iblock element
        $rsPriceElement = CIBlockElement::GetList(
            array(),
            array(
                "ID" => $arg2["PRODUCT_ID"],
            ),
            false,
            false,
            array("ID", "IBLOCK_ID")
        );
        if($arPriceElement = $rsPriceElement->Fetch())
        {
            $arCatalog = CCatalog::GetByID($arPriceElement["IBLOCK_ID"]);
            if(is_array($arCatalog))
            {
                //Check if it is offers iblock
                if($arCatalog["OFFERS"] == "Y")
                {
                    //Find product element
                    $rsElement = CIBlockElement::GetProperty(
                        $arPriceElement["IBLOCK_ID"],
                        $arPriceElement["ID"],
                        "sort",
                        "asc",
                        array("ID" => $arCatalog["SKU_PROPERTY_ID"])
                    );
                    $arElement = $rsElement->Fetch();
                    if($arElement && $arElement["VALUE"] > 0)
                    {
                        $ELEMENT_ID = $arElement["VALUE"];
                        $IBLOCK_ID = $arCatalog["PRODUCT_IBLOCK_ID"];
                        $OFFERS_IBLOCK_ID = $arCatalog["IBLOCK_ID"];
                        $OFFERS_PROPERTY_ID = $arCatalog["SKU_PROPERTY_ID"];
                    }
                }
                //or iblock which has offers
                elseif($arCatalog["OFFERS_IBLOCK_ID"] > 0)
                {
                    $ELEMENT_ID = $arPriceElement["ID"];
                    $IBLOCK_ID = $arPriceElement["IBLOCK_ID"];
                    $OFFERS_IBLOCK_ID = $arCatalog["OFFERS_IBLOCK_ID"];
                    $OFFERS_PROPERTY_ID = $arCatalog["OFFERS_PROPERTY_ID"];
                }
                //or it's regular catalog
                else
                {
                    $ELEMENT_ID = $arPriceElement["ID"];
                    $IBLOCK_ID = $arPriceElement["IBLOCK_ID"];
                    $OFFERS_IBLOCK_ID = false;
                    $OFFERS_PROPERTY_ID = false;
                }
            }
        }
    }
    //Check for iblock event
    elseif(is_array($arg1) && $arg1["ID"] > 0 && $arg1["IBLOCK_ID"] > 0)
    {
        //Check if iblock has offers
        $arOffers = CIBlockPriceTools::GetOffersIBlock($arg1["IBLOCK_ID"]);
        if(is_array($arOffers))
        {
            $ELEMENT_ID = $arg1["ID"];
            $IBLOCK_ID = $arg1["IBLOCK_ID"];
            $OFFERS_IBLOCK_ID = $arOffers["OFFERS_IBLOCK_ID"];
            $OFFERS_PROPERTY_ID = $arOffers["OFFERS_PROPERTY_ID"];
        }
    }

    if($ELEMENT_ID)
    {
        static $arPropCache = array();
        if(!array_key_exists($IBLOCK_ID, $arPropCache))
        {
            //Check for MINIMAL_PRICE property
            $rsProperty = CIBlockProperty::GetByID("MINIMUM_PRICE", $IBLOCK_ID);
            $arProperty = $rsProperty->Fetch();
            if($arProperty)
                $arPropCache[$IBLOCK_ID] = $arProperty["ID"];
            else
                $arPropCache[$IBLOCK_ID] = false;
        }

        if($arPropCache[$IBLOCK_ID])
        {
            //Compose elements filter
            if($OFFERS_IBLOCK_ID)
            {
                $rsOffers = CIBlockElement::GetList(
                    array(),
                    array(
                        "IBLOCK_ID" => $OFFERS_IBLOCK_ID,
                        "PROPERTY_".$OFFERS_PROPERTY_ID => $ELEMENT_ID,
                    ),
                    false,
                    false,
                    array("ID")
                );
                while($arOffer = $rsOffers->Fetch())
                    $arProductID[] = $arOffer["ID"];

                if (!is_array($arProductID))
                    $arProductID = array($ELEMENT_ID);
            }
            else
                $arProductID = array($ELEMENT_ID);

            $minPrice = false;
            $maxPrice = false;
            //Get prices
            $rsPrices = CPrice::GetList(
                array(),
                array(
                    "PRODUCT_ID" => $arProductID,
                )
            );
            while($arPrice = $rsPrices->Fetch())
            {
                if (CModule::IncludeModule('currency') && $strDefaultCurrency != $arPrice['CURRENCY'])
                    $arPrice["PRICE"] = CCurrencyRates::ConvertCurrency($arPrice["PRICE"], $arPrice["CURRENCY"], $strDefaultCurrency);

                $PRICE = $arPrice["PRICE"];

                if($minPrice === false || $minPrice > $PRICE)
                    $minPrice = $PRICE;

                if($maxPrice === false || $maxPrice < $PRICE)
                    $maxPrice = $PRICE;
            }

            //Save found minimal price into property
            if($minPrice !== false)
            {
                CIBlockElement::SetPropertyValuesEx(
                    $ELEMENT_ID,
                    $IBLOCK_ID,
                    array(
                        "MINIMUM_PRICE" => $minPrice,
                        "MAXIMUM_PRICE" => $maxPrice,
                    )
                );
            }
        }
    }
}
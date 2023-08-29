<?php
use Bitrix\Main,
    Bitrix\Iblock,
    Bitrix\Catalog;

IncludeModuleLangFile(__FILE__);

/**
 * дорабатываем класс под свои нужды
 */
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/iblock/classes/general/cml2.php");

class EX_CIBlockCMLImport extends CIBlockCMLImport
{
    // Обмен разделами
    function ImportSection($xml_tree_id, $IBLOCK_ID, $parent_section_id)
    {

    }
    // Обмен элементами
    function ImportElement($arXMLElement, &$counter, $bWF, $arParent)
    {

    }
}

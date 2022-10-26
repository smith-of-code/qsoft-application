<?php

if (!defined('B_PROLOG_INCLUDED') || !B_PROLOG_INCLUDED)  {
    die();
}

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Loader;

Loc::loadMessages(__FILE__);

if (!Loader::includeModule('iblock') || !Loader::includeModule('catalog')) {
    return;
}

/** @var array $arCurrentValues */

$arProperty = [];
$properties = \Bitrix\Iblock\PropertyTable::getList([
    'filter' => ['=IBLOCK_ID' => $arCurrentValues['IBLOCK_ID'], '=ACTIVE' => 'Y'],
    'select' => ['CODE', 'ID', 'NAME', 'PROPERTY_TYPE'],
])->fetchAll();
foreach ($properties as $property) {
    if (in_array($property['PROPERTY_TYPE'], [\Bitrix\Iblock\PropertyTable::TYPE_LIST, \Bitrix\Iblock\PropertyTable::TYPE_STRING])) {
        $propertyCode = $property['CODE'] ?: $property['ID'];
        $arProperty[$propertyCode] = "[$propertyCode] {$property['NAME']}";
    }
}

$arComponentParameters = [
    'GROUPS' => [],
    'PARAMETERS' => [
        'ELEMENT_ID' => [
            'PARENT' => 'DATA_SOURCE',
            'NAME' => Loc::getMessage('PARAMETER_ELEMENT_ID_NAME'),
            'TYPE' => 'STRING',
        ],
        'ELEMENT_CODE' => [
            'PARENT' => 'DATA_SOURCE',
            'NAME' => Loc::getMessage('PARAMETER_ELEMENT_CODE_NAME'),
            'TYPE' => 'STRING',
        ],
        'SECTION_ID' => [
            'PARENT' => 'DATA_SOURCE',
            'NAME' => Loc::getMessage('PARAMETER_SECTION_ID_NAME'),
            'TYPE' => 'STRING',
        ],
        'SECTION_CODE' => [
            'PARENT' => 'DATA_SOURCE',
            'NAME' => Loc::getMessage('PARAMETER_SECTION_CODE_NAME'),
            'TYPE' => 'STRING',
        ],
        'CACHE_TIME' => ['DEFAULT' => 36000000],
        'PROPERTY_COUNT_DETAIL' => [
            'PARENT' => 'DATA_SOURCE',
            'NAME' => Loc::getMessage('PROPERTY_COUNT_DETAIL'),
            'TYPE' => 'STRING',
            'DEFAULT' => '4',
        ],
        'SET_BROWSER_TITLE' => [
            'PARENT' => 'ADDITIONAL_SETTINGS',
            'NAME' => Loc::getMessage('PARAMETER_SET_BROWSER_TITLE'),
            'TYPE' => 'CHECKBOX',
            'DEFAULT' => 'Y',
            'REFRESH' => 'Y',
        ],
        'BROWSER_TITLE' => [
            'PARENT' => 'ADDITIONAL_SETTINGS',
            'NAME' => Loc::getMessage('PARAMETER_BROWSER_TITLE'),
            'TYPE' => 'LIST',
            'MULTIPLE' => 'N',
            'DEFAULT' => '-',
            'VALUES' => array_merge(['-' => ' ', 'NAME' => Loc::getMessage('IBLOCK_FIELD_NAME')], $arProperty),
            'HIDDEN' => (isset($arCurrentValues['SET_BROWSER_TITLE']) && $arCurrentValues['SET_BROWSER_TITLE'] === 'N' ? 'Y' : 'N')
        ],
        'SET_META_KEYWORDS' => [
            'PARENT' => 'ADDITIONAL_SETTINGS',
            'NAME' => Loc::getMessage('CP_BCE_SET_META_KEYWORDS'),
            'TYPE' => 'CHECKBOX',
            'DEFAULT' => 'Y',
            'REFRESH' => 'Y',
        ],
        'META_KEYWORDS' => [
            'PARENT' => 'ADDITIONAL_SETTINGS',
            'NAME' => Loc::getMessage('T_IBLOCK_DESC_KEYWORDS'),
            'TYPE' => 'LIST',
            'MULTIPLE' => 'N',
            'DEFAULT' => '-',
            'VALUES' => array_merge(['-' => ' '], $arProperty),
            'HIDDEN' => (isset($arCurrentValues['SET_META_KEYWORDS']) && $arCurrentValues['SET_META_KEYWORDS'] === 'N' ? 'Y' : 'N')
        ],
        'SET_META_DESCRIPTION' => [
            'PARENT' => 'ADDITIONAL_SETTINGS',
            'NAME' => Loc::getMessage('CP_BCE_SET_META_DESCRIPTION'),
            'TYPE' => 'CHECKBOX',
            'DEFAULT' => 'Y',
            'REFRESH' => 'Y'
        ],
        'META_DESCRIPTION' => [
            'PARENT' => 'ADDITIONAL_SETTINGS',
            'NAME' => Loc::getMessage('T_IBLOCK_DESC_DESCRIPTION'),
            'TYPE' => 'LIST',
            'MULTIPLE' => 'N',
            'DEFAULT' => '-',
            'VALUES' => array_merge(['-'=> ' '], $arProperty),
            'HIDDEN' => (isset($arCurrentValues['SET_META_DESCRIPTION']) && $arCurrentValues['SET_META_DESCRIPTION'] === 'N' ? 'Y' : 'N')
        ],
    ],
];

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

$iblockTypes = CIBlockParameters::GetIBlockTypes(['-' => ' ']);

$iblockFilters = [
    'ACTIVE' => 'Y',
    'SITE_ID' => $_REQUEST['site'],
];

if (isset($arCurrentValues['IBLOCK_TYPE']) && $arCurrentValues['IBLOCK_TYPE'] !== '-') {
    $iblockFilters['TYPE'] = $arCurrentValues['IBLOCK_TYPE'];
}

$iblocksIterator = CIBlock::GetList(['SORT' => 'ASC'], $iblockFilters);

$iblockNames = [];
while ($iblock = $iblocksIterator->Fetch()) {
    $iblockNames[$iblock['ID']] = "[{$iblock['ID']}] {$iblock['NAME']}";
}

$arComponentParameters = [
    'GROUPS' => [],
    'PARAMETERS' => [
        'IBLOCK_TYPE' => [
            'PARENT' => 'DATA_SOURCE',
            'NAME' => Loc::getMessage('PARAMETER_IBLOCK_TYPE_NAME'),
            'TYPE' => 'LIST',
            'VALUES' => $iblockTypes,
            'DEFAULT' => 'catalog',
            'REFRESH' => 'Y',
        ],
        'IBLOCK_ID' => [
            'PARENT' => 'DATA_SOURCE',
            'NAME' => Loc::getMessage('PARAMETER_IBLOCK_ID_NAME'),
            'TYPE' => 'LIST',
            'VALUES' => $iblockNames,
            'DEFAULT' => '107',
            'REFRESH' => 'Y',
        ],
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
    ],
];

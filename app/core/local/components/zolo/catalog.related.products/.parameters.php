<?php

if (!defined('B_PROLOG_INCLUDED') || !B_PROLOG_INCLUDED)  {
    die();
}

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Loader;

Loc::loadMessages(__FILE__);

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
        'CACHE_TIME' => ['DEFAULT' => 36000000],
    ],
];

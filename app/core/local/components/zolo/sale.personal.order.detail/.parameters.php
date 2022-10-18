<?php

use Bitrix\Main\Localization\Loc;

if (!defined('B_PROLOG_INCLUDED') || !B_PROLOG_INCLUDED)  {
    die();
}

Loc::loadMessages(__FILE__);

$arComponentParameters = [
    'GROUPS' => [],
    'PARAMETERS' => [
        'CACHE_TIME' => ['DEFAULT' => 3600],
        'ORDER_ID' => [
            'PARENT' => 'DATA_SOURCE',
            'NAME' => Loc::getMessage('PARAMETER_ORDER_ID_NAME'),
            'TYPE' => 'STRING',
        ],
    ],
];

<?php
if (!defined('B_PROLOG_INCLUDED') || !B_PROLOG_INCLUDED) {
    die();
}

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$arComponentDescription = [
    'NAME' => Loc::getMessage('DESCRIPTION_NAME'),
    'DESCRIPTION' => Loc::getMessage('DESCRIPTION_DESC'),
    'SORT' => 10,
    'CACHE_PATH' => 'Y',
];

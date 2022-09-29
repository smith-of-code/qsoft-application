<?php
if (!defined('B_PROLOG_INCLUDED') || !B_PROLOG_INCLUDED) {
    die();
}

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$arComponentParameters = [
    'GROUPS' => [],
    'PARAMETERS' => [
        'PROFILE_URL' => [
            'PARENT' => 'BASE',
            'NAME' => Loc::getMessage('PROFILE_URL'),
            'TYPE' => 'STRING',
            'DEFAULT' => '/personal/',
        ],
        'ORDER_HISTORY_URL' => [
            'PARENT' => 'BASE',
            'NAME' => Loc::getMessage('ORDER_HISTORY_URL'),
            'TYPE' => 'STRING',
            'DEFAULT' => '/personal/orders/',
        ],
        'INCOMES_CALCULATOR_URL' => [
            'PARENT' => 'BASE',
            'NAME' => Loc::getMessage('INCOMES_CALCULATOR_URL'),
            'TYPE' => 'STRING',
            'DEFAULT' => '/personal/calculator/',
        ],
        'SALES_REPORT_URL' => [
            'PARENT' => 'BASE',
            'NAME' => Loc::getMessage('SALES_REPORT_URL'),
            'TYPE' => 'STRING',
            'DEFAULT' => '/personal/sales-report/',
        ],
        'NOTIFICATIONS_URL' => [
            'PARENT' => 'BASE',
            'NAME' => Loc::getMessage('NOTIFICATIONS_URL'),
            'TYPE' => 'STRING',
            'DEFAULT' => '/personal/notifications/',
        ],
    ],
];

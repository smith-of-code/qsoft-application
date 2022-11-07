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
            'DEFAULT' => PersonalMainProfileNavigationMenu::PROFILE_URL,
        ],
        'ORDER_HISTORY_URL' => [
            'PARENT' => 'BASE',
            'NAME' => Loc::getMessage('ORDER_HISTORY_URL'),
            'TYPE' => 'STRING',
            'DEFAULT' => PersonalMainProfileNavigationMenu::ORDER_HISTORY_URL,
        ],
        'USER_GROUP' => [
            'PARENT' => 'BASE',
            'NAME' => Loc::getMessage('ORDER_HISTORY_URL'),
            'TYPE' => 'STRING',
            'DEFAULT' => 'BUYER',
        ],
        'INCOMES_CALCULATOR_URL' => [
            'PARENT' => 'BASE',
            'NAME' => Loc::getMessage('INCOMES_CALCULATOR_URL'),
            'TYPE' => 'STRING',
            'DEFAULT' => PersonalMainProfileNavigationMenu::INCOMES_CALCULATOR_URL,
        ],
        'SALES_REPORT_URL' => [
            'PARENT' => 'BASE',
            'NAME' => Loc::getMessage('SALES_REPORT_URL'),
            'TYPE' => 'STRING',
            'DEFAULT' => PersonalMainProfileNavigationMenu::SALES_REPORT_URL,
        ],
        'NOTIFICATIONS_URL' => [
            'PARENT' => 'BASE',
            'NAME' => Loc::getMessage('NOTIFICATIONS_URL'),
            'TYPE' => 'STRING',
            'DEFAULT' => PersonalMainProfileNavigationMenu::NOTIFICATIONS_URL,
        ],
    ],
];

<?php

use	Bitrix\Main\Loader;
use	Bitrix\Main\Localization\Loc;
use QSoft\Entity\User;
use QSoft\ORM\NotificationService;

if (!defined('B_PROLOG_INCLUDED') || !B_PROLOG_INCLUDED) {
    die();
}

Loc::loadMessages(__FILE__);

if (!Loader::includeModule('highloadblock')) {
    ShowError(Loc::getMessage('HIGHLOADBLOCK_MODULE_NOT_INSTALLED'));
    return;
}

class PersonalMainProfileNavigationMenu extends CBitrixComponent
{
    const PROFILE_URL = '/personal/';
    const ORDER_HISTORY_URL = '/personal/orders/';
    const INCOMES_CALCULATOR_URL = '/personal/calculator/';
    const SALES_REPORT_URL = '/personal/sales-report/';
    const NOTIFICATIONS_URL = '/personal/notifications/';

    private bool $isError = false;

    public function onPrepareComponentParams($arParams)
    {
        $arParams = parent::onPrepareComponentParams($arParams);

        $arParams['PROFILE_URL'] = $arParams['PROFILE_URL'] ?: self::PROFILE_URL;
        $arParams['ORDER_HISTORY_URL'] = $arParams['ORDER_HISTORY_URL'] ?: self::ORDER_HISTORY_URL;
        $arParams['INCOMES_CALCULATOR_URL'] = $arParams['INCOMES_CALCULATOR_URL'] ?: self::INCOMES_CALCULATOR_URL;
        $arParams['SALES_REPORT_URL'] = $arParams['SALES_REPORT_URL'] ?: self::SALES_REPORT_URL;
        $arParams['NOTIFICATIONS_URL'] = $arParams['NOTIFICATIONS_URL'] ?: self::NOTIFICATIONS_URL;

        return $arParams;
    }

    public function executeComponent()
    {
        try {
            if ($this->isError) {
                return;
            }

            if (!defined('HIGHLOAD_BLOCK_HLNOTIFICATION')) {
                throw new RuntimeException(Loc::getMessage('HLNOTIFICATION_NOT_DEFINED'));
            }

            $user = new User($GLOBALS['USER']->GetID());

            $user = currentUser();

            $this->arResult['NOTIFICATION_COUNT'] = $user->notification->getUnreadCount();

            $this->arResult['IS_CONSULTANT'] = $user->groups->isConsultant();

            $this->includeComponentTemplate();
        } catch (Throwable $e) {
            ShowError($e->getMessage());
        }
    }
}

<?php

use	Bitrix\Main\Loader;
use	Bitrix\Main\Localization\Loc;
use Bitrix\Highloadblock\HighloadBlockTable;
use QSoft\Entity\User;

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

            $hlBlock = HighloadBlockTable::getById(HIGHLOAD_BLOCK_HLNOTIFICATION)->fetch();
            if (!$hlBlock) {
                throw new RuntimeException(Loc::getMessage('HLNOTIFICATION_NOT_SET'));
            }

            $statusField = CUserTypeEntity::GetList([], [
                'ENTITY_ID' => 'HLBLOCK_' . $hlBlock['ID'],
                'FIELD_NAME' => 'UF_STATUS',
            ])->Fetch();

            $statusEnum = CUserFieldEnum::GetList([], [
                'USER_FIELD_ID' => $statusField['ID'],
                'XML_ID' => 'NOTIFICATION_STATUS_UNREAD',
            ])->Fetch();

            $userId = $GLOBALS['USER']->GetID();
            $entity = HighloadBlockTable::compileEntity($hlBlock)->getDataClass();
            $count = $entity::getList([
                'filter' => [
                    'UF_USER_ID' => $userId,
                    'UF_STATUS' => $statusEnum['ID'],
                ],
            ])->getSelectedRowsCount();

            $this->arResult['NOTIFICATION_COUNT'] = $count;

            $this->arResult['IS_CONSULTANT'] = (new User($userId))->groups->isConsultant();

            $this->includeComponentTemplate();
        } catch (Throwable $e) {
            ShowError($e->getMessage());
        }
    }
}

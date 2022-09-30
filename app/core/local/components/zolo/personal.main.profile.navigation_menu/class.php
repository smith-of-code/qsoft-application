<?php

use Bitrix\Main;
use	Bitrix\Main\Loader;
use	Bitrix\Main\Localization\Loc;
use Bitrix\Iblock\Component\Tools;
use Bitrix\Catalog\PriceTable;
use Bitrix\Highloadblock\HighloadBlockTable;

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
    private bool $isError = false;

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

            $entity = HighloadBlockTable::compileEntity($hlBlock)->getDataClass();
            $count = $entity::getList([
                'filter' => [
                    'UF_USER_ID' => $GLOBALS['USER']->GetID(),
                    'UF_STATUS' => $statusEnum['ID'],
                ],
            ])->getSelectedRowsCount();

            $this->arResult['NOTIFICATION_COUNT'] = $count;

            $userGroups = CUser::GetUserGroup($GLOBALS['USER']->GetID());
            $consultantGroup = CGroup::GetList([], [], [
                'ACTIVE' => 'Y',
                'STRING_ID' => 'consultant',
            ])->Fetch();

            $this->arResult['IS_CONSULTANT'] = $consultantGroup && in_array($consultantGroup['ID'], $userGroups);

            $this->includeComponentTemplate();
        } catch (Throwable $e) {
            ShowError($e->getMessage());
        }
    }
}

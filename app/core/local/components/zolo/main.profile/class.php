<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Context;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\SystemException;
use Bitrix\Main\Loader;
use Bitrix\Highloadblock\HighloadBlockTable;

class UserProfileForm extends CBitrixComponent
{
    private $userId;

    public function executeComponent()
    {
        try {
            global $USER;
            $this->userId = $USER->GetId();

            $this->checkModules();
            $this->getResult();
            $this->includeComponentTemplate();
        } catch (SystemException $e) {
            ShowError($e->getMessage());
        }
    }

    public function checkModules()
    {
        if (!Loader::includeModule('iblock')) {
            throw new SystemException(Loc::GetMessage('PSETTINGS_IBLOCK_NOT_INCLUDED'));
        } else if (!Loader::includeModule('highloadblock')) {
            throw new SystemException(Loc::GetMessage('PSETTINGS_HLBLOCK_NOT_INCLUDED'));
        }
    }

    public function getResult()
    {
        $request = Context::getCurrent()->getRequest();

        if ($request->isPost() && $request->getPost('save') == 'Y') {
            $this->update($request->getPostList()->toArray());

            if (empty($this->arResult['NOTIFICATION'])) {
                header('Location: /personal/');
            }
        }

        $this->arResult['USER_INFO'] = $this->getUser();

        switch ($this->arResult['USER_INFO']['PERSONAL_GENDER']) {
            case 'M':
                $this->arResult['USER_INFO']['PERSONAL_GENDER'] = 'Мужской';
                break;
            case 'F':
                $this->arResult['USER_INFO']['PERSONAL_GENDER'] = 'Женский';
                break;
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
                'UF_USER_ID' => $this->userId,
                'UF_STATUS' => $statusEnum['ID'],
            ],
        ])->getSelectedRowsCount();

        $this->arResult['MENU']['NOTIFICATION_COUNT'] = $count;

        $userGroups = CUser::GetUserGroup($this->userId);
        $consultantGroup = CGroup::GetList([], [], [
            'ACTIVE' => 'Y',
            'STRING_ID' => 'consultant',
        ])->Fetch();

        $this->arResult['MENU']['IS_CONSULTANT'] = $consultantGroup && in_array($consultantGroup['ID'], $userGroups);
    }

    private function getUser()
    {

        $arUserInfo = CUser::GetByID($this->userId)->Fetch();

        return $arUserInfo;
    }

    private function update($arParams)
    {
        $arPreparedProperties = $this->prepareProperties($arParams);
    }
}

<?php
if (!defined('B_PROLOG_INCLUDED') || !B_PROLOG_INCLUDED) {
    die();
}

use Bitrix\Main\Context;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\SystemException;
use Bitrix\Main\Loader;
use Bitrix\Highloadblock\HighloadBlockTable as HL;
use QSoft\Service\UserGroupsService;

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
        }

        if (!Loader::includeModule('highloadblock')) {
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

        $this->arResult['SELECT_OPTIONS'] = $this->getSelect();
        $this->arResult['USER_INFO'] = $this->getUser();
        $this->arResult['USER_GROUP'] = $this->getUserGroup();
        if ($this->arResult['USER_GROUP'] == 'Консультант') {
            $this->arResult['LEGAL_ENTITY'] = $this->getLegalEntity();
        }
        $this->arResult['PETS_INFO'] = $this->getPetsInfo();
        $this->arResult['MENTOR_INFO'] = $this->getMentorInfo();
        //Система лояльности
        //Персональные акции
    }

    private function getUserGroup()
    {
        if (UserGroupsService::isBuyer($this->userId)) {
            $userGroup = 'Покупатель';
        } elseif (UserGroupsService::isConsultant($this->userId)) {
            $userGroup = 'Консультант';
        }

        return $userGroup;
    }


    private function getUser()
    {
        $arUserInfo = CUser::GetByID($this->userId)->Fetch();

        if (UserGroupsService::isBuyer($this->userId)) {
            $arUserInfo['USER_GROUP'] = 'Покупатель';
        } elseif (UserGroupsService::isConsultant($this->userId)) {
            $arUserInfo['USER_GROUP'] = 'Консультант';
        }

        switch ($arUserInfo['PERSONAL_GENDER']) {
            case 'M':
                $arUserInfo['PERSONAL_GENDER'] = 'Мужской';
                break;
            case 'F':
                $arUserInfo['PERSONAL_GENDER'] = 'Женский';
                break;
        }

        return $arUserInfo;
    }

    private function getLegalEntity()
    {
        $hlBlock = HL::getList([
            'filter' => ['=ID' => HIGHLOAD_BLOCK_HLLEGALENTITIES],
        ])->fetch();

        $arLegalEntity = HL::compileEntity($hlBlock)->getDataClass()::getList([
            'filter' => [
                'UF_USER_ID' => $this->userId,
                'UF_IS_ACTIVE' => 1
            ],
        ])->fetch();

        $this->arResult['DOCUMENTS'] = json_decode($arLegalEntity['UF_DOCUMENTS'], true, 512, JSON_THROW_ON_ERROR);
        foreach ($this->arResult['SELECT_OPTIONS']['STATUS'] as $key => $value) {
            if ($key == $arLegalEntity['UF_STATUS']) {
                $this->arResult['DOCUMENTS']['STATUS'] = $value;
            }
        }

        return $arLegalEntity;
    }

    private function getPetsInfo()
    {
        $hlBlock = HL::getList([
            'filter' => ['=ID' => HIGHLOAD_BLOCK_HLPETS],
        ])->fetch();

        $resPets = HL::compileEntity($hlBlock)->getDataClass()::getList([
            'filter' => [
                'UF_USER_ID' => $this->userId,
            ],
        ]);
        while ($pet = $resPets->Fetch()){
            $arPets[] = $pet;
        }

        return $arPets;
    }

    private function getMentorInfo()
    {
        return CUser::GetByID($this->arResult['USER_INFO']['UF_MENTOR_ID'])->Fetch();
    }

    private function getSelect()
    {
        //Статусы юр лица для консультантов
        $entity = CUserTypeEntity::GetList([], [
            'ENTITY_ID' => "HLBLOCK_" . HIGHLOAD_BLOCK_HLLEGALENTITIES,
            "FIELD_NAME" => "UF_STATUS"
        ])->Fetch();

        $obEntity = CUserFieldEnum::GetList([], ['USER_FIELD_ID' => $entity['ID']]);
        while ($enumFields = $obEntity->Fetch()) {
            $selects['STATUS'][$enumFields['ID']] = $enumFields['VALUE'];
        }

        //Типы питомцев
        $entity = CUserTypeEntity::GetList([], [
            'ENTITY_ID' => "HLBLOCK_" . HIGHLOAD_BLOCK_HLPETS,
            "FIELD_NAME" => "UF_KIND",

        ])->Fetch();

        $obEntity = CUserFieldEnum::GetList([], ['USER_FIELD_ID' => $entity['ID']]);
        while ($enumFields = $obEntity->Fetch()) {
            $selects['PET_KIND'][$enumFields['ID']] = $enumFields['VALUE'];
        }

        //Порода питомцев
        $entity = CUserTypeEntity::GetList([], [
            'ENTITY_ID' => "HLBLOCK_" . HIGHLOAD_BLOCK_HLPETS,
            "FIELD_NAME" => "UF_BREED",
        ])->Fetch();

        $obEntity = CUserFieldEnum::GetList([], ['USER_FIELD_ID' => $entity['ID']]);
        while ($enumFields = $obEntity->Fetch()) {
            $selects['PET_BREED'][$enumFields['ID']] = $enumFields['VALUE'];
        }

        //Пол питомцев
        $entity = CUserTypeEntity::GetList([], [
            'ENTITY_ID' => "HLBLOCK_" . HIGHLOAD_BLOCK_HLPETS,
            "FIELD_NAME" => "UF_GENDER",
        ])->Fetch();

        $obEntity = CUserFieldEnum::GetList([], ['USER_FIELD_ID' => $entity['ID']]);
        while ($enumFields = $obEntity->Fetch()) {
            $selects['PET_GENDER'][$enumFields['ID']] = $enumFields['VALUE'];
        }

        return $selects;
    }

    private function update($arParams)
    {
        $arPreparedProperties = $this->prepareProperties($arParams);
    }
}

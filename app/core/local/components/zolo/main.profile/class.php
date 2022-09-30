<?php
if (!defined('B_PROLOG_INCLUDED') || !B_PROLOG_INCLUDED) {
    die();
}

use Bitrix\Main\Context;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\SystemException;
use Bitrix\Main\Loader;

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

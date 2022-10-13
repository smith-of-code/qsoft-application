<?php
if (!defined('B_PROLOG_INCLUDED') || !B_PROLOG_INCLUDED) {
    die();
}

use Bitrix\Main\Engine\Contract\Controllerable;
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\SystemException;
use Bitrix\Main\Type\Date;
use Bitrix\Main\Type\DateTime;
use Bitrix\Highloadblock\HighloadBlockTable as HL;
use QSoft\Entity\User;

class MainProfileComponent extends CBitrixComponent  implements Controllerable
{
    private $userId;
    private $user;

    public function executeComponent()
    {
        try {
            $this->userId = $GLOBALS['USER']->GetID();
            $this->checkModules();

            $this->user = new User($this->userId);
            $this->getResult();
            $this->includeComponentTemplate();
        } catch (SystemException $e) {
            ShowError($e->getMessage());
        }
    }

    /**
     * @throws \Bitrix\Main\LoaderException
     * @throws SystemException
     */
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
        $this->arResult['SELECT_OPTIONS'] = $this->getSelects();

        $this->arResult['USER_INFO'] = $this->getUser();

        if ($this->arResult['USER_GROUP'] == 'Консультант') {
            $this->arResult['LEGAL_ENTITY'] = $this->user->legalEntity->get();
            foreach ($this->arResult['SELECT_OPTIONS']['STATUS'] as $key => $value) {
                if ($key == $this->arResult['LEGAL_ENTITY']['UF_STATUS']) {
                    $this->arResult['STATUS'] = $value;
                }
            }
        }
        $this->arResult['PETS_INFO'] = $this->user->pets->get();
        $this->arResult['MENTOR_INFO'] = $this->getMentorInfo();
        //Система лояльности
        //Персональные акции
    }


    private function getUser()
    {
        $arUserInfo = CUser::GetByID($this->userId)->Fetch();

        if ($this->user->groups->isBuyer()) {
            $this->arResult['USER_GROUP'] = 'Покупатель';
        } elseif ($this->user->groups->isConsultant()) {
            $this->arResult['USER_GROUP'] = 'Консультант';
        }

        if (!empty($arUserInfo['PERSONAL_PHOTO'])) {
            $arUserInfo['PERSONAL_PHOTO_URL'] = $this->user->getPhotoUrl();
        }

        return $arUserInfo;
    }

    /**
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws SystemException
     */

    private function getMentorInfo()
    {
        return CUser::GetByID($this->arResult['USER_INFO']['UF_MENTOR_ID'])->Fetch();
    }

    /**
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\ArgumentException
     * @throws SystemException
     */
    private function getSelects(): array
    {
        //Пол пользователя
        $selects['USER_GENDER'] = ['M' => 'Мужской', 'F' => 'Женский'];

        //Пункты выдачи заказов
        $hlBlock = HL::compileEntity(HIGHLOAD_BLOCK_HLPICKUPPOINT)->getDataClass()::getList([
            'order' => ['UF_NAME'=>'ASC'],
            'select' => ['*'],
        ]);
        while ($fields = $hlBlock->Fetch()) {
            $selects['PICK_POINT'][$fields['ID']] = $fields['UF_NAME'];
        }

        //Статусы юр лица для консультантов
        $enums = (new \QSoft\ORM\LegalEntityTable)::getFieldValues(['UF_STATUS']);
        foreach ($enums['UF_STATUS'] as $enum) {
            $selects['STATUS'][$enum['ID']] = $enum['VALUE'];
        }

        //Типы питомцев
        $enums = (new \QSoft\ORM\PetTable)::getFieldValues(['UF_KIND']);
        foreach ($enums['UF_KIND'] as $enum) {
            $selects['PET_KIND'][$enum['ID']] = $enum['VALUE'];
        }

        //Породы кошек
        $hlBlock = HL::compileEntity(HIGHLOAD_BLOCK_HLBREEDCAT)->getDataClass()::getList([
            'order' => ['UF_BREED_CAT'=>'ASC'],
            'select' => ['*'],
        ]);
        while ($fields = $hlBlock->Fetch()) {
            $selects['CAT_BREED'][$fields['ID']] = $fields['UF_BREED_CAT'];
        }

        //Породы собак
        $hlBlock = HL::compileEntity(HIGHLOAD_BLOCK_HLBREEDDOG)->getDataClass()::getList([
            'order' => ['UF_BREED_DOG'=>'ASC'],
            'select' => ['*'],
        ]);
        while ($enumFields = $hlBlock->Fetch()) {
            $selects['DOG_BREED'][$enumFields['ID']] = $enumFields['UF_BREED_DOG'];
        }

        //Пол питомцев
        $enums = (new \QSoft\ORM\PetTable)::getFieldValues(['UF_GENDER']);
        foreach ($enums['UF_GENDER'] as $enum) {
            $selects['PET_GENDER'][$enum['ID']] = $enum['VALUE'];
        }

        return $selects;
    }

    public function configureActions(): array
    {
        return [
            'userInfoUpdate' => [
                'prefilters' => []
            ],
            'legalEntityUpdate' => [
                'prefilters' => []
            ],
            'addPet' => [
                'prefilters' => []
            ],
            'changePet' => [
                'prefilters' => []
            ],
            'deletePet' => [
                'prefilters' => []
            ],
        ];

    }

    public function userInfoUpdateAction($form)
    {
        //TODO:Загрузка фоток
        $props = [];

        foreach ($form as $row) {
            $props[$row['name']] = $row['value'];
        }

        $fields["NAME"] = $props['NAME'];
        $fields = [
            "NAME"              => $props['NAME'],
            "LAST_NAME"         => $props['LAST_NAME'],
            "SECOND_NAME"       => $props['SECOND_NAME'],
            "PERSONAL_GENDER"   => $props['PERSONAL_GENDER'],
            "PERSONAL_BIRTHDAY" => $props['PERSONAL_BIRTHDAY'],
            "EMAIL"             => $props['EMAIL'],
            "PERSONAL_PHONE"    => $props['PERSONAL_PHONE'],
            "PERSONAL_CITY"     => $props['PERSONAL_CITY'],
            "UF_PICKUP_POINT_ID"=> $props['UF_PICKUP_POINT_ID']
        ];

        (new User($GLOBALS['USER']->GetID()))->Update($fields);
    }

    public function legalEntityUpdateAction($form)
    {
        //TODO:Загрузка кучи сканов
        $docs = [];

        foreach ($form as $row) {
            if($row['name'] != 'UF_STATUS') {
                array_set($docs, $row['name'], $row['value']);
            } else {
                $props["UF_STATUS"] = $row['value'];
            }
        }

        $props['UF_USER_ID'] = $GLOBALS['USER']->GetID();
        $props['UF_CREATED_AT'] = new DateTime();
        $props['UF_DOCUMENTS'] = json_encode($docs, JSON_UNESCAPED_UNICODE);
        $props['UF_IS_ACTIVE'] = true;


        \QSoft\ORM\LegalEntityTable::add($props);

        //TODO: добавить модерацию (видимо переслать в ConfirmationTable)
        //TODO(?): добавить ивент хендлер, деактивирующий/удаляющий предыдущую запись после модерации
    }

    public function addPetAction($form)
    {
        $props['UF_USER_ID'] = $GLOBALS['USER']->GetID();
        $props['UF_NAME'] = $form['UF_NAME'];
        $props['UF_GENDER'] = $form['UF_GENDER'];
        $props['UF_KIND'] = $form['UF_KIND'];
        $props['UF_BIRTHDATE'] = new date($form['UF_BIRTHDATE'], "d.m.Y");

        $kinds = (new \QSoft\ORM\PetTable)::getFieldValues(['UF_KIND']);
        foreach ($kinds['UF_KIND'] as $kind) {
            if ($form['UF_KIND'] == $kind['ID']) {
                $petType = $kind['XML_ID'];
            }
        }

        if ($petType == 'KIND_CAT') {
            $props['UF_BREED'] = $form["UF_CAT_BREED"];
        } elseif ($petType == 'KIND_DOG') {
            $props['UF_BREED'] = $form["UF_DOG_BREED"];
        }

        $pet = \QSoft\ORM\PetTable::add($props);

        if ($pet) {
        $data['pet-id'] = $pet;
            } else {
        $data['error'] = 'error';
        }

        return $data;
    }

    public function changePetAction($form)
    {
        $props['UF_USER_ID'] = $GLOBALS['USER']->GetID();
        $props['UF_NAME'] = $form['UF_NAME'];
        $props['UF_GENDER'] = $form['UF_GENDER'];
        $props['UF_KIND'] = $form['UF_KIND'];
        $props['UF_BIRTHDATE'] = new date($form['UF_BIRTHDATE'], "d.m.Y");

        $kinds = (new \QSoft\ORM\PetTable)::getFieldValues(['UF_KIND']);
        foreach ($kinds['UF_KIND'] as $kind) {
            if ($form['UF_KIND'] == $kind['ID']) {
                $petType = $kind['XML_ID'];
            }
        }

        if ($petType == 'KIND_CAT') {
            $props['UF_BREED'] = $form["UF_CAT_BREED"];
        } elseif ($petType == 'KIND_DOG') {
            $props['UF_BREED'] = $form["UF_DOG_BREED"];
        }

        \QSoft\ORM\PetTable::update($form['ID'], $props);
    }

    public function deletePetAction($id)
    {
        \QSoft\ORM\PetTable::delete($id);
    }

    //TODO смена ментора
    //TODO модерация

}

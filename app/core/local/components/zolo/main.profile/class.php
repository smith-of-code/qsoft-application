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
use QSoft\Service\UserGroupsService;

class MainProfileComponent extends CBitrixComponent  implements Controllerable
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
            return 'Покупатель';
        } elseif (UserGroupsService::isConsultant($this->userId)) {
            return 'Консультант';
        }
    }

    private function getUser()
    {
        $arUserInfo = CUser::GetByID($this->userId)->Fetch();

        if (UserGroupsService::isBuyer($this->userId)) {
            $arUserInfo['USER_GROUP'] = 'Покупатель';
        } elseif (UserGroupsService::isConsultant($this->userId)) {
            $arUserInfo['USER_GROUP'] = 'Консультант';
        }

        if (!empty($arUserInfo['PERSONAL_PHOTO'])) {
            $arUserInfo['PERSONAL_PHOTO_URL'] = CFile::GetPath($arUserInfo['PERSONAL_PHOTO']);
        }

        return $arUserInfo;
    }

    /**
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws SystemException
     * @throws JsonException
     */
    private function getLegalEntity()
    {
        $hlBlock = HL::getList([
            'filter' => ['=ID' => HIGHLOAD_BLOCK_HLLEGALENTITIES],
        ])->fetch();

        $arLegalEntity = HL::compileEntity($hlBlock)->getDataClass()::getList([
            'order' => ['ID' => 'DESC'],
            'filter' => [
                'UF_USER_ID' => $this->userId,
                'UF_IS_ACTIVE' => 1
            ],
        ])->fetch();

        if ($arLegalEntity['UF_DOCUMENTS'] != '') {
            $this->arResult['DOCUMENTS'] = json_decode($arLegalEntity['UF_DOCUMENTS'], true, 512, JSON_THROW_ON_ERROR);
        }

        foreach ($this->arResult['SELECT_OPTIONS']['STATUS'] as $key => $value) {
            if ($key == $arLegalEntity['UF_STATUS']) {
                $this->arResult['DOCUMENTS']['STATUS'] = $value;
            }
        }

        return $arLegalEntity;
    }

    /**
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws SystemException
     */
    private function getPetsInfo(): array
    {
        $arPets = [];

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

    /**
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\ArgumentException
     * @throws SystemException
     */
    private function getSelect(): array
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
        global $USER;

        //TODO:Загрузка фоток
        $props = [];

        foreach ($form as $row) {
            $props[$row['name']] = $row['value'];
        }

        $user = new CUser;
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

        $user->Update($USER->GetId(), $fields);
    }

    public function legalEntityUpdateAction($form)
    {
        global $USER;

        //TODO:Загрузка кучи сканов
        $docs = [];

        foreach ($form as $row) {
            switch ($row['name']) {
                case 'UF_STATUS':
                    $props["UF_STATUS"] = $row['value'];
                    break;
                case 'citizenship':
                    $docs["citizenship"] = $row['value'];
                    break;
                case 'passport.series':
                    $docs["passport"]['series'] = $row['value'];
                    break;
                case 'passport.number':
                    $docs["passport"]['number'] = $row['value'];
                    break;
                case 'passport.issued':
                    $docs["passport"]['issued'] = $row['value'];
                    break;
                case 'passport.date':
                    $docs["passport"]['date'] = $row['value'];
                    break;
                case 'passport.addressRegistration.locality':
                    $docs["passport"]['addressRegistration']['locality'] = $row['value'];
                    break;
                case 'passport.addressRegistration.street':
                    $docs["passport"]['addressRegistration']['street'] = $row['value'];
                    break;
                case 'passport.addressRegistration.home':
                    $docs["passport"]['addressRegistration']['home'] = $row['value'];
                    break;
                case 'passport.addressRegistration.flat':
                    $docs["passport"]['addressRegistration']['flat'] = $row['value'];
                    break;
                case 'passport.addressRegistration.index':
                    $docs["passport"]['addressRegistration']['index'] = $row['value'];
                    break;
                case 'passport.addressFact':
                    $docs["passport"]['addressFact'] = $row['value'];
                    break;
                case 'passport.addressFact.locality':
                    $docs["passport"]['addressFact']['locality'] = $row['value'];
                    break;
                case 'passport.addressFact.street':
                    $docs["passport"]['addressFact']['street'] = $row['value'];
                    break;
                case 'passport.addressFact.home':
                    $docs["passport"]['addressFact']['home'] = $row['value'];
                    break;
                case 'passport.addressFact.flat':
                    $docs["passport"]['addressFact']['flat'] = $row['value'];
                    break;
                case 'passport.addressFact.index':
                    $docs["passport"]['addressFact']['index'] = $row['value'];
                    break;
                case 'passport.addressOrganization.locality':
                    $docs["passport"]['addressOrganization']['locality'] = $row['value'];
                    break;
                case 'passport.addressOrganization.street':
                    $docs["passport"]['addressOrganization']['street'] = $row['value'];
                    break;
                case 'passport.addressOrganization.home':
                    $docs["passport"]['addressOrganization']['home'] = $row['value'];
                    break;
                case 'passport.addressOrganization.flat':
                    $docs["passport"]['addressOrganization']['flat'] = $row['value'];
                    break;
                case 'passport.addressOrganization.index':
                    $docs["passport"]['addressOrganization']['index'] = $row['value'];
                    break;
                case 'passport.copyPassport':
                    $docs["passport"]['copyPassport'][] = $row['value'];
                    break;
                case 'inn':
                    $docs["inn"] = $row['value'];
                    break;
                case 'kpp':
                    $docs["kpp"] = $row['value'];
                    break;
                case 'innFiles':
                    $docs["innFiles"][] = $row['value'];
                    break;
                case 'bank.name':
                    $docs["bank"]['name'] = $row['value'];
                    break;
                case 'bank.bik':
                    $docs["bank"]['bik'] = $row['value'];
                    break;
                case 'bank.rAccount':
                    $docs["bank"]['rAccount'] = $row['value'];
                    break;
                case 'bank.kAccount':
                    $docs["bank"]['kAccount'] = $row['value'];
                    break;
                case 'bank.bankFiles':
                    $docs["bank"]['bankFiles'][] = $row['value'];
                    break;
                case 'nds':
                    $docs["nds"] = $row['value'];
                    break;
                case 'usn':
                    $docs["usn"][] = $row['value'];
                    break;
                case 'ogrnip':
                    $docs["ogrnip"] = $row['value'];
                    break;
                case 'egrip':
                    $docs["egrip"][] = $row['value'];
                    break;
                case 'name':
                    $docs["name"] = $row['value'];
                    break;
                case 'nameSmall':
                    $docs["nameSmall"] = $row['value'];
                    break;
                case 'ogrn':
                    $docs["ogrn"] = $row['value'];
                    break;
                case 'rule':
                    $docs["rule"][] = $row['value'];
                    break;
                case 'leader':
                    $docs["leader"][] = $row['value'];
                    break;
                case 'order':
                    $docs["order"] = $row['value'];
                    break;
                case 'egrul':
                    $docs["egrul"][] = $row['value'];
                    break;
                case 'rightToSign':
                    $docs["rightToSign"] = $row['value'];
                    break;
            }
        }

        $props['UF_USER_ID'] = $USER->GetId();
        $props['UF_CREATED_AT'] = new DateTime();
        $props['UF_DOCUMENTS'] = json_encode($docs, JSON_UNESCAPED_UNICODE);
        $props['UF_IS_ACTIVE'] = true;


        \QSoft\ORM\LegalEntityTable::add($props);

        //TODO: добавить модерацию (видимо переслать в ConfirmationTable)
        //TODO(?): добавить ивент хендлер, деактивирующий/удаляющий предыдущую запись после модерации
    }

    public function addPetAction($form)
    {
        global $USER;

        $props['UF_USER_ID'] = $USER->GetId();
        $props['UF_NAME'] = $form['UF_NAME'];
        $props['UF_GENDER'] = $form['UF_GENDER'];
        $props['UF_KIND'] = $form['UF_KIND'];
        //TODO разобраться с датами
        $props['UF_BIRTHDATE'] = $form['UF_BIRTHDATE'];
        $props['UF_BIRTHDATE'] = new Date();

        $entity = CUserTypeEntity::GetList([], [
            'ENTITY_ID' => "HLBLOCK_" . HIGHLOAD_BLOCK_HLPETS,
            "FIELD_NAME" => "UF_KIND",

        ])->Fetch();

        $obEntity = CUserFieldEnum::GetList([], ['USER_FIELD_ID' => $entity['ID']]);
        while ($enumFields = $obEntity->Fetch()) {
            if ($form['UF_KIND'] == $enumFields['ID']) {
                $petType = $enumFields['VALUE'];
            }
        }

        if ($petType == 'кошка') {
            $props['UF_BREED'] = ["UF_CAT_BREED"];
        } else {
            $props['UF_BREED'] = ["UF_DOG_BREED"];
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
        global $USER;

        $props['UF_USER_ID'] = $USER->GetId();
        $props['UF_NAME'] = $form['UF_NAME'];
        $props['UF_GENDER'] = $form['UF_GENDER'];
        $props['UF_KIND'] = $form['UF_KIND'];
        //TODO разобраться с датами
        $props['UF_BIRTHDATE'] = $form['UF_BIRTHDATE'];
        $props['UF_BIRTHDATE'] = new Date();

        $entity = CUserTypeEntity::GetList([], [
            'ENTITY_ID' => "HLBLOCK_" . HIGHLOAD_BLOCK_HLPETS,
            "FIELD_NAME" => "UF_KIND",

        ])->Fetch();

        $obEntity = CUserFieldEnum::GetList([], ['USER_FIELD_ID' => $entity['ID']]);
        while ($enumFields = $obEntity->Fetch()) {
            if ($form['UF_KIND'] == $enumFields['ID']) {
                $petType = $enumFields['VALUE'];
            }
        }

        if ($petType == 'кошка') {
            $props['UF_BREED'] = ["UF_CAT_BREED"];
        } else {
            $props['UF_BREED'] = ["UF_DOG_BREED"];
        }
    }

    public function deletePetAction($id)
    {
        \QSoft\ORM\PetTable::delete($id);
    }

    //TODO смена ментора
    //TODO модерация

}

<?php
if (!defined('B_PROLOG_INCLUDED') || !B_PROLOG_INCLUDED) {
    die();
}

use Bitrix\Main\ArgumentException;
use Bitrix\Main\Engine\Contract\Controllerable;
use Bitrix\Main\Errorable;
use Bitrix\Main\ErrorCollection;
use Bitrix\Main\Loader;
use Bitrix\Main\LoaderException;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ObjectPropertyException;
use Bitrix\Main\SystemException;
use Bitrix\Main\Type\Date;
use Bitrix\Main\Type\DateTime;
use Bitrix\Highloadblock\HighloadBlockTable as HL;
use QSoft\Entity\User;
use QSoft\ORM\CatBreedTable;
use QSoft\ORM\DogBreedTable;
use QSoft\ORM\LegalEntityTable;
use QSoft\ORM\PetTable;
use QSoft\ORM\PickupPointTable;

class MainProfileComponent extends CBitrixComponent implements Controllerable, Errorable
{
    private ?int $userId;
    private User $user;

    protected ErrorCollection $errorCollection;

    public function onPrepareComponentParams($arParams)
    {
        $this->errorCollection = new ErrorCollection();
        $this->userId = $GLOBALS['USER']->GetID();
        $this->user = new User($this->userId);

        if (! isset($this->userId)) {
            echo Loc::getMessage('PSETTINGS_NEED_AUTHORIZATION');
            die();
        }

        $this->checkModules();
    }

    public function executeComponent()
    {
        try {
            $this->getResult();
            $this->includeComponentTemplate();
        } catch (Exception $e) {
            ShowError($e->getMessage());
        }
    }

    /**
     * @throws LoaderException
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
        $this->arResult['PETS_INFO'] = $this->user->pets->getAll();
        $this->arResult['MENTOR_INFO'] = $this->user->getMentor();
        //Система лояльности
        $this->arResult['LOYALTY_INFO'] = $this->user->loyalty->getLoyaltyProgramInfo();
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
     * @throws ObjectPropertyException
     * @throws ArgumentException
     * @throws SystemException
     */
    private function getSelects(): array
    {
        //Пол пользователя
        $selects['USER_GENDER'] = ['M' => 'Мужской', 'F' => 'Женский'];

        //Пункты выдачи заказов
        $hlBlock = PickupPointTable::getList([
            'order' => ['UF_NAME' => 'ASC'],
            'select' => ['*'],
        ]);
        while ($fields = $hlBlock->Fetch()) {
            $selects['PICK_POINT'][$fields['ID']] = $fields['UF_NAME'];
        }

        //Статусы юр лица для консультантов
        $petGenders = LegalEntityTable::getFieldValues(['UF_STATUS'])['UF_STATUS'];
        foreach ($petGenders as $petGender) {
            $selects['STATUS'][$petGender['ID']] = $petGender['VALUE'];
        }

        //Типы питомцев
        $petGenders = PetTable::getFieldValues(['UF_KIND'])['UF_KIND'];
        foreach ($petGenders as $petGender) {
            $selects['PET_KIND'][$petGender['ID']] = $petGender['VALUE'];
        }

        //Породы кошек
        $hlBlock = CatBreedTable::getList([
            'order' => ['UF_BREED_CAT' => 'ASC'],
            'select' => ['*'],
        ]);
        while ($fields = $hlBlock->Fetch()) {
            $selects['CAT_BREED'][$fields['ID']] = $fields['UF_BREED_CAT'];
        }

        //Породы собак
        $hlBlock = DogBreedTable::getList([
            'order' => ['UF_BREED_DOG' => 'ASC'],
            'select' => ['*'],
        ]);
        while ($enumFields = $hlBlock->Fetch()) {
            $selects['DOG_BREED'][$enumFields['ID']] = $enumFields['UF_BREED_DOG'];
        }

        //Пол питомцев
        $petGenders = PetTable::getFieldValues(['UF_GENDER'])['UF_GENDER'];
        foreach ($petGenders as $petGender) {
            $selects['PET_GENDER'][$petGender['ID']] = $petGender['VALUE'];
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

    public function userInfoUpdateAction(array $userInfo)
    {
        //TODO:Загрузка фоток
        $props = [];

        foreach ($userInfo as $userInfoRow) {
            $props[$userInfoRow['name']] = $userInfoRow['value'];
        }

        $fields = [
            'NAME' => $props['NAME'],
            'LAST_NAME' => $props['LAST_NAME'],
            'SECOND_NAME' => $props['SECOND_NAME'],
            'PERSONAL_GENDER' => $props['PERSONAL_GENDER'],
            'PERSONAL_BIRTHDAY' => $props['PERSONAL_BIRTHDAY'],
            'EMAIL' => $props['EMAIL'],
            'PERSONAL_PHONE' => $props['PERSONAL_PHONE'],
            'PERSONAL_CITY' => $props['PERSONAL_CITY'],
            'UF_PICKUP_POINT_ID' => $props['UF_PICKUP_POINT_ID']
        ];

        (new User($GLOBALS['USER']->GetID()))->update($fields);
    }

    public function legalEntityUpdateAction($form)
    {
        //TODO:Загрузка кучи сканов
        $docs = [];

        foreach ($form as $row) {
            if ($row['name'] != 'UF_STATUS') {
                array_set($docs, $row['name'], $row['value']);
            } else {
                $props["UF_STATUS"] = $row['value'];
            }
        }

        $props['UF_USER_ID'] = $GLOBALS['USER']->GetID();
        $props['UF_CREATED_AT'] = new DateTime();
        $props['UF_DOCUMENTS'] = json_encode($docs, JSON_UNESCAPED_UNICODE);
        $props['UF_IS_ACTIVE'] = true;


        LegalEntityTable::add($props);

        //TODO: добавить модерацию (видимо переслать в ConfirmationTable)
        //TODO(?): добавить ивент хендлер, деактивирующий/удаляющий предыдущую запись после модерации
    }

    protected function preparePetForSaving(array $pet): array
    {
        global $USER;

        $props['UF_USER_ID'] = $USER->GetID();
        $props['UF_NAME'] = $pet['UF_NAME'];
        $props['UF_GENDER'] = $pet['UF_GENDER'];
        $props['UF_KIND'] = $pet['UF_KIND'];
        $props['UF_BIRTHDATE'] = new date($pet['UF_BIRTHDATE'], 'd.m.Y');

        $kinds = PetTable::getFieldValues(['UF_KIND'])['UF_KIND'];
        foreach ($kinds as $kind) {
            if ($pet['UF_KIND'] == $kind['ID']) {
                $petType = $kind['XML_ID'];

                if ($petType == 'KIND_CAT') {
                    $props['UF_BREED'] = $pet['UF_CAT_BREED'];
                } elseif ($petType == 'KIND_DOG') {
                    $props['UF_BREED'] = $pet['UF_DOG_BREED'];
                }
            }
        }

        return $props;
    }

    public function addPetAction(array $pet): ?array
    {
        $preparedPet = $this->preparePetForSaving($pet);

        return [
            'pet-id' => PetTable::add($preparedPet)->getId()
        ];
    }

    public function changePetAction(array $pet)
    {
        global $USER;

        if (!$this->canUserChangePet($USER->GetID(), $pet['ID'])) {
            $this->errorCollection[] = new \Bitrix\Main\Error('Can\'t modify other user\'s pet');

            return null;
        }

        $preparedPet = $this->preparePetForSaving($pet);

        PetTable::update($pet['ID'], $preparedPet);
    }

    public function deletePetAction(int $petId)
    {
        global $USER;

        if (!$this->canUserChangePet($USER->GetID(), $petId)) {
            $this->errorCollection[] = new \Bitrix\Main\Error('Can\'t modify other user\'s pet');

            return null;
        }

        PetTable::delete($petId);
    }

    protected function canUserChangePet(int $userId, int $petId): bool
    {
        return (bool)(new User($userId))->pets->get($petId);
    }

    //TODO смена ментора
    //TODO модерация

    public function getErrors()
    {
        $this->errorCollection->toArray();
    }

    public function getErrorByCode($code)
    {
        $this->errorCollection->getErrorByCode($code);
    }
}

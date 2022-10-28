<?php
if (!defined('B_PROLOG_INCLUDED') || !B_PROLOG_INCLUDED) {
    die();
}

use Bitrix\Main\ArgumentException;
use Bitrix\Main\Engine\Contract\Controllerable;
use Bitrix\Main\ErrorCollection;
use Bitrix\Main\Loader;
use Bitrix\Main\LoaderException;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ObjectPropertyException;
use Bitrix\Main\SystemException;
use Bitrix\Main\Type\Date;
use Bitrix\Main\Type\DateTime;
use QSoft\Entity\User;
use QSoft\Helper\PetHelper;
use QSoft\ORM\CatBreedTable;
use QSoft\ORM\DogBreedTable;
use QSoft\ORM\LegalEntityTable;
use QSoft\ORM\PetTable;
use QSoft\ORM\PickupPointTable;

class MainProfileComponent extends CBitrixComponent implements Controllerable
{
    private int $userId;
    private User $user;

    private PetHelper $petHelper;

    protected ErrorCollection $errorCollection;

    public function onPrepareComponentParams($arParams)
    {
        $this->errorCollection = new ErrorCollection();

        if ($userId = $GLOBALS['USER']->GetID()) {
            $this->userId = $userId;
        } else {
            LocalRedirect('/');
        }

        $this->checkModules();

        $this->user = new User($this->userId);

        $this->petHelper = new PetHelper;
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

        $this->arResult['pets'] = $this->petHelper->getUserPets($this->user->id);
        $this->arResult['pet_genders'] = $this->petHelper->getGenders();
        $this->arResult['pet_breeds'] = $this->petHelper->getBreeds();
        $this->arResult['pet_kinds'] = $this->petHelper->getKinds();

        $this->arResult['MENTOR_INFO'] = $this->getMentorInfo();
        //Система лояльности
        //Персональные акции
    }

    private function getMentorInfo()
    {
        $mentoInfo = CUser::GetByID($this->user->mentor->id)->Fetch();
        $mentoInfo['PERSONAL_PHOTO_URL'] = $this->user->mentor->getPhotoUrl();


        return $mentoInfo;
    }


    private function getUser()
    {
        $arUserInfo = CUser::GetByID($this->userId)->Fetch();

        if ($this->user->groups->isBuyer()) {
            $this->arResult['USER_GROUP'] = 'Покупатель';
            $this->arResult['USER_GROUP_XML'] = 'BUYER';
        } elseif ($this->user->groups->isConsultant()) {
            $this->arResult['USER_GROUP'] = 'Консультант';
            $this->arResult['USER_GROUP_XML'] = 'CONSULTANT';
        }

        if (!empty($arUserInfo['PERSONAL_PHOTO'])) {
            $arUserInfo['PERSONAL_PHOTO_URL'] = $this->user->getPhotoUrl();
        }

        if (!empty($arUserInfo['UF_LOYALTY_LEVEL'])) {
            $arUserInfo['UF_LOYALTY_LEVEL_NAME'] = $this->getLoyaltyLevelName($arUserInfo['UF_LOYALTY_LEVEL']);
        }

        return $arUserInfo;
    }

    private function getLoyaltyLevelName($loyaltyLevelId)
    {
        return (new CUserFieldEnum())
            ->GetList([], ['ID' => $loyaltyLevelId])
            ->GetNext()['VALUE'];
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
        $entityStatuses = LegalEntityTable::getFieldValues(['UF_STATUS'])['UF_STATUS'];
        foreach ($entityStatuses as $status) {
            $selects['STATUS'][$status['ID']] = $status['VALUE'];
        }

        //Типы питомцев
        $petTypes = PetTable::getFieldValues(['UF_KIND'])['UF_KIND'];
        foreach ($petTypes as $petType) {
            $selects['PET_KIND'][$petType['ID']] = $petType['VALUE'];
            $selects['PET_KIND_XML'][$petType['ID']] = $petType['XML_ID'];
        }

        //Породы кошек
        $hlBlock = CatBreedTable::getList([
            'order' => ['UF_BREED_CAT' => 'ASC'],
            'select' => ['*'],
        ]);
        while ($fields = $hlBlock->Fetch()) {
            $selects['KIND_CAT_BREED'][$fields['ID']] = $fields['UF_BREED_CAT'];
        }

        //Породы собак
        $hlBlock = DogBreedTable::getList([
            'order' => ['UF_BREED_DOG' => 'ASC'],
            'select' => ['*'],
        ]);
        while ($enumFields = $hlBlock->Fetch()) {
            $selects['KIND_DOG_BREED'][$enumFields['ID']] = $enumFields['UF_BREED_DOG'];
        }

        //Пол питомцев
        $petGenders = PetTable::getFieldValues(['UF_GENDER'])['UF_GENDER'];
        foreach ($petGenders as $petGender) {
            $selects['PET_GENDER'][$petGender['ID']] = $petGender['VALUE'];
            $selects['PET_GENDER_XML'][$petGender['ID']] = $petGender['XML_ID'];
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

    public function addPetAction(array $pet): array
    {
        return ['id' => PetTable::add($this->preparePetForSaving($pet))->getId()];
    }

    public function changePetAction(array $pet)
    {
        PetTable::update($pet['id'], $this->preparePetForSaving($pet));
    }

    public function deletePetAction(int $petId)
    {
        PetTable::delete($petId);
    }

    protected function preparePetForSaving(array $pet): array
    {
        return [
            'UF_USER_ID' => $this->userId,
            'UF_NAME' => $pet['name'],
            'UF_BIRTHDATE' => new Date($pet['birthdate']),
            'UF_GENDER' => $pet['gender']['id'],
            'UF_BREED' => $pet['breed']['id'],
            'UF_KIND' => $pet['kind']['id'],
        ];
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

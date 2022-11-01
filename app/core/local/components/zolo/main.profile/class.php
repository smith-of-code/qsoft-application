<?php
if (!defined('B_PROLOG_INCLUDED') || !B_PROLOG_INCLUDED) {
    die();
}

use Bitrix\Main\ArgumentException;
use Bitrix\Main\Context;
use Bitrix\Main\Engine\Contract\Controllerable;
use Bitrix\Main\Loader;
use Bitrix\Main\LoaderException;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ObjectPropertyException;
use Bitrix\Main\SystemException;
use Bitrix\Main\Type\Date;
use Bitrix\Main\Type\DateTime;
use Bitrix\Main\UserPhoneAuthTable;
use QSoft\Entity\User;
use QSoft\Helper\HlBlockHelper;
use QSoft\Helper\PetHelper;
use QSoft\ORM\LegalEntityTable;
use QSoft\ORM\PetTable;
use QSoft\ORM\PickupPointTable;

class MainProfileComponent extends CBitrixComponent implements Controllerable
{
    private ?int $userId;
    private User $user;

    private PetHelper $petHelper;

    public function __construct($component = null)
    {
        $this->checkModules();

        if (!$this->userId = $GLOBALS['USER']->GetID()) {
            LocalRedirect('/');
        }

        $this->user = new User($this->userId);

        $this->petHelper = new PetHelper;

        parent::__construct($component);
    }

    public function executeComponent()
    {
        try {
            $request = Context::getCurrent()->getRequest();
            if ($request->isAjaxRequest() && !empty($request->getFileList())) {
                global $APPLICATION;

                $arFile = array_first($request->getFileList()->toArray());
                if (!empty($arFile)) {
                    $pathValue = $path ?? $this->arParams['PATH'] ?? "$_SERVER[DOCUMENT_ROOT]/upload/files";
                    $fid = CFile::SaveFile($arFile, $pathValue);

                    $APPLICATION->RestartBuffer();
                    echo json_encode(['FILE_ID' => $fid]);
                    die();
                }
            }

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
        $this->arResult['cities'] = HlBlockHelper::getPreparedEnumFieldValues(PickupPointTable::getTableName(), 'UF_CITY');
        $this->arResult['personal_data'] = $this->user->getPersonalData();
        $this->arResult['user_genders'] = ['M' => 'Мужской', 'F' => 'Женский'];

        $pickupPoints = PickupPointTable::getList([
            'order' => ['UF_NAME' => 'ASC'],
            'select' => ['ID', 'UF_NAME'],
        ])->fetchAll();
        $this->arResult['pickup_points'] = array_combine(
            array_column($pickupPoints, 'ID'),
            array_column($pickupPoints, 'UF_NAME'),
        );

        if ($this->user->groups->isConsultant()) {
            $this->arResult['legal_entity'] = $this->user->legalEntity->getData();
            $this->arResult['legal_entity_types'] = HlBlockHelper::getPreparedEnumFieldValues(
                LegalEntityTable::getTableName(),
                'UF_STATUS'
            );
        }

        $this->arResult['pets'] = $this->petHelper->getUserPets($this->user->id);
        $this->arResult['pet_genders'] = $this->petHelper->getGenders();
        $this->arResult['pet_breeds'] = $this->petHelper->getBreeds();
        $this->arResult['pet_kinds'] = $this->petHelper->getKinds();

        $this->arResult['MENTOR_INFO'] = $this->getMentorInfo();
        //Система лояльности
        $this->arResult['LOYALTY_INFO'] = $this->user->loyalty->getLoyaltyProgramInfo();
        //Персональные акции
    }

    private function getMentorInfo()
    {
        $mentorInfo = CUser::GetByID($this->user->mentor->id)->Fetch();
        $mentorInfo['PERSONAL_PHOTO_URL'] = $this->user->mentor->getPhotoUrl();


        return $mentorInfo;
    }

    public function configureActions(): array
    {
        return [
            'savePersonalData' => [
                'prefilters' => []
            ],
            'sendCode' => [
                'prefilters' => []
            ],
            'verifyCode' => [
                'prefilters' => []
            ],
            'saveLegalEntityData' => [
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

    public function savePersonalDataAction(array $userInfo): array
    {
        $fields = [
            'LOGIN' => $userInfo['phone'],
            'NAME' => $userInfo['first_name'],
            'LAST_NAME' => $userInfo['last_name'],
            'SECOND_NAME' => $userInfo['without_second_name'] === 'true' ? '' : $userInfo['second_name'],
            'PERSONAL_GENDER' => $userInfo['gender'],
            'PERSONAL_BIRTHDAY' => $userInfo['birthdate'],
            'EMAIL' => $userInfo['email'],
            'PERSONAL_PHONE' => $userInfo['phone'],
            'PERSONAL_CITY' => $userInfo['city'],
            'UF_PICKUP_POINT_ID' => $userInfo['pickup_point'],
        ];

        if ($userInfo['photo_id'] && is_numeric($userInfo['photo_id'])) {
            $fields['PERSONAL_PHOTO'] = $userInfo['photo_id'];
        }

        $updateResult = $this->user->update($fields);

        if ($updateResult && $userInfo['password'] && $userInfo['confirm_password']) {
            $updateResult = $this->user->changePassword($userInfo['password'], $userInfo['confirm_password']);
        }

        return ['status' => $updateResult ? 'success' : 'error'];
    }

    public function sendCodeAction(string $phoneNumber): array
    {
        if (UserPhoneAuthTable::validatePhoneNumber($phoneNumber) !== true) {
            throw new InvalidArgumentException('Invalid phone number');
        }

        $this->user->confirmation->sendSmsConfirmation();

        return ['status' => 'success'];
    }

    public function verifyCodeAction(string $code): array
    {
        return ['status' => $this->user->confirmation->verifySmsCode($code) ? 'success' : 'error'];
    }

    public function saveLegalEntityDataAction($data): array
    {
        $result = LegalEntityTable::update($data['id'], [
            'UF_USER_ID' => $data['user_id'],
            'UF_IS_ACTIVE' => $data['active'],
            'UF_STATUS' => $data['type']['id'],
            'UF_DOCUMENTS' => json_encode($data['documents'], JSON_UNESCAPED_UNICODE),
        ]);

        return ['status' => $result->isSuccess() ? 'success' : 'error'];
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
}

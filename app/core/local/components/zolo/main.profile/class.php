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
use QSoft\Helper\CouponHelper;
use QSoft\Helper\HlBlockHelper;
use QSoft\Helper\LoyaltyProgramHelper;
use QSoft\Helper\OrderHelper;
use QSoft\Helper\PetHelper;
use QSoft\Helper\PickupPointHelper;
use QSoft\Helper\TicketHelper;
use QSoft\ORM\LegalEntityTable;
use QSoft\ORM\PetTable;
use QSoft\ORM\PickupPointTable;

class MainProfileComponent extends CBitrixComponent implements Controllerable
{
    private ?int $userId;
    private User $user;

    private PetHelper $petHelper;
    private TicketHelper $ticketHelper;
    private OrderHelper $orderHelper;
    private CouponHelper $couponHelper;
    private LoyaltyProgramHelper $loyaltyProgramHelper;
    private PickupPointHelper $pickupPointHelper;

    public function __construct($component = null)
    {
        $this->checkModules();

        if (!$this->userId = $GLOBALS['USER']->GetID()) {
            LocalRedirect('/');
        }

        $this->user = new User($this->userId);

        $this->petHelper = new PetHelper;
        $this->ticketHelper = new TicketHelper;
        $this->orderHelper = new OrderHelper;
        $this->couponHelper = new CouponHelper;
        $this->loyaltyProgramHelper = new LoyaltyProgramHelper;
        $this->pickupPointHelper = new PickupPointHelper;

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
                    $fid = CFile::SaveFile($arFile, 'dropzone');

                    $APPLICATION->RestartBuffer();
                    echo json_encode(['FILE_ID' => $fid, 'FILE_SRC' => CFile::GetPath($fid)]);
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
        $this->arResult['cities'] = $this->pickupPointHelper->getCities();
        $this->arResult['pickup_points'] = $this->pickupPointHelper->getPickupPoints();

        $this->arResult['user_genders'] = ['M' => ['name' => 'Мужской'], 'F' => ['name' => 'Женский']];

        $this->arResult['personal_data'] = $this->user->getPersonalData();
        $this->arResult['current_accounting_period'] = $this->loyaltyProgramHelper->getCurrentAccountingPeriod();
        $this->arResult['loyalty_status'] = $this->loyaltyProgramHelper->getLoyaltyStatusByPeriod(
            $this->user->id,
            $this->arResult['current_accounting_period']['from'],
            $this->arResult['current_accounting_period']['to'],
        );
        $this->arResult['orders_report'] = $this->orderHelper->getOrdersReport(
            $this->user->id,
            $this->arResult['current_accounting_period']['from'],
            $this->arResult['current_accounting_period']['to'],
        );
        $this->arResult['loyalty_level_info'] = $this->loyaltyProgramHelper->getLoyaltyLevelInfo(
            $this->arResult['personal_data']['loyalty_level']
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
        foreach ($this->arResult['pet_kinds'] as &$kind) {
            $kind['icon'] = substr(strtolower($kind['code']), 5);
        }

        $this->arResult['personal_promotions'] = $this->couponHelper->getUserCoupons($this->user->id);
        $this->arResult['promotion_orders'] = $this->orderHelper->getUserOrdersWithPersonalPromotions($this->user->id);

        $this->arResult['MENTOR_INFO'] = $this->getMentorInfo();
    }

    private function getMentorInfo()
    {
        $mentor = $this->user->getMentor();

        $mentorInfo = [];

        if (!empty($mentor)) {
            $mentorInfo = CUser::GetByID($this->user->getMentor()->id)->Fetch();
            $mentorInfo['PERSONAL_PHOTO_URL'] = $this->user->getMentor()->getPhotoUrl();
        }

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
        $ticketData = [];
        if ($userInfo['first_name'] !== $this->user->name) {
            $ticketData['NAME'] = $userInfo['first_name'];
        }
        if ($userInfo['last_name'] !== $this->user->lastName) {
            $ticketData['LAST_NAME'] = $userInfo['last_name'];
        }
        if ($userInfo['second_name'] !== $this->user->secondName) {
            $ticketData['SECOND_NAME'] = $userInfo['without_second_name'] === 'true' ? '' : $userInfo['second_name'];
        }
        if ($userInfo['gender'] !== $this->user->gender) {
            $ticketData['PERSONAL_GENDER'] = $userInfo['gender'];
        }
        if ($userInfo['photo_id'] && is_numeric($userInfo['photo_id'])) {
            $ticketData['PERSONAL_PHOTO'] = CFile::MakeFileArray($userInfo['photo_id']);
        }
        if ($userInfo['birthdate'] !== $this->user->birthday->format('d.m.Y')) {
            $ticketData['PERSONAL_BIRTHDAY'] = $userInfo['birthdate'];
        }
        if ($userInfo['email'] !== $this->user->email) {
            $ticketData['EMAIL'] = $userInfo['email'];
        }
        if ($userInfo['phone'] !== $this->user->phone) {
            $ticketData['PERSONAL_PHONE'] = $userInfo['phone'];
        }
        if ($userInfo['city'] !== $this->user->city) {
            $ticketData['PERSONAL_CITY'] = $userInfo['city'];
        }
        if ((int) $userInfo['pickup_point_id'] !==  $this->user->pickupPointId) {
            $ticketData['UF_PICKUP_POINT_ID'] = $userInfo['pickup_point_id'];
        }

        if (count($ticketData)) {
            $ticketCreated = $this->ticketHelper->createTicket(
                $this->user->id,
                TicketHelper::CHANGE_PERSONAL_DATA_CATEGORY,
                json_encode($ticketData),
            );
        }

        if ($userInfo['password'] && $userInfo['confirm_password']) {
            $passwordChanged = $this->user->changePassword($userInfo['password'], $userInfo['confirm_password']);
        }

        return [
            'ticket_created' => isset($ticketCreated) && $ticketCreated ? 'success' : 'error',
            'password_changed' => isset($passwordChanged) && $passwordChanged ? 'success' : 'error',
        ];
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
        $oldData = $this->user->legalEntity->getData();

        if ($oldData['type']['id'] !== $data['type']['id'] || $oldData['documents'] !== $data['documents']) {
            $ticketCreated = $this->ticketHelper->createTicket(
                $this->user->id,
                TicketHelper::CHANGE_LEGAL_ENTITY_DATA_CATEGORY,
                json_encode($data, JSON_UNESCAPED_UNICODE),
            );
        }

        return ['status' => isset($ticketCreated) && $ticketCreated ? 'success' : 'error'];
    }

    public function addPetAction(array $pet): array
    {
        return ['id' => PetTable::add($this->preparePetForSaving($pet))->getId()];
    }

    public function changePetAction(array $pet)
    {
        PetTable::update($pet['id'], $this->preparePetForSaving($pet));

        return $pet;
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

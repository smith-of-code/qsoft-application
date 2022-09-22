<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die;

use Bitrix\Main\Application;
use Bitrix\Main\ArgumentException;
use Bitrix\Main\Engine\Contract\Controllerable;
use Bitrix\Main\GroupTable;
use Bitrix\Main\ObjectPropertyException;
use Bitrix\Main\SystemException;
use Bitrix\Main\Type\Date;
use Bitrix\Main\UserPhoneAuthTable;
use Bitrix\Main\UserTable;
use QSoft\ORM\ConfirmationTable;
use QSoft\ORM\PetTable;
use QSoft\Service\ConfirmationService;

class SystemAuthRegistrationComponent extends CBitrixComponent implements Controllerable
{
    private const SESSION_KEY = 'registrationData';

    private const REGISTRATION_TYPES = [
        'buyer' => [
            'name' => 'buyer',
            'steps' => [
                'personal_data',
                'pets_data',
                'choose_contact',
                'set_password',
                'final',
            ],
        ],
        'consultant' => [
            'name' => 'consultant',
            'steps' => [
                'personal_data',
                'pets_data',
                'choose_mentor',
                'legal_entity_data',
                'set_password',
                'final',
            ],
        ],
    ];

    private const FILE_FIELDS = [
        'photo',
        'passport',
        'tax_registration_certificate',
        'usn_notification',
        'ip_registration_certificate',
        'llc_charter',
        'llc_members',
        'ceo_appointment',
        'llc_registration_certificate',
        'procuration',
    ];

    public function onPrepareComponentParams($arParams)
    {
        $arParams += array_flip(array_map(static fn($item) => strtoupper($item), array_flip($_GET)));
        return parent::onPrepareComponentParams($arParams);
    }

    public function executeComponent()
    {
        if (isset($this->arParams['USER_ID']) && isset($this->arParams['CONFIRM_CODE'])) {
            $this->confirmEmail();
        }

        $this->arResult = $this->getRegisterData();

        if (!$this->arResult) {
            $queryType = Application::getInstance()->getContext()->getRequest()->getQuery('type');
            $registrationType = self::REGISTRATION_TYPES[$queryType] ?? array_first(self::REGISTRATION_TYPES);

            $this->arResult = [
                'type' => $registrationType['name'],
                'steps' => $registrationType['steps'],
                'currentStep' => $registrationType['steps'][0],
            ];
        }

        $this->IncludeComponentTemplate();
    }

    private function confirmEmail()
    {
        $confirmResult = (new ConfirmationService)->verifyEmailCode(
            $this->arParams['USER_ID'],
            $this->arParams['CONFIRM_CODE'],
            ConfirmationTable::TYPES['confirm_email'],
        );

        if ($confirmResult) {
            $user = new CUser;
            $user->Update($this->arParams['USER_ID'], ['ACTIVE' => 'Y']);
            $user->Authorize($this->arParams['USER_ID']);
        }

        LocalRedirect('/');
    }

    public function configureActions(): array
    {
        return [
            'saveStep' => [
                'prefilters' => [],
            ],
            'sendPhoneCode' => [
                'prefilters' => [],
            ],
            'verifyPhoneCode' => [
                'prefilters' => [],
            ],
            'register' => [
                'prefilters' => [],
            ],
        ];
    }

    /**
     * @param string $direction - "next"|"previous"
     * @param array $data
     * @return array
     * @throws ArgumentException
     * @throws ObjectPropertyException
     * @throws SystemException
     */
    public function saveStepAction(string $direction, array $data): array
    {
        $registrationData = $this->getRegisterData();

        $registrationType = self::REGISTRATION_TYPES[$data['type']];
        $currentStepIndex = array_search($data['currentStep'], $registrationType['steps']);
        if ($direction === 'next') {
            $data['currentStep'] = $registrationType['steps'][$currentStepIndex + 1];
        } else {
            $registrationData['currentStep'] = $registrationType['steps'][$currentStepIndex - 1];

            return $this->setRegisterData($registrationData);
        }

        foreach ($data as $field => $value) {
            if ($field === 'email' && UserTable::getRow(['filter' => ['=EMAIL' => $value]])) {
                throw new InvalidArgumentException('User with this email already exist');
            }
            if ($field === 'mentor_id') {
                try {
                    UserTable::getById($value);
                } catch (ObjectPropertyException|ArgumentException|SystemException $e) {
                    throw new InvalidArgumentException('User not found');
                }
            }
            if (in_array($field, self::FILE_FIELDS)) {
                // TODO: Хз ещё в каком виду будут приходить файлы
            }
        }

        return $this->setRegisterData(array_merge($registrationData, $data));
    }

    public function sendPhoneCodeAction(string $phoneNumber): array
    {
        if (UserPhoneAuthTable::validatePhoneNumber($phoneNumber) !== true) {
            throw new InvalidArgumentException('Invalid phone number');
        }

        $password = uniqid();
        $user = new CUser;
        $result = $user->Register(
            $phoneNumber,
            '',
            '',
            $password,
            $password,
            '',
        );

        if ($result['TYPE'] === 'ERROR') {
            return [
                'status' => 'error',
                'message' => $result['MESSAGE'],
            ];
        }

        $user->Update($result['ID'], ['ACTIVE' => 'N']);
        $user->Logout();

        $this->setRegisterData(array_merge($this->getRegisterData(), [
            'password' => $password,
            'user_id' => $result['ID'],
        ]));

        (new ConfirmationService)->sendSmsConfirmation($result['ID']);

        return ['status' => 'success'];
    }

    public function verifyPhoneCodeAction(string $code): array
    {
        $verifyResult = (new ConfirmationService)->verifySmsCode($this->getRegisterData()['user_id'], $code);

        return ['status' => $verifyResult ? 'success' : 'error'];
    }

    public function registerAction(array $data): array
    {
        $user = new CUser;
        $registrationData = $this->getRegisterData();

        $userGroupId = GroupTable::getRow([
            'filter' => [
                '=STRING_ID' => $registrationData['type'],
            ],
            'select' => ['ID'],
        ])['ID'];

        // TODO PHOTO, legal entity
        $user->Update($registrationData['user_id'], [
            'NAME' => $data['first_name'],
            'LAST_NAME' => $data['last_name'],
            'SECOND_NAME' => $data['second_name'],
            'EMAIL' => $data['email'],
            'PERSONAL_BIRTHDAY' => new Date($data['birthday']),
            'PERSONAL_GENDER' => $data['gender'],
            'PERSONAL_CITY' => $data['city'],
            'GROUP_ID' => [$userGroupId],
            'UF_MENTOR_ID' => $data['mentor_id'],
            'UF_AGREE_WITH_PERSONAL_DATA_PROCESSING' => $data['agree_with_personal_data_processing'],
            'UF_AGREE_WITH_TERMS_OF_USE' => $data['agree_with_terms_of_use'],
            'UF_AGREE_WITH_COMPANY_RULES' => $data['agree_with_company_rules'],
            'UF_AGREE_TO_RECEIVE_INFORMATION_ABOUT_PROMOTIONS' => $data['agree_to_receive_information__about_promotions'],
        ]);

        $user->ChangePassword(
            UserTable::getRowById($registrationData['user_id'])['LOGIN'],
            '',
            $data['password'],
            $data['confirm_password'],
            SITE_ID,
            '',
            0,
            true,
            '',
            $registrationData['password'],
        );

        foreach ($data['pets'] as $pet) {
            PetTable::add([
                'UF_USER_ID' => $registrationData['user_id'],
                'UF_NAME' => $pet['name'],
                'UF_KIND' => $pet['kind'],
                'UF_BREED' => $pet['breed'],
                'UF_GENDER' => $pet['gender'],
                'UF_BIRTHDATE' => new Date($pet['birthday']),
            ]);
        }

        (new ConfirmationService)->sendEmailConfirmation($registrationData['user_id']);

        return ['status' => 'success'];
    }

    public function getRegisterData(): array
    {
        if (Application::getInstance()->getSession()->has(self::SESSION_KEY)) {
            return Application::getInstance()->getSession()->get(self::SESSION_KEY);
        }
        return [];
    }

    private function setRegisterData(array $data): array
    {
        Application::getInstance()->getSession()->set(self::SESSION_KEY, $data);
        return $data;
    }
}
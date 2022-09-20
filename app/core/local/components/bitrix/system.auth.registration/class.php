<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die;

use Bitrix\Main\Application;
use Bitrix\Main\ArgumentException;
use Bitrix\Main\Engine\Contract\Controllerable;
use Bitrix\Main\ObjectPropertyException;
use Bitrix\Main\SystemException;
use Bitrix\Main\Type\Date;
use Bitrix\Main\UserPhoneAuthTable;
use Bitrix\Main\UserTable;
use QSoft\ORM\PetTable;
use QSoft\Service\ConfirmationService;

class SystemAuthRegistrationComponent extends CBitrixComponent implements Controllerable
{
    private const SESSION_KEY = 'registrationData';

    private const REGISTRATION_TYPES = [
        'user' => [
            'name' => 'user',
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

    public function executeComponent()
    {
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
     */
    public function saveStepAction(string $direction, array $data): array
    {
        $registrationData = $this->getRegisterData();

        $registrationType = self::REGISTRATION_TYPES[$data['type']];
        $currentStepIndex = array_search($data['currentStep'], $registrationType['steps']);
        if ($direction === 'next') {
            $data['currentStep'] = $registrationType['steps'][$currentStepIndex + 1];
        } else {
            $data['currentStep'] = $registrationType['steps'][$currentStepIndex - 1];
        }

        if ($direction === 'previous') {
            return $registrationData;
        }

        foreach ($data as $field => $value) {
            if (($field === 'contact_id' || $field === 'mentor_id')) {
                try {
                    UserTable::getById($field);
                } catch (ObjectPropertyException|ArgumentException|SystemException $e) {
                    throw new InvalidArgumentException('User not found');
                }
            }
            if (in_array($field, self::FILE_FIELDS)) {
                // TODO: Хз ещё в каком виду будут приходить файлы
            }
        }

        $registrationData = array_merge($registrationData, $data);
        Application::getInstance()->getSession()->set('registrationData', $registrationData);

        return $registrationData;
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

        return [
            'status' => $result['TYPE'] === 'OK' ? 'success' : 'error',
            'message' => $result['MESSAGE'],
        ];
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

        // TODO "Я согласен на обработку персональных данных", "Я согласен с условиями пользования сайтом"
        // TODO "Я согласен с правилами компании", "Я согласен на получение информации о продуктах, спецпредложениях и акциях"
        // TODO PHOTO, MENTOR_ID, legal entity
        $userUpdateResult = $user->Update($registrationData['user_id'], [
            'NAME' => $data['first_name'],
            'LAST_NAME' => $data['last_name'],
            'SECOND_NAME' => $data['second_name'],
            'EMAIL' => $data['email'],
            'PERSONAL_BIRTHDAY' => new Date($data['birthday']),
            'PERSONAL_GENDER' => $data['gender'],
            'PERSONAL_CITY' => $data['city'],
        ]);

        $passwordChangeResult = $user->ChangePassword(
            $registrationData['user_id'],
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

        return ['status' => 'success', 'passwordChangeResult' => $passwordChangeResult, 'userUpdateResult' => $userUpdateResult];
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



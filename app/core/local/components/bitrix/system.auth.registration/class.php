<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die;

use Bitrix\Main\Application;
use Bitrix\Main\ArgumentException;
use Bitrix\Main\Engine\Contract\Controllerable;
use Bitrix\Main\GroupTable;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ObjectPropertyException;
use Bitrix\Main\SystemException;
use Bitrix\Main\Type\Date;
use Bitrix\Main\UserPhoneAuthTable;
use Bitrix\Main\UserTable;
use QSoft\Helper\HlBlockHelper;
use QSoft\ORM\ConfirmationTable;
use QSoft\ORM\PetTable;
use QSoft\ORM\PickupPointTable;
use QSoft\Service\ConfirmationService;
use QSoft\Service\UserGroupsService;
use QSoft\Service\UserService;

Loc::loadMessages(__FILE__);

class SystemAuthRegistrationComponent extends CBitrixComponent implements Controllerable
{
    private const SESSION_KEY = 'registrationData';

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
        $registrationTypes = $this->getRegistrationTypes();

        if (isset($this->arParams['USER_ID']) && isset($this->arParams['CONFIRM_CODE'])) {
            $this->confirmEmail();
        }

        $this->arResult = $this->getRegisterData();

        if (!$this->arResult || $this->arResult['type'] !== $registrationTypes[$queryType]) {
            $queryType = Application::getInstance()->getContext()->getRequest()->getQuery('type');
            $registrationType = $registrationTypes[$queryType] ?? array_first($registrationTypes);

            $this->arResult = [
                'type' => $registrationType['name'],
                'pet_kinds' => HlBlockHelper::getEnumFieldValues(PetTable::getTableName(), 'UF_KIND'),
                'pet_genders' => HlBlockHelper::getEnumFieldValues(PetTable::getTableName(), 'UF_GENDER'),
                'cities' => HlBlockHelper::getEnumFieldValues(PickupPointTable::getTableName(), 'UF_CITY'),
                'steps' => $registrationType['steps'],
                'currentStep' => $registrationType['steps'][0]['code'],
            ];
        }

        $this->IncludeComponentTemplate();
    }

    private function getRegistrationTypes(): array
    {
        return [
            'buyer' => [
                'name' => 'buyer',
                'steps' => [
                    [
                        'code' => 'personal_data',
                        'name' => Loc::getMessage('PERSONAL_DATA_STEP'),
                    ],
                    [
                        'code' => 'pets_data',
                        'name' => Loc::getMessage('PETS_DATA_STEP'),
                    ],
                    [
                        'code' => 'choose_mentor',
                        'name' => Loc::getMessage('CHOOSE_CONTACT_STEP'),
                    ],
                    [
                        'code' => 'set_password',
                        'name' => Loc::getMessage('SET_PASSWORD_STEP'),
                    ],
                    ['code' => 'final'],
                ],
            ],
            'consultant' => [
                'name' => 'consultant',
                'steps' => [
                    [
                        'code' => 'personal_data',
                        'name' => Loc::getMessage('PERSONAL_DATA_STEP'),
                    ],
                    [
                        'code' => 'pets_data',
                        'name' => Loc::getMessage('PETS_DATA_STEP'),
                    ],
                    [
                        'code' => 'choose_mentor',
                        'name' => Loc::getMessage('CHOOSE_MENTOR_STEP'),
                    ],
                    [
                        'code' => 'legal_entity_data',
                        'name' => Loc::getMessage('LEGAL_ENTITY_DATA_STEP'),
                    ],
                    [
                        'code' => 'set_password',
                        'name' => Loc::getMessage('SET_PASSWORD_STEP'),
                    ],
                    ['code' => 'final'],
                ],
            ],
        ];
    }

    private function confirmEmail()
    {
        $confirmResult = (new ConfirmationService)->verifyEmailCode(
            $this->arParams['USER_ID'],
            $this->arParams['CONFIRM_CODE'],
            ConfirmationTable::TYPES['confirm_email'],
        );

        if ($confirmResult) {
            (new UserService)->activate($this->arParams['USER_ID']);
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

        $registrationType = $this->getRegistrationTypes()[$data['type']];
        $currentStepIndex = array_search($data['currentStep'], array_column($registrationType['steps'], 'code'));
        if ($direction === 'next') {
            $data['currentStep'] = $registrationType['steps'][$currentStepIndex + 1]['code'];
        } else {
            $registrationData['currentStep'] = $registrationType['steps'][$currentStepIndex - 1]['code'];

            return $this->setRegisterData($registrationData);
        }

        foreach ($data as $field => &$value) {
            if ($field === 'email' && UserTable::getRow(['filter' => ['=EMAIL' => $value]])) {
                throw new InvalidArgumentException('User with this email already exist');
            } else if ($field === 'mentor_id' && $value) {
                try {
                    if (!(new UserGroupsService)->isConsultant($value)) {
                        throw new InvalidArgumentException('Mentor not found');
                    }
                } catch (ObjectPropertyException|ArgumentException|SystemException $e) {
                    throw new InvalidArgumentException('Mentor not found');
                }
            } else if (in_array($field, self::FILE_FIELDS) && !$value['src']) {
                $file = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $value['data']));
                $filePath = "/upload/register/$field" . uniqid() . $value['name'];
                file_put_contents("$_SERVER[DOCUMENT_ROOT]$filePath", $file);
                $arFile = CFile::MakeFileArray("$_SERVER[DOCUMENT_ROOT]$filePath");
                $fileId = CFile::SaveFile($arFile, "$_SERVER[DOCUMENT_ROOT]$filePath");
                $value = [
                    'id' => $fileId,
                    'src' => $filePath,
                ];
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

        $this->setRegisterData([
            'password' => $password,
            'user_id' => $result['ID'],
        ]);

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
            'PERSONAL_BIRTHDAY' => new Date($data['birthdate']),
            'PERSONAL_GENDER' => $data['gender'],
            'PERSONAL_CITY' => $data['cities'][$data['city']],
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
                'UF_KIND' => $pet['type'],
                'UF_BREED' => $pet['breed'],
                'UF_GENDER' => $pet['gender'],
                'UF_BIRTHDATE' => new Date($pet['birthdate']),
            ]);
        }

        (new ConfirmationService)->sendEmailConfirmation($registrationData['user_id']);

        return ['status' => 'success'];
    }

    public function getRegisterData(): array
    {
//        Application::getInstance()->getSession()->remove(self::SESSION_KEY);
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
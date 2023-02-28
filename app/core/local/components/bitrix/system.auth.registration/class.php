<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die;

use Bitrix\Main\Application;
use Bitrix\Main\ArgumentException;
use Bitrix\Main\Engine\ActionFilter\Authentication;
use Bitrix\Main\Engine\ActionFilter\Csrf;
use Bitrix\Main\Engine\Contract\Controllerable;
use Bitrix\Main\GroupTable;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ObjectException;
use Bitrix\Main\ObjectPropertyException;
use Bitrix\Main\SystemException;
use Bitrix\Main\Type\Date;
use Bitrix\Main\UserPhoneAuthTable;
use Bitrix\Main\UserTable;
use QSoft\Entity\User;
use QSoft\Helper\BuyerLoyaltyProgramHelper;
use QSoft\Helper\ConsultantLoyaltyProgramHelper;
use QSoft\Helper\HlBlockHelper;
use QSoft\Helper\PetHelper;
use QSoft\ORM\ConfirmationTable;
use QSoft\ORM\Decorators\EnumDecorator;
use QSoft\ORM\LegalEntityTable;
use QSoft\ORM\PetTable;
use QSoft\ORM\PickupPointTable;
use QSoft\Service\UserGroupsService;

Loc::loadMessages(__FILE__);

class SystemAuthRegistrationComponent extends CBitrixComponent implements Controllerable
{
    private const SESSION_KEY = 'registrationData';

    public const FILE_FIELDS = [
        'photo',
        'passport',
        'tax_registration_certificate',
        'personal_tax_registration_certificate',
        'bank_details',
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

        $queryType = Application::getInstance()->getContext()->getRequest()->getQuery('type');
        if (!$this->arResult || ($queryType && $this->arResult['type'] !== $registrationTypes[$queryType]['name'])) {
            $registrationType = $registrationTypes[$queryType] ?? array_first($registrationTypes);

            $this->arResult = [
                'type' => $registrationType['name'],
                'pet_kinds' => HlBlockHelper::getEnumFieldValues(PetTable::getTableName(), 'UF_KIND'),
                'pet_genders' => HlBlockHelper::getEnumFieldValues(PetTable::getTableName(), 'UF_GENDER'),
                'breeds' => (new PetHelper)->getBreeds(),
                'cities' => HlBlockHelper::getEnumFieldValues(PickupPointTable::getTableName(), 'UF_CITY'),
                'steps' => $registrationType['steps'],
                'currentStep' => $registrationType['steps'][0]['code'],
                'default_pet' => [
                    'type' => 'dog',
                    'gender' => 'man',
                ],
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
                        'index' => 1,
                        'code' => 'personal_data',
                        'name' => Loc::getMessage('PERSONAL_DATA_STEP'),
                    ],
                    [
                        'index' => 3,
                        'code' => 'pets_data',
                        'name' => Loc::getMessage('PETS_DATA_STEP'),
                    ],
                    [
                        'index' => 2,
                        'code' => 'choose_mentor',
                        'name' => Loc::getMessage('CHOOSE_CONTACT_STEP'),
                    ],
                    [
                        'index' => 5,
                        'code' => 'set_password',
                        'name' => Loc::getMessage('SET_PASSWORD_STEP'),
                    ],
                    [
                        'index' => 6,
                        'code' => 'final',
                    ],
                ],
            ],
            'consultant' => [
                'name' => 'consultant',
                'steps' => [
                    [
                        'index' => 1,
                        'code' => 'personal_data',
                        'name' => Loc::getMessage('PERSONAL_DATA_STEP'),
                    ],
                    [
                        'index' => 2,
                        'code' => 'pets_data',
                        'name' => Loc::getMessage('PETS_DATA_STEP'),
                    ],
                    [
                        'index' => 3,
                        'code' => 'choose_mentor',
                        'name' => Loc::getMessage('CHOOSE_MENTOR_STEP'),
                    ],
                    [
                        'index' => 4,
                        'code' => 'legal_entity_data',
                        'name' => Loc::getMessage('LEGAL_ENTITY_DATA_STEP'),
                    ],
                    [
                        'index' => 5,
                        'code' => 'set_password',
                        'name' => Loc::getMessage('SET_PASSWORD_STEP'),
                    ],
                    [
                        'index' => 6,
                        'code' => 'final',
                    ],
                ],
            ],
        ];
    }

    private function confirmEmail()
    {
        $user = new User($this->arParams['USER_ID']);
        $confirmResult = $user->confirmation->verifyEmailCode(
            $this->arParams['CONFIRM_CODE'],
            ConfirmationTable::TYPES['confirm_email'],
        );

        if ($confirmResult && $user->activate()) {
            LocalRedirect('/personal');
        } else {
            LocalRedirect('/');
        }
    }

    public function configureActions(): array
    {
        return [
            'saveStep' => [
                '-prefilters' => [
                    Csrf::class,
                    Authentication::class,
                ],
            ],
            'sendPhoneCode' => [
                '-prefilters' => [
                    Csrf::class,
                    Authentication::class,
                ],
            ],
            'verifyPhoneCode' => [
                '-prefilters' => [
                    Csrf::class,
                    Authentication::class,
                ],
            ],
            'register' => [
                '-prefilters' => [
                    Csrf::class,
                    Authentication::class,
                ],
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
            if ($field === 'email' && UserTable::getRow(['filter' => ['=EMAIL' => $value]])) { // Проверка email

                return ['status' => 'error', 'message' => 'Пользователь с таким email уже существует'];

            } else if ($field === 'mentor_id' && $data['without_mentor_id'] !== 'true') { // Проверка ID наставника

                try {
                    if (!is_numeric($value) || (int) $value <= 0) {
                        return ['status' => 'error', 'message' => 'Некорректный ID'];
                    }
                    $mentor = new User($value);
                    if (!$mentor->active || !$mentor->groups->isConsultant()) {
                        return ['status' => 'error', 'message' => 'Указанный пользователь не может быть наставником'];
                    }
                } catch (\Exception $e) {
                    return ['status' => 'error', 'message' => 'Такого пользователя не существует'];
                }

            } else if (in_array($field, self::FILE_FIELDS) && !$value['src']) { // Обработка файлов

                if (!empty($value['files'])) {
                    foreach ($value['files'] as &$file) {
                        $file['src'] = CFile::GetPath($file['id']);
                    }
                    $value = $value['files'];
                } else {
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
        }

        if (!$data['pets']) {
            $data['pets'] = [];
        }

        return $this->setRegisterData(array_merge($registrationData, $data));
    }

    public function sendPhoneCodeAction(string $phoneNumber): array
    {
        if (UserPhoneAuthTable::validatePhoneNumber($phoneNumber) !== true) {
            return ['status' => 'error', 'message' => 'Невалидный номер телефона'];
        }
        if (UserTable::getCount(['PERSONAL_PHONE' => $phoneNumber])) {
            return ['status' => 'error', 'message' => 'Пользователь с таким номером телефона уже существует'];
        }

        $this->setRegisterData(['phone' => $phoneNumber]);

        (new User)->confirmation->sendSmsConfirmation($phoneNumber);

        return ['status' => 'success'];
    }

    public function verifyPhoneCodeAction(string $code): array
    {
        $verifyResult = (new User)->confirmation->verifySmsCode($code);

        return ['status' => $verifyResult ? 'success' : 'error'];
    }

    public function registerAction(array $data): array
    {
        try {
            $recaptcha = new QSoft\Common\Recaptcha();
            $response = $recaptcha->isValidResponse($data['captcha']);
            if (!$response) {
                throw new Exception('Капча не пройдена');
            }
        } catch (\Exception $e) {
            throw new Exception('Ошибка проверки капчи');
        }

        $phone = normalizePhoneNumber($data['phone']);
        $email = $data['email'];

        if (empty($phone)) {
            throw new Exception('Не указан номер телефона');
        }

        if (empty($email)) {
            throw new Exception('Не указан адрес электронной почты');
        }

        $searchResult = UserTable::getCount([
            [
                'LOGIC' => 'OR',
                ['=PERSONAL_PHONE' => $phone],
                ['=EMAIL' => $email],
            ],
        ]);

        if ($searchResult) {
            throw new Exception('Такой пользователь уже существует');
        }

        $user = new CUser;
        $registrationData = $this->getRegisterData();

        $loyaltyProgramHelper = $registrationData['type'] === 'consultant' ? new ConsultantLoyaltyProgramHelper : new BuyerLoyaltyProgramHelper;
        $firstLevel = $loyaltyProgramHelper->getLowestLevel();
        $levelsIDs = $loyaltyProgramHelper->getLevelsIDs();

        $userGroupId = GroupTable::getRow([
            'filter' => [
                '=STRING_ID' => $registrationData['type'],
            ],
            'select' => ['ID'],
        ])['ID'];

        $result = $user->Register(
            uniqid('user_', true),
            $data['first_name'],
            $data['last_name'],
            $data['password'],
            $data['confirm_password'],
            $data['email'],
        );
        $user->Logout();
        $user->Update($result['ID'], [
            'NAME' => $data['first_name'],
            'LAST_NAME' => $data['last_name'],
            'SECOND_NAME' => $data['second_name'],
            'EMAIL' => $data['email'],
            'PERSONAL_BIRTHDAY' => new Date($data['birthdate']),
            'PERSONAL_PHOTO' => $data['photo'] ? CFile::MakeFileArray($data['photo']['id']) : null,
            'PERSONAL_PHONE' => normalizePhoneNumber($data['phone']),
            'PERSONAL_GENDER' => $data['gender'],
            'PERSONAL_CITY' => array_first(array_filter(
                $data['cities'],
                static fn (array $city): bool => $city['XML_ID'] === $data['city'],
            ))['VALUE'],
            'GROUP_ID' => [$userGroupId],
            'UF_MENTOR_ID' => $data['mentor_id'],
            'UF_LOYALTY_LEVEL' => $levelsIDs[$firstLevel],
            'UF_AGREE_WITH_PERSONAL_DATA_PROCESSING' => $data['agree_with_personal_data_processing'] === 'true',
            'UF_AGREE_WITH_TERMS_OF_USE' => $data['agree_with_terms_of_use'] === 'true',
            'UF_AGREE_WITH_COMPANY_RULES' => $data['agree_with_company_rules'] === 'true',
            'UF_AGREE_TO_RECEIVE_INFORMATION_ABOUT_PROMOTIONS' => $data['agree_to_receive_information__about_promotions'] === 'true',
        ]);

        $kinds = HlBlockHelper::getPreparedEnumFieldValues(PetTable::getTableName(), 'UF_KIND');
        $kinds = array_combine(array_column($kinds, 'code'), $kinds);
        $genders = HlBlockHelper::getPreparedEnumFieldValues(PetTable::getTableName(), 'UF_GENDER');
        $genders = array_combine(array_column($genders, 'code'), $genders);
        foreach ($data['pets'] as $pet) {
            if ($pet) {
                PetTable::add([
                    'UF_USER_ID' => $result['ID'],
                    'UF_NAME' => $pet['name'],
                    'UF_KIND' => $kinds[$pet['type']]['id'],
                    'UF_BREED' => $pet['breed'],
                    'UF_GENDER' => $genders[$pet['gender']]['id'],
                    'UF_BIRTHDATE' => new Date($pet['birthdate']),
                ]);
            }
        }

        if ($data['status']) {
            $documents = [
                'nationality' => $data['nationality'],
                'passport_series' => $data['passport_series'],
                'passport_number' => $data['passport_number'],
                'who_got' => $data['who_got'],
                'getting_date' => $data['getting_date'],
                'passport' => $data['passport'],
                'register_locality' => $data['register_locality'],
                'register_street' => $data['register_street'],
                'register_house' => $data['register_house'],
                'register_apartment' => $data['register_apartment'],
                'register_postal_code' => $data['register_postal_code'],
                'living_locality' => $data['living_locality'] ?? $data['register_locality'],
                'living_street' => $data['living_street'] ?? $data['register_street'],
                'living_house' => $data['living_house'] ?? $data['register_house'],
                'living_apartment' => $data['living_apartment'] ?? $data['register_apartment'],
                'living_postal_code' => $data['living_postal_code'] ?? $data['register_postal_code'],
                'without_living' => (bool) $data['living_locality'],
            ];

            if ($data['status'] === 'self_employed') {
                $documents += [
                    'tin' => $data['tin'],
                    'tax_registration_certificate' => $data['tax_registration_certificate'],
                    'bank_name' => $data['bank_name'],
                    'bic' => $data['bic'],
                    'checking_account' => $data['checking_account'],
                    'correspondent_account' => $data['correspondent_account'],
                    'bank_details' => $data['bank_details'],
                    'personal_tax_registration_certificate' => $data['personal_tax_registration_certificate'],
                ];
            } else if ($data['status'] === 'ltc') {
                $documents += [
                    'ltc_full_name' => $data['ltc_full_name'],
                    'ltc_short_name' => $data['ltc_short_name'],
                    'ogrn' => $data['ogrn'],
                    'tin' => $data['tin'],
                    'nds_payer' => $data['nds_payer_ltc'],
                    'tax_registration_certificate' => $data['tax_registration_certificate'],
                    'usn_notification' => $data['usn_notification'],
                    'kpp' => $data['kpp'],
                    'llc_charter' => $data['llc_charter'],
                    'llc_members' => $data['llc_members'],
                    'ceo_appointment' => $data['ceo_appointment'],
                    'llc_registration_certificate' => $data['llc_registration_certificate'],
                    'bank_name' => $data['bank_name'],
                    'bic' => $data['bic'],
                    'checking_account' => $data['checking_account'],
                    'correspondent_account' => $data['correspondent_account'],
                    'bank_details' => $data['bank_details'],
                    'ltc_locality' => $data['ltc_locality'],
                    'ltc_street' => $data['ltc_street'],
                    'ltc_address_1' => $data['ltc_address_1'],
                    'ltc_address_2' => $data['ltc_address_2'],
                    'ltc_postal_code' => $data['ltc_postal_code'],
                ];

                if ($data['need_proxy']) {
                    $documents['procuration'] = $data['procuration'];
                }
            } else if ($data['status'] === 'ip') {
                $documents += [
                    'ip_name' => $data['ip_name'],
                    'tin' => $data['tin'],
                    'nds_payer' => $data['nds_payer_ip'],
                    'tax_registration_certificate' => $data['tax_registration_certificate'],
                    'usn_notification' => $data['usn_notification'],
                    'ogrnip' => $data['ogrnip'],
                    'ip_registration_certificate' => $data['ip_registration_certificate'],
                    'bank_name' => $data['bank_name'],
                    'bic' => $data['bic'],
                    'checking_account' => $data['checking_account'],
                    'correspondent_account' => $data['correspondent_account'],
                    'bank_details' => $data['bank_details'],
                ];
            }

            LegalEntityTable::add([
                'UF_USER_ID' => $result['ID'],
                'UF_STATUS' => EnumDecorator::prepareField('UF_STATUS', LegalEntityTable::STATUSES[$data['status']]),
                'UF_IS_ACTIVE' => true,
                'UF_DOCUMENTS' => json_encode($documents, JSON_UNESCAPED_UNICODE),
            ]);
        }

        (new User($result['ID']))->confirmation->sendEmailConfirmation('NEW_USER_CONFIRM');

        $this->setRegisterData(array_merge($registrationData, ['currentStep' => 'final']));

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
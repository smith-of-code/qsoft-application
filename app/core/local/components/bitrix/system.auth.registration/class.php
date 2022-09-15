<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die;

/**
 * Bitrix vars
 * @global CUser $USER
 * @global CMain $APPLICATION
 */

use Bitrix\Main\Application;
use Bitrix\Main\ArgumentException;
use Bitrix\Main\Engine\Contract\Controllerable;
use Bitrix\Main\ObjectPropertyException;
use Bitrix\Main\SystemException;
use Bitrix\Main\UserTable;

class CSystemAuthRegistrationComponent extends CBitrixComponent implements Controllerable
{
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
        $session = Application::getInstance()->getSession();
        if ($session->has('registrationData')) {
            $this->arResult = Application::getInstance()->getSession()->get('registrationData');
        } else {
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
            'checkPhoneCode' => [
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
        $registrationData = [];
        if (Application::getInstance()->getSession()->has('registrationData')) {
            $registrationData = Application::getInstance()->getSession()->get('registrationData');
        }

        $registrationType = self::REGISTRATION_TYPES[$data['type']];
        $currentStepIndex = array_search($data['currentStep'], $registrationType['steps']);
        if ($direction === 'next') {
            $data['currentStep'] = $registrationType['steps'][$currentStepIndex + 1];
        } else {
            $data['currentStep'] = $registrationType['steps'][$currentStepIndex - 1];
        }

        foreach ($data as $field => $value) {
            if (($field === 'contact_id' || $field === 'mentor_id')) {
                try {
                    // TODO: Построить какую-нибуть вменяемую ORM с префильтрами по активности и тд
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

    public function sendPhoneCodeAction(string $phone): array
    {
        return ['status' => 'success'];
    }

    public function checkPhoneCodeAction(string $code): array
    {
        return ['status' => 'success'];
    }

    public function registerAction(array $data): array
    {
        return ['status' => 'success'];
    }
}



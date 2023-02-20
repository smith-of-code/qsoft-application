<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die;

use Bitrix\Main\ArgumentException;
use Bitrix\Main\Engine\ActionFilter\Authentication;
use Bitrix\Main\Engine\ActionFilter\Csrf;
use Bitrix\Main\Engine\Contract\Controllerable;
use Bitrix\Main\ObjectPropertyException;
use Bitrix\Main\SystemException;
use Bitrix\Main\UserTable;
use Psr\Log\LogLevel;
use QSoft\Entity\User;
use QSoft\Logger\Logger;
use QSoft\Service\ConfirmationService;

class SystemAuthForgotPasswordComponent extends \CBitrixComponent implements Controllerable
{
    public function executeComponent(): void
    {
        $this->includeComponentTemplate();
    }

    public function configureActions(): array
    {
        return [
            'sendEmailMessage' => [
                '-prefilters' => [
                    Csrf::class,
                    Authentication::class,
                ],
            ],
        ];
    }

    /**
     * @param string $login - User login or email
     * @param string $captcha
     * @return array
     * @throws ArgumentException
     * @throws ObjectPropertyException
     * @throws SystemException
     */
    public function sendEmailMessageAction(string $login, string $captcha = ''): array
    {
        try {
            $recaptcha = new QSoft\Common\Recaptcha();
            $response = $recaptcha->isValidResponse($captcha);
            if (!$response) {
                $error = new Exception('Recaptcha not passed');
                Logger::createFormatedLog(__CLASS__, LogLevel::ERROR, null, $error);

                throw $error;
            }
        } catch (\Exception $e) {
            $error = new Exception('Recaptcha error');
            Logger::createFormatedLog(__CLASS__, LogLevel::ERROR, null, $error);
 
            throw $error;
        }

        $user = UserTable::getRow([
            'filter' => [
                'LOGIC' => 'OR',
                ['=PERSONAL_PHONE' => normalizePhoneNumber($login)],
                ['=EMAIL' => $login],
            ],
            'select' => ['ID', 'ACTIVE'],
        ]);

        if (!$user) {
            return [
                'status' => 'error',
                'message' => 'User not found',
            ];
        }

        if ($user['ACTIVE'] === 'N') {
            return [
                'status' => 'error',
                'message' => 'User is not active',
            ];
        }

        (new User($user['ID']))->confirmation->sendResetPasswordEmail();

        return ['status' => 'success'];
    }
}
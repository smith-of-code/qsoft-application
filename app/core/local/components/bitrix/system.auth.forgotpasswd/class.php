<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die;

use Bitrix\Main\ArgumentException;
use Bitrix\Main\Engine\Contract\Controllerable;
use Bitrix\Main\ObjectPropertyException;
use Bitrix\Main\SystemException;
use Bitrix\Main\UserTable;
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
                'prefilters' => [],
            ],
        ];
    }

    /**
     * @param string $login - User login or email
     * @return array
     * @throws ArgumentException
     * @throws ObjectPropertyException
     * @throws SystemException
     */
    public function sendEmailMessageAction(string $login): array
    {
        $user = UserTable::getRow([
            'filter' => [
                'LOGIC' => 'OR',
                ['=LOGIN' => $login],
                ['=EMAIL' => $login],
            ],
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

        (new ConfirmationService)->sendResetPasswordEmail($user['ID']);

        return ['status' => 'success'];
    }
}
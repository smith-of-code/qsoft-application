<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die;

use Bitrix\Main\Engine\ActionFilter\Authentication;
use Bitrix\Main\Engine\ActionFilter\Csrf;
use Bitrix\Main\Engine\Contract\Controllerable;
use Bitrix\Main\Security\Password;
use Bitrix\Main\UserTable;
use QSoft\Entity\User;
use QSoft\ORM\ConfirmationTable;
use QSoft\Service\ConfirmationService;

class SystemAuthChangePasswordComponent extends CBitrixComponent implements Controllerable
{
    public function onPrepareComponentParams($arParams): array
    {
        $arParams += array_flip(array_map(static fn($item) => strtoupper($item), array_flip($_GET)));
        return parent::onPrepareComponentParams($arParams);
    }

    public function executeComponent()
    {
        $confirmResult = (new User($this->arParams['USER_ID']))->confirmation->verifyEmailCode(
            $this->arParams['CONFIRM_CODE'],
            ConfirmationTable::TYPES['reset_password'],
            false,
        );

        if ($confirmResult) {
            $this->includeComponentTemplate();
        } else {
            LocalRedirect('/');
        }
    }

    public function configureActions(): array
    {
        return [
            'changePassword' => [
                '-prefilters' => [
                    Csrf::class,
                    Authentication::class,
                ],
            ],
        ];
    }

    public function changePasswordAction(int $userId, string $password, string $confirmPassword, string $code): array
    {
        $result = (new User($userId))->changePassword($password, $confirmPassword);
        if ($result) {
            ConfirmationTable::deactivateCode($code);
        }

        return ['status' => $result ? 'success' : 'error'];
    }
}
<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Engine\ActionFilter\Authentication;
use Bitrix\Main\Engine\ActionFilter\Csrf;
use Bitrix\Main\Engine\Contract\Controllerable;
use QSoft\Entity\User;

class LogoutComponent extends CBitrixComponent implements Controllerable
{
    private User $user;

    public function __construct($component = null)
    {
        parent::__construct($component);

        $this->user = new User;
    }

    public function configureActions(): array
    {
        return [
            'logout' => [
                '-prefilters' => [
                    Csrf::class,
                    Authentication::class,
                ],
            ]
        ];
    }

    public function logoutAction(): void
    {
        if ($this->user->isAuthorized) {
            $this->user->logout();
        }
    }
}

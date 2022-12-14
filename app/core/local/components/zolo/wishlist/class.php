<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Context;
use Bitrix\Main\Engine\Contract\Controllerable;
use Bitrix\Main\HttpRequest;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\SystemException;
use Bitrix\Main\Loader;
use QSoft\Entity\User;

class WishlistComponent extends CBitrixComponent implements Controllerable
{
    private User $user;

    public function __construct($component = null)
    {
        parent::__construct($component);

        $this->user = new User;
    }

    public function configureActions()
    {
        return [
            'add' => [
                'prefilters' => [],
            ],
            'remove' => [
                'prefilters' => [],
            ],
        ];
    }

    public function addAction(int $productId): void
    {
        $this->user->wishlist->add($productId);
    }

    public function removeAction(int $productId): void
    {
        $this->user->wishlist->remove($productId);
    }
}

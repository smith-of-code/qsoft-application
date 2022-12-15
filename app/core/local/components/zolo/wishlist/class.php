<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Engine\ActionFilter\Csrf;
use Bitrix\Main\Engine\Contract\Controllerable;
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
                '-prefilters' => [
                    Csrf::class
                ],
            ],
            'remove' => [
                '-prefilters' => [
                    Csrf::class
                ],
            ],
            'getByProductId' => [
                '-prefilters' => [
                    Csrf::class
                ],
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

    public function getByProductIdAction(int $productId): array
    {
        return array_column($this->user->wishlist->getByProductId($productId), 'UF_PRODUCT_ID');
    }
}

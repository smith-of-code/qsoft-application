<?php

namespace QSoft\Service;

use QSoft\Entity\User;
use QSoft\ORM\WishlistTable;

class WishlistService
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function add(int $productId): int
    {
        return WishlistTable::add([
            'UF_USER_ID' => $this->user->id,
            'UF_PRODUCT_ID' => $productId,
        ])->getId();
    }

    public function remove(int $productId): bool
    {
        return WishlistTable::delete($this->get($productId)['ID'])->isSuccess();
    }

    public function get(int $productId): array
    {
        return WishlistTable::getRow([
            'filter' => [
                '=UF_USER_ID' => $this->user->id,
                '=UF_PRODUCT_ID' => $productId,
            ],
        ]);
    }

    public function getAll(): array
    {
        return WishlistTable::getList([
            'filter' => [
                '=UF_USER_ID' => $this->user->id,
            ],
        ])->fetchAll();
    }
}
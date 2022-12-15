<?php

namespace QSoft\Service;

use Bitrix\Main\ArgumentException;
use Bitrix\Main\ObjectPropertyException;
use Bitrix\Main\SystemException;
use Exception;
use QSoft\Entity\User;
use QSoft\ORM\WishlistTable;

class WishlistService
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @param int $productId - (offerId)
     * @return int
     * @throws Exception
     */
    public function add(int $productId): int
    {
        if (!$this->user->isAuthorized) {
            return 0;
        }
        return WishlistTable::add([
            'UF_USER_ID' => $this->user->id,
            'UF_PRODUCT_ID' => $productId,
        ])->getId();
    }

    /**
     * @param int $productId - (offerId)
     * @return bool
     * @throws Exception
     */
    public function remove(int $productId): bool
    {
        if (!$this->user->isAuthorized) {
            return true;
        }
        return WishlistTable::delete($this->get($productId)['ID'])->isSuccess();
    }

    /**
     * @param int $productId - (offerId)
     * @return array
     * @throws ArgumentException
     * @throws ObjectPropertyException
     * @throws SystemException
     */
    public function get(int $productId): array
    {
        if (!$this->user->isAuthorized) {
            return [];
        }
        return WishlistTable::getRow([
            'filter' => [
                '=UF_USER_ID' => $this->user->id,
                '=UF_PRODUCT_ID' => $productId,
            ],
        ]);
    }

    public function getAll(): array
    {
        if (!$this->user->isAuthorized) {
            return [];
        }
        return WishlistTable::getList([
            'filter' => [
                '=UF_USER_ID' => $this->user->id,
            ],
        ])->fetchAll();
    }

    /**
     * @param int $productId - NOT OFFER ID
     * @return array
     * @throws ArgumentException
     * @throws ObjectPropertyException
     * @throws SystemException
     */
    public function getByProductId(int $productId): array
    {
        if (!$this->user->isAuthorized) {
            return [];
        }

        return WishlistTable::getList([
            'filter' => [
                '=UF_USER_ID' => $this->user->id,
                '=UF_PRODUCT_ID' => $this->user->products->getOffersIds($productId),
            ],
        ])->fetchAll();
    }
}
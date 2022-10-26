<?php

namespace QSoft\Basket;

use Bitrix\Sale\Basket;
use Bitrix\Sale\BasketBase;
use Bitrix\Sale\Fuser;
use QSoft\Entity\User;
use QSoft\Helper\BasketHelper;

class BasketBonus
{
    private const BONUSES_TO_GET_OFFER_PROP_CODE_PREFIX = 'BONUSES_';

    /**
     * @var BasketBase Корзина пользователя
     */
    private BasketBase $basket;

    /**
     * InnerBonusAccountService constructor.
     * @param BasketBase $basket
     */
    public function __construct(BasketBase $basket)
    {
        $this->basket = $basket;
    }

    /**
     * @param User $user
     * @return int Сумма бонусов товаров по уровню пользователя
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     */
    public function getUserBonusSum(User $user): int
    {
        if (!$user->groups->isConsultant() || empty($user->loyaltyLevel)) {
            return 0;
        }

        $bonus = 0;
        $propLevel = self::BONUSES_TO_GET_OFFER_PROP_CODE_PREFIX . $user->loyaltyLevel;

        $offersBonuses = $this->loadBasketBonusesByUserLevel($user);

        foreach ($offersBonuses as $bonusItem) {
            $bonus += (int)$bonusItem[$propLevel];
        }

        return $bonus;
    }

    /**
     * @param User $user
     * @return array Бонусы по уровню пользователя по товарам
     */
    public function loadBasketBonusesByUserLevel(User $user): array
    {
        $result = [];

        $propLevel = self::BONUSES_TO_GET_OFFER_PROP_CODE_PREFIX . $user->loyaltyLevel;

        if ($propLevel) {
            $result = BasketHelper::getOfferProperties($this->basket, [$propLevel]);
        }

        return $result;
    }

    /**
     * @param BasketBase $basket
     */
    public function setBasket(BasketBase $basket): void
    {
        $this->basket = $basket;
    }
}
<?php

namespace QSoft\Basket;

use Bitrix\Sale\Basket;
use Bitrix\Sale\BasketBase;
use Bitrix\Sale\Fuser;
use QSoft\Entity\User;
use QSoft\Helper\BasketHelper;

class BasketBonus
{
    const LEVEL_PROPS = [
        'K1' => 'BONUSES_K1',
        'K2' => 'BONUSES_K2',
        'K3' => 'BONUSES_K3'
    ];

    /**
     * @var BasketBase корзина пользователя
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
     * @return int сумма бонусов товаров по уровyю пользователя
     */
    public function getUserBonusSum(User $user): int
    {
        $bonus = 0;
        $propLevel = self::LEVEL_PROPS[$user->loyaltyLevel];

        $offersBonuses = $this->loadBasketBonusesByUserLevel($user);

        foreach ($offersBonuses as $bonusItem) {
            $bonus += (int)$bonusItem[$propLevel];
        }

        return $bonus;
    }

    /**
     * @param User $user
     * @return array бонусы по уровня пользователя по товарам
     */
    public function loadBasketBonusesByUserLevel(User $user): array
    {
        $result = [];
        if (!isset($this->basket)) {
            $this->loadBasket();
        }

        if ($user->groups->isConsultant()) {
            $propLevel = self::LEVEL_PROPS[$user->loyalty->getLoyaltyLevel()];

            if ($propLevel) {
                $result = BasketHelper::getOfferProperties($this->basket, [$propLevel]);
            }
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

    public function loadBasket(): void
    {
        $this->basket = Basket::loadItemsForFUser(Fuser::getId(), SITE_ID);;
    }

}
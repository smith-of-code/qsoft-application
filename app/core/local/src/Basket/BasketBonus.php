<?php

namespace QSoft\Basket;

use Bitrix\Main\ArgumentException;
use Bitrix\Main\ObjectPropertyException;
use Bitrix\Main\SystemException;
use Bitrix\Sale\BasketBase;
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
     * @param BasketBase $basket
     */
    public function setBasket(BasketBase $basket): void
    {
        $this->basket = $basket;
    }

    /**
     * @param User $user
     * @return int Сумма бонусов товаров по уровню пользователя
     * @throws ArgumentException
     * @throws ObjectPropertyException
     * @throws SystemException
     */
    public function getBasketItemsBonusSum(User $user): int
    {
        if (!$user->groups->isConsultant() || empty($user->loyaltyLevel)) {
            return 0;
        }

        $propLevel = self::BONUSES_TO_GET_OFFER_PROP_CODE_PREFIX . $user->loyaltyLevel;

        $offerPropertiesByBasketItems = BasketHelper::getOfferProperties($this->basket, [$propLevel]);

        $bonus = 0;


        foreach ($offerPropertiesByBasketItems as $basketItemId => $offerProperties) {
            $basketBonus = $this->basket->getItemById($basketItemId);
            $bonus += (int)$offerProperties[$propLevel] * $basketBonus ? $basketBonus->getQuantity() : 0;
        }

        return $bonus;
    }
}

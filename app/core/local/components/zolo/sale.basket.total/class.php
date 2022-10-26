<?php

use QSoft\Basket\BasketBonus;
use QSoft\Entity\User;
use QSoft\Service\BonusAccountService;
use Bitrix\Currency\CurrencyManager;
use Bitrix\Main;
use Bitrix\Main\Loader;
use Bitrix\Sale\Basket;
use Bitrix\Sale\BasketBase;
use Bitrix\Sale\BasketItem;
use Bitrix\Sale\Fuser;

class SaleBasketTotal extends CBitrixComponent
{
    public function executeComponent()
    {
        $basket = Basket::loadItemsForFUser(Fuser::getId(), SITE_ID);
        $basket->refresh(Basket\RefreshFactory::create(Basket\RefreshFactory::TYPE_FULL));

        $this->arResult = [
            'BASKET_COUNT' => $basket->count(),
            'BASKET_PRICE' => $basket->getPrice(),
            'BASKET_TOTAL_VAT' => $basket->getVatSum(),
//            'TOTAL_DISCOUNT' => $basket->
        ];

        if (currentUser() && currentUser()->groups->isConsultant()) {
            $this->loadBonusesBlock($basket);
        }

        $discounts = \Bitrix\Sale\Discount::buildFromBasket($basket, new \Bitrix\Sale\Discount\Context\Fuser($basket->getFUserId(true)));

        $discounts->calculate();

        $result = $discounts->getApplyResult(true);

//        $prices = $result['PRICES']['BASKET'];

        dump($result);

//        dump($this->arResult);
    }

    public function loadBonusesBlock($basket)
    {
        $this->arResult = array_merge($this->arResult, [
            'ACTIVE_BONUSES' => currentUser()->bonusPoints,
            'BASKET_ITEMS_BONUS_SUM' => (new BasketBonus($basket))->getBasketItemsBonusSum(currentUser()),
            'USER_LOYALTY_LEVEL' => currentUser()->loyaltyLevel
        ]);
    }
}
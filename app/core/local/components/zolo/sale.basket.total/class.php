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
        if (currentUser() && currentUser()->groups->isConsultant()) {
            $this->loadBonusAccount();
            $this->loadBasketBonus();

            $this->arResult['USER_LOYALTY_LEVEL'] = currentUser()->loyaltyLevel;;

            dump($this->arResult);
        }
    }

    public function loadBonusAccount()
    {
        $this->arResult['ACTIVE_BONUSES'] = currentUser()->bonusPoints;
    }


    public function loadBasketBonus()
    {
        $basket = Basket::loadItemsForFUser(Fuser::getId(), SITE_ID);
        $this->arResult['BASKET_BONUS_SUM'] = (new BasketBonus($basket))
            ->getUserBonusSum(currentUser());
    }





}
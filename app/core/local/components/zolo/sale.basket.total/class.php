<?php


use QSoft\Basket\BasketBonus;
use QSoft\Entity\User;
use QSoft\Service\InnerBonusAccountService;
use Bitrix\Currency\CurrencyManager;
use Bitrix\Main;
use Bitrix\Main\Loader;
use Bitrix\Sale\Basket;
use Bitrix\Sale\BasketBase;
use Bitrix\Sale\BasketItem;
use Bitrix\Sale\Fuser;


class SaleBasketTotal extends CBitrixComponent
{

    private $user;
    private $account;
    private $basketBonus;

    public function executeComponent()
    {
        global $USER;
        if ($USER->GetId()) {
            $this->user = new User($USER->GetId());
            if ($this->user->groups->isConsultant()) {
                $this->loadBonusAccount();
                $this->loadBasketBonus();

                $this->arResult['USER_LOYALTY_LEVEL'] = $this->user->loyalty->getLoyaltyLevel();;

                dump($this->arResult);
            }
        }
    }

    public function loadBonusAccount()
    {
        $innerBonusService = new InnerBonusAccountService($this->user);
        $this->account = $innerBonusService->getAccount();
        $this->arResult['ACTIVE_BONUSES'] = $this->account['CURRENT_BUDGET'];
    }


    public function loadBasketBonus()
    {
        $basket = Basket::loadItemsForFUser(Fuser::getId(), SITE_ID);
        $this->basketBonus = new BasketBonus($basket);
        $this->arResult['BASKET_BONUS_SUM'] = $this->basketBonus->getUserBonusSum($this->user);
    }





}
<?php


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

    public function onPrepareComponentParams($arParams)
    {
        return parent::onPrepareComponentParams($arParams);
    }

    public function executeComponent()
    {
        global $USER;

        $user = new User($USER->GetId());
        if ($user->groups->isConsultant()) {
            $level = $user->loyalty->getLoyaltyLevel();
            $innerBonusService = new InnerBonusAccountService($user);
            $account = $innerBonusService->getAccount();

            $this->arResult['USER_LOYALTY_LEVEL'] = $level;
            $this->arResult['ACTIVE_BONUSES'] = $account['CURRENT_BUDGET'];

            dump($this->arResult);
        }



    }

    public function loadBasketBonuses()
    {

    }





}
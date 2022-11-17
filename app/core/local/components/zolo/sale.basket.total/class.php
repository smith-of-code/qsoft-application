<?php

use Bitrix\Sale\DiscountCouponsManager;
use Bitrix\Sale\Order;
use QSoft\Entity\User;
use QSoft\Helper\BasketHelper;
use QSoft\Helper\LoyaltyProgramHelper;
use QSoft\Helper\OrderHelper;

class SaleBasketTotal extends CBitrixComponent
{
    private User $user;
    private OrderHelper $orderHelper;
    private BasketHelper $basketHelper;
    private LoyaltyProgramHelper $loyaltyProgramHelper;

    public function __construct($component = null)
    {
        parent::__construct($component);

        $this->user = new User;
        $this->orderHelper = new OrderHelper;
        $this->basketHelper = new BasketHelper;
        $this->loyaltyProgramHelper = new LoyaltyProgramHelper;
    }

    public function executeComponent()
    {
        $currentAccountingPeriod = $this->loyaltyProgramHelper->getCurrentAccountingPeriod();
        $isConsultant = $this->user->isAuthorized && $this->user->groups->isConsultant();

        $oldBasket = $this->basketHelper->getBasket();
        $oldBasketItems = $oldBasket->toArray();

        $newBasket = $this->basketHelper->getBasket(true);
        $newBasketItems = $newBasket->toArray();

        $offers = $this->user->products->getOffersByIds(array_column($oldBasketItems, 'PRODUCT_ID'));

        $basketBonuses = 0;
        foreach ($newBasketItems as $index => &$basketItem) {
            if ($isConsultant) {
                $basketBonuses += $this->user->loyalty->calculateBonusesByPrice($basketItem['PRICE']) * $basketItem['QUANTITY'];
            }
            if ($basketItem['PRICE'] !== $oldBasketItems[$index]['PRICE']) {
                $basketItem['PERSONAL_PROMOTION'] = true;
            }
            $basketItem['OFFER'] = $offers[$basketItem['PRODUCT_ID']];
            $basketItem['TOTAL_PRICE'] = $basketItem['PRICE'] * $basketItem['QUANTITY'];
            $basketItem['TOTAL_BASE_PRICE'] = $basketItem['BASE_PRICE'] * $basketItem['QUANTITY'];
        }

        $this->arResult = [
            'IS_CONSULTANT' => $isConsultant,
            'BASKET_COUNT' => $newBasket->count(),
            'BASKET_PRICE' => $newBasket->getPrice(),
            'BASKET_BASE_PRICE'=> $newBasket->getBasePrice(),
            'BASKET_TOTAL_VAT' => $newBasket->getVatSum(),
            'TOTAL_DISCOUNT' => $newBasket->getBasePrice() - $newBasket->getPrice(),
            'BASKET_ITEMS' => $newBasketItems,
            'ACTIVE_BONUSES' => $this->user->bonusPoints,
            'BASKET_ITEMS_BONUS_SUM' => $basketBonuses,
            'USER_LOYALTY_LEVEL' => $this->user->loyaltyLevel,
            'LOYALTY_STATUS' => $this->loyaltyProgramHelper->getLoyaltyStatusByPeriod(
                $this->user->id,
                $currentAccountingPeriod['from'],
                $currentAccountingPeriod['to'],
            ),
        ];

        $this->includeComponentTemplate();
    }
}
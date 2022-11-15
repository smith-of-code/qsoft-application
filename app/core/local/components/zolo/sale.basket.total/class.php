<?php

use QSoft\Entity\User;
use QSoft\Helper\BasketHelper;

class SaleBasketTotal extends CBitrixComponent
{
    private User $user;
    private BasketHelper $basketHelper;

    public function __construct($component = null)
    {
        parent::__construct($component);

        $this->user = new User;
        $this->basketHelper = new BasketHelper;
    }

    public function executeComponent()
    {
        $isConsultant = $this->user->isAuthorized && $this->user->groups->isConsultant();
        $basket = $this->basketHelper->getBasket();
        $basketItems = $basket->toArray();
        $offers = $this->user->products->getOffersByIds(array_column($basketItems, 'PRODUCT_ID'));

        $basketBonuses = 0;
        foreach ($basketItems as &$basketItem) {
            if ($isConsultant) {
                $basketBonuses += $offers[$basketItem['PRODUCT_ID']]['BONUSES'] * $basketItem['QUANTITY'];
            }
            $basketItem['OFFER'] = $offers[$basketItem['PRODUCT_ID']];
            $basketItem['TOTAL_PRICE'] = $basketItem['PRICE'] * $basketItem['QUANTITY'];
            $basketItem['TOTAL_BASE_PRICE'] = $basketItem['BASE_PRICE'] * $basketItem['QUANTITY'];
        }

        $this->arResult = [
            'IS_CONSULTANT' => $isConsultant,
            'BASKET_COUNT' => $basket->count(),
            'BASKET_PRICE' => $basket->getPrice(),
            'BASKET_BASE_PRICE'=> $basket->getBasePrice(),
            'BASKET_TOTAL_VAT' => $basket->getVatSum(),
            'TOTAL_DISCOUNT' => $basket->getBasePrice() - $basket->getPrice(),
            'BASKET_ITEMS' => $basketItems,
            'ACTIVE_BONUSES' => $this->user->bonusPoints,
            'BASKET_ITEMS_BONUS_SUM' => $basketBonuses,
            'USER_LOYALTY_LEVEL' => $this->user->loyaltyLevel,
        ];

        $this->includeComponentTemplate();
    }
}
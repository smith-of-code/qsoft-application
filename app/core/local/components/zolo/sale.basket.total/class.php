<?php

use Bitrix\Sale\Discount;
use Bitrix\Sale\Order;
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
        \Bitrix\Main\Loader::includeModule('sale');
        \Bitrix\Main\Loader::includeModule('catalog');
        $basket = Basket::loadItemsForFUser(Fuser::getId(), SITE_ID);

        $basket->refresh();

        $order = Order::create(SITE_ID, currentUser()->id);
        $order->setPersonTypeId(1);
        $order->setBasket($basket);

        $this->arResult = [
            'BASKET_COUNT' => $basket->count(),
            'BASKET_PRICE' => $order->getPrice(),
            'BASKET_BASE_PRICE'=> $order->getBasePrice(),
            'BASKET_TOTAL_VAT' => $order->getVatSum(),
            'TOTAL_DISCOUNT' => $order->getBasePrice() - $order->getPrice(),
        ];

        if (currentUser() && currentUser()->groups->isConsultant()) {
            $this->loadBonusesBlock($basket);
        }
        
        $product = array('PRODUCT_ID' => 574, 'QUANTITY' => 1);
        $result = \Bitrix\Catalog\Product\Basket::addProductToBasket($basket, $product, array('SITE_ID' => SITE_ID));

        // TODO: Оставил код для формирования корзины,
        // для заполнения корзины необходимо указать id торгового предложения и количество(по умолчанию 1)
        // После зайти на страницу /cart/
        // один заход будет выполнять одну итерацию с корзиной.
        // затем можно переходить на страницу оформления заказа.
        // После реализации корзины удалить.
        Add2BasketByProductID(
            574,
            1
        );

        dump([
            '$this->arResult' => $this->arResult,
            '$order->getDiscountPrice()' => $order->getDiscountPrice(),
            '$order->getDiscount()' => $order->getDiscount(),
            'add' => $result,
            'basket' => $basket,
            'test' => [Fuser::getId(), SITE_ID],
        ]);
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
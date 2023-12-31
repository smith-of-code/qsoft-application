<?php

use Bitrix\Sale\BasketItem;
use Bitrix\Sale\BasketPropertyItem;
use QSoft\Entity\User;
use QSoft\Helper\BasketHelper;
use QSoft\Helper\LoyaltyProgramHelper;

class SaleBasketTotal extends CBitrixComponent
{
    private User $user;
    private BasketHelper $basketHelper;
    private LoyaltyProgramHelper $loyaltyProgramHelper;

    public function __construct($component = null)
    {
        parent::__construct($component);

        $this->user = new User;
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

        $offers = $this->user->products->getOffersByIds(array_column($oldBasketItems, 'PRODUCT_ID'));

        $i = 0;
        $basketBonuses = 0;
        $basketItems = [];
        /** @var BasketItem $newBasketItem */
        foreach ($newBasket as $newBasketItem) {
            $basketItem = $newBasketItem->toArray();
            if ($basketItem['PRICE'] !== $oldBasketItems[$i++]['PRICE']) {
                $basketItem['PERSONAL_PROMOTION'] = true;
            }

            $propertiesCollection = $newBasketItem->getPropertyCollection();
            /** @var BasketPropertyItem $property */
            foreach ($propertiesCollection as $property) {
                if ($property->getField('CODE') === 'PERSONAL_PROMOTION') {
                    $property->setField('VALUE', (bool)$basketItem['PERSONAL_PROMOTION']);
                }
                if ($property->getField('CODE') === 'BONUSES') {
                    $basketItemBonuses = $this->user->loyalty->calculateBonusesByPrice(
                        $basketItem['PRICE'],
                        (bool)$basketItem['PERSONAL_PROMOTION']
                    );
                    $basketBonuses += $basketItemBonuses;
                    $property->setField('VALUE', $basketItemBonuses);
                    $property->save();
                }
            }
            $propertiesCollection->save();
            $newBasketItem->save();
            $basketItem = $newBasketItem->toArray();

            $basketItem['PROPERTIES'] = array_combine(
                array_column($basketItem['PROPERTIES'], 'CODE'),
                array_column($basketItem['PROPERTIES'], 'VALUE'),
            );
            $basketItem['OFFER'] = $offers[$basketItem['PRODUCT_ID']];
            $basketItem['TOTAL_PRICE'] = $basketItem['PRICE'] * $basketItem['QUANTITY'];
            $basketItem['TOTAL_BASE_PRICE'] = $basketItem['BASE_PRICE'] * $basketItem['QUANTITY'];

            $basketItems[] = $basketItem;
        }

        $this->arResult = [
            'IS_AUTHORIZED' => $this->user->isAuthorized,
            'IS_CONSULTANT' => $isConsultant,
            'BASKET_COUNT' => $newBasket->count(),
            'BASKET_PRICE' => $newBasket->getPrice(),
            'BASKET_BASE_PRICE'=> $newBasket->getBasePrice(),
            'BASKET_TOTAL_VAT' => $newBasket->getVatSum(),
            'TOTAL_DISCOUNT' => $newBasket->getBasePrice() - $newBasket->getPrice(),
            'BASKET_ITEMS' => $basketItems,
            'ACTIVE_BONUSES' => $this->user->bonusPoints,
            'BASKET_ITEMS_BONUS_SUM' => $basketBonuses,
            'USER_LOYALTY_LEVEL' => $isConsultant ? $this->user->loyaltyLevel : null,
            'LOYALTY_STATUS' => $isConsultant ? $this->loyaltyProgramHelper->getLoyaltyStatusByPeriod(
                $this->user->id,
                $currentAccountingPeriod['from'],
                $currentAccountingPeriod['to'],
            ) : null,
        ];

        $this->includeComponentTemplate();
    }
}
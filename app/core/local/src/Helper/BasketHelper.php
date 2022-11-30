<?php

namespace QSoft\Helper;

use Bitrix\Main\ArgumentException;
use Bitrix\Main\ArgumentNullException;
use Bitrix\Main\ArgumentOutOfRangeException;
use Bitrix\Main\ArgumentTypeException;
use Bitrix\Main\InvalidOperationException;
use Bitrix\Main\NotImplementedException;
use Bitrix\Sale\Basket;
use Bitrix\Sale\BasketBase;
use Bitrix\Sale\BasketItem;
use Bitrix\Sale\Discount;
use Bitrix\Sale\DiscountCouponsManager;
use Bitrix\Sale\Fuser;
use Bitrix\Sale\Order;
use RuntimeException;

class BasketHelper
{
    private OrderHelper $orderHelper;

    public function __construct()
    {
        $this->orderHelper = new OrderHelper;
    }

    public static function getOfferProperties(BasketBase $basket, array $properties = []): array
    {
        $basketItemsByOffers = [];
        foreach ($basket as $basketItem) {
            /** @var BasketItem $basketItem */
            $basketItemsByOffers[$basketItem->getProductId()] = $basketItem->getId();
        }

        $select = ['ID'];

        if (!empty($properties)) {
            foreach ($properties as $prop) {
                $select[] = 'PROPERTY_' . $prop;
            }
        } else {
            $select[] = 'PROPERTY_*';
        }

        $dbResult = \CIBlockElement::GetList(
            ['SORT' => 'ASC'],
            [
                'IBLOCK_ID' => IBLOCK_PRODUCT_OFFER,
                'ID' => array_keys($basketItemsByOffers)
            ],
            false,
            false,
            $select
        );

        $result = [];
        while ($item = $dbResult->Fetch()) {
            $basketItemId = $basketItemsByOffers[$item['ID']];

            $result[$basketItemId]['BASKET_ITEM_ID'] = $basketItemId;

            if (!empty($properties)) {
                $result[$basketItemId]['ID'] = $item['ID'];

                foreach ($properties as $prop) {
                    $result[$basketItemId][$prop] = $item['PROPERTY_' . $prop . '_VALUE'];
                }
            } else {
                $result[$basketItemId] = array_merge($result[$basketItemId], $item);
            }
        }
        return $result;
    }

    /**
     * @return BasketBase
     * @throws ArgumentException
     * @throws ArgumentNullException
     * @throws ArgumentOutOfRangeException
     * @throws ArgumentTypeException
     * @throws InvalidOperationException
     * @throws NotImplementedException
     */
    public function getBasket(bool $withPersonalPromotions = false, bool $clearPersonalPromotions = true): BasketBase
    {
        $basket = Basket::loadItemsForFUser(Fuser::getId(), SITE_ID);

        $context = new Discount\Context\Fuser($basket->getFUserId());
        if ($discounts = Discount::buildFromBasket($basket, $context)) {
            $discountsResult = $discounts->calculate();
            if (!$discountsResult->isSuccess()) {
                throw new RuntimeException($discountsResult->getErrorMessages());
            }
            $discountsData = $discountsResult->getData();
            if ($discountsData['BASKET_ITEMS']) {
                $applyResult = $basket->applyDiscount($discountsData['BASKET_ITEMS']);
                if (!$applyResult->isSuccess()) {
                    throw new RuntimeException($applyResult->getErrorMessages());
                }
            }
        }
        if ($withPersonalPromotions && $user = currentUser()) {
            $order = Order::create(SITE_ID);
            $order->setBasket($basket);

            DiscountCouponsManager::getUserId();
            $coupons = $this->orderHelper->getUserCoupons($user->id);
            foreach ($coupons as $coupon) {
                DiscountCouponsManager::add($coupon['coupon']);
            }
            $basket = $this->getBasket();
            if ($clearPersonalPromotions) {
                DiscountCouponsManager::clear(true);
            }
        }
        return $basket;
    }
}
<?php

namespace QSoft\Helper;

use Bitrix\Main\ArgumentException;
use Bitrix\Main\ArgumentNullException;
use Bitrix\Main\ArgumentOutOfRangeException;
use Bitrix\Main\ArgumentTypeException;
use Bitrix\Main\InvalidOperationException;
use Bitrix\Main\Loader;
use Bitrix\Main\NotImplementedException;
use Bitrix\Sale\Basket;
use Bitrix\Sale\BasketBase;
use Bitrix\Sale\BasketItem;
use Bitrix\Sale\Discount;
use Bitrix\Sale\DiscountCouponsManager;
use Bitrix\Sale\Fuser;
use Bitrix\Sale\Order;
use CCatalogProduct;
use Psr\Log\LogLevel;
use QSoft\Entity\User;
use QSoft\Logger\Logger;
use RuntimeException;

class BasketHelper
{
    private int $fUserId;

    private User $user;
    private CouponHelper $couponHelper;

    public function __construct(int $fUserId = null)
    {
        $this->fUserId = $fUserId ?? FUser::getId();

        $this->user = new User;
        $this->couponHelper = new CouponHelper;

        Loader::includeModule('sale');
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
        $basket = Basket::loadItemsForFUser($this->fUserId, SITE_ID);

        $context = new Discount\Context\Fuser($basket->getFUserId());
        if ($discounts = Discount::buildFromBasket($basket, $context)) {
            $discountsResult = $discounts->calculate();
            if (!$discountsResult->isSuccess()) {
                $error = new RuntimeException($discountsResult->getErrorMessages());
                Logger::createLogger(__CLASS__, 0, LogLevel::ERROR)
                    ->setLog(
                        $error->getMessage(),
                        [
                            'message' => $error->getMessage(),
                            'namespace' => __NAMESPACE__ ,
                            'file_path' => (new \ReflectionClass(__NAMESPACE__))->getFileName(),
                        ],
                    );
                throw $error;
            }
            $discountsData = $discountsResult->getData();
            if ($discountsData['BASKET_ITEMS']) {
                $applyResult = $basket->applyDiscount($discountsData['BASKET_ITEMS']);
                if (!$applyResult->isSuccess()) {
                    $error = new RuntimeException($applyResult->getErrorMessages());
                    Logger::createLogger(__CLASS__, 0, LogLevel::ERROR)
                        ->setLog(
                            $error->getMessage(),
                            [
                                'message' => $error->getMessage(),
                                'namespace' => __NAMESPACE__ ,
                                'file_path' => (new \ReflectionClass(__NAMESPACE__))->getFileName(),
                            ],
                        );
                    throw $error;
                }
            }
        }
        if ($withPersonalPromotions && $user = currentUser()) {
            $order = Order::create(SITE_ID);
            $order->setBasket($basket);

            DiscountCouponsManager::getUserId();
            $coupons = $this->couponHelper->getUserCoupons($user->id);
            foreach ($coupons as $coupon) {
                DiscountCouponsManager::add($coupon['coupon']);
            }
            $basket = $this->getBasket();
            if ($clearPersonalPromotions) {
                $this->clearPersonalPromotions();
            }
        }
        return $basket;
    }

    public function clearPersonalPromotions(): void
    {
        DiscountCouponsManager::clear(true);
    }

    public function increase(int $offerId, string $detailPage, bool $nonreturnable, int $quantity = 1): bool
    {
        $basket = Basket::loadItemsForFUser($this->fUserId, SITE_ID);

        if ($item = $this->getExistBasketItem($basket, $offerId)) {
            $result = $item->setField('QUANTITY', $item->getQuantity() + $quantity);
            $basket->save();
        } else {
            $result = \Bitrix\Catalog\Product\Basket::addProduct([
                'PRODUCT_ID' => $offerId,
                'QUANTITY' => $quantity,
                'PROPS' => [
                    [
                        'NAME' => 'Детальная страница',
                        'CODE' => 'DETAIL_PAGE',
                        'VALUE' => $detailPage,
                    ],
                    [
                        'NAME' => 'Невозвратный товар',
                        'CODE' => 'NONRETURNABLE',
                        'VALUE' => $nonreturnable,
                    ],
                    [
                        'NAME' => 'Персональная акция',
                        'CODE' => 'PERSONAL_PROMOTION',
                        'VALUE' => false,
                    ],
                    [
                        'NAME' => 'Баллы',
                        'CODE' => 'BONUSES',
                        'VALUE' => $this->user->loyalty->calculateBonusesByPrice(CCatalogProduct::GetOptimalPrice($offerId)['DISCOUNT_PRICE']),
                    ],
                ],
            ]);
        }

        return $result->isSuccess();
    }

    private function getExistBasketItem(BasketBase $basket, int $offerId): ?BasketItem
    {
        /** @var BasketItem $basketItem */
        foreach ($basket->getBasketItems() as $basketItem) {
            if ($basketItem->getProductId() === $offerId) {
                return $basketItem;
            }
        }
        return null;
    }
}
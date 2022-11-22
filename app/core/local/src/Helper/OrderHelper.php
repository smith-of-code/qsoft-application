<?php

namespace QSoft\Helper;

use Bitrix\Main\Type\Date;
use Bitrix\Main\Type\DateTime;
use Bitrix\Sale\Basket\Storage;
use Bitrix\Sale\DiscountCouponsManager;
use Bitrix\Sale\Fuser;
use Bitrix\Sale\Internals\DiscountCouponTable;
use Bitrix\Sale\Internals\DiscountTable;
use Bitrix\Sale\Internals\OrderCouponsTable;
use Bitrix\Sale\Order;
use Bitrix\Sale\Delivery\Services\Manager as DeliveryServicesManager;
use Bitrix\Sale\OrderTable;
use Bitrix\Sale\PaySystem\Manager as PaySystemManager;
use Bitrix\Sale\PropertyValue;
use CFile;
use QSoft\Entity\User;
use QSoft\ORM\Decorators\EnumDecorator;
use QSoft\ORM\NotificationTable;
use QSoft\ORM\TransactionTable;
use QSoft\Service\ProductService;

class OrderHelper
{
    public const ACCOMPLISHED_STATUS = 'F';
    public const PARTLY_REFUNDED_STATUS = 'PR';
    public const FULL_REFUNDED_STATUS = 'FR';

    public const ORDER_STATUSES = [
        'accomplished' => self::ACCOMPLISHED_STATUS,
        'partly_refunded' => self::PARTLY_REFUNDED_STATUS,
        'full_refunded' => self::FULL_REFUNDED_STATUS,
    ];

    private BonusAccountHelper $bonusAccountHelper;
    private LoyaltyProgramHelper $loyaltyProgramHelper;

    public function __construct()
    {
        $this->bonusAccountHelper = new BonusAccountHelper;
        $this->loyaltyProgramHelper = new LoyaltyProgramHelper;
    }

    public function getUserOrdersWithPersonalPromotions(int $userId): array
    {
        $result = OrderTable::getList([
            'filter' => [
                '=USER_ID' => $userId,
                '=TRANSACTION.UF_MEASURE' => EnumDecorator::prepareField(TransactionTable::MEASURES['points']),
            ],
            'select' => ['ID', 'ACCOUNT_NUMBER', 'PRICE', 'DATE_INSERT', 'BONUSES' => 'TRANSACTION.UF_AMOUNT'],
            'runtime' => [
                'COUPON' => [
                    'data_type' => OrderCouponsTable::class,
                    'reference' => ['=this.ID' => 'ref.ORDER_ID'],
                ],
                'TRANSACTION' => [
                    'data_type' => TransactionTable::class,
                    'reference' => ['=this.ID' => 'ref.UF_ORDER_ID'],
                ],
            ],
        ])->fetchAll();

        return array_map(static fn (array $order): array => array_combine(
            array_map(static fn (string $key): string => strtolower($key), array_keys($order)),
            $order
        ), $result);
    }

    public function getUserCoupons(int $userId): array
    {
        $now = new DateTime;

        $result = DiscountCouponTable::getList([
            'filter' => [
                '=USER_ID' => $userId,
                '=ACTIVE' => true,
                [
                    'LOGIC' => 'OR',
                    ['<ACTIVE_FROM' => $now],
                    ['=ACTIVE_FROM' => null],
                ],
                '>ACTIVE_TO' => $now,
            ],
            'select' => ['ID', 'COUPON', 'ACTIVE_TO', 'NAME' => 'DISCOUNT.NAME'],
            'runtime' => [
                'DISCOUNT' => [
                    'data_type' => DiscountTable::class,
                    'reference' => ['=this.DISCOUNT_ID' => 'ref.ID'],
                ],
            ],
        ])->fetchAll();

        return array_map(static fn (array $coupon): array => array_combine(
            array_map(static fn ($key) => strtolower($key), array_keys($coupon)),
            $coupon
        ), $result);
    }

    public function createOrder(int $userId, array $data)
    {
        $user = new User($userId);

        $order = Order::create(SITE_ID, $userId);
        $order->setPersonTypeId(1); // TODO: Cut hardcode

        $basket = Storage::getInstance(Fuser::getId(), SITE_ID)->getBasket();
        $order->setBasket($basket);

        $shipmentCollection = $order->getShipmentCollection();
        $shipment = $shipmentCollection->createItem();
        $deliveryService = DeliveryServicesManager::getById($data['delivery_service']);
        $shipment->setFields([
            'DELIVERY_ID' => $deliveryService['ID'],
            'DELIVERY_NAME' => $deliveryService['NAME'],
            'DATE_ALLOW_DELIVERY' => new DateTime($data['delivery_date']),
        ]);
        $shipmentItemCollection = $shipment->getShipmentItemCollection();
        foreach ($basket->getBasketItems() as $basketItem) {
            $shipmentItem = $shipmentItemCollection->createItem($basketItem);
            $shipmentItem->setQuantity($basketItem->getQuantity());
        }

        $paymentCollection = $order->getPaymentCollection();
        $payment = $paymentCollection->createItem();
        $paySystemService = PaySystemManager::getObjectById(PaySystemManager::getInnerPaySystemId());
        $payment->setFields([
            'PAY_SYSTEM_ID' => $paySystemService->getField('PAY_SYSTEM_ID'),
            'PAY_SYSTEM_NAME' => $paySystemService->getField('NAME'),
        ]);

        if ($data['comment']) {
            $order->setField('USER_DESCRIPTION', $data['comment']);
        }

        $propertyCollection = $order->getPropertyCollection();
        $propertyCollection->getPhone()->setValue($data['phone']);

        // TODO: Выяснить причину отсутствия результата выполнения кода. Закоментировал на это время.
        // Закоментировал, так-как не обнаружил причину бага,
        // но при этом технически отсутствие этих данных не скажется на функционале.
        // $propertyCollection->getPayerName()->setValue("$data[first_name] $data[last_name]"); 

        $propertyCollection->getUserEmail()->setValue($data['email']);
        $propertyCollection->getAddress()->setValue($data['delivery_address']);
        /** @var PropertyValue $property */
        foreach ($propertyCollection as $property) {
            if ($property->getField('CODE') === 'city') {
                $property->setValue($data['city']);
            }
        }

        if ($data['order_bonuses']) {
            $this->bonusAccountHelper->addOrderBonuses($user, $data['order_bonuses']);
        }

        if ($data['bonuses_subtract']) {
            $data['bonuses_subtract'] = (float)$data['bonuses_subtract'];
            $this->bonusAccountHelper->subtractOrderBonuses($user, $data['bonuses_subtract']);
            $order->setField('PRICE', $order->getPrice() - $data['bonuses_subtract']);
        }

        $order->doFinalAction(true);
        $orderId = $order->save()->getId();

        $user->notification->sendNotification(
            NotificationTable::TYPES['order_created'],
            'Создан новый заказ',
            "/personal/orders/$orderId"
        );

        return $orderId;
    }

    public function getOrdersReport(int $userId, Date $from, Date $to)
    {
        $user = new User($userId);

        $result = [
            'self' => [
                'total_sum' => .0,
                'current_period_sum' => .0,
                'current_period_bonuses' => 0,
                'orders_count' => 0,
                'current_orders_count' => 0,
                'paid_orders_count' => 0,
                'refunded_orders_count' => 0,
                'part_refunded_orders_count' => 0,
                'full_refunded_orders_count' => 0,
                'last_month_products' => [],
                'last_order_date' => null,
            ],
            'team' => [
                'total_sum' => .0,
                'current_period_sum' => .0,
                'current_period_bonuses' => 0,
                'orders_count' => 0,
                'current_orders_count' => 0,
                'paid_orders_count' => 0,
                'refunded_orders_count' => 0,
                'part_refunded_orders_count' => 0,
                'full_refunded_orders_count' => 0,
                'last_month_products' => [],
                'last_order_date' => null,
            ],
        ];

        $transactions = TransactionTable::getList([
            'order' => ['UF_CREATED_AT' => 'ASC'],
            'filter' => [
                '=UF_USER_ID' => $user->id,
                '!=UF_ORDER_ID' => null,
            ],
            'select' => [
                'ID',
                'UF_AMOUNT',
                'UF_MEASURE',
                'UF_SOURCE',
                'UF_ORDER_ID',
                'UF_CREATED_AT',
                'ORDER_STATUS' => 'ORDER.STATUS_ID'
            ],
            'runtime' => [
                'ORDER' => [
                    'data_type' => OrderTable::class,
                    'reference' => ['this.UF_ORDER_ID' => 'ref.ID'],
                ],
            ],
        ]);

        $now = new Date;
        $checkedOrders = [];
        $lastMonthOrders = [];
        $currentAccountingPeriod = $this->loyaltyProgramHelper->getCurrentAccountingPeriod();
        $groupSourceFieldId = EnumDecorator::prepareField('UF_SOURCE', TransactionTable::SOURCES['group']);
        $pointsMeasureFieldId = EnumDecorator::prepareField('UF_MEASURE', TransactionTable::MEASURES['points']);
        foreach ($transactions as $transaction) {
            $date = new Date($transaction['UF_CREATED_AT']);
            $orderAccountingPeriod = $this->loyaltyProgramHelper->getAccountingPeriod($date);
            $source = $transaction['UF_SOURCE'] === $groupSourceFieldId ? 'team' : 'self';

            $result[$source]['last_order_date'] = $date;

            if (!in_array($transaction['UF_ORDER_ID'], $checkedOrders)) {
                switch ($transaction['ORDER_STATUS']) {
                    case self::ACCOMPLISHED_STATUS:
                        $result[$source]['paid_orders_count']++;
                        break;
                    case self::PARTLY_REFUNDED_STATUS:
                        $result[$source]['refunded_orders_count']++;
                        $result[$source]['part_refunded_orders_count']++;
                        break;
                    case self::FULL_REFUNDED_STATUS:
                        $result[$source]['refunded_orders_count']++;
                        $result[$source]['full_refunded_orders_count']++;
                        break;
                }
            }

            if ($transaction['UF_MEASURE'] === $pointsMeasureFieldId) {
                if (
                    $date->getDiff($from)->invert
                    && !$date->getDiff($to)->invert
                ) $result[$source]['current_period_bonuses'] += $transaction['UF_AMOUNT'];
            } else {
                $result[$source]['orders_count']++;
                $result[$source]['total_sum'] += $transaction['UF_AMOUNT'];

                if ($currentAccountingPeriod['name'] === $orderAccountingPeriod['name']) {
                    $result[$source]['current_orders_count']++;
                }

                if (
                    $date->getDiff($from)->invert
                    && !$date->getDiff($to)->invert
                ) $result[$source]['current_period_sum'] += $transaction['UF_AMOUNT'];

                if ($date->getDiff($now)->days <= 30) {
                    $lastMonthOrders[$source][] = $transaction['UF_ORDER_ID'];
                }
            }
            $checkedOrders[] = $transaction['UF_ORDER_ID'];
        }

        if (count($lastMonthOrders['self'])) {
            $result['self']['last_month_products'] = $this->getOrderProducts($lastMonthOrders['self']);
        }
        if (count($lastMonthOrders['team'])) {
            $result['team']['last_month_products'] = $this->getOrderProducts($lastMonthOrders['team']);
        }

        return $result;
    }

    private function getOrderProducts($orderId): array
    {
        $result = [];
        $products = ProductService::getProductDataFromBasket($orderId);
        $offers = ProductService::getProductByIds(array_column($products, 'PRODUCT_ID'));
        foreach ($products as $product) {
            $result[] = [
                'name' => $offers[$product['PRODUCT_ID']]['NAME'],
                'article' => $offers[$product['PRODUCT_ID']]['PROPERTY_ARTICLE_VALUE'],
                'price' => $product['PRICE'],
                'quantity' => (int)$product['QUANTITY'],
                'picture' => CFile::GetPath($offers[$product['PRODUCT_ID']]['PROPERTY_IMAGES_VALUE']),
            ];
        }
        return $result;
    }
}
<?php

namespace QSoft\Helper;

use Bitrix\Main\Type\DateTime;
use Bitrix\Sale\Basket\Storage;
use Bitrix\Sale\Fuser;
use Bitrix\Sale\Order;
use Bitrix\Sale\Delivery\Services\Manager as DeliveryServicesManager;
use Bitrix\Sale\OrderTable;
use Bitrix\Sale\PaySystem\Manager as PaySystemManager;
use Bitrix\Sale\PropertyValue;
use CFile;
use QSoft\Entity\User;
use QSoft\ORM\NotificationTable;
use QSoft\ORM\TransactionTable;
use QSoft\Service\ProductService;

class OrderHelper
{
    private BonusAccountHelper $bonusAccountHelper;
    private LoyaltyProgramHelper $loyaltyProgramHelper;

    public function __construct()
    {
        $this->bonusAccountHelper = new BonusAccountHelper;
        $this->loyaltyProgramHelper = new LoyaltyProgramHelper;
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
        $propertyCollection->getPayerName()->setValue("$data[first_name] $data[last_name]");
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

    public function getOrdersReport(int $userId)
    {
        $result = [
            'total_sum' => .0,
            'current_period_sum' => .0,
            'current_period_bonuses' => 0,
            'paid_orders_count' => 0,
            'full_refunded_orders_count' => 0, // TODO
            'part_refunded_orders_count' => 0, // TODO
            'last_month_products' => [],
            'last_order_date' => null,
        ];

        $user = new User($userId);
        $currentAccountingPeriod = $this->loyaltyProgramHelper->getCurrentAccountingPeriod();

        $orders = OrderTable::getList([
            'order' => ['DATE_INSERT' => 'ASC'],
            'filter' => [
                '=USER_ID' => $user->id,
            ],
            'select' => ['ID', 'PRICE', 'DATE_INSERT', 'SUM_PAID'],
        ])->fetchAll();

        $transactions = TransactionTable::getList([
            'filter' => [
                '=UF_USER_ID' => $user->id,
                '=UF_MEASURE' => TransactionTable::MEASURES['points'],
            ],
            'select' => ['ID', 'UF_AMOUNT'],
        ])->fetchAll();

        foreach ($transactions as $transaction) {
            $result['current_period_bonuses'] += $transaction['UF_AMOUNT'];
        }

        $now = new DateTime;
        $lastMonthOrders = [];
        foreach ($orders as $order) {
            $result['total_sum'] += $order['PRICE'];

            $orderDate = new DateTime($order['DATE_INSERT']);
            $result['last_order_date'] = $orderDate;

            if (
                $orderDate->getDiff($currentAccountingPeriod['from'])->invert
                && !$orderDate->getDiff($currentAccountingPeriod['to'])->invert
            ) {
                $result['current_period_sum'] += $order['PRICE'];
            }

            if ($order['PRICE'] === $order['SUM_PAID']) {
                $result['paid_orders_count']++;
            }

            if ($orderDate->getDiff($now)->days <= 30) {
                $lastMonthOrders[] = $order['ID'];
            }
        }

        if (count($lastMonthOrders)) {
            $products = ProductService::getProductOfferDataClass()::getList([
                'filter' => [
                    '=BASKET.ORDER_ID' => $lastMonthOrders,
                ],
                'select' => [
                    'NAME',
                    'VENDOR_CODE' => 'ARTICLE.VALUE',
                    'PRICE' => 'BASKET.PRICE',
                    'QUANTITY' => 'BASKET.QUANTITY',
                    'PICTURE' => 'PREVIEW_PICTURE',
                ],
            ])->fetchAll();

            foreach ($products as $product) {
                $result['last_month_products'][] = [
                    'name' => $product['NAME'],
                    'article' => $product['VENDOR_CODE'],
                    'price' => $product['PRICE'],
                    'quantity' => $product['QUANTITY'],
                    'picture' => CFile::GetPath($product['PICTURE']),
                ];
            }
        }

        return $result;
    }
}
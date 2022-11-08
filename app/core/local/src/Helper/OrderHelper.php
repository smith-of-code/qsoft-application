<?php

namespace QSoft\Helper;

use Bitrix\Main\Type\Date;
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

    public function getOrdersReport(int $userId, Date $from, Date $to)
    {
        $user = new User($userId);

        $result = [
            'self' => [
                'total_sum' => .0,
                'current_period_sum' => .0,
                'current_period_bonuses' => 0,
                'paid_orders_count' => 0,
                'part_refunded_orders_count' => 0,
                'full_refunded_orders_count' => 0,
                'last_month_products' => [],
                'last_order_date' => null,
            ],
            'team' => [
                'total_sum' => .0,
                'current_period_sum' => .0,
                'current_period_bonuses' => 0,
                'paid_orders_count' => 0,
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
        $lastMonthOrders = [];
        $groupSourceFieldId = EnumDecorator::prepareField('UF_SOURCE', TransactionTable::SOURCES['group']);
        $pointsMeasureFieldId = EnumDecorator::prepareField('UF_MEASURE', TransactionTable::MEASURES['points']);
        foreach ($transactions as $transaction) {
            $date = new Date($transaction['UF_CREATED_AT']);
            $source = $transaction['UF_SOURCE'] === $groupSourceFieldId ? 'team' : 'self';

            $result[$source]['last_order_date'] = $date;

            switch ($transaction['ORDER_STATUS']) {
                case self::ACCOMPLISHED_STATUS:
                    $result[$source]['paid_orders_count']++;
                    break;
                case self::PARTLY_REFUNDED_STATUS:
                    $result[$source]['part_refunded_orders_count']++;
                    break;
                case self::FULL_REFUNDED_STATUS:
                    $result[$source]['full_refunded_orders_count']++;
                    break;
            }

            if ($transaction['UF_MEASURE'] === $pointsMeasureFieldId) {
                if (
                    $date->getDiff($from)->invert
                    && !$date->getDiff($to)->invert
                ) $result[$source]['current_period_bonuses'] += $transaction['UF_AMOUNT'];
            } else {
                $result[$source]['total_sum'] += $transaction['UF_AMOUNT'];

                if (
                    $date->getDiff($from)->invert
                    && !$date->getDiff($to)->invert
                ) $result[$source]['current_period_sum'] += $transaction['UF_AMOUNT'];

                if ($date->getDiff($now)->days <= 30) {
                    $lastMonthOrders[] = $transaction['UF_ORDER_ID'];
                }
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
<?php

namespace QSoft\Helper;

use Bitrix\Main\Type\DateTime;
use Bitrix\Sale\Basket\Storage;
use Bitrix\Sale\Fuser;
use Bitrix\Sale\Internals\DiscountCouponTable;
use Bitrix\Sale\Internals\DiscountTable;
use Bitrix\Sale\Internals\OrderCouponsTable;
use Bitrix\Sale\Order;
use Bitrix\Sale\Delivery\Services\Manager as DeliveryServicesManager;
use Bitrix\Sale\OrderTable;
use Bitrix\Sale\PaySystem\Manager as PaySystemManager;
use Bitrix\Sale\PropertyValue;
use QSoft\Entity\User;
use QSoft\ORM\Decorators\EnumDecorator;
use QSoft\ORM\NotificationTable;
use QSoft\ORM\TransactionTable;

class OrderHelper
{
    private BonusAccountHelper $bonusAccountHelper;

    public function __construct()
    {
        $this->bonusAccountHelper = new BonusAccountHelper;
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

        return array_map(static function (array $order): array {
            return array_combine(
                array_map(static fn (string $key): string => strtolower($key), array_keys($order)),
                $order
            );
        }, $result);
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
            'select' => ['ID', 'COUPON', 'ACTIVE_TO', 'SHORT_DESCRIPTION' => 'DISCOUNT.SHORT_DESCRIPTION'],
            'runtime' => [
                'DISCOUNT' => [
                    'data_type' => DiscountTable::class,
                    'reference' => ['=this.DISCOUNT_ID' => 'ref.ID'],
                ],
            ],
        ])->fetchAll();

        $result = array_map(static function (array $coupon): array {
            return array_combine(
                array_map(static fn ($key) => strtolower($key), array_keys($coupon)),
                $coupon
            );
        }, $result);

        foreach ($result as &$item) {
            if ($description = unserialize($item['short_description'])) {
                $item['short_description'] = array_combine(
                    array_map(static fn ($key) => strtolower($key), array_keys($description)),
                    $description,
                );
            }
        }

        return $result;
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
}
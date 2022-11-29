<?php

namespace QSoft\Events;

use Bitrix\Sale\PropertyValue;
use QSoft\Entity\User;
use QSoft\Helper\BonusAccountHelper;
use QSoft\Helper\OrderHelper;
use QSoft\Notifiers\ChangeOrderStatusNotifier;
use Bitrix\Sale\Order;
use QSoft\ORM\TransactionTable;

class OrderEventsListener
{
    public static function OnSaleStatusOrder(int $orderId, string $status): void
    {
        $order = Order::load($orderId);
        $user = new User(Order::load($orderId)->getUserId());

        $notifier = new ChangeOrderStatusNotifier($orderId, $status);
        $user->notification->sendNotification(
            $notifier->getTitle(),
            $notifier->getMessage(),
            $notifier->getLink()
        );

        if ($status === OrderHelper::ACCOMPLISHED_STATUS) {
            $bonusesData = null;
            /** @var PropertyValue $property */
            foreach ($order->getPropertyCollection() as $property) {
                if ($property->getField('CODE') === 'BONUSES_DATA') {
                    $bonusesData = json_decode($property->getField('VALUE'), true);
                    break;
                }
            }
            if ($bonusesData) {
                $bonusAccountHelper = new BonusAccountHelper;
                foreach ($bonusesData as $data) {
                    $tmpUser = new User($data['user_id']);
                    $bonusAccountHelper->addOrderBonuses($tmpUser, $data['value'], TransactionTable::SOURCES['group']);
                }
            }
        }
    }
}

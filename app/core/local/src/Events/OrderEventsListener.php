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
        $bonusAccountHelper = new BonusAccountHelper;

        $order = Order::load($orderId);
        $user = new User(Order::load($orderId)->getUserId());

        $notifier = new ChangeOrderStatusNotifier($orderId, $status);
        $user->notification->sendNotification(
            $notifier->getTitle(),
            $notifier->getMessage(),
            $notifier->getLink()
        );

        switch ($status) {
            case OrderHelper::ACCOMPLISHED_STATUS:
                $bonusesData = null;
                /** @var PropertyValue $property */
                foreach ($order->getPropertyCollection() as $property) {
                    if ($property->getField('CODE') === 'BONUSES_DATA') {
                        $bonusesData = json_decode($property->getField('VALUE'), true);
                        break;
                    }
                }
                if ($bonusesData) {
                    foreach ($bonusesData as $data) {
                        $tmpUser = new User($data['user_id']);
                        $bonusAccountHelper->addOrderBonuses($tmpUser, $data['value'], $data['source'], $data['type']);
                    }
                }
                break;
            case OrderHelper::CANCELLED_STATUS:
            case OrderHelper::FULL_REFUNDED_STATUS:
            case OrderHelper::PARTLY_REFUNDED_STATUS:
                $bonuses = null;
                $bonusesAreReturned = null;
                /** @var PropertyValue $property */
                foreach ($order->getPropertyCollection() as $property) {
                    if ($property->getField('CODE') === 'BONUSES_ARE_RETURNED') {
                        $bonusesAreReturned = $property->getField('VALUE') === 'Y';
                        if (!$bonusesAreReturned) {
                            $property->setField('VALUE', 'Y');
                        }
                    } elseif ($property->getField('CODE') === 'POINTS') {
                        $bonuses = (int)$property->getField('VALUE');
                    }
                }

                if (!$bonusesAreReturned && $bonuses) {
                    $bonusAccountHelper->refundOrderBonuses($user, $bonuses);
                }
                break;
        }

        $order->save();
    }
}

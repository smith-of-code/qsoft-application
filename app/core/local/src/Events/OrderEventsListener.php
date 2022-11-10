<?php

namespace QSoft\Events;

use QSoft\Entity\User;
use QSoft\Notifiers\ChangeOrderStatusNotifier;
use \Bitrix\Sale\Order;

class OrderEventsListener
{
    public static function sendChangeOrderStatusNotification(int $orderId, string $statusId): void
    {
        $notifier = new ChangeOrderStatusNotifier($orderId, $statusId);
        $userId = Order::load($orderId)->getUserId();
        (new User($userId))->notification->sendNotification($notifier->getTitle(), $notifier->getMessage(), $notifier->getLink());
    }
}

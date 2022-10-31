<?php

namespace QSoft\Events;

use QSoft\Entity\User;

class OrderEventsListener
{
    public static function OnSaleStatusOrder(int $orderId, string $statusId): void
    {
        $notifier = new ChangeOrderStatusNotifier($orderId, $statusId);
        (new User())->notification->sendNotification($notifier->getTitle(), $notifier->getMessage(), $notifier->getLink());
    }
}
<?php

namespace QSoft\Events;

use QSoft\Entity\User;
use QSoft\Notifiers\ChangeOrderStatusNotifier;

class OrderEventsListener
{
    public static function sendChangeOrderStatusNotification(int $orderId, string $statusId): void
    {
        $notifier = new ChangeOrderStatusNotifier($orderId, $statusId);
        (new User())->notification->sendNotification($notifier->getTitle(), $notifier->getMessage(), $notifier->getLink());
    }
}

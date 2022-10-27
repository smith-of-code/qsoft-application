<?php

namespace QSoft\Events;

use QSoft\Entity\User;
use QSoft\Service\NotificationService;

class OrderEventsListener
{
    public static function OnSaleStatusOrder(int $orderId, int $statusId): void
    {
        $statusValue = "Значение статуса заказа"; //получить значение статуса заказа по $statusId, $orderId
        $service = new NotificationService(new User());
        $service->sendNotification(
            $statusValue,
            "тестовое сообщение",
        "Тестовая ссылка"
        );
    }
}
<?php

namespace QSoft\Events;

use QSoft\Entity\User;
use QSoft\Service\NotificationService;
use \Bitrix\Sale\Internals\StatusLangTable;


class OrderEventsListener
{
    public static function OnSaleStatusOrder(int $orderId, string $statusId): void
    {
        $statusName = StatusLangTable::getRowById(['STATUS_ID' => $statusId, 'LID' => 'ru'])['NAME'];
        $title = "Ваш заказ №" . $orderId . " " . $statusName;
        $message = "тестовое сообщение";
        $link = "Тестовая ссылка на страницу заказа";
        $service = new NotificationService(new User());
        $service->sendNotification(
            $title,
            $message,
            $link,
        );
    }
}
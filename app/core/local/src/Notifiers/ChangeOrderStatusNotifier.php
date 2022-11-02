<?php

namespace QSoft\Notifiers;

class ChangeOrderStatusNotifier extends NotificationContent
{
    private int $orderId;
    private string $statusId;

    public function __construct(int $orderId, string $statusId)
    {
        parent::__construct();
        $this->orderId = $orderId;
        $this->statusId = $statusId;
    }

    public function getTitle(): string
    {
        return "Ваш заказ №" . $this->orderId . " " . $this->notificationContent[$this->statusId]['name'];
    }

    public function getMessage(): string
    {
        return $this->notificationContent['message'];
    }

    public function getLink(): string
    {
        return $this->notificationContent['link_template'] . $this->orderId;
    }

    protected function getNotificationType(): string
    {
        return 'CHANGE_ORDER_STATUS';
    }
}
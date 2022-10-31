<?php

namespace QSoft\Events;

use Bitrix\Sale\Internals\StatusLangTable;

class ChangeOrderStatusNotifier implements Notifier
{
    private int $orderId;
    private string $statusId;

    public function __construct(int $orderId, string $statusId)
    {
        $this->orderId = $orderId;
        $this->statusId = $statusId;
    }

    public function getTitle(): string
    {
        return "Ваш заказ №" . $this->orderId . " " . mb_strtolower($this->getOrderStatusName());
    }

    public function getMessage(): string
    {
        return "Статус Вашего заказа был изменен. Информацию о заказе Вы можете узнать на детальной странице заказа";
    }

    public function getLink(): string
    {
        return "/personal/order/" . $this->orderId;
    }

    private function getOrderStatusName(): string
    {
        return StatusLangTable::getRowById(['STATUS_ID' => $this->statusId, 'LID' => 'ru'])['NAME'];
    }
}
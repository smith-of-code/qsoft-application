<?php

namespace QSoft\Notifiers;

use Bitrix\Sale\StatusLangTable;
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
        $replacement = [
            '#order_id#' => $this->orderId,
            '#status_name#' => mb_strtolower(StatusLangTable::getRowById($this->statusId)['NAME']),
        ];
        return str_replace(array_keys($replacement), array_values($replacement), $this->notificationContent['title_template']);
    }

    public function getMessage(): string
    {
        return $this->notificationContent['message'];
    }

    public function getLink(): string
    {
        return str_replace('#order_id#', $this->orderId, $this->notificationContent['link_template']);
    }

    protected function getNotificationType(): string
    {
        return 'CHANGE_ORDER_STATUS';
    }
}
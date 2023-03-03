<?php

namespace QSoft\Notifiers;

use Bitrix\Sale\StatusLangTable;
class ChangeOrderNotifier extends NotificationContent
{
    private int $orderId;
    private string $statusId;
    private string $typeNotification;

    public function __construct(int $orderId, string $statusId)
    {
        parent::__construct();
        $this->orderId = $orderId;
        $this->statusId = $statusId;

        $this->typeNotification = ($this->statusId == 'SAME') ? 'CHANGE_ORDER' : 'CHANGE_STATUS';
    }

    public function getTitle(): string
    {
        $statusName = ($this->statusId == 'DEL') ? 'удален' : mb_strtolower(StatusLangTable::getRowById($this->statusId)['NAME']);

        $replacement = [
            '#order_id#' => $this->orderId,
            '#status_name#' => $statusName,
        ];
        return str_replace(array_keys($replacement), array_values($replacement), $this->notificationContent[$this->typeNotification]['title_template']);
    }

    public function getMessage(): string
    {
        return $this->notificationContent[$this->typeNotification]['message'];
    }

    public function getLink(): string
    {
        return str_replace('#order_id#', $this->orderId, $this->notificationContent[$this->typeNotification]['link_template']);
    }

    protected function getNotificationType(): string
    {
        return 'CHANGE_ORDER';
    }
}
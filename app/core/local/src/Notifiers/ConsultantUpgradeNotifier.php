<?php

namespace QSoft\Notifiers;

use QSoft\Entity\User;

class ConsultantUpgradeNotifier extends NotificationContent
{

    private array $fields;
    private string $typeNotification;

    public function __construct(string $typeNotification, array $fields = [])
    {
        parent::__construct();

        $this->fields = $fields;
        $this->typeNotification = $typeNotification;
    }

    public function getTitle(): string
    {
        return $this->notificationContent[$this->typeNotification]['link_template'] ?? $this->notificationContent['title'];
    }

    public function getMessage(): string
    {
        $replacement = [
            '#to#' => $this->fields['to'],
            '#discount#' => $this->fields['discount'],
            '#shortage#' => $this->fields['shortage'],
            '#level#' => $this->fields['level'],
        ];

        return str_replace(array_keys($replacement), array_values($replacement), $this->notificationContent[$this->typeNotification]['message']);
    }

    public function getLink(): string
    {
        return $this->notificationContent[$this->typeNotification]['link_template'] ?? $this->notificationContent['link'];
    }

    protected function getNotificationType(): string
    {
        return 'CONSULTANT_UPGRADE';
    }
}
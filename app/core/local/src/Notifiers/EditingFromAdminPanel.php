<?php

namespace QSoft\Notifiers;

use QSoft\Entity\User;

class EditingFromAdminPanel extends NotificationContent
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

        return $this->notificationContent[$this->typeNotification]['title_template'];
    }

    public function getMessage(): string
    {
        $mentor = new User($this->fields['UF_MENTOR_ID']);
        $replacement = [
            '#FIO#' => $mentor->getFullName(),
            '#phone#' => $mentor->getPersonalData()['phone'],
        ];

        return str_replace(array_keys($replacement), array_values($replacement), $this->notificationContent[$this->typeNotification]['message']);
    }

    public function getLink(): string
    {
        return $this->notificationContent[$this->typeNotification]['link_template'];
    }

    protected function getNotificationType(): string
    {
        return 'ADMIN_EDIT';
    }
}
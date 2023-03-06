<?php

namespace QSoft\Notifiers;

use QSoft\Entity\User;

class EditingFromAdminPanelNotifier extends NotificationContent
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

    /**
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     * @throws \Bitrix\Main\ArgumentException
     */
    public function getMessage(): string
    {
        $replacement = [
            '#FIO#' => 'наставник не задан',
            '#phone#' => 'наставник не задан',
        ];

        if (isset($this->fields['UF_MENTOR_ID']) && $this->fields['UF_MENTOR_ID'] > 0) {
            $mentor = new User(intval($this->fields['UF_MENTOR_ID']));

            if (isset($mentor) && $mentor instanceof User) {
                $replacement = [
                    '#FIO#' => $mentor->getFullName(),
                    '#phone#' => $mentor->getPersonalData()['phone'],
                ];
            }
        }

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
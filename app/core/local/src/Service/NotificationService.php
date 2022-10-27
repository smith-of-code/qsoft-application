<?php

namespace QSoft\Service;

use QSoft\Entity\User;
use QSoft\ORM\NotificationTable;

class NotificationService
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public static function getUnreadNotify(): int
    {
        return NotificationTable::getList([
            'filter' => [
                'UF_USER_ID' => $userId,
                'UF_STATUS' => 'NOTIFICATION_STATUS_UNREAD',
            ],
        ])->getSelectedRowsCount();
    }

    public function sendNotification(string $title, string $message, string $link, string $type = ''): bool
    {
/*
        if (!in_array($type, NotificationTable::TYPES)) {
            throw new \RuntimeException('Unknown notification type');
        }
*/
        return NotificationTable::add([
            'UF_TITLE' => $title,
            'UF_USER_ID' => $this->user->id,
            'UF_TYPE' => $type,
            'UF_STATUS' => NotificationTable::STATUSES['unread'],
            'UF_MESSAGE' => $message,
            'UF_LINK' => $link,
        ])->isSuccess();
    }

}
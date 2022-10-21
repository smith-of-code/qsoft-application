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
}
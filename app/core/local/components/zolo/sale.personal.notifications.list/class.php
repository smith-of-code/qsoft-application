<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true);

use QSoft\Entity\User;
?>

<?php

class NotificationListComponent extends CBitrixComponent
{
    private const NOTIFICATIONS_LIMIT = 1;
    public function executeComponent()
    {
        $this->arResult = $this->loadNotificationsAction();
        $this->includeComponentTemplate();
    }

    private function loadNotificationsAction($offset = 0): array
    {
        $user = new User();
        $notificationTable = $user->notification->getDataClass();
        $notifications = $notificationTable::getList([
                'select' => ['NAME'=> 'TYPE_NAME.VALUE', 'STATUS' => 'STATUS_NAME.VALUE', 'MESSAGE' => 'UF_MESSAGE', 'LINK' => 'UF_LINK'],
                'filter' => ['UF_USER_ID' => $user->id],
                'offset' => $offset,
                'limit' => self::NOTIFICATIONS_LIMIT,
            ]
        )->fetchAll();
        return [
            'NOTIFICATIONS' => $notifications,
            'OFFSET' => $offset + count($notifications),
        ];
    }
}

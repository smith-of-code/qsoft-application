<?php
if (! defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Errorable;
use Bitrix\Main\ErrorCollection;
use Bitrix\Main\Localization\Loc;
use \QSoft\Entity\User;
use \Bitrix\Main\Engine\Contract\Controllerable;
use \Bitrix\Main\Engine\ActionFilter;
use QSoft\ORM\NotificationTable;

class NotificationListComponent extends CBitrixComponent implements Controllerable, Errorable
{
    private const NOTIFICATIONS_LIMIT = 2;
    protected ErrorCollection $errorCollection;

    public function configureActions()
    {
        return [
            'loadNotifications' => [
                '-prefilters' => [
                    ActionFilter\Csrf::class,
                ]
            ]
        ];
    }

    public function onPrepareComponentParams($arParams)
    {
        $this->errorCollection = new ErrorCollection();
    }

    public function executeComponent()
    {
        $this->arResult = $this->loadNotificationsAction([], 0, self::NOTIFICATIONS_LIMIT);
        $this->includeComponentTemplate();
    }

    public function loadNotificationsAction(array $filter, int $offset, int $limit): array
    {
        $notifications = (new User())->notification->getNotifications($filter, $offset, $limit);
        return [
            'NOTIFICATIONS' => $notifications,
            'OFFSET' => $offset + count($notifications),
        ];
    }

    public function readMessageAction(int $notificationId): array
    {
        $service = (new User())->notification;
        if (! $service->has($notificationId)) {
            $this->errorCollection[] = new Error(Loc::getMessage('NOTIFICATION_NOT_FOUND'));
            return [];
        }
        $readResult = $service->read($notificationId);
        if ($readResult->isSuccess()) {
            return ['status' => $service->getStatusValueById($readResult->getData()['UF_STATUS'])];
        } else {
            $this->errorCollection[] = $readResult->getErrorCollection();
            return [];
        }
    }

    public function getErrors()
    {
        return $this->errorCollection->toArray();
    }

    public function getErrorByCode($code)
    {
        return $this->errorCollection->getErrorByCode($code);
    }
}

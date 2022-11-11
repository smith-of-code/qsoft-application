<?php
if (! defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Error;
use Bitrix\Main\Errorable;
use Bitrix\Main\ErrorCollection;
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\SystemException;
use \QSoft\Entity\User;
use \Bitrix\Main\Engine\Contract\Controllerable;
use \Bitrix\Main\Engine\ActionFilter;

class NotificationListComponent extends CBitrixComponent implements Controllerable, Errorable
{
    private const NOTIFICATIONS_LIMIT = 20;
    const NOTIFICATIONS_URL = '/personal/notifications/';
    protected ErrorCollection $errorCollection;
    private User $user;

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
        $this->checkModules();
        $this->user = new User();
    }

    public function checkModules()
    {
        if (!Loader::includeModule('highloadblock')) {
            throw new SystemException(Loc::GetMessage('PSETTINGS_HLBLOCK_NOT_INCLUDED'));
        }
    }

    public function executeComponent()
    {
        $this->arResult = $this->loadNotificationsAction([], 0, self::NOTIFICATIONS_LIMIT);
        $this->includeComponentTemplate();
    }

    public function loadNotificationsAction(array $filter, int $offset, int $limit): array
    {
        $notifications = $this->user->notification->getNotifications($filter, $offset, $limit);

        $unreadNotificationsCount = $this->user->notification->getUnreadCount();
        return [
            'NOTIFICATIONS' => $notifications,
            'OFFSET' => $offset + count($notifications),
            'UNREAD_COUNT' => $unreadNotificationsCount,
            'NOTIFICATIONS_URL' => self::NOTIFICATIONS_URL
        ];
    }

    public function readMessageAction(int $notificationId): array
    {
        $service = $this->user->notification;
        if (! $service->has($notificationId)) {
            $this->errorCollection[] = new Error(Loc::getMessage('NOTIFICATION_NOT_FOUND'));
            return [];
        }
        $readResult = $service->read($notificationId);
        if ($readResult->isSuccess()) {
            return ['status' => $service->getStatusValueById($readResult->getData()['UF_STATUS'])];
        } else {
            $this->errorCollection = $readResult->getErrorCollection();
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

<?php

namespace QSoft\Notifiers;

abstract class NotificationContent implements Notifier
{
    private const CONFIG = 'notification_content';
    protected array $notificationContent;

    protected function __construct()
    {
        $this->notificationContent = app('config')->get(self::CONFIG)[$this->getNotificationType()];
    }

    protected abstract function getNotificationType(): string;
}
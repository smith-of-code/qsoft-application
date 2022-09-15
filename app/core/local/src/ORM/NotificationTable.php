<?php

namespace QSoft\ORM;

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Entity;

Loc::loadMessages(__FILE__);

class NotificationTable extends Entity\DataManager
{
    const TYPES = [
        'NOTIFICATION_TYPE_APPLICATION_STATUS_CHANGE',
        'NOTIFICATION_TYPE_ORDER_CREATED',
        'NOTIFICATION_TYPE_ORDER_STATUS_CHANGE',
        'NOTIFICATION_TYPE_ORDER_READY',
        'NOTIFICATION_TYPE_ORDER_CANCELED',
    ];

    const STATUSES = [
        'NOTIFICATION_STATUS_UNREAD',
        'NOTIFICATION_STATUS_READ',
    ];

    public static function getTableName(): string
    {
        return 'transaction';
    }

    public static function getMap(): array
    {
        return [
            new Entity\IntegerField('ID', [
                'primary' => true,
                'autocomplete' => true,
                'title' => Loc::getMessage('NOTIFICATION_ENTITY_ID_FIELD'),
            ]),
            new Entity\IntegerField('UF_USER_ID', [
                'required' => true,
                'title' => Loc::getMessage('NOTIFICATION_ENTITY_UF_USER_ID_FIELD'),
            ]),
            new Entity\EnumField('UF_TYPE', [
                'required' => true,
                'values' => self::TYPES,
                'title' => Loc::getMessage('NOTIFICATION_ENTITY_UF_TYPE_FIELD'),
            ]),
            new Entity\EnumField('UF_STATUS', [
                'required' => true,
                'values' => self::STATUSES,
                'title' => Loc::getMessage('NOTIFICATION_ENTITY_UF_SOURCE_FIELD'),
            ]),
            new Entity\StringField('UF_MESSAGE', [
                'required' => true,
                'title' => Loc::getMessage('NOTIFICATION_ENTITY_UF_MESSAGE_FIELD'),
            ]),
            new Entity\StringField('UF_LINK', [
                'required' => true,
                'title' => Loc::getMessage('NOTIFICATION_ENTITY_UF_LINK_FIELD'),
            ]),
        ];
    }
}

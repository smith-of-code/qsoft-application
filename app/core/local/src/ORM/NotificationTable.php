<?php

namespace QSoft\ORM;

use Bitrix\Main\Entity\IntegerField;
use Bitrix\Main\Entity\StringField;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\SystemException;
use QSoft\ORM\Decorators\EnumDecorator;
use QSoft\ORM\Entity\EnumField;

Loc::loadMessages(__FILE__);

final class NotificationTable extends BaseTable
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

    protected static array $decorators = [
        'UF_TYPE' => EnumDecorator::class,
        'UF_STATUS' => EnumDecorator::class,
    ];

    public static function getTableName(): string
    {
        return 'transaction';
    }

    /**
     * @throws SystemException
     */
    public static function getMap(): array
    {
        return [
            new IntegerField('ID', [
                'primary' => true,
                'autocomplete' => true,
                'title' => Loc::getMessage('NOTIFICATION_ENTITY_ID_FIELD'),
            ]),
            new IntegerField('UF_USER_ID', [
                'required' => true,
                'title' => Loc::getMessage('NOTIFICATION_ENTITY_UF_USER_ID_FIELD'),
            ]),
            new EnumField('UF_TYPE', [
                'required' => true,
                'title' => Loc::getMessage('NOTIFICATION_ENTITY_UF_TYPE_FIELD'),
            ], self::getTableName()),
            new EnumField('UF_STATUS', [
                'required' => true,
                'title' => Loc::getMessage('NOTIFICATION_ENTITY_UF_SOURCE_FIELD'),
            ], self::getTableName()),
            new StringField('UF_MESSAGE', [
                'required' => true,
                'title' => Loc::getMessage('NOTIFICATION_ENTITY_UF_MESSAGE_FIELD'),
            ]),
            new StringField('UF_LINK', [
                'required' => true,
                'title' => Loc::getMessage('NOTIFICATION_ENTITY_UF_LINK_FIELD'),
            ]),
        ];
    }
}

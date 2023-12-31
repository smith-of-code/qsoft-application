<?php

namespace QSoft\ORM;

use Bitrix\Main\Entity\IntegerField;
use Bitrix\Main\Entity\StringField;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ORM\Fields\DatetimeField;
use Bitrix\Main\SystemException;
use QSoft\ORM\Decorators\EnumDecorator;
use QSoft\ORM\Entity\EnumField;
use \Bitrix\Main\Type\DateTime;



Loc::loadMessages(__FILE__);

final class NotificationTable extends BaseTable
{
    const STATUSES = [
        'unread' => 'NOTIFICATION_STATUS_UNREAD',
        'read' => 'NOTIFICATION_STATUS_READ',
    ];

    const TYPES = [
        'order_created' => 'создание заказа',
    ];

    protected static array $decorators = [
        'UF_STATUS' => EnumDecorator::class,
    ];

    public static function getTableName(): string
    {
        return 'notification';
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
            new StringField('UF_TITLE', [
                'required' => true,
                'title' => Loc::getMessage('NOTIFICATION_ENTITY_UF_TITLE_FIELD'),
            ]),
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
            new DatetimeField('UF_DATE_TIME', [
                'required' => true,
                'title' => Loc::getMessage('NOTIFICATION_ENTITY_DATE_TIME_FIELD'),
                'default_value' => new DateTime(),
            ]),
        ];
    }
}

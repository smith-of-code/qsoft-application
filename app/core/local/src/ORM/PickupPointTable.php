<?php

namespace QSoft\ORM;

use Bitrix\Main\Entity\IntegerField;
use Bitrix\Main\Entity\StringField;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\SystemException;
use QSoft\ORM\Decorators\EnumDecorator;
use QSoft\ORM\Entity\EnumField;

Loc::loadMessages(__FILE__);

final class PickupPointTable extends BaseTable
{
    protected static array $decorators = [
        'UF_CITY' => EnumDecorator::class,
    ];

    public static function getTableName(): string
    {
        return 'pickup_point';
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
                'title' => Loc::getMessage('PICKUP_POINT_ENTITY_ID_FIELD'),
            ]),
            new StringField('UF_NAME', [
                'required' => true,
                'title' => Loc::getMessage('PICKUP_POINT_ENTITY_UF_NAME_FIELD'),
            ]),
            new StringField('UF_DESCRIPTION', [
                'required' => true,
                'title' => Loc::getMessage('PICKUP_POINT_ENTITY_UF_DESCRIPTION_FIELD'),
            ]),
            new EnumField('UF_CITY', [
                'required' => true,
                'title' => Loc::getMessage('PICKUP_POINT_ENTITY_UF_CITY_FIELD'),
            ], self::getTableName()),
            new StringField('UF_WORKING_HOURS_START', [
                'required' => true,
                'title' => Loc::getMessage('PICKUP_POINT_ENTITY_UF_WORKING_HOURS_START_FIELD'),
            ]),
            new StringField('UF_WORKING_HOURS_END', [
                'required' => true,
                'title' => Loc::getMessage('PICKUP_POINT_ENTITY_UF_WORKING_HOURS_END_FIELD'),
            ]),
            new StringField('UF_ADDRESS', [
                'required' => true,
                'title' => Loc::getMessage('PICKUP_POINT_ENTITY_UF_ADDRESS_FIELD'),
            ]),
            new StringField('UF_COORDINATES', [
                'required' => true,
                'title' => Loc::getMessage('PICKUP_POINT_ENTITY_UF_PHONE_FIELD'),
            ]),
        ];
    }
}

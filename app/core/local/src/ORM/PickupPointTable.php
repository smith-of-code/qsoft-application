<?php

namespace QSoft\ORM;

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Entity;

Loc::loadMessages(__FILE__);

class PickupPointTable extends Entity\DataManager
{
    // TODO
    const CITIES = [
        'PICKUP_POINT_CITY_MOSCOW',
        'PICKUP_POINT_CITY_SPB',
    ];

    public static function getTableName(): string
    {
        return 'pickup_point';
    }

    public static function getMap(): array
    {
        return [
            new Entity\IntegerField('ID', [
                'primary' => true,
                'autocomplete' => true,
                'title' => Loc::getMessage('PICKUP_POINT_ENTITY_ID_FIELD'),
            ]),
            new Entity\StringField('UF_NAME', [
                'required' => true,
                'title' => Loc::getMessage('PICKUP_POINT_ENTITY_UF_NAME_FIELD'),
            ]),
            new Entity\StringField('UF_DESCRIPTION', [
                'required' => true,
                'title' => Loc::getMessage('PICKUP_POINT_ENTITY_UF_DESCRIPTION_FIELD'),
            ]),
            new Entity\EnumField('UF_CITY', [
                'required' => true,
                'values' => self::CITIES,
                'title' => Loc::getMessage('PICKUP_POINT_ENTITY_UF_CITY_FIELD'),
            ]),
            new Entity\StringField('UF_WORKING_HOURS_START', [
                'required' => true,
                'title' => Loc::getMessage('PICKUP_POINT_ENTITY_UF_WORKING_HOURS_START_FIELD'),
            ]),
            new Entity\StringField('UF_WORKING_HOURS_END', [
                'required' => true,
                'title' => Loc::getMessage('PICKUP_POINT_ENTITY_UF_WORKING_HOURS_END_FIELD'),
            ]),
            new Entity\StringField('UF_ADDRESS', [
                'required' => true,
                'title' => Loc::getMessage('PICKUP_POINT_ENTITY_UF_ADDRESS_FIELD'),
            ]),
            new Entity\StringField('UF_COORDINATES', [
                'required' => true,
                'title' => Loc::getMessage('PICKUP_POINT_ENTITY_UF_PHONE_FIELD'),
            ]),
        ];
    }
}

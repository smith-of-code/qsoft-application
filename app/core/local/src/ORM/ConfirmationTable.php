<?php

namespace QSoft\ORM;

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Entity;

Loc::loadMessages(__FILE__);

class ConfirmationTable extends Entity\DataManager
{
    const CHANNELS = [
        'CONFIRMATION_CHANNEL_SMS',
        'CONFIRMATION_CHANNEL_EMAIL',
    ];

    const TYPES = [
        'CONFIRMATION_TYPE_PASSWORD_RESET',
        'CONFIRMATION_TYPE_EMAIL_CONFIRMATION',
        'CONFIRMATION_TYPE_PHONE_CONFIRMATION',
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
                'title' => Loc::getMessage('CONFIRMATION_ENTITY_ID_FIELD'),
            ]),
            new Entity\IntegerField('UF_USER_ID', [
                'required' => true,
                'title' => Loc::getMessage('CONFIRMATION_ENTITY_UF_USER_ID_FIELD'),
            ]),
            new Entity\EnumField('UF_CHANNEL', [
                'required' => true,
                'values' => self::CHANNELS,
                'title' => Loc::getMessage('CONFIRMATION_ENTITY_UF_CHANNEL_FIELD'),
            ]),
            new Entity\EnumField('UF_TYPE', [
                'required' => true,
                'values' => self::TYPES,
                'title' => Loc::getMessage('CONFIRMATION_ENTITY_UF_TYPE_FIELD'),
            ]),
            new Entity\StringField('UF_CODE', [
                'required' => true,
                'title' => Loc::getMessage('CONFIRMATION_ENTITY_UF_CODE_FIELD'),
            ]),
            new Entity\DatetimeField('UF_CREATED_AT', [
                'required' => true,
                'title' => Loc::getMessage('CONFIRMATION_ENTITY_UF_CREATED_AT_FIELD'),
            ]),
        ];
    }
}

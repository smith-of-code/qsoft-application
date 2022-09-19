<?php

namespace QSoft\ORM;

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Entity;
use Bitrix\Main\Type\DateTime;

Loc::loadMessages(__FILE__);

class ConfirmationTable extends Entity\DataManager
{
    public const ACTIVE_TIME = 30; // Seconds

    public const CHANNELS = [
        'sms' => 'CONFIRMATION_CHANNEL_SMS',
        'email' => 'CONFIRMATION_CHANNEL_EMAIL',
    ];

    public const TYPES = [
        'reset_password' => 'CONFIRMATION_TYPE_PASSWORD_RESET',
        'confirm_email' => 'CONFIRMATION_TYPE_EMAIL_CONFIRMATION',
        'confirm_phone' => 'CONFIRMATION_TYPE_PHONE_CONFIRMATION',
    ];

    public static function getTableName(): string
    {
        return 'confirmation';
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

    public static function add(array $data)
    {
        $data['UF_CREATED_AT'] = new DateTime;
        return parent::add($data);
    }

    public static function getActiveSmsCode(int $userId)
    {
        $result = self::getRow([
            'filter' => [
                '=UF_USER_ID' => $userId,
                '=UF_CHANNEL' => self::CHANNELS['sms'],
                '>UF_CREATED_AT' => (new DateTime)->add('-' . self::ACTIVE_TIME . ' seconds'),
            ],
            'select' => ['UF_CODE'],
        ]);

        return $result ? $result['UF_CODE'] : null;
    }
}

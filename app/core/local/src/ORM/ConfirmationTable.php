<?php

namespace QSoft\ORM;

use Bitrix\Highloadblock\HighloadBlockTable;
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Entity;
use Bitrix\Main\Type\DateTime;
use RuntimeException;

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
        if (!Loader::includeModule('highloadblock')) {
            throw new \RuntimeException('Module highloadblock not found');
        }

        $hlBlock = HighloadBlockTable::getRow(['filter' => ['=TABLE_NAME' => self::getTableName()]]);
        if (!$hlBlock) {
            throw new \RuntimeException(sprintf('Не найден hl-блок %s', self::getTableName()));
        }

        $fields = \CUserTypeEntity::GetList([], ['ENTITY_ID' => 'HLBLOCK_' . $hlBlock['ID']]);

        $typeIds = [];
        $channelIds = [];
        while ($field = $fields->Fetch()) {
            if ($field['FIELD_NAME'] === 'UF_TYPE') {
                $enums = \CUserFieldEnum::GetList([], ['USER_FIELD_ID' => $field['ID']])->arResult;

                $typeIds = array_column($enums, 'ID');
            } else if ($field['FIELD_NAME'] === 'UF_CHANNEL') {
                $enums = \CUserFieldEnum::GetList([], ['USER_FIELD_ID' => $field['ID']])->arResult;

                $channelIds = array_column($enums, 'ID');
            }
        }

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
                'values' => $channelIds,
                'title' => Loc::getMessage('CONFIRMATION_ENTITY_UF_CHANNEL_FIELD'),
            ]),
            new Entity\EnumField('UF_TYPE', [
                'required' => true,
                'values' => $typeIds,
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
            'order' => ['ID' => 'DESC'],
            'filter' => [
                '=UF_USER_ID' => $userId,
                '=UF_CHANNEL' => self::CHANNELS['sms'],
                '>UF_CREATED_AT' => (new DateTime)->add('-' . self::ACTIVE_TIME . ' seconds'),
            ],
            'select' => ['UF_CODE'],
        ]);

        return $result ? $result['UF_CODE'] : null;
    }

    public static function getActiveEmailCode(int $userId, string $type)
    {
        if ($type !== self::TYPES['confirm_email'] && $type !== self::TYPES['reset_password']) {
            throw new RuntimeException('Incorrect email message type');
        }

        $result = self::getRow([
            'order' => ['ID' => 'DESC'],
            'filter' => [
                '=UF_USER_ID' => $userId,
                '=UF_CHANNEL' => self::CHANNELS['email'],
                '=UF_TYPE' => $type,
            ],
            'select' => ['UF_CODE'],
        ]);

        return $result ? $result['UF_CODE'] : null;
    }
}

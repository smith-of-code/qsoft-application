<?php

namespace QSoft\ORM;

use Bitrix\Main\ArgumentException;
use Bitrix\Main\Entity\BooleanField;
use Bitrix\Main\Entity\DatetimeField;
use Bitrix\Main\Entity\IntegerField;
use Bitrix\Main\Entity\StringField;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ObjectPropertyException;
use Bitrix\Main\SystemException;
use Bitrix\Main\Type\DateTime;
use Psr\Log\LogLevel;
use QSoft\Logger\Logger;
use QSoft\ORM\Decorators\CreatedAtDecorator;
use QSoft\ORM\Decorators\EnumDecorator;
use QSoft\ORM\Entity\EnumField;
use RuntimeException;

Loc::loadMessages(__FILE__);

final class ConfirmationTable extends BaseTable
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

    protected static array $decorators = [
        'UF_CHANNEL' => EnumDecorator::class,
        'UF_TYPE' => EnumDecorator::class,
        'UF_CREATED_AT' => CreatedAtDecorator::class,
    ];

    public static function getTableName(): string
    {
        return 'confirmation';
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
                'title' => Loc::getMessage('CONFIRMATION_ENTITY_ID_FIELD'),
            ]),
            new IntegerField('UF_FUSER_ID', [
                'required' => true,
                'title' => Loc::getMessage('CONFIRMATION_ENTITY_UF_USER_ID_FIELD'),
            ]),
            new EnumField('UF_CHANNEL', [
                'required' => true,
                'title' => Loc::getMessage('CONFIRMATION_ENTITY_UF_CHANNEL_FIELD'),
            ], self::getTableName()),
            new EnumField('UF_TYPE', [
                'required' => true,
                'title' => Loc::getMessage('CONFIRMATION_ENTITY_UF_TYPE_FIELD'),
            ], self::getTableName()),
            new StringField('UF_CODE', [
                'required' => true,
                'title' => Loc::getMessage('CONFIRMATION_ENTITY_UF_CODE_FIELD'),
            ]),
            new DatetimeField('UF_CREATED_AT', [
                'required' => true,
                'title' => Loc::getMessage('CONFIRMATION_ENTITY_UF_CREATED_AT_FIELD'),
            ]),
            new BooleanField('UF_IS_USED', [
                'required' => true,
                'title' => Loc::getMessage('CONFIRMATION_ENTITY_UF_IS_USED'),
            ]),
        ];
    }

    /**
     * @throws ObjectPropertyException
     * @throws SystemException
     * @throws ArgumentException
     */
    public static function getActiveSmsCode(int $fuserId)
    {
        $result = self::getRow([
            'order' => ['ID' => 'DESC'],
            'filter' => [
                '=UF_FUSER_ID' => $fuserId,
                '=UF_CHANNEL' => EnumDecorator::prepareField('UF_CHANNEL', self::CHANNELS['sms']),
                '>UF_CREATED_AT' => (new DateTime)->add('-' . self::ACTIVE_TIME . ' seconds'),
                '=UF_IS_USED' => '0',
            ],
            'select' => ['UF_CODE'],
        ]);

        return $result ? $result['UF_CODE'] : null;
    }

    /**
     * @throws ObjectPropertyException
     * @throws SystemException
     * @throws ArgumentException
     */
    public static function getActiveEmailCode(int $fuserId, string $type)
    {
        if ($type !== self::TYPES['confirm_email'] && $type !== self::TYPES['reset_password']) {
            $error = new RuntimeException('Incorrect email message type');
            Logger::createFormatedLog(__CLASS__, LogLevel::ERROR, $error->getMessage());

            throw $error;
        }

        $result = self::getRow([
            'order' => ['ID' => 'DESC'],
            'filter' => [
                '=UF_FUSER_ID' => $fuserId,
                '=UF_CHANNEL' => EnumDecorator::prepareField('UF_CHANNEL', self::CHANNELS['email']),
                '=UF_TYPE' => EnumDecorator::prepareField('UF_TYPE', $type),
                '=UF_IS_USED' => '0',
            ],
            'select' => ['UF_CODE', 'UF_CREATED_AT'],
        ]);

        return $result ? $result : null;
    }

    /**
     * @throws ObjectPropertyException
     * @throws SystemException
     * @throws ArgumentException
     * @throws \Exception
     */
    public static function deactivateCode($code): void
    {
        $idForUpdate = ConfirmationTable::getRow([
            'order' => ['ID' => 'DESC'],
            'filter' => [
                '=UF_CODE' => $code,
            ],
            'select' => ['*'],
        ]);

        $idForUpdate['UF_IS_USED'] = '1';

        (ConfirmationTable::update($idForUpdate['ID'], $idForUpdate));
    }
}

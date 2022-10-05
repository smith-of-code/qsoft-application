<?php

namespace QSoft\ORM;

use Bitrix\Main\Entity\DatetimeField;
use Bitrix\Main\Entity\FloatField;
use Bitrix\Main\Entity\IntegerField;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\SystemException;
use QSoft\ORM\Decorators\EnumDecorator;
use QSoft\ORM\Entity\EnumField;

Loc::loadMessages(__FILE__);

final class TransactionTable extends BaseTable
{
    const TYPES = [
        'purchase' => 'TRANSACTION_TYPE_PURCHASE',
        'invite' => 'TRANSACTION_TYPE_INVITE',
        'referral' => 'TRANSACTION_TYPE_REFERRAL',
    ];

    const SOURCES = [
        'personal' => 'TRANSACTION_SOURCE_PERSONAL',
        'group' => 'TRANSACTION_SOURCE_GROUP',
    ];

    const MEASURES = [
        'money' => 'TRANSACTION_MEASURE_MONEY',
        'points' => 'TRANSACTION_MEASURE_POINTS',
    ];

    protected static array $decorators = [
        'UF_TYPE' => EnumDecorator::class,
        'UF_SOURCE' => EnumDecorator::class,
        'UF_MEASURE' => EnumDecorator::class,
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
                'title' => Loc::getMessage('TRANSACTION_ENTITY_ID_FIELD'),
            ]),
            new IntegerField('UF_USER_ID', [
                'required' => true,
                'title' => Loc::getMessage('TRANSACTION_ENTITY_UF_USER_ID_FIELD'),
            ]),
            new DatetimeField('UF_CREATED_AT', [
                'required' => true,
                'title' => Loc::getMessage('TRANSACTION_ENTITY_UF_CREATED_AT_FIELD'),
            ]),
            new EnumField('UF_TYPE', [
                'required' => true,
                'title' => Loc::getMessage('TRANSACTION_ENTITY_UF_TYPE_FIELD'),
            ], self::getTableName()),
            new EnumField('UF_SOURCE', [
                'required' => true,
                'title' => Loc::getMessage('TRANSACTION_ENTITY_UF_SOURCE_FIELD'),
            ], self::getTableName()),
            new EnumField('UF_MEASURE', [
                'required' => true,
                'title' => Loc::getMessage('TRANSACTION_ENTITY_UF_MEASURE_FIELD'),
            ], self::getTableName()),
            new FloatField('UF_AMOUNT', [
                'required' => true,
                'title' => Loc::getMessage('TRANSACTION_ENTITY_UF_AMOUNT_FIELD'),
            ]),
        ];
    }
}

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
        'group_purchase' => 'TRANSACTION_TYPE_GROUP_PURCHASE',
        'purchase' => 'TRANSACTION_TYPE_PURCHASE',
        'purchase_with_personal_promotion' => 'TRANSACTION_TYPE_PURCHASE_WITH_PERSONAL_PROMOTION',
        'referral' => 'TRANSACTION_TYPE_REFERRAL',
        'upgrade_to_K2' => 'TRANSACTION_TYPE_UPGRADE_TO_K2',
        'upgrade_to_K3' => 'TRANSACTION_TYPE_UPGRADE_TO_K3',
        'hold_on_K3' => 'TRANSACTION_TYPE_HOLD_ON_K3',
    ];

    const TYPES_LABELS = [
        self::TYPES['group_purchase'] => 'За покупки группы',
        self::TYPES['purchase'] => 'С личных покупок',
        self::TYPES['purchase_with_personal_promotion'] => 'С товаров по персональной акции',
        self::TYPES['referral'] => 'За приглашенных консультантов',
        self::TYPES['upgrade_to_K2'] => 'За переход на K2',
        self::TYPES['upgrade_to_K3'] => 'За переход на K3',
        self::TYPES['hold_on_K3'] => 'За удержание на K3',
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
            new IntegerField('UF_ORDER_ID', [
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
                'values' => true,
            ], self::getTableName()),
            new EnumField('UF_SOURCE', [
                'required' => true,
                'title' => Loc::getMessage('TRANSACTION_ENTITY_UF_SOURCE_FIELD'),
                'values' => true,
            ], self::getTableName()),
            new EnumField('UF_MEASURE', [
                'required' => true,
                'title' => Loc::getMessage('TRANSACTION_ENTITY_UF_MEASURE_FIELD'),
                'values' => true,
            ], self::getTableName()),
            new FloatField('UF_AMOUNT', [
                'required' => true,
                'title' => Loc::getMessage('TRANSACTION_ENTITY_UF_AMOUNT_FIELD'),
            ]),
        ];
    }
}

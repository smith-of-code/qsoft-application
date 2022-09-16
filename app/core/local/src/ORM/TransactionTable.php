<?php

namespace QSoft\ORM;

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Entity;

Loc::loadMessages(__FILE__);

class TransactionTable extends Entity\DataManager
{
    const TYPES = [
        'TRANSACTION_TYPE_PURCHASE',
        'TRANSACTION_TYPE_INVITE',
        'TRANSACTION_TYPE_REFERRAL',
    ];

    const SOURCES = [
        'TRANSACTION_SOURCE_PERSONAL',
        'TRANSACTION_SOURCE_GROUP',
    ];

    const MEASURES = [
        'TRANSACTION_MEASURE_MONEY',
        'TRANSACTION_MEASURE_POINTS',
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
                'title' => Loc::getMessage('TRANSACTION_ENTITY_ID_FIELD'),
            ]),
            new Entity\IntegerField('UF_USER_ID', [
                'required' => true,
                'title' => Loc::getMessage('TRANSACTION_ENTITY_UF_USER_ID_FIELD'),
            ]),
            new Entity\DatetimeField('UF_CREATED_AT', [
                'required' => true,
                'title' => Loc::getMessage('TRANSACTION_ENTITY_UF_CREATED_AT_FIELD'),
            ]),
            new Entity\EnumField('UF_TYPE', [
                'required' => true,
                'values' => self::TYPES,
                'title' => Loc::getMessage('TRANSACTION_ENTITY_UF_TYPE_FIELD'),
            ]),
            new Entity\EnumField('UF_SOURCE', [
                'required' => true,
                'values' => self::SOURCES,
                'title' => Loc::getMessage('TRANSACTION_ENTITY_UF_SOURCE_FIELD'),
            ]),
            new Entity\EnumField('UF_MEASURE', [
                'required' => true,
                'values' => self::MEASURES,
                'title' => Loc::getMessage('TRANSACTION_ENTITY_UF_MEASURE_FIELD'),
            ]),
            new Entity\FloatField('UF_AMOUNT', [
                'required' => true,
                'title' => Loc::getMessage('TRANSACTION_ENTITY_UF_AMOUNT_FIELD'),
            ]),
        ];
    }
}

<?php

namespace QSoft\ORM;

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Entity;
use Bitrix\Main\Type\DateTime;
use CUserFieldEnum;

Loc::loadMessages(__FILE__);

class TransactionTable extends Entity\DataManager
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
                'values' => array_values(self::TYPES),
                'title' => Loc::getMessage('TRANSACTION_ENTITY_UF_TYPE_FIELD'),
            ]),
            new Entity\EnumField('UF_SOURCE', [
                'required' => true,
                'values' => array_values(self::SOURCES),
                'title' => Loc::getMessage('TRANSACTION_ENTITY_UF_SOURCE_FIELD'),
            ]),
            new Entity\EnumField('UF_MEASURE', [
                'required' => true,
                'values' => array_values(self::MEASURES),
                'title' => Loc::getMessage('TRANSACTION_ENTITY_UF_MEASURE_FIELD'),
            ]),
            new Entity\FloatField('UF_AMOUNT', [
                'required' => true,
                'title' => Loc::getMessage('TRANSACTION_ENTITY_UF_AMOUNT_FIELD'),
            ]),
        ];
    }

    public static function add(array $data)
    {
        return parent::add(array_merge($data, ['UF_CREATED_AT' => new DateTime]));
    }

    public static function addMulti($rows, $ignoreEvents = false)
    {
        return parent::addMulti(array_map(static function ($row) {
            return array_merge(self::prepareFields($row), ['UF_CREATED_AT' => new DateTime]);
        }, $rows), $ignoreEvents);
    }

    public static function update($primary, array $data)
    {
        return parent::update($primary, self::prepareFields($data));
    }

    public static function updateMulti($primaries, $data, $ignoreEvents = false)
    {
        return parent::updateMulti($primaries, array_map(static function ($item) {
            return self::prepareFields($item);
        }, $data), $ignoreEvents);
    }

    private static function prepareFields(array $fields): array
    {
        if ($fields['UF_TYPE']) {
            $fields['UF_TYPE'] = self::getEnumFieldId($fields['UF_TYPE']);
        }
        if ($fields['UF_SOURCE']) {
            $fields['UF_SOURCE'] = self::getEnumFieldId($fields['UF_SOURCE']);
        }
        if ($fields['UF_MEASURE']) {
            $fields['UF_MEASURE'] = self::getEnumFieldId($fields['UF_MEASURE']);
        }
        return $fields;
    }

    private static function getEnumFieldId(string $xmlId): int
    {
        return CUserFieldEnum::GetList([], ['XML_ID' => $xmlId])->Fetch()['ID'];
    }
}

<?php

namespace QSoft\ORM;

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Entity;
use QSoft\ORM\Traits\HasHighloadEnums;

Loc::loadMessages(__FILE__);

class TransactionTable extends Entity\DataManager
{
    use HasHighloadEnums;

    public static function getTableName(): string
    {
        return 'transaction';
    }

    public static function getMap(): array
    {
        $data = self::getEnumValues(self::getTableName(), ['UF_TYPE', 'UF_SOURCE', 'UF_MEASURE']);

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
                'values' => $data['UF_TYPE'],
                'title' => Loc::getMessage('TRANSACTION_ENTITY_UF_TYPE_FIELD'),
            ]),
            new Entity\EnumField('UF_SOURCE', [
                'required' => true,
                'values' => $data['UF_SOURCE'],
                'title' => Loc::getMessage('TRANSACTION_ENTITY_UF_SOURCE_FIELD'),
            ]),
            new Entity\EnumField('UF_MEASURE', [
                'required' => true,
                'values' => $data['UF_MEASURE'],
                'title' => Loc::getMessage('TRANSACTION_ENTITY_UF_MEASURE_FIELD'),
            ]),
            new Entity\FloatField('UF_AMOUNT', [
                'required' => true,
                'title' => Loc::getMessage('TRANSACTION_ENTITY_UF_AMOUNT_FIELD'),
            ]),
        ];
    }
}

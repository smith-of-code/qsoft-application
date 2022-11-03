<?php

namespace QSoft\ORM;

use Bitrix\Main\Entity\IntegerField;
use Bitrix\Main\SystemException;

class BeneficiariesTable extends BaseTable
{
    public static function getTableName(): string
    {
        return 'beneficiary';
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
            ]),
            new IntegerField('UF_USER_ID'),
            new IntegerField('UF_BENEFICIARY_ID'),
        ];
    }
}
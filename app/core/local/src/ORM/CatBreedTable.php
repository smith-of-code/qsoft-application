<?php

namespace QSoft\ORM;

use Bitrix\Main\Entity\IntegerField;
use Bitrix\Main\Entity\StringField;

class CatBreedTable extends BaseTable
{
    public static function getTableName(): string
    {
        return 'breed_cat';
    }

    public static function getMap(): array
    {
        return [
            new IntegerField('ID', [
                'primary' => true,
                'autocomplete' => true,
            ]),
            new StringField('UF_BREED_CAT', [
                'required' => true,
            ]),
        ];
    }
}
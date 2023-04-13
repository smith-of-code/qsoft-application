<?php

namespace QSoft\ORM;

use Bitrix\Main\Entity\IntegerField;
use Bitrix\Main\Entity\StringField;

class DogBreedTable extends BaseTable
{
    public static function getTableName(): string
    {
        return 'breed_dog';
    }

    public static function getMap(): array
    {
        return [
            new IntegerField('ID', [
                'primary' => true,
                'autocomplete' => true,
            ]),
            new StringField('UF_BREED_DOG', [
                'required' => true,
            ]),
        ];
    }

}
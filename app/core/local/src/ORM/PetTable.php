<?php

namespace QSoft\ORM;

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Entity;

Loc::loadMessages(__FILE__);

class PetTable extends Entity\DataManager
{
    // TODO: Добавить поля
    const BREEDS = [
        'BREED_DOG_DACHSHUND',
    ];

    const KINDS = [
        'KIND_DOG',
        'KIND_CAT',
    ];

    const GENDERS = [
        'GENDER_MALE',
        'GENDER_FEMALE',
    ];

    public static function getTableName(): string
    {
        return 'pet';
    }

    public static function getMap(): array
    {
        return [
            new Entity\IntegerField('ID', [
                'primary' => true,
                'autocomplete' => true,
                'title' => Loc::getMessage('PET_ENTITY_ID_FIELD'),
            ]),
            new Entity\IntegerField('UF_USER_ID', [
                'required' => true,
                'title' => Loc::getMessage('PET_ENTITY_UF_USER_ID_FIELD'),
            ]),
            new Entity\StringField('UF_NAME', [
                'required' => true,
                'title' => Loc::getMessage('PET_ENTITY_UF_NAME_FIELD'),
            ]),
            new Entity\EnumField('UF_KIND', [
                'required' => true,
                'values' => self::KINDS,
                'title' => Loc::getMessage('PET_ENTITY_UF_KIND_FIELD'),
            ]),
            new Entity\EnumField('UF_BREED', [
                'required' => true,
                'values' => self::BREEDS,
                'title' => Loc::getMessage('PET_ENTITY_UF_BREED_FIELD'),
            ]),
            new Entity\DateField('UF_BIRTHDATE', [
                'required' => true,
                'title' => Loc::getMessage('PET_ENTITY_UF_BIRTHDATE_FIELD'),
            ]),
            new Entity\EnumField('UF_GENDER', [
                'required' => true,
                'values' => self::GENDERS,
                'title' => Loc::getMessage('PET_ENTITY_UF_GENDER_FIELD'),
            ]),
        ];
    }
}

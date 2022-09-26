<?php

namespace QSoft\ORM;

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Entity;
use QSoft\ORM\Traits\HasHighloadEnums;

Loc::loadMessages(__FILE__);

class PetTable extends Entity\DataManager
{
    use HasHighloadEnums;

    public static function getTableName(): string
    {
        return 'pet';
    }

    public static function getMap(): array
    {
        $data = self::getEnumValues(self::getTableName(), ['UF_KIND', 'UF_BREED', 'UF_GENDER']);

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
                'values' => $data['UF_KIND'],
                'title' => Loc::getMessage('PET_ENTITY_UF_KIND_FIELD'),
            ]),
            new Entity\EnumField('UF_BREED', [
                'required' => true,
                'values' => $data['UF_BREED'],
                'title' => Loc::getMessage('PET_ENTITY_UF_BREED_FIELD'),
            ]),
            new Entity\DateField('UF_BIRTHDATE', [
                'required' => true,
                'title' => Loc::getMessage('PET_ENTITY_UF_BIRTHDATE_FIELD'),
            ]),
            new Entity\EnumField('UF_GENDER', [
                'required' => true,
                'values' => $data['UF_GENDER'],
                'title' => Loc::getMessage('PET_ENTITY_UF_GENDER_FIELD'),
            ]),
        ];
    }
}

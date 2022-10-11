<?php

namespace QSoft\ORM;

use Bitrix\Main\Entity\DateField;
use Bitrix\Main\Entity\IntegerField;
use Bitrix\Main\Entity\StringField;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\SystemException;
use QSoft\ORM\Decorators\EnumDecorator;
use QSoft\ORM\Entity\EnumField;

Loc::loadMessages(__FILE__);

final class PetTable extends BaseTable
{
    protected static array $decorators = [
        'UF_KIND' => EnumDecorator::class,
        'UF_GENDER' => EnumDecorator::class,
    ];

    public static function getTableName(): string
    {
        return 'pet';
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
                'title' => Loc::getMessage('PET_ENTITY_ID_FIELD'),
            ]),
            new IntegerField('UF_USER_ID', [
                'required' => true,
                'title' => Loc::getMessage('PET_ENTITY_UF_USER_ID_FIELD'),
            ]),
            new StringField('UF_NAME', [
                'required' => true,
                'title' => Loc::getMessage('PET_ENTITY_UF_NAME_FIELD'),
            ]),
            new EnumField('UF_KIND', [
                'required' => true,
                'title' => Loc::getMessage('PET_ENTITY_UF_KIND_FIELD'),
            ], self::getTableName()),
            new IntegerField('UF_BREED', [
                'required' => true,
                'title' => Loc::getMessage('PET_ENTITY_UF_BREED_FIELD'),
            ]),
            new DateField('UF_BIRTHDATE', [
                'required' => true,
                'title' => Loc::getMessage('PET_ENTITY_UF_BIRTHDATE_FIELD'),
            ]),
            new EnumField('UF_GENDER', [
                'required' => true,
                'title' => Loc::getMessage('PET_ENTITY_UF_GENDER_FIELD'),
            ], self::getTableName()),
        ];
    }
}

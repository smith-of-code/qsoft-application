<?php

namespace QSoft\ORM;

use Bitrix\Main\Entity\BooleanField;
use Bitrix\Main\Entity\DatetimeField;
use Bitrix\Main\Entity\IntegerField;
use Bitrix\Main\Entity\StringField;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\SystemException;
use QSoft\ORM\Decorators\EnumDecorator;
use QSoft\ORM\Entity\EnumField;

Loc::loadMessages(__FILE__);

final class LegalEntityTable extends BaseTable
{
    protected static array $decorators = [
        'UF_STATUS' => EnumDecorator::class,
    ];

    public static function getTableName(): string
    {
        return 'legal_entity';
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
                'title' => Loc::getMessage('LEGAL_ENTITY_ID_FIELD'),
            ]),
            new IntegerField('UF_USER_ID', [
                'required' => true,
                'title' => Loc::getMessage('LEGAL_ENTITY_UF_USER_ID_FIELD'),
            ]),
            new EnumField('UF_STATUS', [
                'required' => true,
                'title' => Loc::getMessage('LEGAL_ENTITY_UF_STATUS_FIELD'),
            ], self::getTableName()),
            new BooleanField('UF_IS_ACTIVE', [
                'required' => true,
                'title' => Loc::getMessage('LEGAL_ENTITY_UF_IS_ACTIVE'),
            ]),
            new StringField('UF_DOCUMENTS', [
                'required' => true,
                'title' => Loc::getMessage('LEGAL_ENTITY_UF_DOCUMENTS'),
            ]),
            new DatetimeField('UF_CREATED_AT', [
                'required' => true,
                'title' => Loc::getMessage('LEGAL_ENTITY_UF_CREATED_AT'),
            ]),
        ];
    }
}

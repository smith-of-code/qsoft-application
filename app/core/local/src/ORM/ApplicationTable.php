<?php

namespace QSoft\ORM;

use Bitrix\Main\Entity\IntegerField;
use Bitrix\Main\Entity\StringField;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\SystemException;
use QSoft\ORM\Decorators\EnumDecorator;
use QSoft\ORM\Entity\EnumField;

Loc::loadMessages(__FILE__);

final class ApplicationTable extends BaseTable
{
    protected static array $decorators = [
        'UF_TYPE' => EnumDecorator::class,
        'UF_STATUS' => EnumDecorator::class,
    ];

    public static function getTableName(): string
    {
        return 'application';
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
                'title' => Loc::getMessage('APPLICATION_ENTITY_ID_FIELD'),
            ]),
            new IntegerField('UF_USER_ID', [
                'required' => true,
                'title' => Loc::getMessage('APPLICATION_ENTITY_UF_USER_ID_FIELD'),
            ]),
            new EnumField('UF_TYPE', [
                'required' => true,
                'title' => Loc::getMessage('APPLICATION_ENTITY_UF_TYPE_FIELD'),
            ], self::getTableName()),
            new EnumField('UF_STATUS', [
                'required' => true,
                'title' => Loc::getMessage('APPLICATION_ENTITY_UF_STATUS_FIELD'),
            ], self::getTableName()),
            new StringField('UF_COMMENT', [
                'required' => true,
                'title' => Loc::getMessage('APPLICATION_ENTITY_UF_TEXT_FIELD'),
            ]),
            new StringField('UF_DATA', [
                'required' => true,
                'title' => Loc::getMessage('APPLICATION_ENTITY_UF_DATA_FIELD'),
            ]),
        ];
    }
}

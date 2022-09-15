<?php

namespace QSoft\ORM;

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Entity;

Loc::loadMessages(__FILE__);

class ApplicationTable extends Entity\DataManager
{
    const TYPES = [
        'APPLICATION_TYPE_CHANGE_PERSONAL_DATA',
        'APPLICATION_TYPE_CHANGE_MENTOR',
        'APPLICATION_TYPE_BUG',
        'APPLICATION_TYPE_RETURN_ORDER',
        'APPLICATION_TYPE_OTHER',
    ];

    const STATUSES = [
        'APPLICATION_STATUS_NEW',
        'APPLICATION_STATUS_IN_PROGRESS',
        'APPLICATION_STATUS_DONE',
        'APPLICATION_STATUS_REJECTED',
    ];

    public static function getTableName(): string
    {
        return 'application';
    }

    public static function getMap(): array
    {
        return [
            new Entity\IntegerField('ID', [
                'primary' => true,
                'autocomplete' => true,
                'title' => Loc::getMessage('APPLICATION_ENTITY_ID_FIELD'),
            ]),
            new Entity\IntegerField('UF_USER_ID', [
                'required' => true,
                'title' => Loc::getMessage('APPLICATION_ENTITY_UF_USER_ID_FIELD'),
            ]),
            new Entity\EnumField('UF_TYPE', [
                'required' => true,
                'values' => self::TYPES,
                'title' => Loc::getMessage('APPLICATION_ENTITY_UF_TYPE_FIELD'),
            ]),
            new Entity\EnumField('UF_STATUS', [
                'required' => true,
                'values' => self::STATUSES,
                'title' => Loc::getMessage('APPLICATION_ENTITY_UF_STATUS_FIELD'),
            ]),
            new Entity\StringField('UF_COMMENT', [
                'required' => true,
                'title' => Loc::getMessage('APPLICATION_ENTITY_UF_TEXT_FIELD'),
            ]),
            new Entity\StringField('UF_DATA', [
                'required' => true,
                'title' => Loc::getMessage('APPLICATION_ENTITY_UF_DATA_FIELD'),
            ]),
        ];
    }
}

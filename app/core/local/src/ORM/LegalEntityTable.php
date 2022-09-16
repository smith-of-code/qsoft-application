<?php

namespace QSoft\ORM;

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Entity;

Loc::loadMessages(__FILE__);

class LegalEntityTable extends Entity\DataManager
{
    const STATUSES = [
        'STATUS_IP',
        'STATUS_JURIDICAL',
        'STATUS_SELF_EMPLOYED',
    ];

    public static function getTableName(): string
    {
        return 'legal_entity';
    }

    public static function getMap(): array
    {
        return [
            new Entity\IntegerField('ID', [
                'primary' => true,
                'autocomplete' => true,
                'title' => Loc::getMessage('LEGAL_ENTITY_ID_FIELD'),
            ]),
            new Entity\IntegerField('UF_USER_ID', [
                'required' => true,
                'title' => Loc::getMessage('LEGAL_ENTITY_UF_USER_ID_FIELD'),
            ]),
            new Entity\EnumField('UF_STATUS', [
                'required' => true,
                'values' => self::STATUSES,
                'title' => Loc::getMessage('LEGAL_ENTITY_UF_STATUS_FIELD'),
            ]),
        ];
    }
}

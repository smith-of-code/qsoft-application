<?php

namespace QSoft\ORM;

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Entity;

Loc::loadMessages(__FILE__);

class GroupPropertiesTable extends Entity\DataManager
{
    public static function getTableName(): string
    {
        return 'group_properties';
    }

    public static function getMap(): array
    {
        return [
            new Entity\IntegerField('ID', [
                'primary' => true,
                'autocomplete' => true,
                'title' => Loc::getMessage('TEAM_ENTITY_ID_FIELD'),
            ]),
            new Entity\IntegerField('UF_GROUP_ID', [
                'required' => true,
                'title' => Loc::getMessage('TEAM_ENTITY_UF_GROUP_ID_FIELD'),
            ]),
            new Entity\IntegerField('UF_DISCOUNT', [
                'required' => true,
                'title' => Loc::getMessage('TEAM_ENTITY_UF_DISCOUNT_FIELD'),
            ]),
        ];
    }
}

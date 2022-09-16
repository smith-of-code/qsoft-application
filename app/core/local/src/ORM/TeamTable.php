<?php

namespace QSoft\ORM;

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Entity;

Loc::loadMessages(__FILE__);

class TeamTable extends Entity\DataManager
{
    public static function getTableName(): string
    {
        return 'team';
    }

    public static function getMap(): array
    {
        return [
            new Entity\IntegerField('ID', [
                'primary' => true,
                'autocomplete' => true,
                'title' => Loc::getMessage('TEAM_ENTITY_ID_FIELD'),
            ]),
            new Entity\IntegerField('UF_MENTOR_ID', [
                'required' => true,
                'title' => Loc::getMessage('TEAM_ENTITY_UF_MENTOR_ID_FIELD'),
            ]),
            new Entity\IntegerField('UF_LEVEL', [
                'required' => true,
                'title' => Loc::getMessage('TEAM_ENTITY_UF_LEVEL_FIELD'),
            ]),
        ];
    }
}

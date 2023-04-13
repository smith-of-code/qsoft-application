<?php

namespace QSoft\ORM;

use Bitrix\Main\Entity\IntegerField;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\SystemException;

Loc::loadMessages(__FILE__);

final class TeamTable extends BaseTable
{
    public static function getTableName(): string
    {
        return 'team';
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
                'title' => Loc::getMessage('TEAM_ENTITY_ID_FIELD'),
            ]),
            new IntegerField('UF_MENTOR_ID', [
                'required' => true,
                'title' => Loc::getMessage('TEAM_ENTITY_UF_MENTOR_ID_FIELD'),
            ]),
            new IntegerField('UF_LEVEL', [
                'required' => true,
                'title' => Loc::getMessage('TEAM_ENTITY_UF_LEVEL_FIELD'),
            ]),
        ];
    }
}

<?php

namespace QSoft\ORM;

use Bitrix\Main\Entity\IntegerField;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\SystemException;

Loc::loadMessages(__FILE__);

final class GroupPropertiesTable extends BaseTable
{
    public static function getTableName(): string
    {
        return 'group_properties';
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
            new IntegerField('UF_GROUP_ID', [
                'required' => true,
                'title' => Loc::getMessage('TEAM_ENTITY_UF_GROUP_ID_FIELD'),
            ]),
            new IntegerField('UF_DISCOUNT', [
                'required' => true,
                'title' => Loc::getMessage('TEAM_ENTITY_UF_DISCOUNT_FIELD'),
            ]),
        ];
    }
}

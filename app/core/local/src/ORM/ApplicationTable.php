<?php

namespace QSoft\ORM;

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Entity;
use QSoft\ORM\Traits\HasHighloadEnums;

Loc::loadMessages(__FILE__);

class ApplicationTable extends Entity\DataManager
{
    use HasHighloadEnums;

    public static function getTableName(): string
    {
        return 'application';
    }

    /**
     * @return array
     * @throws \Bitrix\Main\LoaderException
     * @throws \Bitrix\Main\SystemException
     */
    public static function getMap(): array
    {
        $data = self::getEnumValues(self::getTableName(), ['UF_STATUS', 'UF_TYPE']);

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
                'values' => $data['UF_TYPE'],
                'title' => Loc::getMessage('APPLICATION_ENTITY_UF_TYPE_FIELD'),
            ]),
            new Entity\EnumField('UF_STATUS', [
                'required' => true,
                'values' => $data['UF_STATUS'],
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

<?php

namespace QSoft\ORM;

use Bitrix\Highloadblock\HighloadBlockTable;
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Entity;
use QSoft\ORM\Traits\HasHighloadEnums;

Loc::loadMessages(__FILE__);

class LegalEntityTable extends Entity\DataManager
{
    use HasHighloadEnums;

    public static function getTableName(): string
    {
        return 'legal_entity';
    }

    public static function getMap(): array
    {
        $data = self::getEnumValues(self::getTableName(), ['UF_STATUS']);

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
                'values' => $data['UF_STATUS'],
                'title' => Loc::getMessage('LEGAL_ENTITY_UF_STATUS_FIELD'),
            ]),
        ];
    }
}

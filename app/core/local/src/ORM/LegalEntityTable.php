<?php

namespace QSoft\ORM;

use Bitrix\Highloadblock\HighloadBlockTable;
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Entity;

Loc::loadMessages(__FILE__);

class LegalEntityTable extends Entity\DataManager
{
    public static function getTableName(): string
    {
        return 'legal_entity';
    }

    public static function getMap(): array
    {
        if (!Loader::includeModule('highloadblock')) {
            throw new \RuntimeException('Module highloadblock not found');
        }

        $hlBlock = HighloadBlockTable::getRow(['filter' => ['=TABLE_NAME' => self::getTableName()]]);
        if (!$hlBlock) {
            throw new \RuntimeException(sprintf('Не найден hl-блок %s', self::getTableName()));
        }

        $fields = \CUserTypeEntity::GetList([], ['ENTITY_ID' => 'HLBLOCK_' . $hlBlock['ID']]);

        $statusIds = [];
        while ($field = $fields->Fetch()) {
            if ($field['FIELD_NAME'] === 'UF_STATUS') {
                $enums = \CUserFieldEnum::GetList([], ['USER_FIELD_ID' => $field['ID']])->arResult;

                $statusIds = array_column($enums, 'ID');
            }
        }

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
                'values' => $statusIds,
                'title' => Loc::getMessage('LEGAL_ENTITY_UF_STATUS_FIELD'),
            ]),
        ];
    }
}

<?php

namespace QSoft\ORM\Traits;

use Bitrix\Highloadblock\HighloadBlockTable;
use Bitrix\Main\Loader;

trait HasHighloadEnums
{
    protected static function getEnumValues(string $tableName, array $dataFields): array
    {
        if (!Loader::includeModule('highloadblock')) {
            throw new \RuntimeException('Module highloadblock not found');
        }

        $hlBlock = HighloadBlockTable::getRow(['filter' => ['=TABLE_NAME' => $tableName]]);
        if (!$hlBlock) {
            throw new \RuntimeException(sprintf('Не найден hl-блок %s', $tableName));
        }

        $fields = \CUserTypeEntity::GetList([], ['ENTITY_ID' => 'HLBLOCK_' . $hlBlock['ID']]);

        $result = [];
        while ($field = $fields->Fetch()) {
            if (in_array($field['FIELD_NAME'], $dataFields)) {
                $enums = \CUserFieldEnum::GetList([], ['USER_FIELD_ID' => $field['ID']])->arResult;

                $ids = array_column($enums, 'ID');
                $result[$field['FIELD_NAME']] = $ids;
            }
        }

        return $result;
    }
}
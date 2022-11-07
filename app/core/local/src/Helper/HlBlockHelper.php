<?php

namespace QSoft\Helper;

use Bitrix\Highloadblock\HighloadBlockTable;
use Bitrix\Main\Loader;
use CUserFieldEnum;
use CUserTypeEntity;
use RuntimeException;

class HlBlockHelper
{
    public static function getEnumFieldValues(string $tableName, string $fieldName): array
    {
        if (!Loader::includeModule('highloadblock')) {
            throw new RuntimeException('Module highloadblock not install');
        }

        $hlBlock = HighloadBlockTable::getRow(['filter' => ['=TABLE_NAME' => $tableName]]);
        if (!$hlBlock) {
            throw new RuntimeException(sprintf('Highloadblock %s not found', $tableName));
        }

        $field = CUserTypeEntity::GetList([], [
            'ENTITY_ID' => "HLBLOCK_$hlBlock[ID]",
            'FIELD_NAME' => $fieldName,
        ])->Fetch();

        if (!$field) {
            throw new RuntimeException(sprintf('Highloadblock field %s not found', $fieldName));
        }

        return CUserFieldEnum::GetList([], ['USER_FIELD_ID' => $field['ID']])->arResult;
    }

    public static function getPreparedEnumFieldValues(string $tableName, string $fieldName): array
    {
        $values = static::getEnumFieldValues($tableName, $fieldName);

        return array_combine(
            array_column($values, 'ID'),
            array_map(static fn(array $value): array => [
                'id' => $value['ID'],
                'name' => $value['VALUE'],
                'code' => $value['XML_ID'],
            ], $values),
        );
    }
}
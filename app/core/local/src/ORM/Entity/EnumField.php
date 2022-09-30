<?php

namespace QSoft\ORM\Entity;

use Bitrix\Highloadblock\HighloadBlockTable;
use Bitrix\Main\Entity\EnumField as BaseEnumField;
use Bitrix\Main\Loader;
use CUserFieldEnum;
use CUserTypeEntity;
use RuntimeException;

class EnumField extends BaseEnumField
{
    public function __construct(string $fieldName, array $parameters, string $tableName)
    {
        if ($parameters['values']) {
            $parameters['values'] = self::getEnumValues($tableName, $fieldName);
        }
        parent::__construct($fieldName, $parameters);
    }

    private static function getEnumValues(string $tableName, string $fieldName): array
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

        $enums = CUserFieldEnum::GetList([], ['USER_FIELD_ID' => $field['ID']])->arResult;
        return array_column($enums, 'ID');
    }
}
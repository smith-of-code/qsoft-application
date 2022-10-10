<?php

namespace QSoft\ORM\Entity;

use Bitrix\Highloadblock\HighloadBlockTable;
use Bitrix\Main\Entity\EnumField as BaseEnumField;
use Bitrix\Main\Loader;
use CUserFieldEnum;
use CUserTypeEntity;
use QSoft\Helper\HlBlockHelper;
use RuntimeException;

class EnumField extends BaseEnumField
{
    public function __construct(string $fieldName, array $parameters, string $tableName)
    {
        $parameters['values'] = self::getEnumValues($tableName, $fieldName);
        parent::__construct($fieldName, $parameters);
    }

    private static function getEnumValues(string $tableName, string $fieldName): array
    {
        return array_column(HlBlockHelper::getEnumFieldValues($tableName, $fieldName), 'ID');
    }
}
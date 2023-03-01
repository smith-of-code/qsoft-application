<?php

namespace QSoft\ORM\Entity;

use Bitrix\Highloadblock\HighloadBlockTable;
use Bitrix\Main\Entity\EnumField as BaseEnumField;
use Bitrix\Main\Loader;
use CUserFieldEnum;
use CUserTypeEntity;
use Psr\Log\LogLevel;
use QSoft\Helper\HlBlockHelper;
use QSoft\Logger\Logger;
use RuntimeException;

class EnumField extends BaseEnumField
{
    protected array $valuesExt;

    public function __construct(string $fieldName, array $parameters, string $tableName)
    {
        $values = self::getEnumValues($tableName, $fieldName);

        $this->valuesExt = $values;

        $parameters['values'] = array_column($values, 'ID');

        parent::__construct($fieldName, $parameters);
    }

    public function getValuesExt(): array
    {
        return $this->valuesExt;
    }

    private static function getEnumValues(string $tableName, string $fieldName): array
    {
        if (!Loader::includeModule('highloadblock')) {
            $error = new RuntimeException('Module highloadblock not install');
            Logger::createFormatedLog(__CLASS__, LogLevel::ERROR, $error->getMessage());

            throw $error;
        }

        $hlBlock = HighloadBlockTable::getRow(['filter' => ['=TABLE_NAME' => $tableName]]);
        if (!$hlBlock) {
            $error = new RuntimeException(sprintf('Highloadblock %s not found', $tableName));
            Logger::createFormatedLog(__CLASS__, LogLevel::ERROR, $error->getMessage());

            throw $error;
        }

        $field = CUserTypeEntity::GetList([], [
            'ENTITY_ID' => "HLBLOCK_$hlBlock[ID]",
            'FIELD_NAME' => $fieldName,
        ])->Fetch();

        if (!$field) {
            $error = new RuntimeException(sprintf('Highloadblock field %s not found', $fieldName));
            Logger::createFormatedLog(__CLASS__, LogLevel::ERROR, $error->getMessage());

            throw $error;
        }

        return CUserFieldEnum::GetList([], ['USER_FIELD_ID' => $field['ID']])->arResult;
    }
}
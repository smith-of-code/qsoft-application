<?php

namespace QSoft\Helper;

use Bitrix\Highloadblock\HighloadBlockTable;
use Bitrix\Main\Loader;
use CUserFieldEnum;
use CUserTypeEntity;
use Psr\Log\LogLevel;
use QSoft\Logger\Logger;
use RuntimeException;

class HlBlockHelper
{
    public static function getEnumFieldValues(string $tableName, string $fieldName): array
    {
        if (!Loader::includeModule('highloadblock')) {
            $error = new RuntimeException('Module highloadblock not install');
            Logger::createLogger((new \ReflectionClass(__CLASS__))->getShortName(), 0, LogLevel::ERROR)
                ->setLog(
                    $error->getMessage(),
                    [
                        'message' => $error->getMessage(),
                        'namespace' => __CLASS__,
                        'file_path' => (new \ReflectionClass(__CLASS__))->getFileName(),
                    ],
                );
            throw $error;
        }

        $hlBlock = HighloadBlockTable::getRow(['filter' => ['=TABLE_NAME' => $tableName]]);
        if (!$hlBlock) {
            $error = new RuntimeException(sprintf('Highloadblock %s not found', $tableName));
            Logger::createLogger((new \ReflectionClass(__CLASS__))->getShortName(), 0, LogLevel::ERROR)
                ->setLog(
                    $error->getMessage(),
                    [
                        'message' => $error->getMessage(),
                        'namespace' => __CLASS__,
                        'file_path' => (new \ReflectionClass(__CLASS__))->getFileName(),
                    ],
                );
            throw $error;
        }

        $field = CUserTypeEntity::GetList([], [
            'ENTITY_ID' => "HLBLOCK_$hlBlock[ID]",
            'FIELD_NAME' => $fieldName,
        ])->Fetch();

        if (!$field) {
            $error = new RuntimeException(sprintf('Highloadblock field %s not found', $fieldName));
            Logger::createLogger((new \ReflectionClass(__CLASS__))->getShortName(), 0, LogLevel::ERROR)
                ->setLog(
                    $error->getMessage(),
                    [
                        'message' => $error->getMessage(),
                        'namespace' => __CLASS__,
                        'file_path' => (new \ReflectionClass(__CLASS__))->getFileName(),
                    ],
                );
            throw $error;
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
<?php

namespace QSoft\Helper;

use CUserFieldEnum;
use Bitrix\Highloadblock\HighloadBlockTable;
use http\Exception\RuntimeException;

/**
 * Класс для работы с пользовательскими полями
 * @package QSoft\Helper
 */
class UserFieldHelper
{
    /**
     * Получить информацию о пользовательском поле
     * @param string $entityId ID объекта
     * @param string $xmlId XML_ID поля
     * @return array|null Данные о пользовательском поле
     */
    static public function getUserField(string $entityId, string $xmlId) : ?array
    {
        $res = \CUserTypeEntity::GetList(
            [],
            [
                'ENTITY_ID' => $entityId,
                'FIELD_NAME' => $xmlId
            ]
        )->Fetch();
        if (! $res) {
            return null;
        }
        return $res;
    }

    /**
     * Получить варианты значений пользовательского поля типа "Список"
     * @param int $id ID пользовательского поля
     * @return array
     */
    static public function getUserFieldEnumValues(int $id) : array
    {
        $result = [];
        if ($id <= 0) {
            throw new RuntimeException('Некорректный ID пользовательского поля');
        }
        $vals = CUserFieldEnum::GetList(
            [],
            [
                'USER_FIELD_ID' => $id,
            ]
        );
        while ($val = $vals->Fetch()) {
            $result[$val['ID']] = $val;
        }
        return $result;
    }

    /**
     * Возвращает массив пар соответствия "XML_ID" -> "ID" значений пользовательского поля типа "Список"
     * @param string $entityId ID объекта
     * @param string $xmlId XML_ID поля
     * @return array
     */
    static public function getUserFieldEnumValuesIds(string $entityId, string $xmlId) : array
    {
        $result = [];
        // Получим сведения о UF-поле объекта
        $res = self::getUserField($entityId, $xmlId);
        if ($res) {
            // Получим значения UF-поля объекта
            $vals = self::getUserFieldEnumValues($res['ID']);
            foreach ($vals as $val) {
                $result[$val['XML_ID']] = $val['ID'];
            }
        }
        return $result;
    }
}
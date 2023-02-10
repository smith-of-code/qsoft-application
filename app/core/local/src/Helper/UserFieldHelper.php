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
            $error = new RuntimeException('Некорректный ID пользовательского поля');
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
    
	/**
	 * Получаем ФИО пользователя в формате Фамилия И О
	 *
	 * @param string $firstName
	 * @param string|null $secondName
	 * @param string|null $lastName
	 * 
	 * @return string
	 * 
	 */
	public static function userFIOFormat(string $firstName, ?string $secondName = '', ?string $lastName = ''): string
	{
		$secondName = mb_substr(mb_convert_case($secondName, MB_CASE_TITLE, 'UTF-8'), 0, 1) . '. ' ?? '';
		$firstName = mb_substr(mb_convert_case($firstName, MB_CASE_TITLE, 'UTF-8'), 0, 1) . '.' ?? '';

		return $lastName . ' ' . $firstName . $secondName;
	}
}
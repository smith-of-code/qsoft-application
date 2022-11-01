<?php

namespace QSoft\BasketRules;

use Bitrix\Main\ArgumentException;
use Bitrix\Main\Loader;
use Bitrix\Main\LoaderException;
use Bitrix\Main\ObjectPropertyException;
use Bitrix\Main\SystemException;
use Bitrix\Sale\FuserTable;
use CUserFieldEnum;
use QSoft\Entity\User;

class LoyaltyLevelEquals extends \CSaleActionCtrlAction
{
    public static function GetClassName()
    {
        return __CLASS__;
    }

    /**
     * Получение ID условия
     * @return string
     */
    public static function GetControlID()
    {
        return 'LoyaltyLevelEquals';
    }

    /**
     * Добавление пункта в список условий с указанием отдельной группы
     * @param $arParams
     * @return array
     * @throws LoaderException
     */
    public static function GetControlShow($arParams)
    {
        $arControls = static::GetAtomsEx();

        return [
            'controlgroup' => true,
            'group' => false,
            'label' => 'Поле пользователя',
            'showIn' => static::GetShowIn($arParams['SHOW_IN_GROUPS']),
            'children' => [
                [
                    'controlId' => static::GetControlID(),
                    'group' => false,
                    'label' => 'Если уровень в программе лояльности равен',
                    'showIn' => static::GetShowIn($arParams['SHOW_IN_GROUPS']),
                    'control' => [
                        "Если уровень в программе лояльности равен",
                        $arControls["LoyaltyLevelEquals"]
                    ]
                ]
            ]
        ];
    }

    /**
     * Формирование данных для визуального представления условия
     * @param bool $strControlID
     * @param bool $boolEx
     * @return array
     * @throws LoaderException
     */
    public static function GetAtomsEx($strControlID = false, $boolEx = false)
    {
        $boolEx = true === $boolEx;
        $loyaltyLevels = [];

        if (Loader::includeModule('main')) {
            $dbLoyaltyLevels = CUserFieldEnum::GetList([], ['USER_FIELD_NAME' => 'UF_LOYALTY_LEVEL']);

            while ($loyaltyLevel = $dbLoyaltyLevels->Fetch()) {
                $loyaltyLevels[$loyaltyLevel['VALUE']] = $loyaltyLevel['VALUE'];
            }
        }

        $arAtomList = [
            "LoyaltyLevelEquals" => [
                "JS" => [
                    "id" => "LoyaltyLevelEquals",
                    "name" => "extra",
                    "type" => "select",
                    "values" => $loyaltyLevels,
                    "defaultText" => "...",
                    "defaultValue" => "",
                    "first_option" => "..."
                ],
                "ATOM" => [
                    "ID" => "LoyaltyLevelEquals",
                    "FIELD_TYPE" => "string",
                    "FIELD_LENGTH" => 255,
                    "MULTIPLE" => "N",
                    "VALIDATE" => "list"
                ]
            ],
        ];

        if (!$boolEx) {
            foreach ($arAtomList as &$arOneAtom) {
                $arOneAtom = $arOneAtom["JS"];
            }
            if (isset($arOneAtom)) {
                unset($arOneAtom);
            }
        }

        return $arAtomList;
    }

    /**
     * Функция должна вернуть колбэк того, что должно быть выполнено при наступлении условий
     * @param $arOneCondition
     * @param $arParams
     * @param $arControl
     * @param bool $arSubs
     * @return string
     */
    public static function Generate($arOneCondition, $arParams, $arControl, $arSubs = false)
    {
        return __CLASS__ . "::applyProductDiscount(\$row, {$arOneCondition['LoyaltyLevelEquals']})";
    }

    /**
     * Логика кастомного условия
     * @param $row
     * @param $loyaltyLevelValue
     * @return bool
     * @throws ArgumentException
     * @throws ObjectPropertyException
     * @throws SystemException
     */
    public static function applyProductDiscount($row, $loyaltyLevelValue)
    {
        if (empty($row['FUSER_ID'])) {
            return false;
        }

        $userId = FuserTable::getRowById($row['FUSER_ID'])['USER_ID'];

        return (new User($userId))->loyaltyLevel == $loyaltyLevelValue;
    }
}

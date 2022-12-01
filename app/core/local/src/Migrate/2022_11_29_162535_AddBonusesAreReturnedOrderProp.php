<?php

use QSoft\Migration\Migration;

class AddBonusesAreReturnedOrderProp extends Migration
{
    private const PROPERTY = 'BONUSES_ARE_RETURNED';

    public function up(): void
    {
        $this->includeIBlockModule();
        if (!$this->isPropertyExist()) {
            CSaleOrderProps::Add($this->prepareFields());
        }
    }

    protected function prepareFields()
    {
        return [
            'PERSON_TYPE_ID' => '1', // - тип плательщика;
            'NAME' => 'Бонусы были возвращены', //  - название свойства (тип плательщика зависит от сайта, а сайт - от языка; название должно быть на соответствующем языке);
            'TYPE' => 'CHECKBOX', //  - тип свойства. Допустимые значения:
            'REQUIED' => 'Y', // - флаг (Y/N) обязательное ли поле;
            'DEFAULT_VALUE' => 'N', //  - значение по умолчанию;
            'SORT' => '500', //  - индекс сортировки;
            'USER_PROPS' => 'N', //  - флаг (Y/N) входит ли это свойство в профиль покупателя;
            'PROPS_GROUP_ID' => '1', //  - код группы свойств;
            'DESCRIPTION' => '', //  - описание свойства;
            'IS_PROFILE_NAME' => 'N', //  - флаг (Y/N) использовать ли значение свойства как название профиля покупателя;
            'CODE' => self::PROPERTY, //  - символьный код свойства.
        ];
    }

    public function down(): void
    {
        $this->includeIBlockModule();
        if ($id = $this->isPropertyExist()) {
            CSaleOrderProps::delete($id);
        }
    }

    private function isPropertyExist()
    {
        return CSaleOrderProps::GetList([], ['CODE' => self::PROPERTY])->Fetch()['ID'];
    }

    protected function includeIBlockModule(): void
    {
        if (!CModule::IncludeModule('sale')) {
            throw new RuntimeException('Не удалось подключить модуль iblock');
        }
    }
}
<?php

use Bitrix\Main\DB\Connection;
use Bitrix\Sale\Internals\OrderPropsValueTable;
use QSoft\Migration\Migration;

final class createFealdDiscountPointsForOrder extends Migration
{
    private const PROPERTY = 'POINTS';

    /**
     * @throws \Bitrix\Main\LoaderException
     */
    public function up(): void
    {
        $this->includeIBlockModule();
        $fields = $this->prepareFields();

        if (!$this->isPropertyExist()) {
            CSaleOrderProps::Add($fields);
        }
    }

    protected function prepareFields()
    {
        return [
            'PERSON_TYPE_ID' => '1', // - тип плательщика;
            'NAME' => 'Баллы', //  - название свойства (тип плательщика зависит от сайта, а сайт - от языка; название должно быть на соответствующем языке);
            'TYPE' => 'NUMBER', //  - тип свойства. Допустимые значения:
            'REQUIED' => 'N', // - флаг (Y/N) обязательное ли поле;
            'DEFAULT_VALUE' => '', //  - значение по умолчанию;
            'SORT' => '500', //  - индекс сортировки;
            'USER_PROPS' => 'Y', //  - флаг (Y/N) входит ли это свойство в профиль покупателя;
            'PROPS_GROUP_ID' => '1', //  - код группы свойств;
            'DESCRIPTION' => '', //  - описание свойства;
            'IS_PROFILE_NAME' => 'N', //  - флаг (Y/N) использовать ли значение свойства как название профиля покупателя;
            'CODE' => 'POINTS', //  - символьный код свойства.
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

    /**
     * @return void
     */
    protected function includeIBlockModule(): void
    {
        if (!\CModule::IncludeModule('sale')) {
            throw new \RuntimeException('Не удалось подключить модуль iblock');
        }
    }

}
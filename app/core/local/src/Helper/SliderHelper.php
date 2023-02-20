<?php

namespace QSoft\Helper;

use Bitrix\Highloadblock\HighloadBlockTable;
use Bitrix\Main\Loader;
use Bitrix\Main\UserFieldTable;
use Psr\Log\LogLevel;
use QSoft\Logger\Logger;
use RuntimeException;

/**
 * Класс для работы с программой лояльности
 * @package QSoft\Helper
 */
class SliderHelper
{
    /**
     * Подготавливает параметры для вывода данных в блоке слайдера
     * @param string $sliderCode Символьный код слайдера
     * @return array Массив с параметрами:
     * ['FILTER'] - Перечень ID товаров для компонента раздела каталога;
     * ['BANNERS'] - Перечень баннеров;
     * ['SORTED'] - Общий перечень отсортированных ID товаров и баннеров;
     * @throws \Bitrix\Main\LoaderException
     */
    public static function prepareDataForComponent(string $sliderCode): array
    {
        $result = [];

        if (! Loader::includeModule('highloadblock')) {
            $error = new RuntimeException('Модуль highloadblock не найден');
            Logger::createFormatedLog(__CLASS__, LogLevel::ERROR, null, $error);

            throw $error;
        }

        $sliderHL = HighloadBlockTable::getById(HIGHLOAD_BLOCK_HLSLIDER)->fetch();
        $sliderDataClass = (HighloadBlockTable::compileEntity($sliderHL))->getDataClass();
        $sliderElementHL = HighloadBlockTable::getById(HIGHLOAD_BLOCK_HLSLIDERELEMENT)->fetch();
        $sliderElementDataClass = (HighloadBlockTable::compileEntity($sliderElementHL))->getDataClass();

        if (! $sliderHL || ! $sliderElementHL) {
            $error = new RuntimeException('Не найдены HL-блоки для слайдеров');
            Logger::createFormatedLog(__CLASS__, LogLevel::ERROR, null, $error);

            throw $error;
        }

        // Получим ID слайдера по коду
        if (empty($sliderCode)) {
            return $result;
        }

        $slider = $sliderDataClass::getList([
            'filter' => ['=UF_CODE' => $sliderCode],
            'cache' => ['ttl' => 86400],
        ])->fetch();

        if (! isset($slider['ID'])) {
            return $result;
        }

        // Получим ID свойства типа элемента слайдера
        $typeId = UserFieldTable::getList([
            'filter' => ['ENTITY_ID' => 'HLBLOCK_' . $sliderElementHL['ID'], 'FIELD_NAME' => 'UF_TYPE'],
            'select' => ['ID'],
            'cache' => ['ttl' => 86400 * 30],
        ])->fetch()['ID'];

        // Получим типы элементов слайдера
        $enum = new \CUserFieldEnum();
        $sliderTypesDb = $enum->GetList(
            [],
            ['USER_FIELD_ID' => $typeId],
        );
        $sliderElementTypes = [];
        while($elType = $sliderTypesDb->Fetch()) {
            $sliderElementTypes[$elType['ID']] = $elType['XML_ID'];
        }

        // Получим элементы слайдера
        $elements = $sliderElementDataClass::getList([
            'order' => ['UF_SORT' => 'asc'],
            'filter' => ['=UF_SLIDER_ID' => $slider['ID']],
            'cache' => ['ttl' => 86400],
        ]);

        while($element = $elements->fetch()) {
            if ($sliderElementTypes[$element['UF_TYPE']] === 'PRODUCT') {
                $result['FILTER']['ID'][] = $element['UF_ELEMENT_ID'];

            } elseif ($sliderElementTypes[$element['UF_TYPE']] === 'BANNER') {
                $banner = \CAdvBanner::GetByID($element['UF_ELEMENT_ID'], 'N')->Fetch();

                if ($banner && $banner['CODE_TYPE'] === 'html') {
                    $result['BANNERS'][$banner['ID']] = $banner;
                }

            }
            $element['UF_TYPE'] = $sliderElementTypes[$element['UF_TYPE']];
            $result['SORTED'][] = $element;
        }

        $result['FILTER']['INCLUDE_SUBSECTIONS'] = 'Y';
        $result['FILTER']['SECTION_GLOBAL_ACTIVE'] = 'Y';
        $result['FILTER']['SECTION_ID'] = 0;
        $result['FILTER']['WITH_DISCOUNT'] = null;

        return $result;
    }
}
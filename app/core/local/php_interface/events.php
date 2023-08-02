<?php

use Bitrix\Main\EventManager;
use QSoft\BasketRules\LoyaltyLevelEquals;
use QSoft\Events\AuthRequired;
use QSoft\Events\OfferEventsListener;
use QSoft\Events\SupportEventListner;
use QSoft\Events\UserEventsListener;
use QSoft\Events\OrderEventsListener;
use QSoft\Events\Import1CEventsListener;

$eventManager = EventManager::getInstance();

/**
 * Main module events
 */

// Скрытие свойств, содержащих бонусные баллы и цены со скидкой и заполняемых автоматически, для ТП
$eventManager->addEventHandler('main', 'OnAdminTabControlBegin', [OfferEventsListener::class, 'OnOffersEditFormShow']);

$eventManager->addEventHandler('main', 'OnBeforeUserLogin', [UserEventsListener::class, 'OnBeforeUserLogin']);
$eventManager->addEventHandler('main', 'OnAfterUserAuthorize', [UserEventsListener::class, 'OnAfterUserAuthorize']);
$eventManager->addEventHandler('main', 'OnBeforeUserAdd', [UserEventsListener::class, 'OnBeforeUserAdd']);
$eventManager->addEventHandler('main', 'OnBeforeUserUpdate', [UserEventsListener::class, 'OnBeforeUserUpdate']);

$eventManager->addEventHandler('main', 'OnProlog', [AuthRequired::class, 'checkAuth']);

/**
 * Catalog module events
 */
$eventManager->addEventHandler('catalog', '\Bitrix\Catalog\Price::OnAfterAdd', [OfferEventsListener::class, 'OnPriceAdd']);
$eventManager->addEventHandler('catalog', '\Bitrix\Catalog\Price::OnAfterUpdate', [OfferEventsListener::class, 'OnPriceUpdate']);


/**
 * техподдержка.
 */
// Прослушиваем запрос на изменение профиля пользователя.
$eventManager->addEventHandler('support', 'OnBeforeTicketUpdate', [new SupportEventListner(), 'onBeforeTicketUpdate']);

// Прослушиваем запрос на изменение профиля пользователя.
$eventManager->addEventHandler('support', 'OnAfterTicketUpdate', [new SupportEventListner(), 'onAfterTicketUpdate']);

// Прослушиваем запрос на создание тикета.
$eventManager->addEventHandler('support', 'OnAfterTicketAdd', [new SupportEventListner(), 'onAfterTicketAdd']);

/**
 * Sale module events
 */

$eventManager->addEventHandler('sale', 'OnOrderAdd', [OrderEventsListener::class, 'OnOrderAdd']);
$eventManager->addEventHandler('sale', 'OnSaleStatusOrder', [OrderEventsListener::class, 'OnSaleStatusOrder']);
$eventManager->addEventHandler('sale', 'OnBeforeOrderUpdate', [OrderEventsListener::class, 'OnBeforeOrderUpdate']);
$eventManager->addEventHandler('sale', 'OnBeforeOrderDelete', [OrderEventsListener::class, 'OnBeforeOrderDelete']);
$eventManager->addEventHandler('sale', 'OnCondSaleActionsControlBuildList', [LoyaltyLevelEquals::class, 'GetControlDescr']);
$eventManager->addEventHandler('sale', 'OnOrderAdd', [OrderEventsListener::class, 'OnOrderAdd']);

// События для пересчета бонусов ТП при обновлении правил корзины
$eventManager->addEventHandler('sale', '\Bitrix\Sale\Internals\Discount::OnAfterAdd', [OfferEventsListener::class, 'UpdateBonusesAndPrices']);
$eventManager->addEventHandler('sale', '\Bitrix\Sale\Internals\Discount::OnAfterUpdate', [OfferEventsListener::class, 'UpdateBonusesAndPrices']);
$eventManager->addEventHandler('sale', '\Bitrix\Sale\Internals\Discount::OnAfterDelete', [OfferEventsListener::class, 'UpdateBonusesAndPrices']);


//$eventManager->AddEventHandler('catalog', 'OnSuccessCatalogImport1C', [Import1CEventsListener::class, 'customCatalogImportStep']);
//
//$eventManager->AddEventHandler('iblock', 'OnStartIBlockElementAdd', [Import1CEventsListener::class, 'OnStartIBlockElementAdd']);


//пример обработчика, который при сохранении элемента переводит в транслит его заголовок, добавляет к заголовку текущую дату (для уникальности) и передает в поле "Символьный код"
// файл /bitrix/php_interface/init.php
// регистрируем обработчик
$eventManager->AddEventHandler("iblock", "OnBeforeIBlockElementAdd", Array("CymCode", "OnBeforeIBlockElementAddHandler"));
class CymCode
{
// создаем обработчик события "OnBeforeIBlockElementAdd"
    public static function OnBeforeIBlockElementAddHandler(&$arFields)
    {
        log_array($arFields);
        if (strlen($arFields["CODE"]) <= 0) {
            $arFields["CODE"] = CymCode::imTranslite($arFields["NAME"]) . "_" . date('dmY');
//            log_array($arFields); // убрать после отладки
            return;
        }
    }

// записывает все что передадут в /bitrix/log.txt
    function log_array()
    {
        $arArgs = func_get_args();
        $sResult = '';
        foreach ($arArgs as $arArg) {
            $sResult .= "\n\n" . print_r($arArg, true);
        }
        if (!defined('LOG_FILENAME')) {
            define('LOG_FILENAME', $_SERVER['DOCUMENT_ROOT'] . '/bitrix/log.txt');
        }
        AddMessage2Log($sResult, 'log_array -> ');
    }

    function imTranslite($str)
    {
// транслитерация корректно работает на страницах с любой кодировкой
// ISO 9-95
        static $tbl = array(
            'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ж' => 'g', 'з' => 'z',
            'и' => 'i', 'й' => 'y', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o', 'п' => 'p',
            'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'ы' => 'y', 'э' => 'e', 'А' => 'A',
            'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ж' => 'G', 'З' => 'Z', 'И' => 'I',
            'Й' => 'Y', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O', 'П' => 'P', 'Р' => 'R',
            'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Ы' => 'Y', 'Э' => 'E', 'ё' => "yo", 'х' => "h",
            'ц' => "ts", 'ч' => "ch", 'ш' => "sh", 'щ' => "shch", 'ъ' => "", 'ь' => "", 'ю' => "yu", 'я' => "ya",
            'Ё' => "YO", 'Х' => "H", 'Ц' => "TS", 'Ч' => "CH", 'Ш' => "SH", 'Щ' => "SHCH", 'Ъ' => "", 'Ь' => "",
            'Ю' => "YU", 'Я' => "YA", ' ' => "_", '№' => "", '«' => "<", '»' => ">", '—' => "-"
        );
        return strtr($str, $tbl);
    }
}
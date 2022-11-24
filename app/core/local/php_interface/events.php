<?php

use QSoft\Events\OfferEventsListener;
use QSoft\Events\SupportEventListner;
use QSoft\Events\UserEventsListener;
use QSoft\Events\OrderEventsListener;

$eventManager = \Bitrix\Main\EventManager::getInstance();

/**
 * Main module events
 */
// Скрытие свойств, содержащих бонусные баллы и цены со скидкой и заполняемых автоматически, для ТП
$eventManager->addEventHandler('main', 'OnAdminTabControlBegin', [OfferEventsListener::class, 'OnOffersEditFormShow']);

$eventManager->addEventHandler('main', 'OnBeforeUserAdd', [UserEventsListener::class, 'OnBeforeUserAdd']);
$eventManager->addEventHandler('main', 'OnBeforeUserUpdate', [UserEventsListener::class, 'OnBeforeUserUpdate']);

$eventManager->addEventHandler('main', 'OnProlog', [\QSoft\Events\AuthRequired::class, 'checkAuth']);

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
 * техподдержка конец.
*/

/**
 * Sale module events
 */
$eventManager->addEventHandler('sale', 'OnSaleStatusOrder', [OrderEventsListener::class, 'sendChangeOrderStatusNotification']);
$eventManager->addEventHandler('sale', 'OnCondSaleActionsControlBuildList', [\QSoft\BasketRules\LoyaltyLevelEquals::class, 'GetControlDescr']);
$eventManager->addEventHandler('sale', '\Bitrix\Sale\Internals\Discount::OnAfterAdd', [OfferEventsListener::class, 'UpdateBonuses']);
$eventManager->addEventHandler('sale', '\Bitrix\Sale\Internals\Discount::OnAfterUpdate', [OfferEventsListener::class, 'UpdateBonuses']);
$eventManager->addEventHandler('sale', '\Bitrix\Sale\Internals\Discount::OnAfterDelete', [OfferEventsListener::class, 'UpdateBonuses']);

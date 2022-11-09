<?php

use QSoft\Events\OfferEventsListener;
use QSoft\Events\SupportEventListner;
use QSoft\Events\UserEventsListener;
use QSoft\Events\OrderEventsListener;

$eventManager = \Bitrix\Main\EventManager::getInstance();

/**
 * Main module events
 */
$eventManager->addEventHandler('main', 'OnBeforeUserAdd', [UserEventsListener::class, 'OnBeforeUserAdd']);
$eventManager->addEventHandler('main', 'OnBeforeUserUpdate', [UserEventsListener::class, 'OnBeforeUserUpdate']);

/**
 * Catalog module events
 */
$eventManager->addEventHandler('catalog', 'OnPriceAdd', [OfferEventsListener::class, 'OnPriceAdd']);
$eventManager->addEventHandler('catalog', 'OnPriceUpdate', [OfferEventsListener::class, 'OnPriceUpdate']);

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

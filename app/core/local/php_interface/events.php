<?php

use QSoft\Events\OfferEventsListener;
use QSoft\Events\SupportEventListner;
use QSoft\Events\UserEventsListener;

/**
* Main module events
*/
AddEventHandler('main', 'OnBeforeUserAdd', [UserEventsListener::class, 'OnBeforeUserAdd']);
AddEventHandler('main', 'OnBeforeUserUpdate', [UserEventsListener::class, 'OnBeforeUserUpdate']);

/**
 * Catalog module events
 */
AddEventHandler('catalog', 'OnPriceAdd', [OfferEventsListener::class, 'OnPriceAdd']);
AddEventHandler('catalog', 'OnPriceUpdate', [OfferEventsListener::class, 'OnPriceUpdate']);

/**
 * техподдержка.
*/
// Прослушиваем запрос на изменение профиля пользователя.
AddEventHandler('support', 'OnBeforeTicketUpdate', [new SupportEventListner(), 'onBeforeTicketUpdate']);

// Прослушиваем запрос на изменение профиля пользователя.
AddEventHandler('support', 'OnAfterTicketUpdate', [new SupportEventListner(), 'onAfterTicketUpdate']);

// Прослушиваем запрос на создание тикета.
AddEventHandler('support', 'OnAfterTicketAdd', [new SupportEventListner(), 'onAfterTicketAdd']);
/**
 * техподдержка конец.
*/
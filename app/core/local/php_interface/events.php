<?php

use QSoft\Events\OfferEventsListener;
use QSoft\Events\UserEventsListener;

/**
* Main module events
*/
AddEventHandler('main', 'OnBeforeUserUpdate', [UserEventsListener::class, 'OnBeforeUserUpdate']);

/**
 * Catalog module events
 */
AddEventHandler('catalog', 'OnPriceAdd', [OfferEventsListener::class, 'OnPriceAdd']);
AddEventHandler('catalog', 'OnPriceUpdate', [OfferEventsListener::class, 'OnPriceUpdate']);


<?php

use QSoft\Events\User\UserEventsListener;

/**
 * Main module events
 */
AddEventHandler('main', 'OnBeforeUserUpdate', [UserEventsListener::class, 'OnBeforeUserUpdate']);

<?php

use QSoft\Events\UserEventsListener;

/**
* Main module events
*/
AddEventHandler('main', 'OnBeforeUserUpdate', [UserEventsListener::class, 'OnBeforeUserUpdate']);

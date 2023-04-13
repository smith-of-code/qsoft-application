<?php

namespace QSoft\Events;

use Bitrix\Main\Application;

class AuthRequired
{
    public static function checkAuth()
    {
        global $USER;

        if (
            strpos(Application::getInstance()->getContext()->getRequest()->getRequestUri(), '/personal') === 0
            && !$USER->IsAuthorized()
        ) {
            LocalRedirect('/login');
        }
    }
}
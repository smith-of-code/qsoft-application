<?php

namespace QSoft\Helper;

use Bitrix\Main\Application;

class Page
{
    public static function isMain(): bool
    {
        return Application::getInstance()->getContext()->getRequest()->getRequestUri() === '/';
    }

    public static function isPersonal(): bool
    {
        $currentPageUri = Application::getInstance()->getContext()->getRequest()->getRequestUri();

        return strpos($currentPageUri, '/personal/') === 0;
    }

    public static function isCatalog(): bool
    {
        $currentPageUri = Application::getInstance()->getContext()->getRequest()->getRequestUri();

        return strpos($currentPageUri, '/catalog/') === 0;
    }

    public static function hasBreadcrumbs(): bool
    {
        return false;
    }
}
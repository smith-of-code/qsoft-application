<?php

namespace QSoft\Helper;

use Bitrix\Main\Application;

class Page
{
    private static function getRequestUri(): string
    {
        static $requestUri = null;
        return $requestUri ?? $requestUri = Application::getInstance()->getContext()->getRequest()->getRequestUri();
    }

    public static function isMain(): bool
    {
        $uri = self::getRequestUri();
        return $uri === '/' || ! empty(preg_grep('/^\/[?]/', [$uri]));
    }

    public static function isPersonal(): bool
    {
        return strpos(self::getRequestUri(), '/personal/') === 0;
    }

    public static function isCatalog(): bool
    {
        return strpos(self::getRequestUri(), '/catalog/') === 0;
    }

    public static function isNews(): bool
    {
        return strpos(self::getRequestUri(), '/info/news/') === 0;
    }

    public static function isEvents(): bool
    {
        return strpos(self::getRequestUri(), '/info/events/') === 0;
    }

    public static function isExpertAdvice(): bool
    {
        return strpos(self::getRequestUri(), '/info/expert-advice/') === 0;
    }

    public static function isFaq(): bool
    {
        return strpos(self::getRequestUri(), '/info/faq/') === 0;
    }

    public static function isDiscounts(): bool
    {
        return strpos(self::getRequestUri(), '/info/discounts/') === 0;
    }

    public static function isAmeBusiness(): bool
    {
        return strpos(self::getRequestUri(), '/info/ame-business/') === 0;
    }

    public static function hasBreadcrumbs(): bool
    {
        return self::isCatalog()
            || self::isNews()
            || self::isEvents()
            || self::isExpertAdvice()
            || self::isFaq()
            || self::isDiscounts()
            || self::isAmeBusiness()
        ;
    }
}
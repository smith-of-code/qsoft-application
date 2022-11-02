<?php

use Illuminate\Container\Container;
use QSoft\Application\Application;
use QSoft\Entity\User;

function getApplication(): Container
{
    static $initialized = false;

    if (!$initialized) {
        Container::setInstance(new Application(QSOFT_APPLICATION_ROOT . '/app/core'));
        $initialized = true;
    }

    return Container::getInstance();
}

if (!function_exists('app')) {
    function app($alias)
    {
//        if ($alias === 'logger') {
//            static $loggerInitialized = false;
//
//            if (!$loggerInitialized) {
//                getLaravel()->singleton('logger', function ($app) {
//                    return new Logger('main.bitrix', [
//                        getLoggerHandler(),
//                    ], [
//                        new MemoryUsageProcessor(),
//                        new RequestIdProcessor(),
//                    ]);
//                });
//                $loggerInitialized = true;
//            }
//        }

        return getApplication()->make($alias);
    }
}

if (!function_exists('currentUser')) {
    function currentUser(): ?User
    {
        static $user = null;
        static $isCurrentUserSet = true;

        if (empty($user) && $isCurrentUserSet) {
            global $USER;

            if (empty($USER->GetID())) {
                $isCurrentUserSet = false;
            } else {
                $user = new User($USER->GetID());
            }
        }

        return $user;
    }
}

if (!function_exists('mb_ucfirst')) {
    function mb_ucfirst(string $string, string $encoding = 'utf8'): string
    {
        return mb_strtoupper(mb_substr($string, 0, 1, $encoding), $encoding) . mb_substr($string, 1, null, $encoding);
    }
}

<?php

use Bitrix\Main\UserPhoneAuthTable;
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

if (!function_exists('phpToVueObject')) {
    function phpToVueObject(array $array): string
    {
        $array = convertBitrixDateTimeRecursive($array);
        return htmlspecialchars(json_encode($array), ENT_QUOTES | ENT_HTML401);
    }
}

if (!function_exists('convertBitrixDateTimeRecursive')) {
    /**
     * Рекурсивно преобразует даты Bitrix в строковые представления
     * @param array $array массив данных для обработки
     * @param int $maxDepth максимальная глубина вложенности, при которой будет выполняться функция
     * @return array обработанный массив
     */
    function convertBitrixDateTimeRecursive(array $array, int $maxDepth = 32) : array
    {
        if ($maxDepth <= 0) {
            return $array;
        }
        foreach ($array as $key => $val) {
            if (
                $val instanceof Bitrix\Main\Type\Date
                || $val instanceof Bitrix\Main\Type\DateTime
            ) {
                $array[$key] = (string) $val;
            } elseif (is_array($val)) {
                $array[$key] = convertBitrixDateTimeRecursive($val, $maxDepth - 1);
            }
        }
        return $array;
    }
}
if (!function_exists('numberToRoman')) {
    function numberToRoman(int $number): string
    {
        $romanNumbersMap = [
            'M'  => 1000,
            'CM' => 900,
            'D'  => 500,
            'CD' => 400,
            'C'  => 100,
            'XC' => 90,
            'L'  => 50,
            'XL' => 40,
            'X'  => 10,
            'IX' => 9,
            'V'  => 5,
            'IV' => 4,
            'I'  => 1,
        ];

        $result = '';
        foreach ($romanNumbersMap as $roman => $value) {
            $result .= str_repeat($roman, intval($number / $value));
            $number = $number % $value;
        }
        return $result;
    }
}

if (!function_exists('filesizeFormat')) {
    function filesizeFormat(int $bytes, int $decimals = 2): string
    {
        $factor = floor((strlen($bytes) - 1) / 3);
        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @[' ', ' K', ' M', ' G', ' T'][$factor] . 'B';
    }
}

if (!function_exists('normalizePhoneNumber')) {
    function normalizePhoneNumber(string $phoneNumber): string
    {
        if (str_starts_with($phoneNumber, '8')) {
            $phoneNumber = '+7' . substr($phoneNumber, 1);
        } elseif (str_starts_with($phoneNumber, '7')) {
            $phoneNumber = "+$phoneNumber";
        }
        return UserPhoneAuthTable::normalizePhoneNumber($phoneNumber);
    }
}

if (!function_exists('declinationProduct')) {
    function declinationProduct(int $numeral): string
    {
        if (!$numeral) return "Найдено <span class=\"catalog__results-count\">$numeral</span> товаров";

        $n = $numeral;
        $numeral = $numeral % 100;
        if ($numeral > 19) {
            $numeral = $numeral % 10;
        }

        switch ($numeral) {
            case  1: return "Найден <span class=\"catalog__results-count\">$n</span> товар";
            case  2:
            case  3:
            case  4: return "Найдено <span class=\"catalog__results-count\">$n</span> товара";
            default: return "Найдено <span class=\"catalog__results-count\">$n</span> товаров";
        }
    }
}

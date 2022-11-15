<?php

namespace QSoft;

class Environment
{
    public static function getEnvironmentType()
    {
        return env('ENVIRONMENT_TYPE');
    }

    public static function isDev(): bool
    {
        return self::getEnvironmentType() === 'dev' || empty(self::getEnvironmentType());
    }

    public static function isTest(): bool
    {
        return self::getEnvironmentType() === 'test';
    }

    public static function isProd(): bool
    {
        return self::getEnvironmentType() === 'prod';
    }
}
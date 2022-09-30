<?php

namespace QSoft\ORM\Decorators;

interface DecoratorInterface
{
    public static function prepareField(string $fieldName, $fieldValue);
}

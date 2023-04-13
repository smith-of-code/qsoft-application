<?php

namespace QSoft\ORM\Decorators;

use Bitrix\Main\Type\DateTime;

abstract class CreatedAtDecorator implements DecoratorInterface
{

    public static function prepareField(string $fieldName, $fieldValue): DateTime
    {
        return $fieldValue ?? new DateTime;
    }
}

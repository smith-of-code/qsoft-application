<?php

namespace QSoft\ORM\Decorators;

use CUserFieldEnum;

abstract class EnumDecorator implements DecoratorInterface
{
    public static function prepareField(string $fieldName, $fieldValue)
    {
        return CUserFieldEnum::GetList([], ['XML_ID' => $fieldName])->Fetch()['ID'];
    }
}

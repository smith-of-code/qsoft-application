<?php

namespace QSoft\Factory;

use Bitrix\Main\Security\Random;

final class SizeFactory extends AbstractFactory
{
    protected function makeOne(): array
    {
        return [
            'UF_NAME' => sprintf('%s %d', Random::getString(10), Random::getInt(1, 100)),
            'UF_XML_ID' => Random::getString(10),
        ];
    }
}

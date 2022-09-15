<?php

namespace QSoft\Factory;

use Bitrix\Main\Security\Random;

final class SliderFactory extends Factorable
{
    protected function makeOne(): array
    {
        return [
            'UF_TITLE' => Random::getString(Random::getInt(10, 100)),
        ];
    }
}

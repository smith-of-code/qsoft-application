<?php

namespace QSoft\Factory;

use Bitrix\Main\Security\Random;

final class PickupPointFactory extends AbstractFactory
{
    protected function makeOne(): array
    {
        return [
            'UF_NAME' => Random::getString(Random::getInt(10, 100)),
            'UF_DESCRIPTION' => Random::getString(Random::getInt(10, 100)),
            'UF_CITY' => $this->additionalInfo['cities'][array_rand($this->additionalInfo['cities'])],
            'UF_WORKING_HOURS_START' => Random::getInt(10, 12) . ':00',
            'UF_WORKING_HOURS_END' => Random::getInt(13, 24) . ':00',
            'UF_ADDRESS' => Random::getString(Random::getInt(10, 100)),
            'UF_COORDINATES' => Random::getInt(0, 90) . ',' . Random::getInt(0, 90),
        ];
    }
}

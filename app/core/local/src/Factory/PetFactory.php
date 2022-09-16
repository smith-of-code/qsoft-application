<?php

namespace QSoft\Factory;

use Bitrix\Main\Security\Random;
use Bitrix\Main\Type\DateTime;

final class PetFactory extends AbstractFactory
{
    protected function makeOne(): array
    {
        $intervalString = sprintf('-%d days', Random::getInt(100, 365 * 12));

        return [
            'UF_NAME' => Random::getString(rand(10, 20)),
            'UF_TYPE' => $this->additionalInfo['types'][array_rand($this->additionalInfo['types'])],
            'UF_USER_ID' => $this->additionalInfo['users'][array_rand($this->additionalInfo['users'])],
            'UF_KIND' => $this->additionalInfo['kinds'][array_rand($this->additionalInfo['kinds'])],
            'UF_GENDER' => $this->additionalInfo['genders'][array_rand($this->additionalInfo['genders'])],
            'UF_BREED' => $this->additionalInfo['breeds'][array_rand($this->additionalInfo['breeds'])],
            'UF_BIRTHDATE' => DateTime::createFromTimestamp(strtotime($intervalString)),
        ];
    }
}

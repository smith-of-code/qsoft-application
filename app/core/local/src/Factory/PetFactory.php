<?php

namespace QSoft\Factory;

use Bitrix\Main\Security\Random;
use Bitrix\Main\Type\DateTime;
use DateInterval;

final class PetFactory extends Factorable
{
    protected function makeOne(): array
    {
        $now = new DateTime();
        $intervalString = '-' . Random::getInt(1, 365 * 10) . ' days';

        return [
            'UF_NAME' => Random::getString(rand(10, 20)),
            'UF_TYPE' => $this->additionalInfo['types'][array_rand($this->additionalInfo['types'])],
            'UF_USER_ID' => Random::getInt(1, 100),
            'UF_KIND' => $this->additionalInfo['kinds'][array_rand($this->additionalInfo['kinds'])],
            'UF_GENDER' => $this->additionalInfo['genders'][array_rand($this->additionalInfo['genders'])],
            'UF_BREED' => $this->additionalInfo['breeds'][array_rand($this->additionalInfo['breeds'])],
            'UF_BIRTHDATE' => $now->add(DateInterval::createFromDateString($intervalString))->format('d.m.Y'),
        ];
    }
}

<?php

namespace QSoft\Factory;

use Bitrix\Main\Security\Random;
use Bitrix\Main\Type\DateTime;

final class TransactionFactory extends Factorable
{
    protected function makeOne(): array
    {
        return [
            'UF_USER_ID' => $this->additionalInfo['users'][array_rand($this->additionalInfo['users'])],
            'UF_CREATED_AT' => new DateTime(),
            'UF_TYPE' => $this->additionalInfo['types'][array_rand($this->additionalInfo['types'])],
            'UF_SOURCE' => $this->additionalInfo['sources'][array_rand($this->additionalInfo['sources'])],
            'UF_MEASURE' => $this->additionalInfo['measures'][array_rand($this->additionalInfo['measures'])],
            'UF_AMOUNT' => Random::getInt(10000, 5000000) / 100,
        ];
    }
}

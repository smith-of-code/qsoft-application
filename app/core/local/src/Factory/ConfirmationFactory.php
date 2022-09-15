<?php

namespace QSoft\Factory;

use Bitrix\Main\Security\Random;
use Bitrix\Main\Type\DateTime;

final class ConfirmationFactory extends Factorable
{
    protected function makeOne(): array
    {
        return [
            'UF_USER_ID' => $this->additionalInfo['users'][array_rand($this->additionalInfo['users'])],
            'UF_CREATED_AT' => new DateTime(),
            'UF_CODE' => Random::getString(6),
            'UF_TYPE' => $this->additionalInfo['types'][array_rand($this->additionalInfo['types'])],
            'UF_CHANNEL' => $this->additionalInfo['channels'][array_rand($this->additionalInfo['channels'])],
        ];
    }
}

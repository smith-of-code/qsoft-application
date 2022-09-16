<?php

namespace QSoft\Factory;

use Bitrix\Main\Security\Random;

final class NotificationFactory extends AbstractFactory
{
    protected function makeOne(): array
    {
        return [
            'UF_USER_ID' => $this->additionalInfo['users'][array_rand($this->additionalInfo['users'])],
            'UF_STATUS' => $this->additionalInfo['statuses'][array_rand($this->additionalInfo['statuses'])],
            'UF_TYPE' => $this->additionalInfo['types'][array_rand($this->additionalInfo['types'])],
            'UF_MESSAGE' => Random::getString(Random::getInt(10, 100)),
            'UF_LINK' => Random::getInt(0, 1) ? 'https://' . Random::getString(10, 20) . '.com' : null,
        ];
    }
}

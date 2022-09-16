<?php

namespace QSoft\Factory;

use Bitrix\Main\Security\Random;
use Bitrix\Main\Type\DateTime;

final class ApplicationFactory extends AbstractFactory
{
    protected function makeOne(): array
    {
        return [
            'UF_USER_ID' => $this->additionalInfo['users'][array_rand($this->additionalInfo['users'])],
            'UF_STATUS' => $this->additionalInfo['statuses'][array_rand($this->additionalInfo['statuses'])],
            'UF_TYPE' => $this->additionalInfo['types'][array_rand($this->additionalInfo['types'])],
            'UF_COMMENT' => Random::getString(Random::getInt(10, 255)),
            // TODO If needed
            'UF_DATA' => serialize([]),
        ];
    }
}

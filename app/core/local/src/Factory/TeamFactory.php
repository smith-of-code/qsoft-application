<?php

namespace QSoft\Factory;

use Bitrix\Main\Security\Random;

final class TeamFactory extends Factorable
{
    protected function makeOne(): array
    {
        return [
            'UF_MENTOR_ID' => $this->additionalInfo['users'][array_rand($this->additionalInfo['users'])],
            'UF_LEVEL' => Random::getInt(1, 5),
        ];
    }
}

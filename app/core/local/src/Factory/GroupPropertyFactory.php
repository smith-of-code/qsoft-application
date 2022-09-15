<?php

namespace QSoft\Factory;

use Bitrix\Main\Security\Random;

final class GroupPropertyFactory extends Factorable
{
    protected function makeOne(): array
    {
        return [
            'UF_GROUP_ID' => $this->additionalInfo['groups'][array_rand($this->additionalInfo['groups'])],
            'UF_DISCOUNT' => Random::getInt(0, 50),
        ];
    }
}

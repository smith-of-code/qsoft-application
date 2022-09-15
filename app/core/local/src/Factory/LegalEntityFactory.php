<?php

namespace QSoft\Factory;

final class LegalEntityFactory extends Factorable
{
    protected function makeOne(): array
    {
        return [
            'UF_USER_ID' => $this->additionalInfo['users'][array_rand($this->additionalInfo['users'])],
            'UF_STATUS' => $this->additionalInfo['statuses'][array_rand($this->additionalInfo['statuses'])],
        ];
    }
}

<?php

namespace QSoft\Factory;

final class WishlistFactory extends Factorable
{
    protected function makeOne(): array
    {
        return [
            'UF_USER_ID' => $this->additionalInfo['users'][array_rand($this->additionalInfo['users'])],
            'UF_PRODUCT_ID' => $this->additionalInfo['products'][array_rand($this->additionalInfo['products'])],
        ];
    }
}

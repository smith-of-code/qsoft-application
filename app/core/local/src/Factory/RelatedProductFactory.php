<?php

namespace QSoft\Factory;

use Bitrix\Main\Security\Random;

final class RelatedProductFactory extends AbstractFactory
{
    protected function makeOne(): array
    {
        return [
            'UF_MAIN_PRODUCT_ID' => $this->additionalInfo['products'][array_rand($this->additionalInfo['products'])],
            'UF_RELATED_PRODUCT_ID' => $this->additionalInfo['products'][array_rand($this->additionalInfo['products'])],
        ];
    }
}

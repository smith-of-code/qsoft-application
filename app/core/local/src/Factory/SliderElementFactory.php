<?php

namespace QSoft\Factory;

final class SliderElementFactory extends Factorable
{
    protected function makeOne(): array
    {
        return [
            'UF_SLIDER_ID' => $this->additionalInfo['sliders'][array_rand($this->additionalInfo['sliders'])],
            'UF_TYPE' => $this->additionalInfo['types'][array_rand($this->additionalInfo['types'])],
            'UF_ELEMENT_ID' => $this->additionalInfo['elements'][array_rand($this->additionalInfo['elements'])],
        ];
    }
}

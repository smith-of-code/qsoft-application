<?php

namespace QSoft\Seeder;

interface Seederable
{
    public static function seed(string $blockName): void;
}

<?php

namespace QSoft\Seeder;

use Bitrix\Main\Loader;
use Bitrix\Highloadblock\HighloadBlockTable;
use Bitrix\Main\Application;
use Bitrix\Main\Security\Random;
use QSoft\Factory\SliderFactory;
use RuntimeException;

class SliderSeeder implements Seederable
{
    public static function seed(string $blockName): void
    {
        if (!Loader::includeModule('highloadblock')) {
            throw new RuntimeException('Не удалось загрузить модуль highloadblock');
        }

        $connection = Application::getInstance()->getConnection();
        $connection->startTransaction();

        $hlBlock = HighloadBlockTable::getRow(['filter' => ['=NAME' => $blockName]]);
        if (!$hlBlock) {
            throw new RuntimeException(sprintf('Не найден hl-блок %s', $blockName));
        }

        $entityManager = HighloadBlockTable::compileEntity($hlBlock)->getDataClass();
        $sliders = SliderFactory::create()
            ->setCount(Random::getInt(5, 10))
            ->make();
        array_walk($sliders, static function ($slider) use ($entityManager) {
            $entityManager::add($slider);
        });

        $connection->commitTransaction();
    }
}

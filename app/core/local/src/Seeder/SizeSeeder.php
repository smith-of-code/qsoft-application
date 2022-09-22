<?php

namespace QSoft\Seeder;

use Bitrix\Main\Loader;
use Bitrix\Main\Security\Random;
use Bitrix\Highloadblock\HighloadBlockTable;
use Bitrix\Main\Application;
use QSoft\Factory\SizeFactory;
use RuntimeException;

class SizeSeeder implements Seederable
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
        $sizes = SizeFactory::create()
            ->setCount(Random::getInt(5, 15))
            ->make();

        array_walk($sizes, static function ($item) use ($entityManager) {
            $entityManager::add($item);
        });

        $connection->commitTransaction();
    }
}

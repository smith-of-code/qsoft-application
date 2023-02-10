<?php

namespace QSoft\Seeder;

use Bitrix\Main\Loader;
use Bitrix\Highloadblock\HighloadBlockTable;
use Bitrix\Main\Application;
use Bitrix\Main\Security\Random;
use Psr\Log\LogLevel;
use QSoft\Factory\SliderFactory;
use QSoft\Logger\Logger;
use RuntimeException;

class SliderSeeder implements Seederable
{
    public static function seed(?string $blockName = null): void
    {
        if (!Loader::includeModule('highloadblock')) {
            $error = new RuntimeException('Не удалось загрузить модуль highloadblock');
            Logger::createLogger((new \ReflectionClass(__CLASS__))->getShortName(), 0, LogLevel::ERROR)
                ->setLog(
                    $error->getMessage(),
                    [
                        'message' => $error->getMessage(),
                        'namespace' => __CLASS__,
                        'file_path' => (new \ReflectionClass(__CLASS__))->getFileName(),
                    ],
                );
            throw $error;
        }

        $connection = Application::getInstance()->getConnection();
        $connection->startTransaction();

        $hlBlock = HighloadBlockTable::getRow(['filter' => ['=NAME' => $blockName]]);
        if (!$hlBlock) {
            $error = new RuntimeException(sprintf('Не найден hl-блок %s', $blockName));
            Logger::createLogger((new \ReflectionClass(__CLASS__))->getShortName(), 0, LogLevel::ERROR)
                ->setLog(
                    $error->getMessage(),
                    [
                        'message' => $error->getMessage(),
                        'namespace' => __CLASS__,
                        'file_path' => (new \ReflectionClass(__CLASS__))->getFileName(),
                    ],
                );
            throw $error;
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

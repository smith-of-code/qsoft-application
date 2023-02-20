<?php

namespace QSoft\Seeder;

use Bitrix\Catalog\ProductTable;
use Bitrix\Main\Loader;
use Bitrix\Highloadblock\HighloadBlockTable;
use Bitrix\Main\Application;
use Bitrix\Main\Security\Random;
use Psr\Log\LogLevel;
use QSoft\Factory\SliderElementFactory;
use QSoft\Logger\Logger;
use RuntimeException;
use Throwable;

class SliderElementSeeder implements Seederable
{
    public static function seed(?string $blockName = null): void
    {
        if (!Loader::includeModule('highloadblock')) {
            $error = new RuntimeException('Не удалось загрузить модуль highloadblock');
            Logger::createFormatedLog(__CLASS__, LogLevel::ERROR, $error->getMessage());

            throw $error;
        }

        $connection = Application::getInstance()->getConnection();
        $connection->startTransaction();

        $hlBlock = HighloadBlockTable::getRow(['filter' => ['=NAME' => $blockName]]);
        if (!$hlBlock) {
            $error = new RuntimeException(sprintf('Не найден hl-блок %s', $blockName));
            Logger::createFormatedLog(__CLASS__, LogLevel::ERROR, $error->getMessage());

            throw $error;
        }

        $sliderBlock = HighloadBlockTable::getRow(['filter' => ['=NAME' => 'HlSlider']]);
        if (!$sliderBlock) {
            $error = new RuntimeException(sprintf('Не найден hl-блок %s', 'HlSlider'));
            Logger::createFormatedLog(__CLASS__, LogLevel::ERROR, $error->getMessage());

            throw $error;
        }

        $sliderIds = [];
        $sliders = \CUserTypeEntity::GetList([], ['ENTITY_ID' => 'HLBLOCK_' . $sliderBlock['ID']]);
        while ($slider = $sliders->Fetch()) {
            $sliderIds[] = $slider['ID'];
        }

        try {
            $productIds = [];
            $products = ProductTable::getList();
            while ($product = $products->Fetch()) {
                $productIds[] = $product['ID'];
            }
        } catch (Throwable $e) {
            // Нет товаров
            return;
        }

        $entityManager = HighloadBlockTable::compileEntity($hlBlock)->getDataClass();
        $sliders = SliderElementFactory::create()
            ->setCount(Random::getInt(5, 10))
            ->setAdditionalInfo('sliders', $sliderIds)
            ->setAdditionalInfo('products', $productIds)
            ->make();
        array_walk($sliders, static function ($slider) use ($entityManager) {
            $entityManager::add($slider);
        });

        $connection->commitTransaction();
    }
}

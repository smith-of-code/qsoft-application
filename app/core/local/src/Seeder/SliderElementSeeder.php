<?php

namespace QSoft\Seeder;

use Bitrix\Catalog\ProductTable;
use Bitrix\Main\Loader;
use Bitrix\Highloadblock\HighloadBlockTable;
use Bitrix\Main\Application;
use Bitrix\Main\Security\Random;
use QSoft\Factory\SliderElementFactory;
use RuntimeException;
use Throwable;

class SliderElementSeeder implements Seederable
{
    public static function seed(?string $blockName = null): void
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

        $sliderBlock = HighloadBlockTable::getRow(['filter' => ['=ID' => HIGHLOAD_BLOCK_HLSLIDER]]);
        if (!$sliderBlock) {
            throw new RuntimeException(sprintf('Не найден hl-блок %s', 'HlSlider'));
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

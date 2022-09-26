<?php

namespace QSoft\Seeder;

use Bitrix\Catalog\ProductTable;
use Bitrix\Main\Loader;
use Bitrix\Highloadblock\HighloadBlockTable;
use Bitrix\Main\Application;
use QSoft\Factory\RelatedProductFactory;
use RuntimeException;
use Throwable;

class RelatedProductSeeder implements Seederable
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
        $products = RelatedProductFactory::create()
            ->setCount(ceil(count($productIds) * 0.75))
            ->setAdditionalInfo('products', $productIds)
            ->make();
        array_walk($products, static function ($product) use ($entityManager) {
            $entityManager::add($product);
        });

        $connection->commitTransaction();
    }
}

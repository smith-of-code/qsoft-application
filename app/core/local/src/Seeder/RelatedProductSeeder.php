<?php

namespace QSoft\Seeder;

use Bitrix\Catalog\ProductTable;
use Bitrix\Main\Loader;
use Bitrix\Highloadblock\HighloadBlockTable;
use Bitrix\Main\Application;
use Psr\Log\LogLevel;
use QSoft\Factory\RelatedProductFactory;
use QSoft\Logger\Logger;
use RuntimeException;
use Throwable;

class RelatedProductSeeder implements Seederable
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

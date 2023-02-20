<?php

namespace QSoft\Seeder;

use Bitrix\Catalog\ProductTable;
use Bitrix\Main\Loader;
use Bitrix\Highloadblock\HighloadBlockTable;
use Bitrix\Main\Application;
use QSoft\Factory\WishlistFactory;
use RuntimeException;
use CUser;
use Psr\Log\LogLevel;
use QSoft\Logger\Logger;
use Throwable;

class WishlistSeeder implements Seederable
{
    public static function seed(?string $blockName = null): void
    {
        if (!Loader::includeModule('highloadblock')) {
            $error = new RuntimeException('Не удалось загрузить модуль highloadblock');
            Logger::createFormatedLog(__CLASS__, LogLevel::ERROR, null, $error);
 
            throw $error;
        }

        $connection = Application::getInstance()->getConnection();
        $connection->startTransaction();

        $hlBlock = HighloadBlockTable::getRow(['filter' => ['=NAME' => $blockName]]);
        if (!$hlBlock) {
            $error = new RuntimeException(sprintf('Не найден hl-блок %s', $blockName));
            Logger::createFormatedLog(__CLASS__, LogLevel::ERROR, null, $error);
 
            throw $error;
        }

        $userIds = [];
        $users = CUser::GetList();
        while ($user = $users->Fetch()) {
            $userIds[] = $user['ID'];
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
        $products = WishlistFactory::create()
            ->setCount(ceil(0.5 * count($userIds)))
            ->setAdditionalInfo('users', $userIds)
            ->setAdditionalInfo('products', $productIds)
            ->make();
        array_walk($products, static function ($product) use ($entityManager) {
            $entityManager::add($product);
        });

        $connection->commitTransaction();
    }
}

<?php

namespace QSoft\Basket;

use Bitrix\Catalog\PriceTable;
use Bitrix\Catalog\Product\CatalogProvider;
use Bitrix\Sale\SaleProviderBase;
use QSoft\Entity\User;

class ProductProvider extends CatalogProvider
{
    protected const PRIVATE_PRICE_CODE_PREFIX = 'PRICE_';

    public function getProductData(array $products)
    {
        $products = parent::getProductData($products);

        $basketItemsByOffers = [];

        $productsData = $products->getData()[SaleProviderBase::SUMMMARY_PRODUCT_LIST];

        foreach ($productsData as $offerId => $offer) {
            foreach ($offer[SaleProviderBase::FLAT_PRICE_LIST] as $basketItemId => $basketItem) {
                $basketItemsByOffers[$offerId] = $basketItemId;
            }
        }

        $userId = $this->getContext()['USER_ID'];

        $priceTypes = ['BASE'];
        if (!empty($userId)) {
            $userPriceCode = self::PRIVATE_PRICE_CODE_PREFIX . (new User($userId))->loyaltyLevel;
            $priceTypes[] = $userPriceCode;
        }

        dump($priceTypes);

        $dbPrices = PriceTable::getList([
            'filter' => [
                '=PRODUCT_ID' => array_keys($basketItemsByOffers),
                '=CATALOG_GROUP.XML_ID' => $priceTypes
            ],
            'select' => ['ID', 'PRODUCT_ID', 'PRICE', 'PRICE_CODE' => 'CATALOG_GROUP.XML_ID', 'CATALOG_GROUP_ID', 'PRICE_TYPE_NAME' => 'CATALOG_GROUP.NAME']
        ]);

        while ($price = $dbPrices->fetch()) {
            $basketItem = &$productsData[$price['PRODUCT_ID']][SaleProviderBase::FLAT_PRICE_LIST][$basketItemsByOffers[$price['PRODUCT_ID']]];

            if (isset($userPriceCode) && $price['PRICE_CODE'] === $userPriceCode) {
//                $basketItem['BASE_PRICE'] = $price['PRICE'];
                $basketItem['PRICE'] = $price['PRICE'];
                $basketItem['PRICE_TYPE_ID'] = $price['CATALOG_GROUP_ID'];
                $basketItem['PRODUCT_PRICE_ID'] = $price['ID'];
                $basketItem['NOTES'] = $price['PRICE_TYPE_NAME'];
            } elseif ($price['PRICE_CODE'] === 'BASE') {
                $basketItem['BASE_PRICE'] = $price['PRICE'];
            }

            unset($basketItem);
        }

        $productsData = $this->calculateDiscountPrice($productsData);

//        dd($productsData);

        $products->setData([SaleProviderBase::SUMMMARY_PRODUCT_LIST => $productsData]);

        dump([
            '$products' => $products,
            'bt' => debug_backtrace()
        ]);

        return $products;
    }

    protected function calculateDiscountPrice(array $productsData): array
    {
        foreach ($productsData as &$offer) {
            foreach ($offer[SaleProviderBase::FLAT_PRICE_LIST] as &$basketItem) {
                $basketItem['DISCOUNT_PRICE'] = $basketItem['BASE_PRICE'] - $basketItem['PRICE'];
            }
        }

        return $productsData;
    }

    public function getCatalogData(array $products)
    {
        $products = parent::getCatalogData($products);

        dd(['getCatalogData' => $products]);
    }
}
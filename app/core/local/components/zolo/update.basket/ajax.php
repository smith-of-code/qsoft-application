<?php

use Bitrix\Catalog\Product\CatalogProvider;
use Bitrix\Currency\CurrencyManager;
use Bitrix\Main;
use Bitrix\Main\Loader;
use Bitrix\Sale\Basket;
use Bitrix\Sale\BasketBase;
use Bitrix\Sale\BasketItem;
use Bitrix\Sale\Fuser;
use QSoft\Basket\ProductProvider;


class UpdateBasketController extends \Bitrix\Main\Engine\Controller
{
    public function configureActions()
    {
        return [
            'updateItem' => [
                '-prefilters' => [
                    Main\Engine\ActionFilter\Csrf::class,
                    Main\Engine\ActionFilter\Authentication::class,
                ],
            ],
            'clearBasket' => [
                '-prefilters' => [
                    Main\Engine\ActionFilter\Csrf::class,
                    Main\Engine\ActionFilter\Authentication::class,
                ],
            ],
        ];
    }

    public function updateItemAction($id, $quantity): array
    {
        Loader::includeModule('sale');

        $basket = Basket::loadItemsForFUser(Fuser::getId(), SITE_ID);

        if ($quantity > 0) {
            $this->updateBasketItem($basket, $id, $quantity);
        } else {
            $this->deleteBasketItem($basket, $id);
        }

        $basketSaveResult = $basket->save();

        return [
            'warnings' => $basketSaveResult->getWarnings(),
            'errors' => $basketSaveResult->getErrors()
        ];
    }

    public function clearBasketAction(): array
    {
        Loader::includeModule('sale');

        CSaleBasket::DeleteAll(Fuser::getId());

        return [];
    }

    protected function updateBasketItem(BasketBase $basket, $id, $quantity)
    {
        if (!($basketItem = $this->getBasketItem($basket, $id))) {
            $basketItem = $basket->createItem('catalog', $id);
        }

        $basketItem->setFields([
            'QUANTITY' => $quantity,
            'CURRENCY' => CurrencyManager::getBaseCurrency(),
            'PRODUCT_PROVIDER_CLASS' => ProductProvider::class,
        ]);
    }

    protected function getBasketItem(BasketBase $basket, $id): ?BasketItem
    {
        foreach ($basket as $basketItem) {
            if ($basketItem->getField('PRODUCT_ID') == $id) {
                return $basketItem;
            }
        }

        return null;
    }

    protected function deleteBasketItem(BasketBase $basket, $id)
    {
        if ($basketItem = $this->getBasketItem($basket, $id)) {
            $basketItem->delete();
        }
    }
}
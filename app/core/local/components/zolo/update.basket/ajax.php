<?php

use Bitrix\Main;
use Bitrix\Sale\Basket;
use Bitrix\Sale\BasketBase;


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
        ];
    }

    public function updateItemAction($id, $quantity): array
    {
        $basket = Basket::loadItemsForFUser(CSaleBasket::GetBasketUserID(), SITE_ID);

        if ($quantity > 0) {
            $this->updateBasketItem($basket, $id, $quantity);
        } else {
            $this->deleteBasketItem($basket, $id);
        }

        return ['test' => 'value'];
    }

    protected function updateBasketItem(BasketBase $basket, $id, $quantity)
    {
        if ($basketItem = $this->getBasketItem($basket, $id)) {
            if (!$basketItem->setField('QUANTITY', $quantity)->isSuccess()) {
                // TODO log error
            }
        } else {
            $basketItem = $basket->createItem('catalog', $id);

            $resultCreate = $basketItem->setFields([
                'QUANTITY' => $quantity,
                'CURRENCY' => $this->currency,
                'LID' => SITE_ID,
                'PRODUCT_PROVIDER_CLASS' => 'Qsoft\Catalog\Provider\ProductProvider',
            ]);

            if (!$resultCreate->isSuccess()) {
                // TODO log error
            }
        }

        if (!$basket->save()->isSuccess()) {
            // TODO log error
        }
    }

    protected function getBasketItem(BasketBase $basket, $id): ?\Bitrix\Sale\BasketItem
    {
        foreach ($basket as $basketItem) {
            if ($basketItem->getField('PRODUCT_ID') == $id) {
                return $basketItem;
            }
        }

        return null;
    }

    protected function deleteBasketItem($id)
    {

    }

}
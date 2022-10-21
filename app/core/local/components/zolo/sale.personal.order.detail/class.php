<?php if (!defined('B_PROLOG_INCLUDED') || !B_PROLOG_INCLUDED) die();

use	Bitrix\Main\Loader;
use Bitrix\Sale\Order;
use Bitrix\Main\Engine\Contract\Controllerable;
use Bitrix\Main\UserTable;
use Bitrix\IBlock\Iblock;

Loader::includeModule('iblock');
Loader::includeModule('sale');

class CatalogElementComponent extends CBitrixComponent implements Controllerable
{
    public function configureActions()
    {
        return [
            'load' => [
                '-prefilters' => [
                    \Bitrix\Main\Engine\ActionFilter\Csrf::class,
                    \Bitrix\Main\Engine\ActionFilter\Authentication::class
                ],
            ]
        ];
    }

    public function onPrepareComponentParams($arParams)
    {
        return $arParams;
    }

    public function executeComponent()
    {
        $orderId = $this->arParams['ORDER_ID'];
        $this->arResult['ALL_PRODUCTS_ID'] = $this->getAllProductsId($orderId);
        $this->arResult['ORDER_DETAILS'] = $this->getOrderDetails($orderId);
        $this->arResult['PRODUCTS'] = $this->loadProducts($orderId, $this->arResult['ALL_PRODUCTS_ID'], 0, $this->arParams['LIMIT']);
        $this->arResult['OFFSET'] = $this->arResult['LIMIT'] = $this->arParams['LIMIT'];
        $this->includeComponentTemplate();
    }

    public function loadProductsAction($orderId, $allProductsId, $offset, $limit)
    {
        $result['PRODUCTS'] = $this->loadProducts($orderId, $allProductsId, $offset, $limit);
        $result['OFFSET'] = $offset + count($result['PRODUCTS']);
        return $result;
    }

    private function loadProducts($orderId, $allProductsId, $offset, $limit) {
        $orderItems = $this->getOrderListFromBasket($orderId, array_slice($allProductsId, $offset, $limit));
        $productItems = $this->getOrderListFromIBlock(array_keys($orderItems));
        return array_map(fn($e) => array_merge($orderItems[$e], $productItems[$e]), array_keys($orderItems));
    }
    private function getAllProductsId($orderId)
    {
        $orderItemsId = Bitrix\Sale\Internals\BasketTable::getList([
            'select' => ['PRODUCT_ID'],
            'filter' => ['ORDER_ID' => $orderId]
        ])->fetchAll();
        return array_map(fn($e) => $e['PRODUCT_ID'], $orderItemsId);
    }

    private function getOrderListFromIBlock($productFilterId)
    {
        $productOffers = Iblock::wakeUp(IBLOCK_PRODUCT_OFFER)
            ->getEntityDataClass()
            ::getList([
                'select' => ['PRODUCT_ID' =>'ID', 'PICTURE' => 'PREVIEW_PICTURE', 'VENDOR_CODE' => 'ARTICLE.VALUE'],
                'filter' => ['PRODUCT_ID' => $productFilterId]
            ])->fetchAll();
        return $this->productIdAsKey($productOffers);
    }

    private function getOrderListFromBasket($orderId, $orderFilterId)
    {
        $orderItems = Bitrix\Sale\Internals\BasketTable::getList([
            'select' => ['PRODUCT_ID', 'PRICE', 'QUANTITY', 'NAME'],
            'filter' => ['ORDER_ID' => $orderId, 'PRODUCT_ID' => $orderFilterId],
        ])->fetchAll();
        return $this->productIdAsKey($orderItems);
    }

    private function productIdAsKey($items)
    {
        $result = [];
        foreach($items as $item) {
            $result[$item['PRODUCT_ID']] = $item;
            unset($result[$item['PRODUCT_ID']]['PRODUCT_ID']);
        }
        return $result;
    }

    private function getOrderDetails($orderId): array
    {
        $order = Order::load($orderId);
        return [
            'ORDER_ID' => $order->getId(), // == arParams['ORDER_ID']
            'CREATED_AT' => $order->getDateInsert()->format('d.m.Y'),
            'CREATED_BY' => UserTable::getById($order->getUserId())->fetch(),
            'ORDER_STATUS' => $order->getField('STATUS_ID'),
            'IS_PAID' => $order->isPaid(),
            'TOTAL_PRICE' => $order->getPrice(),
            'VOUCHER_USED' => (bool) $order->getField(['PAY_VOUCHER_NUM']),
        ];
    }
}
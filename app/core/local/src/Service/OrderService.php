<?php

namespace QSoft\Service;

use Bitrix\Main\UserTable;
use Bitrix\Main\Loader;
use Bitrix\Sale\BasketBase;
use Bitrix\Sale\Order;
use Bitrix\Sale\Basket;
use RuntimeException;
use QSoft\Common\DataSource;

class OrderService
{
    private Order $order;
    private BasketBase $basket;

    public function getInstance(int $orderId): OrderService
    {
        return new OrderService($orderId);
    }

    private function __construct(int $orderId)
    {
        $this->includeModules();
        $this->order = Order::load($orderId);
        $this->isOrderExist();
        $this->basket = Basket::loadItemsForOrder($this->order);
    }

    private function includeModules(): void
    {
        Loader::includeModule('sale');
        Loader::includeModule('catalog');
    }

    public function getOrderDetail()
    {
        $this->isOrderExist();
        $order = $this->order;
        return [
            'ID' => $order->getId(),
            'CREATED_AT' => $order->getDateInsert()->format('d.m.Y'),
            'CREATED_BY' => UserTable::getById($order->getUserId())->fetch(),
            'ORDER_STATUS' => $order->getField('STATUS_ID'),
            'IS_PAID' => $order->isPaid(),
            'TOTAL_PRICE' => $order->getPrice(),
            'VOUCHER_USED' => (bool) $order->getField(['PAY_VOUCHER_NUM']),
        ];
    }

    public function getProductsByIds($productIblockId, $idProducts)
    {
        $products = $this->getOrderListFromIBlock($productIblockId, $idProducts);
        $this->getOrderListFromBasket($products);
        return $products;
    }

    private function getOrderListFromIBlock($productIblockId, $idProducts)
    {
        $dataSource = new DataSource($productIblockId);
        return $dataSource
            ->select(['ID', 'PICTURE' => 'PREVIEW_PICTURE', 'VENDOR_CODE' => 'ARTICLE.VALUE'])
            ->filter($idProducts)
            ->getElements();
    }

    private function getOrderListFromBasket(&$idProducts)
    {
        $this->isOrderExist();
        foreach ($idProducts as &$product) {
            $basketItem = $this->basket->getExistsItems('catalog',$product['ID'])[0];
            $product['QUANTITY'] = $basketItem->getQuantity();
            $product['PRICE'] = $basketItem->getPrice();
            $product['NAME'] = $basketItem->getField('NAME');
            unset($product['ID']);
        }
    }

    private function isOrderExist()
    {
        if (!isset($this->order)) {
            throw new RuntimeException('Order not found');
        }
    }

    public function getOrderProductsId()
    {
        return ['ID' => array_map(fn($product) => $product->getProductId(), $this->basket->getBasketItems())];
    }
}
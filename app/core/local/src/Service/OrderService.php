<?php

namespace QSoft\Service;

use Bitrix\Main\Loader;
use Bitrix\Sale\Order;
use Bitrix\Sale\Basket;
use RuntimeException;

class OrderService
{
    public function __construct()
    {
        $this->includeModules();
    }

    private function includeModules(): void
    {
        Loader::includeModule('sale');
        Loader::includeModule('catalog');
    }

    public function getOrder(int $orderId): Order
    {
        $order = Order::load($orderId);
        if (!$order) {
            throw new RuntimeException('Order not found');
        }
        return $order;
    }

    public function getOrderProducts(int $orderId)
    {
        $order = $this->getOrder($orderId);

        return Basket::loadItemsForOrder($order);
    }
}
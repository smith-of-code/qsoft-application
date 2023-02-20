<?php

namespace QSoft\Service;

use Bitrix\Main\Loader;
use Bitrix\Sale\BasketBase;
use Bitrix\Sale\Order;
use Bitrix\Sale\Basket;
use QSoft\Logger\Logger;
use Psr\Log\LogLevel;
use RuntimeException;

class OrderService
{
    public const DELIVERY_OFFSET = 2; // days

    private int $orderId;
    private ?Order $order;

    public function __construct(int $orderId)
    {
        $this->orderId = $orderId;
        $this->includeModules();
    }

    private function includeModules(): void
    {
        Loader::includeModule('sale');
        Loader::includeModule('catalog');
    }

    public function getOrder(): Order
    {
        if (!isset($this->order)) {
            $this->order = Order::load($this->orderId);
            if (!$this->order) {
                $error = new RuntimeException('Order not found');
                Logger::createFormatedLog(__CLASS__, LogLevel::ERROR, $error->getMessage());
     
                throw $error;
            }
        }
        return $this->order;
    }

    public function getOrderProducts(): BasketBase
    {
        return Basket::loadItemsForOrder($this->getOrder());
    }
}

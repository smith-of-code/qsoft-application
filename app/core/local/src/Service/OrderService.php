<?php

namespace QSoft\Service;

use Bitrix\Main\Loader;
use Bitrix\Sale\BasketBase;
use Bitrix\Sale\Order;
use Bitrix\Sale\Basket;
use RuntimeException;

class OrderService
{
    const STATUSES = [
        'OD' => [
            'NAME' => 'Доставлен',
            'COLOR' => '#2D8859',
        ],
        'OP' => [
            'NAME' => 'Размещен',
            'COLOR' => '#3887B5',
        ],
        'OC' => [
            'NAME' => 'Отменен',
            'COLOR' => '#D82F49',
        ],
    ];
    private int $orderId;
    private ?Order $order;

    public function getInstance(int $orderId): OrderService
    {
        return new OrderService($orderId);
    }

    public function __construct(int $orderId)
    {
        $this->includeModules();
        $this->orderId = $orderId;
        $this->order = Order::load($this->orderId);
    }

    private function includeModules(): void
    {
        Loader::includeModule('sale');
        Loader::includeModule('catalog');
    }

    public function getOrderDetails(): Order
    {
        $this->isOrderExist();
        return $this->getDetails();
    }

    private function getDetails()
    {
        $order = $this->order;
        $result = [
            'ID' => $order->getId(),
            'CREATED_AT' => $order->getDateInsert()->format('d.m.Y'),
            'CREATED_BY' => UserTable::getById($order->getUserId())->fetch(),
            //'STATUS_NAME' =>
            //'STATUS_PAID' =>
            //'TOTAL_PRICE' =>
        ];
    }
    private function isOrderExist()
    {
        if (!$this->order) {
            throw new RuntimeException('Order not found');
        }
    }

    public function getOrderProducts(): BasketBase
    {
        return Basket::loadItemsForOrder($this->getOrder());
    }
}
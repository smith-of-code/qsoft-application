<?php if (!defined('B_PROLOG_INCLUDED') || !B_PROLOG_INCLUDED) die();

use	Bitrix\Main\Loader;
use Bitrix\Sale\Order;
use Bitrix\Main\Engine\Contract\Controllerable;
use Bitrix\Main\UserTable;
use Bitrix\IBlock\Iblock;
use	Bitrix\Main\Localization\Loc;

Loader::includeModule('iblock');
Loader::includeModule('sale');
Loc::loadMessages(__FILE__);

class CatalogElementComponent extends CBitrixComponent implements Controllerable
{
    private const PRODUCT_LIMIT = 2;
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
        return parent::onPrepareComponentParams($arParams);
    }

    public function executeComponent()
    {
        try {
            $order = Order::load($this->arParams['ORDER_ID']);
            if(is_null($order)) throw new RuntimeException(Loc::getMessage('ORDER_NOT_FOUND'));
            $orderId = $this->arParams['ORDER_ID'];
            $this->arResult['ALL_PRODUCTS_ID'] = $this->getAllProductsId($orderId);
            $this->arResult['ORDER_DETAILS'] = $this->getOrderDetails($order);
            $this->arResult['PRODUCTS'] = $this->loadProducts($orderId, $this->arResult['ALL_PRODUCTS_ID'], 0);
            $this->arResult['OFFSET'] = count($this->arResult['PRODUCTS']);
            $this->includeComponentTemplate();
        } catch (Throwable $e) {
            ShowError($e->getMessage());
        }
    }

    public function loadProductsAction($orderId, $allProductsId, $offset)
    {
        $result['PRODUCTS'] = $this->loadProducts($orderId, $allProductsId, $offset);
        $result['OFFSET'] = $offset + count($result['PRODUCTS']);
        return $result;
    }

    private function loadProducts($orderId, $allProductsId, $offset) {
        $orderItems = $this->getOrderListFromBasket($orderId, array_slice($allProductsId, $offset, self::PRODUCT_LIMIT));
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

    private function getOrderDetails($order): array
    {
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
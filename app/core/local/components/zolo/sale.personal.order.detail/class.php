<?php
if (! defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Sale\BasketItem;
use Bitrix\Sale\BasketPropertyItem;
use Bitrix\Sale\Internals\OrderPropsValueTable;
use QSoft\Service\ProductService;
use Bitrix\Main\Loader;
use Bitrix\Sale\Order;
use Bitrix\Main\Engine\Contract\Controllerable;
use	Bitrix\Main\Localization\Loc;
use \Bitrix\Main\Engine\ActionFilter\Csrf;
use \QSoft\Entity\User;
use \Bitrix\Sale\Internals\StatusTable;
use QSoft\Helper\UserFieldHelper;

Loader::includeModule('sale');
Loc::loadMessages(__FILE__);

class PersonalOrderDetailComponent extends CBitrixComponent implements Controllerable
{
    private const PRODUCT_LIMIT = 20;

    private User $user;

    public function __construct($component = null)
    {
        parent::__construct($component);

        $this->user = new User;
    }

    public function configureActions()
    {
        return [
            'load' => [
                '-prefilters' => [
                    Csrf::class,
                ],
            ]
        ];
    }

    public function executeComponent()
    {
        try {
            $order = Order::load($this->arParams['ORDER_ID']);
            if (is_null($order)) {
                throw new RuntimeException(Loc::getMessage('ORDER_NOT_FOUND'));
            }
            $this->arResult = $this->loadProducts($order->getId());
            $this->arResult['IS_CONSULTANT'] = $this->user->groups->isConsultant();
            $this->arResult['ORDER_DETAILS'] = $this->getOrderDetails($order);
            $this->includeComponentTemplate();
        } catch (Throwable $e) {
            ShowError($e->getMessage());
        }
    }

    public function loadProductsAction(int $orderId, int $offset)
    {
        return json_encode(
            [
                'basket' => $this->loadProducts($orderId, $offset),
                'test' => $_REQUEST,
            ]
        );
    } 

    private function loadProducts(int $orderId, int $offset = 0): array
    {
        $products = ProductService::getProductDataFromBasket($orderId, $offset, self::PRODUCT_LIMIT + 1);
        $isLast = self::PRODUCT_LIMIT >= count($products);
        $products = $isLast ? $products : array_slice($products, 0, -1);
        $productIds = array_map(fn($product) => $product['PRODUCT_ID'], $products);
        $offers = ProductService::getProductByIds($productIds);
        foreach ($products as &$product) {
            $product['NAME'] = $offers[$product['PRODUCT_ID']]['NAME'];
            $product['PICTURE'] = $offers[$product['PRODUCT_ID']]['PROPERTY_IMAGES_VALUE'] && $offers[$product['PRODUCT_ID']]['PROPERTY_IMAGES_VALUE'][0] ? CFile::GetPath($offers[$product['PRODUCT_ID']]['PROPERTY_IMAGES_VALUE'][0]) : '/local/templates/.default/images/no-image-placeholder.png';
            $product['ARTICLE'] = $offers[$product['PRODUCT_ID']]['PROPERTY_ARTICLE_VALUE'];
            $product['PRICE'] = self::formatPrice($product['PRICE']);
            $product['QUANTITY'] = intVal($product['QUANTITY']);
            $product['BONUSES'] *= $product['QUANTITY'];
        }
        return [
            'PRODUCTS' => $products,
            'OFFSET' => $offset + count($products),
            'last' => $isLast,
        ];
    }

    private static function formatPrice(string $numeric): string
    {
        return number_format($numeric, 0, " ", " ");
    }

    private function getOrderDetails(Order $order): array
    {
        //Получение названия статуса заказа по краткому обозначению (по ID)
        $statusName = StatusTable::getRow([
            'select' => ['NAME' => 'STATUS_LANG.NAME'],
            'filter' => ['ID' => $order->getField('STATUS_ID')],
        ]);

        $bonuses = 0;
        $withPersonalPromotion = false;
        if ($this->user->groups->isConsultant()) {
            /** @var BasketItem $basketItem */
            foreach ($order->getBasket() as $basketItem) {
                /** @var BasketPropertyItem $property */
                foreach ($basketItem->getPropertyCollection() as $property) {
                    if ($property->getField('CODE') === 'BONUSES') {
                        $bonuses += $property->getField('VALUE') * $basketItem->getQuantity();
                    }
                    if ($property->getField('CODE') === 'PERSONAL_PROMOTION') {
                        $withPersonalPromotion = true;
                    }
                }
            }
        }

        return [
            'ORDER_ID' => $order->getId(), // == arParams['ORDER_ID']
            'STATUS_ID' => $order->getField('STATUS_ID'),
            'CREATED_AT' => $order->getDateInsert()->format('d.m.Y'),
            'CREATED_BY' => $this->formUserName(),
            'ORDER_STATUS' => $statusName['NAME'],
            'IS_PAID' => $order->isPaid(),
            'TOTAL_PRICE' => self::formatPrice($order->getPrice()),
            'IS_PROMOTION' => $withPersonalPromotion,
            'BONUSES' => $bonuses,
        ];
    }

    //Получение свойства "Кем заказан" по образцу из ВТЗ: Калининнкова А.Ш.
    private function formUserName(): string
    {
        if ($this->user->lastName) {
            $userName = UserFieldHelper::userFIOFormat($this->user->name, $this->user->secondName, $this->user->lastName);
        } else {
            $userName = $this->user->email ?? $this->user->login;
        }
        return $userName;
    }
}
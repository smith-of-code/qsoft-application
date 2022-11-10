<?php
if (! defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}
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
    private const PRODUCT_LIMIT = 2;

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
        $products = ProductService::getProductDataFromBasket($orderId, $offset, self::PRODUCT_LIMIT);
        if (empty($products)) {
            return [];
        }
        $productIds = array_map(fn($product) => $product['PRODUCT_ID'], $products);
        $offers = ProductService::getProductByIds($productIds);
        $bonuses = ProductService::getBonusByProductIds($productIds);
        foreach ($products as &$product) {
            $product['NAME'] = $offers[$product['PRODUCT_ID']]['NAME'];
            $product['PICTURE'] = CFile::GetPath($offers[$product['PRODUCT_ID']]['PROPERTY_IMAGES_VALUE']);
            $product['ARTICLE'] = $offers[$product['PRODUCT_ID']]['PROPERTY_ARTICLE_VALUE'];
            $product['PRICE'] = self::formatPrice($product['PRICE']);
            $product['QUANTITY'] = intVal($product['QUANTITY']);
            $product['BONUS'] = $bonuses[$product['PRODUCT_ID']]['PRICE'] * $product['QUANTITY'] ?? 0;
        }
        return [
            'PRODUCTS' => $products,
            'OFFSET' => $offset + count($products),
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
        return [
            'ORDER_ID' => $order->getId(), // == arParams['ORDER_ID']
            'CREATED_AT' => $order->getDateInsert()->format('d.m.Y'),
            'CREATED_BY' => $this->formUserName(),
            'ORDER_STATUS' => $statusName['NAME'],
            'IS_PAID' => $order->isPaid(),
            'TOTAL_PRICE' => self::formatPrice($order->getPrice()),
            'IS_PROMOTION' => (bool)$order->getField(['PAY_VOUCHER_NUM']),
        ];
    }

    //Получение свойства "Кем заказан" по образцу из ВТЗ: Калининнкова А.Ш.
    private function formUserName(): string
    {
        $user = new User();
        $userName = '';
        if ($user->lastName) {
            $userName = UserFieldHelper::userFIOFormat($user->name, $user->secondName, $user->lastName);
        } else {
            $userName = $user->email ?? $user->login;
        }

        return $userName;
    }
}
<?php if (!defined('B_PROLOG_INCLUDED') || !B_PROLOG_INCLUDED) die();

use Bitrix\Catalog\PriceTable;
use Bitrix\Main\Loader;
use Bitrix\Sale\Order;
use Bitrix\Main\Engine\Contract\Controllerable;
use	Bitrix\Main\Localization\Loc;
use \QSoft\Service\ProductService;
use \Bitrix\Main\Engine\ActionFilter\Csrf;
use \QSoft\Entity\User;
use \Bitrix\Sale\Internals\StatusTable;
use QSoft\Helper\UserFieldHelper;

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
                    Csrf::class,
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
            if (is_null($order)) {
                throw new RuntimeException(Loc::getMessage('ORDER_NOT_FOUND'));
            }
            $this->arResult = $this->loadProductsAction($order->getId());
            $this->arResult['ORDER_DETAILS'] = $this->getOrderDetails($order);
            $this->includeComponentTemplate();
        } catch (Throwable $e) {
            ShowError($e->getMessage());
        }
    }

    public function loadProductsAction(int $orderId, int $offset = 0): array
    {
        $result['PRODUCTS'] = $this->loadProducts($orderId, $offset);
        $result['OFFSET'] = $offset + count($result['PRODUCTS']);
        return $result;
    }

    public function loadProductsBasketAction(int $orderId, int $offset = 0)
    {
        $result['PRODUCTS'] = $this->loadProducts($orderId, $offset);
        $result['OFFSET'] = $offset + count($result['PRODUCTS']);

        return json_encode(
            [
                'basket' => $result,
                'test' => $_REQUEST
            ]
        );
    }

    private function loadProducts(int $orderId, int $offset): array
    {
        $products = ProductService::getProductOfferDataClass()::getList([
            'select' => [
                'NAME',
                'VENDOR_CODE' => 'ARTICLE.VALUE',
                'PRICE' => 'BASKET.PRICE',
                'QUANTITY' => 'BASKET.QUANTITY',
                'PICTURE' => 'IMAGES.VALUE',
            ],
            'filter' => ['BASKET.ORDER_ID' => $orderId],
            'offset' => $offset,
            'limit' => self::PRODUCT_LIMIT,
        ])->fetchAll();
        $_REQUEST['tester'] = $products;
        foreach ($products as &$product) {
            $product['PICTURE'] = CFile::GetPath($product['PICTURE']);
        }

        return $products;
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
            'TOTAL_PRICE' => $order->getPrice(),
            'VOUCHER_USED' => (bool)$order->getField(['PAY_VOUCHER_NUM']),
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

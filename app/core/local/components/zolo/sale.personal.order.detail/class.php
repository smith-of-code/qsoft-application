<?php if (!defined('B_PROLOG_INCLUDED') || !B_PROLOG_INCLUDED) die();

use Bitrix\Catalog\GroupTable;
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
    private const PRODUCT_LIMIT = 41;

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
            $this->arResult = $this->prepareData($order->getId());
            $this->arResult['ORDER_DETAILS'] = $this->getOrderDetails($order);
            $this->includeComponentTemplate();
        } catch (Throwable $e) {
            ShowError($e->getMessage());
        }
    }

    public function prepareData(int $orderId, int $offset = 0): array
    {
        $result['PRODUCTS'] = $this->loadProducts($orderId, $offset);
        $result['OFFSET'] = $offset + count($result['PRODUCTS']);
        return $result;
    }

    public function loadProductsAction(int $orderId, int $offset = 0)
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
        $dbProducts = ProductService::getProductOfferDataClass()::getList([
            'select' => [
                'ID',
                'NAME',
                'VENDOR_CODE' => 'ARTICLE.VALUE',
                'PRICE' => 'BASKET.PRICE',
                'QUANTITY' => 'BASKET.QUANTITY',
                'PICTURE' => 'IMAGES.VALUE',
            ],
            'filter' => ['BASKET.ORDER_ID' => $orderId],
        ]);

        while ($row = $dbProducts->Fetch()) {
            $products[$row['ID']] = $row;
        }

        foreach ($products as &$product) {
            $product['PICTURE'] = CFile::GetPath($product['PICTURE']);
            $product['PRICE'] = self::formatPrice($product['PRICE']);
            $product['QUANTITY'] = intVal($product['QUANTITY']);
            $productIds[] = $product['ID'];
        }

        if (!empty($productIds)) {
            $bonuses = $this->getBonusByProductIds($productIds);
        }

        foreach ($products as &$product) {
            $product['BONUS'] = $bonuses[$product['ID']]['PRICE'] * $product['QUANTITY'] ?? 0;
        }

        return $products ?? [];
    }

    private function getBonusByProductIds(array $productIds)
    {
        $levelId = 0;

        $levels = GroupTable::GetList(
            [
                'select' => ['*'],
            ]
        )->fetchAll();

        $user = new User();

        $level = $user->loyalty->getLoyaltyProgramInfo()['CURRENT_LEVEL'];

        foreach ($levels as $lvl) {
            if ($lvl['NAME'] == $level) {
                $levelId = $lvl['ID'];
                break;
            }
        }

        $dbBonuses = PriceTable::GetList(
            [
                'select' => ['*'],
                'filter' => [
                    'PRODUCT_ID' => $productIds,
                    'CATALOG_GROUP_ID' => $levelId,
                ],
            ]
        );

        while ($row = $dbBonuses->Fetch()) {
            $bonuses[$row['PRODUCT_ID']] = $row;
        }

        return $bonuses;
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

<?php require_once("$_SERVER[DOCUMENT_ROOT]/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Web\Json;
use QSoft\Service\OrderService;
use QSoft\Service\ProductService;

$orderId = $_GET['order_id'];
if (!$orderId) {
    echo Json::encode([
        'status' => 'error',
        'message' => 'order_id not found',
    ]);
    die();
}

$orderProducts = (new OrderService)->getOrderProducts($orderId);

$productIds = [];
foreach ($orderProducts as $orderProduct) {
    $productIds[] = $orderProduct->getProductID();
}

$offers = (new ProductService)->getOffers($productIds);

echo Json::encode($offers);
require_once($_SERVER['DOCUMENT_ROOT'] . BX_ROOT . '/modules/main/include/epilog_after.php');
die();
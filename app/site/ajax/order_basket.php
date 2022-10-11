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

$orderProducts = (new OrderService($orderId))->getOrderProducts();

$offerIds = [];
foreach ($orderProducts as $orderProduct) {
    $offerIds[] = $orderProduct->getProductID();
}

$offers = (new ProductService)->getOffersByIds($offerIds);

echo Json::encode($offers);
require_once($_SERVER['DOCUMENT_ROOT'] . BX_ROOT . '/modules/main/include/epilog_after.php');
die();
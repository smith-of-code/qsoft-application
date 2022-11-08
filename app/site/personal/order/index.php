<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

//$APPLICATION->SetTitle("testorder");
$APPLICATION->IncludeComponent(
    "zolo:sale.personal.order.detail",
    "",
    [
        'ORDER_ID' => 6,
    ],

);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
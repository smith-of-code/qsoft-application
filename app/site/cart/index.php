<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Корзина");

dump(currentUser());

currentUser()->update([
        'UF_AGREE_WITH_PERSONAL_DATA_PROCESSING' => true
]);

dd(currentUser());
?>
<!--    <main class="page__main main">-->
<!--        --><?php
////        $APPLICATION->IncludeComponent(
////            "bitrix:sale.basket.basket",
////            "",
////            [],
////            false
////        ); ?>
<!--        --><?php //$APPLICATION->IncludeComponent(
//            "zolo:sale.basket.total",
//            '',
//            [],
//            false
//        ); ?>
<!--    </main>-->
<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
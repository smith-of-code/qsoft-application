<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Корзина");

?>
    <main class="page__main main">
<!--        --><?php
        $APPLICATION->IncludeComponent(
	"bitrix:sale.basket.basket", 
	".default", 
    [
		"PATH_TO_ORDER" => "/order/make/",
    ],
	false
); ?>
        <?php 
        $APPLICATION->IncludeComponent(
            "zolo:sale.basket.total",
            '',
            [],
            false
        ); 
        ?>
    </main>
<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
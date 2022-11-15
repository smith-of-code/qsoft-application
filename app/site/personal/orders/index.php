<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

$APPLICATION->IncludeComponent(
    "zolo:sale.personal.orders",
    "",
    [
        'SEF_FOLDER' => '/personal/orders/',
        'SEF_URL_TEMPLATES' => [
            "list" => "index.php",
            "detail" => "#ORDER_ID#",
        ],
    ]
);

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
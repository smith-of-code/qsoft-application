<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

$APPLICATION->IncludeComponent("zolo:sale.personal.referals","",
    [
        'SEF_FOLDER' => '/personal/orders/',
        'SEF_URL_TEMPLATES' => [],
    ]);

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
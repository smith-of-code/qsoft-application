<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

$APPLICATION->IncludeComponent(
    'zolo:sale.personal.notifications.list',
    '',
);

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");

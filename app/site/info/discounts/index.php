<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

$APPLICATION->SetTitle("Акции");

$APPLICATION->IncludeComponent("zolo:discounts", "",);

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");

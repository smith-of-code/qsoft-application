<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>

<?php
$APPLICATION->IncludeComponent(
    'zolo:sale.personal.notifications.list',
    '',
    [

    ]);
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>
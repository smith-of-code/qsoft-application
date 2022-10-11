<?php

require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$request = Bitrix\Main\Application::getInstance()->getContext()->getRequest();

if (!check_bitrix_sessid() || !$request->isAjaxRequest()) {
    die();
}

if ($request->isAjaxRequest()) {
    dd('dsfs');
    global $USER;
    \Bitrix\Main\Diag\Debug::dumpToFile($arReq, '$arReq', '/debug.php');
}

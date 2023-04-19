<?php
if (isset($_SERVER['PHP_AUTH_USER']) && $_SERVER['PHP_AUTH_USER'] === 'amestore' && $_SERVER['PHP_AUTH_PW'] === 'ieShei3u'){
    require $_SERVER['DOCUMENT_ROOT'].'/urlrewrite.php';
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $arResult = array();
    if ($_REQUEST['email'] && filter_var($_REQUEST['email'], FILTER_VALIDATE_EMAIL)){

// bitrix api include
        require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_before.php");
        CModule::IncludeModule('subscribe');
        global $USER;

        // запрос всех рубрик
        $rub = CRubric::GetList(
            array("LID"=>"ASC","SORT"=>"ASC","NAME"=>"ASC"),
            array("ACTIVE"=>"Y", "LID"=>LANG)
        );
        $arRubIDS = array();
        while ($arRub = $rub->Fetch()){
            $arRubIDS[] = $arRub['ID'];
        }
//        var_dump($_REQUEST);
//        exit();
        // формируем массив с полями для создания подписки
        $arFields = Array(
            "USER_ID" => ($USER->IsAuthorized() ? $USER->GetID() : false),
            "FORMAT" => "html",
            "EMAIL" => $_REQUEST['email'],
            "ACTIVE" => "Y",
            "RUB_ID" => [$_REQUEST['chanel']],
            "SEND_CONFIRM" => 'N'
        );


        $subscr = new CSubscription;

        // создаем подписку
        $ID = $subscr->Add($arFields);
        if ($ID > 0){
            $arResult['status'] = 'ok';
        } else {
            $arResult['status'] = 'error';
            $arResult['msg'] = str_replace("<br>","",$subscr->LAST_ERROR);
        }

    } else $arResult['status'] = 'error';

    header('Content-Type: application/json; charset=utf-8',true,$arResult['status']==='error'?400:200);
    echo json_encode($arResult,JSON_UNESCAPED_UNICODE);
//    header('Content-Type: application/json');
//    echo 'json_encode($arResult,JSON_UNESCAPED_UNICODE)';

}else{


//var_dump($_SERVER['PLUG_PAGE']);
//var_dump($_SERVER["DOCUMENT_ROOT"]);
//var_dump($_SERVER["DOCUMENT_URI"]);
//exit();
//if (strpos($_SERVER['DOCUMENT_URI'],[''])){}

    $filePath = $_SERVER["DOCUMENT_ROOT"].$_SERVER["DOCUMENT_URI"];
//var_dump($_SERVER["DOCUMENT_ROOT"].'/info/plug/');
//var_dump();
//exit();
//    var_dump($filePath);
//    var_dump(file_exists($filePath));

    if ( strpos($filePath,$_SERVER["DOCUMENT_ROOT"].'/info/plug/') !== false  &&    file_exists($filePath) && !is_dir($filePath)){

        $mimeType = mime_content_type($filePath);
        if (strpos($filePath,'.css') !== false){
            $mimeType = 'text/css';
        }
        if (strpos($filePath,'.svg') !== false){
            $mimeType = 'image/svg+xml';
        }
        header("Content-Type: $mimeType");
        echo file_get_contents($_SERVER["DOCUMENT_ROOT"].$_SERVER["DOCUMENT_URI"]);
    }else{
        $mimeType = mime_content_type($_SERVER["DOCUMENT_ROOT"].'/info/plug/index.html');

        header("Content-Type: $mimeType");
        echo file_get_contents($_SERVER["DOCUMENT_ROOT"].'/info/plug/index.html');
    }
}


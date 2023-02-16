<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");

require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

global $APPLICATION, $USER;

?>

<!DOCTYPE html>
<html lang="ru">
    <head>
        <title><?php $APPLICATION->ShowTitle();?></title>
        <link rel="shortcut icon" type="image/x-icon" href="<?= SITE_DIR ?>favicon.ico"/>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1 maximum-scale=1 user-scalable=0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" type="text/css" href="/local/templates/.default/css/style.css"/>
        <script src="/local/templates/.default/js/script.js"></script>
        <?php $APPLICATION->ShowHead()?>
    </head>

    <div id="panel"><?php $APPLICATION->ShowPanel(); ?></div>

    <body class="page">
    <?php $APPLICATION->SetTitle("404");?>
        <div class="page__error error">
            <div class="error__content">

            <div class="error__image">
                <picture>
                    <source media="(min-width: 768px)" srcset="/local/templates/.default/images/cat-404.png">
                    <img src="/local/templates/.default/images/cat-404-mobile.png" alt="cat-404" class="error__image-picture">
                </picture>
            </div>

            <p class="error__status">
                Error 404
            </p>

            <div class="error__message">
                <p class="error__text">Приносим извинения, такой страницы не существует.</p>
                <p class="error__text">Если Вы не нашли то, что ищете, обратитесь в нашу службу поддержки. Мы постараемся Вам помочь.</p>
            </div>

            <!--
                Кнопка "Обратиться в техподдержку" -
                при клике открывается модальное окно с формой поддержки.
                Если пользователь не авторизован, то открывается
                станица с Формой авторизации.
             -->
            <?php if ($USER->IsAuthorized()) {?>
                <button type="button" class="error__button button button--rounded button--covered button--red" data-fancybox data-modal-type="modal" href="javascript:" data-type="ajax" data-src="/ajax/popup/popup-support.php" data-selected="OTHER">
                    Обратиться в техподдержку
                </button>
            <?php } else { ?>
                <a href="/auth/" class="button">
                    <button type="button" class="error__button button button--rounded button--covered button--red">
                        Обратиться в техподдержку
                    </button>
                </a>
            <?php }?>

            <?php $APPLICATION->IncludeComponent(
                "zolo:techsupport.form.handler",
                "script",
                [],
                false
            );?>
            </div>
        </div>
    </body>
</html>
<?php
if (! defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}
global $APPLICATION;
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
    </head>

    <div id="panel"><?php $APPLICATION->ShowPanel(); ?></div>

    <body class="page">
    <?php $APPLICATION->SetTitle("Технические работы");?>
        <div class="page__error error">
            <div class="error__content">

                <div class="error__image">
                    <picture>
                        <source media="(min-width: 768px)" srcset="/local/templates/.default/images/cat-maintenance.png">
                        <img src="/local/templates/.default/images/cat-maintenance-mobile.png" alt="cat-maintenance" class="error__image-picture">
                    </picture>
                </div>

                <p class="error__status">
                    Технические работы
                </p>

                <div class="error__message">

                    <p class="error__text">
                        Сегодня до 12:00 мы проводим технические работы, чтобы наш сайт работал лучше.
                    </p>

                    <p class="error__text">
                        Пока Вы ждете, предлагаем почитать новую статью на нашем канале.
                    </p>

                    <p class="error__text">
                        <a href="#" class="error__link button button--simple button--red button--over">Как подобрать корм для стерилизованных кошек</a>
                    </p>
                </div>
            </div>
        </div>
    </body>
</html>

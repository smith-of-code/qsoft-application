<?php

use QSoft\Helper\Page;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
CJSCore::Init(["fx"]);

\Bitrix\Main\UI\Extension::load('zolo.loader');

global $APPLICATION;
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <title><?php $APPLICATION->ShowTitle() ?></title>
    <link rel="shortcut icon" type="image/x-icon" href="<?= SITE_DIR ?>favicon.ico"/>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1 maximum-scale=1 user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" type="text/css" href="/local/templates/.default/css/style.css"/>
    <script src="/local/templates/.default/js/script.js"></script>
    <?php $APPLICATION->ShowHead() ?>
</head>

<div id="panel"><?php $APPLICATION->ShowPanel(); ?></div>

<body class="page">
<!--header-->
<header class="page__header header">

    <div class="header__row header__row--main">
        <div class="container">
            <div class="header__wrapper">
                <div class="header__block header__block--logo">
                    <div class="logo">
                        <a class="logo__link" href="/">
                            <img class="logo__pic" src="/local/templates/.default/images/icons/logo.svg" alt="logo">
                        </a>
                    </div>
                </div>

                <!--Каталог-->
                <?php
                    $APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "header_catalog_menu",
                        [
                            "ROOT_MENU_TYPE" => "consumers_bottom",
                            "MAX_LEVEL" => "1",
                            "HEAD_PATH" => "/include/consumers.php",
                            'COLUMN_ADDITIONAL_CLASS' => 'footer__list--customers'
                        ]
                    );
                    ?>
                <!--Каталог-->

                <!--Поиск-->
                <div class="header__block header__block--search search">
                    <div class="header__search header__search--tablet">
                        <button type="button" class="button button--iconed button--simple button--red"
                                data-fancybox data-modal-type="modal"
                                data-src="#search"
                        >
                                        <span class="button__icon">
                                            <svg class="icon icon--search">
                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-search"></use>
                                            </svg>
                                        </span>
                        </button>

                        <!--Попап поиска-->
                        <article id="search" class="modal modal--whole" style="display: none">
                            <div class="modal__content">
                                <header class="modal__section modal__section--header">
                                    <h4 class="heading heading--average">Поиск</h4>
                                </header>

                                <section class="modal__section modal__section--content">
                                    <div class="form__row">
                                        <div class="form__col">
                                            <div class="form__field">
                                                <div class="form__field-block form__field-block--input">
                                                    <div class="header__search-input input input--small input--buttoned">
                                                        <input type="text"
                                                               class="header__search-input-control input__control"
                                                               name="text" id="text5" placeholder="Я ищу...">
                                                        <button type="button"
                                                                class="input__button input__button--search button button--iconed button--covered button--square button--dark">
                                                                        <span class="button__icon button__icon--medium">
                                                                            <svg class="icon icon--search">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-search"></use>
                                                                            </svg>
                                                                        </span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </article>
                        <!--/Попап поиска-->
                    </div>

                    <div class="header__search header__search--desktop">
                        <div class="form__field">
                            <div class="form__field-block form__field-block--input">
                                <div class="header__search-input input input--small input--buttoned">
                                    <input type="text" class="header__search-input-control input__control" name="text"
                                           id="text5" placeholder="Я ищу...">
                                    <button type="button"
                                            class="input__button input__button--search button button--iconed button--covered button--square button--dark">
                                                    <span class="button__icon button__icon--medium">
                                                        <svg class="icon icon--search">
                                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-search"></use>
                                                        </svg>
                                                    </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!--/Поиск-->

                <div class="header__block header__block--personal personal">
                    <div class="personal__elements">
                        <?php
                        $APPLICATION->IncludeComponent(
                            'zolo:sale.personal.notifications.list',
                            'notification_header',
                        );

                        ?>

                        <?php if ($USER->isAuthorized()): ?>
                            <div class="personal__item personal__item--hidden">
                                <button type="button" class="button button--simple button--red button--vertical" onclick="location.href='/personal';">
                                    <span class="button__icon button__icon--mixed">
                                        <svg class="icon icon--user">
                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-user"></use>
                                        </svg>
                                    </span>
                                    <span class="personal__button-text button__text">Профиль</span>
                                </button>
                            </div>
                        <?php else: ?>
                            <div class="personal__item personal__item--hidden">
                                <button type="button" class="button button--simple button--red button--vertical" onclick="location.href='/login';">
                                    <span class="button__icon button__icon--mixed">
                                        <svg class="icon icon--login">
                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-login"></use>
                                        </svg>
                                    </span>
                                    <span class="personal__button-text button__text">Войти</span>
                                </button>
                            </div>
                        <?php endif ?>

                        <? $APPLICATION->IncludeComponent(
                            'zolo:sale.basket.basket.line',
                            '',
                            [
                                "PATH_TO_BASKET" => SITE_DIR . "personal/cart/",
                                "PATH_TO_PERSONAL" => SITE_DIR . "personal/",
                                "SHOW_PERSONAL_LINK" => "N",
                                "SHOW_NUM_PRODUCTS" => "Y",
                                "SHOW_TOTAL_PRICE" => "Y",
                                "SHOW_PRODUCTS" => "N",
                                "POSITION_FIXED" => "N",
                                "PATH_TO_REGISTER" => SITE_DIR . "login/",
                                "PATH_TO_PROFILE" => SITE_DIR . "personal/"
                            ],
                            false,
                            array()
                        ); ?>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--нижнее меню-->
    <div class="header__row header__row--nav">
        <div class="container">
            <div class="header__wrapper">
                <nav class="navigation">
                    <ul class="navigation__list">
                        <li class="navigation__item">
                            <a href="#" class="navigation__button button button--simple button--red">
                                <span class="button__text">AmeБизнес</span>
                            </a>
                        </li>

                        <li class="navigation__item">
                            <a href="/info/faq/" class="navigation__button button button--simple button--red">
                                <span class="button__text">FAQ</span>
                            </a>
                        </li>

                        <li class="navigation__item">
                            <a href="/info/news/" class="navigation__button button button--simple button--red">
                                <span class="button__text">Новости</span>
                            </a>
                        </li>

                        <li class="navigation__item">
                            <a href="#" type="button" class="navigation__button button button--simple button--dark-red">
                                            <span class="button__icon">
                                                <svg class="icon icon--discount">
                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-discount"></use>
                                                </svg>
                                            </span>
                                <span class="button__text">Акции</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <!--/нижнее меню-->
</header>
<!--/header-->


<div class="page__content content">
    <div class="container">
        <main class="page__private private">

            <h1 class="page__heading">Личный кабинет</h1>

            <div class="content__main">
                <div class="private__row">
                    <div class="private__col private__col--limited">
                        <?php $APPLICATION->IncludeComponent('zolo:personal.main.profile.navigation_menu', '')?>
                    </div>
                    <div class="private__col private__col--full">
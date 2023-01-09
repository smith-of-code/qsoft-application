<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\UI\Extension;
use QSoft\Entity\User;
use QSoft\Helper\Page;

CJSCore::Init(['fx']);
Extension::load('zolo.loader');

global $APPLICATION;

$user = new User;?>

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
<header class="page__header <?= Page::isMain() ? 'header--main page__header--main' : 'header' ?>">

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
                            "ALLOW_MULTI_SELECT" => "N",
                            "CHILD_MENU_TYPE" => "top_catalog",
                            "DELAY" => "N",
                            "MAX_LEVEL" => "2",
                            "MENU_CACHE_GET_VARS" => [],
                            "MENU_CACHE_TIME" => "3600",
                            "MENU_CACHE_TYPE" => "A",
                            "MENU_CACHE_USE_GROUPS" => "Y",
                            "ROOT_MENU_TYPE" => "top_catalog",
                            "USE_EXT" => "Y",
                        ]
                    );
                ?>
                <!--Каталог-->

                <!--Поиск-->
                <?$APPLICATION->IncludeComponent(
                    "bitrix:search.form",
                    "",
                    [
                        "USE_SUGGEST" => "N",
                        "PAGE" => "#SITE_DIR#search/index.php"
                    ]
                );?>
                <!--/Поиск-->

                <div class="header__block header__block--personal personal">
                    <div class="personal__elements">

                        <!--выпадающий список уведомлений-->
                        <?php
                            $APPLICATION->IncludeComponent(
                                'zolo:sale.personal.notifications.list',
                                "notification_header",
                                [
                                    'ONLY_UNREAD' => 'Y',
                                    'LIMIT_COUNT_BY_PAGE' => 20
                                ]
                            );
                        ?>
                        <!--выпадающий список уведомлений-->

                        <?php if ($user->isAuthorized):?>
                            <div class="personal__item personal__item--hidden">
                                <div class="dropdown dropdown--hover" data-dropdown>
                                    <button type="button" class="button button--simple button--red button--vertical" data-dropdown-button>
                                        <span class="button__icon button__icon--mixed">
                                            <svg class="icon icon--user">
                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-user"></use>
                                            </svg>
                                        </span>
                                        <span class="personal__button-text button__text">Профиль</span>
                                    </button>
                                    <div class="logout dropdown__box dropdown__box--shifted dropdown__box--scrolled box box--shadow" data-dropdown-block>
                                        <div class="logout__name">
                                            <button class="logout__button-name button button--simple button--red" onclick="location.href='/personal';">
                                                <span class="logout__lastname" data-truncate-symbols="17"><?=$user->lastName?></span>
                                                <span class="logout__names" data-truncate-symbols="15"><?=$user->name?>&nbsp;</span>
                                                <span class="logout__secondname" data-truncate-symbols="17"><?=$user->secondName?></span>  
                                            </button>
                                        </div>
                                        <div class="logout__id">
                                            ID <?=$user->id?>
                                        </div>
                                        <button type="button" class="logout__button button button--rounded button--outlined button--red" data-logout>
                                            <span class="button__icon">
                                                <svg class="icon icon--basket">
                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-logout"></use>
                                                </svg>
                                            </span>
                                            <span class="button__text">Выйти из профиля</span>
                                        </button>
                                    </div>
                                </div>
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

                        <?php $APPLICATION->IncludeComponent(
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
        <?php
            $APPLICATION->IncludeComponent(
                "bitrix:menu",
                "top_menu_ame",
                [
                    "ALLOW_MULTI_SELECT" => "N",
                    "DELAY" => "N",
                    "MAX_LEVEL" => "1",
                    "MENU_CACHE_GET_VARS" => [],
                    "MENU_CACHE_TIME" => "3600",
                    "MENU_CACHE_TYPE" => "A",
                    "MENU_CACHE_USE_GROUPS" => "Y",
                    "ROOT_MENU_TYPE" => "top_mobile",
                ]
            );
        ?>
    <!--/нижнее меню-->
</header>
<!--/header-->

<div class="page__content content <?= Page::hasBreadcrumbs() ? 'page__content--breadcrumbs' : '' ?> <?= Page::isMain() ? 'page__content--main' : '' ?>">
    <div class="container">
        <main class="<?= Page::isMain() ? 'page__main main' : (Page::isCatalog() ? 'page__catalog catalog' : '') ?>">

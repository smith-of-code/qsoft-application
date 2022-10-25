<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
CJSCore::Init(["fx"]);

\Bitrix\Main\UI\Extension::load('zolo.loader');

global $APPLICATION;
?>

<script>
    window.onload = () => {
        (new Zolo.Loader()).run();
    }
</script>

<!DOCTYPE html>
<html lang="ru">
<head>
    <title><?php $APPLICATION->ShowTitle() ?></title>
    <link rel="shortcut icon" type="image/x-icon" href="<?= SITE_DIR ?>favicon.ico"/>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1 maximum-scale=1 user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" type="text/css" href="/local/templates/.default/css/style.css" />
    <script src="/local/templates/.default/js/script.js"></script>
    <?php $APPLICATION->ShowHead()?>
</head>

<div id="panel"><?php $APPLICATION->ShowPanel(); ?></div>

<body class="page">
<!--header-->
<header class="page__header header header--main">

    <div class="header__row header__row--main">
        <div class="container">
            <div class="header__wrapper">
                <div class="header__block header__block--logo">
                    <div class="logo">
                        <a class="logo__link" href="#">
                            <img class="logo__pic" src="/local/templates/.default/images/icons/logo.svg" alt="logo">
                        </a>
                    </div>
                </div>

                <!--Каталог-->
                <div class="header__block header__block--catalog catalog">
                    <div class="header__catalog">
                        <div class="dropdown dropdown--menu" data-dropdown>
                            <!--кнопка основная-->
                            <div class="header__catalog-button header__catalog-button--main">
                                <button type="button"
                                        class="button button--big button--square button--covered button--red button--heavy"
                                        data-dropdown-button>
                                                <span class="button__icon">
                                                    <svg class="icon icon--burger">
                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-burger"></use>
                                                    </svg>
                                                </span>
                                    <span class="button__text">Каталог</span>
                                </button>
                            </div>
                            <!--/кнопка основная-->

                            <!--кнопка на МВ-->
                            <div class="header__catalog-button header__catalog-button--hidden">
                                <button type="button"
                                        class="button button--covered button--square button--small button--red button--burger"
                                        data-dropdown-button>
                                                <span class="button__icon button__icon--medium">
                                                    <svg class="icon icon--burger">
                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-burger"></use>
                                                    </svg>
                                                </span>
                                </button>
                            </div>
                            <!--/кнопка на МВ-->

                            <!--дропдаун каталога-->
                            <div class="menu dropdown__box box box--shading" data-dropdown-block>
                                <div class="dropdown__close" data-dropdown-close>
                                    <svg class="dropdown__close-icon icon icon--close-square">
                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-close-square"></use>
                                    </svg>
                                </div>

                                <div class="menu__header">
                                    <div class="menu__header-logo logo logo--small">
                                        <img class="logo__pic" src="/local/templates/.default/images/icons/logo.svg"
                                             alt="logo">
                                    </div>
                                    <div class="menu__header-profile">
                                        <button type="button"
                                                class="button button--huge button--rounded button--outlined button--green button--full">
                                                        <span class="button__icon button__icon--right">
                                                            <svg class="icon icon--user">
                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-user"></use>
                                                            </svg>
                                                        </span>
                                            <span class="button__text">Войти в профиль</span>
                                        </button>
                                    </div>

                                    <p class="menu__header-title">Каталог товаров</p>
                                </div>

                                <div class="menu__content">
                                    <div class="menu__row">
                                        <div class="menu__col">
                                            <ul class="menu__list">
                                                <li class="menu__item menu__item--heading">
                                                    <a href="#"
                                                       class="menu__item-link button button--simple button--red">Для
                                                        собак</a>
                                                </li>
                                                <li class="menu__item">
                                                    <a href="#"
                                                       class="menu__item-link button button--simple button--red">Сухой
                                                        корм</a>
                                                </li>

                                                <li class="menu__item">
                                                    <a href="#"
                                                       class="menu__item-link button button--simple button--red">Влажный
                                                        корм</a>
                                                </li>

                                                <li class="menu__item">
                                                    <a href="#"
                                                       class="menu__item-link button button--simple button--red">Лакомства</a>
                                                </li>

                                                <li class="menu__item">
                                                    <a href="#"
                                                       class="menu__item-link button button--simple button--red">Аксессуары</a>
                                                </li>

                                                <li class="menu__item">
                                                    <a href="#"
                                                       class="menu__item-link button button--simple button--red">Советы
                                                        экспертов</a>
                                                </li>
                                            </ul>

                                            <div class="menu__image">
                                                <img src="/local/templates/.default/images/dog.png"
                                                     alt="Каталог для собак" class="menu__image-pic">
                                            </div>
                                        </div>
                                        <div class="menu__col menu__col--right">
                                            <ul class="menu__list">
                                                <li class="menu__item menu__item--heading">
                                                    <a href="#"
                                                       class="menu__item-link button button--simple button--red">Для
                                                        кошек</a>
                                                </li>
                                                <li class="menu__item">
                                                    <a href="#"
                                                       class="menu__item-link button button--simple button--red">Сухой
                                                        корм</a>
                                                </li>

                                                <li class="menu__item">
                                                    <a href="#"
                                                       class="menu__item-link button button--simple button--red">Влажный
                                                        корм</a>
                                                </li>

                                                <li class="menu__item">
                                                    <a href="#"
                                                       class="menu__item-link button button--simple button--red">Лакомства</a>
                                                </li>

                                                <li class="menu__item">
                                                    <a href="#"
                                                       class="menu__item-link button button--simple button--red">Аксессуары</a>
                                                </li>

                                                <li class="menu__item">
                                                    <a href="#"
                                                       class="menu__item-link button button--simple button--red">Советы
                                                        экспертов</a>
                                                </li>
                                            </ul>

                                            <div class="menu__image">
                                                <img src="/local/templates/.default/images/cat.png"
                                                     alt="Каталог для кошек" class="menu__image-pic">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="menu__division">
                                    <ul class="menu__list">
                                        <li class="menu__item menu__item--small">
                                            <a href="#" class="menu__item-link button button--simple button--red">AmeБизнес</a>
                                        </li>

                                        <li class="menu__item menu__item--small">
                                            <a href="#"
                                               class="menu__item-link button button--simple button--red">FAQ</a>
                                        </li>

                                        <li class="menu__item menu__item--small">
                                            <a href="#" class="menu__item-link button button--simple button--red">Новости</a>
                                        </li>

                                        <li class="menu__item menu__item--small">
                                            <a href="#"
                                               class="menu__item-link button button--simple button--red">Акции</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!--/дропдаун каталога-->
                        </div>
                    </div>
                </div>
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
                        <div class="personal__item personal__item--hidden">
                            <div class="dropdown dropdown--long" data-dropdown>
                                <button type="button" class="button button--simple button--red button--vertical"
                                        data-dropdown-button>
                                                <span class="button__icon button__icon--mixed">
                                                    <svg class="icon icon--notification">
                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-notification"></use>
                                                    </svg>

                                                    <span class="button__icon-counter button__icon-counter--red">10</span>
                                                </span>

                                    <span class="personal__button-text button__text">Уведомления</span>
                                </button>

                                <!--выпадающий список уведомлений-->
                                <div class="notice dropdown__box dropdown__box--shifted dropdown__box--scrolled box box--shadow"
                                     data-dropdown-block>
                                    <div class="notice__content" data-scrollbar>
                                        <ul class="notice__list">
                                            <li class="notice__item">
                                                <!--Статус-->
                                                <article class="status">
                                                    <a href="#" class="status__link"></a>
                                                    <div class="status__header">
                                                        <svg class="status__header-icon icon icon--notification">
                                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-notification"></use>
                                                        </svg>

                                                        <p class="status__header-heading heading heading--tiny">Статус
                                                            заявки изменился</p>
                                                    </div>

                                                    <p class="status__info">Ваша заявка на смену наставника была
                                                        рассмотрена и одобрена. Узнать информацию о своем новом
                                                        наставни...</p>

                                                    <div class="status__footer">
                                                        <span class="status__date">10.12.2022</span>
                                                        <span class="status__time"> 12:45</span>
                                                    </div>
                                                </article>
                                                <!--Статус-->
                                            </li>

                                            <li class="notice__item">
                                                <article class="status">
                                                    <a href="#" class="status__link"></a>
                                                    <div class="status__header">
                                                        <svg class="status__header-icon icon icon--notification">
                                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-notification"></use>
                                                        </svg>

                                                        <p class="status__header-heading heading heading--tiny">Статус
                                                            заявки изменился</p>
                                                    </div>

                                                    <p class="status__info">Ваша заявка на смену наставника была
                                                        рассмотрена и одобрена. Узнать информацию о своем новом
                                                        наставни...</p>

                                                    <div class="status__footer">
                                                        <span class="status__date">10.12.2022</span>
                                                        <span class="status__time"> 12:45</span>
                                                    </div>
                                                </article>
                                            </li>

                                            <li class="notice__item">
                                                <article class="status">
                                                    <a href="#" class="status__link"></a>
                                                    <div class="status__header">
                                                        <svg class="status__header-icon icon icon--notification">
                                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-notification"></use>
                                                        </svg>

                                                        <p class="status__header-heading heading heading--tiny">Статус
                                                            заявки изменился</p>
                                                    </div>

                                                    <p class="status__info">Ваша заявка на смену наставника была
                                                        рассмотрена и одобрена. Узнать информацию о своем новом
                                                        наставни...</p>

                                                    <div class="status__footer">
                                                        <span class="status__date">10.12.2022</span>
                                                        <span class="status__time"> 12:45</span>
                                                    </div>
                                                </article>
                                            </li>

                                            <li class="notice__item">
                                                <article class="status">
                                                    <a href="#" class="status__link"></a>
                                                    <div class="status__header">
                                                        <svg class="status__header-icon icon icon--notification">
                                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-notification"></use>
                                                        </svg>

                                                        <p class="status__header-heading heading heading--tiny">Статус
                                                            заявки изменился</p>
                                                    </div>

                                                    <p class="status__info">Ваша заявка на смену наставника была
                                                        рассмотрена и одобрена. Узнать информацию о своем новом
                                                        наставни...</p>

                                                    <div class="status__footer">
                                                        <span class="status__date">10.12.2022</span>
                                                        <span class="status__time"> 12:45</span>
                                                    </div>
                                                </article>
                                            </li>

                                            <li class="notice__item">
                                                <article class="status">
                                                    <a href="#" class="status__link"></a>
                                                    <div class="status__header">
                                                        <svg class="status__header-icon icon icon--notification">
                                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-notification"></use>
                                                        </svg>

                                                        <p class="status__header-heading heading heading--tiny">Статус
                                                            заявки изменился</p>
                                                    </div>

                                                    <p class="status__info">Ваша заявка на смену наставника была
                                                        рассмотрена и одобрена. Узнать информацию о своем новом
                                                        наставни...</p>

                                                    <div class="status__footer">
                                                        <span class="status__date">10.12.2022</span>
                                                        <span class="status__time"> 12:45</span>
                                                    </div>
                                                </article>
                                            </li>

                                            <li class="notice__item">
                                                <article class="status">
                                                    <a href="#" class="status__link"></a>
                                                    <div class="status__header">
                                                        <svg class="status__header-icon icon icon--notification">
                                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-notification"></use>
                                                        </svg>

                                                        <p class="status__header-heading heading heading--tiny">Статус
                                                            заявки изменился</p>
                                                    </div>

                                                    <p class="status__info">Ваша заявка на смену наставника была
                                                        рассмотрена и одобрена. Узнать информацию о своем новом
                                                        наставни...</p>

                                                    <div class="status__footer">
                                                        <span class="status__date">10.12.2022</span>
                                                        <span class="status__time"> 12:45</span>
                                                    </div>
                                                </article>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="notice__action">
                                        <a href="#"
                                           class="button button--rounded-big button--bold button--outlined button--green button--full">Показать
                                            все</a>
                                    </div>
                                </div>
                                <!--выпадающий список уведомлений-->
                            </div>
                        </div>

                        <div class="personal__item personal__item--hidden">
                            <button type="button" class="button button--simple button--red button--vertical">
                                            <span class="button__icon button__icon--mixed">
                                                <svg class="icon icon--user">
                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-user"></use>
                                                </svg>
                                            </span>
                                <span class="personal__button-text button__text">Профиль</span>
                            </button>
                        </div>

                        <!--Для неавторизованного пользователя (скрыто по умолчанию)-->
                        <div class="personal__item personal__item--hidden" style="display: none">
                            <button type="button" class="button button--simple button--red button--vertical">
                                            <span class="button__icon button__icon--mixed">
                                                <svg class="icon icon--login">
                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-login"></use>
                                                </svg>
                                            </span>
                                <span class="personal__button-text button__text">Войти</span>
                            </button>
                        </div>
                        <!--/Для неавторизованного пользователя-->

                        <?$APPLICATION->IncludeComponent(
                            'zolo:sale.basket.basket.line',
                            '',
                            [
                                "PATH_TO_BASKET" => SITE_DIR."personal/cart/",
                                "PATH_TO_PERSONAL" => SITE_DIR."personal/",
                                "SHOW_PERSONAL_LINK" => "N",
                                "SHOW_NUM_PRODUCTS" => "Y",
                                "SHOW_TOTAL_PRICE" => "Y",
                                "SHOW_PRODUCTS" => "N",
                                "POSITION_FIXED" =>"N",
                                "PATH_TO_REGISTER" => SITE_DIR."login/",
                                "PATH_TO_PROFILE" => SITE_DIR."personal/"
                            ],
                            false,
                            array()
                        );?>


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
                            <a href="#" class="navigation__button button button--simple button--red">
                                <span class="button__text">FAQ</span>
                            </a>
                        </li>

                        <li class="navigation__item">
                            <a href="#" class="navigation__button button button--simple button--red">
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
        <main class="page__main main">
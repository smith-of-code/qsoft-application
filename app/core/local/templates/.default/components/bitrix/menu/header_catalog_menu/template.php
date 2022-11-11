<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
    die();
}
dump($arResult);
?>


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
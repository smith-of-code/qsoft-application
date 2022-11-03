<?php
if (!defined('B_PROLOG_INCLUDED') || !B_PROLOG_INCLUDED) {
    die();
}

/**
 * @var array $arResult
 * @var array $arParams
 * @var array $templateData
 */

$currentUrl = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
?>

<nav class="private__menu menu menu--private">
    <ul class="menu__list">
        <li class="menu__item menu__item--active">
            <a href="/personal" class="menu__link">
                <span class="menu__icon menu__icon--active">
                    <svg class="icon icon--profile gui__icon">
                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-profile"></use>
                    </svg>
                </span>
                <span class="menu__text">Профиль</span>
            </a>
        </li>

        <li class="menu__item">
            <a href="/personal/orders" class="menu__link">
                <span class="menu__icon">
                    <svg class="icon icon--receipts gui__icon">
                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-receipts"></use>
                    </svg>
                </span>
                <span class="menu__text">История заказов</span>
            </a>
        </li>

        <li class="menu__item">
            <a href="#" class="menu__link">
                <span class="menu__icon">
                    <svg class="icon icon--calculator gui__icon">
                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-calculator"></use>
                    </svg>
                </span>
                <span class="menu__text">Калькулятор доходности</span>
            </a>
        </li>

        <li class="menu__item">
            <a href="#" class="menu__link">
                <span class="menu__icon">
                    <svg class="icon icon--chart-square gui__icon">
                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-chart-square"></use>
                    </svg>
                </span>
                <span class="menu__text">Отчетность по объемам продаж</span>
            </a>
        </li>

        <li class="menu__item">
            <a href="/personal/notifications" class="menu__link">
                <span class="menu__icon">
                    <svg class="icon icon--notification gui__icon">
                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-notification"></use>
                    </svg>
                </span>
                <span class="menu__text">Уведомления</span>
                <span class="menu__counter">10</span>
            </a>
        </li>
    </ul>
</nav>

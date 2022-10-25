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

<div class="private__col private__col--limited">
    <nav class="private__menu menu menu--private">
        <ul class="menu__list">
            <li class="menu__item <?=($arParams['PROFILE_URL'] === $currentUrl) ? 'menu__item--active' : ''?>">
                <a href="<?=$arParams['PROFILE_URL']?>" class="menu__link">
                    <span class="menu__icon">
                        <svg class="icon icon--profile gui__icon">
                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-profile"></use>
                        </svg>
                    </span>
                    <span class="menu__text">
                        Профиль
                    </span>
                </a>
            </li>

            <li class="menu__item <?=($arParams['ORDER_HISTORY_URL'] === $currentUrl) ? 'menu__item--active' : ''?>">
                <a href="<?=$arParams['ORDER_HISTORY_URL']?>" class="menu__link">
                    <span class="menu__icon">
                        <svg class="icon icon--receipts gui__icon">
                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-receipts"></use>
                        </svg>
                    </span>
                    <span class="menu__text">
                        История заказов
                    </span>
                </a>
            </li>

            <li class="menu__item <?=($arParams['INCOMES_CALCULATOR_URL'] === $currentUrl) ? 'menu__item--active' : ''?>">
                <a href="<?=$arParams['INCOMES_CALCULATOR_URL']?>" class="menu__link">
                    <span class="menu__icon">
                        <svg class="icon icon--calculator gui__icon">
                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-calculator"></use>
                        </svg>
                    </span>
                    <span class="menu__text">
                        Калькулятор доходности
                    </span>
                </a>
            </li>

            <li class="menu__item <?=($arParams['SALES_REPORT_URL'] === $currentUrl) ? 'menu__item--active' : ''?>">
                <a href="<?=$arParams['SALES_REPORT_URL']?>" class="menu__link">
                    <span class="menu__icon">
                        <svg class="icon icon--chart-square gui__icon">
                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-chart-square"></use>
                        </svg>
                    </span>
                    <span class="menu__text">
                        Отчетность по объемам продаж
                    </span>
                </a>
            </li>

            <li class="menu__item <?=($arParams['NOTIFICATIONS_URL'] === $currentUrl) ? 'menu__item--active' : ''?>">
                <a href="<?=$arParams['NOTIFICATIONS_URL']?>" class="menu__link">
                    <span class="menu__icon">
                        <svg class="icon icon--notification gui__icon">
                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-notification"></use>
                        </svg>
                    </span>
                    <span class="menu__text">
                        Уведомления
                    </span>
                    <span class="menu__counter"><?=$arResult['NOTIFICATION_COUNT']?></span>
                </a>
            </li>
        </ul>
    </nav>
</div>
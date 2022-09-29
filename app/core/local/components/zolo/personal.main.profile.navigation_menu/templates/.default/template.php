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

<div>
    <ul>
        <li>
            <a href="<?=$arParams['PROFILE_URL']?>">
                Профиль
                <?=($arParams['PROFILE_URL'] === $currentUrl) ? ' (текущая ссылка)' : ''?>
            </a>
        </li>
        <li>
            <a href="<?=$arParams['ORDER_HISTORY_URL']?>">
                История заказов
                <?=($arParams['ORDER_HISTORY_URL'] === $currentUrl) ? ' (текущая ссылка)' : ''?>
            </a>
        </li>
        <li>
            <a href="<?=$arParams['INCOMES_CALCULATOR_URL']?>">
                Калькулятор доходов
                <?=($arParams['INCOMES_CALCULATOR_URL'] === $currentUrl) ? ' (текущая ссылка)' : ''?>
            </a>
        </li>
        <li>
            <a href="<?=$arParams['SALES_REPORT_URL']?>">
                Отчёт по объёмам продаж
                <?=($arParams['SALES_REPORT_URL'] === $currentUrl) ? ' (текущая ссылка)' : ''?>
            </a>
        </li>
        <li>
            <a href="<?=$arParams['NOTIFICATIONS_URL']?>">
                Уведомления
                <?=$arResult['NOTIFICATION_COUNT']?>
                <?=($arParams['NOTIFICATIONS_URL'] === $currentUrl) ? ' (текущая ссылка)' : ''?>
            </a>
        </li>
    </ul>
</div>

<?php

use Bitrix\Main\Localization\Loc;

if (!defined('B_PROLOG_INCLUDED') || !B_PROLOG_INCLUDED) {
    die();
}
Loc::loadMessages(__FILE__);
/**
 * @var array $arResult
 * @var array $arParams
 * @var array $templateData
 */

$currentUrl = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
?>

<nav class="private__menu menu menu--private">
    <ul class="menu__list">

        <?php $isCurrentUrl  = $currentUrl == $arParams['PROFILE_URL'] ? 'menu__item--active' : ''?>
        <li class="menu__item <?=$isCurrentUrl  ? 'menu__item--active' : ''?>">
            <a href="<?=$arParams['PROFILE_URL']?>" class="menu__link">
                <span class="menu__icon <?=$isCurrentUrl  ? 'menu__icon--active' : ''?>">
                    <svg class="icon icon--profile gui__icon">
                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-profile"></use>
                    </svg>
                </span>
                <span class="menu__text"><?=Loc::getMessage('PROFILE_TAB_NAME')?></span>
            </a>
        </li>

        <?php $isCurrentUrl  = $currentUrl == $arParams['ORDER_HISTORY_URL'] ? 'menu__item--active' : ''?>
        <li class="menu__item <?=$isCurrentUrl  ? 'menu__item--active' : ''?>">
            <a href="<?=$arParams['ORDER_HISTORY_URL']?>" class="menu__link">
                <span class="menu__icon <?=$isCurrentUrl  ? 'menu__icon--active' : ''?>">
                    <svg class="icon icon--receipts gui__icon">
                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-receipts"></use>
                    </svg>
                </span>
                <span class="menu__text"><?=Loc::getMessage('HISTORY_TAB_NAME')?></span>
            </a>
        </li>

        <?php if ($arResult['IS_CONSULTANT']): ?>
            <?php $isCurrentUrl  = $currentUrl == $arParams['INCOMES_CALCULATOR_URL'] ? 'menu__item--active' : ''?>
            <li class="menu__item  <?=$isCurrentUrl  ? 'menu__item--active' : ''?>">
                <a href="<?=$arParams['INCOMES_CALCULATOR_URL']?>" class="menu__link">
                    <span class="menu__icon <?=$isCurrentUrl  ? 'menu__icon--active' : ''?>">
                        <svg class="icon icon--calculator gui__icon">
                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-calculator"></use>
                        </svg>
                    </span>
                    <span class="menu__text"><?=Loc::getMessage('PROFIT_TAB_NAME')?></span>
                </a>
            </li>

            <?php $isCurrentUrl  = $currentUrl == $arParams['SALES_REPORT_URL'] ? 'menu__item--active' : ''?>
            <li class="menu__item  <?=$isCurrentUrl  ? 'menu__item--active' : ''?>">
                <a href="<?=$arParams['SALES_REPORT_URL']?>" class="menu__link">
                    <span class="menu__icon <?=$isCurrentUrl  ? 'menu__icon--active' : ''?>">
                        <svg class="icon icon--chart-square gui__icon">
                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-chart-square"></use>
                        </svg>
                    </span>
                    <span class="menu__text"><?=Loc::getMessage('SALE_VALUE_TAB_NAME')?></span>
                </a>
            </li>
        <?php endif; ?>

        <?php $isCurrentUrl  = $currentUrl == $arParams['NOTIFICATIONS_URL'] ? 'menu__item--active' : ''?>
        <li class="menu__item  <?=$isCurrentUrl  ? 'menu__item--active' : ''?>">
            <a href="<?=$arParams['NOTIFICATIONS_URL']?>" class="menu__link">
                <span class="menu__icon <?=$isCurrentUrl  ? 'menu__icon--active' : ''?>">
                    <svg class="icon icon--notification gui__icon">
                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-notification"></use>
                    </svg>
                </span>
                <span class="menu__text"><?=Loc::getMessage('NOTIFICATION_TAB_NAME')?></span>
                <?php if ($arResult['NOTIFICATION_COUNT']):?>
                    <span class="menu__counter"><?=$arResult['NOTIFICATION_COUNT']?></span>
                <?php endif;?>
            </a>
        </li>
    </ul>
</nav>

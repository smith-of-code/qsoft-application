<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */

global $USER;
$isAuthorized = $USER->IsAuthorized();

$loginLink = '/login/';

?>

<ul class="footer__list <?= $arParams['COLUMN_ADDITIONAL_CLASS'] ?>">
    <li class="footer__item footer__item--heading">
        <?php
        $APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            [
                "AREA_FILE_SHOW" => "file",
                "PATH" => $arParams['HEAD_PATH'],
            ]
        ); ?>
    </li>
    <?php foreach ($arResult as $itemIndex => $arItem): ?>
        <li class="footer__item">
            <?php $needAuth = !$isAuthorized && $arItem['PARAMS']['NEED_AUTH']; ?>
            <a href="<?= !$needAuth ? htmlspecialcharsbx($arItem['LINK']) : $loginLink ?>"
               class="footer__link" <?= $isAuthorized ? $arItem['PARAMS']['ADDITIONAL_ATTRS'] ?? '' : '' ?>
                <?= $arItem['PARAMS']['NO_LINK'] ? 'style="pointer-events: none"' : '' ?>
            >
                <?= htmlspecialcharsbx($arItem["TEXT"], ENT_COMPAT, false); ?>
            </a>
        </li>
    <?php endforeach; ?>
</ul>   
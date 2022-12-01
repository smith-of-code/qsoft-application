<?php
if (! defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */

global $USER;
$isAuthorize = $USER->IsAuthorized();

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
        );?>
    </li>
    <?php foreach($arResult as $itemIndex => $arItem):?>
        <li class="footer__item">
            <?php if (! empty($arItem["LINK"])): ?>
            <a
                href="<?=$isAuthorize ? htmlspecialcharsbx($arItem["LINK"]) : $loginLink ?>"
                class="footer__link" <?=$isAuthorize ? $arItem['PARAMS']['ADDITIONAL_ATTRS'] ?? '' : '' ?>
            ><?=htmlspecialcharsbx($arItem["TEXT"], ENT_COMPAT, false);?></a>
            <?php else: ?>
            <p
                <?=$isAuthorize ? $arItem['PARAMS']['ADDITIONAL_ATTRS'] ?? '' : '' ?>
            ><?=htmlspecialcharsbx($arItem["TEXT"], ENT_COMPAT, false);?></p>
            <?php endif; ?>
        </li>
    <?php endforeach;?>
</ul>   
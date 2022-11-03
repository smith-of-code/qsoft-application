<?php
if (! defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
?>

<ul class="footer__list">
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
            <a href="<?=htmlspecialcharsbx($arItem["LINK"])?>" class="footer__link"><?=htmlspecialcharsbx($arItem["TEXT"], ENT_COMPAT, false)?></a>
        </li>
    <?php endforeach;?>
</ul>

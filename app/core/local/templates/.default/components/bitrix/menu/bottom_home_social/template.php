<?php
if (! defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
?>

<?php foreach($arResult as $itemIndex => $arItem):?>
    <li class="social__item">
        <a href="<?=htmlspecialcharsbx($arItem["LINK"])?>" class="social__link social__link-<?=$arItem['PARAMS']['MESSENGER_ICON']?>">
            <svg class="icon icon--social">
                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-<?=$arItem['PARAMS']['MESSENGER_ICON']?>"></use>
            </svg>
        </a>
    </li>
<?endforeach;?>

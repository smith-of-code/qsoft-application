<?php
if (!defined('B_PROLOG_INCLUDED') || !B_PROLOG_INCLUDED) {
    die();
}
/**
 * @var array $arResult
 * @var array $arParams
 * @var array $templateData
 */

global $APPLICATION;

if ($arParams['SET_TITLE'] === 'Y') {
    $APPLICATION->SetTitle($arResult['NAME']);
}

if ($arParams['SET_META_KEYWORDS'] === 'Y') {
    $APPLICATION->SetPageProperty('keywords', $arResult['META_KEYWORDS']);
}

if ($arParams['SET_META_DESCRIPTION'] === 'Y') {
    $APPLICATION->SetPageProperty('description', $arResult['META_DESCRIPTION']);
}
?>

<div>
    <h1><?=$arResult['TITLE']?></h1>

    <p>Описание</p>
    <span><?=$arResult['DESCRIPTION']?></span>

    <p>Фасовки</p>
    <?php foreach ($arResult['PACKAGINGS'] as $key => $package): ?>
        <?php if ($package): ?>
            <span><?="{$package['VALUE']} ($key)"?></span>
    <?php endif; endforeach; ?>

    <p>Размеры</p>
    <?php foreach ($arResult['SIZES'] as $key => $size): ?>
        <?php if ($size): ?>
            <span><?="$size ($key)"?></span>
    <?php endif; endforeach; ?>

    <p>Цвета</p>
    <?php foreach ($arResult['COLORS'] as $key => $color): ?>
        <?php if ($color): ?>
            <span><?="$color ($key)"?></span>
    <?php endif; endforeach; ?>

    <p>Размер породы</p>
    <span><?=$arResult['BREED']?></span>

    <p>Возраст</p>
    <span><?=$arResult['AGE']?></span>

    <p>Количество в корзине</p>
    <?php foreach ($arResult['BASKET_COUNT'] as $key => $count): ?>
        <?php if ($count): ?>
            <span><?="$count ($key)"?></span>
    <?php endif; endforeach; ?>

    <p>Детальная картинка</p>
    <img src="<?=current($arResult['PRODUCT_IMAGE'])?>">

    <p>Состав</p>
    <span><?=$arResult['COMPOSITION']?></span>

    <p>Фото</p>
    <?php foreach ($arResult['PHOTOS'] as $key => $photos): ?>
        <?php if ($photos): ?>
            <span><?=$key?></span>
        <?php foreach ($photos as $photo): ?>
                <img src="<?=$photo?>">
        <?php endforeach; ?>
    <?php endif; endforeach; ?>

    <p>Материал</p>
    <span><?=$arResult['MATERIAL']?></span>

    <p>Рекомендации по кормлению</p>
    <span><?=$arResult['FEEDING_RECOMMENDATIONS']?></span>

    <p>Цены</p>
    <?php foreach ($arResult['PRICES'] as $key => $price): ?>
        <span><?="{$price['PRICE']} ($key)"?></span>
    <?php endforeach; ?>

    <p>Ссылки на документы</p>
    <?php foreach ($arResult['DOCUMENTS'] as $item): ?>
        <p><?=$item?></p>
    <?php endforeach; ?>
</div>

<?php
dump($arResult, $arParams, $templateData);
?>

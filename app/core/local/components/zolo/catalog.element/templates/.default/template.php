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
</div>

<?php
dump($arResult, $arParams, $templateData);
?>

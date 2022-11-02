<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

if (empty($arResult))
	return;
?>

<ul class="footer__list">
    <li class="footer__item footer__item--heading">
        <?$APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            [
                "AREA_FILE_SHOW" => "file",
                "PATH" => $arParams['HEAD_PATH'],
            ]
        );?>
    </li>
    <?foreach($arResult as $itemIndex => $arItem):?>
        <?if ($arItem["DEPTH_LEVEL"] == "1"):?>
            <li class="footer__item">
                <a href="<?=htmlspecialcharsbx($arItem["LINK"])?>" class="footer__link"><?=htmlspecialcharsbx($arItem["TEXT"], ENT_COMPAT, false)?></a>
            </li>
        <?endif?>
    <?endforeach;?>
</ul>
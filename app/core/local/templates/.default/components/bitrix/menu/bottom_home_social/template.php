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

<?foreach($arResult as $itemIndex => $arItem):?>
    <?if ($arItem["DEPTH_LEVEL"] == "1"):?>
        <li class="social__item">
            <a href="<?=htmlspecialcharsbx($arItem["LINK"])?>" class="social__link"><?=htmlspecialcharsbx($arItem["TEXT"], ENT_COMPAT, false)?>
                <svg class="icon icon--social">
                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-<?=$arItem['PARAMS']['MESSENGER_ICON']?>"></use>
                </svg>
            </a>
        </li>
    <?endif?>
<?endforeach;?>

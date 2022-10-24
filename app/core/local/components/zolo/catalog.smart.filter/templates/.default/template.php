<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
$templateData = array(
	'TEMPLATE_CLASS' => 'bx-'.$arParams['TEMPLATE_THEME']
);

if (isset($templateData['TEMPLATE_THEME']))
{
	$this->addExternalCss($templateData['TEMPLATE_THEME']);
}
?>




<div class="catalog__filter">
    <div class="filter" data-filter>
        <div class="filter__wrapper" data-filter-block>
            <div class="filter__block" data-scrollbar>
                <div class="filter__head">
                    <div class="filter__close" data-filter-close>
                        <svg class="filter__close-icon icon icon--close-square">
                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-close-square"></use>
                        </svg>
                    </div>

                    <h2 class="filter__heading">Каталог товаров</h2>
                </div>
                <div class="<?=$templateData["TEMPLATE_CLASS"]?>">
                    <form name="<?= $arResult["FILTER_NAME"]."_form"?>" action="<?= $arResult["FORM_ACTION"]?>" method="get" class="form">
                        <div class="filter__row">
                            <div class="filter__accordeon accordeon accordeon--simple accordeon--small">
                                <!-- TODO: Интегрировать верстку списка разделов (аккордеон) -->
                                <?
                                /* Список разделов каталога */
                                $sectionListParams = array(
                                    "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                                    "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                                    "SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
                                    "SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
                                    "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                                    "CACHE_TIME" => $arParams["CACHE_TIME"],
                                    "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                                    "COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
                                    "TOP_DEPTH" => $arParams["SECTION_TOP_DEPTH"],
                                    "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
                                    "VIEW_MODE" => $arParams["SECTIONS_VIEW_MODE"],
                                    "SHOW_PARENT_NAME" => $arParams["SECTIONS_SHOW_PARENT_NAME"],
                                    "HIDE_SECTION_NAME" => (isset($arParams["SECTIONS_HIDE_SECTION_NAME"]) ? $arParams["SECTIONS_HIDE_SECTION_NAME"] : "N"),
                                    "ADD_SECTIONS_CHAIN" => (isset($arParams["ADD_SECTIONS_CHAIN"]) ? $arParams["ADD_SECTIONS_CHAIN"] : '')
                                );
                                $sectionListParams["COUNT_ELEMENTS_FILTER"] = "CNT_ACTIVE";
                                $sectionListParams["COUNT_ELEMENTS_FILTER"] = "CNT_AVAILABLE";
                                $APPLICATION->IncludeComponent(
                                    "zolo:catalog.section.list",
                                    "",
                                    $sectionListParams,
                                    $component,
                                    array("HIDE_ICONS" => "Y")
                                );
                                unset($sectionListParams);
                                ?>
                            </div>
                        </div>

                        <div class="filter__row">
                            <div class="filter__options">
                                <div class="switchers">
                                    <ul class="switchers__list">
                                        <li class="switchers__item">
                                            <div class="filter__swither switcher" name="switcher1">
                                                <input type="checkbox" class="switcher__input" name="switch12" id="switch12">
                                                <label for="switch12" class="filter__swither-label switcher__label">
                                                    <span class="switcher__text switcher__text--left">Хиты продаж</span>
                                                    <span class="switcher__icon"></span>
                                                </label>
                                            </div>
                                        </li>

                                        <li class="switchers__item">
                                            <div class="filter__swither switcher" name="switcher2">
                                                <input type="checkbox" class="switcher__input" name="switch1" id="switch22">
                                                <label for="switch22" class="filter__swither-label switcher__label">
                                                    <span class="switcher__text switcher__text--left">Товары со скидкой</span>
                                                    <span class="switcher__icon"></span>
                                                </label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="filter__row">
                            <div class="filter__range range" data-range>
                                <div class="range__header">
                                    <p class="range__heading heading heading--small">Цена, ₽ </p>
                                </div>
                                <div class="range-slider" data-range-slider data-min="1000" data-max="9000" data-step="1"></div>
                                <div class="range__group">
                                    <div class="range__group-field form__field">
                                        <div class="form__field-block form__field-block--input">
                                            <label class="form__field-label" for="min">
                                                от
                                            </label>
                                            <div class="input input--mini input--prefix">
                                                <input type="number" data-range-min="min" value="1000" name="min" class="range__input input__control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="range__group-field form__field">
                                        <div class="form__field-block form__field-block--input">
                                            <label class="form__field-label" for="max">
                                                до
                                            </label>
                                            <div class="input input--mini input--prefix">
                                                <input type="number" data-range-max="max" value="9000" name="max" class="range__input input__control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="filter__range range" data-range>
                                <div class="range__header">
                                    <p class="range__heading heading heading--small">Баллы, ББ</p>
                                </div>
                                <div class="range-slider" data-range-slider data-min="1000" data-max="9000" data-step="1"></div>
                                <div class="range__group">
                                    <div class="range__group-field form__field">
                                        <div class="form__field-block form__field-block--input">
                                            <label class="form__field-label" for="min">
                                                от
                                            </label>
                                            <div class="input input--mini input--prefix">
                                                <input type="number" data-range-min="min" value="1000" name="min" class="range__input input__control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="range__group-field form__field">
                                        <div class="form__field-block form__field-block--input">
                                            <label class="form__field-label" for="max">
                                                до
                                            </label>
                                            <div class="input input--mini input--prefix">
                                                <input type="number" data-range-max="max" value="9000" name="max" class="range__input input__control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="filter__row">
                            <div class="filter__header">
                                <p class="filter__heading heading heading--small">Размер питомца</p>
                            </div>

                            <div class="checkboxes">
                                <ul class="checkboxes__list">
                                    <li class="checkboxes__item">
                                        <div class="checkbox">
                                            <input type="checkbox" class="checkbox__input" name="check[]" value="s" id="checkF">

                                            <label for="checkF" class="checkbox__label">
                                                                        <span class="checkbox__icon">
                                                                            <svg class="checkbox__icon-pic icon icon--check">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check">
                                                                            </svg>
                                                                        </span>

                                                <span class="checkbox__text">Для мелких пород </span>
                                            </label>
                                        </div>
                                    </li>

                                    <li class="checkboxes__item">
                                        <div class="checkbox">
                                            <input type="checkbox" class="checkbox__input" name="check[]" value="s1" id="checkF2" checked>

                                            <label for="checkF2" class="checkbox__label">
                                                                        <span class="checkbox__icon">
                                                                            <svg class="checkbox__icon-pic icon icon--check">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check">
                                                                            </svg>
                                                                        </span>

                                                <span class="checkbox__text">Для средних пород</span>
                                            </label>
                                        </div>
                                    </li>

                                    <li class="checkboxes__item">
                                        <div class="checkbox">
                                            <input type="checkbox" class="checkbox__input" name="check[]" value="s2" id="checkF3">

                                            <label for="checkF3" class="checkbox__label">
                                                                        <span class="checkbox__icon">
                                                                            <svg class="checkbox__icon-pic icon icon--check">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check">
                                                                            </svg>
                                                                        </span>

                                                <span class="checkbox__text">Для крупных пород</span>
                                            </label>
                                        </div>
                                    </li>

                                    <li class="checkboxes__item">
                                        <div class="checkbox">
                                            <input type="checkbox" class="checkbox__input" name="check[]" value="s3" id="checkF4">

                                            <label for="checkF4" class="checkbox__label">
                                                                        <span class="checkbox__icon">
                                                                            <svg class="checkbox__icon-pic icon icon--check">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check">
                                                                            </svg>
                                                                        </span>

                                                <span class="checkbox__text">Для всех пород</span>
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="filter__row">
                            <div class="filter__header">
                                <p class="filter__heading heading heading--small">Возраст питомца</p>
                            </div>

                            <div class="filter__checkboxes checkboxes">
                                <ul class="checkboxes__list">
                                    <li class="checkboxes__item">
                                        <div class="checkbox">
                                            <input type="checkbox" class="checkbox__input" name="check[]" value="s" id="checkF5">

                                            <label for="checkF5" class="checkbox__label">
                                                                        <span class="checkbox__icon">
                                                                            <svg class="checkbox__icon-pic icon icon--check">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check">
                                                                            </svg>
                                                                        </span>

                                                <span class="checkbox__text">Для взрослых</span>
                                            </label>
                                        </div>
                                    </li>

                                    <li class="checkboxes__item">
                                        <div class="checkbox">
                                            <input type="checkbox" class="checkbox__input" name="check[]" value="s1" id="checkF6" checked>

                                            <label for="checkF6" class="checkbox__label">
                                                                        <span class="checkbox__icon">
                                                                            <svg class="checkbox__icon-pic icon icon--check">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check">
                                                                            </svg>
                                                                        </span>

                                                <span class="checkbox__text">Для щенков</span>
                                            </label>
                                        </div>
                                    </li>

                                    <li class="checkboxes__item">
                                        <div class="checkbox">
                                            <input type="checkbox" class="checkbox__input" name="check[]" value="s2" id="checkF7">

                                            <label for="checkF7" class="checkbox__label">
                                                                        <span class="checkbox__icon">
                                                                            <svg class="checkbox__icon-pic icon icon--check">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check">
                                                                            </svg>
                                                                        </span>

                                                <span class="checkbox__text">Для всех пород</span>
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="filter__row">
                            <div class="filter__header">
                                <p class="filter__heading heading heading--small">Возраст питомца</p>
                            </div>

                            <div class="filter__checkboxes checkboxes">
                                <ul class="checkboxes__list">
                                    <li class="checkboxes__item">
                                        <div class="checkbox">
                                            <input type="checkbox" class="checkbox__input" name="check[]" value="s" id="checkF8">

                                            <label for="checkF8" class="checkbox__label">
                                                                        <span class="checkbox__icon">
                                                                            <svg class="checkbox__icon-pic icon icon--check">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check">
                                                                            </svg>
                                                                        </span>

                                                <span class="checkbox__text">Для взрослых</span>
                                            </label>
                                        </div>
                                    </li>

                                    <li class="checkboxes__item">
                                        <div class="checkbox">
                                            <input type="checkbox" class="checkbox__input" name="check[]" value="s1" id="checkF9" checked>

                                            <label for="checkF9" class="checkbox__label">
                                                                        <span class="checkbox__icon">
                                                                            <svg class="checkbox__icon-pic icon icon--check">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check">
                                                                            </svg>
                                                                        </span>

                                                <span class="checkbox__text">Для щенков</span>
                                            </label>
                                        </div>
                                    </li>

                                    <li class="checkboxes__item">
                                        <div class="checkbox">
                                            <input type="checkbox" class="checkbox__input" name="check[]" value="s2" id="checkF10">

                                            <label for="checkF10" class="checkbox__label">
                                                                        <span class="checkbox__icon">
                                                                            <svg class="checkbox__icon-pic icon icon--check">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check">
                                                                            </svg>
                                                                        </span>

                                                <span class="checkbox__text">Для всех пород</span>
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="filter__row">
                            <div class="filter__header">
                                <p class="filter__heading heading heading--small">Фасовка</p>
                            </div>

                            <div class="filter__checkboxes checkboxes" data-toggle-visibility-container>
                                <ul class="checkboxes__list">
                                    <li class="checkboxes__item">
                                        <div class="checkbox">
                                            <input type="checkbox" class="checkbox__input" name="check[]" value="s" id="checkF11">

                                            <label for="checkF11" class="checkbox__label">
                                                                        <span class="checkbox__icon">
                                                                            <svg class="checkbox__icon-pic icon icon--check">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check">
                                                                            </svg>
                                                                        </span>

                                                <span class="checkbox__text">600 г</span>
                                            </label>
                                        </div>
                                    </li>

                                    <li class="checkboxes__item">
                                        <div class="checkbox">
                                            <input type="checkbox" class="checkbox__input" name="check[]" value="s1" id="checkF12" checked>

                                            <label for="checkF12" class="checkbox__label">
                                                                        <span class="checkbox__icon">
                                                                            <svg class="checkbox__icon-pic icon icon--check">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check">
                                                                            </svg>
                                                                        </span>

                                                <span class="checkbox__text">1 кг</span>
                                            </label>
                                        </div>
                                    </li>

                                    <li class="checkboxes__item">
                                        <div class="checkbox">
                                            <input type="checkbox" class="checkbox__input" name="check[]" value="s2" id="checkF13">

                                            <label for="checkF13" class="checkbox__label">
                                                                        <span class="checkbox__icon">
                                                                            <svg class="checkbox__icon-pic icon icon--check">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check">
                                                                            </svg>
                                                                        </span>

                                                <span class="checkbox__text">3 кг</span>
                                            </label>
                                        </div>
                                    </li>

                                    <li class="checkboxes__item">
                                        <div class="checkbox">
                                            <input type="checkbox" class="checkbox__input" name="check[]" value="s2" id="checkF14">

                                            <label for="checkF14" class="checkbox__label">
                                                                        <span class="checkbox__icon">
                                                                            <svg class="checkbox__icon-pic icon icon--check">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check">
                                                                            </svg>
                                                                        </span>

                                                <span class="checkbox__text">5 кг</span>
                                            </label>
                                        </div>
                                    </li>

                                    <li class="checkboxes__item">
                                        <div class="checkbox">
                                            <input type="checkbox" class="checkbox__input" name="check[]" value="s2" id="checkF15">

                                            <label for="checkF15" class="checkbox__label">
                                                                        <span class="checkbox__icon">
                                                                            <svg class="checkbox__icon-pic icon icon--check">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check">
                                                                            </svg>
                                                                        </span>

                                                <span class="checkbox__text">7 кг</span>
                                            </label>
                                        </div>
                                    </li>

                                    <li class="checkboxes__item" data-toggle-visibility-block style="display: none;">
                                        <div class="checkbox">
                                            <input type="checkbox" class="checkbox__input" name="check[]" value="s2" id="checkF16">

                                            <label for="checkF16" class="checkbox__label">
                                                                        <span class="checkbox__icon">
                                                                            <svg class="checkbox__icon-pic icon icon--check">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check">
                                                                            </svg>
                                                                        </span>

                                                <span class="checkbox__text">10 кг</span>
                                            </label>
                                        </div>
                                    </li>

                                    <li class="checkboxes__item" data-toggle-visibility-block style="display: none;">
                                        <div class="checkbox">
                                            <input type="checkbox" class="checkbox__input" name="check[]" value="s2" id="checkF17">

                                            <label for="checkF17" class="checkbox__label">
                                                                        <span class="checkbox__icon">
                                                                            <svg class="checkbox__icon-pic icon icon--check">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check">
                                                                            </svg>
                                                                        </span>

                                                <span class="checkbox__text">15 кг</span>
                                            </label>
                                        </div>
                                    </li>
                                </ul>

                                <button type="button" class="filter__button button button--simple button--gray button--small" data-toggle-visibility-action="hide">
                                                            <span class="button__icon button__icon--mini button__icon--right">
                                                                <svg class="icon icon--arrow-up">
                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-up"></use>
                                                                </svg>
                                                            </span>
                                    <span class="button__text" data-toggle-visibility-action-text="{&quot;show&quot;:&quot;Показать все&quot;, &quot;hide&quot;:&quot;Показать меньше&quot;}">Показать все</span>
                                </button>
                            </div>
                        </div>

                        <div class="filter__row">
                            <div class="filter__header">
                                <p class="filter__heading heading heading--small">Линейка товара</p>
                            </div>

                            <div class="filter__checkboxes checkboxes" data-toggle-visibility-container>
                                <ul class="checkboxes__list">
                                    <li class="checkboxes__item">
                                        <div class="checkbox">
                                            <input type="checkbox" class="checkbox__input" name="check[]" value="s" id="checkF18">

                                            <label for="checkF18" class="checkbox__label">
                                                                        <span class="checkbox__icon">
                                                                            <svg class="checkbox__icon-pic icon icon--check">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check">
                                                                            </svg>
                                                                        </span>

                                                <span class="checkbox__text">AmeAppetite® Premium</span>
                                            </label>
                                        </div>
                                    </li>

                                    <li class="checkboxes__item">
                                        <div class="checkbox">
                                            <input type="checkbox" class="checkbox__input" name="check[]" value="s1" id="checkF19" checked>

                                            <label for="checkF19" class="checkbox__label">
                                                                        <span class="checkbox__icon">
                                                                            <svg class="checkbox__icon-pic icon icon--check">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check">
                                                                            </svg>
                                                                        </span>

                                                <span class="checkbox__text">AmeAppetite® Superpremium</span>
                                            </label>
                                        </div>
                                    </li>

                                    <li class="checkboxes__item">
                                        <div class="checkbox">
                                            <input type="checkbox" class="checkbox__input" name="check[]" value="s2" id="checkF20">

                                            <label for="checkF20" class="checkbox__label">
                                                                        <span class="checkbox__icon">
                                                                            <svg class="checkbox__icon-pic icon icon--check">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check">
                                                                            </svg>
                                                                        </span>

                                                <span class="checkbox__text">AmeAppetite® Holistic</span>
                                            </label>
                                        </div>
                                    </li>
                            </div>
                        </div>

                        <div class="filter__row">
                            <div class="filter__header">
                                <p class="filter__heading heading heading--small">Вкус корма</p>
                            </div>

                            <div class="filter__checkboxes checkboxes" data-toggle-visibility-container>
                                <ul class="checkboxes__list">
                                    <li class="checkboxes__item">
                                        <div class="checkbox">
                                            <input type="checkbox" class="checkbox__input" name="check[]" value="s" id="checkF21">

                                            <label for="checkF21" class="checkbox__label">
                                                                        <span class="checkbox__icon">
                                                                            <svg class="checkbox__icon-pic icon icon--check">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check">
                                                                            </svg>
                                                                        </span>

                                                <span class="checkbox__text">Телятина</span>
                                            </label>
                                        </div>
                                    </li>

                                    <li class="checkboxes__item">
                                        <div class="checkbox">
                                            <input type="checkbox" class="checkbox__input" name="check[]" value="s1" id="checkF22" checked>

                                            <label for="checkF22" class="checkbox__label">
                                                                        <span class="checkbox__icon">
                                                                            <svg class="checkbox__icon-pic icon icon--check">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check">
                                                                            </svg>
                                                                        </span>

                                                <span class="checkbox__text">Говядина</span>
                                            </label>
                                        </div>
                                    </li>

                                    <li class="checkboxes__item">
                                        <div class="checkbox">
                                            <input type="checkbox" class="checkbox__input" name="check[]" value="s2" id="checkF23">

                                            <label for="checkF23" class="checkbox__label">
                                                                        <span class="checkbox__icon">
                                                                            <svg class="checkbox__icon-pic icon icon--check">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check">
                                                                            </svg>
                                                                        </span>

                                                <span class="checkbox__text">Цыпленок</span>
                                            </label>
                                        </div>
                                    </li>

                                    <li class="checkboxes__item">
                                        <div class="checkbox">
                                            <input type="checkbox" class="checkbox__input" name="check[]" value="s2" id="checkF24">

                                            <label for="checkF24" class="checkbox__label">
                                                                        <span class="checkbox__icon">
                                                                            <svg class="checkbox__icon-pic icon icon--check">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check">
                                                                            </svg>
                                                                        </span>

                                                <span class="checkbox__text">Индейка</span>
                                            </label>
                                        </div>
                                    </li>

                                    <li class="checkboxes__item">
                                        <div class="checkbox">
                                            <input type="checkbox" class="checkbox__input" name="check[]" value="s2" id="checkF25">

                                            <label for="checkF25" class="checkbox__label">
                                                                        <span class="checkbox__icon">
                                                                            <svg class="checkbox__icon-pic icon icon--check">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check">
                                                                            </svg>
                                                                        </span>

                                                <span class="checkbox__text">Кролик</span>
                                            </label>
                                        </div>
                                    </li>

                                    <li class="checkboxes__item" data-toggle-visibility-block style="display: none;">
                                        <div class="checkbox">
                                            <input type="checkbox" class="checkbox__input" name="check[]" value="s2" id="checkF26">

                                            <label for="checkF26" class="checkbox__label">
                                                                        <span class="checkbox__icon">
                                                                            <svg class="checkbox__icon-pic icon icon--check">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check">
                                                                            </svg>
                                                                        </span>

                                                <span class="checkbox__text">Утка</span>
                                            </label>
                                        </div>
                                    </li>

                                    <li class="checkboxes__item" data-toggle-visibility-block style="display: none;">
                                        <div class="checkbox">
                                            <input type="checkbox" class="checkbox__input" name="check[]" value="s2" id="checkF27">

                                            <label for="checkF27" class="checkbox__label">
                                                                        <span class="checkbox__icon">
                                                                            <svg class="checkbox__icon-pic icon icon--check">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check">
                                                                            </svg>
                                                                        </span>

                                                <span class="checkbox__text">Ягненок</span>
                                            </label>
                                        </div>
                                    </li>

                                    <li class="checkboxes__item" data-toggle-visibility-block style="display: none;">
                                        <div class="checkbox">
                                            <input type="checkbox" class="checkbox__input" name="check[]" value="s2" id="checkF28">

                                            <label for="checkF28" class="checkbox__label">
                                                                        <span class="checkbox__icon">
                                                                            <svg class="checkbox__icon-pic icon icon--check">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check">
                                                                            </svg>
                                                                        </span>

                                                <span class="checkbox__text">Лосось</span>
                                            </label>
                                        </div>
                                    </li>

                                    <li class="checkboxes__item" data-toggle-visibility-block style="display: none;">
                                        <div class="checkbox">
                                            <input type="checkbox" class="checkbox__input" name="check[]" value="s2" id="checkF29">

                                            <label for="checkF29" class="checkbox__label">
                                                                        <span class="checkbox__icon">
                                                                            <svg class="checkbox__icon-pic icon icon--check">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check">
                                                                            </svg>
                                                                        </span>

                                                <span class="checkbox__text">Другое</span>
                                            </label>
                                        </div>
                                    </li>
                                </ul>

                                <button type="button" class="filter__button button button--simple button--gray button--small" data-toggle-visibility-action="hide">
                                                            <span class="button__icon button__icon--mini button__icon--right">
                                                                <svg class="icon icon--arrow-up">
                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-up"></use>
                                                                </svg>
                                                            </span>
                                    <span class="button__text" data-toggle-visibility-action-text="{&quot;show&quot;:&quot;Показать все&quot;, &quot;hide&quot;:&quot;Показать меньше&quot;}">Показать все</span>
                                </button>
                            </div>
                        </div>

                        <div class="filter__row">
                            <div class="filter__header">
                                <p class="filter__heading heading heading--small">Вкус корма</p>
                            </div>

                            <div class="filter__checkboxes checkboxes" data-toggle-visibility-container>
                                <ul class="checkboxes__list">
                                    <li class="checkboxes__item">
                                        <div class="checkbox">
                                            <input type="checkbox" class="checkbox__input" name="check[]" value="s" id="checkF30">

                                            <label for="checkF30" class="checkbox__label">
                                                                        <span class="checkbox__icon">
                                                                            <svg class="checkbox__icon-pic icon icon--check">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check">
                                                                            </svg>
                                                                        </span>

                                                <span class="checkbox__text">Для привередливых</span>
                                            </label>
                                        </div>
                                    </li>

                                    <li class="checkboxes__item">
                                        <div class="checkbox">
                                            <input type="checkbox" class="checkbox__input" name="check[]" value="s1" id="checkF31" checked>

                                            <label for="checkF31" class="checkbox__label">
                                                                        <span class="checkbox__icon">
                                                                            <svg class="checkbox__icon-pic icon icon--check">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check">
                                                                            </svg>
                                                                        </span>

                                                <span class="checkbox__text">Здоровая кожа и блестящая шерсть</span>
                                            </label>
                                        </div>
                                    </li>

                                    <li class="checkboxes__item">
                                        <div class="checkbox">
                                            <input type="checkbox" class="checkbox__input" name="check[]" value="s2" id="checkF32">

                                            <label for="checkF32" class="checkbox__label">
                                                                        <span class="checkbox__icon">
                                                                            <svg class="checkbox__icon-pic icon icon--check">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check">
                                                                            </svg>
                                                                        </span>

                                                <span class="checkbox__text">Здоровое пищеварение</span>
                                            </label>
                                        </div>
                                    </li>

                                    <li class="checkboxes__item">
                                        <div class="checkbox">
                                            <input type="checkbox" class="checkbox__input" name="check[]" value="s2" id="checkF33">

                                            <label for="checkF33" class="checkbox__label">
                                                                        <span class="checkbox__icon">
                                                                            <svg class="checkbox__icon-pic icon icon--check">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check">
                                                                            </svg>
                                                                        </span>

                                                <span class="checkbox__text">Контроль веса</span>
                                            </label>
                                        </div>
                                    </li>

                                    <li class="checkboxes__item">
                                        <div class="checkbox">
                                            <input type="checkbox" class="checkbox__input" name="check[]" value="s2" id="checkF34">

                                            <label for="checkF34" class="checkbox__label">
                                                                        <span class="checkbox__icon">
                                                                            <svg class="checkbox__icon-pic icon icon--check">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check">
                                                                            </svg>
                                                                        </span>

                                                <span class="checkbox__text">Период роста</span>
                                            </label>
                                        </div>
                                    </li>

                                    <li class="checkboxes__item">
                                        <div class="checkbox">
                                            <input type="checkbox" class="checkbox__input" name="check[]" value="s2" id="checkF35">

                                            <label for="checkF35" class="checkbox__label">
                                                                        <span class="checkbox__icon">
                                                                            <svg class="checkbox__icon-pic icon icon--check">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check">
                                                                            </svg>
                                                                        </span>

                                                <span class="checkbox__text">Другое</span>
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="filter__action">
                            <button type="button" class="button button--rounded-big button--covered button--green button--full">Применить</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="filter__background" data-filter-bg></div>
        </div>
    </div>
</div>



<!-- СТАРАЯ ВЕРСТКА ФИЛЬТРА -->


<div class="smart-filter mb-4 <?=$templateData["TEMPLATE_CLASS"]?>">
	<div class="smart-filter-section">

		<div class="smart-filter-title"><?echo GetMessage("CT_BCSF_FILTER_TITLE")?></div>

		<form name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?echo $arResult["FORM_ACTION"]?>" method="get" class="smart-filter-form">

			<?foreach($arResult["HIDDEN"] as $arItem):?>
				<input type="hidden" name="<?echo $arItem["CONTROL_NAME"]?>" id="<?echo $arItem["CONTROL_ID"]?>" value="<?echo $arItem["HTML_VALUE"]?>" />
			<?endforeach;?>

			<div class="row">
				<?foreach($arResult["ITEMS"] as $key=>$arItem)//prices
				{
					$key = $arItem["ENCODED_ID"];
					if(isset($arItem["PRICE"])):
						if ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0)
							continue;

						$step_num = 4;
						$step = ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"]) / $step_num;
						$prices = array();
						if (Bitrix\Main\Loader::includeModule("currency"))
						{
							for ($i = 0; $i < $step_num; $i++)
							{
								$prices[$i] = CCurrencyLang::CurrencyFormat($arItem["VALUES"]["MIN"]["VALUE"] + $step*$i, $arItem["VALUES"]["MIN"]["CURRENCY"], false);
							}
							$prices[$step_num] = CCurrencyLang::CurrencyFormat($arItem["VALUES"]["MAX"]["VALUE"], $arItem["VALUES"]["MAX"]["CURRENCY"], false);
						}
						else
						{
							$precision = $arItem["DECIMALS"]? $arItem["DECIMALS"]: 0;
							for ($i = 0; $i < $step_num; $i++)
							{
								$prices[$i] = number_format($arItem["VALUES"]["MIN"]["VALUE"] + $step*$i, $precision, ".", "");
							}
							$prices[$step_num] = number_format($arItem["VALUES"]["MAX"]["VALUE"], $precision, ".", "");
						}
						?>

						<div class="col-12 mb-2 smart-filter-parameters-box bx-active">
							<span class="smart-filter-container-modef"></span>

							<div class="smart-filter-parameters-box-title" onclick="smartFilter.hideFilterProps(this)">
								<span class="smart-filter-parameters-box-title-text"><?=$arItem["NAME"]?></span>
								<span data-role="prop_angle" class="smart-filter-angle smart-filter-angle-up">
									<span  class="smart-filter-angles"></span>
								</span>
							</div>

							<div class="smart-filter-block" data-role="bx_filter_block">
								<div class="smart-filter-parameters-box-container">
									<div class="smart-filter-input-group-number">
										<div class="d-flex justify-content-between">
											<div class="form-group" style="width: calc(50% - 10px);">
												<div class="smart-filter-input-container">
													<input
														class="min-price form-control form-control-sm"
														type="number"
														name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
														id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
														value="<?echo $arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"
														size="5"
														placeholder="<?=GetMessage("CT_BCSF_FILTER_FROM")?>"
														onkeyup="smartFilter.keyup(this)"
													/>
												</div>
											</div>

											<div class="form-group" style="width: calc(50% - 10px);">
												<div class="smart-filter-input-container">
													<input
														class="max-price form-control form-control-sm"
														type="number"
														name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
														id="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
														value="<?echo $arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"
														size="5"
														placeholder="<?=GetMessage("CT_BCSF_FILTER_TO")?>"
														onkeyup="smartFilter.keyup(this)"
													/>
												</div>
											</div>
										</div>

										<div class="smart-filter-slider-track-container">
											<div class="smart-filter-slider-track" id="drag_track_<?=$key?>">
												<?for($i = 0; $i <= $step_num; $i++):?>
												<div class="smart-filter-slider-ruler p<?=$i+1?>"><span><?=$prices[$i]?></span></div>
												<?endfor;?>
												<div class="smart-filter-slider-price-bar-vd" style="left: 0;right: 0;" id="colorUnavailableActive_<?=$key?>"></div>
												<div class="smart-filter-slider-price-bar-vn" style="left: 0;right: 0;" id="colorAvailableInactive_<?=$key?>"></div>
												<div class="smart-filter-slider-price-bar-v"  style="left: 0;right: 0;" id="colorAvailableActive_<?=$key?>"></div>
												<div class="smart-filter-slider-range" id="drag_tracker_<?=$key?>"  style="left: 0; right: 0;">
													<a class="smart-filter-slider-handle left"  style="left:0;" href="javascript:void(0)" id="left_slider_<?=$key?>"></a>
													<a class="smart-filter-slider-handle right" style="right:0;" href="javascript:void(0)" id="right_slider_<?=$key?>"></a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?

						$arJsParams = array(
							"leftSlider" => 'left_slider_'.$key,
							"rightSlider" => 'right_slider_'.$key,
							"tracker" => "drag_tracker_".$key,
							"trackerWrap" => "drag_track_".$key,
							"minInputId" => $arItem["VALUES"]["MIN"]["CONTROL_ID"],
							"maxInputId" => $arItem["VALUES"]["MAX"]["CONTROL_ID"],
							"minPrice" => $arItem["VALUES"]["MIN"]["VALUE"],
							"maxPrice" => $arItem["VALUES"]["MAX"]["VALUE"],
							"curMinPrice" => $arItem["VALUES"]["MIN"]["HTML_VALUE"],
							"curMaxPrice" => $arItem["VALUES"]["MAX"]["HTML_VALUE"],
							"fltMinPrice" => intval($arItem["VALUES"]["MIN"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MIN"]["FILTERED_VALUE"] : $arItem["VALUES"]["MIN"]["VALUE"] ,
							"fltMaxPrice" => intval($arItem["VALUES"]["MAX"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MAX"]["FILTERED_VALUE"] : $arItem["VALUES"]["MAX"]["VALUE"],
							"precision" => $precision,
							"colorUnavailableActive" => 'colorUnavailableActive_'.$key,
							"colorAvailableActive" => 'colorAvailableActive_'.$key,
							"colorAvailableInactive" => 'colorAvailableInactive_'.$key,
						);
						?>
						<script type="text/javascript">
							BX.ready(function(){
								window['trackBar<?=$key?>'] = new BX.Iblock.SmartFilter(<?=CUtil::PhpToJSObject($arJsParams)?>);
							});
						</script>
					<?endif;
				}

				//not prices
				foreach($arResult["ITEMS"] as $key=>$arItem)
				{
					if (empty($arItem["VALUES"]) || isset($arItem["PRICE"]))
						continue;

					if ($arItem["DISPLAY_TYPE"] == "A" && ( $arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0))
						continue;
					?>

					<div class="col-lg-12 mb-2 smart-filter-parameters-box <?if ($arItem["DISPLAY_EXPANDED"]== "Y"):?>bx-active<?endif?>">
						<span class="smart-filter-container-modef"></span>

						<div class="smart-filter-parameters-box-title" onclick="smartFilter.hideFilterProps(this)">

							<span class="smart-filter-parameters-box-title-text"><?=$arItem["NAME"]?></span>

							<span data-role="prop_angle" class="smart-filter-angle smart-filter-angle-<?if ($arItem["DISPLAY_EXPANDED"]== "Y"):?>up<?else:?>down<?endif?>">
								<span  class="smart-filter-angles"></span>
							</span>

							<?if ($arItem["FILTER_HINT"] <> ""):?>
								<span class="smart-filter-hint">
									<span class="smart-filter-hint-icon">?</span>
									<span class="smart-filter-hint-popup">
										<span class="smart-filter-hint-popup-angle"></span>
										<span class="smart-filter-hint-popup-content">

										</span>	<?=$arItem["FILTER_HINT"]?></span>
								</span>
							<?endif?>
						</div>

						<div class="smart-filter-block" data-role="bx_filter_block">
							<div class="smart-filter-parameters-box-container">
							<?
							$arCur = current($arItem["VALUES"]);
							switch ($arItem["DISPLAY_TYPE"])
							{
								//region NUMBERS_WITH_SLIDER +
								case "A":
								?>
									<div class="smart-filter-input-group-number">
										<div class="d-flex justify-content-between">

											<div class="form-group" style="width: calc(50% - 10px);">
												<div class="smart-filter-input-container">
													<input class="min-price form-control form-control-sm"
														type="number"
														name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
														id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
														value="<?echo $arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"
														size="5"
														placeholder="<?=GetMessage("CT_BCSF_FILTER_FROM")?>"
														onkeyup="smartFilter.keyup(this)"
													/>
												</div>
											</div>

											<div class="form-group" style="width: calc(50% - 10px);">
												<div class="smart-filter-input-container">
													<input
														class="max-price form-control form-control-sm"
														type="number"
														name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
														id="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
														value="<?echo $arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"
														size="5"
														placeholder="<?=GetMessage("CT_BCSF_FILTER_TO")?>"
														onkeyup="smartFilter.keyup(this)"
													/>
												</div>
											</div>

										</div>

										<div class="smart-filter-slider-track-container">
											<div class="smart-filter-slider-track" id="drag_track_<?=$key?>">
												<?
													$precision = $arItem["DECIMALS"]? $arItem["DECIMALS"]: 0;
													$step = ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"]) / 4;
													$value1 = number_format($arItem["VALUES"]["MIN"]["VALUE"], $precision, ".", "");
													$value2 = number_format($arItem["VALUES"]["MIN"]["VALUE"] + $step, $precision, ".", "");
													$value3 = number_format($arItem["VALUES"]["MIN"]["VALUE"] + $step * 2, $precision, ".", "");
													$value4 = number_format($arItem["VALUES"]["MIN"]["VALUE"] + $step * 3, $precision, ".", "");
													$value5 = number_format($arItem["VALUES"]["MAX"]["VALUE"], $precision, ".", "");
												?>
												<div class="smart-filter-slider-ruler p1"><span><?=$value1?></span></div>
												<div class="smart-filter-slider-ruler p2"><span><?=$value2?></span></div>
												<div class="smart-filter-slider-ruler p3"><span><?=$value3?></span></div>
												<div class="smart-filter-slider-ruler p4"><span><?=$value4?></span></div>
												<div class="smart-filter-slider-ruler p5"><span><?=$value5?></span></div>

												<div class="smart-filter-slider-price-bar-vd" style="left: 0;right: 0;" id="colorUnavailableActive_<?=$key?>"></div>
												<div class="smart-filter-slider-price-bar-vn" style="left: 0;right: 0;" id="colorAvailableInactive_<?=$key?>"></div>
												<div class="smart-filter-slider-price-bar-v"  style="left: 0;right: 0;" id="colorAvailableActive_<?=$key?>"></div>
												<div class="smart-filter-slider-range" 	id="drag_tracker_<?=$key?>"  style="left: 0;right: 0;">
													<a class="smart-filter-slider-handle left"  style="left:0;" href="javascript:void(0)" id="left_slider_<?=$key?>"></a>
													<a class="smart-filter-slider-handle right" style="right:0;" href="javascript:void(0)" id="right_slider_<?=$key?>"></a>
												</div>
											</div>
										</div>
									</div>

									<?
										$arJsParams = array(
										"leftSlider" => 'left_slider_'.$key,
										"rightSlider" => 'right_slider_'.$key,
										"tracker" => "drag_tracker_".$key,
										"trackerWrap" => "drag_track_".$key,
										"minInputId" => $arItem["VALUES"]["MIN"]["CONTROL_ID"],
										"maxInputId" => $arItem["VALUES"]["MAX"]["CONTROL_ID"],
										"minPrice" => $arItem["VALUES"]["MIN"]["VALUE"],
										"maxPrice" => $arItem["VALUES"]["MAX"]["VALUE"],
										"curMinPrice" => $arItem["VALUES"]["MIN"]["HTML_VALUE"],
										"curMaxPrice" => $arItem["VALUES"]["MAX"]["HTML_VALUE"],
										"fltMinPrice" => intval($arItem["VALUES"]["MIN"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MIN"]["FILTERED_VALUE"] : $arItem["VALUES"]["MIN"]["VALUE"] ,
										"fltMaxPrice" => intval($arItem["VALUES"]["MAX"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MAX"]["FILTERED_VALUE"] : $arItem["VALUES"]["MAX"]["VALUE"],
										"precision" => $arItem["DECIMALS"]? $arItem["DECIMALS"]: 0,
										"colorUnavailableActive" => 'colorUnavailableActive_'.$key,
										"colorAvailableActive" => 'colorAvailableActive_'.$key,
										"colorAvailableInactive" => 'colorAvailableInactive_'.$key,
									);
									?>
										<script type="text/javascript">
											BX.ready(function(){
												window['trackBar<?=$key?>'] = new BX.Iblock.SmartFilter(<?=CUtil::PhpToJSObject($arJsParams)?>);
											});
										</script>
									<?

								break;

								//endregion

								//region NUMBERS +
								case "B":
								?>
									<div class="smart-filter-input-group-number">
										<div class="d-flex justify-content-between">
											<div class="form-group" style="width: calc(50% - 10px);">
												<div class="smart-filter-input-container">
													<input
														class="min-price form-control form-control-sm"
														type="number"
														name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
														id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
														value="<?echo $arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"
														size="5"
														placeholder="<?=GetMessage("CT_BCSF_FILTER_FROM")?>"
														onkeyup="smartFilter.keyup(this)"
														/>
												</div>
											</div>

											<div class="form-group" style="width: calc(50% - 10px);">
											<div class="smart-filter-input-container">
												<input
													class="max-price form-control form-control-sm"
													type="number"
													name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
													id="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
													value="<?echo $arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"
													size="5"
													placeholder="<?=GetMessage("CT_BCSF_FILTER_TO")?>"
													onkeyup="smartFilter.keyup(this)"
													/>
											</div>
										</div>
										</div>
									</div>
								<?
								break;
								//endregion

								//region CHECKBOXES_WITH_PICTURES +
								case "G":
								?>
									<div class="smart-filter-input-group-checkbox-pictures">
										<?foreach ($arItem["VALUES"] as $val => $ar):?>
											<input
												style="display: none"
												type="checkbox"
												name="<?=$ar["CONTROL_NAME"]?>"
												id="<?=$ar["CONTROL_ID"]?>"
												value="<?=$ar["HTML_VALUE"]?>"
												<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
											/>
											<?
												$class = "";
												if ($ar["CHECKED"])
													$class.= " bx-active";
												if ($ar["DISABLED"])
													$class.= " disabled";
											?>
											<label for="<?=$ar["CONTROL_ID"]?>"
												   data-role="label_<?=$ar["CONTROL_ID"]?>"
												   class="smart-filter-checkbox-label<?=$class?>"
												   onclick="smartFilter.keyup(BX('<?=CUtil::JSEscape($ar["CONTROL_ID"])?>')); BX.toggleClass(this, 'bx-active');">
												<span class="smart-filter-checkbox-btn bx-color-sl">
													<?if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
														<span class="smart-filter-checkbox-btn-image" style="background-image: url('<?=$ar["FILE"]["SRC"]?>');"></span>
													<?endif?>
												</span>
											</label>
										<?endforeach?>
										<div style="clear: both;"></div>
									</div>
								<?
								break;
								//endregion

								//region CHECKBOXES_WITH_PICTURES_AND_LABELS +
								case "H":
								?>
									<div class="smart-filter-input-group-checkbox-pictures-text">
										<?foreach ($arItem["VALUES"] as $val => $ar):?>
										<input
											style="display: none"
											type="checkbox"
											name="<?=$ar["CONTROL_NAME"]?>"
											id="<?=$ar["CONTROL_ID"]?>"
											value="<?=$ar["HTML_VALUE"]?>"
											<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
										/>
										<?
											$class = "";
											if ($ar["CHECKED"])
												$class.= " bx-active";
											if ($ar["DISABLED"])
												$class.= " disabled";
										?>
										<label for="<?=$ar["CONTROL_ID"]?>"
											   data-role="label_<?=$ar["CONTROL_ID"]?>"
											   class="smart-filter-checkbox-label<?=$class?>"
											   onclick="smartFilter.keyup(BX('<?=CUtil::JSEscape($ar["CONTROL_ID"])?>')); BX.toggleClass(this, 'bx-active');">
											<span class="smart-filter-checkbox-btn">
												<?if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
													<span class="smart-filter-checkbox-btn-image" style="background-image:url('<?=$ar["FILE"]["SRC"]?>');"></span>
												<?endif?>
											</span>
											<span class="smart-filter-checkbox-text" title="<?=$ar["VALUE"];?>">
												<?=$ar["VALUE"];
												if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])):
													?> (<span data-role="count_<?=$ar["CONTROL_ID"]?>"><? echo $ar["ELEMENT_COUNT"]; ?></span>)<?
												endif;?>
											</span>
										</label>
									<?endforeach?>
									</div>
								<?
								break;
								//endregion

								//region DROPDOWN +
								case "P":
								?>
									<? $checkedItemExist = false; ?>
									<div class="smart-filter-input-group-dropdown">
										<div class="smart-filter-dropdown-block" onclick="smartFilter.showDropDownPopup(this, '<?=CUtil::JSEscape($key)?>')">
											<div class="smart-filter-dropdown-text" data-role="currentOption">
												<?foreach ($arItem["VALUES"] as $val => $ar)
												{
													if ($ar["CHECKED"])
													{
														echo $ar["VALUE"];
														$checkedItemExist = true;
													}
												}
												if (!$checkedItemExist)
												{
													echo GetMessage("CT_BCSF_FILTER_ALL");
												}
												?>
											</div>
											<div class="smart-filter-dropdown-arrow"></div>
											<input
												style="display: none"
												type="radio"
												name="<?=$arCur["CONTROL_NAME_ALT"]?>"
												id="<? echo "all_".$arCur["CONTROL_ID"] ?>"
												value=""
											/>
											<?foreach ($arItem["VALUES"] as $val => $ar):?>
												<input
													style="display: none"
													type="radio"
													name="<?=$ar["CONTROL_NAME_ALT"]?>"
													id="<?=$ar["CONTROL_ID"]?>"
													value="<? echo $ar["HTML_VALUE_ALT"] ?>"
													<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
												/>
											<?endforeach?>

											<div class="smart-filter-dropdown-popup" data-role="dropdownContent" style="display: none;">
												<ul>
													<li>
														<label for="<?="all_".$arCur["CONTROL_ID"]?>"
															   class="smart-filter-dropdown-label"
															   data-role="label_<?="all_".$arCur["CONTROL_ID"]?>"
															   onclick="smartFilter.selectDropDownItem(this, '<?=CUtil::JSEscape("all_".$arCur["CONTROL_ID"])?>')">
															<?=GetMessage("CT_BCSF_FILTER_ALL"); ?>
														</label>
													</li>
													<?foreach ($arItem["VALUES"] as $val => $ar):
														$class = "";
														if ($ar["CHECKED"])
															$class.= " selected";
														if ($ar["DISABLED"])
															$class.= " disabled";
													?>
														<li>
															<label for="<?=$ar["CONTROL_ID"]?>"
																   class="smart-filter-dropdown-label<?=$class?>"
																   data-role="label_<?=$ar["CONTROL_ID"]?>"
																   onclick="smartFilter.selectDropDownItem(this, '<?=CUtil::JSEscape($ar["CONTROL_ID"])?>')">
																<?=$ar["VALUE"]?>
															</label>
														</li>
													<?endforeach?>
												</ul>
											</div>
										</div>
									</div>
								<?
								break;
								//endregion

								//region DROPDOWN_WITH_PICTURES_AND_LABELS
								case "R":
									?>
										<div class="smart-filter-input-group-dropdown">
											<div class="smart-filter-dropdown-block" onclick="smartFilter.showDropDownPopup(this, '<?=CUtil::JSEscape($key)?>')">
												<div class="smart-filter-input-group-dropdown-flex" data-role="currentOption">
													<?
													$checkedItemExist = false;
													foreach ($arItem["VALUES"] as $val => $ar):
														if ($ar["CHECKED"])
														{
														?>
															<?if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
																<span class="smart-filter-checkbox-btn-image" style="background-image:url('<?=$ar["FILE"]["SRC"]?>');"></span>
															<?endif?>
															<span class="smart-filter-dropdown-text"><?=$ar["VALUE"]?></span>
														<?
															$checkedItemExist = true;
														}
													endforeach;
													if (!$checkedItemExist)
													{
														?>
															<span class="smart-filter-checkbox-btn-image all"></span>
															<span class="smart-filter-dropdown-text"><?=GetMessage("CT_BCSF_FILTER_ALL");?></span>
														<?
													}
													?>
												</div>

												<div class="smart-filter-dropdown-arrow"></div>

												<input
													style="display: none"
													type="radio"
													name="<?=$arCur["CONTROL_NAME_ALT"]?>"
													id="<? echo "all_".$arCur["CONTROL_ID"] ?>"
													value=""
												/>
												<?foreach ($arItem["VALUES"] as $val => $ar):?>
													<input
														style="display: none"
														type="radio"
														name="<?=$ar["CONTROL_NAME_ALT"]?>"
														id="<?=$ar["CONTROL_ID"]?>"
														value="<?=$ar["HTML_VALUE_ALT"]?>"
														<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
													/>
												<?endforeach?>

												<div class="smart-filter-dropdown-popup" data-role="dropdownContent" style="display: none">
													<ul>
														<li style="border-bottom: 1px solid #e5e5e5;padding-bottom: 5px;margin-bottom: 5px;">
															<label for="<?="all_".$arCur["CONTROL_ID"]?>"
																   class="smart-filter-param-label"
																   data-role="label_<?="all_".$arCur["CONTROL_ID"]?>"
																   onclick="smartFilter.selectDropDownItem(this, '<?=CUtil::JSEscape("all_".$arCur["CONTROL_ID"])?>')">
																<span class="smart-filter-checkbox-btn-image all"></span>
																<span class="smart-filter-dropdown-text"><?=GetMessage("CT_BCSF_FILTER_ALL"); ?></span>
															</label>
														</li>
													<?
													foreach ($arItem["VALUES"] as $val => $ar):
														$class = "";
														if ($ar["CHECKED"])
															$class.= " selected";
														if ($ar["DISABLED"])
															$class.= " disabled";
													?>
														<li>
															<label for="<?=$ar["CONTROL_ID"]?>"
																   data-role="label_<?=$ar["CONTROL_ID"]?>"
																   class="smart-filter-param-label<?=$class?>"
																   onclick="smartFilter.selectDropDownItem(this, '<?=CUtil::JSEscape($ar["CONTROL_ID"])?>')">
																<?if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
																	<span class="smart-filter-checkbox-btn-image" style="background-image:url('<?=$ar["FILE"]["SRC"]?>');"></span>
																<?endif?>
																<span class="smart-filter-dropdown-text"><?=$ar["VALUE"]?></span>
															</label>
														</li>
													<?endforeach?>
													</ul>
												</div>
											</div>
										</div>
									<?
									break;
								//endregion

								//region RADIO_BUTTONS
								case "K":
									?>
									<div class="col">
										<div class="radio">
											<label class="smart-filter-param-label" for="<? echo "all_".$arCur["CONTROL_ID"] ?>">
												<span class="smart-filter-input-checkbox">
													<input
														type="radio"
														value=""
														name="<? echo $arCur["CONTROL_NAME_ALT"] ?>"
														id="<? echo "all_".$arCur["CONTROL_ID"] ?>"
														onclick="smartFilter.click(this)"
													/>
													<span class="smart-filter-param-text"><? echo GetMessage("CT_BCSF_FILTER_ALL"); ?></span>
												</span>
											</label>
										</div>
										<?foreach($arItem["VALUES"] as $val => $ar):?>
											<div class="radio">
												<label data-role="label_<?=$ar["CONTROL_ID"]?>" class="smart-filter-param-label" for="<? echo $ar["CONTROL_ID"] ?>">
													<span class="smart-filter-input-checkbox <? echo $ar["DISABLED"] ? 'disabled': '' ?>">
														<input
															type="radio"
															value="<? echo $ar["HTML_VALUE_ALT"] ?>"
															name="<? echo $ar["CONTROL_NAME_ALT"] ?>"
															id="<? echo $ar["CONTROL_ID"] ?>"
															<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
															onclick="smartFilter.click(this)"
														/>
														<span class="smart-filter-param-text" title="<?=$ar["VALUE"];?>"><?=$ar["VALUE"];?><?
														if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])):
															?>&nbsp;(<span data-role="count_<?=$ar["CONTROL_ID"]?>"><? echo $ar["ELEMENT_COUNT"]; ?></span>)<?
														endif;?></span>
													</span>
												</label>
											</div>
										<?endforeach;?>
									</div>
									<div class="w-100"></div>
									<?
									break;

								//endregion

								//region CHECKBOXES +
								default:
									?>
								<div class="smart-filter-input-group-checkbox-list">
										<?foreach($arItem["VALUES"] as $val => $ar):?>
											<div class="form-group form-check mb-1">
												<input
													type="checkbox"
													value="<? echo $ar["HTML_VALUE"] ?>"
													name="<? echo $ar["CONTROL_NAME"] ?>"
													id="<? echo $ar["CONTROL_ID"] ?>"
													class="form-check-input"
													<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
													<? echo $ar["DISABLED"] ? 'disabled': '' ?>
													onclick="smartFilter.click(this)"
												/>
												<label data-role="label_<?=$ar["CONTROL_ID"]?>" class="smart-filter-checkbox-text form-check-label" for="<? echo $ar["CONTROL_ID"] ?>">
													<?=$ar["VALUE"];
													if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])):
														?>&nbsp;(<span data-role="count_<?=$ar["CONTROL_ID"]?>"><? echo $ar["ELEMENT_COUNT"]; ?></span>)<?
													endif;?>
												</label>
											</div>
										<?endforeach;?>
								</div>
							<?
								//endregion
							}
							?>
							</div>
						</div>
					</div>
				<?
				}
				?>
			</div><!--//row-->

			<div class="row">
				<div class="col smart-filter-button-box">
					<div class="smart-filter-block">
						<div class="smart-filter-parameters-box-container">
							<input
								class="btn btn-primary"
								type="submit"
								id="set_filter"
								name="set_filter"
								value="<?=GetMessage("CT_BCSF_SET_FILTER")?>"
							/>
							<input
								class="btn btn-link"
								type="submit"
								id="del_filter"
								name="del_filter"
								value="<?=GetMessage("CT_BCSF_DEL_FILTER")?>"
							/>
							<div class="smart-filter-popup-result <?= $arParams["POPUP_POSITION"]?>" id="modef" <?if(!isset($arResult["ELEMENT_COUNT"])) echo 'style="display:none"';?> style="display: inline-block;">
								<?echo GetMessage("CT_BCSF_FILTER_COUNT", array("#ELEMENT_COUNT#" => '<span id="modef_num">'.intval($arResult["ELEMENT_COUNT"]).'</span>'));?>
								<span class="arrow"></span>
								<br/>
								<a href="<?echo $arResult["FILTER_URL"]?>" target=""><?echo GetMessage("CT_BCSF_FILTER_SHOW")?></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>

	</div>
</div>

<script type="text/javascript">
	var smartFilter = new JCSmartFilter('<?echo CUtil::JSEscape($arResult["FORM_ACTION"])?>', '<?=CUtil::JSEscape($arParams["FILTER_VIEW_MODE"])?>', <?=CUtil::PhpToJSObject($arResult["JS_FILTER_PARAMS"])?>);
</script>
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
                <form name="<?= $arResult["FILTER_NAME"]."_form"?>" action="<?= $arResult["FORM_ACTION"]?>" method="get" class="form">

                    <div class="filter__row">
                        <?
                        /* Список разделов каталога */
                        $sectionListParams = array(
                            "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                            "SECTION_ID" => $arParams["SECTION_ID"],
                            "SECTION_CODE" => $arParams["SECTION_CODE"],
                            "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                            "CACHE_TIME" => $arParams["CACHE_TIME"],
                            "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                            "COUNT_ELEMENTS" => $arParams["COUNT_ELEMENTS"],
                            "TOP_DEPTH" => $arParams["TOP_DEPTH"],
                            "SECTION_URL" => $arParams["SECTION_URL"],
                            "VIEW_MODE" => $arParams["VIEW_MODE"],
                            "SHOW_PARENT_NAME" => $arParams["SHOW_PARENT_NAME"],
                            "HIDE_SECTION_NAME" => $arParams["HIDE_SECTION_NAME"],
                            "ADD_SECTIONS_CHAIN" => "N", // Отключено, т. к. уже добавляется
                        );
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

                    <?php foreach($arResult["HIDDEN"] as $arItem):?>
                        <input class="filter__row"
                               type="hidden"
                               name="<?= $arItem["CONTROL_NAME"]?>"
                               id="<?= $arItem["CONTROL_ID"]?>"
                               value="<?= $arItem["HTML_VALUE"]?>" />
                    <?php endforeach;?>

                    <?php foreach($arResult["ITEMS"] as $key=>$arItem):

                        if (empty($arItem["VALUES"]))
                            continue;

                        if ($arItem["DISPLAY_TYPE"] == "A" && ( $arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0))
                            continue;

                        if (isset($arItem['PRICE'])) {
                            $key = $arItem["ENCODED_ID"];
                            $arItem["DISPLAY_TYPE"] = 'A';
                        }
                        ?>

                    <div class="filter__row">
                        <?php
                        switch ($arItem["DISPLAY_TYPE"])
                        {

                            case "A":
                                // Показываем ползунок и поля ввода "От" и "До"
                                ?>

                                <div class="filter__range range" data-range>
                                    <div class="range__header">
                                        <p class="range__heading heading heading--small"><?=$arItem["NAME"]?></p>
                                    </div>
                                    <div class="range-slider"
                                         data-range-slider
                                         data-min="<?= floor($arItem["VALUES"]["MIN"]["VALUE"])?>"
                                         data-max="<?= ceil($arItem["VALUES"]["MAX"]["VALUE"])?>"
                                         data-step="1"
                                    ></div>
                                    <div class="range__group">
                                        <div class="range__group-field form__field">
                                            <div class="form__field-block form__field-block--input">
                                                <label class="form__field-label" for="min">
                                                    от
                                                </label>
                                                <div class="input input--mini input--prefix">
                                                    <input type="number"
                                                           data-range-min="min"
                                                           value="<?= floor($arItem["VALUES"]["MIN"]["HTML_VALUE"] ?? $arItem["VALUES"]["MIN"]["VALUE"])?>"
                                                           id="<?= $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
                                                           name="<?= $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
                                                           class="range__input input__control"
                                                    >
                                                </div>
                                            </div>
                                        </div>

                                        <div class="range__group-field form__field">
                                            <div class="form__field-block form__field-block--input">
                                                <label class="form__field-label" for="max">
                                                    до
                                                </label>
                                                <div class="input input--mini input--prefix">
                                                    <input type="number"
                                                           data-range-max="max"
                                                           value="<?= ceil($arItem["VALUES"]["MAX"]["HTML_VALUE"] ?? $arItem["VALUES"]["MAX"]["VALUE"])?>"
                                                           id="<?= $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
                                                           name="<?= $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
                                                           class="range__input input__control"
                                                    >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php
                                break;
                            case "F":
                            default:
                                if ($arItem["CODE"] == "IS_BESTSELLER" || $arItem["CODE"] == "WITH_DISCOUNT"): // Показываем переключатель
                                ?>

                                    <div class="filter__options">
                                        <div class="switchers">
                                            <ul class="switchers__list">
                                                <?php foreach($arItem["VALUES"] as $val => $ar):?>
                                                <li class="switchers__item">
                                                    <div class="filter__swither switcher" name="switcher1">
                                                        <input type="checkbox"
                                                               class="switcher__input"
                                                               id="<?= $ar["CONTROL_ID"] ?>"
                                                               value="<?= $ar["HTML_VALUE"] ?>"
                                                               name="<?= $ar["CONTROL_NAME"] ?>"
                                                               <? echo $ar["CHECKED"] ? 'checked="checked"': '' ?>
                                                        >
                                                        <label for="<?= $ar["CONTROL_ID"] ?>" class="filter__swither-label switcher__label" data-role="label_<?=$ar["CONTROL_ID"]?>">
                                                            <span class="switcher__text switcher__text--left"><?= $arItem["NAME"] ?></span>
                                                            <span class="switcher__icon"></span>
                                                        </label>
                                                    </div>
                                                </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    </div>
                                <?php elseif (count($arItem["VALUES"]) >= 1): // Показываем список чекбоксов, если вариантов значений несколько ?>

                                    <div class="filter__header">
                                        <p class="filter__heading heading heading--small"><?= $arItem["NAME"] ?></p>
                                    </div>

                                    <div class="filter__checkboxes checkboxes" data-toggle-visibility-container>
                                        <ul class="checkboxes__list">
                                            <?php
                                            $count = 0; // Счетчик отрисованных чекбоксов
                                            $showed = 5; // Количество чекбоксов, отображаемых в свернутом режиме списка
                                            foreach($arItem["VALUES"] as $val => $ar):
                                                $count += 1;
                                            ?>

                                                <li class="checkboxes__item"
                                                    <?= $count > $showed ? 'data-toggle-visibility-block' : ''?>
                                                    style="<?= $count > $showed ? 'display: none;' : ''?>">
                                                    <div class="checkbox">
                                                        <input type="checkbox"
                                                               class="checkbox__input"
                                                               value="<?= $ar["HTML_VALUE"] ?>"
                                                               name="<?= $ar["CONTROL_NAME"] ?>"
                                                               id="<?= $ar["CONTROL_ID"] ?>"
                                                               <?= $ar["CHECKED"] ? 'checked="checked"': '' ?>
                                                        >

                                                        <label data-role="label_<?= $ar["CONTROL_ID"] ?>"
                                                               for="<?= $ar["CONTROL_ID"] ?>"
                                                               class="checkbox__label"
                                                        >
                                                            <span class="checkbox__icon">
                                                                <svg class="checkbox__icon-pic icon icon--check">
                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check">
                                                                </svg>
                                                            </span>
                                                            <span class="checkbox__text"><?= $ar["VALUE"] ?></span>
                                                        </label>
                                                    </div>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>

                                        <?php if(count($arItem["VALUES"]) > $showed) : ?>
                                            <button type="button" class="filter__button button button--simple button--gray button--small" data-toggle-visibility-action="hide">
                                                <span class="button__icon button__icon--mini button__icon--right">
                                                    <svg class="icon icon--arrow-down">
                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-down"></use>
                                                    </svg>
                                                </span>
                                                <span class="button__text" data-toggle-visibility-action-text="{&quot;show&quot;:&quot;Показать все&quot;, &quot;hide&quot;:&quot;Показать меньше&quot;}">Показать все</span>
                                            </button>
                                        <?php endif; ?>
                                    </div>

                                <?php
                                endif;
                                break;
                        }
                        ?>
                    </div>

                    <?php endforeach;?>

                    <div class="filter__action">
                        <input class="button button--rounded-big button--covered button--green button--full"
                               type="submit"
                               id="set_filter"
                               name="set_filter"
                               value="Применить"
                        />
                    </div>
                </form>
            </div>
            <div class="filter__background" data-filter-bg></div>
        </div>
    </div>
</div>
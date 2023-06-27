<?php
if (!defined('B_PROLOG_INCLUDED') || !B_PROLOG_INCLUDED) {
    die();
}
/**
 * @var array $arResult
 * @var array $arParams
 * @var array $templateData
 */

global $APPLICATION, $USER;

$navChain = CIBlockSection::GetNavChain($arResult['IBLOCK_ID'], $arResult['SECTION_ID']);
while ($navChainItem = $navChain->GetNext()) {
    $APPLICATION->AddChainItem($navChainItem['NAME'], $navChainItem['SECTION_PAGE_URL']);
}
if ($arParams['SET_TITLE']) {
    $APPLICATION->SetTitle($arResult['TITLE']);
    $APPLICATION->AddChainItem($arResult['TITLE']);
}

if ($arParams['SET_META_KEYWORDS'] === 'Y') {
    $APPLICATION->SetPageProperty('keywords', $arResult['META_KEYWORDS']);
}

if ($arParams['SET_META_DESCRIPTION'] === 'Y') {
    $APPLICATION->SetPageProperty('description', $arResult['META_DESCRIPTION']);
}

$offerId = $arResult['OFFER_FIRST'];
?>
<div id="detailofferStore"
    prop-offers='<?= phpToVueObject($arResult) ?>'
    prop-current-offer-id='<?= $offerId ?>'
></div>
<!-- Каталог товаров -->
<h1 class="specification__title specification__title--mobile"><?= $arResult['TITLE']?></h1><!-- Название -->
<div id="offerArticle" prop-is-mobile="true">
    <p class="specification__article specification__article--mobile specification__article--hidden">Арт. <?=$arResult['ARTICLES'][$offerId]?></p>
</div>
<div class="detail__content content__main content__main--separated">
    <div class="detail__card">
        <!--  Слайдер  в картинками ТП -->
        <div id="imageSlider" prop-is-authorized="<?= json_encode($USER->isAuthorized()) ?>" prop-no-image-placeholder="<?=NO_IMAGE_PLACEHOLDER_PATH?>">
        <div class="detail__card-slider slider slider--product" data-carousel="product">
            <div class="swiper-container" data-carousel-container>
                <div class="swiper-wrapper" data-card-favourite-block>
                    <?  $offerImgs = $arResult['PHOTOS'][$offerId];
                    if (!empty($offerImgs)) : ?>
                        <? foreach ($offerImgs as $image) : ?>
                        <div class="swiper-slide slider__slide">
                            <article class="product-card product-card--detail product-card--slide box box--circle box--hovering box--border">
                                <div class="product-card__header">
                                    <? if ($arResult['DISCOUNT_LABELS'][$offerId]['NAME']) : ?>
                                    <div class="product-card__label label label--<?= $arResult['DISCOUNT_LABELS'][$offerId]['COLOR']?>"><?= strtolower($arResult['DISCOUNT_LABELS'][$offerId]['NAME'])?></div>
                                    <? endif; ?>
                                    <div class="product-card__favourite">
                                        <button type="button" class="product-card__favourite-button button button--ordinary button--iconed button--simple button--big button--red" data-card-favourite="heart">
                                            <span class="button__icon button__icon--big">
                                                <svg class="icon icon--heart">
                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-heart" data-card-favourite-icon></use>
                                                </svg>
                                            </span>
                                        </button>
                                    </div>

                                    <a href="<?= $image['src'] ?>" data-fancybox="gallery">
                                        <div class="product-card__wrapper">
                                            <div class="product-card__image box box--circle">
                                                <div class="product-card__box">
                                                    <img src="<?= $image['src'] ?>" alt="<?= $arResult['NAME'] ?>" class="product-card__pic">
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </article>
                        </div>
                        <? endforeach; ?>
                    <? else : ?>
                    <div class="swiper-slide slider__slide">
                        <article class="product-card product-card--detail product-card--slide box box--circle box--hovering box--border">
                            <div class="product-card__header">
                                <? if ($arResult['DISCOUNT_LABELS'][$offerId]['NAME']) : ?>
                                    <div class="product-card__label label label--<?= $arResult['DISCOUNT_LABELS'][$offerId]['COLOR']?>"><?= strtolower($arResult['DISCOUNT_LABELS'][$offerId]['NAME'])?></div>
                                <? endif; ?>

                                <div class="product-card__favourite">
                                    <button type="button" class="product-card__favourite-button button button--ordinary button--iconed button--simple button--big button--red" data-card-favourite="heart">
                                        <span class="button__icon button__icon--big">
                                            <svg class="icon icon--heart">
                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-heart" data-card-favourite-icon></use>
                                            </svg>
                                        </span>
                                    </button>
                                </div>

                                <a href="https://fakeimg.pl/366x312/" data-fancybox="gallery">
                                    <div class="product-card__wrapper">
                                        <div class="product-card__image box box--circle">
                                            <div class="product-card__box">
                                                <img src="https://fakeimg.pl/366x312/" alt="<?= $arResult['NAME'] ?>" class="product-card__pic">
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </article>
                    </div>
                    <? endif; ?>
                    <? if (!empty($arResult['PRODUCT_VIDEO'])) : ?>
                        <div class="swiper-slide slider__slide">
                            <article class="product-card product-card--detail product-card--slide box box--circle box--hovering box--border">
                                <div class="product-card__header">
                                    <? if ($arResult['DISCOUNT_LABELS'][$offerId]['NAME']) : ?>
                                        <div class="product-card__label label label--<?= $arResult['DISCOUNT_LABELS'][$offerId]['COLOR']?>"><?= strtolower($arResult['DISCOUNT_LABELS'][$offerId]['NAME'])?></div>
                                    <? endif; ?>
                                    <div class="product-card__favourite">
                                        <button type="button" class="product-card__favourite-button button button--ordinary button--iconed button--simple button--big button--red" data-card-favourite="heart">
                                        <span class="button__icon button__icon--big">
                                            <svg class="icon icon--heart">
                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-heart" data-card-favourite-icon></use>
                                            </svg>
                                        </span>
                                        </button>
                                    </div>

                                    <a href="<?= $arResult['PRODUCT_VIDEO']['path'] ?>" data-fancybox="gallery">
                                        <div class="product-card__wrapper">
                                            <div class="product-card__image box box--circle">
                                                <div class="product-card__box">
                                                    <video src="<?= $arResult['PRODUCT_VIDEO']['path'] ?>" poster="/local/templates/.default/images/detail-slide.png" controls class="product-card__pic"></video>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </article>
                        </div>
                    <? endif; ?>
                </div>

                <div class="slider__buttons">
                    <div class="slider__buttons-item swiper-button-prev" data-carousel-prev>
                        <button type="button" class="slider__button slider__button--prev button button--circular button--small button--mixed button--gray-red button--shadow">
                            <span class="button__icon">
                                <svg class="icon icon--arrow-slider">
                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-slider"></use>
                                </svg>
                            </span>
                        </button>
                    </div>

                    <div class="swiper-pagination pagination pagination--image" data-carousel-pagination></div>

                    <div class="slider__buttons-item swiper-button-next" data-carousel-next>
                        <button type="button" class="slider__button slider__button--next button button--circular button--small button--mixed button--gray-red button--shadow">
                            <span class="slider__button-icon button__icon">
                                <svg class="icon icon--arrow-slider">
                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-slider"></use>
                                </svg>
                            </span>
                        </button>
                    </div>
                </div>

            </div>
        </div>
        </div>
        <!-- Конец блока слайдера-->

        <!-- Основной блок -->
        <div class="detail__card-wrapper">
            <!-- Основная информация -->
            <div class="detail__card-specification specification">
                <p class="specification__title specification__title--hidden"><?= $arResult['TITLE']?></p><!-- Название -->

                <!-- Артикулы -->
                <div id="offerArticle">
                    <p class="specification__article specification__article--hidden">Арт. <?=$arResult['ARTICLES'][$offerId]?></p>
                </div>
                <div id="offerSelect">
                    <!-- Блок селекта фассовки большой вариант-->
                    <? if (!empty($arResult['PACKAGINGS'])) :?>
                        <div class="specification__packs packs">
                            <p class="specification__category">Фасовка</p>
                            <ul class="packs__list">
                                <?  foreach ($arResult['PACKAGINGS'] as $item) :?>
                                        <li class="packs__item">
                                            <div class="pack pack--bordered">
                                                <div class="radio">
                                                    <input type="radio" class="pack__input radio__input" name="radio_pack" value="<?=$item['offerId']?>" id="radio<?=$item['offerId']?>"

                                                        <?= ($arResult['AVAILABLE'][$item['offerId']]) ? '' : 'disabled'?>
                                                    >
                                                    <label for="radio<?=$item['offerId']?>">
                                                        <div class="pack__item <?= ($arResult['AVAILABLE'][$item['offerId']]) ? '' : 'pack__item--disabled'?>" ><?= $item['package']?></div>
                                                    </label>
                                                </div>
                                            </div>
                                        </li>
                                <? endforeach; ?>

                            </ul>
                        </div>
                    <? elseif (!empty($arResult['COLORS'])): ?>
                        <div class="specification__colors colors colors--big">
                            <p class="specification__category">Цвет</p>
                            <ul class="colors__list">
                                <?  foreach ($arResult['COLORS'] as $item) :?>
                                        <li class="colors__item">
                                            <div class="color <?= ($arResult['AVAILABLE'][$item['offerId']]) ? '' : 'color--disabled'?>">
                                                <div class="radio">
                                                    <input type="radio" class="color__input radio__input" name="radio_color" value="<?=$item['offerId']?>" id="radio<?=$item['offerId']?>"
                                                        <?= ($arResult['AVAILABLE'][$item['offerId']]) ? '' : 'disabled'?>
                                                    >
                                                    <label for="radio<?=$item['offerId']?>">
                                                        <div class="color__item color__item--big color__item--<?=$item['color']?>"></div>
                                                    </label>
                                                </div>
                                            </div>
                                        </li>
                                <? endforeach; ?>
                            </ul>
                        </div>
                    <? endif; ?>
                </div>
                <!-- Артикулы -->
                <!-- Блок селекта фассовки -->

                <!-- Список описаний товара -->
                <ul class="specification__description">
                    <?php foreach ($arResult['SPECIFICATION'] as $key => $value): ?>
                        <li class="specification__description-item">
                            <p class="specification__description-topic" data-fixwidth>
                                <?=$arResult['PROPERTY_NAMES'][$key]?>
                            </p>
                            <p class="specification__description-response">
                                <?=$value?>
                            </p>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <!-- Список описаний товара -->
            </div>
            <!-- Основная информация -->

            <!-- Блок  Ваш заказ -->
            <div class="detail__card-order cart">
                <h4 class="cart__heading">Ваш заказ</h4>

                <!-- Блок селекта фассовки малый вариант-->
                <div id="offerSelectMobile">
                <? if (!empty($arResult['PACKAGINGS'])) :?>
                <div class="cart__packs">
                    <p class="specification__category">Фасовка</p>
                    <div class="select select--middle select--simple" data-select>
                        <select class="select__control" name="select1m" data-select-control data-placeholder="Выберите фасовку" data-option>
                            <option><!-- пустой option для placeholder --></option>
                            <?  foreach ($arResult['PACKAGINGS'] as $item) :
                                $isAvailable = $arResult['AVAILABLE'][$item['offerId']];
                                ?>
                                <? if ($item['package']) :?>
                                <option value="<?=$item['offerId']?>"
                                        data-option-after='<span class="stock <?= $isAvailable ? 'stock--yes' : ''?>"><?= !$isAvailable ? 'нет ' : ''?>в наличии</span>'
                                    <?= !$isAvailable ? 'disabled' : ''?>
                                >
                                    <?= $item['package']?>
                                </option>
                                <? endif; ?>
                            <? endforeach;?>
                        </select>
                    </div>
                </div>
                <? elseif (!empty($arResult['COLORS'])): ?>
                <div class="cart__colors">
                    <p class="specification__category">Цвет</p>
                    <div class="select select--middle select--simple" data-select>
                        <select class="select__control" name="select1p" data-select-control data-placeholder="Выберите цвет" data-option>
                            <option><!-- пустой option для placeholder --></option>
                            <?  foreach ($arResult['COLORS'] as $item) :
                                $isAvailable = $arResult['AVAILABLE'][$item['offerId']];
                            ?>
                            <? if ($item['color']) :?>
                                <option value="<?=$item['offerId']?>"
                                            data-option-before='<div class="color__item">
                                                <div class="color__item-wrapper">
                                                    <img src="<?=$arResult['ALL_COLORS'][$item['color']]['file_src']?>" class="color__item-pic">
                                                </div>
                                            </div>'
                                        data-option-after='<span class="stock <?= $isAvailable ? 'stock--yes' : ''?>"><?= !$isAvailable ? 'нет ' : ''?>в наличии</span>'>
                                    <?= ($arResult['COLOR_NAMES'][$item['color']]) ??  '' ?>
                                </option>
                            <? endif; ?>
                            <? endforeach;?>
                        </select>
                    </div>
                </div>
                <? endif; ?>
                </div>
                <!-- Блок селекта фассовки малый вариант-->

                <!-- Блок цены ТП -->
                <div
                    id="offerPrice"
                    class="cart__price price"
                    prop-is-authorized="<?= json_encode($USER->isAuthorized()) ?>"
                    prop-is-consultant="<?= json_encode($arResult['IS_CONSULTANT']) ?>"
                >
                    <?php if ($arResult['IS_CONSULTANT']):?>
                        <?php if ($arResult['PRICES'][$offerId]['BASE_PRICE']):?>
                            <p class="price__main"><?=number_format($arResult['PRICES'][$offerId]['BASE_PRICE'], 0, ' ', ' ')?> ₽</p>
                        <?php endif;?>
                        <div class="price__calculation">
                            <p class="price__calculation-total"><?=number_format($arResult['PRICES'][$offerId]['PRICE'], 0, ' ', ' ')?> ₽</p>
                            <p class="price__calculation-accumulation"><?=number_format($arResult['BONUSES_PRICES'][$offerId], 0, ' ', ' ')?> ББ</p>
                        </div>
                    <?php elseif ($USER->isAuthorized() && $arResult['PRICES'][$offerId]['BASE_PRICE']): ?>
                        <div class="price__calculation" >
                            <p class="price__calculation-total price__calculation-total--red"><?=number_format($arResult['PRICES'][$offerId]['PRICE'], 0, ' ', ' ')?> ₽</p>
                            <p class="price__main"><?=number_format($arResult['PRICES'][$offerId]['BASE_PRICE'], 0, ' ', ' ')?> ₽</p>
                        </div>
                    <?php else: ?>
                        <div class="price__calculation" >
                            <p class="price__calculation-total">
                                <?=number_format($arResult['PRICES'][$offerId]['PRICE'], 0, ' ', ' ')?> ₽
                            </p>
                        </div>
                    <?php endif; ?>
                </div>
                <!-- Блок цены ТП -->
            </div>
            <!-- Блок  Ваш заказ -->
        </div>
        <!-- Основной блок -->
    </div>

    <div class="detail__information">
        <div class="detail__information-tabs tabs tabs--accordeon tabs--red tabs--bordered" data-tabs>
            <nav class="tabs__items">
                <ul class="detail__information-tabs-list tabs__list">
                    <?php if (1): ?>
                        <li class="detail__information-tabs-item tabs__item tabs__item--active" data-tab="block1">
                            Описание
                        </li>
                    <?php endif; ?>

                    <?php if (in_array('COMPOSITION', $arResult['ADDITIONAL_TABS']) && ($arResult['COMPOSITION'] || $arResult['ENERGY_VALUE'])): ?>
                        <li class="detail__information-tabs-item tabs__item" data-tab="block2">
                            Состав
                        </li>
                    <?php endif; ?>

                    <?php if (in_array('FEEDING_ADVICE', $arResult['ADDITIONAL_TABS']) && $arResult['FEEDING_RECOMMENDATIONS']): ?>
                        <li class="detail__information-tabs-item tabs__item" data-tab="block3">
                            Рекомендации по кормлению
                        </li>
                    <?php endif; ?>

                    <li class="detail__information-tabs-item tabs__item" data-tab="block4">
                        Документы
                    </li>
                </ul>
            </nav>

            <div class="detail__information-tabs-body tabs__body accordeon accordeon--simple-bordered">
                <div class="accordeon__item box box--rounded-sm tabs__accordeon" data-accordeon="mobile-accordeon">
                    <div class="accordeon__header tabs__accordeon-header" data-accordeon-toggle>
                        <h6 class="accordeon__title accordeon__title--dark">Описание</h6>

                        <button type="button" class="accordeon__toggle button button--circular button--mini button--covered button--red-white">
                            <span class="accordeon__toggle-icon button__icon">
                                <svg class="icon icon--arrow-down">
                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-down"></use>
                                </svg>
                            </span>
                        </button>
                    </div>

                    <div class="tabs__block tabs__block--active accordeon__body" data-accordeon-content data-tab-section="block1">
                        <div class="description description--tablet">

                        <div class="description__col">
                            <?=$arResult['PRODUCT_FEATURES']?>

                            <? if ($arResult['PRODUCT_IMAGE']) :?>
                            <div class="description__image description__image--mobile">
                                <img src="<?=$arResult['PRODUCT_IMAGE']['SRC']?>" alt="Товар" class="description__image__pic">
                            </div>
                            <? endif; ?>

                            <?php if ($arResult['DESCRIPTION']): ?>
                                <h5>Общее</h5>

                                <p>
                                    <?=$arResult['DESCRIPTION']?>
                                </p>
                            <?php endif; ?>

                            <!-- блок Детали -->
                            <?php if (!empty($arResult['PRODUCT_DETAILS'])): ?>
                                <h5>Детали</h5>

                                <ul>
                                    <?php foreach ($arResult['PRODUCT_DETAILS'] as $value): ?>
                                        <li><?=$value?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </div>

                        <div class="description__col description__col--right">
                            <? if ($arResult['PRODUCT_IMAGE']) :?>
                            <div class="description__image description__image--desktop">
                                <img src="<?=$arResult['PRODUCT_IMAGE']['SRC']?>" alt="Товар" class="description__image__pic">
                            </div>
                            <? endif; ?>
                        </div>

                        </div>
                    </div>
                </div>


                <div class="accordeon__item box box--rounded-sm tabs__accordeon" data-accordeon="mobile-accordeon">
                    <div class="accordeon__header tabs__accordeon-header" data-accordeon-toggle="">
                        <h6 class="accordeon__title accordeon__title--dark">Состав</h6>

                        <button type="button" class="accordeon__toggle button button--circular button--mini button--covered button--red-white">
                            <span class="accordeon__toggle-icon button__icon">
                                <svg class="icon icon--arrow-down">
                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-down"></use>
                                </svg>
                            </span>
                        </button>
                    </div>

                    <div class="tabs__block accordeon__body" data-tab-section="block2"  data-accordeon-content="">
                        <div class="description">
                            <div class="description__col description__col--half">
                                <h5 class="description__col-title">Общий состав</h5>
                                <?php if ($arResult['COMPOSITION']['TYPE'] === "HTML"): ?>
                                    <?=$arResult['COMPOSITION']['TEXT']?>
                                <?php else: ?>
                                    <p><?=$arResult['COMPOSITION']['TEXT']?></p>
                                <?php endif; ?>

                            </div>

                            <div class="description__col description__col--half">
                                <h5 class="description__col-title">Пищевая ценность   
                                    <span class="description__annotation">На 100 г продукта</span>
                                </h5>

                                <div class="nutritionals">
                                    <?php foreach ($arResult['NUTRITIONAL_VALUE'] as $key => $value): ?>
                                        <?php if ($value): ?>
                                            <div class="nutritionals__item">
                                                <div class="nutritional">
                                                    <span class="nutritional__name"><?=$arResult['PROPERTY_NAMES'][$key] ?></span>
                                                    <span class="nutritional__size"><?=$value ?></span>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>

                                <?php if (!empty($arResult['ENERGY_VALUE'])): ?>
                                <h5 class="description__col-title">Энергетическая ценность
                                    <span class="description__annotation">На 100 г продукта</span>
                                </h5>

                                <div class="nutritionals">
                                    <?php foreach ($arResult['ENERGY_VALUE'] as $key => $value): ?>
                                        <?php if ($value): ?>
                                            <div class="nutritionals__item">
                                                <div class="nutritional">
                                                    <span class="nutritional__name"><?=$arResult['PROPERTY_NAMES'][$key] ?></span>
                                                    <span class="nutritional__size"><?=$value ?></span>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordeon__item box box--rounded-sm tabs__accordeon" data-accordeon="mobile-accordeon">
                    <div class="accordeon__header tabs__accordeon-header" data-accordeon-toggle>
                        <h6 class="accordeon__title accordeon__title--dark">Рекомендации по кормлению</h6>

                        <button type="button" class="accordeon__toggle button button--circular button--mini button--covered button--red-white">
                            <span class="accordeon__toggle-icon button__icon">
                                <svg class="icon icon--arrow-down">
                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-down"></use>
                                </svg>
                            </span>
                        </button>
                    </div>

                    <div class="tabs__block accordeon__body" data-tab-section="block3"  data-accordeon-content>
                        <?php if ($arResult['FEEDING_RECOMMENDATIONS']['TYPE'] === "HTML"): ?>
                            <?=$arResult['FEEDING_RECOMMENDATIONS']['TEXT']?>
                        <?php else: ?>
                            <p><?=$arResult['FEEDING_RECOMMENDATIONS']['TEXT']?></p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="accordeon__item box box--rounded-sm tabs__accordeon" data-accordeon="mobile-accordeon">
                    <div class="accordeon__header tabs__accordeon-header" data-accordeon-toggle>
                        <h6 class="accordeon__title accordeon__title--dark">Документы</h6>

                        <button type="button" class="accordeon__toggle button button--circular button--mini button--covered button--red-white">
                            <span class="accordeon__toggle-icon button__icon">
                                <svg class="icon icon--arrow-down">
                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-down"></use>
                                </svg>
                            </span>
                        </button>
                    </div>
                    <? if (!empty($arResult['DOCUMENTS'])) : ?>
                    <div class="tabs__block accordeon__body" data-tab-section="block4" data-accordeon-content>
                        <div class="documents">

                            <? foreach ($arResult['DOCUMENTS'] as $document) : ?>
                            <div class="documents__item">
                                <div class="document">
                                    <a href="<?= $document['SRC'] ?>" class="document__link" download>
                                        <div class="document__icon">
                                            <svg class="icon icon--pdf">
                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-<?=array_last(explode('.', $document['SRC'])) ?>"></use>
                                            </svg>
                                        </div>
                                        <div class="document__text">
                                            <span class="document__text-name"><?= $document['ORIGINAL_NAME'] ?></span>
                                            <span class="document__text-size">(<?= round($document['FILE_SIZE'] / 1024) ?> KB)</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <? endforeach; ?>


                        </div>
                    </div>
                    <? endif; ?>
                </div>
            </div>
        </div>
    </div>

    <?

    if (! empty($arResult['RELATED_PRODUCTS'])) {

        global $relatedProductsFilter;

        $relatedProductsFilter['INCLUDE_SUBSECTIONS'] = 'Y';
        $relatedProductsFilter['SECTION_GLOBAL_ACTIVE'] = 'Y';
        $relatedProductsFilter['SECTION_ID'] = 0;
        $relatedProductsFilter['WITH_DISCOUNT'] = null;
        $relatedProductsFilter['ID'] = $arResult['RELATED_PRODUCTS'];

        $relatedProductsSectionComponentParams = [
            "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
            "ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
            "ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
            "ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
            "ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
            "PROPERTY_CODE" => $arParams["PROPERTY_CODE"],
            "PROPERTY_CODE_MOBILE" => ($arParams["PROPERTY_CODE_MOBILE"] ?? []),
            "META_KEYWORDS" => "",
            "META_DESCRIPTION" => "",
            "BROWSER_TITLE" => "",
            "SET_LAST_MODIFIED" => "N",
            "INCLUDE_SUBSECTIONS" => "A",
            "BASKET_URL" => $arParams["BASKET_URL"],
            "ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
            "PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
            "SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
            "PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
            "PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
            "FILTER_NAME" => "relatedProductsFilter",
            "CACHE_TYPE" => 'A',
            "CACHE_TIME" => 86400,
            "CACHE_FILTER" => "N",
            "CACHE_GROUPS" => "N",
            "SET_TITLE" => "N",
            "MESSAGE_404" => "",
            "SET_STATUS_404" => "N",
            "SHOW_404" => "N",
            "DISPLAY_COMPARE" => 'N',
            "PAGE_ELEMENT_COUNT" => 1,
            "LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
            "PRICE_CODE" => $arParams["~PRICE_CODE"],
            "USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
            "SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],

            "PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
            "USE_PRODUCT_QUANTITY" => $arParams["USE_PRODUCT_QUANTITY"],
            "ADD_PROPERTIES_TO_BASKET" => ($arParams["ADD_PROPERTIES_TO_BASKET"] ?? ''),
            "PARTIAL_PRODUCT_PROPERTIES" => ($arParams["PARTIAL_PRODUCT_PROPERTIES"] ?? ''),
            "PRODUCT_PROPERTIES" => $arParams["PRODUCT_PROPERTIES"],

            "DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
            "DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
            "PAGER_TITLE" => $arParams["PAGER_TITLE"],
            "PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
            "PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
            "PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
            "PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
            "PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
            "LAZY_LOAD" => 'N',
            "MESS_BTN_LAZY_LOAD" => '',
            "LOAD_ON_SCROLL" => 'N',

            "OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
            "OFFERS_FIELD_CODE" => $arParams["OFFERS_FIELD_CODE"],
            "OFFERS_PROPERTY_CODE" => $arParams["OFFERS_PROPERTY_CODE"],
            "OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
            "OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
            "OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
            "OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
            "OFFERS_LIMIT" => $arParams["OFFERS_LIMIT"],

            "SECTION_ID" => "",
            "SECTION_CODE" => "",
            "SECTION_URL" => $arParams["SECTION_URL"],
            "DETAIL_URL" => $arParams["DETAIL_URL"],
            "USE_MAIN_ELEMENT_SECTION" => "N",
            "CONVERT_CURRENCY" => $arParams["CONVERT_CURRENCY"],
            "CURRENCY_ID" => $arParams["CURRENCY_ID"],
            "HIDE_NOT_AVAILABLE" => $arParams["HIDE_NOT_AVAILABLE"],
            "HIDE_NOT_AVAILABLE_OFFERS" => $arParams["HIDE_NOT_AVAILABLE_OFFERS"],

            'LABEL_PROP' => ($arParams['LABEL_PROP'] ?? ''),
            'LABEL_PROP_MOBILE' => ($arParams['LABEL_PROP_MOBILE'] ?? ''),
            'LABEL_PROP_POSITION' => ($arParams['LABEL_PROP_POSITION'] ?? ''),
            'ADD_PICT_PROP' => ($arParams['ADD_PICT_PROP'] ?? ''),
            'PRODUCT_DISPLAY_MODE' => 'Y',
            'PRODUCT_BLOCKS_ORDER' => ($arParams['PRODUCT_BLOCKS_ORDER'] ?? ''),
            'PRODUCT_ROW_VARIANTS' => ($arParams['PRODUCT_ROW_VARIANTS'] ?? ''),
            'ENLARGE_PRODUCT' => ($arParams['ENLARGE_PRODUCT'] ?? ''),
            'ENLARGE_PROP' => ($arParams['ENLARGE_PROP'] ?? ''),
            'SHOW_SLIDER' => ($arParams['SHOW_SLIDER'] ?? 'Y'),
            'SLIDER_INTERVAL' => ($arParams['SLIDER_INTERVAL'] ?? '3000'),
            'SLIDER_PROGRESS' => ($arParams['SLIDER_PROGRESS'] ?? 'N'),

            'OFFER_ADD_PICT_PROP' => ($arParams['OFFER_ADD_PICT_PROP'] ?? ''),
            'OFFER_TREE_PROPS' => ($arParams['OFFER_TREE_PROPS'] ?? []),
            'PRODUCT_SUBSCRIPTION' => ($arParams['PRODUCT_SUBSCRIPTION'] ?? ''),
            'SHOW_DISCOUNT_PERCENT' => ($arParams['SHOW_DISCOUNT_PERCENT'] ?? ''),
            'SHOW_OLD_PRICE' => 'Y',
            'SHOW_MAX_QUANTITY' => 'N',
            'MESS_SHOW_MAX_QUANTITY' => ($arParams['~MESS_SHOW_MAX_QUANTITY'] ?? ''),
            'RELATIVE_QUANTITY_FACTOR' => ($arParams['RELATIVE_QUANTITY_FACTOR'] ?? ''),
            'MESS_RELATIVE_QUANTITY_MANY' => ($arParams['~MESS_RELATIVE_QUANTITY_MANY'] ?? ''),
            'MESS_RELATIVE_QUANTITY_FEW' => ($arParams['~MESS_RELATIVE_QUANTITY_FEW'] ?? ''),
            'MESS_BTN_BUY' => ($arParams['~MESS_BTN_BUY'] ?? ''),
            'MESS_BTN_ADD_TO_BASKET' => ($arParams['~MESS_BTN_ADD_TO_BASKET'] ?? ''),
            'MESS_BTN_SUBSCRIBE' => ($arParams['~MESS_BTN_SUBSCRIBE'] ?? ''),
            'MESS_BTN_DETAIL' => ($arParams['~MESS_BTN_DETAIL'] ?? ''),
            'MESS_NOT_AVAILABLE' => ($arParams['~MESS_NOT_AVAILABLE'] ?? ''),
            'MESS_BTN_COMPARE' => ($arParams['~MESS_BTN_COMPARE'] ?? ''),

            'USE_ENHANCED_ECOMMERCE' => ($arParams['USE_ENHANCED_ECOMMERCE'] ?? ''),
            'DATA_LAYER_NAME' => ($arParams['DATA_LAYER_NAME'] ?? ''),
            'BRAND_PROPERTY' => ($arParams['BRAND_PROPERTY'] ?? ''),

            'TEMPLATE_THEME' => ($arParams['TEMPLATE_THEME'] ?? ''),
            "ADD_SECTIONS_CHAIN" => "N",
            'ADD_TO_BASKET_ACTION' => ($arParams['ADD_TO_BASKET_ACTION'] ?? ''),
            'SHOW_CLOSE_POPUP' => ($arParams['SHOW_CLOSE_POPUP'] ?? ''),
            'COMPARE_PATH' => ($arParams['COMPARE_PATH'] ?? ''),
            'COMPARE_NAME' => ($arParams['COMPARE_NAME'] ?? ''),
            'USE_COMPARE_LIST' => ($arParams['USE_COMPARE_LIST'] ?? ''),
            "COMPATIBLE_MODE" => "N",
            "ADD_ELEMENT_CHAIN" => "N",
            "SHOW_ALL_WO_SECTION" => "Y",
            "DISABLE_INIT_JS_IN_COMPONENT" => "N",
        ];

        $APPLICATION->IncludeComponent(
            "zolo:catalog.section",
            "related_products",
            $relatedProductsSectionComponentParams,
            $arResult["THEME_COMPONENT"],
            [
                'HIDE_ICONS' => 'Y',
            ]
        );

    }
    ?>

</div>

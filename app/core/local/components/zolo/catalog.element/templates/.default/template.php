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
<?php
    $APPLICATION->IncludeComponent(
        'bitrix:breadcrumb', 
        '', 
        [
            'PATH' => '',
            'SITE_ID' => '',
            'START_FROM' => '0',
        ],
        false
    );



//    dump("tpl", $arResult);
?>
<?php
$offerId = 721;//$arResult['OFFER_FIRST'];
?>

<!-- Каталог товаров -->
<div class="content__main content__main--separated">
    <div class="detail__card">
        <div class="detail__card-specification detail__card-specification--mobile specification">
            <p class="specification__title"><?= $arResult['TITLE']?></p>
            <?php foreach ($arResult['ARTICLES'] as $articul): ?>
                <p class="specification__article">Арт. <?= $articul?></p>
            <?php endforeach; ?>
        </div>

        <!--  Слайдер  в картинками ТП -->
        <div class="detail__card-slider slider slider--product" data-carousel="product">
            <div class="swiper-container" data-carousel-container>
                <div class="swiper-wrapper" data-card-favourite-block>
                    <?  $offerImgs = $arResult['PHOTOS'][$offerId]; // TODO first By sort
                    if (!empty($offerImgs)) : ?>
                        <? foreach ($offerImgs as $image) : ?>
                        <div class="swiper-slide slider__slide">
                            <article class="product-card product-card--slide box box--circle box--hovering box--border">
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

                                    <div class="product-card__wrapper">
                                        <div class="product-card__image box box--circle">
                                            <div class="product-card__box">
                                                <img src="<?= $image['SRC'] ?>" alt="<?= $arResult['NAME'] ?>" class="product-card__pic">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <? endforeach; ?>
                    <? else : ?>
                    <div class="swiper-slide slider__slide">
                        <article class="product-card product-card--slide box box--circle box--hovering box--border">
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

                                <div class="product-card__wrapper">
                                    <div class="product-card__image box box--circle">
                                        <div class="product-card__box">
                                            <img src="https://fakeimg.pl/366x312/" alt="<?= $arResult['NAME'] ?>" class="product-card__pic">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                    <? endif; ?>
                    <? if (!empty($arResult['PRODUCT_VIDEO'])) : ?>
                        <div class="swiper-slide slider__slide">
                            <article class="product-card product-card--slide box box--circle box--hovering box--border">
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

                                    <div class="product-card__wrapper">
                                        <div class="product-card__image box box--circle">
                                            <div class="product-card__box">
                                                <video src="<?= $arResult['PRODUCT_VIDEO']['path'] ?>" poster="/local/templates/.default/images/detail-slide.png" controls class="product-card__pic"></video>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                    <? endif; ?>
                </div>

                <div class="slider__buttons">
                    <div class="slider__buttons-item swiper-button-prev" data-carousel-prev>
                        <button type="button" class="slider__button slider__button--prev button button--circular button--small button--mixed button--gray-red button--shadow">
                            <span class="button__icon">
                                <svg class="icon icon--basket">
                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-angle-left"></use>
                                </svg>
                            </span>
                        </button>
                    </div>

                    <div class="swiper-pagination pagination pagination--image" data-carousel-pagination></div>

                    <div class="slider__buttons-item swiper-button-next" data-carousel-next>
                        <button type="button" class="slider__button slider__button--next button button--circular button--small button--mixed button--gray-red button--shadow">
                            <span class="button__icon">
                                <svg class="icon icon--basket">
                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-angle-left"></use>
                                </svg>
                            </span>
                        </button>
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
                <?php foreach ($arResult['ARTICLES'] as $articul): ?>
                    <p class="specification__article specification__article--hidden">Арт. <?=$articul?></p>
                <?php endforeach; ?>
                <!-- Артикулы -->

                <!-- Блок селекта фассовки большой вариант-->
                <? if (!empty($arResult['PACKAGINGS'])) :?>
                    <div class="specification__packs packs">
                        <p class="specification__category">Фасовка</p>
                        <ul class="packs__list">
                            <?  foreach ($arResult['PACKAGINGS'] as $offerId => $package) :?>
                                <li class="packs__item">
                                    <div class="pack pack--bordered">
                                        <div class="radio">
                                            <input type="radio" class="pack__input radio__input" name="radio_pack" value="<?=$offerId?>" id="radio<?=$offerId?>"
                                                  <?= ($arResult['AVAILABLE'][$offerId]) ? '' : 'disabled'?>
                                            >
                                            <label for="radio<?=$offerId?>">
                                                <div class="pack__item <?= ($arResult['AVAILABLE'][$offerId]) ? '' : 'pack__item--disabled'?>" ><?= $package?></div>
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
                            <?  foreach ($arResult['COLORS'] as $offerId => $color) :?>
                            <li class="colors__item">
                                <div class="color <?= ($arResult['AVAILABLE'][$offerId]) ? '' : 'color--disabled'?>">
                                    <div class="radio">
                                        <input type="radio" class="color__input radio__input" name="radio_color" value="color_<?=$offerId?>" id="radio<?=$offerId?>"
                                            <?= ($arResult['AVAILABLE'][$offerId]) ? '' : 'disabled'?>
                                        >
                                        <label for="radio<?=$offerId?>">
                                            <div class="color__item color__item--big color__item--<?=$color?>"></div>
                                        </label>
                                    </div>
                                </div>
                            </li>
                            <? endforeach; ?>
                        </ul>
                    </div>
                <? endif; ?>

                <!-- Блок селекта фассовки -->

                <!-- Список описаний товара -->
                <ul class="specification__description">
                    <?php foreach ($arResult['SPECIFICATION'] as $key => $value): ?>
                        <li class="specification__description-item">
                            <p class="specification__description-topic"><?=$arResult['PROPERTY_NAMES'][$key]?></p>
                            <p class="specification__description-response"><?=$value?></p>
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
                <? if (empty($arResult['PACKAGINGS'])) :?>
                <div class="cart__packs">
                    <p class="specification__category">Фасовка</p>
                    <div class="select select--mini" data-select>
                        <select class="select__control" name="select1m" data-select-control data-placeholder="Выберите фасовку" data-option>
                            <option><!-- пустой option для placeholder --></option>
                            <?  foreach ($arResult['PACKAGINGS'] as $offerId => $package) :
                                $isAvailable = $arResult['AVAILABLE'][$offerId];
                                ?>
                            <option value="<?=$offerId?>"
                                    data-option-after='<span class="stock <?= $isAvailable ? 'stock--yes' : ''?>"><?= !$isAvailable ? 'нет ' : ''?>в наличии</span>'
                                <?= !$isAvailable ? 'disabled' : ''?>
                            >
                                <?= $package?>
                            </option>
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
                            <?  foreach ($arResult['COLORS'] as $offerId => $color) :
                                $isAvailable = $arResult['AVAILABLE'][$offerId];
                            ?>
                            <option value="<?=$offerId?>"
                                    data-option-before='<span class="color color--option"><span class="color__item color__item--medium color__item--<?=$color?>"></span></span>'
                                    data-option-after='<span class="stock <?= $isAvailable ? 'stock--yes' : ''?>"><?= !$isAvailable ? 'нет ' : ''?>в наличии</span>'>
                                <?= ($arResult['COLOR_NAMES'][$color]) ??  '' ?>
                            </option>
                            <? endforeach;?>
                        </select>
                    </div>
                </div>
                <? endif; ?>
                <!-- Блок селекта фассовки малый вариант-->

                <?php if ($USER->isAuthorized()): ?>

                    <div class="cart__price price">
                        <p class="price__main">1 545 ₽</p>
                        <div class="price__calculation">
                            <p class="price__calculation-total">1 420 ₽</p>
                            <p class="price__calculation-accumulation">14 ББ</p>
                        </div>
                    </div>

                <?php else: ?>

                    <!-- Если не авторизован -->
                    <div class="cart__price price">
                        <div class="price__calculation" >
                            <p class="price__calculation-total price__calculation-total--red">1 420 ₽</p>
                            <p class="price__main">1 545 ₽</p>
                        </div>
                    </div>

                <?php endif; ?>
                <div class="cart__quantity quantity" data-quantity>
                    <div class="quantity__button" data-quantity-button>
                        <button type="button" class="button button--full button--medium button--rounded button--covered button--white-green">
                            <span class="button__icon">
                                <svg class="icon icon--basket">
                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-basket"></use>
                                </svg>
                            </span>
                            <span class="button__text">В корзину</span>
                        </button>
                    </div>

                    <div class="quantity__actions">
                        <div class="quantity__decrease">
                            <button type="button" class="button button--iconed button--covered button--square button--small button--gray-red" data-quantity-decrease>
                                <span class="button__icon button__icon--small">
                                    <svg class="icon icon--minus">
                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-minus"></use>
                                    </svg>
                                </span>
                            </button>
                        </div>

                        <div class="quantity__total">
                            <span class="quantity__total-icon">
                                <svg class="icon icon--basket">
                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-basket"></use>
                                </svg>
                            </span>
                            <span class="quantity__total-sum" data-quantity-sum="0">0</span>
                        </div>

                        <div class="quantity__increase">
                            <button type="button" class="button button--iconed button--covered button--square button--small button--gray-green" data-quantity-increase>
                                <span class="button__icon button__icon--small">
                                    <svg class="icon icon--plus">
                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-plus"></use>
                                    </svg>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Блок  Ваш заказ -->
        </div>
        <!-- Основной блок -->
    </div>

    <div class="detail__information">
        <div class="detail__information-tabs tabs tabs--accordeon tabs--red tabs--bordered" data-tabs>
            <nav class="tabs__items">
                <ul class="tabs__list">
                    <?php if (1): ?>
                        <li class="tabs__item tabs__item--active" data-tab="block1">
                            Описание
                        </li>
                    <?php endif; ?>

                    <?php if ($arResult['COMPOSITION'] || $arResult['ENERGY_VALUE']): ?>
                        <li class="tabs__item" data-tab="block2">
                            Состав
                        </li>
                    <?php endif; ?>

                    <?php if ($arResult['FEEDING_RECOMMENDATIONS']): ?>
                        <li class="tabs__item" data-tab="block3">
                            Рекомендации по кормлению
                        </li>
                    <?php endif; ?>

                    <li class="tabs__item" data-tab="block4">
                        Документы
                    </li>
                </ul>
            </nav>

            <div class="detail__information-tabs-body tabs__body accordeon accordeon--simple-bordered">
                <div class="accordeon__item box box--rounded-sm tabs__accordeon" data-accordeon>
                    <div class="accordeon__header tabs__accordeon-header" data-accordeon-toggle>
                        <h6 class="accordeon__title">Описание</h6>

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
                            <h5 class="description__title">Особенности нашего корма</h5>

                            <div class="description__features features">
                                <div class="features__item">
                                    <div class="feature">
                                        <div class="feature__icon">
                                            <svg class="icon icon--chemistry">
                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-chemistry"></use>
                                            </svg>
                                        </div>
                                        <div class="feature__text">Сбалансированная формула</div>
                                    </div>
                                </div>

                                <div class="features__item">
                                    <div class="feature">
                                        <div class="feature__icon">
                                            <svg class="icon icon--diagnosis">
                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-diagnosis"></use>
                                            </svg>
                                        </div>
                                        <div class="feature__text">Гипоаллергенные ингредиенты</div>
                                    </div>
                                </div>

                                <div class="features__item">
                                    <div class="feature">
                                        <div class="feature__icon">
                                            <svg class="icon icon--protection">
                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-protection"></use>
                                            </svg>
                                        </div>
                                        <div class="feature__text">Профилактика здоровья ежедневно</div>
                                    </div>
                                </div>

                                <div class="features__item">
                                    <div class="feature">
                                        <div class="feature__icon">
                                            <svg class="icon icon--diploma">
                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-diploma"></use>
                                            </svg>
                                        </div>
                                        <div class="feature__text">Гипоаллергенные ингредиенты</div>
                                    </div>
                                </div>
                            </div>

                            
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
                            <div class="description__image">
                                <img src="<?=$arResult['PRODUCT_IMAGE']['SRC']?>" alt="Товар" class="description__image__pic">
                            </div>
                            <? endif; ?>
                        </div>

                        </div>
                    </div>
                </div>


                <div class="accordeon__item box box--rounded-sm tabs__accordeon" data-accordeon>
                    <div class="accordeon__header tabs__accordeon-header" data-accordeon-toggle="">
                        <h6 class="accordeon__title">Состав</h6>

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
                                <h5>Состав</h5>

                                <p><?= $arResult['COMPOSITION']?></p>
                            </div>

                            <div class="description__col description__col--half">
                                <h5>Пищевая ценность <span class="description__annotation">На 100 г продукта</span></h5>

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
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordeon__item box box--rounded-sm tabs__accordeon" data-accordeon>
                    <div class="accordeon__header tabs__accordeon-header" data-accordeon-toggle>
                        <h6 class="accordeon__title">Рекомендации по кормлению</h6>

                        <button type="button" class="accordeon__toggle button button--circular button--mini button--covered button--red-white">
                            <span class="accordeon__toggle-icon button__icon">
                                <svg class="icon icon--arrow-down">
                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-down"></use>
                                </svg>
                            </span>
                        </button>
                    </div>

                    <div class="tabs__block accordeon__body" data-tab-section="block3"  data-accordeon-content>
                        <?= $arResult['FEEDING_RECOMMENDATIONS'] ?>
                    </div>
                </div>

                <div class="accordeon__item box box--rounded-sm tabs__accordeon" data-accordeon>
                    <div class="accordeon__header tabs__accordeon-header" data-accordeon-toggle>
                        <h6 class="accordeon__title">Документы</h6>

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
                                    <a href="<?= $document['SRC'] ?>" class="document__link" target="_blank">
                                        <div class="document__icon">
                                            <svg class="icon icon--pdf">
                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-pdf"></use>
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

    <div class="detail__attached">
        <h3 class="detail__attached-title">Сопутствующие товары</h3>
n
        <div class="product-cards">
            <ul class="product-cards__list">
                <li class="product-cards__item">
                    <article class="product-card box box--circle box--hovering box--grayish">
                        <a href="#" class="product-card__link"></a>
                        <div class="product-card__header">
                            <div class="product-card__label label label--violet">ограниченное предложение</div>

                            <div class="product-card__favourite">
                                <button type="button" class="product-card__favourite-button button button--ordinary button--iconed button--simple button--big button--red" data-card-favourite="heart">
                                    <span class="button__icon button__icon--big">
                                        <svg class="icon">
                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-heart" data-card-favourite-icon></use>
                                        </svg>
                                    </span>
                                </button>
                            </div>

                            <div class="product-card__wrapper">
                                <div class="product-card__image box box--circle">
                                    <div class="product-card__box">
                                        <img src="/local/templates/.default/images/portage.png" alt="Название товара" class="product-card__pic">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="product-card__content">
                            <h6 class="product-card__title">Клиппер-переноска для кошек и собак Ferplast Jet 10 серый/фиолетовый серый/фиолетовыйсерый/фиолетовый серый/фиолетовый</h6>

                            <p class="product-card__article">Арт. СХ-С-456013</p>

                            <div class="product-card__colors colors">
                                <ul class="colors__list">
                                    <li class="colors__item">
                                        <div class="color">
                                            <div class="radio">
                                                <input type="radio" class="color__input radio__input" name="radio2" value="r1" id="radio" checked>
                                                <label for="radio">
                                                    <div class="color__item color__item--pink"></div>
                                                </label>
                                            </div>
                                        </div>
                                    </li>

                                    <li class="colors__item">
                                        <div class="color">
                                            <div class="radio">
                                                <input type="radio" class="color__input radio__input" name="radio2" value="r2" id="radio2">
                                                <label for="radio2">
                                                    <div class="color__item color__item--blue"></div>
                                                </label>
                                            </div>
                                        </div>
                                    </li>

                                    <li class="colors__item">
                                        <div class="color">
                                            <div class="radio">
                                                <input type="radio" class="color__input radio__input" name="radio2" value="r3" id="radio3">
                                                <label for="radio3">
                                                    <div class="color__item color__item--green"></div>
                                                </label>
                                            </div>
                                        </div>
                                    </li>

                                    <li class="colors__item">
                                        <div class="color">
                                            <div class="radio">
                                                <input type="radio" class="color__input radio__input" name="radio2" value="r4" id="radio4">
                                                <label for="radio4">
                                                    <div class="color__item color__item--yellow"></div>
                                                </label>
                                            </div>
                                        </div>
                                    </li>

                                    <li class="colors__item">
                                        <div class="color">
                                            <div class="radio">
                                                <input type="radio" class="color__input radio__input" name="radio2" value="r3" id="radio5">
                                                <label for="radio5">
                                                    <div class="color__item color__item--red"></div>
                                                </label>
                                            </div>
                                        </div>
                                    </li>

                                    <li class="colors__item">
                                        <div class="color">
                                            <div class="radio">
                                                <input type="radio" class="color__input radio__input" name="radio2" value="r3" id="radio6">
                                                <label for="radio6">
                                                    <div class="color__item color__item--violet"></div>
                                                </label>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <div class="product-card__breed">
                                <div class="select select--mini" data-select>
                                    <select class="select__control" name="select1m" id="select1m" data-select-control data-placeholder="Выберите размер" data-option>
                                        <option><!-- пустой option для placeholder --></option>
                                        <option value="1">Для всех пород</option>
                                        <option value="2">Мелкие породы</option>
                                        <option value="3">Средние породы</option>
                                        <option value="4">Крупные породы</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="product-card__footer">
                            <div class="product-card__price price">
                                <p class="price__main">1 545 ₽</p>
                                <div class="price__calculation">
                                    <p class="price__calculation-total">1 420 ₽</p>
                                    <p class="price__calculation-accumulation">14 ББ</p>
                                </div>
                            </div>

                            <div class="product-card__cart">
                                <div class="quantity" data-quantity>
                                    <div class="quantity__button" data-quantity-button>
                                        <button type="button" class="button button--full button--medium button--rounded button--covered button--white-green">
                                            <span class="button__icon">
                                                <svg class="icon icon--basket">
                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-basket"></use>
                                                </svg>
                                            </span>
                                            <span class="button__text">В корзину</span>
                                        </button>
                                    </div>
        
                                    <div class="quantity__actions">
                                        <div class="quantity__decrease">
                                            <button type="button" class="button button--iconed button--covered button--square button--small button--gray-red" data-quantity-decrease>
                                                <span class="button__icon button__icon--small">
                                                    <svg class="icon icon--minus">
                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-minus"></use>
                                                    </svg>
                                                </span>
                                            </button>
                                        </div>
        
                                        <div class="quantity__total">
                                            <span class="quantity__total-icon">
                                                <svg class="icon icon--basket">
                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-basket"></use>
                                                </svg>
                                            </span>
                                            <span class="quantity__total-sum" data-quantity-sum="0">0</span>
                                        </div>
        
                                        <div class="quantity__increase">
                                            <button type="button" class="button button--iconed button--covered button--square button--small button--gray-green" data-quantity-increase>
                                                <span class="button__icon button__icon--small">
                                                    <svg class="icon icon--plus">
                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-plus"></use>
                                                    </svg>
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                </li>

                <li class="product-cards__item">
                    <article class="product-card box box--circle box--hovering box--grayish">
                        <a href="#" class="product-card__link"></a>
                        <div class="product-card__header">
                            <div class="product-card__label label label--pink">сезонное предложение</div>

                            <div class="product-card__favourite">
                                <button type="button" class="product-card__favourite-button button button--ordinary button--iconed button--simple button--big button--red" data-card-favourite="heart">
                                    <span class="button__icon button__icon--big">
                                        <svg class="icon icon--heart">
                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-heart" data-card-favourite-icon></use>
                                        </svg>
                                    </span>
                                </button>
                            </div>

                            <div class="product-card__wrapper">
                                <div class="product-card__image box box--circle">
                                    <div class="product-card__box">
                                        <img src="/local/templates/.default/images/portage.png" alt="Название товара" class="product-card__pic">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="product-card__content">
                            <h6 class="product-card__title">Клиппер-переноска для кошек и собак Ferplast Jet 10 серый/фиолетовый серый/фиолетовыйсерый/фиолетовый серый/фиолетовый</h6>

                            <p class="product-card__article">Арт. СХ-С-456013</p>

                            <div class="product-card__packs product-card__packs--desktop packs">
                                <ul class="packs__list">
                                    <li class="packs__item">
                                        <div class="pack">
                                            <div class="radio">
                                                <input type="radio" class="pack__input radio__input" name="radio11p" value="r11" id="radio11p" checked>
                                                <label for="radio11p">
                                                    <div class="pack__item">600 г</div>
                                                </label>
                                            </div>
                                        </div>
                                    </li>

                                    <li class="packs__item">
                                        <div class="pack">
                                            <div class="radio">
                                                <input type="radio" class="pack__input radio__input" name="radio11p" value="r22" id="radio22p">
                                                <label for="radio22p">
                                                    <div class="pack__item">1 кг</div>
                                                </label>
                                            </div>
                                        </div>
                                    </li>

                                    <li class="packs__item">
                                        <div class="pack">
                                            <div class="radio">
                                                <input type="radio" class="pack__input radio__input" name="radio11p" value="r33" id="radio33p">
                                                <label for="radio33p">
                                                    <div class="pack__item">3 кг</div>
                                                </label>
                                            </div>
                                        </div>
                                    </li>

                                    <li class="packs__item">
                                        <div class="pack">
                                            <div class="radio">
                                                <input type="radio" class="pack__input radio__input" name="radio11p" value="r44" id="radio44p">
                                                <label for="radio44p">
                                                    <div class="pack__item">5 кг</div>
                                                </label>
                                            </div>
                                        </div>
                                    </li>

                                    <li class="packs__item">
                                        <div class="pack">
                                            <div class="radio">
                                                <input type="radio" class="pack__input radio__input" name="radio11p" value="r55" id="radio55p">
                                                <label for="radio55p">
                                                    <div class="pack__item">7 кг</div>
                                                </label>
                                            </div>
                                        </div>
                                    </li>

                                    <li class="packs__item">
                                        <div class="pack">
                                            <div class="radio">
                                                <input type="radio" class="pack__input radio__input" name="radio11p" value="r66" id="radio66p">
                                                <label for="radio66p">
                                                    <div class="pack__item">10 кг</div>
                                                </label>
                                            </div>
                                        </div>
                                    </li>

                                    <li class="packs__item">
                                        <div class="pack">
                                            <div class="radio">
                                                <input type="radio" class="pack__input radio__input" name="radio11p" value="r77" id="radio77p">
                                                <label for="radio77p">
                                                    <div class="pack__item">15 кг</div>
                                                </label>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <div class="product-card__packs product-card__packs--mobile">
                                <div class="select select--mini" data-select>
                                    <select class="select__control" name="select1p" id="select1p" data-select-control data-placeholder="Выберите фасовку" data-option>
                                        <option><!-- пустой option для placeholder --></option>
                                        <option value="1">600 г</option>
                                        <option value="2">1 кг</option>
                                        <option value="3">3 кг</option>
                                        <option value="4">5 кг</option>
                                        <option value="5">7 кг</option>
                                        <option value="6">10 кг</option>
                                        <option value="7">15 кг</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="product-card__footer">
                            <div class="product-card__price price">
                                <p class="price__main">1 545 ₽</p>
                                <div class="price__calculation">
                                    <p class="price__calculation-total">1 420 ₽</p>
                                    <p class="price__calculation-accumulation">14 ББ</p>
                                </div>
                            </div>

                            <div class="product-card__cart">
                                <div class="quantity" data-quantity>
                                    <div class="quantity__button" data-quantity-button>
                                        <button type="button" class="button button--full button--medium button--rounded button--covered button--white-green">
                                            <span class="button__icon">
                                                <svg class="icon icon--basket">
                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-basket"></use>
                                                </svg>
                                            </span>
                                            <span class="button__text">В корзину</span>
                                        </button>
                                    </div>
        
                                    <div class="quantity__actions">
                                        <div class="quantity__decrease">
                                            <button type="button" class="button button--iconed button--covered button--square button--small button--gray-red" data-quantity-decrease>
                                                <span class="button__icon button__icon--small">
                                                    <svg class="icon icon--minus">
                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-minus"></use>
                                                    </svg>
                                                </span>
                                            </button>
                                        </div>
        
                                        <div class="quantity__total">
                                            <span class="quantity__total-icon">
                                                <svg class="icon icon--basket">
                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-basket"></use>
                                                </svg>
                                            </span>
                                            <span class="quantity__total-sum" data-quantity-sum="0">0</span>
                                        </div>
        
                                        <div class="quantity__increase">
                                            <button type="button" class="button button--iconed button--covered button--square button--small button--gray-green" data-quantity-increase>
                                                <span class="button__icon button__icon--small">
                                                    <svg class="icon icon--plus">
                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-plus"></use>
                                                    </svg>
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                </li>

                <li class="product-cards__item">
                    <article class="product-card box box--circle box--hovering box--grayish">
                        <a href="#" class="product-card__link"></a>
                        <div class="product-card__header">
                            <div class="product-card__favourite">
                                <button type="button" class="product-card__favourite-button button button--ordinary button--iconed button--simple button--big button--red" data-card-favourite="heart">
                                    <span class="button__icon button__icon--big">
                                        <svg class="icon icon--heart">
                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-heart" data-card-favourite-icon></use>
                                        </svg>
                                    </span>
                                </button>
                            </div>

                            <div class="product-card__wrapper">
                                <div class="product-card__image box box--circle">
                                    <div class="product-card__box">
                                        <img src="/local/templates/.default/images/portage.png" alt="Название товара" class="product-card__pic">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="product-card__content">
                            <h6 class="product-card__title">Клиппер-переноска для кошек и собак Ferplast Jet 10 серый/фиолетовый серый/фиолетовыйсерый/фиолетовый серый/фиолетовый</h6>

                            <p class="product-card__article">Арт. СХ-С-456013</p>

                            <div class="product-card__colors colors">
                                <ul class="colors__list">
                                    <li class="colors__item">
                                        <div class="color">
                                            <div class="radio">
                                                <input type="radio" class="color__input radio__input" name="radio2" value="r1" id="radioc" checked>
                                                <label for="radioc">
                                                    <div class="color__item color__item--pink"></div>
                                                </label>
                                            </div>
                                        </div>
                                    </li>

                                    <li class="colors__item">
                                        <div class="color">
                                            <div class="radio">
                                                <input type="radio" class="color__input radio__input" name="radio2" value="r2" id="radio2c">
                                                <label for="radio2c">
                                                    <div class="color__item color__item--blue"></div>
                                                </label>
                                            </div>
                                        </div>
                                    </li>

                                    <li class="colors__item">
                                        <div class="color">
                                            <div class="radio">
                                                <input type="radio" class="color__input radio__input" name="radio2" value="r3" id="radio3c">
                                                <label for="radio3c">
                                                    <div class="color__item color__item--green"></div>
                                                </label>
                                            </div>
                                        </div>
                                    </li>

                                    <li class="colors__item">
                                        <div class="color">
                                            <div class="radio">
                                                <input type="radio" class="color__input radio__input" name="radio2" value="r4" id="radio4c">
                                                <label for="radio4c">
                                                    <div class="color__item color__item--yellow"></div>
                                                </label>
                                            </div>
                                        </div>
                                    </li>

                                    <li class="colors__item">
                                        <div class="color">
                                            <div class="radio">
                                                <input type="radio" class="color__input radio__input" name="radio2" value="r3" id="radio5c">
                                                <label for="radio5c">
                                                    <div class="color__item color__item--red"></div>
                                                </label>
                                            </div>
                                        </div>
                                    </li>

                                    <li class="colors__item">
                                        <div class="color">
                                            <div class="radio">
                                                <input type="radio" class="color__input radio__input" name="radio2" value="r3" id="radio6c">
                                                <label for="radio6c">
                                                    <div class="color__item color__item--violet"></div>
                                                </label>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <div class="product-card__breed">
                                <div class="select select--mini" data-select>
                                    <select class="select__control" name="select11m" id="select11m" data-select-control data-placeholder="Выберите размер" data-option>
                                        <option><!-- пустой option для placeholder --></option>
                                        <option value="1">Для всех пород</option>
                                        <option value="2">Мелкие породы</option>
                                        <option value="3">Средние породы</option>
                                        <option value="4">Крупные породы</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="product-card__footer">
                            <div class="product-card__price price">
                                <p class="price__main">1 545 ₽</p>
                                <div class="price__calculation">
                                    <p class="price__calculation-total">1 420 ₽</p>
                                    <p class="price__calculation-accumulation">14 ББ</p>
                                </div>
                            </div>

                            <div class="product-card__cart">
                                <div class="quantity" data-quantity>
                                    <div class="quantity__button" data-quantity-button>
                                        <button type="button" class="button button--full button--medium button--rounded button--covered button--white-green">
                                            <span class="button__icon">
                                                <svg class="icon icon--basket">
                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-basket"></use>
                                                </svg>
                                            </span>
                                            <span class="button__text">В корзину</span>
                                        </button>
                                    </div>
        
                                    <div class="quantity__actions">
                                        <div class="quantity__decrease">
                                            <button type="button" class="button button--iconed button--covered button--square button--small button--gray-red" data-quantity-decrease>
                                                <span class="button__icon button__icon--small">
                                                    <svg class="icon icon--minus">
                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-minus"></use>
                                                    </svg>
                                                </span>
                                            </button>
                                        </div>
        
                                        <div class="quantity__total">
                                            <span class="quantity__total-icon">
                                                <svg class="icon icon--basket">
                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-basket"></use>
                                                </svg>
                                            </span>
                                            <span class="quantity__total-sum" data-quantity-sum="0">0</span>
                                        </div>
        
                                        <div class="quantity__increase">
                                            <button type="button" class="button button--iconed button--covered button--square button--small button--gray-green" data-quantity-increase>
                                                <span class="button__icon button__icon--small">
                                                    <svg class="icon icon--plus">
                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-plus"></use>
                                                    </svg>
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                </li>

                <li class="product-cards__item">
                    <article class="product-card box box--circle box--hovering box--grayish">
                        <a href="#" class="product-card__link"></a>
                        <div class="product-card__header">
                            <div class="product-card__label label label--pink">сезонное предложение</div>

                            <div class="product-card__favourite">
                                <button type="button" class="product-card__favourite-button button button--ordinary button--iconed button--simple button--big button--red" data-card-favourite="heart">
                                    <span class="button__icon button__icon--big">
                                        <svg class="icon icon--heart">
                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-heart" data-card-favourite-icon></use>
                                        </svg>
                                    </span>
                                </button>
                            </div>

                            <div class="product-card__wrapper">
                                <div class="product-card__image box box--circle">
                                    <div class="product-card__box">
                                        <img src="/local/templates/.default/images/portage.png" alt="Название товара" class="product-card__pic">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="product-card__content">
                            <h6 class="product-card__title">Клиппер-переноска для кошек и собак Ferplast Jet 10 серый/фиолетовый серый/фиолетовыйсерый/фиолетовый серый/фиолетовый</h6>

                            <p class="product-card__article">Арт. СХ-С-456013</p>

                            <div class="product-card__packs product-card__packs--desktop packs">
                                <ul class="packs__list">
                                    <li class="packs__item">
                                        <div class="pack">
                                            <div class="radio">
                                                <input type="radio" class="pack__input radio__input" name="radio11" value="r11" id="radio111p" checked>
                                                <label for="radio111p">
                                                    <div class="pack__item">600 г</div>
                                                </label>
                                            </div>
                                        </div>
                                    </li>

                                    <li class="packs__item">
                                        <div class="pack">
                                            <div class="radio">
                                                <input type="radio" class="pack__input radio__input" name="radio11" value="r22" id="radio221p">
                                                <label for="radio221p">
                                                    <div class="pack__item">1 кг</div>
                                                </label>
                                            </div>
                                        </div>
                                    </li>

                                    <li class="packs__item">
                                        <div class="pack">
                                            <div class="radio">
                                                <input type="radio" class="pack__input radio__input" name="radio11" value="r33" id="radio331p">
                                                <label for="radio331p">
                                                    <div class="pack__item">3 кг</div>
                                                </label>
                                            </div>
                                        </div>
                                    </li>

                                    <li class="packs__item">
                                        <div class="pack">
                                            <div class="radio">
                                                <input type="radio" class="pack__input radio__input" name="radio11" value="r44" id="radio441p">
                                                <label for="radio441p">
                                                    <div class="pack__item">5 кг</div>
                                                </label>
                                            </div>
                                        </div>
                                    </li>

                                    <li class="packs__item">
                                        <div class="pack">
                                            <div class="radio">
                                                <input type="radio" class="pack__input radio__input" name="radio11" value="r55" id="radio551p">
                                                <label for="radio551p">
                                                    <div class="pack__item">7 кг</div>
                                                </label>
                                            </div>
                                        </div>
                                    </li>

                                    <li class="packs__item">
                                        <div class="pack">
                                            <div class="radio">
                                                <input type="radio" class="pack__input radio__input" name="radio11" value="r66" id="radio661p">
                                                <label for="radio661p">
                                                    <div class="pack__item">10 кг</div>
                                                </label>
                                            </div>
                                        </div>
                                    </li>

                                    <li class="packs__item">
                                        <div class="pack">
                                            <div class="radio">
                                                <input type="radio" class="pack__input radio__input" name="radio11" value="r77" id="radio771p">
                                                <label for="radio771p">
                                                    <div class="pack__item">15 кг</div>
                                                </label>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <div class="product-card__packs product-card__packs--mobile">
                                <div class="select select--mini" data-select>
                                    <select class="select__control" name="select11p" id="select11p" data-select-control data-placeholder="Выберите фасовку" data-option>
                                        <option><!-- пустой option для placeholder --></option>
                                        <option value="1">600 г</option>
                                        <option value="2">1 кг</option>
                                        <option value="3">3 кг</option>
                                        <option value="4">5 кг</option>
                                        <option value="5">7 кг</option>
                                        <option value="6">10 кг</option>
                                        <option value="7">15 кг</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="product-card__footer">
                            <div class="product-card__price price">
                                <p class="price__main">1 545 ₽</p>
                                <div class="price__calculation">
                                    <p class="price__calculation-total">1 420 ₽</p>
                                    <p class="price__calculation-accumulation">14 ББ</p>
                                </div>
                            </div>

                            <div class="product-card__cart">
                                <div class="quantity quantity--active" data-quantity>
                                    <div class="quantity__button" data-quantity-button>
                                        <button type="button" class="button button--full button--medium button--rounded button--covered button--white-green">
                                            <span class="button__icon">
                                                <svg class="icon icon--basket">
                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-basket"></use>
                                                </svg>
                                            </span>
                                            <span class="button__text">В корзину</span>
                                        </button>
                                    </div>
        
                                    <div class="quantity__actions">
                                        <div class="quantity__decrease">
                                            <button type="button" class="button button--iconed button--covered button--square button--small button--gray-red" data-quantity-decrease>
                                                <span class="button__icon button__icon--small">
                                                    <svg class="icon icon--minus">
                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-minus"></use>
                                                    </svg>
                                                </span>
                                            </button>
                                        </div>
        
                                        <div class="quantity__total">
                                            <span class="quantity__total-icon">
                                                <svg class="icon icon--basket">
                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-basket"></use>
                                                </svg>
                                            </span>
                                            <span class="quantity__total-sum" data-quantity-sum="2">2</span>
                                        </div>
        
                                        <div class="quantity__increase">
                                            <button type="button" class="button button--iconed button--covered button--square button--small button--gray-green" data-quantity-increase>
                                                <span class="button__icon button__icon--small">
                                                    <svg class="icon icon--plus">
                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-plus"></use>
                                                    </svg>
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- Каталог товаров -->
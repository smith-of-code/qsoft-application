<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Интернет-магазин");
?>
    <div class="content__main content__main--primary">
        <!--Слайдер-->
        <section class="main__section">
            <div class="slider slider--main" data-carousel="main">
                <div class="swiper-container" data-carousel-container>
                    <div class="swiper-wrapper">

                        <div class="swiper-slide slider__slide">
                            <div class="slider__image">
                                <picture>
                                    <source media="(min-width: 1440px)"
                                            srcset="/local/templates/.default/images/main-slider-desktop.jpg">
                                    <source media="(min-width: 768px)"
                                            srcset="/local/templates/.default/images/main-slider-tablet.jpg">
                                    <img src="/local/templates/.default/images/main-slider-mobile.jpg"
                                         alt="Слайд на главной" class="slider__image-picture">
                                </picture>
                            </div>

                            <article class="slider__card card-banner">
                                <a href="#" class="card-banner__link"></a>
                                <div class="card-banner__inner">
                                    <h2 class="card-banner__title">
                                        Это точно понравится вам и вашим питомцам:
                                    </h2>
                                    <p class="card-banner__text">
                                        Скидка на популярные товары для собак в июне
                                    </p>

                                    <div class="card-banner__pagination swiper-pagination pagination pagination--default"
                                         data-carousel-pagination></div>

                                    <div class="card-banner__sale sale">
                                        <p class="sale__text">
                                            -50%
                                        </p>
                                    </div>
                                </div>
                            </article>
                        </div>

                        <div class="swiper-slide slider__slide">
                            <div class="slider__image">
                                <picture>
                                    <source media="(min-width: 1440px)"
                                            srcset="/local/templates/.default/images/main-slider-desktop.jpg">
                                    <source media="(min-width: 768px)"
                                            srcset="/local/templates/.default/images/main-slider-tablet.jpg">
                                    <img src="/local/templates/.default/images/main-slider-mobile.jpg"
                                         alt="Слайд на главной" class="slider__image-picture">
                                </picture>
                            </div>

                            <article class="slider__card card-banner">
                                <a href="#" class="card-banner__link"></a>
                                <div class="card-banner__inner">
                                    <h2 class="card-banner__title">
                                        Это точно понравится вам и вашим питомцам:
                                    </h2>
                                    <p class="card-banner__text">
                                        Скидка на популярные товары для собак в июне
                                    </p>

                                    <div class="card-banner__pagination swiper-pagination pagination pagination--default"
                                         data-carousel-pagination></div>

                                    <div class="card-banner__sale sale">
                                        <p class="sale__text">
                                            -50%
                                        </p>
                                    </div>
                                </div>
                            </article>
                        </div>

                    </div>

                    <div class="swiper-pagination pagination" data-carousel-pagination></div>

                    <div class="slider__buttons">
                        <div class="slider__buttons-item swiper-button-prev" data-carousel-prev>
                            <button type="button" class="slider__button slider__button--prev">
                                <svg class="slider__button-icon icon icon--arrow">
                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-left"></use>
                                </svg>
                            </button>
                        </div>
                        <div class="slider__buttons-item swiper-button-next" data-carousel-next>
                            <button type="button" class="slider__button slider__button--next">
                                <svg class="slider__button-icon icon icon--arrow">
                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-left"></use>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--/Слайдер-->

        <!--Каталоги-->
        <?php
        $APPLICATION->IncludeComponent(
                'bitrix:main.include',
        '',
        [
            'AREA_FILE_SHOW' => 'file',
            'PATH' => 'include/mainPage/catalog.php'
        ])?>
        <!--/Каталоги-->

        <!--Хиты продаж--><!-- $APPLICATION->IncludeComponent(bitrix:catalog.top, "", [...]) -->
        <section class="main__section main__section--separated">
            <div class="main__section-header">
                <p class="main__section-heading heading heading--huge">Хиты продаж</p>
                <a href="#" type="button" class="button button--simple button--red button--transition">
                                    <span class="button__icon button__icon--average button__icon--red button__icon--right">
                                        <svg class="icon icon--arrow-right-light">
                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-right-light"></use>
                                        </svg>
                                    </span>
                    <span class="button__text">Смотреть все</span>
                </a>
            </div>

            <div class="main__tabs tabs tabs--black tabs--rounded" data-tabs>
                <nav class="tabs__items">
                    <ul class="tabs__list">
                        <li class="tabs__item tabs__item--active" data-tab="food">
                            корм
                        </li>

                        <li class="tabs__item" data-tab="accessories">
                            аксессуары
                        </li>
                    </ul>
                </nav>

                <div class="main__tabs-body tabs__body">
                    <!--корм-->
                    <div class="tabs__block tabs__block--active" data-tab-section="food">
                        <div class="product-cards" data-show-cards>
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
                                                    <select class="select__control" name="select1m" data-select-control data-placeholder="Выберите размер" data-option>
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
                                                    <select class="select__control" name="select1p" data-select-control data-placeholder="Выберите фасовку" data-option>
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
                                                    <select class="select__control" name="select11m" data-select-control data-placeholder="Выберите размер" data-option>
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
                                    <article class="product-card product-card--marketing box box--circle box--hovering box--grayish">
                                        <a href="#" class="product-card__link"></a>
                                        <div class="product-card__header">
                                            <div class="product-card__wrapper">
                                                <div class="product-card__image box box--circle">
                                                    <div class="product-card__box">
                                                        <img src="/local/templates/.default/images/animals2.png" alt="Название товара" class="product-card__pic">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="product-card__content">
                                            <h4 class="product-card__title">Новые вкусы<br> от AmeAppetite</h4>

                                            <p class="product-card__text">Побалуйте вашего питомца - телятина, цыпленок, индейка, кролик - он захочет попробовать все!</p>
                                        </div>

                                        <div class="product-card__footer">
                                            <div class="product-card__footer-label">
                                                <div class="label label--primary label--red">
                                                    -15%
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                </li>

                                <li class="product-cards__item product-cards__item--hidden" data-show-card>
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

                                <li class="product-cards__item product-cards__item--hidden" data-show-card>
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

                                <li class="product-cards__item product-cards__item--hidden" data-show-card>
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
                                                    <select class="select__control" name="select11m" data-select-control data-placeholder="Выберите размер" data-option>
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

                                <li class="product-cards__item product-cards__item--hidden" data-show-card>
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
                                                    <select class="select__control" name="select11m" data-select-control data-placeholder="Выберите размер" data-option>
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
                            </ul>

                            <button type="button" class="product-cards__button button button--full button--rounded button--covered button--white-green" data-show-button>
                                Показать еще
                            </button>
                        </div>
                    </div>
                    <!--/корм-->

                    <div class="tabs__block" data-tab-section="accessories">
                        <div class="product-cards" data-show-cards>
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
                                                    <select class="select__control" name="select1m" data-select-control data-placeholder="Выберите размер" data-option>
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
                                                    <select class="select__control" name="select1p" data-select-control data-placeholder="Выберите фасовку" data-option>
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
                                                    <select class="select__control" name="select11m" data-select-control data-placeholder="Выберите размер" data-option>
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
                                    <article class="product-card product-card--marketing box box--circle box--hovering box--grayish">
                                        <a href="#" class="product-card__link"></a>
                                        <div class="product-card__header">
                                            <div class="product-card__wrapper">
                                                <div class="product-card__image box box--circle">
                                                    <div class="product-card__box">
                                                        <img src="/local/templates/.default/images/animals2.png" alt="Название товара" class="product-card__pic">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="product-card__content">
                                            <h4 class="product-card__title">Новые вкусы<br> от AmeAppetite</h4>

                                            <p class="product-card__text">Побалуйте вашего питомца - телятина, цыпленок, индейка, кролик - он захочет попробовать все!</p>
                                        </div>

                                        <div class="product-card__footer">
                                            <div class="product-card__footer-label">
                                                <div class="label label--primary label--red">
                                                    -15%
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                </li>

                                <li class="product-cards__item product-cards__item--hidden" data-show-card>
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

                                <li class="product-cards__item product-cards__item--hidden" data-show-card>
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

                                <li class="product-cards__item product-cards__item--hidden" data-show-card>
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
                                                    <select class="select__control" name="select11m" data-select-control data-placeholder="Выберите размер" data-option>
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

                                <li class="product-cards__item product-cards__item--hidden" data-show-card>
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
                                                    <select class="select__control" name="select11m" data-select-control data-placeholder="Выберите размер" data-option>
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
                            </ul>

                            <button type="button" class="product-cards__button button button--full button--rounded button--covered button--white-green" data-show-button>
                                Показать еще
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--/Хиты продаж-->

        <!--Подборки-->
        <?php
        $APPLICATION->IncludeComponent(
            'bitrix:main.include',
            '',
            [
                'AREA_FILE_SHOW' => 'file',
                'PATH' => 'include/mainPage/collections.php'
            ])?>
        <!--/Подборки-->

        <!--Новости-->
        <?php
        $APPLICATION->IncludeComponent(
            'bitrix:main.include',
            '',
            [
                'AREA_FILE_SHOW' => 'file',
                'PATH' => 'include/mainPage/news.php'
            ])
        ?>
        <!--/Новости-->

        <!--Баннер-->
        <section class="main__section">
            <div class="banner banner--consultant">
                <div class="banner__image">
                    <img class="banner__image-picture" src="/local/templates/.default/images/banner1.png" alt="">
                </div>
                <div class="banner__inner">
                    <p class="banner__title">
                        Приводи друзей — зарабатывайте вместе
                    </p>
                    <p class="banner__text">
                        Работай с единомышленниками и получай бонусные баллы
                    </p>
                </div>
            </div>
        </section>
        <!--/Баннер-->

        <!--Баннер2-->
        <section class="main__section" style="display:none">
            <div class="banner banner--user">
                <div class="banner__image">
                    <img class="banner__image-picture" src="/local/templates/.default/images/banner1.png" alt="">
                </div>
                <div class="banner__inner">
                    <p class="banner__title">
                        Приводи друзей — зарабатывайте вместе
                    </p>
                    <p class="banner__text">
                        Работай с единомышленниками и получай бонусные баллы
                    </p>

                    <div class="banner__actions">
                        <a href="#"
                           class="banner__actions-button button button--rounded button--covered button--red button--heavy">Стать
                            консультантом</a>
                        <a href="#"
                           class="banner__actions-button button button--rounded button--covered button--white-green button--heavy">Узнать
                            больше</a>
                    </div>
                </div>
            </div>
        </section>
        <!--/Баннер2-->

        <!--Баннер3-->
        <section class="main__section" style="display:none">
            <div class="banner banner--user">
                <div class="banner__image">
                    <img class="banner__image-picture" src="/local/templates/.default/images/banner1.png" alt="">
                </div>
                <div class="banner__inner">
                    <p class="banner__title">
                        Получите все привилегии AmeБизнес, став консультантом
                    </p>

                    <div class="banner__actions">
                        <a href="#"
                           class="banner__actions-button button button--rounded button--covered button--red button--heavy">Стать
                            консультантом</a>
                        <a href="#"
                           class="banner__actions-button button button--rounded button--covered button--white-green button--heavy">Узнать
                            больше</a>
                    </div>
                </div>
            </div>
        </section>
        <!--/Баннер3-->

        <?php
        $APPLICATION->IncludeComponent(
            'bitrix:main.include',
            '',
            [
                'AREA_FILE_SHOW' => 'file',
                'PATH' => 'include/mainPage/about.php'
            ])?>
    </div>


<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
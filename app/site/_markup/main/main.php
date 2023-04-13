<!DOCTYPE html>
<html lang="ru">
    <head>
        <title>Главная</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1 maximum-scale=1 user-scalable=0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" type="text/css" href="/local/templates/.default/css/style.css" />
    </head>

    <body class="page">

        <? include_once("../include/header-main.php"); ?>

        <!--content-->
        <div class="page__content page__content--main content">
            <div class="container">
                <main class="page__main main">

                    <div class="content__main content__main--primary">
                        <!--Слайдер-->
                        <section class="main__section">
                            <div class="slider slider--main" data-carousel="main">
                                <div class="swiper-container" data-carousel-container>
                                    <div class="swiper-wrapper">

                                        <div class="swiper-slide slider__slide">
                                            <div class="slider__image">
                                                <picture>
                                                    <source media="(min-width: 1440px)" srcset="/local/templates/.default/images/main-slider-desktop.jpg">
                                                    <source media="(min-width: 768px)" srcset="/local/templates/.default/images/main-slider-tablet.jpg">
                                                    <img src="/local/templates/.default/images/main-slider-mobile.jpg" alt="Слайд на главной" class="slider__image-picture">
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

                                                    <div class="card-banner__pagination swiper-pagination pagination pagination--default" data-carousel-pagination></div>

                                                    <div class="card-banner__sale sale">
                                                        <p class="sale__text sale__text--big">
                                                            -50%
                                                        </p>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>

                                        <div class="swiper-slide slider__slide">
                                            <div class="slider__image">
                                                <picture>
                                                    <source media="(min-width: 1440px)" srcset="/local/templates/.default/images/main-slider-desktop.jpg">
                                                    <source media="(min-width: 768px)" srcset="/local/templates/.default/images/main-slider-tablet.jpg">
                                                    <img src="/local/templates/.default/images/main-slider-mobile.jpg" alt="Слайд на главной" class="slider__image-picture">
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

                                                    <div class="card-banner__pagination swiper-pagination pagination pagination--default" data-carousel-pagination></div>

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
                        <section class="main__section main__section--separated">
                            <div class="subject">
                                <div class="subject__row">
                                    <div class="subject__item box box--circle box--grayish">
                                        <a href="#" class="subject__link"></a>
                                        <div class="subject__info">
                                            <h3 class="subject__title">Товары<br> для собак</h3>
                                            <span type="button" class="subject__button button button--simple button--red">
                                                <span class="subject__button-icon button__icon button__icon--medium button__icon--right">
                                                    <svg class="icon icon--arrow-right-light">
                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-right-light"></use>
                                                    </svg>
                                                </span>
                                                <span class="button__text">Смотреть</span>
                                            </span>
                                        </div>

                                        <div class="subject__image">
                                            <img src="/local/templates/.default/images/dog2.png" alt="Каталог для собак" class="subject__image-pic">
                                        </div>
                                    </div>

                                    <div class="subject__item box box--circle box--grayish">
                                        <a href="#" class="subject__link"></a>
                                        <div class="subject__info">
                                            <h3 class="subject__title">Товары<br> для кошек</h3>
                                            <span type="button" class="subject__button button button--simple button--red">
                                                <span class="subject__button-icon button__icon button__icon--medium button__icon--right">
                                                    <svg class="icon icon--arrow-right-light">
                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-right-light"></use>
                                                    </svg>
                                                </span>
                                                <span class="button__text">Смотреть</span>
                                            </span>
                                        </div>

                                        <div class="subject__image">
                                            <img src="/local/templates/.default/images/cat2.png" alt="Каталог для собак" class="subject__image-pic">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!--/Каталоги-->

                        <!--Хиты продаж-->
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
                        <section class="main__section">
                            <div class="cards-compilation">
                                <ul class="cards-compilation__list">
                                    <li class="cards-compilation__item cards-compilation__item--business cards-compilation__item--extra">

                                        <article class="card-compilation card-compilation--big card-compilation--green box box--hovering box--circle">
                                            <a href="#" class="card-compilation__link"></a>
                                        
                                            <div class="card-compilation__inner">

                                                <div class="card-compilation__banner">
                                                    <img
                                                        src="https://placeimg.com/640/480/any"
                                                        alt="изображение подборки"
                                                        class="card-compilation__banner-image"
                                                    />
                                                </div>

                                                <div class="card-compilation__label label label--secondary label--green">
                                                    AmeБизнес
                                                </div>

                                                <div class="card-compilation__content">
                                                    <h2 class="card-compilation__title">
                                                        Строй свой бизнес с AmeAppetite,
                                                    </h2>

                                                    <p class="card-compilation__text">
                                                        совмещая работу и заботу о питомцах
                                                    </p>
                                                </div>

                                            </div>
                                        </article>

                                    </li>
                                    <li class="cards-compilation__item cards-compilation__item--sale cards-compilation__item--extra">

                                        <article class="card-compilation card-compilation--medium card-compilation--grey box box--hovering box--circle">
                                            <a href="#" class="card-compilation__link"></a>
                                        
                                            <div class="card-compilation__inner">

                                                <div class="card-compilation__banner">
                                                    <img
                                                        src="https://placeimg.com/640/480/any"
                                                        alt="изображение подборки"
                                                        class="card-compilation__banner-image"
                                                    />
                                                </div>

                                                <div class="card-compilation__label label label--primary label--red">
                                                    -25%
                                                </div>

                                                <div class="card-compilation__content">
                                                    <p class="card-compilation__text">
                                                        <span class="card-compilation__text-accent">
                                                            Скидка
                                                        </span>
                                                        на аксессуары для собак средних и маленьких пород!
                                                    </p>
                                                </div>

                                            </div>
                                        </article>

                                    </li>
                                    <li class="cards-compilation__item cards-compilation__item--compilation">

                                        <article class="card-compilation card-compilation--small card-compilation--violet box box--hovering box--circle">
                                            <a href="#" class="card-compilation__link"></a>
                                        
                                            <div class="card-compilation__inner">

                                                <div class="card-compilation__banner">
                                                    <img
                                                        src="https://placeimg.com/640/480/any"
                                                        alt="изображение подборки"
                                                        class="card-compilation__banner-image"
                                                    />
                                                </div>

                                                <div class="card-compilation__label label label--secondary label--violet">
                                                    Подборка
                                                </div>

                                                <div class="card-compilation__content">
                                                    <h2 class="card-compilation__title">
                                                        Строй свой бизнес с AmeAppetite,
                                                    </h2>
                                                </div>

                                            </div>
                                        </article>

                                    </li>
                                    <li class="cards-compilation__item cards-compilation__item--selection">

                                        <article class="card-compilation card-compilation--small card-compilation--violet box box--hovering box--circle">
                                            <a href="#" class="card-compilation__link"></a>
                                        
                                            <div class="card-compilation__inner">

                                                <div class="card-compilation__banner">
                                                    <img
                                                        src="https://placeimg.com/640/480/any"
                                                        alt="изображение подборки"
                                                        class="card-compilation__banner-image"
                                                    />
                                                </div>

                                                <div class="card-compilation__label label label--secondary label--violet">
                                                    Подборка
                                                </div>

                                                <div class="card-compilation__content">
                                                    <h2 class="card-compilation__title">
                                                        Строй свой бизнес с AmeAppetite,
                                                    </h2>
                                                </div>

                                            </div>
                                        </article>

                                    </li>
                                </ul>
                            </div>
                        </section>
                        <!--/Подборки-->

                        <!--Новости-->
                        <section class="main__section">
                            <div class="widgets">
                                <ul class="widgets__list">
                                    <li class="widgets__item">
                                        <div class="widget">
                                            <a class="widget__link" href="#"></a>
                                            <div class="widget__inner">
                                                <div class="widget__head">
                                                    <img class="widget__image" src="/local/templates/.default/images/megaphone.png">
                                                </div>
                                                <div class="widget__content">
                                                    <h4 class="widget__title">
                                                        Новости компании
                                                    </h4>
                                                    <p class="widget__description">
                                                        Держим вас в курсе событий
                                                    </p>
                                                </div>
                                                <div class="widget__footer">
                                                    <button 
                                                        type="button" 
                                                        class="widget__button button button--simple button--red">
                                                        <span class="widget__button-icon button__icon button__icon--right">
                                                            <svg class="icon icon--arrow">
                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-right-light"></use>
                                                            </svg>
                                                        </span>
                                                        <span class="button__text">Смотреть</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="widgets__item">
                                        <div class="widget">
                                            <a class="widget__link" href="#"></a>
                                            <div class="widget__inner">
                                                <div class="widget__head">
                                                    <img class="widget__image" src="/local/templates/.default/images/calendar.png">
                                                </div>
                                                <div class="widget__content">
                                                    <h4 class="widget__title">
                                                        Календарь мероприятий
                                                    </h4>
                                                    <p class="widget__description">
                                                        Расписание встреч и мастер-классов
                                                    </p>
                                                </div>
                                                <div class="widget__footer">
                                                    <button 
                                                        type="button" 
                                                        class="widget__button button button--simple button--red">
                                                        <span class="widget__button-icon button__icon button__icon--right">
                                                            <svg class="icon icon--arrow">
                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-right-light"></use>
                                                            </svg>
                                                        </span>
                                                        <span class="button__text">Смотреть</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="widgets__item">
                                        <div class="widget">
                                            <a class="widget__link" href="#"></a>
                                            <div class="widget__inner">
                                                <div class="widget__head">
                                                    <img class="widget__image" src="/local/templates/.default/images/college-graduation.png">
                                                </div>
                                                <div class="widget__content">
                                                    <h4 class="widget__title">
                                                        Советы экспертов
                                                    </h4>
                                                    <p class="widget__description">
                                                        Больше заботы о ваших питомцах
                                                    </p>
                                                </div>
                                                <div class="widget__footer">
                                                    <button 
                                                        type="button"
                                                        class="widget__button button button--simple button--red">
                                                        <span class="widget__button-icon button__icon button__icon--right">
                                                            <svg class="icon icon--arrow">
                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-right-light"></use>
                                                            </svg>
                                                        </span>
                                                        <span class="button__text">Смотреть</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </section>
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
                                        <a href="#" class="banner__actions-button button button--rounded button--covered button--red button--heavy">Стать консультантом</a>
                                        <a href="#" class="banner__actions-button button button--rounded button--covered button--white-green button--heavy">Узнать больше</a>
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
                                        <a href="#" class="banner__actions-button button button--rounded button--covered button--red button--heavy">Стать консультантом</a>
                                        <a href="#" class="banner__actions-button button button--rounded button--covered button--white-green button--heavy">Узнать больше</a>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!--/Баннер3-->

                        <section class="main__section">
                            <div class="company box box--grayish box--circle">
                                <div class="main__section-header main__section-header--closer">
                                    <p class="main__section-heading heading heading--huge">О компании</p>
                                    <a href="#" type="button" class="button button--simple button--red button--transition">
                                        <span class="button__icon button__icon--red button__icon--right">
                                            <svg class="icon icon--arrow-right-light">
                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-right-light"></use>
                                            </svg>
                                        </span>
                                        <span class="button__text">Узнать больше</span>
                                    </a>
                                </div>

                                <div class="company__row">
                                    <div class="company__col">
                                        <p class="company__title">Заботимся мы — счастливее вы!</p>

                                        <div class="company__content">
                                            <p class="company__text">Мы выбираем только качественную продукцию, которую не стыдно порекомендовать маме, лучшему другу или коллегам в офисе.</p>
                                            <p class="company__text">Наша цель - объединить людей, которые любят животных и стремятся дать лучшее нашим меньшим братьям, ведь они нам доверяют.</p>
                                            <p class="company__text">Поэтому мы предлагаем широкий ассортимент сухих и влажных кормов <span class="company__text-accent">Premium и Super Premium</span> класса, а также современные и качественные аксессуары по привлекательной цене. </p>
                                        </div>
                                    </div>

                                    <div class="company__col company__col--cards">
                                        <div class="adventages-cards">
                                            <ul class="adventages-cards__list">
                                                <li class="adventages-cards__item">
                                                    <div class="adventages-card adventages-card--blue">
                                                        <div class="adventages-card__image">
                                                            <svg class="adventages-card__image-icon icon icon--check-mark">
                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check-mark"></use>
                                                            </svg>
                                                        </div>
                                                        <p class="adventages-card__text">
                                                            Без ГМО<br> и вредных добавок
                                                        </p>
                                                    </div>
                                                </li>
            
                                                <li class="adventages-cards__item">
                                                    <div class="adventages-card adventages-card--gold">
                                                        <div class="adventages-card__image">
                                                            <svg class="adventages-card__image-icon icon icon--check-mark">
                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check-mark"></use>
                                                            </svg>
                                                        </div>
                                                        <p class="adventages-card__text">
                                                            Сбалансированная формула
                                                        </p>
                                                    </div>
                                                </li>
            
                                                <li class="adventages-cards__item">
                                                    <div class="adventages-card adventages-card--wisteria">
                                                        <div class="adventages-card__image">
                                                            <svg class="adventages-card__image-icon icon icon--check-mark">
                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check-mark"></use>
                                                            </svg>
                                                        </div>
                                                        <p class="adventages-card__text">
                                                            Комплекс витаминов и минералов
                                                        </p>
                                                    </div>
                                                </li>
            
                                                <li class="adventages-cards__item">
                                                    <div class="adventages-card adventages-card--piper">
                                                        <div class="adventages-card__image">
                                                            <svg class="adventages-card__image-icon icon icon--check-mark">
                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check-mark"></use>
                                                            </svg>
                                                        </div>
                                                        <p class="adventages-card__text">
                                                            Не менее 25% мяса
                                                        </p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </main>
            </div>
        </div>
        <!--content-->

        <? include_once("../include/footer.php"); ?>

        <script src="/local/templates/.default/js/script.js"></script>
    </body>

</html>
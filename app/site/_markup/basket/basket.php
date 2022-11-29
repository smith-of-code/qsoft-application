<!DOCTYPE html>
<html lang="ru">
    <head>
        <title>Корзина</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1 maximum-scale=1 user-scalable=0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" type="text/css" href="/local/templates/.default/css/style.css" />
    </head>

    <body class="page">

        <!--header-->
        <? include_once("../include/header.php"); ?>
        <!--/header-->

        <!--content-->
        <div class="page__content content">
            <div class="container">
                <main class="page__basket basket">

                    <h1 class="page__heading">Корзина</h1>
                   
                    <div class="content__main">
                        <div class="basket__row">
                            <div class="basket__col basket__col--full">
                                <div class="cards-cart basket__cart" data-basket>
                                    <div class="basket__cart-null heading heading--average">Корзина пуста</div>

                                    <ul class="cards-cart__list basket__list" data-basket-list>
                                        <li class="cards-cart__item basket__item"data-basket-item data-remove-item data-base-price=1200>

                                            <article class="card-cart">
                                                <a href="#" class="card-cart__link"></a>

                                                <div class="card-cart__inner">
                                                    <header class="card-cart__header">
                                                        <div class="card-cart__image">
                                                            <img src="/local/templates/.default/images/portage.png" alt="#" class="card-cart__image-picture">
                                                        </div>
                                                        <div class="card-cart__info">
                                                            <h2 class="card-cart__title">
                                                                AmeAppetite для мелких и средних пород собак со вкусом кролика
                                                            </h2>
                                                            <p class="card-cart__subtitle">
                                                                Арт. СХ-С-956027
                                                            </p>

                                                            <ul class="card-cart__types types">
                                                                <li class="types__item">
                                                                    <p class="types__value">
                                                                        600 г
                                                                    </p>
                                                                </li>
                                                                <li class="types__item">
                                                                    <p class="types__value">
                                                                        Для средних пород
                                                                    </p>
                                                                </li>
                                                                <li class="types__item">
                                                                    <p class="types__value">
                                                                        600 г
                                                                    </p>
                                                                </li>
                                                            </ul>

                                                            <ul class="card-cart__status product-status">
                                                                <li class="product-status__item product-status__item--red">
                                                                    <span class="product-status__icon">
                                                                        <svg class="icon icon--personal-action product-status__icon-mark">
                                                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-personal-action"></use>
                                                                        </svg>
                                                                    </span>
                                                                    <p class="product-status__name">
                                                                        Персональная акция
                                                                    </p>
                                                                </li>
                                                                <li class="product-status__item product-status__item--blue">
                                                                    <span class="product-status__icon">
                                                                        <svg class="icon icon--non-returnable product-status__icon-mark">
                                                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-non-returnable"></use>
                                                                        </svg>
                                                                    </span>
                                                                    <p class="product-status__name">
                                                                        Невозвратный товар
                                                                    </p>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </header>

                                                    <div class="card-cart__wrapper">

                                                        <div class="card-cart__block">
                                                            <div class="card-cart__counter">

                                                                <div class="quantity quantity--active" data-quantity>
                                                                    <div class="quantity__actions">
                                                                        <div class="quantity__decrease">
                                                                            <button type="button" class="button button--iconed button--covered button--square button--gray-red" data-quantity-decrease data-basket-item-count>
                                                                                <span class="button__icon button__icon--small">
                                                                                    <svg class="icon icon--minus">
                                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-minus"></use>
                                                                                    </svg>
                                                                                </span>
                                                                            </button>
                                                                        </div>

                                                                        <div class="quantity__total">
                                                                            <span
                                                                                class="quantity__total-sum"
                                                                                data-quantity-sum="15"
                                                                                data-quantity-min="1"
                                                                                data-quantity-max="15"
                                                                            >
                                                                                15
                                                                            </span>
                                                                        </div>

                                                                        <div class="quantity__increase">
                                                                            <button type="button" class="button button--iconed button--covered button--square button--gray-green" data-quantity-increase data-basket-item-count>
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

                                                            <div class="card-cart__price">
                                                                <p class="card-cart__price-item">
                                                                    <span class="card-cart__price-value">
                                                                        1000 ₽
                                                                    </span>
                                                                    <span class="card-cart__price-sufix">
                                                                        за шт
                                                                    </span>
                                                                </p>
                                                            </div>
                                                            
                                                            <div class="card-cart__total product-price">
                                                                <p class="product-price__item product-price__item--new">
                                                                    14 388 ₽
                                                                </p>
                                                                <p class="product-price__item product-price__item--old">
                                                                    18 462 ₽
                                                                </p>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="card-cart__actions">
                                                        <button type="button" class="card-cart__actions-item button button--ordinary button--iconed button--simple button--big button--red" data-card-favourite="heart" data-tippy-content="В&#160;избранное" data-tippy-placement="right-end">
                                                            <span class="button__icon">
                                                                <svg class="icon">
                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-heart" data-card-favourite-icon></use>
                                                                </svg>
                                                            </span>
                                                        </button>
                                                        <button type="button" class="card-cart__actions-item button button--ordinary button--iconed button--simple button--big button--red" data-remove-button data-tippy-content="Удалить" data-tippy-placement="right-end" data-basket-item-remove>
                                                            <span class="button__icon">
                                                                <svg class="icon">
                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-delete"></use>
                                                                </svg>
                                                            </span>
                                                        </button>
                                                    </div>
                                                </div>

                                            </article>

                                        </li>
                                        <li class="cards-cart__item" data-basket-item data-remove-item>

                                            <article class="card-cart">
                                                <a href="#" class="card-cart__link"></a>

                                                <div class="card-cart__inner">
                                                    <header class="card-cart__header">
                                                        <div class="card-cart__image">
                                                            <img src="/local/templates/.default/images/portage.png" alt="#" class="card-cart__image-picture">
                                                        </div>
                                                        <div class="card-cart__info">
                                                            <h2 class="card-cart__title">
                                                                AmeAppetite для мелких и средних пород собак со вкусом кролика
                                                            </h2>
                                                            <p class="card-cart__subtitle">
                                                                Арт. СХ-С-956027
                                                            </p>

                                                            <ul class="card-cart__types types">
                                                                <li class="types__item">
                                                                    <p class="types__value">
                                                                        600 г
                                                                    </p>
                                                                </li>
                                                                <li class="types__item">
                                                                    <p class="types__value">
                                                                        Для средних пород
                                                                    </p>
                                                                </li>
                                                                <li class="types__item">
                                                                    <p class="types__value">
                                                                        600 г
                                                                    </p>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </header>

                                                    <div class="card-cart__wrapper">

                                                        <div class="card-cart__block">
                                                            <div class="card-cart__counter">

                                                                <div class="quantity quantity--active" data-quantity>
                                                                    <div class="quantity__actions">
                                                                        <div class="quantity__decrease">
                                                                            <button type="button" class="button button--iconed button--covered button--square button--gray-red" data-quantity-decrease data-basket-item-count>
                                                                                <span class="button__icon button__icon--small">
                                                                                    <svg class="icon icon--minus">
                                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-minus"></use>
                                                                                    </svg>
                                                                                </span>
                                                                            </button>
                                                                        </div>

                                                                        <div class="quantity__total">
                                                                            <span
                                                                                class="quantity__total-sum"
                                                                                data-quantity-sum="1"
                                                                                data-quantity-min="1"
                                                                                data-quantity-max="15"
                                                                            >
                                                                                1
                                                                            </span>
                                                                        </div>

                                                                        <div class="quantity__increase">
                                                                            <button type="button" class="button button--iconed button--covered button--square button--gray-green" data-quantity-increase data-basket-item-count>
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

                                                            <div class="card-cart__price">
                                                                <p class="card-cart__price-item">
                                                                    <span class="card-cart__price-value">
                                                                        1542 ₽
                                                                    </span>
                                                                    <span class="card-cart__price-sufix">
                                                                        за шт
                                                                    </span>
                                                                </p>
                                                            </div>
                                                            
                                                            <div class="card-cart__total product-price">
                                                                <p class="product-price__item">
                                                                    18 462 ₽
                                                                </p>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="card-cart__actions">
                                                        <button type="button" class="card-cart__actions-item button button--ordinary button--iconed button--simple button--big button--red" data-card-favourite="heart" data-tippy-content="В&#160;избранное" data-tippy-placement="right-end">
                                                            <span class="button__icon">
                                                                <svg class="icon">
                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-heart" data-card-favourite-icon></use>
                                                                </svg>
                                                            </span>
                                                        </button>
                                                        <button type="button" class="card-cart__actions-item button button--ordinary button--iconed button--simple button--big button--red" data-remove-button data-tippy-content="Удалить" data-tippy-placement="right-end" data-basket-item-remove>
                                                            <span class="button__icon">
                                                                <svg class="icon">
                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-delete"></use>
                                                                </svg>
                                                            </span>
                                                        </button>
                                                    </div>
                                                </div>

                                            </article>

                                        </li>
                                        <li class="cards-cart__item" data-basket-item data-remove-item>

                                            <article class="card-cart">
                                                <a href="#" class="card-cart__link"></a>

                                                <div class="card-cart__inner">
                                                    <header class="card-cart__header">
                                                        <div class="card-cart__image">
                                                            <img src="/local/templates/.default/images/portage.png" alt="#" class="card-cart__image-picture">
                                                        </div>
                                                        <div class="card-cart__info">
                                                            <h2 class="card-cart__title">
                                                                AmeAppetite для мелких и средних пород собак со вкусом кролика
                                                            </h2>
                                                            <p class="card-cart__subtitle">
                                                                Арт. СХ-С-956027
                                                            </p>

                                                            <ul class="card-cart__types types">
                                                                <li class="types__item">
                                                                    <p class="types__value">
                                                                        600 г
                                                                    </p>
                                                                </li>
                                                                <li class="types__item">
                                                                    <p class="types__value">
                                                                        Для средних пород
                                                                    </p>
                                                                </li>
                                                                <li class="types__item">
                                                                    <p class="types__value">
                                                                        600 г
                                                                    </p>
                                                                </li>
                                                            </ul>

                                                            <ul class="card-cart__status product-status">
                                                                <li class="product-status__item product-status__item--red">
                                                                    <span class="product-status__icon">
                                                                        <svg class="icon icon--personal-action product-status__icon-mark">
                                                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-personal-action"></use>
                                                                        </svg>
                                                                    </span>
                                                                    <p class="product-status__name">
                                                                        Персональная акция
                                                                    </p>
                                                                </li>
                                                                <li class="product-status__item product-status__item--blue">
                                                                    <span class="product-status__icon">
                                                                        <svg class="icon icon--non-returnable product-status__icon-mark">
                                                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-non-returnable"></use>
                                                                        </svg>
                                                                    </span>
                                                                    <p class="product-status__name">
                                                                        Невозвратный товар
                                                                    </p>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </header>

                                                    <div class="card-cart__wrapper">

                                                        <div class="card-cart__block">
                                                            <div class="card-cart__counter">

                                                                <div class="quantity quantity--active" data-quantity>
                                                                    <div class="quantity__actions">
                                                                        <div class="quantity__decrease">
                                                                            <button type="button" class="button button--iconed button--covered button--square button--gray-red" data-quantity-decrease data-basket-item-count>
                                                                                <span class="button__icon button__icon--small">
                                                                                    <svg class="icon icon--minus">
                                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-minus"></use>
                                                                                    </svg>
                                                                                </span>
                                                                            </button>
                                                                        </div>

                                                                        <div class="quantity__total">
                                                                            <span
                                                                                class="quantity__total-sum"
                                                                                data-quantity-sum="1"
                                                                                data-quantity-min="1"
                                                                                data-quantity-max="15"
                                                                            >
                                                                                1
                                                                            </span>
                                                                        </div>

                                                                        <div class="quantity__increase">
                                                                            <button type="button" class="button button--iconed button--covered button--square button--gray-green" data-quantity-increase data-basket-item-count>
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

                                                            <div class="card-cart__price">
                                                                <p class="card-cart__price-item">
                                                                    <span class="card-cart__price-value">
                                                                        1542 ₽
                                                                    </span>
                                                                    <span class="card-cart__price-sufix">
                                                                        за шт
                                                                    </span>
                                                                </p>
                                                            </div>
                                                            
                                                            <div class="card-cart__total product-price">
                                                                <p class="product-price__item product-price__item--new">
                                                                    14 388 ₽
                                                                </p>
                                                                <p class="product-price__item product-price__item--old">
                                                                    18 462 ₽
                                                                </p>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="card-cart__actions">
                                                        <button type="button" class="card-cart__actions-item button button--ordinary button--iconed button--simple button--big button--red" data-card-favourite="heart" data-tippy-content="В&#160;избранное" data-tippy-placement="right-end">
                                                            <span class="button__icon">
                                                                <svg class="icon">
                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-heart" data-card-favourite-icon></use>
                                                                </svg>
                                                            </span>
                                                        </button>
                                                        <button type="button" class="card-cart__actions-item button button--ordinary button--iconed button--simple button--big button--red" data-remove-button data-tippy-content="Удалить" data-tippy-placement="right-end" data-basket-item-remove>
                                                            <span class="button__icon">
                                                                <svg class="icon">
                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-delete"></use>
                                                                </svg>
                                                            </span>
                                                        </button>
                                                    </div>
                                                </div>

                                            </article>

                                        </li>
                                        <li class="cards-cart__item" data-basket-item data-remove-item>

                                            <article class="card-cart">
                                                <a href="#" class="card-cart__link"></a>

                                                <div class="card-cart__inner">
                                                    <header class="card-cart__header">
                                                        <div class="card-cart__image">
                                                            <img src="/local/templates/.default/images/portage.png" alt="#" class="card-cart__image-picture">
                                                        </div>
                                                        <div class="card-cart__info">
                                                            <h2 class="card-cart__title">
                                                                AmeAppetite для мелких и средних пород собак со вкусом кролика
                                                            </h2>
                                                            <p class="card-cart__subtitle">
                                                                Арт. СХ-С-956027
                                                            </p>

                                                            <ul class="card-cart__types types">
                                                                <li class="types__item">
                                                                    <p class="types__value">
                                                                        600 г
                                                                    </p>
                                                                </li>
                                                                <li class="types__item">
                                                                    <p class="types__value">
                                                                        Для средних пород
                                                                    </p>
                                                                </li>
                                                                <li class="types__item">
                                                                    <p class="types__value">
                                                                        600 г
                                                                    </p>
                                                                </li>
                                                            </ul>

                                                            <ul class="card-cart__status product-status">
                                                                <li class="product-status__item product-status__item--red">
                                                                    <span class="product-status__icon">
                                                                        <svg class="icon icon--personal-action product-status__icon-mark">
                                                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-personal-action"></use>
                                                                        </svg>
                                                                    </span>
                                                                    <p class="product-status__name">
                                                                        Персональная акция
                                                                    </p>
                                                                </li>
                                                                <li class="product-status__item product-status__item--blue">
                                                                    <span class="product-status__icon">
                                                                        <svg class="icon icon--non-returnable product-status__icon-mark">
                                                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-non-returnable"></use>
                                                                        </svg>
                                                                    </span>
                                                                    <p class="product-status__name">
                                                                        Невозвратный товар
                                                                    </p>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </header>

                                                    <div class="card-cart__wrapper">

                                                        <div class="card-cart__block">
                                                            <div class="card-cart__counter">

                                                                <div class="quantity quantity--active" data-quantity>
                                                                    <div class="quantity__actions">
                                                                        <div class="quantity__decrease">
                                                                            <button type="button" class="button button--iconed button--covered button--square button--gray-red" data-quantity-decrease data-basket-item-count>
                                                                                <span class="button__icon button__icon--small">
                                                                                    <svg class="icon icon--minus">
                                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-minus"></use>
                                                                                    </svg>
                                                                                </span>
                                                                            </button>
                                                                        </div>

                                                                        <div class="quantity__total">
                                                                            <span
                                                                                class="quantity__total-sum"
                                                                                data-quantity-sum="1"
                                                                                data-quantity-min="1"
                                                                                data-quantity-max="15"
                                                                            >
                                                                                1
                                                                            </span>
                                                                        </div>

                                                                        <div class="quantity__increase">
                                                                            <button type="button" class="button button--iconed button--covered button--square button--gray-green" data-quantity-increase data-basket-item-count>
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

                                                            <div class="card-cart__price">
                                                                <p class="card-cart__price-item">
                                                                    <span class="card-cart__price-value">
                                                                        1542 ₽
                                                                    </span>
                                                                    <span class="card-cart__price-sufix">
                                                                        за шт
                                                                    </span>
                                                                </p>
                                                            </div>
                                                            
                                                            <div class="card-cart__total product-price">
                                                                <p class="product-price__item product-price__item--new">
                                                                    14 388 ₽
                                                                </p>
                                                                <p class="product-price__item product-price__item--old">
                                                                    18 462 ₽
                                                                </p>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="card-cart__actions">
                                                        <button type="button" class="card-cart__actions-item button button--ordinary button--iconed button--simple button--big button--red" data-card-favourite="heart" data-tippy-content="В&#160;избранное" data-tippy-placement="right-end">
                                                            <span class="button__icon">
                                                                <svg class="icon">
                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-heart" data-card-favourite-icon></use>
                                                                </svg>
                                                            </span>
                                                        </button>
                                                        <button type="button" class="card-cart__actions-item button button--ordinary button--iconed button--simple button--big button--red" data-remove-button data-tippy-content="Удалить" data-tippy-placement="right-end" data-basket-item-remove>
                                                            <span class="button__icon">
                                                                <svg class="icon">
                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-delete"></use>
                                                                </svg>
                                                            </span>
                                                        </button>
                                                    </div>
                                                </div>

                                            </article>

                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="basket__col basket__col--limited">
                                <div class="basket__progress">
                                    <div class="card-progress card-progress--mini">
                                        <div class="card-progress__inner">
                                            <p class="card-progress__title">
                                                Повышения уровня по личным покупкам
                                            </p>
                                            <div class="card-progress__mark">
                                                <svg class="card-progress__icon icon icon--cat-serious">
                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-cat-serious"></use>
                                                </svg>
                                                <span class="card-progress__mark-text">
                                                    Осталось еще немного
                                                </span>
                                            </div>
                                            <div class="card-progress__wrapper">
                                                <div class="card-progress__progress progress-bar">
                                                    <div style="width: 80%;" class="progress-bar__filler progress-bar__filler--red"></div>
                                                </div>
                                                <div class="card-progress__bottom">
                                                    <div class="card-progress__amount amount">
                                                        <p class="amount__target amount__target--red">
                                                            124 000 ₽
                                                        </p>
                                                        <p class="amount__total">
                                                            из 175 000 ₽
                                                        </p>
                                                    </div>
    
                                                    <div class="card-progress__status">
                                                        <p class="card-progress__text">
                                                            Осталось
                                                        </p>
                                                        <p class="card-progress__text">
                                                            56 000 ₽
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-progress__warning warning">
                                                <div class="warning__mark">
                                                    <button type="button" 
                                                        class="button button--iconed button--simple button--red"
                                                        data-fancybox data-modal-type="modal"
                                                        data-src="#conditions"
                                                    >
                                                        <span class="button__icon">
                                                            <svg class="icon icon--basket warning__icon">
                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-attention"></use>
                                                            </svg>
                                                        </span>
                                                    </button>
                                                </div>
                                                <p class="warning__text">
                                                    Условия повышения уровня
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <article id="conditions" class="modal modal--full box box--circle box--hanging" style="display: none">
                                        <div class="modal__content">
                                            <header class="modal__section modal__section--header">
                                                <p class="heading heading--average">Условия поддержания уровня</p>
                                            </header>

                                            <section class="modal__section modal__section--content">
                                                <div class="conditions">
                                                    <div class="conditions__block">
                                                        <h5 class="conditions__title">Условия поддержания уровня для К1:</h5>

                                                        <ul class="conditions__list">
                                                            <li class="conditions__item">
                                                                Совершение личных покупок на общую сумму 5000 рублей за период в 3 последовательных месяца (квартал);
                                                            </li>
                                                        </ul>
                                                    </div>

                                                    <div class="conditions__block">
                                                        <h5 class="conditions__title">Условия поддержания уровня для К2 (единовременное соблюдение всех условий):</h5>

                                                        <ul class="conditions__list">
                                                            <li class="conditions__item">
                                                                Совершение личных покупок на сумму 5000 рублей каждый месяц за период в 3 последовательных месяца (квартал);
                                                            </li>

                                                            <li class="conditions__item">
                                                                Совершение групповых покупок на сумму 7000 рублей каждый месяц за период в 3 последовательных месяца (квартал);
                                                            </li>
                                                        </ul>

                                                        <p class="conditions__text">Переход на уровень К2 возможен в течение 3 последовательных месяцев при соблюдении условий перехода на уровень К2;
                                                        </p>
                                                        <p class="conditions__text">При несоблюдении условий поддержания уровня К2 будет выполняться переход на уровень К1.</p>
                                                    </div>

                                                    <div class="conditions__block">
                                                        <h5 class="conditions__title">Условия поддержания уровня для К3 (единовременное соблюдение всех условий):</h5>

                                                        <ul class="conditions__list">
                                                            <li class="conditions__item">
                                                                Совершение личных покупок на сумму 10000 рублей каждый месяц за период в 3 последовательных месяца (квартал);
                                                            </li>

                                                            <li class="conditions__item">
                                                                Совершение групповых покупок на сумму 20000 рублей каждый месяц за период в 3 последовательных месяца (квартал);
                                                            </li>
                                                        </ul>

                                                        <p class="conditions__text">Переход на уровень К3 возможен в течение 6 последовательных месяцев при соблюдении условий перехода на уровень К3;

                                                        </p>
                                                        <p class="conditions__text">При несоблюдении условий поддержания уровня К3 будет выполняться переход на уровень К2.</p>
                                                    </div>
                                                </div>
                                            </section>
                                        </div>
                                    </article>
                                </div>
                                <div class="basket__order">
                                    <div class="basket-card" data-basket-card>
                                        <div class="basket-card__title">Ваш заказ</div>

                                        <div class="basket-card__wrapper">
                                            <div class="basket-card__list">
                                                <div class="basket-card__item">
                                                    <span class="basket-card__text basket-card__text--gray">Количество товаров</span>
                                                    <span class="basket-card__total" data-basket-product-total>0</span> 
                                                </div>
                                                <div class="basket-card__item">
                                                    <span class="basket-card__text basket-card__text--gray">Сумма НДС</span>
                                                    <span class="basket-card__total" data-basket-product-nds>0 ₽</span> 
                                                </div>
                                                <div class="basket-card__item">
                                                    <span class="basket-card__text">Сумма заказа</span>
                                                    <span class="basket-card__total" data-basket-order-amount>0 ₽</span> 
                                                </div>
                                                <div class="basket-card__item">
                                                    <span class="basket-card__text basket-card__text--green">Экономия</span>
                                                    <span class="basket-card__total basket-card__total--green" data-basket-economy>0 ₽</span> 
                                                </div>
                                                <div class="basket-card__bonus">
                                                    <div class="basket-card__bonus-wrapper">
                                                        <div class="basket-card__bonus-inner">
                                                            <span class="basket-card__bonus-text">Сумма ББ на счету</span>
                                                            <span class="basket-card__bonus-count" data-basket-bonus-balance>7 216 ББ</span>
                                                        </div>
                                                        <div class="basket-card__bonus-inner">
                                                            <span class="basket-card__bonus-text">ББ за заказ</span>
                                                            <span class="basket-card__bonus-count">356 ББ</span>
                                                        </div>

                                                        <div class="form__row">
                                                            <div class="form__col">
                                                                <div class="form__field">
                                                                    <div class="form__field-block form__field-block--input">
                                                                        <div class="input input--small input--buttoned input--placeholder" data-basket-bonus-input>
                                                                            <input type="number" class="input__control" name="text" id="text3" value="">
                                                                            <span class="input__placeholder">Сколько баллов списать</span>
                                                                            <button type="button" class="input__button button button--iconed button--covered button--rounded button--big button--dark" data-basket-bonus-accept>
                                                                                <span class="button__icon button__icon--small">
                                                                                    <svg class="icon icon--arrow">
                                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-right-light"></use>
                                                                                    </svg>
                                                                                </span>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="basket-card__bonus-error">
                                                            Баллами можно оплатить до 99% от итоговой стоимости в корзине. Пожалуйста, уменьшите количество списываемых баллов
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="basket-card__item">
                                                    <span class="basket-card__text basket-card__text--bold">Итого к оплате</span>
                                                    <span class="basket-card__total basket-card__total--bold" data-basket-total>0 ₽</span> 
                                                </div>
                                            </div>
                                            <button type="button" class="basket-card__button button button--rounded button--covered button--green button--full">
                                                Оформить заказ
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <!--content-->

        <!--Футер-->
        <? include_once("../include/footer.php"); ?>
        <!--/Футер-->

        <script src="/local/templates/.default/js/script.js"></script>
    </body>

</html>
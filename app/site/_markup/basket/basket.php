<!DOCTYPE html>
<html lang="ru">
    <head>
        <title>Детальная страница товара</title>

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
                                <div class="cards-cart basket__cart">
                                    <ul class="cards-cart__list basket__list">
                                    <li class="cards-cart__item basket__item" data-remove-item>

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
                                                                        <button type="button" class="button button--iconed button--covered button--square button--gray-red" data-quantity-decrease>
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
                                                                        <button type="button" class="button button--iconed button--covered button--square button--gray-green" data-quantity-increase>
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
                                                    <button type="button" class="card-cart__actions-item button button--ordinary button--iconed button--simple button--big button--red" data-remove-button data-tippy-content="Удалить" data-tippy-placement="right-end">
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
                                    <li class="cards-cart__item" data-remove-item>

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
                                                                        <button type="button" class="button button--iconed button--covered button--square button--gray-red" data-quantity-decrease>
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
                                                                        <button type="button" class="button button--iconed button--covered button--square button--gray-green" data-quantity-increase>
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
                                                    <button type="button" class="card-cart__actions-item button button--ordinary button--iconed button--simple button--big button--red" data-remove-button data-tippy-content="Удалить" data-tippy-placement="right-end">
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
                                    <li class="cards-cart__item" data-remove-item>

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
                                                                        <button type="button" class="button button--iconed button--covered button--square button--gray-red" data-quantity-decrease>
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
                                                                        <button type="button" class="button button--iconed button--covered button--square button--gray-green" data-quantity-increase>
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
                                                    <button type="button" class="card-cart__actions-item button button--ordinary button--iconed button--simple button--big button--red" data-remove-button data-tippy-content="Удалить" data-tippy-placement="right-end">
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
                                    <li class="cards-cart__item" data-remove-item>

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
                                                                        <button type="button" class="button button--iconed button--covered button--square button--gray-red" data-quantity-decrease>
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
                                                                        <button type="button" class="button button--iconed button--covered button--square button--gray-green" data-quantity-increase>
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
                                                    <button type="button" class="card-cart__actions-item button button--ordinary button--iconed button--simple button--big button--red" data-remove-button data-tippy-content="Удалить" data-tippy-placement="right-end">
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
                                    <div class="card-progress">
                                        <div class="card-progress__inner">
                                            <p class="card-progress__title">
                                                Повышения уровня по групповым покупкам
                                            </p>
                                            <div class="card-progress__mark">
                                                <svg class="card-progress__icon icon icon--cat-happy">
                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-cat-happy"></use>
                                                </svg>
                                                <span class="card-progress__mark-text">
                                                    Просто фантастика
                                                </span>
                                            </div>
                                            <div class="card-progress__wrapper">
                                                <div class="card-progress__progress progress-bar">
                                                    <div style="width: 100%;" class="progress-bar__filler progress-bar__filler--green"></div>
                                                </div>
                                                <div class="card-progress__bottom">
                                                    <div class="card-progress__amount amount">
                                                        <p class="amount__target amount__target--green">
                                                            179 000 ₽
                                                        </p>
                                                        <p class="amount__total">
                                                            из 175 000 ₽
                                                        </p>
                                                    </div>

                                                    <div class="card-progress__status">
                                                        <p class="card-progress__text">
                                                            Перевыполнено 
                                                        </p>
                                                        <p class="card-progress__text">
                                                            на 4 000 ₽
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="basket__order">
                                    <div class="basket-card">
                                        <div class="basket-card__title">Ваш заказ</div>
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
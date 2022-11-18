<!DOCTYPE html>
<html lang="ru">
    <head>
        <title>Личный кабинет</title>

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
                <main class="page__private private">

                    <h1 class="page__heading">Личный кабинет</h1>

                    <div class="content__main">
                        <div class="private__row">
                            <div class="private__col private__col--limited">
                                <nav class="private__menu menu menu--private">
                                    <ul class="menu__list">
                                        <li class="menu__item">
                                            <a href="#" class="menu__link">
                                                <span class="menu__icon">
                                                    <svg class="icon icon--profile gui__icon">
                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-profile"></use>
                                                    </svg>
                                                </span>
                                                <span class="menu__text">
                                                    Профиль
                                                </span>
                                            </a>
                                        </li>

                                        <li class="menu__item  menu__item--active">
                                            <a href="#" class="menu__link">
                                                <span class="menu__icon menu__icon--active">
                                                    <svg class="icon icon--receipts gui__icon">
                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-receipts"></use>
                                                    </svg>
                                                </span>
                                                <span class="menu__text">
                                                    История заказов
                                                </span>
                                            </a>
                                        </li>

                                        <li class="menu__item">
                                            <a href="#" class="menu__link">
                                                <span class="menu__icon">
                                                    <svg class="icon icon--calculator gui__icon">
                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-calculator"></use>
                                                    </svg>
                                                </span>
                                                <span class="menu__text">
                                                    Калькулятор доходности
                                                </span>
                                            </a>
                                        </li>

                                        <li class="menu__item">
                                            <a href="#" class="menu__link">
                                                <span class="menu__icon">
                                                    <svg class="icon icon--chart-square gui__icon">
                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-chart-square"></use>
                                                    </svg>
                                                </span>
                                                <span class="menu__text">
                                                    Отчетность по объемам продаж
                                                </span>
                                            </a>
                                        </li>

                                        <li class="menu__item">
                                            <a href="#" class="menu__link">
                                                <span class="menu__icon">
                                                    <svg class="icon icon--notification gui__icon">
                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-notification"></use>
                                                    </svg>
                                                </span>
                                                <span class="menu__text">
                                                    Уведомления
                                                </span>
                                                <span class="menu__counter">10</span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>

                            <div class="private__col private__col--full">
                                <div class="orders">
                                    <div class="content__filter filter filter--content">
                                        <form class="form form--wraped form--separated form--wraped-small">
                                            <div class="form__row">
                                                <div class="form__col">
                                                    <div class="form__field">
                                                        <div class="form__field-block form__field-block--input">
                                                            <div class="input input--middle input--squared input--buttoned">
                                                                <input type="text" class="input__control" name="text" id="text5" placeholder="Я ищу...">
                                                                <button type="button" class="input__button input__button--search button button--iconed button--covered button--square button--dark">
                                                                    <span class="button__icon button__icon--medium">
                                                                        <svg class="icon icon--search">
                                                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-search"></use>
                                                                        </svg>
                                                                    </span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form__row form__row--merged">
                                                <div class="form__col form__col--definite">
                                                    <div class="form__field">
                                                        <div class="form__field-block form__field-block--input">
                                                            <div class="form__control">
                                                                <div class="filter__select select select--mitigate select--small select--squared select--multiple" data-select>
                                                                    <select class="select__control" name="select2" data-select-control data-placeholder="Статус заказа" multiple>
                                                                        <option><!-- пустой option для placeholder --></option>
                                                                        <option value="1">Размещен</option>
                                                                        <option value="2">Отменен</option>
                                                                        <option value="3">Доставлен</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form__col form__col--definite">
                                                    <div class="form__field">
                                                        <div class="form__field-block form__field-block--input">
                                                            <div class="form__control">
                                                                <div class="filter__select select select--mitigate select--small select--squared" data-select>
                                                                    <select class="select__control" name="select2" data-select-control data-placeholder="Статус оплаты">
                                                                        <option><!-- пустой option для placeholder --></option>
                                                                        <option value="1">Оплачен</option>
                                                                        <option value="2">Не оплачен</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form__col form__col--right form__col--definite">
                                                    <div class="form__field">
                                                        <div class="form__field-block form__field-block--input">
                                                            <div class="form__control">
                                                                <div class="filter__sort select select--small select--sorting select--borderless" data-select>
                                                                    <select class="select__control" name="select5" id="sort" data-select-control data-placeholder="Сортировка">
                                                                        <option><!-- пустой option для placeholder --></option>
                                                                        <option value="1">По дате создания</option>
                                                                        <option value="2">По сумме заказа</option>
                                                                    </select>
                        
                                                                    <button type="button" class="input__button input__button--select button button--iconed button--covered button--square button--dark">
                                                                        <span class="button__icon button__icon--medium">
                                                                            <svg class="icon icon--sort">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-sort"></use>
                                                                            </svg>
                                                                        </span>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                        <section class="orders__section">
                                            <div class="cards-order">
                                                <ul class="cards-order__list">
                                                    <li class="cards-order__item">
                                                        <article class="card-order card-order--green">
                                                            <div class="card-order__inner">
                                                                <header class="card-order__header">
                                                                    <ul class="card-order__list">
                                                                        <li class="card-order__item card-order__item--inlined">
                                                                            <h2 class="card-order__title">
                                                                                Заказ от 02.08.2022
                                                                            </h2>
                                                                            <p class="card-order__subtitle">
                                                                                №543268
                                                                            </p>
                                                                        </li>

                                                                        <li class="card-order__item card-order__item--span">
                                                                            <div class="info-slot info-slot--inlined">
                                                                                <p class="info-slot__name">
                                                                                    Кем заказан
                                                                                </p>
                                                                                <p class="info-slot__value">
                                                                                    Дубровская А.Ф.
                                                                                </p>
                                                                            </div>
                                                                        </li>

                                                                        <li class="card-order__item card-order__item--delivery">
                                                                            <div class="info-slot">
                                                                                <p class="info-slot__value info-slot__value--marked">
                                                                                    Доставлен
                                                                                </p>
                                                                            </div>
                                                                        </li>

                                                                        <li class="card-order__item card-order__item--pay">
                                                                            <div class="info-slot info-slot--pay">
                                                                                <p class="info-slot__name">
                                                                                    Статус оплаты
                                                                                </p>
                                                                                <p class="info-slot__value info-slot__value--icon">
                                                                                    <span class="info-slot__icon">
                                                                                        <svg class="icon icon--credit-not-paid info-slot__icon-mark">
                                                                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-credit-paid"></use>
                                                                                        </svg>
                                                                                    </span>
                                                                                    Оплачен
                                                                                </p>
                                                                            </div>
                                                                        </li>

                                                                        <li class="card-order__item">
                                                                            <div class="card-order__price price">
                                                                                <div class="price__calculation price__calculation--columned">
                                                                                    <p class="price__calculation-total price__calculation-total--has-icon">
                                                                                        <span class="price__calculation-picture">
                                                                                            <svg class="icon icon--cart-card price__calculation-icon tooltip" data-tippy-content="применена персональная акция" data-tippy-placement="bottom-start">
                                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-cart-card"></use>
                                                                                            </svg>
                                                                                        </span>
                                                                                        <span class="price__calculation-value">
                                                                                            11 904 ₽
                                                                                        </span>
                                                                                    </p>
                                                                                    <p class="price__calculation-accumulation">119 ББ</p>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                    </ul>
                                                                </header>

                                                                <div class="card-order__content">
                                                                    <div class="accordeon__item box" data-accordeon>
                                                                        <div class="accordeon__header" data-accordeon-toggle>
                                                                            <h6 class="accordeon__title">Состав заказа</h6>

                                                                            <button type="button" class="accordeon__toggle button button--circular button--mini button--covered button--red-white">
                                                                                <span class="accordeon__toggle-icon button__icon">
                                                                                    <svg class="icon icon--arrow-down">
                                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-down"></use>
                                                                                    </svg>
                                                                                </span>
                                                                            </button>

                                                                        </div>

                                                                        <div class="accordeon__body" data-accordeon-content>
                                                                            
                                                                            <div class="table-list">
                                                                                <div class="table-list__head">
                                                                                    <div class="table-list__cell">
                                                                                        <p class="table-list__name">
                                                                                            Наименование
                                                                                        </p>
                                                                                    </div>
                                                                                    <div class="table-list__cell table-list__cell--desktop">
                                                                                        <p class="table-list__name">
                                                                                            Цена
                                                                                        </p>
                                                                                    </div>
                                                                                    <div class="table-list__cell table-list__cell--desktop">
                                                                                        <p class="table-list__name">
                                                                                            Количество
                                                                                        </p>
                                                                                    </div>
                                                                                    <div class="table-list__cell table-list__cell--desktop">
                                                                                        <p class="table-list__name">
                                                                                            Сумма баллов
                                                                                        </p>
                                                                                    </div>
                                                                                </div>

                                                                                <ul class="table-list__list">

                                                                                    <li class="table-list__item">

                                                                                        <article class="product-line">
                                                                                            <div class="product-line__inner">
                                                                                                <div class="product-line__info">
                                                                                                    <div class="product-line__image">
                                                                                                        <img src="/local/templates/.default/images/portage.png" alt="#" class="product-line__image-picture">
                                                                                                    </div>
                                                                                                    <div class="product-line__wrapper">
                                                                                                        <h2 class="product-line__title">
                                                                                                            AmeAppetite для мелких и средних пород собак со вкусом кролика
                                                                                                        </h2>
                                                                                                        <p class="product-line__subtitle">
                                                                                                            Арт. СХ-С-956027
                                                                                                        </p>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="product-line__characteristic">
                                                                                                    <ul class="product-line__list">
                                                                                                        <li class="product-line__params product-line__params--span">
                                                                                                            <p class="product-line__text">
                                                                                                                <span class="product-line__params-name">
                                                                                                                    Цена:
                                                                                                                </span>
                                                                                                                <span class="product-line__params-value">
                                                                                                                    1 097 ₽
                                                                                                                </span>
                                                                                                            </p>
                                                                                                        </li> 
                                                                                                        <li class="product-line__params">
                                                                                                            <p class="product-line__text">
                                                                                                                <span class="product-line__params-name">
                                                                                                                    Количество:
                                                                                                                </span>
                                                                                                                <span class="product-line__params-value">
                                                                                                                    4
                                                                                                                </span>
                                                                                                            </p>
                                                                                                        </li> 
                                                                                                        <li class="product-line__params product-line__params--bold">
                                                                                                            <p class="product-line__text">
                                                                                                                <span class="product-line__params-name">
                                                                                                                    Сумма баллов:
                                                                                                                </span>
                                                                                                                <span class="product-line__params-value">
                                                                                                                    436 ББ
                                                                                                                </span>
                                                                                                            </p>
                                                                                                        </li> 
                                                                                                    </ul>
                                                                                                </div>
                                                                                            </div>
                                                                                        </article>

                                                                                    </li>
                                                                                    <li class="table-list__item">

                                                                                        <article class="product-line">
                                                                                            <div class="product-line__inner">
                                                                                                <div class="product-line__info">
                                                                                                    <div class="product-line__image">
                                                                                                        <img src="/local/templates/.default/images/portage.png" alt="#" class="product-line__image-picture">
                                                                                                    </div>
                                                                                                    <div class="product-line__wrapper">
                                                                                                        <h2 class="product-line__title">
                                                                                                            AmeAppetite для мелких и средних пород собак со вкусом кролика
                                                                                                        </h2>
                                                                                                        <p class="product-line__subtitle">
                                                                                                            Арт. СХ-С-956027
                                                                                                        </p>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="product-line__characteristic">
                                                                                                    <ul class="product-line__list">
                                                                                                        <li class="product-line__params product-line__params--span">
                                                                                                            <p class="product-line__text">
                                                                                                                <span class="product-line__params-name">
                                                                                                                    Цена:
                                                                                                                </span>
                                                                                                                <span class="product-line__params-value">
                                                                                                                    1 097 ₽
                                                                                                                </span>
                                                                                                            </p>
                                                                                                        </li> 
                                                                                                        <li class="product-line__params">
                                                                                                            <p class="product-line__text">
                                                                                                                <span class="product-line__params-name">
                                                                                                                    Количество:
                                                                                                                </span>
                                                                                                                <span class="product-line__params-value">
                                                                                                                    4
                                                                                                                </span>
                                                                                                            </p>
                                                                                                        </li> 
                                                                                                        <li class="product-line__params product-line__params--bold">
                                                                                                            <p class="product-line__text">
                                                                                                                <span class="product-line__params-name">
                                                                                                                    Сумма баллов:
                                                                                                                </span>
                                                                                                                <span class="product-line__params-value">
                                                                                                                    436 ББ
                                                                                                                </span>
                                                                                                            </p>
                                                                                                        </li> 
                                                                                                    </ul>
                                                                                                </div>
                                                                                            </div>
                                                                                        </article>

                                                                                    </li>
                                                                                    <li class="table-list__item">

                                                                                        <article class="product-line">
                                                                                            <div class="product-line__inner">
                                                                                                <div class="product-line__info">
                                                                                                    <div class="product-line__image">
                                                                                                        <img src="/local/templates/.default/images/portage.png" alt="#" class="product-line__image-picture">
                                                                                                    </div>
                                                                                                    <div class="product-line__wrapper">
                                                                                                        <h2 class="product-line__title">
                                                                                                            AmeAppetite для мелких и средних пород собак со вкусом кролика
                                                                                                        </h2>
                                                                                                        <p class="product-line__subtitle">
                                                                                                            Арт. СХ-С-956027
                                                                                                        </p>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="product-line__characteristic">
                                                                                                    <ul class="product-line__list">
                                                                                                        <li class="product-line__params product-line__params--span">
                                                                                                            <p class="product-line__text">
                                                                                                                <span class="product-line__params-name">
                                                                                                                    Цена:
                                                                                                                </span>
                                                                                                                <span class="product-line__params-value">
                                                                                                                    1 097 ₽
                                                                                                                </span>
                                                                                                            </p>
                                                                                                        </li> 
                                                                                                        <li class="product-line__params">
                                                                                                            <p class="product-line__text">
                                                                                                                <span class="product-line__params-name">
                                                                                                                    Количество:
                                                                                                                </span>
                                                                                                                <span class="product-line__params-value">
                                                                                                                    4
                                                                                                                </span>
                                                                                                            </p>
                                                                                                        </li> 
                                                                                                        <li class="product-line__params product-line__params--bold">
                                                                                                            <p class="product-line__text">
                                                                                                                <span class="product-line__params-name">
                                                                                                                    Сумма баллов:
                                                                                                                </span>
                                                                                                                <span class="product-line__params-value">
                                                                                                                    436 ББ
                                                                                                                </span>
                                                                                                            </p>
                                                                                                        </li> 
                                                                                                    </ul>
                                                                                                </div>
                                                                                            </div>
                                                                                        </article>

                                                                                    </li>

                                                                                </ul>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </article>
                                                    </li>

                                                    <li class="cards-order__item">
                                                        <article class="card-order card-order--blue">
                                                            <div class="card-order__inner">
                                                                <header class="card-order__header">
                                                                    <ul class="card-order__list">
                                                                        <li class="card-order__item card-order__item--inlined">
                                                                            <h2 class="card-order__title">
                                                                                Заказ от 02.08.2022
                                                                            </h2>
                                                                            <p class="card-order__subtitle">
                                                                                №543268
                                                                            </p>
                                                                        </li>

                                                                        <li class="card-order__item card-order__item--span">
                                                                            <div class="info-slot info-slot--inlined">
                                                                                <p class="info-slot__name">
                                                                                    Кем заказан
                                                                                </p>
                                                                                <p class="info-slot__value">
                                                                                    Дубровская А.Ф.
                                                                                </p>
                                                                            </div>
                                                                        </li>

                                                                        <li class="card-order__item card-order__item--delivery">
                                                                            <div class="info-slot">
                                                                                <p class="info-slot__value info-slot__value--marked">
                                                                                    Доставлен
                                                                                </p>
                                                                            </div>
                                                                        </li>

                                                                        <li class="card-order__item card-order__item--pay">
                                                                            <div class="info-slot info-slot--pay">
                                                                                <p class="info-slot__name">
                                                                                    Статус оплаты
                                                                                </p>
                                                                                <p class="info-slot__value info-slot__value--icon">
                                                                                    <span class="info-slot__icon">
                                                                                        <svg class="icon icon--credit-not-paid info-slot__icon-mark">
                                                                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-credit-paid"></use>
                                                                                        </svg>
                                                                                    </span>
                                                                                    Оплачен
                                                                                </p>
                                                                            </div>
                                                                        </li>

                                                                        <li class="card-order__item">
                                                                            <div class="card-order__price price">
                                                                                <div class="price__calculation price__calculation--columned">
                                                                                    <p class="price__calculation-total price__calculation-total--has-icon">
                                                                                        <span class="price__calculation-picture">
                                                                                            <svg class="icon icon--cart-card price__calculation-icon tooltip" data-tippy-content="применена персональная акция" data-tippy-placement="bottom-start">
                                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-cart-card"></use>
                                                                                            </svg>
                                                                                        </span>
                                                                                        <span class="price__calculation-value">
                                                                                            11 904 ₽
                                                                                        </span>
                                                                                    </p>
                                                                                    <p class="price__calculation-accumulation">119 ББ</p>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                    </ul>
                                                                </header>

                                                                <div class="card-order__content">
                                                                    <div class="accordeon__item box" data-accordeon>
                                                                        <div class="accordeon__header" data-accordeon-toggle>
                                                                            <h6 class="accordeon__title">Состав заказа</h6>

                                                                            <button type="button" class="accordeon__toggle button button--circular button--mini button--covered button--red-white">
                                                                                <span class="accordeon__toggle-icon button__icon">
                                                                                    <svg class="icon icon--arrow-down">
                                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-down"></use>
                                                                                    </svg>
                                                                                </span>
                                                                            </button>

                                                                        </div>

                                                                        <div class="accordeon__body" data-accordeon-content>
                                                                            
                                                                            <div class="table-list">
                                                                                <div class="table-list__head">
                                                                                    <div class="table-list__cell">
                                                                                        <p class="table-list__name">
                                                                                            Наименование
                                                                                        </p>
                                                                                    </div>
                                                                                    <div class="table-list__cell table-list__cell--desktop">
                                                                                        <p class="table-list__name">
                                                                                            Цена
                                                                                        </p>
                                                                                    </div>
                                                                                    <div class="table-list__cell table-list__cell--desktop">
                                                                                        <p class="table-list__name">
                                                                                            Количество
                                                                                        </p>
                                                                                    </div>
                                                                                    <div class="table-list__cell table-list__cell--desktop">
                                                                                        <p class="table-list__name">
                                                                                            Сумма баллов
                                                                                        </p>
                                                                                    </div>
                                                                                </div>

                                                                                <ul class="table-list__list">

                                                                                    <li class="table-list__item">

                                                                                        <article class="product-line">
                                                                                            <div class="product-line__inner">
                                                                                                <div class="product-line__info">
                                                                                                    <div class="product-line__image">
                                                                                                        <img src="/local/templates/.default/images/portage.png" alt="#" class="product-line__image-picture">
                                                                                                    </div>
                                                                                                    <div class="product-line__wrapper">
                                                                                                        <h2 class="product-line__title">
                                                                                                            AmeAppetite для мелких и средних пород собак со вкусом кролика
                                                                                                        </h2>
                                                                                                        <p class="product-line__subtitle">
                                                                                                            Арт. СХ-С-956027
                                                                                                        </p>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="product-line__characteristic">
                                                                                                    <ul class="product-line__list">
                                                                                                        <li class="product-line__params product-line__params--span">
                                                                                                            <p class="product-line__text">
                                                                                                                <span class="product-line__params-name">
                                                                                                                    Цена:
                                                                                                                </span>
                                                                                                                <span class="product-line__params-value">
                                                                                                                    1 097 ₽
                                                                                                                </span>
                                                                                                            </p>
                                                                                                        </li> 
                                                                                                        <li class="product-line__params">
                                                                                                            <p class="product-line__text">
                                                                                                                <span class="product-line__params-name">
                                                                                                                    Количество:
                                                                                                                </span>
                                                                                                                <span class="product-line__params-value">
                                                                                                                    4
                                                                                                                </span>
                                                                                                            </p>
                                                                                                        </li> 
                                                                                                        <li class="product-line__params product-line__params--bold">
                                                                                                            <p class="product-line__text">
                                                                                                                <span class="product-line__params-name">
                                                                                                                    Сумма баллов:
                                                                                                                </span>
                                                                                                                <span class="product-line__params-value">
                                                                                                                    436 ББ
                                                                                                                </span>
                                                                                                            </p>
                                                                                                        </li> 
                                                                                                    </ul>
                                                                                                </div>
                                                                                            </div>
                                                                                        </article>

                                                                                    </li>
                                                                                    <li class="table-list__item">

                                                                                        <article class="product-line">
                                                                                            <div class="product-line__inner">
                                                                                                <div class="product-line__info">
                                                                                                    <div class="product-line__image">
                                                                                                        <img src="/local/templates/.default/images/portage.png" alt="#" class="product-line__image-picture">
                                                                                                    </div>
                                                                                                    <div class="product-line__wrapper">
                                                                                                        <h2 class="product-line__title">
                                                                                                            AmeAppetite для мелких и средних пород собак со вкусом кролика
                                                                                                        </h2>
                                                                                                        <p class="product-line__subtitle">
                                                                                                            Арт. СХ-С-956027
                                                                                                        </p>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="product-line__characteristic">
                                                                                                    <ul class="product-line__list">
                                                                                                        <li class="product-line__params product-line__params--span">
                                                                                                            <p class="product-line__text">
                                                                                                                <span class="product-line__params-name">
                                                                                                                    Цена:
                                                                                                                </span>
                                                                                                                <span class="product-line__params-value">
                                                                                                                    1 097 ₽
                                                                                                                </span>
                                                                                                            </p>
                                                                                                        </li> 
                                                                                                        <li class="product-line__params">
                                                                                                            <p class="product-line__text">
                                                                                                                <span class="product-line__params-name">
                                                                                                                    Количество:
                                                                                                                </span>
                                                                                                                <span class="product-line__params-value">
                                                                                                                    4
                                                                                                                </span>
                                                                                                            </p>
                                                                                                        </li> 
                                                                                                        <li class="product-line__params product-line__params--bold">
                                                                                                            <p class="product-line__text">
                                                                                                                <span class="product-line__params-name">
                                                                                                                    Сумма баллов:
                                                                                                                </span>
                                                                                                                <span class="product-line__params-value">
                                                                                                                    436 ББ
                                                                                                                </span>
                                                                                                            </p>
                                                                                                        </li> 
                                                                                                    </ul>
                                                                                                </div>
                                                                                            </div>
                                                                                        </article>

                                                                                    </li>
                                                                                    <li class="table-list__item">

                                                                                        <article class="product-line">
                                                                                            <div class="product-line__inner">
                                                                                                <div class="product-line__info">
                                                                                                    <div class="product-line__image">
                                                                                                        <img src="/local/templates/.default/images/portage.png" alt="#" class="product-line__image-picture">
                                                                                                    </div>
                                                                                                    <div class="product-line__wrapper">
                                                                                                        <h2 class="product-line__title">
                                                                                                            AmeAppetite для мелких и средних пород собак со вкусом кролика
                                                                                                        </h2>
                                                                                                        <p class="product-line__subtitle">
                                                                                                            Арт. СХ-С-956027
                                                                                                        </p>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="product-line__characteristic">
                                                                                                    <ul class="product-line__list">
                                                                                                        <li class="product-line__params product-line__params--span">
                                                                                                            <p class="product-line__text">
                                                                                                                <span class="product-line__params-name">
                                                                                                                    Цена:
                                                                                                                </span>
                                                                                                                <span class="product-line__params-value">
                                                                                                                    1 097 ₽
                                                                                                                </span>
                                                                                                            </p>
                                                                                                        </li> 
                                                                                                        <li class="product-line__params">
                                                                                                            <p class="product-line__text">
                                                                                                                <span class="product-line__params-name">
                                                                                                                    Количество:
                                                                                                                </span>
                                                                                                                <span class="product-line__params-value">
                                                                                                                    4
                                                                                                                </span>
                                                                                                            </p>
                                                                                                        </li> 
                                                                                                        <li class="product-line__params product-line__params--bold">
                                                                                                            <p class="product-line__text">
                                                                                                                <span class="product-line__params-name">
                                                                                                                    Сумма баллов:
                                                                                                                </span>
                                                                                                                <span class="product-line__params-value">
                                                                                                                    436 ББ
                                                                                                                </span>
                                                                                                            </p>
                                                                                                        </li> 
                                                                                                    </ul>
                                                                                                </div>
                                                                                            </div>
                                                                                        </article>

                                                                                    </li>

                                                                                </ul>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </article>
                                                    </li>
                                                    
                                                    <li class="cards-order__item">
                                                        <article class="card-order card-order--red">
                                                            <div class="card-order__inner">
                                                                <header class="card-order__header">
                                                                    <ul class="card-order__list">
                                                                        <li class="card-order__item card-order__item--inlined">
                                                                            <h2 class="card-order__title">
                                                                                Заказ от 02.08.2022
                                                                            </h2>
                                                                            <p class="card-order__subtitle">
                                                                                №543268
                                                                            </p>
                                                                        </li>

                                                                        <li class="card-order__item card-order__item--span">
                                                                            <div class="info-slot info-slot--inlined">
                                                                                <p class="info-slot__name">
                                                                                    Кем заказан
                                                                                </p>
                                                                                <p class="info-slot__value">
                                                                                    Дубровская А.Ф.
                                                                                </p>
                                                                            </div>
                                                                        </li>

                                                                        <li class="card-order__item card-order__item--delivery">
                                                                            <div class="info-slot">
                                                                                <p class="info-slot__value info-slot__value--marked">
                                                                                    Доставлен
                                                                                </p>
                                                                            </div>
                                                                        </li>

                                                                        <li class="card-order__item card-order__item--pay">
                                                                            <div class="info-slot info-slot--pay">
                                                                                <p class="info-slot__name">
                                                                                    Статус оплаты
                                                                                </p>
                                                                                <p class="info-slot__value info-slot__value--icon">
                                                                                    <span class="info-slot__icon">
                                                                                        <svg class="icon icon--credit-not-paid info-slot__icon-mark">
                                                                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-credit-paid"></use>
                                                                                        </svg>
                                                                                    </span>
                                                                                    Оплачен
                                                                                </p>
                                                                            </div>
                                                                        </li>

                                                                        <li class="card-order__item">
                                                                            <div class="card-order__price price">
                                                                                <div class="price__calculation price__calculation--columned">
                                                                                    <p class="price__calculation-total price__calculation-total--has-icon">
                                                                                        <span class="price__calculation-picture">
                                                                                            <svg class="icon icon--cart-card price__calculation-icon tooltip" data-tippy-content="применена персональная акция" data-tippy-placement="bottom-start">
                                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-cart-card"></use>
                                                                                            </svg>
                                                                                        </span>
                                                                                        <span class="price__calculation-value">
                                                                                            11 904 ₽
                                                                                        </span>
                                                                                    </p>
                                                                                    <p class="price__calculation-accumulation">119 ББ</p>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                    </ul>
                                                                </header>

                                                                <div class="card-order__content">
                                                                    <div class="accordeon__item box" data-accordeon>
                                                                        <div class="accordeon__header" data-accordeon-toggle>
                                                                            <h6 class="accordeon__title">Состав заказа</h6>

                                                                            <button type="button" class="accordeon__toggle button button--circular button--mini button--covered button--red-white">
                                                                                <span class="accordeon__toggle-icon button__icon">
                                                                                    <svg class="icon icon--arrow-down">
                                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-down"></use>
                                                                                    </svg>
                                                                                </span>
                                                                            </button>

                                                                        </div>

                                                                        <div class="accordeon__body" data-accordeon-content>
                                                                            
                                                                            <div class="table-list">
                                                                                <div class="table-list__head">
                                                                                    <div class="table-list__cell">
                                                                                        <p class="table-list__name">
                                                                                            Наименование
                                                                                        </p>
                                                                                    </div>
                                                                                    <div class="table-list__cell table-list__cell--desktop">
                                                                                        <p class="table-list__name">
                                                                                            Цена
                                                                                        </p>
                                                                                    </div>
                                                                                    <div class="table-list__cell table-list__cell--desktop">
                                                                                        <p class="table-list__name">
                                                                                            Количество
                                                                                        </p>
                                                                                    </div>
                                                                                    <div class="table-list__cell table-list__cell--desktop">
                                                                                        <p class="table-list__name">
                                                                                            Сумма баллов
                                                                                        </p>
                                                                                    </div>
                                                                                </div>

                                                                                <ul class="table-list__list">

                                                                                    <li class="table-list__item">

                                                                                        <article class="product-line">
                                                                                            <div class="product-line__inner">
                                                                                                <div class="product-line__info">
                                                                                                    <div class="product-line__image">
                                                                                                        <img src="/local/templates/.default/images/portage.png" alt="#" class="product-line__image-picture">
                                                                                                    </div>
                                                                                                    <div class="product-line__wrapper">
                                                                                                        <h2 class="product-line__title">
                                                                                                            AmeAppetite для мелких и средних пород собак со вкусом кролика
                                                                                                        </h2>
                                                                                                        <p class="product-line__subtitle">
                                                                                                            Арт. СХ-С-956027
                                                                                                        </p>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="product-line__characteristic">
                                                                                                    <ul class="product-line__list">
                                                                                                        <li class="product-line__params product-line__params--span">
                                                                                                            <p class="product-line__text">
                                                                                                                <span class="product-line__params-name">
                                                                                                                    Цена:
                                                                                                                </span>
                                                                                                                <span class="product-line__params-value">
                                                                                                                    1 097 ₽
                                                                                                                </span>
                                                                                                            </p>
                                                                                                        </li> 
                                                                                                        <li class="product-line__params">
                                                                                                            <p class="product-line__text">
                                                                                                                <span class="product-line__params-name">
                                                                                                                    Количество:
                                                                                                                </span>
                                                                                                                <span class="product-line__params-value">
                                                                                                                    4
                                                                                                                </span>
                                                                                                            </p>
                                                                                                        </li> 
                                                                                                        <li class="product-line__params product-line__params--bold">
                                                                                                            <p class="product-line__text">
                                                                                                                <span class="product-line__params-name">
                                                                                                                    Сумма баллов:
                                                                                                                </span>
                                                                                                                <span class="product-line__params-value">
                                                                                                                    436 ББ
                                                                                                                </span>
                                                                                                            </p>
                                                                                                        </li> 
                                                                                                    </ul>
                                                                                                </div>
                                                                                            </div>
                                                                                        </article>

                                                                                    </li>
                                                                                    <li class="table-list__item">

                                                                                        <article class="product-line">
                                                                                            <div class="product-line__inner">
                                                                                                <div class="product-line__info">
                                                                                                    <div class="product-line__image">
                                                                                                        <img src="/local/templates/.default/images/portage.png" alt="#" class="product-line__image-picture">
                                                                                                    </div>
                                                                                                    <div class="product-line__wrapper">
                                                                                                        <h2 class="product-line__title">
                                                                                                            AmeAppetite для мелких и средних пород собак со вкусом кролика
                                                                                                        </h2>
                                                                                                        <p class="product-line__subtitle">
                                                                                                            Арт. СХ-С-956027
                                                                                                        </p>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="product-line__characteristic">
                                                                                                    <ul class="product-line__list">
                                                                                                        <li class="product-line__params product-line__params--span">
                                                                                                            <p class="product-line__text">
                                                                                                                <span class="product-line__params-name">
                                                                                                                    Цена:
                                                                                                                </span>
                                                                                                                <span class="product-line__params-value">
                                                                                                                    1 097 ₽
                                                                                                                </span>
                                                                                                            </p>
                                                                                                        </li> 
                                                                                                        <li class="product-line__params">
                                                                                                            <p class="product-line__text">
                                                                                                                <span class="product-line__params-name">
                                                                                                                    Количество:
                                                                                                                </span>
                                                                                                                <span class="product-line__params-value">
                                                                                                                    4
                                                                                                                </span>
                                                                                                            </p>
                                                                                                        </li> 
                                                                                                        <li class="product-line__params product-line__params--bold">
                                                                                                            <p class="product-line__text">
                                                                                                                <span class="product-line__params-name">
                                                                                                                    Сумма баллов:
                                                                                                                </span>
                                                                                                                <span class="product-line__params-value">
                                                                                                                    436 ББ
                                                                                                                </span>
                                                                                                            </p>
                                                                                                        </li> 
                                                                                                    </ul>
                                                                                                </div>
                                                                                            </div>
                                                                                        </article>

                                                                                    </li>
                                                                                    <li class="table-list__item">

                                                                                        <article class="product-line">
                                                                                            <div class="product-line__inner">
                                                                                                <div class="product-line__info">
                                                                                                    <div class="product-line__image">
                                                                                                        <img src="/local/templates/.default/images/portage.png" alt="#" class="product-line__image-picture">
                                                                                                    </div>
                                                                                                    <div class="product-line__wrapper">
                                                                                                        <h2 class="product-line__title">
                                                                                                            AmeAppetite для мелких и средних пород собак со вкусом кролика
                                                                                                        </h2>
                                                                                                        <p class="product-line__subtitle">
                                                                                                            Арт. СХ-С-956027
                                                                                                        </p>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="product-line__characteristic">
                                                                                                    <ul class="product-line__list">
                                                                                                        <li class="product-line__params product-line__params--span">
                                                                                                            <p class="product-line__text">
                                                                                                                <span class="product-line__params-name">
                                                                                                                    Цена:
                                                                                                                </span>
                                                                                                                <span class="product-line__params-value">
                                                                                                                    1 097 ₽
                                                                                                                </span>
                                                                                                            </p>
                                                                                                        </li> 
                                                                                                        <li class="product-line__params">
                                                                                                            <p class="product-line__text">
                                                                                                                <span class="product-line__params-name">
                                                                                                                    Количество:
                                                                                                                </span>
                                                                                                                <span class="product-line__params-value">
                                                                                                                    4
                                                                                                                </span>
                                                                                                            </p>
                                                                                                        </li> 
                                                                                                        <li class="product-line__params product-line__params--bold">
                                                                                                            <p class="product-line__text">
                                                                                                                <span class="product-line__params-name">
                                                                                                                    Сумма баллов:
                                                                                                                </span>
                                                                                                                <span class="product-line__params-value">
                                                                                                                    436 ББ
                                                                                                                </span>
                                                                                                            </p>
                                                                                                        </li> 
                                                                                                    </ul>
                                                                                                </div>
                                                                                            </div>
                                                                                        </article>

                                                                                    </li>

                                                                                </ul>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </article>
                                                    </li>
                                                </ul>
                                            </div>

                                            <button type="button" class="orders__button button button--rounded button--outlined button--green button--full">Показать больше</button>
                                        </section>
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
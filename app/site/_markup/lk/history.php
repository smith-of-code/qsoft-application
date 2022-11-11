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
        <header class="page__header header">
            <div class="header__row header__row--main">
                <div class="container">
                    <div class="header__wrapper">
                        <div class="header__block header__block--logo">
                            <div class="logo">
                                <a class="logo__link" href="#">
                                    <img class="logo__pic" src="/local/templates/.default/images/icons/logo.svg" alt="logo">
                                </a>
                            </div>
                        </div>

                        <!--Каталог-->
                        <div class="header__block header__block--catalog catalog">
                            <div class="header__catalog">
                                <div class="dropdown dropdown--menu" data-dropdown>
                                    <!--кнопка основная-->
                                    <div class="header__catalog-button header__catalog-button--main">
                                        <button type="button" class="button button--big button--square button--covered button--red button--heavy" data-dropdown-button>
                                            <span class="button__icon">
                                                <svg class="icon icon--burger">
                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-burger"></use>
                                                </svg>
                                            </span>
                                            <span class="button__text">Каталог</span>
                                        </button>
                                    </div>
                                    <!--/кнопка основная-->

                                    <!--кнопка на МВ-->
                                    <div class="header__catalog-button header__catalog-button--hidden">
                                        <button type="button" class="button button--covered button--square button--small button--red button--burger" data-dropdown-button>
                                            <span class="button__icon button__icon--medium">
                                                <svg class="icon icon--burger">
                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-burger"></use>
                                                </svg>
                                            </span>
                                        </button>
                                    </div>
                                    <!--/кнопка на МВ-->

                                    <!--дропдаун каталога-->
                                    <div class="menu dropdown__box box box--shading" data-dropdown-block>
                                        <div class="dropdown__close" data-dropdown-close>
                                            <svg class="dropdown__close-icon icon icon--close-square">
                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-close-square"></use>
                                            </svg>
                                        </div>

                                        <div class="menu__header">
                                            <div class="menu__header-logo logo logo--small">
                                                <img class="logo__pic" src="/local/templates/.default/images/icons/logo.svg" alt="logo">
                                            </div>
                                            <div class="menu__header-profile">
                                                <button type="button" class="button button--huge button--rounded button--outlined button--green button--full">
                                                    <span class="button__icon button__icon--right">
                                                        <svg class="icon icon--user">
                                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-user"></use>
                                                        </svg>
                                                    </span>
                                                    <span class="button__text">Войти в профиль</span>
                                                </button>
                                            </div>

                                            <p class="menu__header-title">Каталог товаров</p>
                                        </div>

                                        <div class="menu__content">
                                            <div class="menu__row">
                                                <div class="menu__col">
                                                    <ul class="menu__list">
                                                        <li class="menu__item menu__item--heading">
                                                            <a href="#" class="menu__item-link button button--simple button--red">Для собак</a>
                                                        </li>
                                                        <li class="menu__item">
                                                            <a href="#" class="menu__item-link button button--simple button--red">Сухой корм</a>
                                                        </li>

                                                        <li class="menu__item">
                                                            <a href="#" class="menu__item-link button button--simple button--red">Влажный корм</a>
                                                        </li>

                                                        <li class="menu__item">
                                                            <a href="#" class="menu__item-link button button--simple button--red">Лакомства</a>
                                                        </li>

                                                        <li class="menu__item">
                                                            <a href="#" class="menu__item-link button button--simple button--red">Аксессуары</a>
                                                        </li>

                                                        <li class="menu__item">
                                                            <a href="#" class="menu__item-link button button--simple button--red">Советы экспертов</a>
                                                        </li>
                                                    </ul>

                                                    <div class="menu__image">
                                                        <img src="/local/templates/.default/images/dog.png" alt="Каталог для собак" class="menu__image-pic">
                                                    </div>
                                                </div>
                                                <div class="menu__col menu__col--right">
                                                    <ul class="menu__list">
                                                        <li class="menu__item menu__item--heading">
                                                            <a href="#" class="menu__item-link button button--simple button--red">Для кошек</a>
                                                        </li>
                                                        <li class="menu__item">
                                                            <a href="#" class="menu__item-link button button--simple button--red">Сухой корм</a>
                                                        </li>

                                                        <li class="menu__item">
                                                            <a href="#" class="menu__item-link button button--simple button--red">Влажный корм</a>
                                                        </li>

                                                        <li class="menu__item">
                                                            <a href="#" class="menu__item-link button button--simple button--red">Лакомства</a>
                                                        </li>

                                                        <li class="menu__item">
                                                            <a href="#" class="menu__item-link button button--simple button--red">Аксессуары</a>
                                                        </li>

                                                        <li class="menu__item">
                                                            <a href="#" class="menu__item-link button button--simple button--red">Советы экспертов</a>
                                                        </li>
                                                    </ul>

                                                    <div class="menu__image">
                                                        <img src="/local/templates/.default/images/cat.png" alt="Каталог для кошек" class="menu__image-pic">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="menu__division">
                                            <ul class="menu__list">
                                                <li class="menu__item menu__item--small">
                                                    <a href="#" class="menu__item-link button button--simple button--red">AmeБизнес</a>
                                                </li>

                                                <li class="menu__item menu__item--small">
                                                    <a href="#" class="menu__item-link button button--simple button--red">FAQ</a>
                                                </li>

                                                <li class="menu__item menu__item--small">
                                                    <a href="#" class="menu__item-link button button--simple button--red">Новости</a>
                                                </li>

                                                <li class="menu__item menu__item--small">
                                                    <a href="#" class="menu__item-link button button--simple button--red">Акции</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!--/дропдаун каталога-->
                                </div>
                            </div>
                        </div>
                        <!--Каталог-->

                        <!--Поиск-->
                        <div class="header__block header__block--search search">
                            <div class="header__search header__search--tablet">
                                <button type="button" class="button button--iconed button--simple button--red"
                                        data-fancybox data-modal-type="modal"
                                        data-src="#search"
                                >
                                    <span class="button__icon">
                                        <svg class="icon icon--search">
                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-search"></use>
                                        </svg>
                                    </span>
                                </button>

                                <!--Попап поиска-->
                                <article id="search" class="modal modal--whole" style="display: none">
                                    <div class="modal__content">
                                        <header class="modal__section modal__section--header">
                                            <h4 class="heading heading--average">Поиск</h4>
                                        </header>

                                        <section class="modal__section modal__section--content">
                                            <div class="form__row">
                                                <div class="form__col">
                                                    <div class="form__field">
                                                        <div class="form__field-block form__field-block--input">
                                                            <div class="header__search-input input input--small input--buttoned">
                                                                <input type="text" class="header__search-input-control input__control" name="text" id="text5" placeholder="Я ищу...">
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
                                        </section>
                                    </div>
                                </article>
                                <!--/Попап поиска-->
                            </div>

                            <div class="header__search header__search--desktop">
                                <div class="form__field">
                                    <div class="form__field-block form__field-block--input">
                                        <div class="header__search-input input input--small input--buttoned">
                                            <input type="text" class="header__search-input-control input__control" name="text" id="text5" placeholder="Я ищу...">
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
                        <!--/Поиск-->

                        <div class="header__block header__block--personal personal">
                            <div class="personal__elements">
                                <div class="personal__item personal__item--hidden">
                                    <div class="dropdown dropdown--long" data-dropdown>
                                        <button type="button" class="button button--simple button--red button--vertical" data-dropdown-button>
                                            <span class="button__icon button__icon--mixed">
                                                <svg class="icon icon--notification">
                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-notification"></use>
                                                </svg>

                                                <span class="button__icon-counter button__icon-counter--red">10</span>
                                            </span>

                                            <span class="personal__button-text button__text">Уведомления</span>
                                        </button>

                                        <!--выпадающий список уведомлений-->
                                        <div class="notice dropdown__box dropdown__box--shifted dropdown__box--scrolled box box--shadow" data-dropdown-block>
                                            <div class="notice__content" data-scrollbar>
                                                <ul class="notice__list">
                                                    <li class="notice__item">
                                                        <!--Статус-->
                                                        <article class="status">
                                                            <a href="#" class="status__link"></a>
                                                            <div class="status__header">
                                                                <svg class="status__header-icon icon icon--notification">
                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-notification"></use>
                                                                </svg>

                                                                <p class="status__header-heading heading heading--tiny">Статус заявки изменился</p>
                                                            </div>

                                                            <p class="status__info">Ваша заявка на смену наставника была рассмотрена и одобрена. Узнать информацию о своем новом наставни...</p>

                                                            <div class="status__footer">
                                                                <span class="status__date">10.12.2022</span>
                                                                <span class="status__time"> 12:45</span>
                                                            </div>
                                                        </article>
                                                        <!--Статус-->
                                                    </li>

                                                    <li class="notice__item">
                                                        <article class="status">
                                                            <a href="#" class="status__link"></a>
                                                            <div class="status__header">
                                                                <svg class="status__header-icon icon icon--notification">
                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-notification"></use>
                                                                </svg>

                                                                <p class="status__header-heading heading heading--tiny">Статус заявки изменился</p>
                                                            </div>

                                                            <p class="status__info">Ваша заявка на смену наставника была рассмотрена и одобрена. Узнать информацию о своем новом наставни...</p>

                                                            <div class="status__footer">
                                                                <span class="status__date">10.12.2022</span>
                                                                <span class="status__time"> 12:45</span>
                                                            </div>
                                                        </article>
                                                    </li>

                                                    <li class="notice__item">
                                                        <article class="status">
                                                            <a href="#" class="status__link"></a>
                                                            <div class="status__header">
                                                                <svg class="status__header-icon icon icon--notification">
                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-notification"></use>
                                                                </svg>

                                                                <p class="status__header-heading heading heading--tiny">Статус заявки изменился</p>
                                                            </div>

                                                            <p class="status__info">Ваша заявка на смену наставника была рассмотрена и одобрена. Узнать информацию о своем новом наставни...</p>

                                                            <div class="status__footer">
                                                                <span class="status__date">10.12.2022</span>
                                                                <span class="status__time"> 12:45</span>
                                                            </div>
                                                        </article>
                                                    </li>

                                                    <li class="notice__item">
                                                        <article class="status">
                                                            <a href="#" class="status__link"></a>
                                                            <div class="status__header">
                                                                <svg class="status__header-icon icon icon--notification">
                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-notification"></use>
                                                                </svg>

                                                                <p class="status__header-heading heading heading--tiny">Статус заявки изменился</p>
                                                            </div>

                                                            <p class="status__info">Ваша заявка на смену наставника была рассмотрена и одобрена. Узнать информацию о своем новом наставни...</p>

                                                            <div class="status__footer">
                                                                <span class="status__date">10.12.2022</span>
                                                                <span class="status__time"> 12:45</span>
                                                            </div>
                                                        </article>
                                                    </li>

                                                    <li class="notice__item">
                                                        <article class="status">
                                                            <a href="#" class="status__link"></a>
                                                            <div class="status__header">
                                                                <svg class="status__header-icon icon icon--notification">
                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-notification"></use>
                                                                </svg>

                                                                <p class="status__header-heading heading heading--tiny">Статус заявки изменился</p>
                                                            </div>

                                                            <p class="status__info">Ваша заявка на смену наставника была рассмотрена и одобрена. Узнать информацию о своем новом наставни...</p>

                                                            <div class="status__footer">
                                                                <span class="status__date">10.12.2022</span>
                                                                <span class="status__time"> 12:45</span>
                                                            </div>
                                                        </article>
                                                    </li>

                                                    <li class="notice__item">
                                                        <article class="status">
                                                            <a href="#" class="status__link"></a>
                                                            <div class="status__header">
                                                                <svg class="status__header-icon icon icon--notification">
                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-notification"></use>
                                                                </svg>

                                                                <p class="status__header-heading heading heading--tiny">Статус заявки изменился</p>
                                                            </div>

                                                            <p class="status__info">Ваша заявка на смену наставника была рассмотрена и одобрена. Узнать информацию о своем новом наставни...</p>

                                                            <div class="status__footer">
                                                                <span class="status__date">10.12.2022</span>
                                                                <span class="status__time"> 12:45</span>
                                                            </div>
                                                        </article>
                                                    </li>
                                                </ul>
                                            </div>

                                            <div class="notice__action">
                                                <a href="#" class="button button--rounded-big button--bold button--outlined button--green button--full">Показать все</a>
                                            </div>
                                        </div>
                                        <!--выпадающий список уведомлений-->
                                    </div>
                                </div>

                                <div class="personal__item personal__item--hidden">
                                    <button type="button" class="button button--simple button--red button--vertical">
                                        <span class="button__icon button__icon--mixed">
                                            <svg class="icon icon--user">
                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-user"></use>
                                            </svg>
                                        </span>
                                        <span class="personal__button-text button__text">Профиль</span>
                                    </button>
                                </div>

                                <!--Для неавторизованного пользователя (скрыто по умолчанию)-->
                                <div class="personal__item personal__item--hidden" style="display: none">
                                    <button type="button" class="button button--simple button--red button--vertical">
                                        <span class="button__icon button__icon--mixed">
                                            <svg class="icon icon--login">
                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-login"></use>
                                            </svg>
                                        </span>
                                        <span class="personal__button-text button__text">Войти</span>
                                    </button>
                                </div>
                                <!--/Для неавторизованного пользователя-->

                                <div class="personal__item">
                                    <button type="button" class="button button--simple button--red button--vertical">
                                        <span class="button__icon button__icon--mixed">
                                            <svg class="icon icon--basket">
                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-basket"></use>
                                            </svg>

                                            <span class="button__icon-counter button__icon-counter--dark">12</span>
                                        </span>
                                        <span class="personal__button-text button__text">16 842 ₽</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--нижнее меню-->
            <div class="header__row header__row--nav">
                <div class="container">
                    <div class="header__wrapper">
                        <nav class="navigation">
                            <ul class="navigation__list">
                                <li class="navigation__item">
                                    <a href="#" class="navigation__button button button--simple button--red">
                                        <span class="button__text">AmeБизнес</span>
                                    </a>
                                </li>

                                <li class="navigation__item">
                                    <a href="#" class="navigation__button button button--simple button--red">
                                        <span class="button__text">FAQ</span>
                                    </a>
                                </li>

                                <li class="navigation__item">
                                    <a href="#" class="navigation__button button button--simple button--red">
                                        <span class="button__text">Новости</span>
                                    </a>
                                </li>

                                <li class="navigation__item">
                                    <a href="#" type="button" class="navigation__button button button--simple button--dark-red">
                                        <span class="button__icon">
                                            <svg class="icon icon--discount">
                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-discount"></use>
                                            </svg>
                                        </span>
                                        <span class="button__text">Акции</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <!--/нижнее меню-->
        </header>
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
                                                                    <a href="#" class="card-order__link"></a>
                                                                    <ul class="card-order__list">
                                                                        <li class="card-order__item">
                                                                            <h2 class="card-order__title">
                                                                                Заказ от 02.08.2022
                                                                            </h2>
                                                                            <p class="card-order__subtitle">
                                                                                №543268
                                                                            </p>
                                                                        </li>
                
                                                                        <li class="card-order__item card-order__item--span">
                                                                            <div class="info-slot">
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
                                                                                <p class="info-slot__name">
                                                                                    Статус заказа
                                                                                </p>
                                                                                <p class="info-slot__value info-slot__value--marked">
                                                                                    Доставлен
                                                                                </p>
                                                                            </div>
                                                                        </li>
                
                                                                        <li class="card-order__item card-order__item--pay">
                                                                            <div class="info-slot">
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
                                                                    <a href="#" class="card-order__link"></a>
                                                                    <ul class="card-order__list">
                                                                        <li class="card-order__item">
                                                                            <h2 class="card-order__title">
                                                                                Заказ от 02.08.2022
                                                                            </h2>
                                                                            <p class="card-order__subtitle">
                                                                                №543268
                                                                            </p>
                                                                        </li>
                
                                                                        <li class="card-order__item card-order__item--span">
                                                                            <div class="info-slot">
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
                                                                                <p class="info-slot__name">
                                                                                    Статус заказа
                                                                                </p>
                                                                                <p class="info-slot__value info-slot__value--marked">
                                                                                    Размещен
                                                                                </p>
                                                                            </div>
                                                                        </li>
                
                                                                        <li class="card-order__item card-order__item--pay">
                                                                            <div class="info-slot">
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
                                                                                                        <img src="https://fakeimg.pl/366x312/" alt="#" class="product-line__image-picture">
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
                                                                    <a href="#" class="card-order__link"></a>
                                                                    <ul class="card-order__list">
                                                                        <li class="card-order__item">
                                                                            <h2 class="card-order__title">
                                                                                Заказ от 02.08.2022
                                                                            </h2>
                                                                            <p class="card-order__subtitle">
                                                                                №543268
                                                                            </p>
                                                                        </li>
                
                                                                        <li class="card-order__item card-order__item--span">
                                                                            <div class="info-slot">
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
                                                                                <p class="info-slot__name">
                                                                                    Статус заказа
                                                                                </p>
                                                                                <p class="info-slot__value info-slot__value--marked">
                                                                                    Отменен
                                                                                </p>
                                                                            </div>
                                                                        </li>
                
                                                                        <li class="card-order__item card-order__item--pay">
                                                                            <div class="info-slot">
                                                                                <p class="info-slot__name">
                                                                                    Статус оплаты
                                                                                </p>
                                                                                <p class="info-slot__value info-slot__value--icon">
                                                                                    <span class="info-slot__icon">
                                                                                        <svg class="icon icon--credit-not-paid info-slot__icon-mark">
                                                                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-credit-not-paid"></use>
                                                                                        </svg>
                                                                                    </span>
                                                                                    Не оплачен
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
                                                                                                        <img src="https://fakeimg.pl/366x312/" alt="#" class="product-line__image-picture">
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
                                                                                                        <img src="https://fakeimg.pl/366x312/" alt="#" class="product-line__image-picture">
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
                                                                                                        <img src="https://fakeimg.pl/366x312/" alt="#" class="product-line__image-picture">
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
        <footer class="page__footer footer">
            <div class="footer__container container">
                <nav class="footer__nav">
                    <ul class="footer__list">
                        <li class="footer__item footer__item--heading">
                            Для собак
                        </li>
                        <li class="footer__item">
                            <a href="#" class="footer__link">
                                Сухой корм
                            </a>
                        </li>
                        <li class="footer__item">
                            <a href="#" class="footer__link">
                                Влажный корм
                            </a>
                        </li>
                        <li class="footer__item">
                            <a href="#" class="footer__link">
                                Лакомства
                            </a>
                        </li>
                        <li class="footer__item">
                            <a href="#" class="footer__link">
                                Аксессуары
                            </a>
                        </li>
                        <li class="footer__item">
                            <a href="#" class="footer__link">
                                Советы экспертов
                            </a>
                        </li>
                    </ul>
                    <ul class="footer__list">
                        <li class="footer__item footer__item--heading">
                            Для кошек
                        </li>
                        <li class="footer__item">
                            <a href="#" class="footer__link">
                                Сухой корм
                            </a>
                        </li>
                        <li class="footer__item">
                            <a href="#" class="footer__link">
                                Влажный корм
                            </a>
                        </li>
                        <li class="footer__item">
                            <a href="#" class="footer__link">
                                Лакомства
                            </a>
                        </li>
                        <li class="footer__item">
                            <a href="#" class="footer__link">
                                Аксессуары
                            </a>
                        </li>
                        <li class="footer__item">
                            <a href="#" class="footer__link">
                                Советы экспертов
                            </a>
                        </li>
                    </ul>
                    <ul class="footer__list">
                        <li class="footer__item footer__item--heading">
                            Покупателям
                        </li>
                        <li class="footer__item">
                            <a href="#" class="footer__link">
                                Акции
                            </a>
                        </li>
                        <li class="footer__item">
                            <a href="#" class="footer__link">
                                Оплата и доставка
                            </a>
                        </li>
                        <li class="footer__item">
                            <a href="#" class="footer__link">
                                FAQ
                            </a>
                        </li>
                        <li class="footer__item">
                            <a href="#" class="footer__link">
                                Обратиться в поддержку
                            </a>
                        </li>
                    </ul>
                    <ul class="footer__list">
                        <li class="footer__item footer__item--heading">
                            Компания AmeAppetite
                        </li>
                        <li class="footer__item">
                            <a href="#" class="footer__link">
                                AmeБизнес
                            </a>
                        </li>
                        <li class="footer__item">
                            <a href="#" class="footer__link">
                                Новости
                            </a>
                        </li>
                        <li class="footer__item">
                            <a href="#" class="footer__link">
                                Мероприятия
                            </a>
                        </li>
                    </ul>
                    <ul class="footer__list">
                        <li class="footer__item footer__item--heading">
                            Контакты
                        </li>
                        <li class="footer__item">
                            <a href="tel:88001234567" class="footer__link">
                                8 (800) 123-45-67
                            </a>
                        </li>
                        <li class="footer__item">
                            <a href="mailto:dogcathappy@ame.ru" class="footer__link">
                                dogcathappy@ame.ru
                            </a>
                        </li>
                        <li class="footer__item">
                            Москва, Проспект Мира, 87
                        </li>
                    </ul>
                    <ul class="footer__list">
                        <li class="footer__item footer__item--heading">
                            Правовая информация
                        </li>
                        <li class="footer__item">
                            <a href="#" class="footer__link">
                                Правила компании
                            </a>
                        </li>
                        <li class="footer__item">
                            <a href="#" class="footer__link">
                                Положение об обработке персональных данных
                            </a>
                        </li>
                        <li class="footer__item">
                            <a href="#" class="footer__link">
                                Правила поведения в компании
                            </a>
                        </li>
                    </ul>
                </nav>

                <div class="footer__social social">
                    <ul class="social__list">
                        <li class="social__item">
                            <a href="#" class="social__link">
                                <svg class="icon icon--social">
                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-telegram"></use>
                                </svg>
                            </a>
                        </li>
                        <li class="social__item">
                            <a href="#" class="social__link">
                                <svg class="icon icon--social">
                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-youtube"></use>
                                </svg>
                            </a>
                        </li>
                        <li class="social__item">
                            <a href="#" class="social__link">
                                <svg class="icon icon--social">
                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-vk"></use>
                                </svg>
                            </a>
                        </li>
                        <li class="social__item">
                            <a href="#" class="social__link">
                                <svg class="icon icon--social">
                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-whatsapp"></use>
                                </svg>
                            </a>
                        </li>
                        <li class="social__item">
                            <a href="#" class="social__link">
                                <svg class="icon icon--social">
                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-viber"></use>
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="footer__bottom">
                    <p class="footer__copyright">
                        &copy; AmeAppetite, 2022
                    </p>
                </div>
            </div>
        </footer>
        <!--/Футер-->

        <script src="/local/templates/.default/js/script.js"></script>
    </body>

</html>
<!DOCTYPE html>
<html lang="ru">
    <head>
        <title>Каталог</title>

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
                                    <span class="button__icon button__icon--mixed">
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
                                                            <div class="header__search-input input input--small input--buttoned input--squared">
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
                                        <div class="header__search-input input input--small input--buttoned input--squared">
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

                                <div class="personal__item personal__item--basket">
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
        <div class="page__content page__content--breadcrumbs content">
            <div class="container">
                <main class="page__catalog catalog">
                    <div class="breadcrumbs">
                        <ul class="breadcrumbs__list">
                            <li class="breadcrumbs__item">
                                <a href="#" class="breadcrumbs__link">Главная</a>
                            </li>
                            <li class="breadcrumbs__item breadcrumbs__item--active">
                                <a class="breadcrumbs__link">Каталог товаров</a>
                            </li>
                        </ul>
                    </div>

                    <h1 class="page__heading">Каталог товаров</h1>

                    <div class="content__main">
                        <div class="catalog__wrapper">
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
                                            <form class="form">
                                                <div class="filter__row">
                                                    <div class="filter__accordeon accordeon accordeon--simple accordeon--small">
                                                        <div class="accordeon__item box box--rounded-sm" data-accordeon>
                                                            <div class="accordeon__header" data-accordeon-toggle>
                                                                <h5 class="accordeon__title accordeon__title--dark">Для собак</h5>

                                                                <button type="button" class="accordeon__toggle button button--circular button--mini button--mixed button--gray-red">
                                                                    <span class="accordeon__toggle-icon button__icon">
                                                                        <svg class="icon icon--arrow-down">
                                                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-down"></use>
                                                                        </svg>
                                                                    </span>
                                                                </button>

                                                            </div>

                                                            <div class="filter__accordeon-body accordeon__body" data-accordeon-content>
                                                                <div class="category">
                                                                    <ul class="category__list">
                                                                        <li class="category__item">
                                                                            <a href="#" class="category__item-link button button--simple button--red">Сухие корма</a>
                                                                        </li>
                                                                        <li class="category__item">
                                                                            <a href="#" class="category__item-link button button--simple button--red">Влажные корма</a>
                                                                        </li>
                                                                        <li class="category__item">
                                                                            <a href="#" class="category__item-link button button--simple button--red">Лакомства</a>
                                                                        </li>
                                                                        <li class="category__item">
                                                                            <a href="#" class="category__item-link button button--simple button--red">Аксессуары</a>
                                                                        </li>
                                                                        <li class="category__item">
                                                                            <a href="#" class="category__item-link button button--simple button--red">Появился щенок</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="accordeon__item box box--rounded-sm" data-accordeon>
                                                            <div class="accordeon__header" data-accordeon-toggle>
                                                                <h5 class="accordeon__title accordeon__title--dark">Для кошек</h5>
                            
                                                                <button type="button" class="accordeon__toggle button button--circular button--mini button--mixed button--gray-red">
                                                                    <span class="accordeon__toggle-icon button__icon">
                                                                        <svg class="icon icon--arrow-down">
                                                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-down"></use>
                                                                        </svg>
                                                                    </span>
                                                                </button>
                            
                                                            </div>
                            
                                                            <div class="filter__accordeon-body accordeon__body" data-accordeon-content>
                                                                <div class="category">
                                                                    <ul class="category__list">
                                                                        <li class="category__item">
                                                                            <a href="#" class="category__item-link button button--simple button--red">Сухие корма</a>
                                                                        </li>
                                                                        <li class="category__item">
                                                                            <a href="#" class="category__item-link button button--simple button--red">Влажные корма</a>
                                                                        </li>
                                                                        <li class="category__item">
                                                                            <a href="#" class="category__item-link button button--simple button--red">Лакомства</a>
                                                                        </li>
                                                                        <li class="category__item">
                                                                            <a href="#" class="category__item-link button button--simple button--red">Аксессуары</a>
                                                                        </li>
                                                                        <li class="category__item">
                                                                            <a href="#" class="category__item-link button button--simple button--red">Появился щенок</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
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
                                        <div class="filter__background" data-filter-bg></div>
                                    </div>
                                </div>
                            </div>

                            <div class="catalog__main">
                                <div class="catalog__panel">
                                    <p class="catalog__results">Найдено <span class="catalog__results-count">19 </span>товаров</p>

                                    <div class="catalog__sort">
                                        <div class="catalog__select select select--small select--limited select--sorting select--borderless" data-select>
                                            <select class="select__control" name="select5" id="sort" data-select-control data-placeholder="Сортировка">
                                                <option><!-- пустой option для placeholder --></option>
                                                <option value="1">По цене</option>
                                                <option value="2">По популярности</option>
                                            </select>

                                            <button type="button" class="input__button input__button--select button button--iconed button--covered button--square button--dark">
                                                <span class="button__icon button__icon--medium">
                                                    <svg class="icon icon--sort">
                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-sort"></use>
                                                    </svg>
                                                </span>
                                            </button>
                                        </div>

                                        <div class="catalog__toggle">
                                            <button type="button" class="filter__toggle button button--square button--covered button--black-red button--full" data-filter-button>
                                                <span class="button__icon button__icon--right button__icon--medium">
                                                    <svg class="icon icon--filter">
                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-filter"></use>
                                                    </svg>
                                                </span>
                                                <span class="button__text">Фильтр</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="catalog__products">
                                    <div class="product-cards product-cards--catalog">
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
                                                                                <div class="color__item">
                                                                                    <div class="color__item-wrapper">
                                                                                        <img src="/local/templates/.default/images/cat2.png"
                                                                                        class="color__item-pic">
                                                                                    </div>
                                                                                </div>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </li>
            
                                                                <li class="colors__item">
                                                                    <div class="color">
                                                                        <div class="radio">
                                                                            <input type="radio" class="color__input radio__input" name="radio2" value="r2" id="radio2">
                                                                            <label for="radio2">
                                                                                <div class="color__item">
                                                                                    <div class="color__item-wrapper">
                                                                                        <img src="/local/templates/.default/images/cat2.png"
                                                                                        class="color__item-pic">
                                                                                    </div>
                                                                                </div>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </li>
            
                                                                <li class="colors__item">
                                                                    <div class="color">
                                                                        <div class="radio">
                                                                            <input type="radio" class="color__input radio__input" name="radio2" value="r3" id="radio3">
                                                                            <label for="radio3">
                                                                                <div class="color__item">
                                                                                    <div class="color__item-wrapper">
                                                                                        <img src="/local/templates/.default/images/cat2.png"
                                                                                        class="color__item-pic">
                                                                                    </div>
                                                                                </div>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </li>
            
                                                                <li class="colors__item">
                                                                    <div class="color">
                                                                        <div class="radio">
                                                                            <input type="radio" class="color__input radio__input" name="radio2" value="r4" id="radio4">
                                                                            <label for="radio4">
                                                                                <div class="color__item">
                                                                                    <div class="color__item-wrapper">
                                                                                        <img src="/local/templates/.default/images/cat2.png"
                                                                                        class="color__item-pic">
                                                                                    </div>
                                                                                </div>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </li>
            
                                                                <li class="colors__item">
                                                                    <div class="color">
                                                                        <div class="radio">
                                                                            <input type="radio" class="color__input radio__input" name="radio2" value="r3" id="radio5">
                                                                            <label for="radio5">
                                                                                <div class="color__item">
                                                                                    <div class="color__item-wrapper">
                                                                                        <img src="/local/templates/.default/images/cat2.png"
                                                                                        class="color__item-pic">
                                                                                    </div>
                                                                                </div>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </li>
            
                                                                <li class="colors__item">
                                                                    <div class="color">
                                                                        <div class="radio">
                                                                            <input type="radio" class="color__input radio__input" name="radio2" value="r3" id="radio6">
                                                                            <label for="radio6">
                                                                                <div class="color__item">
                                                                                    <div class="color__item-wrapper">
                                                                                        <img src="/local/templates/.default/images/cat2.png"
                                                                                        class="color__item-pic">
                                                                                    </div>
                                                                                </div>
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

                                <button type="button" class="catalog__button button button--show button--rounded-big button--outlined button--green">Показать больше</button>
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
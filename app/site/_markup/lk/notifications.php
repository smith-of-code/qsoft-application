<!DOCTYPE html>
<html lang="ru">
    <head>
        <title>Уведомления</title>

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
                <main class="page__private page__private--notification private">

                    <div class="page__breadcrumbs breadcrumbs">
                        <ul class="breadcrumbs__list">
                            <li class="breadcrumbs__item">
                                <a href="#" class="breadcrumbs__link">Главная</a>
                            </li>
                            <li class="breadcrumbs__item breadcrumbs__item--active">
                                <a class="breadcrumbs__link">Уведомления</a>
                            </li>
                        </ul>
                    </div>

                    <h1 class="page__heading page__heading--notification">Личный кабинет</h1>

                    <div class="content__main">
                        <div class="private__row">
                            <div class="private__col private__col--limited">
                                <nav class="private__menu notifications__menu notifications__menu--private menu menu--private">
                                    <ul class="menu__list notifications__menu-list">
                                        <li class="menu__item notifications__menu-item">
                                            <a href="#" class="menu__link">
                                                <span class="notifications__menu-icon menu__icon">
                                                    <svg class="icon icon--profile gui__icon">
                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-profile"></use>
                                                    </svg>
                                                </span>
                                                <span class="menu__text">
                                                    Профиль
                                                </span>
                                            </a>
                                        </li>

                                        <li class="menu__item notifications__menu-item">
                                            <a href="#" class="menu__link">
                                                <span class="notifications__menu-icon menu__icon">
                                                    <svg class="icon icon--receipts gui__icon">
                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-receipts"></use>
                                                    </svg>
                                                </span>
                                                <span class="menu__text">
                                                    История заказов
                                                </span>
                                            </a>
                                        </li>

                                        <li class="menu__item notifications__menu-item">
                                            <a href="#" class="menu__link">
                                                <span class="menu__icon notifications__menu-icon">
                                                    <svg class="icon icon--calculator gui__icon">
                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-calculator"></use>
                                                    </svg>
                                                </span>
                                                <span class="menu__text">
                                                    Калькулятор доходности
                                                </span>
                                            </a>
                                        </li>

                                        <li class="menu__item notifications__menu-item">
                                            <a href="#" class="menu__link">
                                                <span class="menu__icon notifications__menu-icon">
                                                    <svg class="icon icon--chart-square gui__icon">
                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-chart-square"></use>
                                                    </svg>
                                                </span>
                                                <span class="menu__text">
                                                    Отчетность по объемам продаж
                                                </span>
                                            </a>
                                        </li>

                                        <li class="menu__item notifications__menu-item menu__item--active">
                                            <a href="#" class="menu__link">
                                                <span class="notifications__menu-icon menu__icon menu__icon--active">
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
                                <div class="notifications">
                                    <h3 class="notifications__title">Уведомления</h3>

                                    <div class="notifications__cards cards-notify">
                                        <ul class="notifications__list cards-notify__list">
                                            <li class="cards-notify__item">

                                                <article class="card-notify card-notify--green">
                                                    <a href="#" class="card-notify__link"></a>
                                                
                                                    <div class="card-notify__inner">
                                                    
                                                        <header class="card-notify__header">
                                                            <div class="card-notify__mark">
                                                                <svg class="card-notify__mark-icon icon icon--notification">
                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-notification"></use>
                                                                </svg>
                                                            </div>
                                                            <p class="card-notify__title">
                                                                Статус заявки изменился
                                                            </p>
                                                        </header>

                                                        <div class="card-notify__message">
                                                            <p class="card-notify__text">
                                                                Поздравляем! Вы перевыполнили план по удержанию статуса уровня к2 в этом месяце
                                                            </p>
                                                        </div>

                                                        <footer class="card-notify__footer">
                                                            <time class="card-notify__send" datetime="2022-07-27 13:24">
                                                                <span class="card-notify__send-status">Отправлено</span>
                                                                <span class="card-notify__send-date">27.07.2022</span>
                                                                <span class="card-notify__send-time">13:24</span>
                                                            </time>

                                                            <div class="card-notify__status">
                                                                <span class="card-notify__status-mark">
                                                                    <svg class="card-notify__status-icon icon icon--tick-circle-bold">
                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-tick-circle-bold"></use>
                                                                    </svg>
                                                                </span>
                                                                <p class="card-notify__status-text">
                                                                    Прочитано
                                                                </p>
                                                            </div>
                                                        </footer>

                                                    </div>
                                                </article>

                                            </li>
                                            <li class="cards-notify__item">

                                                <article class="card-notify card-notify--orange">
                                                    <a href="#" class="card-notify__link"></a>
                                                
                                                    <div class="card-notify__inner">
                                                    
                                                        <header class="card-notify__header">
                                                            <div class="card-notify__mark">
                                                                <svg class="card-notify__mark-icon icon icon--notification">
                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-notification"></use>
                                                                </svg>
                                                            </div>
                                                            <p class="card-notify__title">
                                                                Статус заявки изменился
                                                            </p>
                                                        </header>

                                                        <div class="card-notify__message">
                                                            <p class="card-notify__text">
                                                                Ваша заявка на смену наставника была рассмотрена и одобрена. Узнать информацию о своем новом наставнике, Вы можете в Профиле личного кабинета
                                                            </p>
                                                        </div>

                                                        <footer class="card-notify__footer">
                                                            <time class="card-notify__send" datetime="2022-07-27 13:24">
                                                                <span class="card-notify__send-status">Отправлено</span>
                                                                <span class="card-notify__send-date">27.07.2022</span>
                                                                <span class="card-notify__send-time">13:24</span>
                                                            </time>

                                                            <div class="card-notify__status">
                                                                <span class="card-notify__status-mark">
                                                                    <svg class="card-notify__status-icon icon icon--attention">
                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-attention"></use>
                                                                    </svg>
                                                                </span>
                                                                <p class="card-notify__status-text">
                                                                    Ждет прочтения
                                                                </p>
                                                            </div>
                                                        </footer>

                                                    </div>
                                                </article>

                                            </li>
                                            <li class="cards-notify__item">

                                                <article class="card-notify card-notify--orange">
                                                    <a href="#" class="card-notify__link"></a>
                                                
                                                    <div class="card-notify__inner">
                                                    
                                                        <header class="card-notify__header">
                                                            <div class="card-notify__mark">
                                                                <svg class="card-notify__mark-icon icon icon--notification">
                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-notification"></use>
                                                                </svg>
                                                            </div>
                                                            <p class="card-notify__title">
                                                                Статус заявки изменился
                                                            </p>
                                                        </header>

                                                        <div class="card-notify__message">
                                                            <p class="card-notify__text">
                                                                Ваша заявка на смену наставника была рассмотрена и одобрена. Узнать информацию о своем новом наставнике, Вы можете в Профиле личного кабинета
                                                            </p>
                                                        </div>

                                                        <footer class="card-notify__footer">
                                                            <time class="card-notify__send" datetime="2022-07-27 13:24">
                                                                <span class="card-notify__send-status">Отправлено</span>
                                                                <span class="card-notify__send-date">27.07.2022</span>
                                                                <span class="card-notify__send-time">13:24</span>
                                                            </time>

                                                            <div class="card-notify__status">
                                                                <span class="card-notify__status-mark">
                                                                    <svg class="card-notify__status-icon icon icon--attention">
                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-attention"></use>
                                                                    </svg>
                                                                </span>
                                                                <p class="card-notify__status-text">
                                                                    Ждет прочтения
                                                                </p>
                                                            </div>
                                                        </footer>

                                                    </div>
                                                </article>

                                            </li>
                                            <li class="cards-notify__item">

                                                <article class="card-notify card-notify--orange">
                                                    <a href="#" class="card-notify__link"></a>
                                                
                                                    <div class="card-notify__inner">
                                                    
                                                        <header class="card-notify__header">
                                                            <div class="card-notify__mark">
                                                                <svg class="card-notify__mark-icon icon icon--notification">
                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-notification"></use>
                                                                </svg>
                                                            </div>
                                                            <p class="card-notify__title">
                                                                Статус заявки изменился
                                                            </p>
                                                        </header>

                                                        <div class="card-notify__message">
                                                            <p class="card-notify__text">
                                                                Ваша заявка на смену наставника была рассмотрена и одобрена. Узнать информацию о своем новом наставнике, Вы можете в Профиле личного кабинета
                                                            </p>
                                                        </div>

                                                        <footer class="card-notify__footer">
                                                            <time class="card-notify__send" datetime="2022-07-27 13:24">
                                                                <span class="card-notify__send-status">Отправлено</span>
                                                                <span class="card-notify__send-date">27.07.2022</span>
                                                                <span class="card-notify__send-time">13:24</span>
                                                            </time>

                                                            <div class="card-notify__status">
                                                                <span class="card-notify__status-mark">
                                                                    <svg class="card-notify__status-icon icon icon--attention">
                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-attention"></use>
                                                                    </svg>
                                                                </span>
                                                                <p class="card-notify__status-text">
                                                                    Ждет прочтения
                                                                </p>
                                                            </div>
                                                        </footer>

                                                    </div>
                                                </article>

                                            </li>
                                        </ul>

                                        <button type="button" class="notifications__button-more button button--full button--rounded button--covered button--white-green">
                                            Показать больше
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--Сменить наставника-->
                    <article id="technical-support" class="modal modal--limited modal--wide modal--scrolled box box--circle box--hanging" style="display: none" data-support>
                        <div class="modal__content">
                            <header class="modal__section modal__section--header">
                                <p class="heading heading--average">Техническая поддержка</p>
                            </header>

                            <section class="modal__section modal__section--content" data-scrollbar>
                                <form action="" class="form">
                                    <div class="form__row form__row--separated">
                                        <div class="form__col">
                                            <div class="form__field">
                                                <div class="form__field-block form__field-block--label">
                                                    <label for="selectTp" class="form__label form__label--required">
                                                        <span class="form__label-text">Тип обращения</span>
                                                    </label>
                                                </div>

                                                <div class="form__field-block form__field-block--input">
                                                    <div class="form__control">
                                                        <div class="select select--mitigate" data-select>
                                                            <select class="select__control" name="selectTp" id="selectTp" data-select-control data-placeholder="Выберите город" data-option>
                                                                <option><!-- пустой option для placeholder --></option>
                                                                <option value="1" data-variant="refund">Возврат заказа</option>
                                                                <option value="2" data-variant="nonfunctional">Неработающая функциональность</option>
                                                                <option value="3" data-variant="change"  selected>Смена наставника/контактного лица</option>
                                                                <option value="4" data-variant="personal">Смена персональных данных</option>
                                                                <option value="5" data-variant="other">Другое</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!--Возврат заказа-->
                                    <div class="modal__section-variant" data-variant-block="refund">
                                        <div class="form__row form__row--gaped">
                                            <div class="form__col">
                                                <div class="form__field">
                                                    <div class="form__field-block form__field-block--label">
                                                        <label for="Email2" class="form__label">
                                                            <span class="form__label-text">Email</span>
                                                        </label>
                                                    </div>
    
                                                    <div class="form__field-block form__field-block--input">
                                                        <div class="input input--simple">
                                                            <input type="text" class="input__control" name="Email" id="Email2" value="Pushkin@ya.ru" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form__row form__row--closer">
                                            <div class="form__col">
                                                <div class="form__field">
                                                    <div class="form__field-block form__field-block--label">
                                                        <label for="text-required7" class="form__label form__label--required">
                                                            <span class="form__label-text">Номер заказа</span>
                                                        </label>
                                                    </div>
            
                                                    <div class="form__field-block form__field-block--input">
                                                        <div class="input">
                                                            <input type="text" class="input__control" name="text-required" id="text-required7" placeholder="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form__row">
                                            <div class="form__col">
                                                <div class="form__field">
                                                    <div class="form__field-block form__field-block--label">
                                                        <label for="text" class="form__label">
                                                            <span class="form__label-text">Комментарий</span>
                                                        </label>
                                                    </div>
                                                    <div class="form__field-block form__field-block--input">
                                                        <label class="input input--textarea">
                                                            <textarea type="text" class="input__control" name="textarea" id="textarea3" placeholder="Не более 1000 символов" maxlength="1000" data-textarea-input=""></textarea>
                                                            <div class="input__counter">
                                                                <span class="input__counter-current" data-textarea-current="">0</span>
                                                                    /
                                                                <span class="input__counter-total" data-textarea-total="">1000</span>
                                                            </div>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/Возврат заказа-->

                                    <!--Неработающая функциональность-->
                                    <div class="modal__section-variant" data-variant-block="nonfunctional">

                                        <div class="form__row form__row--gaped">
                                            <div class="form__col">
                                                <div class="form__field">
                                                    <div class="form__field-block form__field-block--label">
                                                        <label for="Email1" class="form__label">
                                                            <span class="form__label-text">Email</span>
                                                        </label>
                                                    </div>
    
                                                    <div class="form__field-block form__field-block--input">
                                                        <div class="input input--simple">
                                                            <input type="text" class="input__control" name="Email" id="Email1" value="Pushkin@ya.ru" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form__row form__row--closer">
                                            <div class="form__col">
                                                <div class="form__field">
                                                    <div class="form__field-block form__field-block--label">
                                                        <label for="text" class="form__label">
                                                            <span class="form__label-text">Комментарий</span>
                                                        </label>
                                                    </div>
                                                    <div class="form__field-block form__field-block--input">
                                                        <label class="input input--textarea">
                                                            <textarea type="text" class="input__control" name="textarea" id="textarea2" placeholder="Не более 1000 символов" maxlength="1000" data-textarea-input=""></textarea>
                                                            <div class="input__counter">
                                                                <span class="input__counter-current" data-textarea-current="">0</span>
                                                                    /
                                                                <span class="input__counter-total" data-textarea-total="">1000</span>
                                                            </div>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/Неработающая функциональность-->

                                    <!--Смена наставника/контактного лица-->
                                    <div class="modal__section-variant" data-variant-block="change">
                                        <div class="form__row form__row--gaped">
                                            <div class="form__col">
                                                <div class="form__field">
                                                    <div class="form__field-block form__field-block--label">
                                                        <label for="Email3" class="form__label">
                                                            <span class="form__label-text">Email</span>
                                                        </label>
                                                    </div>
    
                                                    <div class="form__field-block form__field-block--input">
                                                        <div class="input input--simple">
                                                            <input type="text" class="input__control" name="Email" id="Email3" value="Pushkin@ya.ru" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form__row form__row--closer">
                                            <div class="form__col">
                                                <div class="form__field">
                                                    <div class="form__field-block form__field-block--label">
                                                        <label for="ID" class="form__label">
                                                            <span class="form__label-text">ID текущего наставника</span>
                                                        </label>
                                                    </div>
    
                                                    <div class="form__field-block form__field-block--input">
                                                        <div class="input input--simple">
                                                            <input type="text" class="input__control" name="ID" id="ID" value="323213" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form__row">
                                            <div class="form__col">
                                                <div class="form__field">
                                                    <div class="form__field-block form__field-block--label">
                                                        <label for="text-required9" class="form__label form__label--required">
                                                            <span class="form__label-text">ID нового наставника</span>
                                                        </label>
                                                    </div>
            
                                                    <div class="form__field-block form__field-block--input">
                                                        <div class="input">
                                                            <input type="number" class="input__control" name="text-required" id="text-required9" placeholder="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form__row">
                                            <div class="form__col">
                                                <div class="form__field">
                                                    <div class="form__field-block form__field-block--label">
                                                        <label for="select4m" class="form__label form__label--required">
                                                            <span class="form__label-text">Причина</span>
                                                        </label>
                                                    </div>
    
                                                    <div class="form__field-block form__field-block--input">
                                                        <div class="form__control">
                                                            <div class="select select--mitigate" data-select>
                                                                <select class="select__control" name="select4m" id="select4m" data-select-control data-placeholder="Выберите город">
                                                                    <option><!-- пустой option для placeholder --></option>
                                                                    <option value="1">Возврат заказа</option>
                                                                    <option value="2">Неработающая функциональность</option>
                                                                    <option value="3">Смена наставника/контактного лица</option>
                                                                    <option value="4">Смена персональных данных</option>
                                                                    <option value="5">Другое</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form__row">
                                            <div class="form__col">
                                                <div class="form__field">
                                                    <div class="form__field-block form__field-block--label">
                                                        <label for="text" class="form__label">
                                                            <span class="form__label-text">Комментарий</span>
                                                        </label>
                                                    </div>
                                                    <div class="form__field-block form__field-block--input">
                                                        <label class="input input--textarea">
                                                            <textarea type="text" class="input__control" name="textarea" id="textarea4" placeholder="Не более 1000 символов" maxlength="1000" data-textarea-input=""></textarea>
                                                            <div class="input__counter">
                                                                <span class="input__counter-current" data-textarea-current="">0</span>
                                                                    /
                                                                <span class="input__counter-total" data-textarea-total="">1000</span>
                                                            </div>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/Смена наставника/контактного лица-->

                                    <!--Смена персональных данных-->
                                    <div class="modal__section-variant" data-variant-block="personal">
                                        <div class="form__row form__row--gaped">
                                            <div class="form__col">
                                                <div class="form__field">
                                                    <div class="form__field-block form__field-block--label">
                                                        <label for="Email4" class="form__label">
                                                            <span class="form__label-text">Email</span>
                                                        </label>
                                                    </div>
    
                                                    <div class="form__field-block form__field-block--input">
                                                        <div class="input input--simple">
                                                            <input type="text" class="input__control" name="Email" id="Email4" value="Pushkin@ya.ru" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form__row form__row--closer">
                                            <div class="form__col">
                                                <div class="form__field">
                                                    <div class="form__field-block form__field-block--label">
                                                        <label for="text-required10" class="form__label">
                                                            <span class="form__label-text">Актуальная фамилия</span>
                                                        </label>
                                                    </div>
            
                                                    <div class="form__field-block form__field-block--input">
                                                        <div class="input">
                                                            <input type="number" class="input__control" name="text-required" id="text-required10" placeholder="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form__row">
                                            <div class="form__col">
                                                <div class="form__field">
                                                    <div class="form__field-block form__field-block--label">
                                                        <label for="text-required11" class="form__label">
                                                            <span class="form__label-text">Актуальное имя</span>
                                                        </label>
                                                    </div>

                                                    <div class="form__field-block form__field-block--input">
                                                        <div class="input">
                                                            <input type="number" class="input__control" name="text-required" id="text-required11" placeholder="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form__row">
                                            <div class="form__col">
                                                <div class="form__field">
                                                    <div class="form__field-block form__field-block--label">
                                                        <label for="text-required" class="form__label">
                                                            <span class="form__label-text">Актуальное отчество</span>
                                                        </label>
                                                    </div>

                                                    <div class="form__field-block form__field-block--input">
                                                        <div class="input">
                                                            <input type="number" class="input__control" name="text-required" id="text-required" placeholder="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form__row">
                                            <div class="form__col">
                                                <div class="form__field">
                                                    <div class="form__field-block form__field-block--label">
                                                        <label for="text" class="form__label">
                                                            <span class="form__label-text">Дата рождения</span>
                                                        </label>
                                                    </div>
                                                    <div class="form__field-block form__field-block--input">
                                                        <div class="input input--iconed">
                                                            <input inputmode="numeric"
                                                                class="input__control"
                                                                name="birthdate"
                                                                id="birthdate2"
                                                                placeholder="ДД.ММ.ГГГГ"
                                                                data-mask-date 
                                                                data-inputmask-alias="datetime"
                                                                data-inputmask-inputformat="dd.mm.yyyy"
                                                                data-pets-date-input
                                                                data-pets-change
                                                                value="09.11.2011"
                                                            >
                                                            <span class="input__icon">
                                                                <svg class="icon icon--calendar">
                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-calendar"></use>
                                                                </svg>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form__row">
                                            <div class="form__col">
                                                <div class="dropzone" data-uploader>
                                                    <input type="file" name="uploadFiles[]" multiple class="dropzone__control">

                                                    <div class="dropzone__area" data-uploader-area='{"paramName": "uploadFiles[]", "url":"/_markup/gui.php"}'>
                                                        <div class="dropzone__message dz-message needsclick">
                                                            <div class="dropzone__message-caption needsclick">
                                                                <h6 class="dropzone__message-title">Ограничения:</h6>
                                                                <ul class="dropzone__message-list">
                                                                    <li class="dropzone__message-item">до 10 файлов</li>
                                                                    <li class="dropzone__message-item">вес каждого файла не более 5 МБ</li>
                                                                    <li class="dropzone__message-item">форматы файлов: PDF, JPG, JPEG, PNG, HEIC</li>
                                                                </ul>
                                                            </div>

                                                            <button type="button" class="dropzone__button dropzone__button--wide button button--medium button--rounded button--outlined button--green">
                                                                <span class="button__icon">
                                                                    <svg class="icon icon--import">
                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-import"></use>
                                                                    </svg>
                                                                </span>
                                                                <span class="button__text button__text--required">Загрузить файл</span>
                                                            </button>
                                                        </div>
                        
                                                        <div class="dropzone__previews dropzone__previews--small dz-previews" data-uploader-previews>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form__row">
                                            <div class="form__col">
                                                <div class="form__field">
                                                    <div class="form__field-block form__field-block--label">
                                                        <label for="text" class="form__label">
                                                            <span class="form__label-text">Комментарий</span>
                                                        </label>
                                                    </div>
                                                    <div class="form__field-block form__field-block--input">
                                                        <label class="input input--textarea">
                                                            <textarea type="text" class="input__control" name="textarea" id="textarea5" placeholder="Не более 1000 символов" maxlength="1000" data-textarea-input=""></textarea>
                                                            <div class="input__counter">
                                                                <span class="input__counter-current" data-textarea-current="">0</span>
                                                                    /
                                                                <span class="input__counter-total" data-textarea-total="">1000</span>
                                                            </div>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/Смена персональных данных-->

                                    <!--Другое-->
                                    <div class="modal__section-variant modal__section-variant--active" data-variant-block="other">
                                        <div class="form__row form__row--gaped">
                                            <div class="form__col">
                                                <div class="form__field">
                                                    <div class="form__field-block form__field-block--label">
                                                        <label for="Email1" class="form__label">
                                                            <span class="form__label-text">Email</span>
                                                        </label>
                                                    </div>
    
                                                    <div class="form__field-block form__field-block--input">
                                                        <div class="input input--simple">
                                                            <input type="text" class="input__control" name="Email" id="Email1" value="Pushkin@ya.ru" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form__row form__row--closer">
                                            <div class="form__col">
                                                <div class="form__field">
                                                    <div class="form__field-block form__field-block--label">
                                                        <label for="text" class="form__label">
                                                            <span class="form__label-text">Комментарий</span>
                                                        </label>
                                                    </div>
                                                    <div class="form__field-block form__field-block--input">
                                                        <label class="input input--textarea">
                                                            <textarea type="text" class="input__control" name="textarea" id="textarea2" placeholder="Не более 1000 символов" maxlength="1000" data-textarea-input=""></textarea>
                                                            <div class="input__counter">
                                                                <span class="input__counter-current" data-textarea-current="">0</span>
                                                                    /
                                                                <span class="input__counter-total" data-textarea-total="">1000</span>
                                                            </div>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/Другое-->

                                    <div class="modal__section-actions">
                                        <button type="button" class="form__footer-button button button--rounded button--covered button--red button--full">Отправить</button>
                                    </div>
                                </form>
                            </section>
                        </div>
                    </article>
                    <!--/Сменить наставника-->
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
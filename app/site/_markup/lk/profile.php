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
                <main class="page__private private" data-tabs>

                    <h1 class="page__heading">Личный кабинет</h1>

                    <div class="content__main">
                        <div class="private__tabs tabs tabs--menu">
                            <div class="private__row">
                                <div class="private__col private__col--limited">
                                    <nav class="private__menu">
                                        <ul class="tabs__list">
                                            <li class="tabs__item tabs__item--active" data-tab="profile">
                                                <div class="tabs__item-icon">
                                                    <svg class="icon icon--profile gui__icon">
                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-profile"></use>
                                                    </svg>
                                                </div>
                                                <span class="tabs__item-text">
                                                    Профиль
                                                </span>
                                            </li>

                                            <li class="tabs__item" data-tab="history">
                                                <div class="tabs__item-icon">
                                                    <svg class="icon icon--receipts gui__icon">
                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-receipts"></use>
                                                    </svg>
                                                </div>
                                                <span class="tabs__item-text">
                                                    История заказов
                                                </span>
                                            </li>

                                            <li class="tabs__item" data-tab="calculator">
                                                <div class="tabs__item-icon">
                                                    <svg class="icon icon--calculator gui__icon">
                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-calculator"></use>
                                                    </svg>
                                                </div>
                                                <span class="tabs__item-text">
                                                    Калькулятор доходности
                                                </span>
                                            </li>

                                            <li class="tabs__item" data-tab="report">
                                                <div class="tabs__item-icon">
                                                    <svg class="icon icon--chart-square gui__icon">
                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-chart-square"></use>
                                                    </svg>
                                                </div>
                                                <span class="tabs__item-text">
                                                    Отчетность по объемам продаж
                                                </span>
                                            </li>

                                            <li class="tabs__item" data-tab="notification">
                                                <div class="tabs__item-icon">
                                                    <svg class="icon icon--notification gui__icon">
                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-notification"></use>
                                                    </svg>
                                                </div>
                                                <span class="tabs__item-text">
                                                    Уведомления
                                                </span>
                                                <span class="tabs__item-counter">10</span>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>

                                <div class="private__col private__col--full">
                                    <div class="tabs__body">
                                        <div class="tabs__block tabs__block--active" data-tab-section="profile">
                                            <div class="profile">
                                                <h3 class="profile__title">Профиль</h3>

                                                <div class="profile__block">
                                                    <section class="section">
                                                        <form class="form form--wraped" action="" method="post">
                                                            <div class="section__box box box--gray box--rounded-sm">
                                                                <h4 class="section__title">Персональные данные</h4>

                                                                <div class="section__wrapper">
                                                                     <!--dropzone-->
                                                                    <div class="profile__dropzone dropzone dropzone--image dropzone--simple" data-uploader>
                                                                        <input type="file" name="uploadFiles[]" multiple class="dropzone__control">

                                                                        <div class="dropzone__area" data-uploader-area='{"paramName": "uploadFiles[]", "url":"/_markup/gui.php", "images": true, "single": true}'>
                                                                            <div class="dropzone__message dz-message needsclick">
                                                                                <div class="dropzone__message-button dz-button link needsclick" data-uploader-previews>
                                                                                    <svg class="dropzone__message-button-icon icon icon--camera">
                                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-camera"></use>
                                                                                    </svg>
                                                                                </div>
                                                                            </div>

                                                                            <div class="dropzone__previews dz-previews" data-uploader-previews>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!--/dropzone-->

                                                                    <div class="section__box-inner">
                                                                        <div class="section__box-content box box--white box--rounded-sm box--inner">
                                                                            <div class="section__box-block">
                                                                                <div class="form__row form__row--special">
                                                                                    <div class="form__col">
                                                                                        <div class="form__field">
                                                                                            <div class="form__field-block form__field-block--label">
                                                                                                <label for="text-required" class="form__label form__label--required">
                                                                                                    <span class="form__label-text">Фамилия</span>
                                                                                                </label>
                                                                                            </div>

                                                                                            <div class="form__field-block form__field-block--input">
                                                                                                <div class="input">
                                                                                                    <input type="text" class="input__control" name="text-required" id="text-required" placeholder="Введите фамилию">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="form__col">
                                                                                        <div class="form__field">
                                                                                            <div class="form__field-block form__field-block--label">
                                                                                                <label for="text-required" class="form__label form__label--required">
                                                                                                    <span class="form__label-text">Имя</span>
                                                                                                </label>
                                                                                            </div>

                                                                                            <div class="form__field-block form__field-block--input">
                                                                                                <div class="input">
                                                                                                    <input type="text" class="input__control" name="text-required" id="text-required" placeholder="Введите имя">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="form__col">
                                                                                        <div class="form__field">
                                                                                            <div class="form__field-block form__field-block--label">
                                                                                                <label for="text-required" class="form__label form__label--required">
                                                                                                    <span class="form__label-text">Отчество</span>
                                                                                                </label>
                                                                                            </div>

                                                                                            <div class="form__field-block form__field-block--input">
                                                                                                <div class="input">
                                                                                                    <input type="text" class="input__control" name="text-required" id="text-required" placeholder="Введите отчество">
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
                                                                                            <label for="select33" class="form__label form__label--required">
                                                                                                <span class="form__label-text">Пол</span>
                                                                                            </label>
                                                                                        </div>
                                        
                                                                                        <div class="form__field-block form__field-block--input">
                                                                                            <div class="form__control">
                                                                                                <div class="select select--mitigate" data-select>
                                                                                                    <select class="select__control" name="select33" id="select33" data-select-control data-placeholder="Выберите пол">
                                                                                                        <option><!-- пустой option для placeholder --></option>
                                                                                                        <option value="1">Женский</option>
                                                                                                        <option value="2">Мужской</option>
                                                                                                    </select>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form__col">
                                                                                    <div class="form__field">
                                                                                        <div class="form__field-block form__field-block--label">
                                                                                            <label for="birthdate" class="form__label form__label--required">
                                                                                                <span class="form__label-text">Дата рождения</span>
                                                                                            </label>
                                                                                        </div>

                                                                                        <div class="form__field-block form__field-block--input">
                                                                                            <div class="input input--iconed">
                                                                                                <input inputmode="numeric"
                                                                                                    class="input__control"
                                                                                                    name="text"
                                                                                                    id="birthdate"
                                                                                                    placeholder="ДД.ММ.ГГГГ"
                                                                                                    data-mask-date 
                                                                                                    data-inputmask-alias="datetime"
                                                                                                    data-inputmask-inputformat="dd.mm.yyyy"
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
                                                                                    <div class="form__field">
                                                                                        <div class="form__field-block form__field-block--label">
                                                                                            <label for="text-required" class="form__label form__label--required">
                                                                                                <span class="form__label-text">E-mail</span>
                                                                                            </label>
                                                                                        </div>

                                                                                        <div class="form__field-block form__field-block--input">
                                                                                            <div class="input">
                                                                                                <input type="text" class="input__control" name="text-required" id="text-required" placeholder="example@email.com" data-mail inputmode="email">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form__col">
                                                                                    <div class="form__field">
                                                                                        <div class="form__field-block form__field-block--label">
                                                                                            <label for="text-required" class="form__label form__label--required">
                                                                                                <span class="form__label-text">Телефон</span>
                                                                                            </label>
                                                                                        </div>

                                                                                        <div class="form__field-block form__field-block--input">
                                                                                            <div class="input">
                                                                                                <input type="tel" class="input__control" name="text-required" id="text-required" placeholder="+7 (___) ___-__-__" data-phone inputmode="text">
                                                                                            </div>
                                                                                        </div>

                                                                                        <button type="button" class="form__field-button button button--simple button--red button--underlined button--tiny">
                                                                                            Отправить проверочный код
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="form__row">
                                                                                <div class="form__col">
                                                                                    <div class="form__field">
                                                                                        <div class="form__field-block form__field-block--label">
                                                                                            <label for="select22" class="form__label form__label--required">
                                                                                                <span class="form__label-text">Населенный пункт</span>
                                                                                            </label>
                                                                                        </div>
                                        
                                                                                        <div class="form__field-block form__field-block--input">
                                                                                            <div class="form__control">
                                                                                                <div class="select select--mitigate" data-select>
                                                                                                    <select class="select__control" name="select22" id="select22" data-select-control data-placeholder="Выберите город">
                                                                                                        <option><!-- пустой option для placeholder --></option>
                                                                                                        <option value="1">Москва</option>
                                                                                                        <option value="2">Нижний Новгород</option>
                                                                                                        <option value="3">Самара</option>
                                                                                                        <option value="4">Челябинск</option>
                                                                                                    </select>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form__col">
                                                                                    <div class="form__field">
                                                                                        <div class="form__field-block form__field-block--label">
                                                                                            <label for="select22" class="form__label form__label--required">
                                                                                                <span class="form__label-text">Пункт выдачи заказов</span>
                                                                                            </label>
                                                                                        </div>
                                        
                                                                                        <div class="form__field-block form__field-block--input">
                                                                                            <div class="form__control">
                                                                                                <div class="select select--mitigate" data-select>
                                                                                                    <select class="select__control" name="select22" data-select-control data-placeholder="Выберите город">
                                                                                                        <option><!-- пустой option для placeholder --></option>
                                                                                                        <option value="1">Москва</option>
                                                                                                        <option value="2">Нижний Новгород</option>
                                                                                                        <option value="3">Самара</option>
                                                                                                        <option value="4">Челябинск</option>
                                                                                                    </select>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </section>
                                                </div>

                                                <div class="profile__block">
                                                    <section class="section">
                                                        <form class="form form--wraped" action="" method="post">
                                                            <div class="section__box box box--gray box--rounded-sm">
                                                                <h4 class="section__title">Юридические данные</h4>

                                                                <div class="section__box-inner">
                                                                    <h5 class="box__heading box__heading--middle">Общее</h5>

                                                                    <div class="section__box-content box box--white box--rounded-sm box--inner">
                                                                        <div class="section__box-block">
                                                                            <h6 class="box__heading box__heading--small">Статус и гражданство</h6>
                                
                                                                            <div class="form__row form__row--mixed">
                                                                                <div class="form__col">
                                                                                    <div class="form__field">
                                                                                        <div class="form__field-block form__field-block--label">
                                                                                            <label for="r111" class="form__label form__label--required">
                                                                                                <span class="form__label-text">Статус</span>
                                                                                            </label>
                                                                                        </div>
                                
                                                                                        <div class="form__field-block form__field-block--input">
                                                                                            <div class="form__control">
                                                                                                <div class="select select--mitigate" data-select>
                                                                                                    <select class="select__control" name="r111" id="r111" data-select-control data-placeholder="Выберите статус">
                                                                                                        <option><!-- пустой option для placeholder --></option>
                                                                                                        <option value="1">Самозанятый</option>
                                                                                                        <option value="2">ИП</option>
                                                                                                        <option value="3">OOO</option>
                                                                                                    </select>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                
                                                                                <div class="form__col">
                                                                                    <div class="form__field">
                                                                                        <div class="form__field-block form__field-block--label">
                                                                                            <label for="r11" class="form__label form__label--required">
                                                                                                <span class="form__label-text">Гражданство</span>
                                                                                            </label>
                                                                                        </div>
                                
                                                                                        <div class="form__field-block form__field-block--input">
                                                                                            <div class="form__control">
                                                                                                <div class="select select--mitigate" data-select>
                                                                                                    <select class="select__control" name="r11" id="r11" data-select-control data-placeholder="Выберите пол">
                                                                                                        <option><!-- пустой option для placeholder --></option>
                                                                                                        <option value="1">Резидент РФ</option>
                                                                                                        <option value="2">Незезидент РФ</option>
                                                                                                    </select>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                
                                                                        <div class="section__box-block">
                                                                            <h6 class="box__heading box__heading--small">Паспортные данные</h6>
                                
                                                                            <div class="form__row form__row--mixed">
                                                                                <div class="form__col">
                                                                                    <div class="form__field">
                                                                                        <div class="form__field-block form__field-block--label">
                                                                                            <label for="text-required" class="form__label form__label--required">
                                                                                                <span class="form__label-text">Серия паспорта</span>
                                                                                            </label>
                                                                                        </div>
                                
                                                                                        <div class="form__field-block form__field-block--input">
                                                                                            <div class="input">
                                                                                                <input type="text" class="input__control" name="text-required" id="text-required" placeholder="12 34" data-passport-seria>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                
                                                                                <div class="form__col">
                                                                                    <div class="form__field">
                                                                                        <div class="form__field-block form__field-block--label">
                                                                                            <label for="text-required" class="form__label form__label--required">
                                                                                                <span class="form__label-text">Номер</span>
                                                                                            </label>
                                                                                        </div>
                                
                                                                                        <div class="form__field-block form__field-block--input">
                                                                                            <div class="input">
                                                                                                <input type="text" class="input__control" name="text-required" id="text-required" placeholder="Введите номер паспорта" data-passport-number>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                
                                                                            <div class="form__row form__row--mixed">
                                                                                <div class="form__col">
                                                                                    <div class="form__field">
                                                                                        <div class="form__field-block form__field-block--label">
                                                                                            <label for="text-required" class="form__label form__label--required">
                                                                                                <span class="form__label-text">Кем выдан</span>
                                                                                            </label>
                                                                                        </div>
                                
                                                                                        <div class="form__field-block form__field-block--input">
                                                                                            <div class="input">
                                                                                                <input type="text" class="input__control" name="text-required" id="text-required" placeholder="Кем выдан">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                
                                                                                <div class="form__col">
                                                                                    <div class="form__field">
                                                                                        <div class="form__field-block form__field-block--label">
                                                                                            <label for="date" class="form__label">
                                                                                                <span class="form__label-text">Дата выдачи паспорта</span>
                                                                                            </label>
                                                                                        </div>
                                
                                                                                        <div class="form__field-block form__field-block--input">
                                                                                            <div class="input input--iconed">
                                                                                                <input inputmode="numeric"
                                                                                                    class="input__control"
                                                                                                    name="date"
                                                                                                    id="date"
                                                                                                    placeholder="ДД.ММ.ГГГГ"
                                                                                                    data-mask-date 
                                                                                                    data-inputmask-alias="datetime"
                                                                                                    data-inputmask-inputformat="dd.mm.yyyy"
                                                                                                    data-pets-date-input
                                                                                                    data-pets-change
                                                                                                    value="09.10.2017"
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
                                                                        </div>

                                                                        <div class="section__box-block">
                                                                            <h6 class="box__heading box__heading--small">Адрес регистрации</h6>
                                
                                                                            <div class="form__row form__row--mixed">
                                                                                <div class="form__col">
                                                                                    <div class="form__field">
                                                                                        <div class="form__field-block form__field-block--label">
                                                                                            <label for="text-required" class="form__label form__label--required">
                                                                                                <span class="form__label-text">Населенный пункт</span>
                                                                                            </label>
                                                                                        </div>
                                
                                                                                        <div class="form__field-block form__field-block--input">
                                                                                            <div class="input">
                                                                                                <input type="text" class="input__control" name="text-required" id="text-required" placeholder="Населенный пункт">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                
                                                                                <div class="form__col">
                                                                                    <div class="form__field">
                                                                                        <div class="form__field-block form__field-block--label">
                                                                                            <label for="text-required" class="form__label form__label--required">
                                                                                                <span class="form__label-text">Улица</span>
                                                                                            </label>
                                                                                        </div>
                                
                                                                                        <div class="form__field-block form__field-block--input">
                                                                                            <div class="input">
                                                                                                <input type="text" class="input__control" name="text-required" id="text-required" placeholder="Улица">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                
                                                                            <div class="form__row form__row--mixed">
                                                                                <div class="form__col">
                                                                                    <div class="form__field">
                                                                                        <div class="form__field-block form__field-block--label">
                                                                                            <label for="text-required" class="form__label form__label--required">
                                                                                                <span class="form__label-text">Дом</span>
                                                                                            </label>
                                                                                        </div>
                                
                                                                                        <div class="form__field-block form__field-block--input">
                                                                                            <div class="input">
                                                                                                <input type="number" class="input__control" name="text-required" id="text-required" placeholder="Дом">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                
                                                                                <div class="form__col">
                                                                                    <div class="form__field">
                                                                                        <div class="form__field-block form__field-block--label">
                                                                                            <label for="text-required" class="form__label form__label--required">
                                                                                                <span class="form__label-text">Квартира</span>
                                                                                            </label>
                                                                                        </div>
                                
                                                                                        <div class="form__field-block form__field-block--input">
                                                                                            <div class="input">
                                                                                                <input type="number" class="input__control" name="text-required" id="text-required" placeholder="Квартира">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                
                                                                                
                                                                                <div class="form__col">
                                                                                    <div class="form__field">
                                                                                        <div class="form__field-block form__field-block--label">
                                                                                            <label for="text-required" class="form__label form__label--required">
                                                                                                <span class="form__label-text">Индекс</span>
                                                                                            </label>
                                                                                        </div>
                                
                                                                                        <div class="form__field-block form__field-block--input">
                                                                                            <div class="input">
                                                                                                <input type="number" class="input__control" name="text-required" id="text-required" placeholder="Индекс">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="section__box-block">
                                                                            <h6 class="box__heading box__heading--small">Адрес проживания</h6>
                                
                                                                            <div class="form__row form__row--mixed">
                                                                                <div class="form__col">
                                                                                    <div class="form__field">
                                                                                        <div class="form__field-block form__field-block--label">
                                                                                            <label for="text-required" class="form__label form__label--required">
                                                                                                <span class="form__label-text">Населенный пункт</span>
                                                                                            </label>
                                                                                        </div>
                                
                                                                                        <div class="form__field-block form__field-block--input">
                                                                                            <div class="input">
                                                                                                <input type="text" class="input__control" name="text-required" id="text-required" placeholder="Населенный пункт">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                
                                                                                <div class="form__col">
                                                                                    <div class="form__field">
                                                                                        <div class="form__field-block form__field-block--label">
                                                                                            <label for="text-required" class="form__label form__label--required">
                                                                                                <span class="form__label-text">Улица</span>
                                                                                            </label>
                                                                                        </div>
                                
                                                                                        <div class="form__field-block form__field-block--input">
                                                                                            <div class="input">
                                                                                                <input type="text" class="input__control" name="text-required" id="text-required" placeholder="Улица">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                
                                                                            <div class="form__row form__row--mixed">
                                                                                <div class="form__col">
                                                                                    <div class="form__field">
                                                                                        <div class="form__field-block form__field-block--label">
                                                                                            <label for="text-required" class="form__label form__label--required">
                                                                                                <span class="form__label-text">Дом</span>
                                                                                            </label>
                                                                                        </div>
                                
                                                                                        <div class="form__field-block form__field-block--input">
                                                                                            <div class="input">
                                                                                                <input type="number" class="input__control" name="text-required" id="text-required" placeholder="Дом">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                
                                                                                <div class="form__col">
                                                                                    <div class="form__field">
                                                                                        <div class="form__field-block form__field-block--label">
                                                                                            <label for="text-required" class="form__label form__label--required">
                                                                                                <span class="form__label-text">Квартира</span>
                                                                                            </label>
                                                                                        </div>
                                
                                                                                        <div class="form__field-block form__field-block--input">
                                                                                            <div class="input">
                                                                                                <input type="number" class="input__control" name="text-required" id="text-required" placeholder="Квартира">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                
                                                                                
                                                                                <div class="form__col">
                                                                                    <div class="form__field">
                                                                                        <div class="form__field-block form__field-block--label">
                                                                                            <label for="text-required" class="form__label form__label--required">
                                                                                                <span class="form__label-text">Индекс</span>
                                                                                            </label>
                                                                                        </div>
                                
                                                                                        <div class="form__field-block form__field-block--input">
                                                                                            <div class="input">
                                                                                                <input type="number" class="input__control" name="text-required" id="text-required" placeholder="Индекс">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                
                                                                            <div class="form__row form__row--mixed">
                                                                                <div class="form__col">
                                                                                    <div class="form__field">
                                                                                        <div class="checkbox">
                                                                                            <input type="checkbox" class="checkbox__input" name="check[]" value="s" id="check">
                                
                                                                                            <label for="check" class="checkbox__label">
                                                                                                <span class="checkbox__icon">
                                                                                                    <svg class="checkbox__icon-pic icon icon--check">
                                                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check">
                                                                                                    </svg>
                                                                                                </span>
                                
                                                                                                <span class="checkbox__text">Адрес регистрации совпадает с адресом фактического проживания</span>
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="section__box-block">
                                                                            <h6 class="box__heading box__heading--small">Копия паспорта</h6>

                                                                            <div class="dropzone" data-uploader>
                                                                                <input type="file" name="uploadFiles[]" multiple class="dropzone__control">

                                                                                <div class="dropzone__area" data-uploader-area='{"paramName": "uploadFiles[]", "url":"/_markup/gui.php"}'>
                                                                                    <div class="dropzone__message dz-message needsclick">
                                                                                        <button type="button" class="dropzone__button button button--medium button--rounded button--covered button--red">
                                                                                            <span class="button__icon">
                                                                                                <svg class="icon icon--import">
                                                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-import"></use>
                                                                                                </svg>
                                                                                            </span>
                                                                                            <span class="button__text">Загрузить файл</span>
                                                                                        </button>
                                                                                    </div>
                                                    
                                                                                    <div class="dropzone__previews dz-previews" data-uploader-previews>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                
                                                                <div class="section__box-inner">
                                                                    <h5 class="box__heading box__heading--middle">Самозанятый</h5>
                                
                                                                    <div class="section__box-content box box--white box--rounded-sm box--inner">
                                                                        <div class="section__box-block">
                                                                            <h6 class="box__heading box__heading--small">ИНН и копия свидетельства о постановке на учет в налоговом органе</h6>
                                                                            <div class="form__row">
                                                                                <div class="form__col">
                                                                                    <div class="form__field form__field--fixed">
                                                                                        <div class="form__field-block form__field-block--label">
                                                                                            <label for="text-required" class="form__label form__label--required">
                                                                                                <span class="form__label-text">ИНН</span>
                                                                                            </label>
                                                                                        </div>
                                
                                                                                        <div class="form__field-block form__field-block--input">
                                                                                            <div class="input">
                                                                                                <input type="text" class="input__control" name="text-required" id="text-required" placeholder="ИНН" data-inn>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="section__box-block">
                                                                            <div class="dropzone" data-uploader>
                                                                                <input type="file" name="uploadFiles[]" multiple class="dropzone__control">

                                                                                <div class="dropzone__area" data-uploader-area='{"paramName": "uploadFiles[]", "url":"/_markup/gui.php"}'>
                                                                                    <div class="dropzone__message dz-message needsclick">
                                                                                        <button type="button" class="dropzone__button button button--medium button--rounded button--covered button--red">
                                                                                            <span class="button__icon">
                                                                                                <svg class="icon icon--import">
                                                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-import"></use>
                                                                                                </svg>
                                                                                            </span>
                                                                                            <span class="button__text">Загрузить файл</span>
                                                                                        </button>
                                                                                    </div>
                                
                                                                                    <div class="dropzone__previews dz-previews" data-uploader-previews>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                
                                                                        <div class="section__box-block">
                                                                            <h6 class="box__heading box__heading--small">Банковские реквизиты</h6>
                                
                                                                            <div class="form__row form__row--mixed">
                                                                                <div class="form__col">
                                                                                    <div class="form__field">
                                                                                        <div class="form__field-block form__field-block--label">
                                                                                            <label for="text-required" class="form__label form__label--required">
                                                                                                <span class="form__label-text">Наименование банка</span>
                                                                                            </label>
                                                                                        </div>
                                
                                                                                        <div class="form__field-block form__field-block--input">
                                                                                            <div class="input">
                                                                                                <input type="text" class="input__control" name="text-required" id="text-required" placeholder="Наименование банка">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                
                                                                                <div class="form__col">
                                                                                    <div class="form__field">
                                                                                        <div class="form__field-block form__field-block--label">
                                                                                            <label for="text-required" class="form__label form__label--required">
                                                                                                <span class="form__label-text">БИК</span>
                                                                                            </label>
                                                                                        </div>
                                
                                                                                        <div class="form__field-block form__field-block--input">
                                                                                            <div class="input">
                                                                                                <input type="text" class="input__control" name="text-required" id="text-required" placeholder="БИК" data-bik>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                
                                                                            <div class="form__row form__row--mixed">
                                                                                <div class="form__col">
                                                                                    <div class="form__field">
                                                                                        <div class="form__field-block form__field-block--label">
                                                                                            <label for="text-required" class="form__label form__label--required">
                                                                                                <span class="form__label-text">Расчетный счет</span>
                                                                                            </label>
                                                                                        </div>
                                
                                                                                        <div class="form__field-block form__field-block--input">
                                                                                            <div class="input">
                                                                                                <input type="number" class="input__control" name="text-required" id="text-required" placeholder="Расчетный счет">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                
                                                                                <div class="form__col">
                                                                                    <div class="form__field">
                                                                                        <div class="form__field-block form__field-block--label">
                                                                                            <label for="text-required" class="form__label form__label--required">
                                                                                                <span class="form__label-text">Корреспондентский счет</span>
                                                                                            </label>
                                                                                        </div>
                                
                                                                                        <div class="form__field-block form__field-block--input">
                                                                                            <div class="input">
                                                                                                <input type="number" class="input__control" name="text-required" id="text-required" placeholder="Корреспондентский счет">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="section__box-block">
                                                                            <h6 class="box__heading box__heading--small">Сведения о банковских реквизитах</h6>

                                                                            <div class="dropzone" data-uploader>
                                                                                <input type="file" name="uploadFiles[]" multiple class="dropzone__control">

                                                                                <div class="dropzone__area" data-uploader-area='{"paramName": "uploadFiles[]", "url":"/_markup/gui.php"}'>
                                                                                    <div class="dropzone__message dz-message needsclick">
                                                                                        <button type="button" class="dropzone__button button button--medium button--rounded button--covered button--red">
                                                                                            <span class="button__icon">
                                                                                                <svg class="icon icon--import">
                                                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-import"></use>
                                                                                                </svg>
                                                                                            </span>
                                                                                            <span class="button__text">Загрузить файл</span>
                                                                                        </button>
                                                                                    </div>
                                
                                                                                    <div class="dropzone__previews dz-previews" data-uploader-previews>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="section__box-block">
                                                                            <h6 class="box__heading box__heading--small">Справка о постановке на учет физического лица в качестве плательщика налога на профессиональный доход</h6>

                                                                            <div class="dropzone" data-uploader>
                                                                                <input type="file" name="uploadFiles[]" multiple class="dropzone__control">

                                                                                <div class="dropzone__area" data-uploader-area='{"paramName": "uploadFiles[]", "url":"/_markup/gui.php"}'>
                                                                                    <div class="dropzone__message dz-message needsclick">
                                                                                        <button type="button" class="dropzone__button button button--medium button--rounded button--covered button--red">
                                                                                            <span class="button__icon">
                                                                                                <svg class="icon icon--import">
                                                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-import"></use>
                                                                                                </svg>
                                                                                            </span>
                                                                                            <span class="button__text">Загрузить файл</span>
                                                                                        </button>
                                                                                    </div>
                                
                                                                                    <div class="dropzone__previews dz-previews" data-uploader-previews>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </section>
                                                </div>

                                                <div class="profile__block">
                                                    <div class="box box--gray box--rounded">
                                                        <h4 class="box__heading heading heading--average">
                                                            Данные о питомцах
                                                        </h4>

                                                        <div class="pet-cards">
                                                            <ul class="pet-cards__list" data-pets-list>
                                                                <li class="pet-cards__item">
                                                                    <!--Карточка питомца-->
                                                                    <article class="pet-card" data-pets-card>
                                                                        <div class="pet-card__main box box--circle" data-pets-main>
                                                                            <div class="pet-card__content">
                                                                                <div class="pet-card__avatar" data-pets-type>
                                                                                    <svg class="icon icon--dog">
                                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-dog"></use>
                                                                                    </svg>
                                                                                </div>

                                                                                <div class="pet-card__info">
                                                                                    <div class="pet-card__name" data-pets-name>
                                                                                        Мухтар Бесстрашный
                                                                                    </div>

                                                                                    <div class="pet-card__breed" data-pets-breed>
                                                                                        Лабрадор
                                                                                    </div>

                                                                                    <div class="pet-card__info-record">
                                                                                        <div class="pet-card__gender" data-pets-gender>
                                                                                            <svg class="icon icon--man">
                                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-man"></use>
                                                                                            </svg>
                                                                                        </div>

                                                                                        <div class="pet-card__date" data-pets-date>
                                                                                            09.10.2017
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="pet-card__actions">
                                                                                <div class="pet-card__modify">
                                                                                    <button type="button" class="pet-card__actions-button button button--iconed button--simple button--red" data-tippy-content="Редактировать" data-pets-modify>
                                                                                        <span class="button__icon">
                                                                                            <svg class="icon icon--edit">
                                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-edit"></use>
                                                                                            </svg>
                                                                                        </span>
                                                                                    </button>
                                                                                </div>

                                                                                <div class="pet-card__delete">
                                                                                    <button type="button" class="pet-card__actions-button button button--iconed button--simple button--red" data-tippy-content="Удалить" data-pets-delete>
                                                                                        <span class="button__icon">
                                                                                            <svg class="icon icon--basket">
                                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-basket"></use>
                                                                                            </svg>
                                                                                        </span>
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="pet-card__edit box box--rounded-sm" data-pets-edit>
                                                                            <form class="form" action="" method="post" data-pets-form data-validation="add-pets">
                                                                                <div class="pet-card__row form__row">
                                                                                    <div class="pet-card__col pet-card__col--1-3 pet-card__col--3 form__col">
                                                                                        <div class="form__field">
                                                                                            <div class="form__field-block form__field-block--label">
                                                                                                <label for="pet-card-select1" class="form__label">
                                                                                                    <span class="form__label-text">Тип питомца</span>
                                                                                                </label>
                                                                                            </div>

                                                                                            <div class="form__field-block form__field-block--input">
                                                                                                <div class="form__control">
                                                                                                    <div class="select select--mitigate select--iconed" data-select>
                                                                                                        <select class="select__control" name="type" id="pet-card-select1" data-select-control data-placeholder="Выбрать" data-pets-type-input data-pets-change>
                                                                                                            <option><!-- пустой option для placeholder --></option>
                                                                                                            <option value="1" data-option-icon="cat">Кошка</option>
                                                                                                            <option value="2" data-option-icon="dog" selected>Собака</option>
                                                                                                        </select>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="pet-card__col pet-card__col--1-3 form__col">
                                                                                        <div class="form__field">
                                                                                            <div class="form__field-block form__field-block--label">
                                                                                                <label for="pet-card-select11" class="form__label">
                                                                                                    <span class="form__label-text">Пол</span>
                                                                                                </label>
                                                                                            </div>

                                                                                            <div class="form__field-block form__field-block--input">
                                                                                                <div class="form__control">
                                                                                                    <div class="select select--mitigate" data-select>
                                                                                                        <select class="select__control" name="gender" id="pet-card-select11" data-select-control data-placeholder="Выбрать" data-pets-gender-input data-pets-change>
                                                                                                            <option><!-- пустой option для placeholder --></option>
                                                                                                            <option value="1" selected>Мальчик</option>
                                                                                                            <option value="2">Девочка</option>
                                                                                                        </select>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="pet-card__col pet-card__col--1-3 form__col">
                                                                                        <div class="form__field">
                                                                                            <div class="form__field-block form__field-block--label">
                                                                                                <label for="birthdate3" class="form__label">
                                                                                                    <span class="form__label-text">Дата рождения</span>
                                                                                                </label>
                                                                                            </div>

                                                                                            <div class="form__field-block form__field-block--input">
                                                                                                <div class="input input--iconed">
                                                                                                    <input inputmode="numeric"
                                                                                                        class="input__control"
                                                                                                        name="birthdate"
                                                                                                        id="birthdate3"
                                                                                                        placeholder="ДД.ММ.ГГГГ"
                                                                                                        data-mask-date 
                                                                                                        data-inputmask-alias="datetime"
                                                                                                        data-inputmask-inputformat="dd.mm.yyyy"
                                                                                                        data-pets-date-input
                                                                                                        data-pets-change
                                                                                                        value="09.10.2017"
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

                                                                                    <div class="pet-card__col pet-card__col--1-2 pet-card__col--1 form__col">
                                                                                        <div class="form__field">
                                                                                            <div class="form__field-block form__field-block--label">
                                                                                                <label for="pet-card-select111" class="form__label">
                                                                                                    <span class="form__label-text">Порода</span>
                                                                                                </label>
                                                                                            </div>

                                                                                            <div class="form__field-block form__field-block--input">
                                                                                                <div class="form__control">
                                                                                                    <div class="select select--mitigate" data-select>
                                                                                                        <select class="select__control" name="breed" id="pet-card-select111" data-select-control data-placeholder="Выбрать" data-pets-breed-input data-pets-change>
                                                                                                            <option><!-- пустой option для placeholder --></option>
                                                                                                            <option value="1" selected>Лабрадор</option>
                                                                                                            <option value="2">Пудель</option>
                                                                                                            <option value="3">Болонка</option>
                                                                                                            <option value="4">Мопс</option>
                                                                                                            <option value="5">Китайская хохлатая</option>
                                                                                                            <option value="6">Кавалер кинг чарльз спаниель</option>
                                                                                                            <option value="7">Дог</option>
                                                                                                        </select>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="pet-card__col pet-card__col--1-2 pet-card__col--2 form__col">
                                                                                        <div class="form__field">
                                                                                            <div class="form__field-block form__field-block--label">
                                                                                                <label for="text19" class="form__label">
                                                                                                    <span class="form__label-text">Кличка</span>
                                                                                                </label>
                                                                                            </div>

                                                                                            <div class="form__field-block form__field-block--input">
                                                                                                <div class="input">
                                                                                                    <input value="Мухтар Бесстрашный" type="text" class="input__control" name="nickname" id="text19" placeholder="Выбрать" data-pets-name-input data-pets-change>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="pet-card__buttons">
                                                                                    <button type="submit" class="pet-card__button button button--rounded button--covered button--green button--full" data-pets-save>
                                                                                        Сохранить изменения
                                                                                    </button>

                                                                                    <button type="button" class="pet-card__button button button--rounded button--mixed button--red button--full" data-pets-cancel>
                                                                                        Отменить изменения
                                                                                    </button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </article>
                                                                    <!--/Карточка питомца-->
                                                                </li>

                                                                <li class="pet-cards__item">
                                                                    <!--Карточка питомца-->
                                                                    <article class="pet-card" data-pets-card>
                                                                        <div class="pet-card__main box box--circle" data-pets-main>
                                                                            <div class="pet-card__content">
                                                                                <div class="pet-card__avatar" data-pets-type>
                                                                                    <svg class="icon icon--cat">
                                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-cat"></use>
                                                                                    </svg>
                                                                                </div>

                                                                                <div class="pet-card__info">
                                                                                    <div class="pet-card__name" data-pets-name>
                                                                                        Мурка
                                                                                    </div>

                                                                                    <div class="pet-card__breed" data-pets-breed>
                                                                                        Русская голубая
                                                                                    </div>

                                                                                    <div class="pet-card__info-record">
                                                                                        <div class="pet-card__gender" data-pets-gender>
                                                                                            <svg class="icon icon--woman">
                                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-woman"></use>
                                                                                            </svg>
                                                                                        </div>

                                                                                        <div class="pet-card__date" data-pets-date>
                                                                                            09.11.2011
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="pet-card__actions">
                                                                                <div class="pet-card__modify">
                                                                                    <button type="button" class="pet-card__actions-button button button--iconed button--simple button--red" data-tippy-content="Редактировать" data-pets-modify>
                                                                                        <span class="button__icon">
                                                                                            <svg class="icon icon--edit">
                                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-edit"></use>
                                                                                            </svg>
                                                                                        </span>
                                                                                    </button>
                                                                                </div>

                                                                                <div class="pet-card__delete">
                                                                                    <button type="button" class="pet-card__actions-button button button--iconed button--simple button--red" data-tippy-content="Удалить" data-pets-delete>
                                                                                        <span class="button__icon">
                                                                                            <svg class="icon icon--basket">
                                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-basket"></use>
                                                                                            </svg>
                                                                                        </span>
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="pet-card__edit box box--rounded-sm" data-pets-edit>
                                                                            <form class="form" action="" method="post" data-validation="add-pets" data-pets-form>
                                                                                <div class="pet-card__row form__row">
                                                                                    <div class="pet-card__col pet-card__col--1-3 pet-card__col--3 form__col">
                                                                                        <div class="form__field">
                                                                                            <div class="form__field-block form__field-block--label">
                                                                                                <label for="pet-card-select2" class="form__label">
                                                                                                    <span class="form__label-text">Тип питомца</span>
                                                                                                </label>
                                                                                            </div>
                                                    
                                                                                            <div class="form__field-block form__field-block--input">
                                                                                                <div class="form__control">
                                                                                                    <div class="select select--mitigate select--iconed" data-select>
                                                                                                        <select class="select__control" name="type" id="pet-card-select2" data-select-control data-placeholder="Выбрать" data-pets-type-input data-pets-change>
                                                                                                            <option><!-- пустой option для placeholder --></option>
                                                                                                            <option value="1" data-option-icon="cat" selected>Кошка</option>
                                                                                                            <option value="2"data-pets-card data-option-icon="dog">Собака</option>
                                                                                                        </select>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="pet-card__col pet-card__col--1-3 form__col">
                                                                                        <div class="form__field">
                                                                                            <div class="form__field-block form__field-block--label">
                                                                                                <label for="pet-card-select22" class="form__label">
                                                                                                    <span class="form__label-text">Пол</span>
                                                                                                </label>
                                                                                            </div>

                                                                                            <div class="form__field-block form__field-block--input">
                                                                                                <div class="form__control">
                                                                                                    <div class="select select--mitigate" data-select>
                                                                                                        <select class="select__control" name="gender" id="pet-card-select22" data-select-control data-placeholder="Выбрать" data-pets-gender-input data-pets-change>
                                                                                                            <option><!-- пустой option для placeholder --></option>
                                                                                                            <option value="1">Мальчик</option>
                                                                                                            <option value="2" selected>Девочка</option>
                                                                                                        </select>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="pet-card__col pet-card__col--1-3 form__col">
                                                                                        <div class="form__field">
                                                                                            <div class="form__field-block form__field-block--label">
                                                                                                <label for="birthdate4" class="form__label">
                                                                                                    <span class="form__label-text">Дата рождения</span>
                                                                                                </label>
                                                                                            </div>

                                                                                            <div class="form__field-block form__field-block--input">
                                                                                                <div class="input input--iconed">
                                                                                                    <input inputmode="numeric"
                                                                                                        class="input__control"
                                                                                                        name="birthdate"
                                                                                                        id="birthdate4"
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

                                                                                    <div class="pet-card__col pet-card__col--1-2 pet-card__col--1 form__col">
                                                                                        <div class="form__field">
                                                                                            <div class="form__field-block form__field-block--label">
                                                                                                <label for="pet-card-select222" class="form__label">
                                                                                                    <span class="form__label-text">Порода</span>
                                                                                                </label>
                                                                                            </div>

                                                                                            <div class="form__field-block form__field-block--input">
                                                                                                <div class="form__control">
                                                                                                    <div class="select select--mitigate" data-select>
                                                                                                        <select class="select__control" name="breed" id="pet-card-select222" data-select-control data-placeholder="Выбрать" data-pets-breed-input data-pets-change>
                                                                                                            <option><!-- пустой option для placeholder --></option>
                                                                                                            <option value="1">Лабрадор</option>
                                                                                                            <option value="2">Пудель</option>
                                                                                                            <option value="3">Болонка</option>
                                                                                                            <option value="4">Мопс</option>
                                                                                                            <option value="5">Китайская хохлатая</option>
                                                                                                            <option value="6">Кавалер кинг чарльз спаниель</option>
                                                                                                            <option value="7">Дог</option>
                                                                                                            <option value="8" selected>Русская голубая</option>
                                                                                                        </select>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="pet-card__col pet-card__col--1-2 pet-card__col--2 form__col">
                                                                                        <div class="form__field">
                                                                                            <div class="form__field-block form__field-block--label">
                                                                                                <label for="text199" class="form__label">
                                                                                                    <span class="form__label-text">Кличка</span>
                                                                                                </label>
                                                                                            </div>

                                                                                            <div class="form__field-block form__field-block--input">
                                                                                                <div class="input">
                                                                                                    <input type="text" value="Мурка" class="input__control" name="nickname" id="text199" placeholder="Выбрать" data-pets-name-input data-pets-change>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="pet-card__buttons">
                                                                                    <button type="submit" class="pet-card__button button button--rounded button--covered button--green button--full" data-pets-save>
                                                                                        Сохранить изменения
                                                                                    </button>

                                                                                    <button type="button" class="pet-card__button button button--rounded button--mixed button--red button--full" data-pets-cancel>
                                                                                        Отменить изменения
                                                                                    </button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </article>
                                                                    <!--/Карточка питомца-->
                                                                </li>
                                                            </ul>

                                                            <div class="pet-cards__adding">
                                                                <button type="button" class="button button--rounded button--covered button--white-green button--full" data-pets-add>
                                                                    <span class="button__icon button__icon--medium">
                                                                        <svg class="icon icon--add-circle">
                                                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-add-circle"></use>
                                                                        </svg>
                                                                    </span>
                                                                    <span class="button__text">Добавить питомца</span>
                                                                </button>
                                                            </div>

                                                            <!--/Шаблон карточки для добавления на страницу-->
                                                            <script id="hidden-template-pet" type="text/x-custom-template">
                                                                <li class="pet-cards__item">
                                                                    <!--Карточка питомца-->
                                                                    <article class="pet-card pet-card--editing" data-pets-card data-pets-new>
                                                                        <div class="pet-card__main box box--circle" data-pets-main>
                                                                            <div class="pet-card__content">
                                                                                <div class="pet-card__avatar" data-pets-type>
                                                                                    <svg class="icon icon--dog">
                                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-dog"></use>
                                                                                    </svg>
                                                                                </div>

                                                                                <div class="pet-card__info">
                                                                                    <div class="pet-card__name" data-pets-name></div>

                                                                                    <div class="pet-card__breed" data-pets-breed></div>

                                                                                    <div class="pet-card__info-record">
                                                                                        <div class="pet-card__gender" data-pets-gender>
                                                                                            <svg class="icon icon--man">
                                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-man"></use>
                                                                                            </svg>
                                                                                        </div>

                                                                                        <div class="pet-card__date" data-pets-date></div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="pet-card__actions">
                                                                                <div class="pet-card__modify">
                                                                                    <button type="button" class="pet-card__actions-button button button--iconed button--simple button--red" data-tippy-content="Редактировать" data-pets-modify>
                                                                                        <span class="button__icon">
                                                                                            <svg class="icon icon--edit">
                                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-edit"></use>
                                                                                            </svg>
                                                                                        </span>
                                                                                    </button>
                                                                                </div>
                            
                                                                                <div class="pet-card__delete">
                                                                                    <button type="button" class="pet-card__actions-button button button--iconed button--simple button--red" data-tippy-content="Удалить" data-pets-delete>
                                                                                        <span class="button__icon">
                                                                                            <svg class="icon icon--basket">
                                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-basket"></use>
                                                                                            </svg>
                                                                                        </span>
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="pet-card__edit box box--rounded-sm" data-pets-edit>
                                                                            <form class="form" action="" method="post" data-pets-form data-validation="add-pets">
                                                                                <div class="pet-card__row form__row">
                                                                                    <div class="pet-card__col pet-card__col--1-3 pet-card__col--3 form__col">
                                                                                        <div class="form__field">
                                                                                            <div class="form__field-block form__field-block--label">
                                                                                                <label for="type-#ID#" class="form__label">
                                                                                                    <span class="form__label-text">Тип питомца</span>
                                                                                                </label>
                                                                                            </div>
                                                    
                                                                                            <div class="form__field-block form__field-block--input">
                                                                                                <div class="form__control">
                                                                                                    <div class="select select--mitigate select--iconed" data-select>
                                                                                                        <select class="select__control" name="type" id="type-#ID#" data-select-control data-placeholder="Выбрать" data-pets-type-input data-pets-change>
                                                                                                            <option><!-- пустой option для placeholder --></option>
                                                                                                            <option value="1" data-option-icon="cat">Кошка</option>
                                                                                                            <option value="2"data-pets-card data-option-icon="dog">Собака</option>
                                                                                                        </select>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="pet-card__col pet-card__col--1-3 form__col">
                                                                                        <div class="form__field">
                                                                                            <div class="form__field-block form__field-block--label">
                                                                                                <label for="gender-#ID#" class="form__label">
                                                                                                    <span class="form__label-text">Пол</span>
                                                                                                </label>
                                                                                            </div>

                                                                                            <div class="form__field-block form__field-block--input">
                                                                                                <div class="form__control">
                                                                                                    <div class="select select--mitigate" data-select>
                                                                                                        <select class="select__control" name="gender" id="gender-#ID#" data-select-control data-placeholder="Выбрать" data-pets-gender-input data-pets-change>
                                                                                                            <option><!-- пустой option для placeholder --></option>
                                                                                                            <option value="1">Мальчик</option>
                                                                                                            <option value="2">Девочка</option>
                                                                                                        </select>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="pet-card__col pet-card__col--1-3 form__col">
                                                                                        <div class="form__field">
                                                                                            <div class="form__field-block form__field-block--label">
                                                                                                <label for="birthdate" class="form__label">
                                                                                                    <span class="form__label-text">Дата рождения</span>
                                                                                                </label>
                                                                                            </div>

                                                                                            <div class="form__field-block form__field-block--input">
                                                                                                <div class="input input--iconed">
                                                                                                    <input inputmode="numeric"
                                                                                                        class="input__control"
                                                                                                        name="birthdate"
                                                                                                        id="birthdate"
                                                                                                        placeholder="ДД.ММ.ГГГГ"
                                                                                                        data-mask-date 
                                                                                                        data-inputmask-alias="datetime"
                                                                                                        data-inputmask-inputformat="dd.mm.yyyy"
                                                                                                        data-pets-date-input
                                                                                                        data-pets-change
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

                                                                                    <div class="pet-card__col pet-card__col--1-2 pet-card__col--1 form__col">
                                                                                        <div class="form__field">
                                                                                            <div class="form__field-block form__field-block--label">
                                                                                                <label for="breed-#ID#" class="form__label">
                                                                                                    <span class="form__label-text">Порода</span>
                                                                                                </label>
                                                                                            </div>
                                                    
                                                                                            <div class="form__field-block form__field-block--input">
                                                                                                <div class="form__control">
                                                                                                    <div class="select select--mitigate" data-select>
                                                                                                        <select class="select__control" name="breed" id="breed-#ID#" data-select-control data-placeholder="Выбрать" data-pets-breed-input data-pets-change>
                                                                                                            <option><!-- пустой option для placeholder --></option>
                                                                                                            <option value="1">Лабрадор</option>
                                                                                                            <option value="2">Пудель</option>
                                                                                                            <option value="3">Болонка</option>
                                                                                                            <option value="4">Мопс</option>
                                                                                                            <option value="5">Китайская хохлатая</option>
                                                                                                            <option value="6">Кавалер кинг чарльз спаниель</option>
                                                                                                            <option value="7">Дог</option>
                                                                                                        </select>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="pet-card__col pet-card__col--1-2 pet-card__col--2 form__col">
                                                                                        <div class="form__field">
                                                                                            <div class="form__field-block form__field-block--label">
                                                                                                <label for="text1999" class="form__label">
                                                                                                    <span class="form__label-text">Кличка</span>
                                                                                                </label>
                                                                                            </div>

                                                                                            <div class="form__field-block form__field-block--input">
                                                                                                <div class="input">
                                                                                                    <input type="text" class="input__control" name="nickname" id="text1999" placeholder="Выбрать" data-pets-name-input data-pets-change>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="pet-card__buttons">
                                                                                    <button type="submit" class="pet-card__button button button--rounded button--covered button--green button--full button--disabled" disabled data-pets-save>
                                                                                        Сохранить изменения
                                                                                    </button>

                                                                                    <button type="button" class="pet-card__button button button--rounded button--mixed button--red button--full" data-pets-cancel>
                                                                                        Отменить изменения
                                                                                    </button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </article>
                                                                    <!--/Карточка питомца-->
                                                                </li>
                                                            </script>
                                                            <!--/Шаблон карточки для добавления на страницу-->
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="profile__block">
                                                    <section class="section">
                                                        <form class="form form--wraped" action="" method="post">
                                                            <div class="section__box box box--gray box--rounded-sm">
                                                                <h4 class="section__title">Наставник</h4>

                                                                <div class="section__wrapper">
                                                                     <!--dropzone-->
                                                                    <div class="profile__dropzone dropzone dropzone--image dropzone--simple" data-uploader>
                                                                        <input type="file" name="uploadFiles[]" multiple class="dropzone__control">

                                                                        <div class="dropzone__area" data-uploader-area='{"paramName": "uploadFiles[]", "url":"/_markup/gui.php", "images": true, "single": true}'>
                                                                            <div class="dropzone__message dz-message needsclick">
                                                                                <div class="dropzone__message-button dz-button link needsclick" data-uploader-previews>
                                                                                    <svg class="dropzone__message-button-icon icon icon--camera">
                                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-camera"></use>
                                                                                    </svg>
                                                                                </div>
                                                                            </div>

                                                                            <div class="dropzone__previews dz-previews" data-uploader-previews>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!--/dropzone-->

                                                                    <div class="section__box-inner">
                                                                        <div class="section__box-content box box--white box--rounded-sm box--inner">
                                                                            <div class="section__box-block">
                                                                                <div class="form__row form__row--special">
                                                                                    <div class="form__col">
                                                                                        <div class="form__field">
                                                                                            <div class="form__field-block form__field-block--label">
                                                                                                <label for="text-required" class="form__label form__label--required">
                                                                                                    <span class="form__label-text">Фамилия</span>
                                                                                                </label>
                                                                                            </div>

                                                                                            <div class="form__field-block form__field-block--input">
                                                                                                <div class="input">
                                                                                                    <input type="text" class="input__control" name="text-required" id="text-required" placeholder="Введите фамилию">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="form__col">
                                                                                        <div class="form__field">
                                                                                            <div class="form__field-block form__field-block--label">
                                                                                                <label for="text-required" class="form__label form__label--required">
                                                                                                    <span class="form__label-text">Имя</span>
                                                                                                </label>
                                                                                            </div>

                                                                                            <div class="form__field-block form__field-block--input">
                                                                                                <div class="input">
                                                                                                    <input type="text" class="input__control" name="text-required" id="text-required" placeholder="Введите имя">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="form__col">
                                                                                        <div class="form__field">
                                                                                            <div class="form__field-block form__field-block--label">
                                                                                                <label for="text-required" class="form__label form__label--required">
                                                                                                    <span class="form__label-text">Отчество</span>
                                                                                                </label>
                                                                                            </div>

                                                                                            <div class="form__field-block form__field-block--input">
                                                                                                <div class="input">
                                                                                                    <input type="text" class="input__control" name="text-required" id="text-required" placeholder="Введите отчество">
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
                                                                                            <label for="text-required" class="form__label form__label--required">
                                                                                                <span class="form__label-text">E-mail</span>
                                                                                            </label>
                                                                                        </div>

                                                                                        <div class="form__field-block form__field-block--input">
                                                                                            <div class="input">
                                                                                                <input type="text" class="input__control" name="text-required" id="text-required" placeholder="example@email.com" data-mail inputmode="email">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form__col">
                                                                                    <div class="form__field">
                                                                                        <div class="form__field-block form__field-block--label">
                                                                                            <label for="text-required" class="form__label form__label--required">
                                                                                                <span class="form__label-text">Телефон</span>
                                                                                            </label>
                                                                                        </div>

                                                                                        <div class="form__field-block form__field-block--input">
                                                                                            <div class="input">
                                                                                                <input type="tel" class="input__control" name="text-required" id="text-required" placeholder="+7 (___) ___-__-__" data-phone inputmode="text">
                                                                                            </div>
                                                                                        </div>

                                                                                        <button type="button" class="form__field-button button button--simple button--red button--underlined button--tiny">
                                                                                            Отправить проверочный код
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="form__row">
                                                                                <div class="form__col">
                                                                                    <div class="form__field">
                                                                                        <div class="form__field-block form__field-block--label">
                                                                                            <label for="select22" class="form__label form__label--required">
                                                                                                <span class="form__label-text">Населенный пункт</span>
                                                                                            </label>
                                                                                        </div>
                                        
                                                                                        <div class="form__field-block form__field-block--input">
                                                                                            <div class="form__control">
                                                                                                <div class="select select--mitigate" data-select>
                                                                                                    <select class="select__control" name="select22" id="select22" data-select-control data-placeholder="Выберите город">
                                                                                                        <option><!-- пустой option для placeholder --></option>
                                                                                                        <option value="1">Москва</option>
                                                                                                        <option value="2">Нижний Новгород</option>
                                                                                                        <option value="3">Самара</option>
                                                                                                        <option value="4">Челябинск</option>
                                                                                                    </select>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form__col">
                                                                                    <div class="form__field">
                                                                                        <div class="form__field-block form__field-block--label">
                                                                                            <label for="select22" class="form__label form__label--required">
                                                                                                <span class="form__label-text">Пункт выдачи заказов</span>
                                                                                            </label>
                                                                                        </div>
                                        
                                                                                        <div class="form__field-block form__field-block--input">
                                                                                            <div class="form__control">
                                                                                                <div class="select select--mitigate" data-select>
                                                                                                    <select class="select__control" name="select22" data-select-control data-placeholder="Выберите город">
                                                                                                        <option><!-- пустой option для placeholder --></option>
                                                                                                        <option value="1">Москва</option>
                                                                                                        <option value="2">Нижний Новгород</option>
                                                                                                        <option value="3">Самара</option>
                                                                                                        <option value="4">Челябинск</option>
                                                                                                    </select>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </section>
                                                </div>

                                                <div class="profile__block">
                                                    <section class="section">
                                                        <div class="section__box box box--gray box--rounded-sm">
                                                            <h4 class="section__title">Система лояльности</h4>

                                                            <div class="section__box-inner">
                                                                <h5 class="box__heading box__heading--middle">Достижения в системе лояльности</h5>

                                                                <div class="success-cards">
                                                                    <div class="success-cards__item">
                                                                        <div class="success-card success-card--green">
                                                                            <span class="success-card__title heading heading--large">К2</span>
                                                                            <span class="success-card__info">Уровень аккаунта</span>
                                                                        </div>
                                                                    </div>

                                                                    <div class="success-cards__item">
                                                                        <div class="success-card success-card--red">
                                                                            <span class="success-card__title heading heading--large">5%</span>
                                                                            <span class="success-card__info">Персональная скидка</span>
                                                                        </div>
                                                                    </div>

                                                                    <div class="success-cards__item">
                                                                        <div class="success-card success-card--violet">
                                                                            <span class="success-card__title heading heading--large">808</span>
                                                                            <span class="success-card__info">Сумма баллов за IV квартал 2022</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="section__box-inner">
                                                                <h5 class="box__heading box__heading--middle">Плановые показатели</h5>
                                                            </div>

                                                            <div class="section__box-inner">
                                                                <h5 class="box__heading box__heading--middle">Преимущества аккаунтов разного уровня</h5>
                                                            </div>
                                                        </div>
                                                    </section>
                                                </div>

                                                <div class="profile__block">
                                                    <section class="section">
                                                        <div class="section__box box box--gray box--rounded-sm">
                                                            <h4 class="section__title">Персональные акции</h4>

                                                            <div class="section__box-inner">
                                                                <h5 class="box__heading box__heading--middle">Участие в персональной акции</h5>

                                                                <div class="profile__order box box--white box--circle">
                                                                    <div class="profile__order-row">
                                                                        <div class="profile__order-col">
                                                                            <h5 class="profile__order-heading heading headding--small">
                                                                                Заказ от 02.08.2022
                                                                            </h5>
                                                                            <span class="profile__order-number">№543268</span>
                                                                        </div>
    
                                                                        <div class="profile__order-col">
                                                                            <div class="price">
                                                                                <div class="price__calculation price__calculation--columned">
                                                                                    <p class="price__calculation-total">1 420 ₽</p>
                                                                                    <p class="price__calculation-accumulation">14 ББ</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="section__box-inner">
                                                                <h5 class="box__heading box__heading--middle">Актуальные акции</h5>

                                                                <div class="profile__stocks cards-stock">
                                                                    <ul class="cards-stock__list">
                                                                        <li class="cards-stock__item">
                                                                            <div class="card-stock">
                                                                                <a href="#" class="card-stock__link"></a>
                                                                                <div class="card-stock__inner">
                                                                                    <div class="card-stock__top">
                                                                                        <div class="card-stock__wrapper">
                                                                                            <div class="card-stock__image box box--circle">
                                                                                                <img src="https://fakeimg.pl/366x312/" alt="#" class="card-stock__image-picture">
                                                                                            </div>
                                                                                            <div class="card-stock__finish date-finish">
                                                                                                <span class="date-finish__icon">
                                                                                                    <svg class="date-finish__icon icon icon--clock">
                                                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-clock"></use>
                                                                                                    </svg>
                                                                                                </span>
                                                                                                <span class="date-finish__text">
                                                                                                    <span class="date-finish__text date-finish__text--desktop">
                                                                                                        Действует
                                                                                                    </span>
                                                                                                    до
                                                                                                    <time datetime="2022-09-20">20.09.2022</time>
                                                                                                </span>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="card-stock__devider dots">
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="card-stock__bottom">
                                                                                        <p class="card-stock__title">
                                                                                            Скидка 15%
                                                                                        </p>
                                                                                        <p class="card-stock__text">
                                                                                            На развивающие игрушки для кошек Complemento
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                        <li class="cards-stock__item">
                                                                            <div class="card-stock">
                                                                                <a href="#" class="card-stock__link"></a>
                                                                                <div class="card-stock__inner">
                                                                                    <div class="card-stock__top">
                                                                                        <div class="card-stock__wrapper">
                                                                                            <div class="card-stock__image box box--circle">
                                                                                                <img src="https://fakeimg.pl/366x312/" alt="#" class="card-stock__image-picture">
                                                                                            </div>
                                                                                            <div class="card-stock__finish date-finish">
                                                                                                <span class="date-finish__icon">
                                                                                                    <svg class="date-finish__icon icon icon--clock">
                                                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-clock"></use>
                                                                                                    </svg>
                                                                                                </span>
                                                                                                <span class="date-finish__text">
                                                                                                    <span class="date-finish__text date-finish__text--desktop">
                                                                                                        Действует
                                                                                                    </span>
                                                                                                    до
                                                                                                    <time datetime="2022-09-20">20.09.2022</time>
                                                                                                </span>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="card-stock__devider dots">
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="card-stock__bottom">
                                                                                        <p class="card-stock__title">
                                                                                            Скидка 15%
                                                                                        </p>
                                                                                        <p class="card-stock__text">
                                                                                            На развивающие игрушки для кошек Complemento
                                                                                            На развивающие игрушки для кошек Complemento
                                                                                            На развивающие игрушки для кошек Complemento
                                                                                            На развивающие игрушки для кошек Complemento
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                        <li class="cards-stock__item">
                                                                            <div class="card-stock">
                                                                                <a href="#" class="card-stock__link"></a>
                                                                                <div class="card-stock__inner">
                                                                                    <div class="card-stock__top">
                                                                                        <div class="card-stock__wrapper">
                                                                                            <div class="card-stock__image box box--circle">
                                                                                                <img src="https://fakeimg.pl/366x312/" alt="#" class="card-stock__image-picture">
                                                                                            </div>
                                                                                            <div class="card-stock__finish date-finish">
                                                                                                <span class="date-finish__icon">
                                                                                                    <svg class="date-finish__icon icon icon--clock">
                                                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-clock"></use>
                                                                                                    </svg>
                                                                                                </span>
                                                                                                <span class="date-finish__text">
                                                                                                    <span class="date-finish__text date-finish__text--desktop">
                                                                                                        Действует
                                                                                                    </span>
                                                                                                    до
                                                                                                    <time datetime="2022-09-20">20.09.2022</time>
                                                                                                </span>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="card-stock__devider dots">
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="card-stock__bottom">
                                                                                        <p class="card-stock__title">
                                                                                            Скидка 15%
                                                                                        </p>
                                                                                        <p class="card-stock__text">
                                                                                            На развивающие игрушки для кошек Complemento
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                        <li class="cards-stock__item">
                                                                            <div class="card-stock">
                                                                                <a href="#" class="card-stock__link"></a>
                                                                                <div class="card-stock__inner">
                                                                                    <div class="card-stock__top">
                                                                                        <div class="card-stock__wrapper">
                                                                                            <div class="card-stock__image box box--circle">
                                                                                                <img src="https://fakeimg.pl/366x312/" alt="#" class="card-stock__image-picture">
                                                                                            </div>
                                                                                            <div class="card-stock__finish date-finish">
                                                                                                <span class="date-finish__icon">
                                                                                                    <svg class="date-finish__icon icon icon--clock">
                                                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-clock"></use>
                                                                                                    </svg>
                                                                                                </span>
                                                                                                <span class="date-finish__text">
                                                                                                    <span class="date-finish__text date-finish__text--desktop">
                                                                                                        Действует
                                                                                                    </span>
                                                                                                    до
                                                                                                    <time datetime="2022-09-20">20.09.2022</time>
                                                                                                </span>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="card-stock__devider dots">
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="card-stock__bottom">
                                                                                        <p class="card-stock__title">
                                                                                            Скидка 15%
                                                                                            Скидка 15%
                                                                                            Скидка 15%
                                                                                            Скидка 15%
                                                                                        </p>
                                                                                        <p class="card-stock__text">
                                                                                            На развивающие игрушки для кошек Complemento
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                        <li class="cards-stock__item">
                                                                            <div class="card-stock">
                                                                                <a href="#" class="card-stock__link"></a>
                                                                                <div class="card-stock__inner">
                                                                                    <div class="card-stock__top">
                                                                                        <div class="card-stock__wrapper">
                                                                                            <div class="card-stock__image box box--circle">
                                                                                                <img src="https://fakeimg.pl/366x312/" alt="#" class="card-stock__image-picture">
                                                                                            </div>
                                                                                            <div class="card-stock__finish date-finish">
                                                                                                <span class="date-finish__icon">
                                                                                                    <svg class="date-finish__icon icon icon--clock">
                                                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-clock"></use>
                                                                                                    </svg>
                                                                                                </span>
                                                                                                <span class="date-finish__text">
                                                                                                    <span class="date-finish__text date-finish__text--desktop">
                                                                                                        Действует
                                                                                                    </span>
                                                                                                    до
                                                                                                    <time datetime="2022-09-20">20.09.2022</time>
                                                                                                </span>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="card-stock__devider dots">
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="card-stock__bottom">
                                                                                        <p class="card-stock__title">
                                                                                            Скидка 15%
                                                                                        </p>
                                                                                        <p class="card-stock__text">
                                                                                            На развивающие игрушки для кошек Complemento
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                        <li class="cards-stock__item">
                                                                            <div class="card-stock">
                                                                                <a href="#" class="card-stock__link"></a>
                                                                                <div class="card-stock__inner">
                                                                                    <div class="card-stock__top">
                                                                                        <div class="card-stock__wrapper">
                                                                                            <div class="card-stock__image box box--circle">
                                                                                                <img src="https://fakeimg.pl/366x312/" alt="#" class="card-stock__image-picture">
                                                                                            </div>
                                                                                            <div class="card-stock__finish date-finish">
                                                                                                <span class="date-finish__icon">
                                                                                                    <svg class="date-finish__icon icon icon--clock">
                                                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-clock"></use>
                                                                                                    </svg>
                                                                                                </span>
                                                                                                <span class="date-finish__text">
                                                                                                    <span class="date-finish__text date-finish__text--desktop">
                                                                                                        Действует
                                                                                                    </span>
                                                                                                    до
                                                                                                    <time datetime="2022-09-20">20.09.2022</time>
                                                                                                </span>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="card-stock__devider dots">
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                            <span class="dots__item"></span>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="card-stock__bottom">
                                                                                        <p class="card-stock__title">
                                                                                            Скидка 15%
                                                                                        </p>
                                                                                        <p class="card-stock__text">
                                                                                            На развивающие игрушки для кошек Complemento
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                    
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </section>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="tabs__block" data-tab-section="history">
                                            История заказов
                                        </div>

                                        <div class="tabs__block" data-tab-section="calculator">
                                            Калькулятор доходности
                                        </div>

                                        <div class="tabs__block" data-tab-section="report">
                                            Отчетность по объемам продаж
                                        </div>

                                        <div class="tabs__block" data-tab-section="notification">
                                            Уведомления
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
<!DOCTYPE html>
<html lang="ru">
    <head>
        <title>О компании</title>

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
                <main class="page__about about">
                    <div class="breadcrumbs">
                        <ul class="breadcrumbs__list">
                            <li class="breadcrumbs__item">
                                <a href="#" class="breadcrumbs__link">Главная</a>
                            </li>
                            <li class="breadcrumbs__item breadcrumbs__item--active">
                                <a class="breadcrumbs__link">AmeБизнес</a>
                            </li>
                        </ul>
                    </div>

                    <h1 class="page__heading">AmeБизнес</h1>

                    <div class="content__main">
                        <div class="about__wrapper">
                            <section class="about__hero section">
                                
                                <div class="about__hero-box section__box box box--gray box--rounded-sm">
                                    <div class="about__hero-images">
                                        <img class="about__hero-images-picture" src="/local/templates/.default/images/about-hero.png" alt="hero-img">
                                    </div>
                                    <h3 class="about__hero-title section__title section__title--closer">
                                        AmeAppetite <br>
                                        Заботимся мы — счастливее вы!
                                    </h3>
                                    <div class="about__hero-description">
                                        <p class="about__hero-description-text">
                                            Идея создания компании родилась из нашей любви как к животным, так и к людям. Мы не хотели выбирать и решили воплотить в жизнь мечту приносить пользу тем, кого любим. Мы стремимся заботиться о здоровье наших пушистых друзей и выбираем только качественную продукцию, а также даем возможность каждому стать нашим партнером и предлагаем привлекательные возможности для ведения своего бизнеса, чтобы в жизни каждого было больше ярких эмоций и запоминающихся событий.
                                        </p>
                                        <p class="about__hero-description-text">
                                            Мы любим то, что делаем и хотим расти и становиться лучше вместе с Вами.
                                        </p>
                                    </div>
                                </div>
                            </section>

                            <section class="about__appreciate section">
                                <div class="section__box box">
                                    <div class="section__header about__appreciate-header">
                                        <h3 class="section__title section__title--closer">
                                            Мы ценим
                                        </h3>
                                    </div>
                                    
                                    <ul class="about__appreciate-list">
                                        <li class="about__appreciate-item">
                                            <div class="about__appreciate-card about__appreciate-card--blue">
                                                <img class="about__appreciate-icon" src="/local/templates/.default/images/icons/solidarity.svg" alt="solidarity">
                                                <p class="about__appreciate-text">Честность</p>
                                            </div>
                                        </li>

                                        <li class="about__appreciate-item">
                                            <div class="about__appreciate-card about__appreciate-card--green">
                                                <img class="about__appreciate-icon" src="/local/templates/.default/images/icons/handshake.svg" alt="solidarity">
                                                <p class="about__appreciate-text">Ответсвенность</p>
                                            </div>
                                        </li>

                                        <li class="about__appreciate-item">
                                            <div class="about__appreciate-card about__appreciate-card--eggwhite">
                                                <img class="about__appreciate-icon" src="/local/templates/.default/images/icons/foot.svg" alt="solidarity">
                                                <p class="about__appreciate-text">Персональный подход</p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                               
                            </section>

                            <section class="about__goals section">
                                <div class="section__box box">
                                    <ul class="about__goals-list">
                                        <li class="about__goals-item">
                                            <div class="about__goals-card">
                                                <div class="about__goals-card-wrapper">
                                                    <picture class="about__goals-card-picture">
                                                        <source srcset="/local/templates/.default/images/about-goal-1-mobile.png" media="(max-width: 767px)" />
                                                        <img class="about__goals-card-images" src="/local/templates/.default/images/about-goal-1.png" alt="">
                                                    </picture>
                                                </div>
                                           
                                                <div class="about__goals-card-content">
                                                    <h4 class="about__goals-card-title">
                                                        Дарим пользу
                                                    </h4>
                                                    <p class="about__goals-card-text">
                                                        Наша продукция понравится Вашим питомцам, и Вы захотите ее рекомендовать.
                                                    </p>
                                                </div>
                                            </div>
                                        </li>

                                        <li class="about__goals-item">
                                            <div class="about__goals-card">
                                                <div class="about__goals-card-wrapper">
                                                    <picture class="about__goals-card-picture">
                                                        <source srcset="/local/templates/.default/images/about-goal-2-mobile.png" media="(max-width: 767px)" />
                                                        <img class="about__goals-card-images" src="/local/templates/.default/images/about-goal-2.png" alt="">
                                                    </picture>
                                                </div>
                                                
                                                <div class="about__goals-card-content">
                                                    <h4 class="about__goals-card-title">
                                                        Растем вместе
                                                    </h4>
                                                    <p class="about__goals-card-text">
                                                        Мы ценим наших партнеров и готовы прислушиваться к Вашему мнению, ведь на нем строится наше дело.
                                                    </p>
                                                </div>
                                            </div>
                                        </li>

                                        <li class="about__goals-item about__goals-item--full">
                                            <div class="about__goals-card about__goals-card--full">
                                                <div class="about__goals-card-wrapper">
                                                    <picture class="about__goals-card-picture">
                                                        <source srcset="/local/templates/.default/images/about-goal-3-mobile.png" media="(max-width: 767px)" />
                                                        <img class="about__goals-card-images" src="/local/templates/.default/images/about-goal-3.png" alt="">
                                                    </picture>
                                                </div>
                                               
                                                <div class="about__goals-card-content">
                                                    <h4 class="about__goals-card-title">
                                                        Стремимся к успеху
                                                    </h4>
                                                    <p class="about__goals-card-text">
                                                        Мы строим бизнес так, чтобы дать возможность нашим партнерам рекомендовать качественную продукцию и получать стабильный доход. Мы не экономим на качестве, мы не тратим деньги на рекламу.
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </section>

                            <section class="about__advantages section">
                                <div class="about__advantages-top section__box box box--gray box--rounded-sm">
                                    <div class="about__advantages-wrapper">
                                        <picture class="about__advantages-picture">
                                            <source srcset="/local/templates/.default/images/about-adventages-mobile.png" media="(max-width: 767px)" />
                                            <img class="about__advantages-images" src="/local/templates/.default/images/about-adventages.png" alt="">
                                        </picture>
                                    </div>
                                    <div class="about__advantages-content">
                                        <h3 class="about__advantages-title section__title section__title--closer">
                                            Наша продукция – это то, чем хочется делиться
                                        </h3>
                                        <p class="about__advantages-text">
                                            Мы выбираем только качественную продукцию, которую не стыдно порекомендовать маме, лучшему другу или коллегам в офисе.
                                            Наша цель - объединить людей, которые любят животных и стремятся дать лучшее нашим меньшим братьям, ведь они нам доверяют. 
                                            Поэтому мы предлагаем широкий ассортимент сухих и влажных кормов Premium и Super Premium класса, а также современные и качественные аксессуары по привлекательной цене.
                                        </p>
                                        <ul class="about__advantages-list">
                                            <li class="about__advantages-item">
                                                <div class="about__advantages-card">
                                                    <img class="about__advantages-card-icon" src="/local/templates/.default/images/icons/about-happy.svg" alt="">
                                                    <p class="about__advantages-card-text">На любой вкус</p>
                                                </div>
                                            </li>

                                            <li class="about__advantages-item">
                                                <div class="about__advantages-card">
                                                    <img class="about__advantages-card-icon" src="/local/templates/.default/images/icons/about-vet.svg" alt="">
                                                    <p class="about__advantages-card-text">На любой вкус</p>
                                                </div>
                                            </li>

                                            <li class="about__advantages-item">
                                                <div class="about__advantages-card">
                                                    <img class="about__advantages-card-icon" src="/local/templates/.default/images/icons/about-dog.svg" alt="">
                                                    <p class="about__advantages-card-text">На любой вкус</p>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>   
                                </div>
                                <div class="about__advantages-bottom section__box box">
                                    <div class="adventages-cards adventages-cards--square">
                                        <ul class="adventages-cards__list">
                                            <li class="adventages-cards__item">
                                                <div class="adventages-card adventages-card--bg-gray adventages-card--blue">
                                                    <div class="adventages-card__image">
                                                        <svg class="adventages-card__image-icon adventages-card__image-icon--lg icon icon--check-mark">
                                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check-mark"></use>
                                                        </svg>
                                                    </div>
                                                    <p class="adventages-card__text">
                                                        Комплекс витаминов и минералов
                                                    </p>
                                                </div>
                                            </li>

                                            <li class="adventages-cards__item">
                                                <div class="adventages-card adventages-card--bg-gray adventages-card--gold">
                                                    <div class="adventages-card__image">
                                                        <svg class="adventages-card__image-icon adventages-card__image-icon--lg icon icon--check-mark">
                                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check-mark"></use>
                                                        </svg>
                                                    </div>
                                                    <p class="adventages-card__text">
                                                        Сбалансированная формула
                                                    </p>
                                                </div>
                                            </li>

                                            <li class="adventages-cards__item">
                                                <div class="adventages-card adventages-card--bg-gray adventages-card--wisteria">
                                                    <div class="adventages-card__image">
                                                        <svg class="adventages-card__image-icon adventages-card__image-icon--lg icon icon--check-mark">
                                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check-mark"></use>
                                                        </svg>
                                                    </div>
                                                    <p class="adventages-card__text">
                                                        Комплекс витаминов и минералов
                                                    </p>
                                                </div>
                                            </li>

                                            <li class="adventages-cards__item">
                                                <div class="adventages-card adventages-card--bg-gray adventages-card--piper">
                                                    <div class="adventages-card__image">
                                                        <svg class="adventages-card__image-icon adventages-card__image-icon--lg icon icon--check-mark">
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
                            </section>

                            <section class="about__cert section">
                                <div class="about__cert-box section__box box">
                                    <div class=" section__header">
                                        <h3 class="about__cert-title section__title section__title--closer">
                                            Сертификаты, подтверждающие качество нашей продукции
                                        </h3>
                                    </div>

                                    <div class="about__cert-list documents">
                                        <div class="about__cert-item documents__item">
                                            <div class="document document--column">
                                                <a href="/local/templates/.default/images/main-slider-desktop.jpg" class="document__link" target="_blank">
                                                    <div class="document__icon">
                                                        <svg class="icon icon--pdf">
                                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-pdf"></use>
                                                        </svg>
                                                    </div>
                                                    <div class="document__text">
                                                        <span class="document__text-name">Сертификат о государственной регистрации</span>
                                                        <span class="document__text-size">(630 KB)</span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="about__cert-item documents__item">
                                            <div class="document document--column">
                                                <a href="/local/templates/.default/images/main-slider-desktop.jpg" class="document__link" target="_blank">
                                                    <div class="document__icon">
                                                        <svg class="icon icon--pdf">
                                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-pdf"></use>
                                                        </svg>
                                                    </div>
                                                    <div class="document__text">
                                                        <span class="document__text-name">Заключение ветеринарной комиссии</span>
                                                        <span class="document__text-size">(630 KB)</span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="about__cert-item documents__item">
                                            <div class="document document--column">
                                                <a href="/local/templates/.default/images/main-slider-desktop.jpg" class="document__link" target="_blank">
                                                    <div class="document__icon">
                                                        <svg class="icon icon--pdf">
                                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-pdf"></use>
                                                        </svg>
                                                    </div>
                                                    <div class="document__text">
                                                        <span class="document__text-name">Часто задаваемые вопросы</span>
                                                        <span class="document__text-size">(1.2 Mb)</span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="about__cert-item documents__item">
                                            <div class="document document--column">
                                                <a href="/local/templates/.default/images/main-slider-desktop.jpg" class="document__link" target="_blank">
                                                    <div class="document__icon">
                                                        <svg class="icon icon--pdf">
                                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-pdf"></use>
                                                        </svg>
                                                    </div>
                                                    <div class="document__text">
                                                        <span class="document__text-name">Сертификат о безопасности</span>
                                                        <span class="document__text-size">(630 KB)</span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="about__cert-item documents__item">
                                            <div class="document document--column">
                                                <a href="/local/templates/.default/images/main-slider-desktop.jpg" class="document__link" target="_blank">
                                                    <div class="document__icon">
                                                        <svg class="icon icon--pdf">
                                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-pdf"></use>
                                                        </svg>
                                                    </div>
                                                    <div class="document__text">
                                                        <span class="document__text-name">Сертификат о безопасности</span>
                                                        <span class="document__text-size">(630 KB)</span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="about__cert-item documents__item">
                                            <div class="document document--column">
                                                <a href="/local/templates/.default/images/main-slider-desktop.jpg" class="document__link" target="_blank">
                                                    <div class="document__icon">
                                                        <svg class="icon icon--pdf">
                                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-pdf"></use>
                                                        </svg>
                                                    </div>
                                                    <div class="document__text">
                                                        <span class="document__text-name">Сертификат о безопасности</span>
                                                        <span class="document__text-size">(630 KB)</span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="about__cert-item documents__item">
                                            <div class="document document--column">
                                                <a href="/local/templates/.default/images/main-slider-desktop.jpg" class="document__link" target="_blank">
                                                    <div class="document__icon">
                                                        <svg class="icon icon--pdf">
                                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-pdf"></use>
                                                        </svg>
                                                    </div>
                                                    <div class="document__text">
                                                        <span class="document__text-name">Сертификат о безопасности</span>
                                                        <span class="document__text-size">(630 KB)</span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </section>

                            <section class="about__business section">
                                <div class="about__business-box section__box box">
                                    <div class="about__business-header section__header">
                                        <h2 class="about__cert-title section__title section__title--closer">
                                            Бизнес с нами
                                        </h2>
                                    </div>

                                    <div class="about__business-steps work-steps">
                                        <div class="work-steps__box section__box box box--gray">
                                            <div class="work-steps__header section__header">
                                                <h3 class="section__title section__title--closer">Как это рабоатет</h3>
                                            </div>
                                            <ul class="work-steps__list">
                                                <li class="work-steps__item">
                                                    <div class="work-step work-step--red">
                                                        <span class="work-step__count">
                                                            <img class="work-step__count-picture" src="/local/templates/.default/images/hexagon-step-1.png" alt="how-work-steps-step-1">
                                                        </span>
                                                        <div class="work-step__wrapper">
                                                            <h6 class="work-step__text">Вы покупаете нашу продукцию</h6>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li class="work-steps__item">
                                                    <div class="work-step work-step--piper">
                                                        <span class="work-step__count">
                                                            <img class="work-step__count-picture" src="/local/templates/.default/images/hexagon-step-2.png" alt="how-work-steps-step-1">
                                                        </span>
                                                        <div class="work-step__wrapper">
                                                            <h6 class="work-step__text">
                                                                Ваш питомец доволен и Вы довольны
                                                            </h6>
                                                        </div>
                                                    </div>
                                                
                                                
                                                </li>

                                                <li class="work-steps__item">
                                                    <div class="work-step work-step--gold">
                                                        <span class="work-step__count">
                                                            <img class="work-step__count-picture" src="/local/templates/.default/images/hexagon-step-3.png" alt="how-work-steps-step-1">
                                                        </span>
                                                        <div class="work-step__wrapper">
                                                            <h6 class="work-step__text">
                                                                Вы рекомендуете нашу продукцию своим друзьям
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li class="work-steps__item">
                                                    <div class="work-step work-step--green">
                                                        <span class="work-step__count">
                                                            <img class="work-step__count-picture" src="/local/templates/.default/images/hexagon-step-4.png" alt="how-work-steps-step-1">
                                                        </span>
                                                        <div class="work-step__wrapper">
                                                            <h6 class="work-step__text">
                                                                Ваши друзья рекомендуют нашу продукцию своим коллегам
                                                            </h6>
                                                        </div>
                                                    </div>
                                                    

                                                </li>

                                                <li class="work-steps__item">
                                                    <div class="work-step work-step--blue">
                                                        <span class="work-step__count">
                                                            <img class="work-step__count-picture" src="/local/templates/.default/images/hexagon-step-5.png" alt="how-work-steps-step-1">
                                                        </span>
                                                        <div class="work-step__wrapper">
                                                            <h6 class="work-step__text">
                                                                Вы получаете вознаграждение за свою рекомендацию и начинаете работать как партнер AmeAppetite
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="about__business-node">
                                        <svg class="about__business-node-icon" class="icon icon--double-quotes">
                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-double-quotes"></use>
                                        </svg>
                                        <p class="about__business-node-text">
                                            Мы хотим дать возможность нашим покупателям стать нашими настоящими партнерами, чтобы о качестве нашей продукции рассказывали не мы сами в кричащих рекламных роликах, а Вы – честные потребители.
                                        </p>
                                    </div>
                                </div> 
                            </section>

                            <section class="section">
                                <div class="section__box box">
            
                                </div> 
                            </section>

                            <section class="section">
                                <div class="section__box box">
            
                                </div> 
                            </section>

                            <section class="section">
                                <div class="section__box box">
            
                                </div> 
                            </section>
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
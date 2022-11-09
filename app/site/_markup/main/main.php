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

                    <div class="content__main">
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

                        <section class="main__section main__section--separated">
                            <div class="subject">
                                <div class="subject__row">
                                    <div class="subject__item box box--circle box--grayish">
                                        <a href="#" class="subject__link"></a>
                                        <div class="subject__info">
                                            <h3 class="subject__title">Товары для собак</h3>
                                            <span type="button" class="button button--simple button--red">
                                                <span class="button__icon button__icon--right">
                                                    <svg class="icon icon--arrow-right-light">
                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-right-light"></use>
                                                    </svg>
                                                </span>
                                                <span class="button__text">Смотреть</span>
                                            </span>
                                        </div>

                                        <div class="subject__image">
                                            <img src="/local/templates/.default/images/dog.png" alt="Каталог для собак" class="subject__image-pic">
                                        </div>
                                    </div>

                                    <div class="subject__item box box--circle box--grayish">
                                        <a href="#" class="subject__link"></a>
                                        <div class="subject__info">
                                            <h3 class="subject__title">Товары для кошек</h3>
                                            <span type="button" class="button button--simple button--red">
                                                <span class="button__icon button__icon--right">
                                                    <svg class="icon icon--arrow-right-light">
                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-right-light"></use>
                                                    </svg>
                                                </span>
                                                <span class="button__text">Смотреть</span>
                                            </span>
                                        </div>

                                        <div class="subject__image">
                                            <img src="/local/templates/.default/images/cat.png" alt="Каталог для собак" class="subject__image-pic">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <section class="main__section main__section--separated">Хиты продаж</section>

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
                            <div class="banner">
                                <div class="banner__image">
                                    <img class="banner__image-picture" src="/local/templates/.default/images/howbecome-banner.png" alt="">
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

                        <section class="main__section">О компании</section>
                    </div>
                </main>
            </div>
        </div>
        <!--content-->

        <? include_once("../include/footer.php"); ?>

        <script src="/local/templates/.default/js/script.js"></script>
    </body>

</html>
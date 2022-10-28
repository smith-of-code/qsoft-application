<!DOCTYPE html>
<html lang="ru">
    <head>
        <title>Отчетность</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1 maximum-scale=1 user-scalable=0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" type="text/css" href="/local/templates/.default/css/style.css" />
    </head>

    <body class="page">

        <? include_once("../include/header.php"); ?>

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
                                                    <svg class="icon icon--profile">
                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-profile"></use>
                                                    </svg>
                                                </span>
                                                <span class="menu__text">
                                                    Профиль
                                                </span>
                                            </a>
                                        </li>

                                        <li class="menu__item">
                                            <a href="#" class="menu__link">
                                                <span class="menu__icon">
                                                    <svg class="icon icon--receipts">
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
                                                    <svg class="icon icon--calculator">
                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-calculator"></use>
                                                    </svg>
                                                </span>
                                                <span class="menu__text">
                                                    Калькулятор доходности
                                                </span>
                                            </a>
                                        </li>

                                        <li class="menu__item menu__item--active">
                                            <a href="#" class="menu__link">
                                                <span class="menu__icon menu__icon--active">
                                                    <svg class="icon icon--chart-square">
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
                                                    <svg class="icon icon--notification">
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
                                <div class="accounting">
                                    <section class="accounting__section section">
                                        <div class="section__box box">
                                            <div class="participant participant--accounting">
                                                <div class="participant__item">
                                                    <div class="participant__header box box--gray box--rounded-sm">
                                                        <div class="participant__row">
                                                            <div class="participant__col participant__col--avatar">
                                                                <div class="participant__avatar avatar avatar--accent">
                                                                    <div class="avatar__box">
                                                                        <img src="https://coolsen.ru/wp-content/uploads/2021/06/72-7.jpg" alt="#" class="avatar__picture">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="participant__col participant__col--name">
                                                                <div class="participant__info">
                                                                    <span class="participant__info-name">ФИО</span>
                                                                    <span class="participant__info-value participant__info-value--truncate participant__info-value--accent" data-tippy-content="Достоевская-Васильева А.М." data-show-text>Достоевская-Васильева А.М.</span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="participant__row participant__row--separated">
                                                            <div class="participant__col participant__col--id">
                                                                <div class="participant__info">
                                                                    <span class="participant__info-name">ID</span>
                                                                    <span class="participant__info-value">1012376</span>
                                                                </div>
                                                            </div>

                                                            <div class="participant__col participant__col--level">
                                                                <div class="participant__info">
                                                                    <span class="participant__info-name">Уровень</span>
                                                                    <span class="participant__info-value">к2</span>
                                                                </div>
                                                            </div>

                                                            <div class="participant__col participant__col--date">
                                                                <div class="participant__info">
                                                                    <span class="participant__info-name">На сайте с</span>
                                                                    <span class="participant__info-value">01.12.2022</span>
                                                                </div>
                                                            </div>

                                                            <div class="participant__col participant__col--tel participant__col--separated">
                                                                <div class="participant__info">
                                                                    <span class="participant__info-name">Телефон</span>
                                                                    <span class="participant__info-value">8 (901) 123-45-67</span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="participant__row">
                                                            <div class="participant__col participant__col--email">
                                                                <div class="participant__info">
                                                                    <span class="participant__info-name">Email</span>
                                                                    <span class="participant__info-value participant__info-value--truncate" data-tippy-content="dostaevskaya-vasileva1995@yandex.ru" data-show-text>dostaevskaya-vasileva1995@yandex.ru</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="accounting__section-box section__box box box--gray">

                                                    <div class="accounting__filter filter filter--content">
                                                        <form class="accounting__filter-form form">
                                                            <div class="accounting__filter-name heading heading--small">
                                                                Выберите период отчета
                                                            </div>

                                                            <div class="form__field">
                                                                <div class="form__field-block form__field-block--input">
                                                                    <div class="form__control">
                                                                        <div class="accounting__filter-select select select--mitigate select--small select--squared" data-select>
                                                                            <select class="select__control" name="select2" data-select-control data-placeholder="Период">
                                                                                <option><!-- пустой option для placeholder --></option>
                                                                                <option value="1">I квартал 2022</option>
                                                                                <option value="2">II квартал 2022</option>
                                                                                <option value="3">III квартал 2022</option>
                                                                                <option value="4">IV квартал 2022</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>

                                                    <div class="participant__section">
                                                        <h5 class="participant__section-title">
                                                            Плановые показатели
                                                        </h5>

                                                        <div class="tabs tabs--white tabs--small tabs--circle tabs--red" data-tabs>
                                                            <nav class="tabs__items">
                                                                <ul class="tabs__list">
                                                                    <li class="tabs__item tabs__item--active" data-tab="block1">
                                                                        Личные
                                                                    </li>

                                                                    <li class="tabs__item" data-tab="block2">
                                                                        Групповые
                                                                    </li>
                                                                </ul>
                                                            </nav>

                                                            <div class="tabs__body">
                                                                <!--Таб личные-->
                                                                <div class="tabs__block tabs__block--active" data-tab-section="block1">
                                                                    <div class="participant__block">
                                                                        <div class="participant__progress cards-progress">
                                                                            <ul class="cards-progress__list">
                                                                                
                                                                                <li class="cards-progress__item">
                                                                                    <div class="card-progress card-progress--unbordered">
                                                                                        <div class="card-progress__inner">
                                                                                            <p class="card-progress__title">
                                                                                                Удержание уровня по личным покупкам
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
                                                                                                            Осталось 56 000 ₽
                                                                                                        </p>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="card-progress__warning warning">
                                                                                                <div class="warning__mark">
                                                                                                    <button type="button" class="button button--iconed button--simple button--red" data-fancybox="" data-modal-type="modal" data-src="#conditions">
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
                                                                                </li>
                                                                                <li class="cards-progress__item">
                                                                                    <div class="card-progress card-progress--unbordered">
                                                                                        <div class="card-progress__inner">
                                                                                            <p class="card-progress__title">
                                                                                                Повышения уровня по личным покупкам
                                                                                            </p>
                                                                                            <div class="card-progress__mark">
                                                                                                <svg class="card-progress__icon icon icon--cat-smile">
                                                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-cat-smile"></use>
                                                                                                </svg>
                                                                                                <span class="card-progress__mark-text">
                                                                                                    Цель достигнута
                                                                                                </span>
                                                                                            </div>
                                                                                            <div class="card-progress__wrapper">
                                                                                                <div class="card-progress__progress progress-bar">
                                                                                                    <div style="width: 100%;" class="progress-bar__filler progress-bar__filler--green"></div>
                                                                                                </div>
                                                                                                <div class="card-progress__bottom">
                                                                                                    <div class="card-progress__amount amount">
                                                                                                        <p class="amount__target amount__target--green">
                                                                                                            175 000 ₽
                                                                                                        </p>
                                                                                                        <p class="amount__total">
                                                                                                            из 175 000 ₽
                                                                                                        </p>
                                                                                                    </div>
                                                                                                    <div class="card-progress__status">
                                                                                                        <p class="card-progress__text">
                                                                                                            Выполнено
                                                                                                        </p>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="card-progress__warning warning">
                                                                                                <div class="warning__mark">
                                                                                                    <button type="button" class="button button--iconed button--simple button--red" data-fancybox="" data-modal-type="modal" data-src="#conditions">
                                                                                                        <span class="button__icon">
                                                                                                            <svg class="icon icon--basket warning__icon">
                                                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-attention"></use>
                                                                                                            </svg>
                                                                                                        </span>
                                                                                                    </button>
                                                                                                </div>
                                                                                                <p class="warning__text">
                                                                                                    Условия удержания уровня
                                                                                                </p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--/Таб личные-->

                                                                <!--Таб групповые-->
                                                                <div class="tabs__block" data-tab-section="block2">
                                                                    <div class="participant__block">
                                                                        <div class="participant__progress cards-progress">
                                                                            <ul class="cards-progress__list">
                                                                                <li class="cards-progress__item">
                                                                                    <div class="card-progress card-progress--unbordered">
                                                                                        <div class="card-progress__inner">
                                                                                            <p class="card-progress__title">
                                                                                                Удержание уровня по личным покупкам
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
                                                                                                            Осталось 56 000 ₽
                                                                                                        </p>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="card-progress__warning warning">
                                                                                                <div class="warning__mark">
                                                                                                    <button type="button" class="button button--iconed button--simple button--red" data-fancybox="" data-modal-type="modal" data-src="#conditions">
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
                                                                                </li>
                                                                                <li class="cards-progress__item">
                                                                                    <div class="card-progress card-progress--unbordered">
                                                                                        <div class="card-progress__inner">
                                                                                            <p class="card-progress__title">
                                                                                                Повышения уровня по личным покупкам
                                                                                            </p>
                                                                                            <div class="card-progress__mark">
                                                                                                <svg class="card-progress__icon icon icon--cat-smile">
                                                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-cat-smile"></use>
                                                                                                </svg>
                                                                                                <span class="card-progress__mark-text">
                                                                                                    Цель достигнута
                                                                                                </span>
                                                                                            </div>
                                                                                            <div class="card-progress__wrapper">
                                                                                                <div class="card-progress__progress progress-bar">
                                                                                                    <div style="width: 100%;" class="progress-bar__filler progress-bar__filler--green"></div>
                                                                                                </div>
                                                                                                <div class="card-progress__bottom">
                                                                                                    <div class="card-progress__amount amount">
                                                                                                        <p class="amount__target amount__target--green">
                                                                                                            175 000 ₽
                                                                                                        </p>
                                                                                                        <p class="amount__total">
                                                                                                            из 175 000 ₽
                                                                                                        </p>
                                                                                                    </div>
                                                                                                    <div class="card-progress__status">
                                                                                                        <p class="card-progress__text">
                                                                                                            Выполнено
                                                                                                        </p>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="card-progress__warning warning">
                                                                                                <div class="warning__mark">
                                                                                                    <button type="button" class="button button--iconed button--simple button--red" data-fancybox="" data-modal-type="modal" data-src="#conditions">
                                                                                                        <span class="button__icon">
                                                                                                            <svg class="icon icon--basket warning__icon">
                                                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-attention"></use>
                                                                                                            </svg>
                                                                                                        </span>
                                                                                                    </button>
                                                                                                </div>
                                                                                                <p class="warning__text">
                                                                                                    Условия удержания уровня
                                                                                                </p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--/Таб групповые-->
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="participant__section">
                                                        <h5 class="participant__section-title">
                                                            Продажи
                                                        </h5>

                                                        <div class="tabs tabs--white tabs--small tabs--circle tabs--red" data-tabs>
                                                            <nav class="tabs__items">
                                                                <ul class="tabs__list">
                                                                    <li class="tabs__item tabs__item--active" data-tab="block1">
                                                                        Личные
                                                                    </li>
                            
                                                                    <li class="tabs__item" data-tab="block2">
                                                                        Групповые
                                                                    </li>
                                                                </ul>
                                                            </nav>

                                                            <div class="tabs__body">
                                                                <!--Таб Личные-->
                                                                <div class="tabs__block tabs__block--active" data-tab-section="block1">
                                                                    <div class="participant__block">
                                                                        <!--Результаты-->
                                                                        <div class="results">
                                                                            <ul class="results__list">
                                                                                <li class="results__item">
                                                                                    <!--Результат-->
                                                                                    <div class="result">
                                                                                        <div class="result__main">
                                                                                            <p class="result__title">Сумма всех личных заказов</p>
                                                                                            <p class="result__total">568 429 ₽</p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <!--/Результат-->
                                                                                </li>

                                                                                <li class="results__item">
                                                                                    <div class="result">
                                                                                        <div class="result__main">
                                                                                            <p class="result__title">Сумма личных заказов за текущий отчетный период</p>
                                                                                            <p class="result__total">268 429 ₽</p>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>

                                                                                <li class="results__item">
                                                                                    <div class="result">
                                                                                        <div class="result__main">
                                                                                            <p class="result__title">Сумма личных баллов за текущий период</p>
                                                                                            <p class="result__total">679 ББ</p>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>

                                                                                <li class="results__item">
                                                                                    <div class="result">
                                                                                        <div class="result__main">
                                                                                            <p class="result__title">Количество личных заказов со статусом «Оплачен»</p>
                                                                                            <p class="result__total">12</p>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>

                                                                                <li class="results__item">
                                                                                    <div class="result">
                                                                                        <div class="result__main">
                                                                                            <p class="result__title">Количество личных заказов со статусом «Возврат»</p>
                                                                                            <p class="result__total">4</p>
                                                                                        </div>
                                                                                        <div class="result__addition">
                                                                                            <div data-toggle-visibility-container>
                                                                                                <button type="button" class="button button--simple button--gray button--small" data-toggle-visibility-action="hide">
                                                                                                    <span class="button__icon button__icon--mini button__icon--right">
                                                                                                        <svg class="icon icon--arrow-up">
                                                                                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-down"></use>
                                                                                                        </svg>
                                                                                                    </span>
                                                                                                    <span class="button__text" data-toggle-visibility-action-text="{&quot;show&quot;:&quot;Показать детализацию&quot;, &quot;hide&quot;:&quot;Скрыть детализацию&quot;}">Показать детализацию</span>
                                                                                                </button>

                                                                                                <div data-toggle-visibility-block style="display: none;">
                                                                                                    <!--Возвраты-->
                                                                                                    <div class="result__return">
                                                                                                        <div class="result__return-item">
                                                                                                            <p class="result__return-name">Количество полных возвратов</p>
                                                                                                            <p class="result__return-total">1</p>
                                                                                                        </div>
                                                                                                        <div class="result__return-item">
                                                                                                            <p class="result__return-name">Количество частичных возвратов</p>
                                                                                                            <p class="result__return-total">3</p>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <!--/Возвраты-->
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>

                                                                                <li class="results__item">
                                                                                    <div class="result">
                                                                                        <div class="result__main">
                                                                                            <p class="result__title">Дата последнего личного заказа</p>
                                                                                            <p class="result__total">09.07.2022</p>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>

                                                                                <li class="results__item">
                                                                                    <div class="result">
                                                                                        <div class="result__main">
                                                                                            <p class="result__title">Количество товаров со всех заказов за последний месяц</p>
                                                                                            <p class="result__total">21</p>
                                                                                        </div>
                                                                                        <div class="result__addition">
                                                                                            <div data-toggle-visibility-container>
                                                                                                <button type="button" class="button button--simple button--gray button--small" data-toggle-visibility-action="hide">
                                                                                                    <span class="button__icon button__icon--mini button__icon--right">
                                                                                                        <svg class="icon icon--arrow-up">
                                                                                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-down"></use>
                                                                                                        </svg>
                                                                                                    </span>
                                                                                                    <span class="button__text" data-toggle-visibility-action-text="{&quot;show&quot;:&quot;Показать детализацию&quot;, &quot;hide&quot;:&quot;Скрыть детализацию&quot;}">Показать детализацию</span>
                                                                                                </button>
                                                                                                <!--Таблица товаров-->
                                                                                                <div class="result__products table-list" data-toggle-visibility-block style="display: none;">
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
                                                                                                                Сумма
                                                                                                            </p>
                                                                                                        </div>
                                                                                                    </div>

                                                                                                    <ul class="table-list__list table-list__list--limited" data-scrollbar>
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
                                                                                                                                        Сумма:
                                                                                                                                    </span>
                                                                                                                                    <span class="product-line__params-value">
                                                                                                                                        4 388 ₽
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
                                                                                                                                        Сумма:
                                                                                                                                    </span>
                                                                                                                                    <span class="product-line__params-value">
                                                                                                                                        4 388 ₽
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
                                                                                                                                        Сумма:
                                                                                                                                    </span>
                                                                                                                                    <span class="product-line__params-value">
                                                                                                                                        4 388 ₽
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
                                                                                                                                        Сумма:
                                                                                                                                    </span>
                                                                                                                                    <span class="product-line__params-value">
                                                                                                                                        4 388 ₽
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
                                                                                                                                        Сумма:
                                                                                                                                    </span>
                                                                                                                                    <span class="product-line__params-value">
                                                                                                                                        4 388 ₽
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
                                                                                                                                        Сумма:
                                                                                                                                    </span>
                                                                                                                                    <span class="product-line__params-value">
                                                                                                                                        4 388 ₽
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
                                                                                                                                        Сумма:
                                                                                                                                    </span>
                                                                                                                                    <span class="product-line__params-value">
                                                                                                                                        4 388 ₽
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
                                                                                                                                        Сумма:
                                                                                                                                    </span>
                                                                                                                                    <span class="product-line__params-value">
                                                                                                                                        4 388 ₽
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
                                                                                                <!--/Таблица товаров-->
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                        <!--Результаты-->
                                                                    </div>
                                                                </div>
                                                                <!--/Таб Личные-->

                                                                <!--Таб Групповые-->
                                                                <div class="tabs__block" data-tab-section="block2">
                                                                    <div class="participant__block">
                                                                        <div class="participant__block">
                                                                            <!--Результаты-->
                                                                            <div class="results">
                                                                                <ul class="results__list">
                                                                                    <li class="results__item">
                                                                                        <!--Результат-->
                                                                                        <div class="result">
                                                                                            <div class="result__main">
                                                                                                <p class="result__title">Сумма всех личных заказов</p>
                                                                                                <p class="result__total">568 429 ₽</p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <!--/Результат-->
                                                                                    </li>

                                                                                    <li class="results__item">
                                                                                        <div class="result">
                                                                                            <div class="result__main">
                                                                                                <p class="result__title">Сумма личных заказов за текущий отчетный период</p>
                                                                                                <p class="result__total">268 429 ₽</p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </li>

                                                                                    <li class="results__item">
                                                                                        <div class="result">
                                                                                            <div class="result__main">
                                                                                                <p class="result__title">Сумма личных баллов за текущий период</p>
                                                                                                <p class="result__total">679 ББ</p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </li>

                                                                                    <li class="results__item">
                                                                                        <div class="result">
                                                                                            <div class="result__main">
                                                                                                <p class="result__title">Количество личных заказов со статусом «Оплачен»</p>
                                                                                                <p class="result__total">12</p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </li>

                                                                                    <li class="results__item">
                                                                                        <div class="result">
                                                                                            <div class="result__main">
                                                                                                <p class="result__title">Количество личных заказов со статусом «Возврат»</p>
                                                                                                <p class="result__total">4</p>
                                                                                            </div>
                                                                                            <div class="result__addition">
                                                                                                <div data-toggle-visibility-container>
                                                                                                    <button type="button" class="button button--simple button--gray button--small" data-toggle-visibility-action="hide">
                                                                                                        <span class="button__icon button__icon--mini button__icon--right">
                                                                                                            <svg class="icon icon--arrow-up">
                                                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-down"></use>
                                                                                                            </svg>
                                                                                                        </span>
                                                                                                        <span class="button__text" data-toggle-visibility-action-text="{&quot;show&quot;:&quot;Показать детализацию&quot;, &quot;hide&quot;:&quot;Скрыть детализацию&quot;}">Показать детализацию</span>
                                                                                                    </button>

                                                                                                    <div data-toggle-visibility-block style="display: none;">
                                                                                                        <!--Возвраты-->
                                                                                                        <div class="result__return">
                                                                                                            <div class="result__return-item">
                                                                                                                <p class="result__return-name">Количество полных возвратов</p>
                                                                                                                <p class="result__return-total">1</p>
                                                                                                            </div>
                                                                                                            <div class="result__return-item">
                                                                                                                <p class="result__return-name">Количество частичных возвратов</p>
                                                                                                                <p class="result__return-total">3</p>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <!--/Возвраты-->
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </li>

                                                                                    <li class="results__item">
                                                                                        <div class="result">
                                                                                            <div class="result__main">
                                                                                                <p class="result__title">Дата последнего личного заказа</p>
                                                                                                <p class="result__total">09.07.2022</p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </li>

                                                                                    <li class="results__item">
                                                                                        <div class="result">
                                                                                            <div class="result__main">
                                                                                                <p class="result__title">Количество товаров со всех заказов за последний месяц</p>
                                                                                                <p class="result__total">21</p>
                                                                                            </div>
                                                                                            <div class="result__addition">
                                                                                                <div data-toggle-visibility-container>
                                                                                                    <button type="button" class="button button--simple button--gray button--small" data-toggle-visibility-action="hide">
                                                                                                        <span class="button__icon button__icon--mini button__icon--right">
                                                                                                            <svg class="icon icon--arrow-up">
                                                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-down"></use>
                                                                                                            </svg>
                                                                                                        </span>
                                                                                                        <span class="button__text" data-toggle-visibility-action-text="{&quot;show&quot;:&quot;Показать детализацию&quot;, &quot;hide&quot;:&quot;Скрыть детализацию&quot;}">Показать детализацию</span>
                                                                                                    </button>
                                                                                                    <!--Таблица товаров-->
                                                                                                    <div class="result__products table-list" data-toggle-visibility-block style="display: none;">
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
                                                                                                                    Сумма
                                                                                                                </p>
                                                                                                            </div>
                                                                                                        </div>

                                                                                                        <ul class="table-list__list table-list__list--limited" data-scrollbar>
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
                                                                                                                                            Сумма:
                                                                                                                                        </span>
                                                                                                                                        <span class="product-line__params-value">
                                                                                                                                            4 388 ₽
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
                                                                                                                                            Сумма:
                                                                                                                                        </span>
                                                                                                                                        <span class="product-line__params-value">
                                                                                                                                            4 388 ₽
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
                                                                                                                                            Сумма:
                                                                                                                                        </span>
                                                                                                                                        <span class="product-line__params-value">
                                                                                                                                            4 388 ₽
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
                                                                                                    <!--/Таблица товаров-->
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                            <!--Результаты-->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--/Таб Групповые-->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                              

                                                
                                            </div> 
                                        </div>
                                    </section>

                                    <section class="accounting__section section">
                                        <div class="section__box box">
                                            <div class="section__header">
                                                <h4 class="section__title section__title--closer">
                                                    Участники группы
                                                </h4>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <!--content-->

        <? include_once("../include/footer.php"); ?>

        <script src="/local/templates/.default/js/script.js"></script>
    </body>

</html>
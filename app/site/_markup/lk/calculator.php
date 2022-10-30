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

                                        <li class="menu__item menu__item--active">
                                            <a href="#" class="menu__link">
                                                <span class="menu__icon menu__icon--active">
                                                    <svg class="icon icon--calculator">
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
                                <div class="profitability" data-calculator>
                                    <section class="profitability__section section">
                                        <div class="section__box box box--gray box--rounded-sm">
                                            <div class="profitability__section-header section__header">
                                                <h4 class="section__title section__title--closer">Ваш путь успеха</h4>

                                                <div class="profitability__hint" data-tippy-html>
                                                    <svg class="icon icon--question-circle">
                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-question-circle"></use>
                                                    </svg>

                                                    <div style="display: none;" data-tippy-template>
                                                        <div class="profitability__tooltip">
                                                            <p class="profitability__tooltip-title">Для перехода на уровень К2 необходимо выполнить следующие условия:</p>

                                                            <ul class="profitability__tooltip-list">
                                                                <li class="profitability__tooltip-item">
                                                                    <svg class="profitability__tooltip-icon icon icon--check-mark">
                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check-mark"></use>
                                                                    </svg>

                                                                    <p class="profitability__tooltip-text">Совершение личных покупок на общую сумму 10 000 рублей с учетом примененных скидок за 1 квартал</p>
                                                                </li>

                                                                <li class="profitability__tooltip-item">
                                                                    <svg class="profitability__tooltip-icon icon icon--check-mark">
                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check-mark"></use>
                                                                    </svg>

                                                                    <p class="profitability__tooltip-text">Совершение покупок Вашей группой на общую сумму 10 000 рублей с учетом всех примененных скидок за 1 квартал</p>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>

                                                    <!--Для к2-->
                                                    <!-- <div style="display: none;" data-tippy-template>
                                                        <div class="profitability__tooltip">
                                                            <p class="profitability__tooltip-title">Для перехода на уровень К2 необходимо выполнить следующие условия:</p>

                                                            <ul class="profitability__tooltip-list">
                                                                <li class="profitability__tooltip-item">
                                                                    <svg class="profitability__tooltip-icon icon icon--check-mark">
                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check-mark"></use>
                                                                    </svg>

                                                                    <p class="profitability__tooltip-text">Совершение личных покупок на общую сумму 50 000 рублей с учетом примененных скидок за 2 квартала (6 последовательных месяца)</p>
                                                                </li>

                                                                <li class="profitability__tooltip-item">
                                                                    <svg class="profitability__tooltip-icon icon icon--check-mark">
                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check-mark"></use>
                                                                    </svg>

                                                                    <p class="profitability__tooltip-text">Совершение покупок Вашей группой на общую сумму 100 000 рублей с учетом примененных скидок за 2 квартала (6 последовательных месяца)</p>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div> -->
                                                    <!--Для к2-->

                                                    <!--Для к3-->
                                                    <!-- <div style="display: none;" data-tippy-template>
                                                        <div class="profitability__tooltip">
                                                            <p class="profitability__tooltip-title">Поздравляем! Вы достигли максимального уровня</p>
                                                        </div>
                                                    </div> -->
                                                    <!--Для к3-->

                                                </div>
                                            </div>

                                            <div class="profitability__block">
                                                <div class="profitability__row">
                                                    <div class="card-level">
                                                        <div class="card-level__inner">
                                                            <div class="card-level__top">
                                                                <p class="card-level__title">
                                                                    Текущий уровень К1 – скидка 7%
                                                                </p>
                                                                <p class="card-level__progress">
                                                                    Прогресс 89%
                                                                </p>
                                                            </div>
                                                            <div class="card-level__progress-bar multi-progress">
                                                                <div style="width: 100%;" class="multi-progress__filler multi-progress__filler--green"></div>
                                                                <div style="width: 65%;" class="multi-progress__filler multi-progress__filler--purple"></div>
                                                            </div>
                                                            <ul class="card-level__list">
                                                                <li class="card-level__item card-level__item--green">
                                                                    Личные покупки за отчетный квартал
                                                                </li>
                                                                <li class="card-level__item card-level__item--purple">
                                                                    Групповые покупки за отчетный квартал
                                                                </li>
                                                            </ul>
                                                            <p class="card-level__text">
                                                                Уровень К2 - скидка 10%
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="profitability__row">
                                                    <!-- Для интеграции:
                                                        Есть 4 состояния
                                                        - если (накопленная сумма / требуемая сумма) < 0.5, 
                                                            то иконка = "icon-cat-sad", текст "Нужно больше усилий"

                                                        - если 0.5 <= (накопленная сумма / требуемая сумма) < 1, 
                                                            то иконка = "icon-cat-serious", текст "Хорошо получается"

                                                        - если (накопленная сумма / требуемая сумма) = 1, 
                                                            то иконка = "icon-cat-smile", текст "Цель достигнута"

                                                        - если (накопленная сумма / требуемая сумма) > 1, 
                                                            то иконка = "icon-cat-happy", текст "Просто фантастика"
                                                    -->

                                                    <div class="cards-progress">
                                                        <ul class="cards-progress__list">
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
                                                                    </div>
                                                                </div>

                                                            </li>

                                                            <li class="cards-progress__item">
                                                                <div class="card-progress card-progress--unbordered">
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

                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>

                                    <section class="profitability__section section">
                                        <div class="section__box box box--gray box--rounded-sm">
                                            <div class="profitability__section-header section__header">
                                                <h4 class="section__title section__title--closer">Калькулятор Вашего дохода</h4>

                                                <script>
                                                    let bigData = {
                                                        level: [
                                                            {
                                                                maxPointsPersonal: 1000,
                                                                minPointsPersonal: 1,
                                                                stepPointsPersonal: 1,
                                                                maxPointsGroup: 1000,
                                                                minPointsGroup: 1,
                                                                stepPointsGroup: 1,
                                                                standardPersonal: 100,
                                                                standardGroup: 200,
                                                                // percent: 7,
                                                            },
                                                            {
                                                                maxPointsPersonal: 2000,
                                                                minPointsPersonal: 2,
                                                                stepPointsPersonal: 2,
                                                                maxPointsGroup: 2000,
                                                                minPointsGroup: 2,
                                                                stepPointsGroup: 2,
                                                                standardPersonal: 100,
                                                                standardGroup: 200,
                                                                // percent: 10,
                                                            },
                                                            {
                                                                maxPointsPersonal: 3000,
                                                                minPointsPersonal: 3,
                                                                stepPointsPersonal: 3,
                                                                maxPointsGroup: 4000,
                                                                minPointsGroup: 4,
                                                                stepPointsGroup: 4,
                                                                standardPersonal: 100,
                                                                standardGroup: 200,
                                                                // percent: 12,
                                                            },
                                                        ],
                                                        currentLevel: 1,
                                                        personalRub: 100,
                                                        personalPoints: 1,
                                                        groupRub: 200,
                                                        groupPoints: 1,
                                                    };
                                                </script>

                                                <!--к1-->
                                                <div class="profitability__hint" data-tippy-html data-calculator-level-hidden="1">
                                                    <svg class="icon icon--question-circle">
                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-question-circle"></use>
                                                    </svg>

                                                    <div style="display: none;" data-tippy-template>
                                                        <div class="profitability__tooltip">
                                                            <p class="profitability__tooltip-title">Условия выполнения плана на уровне К1:</p>

                                                            <ul class="profitability__tooltip-list">
                                                                <li class="profitability__tooltip-item">
                                                                    <svg class="profitability__tooltip-icon icon icon--check-mark">
                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check-mark"></use>
                                                                    </svg>

                                                                    <p class="profitability__tooltip-text">Приобретение стартового набора Консультанта;</p>
                                                                </li>

                                                                <li class="profitability__tooltip-item">
                                                                    <svg class="profitability__tooltip-icon icon icon--check-mark">
                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check-mark"></use>
                                                                    </svg>

                                                                    <p class="profitability__tooltip-text">Совершение покупок Вашей группой на общую сумму 5 000 рублей с учетом всех примененных скидок</p>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--к1-->

                                                <!--к2-->
                                                <div class="profitability__hint" style="display: none;" data-tippy-html data-calculator-level-hidden="2">
                                                    <svg class="icon icon--question-circle">
                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-question-circle"></use>
                                                    </svg>

                                                    <div style="display: none;" data-tippy-template>
                                                        <div class="profitability__tooltip">
                                                            <p class="profitability__tooltip-title">Условия выполнения плана на уровне К2:</p>

                                                            <ul class="profitability__tooltip-list">
                                                                <li class="profitability__tooltip-item">
                                                                    <svg class="profitability__tooltip-icon icon icon--check-mark">
                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check-mark"></use>
                                                                    </svg>

                                                                    <p class="profitability__tooltip-text">Ежемесячное совершение личных покупок на 5 000 рублей с учетом всех примененных скидок;</p>
                                                                </li>

                                                                <li class="profitability__tooltip-item">
                                                                    <svg class="profitability__tooltip-icon icon icon--check-mark">
                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check-mark"></use>
                                                                    </svg>

                                                                    <p class="profitability__tooltip-text">Ежемесячное совершение покупок Вашей группой на общую сумму 7 000 рублей с учетом всех примененных скидок</p>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--к2-->

                                                <!--к3-->
                                                <div class="profitability__hint" style="display: none;" data-tippy-html data-calculator-level-hidden="3">
                                                    <svg class="icon icon--question-circle">
                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-question-circle"></use>
                                                    </svg>

                                                    <div style="display: none;" data-tippy-template>
                                                        <div class="profitability__tooltip">
                                                            <p class="profitability__tooltip-title">Условия выполнения плана на уровне К3:</p>

                                                            <ul class="profitability__tooltip-list">
                                                                <li class="profitability__tooltip-item">
                                                                    <svg class="profitability__tooltip-icon icon icon--check-mark">
                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check-mark"></use>
                                                                    </svg>

                                                                    <p class="profitability__tooltip-text">Ежемесячное совершение личных покупок на 10 000 рублей с учетом всех примененных скидок;</p>
                                                                </li>

                                                                <li class="profitability__tooltip-item">
                                                                    <svg class="profitability__tooltip-icon icon icon--check-mark">
                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check-mark"></use>
                                                                    </svg>

                                                                    <p class="profitability__tooltip-text">Ежемесячное совершение покупок Вашей группой на общую сумму 20 000 рублей с учетом всех примененных скидок</p>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--к3-->
                                            </div>

                                            <div class="profitability__level">
                                                <div class="profitability__tabs tabs tabs--red tabs--separated tabs--small" data-tabs>
                                                    <div class="profitability__level-header box box--circle">
                                                        <h6 class="profitability__level-title">Выберите уровень аккаунта и рассчитайте свой потенциальный доход</h6>
                                                        <nav class="tabs__items">
                                                            <ul class="tabs__list">
                                                                <li class="tabs__item tabs__item--active" data-tab="k1">
                                                                    Уровень К1
                                                                </li>

                                                                <li class="tabs__item" data-tab="k2">
                                                                    Уровень К2
                                                                </li>

                                                                <li class="tabs__item" data-tab="k3">
                                                                    Уровень К3
                                                                </li>
                                                            </ul>

                                                            <input type="radio" name="radioButton" value="1" data-calculator-level checked>
                                                            <input type="radio" name="radioButton" value="2" data-calculator-level>
                                                            <input type="radio" name="radioButton" value="3" data-calculator-level>
                                                        </nav>
                                                    </div>

                                                    <div class="profitability__tabs-body tabs__body">
                                                        <div class="tabs__block tabs__block--active" data-tab-section="k1">
                                                            <form class="form">
                                                                <div class="section__box-inner">
                                                                    <h5 class="box__heading box__heading--middle">Личные покупки</h5>

                                                                    <div class="profitability__calculation" data-calculator-range="personal">
                                                                        <div class="profitability__calculation-cards cards-counting cards-counting--double">
                                                                            <ul class="cards-counting__list">
                                                                                <li class="cards-counting__item">
                                                                                    <div class="card-counting card-counting--extra" >
                                                                                        <div class="card-counting__inner" >
                                                                                            <div class="card-counting__value">
                                                                                                <!-- скрипт выводит значение data-current в value-count -->
                                                                                                <input
                                                                                                    type="number"
                                                                                                    class="card-counting__value-count"
                                                                                                    data-range-min
                                                                                                    data-calculator-range-input-rub
                                                                                                />
                                                                                                <span class="card-counting__value-suffix">
                                                                                                    ₽
                                                                                                </span>
                                                                                            </div>
                                            
                                                                                            <div class="card-counting__range range" data-range>
                                                                                                <div
                                                                                                    class="range-slider"
                                                                                                    data-range-slider
                                                                                                    data-type="min"
                                                                                                    data-min="100"
                                                                                                    data-current="100"
                                                                                                    data-max="100000"
                                                                                                    data-step="100"
                                                                                                ></div>
                                                                                            </div>

                                                                                            <p class="card-counting__name">
                                                                                                Сумма личных покупок
                                                                                            </p>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>

                                                                                <li class="cards-counting__item">
                                                                                    <div class="card-counting card-counting--extra">
                                                                                        <div class="card-counting__inner">
                                                                                            <div class="card-counting__value">
                                                                                                <!-- скрипт выводит значение data-current в value-count -->
                                                                                                <input
                                                                                                    type="number"
                                                                                                    class="card-counting__value-count"
                                                                                                    data-range-min
                                                                                                    data-calculator-range-input-point
                                                                                                />
                                                                                                <span class="card-counting__value-suffix">
                                                                                                    ББ
                                                                                                </span>
                                                                                            </div>
                                            
                                                                                            <div class="card-counting__range range" data-range>
                                                                                                <div
                                                                                                    class="range-slider"
                                                                                                    data-range-slider
                                                                                                    data-type="min"
                                                                                                    data-min="1"
                                                                                                    data-current="1"
                                                                                                    data-max="1000"
                                                                                                    data-step="1"
                                                                                                    data-calculator-range-points
                                                                                                ></div>
                                                                                            </div>
                                            
                                                                                            <p class="card-counting__name">
                                                                                                Сумма личных баллов
                                                                                            </p>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>
                                                                            </ul>
                                                                        </div>

                                                                        <div class="profitability__calculation-result">
                                                                            <p class="profitability__calculation-annotation">В соответствии с действующим маркетинговым планом минимальная сумма личных покупок за 1 отчетный период для Консультанта 
                                                                                <span data-calculator-level-hidden="1">К1 составляет 5 000 руб.</span>
                                                                                <span style="display: none" data-calculator-level-hidden="2">К2 составляет 15 000 руб.</span>
                                                                                <span style="display: none" data-calculator-level-hidden="3">К3 составляет 30 000 руб.</span>
                                                                            </p>

                                                                            <div class="profitability__calculation-total">
                                                                                <p class="profitability__calculation-total-sum">
                                                                                    = <span data-calculator-personal-points-sum>1</span> ББ
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="section__box-inner">
                                                                    <h5 class="box__heading box__heading--middle">Доход от зарегистрированных покупателей в моей группе</h5>

                                                                    <div class="profitability__calculation" data-calculator-range="group">
                                                                        <div class="cards-counting">
                                                                            <ul class="cards-counting__list">
                                                                                <li class="cards-counting__item">
                                                                                    <div class="card-counting">
                                                                                        <div class="card-counting__inner">
                                                                                            <div class="card-counting__value">
                                                                                                <!-- скрипт выводит значение data-current в value-count -->
                                                                                                <input
                                                                                                    type="number"
                                                                                                    class="card-counting__value-count"
                                                                                                    data-range-min
                                                                                                />
                                                                                                <span class="card-counting__value-suffix"></span>
                                                                                            </div>

                                                                                            <div class="card-counting__range range" data-range>
                                                                                                <div
                                                                                                    class="range-slider"
                                                                                                    data-range-slider
                                                                                                    data-type="min"
                                                                                                    data-min="1"
                                                                                                    data-current="5"
                                                                                                    data-max="10"
                                                                                                    data-step="1"
                                                                                                ></div>
                                                                                            </div>

                                                                                            <p class="card-counting__name">
                                                                                                Количество покупателей
                                                                                            </p>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>

                                                                                <li class="cards-counting__item">
                                                                                    <div class="card-counting">
                                                                                        <div class="card-counting__inner">
                                                                                            <div class="card-counting__value">
                                                                                                <!-- скрипт выводит значение data-current в value-count -->
                                                                                                <input
                                                                                                    type="number"
                                                                                                    class="card-counting__value-count"
                                                                                                    data-range-min
                                                                                                    data-calculator-range-input-rub
                                                                                                />
                                                                                                <span class="card-counting__value-suffix">
                                                                                                    ₽
                                                                                                </span>
                                                                                            </div>
                                            
                                                                                            <div class="card-counting__range range" data-range>
                                                                                                <div
                                                                                                    class="range-slider"
                                                                                                    data-range-slider
                                                                                                    data-type="min"
                                                                                                    data-min="200"
                                                                                                    data-current="200"
                                                                                                    data-max="100000"
                                                                                                    data-step="200"
                                                                                                ></div>
                                                                                            </div>
                                            
                                                                                            <p class="card-counting__name">
                                                                                                Средняя сумма покупок 1 покупателя
                                                                                            </p>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>

                                                                                <li class="cards-counting__item">
                                                                                    <div class="card-counting">
                                                                                        <div class="card-counting__inner">
                                                                                            <div class="card-counting__value">
                                                                                                <!-- скрипт выводит значение data-current в value-count -->
                                                                                                <input
                                                                                                    type="number"
                                                                                                    class="card-counting__value-count"
                                                                                                    data-range-min
                                                                                                    data-calculator-range-input-point
                                                                                                />
                                                                                                <span class="card-counting__value-suffix">
                                                                                                    ББ
                                                                                                </span>
                                                                                            </div>
                                            
                                                                                            <div class="card-counting__range range" data-range>
                                                                                                <div
                                                                                                    class="range-slider"
                                                                                                    data-range-slider
                                                                                                    data-type="min"
                                                                                                    data-min="1"
                                                                                                    data-current="1"
                                                                                                    data-max="500"
                                                                                                    data-step="1"
                                                                                                    data-calculator-range-points
                                                                                                ></div>   
                                                                                            </div>
                                            
                                                                                            <p class="card-counting__name">
                                                                                                Средняя сумма баллов 1 покупателя
                                                                                            </p>
                                                                                        </div>
                                                                                    </div>
                                            
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="section__box-inner">
                                                                    <h5 class="box__heading box__heading--middle">Доход от консультантов в моей группе</h5>

                                                                    <div class="profitability__calculation" data-group>
                                                                        <div class="profitability__calculation-cards cards-counting">
                                                                            <ul class="cards-counting__list">
                                                                                <li class="cards-counting__item">
                                                                                    <div class="card-counting">
                                                                                        <div class="card-counting__inner">
                                                                                            <div class="card-counting__value">
                                                                                                <!-- скрипт выводит значение data-current в value-count -->
                                                                                                <input
                                                                                                    type="number"
                                                                                                    class="card-counting__value-count"
                                                                                                    data-range-min
                                                                                                />
                                                                                                <span class="card-counting__value-suffix"></span>
                                                                                            </div>

                                                                                            <div class="card-counting__range range" data-range>
                                                                                                <div
                                                                                                    class="range-slider"
                                                                                                    data-range-slider
                                                                                                    data-type="min"
                                                                                                    data-min="1"
                                                                                                    data-current="3"
                                                                                                    data-max="10"
                                                                                                    data-step="1"
                                                                                                ></div>
                                                                                            </div>

                                                                                            <p class="card-counting__name">
                                                                                                Количество консультантов
                                                                                            </p>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>

                                                                                <li class="cards-counting__item">
                                                                                    <div class="card-counting">
                                                                                        <div class="card-counting__inner">
                                                                                            <div class="card-counting__value">
                                                                                                <!-- скрипт выводит значение data-current в value-count -->
                                                                                                <input
                                                                                                    type="number"
                                                                                                    class="card-counting__value-count"
                                                                                                    data-range-min
                                                                                                />
                                                                                                <span class="card-counting__value-suffix">
                                                                                                    ₽
                                                                                                </span>
                                                                                            </div>

                                                                                            <div class="card-counting__range range" data-range>
                                                                                                <div
                                                                                                    class="range-slider"
                                                                                                    data-range-slider
                                                                                                    data-type="min"
                                                                                                    data-min="1000"
                                                                                                    data-current="0"
                                                                                                    data-max="30000"
                                                                                                    data-step="1000"
                                                                                                ></div>
                                                                                            </div>

                                                                                            <p class="card-counting__name">
                                                                                                Средняя сумма покупок 1 консультанта
                                                                                            </p>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>

                                                                                <li class="cards-counting__item">
                                                                                    <div class="card-counting">
                                                                                        <div class="card-counting__inner">
                                                                                            <div class="card-counting__value">
                                                                                                <!-- скрипт выводит значение data-current в value-count -->
                                                                                                <input
                                                                                                    type="number"
                                                                                                    class="card-counting__value-count"
                                                                                                    data-range-min
                                                                                                />
                                                                                                <span class="card-counting__value-suffix">
                                                                                                    ББ
                                                                                                </span>
                                                                                            </div>

                                                                                            <div class="card-counting__range range" data-range>
                                                                                                <div
                                                                                                    class="range-slider"
                                                                                                    data-range-slider
                                                                                                    data-type="min"
                                                                                                    data-min="0"
                                                                                                    data-current="0"
                                                                                                    data-max="1000"
                                                                                                    data-step="10"
                                                                                                ></div>   
                                                                                            </div>

                                                                                            <p class="card-counting__name">
                                                                                                Средняя сумма баллов 1 консультанта
                                                                                            </p>
                                                                                        </div>
                                                                                    </div>

                                                                                </li>
                                                                            </ul>
                                                                        </div>

                                                                        <div class="profitability__calculation-groups">
                                                                            <button type="button" class="profitability__calculation-button button button--medium button--rounded button--outlined button--mixed button--full">
                                                                                <span class="button__icon button__icon--medium">
                                                                                    <svg class="icon icon--add-circle">
                                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-add-circle"></use>
                                                                                    </svg>
                                                                                </span>
                                                                                <span class="button__text button__text--full">Создать группу консультантов с выбранными параметрами</span>
                                                                            </button>

                                                                            <div class="profitability__groups groups">
                                                                                <ul class="groups__list">
                                                                                    <li class="groups__item">
                                                                                        <div class="group">
                                                                                            <div class="group__users">
                                                                                                <div class="group__users-icon">
                                                                                                    <svg class="icon icon--users">
                                                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-users"></use>
                                                                                                    </svg>
                                                                                                </div>
                                                                                                <span class="group__users-counter counter">10</span>
                                                                                            </div>

                                                                                            <div class="group__symbol">
                                                                                                <svg class="icon icon--cross">
                                                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-cross"></use>
                                                                                                </svg>
                                                                                            </div>

                                                                                            <div class="group__sum price price--inlined">
                                                                                                <div class="price__calculation">
                                                                                                    <p class="price__calculation-total">1 420 ₽</p>
                                                                                                    <p class="price__calculation-accumulation">14 ББ</p>
                                                                                                </div>
                                                                                            </div>

                                                                                            <div class="group__delete">
                                                                                                <svg class="group__delete-icon icon icon--close-square">
                                                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-close-square"></use>
                                                                                                </svg>
                                                                                            </div>
                                                                                        </div>
                                                                                    </li>

                                                                                    <li class="groups__item">
                                                                                        <div class="group">
                                                                                            <div class="group__users">
                                                                                                <div class="group__users-icon">
                                                                                                    <svg class="icon icon--users">
                                                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-users"></use>
                                                                                                    </svg>
                                                                                                </div>
                                                                                                <span class="group__users-counter counter">10</span>
                                                                                            </div>

                                                                                            <div class="group__symbol">
                                                                                                <svg class="icon icon--cross">
                                                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-cross"></use>
                                                                                                </svg>
                                                                                            </div>

                                                                                            <div class="group__sum price price--inlined">
                                                                                                <div class="price__calculation">
                                                                                                    <p class="price__calculation-total">1 420 ₽</p>
                                                                                                    <p class="price__calculation-accumulation">14 ББ</p>
                                                                                                </div>
                                                                                            </div>

                                                                                            <div class="group__delete">
                                                                                                <svg class="group__delete-icon icon icon--close-square">
                                                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-close-square"></use>
                                                                                                </svg>
                                                                                            </div>
                                                                                        </div>
                                                                                    </li>

                                                                                    <li class="groups__item">
                                                                                        <div class="group">
                                                                                            <div class="group__users">
                                                                                                <div class="group__users-icon">
                                                                                                    <svg class="icon icon--users">
                                                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-users"></use>
                                                                                                    </svg>
                                                                                                </div>
                                                                                                <span class="group__users-counter counter">10</span>
                                                                                            </div>

                                                                                            <div class="group__symbol">
                                                                                                <svg class="icon icon--cross">
                                                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-cross"></use>
                                                                                                </svg>
                                                                                            </div>

                                                                                            <div class="group__sum price price--inlined">
                                                                                                <div class="price__calculation">
                                                                                                    <p class="price__calculation-total">1 420 ₽</p>
                                                                                                    <p class="price__calculation-accumulation">14 ББ</p>
                                                                                                </div>
                                                                                            </div>

                                                                                            <div class="group__delete">
                                                                                                <svg class="group__delete-icon icon icon--close-square">
                                                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-close-square"></use>
                                                                                                </svg>
                                                                                            </div>
                                                                                        </div>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>

                                                                        <div class="profitability__calculation-result">
                                                                            <p class="profitability__calculation-annotation">В соответствии с действующим маркетинговым планом минимальная сумма групповых покупок за 1 отчетный период для Консультанта 
                                                                                <span data-calculator-level-hidden="1">К1 составляет 0 руб.</span>
                                                                                <span style="display: none;" data-calculator-level-hidden="2">К2 составляет 21 000 руб.</span>
                                                                                <span style="display: none;" data-calculator-level-hidden="3">К3 составляет 60 000 руб.</span>
                                                                                </p>

                                                                            <div class="profitability__calculation-total">
                                                                                <p class="profitability__calculation-total-sum">
                                                                                    = 944 ББ
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="profitability__consultants" data-consultants>
                                                                    <div class="profitability__consultants-col">
                                                                        <div class="profitability__consultants-switcher switcher" name="switcher3">
                                                                            <input type="checkbox" class="switcher__input" name="switch2" id="switch3" data-consultants-switcher>
                                                                            <label for="switch3" class="switcher__label">
                                                                                <span class="switcher__icon"></span>
                                                                                <span class="switcher__text switcher__text--small">Учитывать разовые начисления баллов, за переход на уровеньи привлечение новых консультантов в группу</span>
                                                                            </label>
                                                                        </div>
                                                                    </div>

                                                                    <div class="profitability__consultants-col profitability__consultants-col--inlined">
                                                                        <div class="profitability__consultants-quantity profitability__consultants-quantity--hidden quantity quantity--active" data-quantity data-consultants-quantity>
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
                                                                                    <span class="quantity__total-sum" data-quantity-sum="1" data-quantity-min="1" data-quantity-max="15">
                                                                                        1
                                                                                    </span>
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

                                                                        <div class="profitability__hint">
                                                                            <svg class="icon icon--question-circle">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-question-circle"></use>
                                                                            </svg>
                                                                        </div>


                                                                    </div>
                                                                </div>

                                                                <button type="button" class="profitability__computing button button--medium button--rounded button--covered button--red button--full">
                                                                    <span class="button__text">Рассчитать</span>
                                                                </button>
                                                            </form>
                                                        </div>

                                                        <div class="tabs__block" data-tab-section="k2">
                                                            Аналогично Уровень К1
                                                        </div>

                                                        <div class="tabs__block" data-tab-section="k3">
                                                            Аналогично Уровень К1
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>

                                    <section class="profitability__section section">
                                        <div class="section__box box box--gray box--rounded-sm">
                                            <div class="profitability__section-header section__header">
                                                <h4 class="section__title section__title--closer">Результат расчета Вашего потенциального дохода</h4>

                                                <div class="profitability__hint">
                                                    <svg class="icon icon--question-circle">
                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-question-circle"></use>
                                                    </svg>
                                                </div>
                                            </div>

                                            Диаграмма
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
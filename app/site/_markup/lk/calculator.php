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
                                <div class="profitability">
                                    <section class="profitability__section section">
                                        <div class="section__box box box--gray box--rounded-sm">
                                            <div class="profitability__section-header section__header">
                                                <h4 class="section__title section__title--closer">Ваш путь успеха</h4>

                                                <div class="profitability__hint">
                                                    <svg class="icon icon--question-circle">
                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-question-circle"></use>
                                                    </svg>
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

                                                <div class="profitability__hint">
                                                    <svg class="icon icon--question-circle">
                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-question-circle"></use>
                                                    </svg>
                                                </div>
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
                                                        </nav>
                                                    </div>

                                                    <div class="profitability__tabs-body tabs__body">
                                                        <div class="tabs__block tabs__block--active" data-tab-section="k1">
                                                            <div class="section__box-inner">
                                                                <h5 class="box__heading box__heading--middle">Личные покупки</h5>
                                                            </div>
                                                        </div>
                    
                                                        <div class="tabs__block" data-tab-section="k2">
                                                            Состав
                                                        </div>
                    
                                                        <div class="tabs__block" data-tab-section="k3">
                                                            Рекомендации по кормлению
                                                        </div>
                    
                                                        <div class="tabs__block" data-tab-section="block4">
                                                            Документы
                                                        </div>
                                                    </div>
                                                </div>
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
<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>

<div class="profitability" data-calculator>
    <section class="profitability__section section">
        <div class="section__box box box--gray box--rounded-sm">
            <div class="profitability__section-header section__header">
                <h4 class="section__title section__title--closer">Ваш путь успеха</h4>

                <?php if ($arResult['next_level']):?>
                    <div class="profitability__hint" data-tippy-html>
                        <svg class="icon icon--question-circle">
                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-question-circle"></use>
                        </svg>

                        <div style="display: none;" data-tippy-template>
                            <div class="profitability__tooltip">
                                <p class="profitability__tooltip-title">Для перехода на уровень <?=$arResult['next_level']['label']?> необходимо выполнить следующие условия:</p>

                                <ul class="profitability__tooltip-list">
                                    <li class="profitability__tooltip-item">
                                        <svg class="profitability__tooltip-icon icon icon--check-mark">
                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check-mark"></use>
                                        </svg>

                                        <p class="profitability__tooltip-text">Совершение личных покупок на общую сумму <?=$arResult['next_level']['upgrade_level_terms']['self_total']?> рублей с учетом примененных скидок за <?=$arResult['next_level']['upgrade_level_terms']['self_period_months'] === 3 ? '1 квартал' : (($arResult['next_level']['upgrade_level_terms']['self_period_months'] / 3) . " квартала ({$arResult['next_level']['upgrade_level_terms']['self_period_months']} последовательных месяцев)")?></p>
                                    </li>

                                    <li class="profitability__tooltip-item">
                                        <svg class="profitability__tooltip-icon icon icon--check-mark">
                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check-mark"></use>
                                        </svg>

                                        <p class="profitability__tooltip-text">Совершение покупок Вашей группой на общую сумму <?=$arResult['next_level']['upgrade_level_terms']['team_total']?> рублей с учетом примененных скидок за <?=$arResult['next_level']['upgrade_level_terms']['team_period_months'] === 3 ? '1 квартал' : (($arResult['next_level']['upgrade_level_terms']['team_period_months'] / 3) . " квартала ({$arResult['next_level']['upgrade_level_terms']['team_period_months']} последовательных месяцев)")?></p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php else:?>
                    <div style="display: none;" data-tippy-template>
                        <div class="profitability__tooltip">
                            <p class="profitability__tooltip-title">Поздравляем! Вы достигли максимального уровня</p>
                        </div>
                    </div>
                <?php endif;?>
            </div>

            <div class="profitability__block">
                <?php if ($arResult['next_level']):?>
                    <div class="profitability__row">
                        <div class="card-level">
                            <div class="card-level__inner">
                                <div class="card-level__top">
                                    <p class="card-level__title">
                                        Текущий уровень <?=$arResult['current_level']['label']?> – скидка <?=$arResult['current_level']['benefits']['personal_discount']?>%
                                    </p>
                                    <p class="card-level__progress">
                                        Прогресс <?=round(($arResult['loyalty_status']['self']['upgrade_progress'] + $arResult['loyalty_status']['team']['upgrade_progress']) / 2)?>%
                                    </p>
                                </div>
                                <div class="card-level__progress-bar multi-progress">
                                    <div style="width: <?=$arResult['loyalty_status']['self']['upgrade_progress']?>%;" class="multi-progress__filler multi-progress__filler--green"></div>
                                    <div style="width: <?=$arResult['loyalty_status']['team']['upgrade_progress']?>%;" class="multi-progress__filler multi-progress__filler--purple"></div>
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
                                    Уровень <?=$arResult['next_level']['label']?> - скидка <?=$arResult['next_level']['benefits']['personal_discount']?>%
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endif;?>

                <div class="profitability__row">
                    <div class="participant__progress cards-progress">
                        <ul class="cards-progress__list">
                            <li class="cards-progress__item">
                                <div
                                    id="loyaltyStatusTale"
                                    prop-current-value="<?=$arResult['loyalty_status']['self']['current_value']?>"
                                    prop-target-value="<?=$arResult['loyalty_status']['self']['hold_value']?>"
                                    prop-label="Повышение уровня по личным покупкам"
                                ></div>
                            </li>
                            <li class="cards-progress__item">
                                <div
                                    id="loyaltyStatusTale"
                                    prop-current-value="<?=$arResult['loyalty_status']['team']['current_value']?>"
                                    prop-target-value="<?=$arResult['loyalty_status']['team']['upgrade_value']?>"
                                    prop-label="Повышение уровня по групповым покупкам"
                                    prop-is-hold="<?=json_encode(false)?>"
                                ></div>
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
                                maxPointsPersonal: <?=$arResult['levels']['consultant']['K1']['self_max_bonuses']?>,
                                minPointsPersonal: 0,
                                stepPointsPersonal: <?=$arResult['levels']['consultant']['K1']['benefits']['personal_bonuses_for_cost']['size']?>,
                                maxPointsGroup: <?=$arResult['levels']['consultant']['K1']['team_max_bonuses']?>,
                                minPointsGroup: 0,
                                stepPointsGroup: <?=$arResult['levels']['consultant']['K1']['benefits']['group_bonuses_for_cost']['size']?>,
                                standardPersonal: <?=$arResult['levels']['consultant']['K1']['benefits']['personal_bonuses_for_cost']['step']?>,
                                standardGroup: <?=$arResult['levels']['consultant']['K1']['benefits']['group_bonuses_for_cost']['step']?>,
                                percent: <?=$arResult['levels']['consultant']['K1']['benefits']['personal_discount']?>,
                                invitation: <?=$arResult['levels']['consultant']['K1']['benefits']['referral_size']?>,
                                transitionToLevel: 0,
                            },
                            {
                                maxPointsPersonal: <?=$arResult['levels']['consultant']['K2']['self_max_bonuses']?>,
                                minPointsPersonal: 0,
                                stepPointsPersonal: <?=$arResult['levels']['consultant']['K2']['benefits']['personal_bonuses_for_cost']['size']?>,
                                maxPointsGroup: <?=$arResult['levels']['consultant']['K2']['team_max_bonuses']?>,
                                minPointsGroup: 0,
                                stepPointsGroup: <?=$arResult['levels']['consultant']['K2']['benefits']['group_bonuses_for_cost']['size']?>,
                                standardPersonal: <?=$arResult['levels']['consultant']['K2']['benefits']['personal_bonuses_for_cost']['step']?>,
                                standardGroup: <?=$arResult['levels']['consultant']['K2']['benefits']['group_bonuses_for_cost']['step']?>,
                                percent: <?=$arResult['levels']['consultant']['K2']['benefits']['personal_discount']?>,
                                invitation: <?=$arResult['levels']['consultant']['K2']['benefits']['referral_size']?>,
                                transitionToLevel: <?=$arResult['levels']['consultant']['K2']['benefits']['upgrade_level_bonuses']?>,
                            },
                            {
                                maxPointsPersonal: <?=$arResult['levels']['consultant']['K3']['self_max_bonuses']?>,
                                minPointsPersonal: 0,
                                stepPointsPersonal: <?=$arResult['levels']['consultant']['K3']['benefits']['personal_bonuses_for_cost']['size']?>,
                                maxPointsGroup: <?=$arResult['levels']['consultant']['K3']['team_max_bonuses']?>,
                                minPointsGroup: 0,
                                stepPointsGroup: <?=$arResult['levels']['consultant']['K3']['benefits']['group_bonuses_for_cost']['size']?>,
                                standardPersonal: <?=$arResult['levels']['consultant']['K3']['benefits']['personal_bonuses_for_cost']['step']?>,
                                standardGroup: <?=$arResult['levels']['consultant']['K3']['benefits']['group_bonuses_for_cost']['step']?>,
                                percent: <?=$arResult['levels']['consultant']['K3']['benefits']['personal_discount']?>,
                                invitation: <?=$arResult['levels']['consultant']['K3']['benefits']['referral_size']?>,
                                transitionToLevel: <?=$arResult['levels']['consultant']['K3']['benefits']['upgrade_level_bonuses']?>,
                            },
                        ],
                        currentLevel: <?=$arResult['current_level']['level']?>,

                        personalRub: 0,
                        personalPoints: 0,

                        groupBuyer: 1,
                        groupRub: 0,
                        groupPoints: 0,

                        consultant: 1,
                        consultantRub: 0,
                        consultantPoints: 0,
                        consultantArr: [],

                        oneTimeCharges: 0,
                        oneTimeChargesTransitionLevel: 0,
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

                                    <p class="profitability__tooltip-text">Совершение личных покупок на общую сумму <?=$arResult['levels']['consultant']['K1']['hold_level_terms']['self_total']?> рублей с учетом всех примененных скидок в течении первых <?=$arResult['levels']['consultant']['K1']['hold_level_terms']['self_period_months']?> месяцев после регистрации</p>
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

                                    <p class="profitability__tooltip-text">Ежемесячное совершение личных покупок на <?=$arResult['levels']['consultant']['K2']['hold_level_terms']['self_total']?> рублей с учетом всех примененных скидок;</p>
                                </li>

                                <li class="profitability__tooltip-item">
                                    <svg class="profitability__tooltip-icon icon icon--check-mark">
                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check-mark"></use>
                                    </svg>

                                    <p class="profitability__tooltip-text">Ежемесячное совершение покупок Вашей группой на общую сумму <?=$arResult['levels']['consultant']['K2']['hold_level_terms']['team_total']?> рублей с учетом всех примененных скидок</p>
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

                                    <p class="profitability__tooltip-text">Ежемесячное совершение личных покупок на <?=$arResult['levels']['consultant']['K2']['hold_level_terms']['self_total']?> рублей с учетом всех примененных скидок;</p>
                                </li>

                                <li class="profitability__tooltip-item">
                                    <svg class="profitability__tooltip-icon icon icon--check-mark">
                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check-mark"></use>
                                    </svg>

                                    <p class="profitability__tooltip-text">Ежемесячное совершение покупок Вашей группой на общую сумму <?=$arResult['levels']['consultant']['K2']['hold_level_terms']['team_total']?> рублей с учетом всех примененных скидок</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--к3-->
            </div>

            <div class="profitability__level">
                <div class="profitability__level-header box box--circle">
                    <h6 class="profitability__level-title">Выберите уровень аккаунта и рассчитайте свой потенциальный доход</h6>
                    <div class="toggles">
                        <ul class="toggles__list">
                            <li class="toggles__item">
                                <div class="toggle toggle--first">
                                    <div class="radio">
                                        <input class="toggle__input radio__input" type="radio" name="radioButton1" value="1" id="radioButton1" data-calculator-level checked>
                                        <label for="radioButton1">
                                            <div class="toggle__item">Уровень К1</div>
                                        </label>
                                    </div>
                                </div>
                            </li>

                            <li class="toggles__item">
                                <div class="toggle">
                                    <div class="radio">
                                        <input class="toggle__input radio__input" type="radio" name="radioButton1" value="2" id="radioButton2" data-calculator-level>
                                        <label for="radioButton2">
                                            <div class="toggle__item">Уровень К2</div>
                                        </label>
                                    </div>
                                </div>
                            </li>

                            <li class="toggles__item">
                                <div class="toggle toggle--last">
                                    <div class="radio">
                                        <input class="toggle__input radio__input" type="radio" name="radioButton1" value="3" id="radioButton3" data-calculator-level>
                                        <label for="radioButton3">
                                            <div class="toggle__item">Уровень К3</div>
                                        </label>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="profitability__content">
                    <form class="form">
                        <div class="section__box-inner">
                            <h5 class="box__heading box__heading--middle box__heading--dark">Личные покупки</h5>

                            <div class="profitability__calculation" data-calculator-range="personal">
                                <div class="profitability__calculation-cards cards-counting cards-counting--double">
                                    <ul class="cards-counting__list">
                                        <li class="cards-counting__item">
                                            <div class="card-counting card-counting--extra" >
                                                <div class="card-counting__inner" >
                                                    <div class="card-counting__value">
                                                        <!-- скрипт выводит значение data-current в value-count -->
                                                        <input
                                                                type="text"
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
                                                                data-min="0"
                                                                data-current="0"
                                                                data-max="10000000"
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
                                                                type="text"
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
                                                                data-min="0"
                                                                data-current="0"
                                                                data-max="100000"
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
                                        <span data-calculator-level-hidden="1">К1 составляет <?=$arResult['levels']['consultant']['K1']['hold_level_terms']['self_min_amount']?> руб.</span>
                                        <span style="display: none" data-calculator-level-hidden="2">К2 составляет <?=$arResult['levels']['consultant']['K2']['hold_level_terms']['self_min_amount']?> руб.</span>
                                        <span style="display: none" data-calculator-level-hidden="3">К3 составляет <?=$arResult['levels']['consultant']['K3']['hold_level_terms']['self_min_amount']?> руб.</span>
                                    </p>

                                    <div class="profitability__calculation-total">
                                        <p class="profitability__calculation-total-sum">
                                            = <span data-calculator-personal-points-sum>0</span> ББ
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="section__box-inner">
                            <h5 class="box__heading box__heading--middle box__heading--dark">Доход от зарегистрированных покупателей в моей группе</h5>

                            <div class="profitability__calculation" data-calculator-range="group">
                                <div class="cards-counting">
                                    <ul class="cards-counting__list">
                                        <li class="cards-counting__item">
                                            <div class="card-counting">
                                                <div class="card-counting__inner">
                                                    <div class="card-counting__value">
                                                        <!-- скрипт выводит значение data-current в value-count -->
                                                        <input
                                                                type="text"
                                                                class="card-counting__value-count"
                                                                data-range-min
                                                                data-calculator-quantity="buyer"
                                                        />
                                                        <span class="card-counting__value-suffix"></span>
                                                    </div>

                                                    <div class="card-counting__range range" data-range>
                                                        <div
                                                                class="range-slider"
                                                                data-range-slider
                                                                data-type="min"
                                                                data-min="1"
                                                                data-current="1"
                                                                data-max="999"
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
                                                                type="text"
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
                                                                data-min="0"
                                                                data-current="0"
                                                                data-max="10000000"
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
                                                                type="text"
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
                                                                data-min="0"
                                                                data-current="0"
                                                                data-max="100000"
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
                            <h5 class="box__heading box__heading--middle box__heading--dark">Доход от консультантов в моей группе</h5>

                            <div class="profitability__calculation" data-calculator-consultant data-calculator-range="consultant">
                                <div class="profitability__calculation-cards cards-counting">
                                    <ul class="cards-counting__list">
                                        <li class="cards-counting__item">
                                            <div class="card-counting">
                                                <div class="card-counting__inner">
                                                    <div class="card-counting__value">
                                                        <!-- скрипт выводит значение data-current в value-count -->
                                                        <input
                                                                type="text"
                                                                class="card-counting__value-count"
                                                                data-range-min
                                                                data-calculator-quantity="consultant"
                                                        />
                                                        <span class="card-counting__value-suffix"></span>
                                                    </div>

                                                    <div class="card-counting__range range" data-range>
                                                        <div
                                                                class="range-slider"
                                                                data-range-slider
                                                                data-type="min"
                                                                data-min="1"
                                                                data-current="1"
                                                                data-max="999"
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
                                                                type="text"
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
                                                                data-min="0"
                                                                data-current="0"
                                                                data-max="10000000"
                                                                data-step="200"
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
                                                                type="text"
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
                                                                data-min="0"
                                                                data-current="0"
                                                                data-max="100000"
                                                                data-step="1"
                                                                data-calculator-range-points
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
                                    <button type="button" class="profitability__calculation-button button button--medium button--rounded button--outlined button--mixed button--full" data-calculator-consultant-add>
                                                                        <span class="button__icon button__icon--medium">
                                                                            <svg class="icon icon--add-circle">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-add-circle"></use>
                                                                            </svg>
                                                                        </span>
                                        <span class="button__text button__text--full">Создать группу консультантов с выбранными параметрами</span>
                                    </button>

                                    <div class="profitability__groups groups">
                                        <ul class="groups__list" data-calculator-consultant-wrapper>
                                        </ul>
                                    </div>
                                </div>

                                <div class="profitability__calculation-result">
                                    <p class="profitability__calculation-annotation">В соответствии с действующим маркетинговым планом минимальная сумма групповых покупок за 1 отчетный период для Консультанта
                                        <span data-calculator-level-hidden="1">К1 составляет <?=$arResult['levels']['consultant']['K1']['hold_level_terms']['team_min_amount']?> руб.</span>
                                        <span style="display: none;" data-calculator-level-hidden="2">К2 составляет <?=$arResult['levels']['consultant']['K2']['hold_level_terms']['team_min_amount']?> руб.</span>
                                        <span style="display: none;" data-calculator-level-hidden="3">К3 составляет <?=$arResult['levels']['consultant']['K3']['hold_level_terms']['team_min_amount']?> руб.</span>
                                    </p>

                                    <div class="profitability__calculation-total">
                                        <p class="profitability__calculation-total-sum">
                                            = <span data-calculator-group-points-sum>0</span> ББ
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
                                        <span class="switcher__text switcher__text--small">Учитывать разовые начисления баллов, за переход на уровень и привлечение новых консультантов в группу</span>
                                    </label>
                                </div>
                            </div>

                            <div class="profitability__consultants-col profitability__consultants-col--inlined">
                                <div class="profitability__consultants-quantity profitability__consultants-quantity--hidden quantity quantity--active" data-quantity data-consultants-quantity>
                                    <div class="quantity__actions">
                                        <div class="quantity__decrease">
                                            <button type="button" class="profitability__button button button--iconed button--covered button--square button--small button--gray-red" data-quantity-decrease>
                                                                                <span class="button__icon button__icon--small">
                                                                                    <svg class="icon icon--minus">
                                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-minus"></use>
                                                                                    </svg>
                                                                                </span>
                                            </button>
                                        </div>

                                        <div class="quantity__total">
                                                                            <span class="profitability__sum quantity__total-sum" data-quantity-sum="1" data-quantity-min="1" data-quantity-max="999">
                                                                                1
                                                                            </span>
                                        </div>

                                        <div class="quantity__increase">
                                            <button type="button" class="profitability__button button button--iconed button--covered button--square button--small button--gray-green" data-quantity-increase>
                                                                                <span class="button__icon button__icon--small">
                                                                                    <svg class="icon icon--plus">
                                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-plus"></use>
                                                                                    </svg>
                                                                                </span>
                                            </button>
                                        </div>
                                    </div>

                                    <span class="profitability__signature">Новых консультантов</span>
                                </div>

                                <div class="profitability__hint profitability__hint--consultant" 
                                        data-tippy-content="В расчёте будут учтены баллы, которые Вы можете получить, если привлечёте
                                        1 новых консультантов в свою группу
                                        ">
                                    <svg class="icon icon--question-circle">
                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-question-circle"></use>
                                    </svg>
                                </div>
                                
                            </div>

                        </div>

                        <button type="button" class="profitability__computing button button--medium button--rounded button--covered button--red button--full button--disabled" disabled data-calculator-computing>
                            <span class="button__text">Рассчитать</span>
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </section>

    <section class="profitability__section section" data-calculator-computing-block style="display: none">
        <div class="section__box box box--gray box--rounded-sm">
            <div class="profitability__section-header section__header">
                <h4 class="section__title section__title--closer">Результат расчета Вашего потенциального дохода</h4>

                <!--к1-->
                <div class="profitability__hint" data-tippy-html data-calculator-level-hidden="1">
                    <svg class="icon icon--question-circle">
                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-question-circle"></use>
                    </svg>

                    <div style="display: none;" data-tippy-template>
                        <div class="profitability__tooltip">
                            <p class="profitability__tooltip-title">Баллы на уровне К1:</p>

                            <ul class="profitability__tooltip-list">
                                <li class="profitability__tooltip-item">
                                    <svg class="profitability__tooltip-icon icon icon--check-mark">
                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check-mark"></use>
                                    </svg>

                                    <p class="profitability__tooltip-text"><?=$arResult['levels']['consultant']['K1']['benefits']['personal_bonuses_for_cost']['size']?>Б за каждые полные <?=$arResult['levels']['consultant']['K1']['benefits']['personal_bonuses_for_cost']['step']?> рублей личных покупок</p>
                                </li>

                                <li class="profitability__tooltip-item">
                                    <svg class="profitability__tooltip-icon icon icon--check-mark">
                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check-mark"></use>
                                    </svg>

                                    <p class="profitability__tooltip-text"><?=$arResult['levels']['consultant']['K1']['benefits']['group_bonuses_for_cost']['size']?>Б за каждые полные <?=$arResult['levels']['consultant']['K1']['benefits']['group_bonuses_for_cost']['step']?> рублей покупок Вашей группы</p>
                                </li>

                                <li class="profitability__tooltip-item">
                                    <svg class="profitability__tooltip-icon icon icon--check-mark">
                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check-mark"></use>
                                    </svg>

                                    <p class="profitability__tooltip-text"><?=$arResult['levels']['consultant']['K1']['benefits']['referral_size']?>Б за каждого нового Консультанта в Вашей группе*</p>
                                </li>
                            </ul>

                            <p class="profitability__tooltip-note">*Единоразово</p>
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
                            <p class="profitability__tooltip-title">Баллы на уровне К2:</p>

                            <ul class="profitability__tooltip-list">
                                <li class="profitability__tooltip-item">
                                    <svg class="profitability__tooltip-icon icon icon--check-mark">
                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check-mark"></use>
                                    </svg>

                                    <p class="profitability__tooltip-text"><?=$arResult['levels']['consultant']['K2']['benefits']['personal_bonuses_for_cost']['size']?>Б за каждые полные <?=$arResult['levels']['consultant']['K2']['benefits']['personal_bonuses_for_cost']['step']?> рублей личных покупок</p>
                                </li>

                                <li class="profitability__tooltip-item">
                                    <svg class="profitability__tooltip-icon icon icon--check-mark">
                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check-mark"></use>
                                    </svg>

                                    <p class="profitability__tooltip-text"><?=$arResult['levels']['consultant']['K2']['benefits']['group_bonuses_for_cost']['size']?>Б за каждые полные <?=$arResult['levels']['consultant']['K2']['benefits']['group_bonuses_for_cost']['step']?> рублей покупок Вашей группы</p>
                                </li>

                                <li class="profitability__tooltip-item">
                                    <svg class="profitability__tooltip-icon icon icon--check-mark">
                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check-mark"></use>
                                    </svg>

                                    <p class="profitability__tooltip-text"><?=$arResult['levels']['consultant']['K2']['benefits']['referral_size']?>Б за каждого нового Консультанта в Вашей группе*</p>
                                </li>

                                <li class="profitability__tooltip-item">
                                    <svg class="profitability__tooltip-icon icon icon--check-mark">
                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check-mark"></use>
                                    </svg>

                                    <p class="profitability__tooltip-text"><?=$arResult['levels']['consultant']['K2']['benefits']['upgrade_level_bonuses']?>Б за переход на новый уровень*</p>
                                </li>
                            </ul>

                            <p class="profitability__tooltip-note">*Единоразово</p>
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
                            <p class="profitability__tooltip-title">Баллы на уровне К3:</p>

                            <ul class="profitability__tooltip-list">
                                <li class="profitability__tooltip-item">
                                    <svg class="profitability__tooltip-icon icon icon--check-mark">
                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check-mark"></use>
                                    </svg>

                                    <p class="profitability__tooltip-text"><?=$arResult['levels']['consultant']['K3']['benefits']['personal_bonuses_for_cost']['size']?>Б за каждые полные <?=$arResult['levels']['consultant']['K3']['benefits']['personal_bonuses_for_cost']['step']?> рублей личных покупок</p>
                                </li>

                                <li class="profitability__tooltip-item">
                                    <svg class="profitability__tooltip-icon icon icon--check-mark">
                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check-mark"></use>
                                    </svg>

                                    <p class="profitability__tooltip-text"><?=$arResult['levels']['consultant']['K3']['benefits']['group_bonuses_for_cost']['size']?>Б за каждые полные <?=$arResult['levels']['consultant']['K3']['benefits']['group_bonuses_for_cost']['step']?> рублей покупок Вашей группы</p>
                                </li>

                                <li class="profitability__tooltip-item">
                                    <svg class="profitability__tooltip-icon icon icon--check-mark">
                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check-mark"></use>
                                    </svg>

                                    <p class="profitability__tooltip-text"><?=$arResult['levels']['consultant']['K3']['benefits']['referral_size']?>Б за каждого нового Консультанта в Вашей группе*</p>
                                </li>

                                <li class="profitability__tooltip-item">
                                    <svg class="profitability__tooltip-icon icon icon--check-mark">
                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check-mark"></use>
                                    </svg>

                                    <p class="profitability__tooltip-text"><?=$arResult['levels']['consultant']['K3']['benefits']['upgrade_level_bonuses']?>Б за переход на новый уровень**</p>
                                </li>
                            </ul>

                            <p class="profitability__tooltip-note">*Единоразово</p>
                            <p class="profitability__tooltip-note">**Каждые 6 месяцев поддержания уровня</p>
                        </div>
                    </div>
                </div>
                <!--к3-->
            </div>

            <div class="diagramm">
                <div class="diagramm__row">

                    <div class="diagramm__total diagramm__total--mobile">
                        <span class="diagramm__total-text">Ваш потенциальный* доход</span>
                        <span class="diagramm__total-sum"><span data-calculator-computing-sum>0</span> ₽</span>
                    </div>

                    <div class="diagramm__col diagramm__col--results">
                        <div class="diagramm__results">
                            <div class="diagramm__result">
                                <span class="diagramm__result-icon" style="background-color:#3887b5"></span>
                                <span class="diagramm__result-text">Доход от личных продаж</span>
                            </div>
                            <div class="diagramm__result">
                                <span class="diagramm__result-icon" style="background-color:#2c877f"></span>
                                <span class="diagramm__result-text">Прибыль от личных покупок</span>
                            </div>
                            <div class="diagramm__result">
                                <span class="diagramm__result-icon" style="background-color:#945dab"></span>
                                <span class="diagramm__result-text">Доход от группы</span>
                            </div>
                            <div class="diagramm__result">
                                <span class="diagramm__result-icon" style="background-color:#c73c5e"></span>
                                <span class="diagramm__result-text">Разовые начисления</span>
                            </div>
                        </div>

                        <div class="diagramm__total diagramm__total--desktop">
                            <span class="diagramm__total-text">Ваш потенциальный* доход</span>
                            <span class="diagramm__total-sum"><span data-calculator-computing-sum>0</span> ₽</span>
                        </div>
                    </div>

                    <div class="diagramm__col diagramm__col--main">
                        <div class="diagramm__main">
                            <canvas width="400" height="400" data-chart='{"labels": [" Доход от личных продаж", " Прибыль от личных покупок", " Доход от группы", " Разовые начисления"],"datasets": [{"data": [0, 0, 0, 0],"backgroundColor": ["#3887b5","#2c877f","#945dab","#d82f49"]}]}' data-calculator-chart></canvas>
                        </div>
                    </div>

                    <div class="diagramm__col diagramm__col--composition">
                        <div class="diagramm__composition">
                            <div class="diagramm__composition-item">
                                <div class="diagramm__piece">
                                    <canvas width="80" height="80" data-chart='{"datasets": [{"data": [0, 1],"backgroundColor": ["#3887b5", "#D0EDFE"]}]}' data-chart-no-labels data-chart-no-tooltip data-calculator-chart-income-sales></canvas>
                                </div>
                                <div class="diagramm__composition-text">Доход<br> от личных продаж</div>
                            </div>
                            <div class="diagramm__composition-item">
                                <div class="diagramm__piece">
                                    <canvas width="80" height="80" data-chart='{"datasets": [{"data": [0, 1],"backgroundColor": ["#2C877F","#C5F2F2"]}]}' data-chart-no-labels data-chart-no-tooltip data-calculator-chart-profit-purchases></canvas>
                                </div>
                                <div class="diagramm__composition-text">Прибыль<br> от личных покупок</div>
                            </div>
                            <div class="diagramm__composition-item">
                                <div class="diagramm__piece">
                                    <canvas width="80" height="80" data-chart='{"datasets": [{"data": [0, 1],"backgroundColor": ["#945DAB","#DDCFE3"]}]}' data-chart-no-labels data-chart-no-tooltip data-calculator-chart-income-group></canvas>
                                </div>
                                <div class="diagramm__composition-text">Доход от группы <br><br></div>
                            </div>
                            <div class="diagramm__composition-item">
                                <div class="diagramm__piece">
                                    <canvas width="80" height="80" data-chart='{"datasets": [{"data": [0, 1],"backgroundColor": ["#C73C5E","#FAD0D3"]}]}' data-chart-no-labels data-chart-no-tooltip data-calculator-chart-onetime-charges></canvas>
                                </div>
                                <div class="diagramm__composition-text">Разовые<br> начисления</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="diagramm__footer">
                    <p class="diagramm__footer-info">
                        *Калькулятор позволяет осуществить ориентировочный расчет Вашего вознаграждения, предоставлен на основе данных, введенных в полях калькулятора доходности, и не является точным прогнозом.
                    </p>
                </div>
            </div>

        </div>
    </section>
</div>
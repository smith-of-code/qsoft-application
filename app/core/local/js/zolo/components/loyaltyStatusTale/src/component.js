import NumberFormatMixin from "../../../mixins/NumberFormatMixin";

export const LoyaltyStatusTale = {
    mixins: [NumberFormatMixin],

    props: {
        currentValue: {
            type: Number,
            required: true,
        },
        targetValue: {
            type: Number,
            required: true,
        },
        label: {
            type: String,
            required: true,
        },
        isHold: {
            type: Boolean,
            default: true,
        },
        isConsultant: {
            type: Boolean,
            default: true,
        },
    },

    template: `
        <div v-if="targetValue > 0" class="card-progress card-progress--unbordered">
            <div class="card-progress__inner">
                <p class="card-progress__title">
                    {{ label }}
                </p>
                <div v-if="currentValue / targetValue < 0.5" class="card-progress__mark">
                    <svg class="card-progress__icon icon icon--cat-serious">
                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-cat-sad"></use>
                    </svg>
                    <span class="card-progress__mark-text">
                        Нужно больше усилий
                    </span>
                </div>
                <div v-else-if="currentValue / targetValue < 1" class="card-progress__mark">
                    <svg class="card-progress__icon icon icon--cat-serious">
                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-cat-serious"></use>
                    </svg>
                    <span class="card-progress__mark-text">
                        Хорошо получается
                    </span>
                </div>
                <div v-else-if="currentValue / targetValue == 1" class="card-progress__mark">
                    <svg class="card-progress__icon icon icon--cat-serious">
                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-cat-smile"></use>
                    </svg>
                    <span class="card-progress__mark-text">
                        Цель достигнута
                    </span>
                </div>
                <div v-else class="card-progress__mark">
                    <svg class="card-progress__icon icon icon--cat-serious">
                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-cat-happy"></use>
                    </svg>
                    <span class="card-progress__mark-text">
                        Просто фантастика
                    </span>
                </div>
                <div class="card-progress__wrapper">
                    <div class="card-progress__progress progress-bar">
                        <div
                            class="progress-bar__filler"
                            :style="{ width: ((currentValue * 100 / targetValue) < 100 ? (currentValue * 100 / targetValue) : 100) + '%' }"
                            :class="{ 
                                'progress-bar__filler--green': targetValue - currentValue <= 0,
                                'progress-bar__filler--red': targetValue - currentValue > 0,
                             }"
                        ></div>
                    </div>
                    <div class="card-progress__bottom">
                        <div class="card-progress__amount amount">
                            <p
                                class="amount__target"
                                :class="{
                                    'amount__target--green': targetValue - currentValue <= 0,
                                    'amount__target--red': targetValue - currentValue > 0,
                                }"
                            >
                                {{ formatNumber(currentValue) }} ₽
                            </p>
                            <p class="amount__total">
                                из {{ formatNumber(targetValue) }} ₽
                            </p>
                        </div>
                        <div v-if="targetValue - currentValue > 0" class="card-progress__status">
                            <p class="card-progress__text">
                                Осталось {{ formatNumber(targetValue - currentValue) }}&nbsp;₽
                            </p>
                        </div>
                        <div v-else-if="targetValue - currentValue == 0" class="card-progress__status">
                            <p class="card-progress__text">
                                Выполнено
                            </p>
                        </div>
                        <div v-else class="card-progress__status">
                            <p class="card-progress__text">
                                Перевыполнено на  {{ formatNumber(currentValue - targetValue) }}&nbsp;₽
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card-progress__warning warning">
                    <div class="warning__mark">
                        <button type="button" class="button button--iconed button--simple button--red" data-fancybox="" data-modal-type="modal" :data-src="isHold ? '#hold-conditions' : '#upgrade-conditions'">
                            <span class="button__icon">
                                <svg class="icon icon--basket warning__icon">
                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-attention"></use>
                                </svg>
                            </span>
                        </button>
                    </div>
                    <p class="warning__text">
                        {{ isHold ? 'Условия поддержания уровня' : 'Условия повышения уровня' }}
                    </p>
                </div>
                <article v-if="isHold" id="hold-conditions" class="modal modal--full box box--circle box--hanging" style="display: none">
                    <div class="modal__content">
                        <header class="modal__section modal__section--header">
                            <p class="heading heading--average">Условия поддержания уровня</p>
                        </header>

                        <section class="modal__section modal__section--content">
                            <div class="conditions">
                                <div class="conditions__block">
                                    <h5 class="conditions__title">
                                        Условия поддержания уровня для {{isConsultant ? "К1" : "В1"}}:
                                    </h5>
                                    <ul class="conditions__list">
                                        <li class="conditions__item">
                                            Совершение личных покупок на общую сумму {{ formatNumber(5000) }} рублей за период в 3 последовательных месяца (квартал);
                                        </li>
                                    </ul>
                                </div>

                                <div class="conditions__block">
                                    <h5 class="conditions__title">
                                        Условия поддержания уровня для {{isConsultant ? "К2" : "В2"}} (единовременное соблюдение всех условий):
                                    </h5>

                                    <ul class="conditions__list">
                                        <li class="conditions__item">
                                            Совершение личных покупок на сумму {{ formatNumber(5000) }} рублей каждый месяц за период в 3 последовательных месяца (квартал);
                                        </li>

                                        <li class="conditions__item">
                                            Совершение групповых покупок на сумму {{ formatNumber(7000) }} рублей каждый месяц за период в 3 последовательных месяца (квартал);
                                        </li>
                                    </ul>

                                    <p class="conditions__text">Переход на уровень {{isConsultant ? "К2" : "В2"}} возможен в течение 3 последовательных месяцев при соблюдении условий перехода на уровень {{isConsultant ? "К2" : "В2"}};
                                    </p>
                                    <p class="conditions__text">При несоблюдении условий поддержания уровня {{isConsultant ? "К2" : "В2"}} будет выполняться переход на уровень {{isConsultant ? "К1" : "В1"}}.</p>
                                </div>

                                <div class="conditions__block">
                                    <h5 class="conditions__title">
                                        Условия поддержания уровня для {{isConsultant ? "К3" : "В3"}} (единовременное соблюдение всех условий):
                                    </h5>

                                    <ul class="conditions__list">
                                        <li class="conditions__item">
                                            Совершение личных покупок на сумму {{ formatNumber(10000) }} рублей каждый месяц за период в 3 последовательных месяца (квартал);
                                        </li>

                                        <li class="conditions__item">
                                            Совершение групповых покупок на сумму {{ formatNumber(20000) }} рублей каждый месяц за период в 3 последовательных месяца (квартал);
                                        </li>
                                    </ul>

                                    <p class="conditions__text">Переход на уровень {{isConsultant ? "К3" : "В3"}} возможен в течение 6 последовательных месяцев при соблюдении условий перехода на уровень {{isConsultant ? "К3" : "В3"}};

                                    </p>
                                    <p class="conditions__text">При несоблюдении условий поддержания уровня {{isConsultant ? "К3" : "В3"}} будет выполняться переход на уровень {{isConsultant ? "К2" : "В2"}}.</p>
                                </div>
                            </div>
                        </section>
                    </div>
                </article>
                <article v-else id="upgrade-conditions" class="modal modal--full box box--circle box--hanging" style="display: none">
                    <div class="modal__content">
                        <header class="modal__section modal__section--header">
                            <p class="heading heading--average">Условия повышения уровня</p>
                        </header>

                        <section class="modal__section modal__section--content">
                            <div class="conditions">
                                <div class="conditions__block">
                                    <h5 class="conditions__title">
                                        Условия повышения уровня до {{isConsultant ? "К2" : "В2"}} (единовременное соблюдение всех условий):
                                    </h5>

                                    <ul class="conditions__list">
                                        <li class="conditions__item">
                                            Совершение личных покупок на общую сумму {{ formatNumber(10000) }} рублей за период в 3 последовательных месяца (квартал);
                                        </li>

                                        <li class="conditions__item">
                                            Совершение групповых покупок на общую сумму {{ formatNumber(10000) }} рублей за период в 3 последовательных месяца (квартал);
                                        </li>
                                    </ul>

                                    <p class="conditions__text">Переход на уровень {{isConsultant ? "К2" : "В2"}} возможен в течение 3 последовательных месяцев при соблюдении условий перехода на уровень {{isConsultant ? "К2" : "В2"}};</p>
                                </div>

                                <div class="conditions__block">
                                    <h5 class="conditions__title">
                                        Условия повышения уровня до {{isConsultant ? "К3" : "В3"}} (единовременное соблюдение всех условий):
                                    </h5>

                                    <ul class="conditions__list">
                                        <li class="conditions__item">
                                            Совершение личных покупок на общую сумму {{ formatNumber(50000) }} рублей за период в 6 последовательных месяца (два последовательных квартала);
                                        </li>

                                        <li class="conditions__item">
                                            Совершение групповых покупок на общую сумму {{ formatNumber(100000) }} рублей за период в 6 последовательных месяца (два последовательных квартала);
                                        </li>
                                    </ul>

                                    <p class="conditions__text">Переход на уровень {{isConsultant ? "К3" : "В3"}} возможен в течение 6 последовательных месяцев при соблюдении условий перехода на уровень {{isConsultant ? "К3" : "В3"}};</p>
                                </div>
                            </div>
                        </section>
                    </div>
                </article>
            </div>
        </div>
        <div v-else class="card-progress card-progress--success card-progress--unbordered">
            <div class="card-progress__inner card-progress__inner--columed">
                <div class="card-progress__image">
                    <svg class="card-progress__image-pic icon icon--cat-cheerful">
                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-cat-cheerful"></use>
                    </svg>
                </div>
                <p class="card-progress__text">У Вас максимальный уровень</p>
            </div>
        </div>
    `
};
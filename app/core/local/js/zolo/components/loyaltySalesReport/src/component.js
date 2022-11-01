import { useLoyaltySalesReportStore } from '../../../stores/loyaltySalesReportStore';

export const LoyaltySalesReport = {
    data() {
        return {}
    },

    props: {
        user: {
            type: Object,
            required: true,
        },
        ordersReport: {
            type: Object,
            required: true,
        },
        currentAccountingPeriod: {
            type: Object,
            required: true,
        },
        accountingPeriods: {
            type: Array,
            required: true,
        },
        loyaltyStatus: {
            type: Object,
            required: true,
        },
        bonusesIncome: {
            type: Object,
            required: true,
        },
    },

    setup() {
        return { loyaltySalesReportStore: useLoyaltySalesReportStore() };
    },

    created() {
        console.log(this.user, this.loyaltyStatus, this.bonusesIncome);
    },

    methods: {
        formatNumber(number) {
            return parseInt(number).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$& ') + ' ₽';
        },
    },
    
    template: `
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
                                                    <img :src="user.photo" alt="#" class="avatar__picture">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="participant__col participant__col--name">
                                            <div class="participant__info">
                                                <span class="participant__info-name">ФИО</span>
                                                <span class="participant__info-value participant__info-value--truncate participant__info-value--accent" data-tippy-content="Достоевская-Васильева А.М." data-show-text>{{ user.name_initials }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="participant__row participant__row--separated">
                                        <div class="participant__col participant__col--id">
                                            <div class="participant__info">
                                                <span class="participant__info-name">ID</span>
                                                <span class="participant__info-value">{{ user.id }}</span>
                                            </div>
                                        </div>

                                        <div class="participant__col participant__col--level">
                                            <div class="participant__info">
                                                <span class="participant__info-name">Уровень</span>
                                                <span class="participant__info-value">{{ user.loyalty_level }}</span>
                                            </div>
                                        </div>

                                        <div class="participant__col participant__col--date">
                                            <div class="participant__info">
                                                <span class="participant__info-name">На сайте с</span>
                                                <span class="participant__info-value">{{ user.date_register }}</span>
                                            </div>
                                        </div>

                                        <div class="participant__col participant__col--tel participant__col--separated">
                                            <div class="participant__info">
                                                <span class="participant__info-name">Телефон</span>
                                                <span class="participant__info-value">{{ user.phone }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="participant__row">
                                        <div class="participant__col participant__col--email">
                                            <div class="participant__info">
                                                <span class="participant__info-name">Email</span>
                                                <span class="participant__info-value participant__info-value--truncate" data-tippy-content="dostaevskaya-vasileva1995@yandex.ru" data-show-text>{{ user.email }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="accounting__section-box section__box box box--gray">

                                <div class="accounting__period filter filter--content">
                                    <form class="accounting__period-form form">
                                        <div class="accounting__period-name heading heading--small">
                                            Выберите период отчета
                                        </div>

                                        <div class="form__field">
                                            <div class="form__field-block form__field-block--input">
                                                <div class="form__control">
                                                    <div class="accounting__period-select select select--mitigate select--small select--squared" data-select>
                                                        <select class="select__control" name="select2" data-select-control data-placeholder="Период">
                                                            <option><!-- пустой option для placeholder --></option>
                                                            <option
                                                                v-for="accountingPeriod in accountingPeriods"
                                                                :key="accountingPeriod.name"
                                                                value="1"
                                                            >{{ accountingPeriod.name }}</option>
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
                                                                        <div v-if="loyaltyStatus.self.current_value / loyaltyStatus.self.hold_value < 0.5" class="card-progress__mark">
                                                                            <svg class="card-progress__icon icon icon--cat-serious">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-cat-serious"></use>
                                                                            </svg>
                                                                            <span class="card-progress__mark-text">
                                                                                Нужно больше усилий
                                                                            </span>
                                                                        </div>
                                                                        <div v-else-if="loyaltyStatus.self.current_value / loyaltyStatus.self.hold_value < 1" class="card-progress__mark">
                                                                            <svg class="card-progress__icon icon icon--cat-serious">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-cat-serious"></use>
                                                                            </svg>
                                                                            <span class="card-progress__mark-text">
                                                                                Хорошо получается
                                                                            </span>
                                                                        </div>
                                                                        <div v-else class="card-progress__mark">
                                                                            <svg class="card-progress__icon icon icon--cat-serious">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-cat-serious"></use>
                                                                            </svg>
                                                                            <span class="card-progress__mark-text">
                                                                                Просто фантастика
                                                                            </span>
                                                                        </div>
                                                                        <div class="card-progress__wrapper">
                                                                            <div class="card-progress__progress progress-bar">
                                                                                <div
                                                                                    :style="{ width: (loyaltyStatus.self.current_value * 100 / loyaltyStatus.self.hold_value) + '%' }"
                                                                                    class="progress-bar__filler progress-bar__filler--red"
                                                                                ></div>
                                                                            </div>
                                                                            <div class="card-progress__bottom">
                                                                                <div class="card-progress__amount amount">
                                                                                    <p class="amount__target amount__target--red">
                                                                                        {{ formatNumber(loyaltyStatus.self.current_value) }}
                                                                                    </p>
                                                                                    <p class="amount__total">
                                                                                        из {{ formatNumber(loyaltyStatus.self.hold_value) }}
                                                                                    </p>
                                                                                </div>
                                
                                                                                <div v-if="loyaltyStatus.self.hold_value > loyaltyStatus.self.current_value" class="card-progress__status">
                                                                                    <p class="card-progress__text">
                                                                                        Осталось {{ formatNumber(loyaltyStatus.self.hold_value - loyaltyStatus.self.current_value) }}
                                                                                    </p>
                                                                                </div>
                                                                                <div v-else class="card-progress__status">
                                                                                    <p class="card-progress__text">
                                                                                        Перевыполнено на  {{ formatNumber(loyaltyStatus.self.current_value - loyaltyStatus.self.hold_value) }}
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
                                                            <li class="cards-progress__item">
                                                                <div class="card-progress card-progress--unbordered">
                                                                    <div class="card-progress__inner">
                                                                        <p class="card-progress__title">
                                                                            Повышения уровня по личным покупкам
                                                                        </p>
                                                                        <div v-if="loyaltyStatus.self.current_value / loyaltyStatus.self.upgrade_value < 0.5" class="card-progress__mark">
                                                                            <svg class="card-progress__icon icon icon--cat-serious">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-cat-serious"></use>
                                                                            </svg>
                                                                            <span class="card-progress__mark-text">
                                                                                Нужно больше усилий
                                                                            </span>
                                                                        </div>
                                                                        <div v-else-if="loyaltyStatus.self.current_value / loyaltyStatus.self.upgrade_value < 1" class="card-progress__mark">
                                                                            <svg class="card-progress__icon icon icon--cat-serious">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-cat-serious"></use>
                                                                            </svg>
                                                                            <span class="card-progress__mark-text">
                                                                                Хорошо получается
                                                                            </span>
                                                                        </div>
                                                                        <div v-else class="card-progress__mark">
                                                                            <svg class="card-progress__icon icon icon--cat-serious">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-cat-serious"></use>
                                                                            </svg>
                                                                            <span class="card-progress__mark-text">
                                                                                Просто фантастика
                                                                            </span>
                                                                        </div>
                                                                        <div class="card-progress__wrapper">
                                                                            <div class="card-progress__progress progress-bar">
                                                                                <div
                                                                                    :style="{ width: (loyaltyStatus.self.current_value * 100 / loyaltyStatus.self.upgrade_value) + '%' }"
                                                                                    class="progress-bar__filler progress-bar__filler--green"
                                                                                ></div>
                                                                            </div>
                                                                            <div class="card-progress__bottom">
                                                                                <div class="card-progress__amount amount">
                                                                                    <p class="amount__target amount__target--green">
                                                                                        {{ formatNumber(loyaltyStatus.self.current_value) }}
                                                                                    </p>
                                                                                    <p class="amount__total">
                                                                                        из {{ formatNumber(loyaltyStatus.self.upgrade_value) }}
                                                                                    </p>
                                                                                </div>
                                                                                <div v-if="loyaltyStatus.self.hold_value > loyaltyStatus.self.current_value" class="card-progress__status">
                                                                                    <p class="card-progress__text">
                                                                                        Осталось {{ formatNumber(loyaltyStatus.self.upgrade_value - loyaltyStatus.self.current_value) }}
                                                                                    </p>
                                                                                </div>
                                                                                <div v-else class="card-progress__status">
                                                                                    <p class="card-progress__text">
                                                                                        Перевыполнено на  {{ formatNumber(loyaltyStatus.self.current_value - loyaltyStatus.self.upgrade_value) }}
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
                                                                                <div
                                                                                    :style="{ width: (loyaltyStatus.team.current_value * 100 / loyaltyStatus.team.hold_value) + '%' }"
                                                                                    class="progress-bar__filler progress-bar__filler--red"
                                                                                ></div>
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
                                                                        <p class="result__total">{{ formatNumber(ordersReport.total_sum) }}</p>
                                                                    </div>
                                                                </div>
                                                                <!--/Результат-->
                                                            </li>

                                                            <li class="results__item">
                                                                <div class="result">
                                                                    <div class="result__main">
                                                                        <p class="result__title">Сумма личных заказов за текущий отчетный период</p>
                                                                        <p class="result__total">{{ formatNumber(ordersReport.current_period_sum) }}</p>
                                                                    </div>
                                                                </div>
                                                            </li>

                                                            <li class="results__item">
                                                                <div class="result">
                                                                    <div class="result__main">
                                                                        <p class="result__title">Сумма личных баллов за текущий период</p>
                                                                        <p class="result__total">{{ ordersReport.current_period_bonuses }} ББ</p>
                                                                    </div>
                                                                </div>
                                                            </li>

                                                            <li class="results__item">
                                                                <div class="result">
                                                                    <div class="result__main">
                                                                        <p class="result__title">Количество личных заказов со статусом «Оплачен»</p>
                                                                        <p class="result__total">{{ ordersReport.paid_orders_count }}</p>
                                                                    </div>
                                                                </div>
                                                            </li>

                                                            <li class="results__item">
                                                                <div class="result">
                                                                    <div class="result__main">
                                                                        <p class="result__title">Количество личных заказов со статусом «Возврат»</p>
                                                                        <p class="result__total">Не реализовано</p>
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
                                                                        <p class="result__total">{{ ordersReport.last_order_date }}</p>
                                                                    </div>
                                                                </div>
                                                            </li>

                                                            <li class="results__item">
                                                                <div class="result">
                                                                    <div class="result__main">
                                                                        <p class="result__title">Количество товаров со всех заказов за последний месяц</p>
                                                                        <p class="result__total">{{ ordersReport.last_month_products.length }}</p>
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
                                                                                    <li v-for="product in ordersReport.last_month_products" :key="product.article" class="table-list__item">
                                                                                        <article class="product-line">
                                                                                            <div class="product-line__inner">
                                                                                                <div class="product-line__info">
                                                                                                    <div class="product-line__image">
                                                                                                        <img src="/local/templates/.default/images/portage.png" alt="#" class="product-line__image-picture">
                                                                                                    </div>
                                                                                                    <div class="product-line__wrapper">
                                                                                                        <h2 class="product-line__title">
                                                                                                            {{ product.name }}
                                                                                                        </h2>
                                                                                                        <p class="product-line__subtitle">
                                                                                                            Арт. {{ product.article }}
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
                                                                                                                    {{ formatNumber(product.price) }}
                                                                                                                </span>
                                                                                                            </p>
                                                                                                        </li> 
                                                                                                        <li class="product-line__params">
                                                                                                            <p class="product-line__text">
                                                                                                                <span class="product-line__params-name">
                                                                                                                    Количество:
                                                                                                                </span>
                                                                                                                <span class="product-line__params-value">
                                                                                                                    {{ product.quantity }}
                                                                                                                </span>
                                                                                                            </p>
                                                                                                        </li> 
                                                                                                        <li class="product-line__params product-line__params--bold">
                                                                                                            <p class="product-line__text">
                                                                                                                <span class="product-line__params-name">
                                                                                                                    Сумма:
                                                                                                                </span>
                                                                                                                <span class="product-line__params-value">
                                                                                                                    {{ formatNumber(product.price * product.quantity) }}
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
            </div>
        </div>    
    `
};
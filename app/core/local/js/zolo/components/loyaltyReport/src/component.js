import { useLoyaltySalesReportStore } from '../../../stores/loyaltySalesReportStore';
import { LoyaltyStatusReport } from "../../loyaltyStatusReport/src/component";
import { OrdersReport } from "../../ordersReport/src/component";
import NumberFormatMixin from "../../../mixins/NumberFormatMixin";

export const LoyaltyReport = {
    components: { LoyaltyStatusReport, OrdersReport },

    mixins: [NumberFormatMixin],

    data() {
        return {
            mutableLoyaltyStatus: {},
            mutableBonusesIncome: {},
            mutableOrdersReport: {},
        }
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
        accordion: {
            type: Boolean,
            default: false,
        },
    },

    setup() {
        return { loyaltySalesReportStore: useLoyaltySalesReportStore() };
    },

    created() {
        this.mutableLoyaltyStatus = this.loyaltyStatus;
        this.mutableBonusesIncome = this.bonusesIncome;
        this.mutableOrdersReport = this.ordersReport;
    },

    mounted() {
        if (!this.accordion) {
            $('select[name=accounting_periods]').on('change', () => this.changeAccountingPeriod());
        }
    },

    methods: {
        async changeAccountingPeriod() {
            const period = $('select[name=accounting_periods]').val().split('-');

            const response = await this.loyaltySalesReportStore.getDataByPeriod(period[0], period[1]);

            this.mutableLoyaltyStatus = response.data.loyalty_status;
            this.mutableOrdersReport = response.data.orders_report;
        },
    },

    template: `
        <div :class="{ 'accordeon__item': accordion, 'participant__item': accordion, participant: !accordion, 'participant--accounting': !accordion }" :data-accordeon="accordion">
            <div class="participant__header box box--rounded-sm" :class="{ 'accordeon__header': accordion, 'participant__item': !accordion, 'box--gray': !accordion }">
                <div class="participant__row">
                    <div class="participant__col participant__col--avatar">
                        <div class="participant__avatar avatar avatar--accent">
                            <div class="avatar__box">
                                <img :src="user.photo" class="avatar__picture">
                            </div>
                        </div>
                    </div>
                    <div class="participant__col participant__col--name">
                        <div class="participant__info">
                            <span class="participant__info-name">ФИО</span>
                            <span class="participant__info-value participant__info-value--truncate participant__info-value--accent" :data-tippy-content="user.name_initials" data-show-text>{{ user.name_initials }}</span>
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
                            <span class="participant__info-value participant__info-value--truncate" :data-tippy-content="user.email" data-show-text>{{ user.email }}</span>
                        </div>
                    </div>
                </div>
                
                <div v-if="accordion" class="participant__row participant__row--toggle" data-accordeon-toggle>
                    <p class="participant__show">Подробнее</p>
                    <button type="button" class="accordeon__toggle button button--circular button--mini button--covered button--red-white" >
                        <span class="accordeon__toggle-icon button__icon">
                            <svg class="icon icon--arrow-down">
                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-down"></use>
                            </svg>
                        </span>
                    </button>
                </div>
            </div>

            <div :class="{ 'accordeon__body': accordion, 'accounting__section-box': !accordion, 'section__box': !accordion, 'box': !accordion, 'box--gray': !accordion }" :data-accordeon-content="accordion">

                <div v-if="!accordion" class="accounting__period filter filter--content">
                    <form class="accounting__period-form form">
                        <div class="accounting__period-name heading heading--small">
                            Выберите период отчета
                        </div>

                        <div class="form__field">
                            <div class="form__field-block form__field-block--input">
                                <div class="form__control">
                                    <div class="accounting__period-select select select--mitigate select--small select--squared" data-select>
                                        <select class="select__control" name="accounting_periods" data-select-control data-placeholder="Период">
                                            <option><!-- пустой option для placeholder --></option>
                                            <option
                                                v-for="accountingPeriod in accountingPeriods"
                                                :key="accountingPeriod.name"
                                                :selected="accountingPeriod.name === currentAccountingPeriod.name"
                                                :value="accountingPeriod.from + '-' + accountingPeriod.to"
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
                                                <LoyaltyStatusReport
                                                    :current-value="mutableLoyaltyStatus.self.current_value"
                                                    :target-value="mutableLoyaltyStatus.self.hold_value"
                                                />
                                            </li>
                                            <li class="cards-progress__item">
                                                <LoyaltyStatusReport
                                                    :current-value="mutableLoyaltyStatus.self.current_value"
                                                    :target-value="mutableLoyaltyStatus.self.upgrade_value"
                                                />
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
                                                <LoyaltyStatusCard
                                                    :current-value="mutableLoyaltyStatus.team.current_value"
                                                    :target-value="mutableLoyaltyStatus.team.hold_value"
                                                />
                                            </li>
                                            <li class="cards-progress__item">
                                                <LoyaltyStatusCard
                                                    :current-value="mutableLoyaltyStatus.team.current_value"
                                                    :target-value="mutableLoyaltyStatus.team.upgrade_value"
                                                />
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
                        Покупки
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
                                <OrdersReport :orders-report="mutableOrdersReport" />
                            </div>
                            <!--/Таб Личные-->

                            <!--Таб Групповые-->
                            <div class="tabs__block" data-tab-section="block2">
                                <OrdersReport :orders-report="{}" />
                            </div>
                            <!--/Таб Групповые-->
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    `
};
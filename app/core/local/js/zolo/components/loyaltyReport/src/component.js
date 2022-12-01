import { useLoyaltySalesReportStore } from '../../../stores/loyaltySalesReportStore';
import { LoyaltyStatusReport } from "../../loyaltyStatusReport/src/component";
import { OrdersReport } from "../../ordersReport/src/component";
import NumberFormatMixin from "../../../mixins/NumberFormatMixin";

let id = 0;

export const LoyaltyReport = {
    components: { LoyaltyStatusReport, OrdersReport },

    mixins: [NumberFormatMixin],

    data() {
        return {
            componentId: `loyalty-report${++id}`,
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
        async changeAccountingPeriod(data) {
            if (!data) {
                const period = $('select[name=accounting_periods]').val().split('-');
                const response = await this.loyaltySalesReportStore.getDataByPeriod(period[0], period[1]);
                data = response.data;
            }

            this.mutableLoyaltyStatus = data.loyalty_status;
            this.mutableOrdersReport = data.orders_report;
            this.mutableBonusesIncome = data.bonuses_income;

            const diagram = $(`#${this.componentId}`)[0];
            diagram.myChart.data = this.mutableBonusesIncome.js_data;
            diagram.myChart.update();
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

                    <div v-if="user.pets" class="participant__col participant__col--pets">
                        <div class="participant__info">
                            <span class="participant__info-name">Питомец</span>
                            <div v-if="!user.pets.length" class="participant__info-pets">
                                <div class="participant__info-pet">
                                    Нет
                                </div>
                            </div>
                            <div v-else class="participant__info-pets">
                                <div v-for="pet in user.pets" :key="pet" class="participant__info-pet" :class="'participant__info-pet--' + pet">
                                    <svg class="icon" :class="'icon--' + pet">
                                        <use :xlink:href="'/local/templates/.default/images/icons/sprite.svg#icon-' + pet + '-seating'"></use>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                  
                    <div v-else class="participant__col participant__col--level">
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
                        <div class="accounting__period-heading">
                            <div class="accounting__period-name heading heading--small">
                                Выберите период отчета
                            </div>

                            <div class="form__field">
                                <div class="form__field-block form__field-block--input">
                                    <div class="form__control">
                                        <div class="accounting__period-select select select--mitigate select--small select--common" data-select>
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
                        </div>
                    </form>
                </div>

                <div v-if="user.is_consultant === 'true'" class="accounting__diagramm" :hidden="!parseInt(mutableBonusesIncome.total)">
                    <h5 class="accounting__diagramm-title">Мой заработок</h5>

                    <div class="diagramm diagramm--simple">
                        <div class="diagramm__row">
                            <div class="diagramm__col diagramm__col--diagramm">
                                <div class="diagramm__main">
                                    <canvas
                                        width="227"
                                        height="227"
                                        :id="componentId"
                                        :data-chart='JSON.stringify(mutableBonusesIncome.js_data)'
                                    ></canvas>
                                    <div class="diagramm__sum">{{ formatNumber(mutableBonusesIncome.total) }}</div>
                                </div>
                            </div>
                            <div class="diagramm__col diagramm__col--sum">
                                <p class="diagramm__title">Сумма всех заработанных баллов:</p>

                                <div class="diagramm__results">
                                    <div
                                        v-for="(bonusesIncome, bonusesIncomeKey) in mutableBonusesIncome.js_data.labels"
                                        :key="bonusesIncomeKey"
                                        class="diagramm__result"
                                    >
                                        <span class="diagramm__result-icon" :style="{ 'background-color': mutableBonusesIncome.js_data.datasets[0].backgroundColor[bonusesIncomeKey] }"></span>
                                        <span class="diagramm__result-text">{{ bonusesIncome }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div v-if="user.is_consultant === 'true'" class="participant__section">
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
                                        <LoyaltyStatusReport
                                            :current-value="mutableLoyaltyStatus.self.current_value"
                                            :hold-value="mutableLoyaltyStatus.self.hold_value"
                                            :upgrade-value="mutableLoyaltyStatus.self.upgrade_value"
                                        />
                                    </div>
                                </div>
                            </div>
                            <!--/Таб личные-->

                            <!--Таб групповые-->
                            <div class="tabs__block" data-tab-section="block2">
                                <div class="participant__block">
                                    <div class="participant__progress cards-progress">
                                        <LoyaltyStatusReport
                                            :current-value="mutableLoyaltyStatus.team.current_value"
                                            :hold-value="mutableLoyaltyStatus.team.hold_value"
                                            :upgrade-value="mutableLoyaltyStatus.team.upgrade_value"
                                            :is-group="true"
                                        />
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
                        <nav v-if="user.is_consultant === 'true'" class="tabs__items">
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
                                <OrdersReport :orders-report="mutableOrdersReport.self" />
                            </div>
                            <!--/Таб Личные-->

                            <!--Таб Групповые-->
                            <div class="tabs__block" data-tab-section="block2">
                                <OrdersReport :orders-report="mutableOrdersReport.team" />
                            </div>
                            <!--/Таб Групповые-->
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    `
};
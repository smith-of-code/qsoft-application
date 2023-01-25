import { useLoyaltySalesReportStore } from '../../../stores/loyaltySalesReportStore';
import { LoyaltyReport } from "../../loyaltyReport/src/component";

export const SalesReportPage = {
    components: { LoyaltyReport },

    data() {
        return {
            consultantsSortAsc: true,
            consultantsSort: 'id',
            buyersSortAsc: true,
            buyersSort: 'id',
            consultantsLoyaltyLevelFilter: [],
            buyersLoyaltyLevelFilter: [],
            mutableConsultants: [],
            mutableBuyers: [],
        };
    },

    props: {
        consultantLoyaltyLevels: {
            type: Object,
            required: true,
        },
        buyerLoyaltyLevels: {
            type: Object,
            required: true,
        },
        consultantAccountingPeriods: {
            type: Array,
            required: true,
        },
        buyerAccountingPeriods: {
            type: Array,
            required: true,
        },
        currentUser: {
            type: Object,
            required: true,
        },
        currentAccountingPeriod: {
            type: Object,
            required: true,
        },
        team: {
            type: Array,
            required: true,
        },
    },

    setup() {
        return { loyaltySalesReportStore: useLoyaltySalesReportStore() };
    },

    computed: {
        consultantsMembers() {
            return this.mutableConsultants.filter((consultant) => {
                return this.consultantsLoyaltyLevelFilter.length
                    ? this.consultantsLoyaltyLevelFilter.includes(consultant.user_info.loyalty_level)
                    : true;
            }).sort((a, b) => {
                let aPrepared, bPrepared, aDate, bDate;

                switch (this.consultantsSort) {
                    case 'id':
                        return this.consultantsSortAsc ? parseInt(a.user_info.id) > parseInt(b.user_info.id) : parseInt(a.user_info.id) < parseInt(b.user_info.id);
                    case 'loyalty_level':
                        return this.consultantsSortAsc ? a.user_info.loyalty_level > b.user_info.loyalty_level : a.user_info.loyalty_level < b.user_info.loyalty_level;
                    case 'date_register':
                        aPrepared = a.user_info.date_register.split('.');
                        bPrepared = b.user_info.date_register.split('.');
                        aDate = new Date(`${aPrepared[2]}-${aPrepared[1]}-${aPrepared[0]}`);
                        bDate = new Date(`${bPrepared[2]}-${bPrepared[1]}-${bPrepared[0]}`);
                        return this.consultantsSortAsc ? aDate.getTime() > bDate.getTime() : aDate.getTime() < bDate.getTime();
                    case 'paid_orders':
                        return this.consultantsSortAsc ? parseInt(a.orders_report.self.paid_orders_count) < parseInt(b.orders_report.self.paid_orders_count) : parseInt(a.orders_report.self.paid_orders_count) > parseInt(b.orders_report.self.paid_orders_count);
                    case 'refunded_orders':
                        return this.consultantsSortAsc ? parseInt(a.orders_report.self.refunded_orders_count) < parseInt(b.orders_report.self.refunded_orders_count) : parseInt(a.orders_report.self.refunded_orders_count) > parseInt(b.orders_report.self.refunded_orders_count);
                    case 'orders_count':
                        return this.consultantsSortAsc ? parseInt(a.orders_report.self.orders_count) < parseInt(b.orders_report.self.orders_count) : parseInt(a.orders_report.self.orders_count) > parseInt(b.orders_report.self.orders_count);
                    case 'current_bonuses_count':
                        return this.consultantsSortAsc ? parseInt(a.bonuses_income.total) < parseInt(b.bonuses_income.total) : parseInt(a.bonuses_income.total) > parseInt(b.bonuses_income.total);
                    case 'current_orders_count':
                        return this.consultantsSortAsc ? parseInt(a.orders_report.self.current_orders_count) < parseInt(b.orders_report.self.current_orders_count) : parseInt(a.orders_report.self.current_orders_count) > parseInt(b.orders_report.self.current_orders_count);
                    case 'last_order_date':
                        aPrepared = a.orders_report.self.last_order_date.split('.');
                        bPrepared = b.orders_report.self.last_order_date.split('.');
                        aDate = new Date(`${aPrepared[2]}-${aPrepared[1]}-${aPrepared[0]}`);
                        bDate = new Date(`${bPrepared[2]}-${bPrepared[1]}-${bPrepared[0]}`);
                        return this.consultantsSortAsc ? aDate.getTime() > bDate.getTime() : aDate.getTime() < bDate.getTime();
                    case 'bonuses_count':
                        return this.consultantsSortAsc ? parseInt(a.bonuses_income.all_total) < parseInt(b.bonuses_income.all_total) : parseInt(a.bonuses_income.all_total) > parseInt(b.bonuses_income.all_total);
                }
            });
        },
        buyersMembers() {
            return this.mutableBuyers.filter((buyer) => {
                return this.buyersLoyaltyLevelFilter.length
                    ? this.buyersLoyaltyLevelFilter.includes(buyer.user_info.loyalty_level)
                    : true;
            }).sort((a, b) => {
                let aPrepared, bPrepared, aDate, bDate;

                switch (this.buyersSort) {
                    case 'id':
                        return this.buyersSortAsc ? parseInt(a.user_info.id) > parseInt(b.user_info.id) : parseInt(a.user_info.id) < parseInt(b.user_info.id);
                    case 'date_register':
                        aPrepared = a.user_info.date_register.split('.');
                        bPrepared = b.user_info.date_register.split('.');
                        aDate = new Date(`${aPrepared[2]}-${aPrepared[1]}-${aPrepared[0]}`);
                        bDate = new Date(`${bPrepared[2]}-${bPrepared[1]}-${bPrepared[0]}`);
                        return this.buyersSortAsc ? aDate.getTime() > bDate.getTime() : aDate.getTime() < bDate.getTime();
                    case 'paid_orders':
                        return this.buyersSortAsc ? parseInt(a.orders_report.self.paid_orders_count) < parseInt(b.orders_report.self.paid_orders_count) : parseInt(a.orders_report.self.paid_orders_count) > parseInt(b.orders_report.self.paid_orders_count);
                    case 'refunded_orders':
                        return this.buyersSortAsc ? parseInt(a.orders_report.self.refunded_orders_count) < parseInt(b.orders_report.self.refunded_orders_count) : parseInt(a.orders_report.self.refunded_orders_count) > parseInt(b.orders_report.self.refunded_orders_count);
                    case 'orders_count':
                        return this.buyersSortAsc ? parseInt(a.orders_report.self.orders_count) < parseInt(b.orders_report.self.orders_count) : parseInt(a.orders_report.self.orders_count) > parseInt(b.orders_report.self.orders_count);
                    case 'current_bonuses_count':
                        return this.buyersSortAsc ? parseInt(a.bonuses_income.total) < parseInt(b.bonuses_income.total) : parseInt(a.bonuses_income.total) > parseInt(b.bonuses_income.total);
                    case 'current_orders_count':
                        return this.buyersSortAsc ? parseInt(a.orders_report.self.current_orders_count) < parseInt(b.orders_report.self.current_orders_count) : parseInt(a.orders_report.self.current_orders_count) > parseInt(b.orders_report.self.current_orders_count);
                    case 'last_order_date':
                        aPrepared = a.orders_report.self.last_order_date.split('.');
                        bPrepared = b.orders_report.self.last_order_date.split('.');
                        aDate = new Date(`${aPrepared[2]}-${aPrepared[1]}-${aPrepared[0]}`);
                        bDate = new Date(`${bPrepared[2]}-${bPrepared[1]}-${bPrepared[0]}`);
                        return this.buyersSortAsc ? aDate.getTime() > bDate.getTime() : aDate.getTime() < bDate.getTime();
                }
            });
        },
    },

    created() {
        this.mutableConsultants = this.team.consultants;
        this.mutableBuyers = this.team.buyers;
    },

    mounted() {
        $('select[name=consultant_loyalty_levels]').on('change', () => {
            this.consultantsLoyaltyLevelFilter = $('select[name=consultant_loyalty_levels]').val();
        });
        $('select[name=buyer_loyalty_levels]').on('change', () => {
            this.buyersLoyaltyLevelFilter = $('select[name=buyer_loyalty_levels]').val();
        });

        $('select[name=consultants_sort]').on('change', () => {
            this.consultantsSort = $('select[name=consultants_sort]').val();
        });
        $('select[name=buyers_sort]').on('change', () => {
            this.buyersSort = $('select[name=buyers_sort]').val();
        });

        $('select[name=consultant_accounting_periods]').on('change', () => this.changeConsultantAccountingPeriod());
        $('select[name=buyer_accounting_periods]').on('change', () => this.changeBuyerAccountingPeriod());
    },

    methods: {
        async changeConsultantAccountingPeriod() {
            const period = $('select[name=consultant_accounting_periods]').val().split('-');
            const response = await this.loyaltySalesReportStore.getTeamMembersDataByPeriod(
                this.mutableConsultants.map((user) => user.user_info.id),
                period[0],
                period[1],
            );
            this.mutableConsultants = response.data;
            for (const i in response.data) {
                this.$refs[`consultant-${response.data[i].user_info.id}`][0].changeAccountingPeriod(response.data[i]);
            }
        },
        async changeBuyerAccountingPeriod() {
            const period = $('select[name=buyer_accounting_periods]').val().split('-');
            const response = await this.loyaltySalesReportStore.getTeamMembersDataByPeriod(
                this.mutableBuyers.map((user) => user.user_info.id),
                period[0],
                period[1],
            );
            this.mutableBuyers = response.data;
            for (const i in response.data) {
                this.$refs[`buyer-${response.data[i].user_info.id}`][0].changeAccountingPeriod(response.data[i]);
            }
        },
    },

    template: `
        <div class="private__col private__col--full">
            <div class="accounting">
                <section class="accounting__section section">
                    <div class="section__box box">
                        <LoyaltyReport
                            :user="currentUser.user_info"
                            :orders-report="currentUser.orders_report"
                            :current-accounting-period="currentAccountingPeriod"
                            :accounting-periods="currentUser.accounting_periods"
                            :loyalty-status="currentUser.loyalty_status"
                            :bonuses-income="currentUser.bonuses_income"
                        />
                    </div>
                </section>
                
                <section v-if="team.consultants.length || team.buyers.length" class="accounting__section section">
                    <div class="section__box box">
                        <div class="section__header">
                            <h4 class="section__title">
                                Участники группы
                            </h4>
                        </div>

                        <div class="tabs tabs--gray tabs--covered tabs--small tabs--circle tabs--full-mob" data-tabs>
                            <nav class="accounting__tabs-items tabs__items">
                                <ul class="tabs__list">
                                    <li class="tabs__item tabs__item--active" data-tab="block1">
                                        Консультанты
                                        <span>({{ mutableConsultants.length }})</span>
                                    </li>

                                    <li class="tabs__item" data-tab="block2">
                                        Покупатели
                                        <span>({{ mutableBuyers.length }})</span>
                                    </li>
                                </ul>
                            </nav>

                            <div class="tabs__body">
                                <!--Консультанты-->
                                <div class="tabs__block tabs__block--active" data-tab-section="block1">
                                    <div class="accounting__block">
                                        <div class="accounting__filter content__filter filter filter--content">
                                            <form class="form form--wraped form--separated form--wraped-small">
                                                <div class="form__row form__row--merged">
                                                    <div class="form__col form__col--definite">
                                                        <div class="form__field">
                                                            <div class="form__field-block form__field-block--input">
                                                                <div class="form__control">
                                                                    <div class="filter__select select select--mitigate select--small select--squared select--multiple" data-select>
                                                                        <select class="select__control" name="consultant_loyalty_levels" data-select-control data-placeholder="Выбрать уровень" multiple>
                                                                            <option><!-- пустой option для placeholder --></option>
                                                                            <option
                                                                                v-for="(level, levelName) in consultantLoyaltyLevels"
                                                                                :key="levelName"
                                                                                :value="levelName"
                                                                            >{{ levelName }}</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form__col form__col--definite">
                                                        <div class="form__field">
                                                            <div class="form__field-block form__field-block--input">
                                                                <div class="form__control">
                                                                    <div class="filter__select select select--mitigate select--small select--squared" data-select>
                                                                        <select class="select__control" name="consultant_accounting_periods" data-select-control data-placeholder="Выбрать период">
                                                                            <option><!-- пустой option для placeholder --></option>
                                                                            <option
                                                                                v-for="accountingPeriod in consultantAccountingPeriods"
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

                                                    <div class="form__col form__col--right form__col--definite">
                                                        <div class="form__field">
                                                            <div class="form__field-block form__field-block--input">
                                                                <div class="form__control">
                                                                    <div class="filter__sort select select--small select--sorting select--borderless" data-select>
                                                                        <select class="select__control" name="consultants_sort" data-select-control data-placeholder="Сортировать по">
                                                                            <option><!-- пустой option для placeholder --></option>
                                                                            <option value="loyalty_level">По уровню консультанта</option>
                                                                            <option value="date_register">По дате регистрации</option>
                                                                            <option value="paid_orders">По количеству личных заказов со статусом "Оплачен"</option>
                                                                            <option value="refunded_orders">По количеству личных заказов со статусом "Возврат"</option>
                                                                            <option value="orders_count">По сумме всех личных заказов</option>
                                                                            <option value="current_bonuses_count">По сумме личных баллов за текущий отчетный период</option>
                                                                            <option value="current_orders_count">По сумме личных заказов за текущий отчетный период</option>
                                                                            <option value="last_order_date">По дате последнего личного заказа</option>
                                                                            <option value="bonuses_count">По количеству всех заработанных баллов</option>
                                                                        </select>
                            
                                                                        <button type="button" class="input__button input__button--select button button--iconed button--covered button--square button--dark" @click="consultantsSortAsc = !consultantsSortAsc">
                                                                            <span class="button__icon button__icon--medium">
                                                                                <svg class="icon icon--sort">
                                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-sort"></use>
                                                                                </svg>
                                                                            </span>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                        <div class="accordeon accordeon--separated">
                                            <div class="participant">
                                                <div class="participant__head">
                                                    <div class="participant__head-item participant__head-item--name">ФИО</div>
                                                    <div class="participant__head-item participant__head-item--id">ID</div>
                                                    <div class="participant__head-item participant__head-item--level">Уровень</div>
                                                    <div class="participant__head-item participant__head-item--date">На сайте с</div>
                                                    <div class="participant__head-item participant__head-item--tel">Телефон</div>
                                                    <div class="participant__head-item participant__head-item--email">Email</div>
                                                </div>

                                                <LoyaltyReport
                                                    v-for="member in consultantsMembers"
                                                    :key="member.user_info.id"
                                                    :ref="'consultant-' + member.user_info.id"
                                                    :user="member.user_info"
                                                    :orders-report="member.orders_report"
                                                    :current-accounting-period="currentAccountingPeriod"
                                                    :accounting-periods="member.accounting_periods"
                                                    :loyalty-status="member.loyalty_status"
                                                    :bonuses-income="member.bonuses_income"
                                                    :accordion="true"
                                                    :title="'Заработок Консультанта'"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--/Консультанты-->

                                <!--Покупатели-->
                                <div class="tabs__block" data-tab-section="block2">
                                    <div class="accounting__block">
                                        <div class="accounting__filter content__filter filter filter--content">
                                            <form class="form form--wraped form--separated form--wraped-small">
                                                <div class="form__row form__row--merged">

                                                    <div class="form__col form__col--definite">
                                                        <div class="form__field">
                                                            <div class="form__field-block form__field-block--input">
                                                                <div class="form__control">
                                                                    <div class="filter__select select select--mitigate select--small select--squared" data-select>
                                                                        <select class="select__control" name="buyer_accounting_periods" data-select-control data-placeholder="Выбрать период">
                                                                            <option><!-- пустой option для placeholder --></option>
                                                                            <option
                                                                                v-for="accountingPeriod in buyerAccountingPeriods"
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

                                                    <div class="form__col form__col--right form__col--definite">
                                                        <div class="form__field">
                                                            <div class="form__field-block form__field-block--input">
                                                                <div class="form__control">
                                                                    <div class="filter__sort select select--small select--sorting select--borderless" data-select>
                                                                        <select class="select__control" name="select2" id="sort2" data-select-control data-placeholder="Сортировать по">
                                                                            <option><!-- пустой option для placeholder --></option>
                                                                            <option value="date_register">По дате регистрации</option>
                                                                            <option value="paid_orders">По количеству личных заказов со статусом "Оплачен"</option>
                                                                            <option value="refunded_orders">По количеству личных заказов со статусом "Возврат"</option>
                                                                            <option value="orders_count">По сумме всех личных заказов</option>
                                                                            <option value="current_orders_count">По сумме личных заказов за текущий отчетный период</option>
                                                                            <option value="last_order_date">По дате последнего личного заказа</option>
                                                                        </select>
                            
                                                                        <button type="button" class="input__button input__button--select button button--iconed button--covered button--square button--dark" @click="buyersSortAsc = !buyersSortAsc">
                                                                            <span class="button__icon button__icon--medium">
                                                                                <svg class="icon icon--sort">
                                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-sort"></use>
                                                                                </svg>
                                                                            </span>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                        <div class="accordeon accordeon--separated">
                                            <div class="participant">
                                                <div class="participant__head">
                                                    <div class="participant__head-item participant__head-item--name">ФИО</div>
                                                    <div class="participant__head-item participant__head-item--id">ID</div>
                                                    <div class="participant__head-item participant__head-item--pet">Питомец</div>
                                                    <div class="participant__head-item participant__head-item--date">На сайте с</div>
                                                    <div class="participant__head-item participant__head-item--tel">Телефон</div>
                                                    <div class="participant__head-item participant__head-item--email">Email</div>
                                                </div>

                                                <LoyaltyReport
                                                    v-for="member in buyersMembers"
                                                    :key="member.user_info.id"
                                                    :ref="'buyer-' + member.user_info.id"
                                                    :user="member.user_info"
                                                    :orders-report="member.orders_report"
                                                    :current-accounting-period="currentAccountingPeriod"
                                                    :accounting-periods="member.accounting_periods"
                                                    :loyalty-status="member.loyalty_status"
                                                    :accordion="true"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--/Покупатели-->
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    `
};
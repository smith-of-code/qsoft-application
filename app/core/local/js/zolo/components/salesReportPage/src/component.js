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
                if (this.consultantsSortAsc) {
                    return a.user_info[this.consultantsSort] > b.user_info[this.consultantsSort];
                } else {
                    return a.user_info[this.consultantsSort] < b.user_info[this.consultantsSort];
                }
            });
        },
        buyersMembers() {
            return this.mutableBuyers.filter((buyer) => {
                return this.buyersLoyaltyLevelFilter.length
                    ? this.buyersLoyaltyLevelFilter.includes(buyer.user_info.loyalty_level)
                    : true;
            }).sort((a, b) => {
                if (this.buyersSortAsc) {
                    return a.user_info[this.buyersSort] > b.user_info[this.buyersSort];
                } else {
                    return a.user_info[this.buyersSort] < b.user_info[this.buyersSort];
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
        },
        async changeBuyerAccountingPeriod() {
            const period = $('select[name=buyer_accounting_periods]').val().split('-');
            const response = await this.loyaltySalesReportStore.getTeamMembersDataByPeriod(
                this.mutableBuyers.map((user) => user.user_info.id),
                period[0],
                period[1],
            );
            this.mutableBuyers = response.data;
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
                
                <section class="accounting__section section">
                    <div class="section__box box">
                        <div class="section__header">
                            <h4 class="section__title">
                                Участники группы
                            </h4>
                        </div>

                        <div class="tabs tabs--covered tabs--small tabs--circle tabs--red" data-tabs>
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
                                                                            <option value="name_initials">ФИО</option>
                                                                            <option selected value="id">ID</option>
                                                                            <option value="loyalty_level">Уровень</option>
                                                                            <option value="date_register">На сайте с</option>
                                                                            <option value="phone">Телефон</option>
                                                                            <option value="email">Email</option>
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
                                                    :user="member.user_info"
                                                    :orders-report="member.orders_report"
                                                    :current-accounting-period="currentAccountingPeriod"
                                                    :accounting-periods="member.accounting_periods"
                                                    :loyalty-status="member.loyalty_status"
                                                    :bonuses-income="member.bonuses_income"
                                                    :accordion="true"
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
                                                                            <option value="name_initials">ФИО</option>
                                                                            <option selected value="id">ID</option>
                                                                            <option value="date_register">На сайте с</option>
                                                                            <option value="phone">Телефон</option>
                                                                            <option value="email">Email</option>
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
                                                    :user="member.user_info"
                                                    :orders-report="member.orders_report"
                                                    :current-accounting-period="currentAccountingPeriod"
                                                    :accounting-periods="member.accounting_periods"
                                                    :loyalty-status="member.loyalty_status"
                                                    :bonuses-income="member.bonuses_income"
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
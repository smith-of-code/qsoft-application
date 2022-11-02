import { useLoyaltySalesReportStore } from '../../../stores/loyaltySalesReportStore';
import { LoyaltyReport } from "../../loyaltyReport/src/component";
import toggle from "../../../../../../../../assets/js/modules/toggle";

export const SalesReportPage = {
    components: { LoyaltyReport },

    data() {
        return {
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
            });
        },
        buyersMembers() {
            return this.mutableConsultants.filter((buyer) => {
                return this.buyersLoyaltyLevelFilter.length
                    ? this.buyersLoyaltyLevelFilter.includes(buyer.user_info.loyalty_level)
                    : true;
            });
        },
    },

    created() {
        this.mutableConsultants = this.team.consultants;
        this.mutableBuyers = this.team.buyers;
    },

    mounted() {
        window.initSelect();
        toggle();

        $('select[name=consultant_loyalty_levels]').on('change', () => {
            this.consultantsLoyaltyLevelFilter = $('select[name=consultant_loyalty_levels]').val();
        });
        $('select[name=buyer_loyalty_levels]').on('change', () => {
            this.buyersLoyaltyLevelFilter = $('select[name=buyer_loyalty_levels]').val();
        });

        $('select[name=consultant_accounting_periods]').on('change', () => this.changeConsultantAccountingPeriod());
        $('select[name=buyer_accounting_periods]').on('change', () => this.changeBuyerAccountingPeriod());
    },

    methods: {
        async changeConsultantAccountingPeriod() {
            const period = $('select[name=consultant_accounting_periods]').val().split('-');
            const response = await this.loyaltySalesReportStore.getTeamMembersDataByPeriod('consultant', period[0], period[1]);
            this.mutableConsultants = response.data;
        },
        async changeBuyerAccountingPeriod() {
            const period = $('select[name=buyer_accounting_periods]').val().split('-');
            const response = await this.loyaltySalesReportStore.getTeamMembersDataByPeriod('buyer', period[0], period[1]);
            this.mutableBuyers = response.data.loyalty_status;
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

                        <div class="tabs tabs--covered tabs--white tabs--small tabs--circle tabs--red" data-tabs>
                            <nav class="accounting__tabs-items tabs__items">
                                <ul class="tabs__list">
                                    <li class="tabs__item tabs__item--active" data-tab="block1">
                                        Консультанты
                                        <span>({{ mutableConsultants.length }})</span>
                                    </li>

                                    <li class="tabs__item" data-tab="block2">
                                        Покупатели
                                        <span>(28)</span>
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
                                                                        <div class="select__group">
                                                                            <select class="select__control" name="select1" id="sort1" data-select-control data-placeholder="Сортировать по">
                                                                                <option><!-- пустой option для placeholder --></option>
                                                                                <option value="1">По дате создания</option>
                                                                                <option value="2">По сумме заказа</option>
                                                                            </select>
                                
                                                                            <button type="button" class="input__button input__button--select button button--iconed button--covered button--square button--dark">
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
                                                                        <select class="select__control" name="select2" data-select-control data-placeholder="Выбрать период">
                                                                            <option><!-- пустой option для placeholder --></option>
                                                                            <option value="1">Оплачен</option>
                                                                            <option value="2">Не оплачен</option>
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
                                                                        <div class="select__group">
                                                                            <select class="select__control" name="select2" id="sort2" data-select-control data-placeholder="Сортировать по">
                                                                                <option><!-- пустой option для placeholder --></option>
                                                                                <option value="1">По дате создания</option>
                                                                                <option value="2">По сумме заказа</option>
                                                                            </select>
                                
                                                                            <button type="button" class="input__button input__button--select button button--iconed button--covered button--square button--dark">
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

                                                <!--Карточка участника-->
                                                <div class="participant__item accordeon__item" data-accordeon>
                                                    <div class="participant__header accordeon__header box box--rounded-sm">
                                                        <div class="participant__row">
                                                            <div class="participant__col participant__col--avatar">
                                                                <div class="participant__avatar avatar">
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

                                                            <div class="participant__col participant__col--pets">
                                                                <div class="participant__info">
                                                                    <span class="participant__info-name">Питомец</span>
                                                                    <div class="participant__info-pets">
                                                                        <div class="participant__info-pet participant__info-pet--cat">
                                                                            <svg class="icon icon--cat">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-cat-seating"></use>
                                                                            </svg>
                                                                        </div>
                                                                        <div class="participant__info-pet participant__info-pet--dog">
                                                                            <svg class="icon icon--dog">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-dog-seating"></use>
                                                                            </svg>
                                                                        </div>
                                                                    </div>
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

                                                        <div class="participant__row participant__row--toggle" data-accordeon-toggle>
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

                                                    <div class="accordeon__body" data-accordeon-content>
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
                                                <!--/Карточка участника-->
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
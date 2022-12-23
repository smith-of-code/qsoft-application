import NumberFormatMixin from "../../../mixins/NumberFormatMixin";

export const OrdersReport = {
    mixins: [NumberFormatMixin],

    data() {
        return {
            label: this.isGroup ? 'групповых' : 'личных',
            label2: this.isGroup ? 'группового' : 'личного',
        };
    },

    props: {
        ordersReport: {
            type: Object,
            required: true,
        },
        isGroup: {
            type: Boolean,
            default: false,
        },
    },

    methods: {
        showPriceWhole(item) {
            const number = parseFloat(item);
            const numberFloor = Math.floor(number);
            return numberFloor.toLocaleString('ru-RU', {minimumFractionDigits: 0});
        },
  
        showPriceRemains(item) {
            const number = parseFloat(item);
            const numberFixed = number.toFixed(2);
            const totalRemains = numberFixed.toString().split('.')[1];
           
            if (totalRemains === "00") {
                return 
            } else {
                return ',' + totalRemains
            }
        }
      },
      
    template: `
        <div class="participant__block">
            <!--Результаты-->
            <div class="results">
                <ul class="results__list">
                    <li class="results__item">
                        <!--Результат-->
                        <div class="result">
                            <div class="result__main">
                                <p class="result__title">Сумма всех {{ label }} заказов</p>
                                <p class="result__total">{{ formatNumber(ordersReport.total_sum) }} ₽</p>
                            </div>
                        </div>
                        <!--/Результат-->
                    </li>

                    <li class="results__item">
                        <div class="result">
                            <div class="result__main">
                                <p class="result__title">Сумма {{ label }} заказов за текущий отчетный период</p>
                                <p class="result__total">{{ formatNumber(ordersReport.current_period_sum) }} ₽</p>
                            </div>
                        </div>
                    </li>

                    <li class="results__item">
                        <div class="result">
                            <div class="result__main">
                                <p class="result__title">Сумма {{ label }} баллов за текущий период</p>
                                <p class="result__total">{{ formatNumber(ordersReport.current_period_bonuses, false) }} ББ</p>
                            </div>
                        </div>
                    </li>

                    <li class="results__item">
                        <div class="result">
                            <div class="result__main">
                                <p class="result__title">Количество {{ label }} заказов со статусом «Оплачен»</p>
                                <p class="result__total">{{ formatNumber(ordersReport.paid_orders_count, false) }}</p>
                            </div>
                        </div>
                    </li>

                    <li class="results__item">
                        <div class="result">
                            <div class="result__main">
                                <p class="result__title">Количество {{ label }} заказов со статусом «Возврат»</p>
                                <p class="result__total">
                                    {{ formatNumber(ordersReport.part_refunded_orders_count + ordersReport.full_refunded_orders_count, false) }}
                                </p>
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
                                                <p class="result__return-total">
                                                    {{ formatNumber(ordersReport.full_refunded_orders_count, false) }}
                                                </p>
                                            </div>
                                            <div class="result__return-item">
                                                <p class="result__return-name">Количество частичных возвратов</p>
                                                <p class="result__return-total">
                                                    {{ formatNumber(ordersReport.part_refunded_orders_count, false) }}
                                                </p>
                                            </div>
                                        </div>
                                        <!--/Возвраты-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li v-if="ordersReport.last_order_date" class="results__item">
                        <div class="result">
                            <div class="result__main">
                                <p class="result__title">Дата {{ label2 }} последнего заказа</p>
                                <p class="result__total">{{ ordersReport.last_order_date }}</p>
                            </div>
                        </div>
                    </li>

                    <li v-if="ordersReport.last_month_products.length" class="results__item">
                        <div class="result">
                            <div class="result__main">
                                <p class="result__title">Количество товаров со всех {{ label }} заказов за последний месяц</p>
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
                                                                <img :src="product.picture" alt="#" class="product-line__image-picture">
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
                                                                            <span class="product-line__params-value--whole">
                                                                                {{ showPriceWhole(product.price) }}
                                                                            </span>
                                                                            <span class="product-line__params-value--remains">
                                                                                {{ showPriceRemains(product.price) }} ₽
                                                                            </span>
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
                                                                            <span class="product-line__params-value--whole">
                                                                                {{ showPriceWhole(product.price * product.quantity) }}
                                                                            </span>
                                                                            <span class="product-line__params-value--remains">
                                                                                {{ showPriceRemains(product.price * product.quantity) }} ₽
                                                                            </span>
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
    `
};
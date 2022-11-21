import {mapState} from "ui.vue3.pinia";
import {detailOfferStore} from "../../../stores/detailOfferStore";
import {useBasketStore} from "../../../stores/basketStore";
import NumberFormatMixin from "../../../mixins/NumberFormatMixin";

export const OfferPrice = {
    mixins: [NumberFormatMixin],

    props: {
        isAuthorized: {
            type: Boolean,
            required: true,
        },
        isConsultant: {
            type: Boolean,
            required: true,
        },
    },

    data() {
        return {}
    },

    computed: {
        ...mapState(detailOfferStore, ['price', 'bonuses', 'currentOfferId', 'catalogQuantity']),
        basketItem() {
            return this.basketStore.getItem(this.offerStore.currentOfferId) ?? {};
        },
    },

    setup() {
        return {
            offerStore: detailOfferStore(),
            basketStore: useBasketStore(),
        };
    },

    methods: {
        increaseItem() {
            this.basketStore.increaseItem(this.currentOfferId, this.bonuses);
        },
        decreaseItem() {
            this.basketStore.decreaseItem(this.currentOfferId);
        },
    },

    template: `
        <div class="cart__price price" data-quantity>
            <template v-if="this.isConsultant">
              <p v-if="price.BASE_PRICE" class="price__main">{{ formatNumber(price.BASE_PRICE) }} ₽</p>
              <div class="price__calculation">
                <p class="price__calculation-total">{{ formatNumber(price.PRICE) }} ₽</p>
                <p class="price__calculation-accumulation">{{ formatNumber(bonuses) }} ББ</p>
              </div>
            </template>
            <template v-else>
              <div class="price__calculation" >
                <p class="price__calculation-total">
                  {{ formatNumber(price.PRICE) }} ₽
                </p>
              </div>
            </template>
        </div>
        <div class="cart__quantity quantity" :class="{ 'quantity--active': basketItem.QUANTITY }">
            <div v-if="!basketItem.QUANTITY" class="quantity__button">
              <button type="button" class="button button--full button--medium button--rounded button--covered button--white-green" @click="increaseItem">
                <span class="button__icon">
                    <svg class="icon icon--basket">
                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-basket"></use>
                    </svg>
                </span>
                <span class="button__text">В корзину</span>
              </button>
            </div>
    
            <div v-else class="quantity__actions">
              <div class="quantity__decrease">
                <button type="button" class="button button--iconed button--covered button--square button--small button--gray-red" @click="decreaseItem">
                    <span class="button__icon button__icon--small">
                        <svg class="icon icon--minus">
                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-minus"></use>
                        </svg>
                    </span>
                </button>
              </div>
    
              <div class="quantity__total">
                    <span class="quantity__total-icon">
                        <svg class="icon icon--basket">
                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-basket"></use>
                        </svg>
                    </span>
                <span class="quantity__total-sum" :data-quantity-max="catalogQuantity" :data-quantity-sum="formatNumber(basketItem.QUANTITY)">{{ formatNumber(basketItem.QUANTITY) }}</span>
              </div>
    
              <div class="quantity__increase">
                <button type="button" class="button button--iconed button--covered button--square button--small button--gray-green" @click="increaseItem">
                    <span class="button__icon button__icon--small">
                        <svg class="icon icon--plus">
                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-plus"></use>
                        </svg>
                    </span>
                </button>
              </div>
            </div>
        </div>
    `
};
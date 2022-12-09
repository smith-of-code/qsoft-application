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
        ...mapState(detailOfferStore, ['price', 'bonuses', 'currentOfferId', 'catalogQuantity', 'isNonreturnable']),
        ...mapState(useBasketStore, ['items']),
    },

    setup() {
        return {
            offerStore: detailOfferStore(),
            basketStore: useBasketStore(),
        };
    },

    methods: {
        increaseItem() {
            this.basketStore.increaseItem(this.currentOfferId, window.location.pathname, this.isNonreturnable);
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
            <template v-else-if="isAuthorized && price.BASE_PRICE">
                <div class="price__calculation" >
                    <p class="price__calculation-total price__calculation-total--red">{{ formatNumber(price.PRICE) }} ₽</p>
                    <p class="price__main">{{ formatNumber(price.BASE_PRICE) }} ₽</p>
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
        <div class="cart__quantity quantity" :class="{ 'quantity--active': items[currentOfferId]?.QUANTITY }">
            <div v-if="!items[currentOfferId]?.QUANTITY" class="quantity__button">
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
                <button type="button" class="button button--iconed button--covered button--square button--small button--gray-red button--counter" @click="decreaseItem">
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
                <span class="quantity__total-sum">{{ formatNumber(items[currentOfferId]?.QUANTITY) }}</span>
              </div>
    
              <div class="quantity__increase">
                <button type="button" class="button button--iconed button--covered button--square button--small button--gray-green button--counter" @click="increaseItem" :disabled="parseInt(items[currentOfferId]?.QUANTITY) >= Math.min(catalogQuantity, 99)" :class="{ 'button--disabled': parseInt(items[currentOfferId]?.QUANTITY) >= Math.min(catalogQuantity, 99) }">
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
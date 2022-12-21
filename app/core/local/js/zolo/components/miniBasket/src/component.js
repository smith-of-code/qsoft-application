import {useBasketStore} from "../../../stores/basketStore";
import {computed} from "ui.vue3";
import NumberFormatMixin from "../../../mixins/NumberFormatMixin";

export const MiniBasket = {
    mixins: [NumberFormatMixin],

    data() {
        return {}
    },

    setup() {
        const store = useBasketStore();
        store.fetchBasketTotals();
        return {
            itemsCount: computed(() => store.itemsCount),
            basketPrice: computed(() => store.basketPrice)
        }
    },

    methods: {
      showPriceWhole(item) {
          const number = parseFloat(item);
          return Math.floor(number);
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
      <button type="button" class="button button--simple button--red button--vertical">
      <span class="button__icon button__icon--mixed">
        <svg class="icon icon--basket">
          <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-basket"></use>
        </svg>
        <span v-if="itemsCount" class="button__icon-counter button__icon-counter--dark">{{ itemsCount }}</span>
        </span>
      <span v-if="itemsCount" class="personal__button-text button__text">
        <span class="personal__price-whole">
            {{ showPriceWhole(basketPrice) }}
        </span>
        <span class="personal__price-remains">
            {{ showPriceRemains(basketPrice) }}&#8381
        </span>
      </span>
      <span v-else class="personal__button-text button__text">Корзина</span>
      </button>
    `
};
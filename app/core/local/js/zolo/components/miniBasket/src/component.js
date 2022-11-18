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
    
    template: `
      <button type="button" class="button button--simple button--red button--vertical">
      <span class="button__icon button__icon--mixed">
        <svg class="icon icon--basket">
          <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-basket"></use>
        </svg>
        <span class="button__icon-counter button__icon-counter--dark">{{ itemsCount }}</span>
        </span>
      <span class="personal__button-text button__text">{{ formatNumber(basketPrice) }} &#8381;</span>
      </button>
    `
};
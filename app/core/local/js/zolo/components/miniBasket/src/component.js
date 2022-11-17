import {useBasketStore} from "../../../stores/basketStore";
import {computed} from "ui.vue3";

export const MiniBasket = {
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
    
    // language=Vue
    template: `
      <button type="button" class="button button--simple button--red button--vertical">
      <span class="button__icon button__icon--mixed">
        <svg class="icon icon--basket">
          <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-basket"></use>
        </svg>
        <span class="button__icon-counter button__icon-counter--dark">{{ itemsCount }}</span>
        </span>
      <span class="personal__button-text button__text">{{ basketPrice }}</span>
      </button>
    `
};
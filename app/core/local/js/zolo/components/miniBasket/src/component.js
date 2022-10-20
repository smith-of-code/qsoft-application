import {useBasketStore, getItemsCount} from "../../../loader/src/store";

export const MiniBasket = {
    data() {
        return {
            totalItemsCount: 0,
            totalPrice: 0,
            store: useBasketStore()
        }
    },
    // created() {
    //     setInterval(() => this.counter++, 1000);
    // },

    setup() {},
    // language=Vue
    template: `
      <button type="button" class="button button--simple button--red button--vertical">
      <span class="button__icon button__icon--mixed">
                        <svg class="icon icon--basket">
                          <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-basket"></use>
                        </svg>
                        <span class="button__icon-counter button__icon-counter--dark">{{ getItemsCount() }}</span>
        </span>
      <span class="personal__button-text button__text">{{ totalPrice }}</span>
      </button>
    `
};
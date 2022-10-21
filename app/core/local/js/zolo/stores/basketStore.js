import {defineStore} from 'ui.vue3.pinia';

export const useBasketStore = defineStore('basket', {
    state: () => ({
        items: [],
        itemsCount: undefined,
        basketPrice: undefined,
        loading: false
    }),
    getters: {
        getItemsCount: (state) => {
            return state.items.length;
        },
    },
    actions: {
        addItem(payload) {
            items.push(payload);
        },
        async fetchBasketTotals() {
            this.loading = true;

            try {
                const response = await BX.ajax.runComponentAction('zolo:sale.basket.basket.line', 'getBasketTotals', {})
                    .then((response) => response.data);

                this.itemsCount = response.itemsCount;
                this.basketPrice = response.basketPrice;
            } finally {
                this.loading = false;
            }
        },
    },
})
import {defineStore} from 'ui.vue3.pinia';

export const useBasketStore = defineStore('main', {
    state: () => ({
        items: [],
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
        async fetchBasket() {
            this.posts = [];
            this.loading = true;

            try {
                this.posts = await BX.ajax.runComponentAction('zolo:sale.basket.basket.line', 'getBasketTotals', {})
                    .then((response) => response.json());
            } finally {
                this.loading = false;
            }
        },
    },
})
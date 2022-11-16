import {defineStore} from 'ui.vue3.pinia';

export const useBasketStore = defineStore('basket', {
    state: () => ({
        items: {},
        itemsCount: undefined,
        basketPrice: undefined,
        loading: false,
    }),
    actions: {
        getItem(id) {
            return this.items[id];
        },
        async fetchBasketTotals() {
            this.loading = true;
            try {
                const response = await BX.ajax.runComponentAction('zolo:sale.basket.basket.line', 'getBasketTotals', {})
                    .then((response) => response.data);

                this.items = response.items;
                this.itemsCount = Object.values(response.items).length;
                this.basketPrice = response.basketPrice;
            } finally {
                this.loading = false;
            }
        },
        async increaseItem(offerId, bonuses = 0) {
            this.loading = true;
            try {
                const response = await BX.ajax.runComponentAction('zolo:sale.basket.basket.line', 'increaseItem', {
                    data: { offerId, bonuses }
                }).then((response) => response.data);

                this.items = response.items;
                this.itemsCount = Object.values(response.items).length;
                this.basketPrice = response.basketPrice;
            } finally {
                this.loading = false;
            }
        },
        async decreaseItem(offerId, quantity = 1) {
            this.loading = true;
            try {
                const response = await BX.ajax.runComponentAction('zolo:sale.basket.basket.line', 'decreaseItem', {
                    data: { offerId, quantity }
                }).then((response) => response.data);

                this.items = response.items;
                this.itemsCount = Object.values(response.items).length;
                this.basketPrice = response.basketPrice;
            } finally {
                this.loading = false;
            }
        },
    },
})
import {defineStore} from 'ui.vue3.pinia';

export const useBasketStore = defineStore('basket', {
    state: () => ({
        fetched: false,
        items: {},
        itemsCount: undefined,
        basketPrice: undefined,
        loading: false,
        missing: {},
        isBasketOldEmpty: true
    }),
    actions: {
        async getItem(id) {
            if (!this.fetched) {
                await this.fetchBasketTotals();
                this.fetched = true;
            }
            return this.items[id];
        },
        async fetchBasketTotals() {
            if (!this.fetched) {
                this.loading = true;
                try {
                    const response = await BX.ajax.runComponentAction('zolo:sale.basket.basket.line', 'getBasketTotals', {
                        data: { withPersonalPromotions: window.location.pathname === '/cart/' },
                    }).then((response) => response.data);

                    this.items = response.items;
                    this.itemsCount = Object.values(response.items).length;
                    this.basketPrice = response.basketPrice;
                } finally {
                    this.loading = false;
                }
                this.fetched = true;
            }
        },
        async increaseItem(offerId, detailPage = '', nonreturnable = false) {
            this.loading = true;
            try {
                const response = await BX.ajax.runComponentAction('zolo:sale.basket.basket.line', 'increaseItem', {
                    data: {
                        offerId,
                        detailPage,
                        nonreturnable,
                        withPersonalPromotions: window.location.pathname === '/cart/',
                    }
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
                    data: { offerId, quantity, withPersonalPromotions: window.location.pathname === '/cart/' }
                }).then((response) => response.data);

                this.items = response.items;
                this.itemsCount = Object.values(response.items).length;
                this.basketPrice = response.basketPrice;
            } finally {
                this.loading = false;
            }
        },
        async repeatOrder() {
            this.loading = true;
            try {
                const response = await BX.ajax.runComponentAction('zolo:sale.basket.basket.line', 'repeatOrder', {
                    data: { orderId }
                }).then((response) => response.data);
                this.items = response.items;
                this.itemsCount = Object.values(response.items).length;
                this.basketPrice = response.basketPrice;
                this.missing = response.missing;
                this.isBasketOldEmpty = response.isBasketOldEmpty;
            } finally {
                this.loading = false;
            }
            return {
                'items': this.items,
                'itemsCount': this.itemsCount,
                'basketPrice': this.basketPrice,
                'missing': this.missing,
                'isBasketOldEmpty': this.isBasketOldEmpty
            };
        },
    },
})
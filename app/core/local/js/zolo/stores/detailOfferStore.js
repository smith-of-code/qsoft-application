import {defineStore} from 'ui.vue3.pinia';

export const detailOfferStore = defineStore('detailOffer', {
    state: () => ({
        offers: [],
        currentOfferId: undefined,
    }),
    getters: {
        article() {
            return this.offers.ARTICLES[this.currentOfferId];
        },
        images() {
            return this.offers.PHOTOS[this.currentOfferId];
        },
        packagings() {
            return this.offers.PACKAGINGS;
        },
        colors() {
            return this.offers.COLORS;
        },
        price() {
            return this.offers.PRICES[this.currentOfferId]
        }
    },
    actions: {
        load(name, data) {
            this[name] = data;
        },
        checkAvailable(id) {
            return !!this.offers.AVAILABLE[id];
        },
        setStore(data) {
            this.offers = data;
        },
        setOffer(id) {
            this.currentOfferId = id;
        },
    },
})
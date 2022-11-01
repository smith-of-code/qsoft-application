import {defineStore} from 'ui.vue3.pinia';

export const detailOfferStore = defineStore('detailOffer', {
    state: () => ({
        offers: [],
        currentOfferId: undefined,
    }),
    getters: {
        currentOffer() {
            return this.offers.OFFERS[this.currentOfferId];
        },
        article() {
            return this.offers.ARTICLES[this.currentOfferId];
        },
        images() {
            return this.offers.PHOTOS[this.currentOfferId];
        },
    },
    actions: {
        getOffers() {
            return this.offers;
        },
        checkAvailable(id) {
            return this.offers.AVAILABLE[id];
        },
        setStore(data) {
            console.log('SetSTore', data);
            this.offers = data;
        },
        setOffer(id) {
            console.log('SetOffer', id);
            this.currentOfferId = id;
        },
},
})
import { defineStore } from 'ui.vue3.pinia';

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
        currentColor() {
            return this.offers.COLORS[this.currentOfferId];
        },
        currentSize() {
            return this.offers.SIZES[this.currentOfferId];
        },
        color2Size() {
            return this.offers.COLOR2SIZE;
        },
        size2Color() {
            return this.offers.SIZE2COLOR;
        },
        price() {
            return this.offers.PRICES[this.currentOfferId];
        },
        bonuses() {
            return this.offers.BONUSES_PRICES[this.currentOfferId];
        },
        catalogQuantity() {
            return this.offers.OFFERS[this.currentOfferId].CATALOG_QUANTITY;
        },
        isNonreturnable() {
            return this.offers.NONRETURNABLE;
        },
        inWishlist() {
            return this.offers.OFFERS[this.currentOfferId].IN_WISHLIST;
        },
    },
    actions: {
        getIdByColor(color){
            // size preselected
            let size = this.offers.SIZES[this.currentOfferId];
            return this.offers.SIZE2COLOR[size][color];
        },
        getIdBySize(size){
            // color preselected
            let color = this.offers.COLORS[this.currentOfferId];
            return this.offers.COLOR2SIZE[color][size];
        },
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
        toggleInWishlist() {
            this.offers.OFFERS[this.currentOfferId].IN_WISHLIST = !this.offers.OFFERS[this.currentOfferId].IN_WISHLIST;
        },
    },
})
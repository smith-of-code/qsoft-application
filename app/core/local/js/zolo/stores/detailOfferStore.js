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
            console.log('this.offers.COLORS', this.offers.COLORS);
            return this.offers.COLORS;
        },
        color2Size() {
            console.log(this.offers.COLOR2SIZE);
            return this.offers.COLOR2SIZE;
        },
        currentColorSizes() {

        },

        size2Color() {
            console.log('size2Color REF', this.offers.SIZE2COLOR);
            return this.offers.SIZE2COLOR;
        },
        price() {
            return this.offers.PRICES[this.currentOfferId]
        }
    },
    actions: {
        getIdByColor(color){
            // size preselected
            let size = this.offers.SIZES_OLD[this.currentOfferId];

            console.log('!!!!', size, this.offers.SIZE2COLOR[size][color]);
            return this.offers.SIZE2COLOR[size][color];
        },
        getIdBySize(size){
            // color preselected
            let color = this.offers.COLORS_TYPES[this.currentOfferId];
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
    },
})
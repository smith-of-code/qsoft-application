import {mapState} from "ui.vue3.pinia";
import {detailOfferStore} from "../../../stores/detailOfferStore";

export const OfferArticle = {
    data() {
        return {};
    },
    computed: {
        ...mapState(detailOfferStore, ['offers', 'currentOfferId', 'article']),
    },
    setup() {
        return { store: detailOfferStore() };
    },

    template: `
        <p class="specification__article">Арт. {{ article }}</p>
    `
};
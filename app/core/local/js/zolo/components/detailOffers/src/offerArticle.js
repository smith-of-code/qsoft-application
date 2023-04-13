import {mapState} from "ui.vue3.pinia";
import {detailOfferStore} from "../../../stores/detailOfferStore";

export const OfferArticle = {
    props: {
        isMobile: {
            type: Boolean,
            default: false
        },
    },
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
        <p class="specification__article" :class="[isMobile ? 'specification__article--mobile': 'specification__article--hidden']">
            Арт. {{ article }}
        </p>
    `
};
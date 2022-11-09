import {mapState} from "ui.vue3.pinia";
import {detailOfferStore} from "../../../stores/detailOfferStore";

export const OfferPrice = {
    data() {
        return {}
    },
    computed: {
        ...mapState(detailOfferStore, ['offers', 'currentOfferId', 'price']),
    },
    setup() {
        const store = detailOfferStore();
        return {
            store
        }
    },

    // language=Vue
    template: `
        <template v-if="this.isAuthorized">
            <p class="price__main">{{ price }} ₽</p>
            <div class="price__calculation">
                <p class="price__calculation-total">? ₽</p>
                <p class="price__calculation-accumulation">? ББ</p>
            </div>
        </template>
        <template v-else>
            <div class="price__calculation" >
                <p class="price__calculation-total price__calculation-total--red">? ₽</p>
                <p class="price__main">{{ price }}</p>
            </div>  
        </template>
    `
};
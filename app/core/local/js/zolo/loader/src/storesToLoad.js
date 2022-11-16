import {detailOfferStore} from "../../stores/detailOfferStore";
import {useBasketStore} from "../../stores/basketStore";
import {useWishlistStore} from "../../stores/wishlistStore";

export default {
    '#detailofferStore': {
        name: 'detailOfferStore',
        instance: detailOfferStore,
    },
    '#basketStore': {
        name: 'basketStore',
        instance: useBasketStore,
    },
    '#wishlistStore': {
        name: 'wishlistStore',
        instance: useWishlistStore,
    },
}
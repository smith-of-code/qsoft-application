import {defineStore} from 'ui.vue3.pinia';

export const useWishlistStore = defineStore('wishlist', {
    actions: {
        async add(productId) { // (offerId)
            return await BX.ajax.runComponentAction('zolo:wishlist', 'add', {
                mode: 'class',
                data: { productId },
            });
        },
        async remove(productId) { // (offerId)
            return await BX.ajax.runComponentAction('zolo:wishlist', 'remove', {
                mode: 'class',
                data: { productId },
            });
        },
        async getByProductId(productId) { // NOT BY OFFER
            return await BX.ajax.runComponentAction('zolo:wishlist', 'getByProductId', {
                mode: 'class',
                data: { productId },
            });
        },
    },
})
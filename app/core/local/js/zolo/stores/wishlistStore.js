import {defineStore} from 'ui.vue3.pinia';

export const useWishlistStore = defineStore('wishlist', {
    actions: {
        async add(productId) {
            return await BX.ajax.runComponentAction('zolo:wishlist', 'add', {
                mode: 'class',
                data: { productId },
            });
        },
        async remove(productId) {
            return await BX.ajax.runComponentAction('zolo:wishlist', 'remove', {
                mode: 'class',
                data: { productId },
            });
        },
    },
})
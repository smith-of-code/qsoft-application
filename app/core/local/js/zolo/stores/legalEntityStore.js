import { defineStore } from 'ui.vue3.pinia';

export const useLegalEntityStore = defineStore('legalEntity', {
    actions: {
        async saveLegalEntityData(data) {
            return await BX.ajax.runComponentAction('zolo:main.profile', 'saveLegalEntityData', {
                mode: 'class',
                data: { data },
            });
        },
    },
})
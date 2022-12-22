import { defineStore } from 'ui.vue3.pinia';

export const usePersonalDataStore = defineStore('personalData', {
    actions: {
        async savePersonalData(data) {
            return await BX.ajax.runComponentAction('zolo:main.profile', 'savePersonalData', {
                mode: 'class',
                data: { userInfo: data },
            });
        },
        async sendCode(value, type) {
            return await BX.ajax.runComponentAction('zolo:main.profile', 'sendCode', {
                mode: 'class',
                data: { value, type },
            });
        },
        async verifyCode(code, type) {
            return await BX.ajax.runComponentAction('zolo:main.profile', 'verifyCode', {
                mode: 'class',
                data: { code, type },
            });
        },
    },
})
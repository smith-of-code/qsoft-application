import { defineStore } from 'ui.vue3.pinia';

export const usePetStore = defineStore('pet', {
    actions: {
        async deletePet(petId) {
            return await BX.ajax.runComponentAction('zolo:main.profile', 'deletePet', {
                mode: 'class',
                data: { petId },
            });
        },
        async addPet(pet) {
            return await BX.ajax.runComponentAction('zolo:main.profile', 'addPet', {
                mode: 'class',
                data: { pet },
            });
        },
        async changePet(pet) {
            return await BX.ajax.runComponentAction('zolo:main.profile', 'changePet', {
                mode: 'class',
                data: { pet },
            });
        },
    },
})
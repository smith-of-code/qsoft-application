import {defineStore} from 'ui.vue3.pinia';

export const useDropzoneStore = defineStore('dropzone', {
    actions: {
        async uploadFile(files) {
            return await BX.ajax.runComponentAction('zolo:dropzone', 'upload', {
                mode: 'class',
                data: files,
            });
        },
        async deleteFile(id) {
            return await BX.ajax.runComponentAction('zolo:dropzone', 'delete', {
                mode: 'class',
                data: { id },
            });
        },
    },
})
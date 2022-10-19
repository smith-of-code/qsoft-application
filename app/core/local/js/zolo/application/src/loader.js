import {BitrixVue} from 'ui.vue3';

export class Application {

    run(): void {
        return BitrixVue.createApp({
            name: 'zolo',
            components: {},
        });
    }
}
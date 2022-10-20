import {BitrixVue} from 'ui.vue3';
import {createPinia} from 'ui.vue3.pinia';
import applicationsToRender from './applicationsToRender';

export class Loader {
    run(): void {
        const pinia = createPinia();
        // window.store = store;

        for (const applicationRoot in applicationsToRender) {
            this.renderApplication(applicationRoot, applicationsToRender[applicationRoot], pinia);
        }
    }

    renderApplication(root: string, component: object, pinia): void {
        const rootElement = document.querySelector(root)

        // console.log('rootElement', {...rootElement});

        if (rootElement) {
            const app = BitrixVue.createApp(component);

            app.mount(rootElement);
            app.use(pinia);
        }

    }
}
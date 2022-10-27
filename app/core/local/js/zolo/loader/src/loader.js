import {BitrixVue} from 'ui.vue3';
import {createPinia} from 'ui.vue3.pinia';
import applicationsToRender from './applicationsToRender';

export class Loader {
    run(): void {
        const pinia = createPinia();

        for (const applicationRoot in applicationsToRender) {
            this.renderApplication(applicationRoot, applicationsToRender[applicationRoot], pinia);
        }
    }

    renderApplication(root, component, pinia): void {
        const rootElement = document.querySelector(root)

        if (rootElement) {
            const app = BitrixVue.createApp(component);

            app.use(pinia);
            app.mount(rootElement);
        }

    }
}
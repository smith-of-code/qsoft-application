import { BitrixVue } from 'ui.vue3';
import { createPinia } from 'ui.vue3.pinia';
import applicationsToRender from './applicationsToRender';

export class Loader {
    run() {
        const pinia = createPinia();

        for (const applicationRoot in applicationsToRender) {
            this.renderApplication(applicationRoot, applicationsToRender[applicationRoot], pinia);
        }
    }

    renderApplication(root, component, pinia) {
        const rootElement = document.querySelector(root);
        if (rootElement) {
            let props = {};
            for (const attribute of rootElement.attributes) {
                if (attribute.name.startsWith('prop-')) {
                    try {
                        props[attribute.name.substring(5)] = JSON.parse(attribute.value);
                    } catch (error) {
                        props[attribute.name.substring(5)] = attribute.value;
                    }
                }
            }
            const app = BitrixVue.createApp(component, props);
            app.use(pinia);
            app.mount(rootElement);
        }
    }
}
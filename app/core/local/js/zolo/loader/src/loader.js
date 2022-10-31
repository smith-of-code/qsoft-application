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
                    let attributeName = attribute.name
                        .substring(5)
                        .replace(/-./g, x => x[1].toUpperCase());
                    try {
                        props[attributeName] = JSON.parse(attribute.value);
                    } catch (error) {
                        props[attributeName] = attribute.value;
                    }
                }
            }
            const app = BitrixVue.createApp(component, props);
            app.use(pinia);
            app.mount(rootElement);
        }
    }
}
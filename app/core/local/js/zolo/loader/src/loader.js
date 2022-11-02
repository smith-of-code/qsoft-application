import {BitrixVue} from 'ui.vue3';
import { createPinia, setActivePinia } from 'ui.vue3.pinia';
import applicationsToRender from './applicationsToRender';
import storesToLoad from "./storesToLoad";

export class Loader {
    run(): void {
        const pinia = createPinia();

        setActivePinia(pinia);
        for (const dataRoot in storesToLoad) {
            this.loadStore(dataRoot, storesToLoad[dataRoot]);
        }

        for (const applicationRoot in applicationsToRender) {
            this.renderApplication(applicationRoot, applicationsToRender[applicationRoot], pinia);
        }
    }

    loadStore(root, store) {
        const rootElement = document.querySelector(root);
        if (rootElement) {
            let props = this.loadProperties(rootElement);

            for (const attributeName in props) {
                let data = props[attributeName];
                if (data) {
                    // Для загрузки из атрибута store должен релизовывать метод load(имя_свойства, данные)
                    // имя пропсы prop-some-name преобразуется в имя свойства someName
                    store().load(attributeName, data);
                } else {
                    console.log('Error getting data from root ' + root + ' ' + attributeName);
                }
            }
        }
    }

    // TODO загрузка свойств скопирована из 227010, вынесена в метод. Нужно убрать дубли
    loadProperties(rootElement) {
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
        return props;
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
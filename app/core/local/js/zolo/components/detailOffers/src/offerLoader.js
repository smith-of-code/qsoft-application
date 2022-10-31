import {createPinia, setActivePinia} from 'ui.vue3.pinia';
import {BitrixVue} from 'ui.vue3';
import {detailOfferStore} from "../../../stores/detailOfferStore";
import applicationsToRender from "./applicationsToRender";

export class offerLoader {

    #store;
    data = [];

    constructor(): void
    {
        this.#store = createPinia();
    }

    start(): void
    {
        detailOfferStore().setStore(this.data);
        detailOfferStore().setOffer(this.data.OFFER_FIRST);

        for (const root in applicationsToRender) {
            const rootElement = document.querySelector(root)
            if (rootElement) {
                const app = BitrixVue.createApp(applicationsToRender[root]);
                app.use(this.#store);
                app.mount(root);
            }
        }
    }

    loadData(data): void {
        console.log(data);
        this.data = data;
    }

    initStorageBeforeStartApplication(): void
    {
        setActivePinia(this.#store);
    }
}
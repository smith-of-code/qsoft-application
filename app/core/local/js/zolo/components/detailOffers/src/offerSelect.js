import { mapState } from "ui.vue3.pinia";
import { detailOfferStore } from "../../../stores/detailOfferStore";

export const SelectOffer = {
    data() {
        return {
        };
    },

    setup() {
        const store = detailOfferStore();
        return {
            store
        }
    },
    computed: {
        ...mapState(detailOfferStore, ['offers', 'currentOfferId', 'packagings', 'colors']),
    },
    methods: {
        setOffer(event) {
            if (this.store.checkAvailable(event.target.value)) {
                this.store.setOffer(event.target.value);
            }
        },
    },
    // language=Vue
    template: `
        <template v-if="packagings.length > 0">
        <div class="specification__packs packs">
            <p class="specification__category">Фасовка</p>
            <ul class="packs__list">
                <li class="packs__item" v-for="(item) in packagings">
                    <div class="pack pack--bordered">
                        <div class="radio">
                            <input type="radio" class="pack__input radio__input" name="radio_pack"
                                   @click="setOffer"
                                   v-bind:value="item.offerId" 
                                   v-bind:id="'radio' + item.offerId"
                                   v-bind:disabled="!offers.AVAILABLE[item.offerId]"
                                   v-bind:checked="currentOfferId == item.offerId"
                            >
                            <label v-bind:for="'radio' + item.offerId">
                                <div v-bind:class="'pack__item' + (offers.AVAILABLE[item.offerId] ? '': ' pack__item--disabled')">{{item.package}}</div>
                            </label>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        </template>
        <template v-else-if="colors.length > 0">
        <div class="specification__colors colors colors--big">
            <p class="specification__category">Цвет</p>
            <ul class="colors__list">
              <li class="colors__item" v-for="item in colors" >
                    <div v-bind:class="'color' + (offers.AVAILABLE[item.offerId]) ? '' : 'color--disabled'">
                        <div class="radio">
                            <input type="radio" class="color__input radio__input" name="radio_color"
                                   @click="setOffer"
                                   v-bind:value="item.offerId"
                                   v-bind:id="'radio' + item.offerId"
                                   v-bind:disabled="!offers.AVAILABLE[item.offerId]"
                                   v-bind:checked="currentOfferId == item.offerId"
                            >
                            <label v-bind:for="'radio' + item.offerId">
                                <div v-bind:class="'color__item color__item--big color__item--' + item.color"></div>
                            </label>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        </template>
    `
};
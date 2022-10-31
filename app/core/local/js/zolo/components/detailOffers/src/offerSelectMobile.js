import {mapState} from "ui.vue3.pinia";
import {detailOfferStore} from "../../../stores/detailOfferStore";
export const SelectOfferMobile = {
    data() {
        return {
        };
    },

    setup() {
        const store = detailOfferStore();
        let offers = store.getOffers();
        return {
            store, offers
        }
    },
    computed: {
        ...mapState(detailOfferStore, ['offers', 'currentOfferId']),
    },
    methods: {
        setOffer(event) {
            console.log(event);
            if (this.store.checkAvailable(event.target.value)) {
                this.store.setOffer(event.target.value);
            }
        },
    },
    // language=Vue
    template: `
        <!-- Блок селекта фассовки малый вариант-->
        <template v-if="offers.PACKAGINGS.length > 0">
            <div class="cart__packs">
                <p class="specification__category">Фасовка</p>
                <div class="select select--mini" data-select  >
                    <select class="select__control"  name="select1m" data-select-control data-placeholder="Выберите фасовку" data-option >
                        <option><!-- пустой option для placeholder --></option>
                        <option v-for="(item) in offers.PACKAGINGS"
                                v-bind:value="item.offerId"
                                v-bind:disabled="!offers.AVAILABLE[item.offerId]"
                                v-bind:data-option-after="'<span class=&quot;stock ' + (offers.AVAILABLE[item.offerId] ? 'stock--yes' : '') + '&quot;>' +  (!offers.AVAILABLE[item.offerId] ? 'нет ' : '') + 'в наличии</span>'"
                                v-on:click="setOffer"
                        >
                            <span >{{item.package}}</span>
                        </option>
                    </select>
                </div>
            </div>
        </template>
        <template v-else-if="offers.COLORS.length > 0">
            <div class="cart__colors">
                <p class="specification__category">Цвет</p>
                <div class="select select--middle select--simple" data-select>
                    <select class="select__control" name="select1p" data-select-control data-placeholder="Выберите цвет" data-option>
                        <option><!-- пустой option для placeholder --></option>
                        <option v-for="item in offers.COLORS"
                                v-on:click="setOffer"
                                v-bind:value="item.offerId"
                                v-bind:disabled="!offers.AVAILABLE[item.offerId]"
                                v-bind:data-option-before="'<span class=&quot;color color--option&quot;><span class=&quot;color__item color__item--medium color__item--' + item.color + '&quot;></span></span>'"
                                v-bind:data-option-after="'<span class=&quot;stock ' + (offers.AVAILABLE[item.offerId] ? 'stock--yes' : '') + '&quot;>' +  (!offers.AVAILABLE[item.offerId] ? 'нет ' : '') + 'в наличии</span>'">
                            {{offers.COLOR_NAMES[item.color]}}
                        </option>
                    </select>
                </div>
            </div>
        </template>
        <!-- Блок селекта фассовки малый вариант-->
    `
};
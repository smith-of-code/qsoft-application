import {mapState} from "ui.vue3.pinia";
import {detailOfferStore} from "../../../stores/detailOfferStore";
export const SelectOfferMobile = {
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
    mounted() {
        window.initSelect();
        $('select[name=select-package]').on('change',() => this.setOffer('select-package'));
        $('select[name=select-color]').on('change',() => this.setOffer('select-color'));
    },
    computed: {
        ...mapState(detailOfferStore, ['offers', 'currentOfferId', 'packagings', 'colors']),
    },
    methods: {
        setOffer(name) {
            let value = $('select[name=' + name+ ']').val();
            if (this.store.checkAvailable(value)) {
                this.store.setOffer(value);
            }
        },
    },
    // language=Vue
    template: `
        <!-- Блок селекта фассовки малый вариант-->
        <template v-if="packagings.length > 0">
            <div class="cart__packs">
                <p class="specification__category">Фасовка</p>
                <div class="select select--mini" data-select  >
                    <select class="select__control"  name="select-package" data-select-control data-placeholder="Выберите фасовку" data-option >
                        <option><!-- пустой option для placeholder --></option>
                        <option v-for="(item) in packagings"
                                v-bind:value="item.offerId"
                                v-bind:selected="currentOfferId == item.offerId"
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
        <template v-else-if="colors.length > 0">
            <div class="cart__colors">
                <p class="specification__category">Цвет</p>
                <div class="select select--middle select--simple" data-select>
                    <select class="select__control" name="select-color" data-select-control data-placeholder="Выберите цвет" data-option>
                        <option><!-- пустой option для placeholder --></option>
                        <option v-for="item in colors"
                                v-on:click="setOffer"
                                v-bind:value="item.offerId"
                                v-bind:selected="currentOfferId == item.offerId"
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
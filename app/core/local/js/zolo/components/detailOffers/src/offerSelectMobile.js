import {mapState} from "ui.vue3.pinia";
import {detailOfferStore} from "../../../stores/detailOfferStore";
export const SelectOfferMobile = {
    data() {
        return {
            isSizeRestricted: false
        };
    },

    setup() {
        const store = detailOfferStore();
        return {
            store
        }
    },
    mounted() {
        // window.initSelect();
        $('select[name=select-package]').on('change',() => this.setOffer('select-package', false));
        $('select[name=select-color]').on('change',() => this.setOffer('select-color', false));
        $('select[name=select-size-mob]').on('change',() => this.setOffer('select-size-mob', true));
    },
    updated() {
        window.initSelect();

    },
    computed: {
        ...mapState(detailOfferStore, ['allColors', 'offers', 'currentOfferId', 'packagings', 'color2Size', 'size2Color', 'currentColor', 'currentSize']),
    },
    methods: {
        setOffer(name, selectFlag) {
            this.isSizeRestricted = selectFlag;
            let value = $('select[name=' + name+ ']').val();
            if (this.store.checkAvailable(value)) {
                this.store.setOffer(value);
            }
        },
        getColorOffer(color) {
            if (this.isSizeRestricted) {
                return this.store.getIdByColor(color);
            } else {
                if (color == this.currentColor) {
                    return this.currentOfferId;
                }
                let keys = Object.keys(this.color2Size[color]);
                let first = (keys.indexOf(this.currentSize) == -1) ? keys[0] : this.currentSize;
                return this.color2Size[color][first];
            }
        }
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
                                v-bind:disabled="offers.AVAILABLE[item.offerId] !== 'true'"
                                v-bind:data-option-after="'<span class=&quot;stock ' + (offers.AVAILABLE[item.offerId] === 'true' ? 'stock--yes' : '') + '&quot;>' +  (offers.AVAILABLE[item.offerId] !== 'true' ? 'нет ' : '') + 'в наличии</span>'"
                                v-on:click="setOffer"
                        >
                            <span >{{item.package}}</span>
                        </option>
                    </select>
                </div>
            </div>
        </template>
        <template v-else-if="color2Size">
            <div class="cart__colors">
                <p class="specification__category">Цвет</p>
                <div class="select select--middle select--simple" data-select>
                    <select class="select__control" name="select-color" data-select-control data-placeholder="Выберите цвет" data-option>
                        <option><!-- пустой option для placeholder --></option>
                        <option v-for="(item, color) in color2Size"
                                v-on:click="setOffer"
                                v-bind:value="getColorOffer(color)"
                                v-bind:selected="currentOfferId == getColorOffer(color)"
                                v-bind:disabled="offers.AVAILABLE[getColorOffer(color)] !== 'true'"
                                v-bind:data-option-before="'<div class=&quot;color__item ' + color + '&quot;><div class=&quot;color__item-wrapper&quot;><img src=&quot;' + allColors[color].file_src + '&quot; class=&quot;color__item-pic&quot;></div></div>'"
                        >
                            &lt;span class=&quot;color__name&quot;&gt; {{ offers.COLOR_NAMES[color] }} &lt;/span&gt;
                            &lt;span class=&quot;stock {{ (offers.AVAILABLE[getColorOffer(color)] === 'true' ? ' stock--yes' : '') }} &quot;&gt;
                            {{ (offers.AVAILABLE[getColorOffer(color)] !== 'true' ? 'нет ' : '') }}в наличии &lt;/span&gt;
                        </option>
                    </select>
                </div>
            </div>
            <div class="cart__breed">
                <p class="specification__category">Размер</p>
                <div class="select select--middle select--simple" data-select>
                    <select class="select__control" name="select-size-mob" data-select-control data-placeholder="Выберите размер" data-option>
                        <option><!-- пустой option для placeholder --></option>
                        <option v-for="(item, size) in size2Color"
                                v-bind:value="store.getIdBySize(size)"
                                v-bind:disabled="offers.AVAILABLE[store.getIdBySize(size)] !== 'true'"
                                v-bind:selected="currentOfferId == store.getIdBySize(size)"
                        >
                            {{ offers.SIZE_NAMES[size] }} &lt;span class=&quot;stock
                            {{ (offers.AVAILABLE[store.getIdBySize(size)] === 'true' ? ' stock--yes' : '') }}&quot;&gt;
                            {{(offers.AVAILABLE[store.getIdBySize(size)] !== 'true' ? 'нет' : '')}} в наличии&lt;/span&gt;
                        </option>
                    </select>
                </div>
            </div>
        </template>
        <!-- Блок селекта фассовки малый вариант-->
    `
};
import {mapState} from "ui.vue3.pinia";
import {detailOfferStore} from "../../../stores/detailOfferStore";

export const SelectOffer = {
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
        // window.initSelect(); // TODO ?
        $('select[name=select-size]').on('change', () => this.setSelectOffer('select-size'));
    },
    updated() {
        window.initSelect();
    },
    computed: {
        ...mapState(detailOfferStore, ['allColors', 'offers', 'currentOfferId', 'packagings', 'color2Size', 'size2Color', 'currentColor', 'currentSize']),
    },
    methods: {
        setOffer(event) {
            this.isSizeRestricted = false;
            if (this.store.checkAvailable(event.target.value)) {
                this.store.setOffer(event.target.value);
            }
        },
        setSelectOffer(name) {
            this.isSizeRestricted = true;
            let value = $('select[name=' + name + ']').val();
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
        <template v-if="packagings.length > 0">
            <div class="specification__packs packs">
                <p class="specification__category">Фасовка</p>
                <ul class="packs__list">
                    <li class="packs__item" v-for="(item) in packagings">
                        <div class="pack pack--bordered" v-bind:data-tippy-content="offers.AVAILABLE[item.offerId] === true ? null : 'Нет в наличии'">
                            <div class="radio">
                                <input autocomplete="off" type="radio" class="pack__input radio__input" name="radio_pack"
                                       @click="setOffer"
                                       v-bind:value="item.offerId"
                                       v-bind:id="'radio' + item.offerId"
                                       v-bind:disabled="offers.AVAILABLE[item.offerId] !== true"
                                       v-bind:checked="currentOfferId == item.offerId"
                                >
                                <label v-bind:for="'radio' + item.offerId">
                                    <div v-bind:class="'pack__item' + (offers.AVAILABLE[item.offerId] === true ? '': ' pack__item--disabled')">
                                        {{item.package}}
                                    </div>
                                </label>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </template>
        <template v-else-if="color2Size">
            <div class="specification__colors colors colors--big">
                <p class="specification__category">Цвет</p>
                <ul class="colors__list">
                    <li class="colors__item" v-for="(item, color) in color2Size" :class="'colors__item-' + color" v-bind:data-tippy-content="offers.AVAILABLE[getColorOffer(color)] === true ? null : 'Нет в наличии'">
                        <div v-bind:class="'color ' + ((offers.AVAILABLE[getColorOffer(color)] === true) ? '' : ' color--disabled')">
                            <div class="radio">
                                <input autocomplete="off" type="radio" class="color__input radio__input" name="radio_color"
                                       @click="setOffer"
                                       v-bind:value="getColorOffer(color)"
                                       v-bind:id="'radio' + getColorOffer(color)"
                                       v-bind:disabled="offers.AVAILABLE[getColorOffer(color)] !== true"
                                       v-bind:checked="currentOfferId == getColorOffer(color)"
                                >
                                <label v-bind:for="'radio' + getColorOffer(color)">
                                  <div class="color__item">
                                    <div class="color__item-wrapper">
                                      <img :src="allColors[color].file_src" class="color__item-pic" alt="Color">
                                    </div>
                                  </div>
                                </label>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="specification__breed">
                <p class="specification__category">Размер</p>
                <div class="specification__select select select--middle" data-select>
                    <select class="select__control" name="select-size" data-select-control
                            data-placeholder="Выберите размер" data-option>
                        <option><!-- пустой option для placeholder --></option>
                        <option v-for="(item, size) in size2Color"
                                v-bind:value="store.getIdBySize(size)"
                                v-bind:disabled="offers.AVAILABLE[store.getIdBySize(size)] !== true"
                                v-bind:selected="currentOfferId == store.getIdBySize(size)"
                        >
                            {{ offers.SIZE_NAMES[size] }} &lt;span class=&quot;stock
                            {{ (offers.AVAILABLE[store.getIdBySize(size)] === true ? 'stock--yes' : '') }}&quot;&gt;
                            {{(!offers.AVAILABLE[store.getIdBySize(size)] === true ? 'нет ' : '')}} в наличии&lt;/span&gt;
                        </option>
                    </select>
                </div>
            </div>
        </template>
    `
};
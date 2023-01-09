import inputMaskInit from "../../../../../../../../../assets/js/modules/inputmask";

let id = 0;

export const DateInput = {
    data() {
        return {
            componentId: 'date-input-' + ++id,
            currentValue: null,
        };
    },

    props: {
        name: {
            type: String,
            required: true,
        },
        value: {
            type: String,
            default: null,
        },
    },

    watch: {
        currentValue(newValue) {
            this.$emit('custom-change', newValue);
        },
    },

    created() {
        this.currentValue = this.value;
    },

    mounted() {
        // inputMaskInit($(`[data-date-input-id=${this.componentId}]`), 'dateMask');
    },

    template: `
        <div class="input input--iconed" :data-date-input-id="componentId">
            <input
                inputmode="numeric"
                class="input__control"
                :name="name"
                placeholder="ДД.ММ.ГГГГ"
                data-mask-date
                :id="componentId"
                v-model="currentValue"
                data-pets-date-input
                data-pets-change
                autocomplete="off"
            >
            <span class="input__control-error--mask"></span>
            <span class="input__icon">
                <svg class="icon icon--calendar">
                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-calendar"></use>
                </svg>
            </span>
        </div>
    `,
};
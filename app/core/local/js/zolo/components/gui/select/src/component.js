import select from "../../../../../../../../../assets/js/modules/select";
import StringFormatMixin from "../../../../mixins/StringFormatMixin";

let id = 0;

export const Select = {
    mixins: [StringFormatMixin],

    data() {
        return {
            componentId: 'select-' + ++id,
        };
    },

    props: {
        name: {
            type: String,
            required: true,
        },
        placeholder: {
            type: String,
            default: null,
        },
        options: {
            type: Object,
            required: true,
        },
        selected: {
            type: Number,
            default: null,
        },
        iconed: {
            type: Boolean,
            default: false,
        },
    },

    mounted() {
        select();

        $(`#${this.componentId}`).on('change', () => {
            this.$emit('custom-change', $(`#${this.componentId}`).val());
        });
    },

    methods: {
        getIconPath(icon) {
            return `<svg class="select__item-icon icon icon--${icon}"><use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-${icon}"></use></svg>`;
        },
    },

    template: `
        <div class="select select--mitigate" :class="{ 'select--iconed': iconed }" data-select>
            <select class="select__control" :name="name" :id="componentId" data-select-control :data-placeholder="placeholder ?? 'Выбрать'">
                <option><!-- пустой option для placeholder --></option>
                <option
                    v-for="(option, optionId) in options"
                    :key="optionId"
                    :value="optionId"
                    :data-option-before="iconed ? getIconPath(option.icon) : false"
                    :selected="optionId === selected"
                >
                    {{ uppercaseFirst(option.name) }}
                </option>
            </select>
        </div>
    `,
};
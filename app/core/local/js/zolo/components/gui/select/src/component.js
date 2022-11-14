import select from "../../../../../../../../../assets/js/modules/select";

let id = 0;

export const Select = {
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
        species: {
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
        speciesStr(option) {
            return this.species ? `<svg class="select__item-icon icon icon--cat"><use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-${option.icon}"></use></svg>` : '';
        }
    },

    template: `
        <div class="select select--mitigate" :class="{ 'select--iconed': iconed }" data-select>
            <select class="select__control" :name="name" :id="componentId" data-select-control :data-placeholder="placeholder ?? 'Выбрать'">
                <option><!-- пустой option для placeholder --></option>
                <option
                    v-for="(option, optionId) in options"
                    :key="optionId"
                    :value="optionId"
                    :data-option-icon="iconed ? option.icon : false"
                    :selected="optionId === selected"
                    :data-option-before="speciesStr(option)"
                >
                    {{ option.name }}
                </option>
            </select>
        </div>
    `,
};
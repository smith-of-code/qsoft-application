import { Dropzone } from "../../gui/dropzone/src/component";
import { useLegalEntityStore } from '../../../stores/legalEntityStore';

let id = 0;

export const LegalEntity = {
    components: { Dropzone },

    data() {
        return {
            componentId: `legal-entity-${++id}`,
            originalLegalEntity: {},
            mutableLegalEntity: {},
            editing: false,
            error: false,
        };
    },

    props: {
        legalEntity: {
            type: Object,
            default: {},
        },
        types: {
            type: Object,
            required: true,
        },
    },

    setup() {
        return { legalEntityStore: useLegalEntityStore() };
    },

    created() {
        this.originalLegalEntity = JSON.parse(JSON.stringify(this.legalEntity));
        this.initLegalEntity();
    },

    mounted() {
        $('select[name=status]').on('change', () => this.changeLegalEntityType());
    },

    methods: {
        initLegalEntity() {
            this.mutableLegalEntity = JSON.parse(JSON.stringify(this.originalLegalEntity));
        },
        changeLegalEntityType() {
            this.mutableLegalEntity.type = this.types[$('select[name=status]').val()];
        },
        edit() {
            this.editing = true;
            if ($(`#${this.componentId} .accordeon__body`).css('display') === 'none') {
                $(`#${this.componentId} [data-accordeon-toggle]`).trigger('click');
            }
        },
        cancelEditing() {
            this.initLegalEntity();
            this.editing = false;
        },
        saveChanges() {
            this.error = false;
            for (const document in this.mutableLegalEntity.documents) {
                if (!document || !document.length) {
                    this.error = true;
                    return;
                }
            }

            this.legalEntityStore.saveLegalEntityData(this.mutableLegalEntity);
            this.editing = false;

            this.originalLegalEntity = JSON.parse(JSON.stringify(this.mutableLegalEntity));

            $.fancybox.open({ src: '#thanks' });
        },
    },

    template: `
        <div :id="componentId" class="profile__block legal_entity_block" data-accordeon :class="{ 'profile__block--edit': editing }">
            <section class="section">
                <div class="form form--wraped form--separated">
                    <div class="section__box box box--gray box--rounded-sm">
                        <div class="profile__accordeon-header accordeon__header section__header">
                            <h4 class="section__title section__title--closer">Юридические данные</h4>

                            <div class="profile__actions">
                                <button v-if="!editing" type="button" class="profile__actions-button profile__actions-button--edit button button--simple button--red" @click="edit">
                                    <span class="button__icon">
                                        <svg class="icon icon--edit">
                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-edit"></use>
                                        </svg>
                                    </span>
                                    <span class="button__text">Редактировать</span>
                                </button>

                                <button type="button" class="profile__actions-button accordeon__toggle button button--circular button--mini button--covered button--red-white" data-accordeon-toggle >
                                    <span class="accordeon__toggle-icon button__icon">
                                        <svg class="icon icon--arrow-down">
                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-down"></use>
                                        </svg>
                                    </span>
                                </button>
                            </div>
                        </div>

                        <div class="accordeon__body accordeon__body--closer" data-accordeon-content>
                            <div class="profile__actions profile__actions--mobile">
                                <button v-if="!editing" type="button" class="profile__actions-button button button--simple button--red" @click="edit">
                                    <span class="button__icon">
                                        <svg class="icon icon--edit">
                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-edit"></use>
                                        </svg>
                                    </span>
                                    <span class="button__text">Редактировать</span>
                                </button>
                            </div>

                            <div class="section__box-inner">
                                <h5 class="box__heading box__heading--middle">Общее</h5>

                                <div class="section__box-content box box--white box--rounded-sm box--inner">
                                    <div class="section__box-block">
                                        <h6 class="box__heading box__heading--small">Статус и гражданство</h6>

                                        <div class="form__row form__row--mixed">
                                            <div class="form__col">
                                                <div class="form__field">
                                                    <div class="form__field-block form__field-block--label">
                                                        <label for="status" class="profile__label form__label form__label--required">
                                                            <span class="form__label-text">Статус</span>
                                                        </label>
                                                    </div>

                                                    <div class="form__field-block form__field-block--input">
                                                        <div class="form__control">
                                                            <div class="profile__toggle-select select select--mitigate" data-select>
                                                                <select class="select__control js-required" name="status" id="status" data-select-control data-placeholder="Выберите статус">
                                                                    <option><!-- пустой option для placeholder --></option>
                                                                    <option
                                                                        v-for="type in types"
                                                                        :key="type.id"
                                                                        :value="type.id"
                                                                        :selected="type.id === legalEntity.type.id"
                                                                    >
                                                                        {{ type.name }}
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- TODO: Определиться с реализацией -->
                                            <div class="form__col">
                                                <div class="form__field">
                                                    <div class="form__field-block form__field-block--label">
                                                        <label for="nationality" class="profile__label form__label form__label--required">
                                                            <span class="form__label-text">Гражданство</span>
                                                        </label>
                                                    </div>

                                                    <div class="form__field-block form__field-block--input">
                                                        <div class="form__control">
                                                            <div class="profile__toggle-select select select--mitigate" data-select>
                                                                <select class="select__control js-required" name="nationality" id="nationality" data-select-control data-placeholder="Выберите статус гражданства">
                                                                    <option><!-- пустой option для placeholder --></option>
                                                                    <option
                                                                        value="russian"
                                                                        :selected="mutableLegalEntity.documents.nationality === 'russian'"
                                                                    >Резидент РФ</option>
                                                                    <option
                                                                        value="not_russian"
                                                                        :selected="mutableLegalEntity.documents.nationality === 'not_russian'"
                                                                    >Незезидент РФ</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="section__box-block">
                                        <h6 class="box__heading box__heading--small">Паспортные данные</h6>

                                        <div class="form__row form__row--mixed">
                                            <div class="form__col">
                                                <div class="form__field">
                                                    <div class="form__field-block form__field-block--label">
                                                        <label for="passport_series" class="profile__label form__label form__label--required">
                                                            <span class="form__label-text">Серия паспорта</span>
                                                        </label>
                                                    </div>

                                                    <div class="form__field-block form__field-block--input">
                                                        <div class="input">
                                                            <input
                                                                type="text"
                                                                class="input__control js-required"
                                                                data-profile-readonly
                                                                name="passport_series"
                                                                id="passport_series"
                                                                placeholder="12 34"
                                                                data-passport-seria
                                                                :readonly="!editing"
                                                                v-model="mutableLegalEntity.documents.passport_series"
                                                            >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form__col">
                                                <div class="form__field">
                                                    <div class="form__field-block form__field-block--label">
                                                        <label for="passport_number" class="profile__label form__label form__label--required">
                                                            <span class="form__label-text">Номер</span>
                                                        </label>
                                                    </div>

                                                    <div class="form__field-block form__field-block--input">
                                                        <div class="input">
                                                            <input 
                                                                type="text"
                                                                class="input__control js-required"
                                                                data-profile-readonly
                                                                name="passport_number"
                                                                id="passport_number"
                                                                placeholder="Введите номер паспорта"
                                                                data-passport-number
                                                                :readonly="!editing"
                                                                v-model="mutableLegalEntity.documents.passport_number"
                                                            >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form__row form__row--mixed">
                                            <div class="form__col">
                                                <div class="form__field">
                                                    <div class="form__field-block form__field-block--label">
                                                        <label for="who_got" class="profile__label form__label form__label--required">
                                                            <span class="form__label-text">Кем выдан</span>
                                                        </label>
                                                    </div>

                                                    <div class="form__field-block form__field-block--input">
                                                        <div class="input">
                                                            <input
                                                                type="text"
                                                                class="input__control js-required"
                                                                data-profile-readonly
                                                                name="who_got"
                                                                id="who_got"
                                                                placeholder="Кем выдан"
                                                                :readonly="!editing"
                                                                v-model="mutableLegalEntity.documents.who_got"
                                                            >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form__col">
                                                <div class="form__field">
                                                    <div class="form__field-block form__field-block--label">
                                                        <label for="getting_date" class="form__label">
                                                            <span class="form__label-text">Дата выдачи паспорта</span>
                                                        </label>
                                                    </div>

                                                    <div class="form__field-block form__field-block--input">
                                                        <div class="input input--iconed">
                                                            <input
                                                                inputmode="numeric"
                                                                class="input__control js-required js-date"
                                                                name="getting_date"
                                                                id="getting_date"
                                                                placeholder="ДД.ММ.ГГГГ"
                                                                data-mask-date 
                                                                data-inputmask-alias="datetime"
                                                                data-inputmask-inputformat="dd.mm.yyyy"
                                                                data-pets-date-input
                                                                data-pets-change
                                                                data-profile-readonly
                                                                :readonly="!editing"
                                                                v-model="mutableLegalEntity.documents.getting_date"
                                                            >
                                                            <span class="input__icon">
                                                                <svg class="icon icon--calendar">
                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-calendar"></use>
                                                                </svg>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="section__box-block">
                                        <h6 class="box__heading box__heading--small">Адрес регистрации</h6>

                                        <div class="form__row form__row--mixed">
                                            <div class="form__col">
                                                <div class="form__field">
                                                    <div class="form__field-block form__field-block--label">
                                                        <label for="register_locality" class="profile__label form__label form__label--required">
                                                            <span class="form__label-text">Населенный пункт</span>
                                                        </label>
                                                    </div>

                                                    <div class="form__field-block form__field-block--input">
                                                        <div class="input">
                                                            <input
                                                                type="text"
                                                                class="input__control js-required"
                                                                data-profile-readonly
                                                                name="register_locality"
                                                                id="register_locality"
                                                                placeholder="Населенный пункт"
                                                                :readonly="!editing"
                                                                v-model="mutableLegalEntity.documents.register_locality"
                                                            >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form__col">
                                                <div class="form__field">
                                                    <div class="form__field-block form__field-block--label">
                                                        <label for="register_street" class="profile__label form__label form__label--required">
                                                            <span class="form__label-text">Улица</span>
                                                        </label>
                                                    </div>

                                                    <div class="form__field-block form__field-block--input">
                                                        <div class="input">
                                                            <input
                                                                type="text"
                                                                class="input__control js-required"
                                                                data-profile-readonly
                                                                name="register_street"
                                                                id="register_street"
                                                                placeholder="Улица"
                                                                :readonly="!editing"
                                                                v-model="mutableLegalEntity.documents.register_street"
                                                            >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form__row form__row--mixed">
                                            <div class="form__col">
                                                <div class="form__field">
                                                    <div class="form__field-block form__field-block--label">
                                                        <label for="register_house" class="profile__label form__label form__label--required">
                                                            <span class="form__label-text">Дом</span>
                                                        </label>
                                                    </div>

                                                    <div class="form__field-block form__field-block--input">
                                                        <div class="input">
                                                            <input
                                                                type="number"
                                                                class="input__control js-required"
                                                                data-profile-readonly
                                                                name="passport.addressRegistration.home"
                                                                id="register_house"
                                                                placeholder="Дом"
                                                                :readonly="!editing"
                                                                v-model="mutableLegalEntity.documents.register_house"
                                                            >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form__col">
                                                <div class="form__field">
                                                    <div class="form__field-block form__field-block--label">
                                                        <label for="register_apartment" class="profile__label form__label form__label--required">
                                                            <span class="form__label-text">Квартира</span>
                                                        </label>
                                                    </div>

                                                    <div class="form__field-block form__field-block--input">
                                                        <div class="input">
                                                            <input
                                                                type="number"
                                                                class="input__control js-required"
                                                                data-profile-readonly
                                                                name="register_apartment"
                                                                id="register_apartment"
                                                                placeholder="Квартира"
                                                                :readonly="!editing"
                                                                v-model="mutableLegalEntity.documents.register_apartment"
                                                            >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            
                                            <div class="form__col">
                                                <div class="form__field">
                                                    <div class="form__field-block form__field-block--label">
                                                        <label for="register_postal_code" class="profile__label form__label form__label--required">
                                                            <span class="form__label-text">Индекс</span>
                                                        </label>
                                                    </div>

                                                    <div class="form__field-block form__field-block--input">
                                                        <div class="input">
                                                            <input
                                                                type="number"
                                                                class="input__control js-required"
                                                                data-profile-readonly
                                                                name="register_postal_code"
                                                                id="register_postal_code"
                                                                placeholder="Индекс"
                                                                :readonly="!editing"
                                                                v-model="mutableLegalEntity.documents.register_postal_code"
                                                            >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="section__box-block" data-identic data-validate-dependent>
                                        <h6 class="box__heading box__heading--small">Адрес проживания</h6>
                                            <div class="form__row form__row--mixed">
                                                <div class="form__col">
                                                    <div class="form__field">
                                                        <div class="form__field-block form__field-block--label">
                                                            <label for="living_locality" class="profile__label form__label form__label--required">
                                                                <span class="form__label-text">Населенный пункт</span>
                                                            </label>
                                                        </div>

                                                        <div class="form__field-block form__field-block--input">
                                                            <div class="input">
                                                                <input
                                                                    type="text"
                                                                    class="input__control js-required-dependent"
                                                                    data-identic-input
                                                                    data-profile-readonly
                                                                    name="living_locality"
                                                                    id="living_locality"
                                                                    placeholder="Населенный пункт"
                                                                    :readonly="!editing"
                                                                    v-model="mutableLegalEntity.documents.living_locality"
                                                                >
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form__col">
                                                    <div class="form__field">
                                                        <div class="form__field-block form__field-block--label">
                                                            <label for="living_street" class="profile__label form__label form__label--required">
                                                                <span class="form__label-text">Улица</span>
                                                            </label>
                                                        </div>

                                                        <div class="form__field-block form__field-block--input">
                                                            <div class="input">
                                                                <input
                                                                    type="text"
                                                                    class="input__control js-required-dependent"
                                                                    data-identic-input
                                                                    data-profile-readonly
                                                                    name="living_street"
                                                                    id="living_street"
                                                                    placeholder="Улица"
                                                                    :readonly="!editing"
                                                                    v-model="mutableLegalEntity.documents.living_street"
                                                                >
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form__row form__row--mixed">
                                                <div class="form__col">
                                                    <div class="form__field">
                                                        <div class="form__field-block form__field-block--label">
                                                            <label for="living_house" class="profile__label form__label form__label--required">
                                                                <span class="form__label-text">Дом</span>
                                                            </label>
                                                        </div>

                                                        <div class="form__field-block form__field-block--input">
                                                            <div class="input">
                                                                <input
                                                                    type="number"
                                                                    class="input__control js-required-dependent"
                                                                    data-identic-input
                                                                    data-profile-readonly
                                                                    name="living_house"
                                                                    id="living_house"
                                                                    placeholder="Дом"
                                                                    :readonly="!editing"
                                                                    v-model="mutableLegalEntity.documents.living_house"
                                                                >
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form__col">
                                                    <div class="form__field">
                                                        <div class="form__field-block form__field-block--label">
                                                            <label for="living_apartment" class="profile__label form__label form__label--required">
                                                                <span class="form__label-text">Квартира</span>
                                                            </label>
                                                        </div>

                                                        <div class="form__field-block form__field-block--input">
                                                            <div class="input">
                                                                <input
                                                                    type="number"
                                                                    class="input__control js-required-dependent"
                                                                    data-identic-input
                                                                    data-profile-readonly
                                                                    name="living_apartment"
                                                                    id="living_apartment"
                                                                    placeholder="Квартира"
                                                                    :readonly="!editing"
                                                                    v-model="mutableLegalEntity.documents.living_apartment"
                                                                >
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                
                                                <div class="form__col">
                                                    <div class="form__field">
                                                        <div class="form__field-block form__field-block--label">
                                                            <label for="living_postal_code" class="profile__label form__label form__label--required">
                                                                <span class="form__label-text">Индекс</span>
                                                            </label>
                                                        </div>

                                                        <div class="form__field-block form__field-block--input">
                                                            <div class="input">
                                                                <input
                                                                    type="number"
                                                                    class="input__control js-required-dependent"
                                                                    data-identic-input
                                                                    data-profile-readonly
                                                                    name="living_postal_code"
                                                                    id="living_postal_code"
                                                                    placeholder="Индекс"
                                                                    :readonly="!editing"
                                                                    v-model="mutableLegalEntity.documents.living_postal_code"
                                                                >
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                        <!-- TODO: Определиться с реализацией -->
                                        <div class="profile__toggle form__row form__row--mixed">
                                            <div class="form__col">
                                                <div class="form__field">
                                                    <div class="checkbox">
                                                        <input
                                                            type="checkbox"
                                                            class="checkbox__input"
                                                            name="without_living"
                                                            id="without_living"
                                                            data-identic-change
                                                            data-validate-dependent-change
                                                            :readonly="!editing"
                                                            v-model="mutableLegalEntity.documents.without_living"                                                            
                                                        >

                                                        <label for="without_living" class="checkbox__label">
                                                            <span class="checkbox__icon">
                                                                <svg class="checkbox__icon-pic icon icon--check">
                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check">
                                                                </svg>
                                                            </span>

                                                            <span class="checkbox__text">Адрес регистрации совпадает с адресом фактического проживания</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="section__box-block">
                                        <h6 class="box__heading box__heading--small">Копия паспорта</h6>
                                        <Dropzone
                                            :files="mutableLegalEntity.documents.passport"
                                            :editing="editing"
                                        />
                                    </div>
                                </div>
                            </div>
                            
                            <div :hidden="mutableLegalEntity.type.code !== 'STATUS_SELF_EMPLOYED'" class="section__box-inner legal_entity STATUS_SELF_EMPLOYED">
                                <h5 class="box__heading box__heading--middle">Самозанятый</h5>
                    
                                <div class="section__box-content box box--white box--rounded-sm box--inner">
                                    <div class="section__box-block">
                                        <div class="form__row">
                                            <div class="form__col">
                                                <div class="form__field">
                                                    <div class="form__field-block form__field-block--label">
                                                        <label for="tin" class="form__label form__label--required">
                                                            <span class="form__label-text">ИНН</span>
                                                        </label>
                                                    </div>
                    
                                                    <div class="form__field-block form__field-block--input">
                                                        <div class="input">
                                                            <input
                                                                type="text"
                                                                class="input__control"
                                                                name="tin"
                                                                id="tin"
                                                                placeholder="ИНН"
                                                                data-inn
                                                                v-model="mutableLegalEntity.documents.tin"
                                                            >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                    
                                    <div class="section__box-block">
                                        <h6 class="box__heading box__heading--small">Копия свидетельства о постановке на учет в налоговом органе</h6>

                                          <Dropzone
                                              :files="mutableLegalEntity.documents.tax_registration_certificate"
                                              :editing="editing"
                                          />
                                    </div>
                    
                                    <div class="section__box-block">
                                        <h6 class="box__heading box__heading--small">Банковские реквизиты</h6>
                    
                                        <div class="form__row">
                                            <div class="form__col">
                                                <div class="form__field">
                                                    <div class="form__field-block form__field-block--label">
                                                        <label for="bank_name" class="form__label form__label--required">
                                                            <span class="form__label-text">Наименование банка</span>
                                                        </label>
                                                    </div>
                    
                                                    <div class="form__field-block form__field-block--input">
                                                        <div class="input">
                                                            <input
                                                                type="text"
                                                                class="input__control"
                                                                name="bank_name"
                                                                id="bank_name"
                                                                placeholder="Наименование банка"
                                                                :readonly="!editing"
                                                                v-model="mutableLegalEntity.documents.bank_name"
                                                            >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                    
                                            <div class="form__col">
                                                <div class="form__field">
                                                    <div class="form__field-block form__field-block--label">
                                                        <label for="bic" class="form__label form__label--required">
                                                            <span class="form__label-text">БИК</span>
                                                        </label>
                                                    </div>
                    
                                                    <div class="form__field-block form__field-block--input">
                                                        <div class="input">
                                                            <input
                                                                type="text"
                                                                class="input__control"
                                                                name="bic"
                                                                id="bic"
                                                                placeholder="БИК"
                                                                data-bik
                                                                :readonly="!editing"
                                                                v-model="mutableLegalEntity.documents.bic"
                                                            >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                    
                                        <div class="form__row">
                                            <div class="form__col">
                                                <div class="form__field">
                                                    <div class="form__field-block form__field-block--label">
                                                        <label for="checking_account" class="form__label form__label--required">
                                                            <span class="form__label-text">Расчетный счет</span>
                                                        </label>
                                                    </div>
                    
                                                    <div class="form__field-block form__field-block--input">
                                                        <div class="input">
                                                            <input
                                                                type="number"
                                                                class="input__control"
                                                                name="checking_account"
                                                                id="checking_account"
                                                                placeholder="Расчетный счет"
                                                                :readonly="!editing"
                                                                v-model="mutableLegalEntity.documents.bic"
                                                            >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                    
                                            <div class="form__col">
                                                <div class="form__field">
                                                    <div class="form__field-block form__field-block--label">
                                                        <label for="correspondent_account" class="form__label form__label--required">
                                                            <span class="form__label-text">Корреспондентский счет</span>
                                                        </label>
                                                    </div>
                    
                                                    <div class="form__field-block form__field-block--input">
                                                        <div class="input">
                                                            <input
                                                                type="number"
                                                                class="input__control"
                                                                name="correspondent_account"
                                                                id="correspondent_account"
                                                                placeholder="Корреспондентский счет"
                                                                :readonly="!editing"
                                                                v-model="mutableLegalEntity.documents.correspondent_account"
                                                            >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                    
                                    <div class="section__box-block">
                                        <h6 class="box__heading box__heading--small">Сведения о банковских реквизитах</h6>
                                          <Dropzone
                                              :files="mutableLegalEntity.documents.bank_details"
                                              :editing="editing"
                                          />
                                    </div>
                    
                                    <div class="section__box-block">
                                        <h6 class="box__heading box__heading--small">Копия справки о постановке на учет физического лица в качестве плательщика налога на профессиональный доход</h6>

                                      <Dropzone
                                          :files="mutableLegalEntity.documents.personal_tax_registration_certificate"
                                          :editing="editing"
                                      />
                                    </div>
                                </div>
                            </div>
                            
                            <div :hidden="mutableLegalEntity.type.code !== 'STATUS_IP'" class="section__box-inner legal_entity STATUS_IP">
                                <h5 class="box__heading box__heading--middle">Индивидуальный предприниматель</h5>
                    
                                <div class="section__box-content box box--white box--rounded-sm box--inner">
                                    <div class="section__box-block">
                                        <div class="form__row">
                                            <div class="form__col">
                                                <div class="form__field">
                                                    <div class="form__field-block form__field-block--label">
                                                        <label for="ip_name" class="form__label form__label--required">
                                                            <span class="form__label-text">Наименование ИП</span>
                                                        </label>
                                                    </div>
                    
                                                    <div class="form__field-block form__field-block--input">
                                                        <div class="input">
                                                            <input
                                                                type="text"
                                                                class="input__control"
                                                                name="ip_name"
                                                                id="ip_name"
                                                                placeholder="Наименование ИП"
                                                                :readonly="!editing"
                                                                v-model="mutableLegalEntity.documents.ip_name"
                                                            >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                    
                                    <div class="section__box-block">
                                        <div class="form__row">
                                            <div class="form__col">
                                                <div class="form__field">
                                                    <div class="form__field-block form__field-block--label">
                                                        <label for="tin" class="form__label form__label--required">
                                                            <span class="form__label-text">ИНН</span>
                                                        </label>
                                                    </div>
                    
                                                    <div class="form__field-block form__field-block--input">
                                                        <div class="input">
                                                            <input
                                                                type="text"
                                                                class="input__control"
                                                                name="tin"
                                                                id="tin"
                                                                placeholder="ИНН"
                                                                data-inn
                                                                :readonly="!editing"
                                                                v-model="mutableLegalEntity.documents.tin"
                                                            >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                    
                                    <div class="form__row">
                                        <div class="form__col">
                                            <div class="form__field">
                                                <div class="checkbox">
                                                    <input
                                                        type="checkbox"
                                                        class="checkbox__input"
                                                        name="nds_payer_ip"
                                                        id="nds_payer_ip"
                                                        :readonly="!editing"
                                                        v-model="mutableLegalEntity.documents.nds_payer_ip"
                                                        :checked="mutableLegalEntity.documents.nds_payer_ip" 
                                                    >
                    
                                                    <label for="nds_payer_ip" class="checkbox__label">
                                                        <span class="checkbox__icon">
                                                            <svg class="checkbox__icon-pic icon icon--check">
                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check">
                                                            </svg>
                                                        </span>
                    
                                                        <span class="checkbox__text">Плательщик НДС</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                    
                                    <div class="section__box-block">
                                        <h6 class="box__heading box__heading--small">Копия свидетельства о постановке на учет в налоговом органе</h6>

                                      <Dropzone
                                          :files="mutableLegalEntity.documents.tax_registration_certificate"
                                          :editing="editing"
                                      />
                                    </div>
                    
                                    <div class="section__box-block">
                                        <h6 class="box__heading box__heading--small">Копия уведомления о применении УСН успрощенной системы налогоплательщика(в случае применения УСН)</h6>

                                      <Dropzone
                                          :files="mutableLegalEntity.documents.usn_notification"
                                          :editing="editing"
                                      />
                                    </div>
                    
                                    <div class="section__box-block">
                                        <div class="form__row">
                                            <div class="form__col">
                                                <div class="form__field">
                                                    <div class="form__field-block form__field-block--label">
                                                        <label for="ogrnip" class="form__label form__label--required">
                                                            <span class="form__label-text">ОГРНИП</span>
                                                        </label>
                                                    </div>
                    
                                                    <div class="form__field-block form__field-block--input">
                                                        <div class="input">
                                                            <input
                                                                type="text"
                                                                class="input__control"
                                                                name="ogrnip"
                                                                id="ogrnip"
                                                                placeholder="ОГРНИП"
                                                                data-ogrnip
                                                                :readonly="!editing"
                                                                v-model="mutableLegalEntity.documents.ogrnip"
                                                            >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                    
                                    <div class="section__box-block">
                                        <h6 class="box__heading box__heading--small">Копия свидетельства о государственной регистрации ИП/листа записи ЕГРИП</h6>

                                      <Dropzone
                                          :files="mutableLegalEntity.documents.ip_registration_certificate"
                                          :editing="editing"
                                      />
                                    </div>
                    
                                    <div class="section__box-block">
                                        <h6 class="box__heading box__heading--small">Банковские реквизиты</h6>
                    
                                        <div class="form__row">
                                            <div class="form__col">
                                                <div class="form__field">
                                                    <div class="form__field-block form__field-block--label">
                                                        <label for="bank_name" class="form__label form__label--required">
                                                            <span class="form__label-text">Наименование банка</span>
                                                        </label>
                                                    </div>
                    
                                                    <div class="form__field-block form__field-block--input">
                                                        <div class="input">
                                                            <input
                                                                type="text"
                                                                class="input__control"
                                                                name="bank_name"
                                                                id="bank_name"
                                                                placeholder="Наименование банка"
                                                                :readonly="!editing"
                                                                v-model="mutableLegalEntity.documents.bank_name"
                                                            >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                    
                                            <div class="form__col">
                                                <div class="form__field">
                                                    <div class="form__field-block form__field-block--label">
                                                        <label for="bic" class="form__label form__label--required">
                                                            <span class="form__label-text">БИК</span>
                                                        </label>
                                                    </div>
                    
                                                    <div class="form__field-block form__field-block--input">
                                                        <div class="input">
                                                            <input
                                                                type="text"
                                                                class="input__control"
                                                                name="bic"
                                                                id="bic"
                                                                placeholder="БИК"
                                                                data-bik
                                                                :readonly="!editing"
                                                                v-model="mutableLegalEntity.documents.bic"
                                                            >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                    
                                        <div class="form__row">
                                            <div class="form__col">
                                                <div class="form__field">
                                                    <div class="form__field-block form__field-block--label">
                                                        <label for="checking_account" class="form__label form__label--required">
                                                            <span class="form__label-text">Расчетный счет</span>
                                                        </label>
                                                    </div>
                    
                                                    <div class="form__field-block form__field-block--input">
                                                        <div class="input">
                                                            <input
                                                                type="number"
                                                                class="input__control"
                                                                name="checking_account"
                                                                id="checking_account"
                                                                placeholder="Расчетный счет"
                                                                :readonly="!editing"
                                                                v-model="mutableLegalEntity.documents.checking_account"
                                                            >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                    
                                            <div class="form__col">
                                                <div class="form__field">
                                                    <div class="form__field-block form__field-block--label">
                                                        <label for="correspondent_account" class="form__label form__label--required">
                                                            <span class="form__label-text">Корреспондентский счет</span>
                                                        </label>
                                                    </div>
                    
                                                    <div class="form__field-block form__field-block--input">
                                                        <div class="input">
                                                            <input
                                                                type="number"
                                                                class="input__control"
                                                                name="correspondent_account"
                                                                id="correspondent_account"
                                                                placeholder="Корреспондентский счет"
                                                                :readonly="!editing"
                                                                v-model="mutableLegalEntity.documents.correspondent_account"
                                                            >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                    
                                    <div class="section__box-block">
                                        <h6 class="box__heading box__heading--small">Сведения о банковских реквизитах</h6>

                                      <Dropzone
                                          :files="mutableLegalEntity.documents.bank_details"
                                          :editing="editing"
                                      />
                                    </div>
                                </div>
                            </div>
                            
                            <div :hidden="mutableLegalEntity.type.code !== 'STATUS_JURIDICAL'" class="section__box-inner legal_entity STATUS_JURIDICAL">
                                <h5 class="box__heading box__heading--middle">Общество с ограниченной ответственностью</h5>
                    
                                <div class="section__box-content box box--white box--rounded-sm box--inner">
                                    <div class="section__box-block">
                                        <div class="form__row">
                                            <div class="form__col">
                                                <div class="form__field">
                                                    <div class="form__field-block form__field-block--label">
                                                        <label for="ltc_full_name" class="form__label form__label--required">
                                                            <span class="form__label-text">Наименование организации (полное)</span>
                                                        </label>
                                                    </div>
                    
                                                    <div class="form__field-block form__field-block--input">
                                                        <div class="input">
                                                            <input
                                                                type="text"
                                                                class="input__control"
                                                                name="ltc_full_name"
                                                                id="ltc_full_name"
                                                                placeholder="Наименование организации (полное)"
                                                                :readonly="!editing"
                                                                v-model="mutableLegalEntity.documents.ltc_full_name"
                                                            >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                    
                                    <div class="section__box-block">
                                        <div class="form__row">
                                            <div class="form__col">
                                                <div class="form__field">
                                                    <div class="form__field-block form__field-block--label">
                                                        <label for="ltc_short_name" class="form__label form__label--required">
                                                            <span class="form__label-text">Наименование организации (сокращенное)</span>
                                                        </label>
                                                    </div>
                    
                                                    <div class="form__field-block form__field-block--input">
                                                        <div class="input">
                                                            <input
                                                                type="text"
                                                                class="input__control"
                                                                name="ltc_short_name"
                                                                id="ltc_short_name"
                                                                placeholder="Наименование организации (сокращенное)"
                                                                :readonly="!editing"
                                                                v-model="mutableLegalEntity.documents.ltc_short_name"
                                                            >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                    
                                    <div class="section__box-block">
                                        <div class="form__row">
                                            <div class="form__col">
                                                <div class="form__field">
                                                    <div class="form__field-block form__field-block--label">
                                                        <label for="ogrn" class="form__label form__label--required">
                                                            <span class="form__label-text">ОГРН</span>
                                                        </label>
                                                    </div>
                    
                                                    <div class="form__field-block form__field-block--input">
                                                        <div class="input">
                                                            <input
                                                                type="text"
                                                                class="input__control"
                                                                name="ogrn"
                                                                id="ogrn"
                                                                placeholder="ОГРН"
                                                                data-ogrn
                                                                :readonly="!editing"
                                                                v-model="mutableLegalEntity.documents.ogrn"
                                                            >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                    
                                    <div class="section__box-block">
                                        <div class="form__row">
                                            <div class="form__col">
                                                <div class="form__field">
                                                    <div class="form__field-block form__field-block--label">
                                                        <label for="tin" class="form__label form__label--required">
                                                            <span class="form__label-text">ИНН</span>
                                                        </label>
                                                    </div>
                    
                                                    <div class="form__field-block form__field-block--input">
                                                        <div class="input">
                                                            <input
                                                                type="text"
                                                                class="input__control"
                                                                name="tin"
                                                                id="tin"
                                                                placeholder="ИНН"
                                                                data-short-inn
                                                                :readonly="!editing"
                                                                v-model="mutableLegalEntity.documents.tin"
                                                            >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                    
                                    <div class="form__row">
                                        <div class="form__col">
                                            <div class="form__field">
                                                <div class="checkbox">
                                                    <input
                                                        type="checkbox"
                                                        class="checkbox__input"
                                                        name="nds_payer_ltc"
                                                        id="nds_payer_ltc"
                                                        :readonly="!editing"
                                                        v-model="mutableLegalEntity.documents.nds_payer_ltc"
                                                        :checked="mutableLegalEntity.documents.nds_payer_ltc" 
                                                    >
                    
                                                    <label for="nds_payer_ltc" class="checkbox__label">
                                                        <span class="checkbox__icon">
                                                            <svg class="checkbox__icon-pic icon icon--check">
                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check">
                                                            </svg>
                                                        </span>
                    
                                                        <span class="checkbox__text">Плательщик НДС</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                    
                                    <div class="section__box-block">
                                        <h6 class="box__heading box__heading--small">Копия свидетельства о постановке на учет российской организации в налоговом органе</h6>

                                      <Dropzone
                                          :files="mutableLegalEntity.documents.tax_registration_certificate"
                                          :editing="editing"
                                      />
                                    </div>
                    
                                    <div class="section__box-block">
                                        <h6 class="box__heading box__heading--small">Копия уведомления о применении УСН успрощенной системы налогоплательщика(в случае применения УСН)</h6>

                                      <Dropzone
                                          :files="mutableLegalEntity.documents.usn_notification"
                                          :editing="editing"
                                      />
                                    </div>
                    
                                    <div class="section__box-block">
                                        <div class="form__row">
                                            <div class="form__col">
                                                <div class="form__field">
                                                    <div class="form__field-block form__field-block--label">
                                                        <label for="kpp" class="form__label form__label--required">
                                                            <span class="form__label-text">КПП</span>
                                                        </label>
                                                    </div>
                    
                                                    <div class="form__field-block form__field-block--input">
                                                        <div class="input">
                                                            <input
                                                                type="text"
                                                                class="input__control"
                                                                name="kpp"
                                                                id="kpp"
                                                                placeholder="КПП"
                                                                data-kpp
                                                                :readonly="!editing"
                                                                v-model="mutableLegalEntity.documents.kpp"
                                                            >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                    
                                    <div class="section__box-block">
                                        <h6 class="box__heading box__heading--small">Копия устава ООО</h6>

                                      <Dropzone
                                          :files="mutableLegalEntity.documents.llc_charter"
                                          :editing="editing"
                                      />
                                    </div>
                    
                                    <div class="section__box-block">
                                        <h6 class="box__heading box__heading--small">Копия протокола участников (решения участника) ООО об избрании руководителя организации</h6>

                                      <Dropzone
                                          :files="mutableLegalEntity.documents.llc_members"
                                          :editing="editing"
                                      />
                                    </div>
                    
                                    <div class="section__box-block">
                                        <h6 class="box__heading box__heading--small">Копия приказа о вступлнеии в должность генерального директора</h6>

                                      <Dropzone
                                          :files="mutableLegalEntity.documents.ceo_appointment"
                                          :editing="editing"
                                      />
                                    </div>
                    
                                    <div class="section__box-block">
                                        <h6 class="box__heading box__heading--small">Копия свидетельства о государственной регистрации ООО/листа записи ЕГРЮЛ о внесении записи об ООО в ЕГРЮЛ</h6>

                                      <Dropzone
                                          :files="mutableLegalEntity.documents.llc_registration_certificate"
                                          :editing="editing"
                                      />
                                    </div>
                    
                                    <div class="form__row">
                                        <div class="form__col">
                                            <div class="form__field">
                                                <div class="checkbox">
                                                    <input
                                                        type="checkbox"
                                                        class="checkbox__input"
                                                        name="need_proxy"
                                                        id="need_proxy"
                                                        :readonly="!editing"
                                                        v-model="mutableLegalEntity.documents.need_proxy"
                                                        :checked="mutableLegalEntity.documents.need_proxy" 
                                                    >
                    
                                                    <label for="need_proxy" class="checkbox__label">
                                                        <span class="checkbox__icon">
                                                            <svg class="checkbox__icon-pic icon icon--check">
                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check">
                                                            </svg>
                                                        </span>
                    
                                                        <span class="checkbox__text">У меня нет права подписи документов ООО, я хотел бы добавить уполномоченное лицо</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                    
                                    <div class="section__box-block">
                                        <h6 class="box__heading box__heading--small">Копия доверенности на представителя (в случае подписания представителем-не руководителем ООО)</h6>

                                      <Dropzone
                                          :files="mutableLegalEntity.documents.procuration"
                                          :editing="editing"
                                      />
                                    </div>
                    
                                    <div class="section__box-block">
                                        <h6 class="box__heading box__heading--small">Банковские реквизиты</h6>
                    
                                        <div class="form__row">
                                            <div class="form__col">
                                                <div class="form__field">
                                                    <div class="form__field-block form__field-block--label">
                                                        <label for="bank_name" class="form__label form__label--required">
                                                            <span class="form__label-text">Наименование банка</span>
                                                        </label>
                                                    </div>
                    
                                                    <div class="form__field-block form__field-block--input">
                                                        <div class="input">
                                                            <input
                                                                type="text"
                                                                class="input__control"
                                                                name="bank_name"
                                                                id="bank_name"
                                                                placeholder="Наименование банка"
                                                                :readonly="!editing"
                                                                v-model="mutableLegalEntity.documents.bank_name"
                                                            >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                    
                                            <div class="form__col">
                                                <div class="form__field">
                                                    <div class="form__field-block form__field-block--label">
                                                        <label for="bic" class="form__label form__label--required">
                                                            <span class="form__label-text">БИК</span>
                                                        </label>
                                                    </div>
                    
                                                    <div class="form__field-block form__field-block--input">
                                                        <div class="input">
                                                            <input
                                                                type="text"
                                                                class="input__control"
                                                                name="bic"
                                                                id="bic"
                                                                placeholder="БИК"
                                                                data-bik
                                                                :readonly="!editing"
                                                                v-model="mutableLegalEntity.documents.bic"
                                                            >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                    
                                        <div class="form__row">
                                            <div class="form__col">
                                                <div class="form__field">
                                                    <div class="form__field-block form__field-block--label">
                                                        <label for="checking_account" class="form__label form__label--required">
                                                            <span class="form__label-text">Расчетный счет</span>
                                                        </label>
                                                    </div>
                    
                                                    <div class="form__field-block form__field-block--input">
                                                        <div class="input">
                                                            <input
                                                                type="number"
                                                                class="input__control"
                                                                name="checking_account"
                                                                id="checking_account"
                                                                placeholder="Расчетный счет"
                                                                :readonly="!editing"
                                                                v-model="mutableLegalEntity.documents.checking_account"
                                                            >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                    
                                            <div class="form__col">
                                                <div class="form__field">
                                                    <div class="form__field-block form__field-block--label">
                                                        <label for="correspondent_account" class="form__label form__label--required">
                                                            <span class="form__label-text">Корреспондентский счет</span>
                                                        </label>
                                                    </div>
                    
                                                    <div class="form__field-block form__field-block--input">
                                                        <div class="input">
                                                            <input
                                                                type="number"
                                                                class="input__control"
                                                                name="correspondent_account"
                                                                id="correspondent_account"
                                                                placeholder="Корреспондентский счет"
                                                                :readonly="!editing"
                                                                v-model="mutableLegalEntity.documents.correspondent_account"
                                                            >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                    
                                    <div class="section__box-block">
                                        <h6 class="box__heading box__heading--small">Сведения о банковских реквизитах</h6>

                                      <Dropzone
                                          :files="mutableLegalEntity.documents.bank_details"
                                          :editing="editing"
                                      />
                                    </div>
                    
                                    <div class="section__box-block">
                                        <h6 class="box__heading box__heading--small">Адрес организации</h6>
                    
                                        <div class="form__row">
                                            <div class="form__col">
                                                <div class="form__field">
                                                    <div class="form__field-block form__field-block--label">
                                                        <label for="ltc_locality" class="form__label form__label--required">
                                                            <span class="form__label-text">Населенный пункт</span>
                                                        </label>
                                                    </div>
                    
                                                    <div class="form__field-block form__field-block--input">
                                                        <div class="input">
                                                            <input
                                                                type="text"
                                                                class="input__control"
                                                                name="ltc_locality"
                                                                id="ltc_locality"
                                                                placeholder="Населенный пункт"
                                                                :readonly="!editing"
                                                                v-model="mutableLegalEntity.documents.ltc_locality"
                                                            >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                    
                                            <div class="form__col">
                                                <div class="form__field">
                                                    <div class="form__field-block form__field-block--label">
                                                        <label for="ltc_street" class="form__label form__label--required">
                                                            <span class="form__label-text">Улица</span>
                                                        </label>
                                                    </div>
                    
                                                    <div class="form__field-block form__field-block--input">
                                                        <div class="input">
                                                            <input
                                                                type="text"
                                                                class="input__control"
                                                                name="ltc_street"
                                                                id="ltc_street"
                                                                placeholder="Улица"
                                                                :readonly="!editing"
                                                                v-model="mutableLegalEntity.documents.ltc_street"
                                                            >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                    
                                        <div class="form__row">
                                            <div class="form__col">
                                                <div class="form__field">
                                                    <div class="form__field-block form__field-block--label">
                                                        <label for="ltc_address_1" class="form__label form__label--required">
                                                            <span class="form__label-text">Дом, корпус, строение</span>
                                                        </label>
                                                    </div>
                    
                                                    <div class="form__field-block form__field-block--input">
                                                        <div class="input">
                                                            <input
                                                                type="number"
                                                                class="input__control"
                                                                name="ltc_address_1"
                                                                id="ltc_address_1"
                                                                placeholder="Дом, корпус, строение"
                                                                :readonly="!editing"
                                                                v-model="mutableLegalEntity.documents.ltc_address_1"
                                                            >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                    
                                            <div class="form__col">
                                                <div class="form__field">
                                                    <div class="form__field-block form__field-block--label">
                                                        <label for="ltc_address_2" class="form__label form__label--required">
                                                            <span class="form__label-text">Этаж, помещение, комната</span>
                                                        </label>
                                                    </div>
                    
                                                    <div class="form__field-block form__field-block--input">
                                                        <div class="input">
                                                            <input
                                                                type="number"
                                                                class="input__control"
                                                                name="ltc_address_2"
                                                                id="ltc_address_2"
                                                                placeholder="Этаж, помещение, комната"
                                                                :readonly="!editing"
                                                                v-model="mutableLegalEntity.documents.ltc_address_2"
                                                            >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                    
                    
                                            <div class="form__col">
                                                <div class="form__field">
                                                    <div class="form__field-block form__field-block--label">
                                                        <label for="ltc_postal_code" class="form__label form__label--required">
                                                            <span class="form__label-text">Индекс</span>
                                                        </label>
                                                    </div>
                    
                                                    <div class="form__field-block form__field-block--input">
                                                        <div class="input">
                                                            <input
                                                                type="number"
                                                                class="input__control"
                                                                name="ltc_postal_code"
                                                                id="ltc_postal_code"
                                                                placeholder="Индекс"
                                                                :readonly="!editing"
                                                                v-model="mutableLegalEntity.documents.ltc_postal_code"
                                                            >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="profile__toggle profile__toggle--inline section__actions">
                                <div class="section__actions-col">

                                  <button type="button" class="button button--rounded button--mixed button--red button--full" @click="() => cancelEditing(pet, petKey)">
                                    <span class="button__text">Отменить изменения</span>
                                  </button>
                                </div>

                                <div class="section__actions-col">
                                    <button type="button" class="button button--rounded button--covered button--green button--full" @click="saveChanges">
                                        <span class="button__text">Сохранить изменения</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <article id="thanks" class="modal modal--wide modal--centered box box--circle box--hanging" style="display: none">
            <div class="modal__content">
                <section class="modal__section modal__section--content">
                    <div class="notification notification--simple">
                        <div class="notification__icon">
                            <svg class="icon icon--cat-serious">
                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-cat-serious"></use>
                            </svg>
                        </div>
                        
                        <h4 class="notification__title">Спасибо за обращение</h4>
                        <p class="notification__text">Мы проверим обновленные данные и уведомим Вас о результате внесения изменений. </p>
                    </div>
                </section>
            </div>
        </article>
    `,
};
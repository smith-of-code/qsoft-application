import { useLegalEntityStore } from '../../../stores/legalEntityStore';

export const LegalEntity = {
    data() {
        return {
            mutableLegalEntity: {},
            editing: false,
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
        this.initLegalEntity();
    },

    mounted() {
        $('select[name=status]').on('change', () => this.changeLegalEntityType());
    },

    methods: {
        initLegalEntity() {
            this.mutableLegalEntity = JSON.parse(JSON.stringify(this.legalEntity));
        },
        changeLegalEntityType() {
            this.mutableLegalEntity.type = this.types[$('select[name=status]').val()];
        },
        cancelEditing() {
            this.editing = false;
            this.initLegalEntity();
        },
        saveChanges() {
            // TODO Validation

            $('.legal_entity_block input[type=file]').each((index, item) => {
                this.mutableLegalEntity.documents[$(item).attr('name')] = [];
                $(item).parent().find('.file.dz-success.dz-complete').each((index, innerItem) => {
                    this.mutableLegalEntity.documents[$(item).attr('name')].push({
                        id: $(innerItem).find('input[type=hidden]').val(),
                        name: $(innerItem).find('[data-uploader-preview-filename]').html(),
                        format: $(innerItem).find('[data-uploader-preview-format]').html(),
                        size: $(innerItem).find('[data-uploader-preview-size]').html(),
                    });
                });
            });

            this.legalEntityStore.saveLegalEntityData(this.mutableLegalEntity);
            this.cancelEditing();
        },
    },

    template: `
        <div class="profile__block legal_entity_block" data-accordeon :class="{ 'profile__block--edit': editing }">
            <section class="section">
                <div class="form form--wraped form--separated">
                    <div class="section__box box box--gray box--rounded-sm">
                        <div class="profile__accordeon-header accordeon__header section__header">
                            <h4 class="section__title section__title--closer">Юридические данные</h4>

                            <div class="profile__actions">
                                <button type="button" class="profile__actions-button profile__actions-button--edit button button--simple button--red" @click="editing = true">
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
                                <button type="button" class="profile__actions-button button button--simple button--red" data-profile-edit>
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

                                        <!-- TODO: Определиться с реализацией -->
                                        <!-- Для интеграции - необходимо вставить ссылку на файл -->
                                        <div class="profile__notification" style="display:none">
                                            <span class="profile__notification-icon">
                                                <svg class="icon icon--danger">
                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-danger"></use>
                                                </svg>
                                            </span>
                                            <p class="profile__notification-text">Необходимо приложить документы. Войдите в режим редактирования.</p>
                                        </div>

                                        <div class="dropzone" data-uploader>
                                            <input type="file" name="passport" multiple class="dropzone__control">

                                            <div class="dropzone__area" data-uploader-area='{"paramName": "passport", "url":"/_markup/gui.php"}'>
                                                <div class="profile__toggle dropzone__message dz-message needsclick">
                                                    <button type="button" class="dropzone__button button button--medium button--rounded button--covered button--red">
                                                        <span class="button__icon">
                                                            <svg class="icon icon--import">
                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-import"></use>
                                                            </svg>
                                                        </span>
                                                        <span class="button__text">Загрузить файл</span>
                                                    </button>
                                                </div>
                
                                                <div class="dropzone__previews dz-previews" data-uploader-previews>
                                                    <div v-for="passportPhoto in mutableLegalEntity.documents.passport" :key="passportPhoto.id" class="file dz-processing dz-image-preview dz-success" data-uploader-preview="">
                                                        <div class="file__wrapper">
                                                            <div class="file__prewiew">
                                                                <div class="file__icon">
                                                                    <svg class="icon icon--gallery">
                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-gallery"></use>
                                                                    </svg>
                                                                </div>

                                                                <div class="file__name">
                                                                    <h6 class="file__name-heading heading heading--tiny" data-uploader-preview-filename="">{{ passportPhoto.name }}</h6>
                                                                </div>
                                                            </div>

                                                            <div class="file__info">
                                                                <div class="file__format" data-uploader-preview-format="">{{ passportPhoto.format }}</div>

                                                                <div class="file__weight" data-uploader-preview-size="">{{ passportPhoto.size }}</div>

                                                                <div class="file__delete" data-dz-remove="">
                                                                    <button type="button" class="file__delete-button button button--iconed button--simple button--gray">
                                                                        <span class="file__delete-button-icon button__icon">
                                                                            <svg class="icon icon--delete">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-delete"></use>
                                                                            </svg>
                                                                        </span>
                                                                    </button>
                                                                </div>

                                                                <!-- Для интеграции - необходимо вставить ссылку на файл -->
                                                                <div class="file__upload">
                                                                    <a class="button button--iconed button--simple button--gray" :href="passportPhoto.src" download>
                                                                        <span class="button__icon">
                                                                            <svg class="icon icon--import">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-import"></use>
                                                                            </svg>
                                                                        </span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" data-dropzone-file="" :value="passportPhoto.id">
                                                        <div class="file__error" data-dz-errormessage=""></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
                                        <h6 class="box__heading box__heading--small">Загрузить копию свидетельства о постановке на учет в налоговом органе</h6>
                    
                                        <div class="dropzone" data-uploader>
                                            <input type="file" name="tax_registration_certificate" multiple class="dropzone__control">
                                        
                                            <div class="dropzone__area" data-uploader-area='{"paramName": "tax_registration_certificate", "url":"/_markup/gui.php"}'>
                                                <div class="profile__toggle dropzone__message dz-message needsclick">
                                                    <button type="button" class="dropzone__button button button--medium button--rounded button--covered button--red">
                                                        <span class="button__icon">
                                                            <svg class="icon icon--import">
                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-import"></use>
                                                            </svg>
                                                        </span>
                                                        <span class="button__text">Загрузить файл</span>
                                                    </button>
                                                </div>
                                        
                                                <div class="dropzone__previews dz-previews" data-uploader-previews>
                                                    <div v-for="taxRegistrationCertificatePhoto in mutableLegalEntity.documents.tax_registration_certificate" class="file dz-processing dz-image-preview dz-success dz-complete" data-uploader-preview="">
                                                        <div class="file__wrapper">
                                                            <div class="file__prewiew">
                                                                <div class="file__icon">
                                                                    <svg class="icon icon--gallery">
                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-gallery"></use>
                                                                    </svg>
                                                                </div>
                                    
                                                                <div class="file__name">
                                                                    <h6 class="file__name-heading heading heading--tiny" data-uploader-preview-filename="">{{ taxRegistrationCertificatePhoto.name }}</h6>
                                                                </div>
                                                            </div>
                                    
                                                            <div class="file__info">
                                                                <div class="file__format" data-uploader-preview-format="">{{ taxRegistrationCertificatePhoto.format }}</div>
                                    
                                                                <div class="file__weight" data-uploader-preview-size="">{{ taxRegistrationCertificatePhoto.size }}</div>
                                    
                                                                <div class="file__delete" data-dz-remove="">
                                                                    <button type="button" class="file__delete-button button button--iconed button--simple button--gray">
                                                                    <span class="file__delete-button-icon button__icon">
                                                                        <svg class="icon icon--delete">
                                                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-delete"></use>
                                                                        </svg>
                                                                    </span>
                                                                    </button>
                                                                </div>
                                                                
                                                                <div class="file__upload">
                                                                    <a class="button button--iconed button--simple button--gray" :href="taxRegistrationCertificatePhoto.src" download>
                                                                        <span class="button__icon">
                                                                            <svg class="icon icon--import">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-import"></use>
                                                                            </svg>
                                                                        </span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" data-dropzone-file="" :value="taxRegistrationCertificatePhoto.id">
                                                        <div class="file__error" data-dz-errormessage=""></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
                                        <h6 class="box__heading box__heading--small">Загрузить сведения о банковских реквизитах</h6>
                    
                                        <div class="dropzone" data-uploader>
                                            <input type="file" name="bank_details" multiple class="dropzone__control">
                                        
                                            <div class="dropzone__area" data-uploader-area='{"paramName": "bank_details", "url":"/_markup/gui.php"}'>
                                                <div class="profile__toggle dropzone__message dz-message needsclick">
                                                    <button type="button" class="dropzone__button button button--medium button--rounded button--covered button--red">
                                                        <span class="button__icon">
                                                            <svg class="icon icon--import">
                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-import"></use>
                                                            </svg>
                                                        </span>
                                                        <span class="button__text">Загрузить файл</span>
                                                    </button>
                                                </div>
                                        
                                                <div class="dropzone__previews dz-previews" data-uploader-previews>
                                                    <div v-for="photo in mutableLegalEntity.documents.bank_details" class="file dz-processing dz-image-preview dz-success dz-complete" data-uploader-preview="">
                                                        <div class="file__wrapper">
                                                            <div class="file__prewiew">
                                                                <div class="file__icon">
                                                                    <svg class="icon icon--gallery">
                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-gallery"></use>
                                                                    </svg>
                                                                </div>
                                    
                                                                <div class="file__name">
                                                                    <h6 class="file__name-heading heading heading--tiny" data-uploader-preview-filename="">{{ photo.name }}</h6>
                                                                </div>
                                                            </div>
                                    
                                                            <div class="file__info">
                                                                <div class="file__format" data-uploader-preview-format="">{{ photo.format }}</div>
                                    
                                                                <div class="file__weight" data-uploader-preview-size="">{{ photo.size }}</div>
                                    
                                                                <div class="file__delete" data-dz-remove="">
                                                                    <button type="button" class="file__delete-button button button--iconed button--simple button--gray">
                                                                    <span class="file__delete-button-icon button__icon">
                                                                        <svg class="icon icon--delete">
                                                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-delete"></use>
                                                                        </svg>
                                                                    </span>
                                                                    </button>
                                                                </div>
                                                                
                                                                <div class="file__upload">
                                                                    <a class="button button--iconed button--simple button--gray" :href="photo.src" download>
                                                                        <span class="button__icon">
                                                                            <svg class="icon icon--import">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-import"></use>
                                                                            </svg>
                                                                        </span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" data-dropzone-file="" :value="photo.id">
                                                        <div class="file__error" data-dz-errormessage=""></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                    
                                    <div class="section__box-block">
                                        <h6 class="box__heading box__heading--small">Загрузить копию справки о постановке на учет физического лица в качестве плательщика налога на профессиональный доход</h6>
                    
                                        <div class="dropzone" data-uploader>
                                            <input type="file" name="personal_tax_registration_certificate" multiple class="dropzone__control">
                                        
                                            <div class="dropzone__area" data-uploader-area='{"paramName": "personal_tax_registration_certificate", "url":"/_markup/gui.php"}'>
                                                <div class="profile__toggle dropzone__message dz-message needsclick">
                                                    <button type="button" class="dropzone__button button button--medium button--rounded button--covered button--red">
                                                        <span class="button__icon">
                                                            <svg class="icon icon--import">
                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-import"></use>
                                                            </svg>
                                                        </span>
                                                        <span class="button__text">Загрузить файл</span>
                                                    </button>
                                                </div>
                                        
                                                <div class="dropzone__previews dz-previews" data-uploader-previews>
                                                    <div v-for="photo in mutableLegalEntity.documents.personal_tax_registration_certificate" class="file dz-processing dz-image-preview dz-success dz-complete" data-uploader-preview="">
                                                        <div class="file__wrapper">
                                                            <div class="file__prewiew">
                                                                <div class="file__icon">
                                                                    <svg class="icon icon--gallery">
                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-gallery"></use>
                                                                    </svg>
                                                                </div>
                                    
                                                                <div class="file__name">
                                                                    <h6 class="file__name-heading heading heading--tiny" data-uploader-preview-filename="">{{ photo.name }}</h6>
                                                                </div>
                                                            </div>
                                    
                                                            <div class="file__info">
                                                                <div class="file__format" data-uploader-preview-format="">{{ photo.format }}</div>
                                    
                                                                <div class="file__weight" data-uploader-preview-size="">{{ photo.size }}</div>
                                    
                                                                <div class="file__delete" data-dz-remove="">
                                                                    <button type="button" class="file__delete-button button button--iconed button--simple button--gray">
                                                                    <span class="file__delete-button-icon button__icon">
                                                                        <svg class="icon icon--delete">
                                                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-delete"></use>
                                                                        </svg>
                                                                    </span>
                                                                    </button>
                                                                </div>
                                                                
                                                                <div class="file__upload">
                                                                    <a class="button button--iconed button--simple button--gray" :href="photo.src" download>
                                                                        <span class="button__icon">
                                                                            <svg class="icon icon--import">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-import"></use>
                                                                            </svg>
                                                                        </span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" data-dropzone-file="" :value="photo.id">
                                                        <div class="file__error" data-dz-errormessage=""></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
                                        <h6 class="box__heading box__heading--small">Загрузить копию свидетельства о постановке на учет в налоговом органе</h6>
                    
                                        <div class="dropzone" data-uploader>
                                            <input type="file" name="tax_registration_certificate" multiple class="dropzone__control">
                                        
                                            <div class="dropzone__area" data-uploader-area='{"paramName": "tax_registration_certificate", "url":"/_markup/gui.php"}'>
                                                <div class="profile__toggle dropzone__message dz-message needsclick">
                                                    <button type="button" class="dropzone__button button button--medium button--rounded button--covered button--red">
                                                        <span class="button__icon">
                                                            <svg class="icon icon--import">
                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-import"></use>
                                                            </svg>
                                                        </span>
                                                        <span class="button__text">Загрузить файл</span>
                                                    </button>
                                                </div>
                                        
                                                <div class="dropzone__previews dz-previews" data-uploader-previews>
                                                    <div v-for="photo in mutableLegalEntity.documents.tax_registration_certificate" :key="photo.id" class="file dz-processing dz-image-preview dz-success dz-complete" data-uploader-preview="">
                                                        <div class="file__wrapper">
                                                            <div class="file__prewiew">
                                                                <div class="file__icon">
                                                                    <svg class="icon icon--gallery">
                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-gallery"></use>
                                                                    </svg>
                                                                </div>
                                    
                                                                <div class="file__name">
                                                                    <h6 class="file__name-heading heading heading--tiny" data-uploader-preview-filename="">{{ photo.name }}</h6>
                                                                </div>
                                                            </div>
                                    
                                                            <div class="file__info">
                                                                <div class="file__format" data-uploader-preview-format="">{{ photo.format }}</div>
                                    
                                                                <div class="file__weight" data-uploader-preview-size="">{{ photo.size }}</div>
                                    
                                                                <div class="file__delete" data-dz-remove="">
                                                                    <button type="button" class="file__delete-button button button--iconed button--simple button--gray">
                                                                    <span class="file__delete-button-icon button__icon">
                                                                        <svg class="icon icon--delete">
                                                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-delete"></use>
                                                                        </svg>
                                                                    </span>
                                                                    </button>
                                                                </div>
                                                                
                                                                <div class="file__upload">
                                                                    <a class="button button--iconed button--simple button--gray" :href="photo.src" download>
                                                                        <span class="button__icon">
                                                                            <svg class="icon icon--import">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-import"></use>
                                                                            </svg>
                                                                        </span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" data-dropzone-file="" :value="photo.id">
                                                        <div class="file__error" data-dz-errormessage=""></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                    
                                    <div class="section__box-block">
                                        <h6 class="box__heading box__heading--small">Загрузить копию уведомления о применении УСН успрощенной системы налогоплательщика(в случае применения УСН)</h6>
                    
                                        <div class="dropzone" data-uploader>
                                            <input type="file" name="usn_notification" multiple class="dropzone__control">
                                        
                                            <div class="dropzone__area" data-uploader-area='{"paramName": "usn_notification", "url":"/_markup/gui.php"}'>
                                                <div class="profile__toggle dropzone__message dz-message needsclick">
                                                    <button type="button" class="dropzone__button button button--medium button--rounded button--covered button--red">
                                                        <span class="button__icon">
                                                            <svg class="icon icon--import">
                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-import"></use>
                                                            </svg>
                                                        </span>
                                                        <span class="button__text">Загрузить файл</span>
                                                    </button>
                                                </div>
                                        
                                                <div class="dropzone__previews dz-previews" data-uploader-previews>
                                                    <div v-for="photo in mutableLegalEntity.documents.usn_notification" :key="photo.id" class="file dz-processing dz-image-preview dz-success dz-complete" data-uploader-preview="">
                                                        <div class="file__wrapper">
                                                            <div class="file__prewiew">
                                                                <div class="file__icon">
                                                                    <svg class="icon icon--gallery">
                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-gallery"></use>
                                                                    </svg>
                                                                </div>
                                    
                                                                <div class="file__name">
                                                                    <h6 class="file__name-heading heading heading--tiny" data-uploader-preview-filename="">{{ photo.name }}</h6>
                                                                </div>
                                                            </div>
                                    
                                                            <div class="file__info">
                                                                <div class="file__format" data-uploader-preview-format="">{{ photo.format }}</div>
                                    
                                                                <div class="file__weight" data-uploader-preview-size="">{{ photo.size }}</div>
                                    
                                                                <div class="file__delete" data-dz-remove="">
                                                                    <button type="button" class="file__delete-button button button--iconed button--simple button--gray">
                                                                    <span class="file__delete-button-icon button__icon">
                                                                        <svg class="icon icon--delete">
                                                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-delete"></use>
                                                                        </svg>
                                                                    </span>
                                                                    </button>
                                                                </div>
                                                                
                                                                <div class="file__upload">
                                                                    <a class="button button--iconed button--simple button--gray" :href="photo.src" download>
                                                                        <span class="button__icon">
                                                                            <svg class="icon icon--import">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-import"></use>
                                                                            </svg>
                                                                        </span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" data-dropzone-file="" :value="photo.id">
                                                        <div class="file__error" data-dz-errormessage=""></div>
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
                                        <h6 class="box__heading box__heading--small">Загрузить копию свидетельства о государственной регистрации ИП/листа записи ЕГРИП</h6>
                    
                                        <div class="dropzone" data-uploader>
                                            <input type="file" name="ip_registration_certificate" multiple class="dropzone__control">
                                        
                                            <div class="dropzone__area" data-uploader-area='{"paramName": "ip_registration_certificate", "url":"/_markup/gui.php"}'>
                                                <div class="profile__toggle dropzone__message dz-message needsclick">
                                                    <button type="button" class="dropzone__button button button--medium button--rounded button--covered button--red">
                                                        <span class="button__icon">
                                                            <svg class="icon icon--import">
                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-import"></use>
                                                            </svg>
                                                        </span>
                                                        <span class="button__text">Загрузить файл</span>
                                                    </button>
                                                </div>
                                        
                                                <div class="dropzone__previews dz-previews" data-uploader-previews>
                                                    <div v-for="photo in mutableLegalEntity.documents.ip_registration_certificate" :key="photo.id" class="file dz-processing dz-image-preview dz-success dz-complete" data-uploader-preview="">
                                                        <div class="file__wrapper">
                                                            <div class="file__prewiew">
                                                                <div class="file__icon">
                                                                    <svg class="icon icon--gallery">
                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-gallery"></use>
                                                                    </svg>
                                                                </div>
                                    
                                                                <div class="file__name">
                                                                    <h6 class="file__name-heading heading heading--tiny" data-uploader-preview-filename="">{{ photo.name }}</h6>
                                                                </div>
                                                            </div>
                                    
                                                            <div class="file__info">
                                                                <div class="file__format" data-uploader-preview-format="">{{ photo.format }}</div>
                                    
                                                                <div class="file__weight" data-uploader-preview-size="">{{ photo.size }}</div>
                                    
                                                                <div class="file__delete" data-dz-remove="">
                                                                    <button type="button" class="file__delete-button button button--iconed button--simple button--gray">
                                                                    <span class="file__delete-button-icon button__icon">
                                                                        <svg class="icon icon--delete">
                                                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-delete"></use>
                                                                        </svg>
                                                                    </span>
                                                                    </button>
                                                                </div>
                                                                
                                                                <div class="file__upload">
                                                                    <a class="button button--iconed button--simple button--gray" :href="photo.src" download>
                                                                        <span class="button__icon">
                                                                            <svg class="icon icon--import">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-import"></use>
                                                                            </svg>
                                                                        </span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" data-dropzone-file="" :value="photo.id">
                                                        <div class="file__error" data-dz-errormessage=""></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
                                        <h6 class="box__heading box__heading--small">Загрузить сведения о банковских реквизитах</h6>
                    
                                        <div class="dropzone" data-uploader>
                                            <input type="file" name="bank_details" multiple class="dropzone__control">
                                        
                                            <div class="dropzone__area" data-uploader-area='{"paramName": "bank_details", "url":"/_markup/gui.php"}'>
                                                <div class="profile__toggle dropzone__message dz-message needsclick">
                                                    <button type="button" class="dropzone__button button button--medium button--rounded button--covered button--red">
                                                        <span class="button__icon">
                                                            <svg class="icon icon--import">
                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-import"></use>
                                                            </svg>
                                                        </span>
                                                        <span class="button__text">Загрузить файл</span>
                                                    </button>
                                                </div>
                                        
                                                <div class="dropzone__previews dz-previews" data-uploader-previews>
                                                    <div v-for="photo in mutableLegalEntity.documents.bank_details" :key="photo.id" class="file dz-processing dz-image-preview dz-success dz-complete" data-uploader-preview="">
                                                        <div class="file__wrapper">
                                                            <div class="file__prewiew">
                                                                <div class="file__icon">
                                                                    <svg class="icon icon--gallery">
                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-gallery"></use>
                                                                    </svg>
                                                                </div>
                                    
                                                                <div class="file__name">
                                                                    <h6 class="file__name-heading heading heading--tiny" data-uploader-preview-filename="">{{ photo.name }}</h6>
                                                                </div>
                                                            </div>
                                    
                                                            <div class="file__info">
                                                                <div class="file__format" data-uploader-preview-format="">{{ photo.format }}</div>
                                    
                                                                <div class="file__weight" data-uploader-preview-size="">{{ photo.size }}</div>
                                    
                                                                <div class="file__delete" data-dz-remove="">
                                                                    <button type="button" class="file__delete-button button button--iconed button--simple button--gray">
                                                                    <span class="file__delete-button-icon button__icon">
                                                                        <svg class="icon icon--delete">
                                                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-delete"></use>
                                                                        </svg>
                                                                    </span>
                                                                    </button>
                                                                </div>
                                                                
                                                                <div class="file__upload">
                                                                    <a class="button button--iconed button--simple button--gray" :href="photo.src" download>
                                                                        <span class="button__icon">
                                                                            <svg class="icon icon--import">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-import"></use>
                                                                            </svg>
                                                                        </span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" data-dropzone-file="" :value="photo.id">
                                                        <div class="file__error" data-dz-errormessage=""></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
                                        <h6 class="box__heading box__heading--small">Загрузить копию свидетельства о постановке на учет российской организации в налоговом органе</h6>
                    
                                        <div class="dropzone" data-uploader>
                                            <input type="file" name="tax_registration_certificate" multiple class="dropzone__control">
                                        
                                            <div class="dropzone__area" data-uploader-area='{"paramName": "tax_registration_certificate", "url":"/_markup/gui.php"}'>
                                                <div class="profile__toggle dropzone__message dz-message needsclick">
                                                    <button type="button" class="dropzone__button button button--medium button--rounded button--covered button--red">
                                                        <span class="button__icon">
                                                            <svg class="icon icon--import">
                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-import"></use>
                                                            </svg>
                                                        </span>
                                                        <span class="button__text">Загрузить файл</span>
                                                    </button>
                                                </div>
                                        
                                                <div class="dropzone__previews dz-previews" data-uploader-previews>
                                                    <div v-for="photo in mutableLegalEntity.documents.tax_registration_certificate" :key="photo.id" class="file dz-processing dz-image-preview dz-success dz-complete" data-uploader-preview="">
                                                        <div class="file__wrapper">
                                                            <div class="file__prewiew">
                                                                <div class="file__icon">
                                                                    <svg class="icon icon--gallery">
                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-gallery"></use>
                                                                    </svg>
                                                                </div>
                                    
                                                                <div class="file__name">
                                                                    <h6 class="file__name-heading heading heading--tiny" data-uploader-preview-filename="">{{ photo.name }}</h6>
                                                                </div>
                                                            </div>
                                    
                                                            <div class="file__info">
                                                                <div class="file__format" data-uploader-preview-format="">{{ photo.format }}</div>
                                    
                                                                <div class="file__weight" data-uploader-preview-size="">{{ photo.size }}</div>
                                    
                                                                <div class="file__delete" data-dz-remove="">
                                                                    <button type="button" class="file__delete-button button button--iconed button--simple button--gray">
                                                                    <span class="file__delete-button-icon button__icon">
                                                                        <svg class="icon icon--delete">
                                                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-delete"></use>
                                                                        </svg>
                                                                    </span>
                                                                    </button>
                                                                </div>
                                                                
                                                                <div class="file__upload">
                                                                    <a class="button button--iconed button--simple button--gray" :href="photo.src" download>
                                                                        <span class="button__icon">
                                                                            <svg class="icon icon--import">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-import"></use>
                                                                            </svg>
                                                                        </span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" data-dropzone-file="" :value="photo.id">
                                                        <div class="file__error" data-dz-errormessage=""></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                    
                                    <div class="section__box-block">
                                        <h6 class="box__heading box__heading--small">Загрузить копию уведомления о применении УСН успрощенной системы налогоплательщика(в случае применения УСН)</h6>
                    
                                        <div class="dropzone" data-uploader>
                                            <input type="file" name="usn_notification" multiple class="dropzone__control">
                                        
                                            <div class="dropzone__area" data-uploader-area='{"paramName": "usn_notification", "url":"/_markup/gui.php"}'>
                                                <div class="profile__toggle dropzone__message dz-message needsclick">
                                                    <button type="button" class="dropzone__button button button--medium button--rounded button--covered button--red">
                                                        <span class="button__icon">
                                                            <svg class="icon icon--import">
                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-import"></use>
                                                            </svg>
                                                        </span>
                                                        <span class="button__text">Загрузить файл</span>
                                                    </button>
                                                </div>
                                        
                                                <div class="dropzone__previews dz-previews" data-uploader-previews>
                                                    <div v-for="photo in mutableLegalEntity.documents.usn_notification" :key="photo.id" class="file dz-processing dz-image-preview dz-success dz-complete" data-uploader-preview="">
                                                        <div class="file__wrapper">
                                                            <div class="file__prewiew">
                                                                <div class="file__icon">
                                                                    <svg class="icon icon--gallery">
                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-gallery"></use>
                                                                    </svg>
                                                                </div>
                                    
                                                                <div class="file__name">
                                                                    <h6 class="file__name-heading heading heading--tiny" data-uploader-preview-filename="">{{ photo.name }}</h6>
                                                                </div>
                                                            </div>
                                    
                                                            <div class="file__info">
                                                                <div class="file__format" data-uploader-preview-format="">{{ photo.format }}</div>
                                    
                                                                <div class="file__weight" data-uploader-preview-size="">{{ photo.size }}</div>
                                    
                                                                <div class="file__delete" data-dz-remove="">
                                                                    <button type="button" class="file__delete-button button button--iconed button--simple button--gray">
                                                                    <span class="file__delete-button-icon button__icon">
                                                                        <svg class="icon icon--delete">
                                                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-delete"></use>
                                                                        </svg>
                                                                    </span>
                                                                    </button>
                                                                </div>
                                                                
                                                                <div class="file__upload">
                                                                    <a class="button button--iconed button--simple button--gray" :href="photo.src" download>
                                                                        <span class="button__icon">
                                                                            <svg class="icon icon--import">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-import"></use>
                                                                            </svg>
                                                                        </span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" data-dropzone-file="" :value="photo.id">
                                                        <div class="file__error" data-dz-errormessage=""></div>
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
                                        <h6 class="box__heading box__heading--small">Загрузить копию устава ООО</h6>
                    
                                        <div class="dropzone" data-uploader>
                                            <input type="file" name="llc_charter" multiple class="dropzone__control">
                                        
                                            <div class="dropzone__area" data-uploader-area='{"paramName": "llc_charter", "url":"/_markup/gui.php"}'>
                                                <div class="profile__toggle dropzone__message dz-message needsclick">
                                                    <button type="button" class="dropzone__button button button--medium button--rounded button--covered button--red">
                                                        <span class="button__icon">
                                                            <svg class="icon icon--import">
                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-import"></use>
                                                            </svg>
                                                        </span>
                                                        <span class="button__text">Загрузить файл</span>
                                                    </button>
                                                </div>
                                        
                                                <div class="dropzone__previews dz-previews" data-uploader-previews>
                                                    <div v-for="photo in mutableLegalEntity.documents.llc_charter" :key="photo.id" class="file dz-processing dz-image-preview dz-success dz-complete" data-uploader-preview="">
                                                        <div class="file__wrapper">
                                                            <div class="file__prewiew">
                                                                <div class="file__icon">
                                                                    <svg class="icon icon--gallery">
                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-gallery"></use>
                                                                    </svg>
                                                                </div>
                                    
                                                                <div class="file__name">
                                                                    <h6 class="file__name-heading heading heading--tiny" data-uploader-preview-filename="">{{ photo.name }}</h6>
                                                                </div>
                                                            </div>
                                    
                                                            <div class="file__info">
                                                                <div class="file__format" data-uploader-preview-format="">{{ photo.format }}</div>
                                    
                                                                <div class="file__weight" data-uploader-preview-size="">{{ photo.size }}</div>
                                    
                                                                <div class="file__delete" data-dz-remove="">
                                                                    <button type="button" class="file__delete-button button button--iconed button--simple button--gray">
                                                                    <span class="file__delete-button-icon button__icon">
                                                                        <svg class="icon icon--delete">
                                                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-delete"></use>
                                                                        </svg>
                                                                    </span>
                                                                    </button>
                                                                </div>
                                                                
                                                                <div class="file__upload">
                                                                    <a class="button button--iconed button--simple button--gray" :href="photo.src" download>
                                                                        <span class="button__icon">
                                                                            <svg class="icon icon--import">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-import"></use>
                                                                            </svg>
                                                                        </span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" data-dropzone-file="" :value="photo.id">
                                                        <div class="file__error" data-dz-errormessage=""></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                    
                                    <div class="section__box-block">
                                        <h6 class="box__heading box__heading--small">Загрузить копию протокола участников (решения участника) ООО об избрании руководителя организации</h6>
                    
                                        <div class="dropzone" data-uploader>
                                            <input type="file" name="llc_members" multiple class="dropzone__control">
                                        
                                            <div class="dropzone__area" data-uploader-area='{"paramName": "llc_members", "url":"/_markup/gui.php"}'>
                                                <div class="profile__toggle dropzone__message dz-message needsclick">
                                                    <button type="button" class="dropzone__button button button--medium button--rounded button--covered button--red">
                                                        <span class="button__icon">
                                                            <svg class="icon icon--import">
                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-import"></use>
                                                            </svg>
                                                        </span>
                                                        <span class="button__text">Загрузить файл</span>
                                                    </button>
                                                </div>
                                        
                                                <div class="dropzone__previews dz-previews" data-uploader-previews>
                                                    <div v-for="photo in mutableLegalEntity.documents.llc_members" :key="photo.id" class="file dz-processing dz-image-preview dz-success dz-complete" data-uploader-preview="">
                                                        <div class="file__wrapper">
                                                            <div class="file__prewiew">
                                                                <div class="file__icon">
                                                                    <svg class="icon icon--gallery">
                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-gallery"></use>
                                                                    </svg>
                                                                </div>
                                    
                                                                <div class="file__name">
                                                                    <h6 class="file__name-heading heading heading--tiny" data-uploader-preview-filename="">{{ photo.name }}</h6>
                                                                </div>
                                                            </div>
                                    
                                                            <div class="file__info">
                                                                <div class="file__format" data-uploader-preview-format="">{{ photo.format }}</div>
                                    
                                                                <div class="file__weight" data-uploader-preview-size="">{{ photo.size }}</div>
                                    
                                                                <div class="file__delete" data-dz-remove="">
                                                                    <button type="button" class="file__delete-button button button--iconed button--simple button--gray">
                                                                    <span class="file__delete-button-icon button__icon">
                                                                        <svg class="icon icon--delete">
                                                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-delete"></use>
                                                                        </svg>
                                                                    </span>
                                                                    </button>
                                                                </div>
                                                                
                                                                <div class="file__upload">
                                                                    <a class="button button--iconed button--simple button--gray" :href="photo.src" download>
                                                                        <span class="button__icon">
                                                                            <svg class="icon icon--import">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-import"></use>
                                                                            </svg>
                                                                        </span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" data-dropzone-file="" :value="photo.id">
                                                        <div class="file__error" data-dz-errormessage=""></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                    
                                    <div class="section__box-block">
                                        <h6 class="box__heading box__heading--small">Загрузить копию приказа о вступлнеии в должность генерального директора</h6>
                    
                                        <div class="dropzone" data-uploader>
                                            <input type="file" name="ceo_appointment" multiple class="dropzone__control">
                                        
                                            <div class="dropzone__area" data-uploader-area='{"paramName": "ceo_appointment", "url":"/_markup/gui.php"}'>
                                                <div class="profile__toggle dropzone__message dz-message needsclick">
                                                    <button type="button" class="dropzone__button button button--medium button--rounded button--covered button--red">
                                                        <span class="button__icon">
                                                            <svg class="icon icon--import">
                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-import"></use>
                                                            </svg>
                                                        </span>
                                                        <span class="button__text">Загрузить файл</span>
                                                    </button>
                                                </div>
                                        
                                                <div class="dropzone__previews dz-previews" data-uploader-previews>
                                                    <div v-for="photo in mutableLegalEntity.documents.ceo_appointment" :key="photo.id" class="file dz-processing dz-image-preview dz-success dz-complete" data-uploader-preview="">
                                                        <div class="file__wrapper">
                                                            <div class="file__prewiew">
                                                                <div class="file__icon">
                                                                    <svg class="icon icon--gallery">
                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-gallery"></use>
                                                                    </svg>
                                                                </div>
                                    
                                                                <div class="file__name">
                                                                    <h6 class="file__name-heading heading heading--tiny" data-uploader-preview-filename="">{{ photo.name }}</h6>
                                                                </div>
                                                            </div>
                                    
                                                            <div class="file__info">
                                                                <div class="file__format" data-uploader-preview-format="">{{ photo.format }}</div>
                                    
                                                                <div class="file__weight" data-uploader-preview-size="">{{ photo.size }}</div>
                                    
                                                                <div class="file__delete" data-dz-remove="">
                                                                    <button type="button" class="file__delete-button button button--iconed button--simple button--gray">
                                                                    <span class="file__delete-button-icon button__icon">
                                                                        <svg class="icon icon--delete">
                                                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-delete"></use>
                                                                        </svg>
                                                                    </span>
                                                                    </button>
                                                                </div>
                                                                
                                                                <div class="file__upload">
                                                                    <a class="button button--iconed button--simple button--gray" :href="photo.src" download>
                                                                        <span class="button__icon">
                                                                            <svg class="icon icon--import">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-import"></use>
                                                                            </svg>
                                                                        </span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" data-dropzone-file="" :value="photo.id">
                                                        <div class="file__error" data-dz-errormessage=""></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                    
                                    <div class="section__box-block">
                                        <h6 class="box__heading box__heading--small">Загрузить копию свидетельства о государственной регистрации ООО/листа записи ЕГРЮЛ о внесении записи об ООО в ЕГРЮЛ</h6>
                    
                                        <div class="dropzone" data-uploader>
                                            <input type="file" name="llc_registration_certificate" multiple class="dropzone__control">
                                        
                                            <div class="dropzone__area" data-uploader-area='{"paramName": "llc_registration_certificate", "url":"/_markup/gui.php"}'>
                                                <div class="profile__toggle dropzone__message dz-message needsclick">
                                                    <button type="button" class="dropzone__button button button--medium button--rounded button--covered button--red">
                                                        <span class="button__icon">
                                                            <svg class="icon icon--import">
                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-import"></use>
                                                            </svg>
                                                        </span>
                                                        <span class="button__text">Загрузить файл</span>
                                                    </button>
                                                </div>
                                        
                                                <div class="dropzone__previews dz-previews" data-uploader-previews>
                                                    <div v-for="photo in mutableLegalEntity.documents.llc_registration_certificate" :key="photo.id" class="file dz-processing dz-image-preview dz-success dz-complete" data-uploader-preview="">
                                                        <div class="file__wrapper">
                                                            <div class="file__prewiew">
                                                                <div class="file__icon">
                                                                    <svg class="icon icon--gallery">
                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-gallery"></use>
                                                                    </svg>
                                                                </div>
                                    
                                                                <div class="file__name">
                                                                    <h6 class="file__name-heading heading heading--tiny" data-uploader-preview-filename="">{{ photo.name }}</h6>
                                                                </div>
                                                            </div>
                                    
                                                            <div class="file__info">
                                                                <div class="file__format" data-uploader-preview-format="">{{ photo.format }}</div>
                                    
                                                                <div class="file__weight" data-uploader-preview-size="">{{ photo.size }}</div>
                                    
                                                                <div class="file__delete" data-dz-remove="">
                                                                    <button type="button" class="file__delete-button button button--iconed button--simple button--gray">
                                                                    <span class="file__delete-button-icon button__icon">
                                                                        <svg class="icon icon--delete">
                                                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-delete"></use>
                                                                        </svg>
                                                                    </span>
                                                                    </button>
                                                                </div>
                                                                
                                                                <div class="file__upload">
                                                                    <a class="button button--iconed button--simple button--gray" :href="photo.src" download>
                                                                        <span class="button__icon">
                                                                            <svg class="icon icon--import">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-import"></use>
                                                                            </svg>
                                                                        </span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" data-dropzone-file="" :value="photo.id">
                                                        <div class="file__error" data-dz-errormessage=""></div>
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
                                        <h6 class="box__heading box__heading--small">Загрузить копию доверенности на представителя (в случае подписания представителем-не руководителем ООО)</h6>
                    
                                        <div class="dropzone" data-uploader>
                                            <input type="file" name="procuration" multiple class="dropzone__control">
                                        
                                            <div class="dropzone__area" data-uploader-area='{"paramName": "procuration", "url":"/_markup/gui.php"}'>
                                                <div class="profile__toggle dropzone__message dz-message needsclick">
                                                    <button type="button" class="dropzone__button button button--medium button--rounded button--covered button--red">
                                                        <span class="button__icon">
                                                            <svg class="icon icon--import">
                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-import"></use>
                                                            </svg>
                                                        </span>
                                                        <span class="button__text">Загрузить файл</span>
                                                    </button>
                                                </div>
                                        
                                                <div class="dropzone__previews dz-previews" data-uploader-previews>
                                                    <div v-for="photo in mutableLegalEntity.documents.procuration" :key="photo.id" class="file dz-processing dz-image-preview dz-success dz-complete" data-uploader-preview="">
                                                        <div class="file__wrapper">
                                                            <div class="file__prewiew">
                                                                <div class="file__icon">
                                                                    <svg class="icon icon--gallery">
                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-gallery"></use>
                                                                    </svg>
                                                                </div>
                                    
                                                                <div class="file__name">
                                                                    <h6 class="file__name-heading heading heading--tiny" data-uploader-preview-filename="">{{ photo.name }}</h6>
                                                                </div>
                                                            </div>
                                    
                                                            <div class="file__info">
                                                                <div class="file__format" data-uploader-preview-format="">{{ photo.format }}</div>
                                    
                                                                <div class="file__weight" data-uploader-preview-size="">{{ photo.size }}</div>
                                    
                                                                <div class="file__delete" data-dz-remove="">
                                                                    <button type="button" class="file__delete-button button button--iconed button--simple button--gray">
                                                                    <span class="file__delete-button-icon button__icon">
                                                                        <svg class="icon icon--delete">
                                                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-delete"></use>
                                                                        </svg>
                                                                    </span>
                                                                    </button>
                                                                </div>
                                                                
                                                                <div class="file__upload">
                                                                    <a class="button button--iconed button--simple button--gray" :href="photo.src" download>
                                                                        <span class="button__icon">
                                                                            <svg class="icon icon--import">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-import"></use>
                                                                            </svg>
                                                                        </span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" data-dropzone-file="" :value="photo.id">
                                                        <div class="file__error" data-dz-errormessage=""></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
                                        <h6 class="box__heading box__heading--small">Загрузить сведения о банковских реквизитах</h6>
                    
                                        <div class="dropzone" data-uploader>
                                            <input type="file" name="bank_details" multiple class="dropzone__control">
                                        
                                            <div class="dropzone__area" data-uploader-area='{"paramName": "bank_details", "url":"/_markup/gui.php"}'>
                                                <div class="profile__toggle dropzone__message dz-message needsclick">
                                                    <button type="button" class="dropzone__button button button--medium button--rounded button--covered button--red">
                                                        <span class="button__icon">
                                                            <svg class="icon icon--import">
                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-import"></use>
                                                            </svg>
                                                        </span>
                                                        <span class="button__text">Загрузить файл</span>
                                                    </button>
                                                </div>
                                        
                                                <div class="dropzone__previews dz-previews" data-uploader-previews>
                                                    <div v-for="photo in mutableLegalEntity.documents.procuration" :key="photo.id" class="file dz-processing dz-image-preview dz-success dz-complete" data-uploader-preview="">
                                                        <div class="file__wrapper">
                                                            <div class="file__prewiew">
                                                                <div class="file__icon">
                                                                    <svg class="icon icon--gallery">
                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-gallery"></use>
                                                                    </svg>
                                                                </div>
                                    
                                                                <div class="file__name">
                                                                    <h6 class="file__name-heading heading heading--tiny" data-uploader-preview-filename="">{{ photo.name }}</h6>
                                                                </div>
                                                            </div>
                                    
                                                            <div class="file__info">
                                                                <div class="file__format" data-uploader-preview-format="">{{ photo.format }}</div>
                                    
                                                                <div class="file__weight" data-uploader-preview-size="">{{ photo.size }}</div>
                                    
                                                                <div class="file__delete" data-dz-remove="">
                                                                    <button type="button" class="file__delete-button button button--iconed button--simple button--gray">
                                                                    <span class="file__delete-button-icon button__icon">
                                                                        <svg class="icon icon--delete">
                                                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-delete"></use>
                                                                        </svg>
                                                                    </span>
                                                                    </button>
                                                                </div>
                                                                
                                                                <div class="file__upload">
                                                                    <a class="button button--iconed button--simple button--gray" :href="photo.src" download>
                                                                        <span class="button__icon">
                                                                            <svg class="icon icon--import">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-import"></use>
                                                                            </svg>
                                                                        </span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" data-dropzone-file="" :value="photo.id">
                                                        <div class="file__error" data-dz-errormessage=""></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
                                    <button type="button" class="button button--rounded button--covered button--white-green button--full" @click="cancelEditing">
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
    `,
};
import { usePersonalDataStore } from '../../../stores/personalDataStore';

export const LegalEntity = {
    data() {
        return {
            mutableUserInfo: {},
            editing: false,
        };
    },

    props: {
        userInfo: {
            type: Object,
            default: {},
        },
        genders: {
            type: Object,
            required: true,
        },
        cities: {
            type: Object,
            required: true,
        },
        pickupPoints: {
            type: Object,
            required: true,
        },
    },

    setup() {
        return { personalDataStore: usePersonalDataStore() };
    },

    created() {
        console.log(this.userInfo, this.genders, this.cities, this.pickupPoints);
        this.initUserInfo();
    },

    mounted() {
        window.dropzone();
        window.initSelect(); // TODO Do anything with it
        window.inputMaskInit();
    },

    methods: {
        initUserInfo() {
            this.mutableUserInfo = JSON.parse(JSON.stringify(this.userInfo));
        },
        cancelEditing() {
            this.editing = false;
            this.initUserInfo();
        },
        saveUserInfo() {
            // TODO validate

            this.mutableUserInfo.photo_id = $('input[type=file][name=photo]').parent().find('input[type=hidden]').val();
            this.mutableUserInfo.gender = $('#gender').val();
            this.mutableUserInfo.city = $('#city').val();
            this.mutableUserInfo.pickup_point = $('#pickup_point').val();

            this.personalDataStore.savePersonalData(this.mutableUserInfo);
            this.cancelEditing();
        },
    },

    template: `
        <div class="profile__block" data-accordeon data-profile-block>
            <section class="section">
                <form class="form form--wraped form--separated" action="" method="post" data-profile-form data-validation="profile">
                    <div class="section__box box box--gray box--rounded-sm">
                        <div class="profile__accordeon-header accordeon__header section__header">
                            <h4 class="section__title section__title--closer">Юридические данные</h4>

                            <div class="profile__actions">
                                <button type="button" class="profile__actions-button profile__actions-button--edit button button--simple button--red" data-profile-edit>
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
                                                                    <option value="russian">Резидент РФ</option>
                                                                    <option value="not_russian">Незезидент РФ</option>
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
                                                                v-model="mutableLegalEntity.passport_series"
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
                                                                v-model="mutableLegalEntity.passport_number"
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
                                                                v-model="mutableLegalEntity.who_got"
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
                                                                v-model="mutableLegalEntity.getting_date"
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
                                                                v-model="mutableLegalEntity.register_locality"
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
                                                                v-model="mutableLegalEntity.register_street"
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
                                                                v-model="mutableLegalEntity.register_house"
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
                                                                v-model="mutableLegalEntity.register_apartment"
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
                                                                v-model="mutableLegalEntity.register_postal_code"
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
                                                                    v-model="mutableLegalEntity.living_locality"
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
                                                                    v-model="mutableLegalEntity.living_street"
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
                                                                    v-model="mutableLegalEntity.living_house"
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
                                                                    v-model="mutableLegalEntity.living_apartment"
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
                                                                    v-model="mutableLegalEntity.living_postal_code"
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
                                                            v-model="mutableLegalEntity.without_living"                                                            
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
                                                    <div class="file dz-processing dz-image-preview dz-success" data-uploader-preview="">
                                                        <div class="file__wrapper">
                                                            <div class="file__prewiew">
                                                                <div class="file__icon">
                                                                    <svg class="icon icon--gallery">
                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-gallery"></use>
                                                                    </svg>
                                                                </div>

                                                                <div class="file__name">
                                                                    <h6 class="file__name-heading heading heading--tiny" data-uploader-preview-filename="">Profile...ob</h6>
                                                                </div>
                                                            </div>

                                                            <div v-for="passportPhoto in mutableLegalEntity.passport" class="file__info">
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
                                                                    <a class="button button--iconed button--simple button--gray" href="#" download>
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
                            
                            <div v-if="mutableLegalEntity.type.code === 'STATUS_SELF_EMPLOYED'" class="section__box-inner legal_entity self_employed">
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
                                                                v-model="mutableLegalEntity.tin"
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
                                                <div class="dropzone__message dz-message needsclick">
                                                    <div class="dropzone__message-caption needsclick">
                                                        <h6 class="dropzone__message-title">Ограничения:</h6>
                                                        <ul class="dropzone__message-list">
                                                            <li class="dropzone__message-item">до 10 файлов</li>
                                                            <li class="dropzone__message-item">вес каждого файла не более 5 МБ</li>
                                                            <li class="dropzone__message-item">форматы файлов: PDF, JPG, JPEG, PNG, HEIC</li>
                                                        </ul>
                                                    </div>
                                        
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
                                                    <div v-for="taxRegistrationCertificatePhoto in mutableLegalEntity.tax_registration_certificate" class="file dz-processing dz-image-preview dz-success dz-complete" data-uploader-preview="">
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
                                                                v-model="mutableLegalEntity.bank_name"
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
                                                                v-model="mutableLegalEntity.bic"
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
                                                                v-model="mutableLegalEntity.bic"
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
                                                                v-model="mutableLegalEntity.correspondent_account"
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
                                                <div class="dropzone__message dz-message needsclick">
                                                    <div class="dropzone__message-caption needsclick">
                                                        <h6 class="dropzone__message-title">Ограничения:</h6>
                                                        <ul class="dropzone__message-list">
                                                            <li class="dropzone__message-item">до 10 файлов</li>
                                                            <li class="dropzone__message-item">вес каждого файла не более 5 МБ</li>
                                                            <li class="dropzone__message-item">форматы файлов: PDF, JPG, JPEG, PNG, HEIC</li>
                                                        </ul>
                                                    </div>
                                        
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
                                                    <div v-for="photo in mutableLegalEntity.bank_details" class="file dz-processing dz-image-preview dz-success dz-complete" data-uploader-preview="">
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
                                                <div class="dropzone__message dz-message needsclick">
                                                    <div class="dropzone__message-caption needsclick">
                                                        <h6 class="dropzone__message-title">Ограничения:</h6>
                                                        <ul class="dropzone__message-list">
                                                            <li class="dropzone__message-item">до 10 файлов</li>
                                                            <li class="dropzone__message-item">вес каждого файла не более 5 МБ</li>
                                                            <li class="dropzone__message-item">форматы файлов: PDF, JPG, JPEG, PNG, HEIC</li>
                                                        </ul>
                                                    </div>
                                        
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
                                                    <div v-for="photo in mutableLegalEntity.personal_tax_registration_certificate" class="file dz-processing dz-image-preview dz-success dz-complete" data-uploader-preview="">
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
                                                        name="correctness_confirmation_self_employed"
                                                        id="correctness_confirmation_self_employed"
                                                        :readonly="!editing"
                                                        v-model="mutableLegalEntity.correctness_confirmation_self_employed"
                                                    >
                    
                                                    <label for="correctness_confirmation_self_employed" class="checkbox__label">
                                                        <span class="checkbox__icon">
                                                            <svg class="checkbox__icon-pic icon icon--check">
                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check">
                                                            </svg>
                                                        </span>
                    
                                                        <span class="checkbox__text">Я подтверждаю правильность введенных данных и подлинность загруженных документов</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="profile__toggle profile__toggle--inline section__actions">
                                <div class="section__actions-col">
                                    <button type="button" class="button button--rounded button--covered button--white-green button--full" data-profile-form-cancel>
                                        <span class="button__text">Отменить изменения</span>
                                    </button>
                                </div>

                                <div class="section__actions-col">
                                    <button type="submit" class="button button--rounded button--covered button--green button--full">
                                        <span class="button__text">Сохранить изменения</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    `,
};
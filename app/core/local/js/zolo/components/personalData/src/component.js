import { usePersonalDataStore } from '../../../stores/personalDataStore';

export const PersonalData = {
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
        <div class="profile__block" data-accordeon :class="{ 'profile__block--edit': editing }">
            <section class="section">
                <form class="form form--wraped form--separated" action="" method="post" data-profile-form data-validation="profile">
                    <div class="section__box box box--gray box--rounded-sm">
                        <div class="profile__accordeon-header accordeon__header section__header">
                            <h4 class="section__title section__title--closer">Персональные данные</h4>
                            <div class="profile__actions">
                                <button type="button" class="profile__actions-button profile__actions-button--edit button button--simple button--red" @click="editing = true">
                                    <span class="button__icon">
                                        <svg class="icon icon--edit">
                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-edit"></use>
                                        </svg>
                                    </span>
                                    <span class="button__text">Редактировать</span>
                                </button>

                                <button type="button" class="profile__actions-button profile__actions-button--toggle accordeon__toggle button button--circular button--mini button--covered button--red-white" data-accordeon-toggle >
                                    <span class="accordeon__toggle-icon button__icon">
                                        <svg class="icon icon--arrow-down">
                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-down"></use>
                                        </svg>
                                    </span>
                                </button>
                            </div>
                        </div>

                        <div class="profile__accordeon-body accordeon__body accordeon__body--closer" data-accordeon-content>
                            <div class="profile__actions profile__actions--mobile">
                                <button type="button" class="profile__actions-button button button--simple button--red">
                                    <span class="button__icon">
                                        <svg class="icon icon--edit">
                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-edit"></use>
                                        </svg>
                                    </span>
                                    <span class="button__text">Редактировать</span>
                                </button>
                            </div>

                            <div class="section__wrapper">
                                <div class="profile__avatar">
                                    <div class="profile__avatar-box">
                                        <div class="profile__avatar-image">
                                            <img :src="mutableUserInfo.photo" alt="Персональное фото" class="profile__avatar-image-pic">
                                        </div>
                                    </div>

                                    <div class="profile__dropzone dropzone dropzone--image dropzone--simple" data-uploader>
                                        <input type="file" name="photo" multiple class="dropzone__control js-required">
                                        <div class="dropzone__area" data-uploader-area='{"paramName": "photo", "url":"/_markup/gui.php", "images": true, "single": true}'>
                                            <div class="dropzone__message dropzone__message--simple dz-message needsclick">
                                                <div class="dropzone__message-button dz-button link needsclick" data-uploader-previews>
                                                    <svg class="dropzone__message-button-icon icon icon--camera">
                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-camera"></use>
                                                    </svg>
                                                </div>

                                                <div class="profile__toggle">
                                                    <button type="button" class="dropzone__button button button--medium button--rounded button--outlined button--green">
                                                        <span class="button__icon">
                                                            <svg class="icon icon--import">
                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-import"></use>
                                                            </svg>
                                                        </span>
                                                        <span class="button__text">Загрузить фото</span>
                                                    </button>
                                                </div>

                                                <div class="profile__toggle dropzone__message-caption needsclick">
                                                    <h6 class="dropzone__message-title">Требования к фото:</h6>
                                                    <ul class="dropzone__message-list">
                                                        <li class="dropzone__message-item">формат jpg, jpeg, png, heic</li>
                                                        <li class="dropzone__message-item">размер 240 Х 320 px</li>
                                                        <li class="dropzone__message-item">вес не более 1МБ</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="profile__info">
                                        <span class="profile__level">Уровень {{ mutableUserInfo.loyalty_level }}</span>
                                        <span class="profile__id">ID {{ mutableUserInfo.id }}</span>
                                    </div>
                                </div>

                                <div class="section__box-inner section__box-inner--full">
                                    <div class="section__box-content section__box-content--collapsed box box--white box--rounded-sm box--inner" data-identic data-validate-dependent>
                                        <div class="form__row form__row--special">
                                            <div class="form__col">
                                                <div class="form__field">
                                                    <div class="form__field-block form__field-block--label">
                                                        <label for="last_name" class="profile__label form__label form__label--required">
                                                            <span class="form__label-text">Фамилия</span>
                                                        </label>
                                                    </div>

                                                    <div class="form__field-block form__field-block--input">
                                                        <div class="input">
                                                            <input
                                                                type="text"
                                                                class="input__control js-required"
                                                                name="last_name"
                                                                id="last_name"
                                                                placeholder="Введите фамилию"
                                                                :readonly="!editing"
                                                                v-model="mutableUserInfo.last_name"
                                                            >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form__col">
                                                <div class="form__field">
                                                    <div class="form__field-block form__field-block--label">
                                                        <label for="first_name" class="profile__label form__label form__label--required">
                                                            <span class="form__label-text">Имя</span>
                                                        </label>
                                                    </div>

                                                    <div class="form__field-block form__field-block--input">
                                                        <div class="input">
                                                            <input
                                                                type="text"
                                                                class="input__control js-required" 
                                                                name="first_name"
                                                                id="first_name"
                                                                placeholder="Введите имя"
                                                                :readonly="!editing"
                                                                v-model="mutableUserInfo.first_name" 
                                                            >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form__col">
                                                <div class="form__field">
                                                    <div class="form__field-block form__field-block--label">
                                                        <label for="second_name" class="profile__label form__label form__label--required">
                                                            <span class="form__label-text">Отчество</span>
                                                        </label>
                                                    </div>

                                                    <div class="form__field-block form__field-block--input">
                                                        <div class="input">
                                                            <input 
                                                                type="text" 
                                                                class="input__control js-required-dependent" 
                                                                name="second_name" 
                                                                id="second_name" 
                                                                placeholder="Введите отчество" 
                                                                :readonly="!editing" 
                                                                data-identic-input
                                                                v-model="mutableUserInfo.second_name" 
                                                            >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- TODO: определиться с реализацией -->
                                        <div class="profile__toggle form__row form__row--centered">
                                            <div class="form__col">
                                                <div class="form__field">
                                                    <div class="checkbox">
                                                        <input 
                                                            type="checkbox" 
                                                            class="checkbox__input" 
                                                            name="without_second_name" 
                                                            id="without_second_name" 
                                                            data-identic-change 
                                                            data-validate-dependent-change
                                                            v-model="mutableUserInfo.without_second_name"
                                                            :checked="mutableUserInfo.without_second_name" 
                                                        >
    
                                                        <label for="without_second_name" class="checkbox__label">
                                                            <span class="checkbox__icon">
                                                                <svg class="checkbox__icon-pic icon icon--check">
                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check"></use>
                                                                </svg>
                                                            </span>
    
                                                            <span class="checkbox__text">У меня нет отчества</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form__row">
                                            <div class="form__col">
                                                <div class="form__field">
                                                    <div class="form__field-block form__field-block--label">
                                                        <label for="gender" class="profile__label form__label form__label--required">
                                                            <span class="form__label-text">Пол</span>
                                                        </label>
                                                    </div>
    
                                                    <div class="form__field-block form__field-block--input">
                                                        <div class="form__control">
                                                            <div class="profile__toggle-select select select--mitigate" data-select>
                                                                <select class="select__control js-required" name="gender" id="gender" data-select-control data-placeholder="Выберите пол">
                                                                    <option><!-- пустой option для placeholder --></option>
                                                                    <option 
                                                                        v-for="(gender, genderCode) in genders" 
                                                                        :key="genderCode"
                                                                        :value="genderCode" 
                                                                        :selected="genderCode === mutableUserInfo.gender"
                                                                    >{{ gender }}</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form__col">
                                                <div class="form__field">
                                                    <div class="form__field-block form__field-block--label">
                                                        <label for="birthdate" class="profile__label form__label form__label--required">
                                                            <span class="form__label-text">Дата рождения</span>
                                                        </label>
                                                    </div>

                                                    <div class="form__field-block form__field-block--input">
                                                        <div class="input input--iconed">
                                                            <input 
                                                                inputmode="numeric"
                                                                class="input__control js-required js-date"
                                                                name="birthdate"
                                                                id="birthdate"
                                                                placeholder="ДД.ММ.ГГГГ"
                                                                data-mask-date 
                                                                data-inputmask-alias="datetime"
                                                                data-inputmask-inputformat="dd.mm.yyyy"
                                                                :readonly="!editing"
                                                                v-model="mutableUserInfo.birthdate"
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

                                        <div class="form__row">
                                            <div class="form__col">
                                                <div class="form__field">
                                                    <div class="form__field-block form__field-block--label">
                                                        <label for="email" class="profile__label form__label form__label--required">
                                                            <span class="form__label-text">E-mail</span>
                                                        </label>
                                                    </div>

                                                    <div class="form__field-block form__field-block--input">
                                                        <div class="input">
                                                            <input 
                                                                type="text" 
                                                                class="input__control js-required js-email" 
                                                                name="email" 
                                                                id="email" 
                                                                placeholder="example@email.com" 
                                                                data-mail 
                                                                inputmode="email"  
                                                                :readonly="!editing"
                                                                v-model="mutableUserInfo.email" 
                                                            >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form__col">
                                                <div class="form__field">
                                                    <div class="form__field-block form__field-block--label">
                                                        <label for="phone" class="profile__label form__label form__label--required">
                                                            <span class="form__label-text">Телефон</span>
                                                        </label>
                                                    </div>

                                                    <div class="form__field-block form__field-block--input">
                                                        <div class="input">
                                                            <input 
                                                                type="tel" 
                                                                class="input__control js-required" 
                                                                name="phone" 
                                                                id="phone" 
                                                                placeholder="+7 (___) ___-__-__" 
                                                                data-phone 
                                                                inputmode="text"  
                                                                :readonly="!editing"
                                                                v-model="mutableUserInfo.phone" 
                                                            >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- TODO: определить реализацию -->
                                        <div class="form__row">
                                            <div class="form__col">
                                                <div class="form__field">
                                                    <div class="form__field-block form__field-block--label">
                                                        <label for="city" class="profile__label form__label form__label--required">
                                                            <span class="form__label-text">Населенный пункт</span>
                                                        </label>
                                                    </div>
    
                                                    <div class="form__field-block form__field-block--input">
                                                        <div class="form__control">
                                                            <div class="profile__toggle-select select select--mitigate" data-select>
                                                                <select class="select__control js-required" name="city" id="city" data-select-control data-placeholder="Выберите город">
                                                                    <option><!-- пустой option для placeholder --></option>
                                                                    <option
                                                                        v-for="city in cities"
                                                                        :key="city.name" 
                                                                        :value="city.name"
                                                                        :selected="city.name === mutableUserInfo.city"
                                                                    >{{ city.name }}</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form__col">
                                                <div class="form__field">
                                                    <div class="form__field-block form__field-block--label">
                                                        <label for="pickup_point" class="profile__label form__label form__label--required">
                                                            <span class="form__label-text">Пункт выдачи заказов</span>
                                                        </label>
                                                    </div>
    
                                                    <div class="form__field-block form__field-block--input">
                                                        <div class="form__control">
                                                            <div class="profile__toggle-select select select--mitigate" data-select>
                                                                <select class="select__control js-required" name="pickup_point" id="pickup_point" data-select-control data-placeholder="Выберите пункт выдачи">
                                                                    <option><!-- пустой option для placeholder --></option>
                                                                    <option
                                                                        v-for="(pickupPoint, pickupPointId) in pickupPoints"
                                                                        :key="pickupPointId"
                                                                        :value="pickupPointId" 
                                                                        :selected="pickupPointId === mutableUserInfo.pickup_point_id"
                                                                        class="form-control__option"
                                                                    >{{ pickupPoint }}</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="profile__toggle profile__toggle--inline form__row">
                                            <div class="form__col">
                                                <div class="form__field">
                                                    <div class="form__field-block form__field-block--label">
                                                        <label for="password" class="form__label form__label--required">
                                                            <span class="form__label-text">Пароль</span>
                                                        </label>
                                                    </div>
            
                                                    <div class="form__field-block form__field-block--input" data-password-block>
                                                        <div class="input input--iconed">
                                                            <input 
                                                                type="password" 
                                                                class="input__control js-required" 
                                                                name="password" 
                                                                id="password" 
                                                                placeholder="Введите пароль" 
                                                                data-password-input
                                                                v-model="mutableUserInfo.password"
                                                            >
                                                            <span class="input__icon input__icon-password" data-password-toggle>
                                                                <svg class="input__icon-password-icon input__icon-password-icon--show icon icon--eye">
                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-eye"></use>
                                                                </svg>
                                                                <svg class="input__icon-password-icon input__icon-password-icon--hidden icon icon--eye-off">
                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-eye-off"></use>
                                                                </svg>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
            
            
                                            <div class="form__col">
                                                <div class="form__field">
                                                    <div class="form__field-block form__field-block--label">
                                                        <label for="confirm_password" class="form__label form__label--required">
                                                            <span class="form__label-text">Подтвердить пароль</span>
                                                        </label>
                                                    </div>
            
                                                    <div class="form__field-block form__field-block--input" data-password-block>
                                                        <div class="input input--iconed">
                                                            <input 
                                                                type="password" 
                                                                class="input__control js-required" 
                                                                name="confirm_password" 
                                                                id="confirm_password" 
                                                                placeholder="Введите пароль" 
                                                                data-password-input
                                                                v-model="mutableUserInfo.confirm_password"
                                                            >
                                                            <span class="input__icon input__icon-password" data-password-toggle>
                                                                <svg class="input__icon-password-icon input__icon-password-icon--show icon icon--eye">
                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-eye"></use>
                                                                </svg>
                                                                <svg class="input__icon-password-icon input__icon-password-icon--hidden icon icon--eye-off">
                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-eye-off"></use>
                                                                </svg>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="profile__toggle profile__requirement requirement requirement--inlined box box--gray box--circle">
                                            <div class="requirement__col">
                                                <p class="requirement__text">Требования к паролю:</p>
                                            </div>
            
                                            <div class="requirement__col requirement__col--right">
                                                <ul class="requirement__list">
                                                    <li class="requirement__item">
                                                        Использование только латинских букв, символов и цифр
                                                    </li>
                                                    <li class="requirement__item">
                                                        Не менее 8 символов
                                                    </li>
                                                    <li class="requirement__item">
                                                        Не менее одной заглавной буквы
                                                    </li>
                                                    <li class="requirement__item">
                                                        Не менее одной строчной буквы
                                                    </li>
                                                </ul>
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
                                    <button type="button" class="button button--rounded button--covered button--green button--full" @click="saveUserInfo">
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
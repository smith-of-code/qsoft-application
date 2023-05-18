import { usePersonalDataStore } from '../../../stores/personalDataStore';
import { Select } from "../../gui/select/src/component";

export const PersonalData = {
    components: { Select },

    data() {
        return {
            mutableUserInfo: {},
            editing: false,
            onceEdited: false,
            phoneError: false,
            emailError: false,
            passwordError: false,
            phoneVerified: false,
            emailVerified: false,
            verifyError: false,
            confirmationType: false,
            copyInProgress:false
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
        refLink:{
            type: String,
            default: null
        }
    },

    computed: {
        canSave() {
            return JSON.stringify(this.userInfo) !== JSON.stringify(this.mutableUserInfo);
        },
        userCity() {
            return Object.values(this.cities).find(city => city.name === this.mutableUserInfo.city);
        },
        validatePassword() {
            switch (true) {
                case this.mutableUserInfo.password !== this.mutableUserInfo.confirm_password:
                case this.mutableUserInfo.password.length < 8:
                case this.mutableUserInfo.password.match(/[А-я]+/i):
                case this.mutableUserInfo.password.toUpperCase() === this.mutableUserInfo.password:
                case this.mutableUserInfo.password.toLowerCase() === this.mutableUserInfo.password:
                    return false;
            }
            return true;
        },
    },

    setup() {
        return { personalDataStore: usePersonalDataStore() };
    },

    created() {
        this.initUserInfo();
    },

    mounted() {
        $('input[type=file][name=photo]').on('change', () => {
            this.mutableUserInfo.photo_id = $('input[type=file][name=photo]').parent().find('input[type=hidden]').val();
        });
    },

    methods: {
        copyLink(){
            this.copyInProgress = true
            navigator.clipboard.writeText(location.origin + this.refLink)
            setTimeout(()=>{
                this.copyInProgress = false
            },5000)

        },
        initUserInfo() {
            this.mutableUserInfo = JSON.parse(JSON.stringify(this.userInfo));
        },
        cancelEditing() {
            this.editing = false;
            this.initUserInfo();
        },
        saveUserInfo() {
            this.passwordError = false;
            this.phoneError = false;
            this.emailError = false;
            let error = false;

            this.mutableUserInfo = {
                ...this.mutableUserInfo,
                last_name: this.mutableUserInfo.last_name.replaceAll(/[^a-zA-Zа-яА-ЯёЁ-]+/gu, '').slice(0, 100),
                first_name: this.mutableUserInfo.first_name.replaceAll(/[^a-zA-Zа-яА-ЯёЁ-]+/gu, '').slice(0, 100),
                second_name: this.mutableUserInfo.second_name.replaceAll(/[^a-zA-Zа-яА-ЯёЁ-]+/gu, '').slice(0, 100)
            }

            if (this.userInfo.phone !== this.mutableUserInfo.phone.replaceAll(/\(|\)|\s|-+/g, '') && this.phoneVerified !== this.mutableUserInfo.phone) {
                error = true;
                this.phoneError = true;
            }
            if (this.userInfo.email !== this.mutableUserInfo.email && this.emailVerified !== this.mutableUserInfo.email) {
                error = true;
                this.emailError = true;
            }
            if ((this.mutableUserInfo.password || this.mutableUserInfo.confirm_password) && !this.validatePassword) {
                error = true;
                this.passwordError = true;
            }

            if (error) {
                return;
            }

            this.mutableUserInfo.photo_id = $('input[type=file][name=photo]').parent().find('input[type=hidden]').val();

            this.personalDataStore.savePersonalData({
                ...this.mutableUserInfo,
                phone: this.mutableUserInfo.phone.replaceAll(/\(|\)|\s|-+/g, ''),
            });
            this.editing = false;

            this.initUserInfo();
            $.fancybox.open({ src: '#thanks' });
        },
        async sendCode(value, type) {
            try {
                const response = await this.personalDataStore.sendCode(value, type);

                if (!response.data || response.data.status === 'error') {
                    throw new Error(response.data.message);
                }
                this.confirmationType = type;
            } catch (e) {
                this.phoneError = e.message ? e.message : true;
                return;
            }


            $.fancybox.open({ src: '#approve-number' });
        },
        async verifyCode() {
            try {
                const codeInput = $('input[name=verify_code]');

                const response = await this.personalDataStore.verifyCode(codeInput.val(), this.confirmationType);

                if (!response.data || response.data.status === 'error') {
                    throw new Error();
                } else {
                    if (this.confirmationType === 'phone') {
                        this.phoneError = false;
                        this.phoneVerified = this.mutableUserInfo.phone;
                    } else if (this.confirmationType === 'email') {
                        this.emailError = false;
                        this.emailVerified = this.mutableUserInfo.email;
                    }
                }
                codeInput.val('');
            } catch (e) {
                this.verifyError = true;
                return;
            }

            this.verifyError = false;
            this.confirmationType = false;
            $.fancybox.close({ src: '#approve-number' });
        },
    },

    template: `
        <div class="profile__block accordeon__item" data-accordeon :class="{ 'profile__block--edit': editing, 'accordeon__item--opened': onceEdited }">
            <section class="section">
                <form class="form form--wraped form--separated" action="" method="post" data-profile-form data-validation="profile">
                    <div class="section__box box box--gray box--rounded-sm">
                        <div class="profile__accordeon-header accordeon__header section__header">
                            <h4 class="section__title section__title--closer">Персональные данные</h4>
                            <div class="profile__actions">
                                <button v-show="!editing" type="button" class="profile__actions-button profile__actions-button--edit profile__actions-button--edit-personal button button--simple button--red" @click="editing = true, onceEdited = true">
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
                                <button v-if="!editing" type="button" class="profile__actions-button button button--simple button--red" @click="editing = true">
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
                                            <img v-if="mutableUserInfo.photo" :src="mutableUserInfo.photo" alt="Персональное фото" class="profile__avatar-image-pic">
                                            <svg v-else class="dropzone__message-button-icon icon icon--camera">
                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-camera"></use>
                                            </svg>
                                        </div>
                                    </div>

                                    <div class="profile__dropzone dropzone dropzone--image dropzone--simple" data-uploader>
                                        <input type="file" name="photo" class="dropzone__control js-required">
                                        <div class="dropzone__area">
                                            <div class="dropzone__message dropzone__message--simple dz-message needsclick">
                                                <div class="dropzone__message-button dz-button link needsclick" data-uploader-previews>
                                                    <img v-if="mutableUserInfo.photo" :src="mutableUserInfo.photo" alt="Персональное фото" class="profile__avatar-image-pic">
                                                    <svg v-else class="dropzone__message-button-icon icon icon--camera">
                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-camera"></use>
                                                    </svg>
                                                </div>

                                                <div class="profile__toggle">
                                                    <button type="button" class="dropzone__button button button--medium button--rounded button--outlined button--green" data-uploader-area='{"paramName": "photo", "url":"/_markup/gui.php", "images": true, "single": true, "acceptedFiles": ".jpg, .jpeg, .png" ,"maxFiles": "1", "maxFileSize": "3" }'>
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
                                                        <li class="dropzone__message-item">формат jpg, jpeg, png</li>
                                                        <li class="dropzone__message-item">размер 720 Х 1280 px</li>
                                                        <li class="dropzone__message-item">вес не более 3МБ</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="profile__info">
                                        <span v-if="mutableUserInfo.is_consultant" class="profile__level">
                                            Уровень {{ mutableUserInfo.loyalty_level }}
                                        </span>
                                        <span class="profile__id">ID {{ mutableUserInfo.id }}</span>
                                        <button type="button" class="logout__button button button--rounded button--outlined button--red" data-logout="">
                                            <span class="button__icon">
                                                <svg class="icon icon--basket">
                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-logout"></use>
                                                </svg>
                                            </span>
                                            <span class="button__text">Выйти из профиля</span>
                                        </button>
                                        </div>
                                </div>

                                <div class="section__box-inner section__box-inner--full">
                                    <div class="section__box-content section__box-content--collapsed box box--white box--rounded-sm box--inner" data-identic data-validate-dependent>
                                    <div class="section__box-block">
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
                                                                data-replace-input="fullName"
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
                                                                data-replace-input="fullName"
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
                                                                data-replace-input="fullName"
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
                                                                <Select
                                                                    name="gender"
                                                                    :options="genders"
                                                                    placeholder="Выберите пол"
                                                                    :selected="mutableUserInfo.gender"
                                                                    @custom-change="(value) => { mutableUserInfo.gender = value }"
                                                                />
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
                                                                data-mask-date-reg
                                                                :readonly="!editing"
                                                                v-model="mutableUserInfo.birthdate"
                                                                autocomplete="new-password"
                                                            >
                                                            <span class="input__control-error--mask"></span>
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
                                                                :class="{ 'input__control--error': emailError }"
                                                                :readonly="!editing"
                                                                v-model="mutableUserInfo.email" 
                                                            >
                                                            
                                                            <span v-if="typeof emailError === 'string'" class="input__control-error">
                                                                {{ emailError }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                    
                                                    <button
                                                        v-if="editing && mutableUserInfo.email.indexOf('_') === -1 && userInfo.email !== mutableUserInfo.email && emailVerified !== mutableUserInfo.email"
                                                        type="button"
                                                        class="form__field-button button button--simple button--red button--underlined button--tiny"
                                                        data-src="#approve-number"
                                                        @click="sendCode(mutableUserInfo.email, 'email')"
                                                        :style="{ color: emailError ? 'red' : 'black' }"
                                                    >
                                                        Подтвердить
                                                    </button>
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
                                                                :class="{ 'input__control--error': phoneError }"
                                                                :readonly="!editing"
                                                                v-model="mutableUserInfo.phone"
                                                            >
                                                            
                                                            <span v-if="typeof phoneError === 'string'" class="input__control-error">
                                                                {{ phoneError }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                    
                                                    <button
                                                        v-if="editing && mutableUserInfo.phone.indexOf('_') === -1 && userInfo.phone !== mutableUserInfo.phone.replaceAll(/\\(|\\)|\\s|-+/g, '') && phoneVerified !== mutableUserInfo.phone"
                                                        type="button"
                                                        class="form__field-button button button--simple button--red button--underlined button--tiny"
                                                        data-src="#approve-number"
                                                        @click="sendCode(mutableUserInfo.phone.replaceAll(/\\(|\\)|\\s|-+/g, ''), 'phone')"
                                                        :style="{ color: phoneError ? 'red' : 'black' }"
                                                    >
                                                        Подтвердить
                                                    </button>
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
                                                                <Select
                                                                    name="city"
                                                                    :options="cities"
                                                                    placeholder="Выберите город"
                                                                    :selected="userCity.id"
                                                                    @custom-change="(value) => { mutableUserInfo.city = cities[value].name }"
                                                                />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form__col">
                                                <div class="form__field">
                                                    <div class="form__field-block form__field-block--label">
                                                        <label for="pickup_point_id" class="profile__label form__label form__label--required">
                                                            <span class="form__label-text">Пункт выдачи заказов</span>
                                                        </label>
                                                    </div>
    
                                                    <div class="form__field-block form__field-block--input">
                                                        <div class="form__control">
                                                            <div class="profile__toggle-select select select--mitigate" data-select>
                                                                <Select
                                                                    name="pickup_point_id"
                                                                    :options="pickupPoints[userCity.id] ?? {}"
                                                                    placeholder="Пункт выдачи заказов"
                                                                    :selected="mutableUserInfo.pickup_point_id"
                                                                    @custom-change="(value) => { mutableUserInfo.pickup_point_id = value }"
                                                                />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="profile__toggle profile__toggle--row profile__toggle--inline form__row">
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
                                                                :class="{ 'input__control--error': passwordError && !validatePassword }"
                                                                v-model="mutableUserInfo.password"
                                                                autocomplete="new-password"
                                                            >
                                                            <button class="input__icon input__icon-password" data-password-toggle>
                                                                <svg class="input__icon-password-icon input__icon-password-icon--show icon icon--eye">
                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-eye"></use>
                                                                </svg>
                                                                <svg class="input__icon-password-icon input__icon-password-icon--hidden icon icon--eye-off">
                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-eye-off"></use>
                                                                </svg>
                                                            </button>
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
                                                                :class="{ 'input__control--error': passwordError && !validatePassword }"
                                                                v-model="mutableUserInfo.confirm_password"
                                                                autocomplete="off"
                                                            >
                                                            <button class="input__icon input__icon-password" data-password-toggle>
                                                                <svg class="input__icon-password-icon input__icon-password-icon--show icon icon--eye">
                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-eye"></use>
                                                                </svg>
                                                                <svg class="input__icon-password-icon input__icon-password-icon--hidden icon icon--eye-off">
                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-eye-off"></use>
                                                                </svg>
                                                            </button>
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
                            </div>

                            <div class="profile__toggle profile__toggle--inline section__actions">
                                <div class="section__actions-col">
                                    <button type="button" class="button button--rounded button--mixed button--red button--full" @click="cancelEditing">
                                        <span class="button__text">Отменить изменения</span>
                                    </button>
                                </div>

                                <div class="section__actions-col">
                                    <button type="button" class="profile__button-personal button button--rounded button--covered button--green button--full" :class="{ 'button--disabled': !canSave }" :disabled="canSave ? false : true" @click="saveUserInfo">
                                        <span class="button__text">Сохранить изменения</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </section>

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
            
            <article id="approve-number" class="modal modal--small modal--centered box box--circle box--hanging" style="display: none">
                <div class="modal__content">
                    <header class="modal__section modal__section--header">
                        <p v-if="this.confirmationType == 'phone'" class="heading heading--small heading--centered">
                        Подтверждение номера
                        </p>
                        <p v-else class="heading heading--small heading--centered">
                        Подтверждение адреса электронной почты
                        </p>
                    </header>
            
                    <section class="modal__section modal__section--content">
                        <div v-if="this.confirmationType == 'phone'">
                            <p class="modal__section-text">На указанный номер телефона отправлен код подтверждения.</p>
                            <p class="modal__section-text">Пожалуйста, введите его в окно ниже</p>
                        </div>
                        <div v-else>
                            <p class="modal__section-text">На указанный адрес электронной почты отправлен код подтверждения.</p>
                            <p class="modal__section-text">Пожалуйста, введите его в окно ниже</p>
                        </div>
            
                        <div class="form__row">
                            <div class="form__col">
                                <div class="form__field">
                                    <div class="form__field-block form__field-block--input">
                                        <div class="input input--tiny input--centered input--tel">
                                            <input
                                                type="text"
                                                maxlength="6"
                                                class="input__control"
                                                name="verify_code"
                                                id="verify_code"
                                                :class="{ 'input__control--error': verifyError }"
                                            >
                                        
                                            <span v-if="verifyError" class="input__control-error">Неверный или просроченный код</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
            
                        <button class="button button--rounded button--covered button--red button--full" style="margin-top: 25px;" @click="verifyCode">
                            <span class="button__text">Далее</span>
                        </button>
                    </section>
                </div>
            </article>
        </div>
    `,
};
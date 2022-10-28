import { usePetStore } from '../../../stores/petStore';

export const Pets = {
    data() {
        return {
            mutablePets: [],
        };
    },

    props: {
        pets: {
            type: Object,
            default: {},
        },
        genders: {
            type: Object,
            required: true,
        },
        breeds: {
            type: Object,
            required: true,
        },
        kinds: {
            type: Object,
            required: true,
        },
    },

    setup() {
        return { petStore: usePetStore() };
    },

    created() {
        this.mutablePets = Object.values(this.pets);
    },

    mounted() {
        window.initSelect(); // TODO Do anything with it
        window.inputMaskInit();
    },

    methods: {
        addPet() {
            this.mutablePets.push({ id: `new-${Date.now()}`, editing: true });
            window.initSelect(); // TODO Do anything with it
            window.inputMaskInit();
        },
        deletePet(pet) {
            if (pet.id.indexOf('new') === -1) {
                this.petStore.deletePet(pet.id);
            }

            this.mutablePets.splice(this.mutablePets.indexOf(pet), 1);
        },
        checkPetAvailable(pet) {
            return pet.name && pet.kind && pet.breed && pet.birthdate && pet.gender;
        },
        cancelEditing(pet) {
            if (pet.id.indexOf('new') !== -1) {
                this.deletePet(pet);
            } else {
                this.mutablePets[this.mutablePets.indexOf(pet)] = this.pets[pet.id];
            }
        },
        savePet(pet) {
            pet.kind = this.kinds[$(`#kind-${pet.id}`).val()];
            pet.breed = this.breeds[pet.kind.code][$(`#breed-${pet.id}`).val()];
            pet.gender = this.genders[$(`#gender-${pet.id}`).val()];

            pet.editing = false;

            if (pet.id.indexOf('new') === -1) {
                pet.id = this.petStore.changePet(pet).data.id;
            } else {
                this.petStore.addPet(pet);
            }
        },
    },

    template: `
        <div class="profile__block" data-accordeon>
            <div class="section__box box box--gray box--rounded">
                <div class="profile__accordeon-header accordeon__header section__header">
                    <h4 class="section__title section__title--closer">Данные о питомцах</h4>

                    <div class="profile__actions">
                        <button type="button" class="profile__actions-button profile__actions-button--toggle accordeon__toggle button button--circular button--mini button--covered button--red-white" data-accordeon-toggle>
                            <span class="accordeon__toggle-icon button__icon">
                                <svg class="icon icon--arrow-down">
                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-down"></use>
                                </svg>
                            </span>
                        </button>
                    </div>
                </div>

                <div class="profile__accordeon-body accordeon__body accordeon__body--closer" data-accordeon-content>
                    <div class="pet-cards">
                        <ul class="pet-cards__list" data-pets-list>
                            <li v-for="pet in mutablePets" :key="pet.id" class="pet-cards__item">
                                <article class="pet-card" :class="{ 'pet-card--editing': pet.editing }" data-pets-card>
                                    <div class="pet-card__main box box--circle" data-pets-main>
                                        <div class="pet-card__content">
                                            <div class="pet-card__avatar" data-pets-type>
                                                <svg class="icon icon--dog">
                                                    <use :xlink:href="'/local/templates/.default/images/icons/sprite.svg#icon-' + pet.kind?.code.toLowerCase().substring(5)"></use>
                                                </svg>
                                            </div>

                                            <div class="pet-card__info">
                                                <div class="pet-card__name" data-pets-name>
                                                    {{ pet.name }}
                                                </div>

                                                <div class="pet-card__breed" data-pets-breed>
                                                    {{ pet.breed.name }}
                                                </div>

                                                <div class="pet-card__info-record">
                                                    <div class="pet-card__gender" data-pets-gender>
                                                        <svg class="icon icon--man">
                                                            <use :xlink:href="'/local/templates/.default/images/icons/sprite.svg#icon-' + (pet.gender?.code.indexOf('FEMALE') !== -1 ? 'woman' : 'man')"></use>
                                                        </svg>
                                                    </div>

                                                    <div class="pet-card__date" data-pets-date>
                                                        {{ pet.birthdate }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="pet-card__actions">
                                            <div class="pet-card__modify">
                                                <button type="button" class="pet-card__actions-button button button--iconed button--simple button--red" data-tippy-content="Редактировать" @click="pet.editing = true">
                                                    <span class="button__icon">
                                                        <svg class="icon icon--edit">
                                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-edit"></use>
                                                        </svg>
                                                    </span>
                                                </button>
                                            </div>

                                            <div class="pet-card__delete">
                                                <button type="button" class="pet-card__actions-button button button--iconed button--simple button--red" data-tippy-content="Удалить" @click="deletePet(pet)">
                                                    <span class="button__icon">
                                                        <svg class="icon icon--trash">
                                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-trash"></use>
                                                        </svg>
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="pet-card__edit box box--rounded-sm" data-pets-edit>
                                        <form class="form" action="" method="post" data-pets-form>
                                            <div class="pet-card__row form__row">
                                                <div class="pet-card__col pet-card__col--1-3 pet-card__col--3 form__col">
                                                    <div class="form__field">
                                                        <div class="form__field-block form__field-block--label">
                                                            <label for="UF_KIND" class="form__label">
                                                                <span class="form__label-text">Тип питомца</span>
                                                            </label>
                                                        </div>

                                                        <div class="form__field-block form__field-block--input">
                                                            <div class="form__control">
                                                                <div class="select select--mitigate select--iconed" data-select>
                                                                    <select class="select__control" name="UF_KIND" :id="'kind-' + pet.id" data-select-control data-placeholder="Выбрать">
                                                                        <option><!-- пустой option для placeholder --></option>
                                                                        <option
                                                                            v-for="(kind, kindId) in kinds"
                                                                            :key="kindId"
                                                                            :value="kindId"
                                                                            :data-option-icon="kind.code.toLowerCase().substring(5)"
                                                                            :selected="kind.code === pet.kind?.code"
                                                                        >
                                                                            {{ kind.name }}
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="pet-card__col pet-card__col--1-3 form__col">
                                                    <div class="form__field">
                                                        <div class="form__field-block form__field-block--label">
                                                            <label for="UF_GENDER" class="form__label">
                                                                <span class="form__label-text">Пол</span>
                                                            </label>
                                                        </div>

                                                        <div class="form__field-block form__field-block--input">
                                                            <div class="form__control">
                                                                <div class="select select--mitigate" data-select>
                                                                    <select class="select__control" name="UF_GENDER" :id="'gender-' + pet.id" data-select-control data-placeholder="Выбрать">
                                                                        <option><!-- пустой option для placeholder --></option>
                                                                        <option
                                                                            v-for="(gender, genderId) in genders"
                                                                            :key="genderId"
                                                                            :value="genderId"
                                                                            :selected="gender.code === pet.gender?.code"
                                                                        >
                                                                            {{ gender.name }}
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="pet-card__col pet-card__col--1-3 form__col">
                                                    <div class="form__field">
                                                        <div class="form__field-block form__field-block--label">
                                                            <label for="UF_BIRTHDATE" class="form__label">
                                                                <span class="form__label-text">Дата рождения</span>
                                                            </label>
                                                        </div>

                                                        <div class="form__field-block form__field-block--input">
                                                           <div class="input input--iconed">
                                                                <input
                                                                    inputmode="numeric"
                                                                    class="input__control"
                                                                    name="UF_BIRTHDATE"
                                                                    placeholder="ДД.ММ.ГГГГ"
                                                                    data-mask-date
                                                                    data-inputmask-alias="datetime"
                                                                    data-inputmask-inputformat="dd.mm.yyyy"
                                                                    :id="'birthdate-' + pet.id"
                                                                    v-model="pet.birthdate"
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

                                                <div class="pet-card__col pet-card__col--1-2 pet-card__col--1 form__col">
                                                    <div class="form__field">
                                                        <div class="form__field-block form__field-block--label">
                                                            <label for="UF_BREED" class="form__label">
                                                                <span class="form__label-text">Порода</span>
                                                            </label>
                                                        </div>

                                                        <div class="form__field-block form__field-block--input">
                                                            <div class="form__control">
                                                                <div class="select select--mitigate" data-select>
                                                                    <select class="select__control" name="UF_BREED" :id="'breed-' + pet.id" data-select-control data-placeholder="Выбрать">
                                                                        <option><!-- пустой option для placeholder --></option>
                                                                        <option
                                                                            v-for="(breed, breedId) in breeds[pet.kind?.code]"
                                                                            :key="breedId"
                                                                            :value="breedId"
                                                                            :selected="breed.id === pet.breed.id"
                                                                        >
                                                                            {{ breed.name }}
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="pet-card__col pet-card__col--1-2 pet-card__col--2 form__col">
                                                    <div class="form__field">
                                                        <div class="form__field-block form__field-block--label">
                                                            <label for="UF_NAME" class="form__label">
                                                                <span class="form__label-text">Кличка</span>
                                                            </label>
                                                        </div>
                                                
                                                        <div class="form__field-block form__field-block--input">
                                                            <div class="input">
                                                                <input
                                                                    type="text"
                                                                    class="input__control"
                                                                    name="UF_NAME"
                                                                    id="text19"
                                                                    placeholder="Выбрать"
                                                                    data-pets-name-input
                                                                    v-model="pet.name"
                                                                >
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="pet-card__buttons">
                                                <button type="submit" class="pet-card__button button button--rounded button--covered button--green button--full" :class="{ 'button--disabled': !checkPetAvailable(pet) }" :disabled="!checkPetAvailable(pet)" @click="savePet(pet)">
                                                    Сохранить изменения
                                                </button>
                                            
                                                <button type="button" class="pet-card__button button button--rounded button--mixed button--red button--full" @click="cancelEditing(pet)">
                                                    Отменить изменения
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </article>
                            </li>
                        </ul>

                        <div class="pet-cards__adding">
                            <button type="button" class="button button--rounded button--covered button--white-green button--full" @click="addPet">
                                <span class="button__icon button__icon--medium">
                                    <svg class="icon icon--add-circle">
                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-add-circle"></use>
                                    </svg>
                                </span>
                                <span class="button__text">Добавить питомца</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `,
};
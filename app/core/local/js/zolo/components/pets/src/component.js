import { usePetStore } from '../../../stores/petStore';
import { Select } from "../../gui/select/src/component";
import { DateInput } from "../../gui/dateInput/src/component";

export const Pets = {
    components: { Select, DateInput },

    data() {
        return {
            originalPets: {},
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
        this.originalPets = JSON.parse(JSON.stringify(this.pets));
        this.mutablePets = JSON.parse(JSON.stringify(Object.values(this.pets)));
    },

    methods: {
        addPet() {
            this.mutablePets.push({ id: `new-${Date.now()}`, editing: true });
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
        cancelEditing(pet, petKey) {
            if (pet.id.indexOf('new') !== -1) {
                this.deletePet(pet);
            } else {
                this.mutablePets[petKey] = JSON.parse(JSON.stringify(this.originalPets[pet.id]));
            }
        },
        async savePet(pet) {
            if (pet.id.indexOf('new') === -1) {
                await this.petStore.changePet(pet);
                pet.editing = false;
            } else {
                const response = await this.petStore.addPet(pet);
                pet.id = `${response.data.id}`;
                pet.editing = false;
                this.originalPets[pet.id] = JSON.parse(JSON.stringify(pet));
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
                            <li v-for="(pet, petKey) in mutablePets" :key="pet.id" class="pet-cards__item">
                                <article class="pet-card" :class="{ 'pet-card--editing': pet.editing }" data-pets-card>
                                    <div class="pet-card__main box box--circle" data-pets-main>
                                        <div class="pet-card__content">
                                            <div class="pet-card__avatar" data-pets-type>
                                                <svg class="icon" :class="'icon--' + pet.kind?.code.toLowerCase().substring(5)">
                                                    <use :xlink:href="'/local/templates/.default/images/icons/sprite.svg#icon-' + pet.kind?.code.toLowerCase().substring(5)"></use>
                                                </svg>
                                            </div>

                                            <div class="pet-card__info">
                                                <div class="pet-card__name" data-pets-name>
                                                    {{ pet.name }}
                                                </div>

                                                <div class="pet-card__breed" data-pets-breed>
                                                    {{ pet.breed?.name }}
                                                </div>

                                                <div class="pet-card__info-record">
                                                    <div class="pet-card__gender" data-pets-gender>
                                                        <svg class="icon" :class="'icon--' + (pet.gender?.code.indexOf('FEMALE') !== -1 ? 'woman' : 'man')">
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
                                                                <Select
                                                                    :name="UF_KIND"
                                                                    :options="kinds"
                                                                    :selected="pet.kind?.id"
                                                                    :iconed="true"
                                                                    @custom-change="(value) => { pet.kind = kinds[value]; pet.breed = null }"
                                                                />
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
                                                                <Select
                                                                    :name="UF_GENDER"
                                                                    :options="genders"
                                                                    :selected="pet.gender?.id"
                                                                    @custom-change="(value) => { pet.gender = genders[value] }"
                                                                />
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
                                                           <DateInput
                                                               :name="UF_BIRTHDATE"
                                                               :value="pet.birthdate"
                                                               @custom-change="(value) => { pet.birthdate = value }"
                                                           />
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
                                                                <Select
                                                                    :name="UF_BREED"
                                                                    :options="breeds[pet.kind?.code] ?? {}"
                                                                    :selected="pet.breed?.id"
                                                                    @custom-change="(value) => { pet.breed = breeds[pet.kind.code][value] }"
                                                                />
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
                                                <button type="button" class="pet-card__button button button--rounded button--covered button--green button--full" :class="{ 'button--disabled': !checkPetAvailable(pet) }" :disabled="!checkPetAvailable(pet)" @click="savePet(pet)">
                                                    Сохранить изменения
                                                </button>
                                            
                                                <button type="button" class="pet-card__button button button--rounded button--mixed button--red button--full" @click="() => cancelEditing(pet, petKey)">
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
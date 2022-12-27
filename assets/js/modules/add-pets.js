import select from './select';
import inputmask from './inputmask';

const ELEMENTS_SELECTOR = {
    card: '[data-pets-card]',
    list: '[data-pets-list]',
    main: '[data-pets-main]',
    edit: '[data-pets-edit]',

    modifyButton: '[data-pets-modify]',
    deleteButton: '[data-pets-delete]',

    type: '[data-pets-type]',
    gender: '[data-pets-gender]',
    date: '[data-pets-date]',
    breed: '[data-pets-breed]',
    name: '[data-pets-name]',

    dateInput: '[data-pets-date-input]',
    breedInput: '[data-pets-breed-input]',
    nameInput: '[data-pets-name-input]',
    genderInput: '[data-pets-gender-input]',
    typeInput: '[data-pets-type-input]',
    changeInput: '[data-pets-change]',

    buttonSave: '[data-pets-save]',
    buttonCancel: '[data-pets-cancel]',
    buttonAdd: '[data-pets-add]',

    petsAdd: '[data-pets-form]',
};

export default function () {
    $(document).on('click', ELEMENTS_SELECTOR.deleteButton, function() {
        $(this).closest(ELEMENTS_SELECTOR.card).parent().remove();
        checkAddButton();
    });

    $(document).on('click', ELEMENTS_SELECTOR.modifyButton, function() {
        $(this).closest(ELEMENTS_SELECTOR.card).addClass('pet-card--editing');

        let card = $(this).closest(ELEMENTS_SELECTOR.card);
        let buttonSave = card.find(ELEMENTS_SELECTOR.buttonSave);

        buttonSave.attr('disabled', true);
        buttonSave.addClass('button--disabled');
    });

    $(document).on('input', ELEMENTS_SELECTOR.changeInput, function() {
        let buttonSave = $(this).closest(ELEMENTS_SELECTOR.card).find(ELEMENTS_SELECTOR.buttonSave);
        buttonSave.removeAttr('disabled');
        buttonSave.removeClass('button--disabled');
    });

    $(document).on('submit', ELEMENTS_SELECTOR.petsAdd, function(e) {
        e.preventDefault();

        let element = $(this).closest(ELEMENTS_SELECTOR.card);

        //имя
        let nameInput = element.find(ELEMENTS_SELECTOR.nameInput).val();
        element.find(ELEMENTS_SELECTOR.name).text(nameInput);

        //дата рождения
        let dateInput = element.find(ELEMENTS_SELECTOR.dateInput).val();
        element.find(ELEMENTS_SELECTOR.date).text(dateInput);

        //порода
        let breedInput = element.find(`${ELEMENTS_SELECTOR.breedInput} option:selected`).text();
        element.find(ELEMENTS_SELECTOR.breed).text(breedInput);

        //пол
        let genderInput = element.find(`${ELEMENTS_SELECTOR.genderInput} option:selected`).text();
        let gender = genderInput.indexOf('Девочка') !== -1 ? 'woman' : 'man';
        element.find(ELEMENTS_SELECTOR.gender).html(`<svg class="icon icon--${gender}">
            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-${gender}"></use>
        </svg>`);

        //тип
        let typeInput = element.find(`${ELEMENTS_SELECTOR.typeInput} option:selected`).data('pets-species');
        let icon = (typeInput == 'dog') ? 'dog' : 'cat';
        element.find(ELEMENTS_SELECTOR.type).html(`<svg class="icon icon--${icon}">
            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-${icon}"></use>
        </svg>`);

        element.removeClass('pet-card--editing');

        element.removeAttr('data-pets-new');
    });

    $(document).on('click', ELEMENTS_SELECTOR.buttonCancel, function() {
        let card = $(this).closest(ELEMENTS_SELECTOR.card);

        if (card.data('pets-new') !== undefined) {
            card.closest('.pet-cards__item').remove();
            checkAddButton();
        } else {
            card.removeClass('pet-card--editing');
        }
    });

    $(document).on('click', ELEMENTS_SELECTOR.buttonAdd, function() { // переписать на отправку формы и сделать валидацию
        let template = $('#hidden-template-pet').text();
        template = template.replaceAll('#ID#', Date.now());
        template = $(template);

        const petKind = template.closest('.pet-cards__item').find('[data-pet-kind]').val();
        template.find(`[data-breed]`).hide();
        if (petKind) {
            template.find(`[data-breed=${petKind}]`).show();
        } else {
            template.find(`[data-breed=empty]`).show();
        }
        $(ELEMENTS_SELECTOR.list).append(template);

        checkAddButton();
        select();
        inputmask();
        validate();
    });

    function checkAddButton() {
        const $button = $(ELEMENTS_SELECTOR.buttonAdd);
        if ($button.closest('.pet-cards').find('.pet-cards__item').length >= 10) {
            $button.attr('disabled', true);
            $button.addClass('button--disabled');
        } else {
            $button.attr('disabled', false);
            $button.removeClass('button--disabled');
        }
    }

    function validate() {
        let forms = $('[data-validation="add-pets"]');
        forms.each((id, elem)=>{
            let rules = {};
            $(elem).find('input, select').each((id, innerElem) => {
                if ($(innerElem).attr('type') === 'hidden' || !$(innerElem).attr('name')) return;
                const name = $(innerElem).attr('name');
                rules[name] = { required: true };
                if (name.indexOf('birthdate') !== -1) {
                    rules[name].validDate = true;
                }
            });
            $(elem).validate({ rules });
        });
    }
    validate();
}

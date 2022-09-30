import select from './select';

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
};

export default function () {
    $(document).on('click', ELEMENTS_SELECTOR.deleteButton, function() {
        $(this).closest(ELEMENTS_SELECTOR.card).remove();
    });

    $(document).on('click', ELEMENTS_SELECTOR.modifyButton, function() {
        $(this).closest(ELEMENTS_SELECTOR.card).addClass('pet-card--editing');

        let card = $(this).closest(ELEMENTS_SELECTOR.card);
        let buttonSave = card.find(ELEMENTS_SELECTOR.buttonSave);

        buttonSave.attr('disabled', true);
        buttonSave.addClass('button--disabled');

        $(document).on('input', ELEMENTS_SELECTOR.changeInput, function() {
            let buttonSave = $(this).closest(ELEMENTS_SELECTOR.card).find(ELEMENTS_SELECTOR.buttonSave);
            buttonSave.removeAttr('disabled');
            buttonSave.removeClass('button--disabled');
        });
    });

    $(document).on('click', ELEMENTS_SELECTOR.buttonSave, function() {
        let element = $(this).closest(ELEMENTS_SELECTOR.card);

        //имя
        let nameInput = $(this).closest(ELEMENTS_SELECTOR.edit).find(ELEMENTS_SELECTOR.nameInput).val();
        element.find(ELEMENTS_SELECTOR.name).text(nameInput);

        //дата рождения
        let dateInput = $(this).closest(ELEMENTS_SELECTOR.edit).find(ELEMENTS_SELECTOR.dateInput).val();
        element.find(ELEMENTS_SELECTOR.date).text(dateInput);

        //порода
        let breedInput = $(this).closest(ELEMENTS_SELECTOR.edit).find(`${ELEMENTS_SELECTOR.breedInput} option:selected`).text();
        element.find(ELEMENTS_SELECTOR.breed).text(breedInput);

        //пол
        let genderInput = $(this).closest(ELEMENTS_SELECTOR.edit).find(`${ELEMENTS_SELECTOR.genderInput} option:selected`).text();
        let gender = (typeInput == 'Девочка') ? 'woman' : 'man';

        element.find(ELEMENTS_SELECTOR.gender).html(`<svg class="icon icon--man">
            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-${gender}"></use>
        </svg>`);

        //тип
        let typeInput = $(this).closest(ELEMENTS_SELECTOR.edit).find(`${ELEMENTS_SELECTOR.typeInput} option:selected`).data('option-icon');
        let icon = (typeInput == 'dog') ? 'dog' : 'cat';

        element.find(ELEMENTS_SELECTOR.type).html(`<svg class="icon icon--${icon}">
            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-${icon}"></use>
        </svg>`);

        element.removeClass('pet-card--editing');
    });

    $(document).on('click', ELEMENTS_SELECTOR.buttonCancel, function() {
        $(this).closest(ELEMENTS_SELECTOR.card).removeClass('pet-card--editing');
    });

    $(document).on('click', ELEMENTS_SELECTOR.buttonAdd, function() {
        let template = $('#hidden-template-pet').text();
        template = template.replaceAll('#ID#', Date.now());
        $(ELEMENTS_SELECTOR.list).append(template);

        select();
    });
}

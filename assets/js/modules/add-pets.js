const ELEMENTS_SELECTOR = {
    card: '[data-pets-card]',
    main: '[data-pets-main]',
    edit: '[data-pets-edit]',
    modifyButton: '[data-pets-modify]',
    deleteButton: '[data-pets-delete]',
};

export default function () {
    $(document).on('click', ELEMENTS_SELECTOR.deleteButton, function() {
        $(this).closest(ELEMENTS_SELECTOR.card).remove();
    });

    $(document).on('click', ELEMENTS_SELECTOR.modifyButton, function() {
        $(this).closest(ELEMENTS_SELECTOR.card).addClass('pet-card--editing');
    });
}

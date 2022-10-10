const ELEMENTS_SELECTOR = {
    modal: '[data-support]',
    variant: '[data-variant-block]',
    option: '[data-option]',
};

export default function () {
    $(document).on('change', ELEMENTS_SELECTOR.option, function () {
        let option = $(this).find('option:selected').attr('data-variant');

        $(ELEMENTS_SELECTOR.variant).removeClass('modal__section-variant--active');

        $(ELEMENTS_SELECTOR.modal).find(`[data-variant-block='${option}'`).addClass('modal__section-variant--active');

    });
}

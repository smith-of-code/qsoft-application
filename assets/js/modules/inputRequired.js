const ELEMENTS_SELECTOR = {
    input: '[data-input-required]',
}

export default function inputRequired() {

    $(document).on('blur', ELEMENTS_SELECTOR.input, function () {
        let input = $(this);
        let value = input.val();
        let span = `<span class="input__control-error">Поле обязательно к заполнению</span>`;
        let checkSpan = input.parent().find('.input__control-error').length;

        if (!value) {
            input.addClass('input__control--error');
            if (checkSpan === 0) {
                input.parent().append(span);
            }
        }
    });

    $(document).on('input', ELEMENTS_SELECTOR.input, function () {
        let input = $(this);
        let value = input.val();
        let span = input.parent().find('.input__control-error');

        if (value) {
            input.removeClass('input__control--error');
            span.remove();
        }
    });
}

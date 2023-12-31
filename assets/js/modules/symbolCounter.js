const ELEMENTS_SELECTOR = {
    input: '[data-textarea-input]',
    current: '[data-textarea-current]',
    total: '[data-textarea-total]',
};

export default function symbolCounter() {
    let max = $(ELEMENTS_SELECTOR.input).attr('maxlength');

    $(ELEMENTS_SELECTOR.total).text(max);
    $(ELEMENTS_SELECTOR.current).text(0);


    $(document).on('input', ELEMENTS_SELECTOR.input, function () {
        let currentNumber = $(this).val().length;
        $(this).parent().find(ELEMENTS_SELECTOR.current).text(currentNumber);
    });

    $(document).on('focus', ELEMENTS_SELECTOR.input, function (evt) {
        $(evt.target).addClass('input__control--hideplaceholder');
    });

    $(document).on('blur', ELEMENTS_SELECTOR.input, function (evt) {
        $(evt.target).removeClass('input__control--hideplaceholder');
    });
}
const ELEMENTS_SELECTOR = {
    block: '[data-identic]',
    change: '[data-identic-change]',
    input: '[data-identic-input]',
};

export default function () {
    $(document).on('change', ELEMENTS_SELECTOR.change, function() {
        let block = $(this).closest(ELEMENTS_SELECTOR.block);
        let inputs = block.find(ELEMENTS_SELECTOR.input);

        if ($(this).is(":checked")) {
            inputs.attr('readonly', true);
            inputs.addClass('input__control--disabled');
        } else {
            inputs.removeAttr('readonly');
            inputs.removeClass('input__control--disabled');
        }
    });
}
const ELEMENTS_SELECTOR = {
    class: '.input--placeholder .input__control',
};

export default function () {
    $(document).on('input', ELEMENTS_SELECTOR.class, function () {
        let value = $(this).val();
        $(this).attr('value', value);
    });
}
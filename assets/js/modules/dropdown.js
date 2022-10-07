const ELEMENTS_SELECTOR = {
    button: '[data-dropdown-button]',
    dropdownBlock: '[data-dropdown-block]',
    dropdown: '[data-dropdown]',
    close: '[data-dropdown-close]',
};

export default function () {
    $(document).on('click', ELEMENTS_SELECTOR.button, function() {
        $(this).closest(ELEMENTS_SELECTOR.dropdown).toggleClass('dropdown--active');
    });

    $(document).on('click', ELEMENTS_SELECTOR.close, function() {
        $(this).closest(ELEMENTS_SELECTOR.dropdown).removeClass('dropdown--active');
    });
}

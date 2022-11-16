const ELEMENTS_SELECTOR = {
    button: '[data-dropdown-button]',
    buttonMenu: '[data-dropdown-burger]',
    dropdownBlock: '[data-dropdown-block]',
    dropdown: '[data-dropdown]',
    close: '[data-dropdown-close]',
};

export default function () {
    $(document).on('click', ELEMENTS_SELECTOR.button, function() {
        let dropdown = $(this).closest(ELEMENTS_SELECTOR.dropdown);
        let rund = Math.floor(Math.random() * 1000);

        dropdown.toggleClass('dropdown--active');

        $(document).on('click.dropdown'+rund, function (e) {
            let elem = $(e.target);

            if (dropdown.find(elem).length) {
                return;
            }

            dropdown.removeClass('dropdown--active');
            $(this).off('click.dropdown'+rund);
        });

        if (dropdown.hasClass('dropdown--active')) {
            $(ELEMENTS_SELECTOR.buttonMenu).addClass('header__catalog-button-menu--active');
        } else {
            $(ELEMENTS_SELECTOR.buttonMenu).removeClass('header__catalog-button-menu--active');
        }
    });

    $(document).on('click', ELEMENTS_SELECTOR.close, function() {
        $(this).closest(ELEMENTS_SELECTOR.dropdown).removeClass('dropdown--active');
    });
}

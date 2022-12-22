const ELEMENTS_SELECTOR = {
    button: '[data-dropdown-button]',
    buttonMenu: '[data-dropdown-burger]',
    dropdown: '[data-dropdown]',
    close: '[data-dropdown-close]',
};

export default function () {
    $(document).on('click', ELEMENTS_SELECTOR.button, function() {
        let dropdown = $(this).closest(ELEMENTS_SELECTOR.dropdown);
        let rund = Math.floor(Math.random() * 1000);
        let button = $(this)

        dropdown.toggleClass('dropdown--active');
        
        $(document).on('click.dropdown'+rund, function (e) {
            let elem = $(e.target);

            if (dropdown.find(elem).length) {
                return;
            }

            dropdown.removeClass('dropdown--active');
            button.removeClass('header__catalog-button-menu--active');
            $(this).off('click.dropdown'+rund);
        });
    });

    $(document).on('mouseover', ELEMENTS_SELECTOR.button, function() {
        let dropdown = $(this).closest(ELEMENTS_SELECTOR.dropdown);
        let rund = Math.floor(Math.random() * 1000);
        let button = $(this)
        let type = dropdown.attr('data-dropdown');

        if (type === "hover") {
            dropdown.addClass('dropdown--active');
        
            $(document).on('click.dropdown'+rund, function (e) {
                let elem = $(e.target);
    
                if (dropdown.find(elem).length) {
                    return;
                }

                dropdown.removeClass('dropdown--active');
                $(this).off('click.dropdown'+rund);
            });
        }
        
    })

    $(document).on('click', ELEMENTS_SELECTOR.buttonMenu, function() {
        $(this).toggleClass('header__catalog-button-menu--active');
    });

    $(document).on('click', ELEMENTS_SELECTOR.close, function() {
        $(this).closest(ELEMENTS_SELECTOR.dropdown).removeClass('dropdown--active');
    });
}

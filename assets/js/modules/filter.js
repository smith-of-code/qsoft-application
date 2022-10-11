const ELEMENTS_SELECTOR = {
    button: '[data-filter-button]',
    filterBlock: '[data-filter-block]',
    background: '[data-filter-bg]',
    close: '[data-filter-close]',
    filter: '[data-filter]',
};

export default function () {
    $(document).on('click', ELEMENTS_SELECTOR.button, function() {
        $(this).closest(ELEMENTS_SELECTOR.filter).toggleClass('filter--active');
        $('.page').toggleClass('page--locked-mobile');
    });

    $(document).on('click', `${ELEMENTS_SELECTOR.close}, ${ELEMENTS_SELECTOR.background}`, function() {
        $(this).closest(ELEMENTS_SELECTOR.filter).removeClass('filter--active');
        $('.page').removeClass('page--locked-mobile');
    });
}

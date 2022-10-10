const ELEMENTS_SELECTOR = {
    button: '[data-filter-button]',
    filterBlock: '[data-filter-block]',
    close: '[data-filter-close]',
    filter: '[data-filter]',
};

export default function () {
    $(document).on('click', ELEMENTS_SELECTOR.button, function() {
        $(ELEMENTS_SELECTOR.filter).find(ELEMENTS_SELECTOR.filterBlock).toggleClass('filter__block--active');
        $('.page').addClass('page--locked');
    });

    $(document).on('click', ELEMENTS_SELECTOR.close, function() {
        $(ELEMENTS_SELECTOR.filterBlock).removeClass('filter__block--active');
        $('.page').removeClass('page--locked');
    });
}

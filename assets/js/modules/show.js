const ELEMENTS_SELECTOR = {
    block: '[data-show-cards]',
    card: '[data-show-card]',
    button: '[data-show-button]',
};

export default function show() {
    $(document).on('click', ELEMENTS_SELECTOR.button, function () {
        $(ELEMENTS_SELECTOR.block).find(ELEMENTS_SELECTOR.card).removeClass('product-cards__item--hidden');
        $(this).hide();
    });
}
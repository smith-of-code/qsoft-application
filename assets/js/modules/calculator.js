const ELEMENTS_SELECTOR = {
    consultants: '[data-consultants]',
    switcher: '[data-consultants-switcher]',
    quantity: '[data-consultants-quantity]',
};

export default function () {
    $(document).on('change', ELEMENTS_SELECTOR.switcher, function() {
        $(ELEMENTS_SELECTOR.consultants).find(ELEMENTS_SELECTOR.quantity).toggleClass('profitability__consultants-quantity--hidden');
    });
}

const ELEMENTS_SELECTOR = {
    quantity: '[data-quantity]',
    button: '[data-quantity-button]',
    actions: '[data-quantity-actions]',
    decrease: '[data-quantity-decrease]',
    increase: '[data-quantity-increase]',
    sum: '[data-quantity-sum]',
};

export default function changeTotal() {
    let sum = $(ELEMENTS_SELECTOR.sum).text(0);

    $(document).on('click', ELEMENTS_SELECTOR.button, function () {
        $(ELEMENTS_SELECTOR.quantity).addClass('quantity--active');
    });
}

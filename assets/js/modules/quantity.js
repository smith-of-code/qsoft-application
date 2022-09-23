const ELEMENTS_SELECTOR = {
    quantity: '[data-quantity]',
    button: '[data-quantity-button]',
    decrease: '[data-quantity-decrease]',
    increase: '[data-quantity-increase]',
    sum: '[data-quantity-sum]',
};

export default function changeTotal() {
    let sum = 0;
    $(ELEMENTS_SELECTOR.sum).text(sum);

    $(document).on('click', ELEMENTS_SELECTOR.button, function () {
        sum++;
        $(ELEMENTS_SELECTOR.sum).text(sum);
        $(ELEMENTS_SELECTOR.quantity).addClass('quantity--active');
    });

    $(document).on('click', ELEMENTS_SELECTOR.increase, function () {
        sum++;
        $(ELEMENTS_SELECTOR.sum).text(sum);

        if (sum == 10) {
            $(this).prop('disabled', true);
            $(this).addClass('button--disabled');
        }
    });  

    $(document).on('click', ELEMENTS_SELECTOR.decrease, function () {
        sum--;
        $(ELEMENTS_SELECTOR.sum).text(sum);

        if (sum == 0) {
            $(ELEMENTS_SELECTOR.quantity).removeClass('quantity--active');
        }

        $(ELEMENTS_SELECTOR.increase).prop('disabled', false);
        $(ELEMENTS_SELECTOR.increase).removeClass('button--disabled');
    });
}

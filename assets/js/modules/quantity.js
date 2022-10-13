const ELEMENTS_SELECTOR = {
    quantity: '[data-quantity]',
    button: '[data-quantity-button]',
    decrease: '[data-quantity-decrease]',
    increase: '[data-quantity-increase]',
    sum: '[data-quantity-sum]',
};

export default function changeTotal() {
    function changeSum(element, calculation='+') {
        let quantityBlock = element.closest(ELEMENTS_SELECTOR.quantity);
        let sumBlock = quantityBlock.find(ELEMENTS_SELECTOR.sum);
        let sum = sumBlock.data('quantity-sum');

        if (calculation == '+') {
            sum++;
        } else {
            sum--;
        }

        sumBlock.data('quantity-sum', sum);
        sumBlock.text(sum);

        return sum;
    }

    $(document).on('click', ELEMENTS_SELECTOR.button, function () {
        changeSum($(this));

        $(this).closest(ELEMENTS_SELECTOR.quantity).addClass('quantity--active');
    });

    $(document).on('click', ELEMENTS_SELECTOR.increase, function () {
        let sum = changeSum($(this));

        if (sum == 10) {
            $(this).prop('disabled', true);
            $(this).addClass('button--disabled');
        }
    });  

    $(document).on('click', ELEMENTS_SELECTOR.decrease, function () {
        let quantityBlock = $(this).closest(ELEMENTS_SELECTOR.quantity);
        let increase = quantityBlock.find(ELEMENTS_SELECTOR.increase);
        let sum = changeSum($(this), '-');

        if (sum == 0) {
            quantityBlock.removeClass('quantity--active');
        }

        increase.prop('disabled', false);
        increase.removeClass('button--disabled');
    });
}

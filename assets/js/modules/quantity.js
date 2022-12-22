const ELEMENTS_SELECTOR = {
    quantity: '[data-quantity]',
    button: '[data-quantity-button]',
    decrease: '[data-quantity-decrease]',
    increase: '[data-quantity-increase]',
    sum: '[data-quantity-sum]',
    max: '[data-quantity-max]',
    min: '[data-quantity-min]'
};

export default function changeTotal() {
    function checkSum(item) {
        let sumBlock = item.find(ELEMENTS_SELECTOR.sum);
        let decrease = item.find(ELEMENTS_SELECTOR.decrease);
        let increase = item.find(ELEMENTS_SELECTOR.increase);
        let sum = sumBlock.data('quantity-sum');
        let min = sumBlock.data('quantity-min');
        let max= sumBlock.data('quantity-max');

        if (sum >= max) {
            increase.prop('disabled', true);
            increase.addClass('button--disabled');
        } else {
            increase.prop('disabled', false);
            increase.removeClass('button--disabled');
        }

        if (sum <= min) {
            decrease.prop('disabled', true);
            decrease.addClass('button--disabled');
        } else {
            decrease.prop('disabled', false);
            decrease.removeClass('button--disabled');
        }

        if (sum === 0) {
            item.removeClass('quantity--active');
        } else {
            item.addClass('quantity--active');
        }

        if (sum > max) {
            sumBlock.html(max)
        }

        if (sum < min) {
            sumBlock.html(min)
        }
    }

    $(ELEMENTS_SELECTOR.quantity).each((index, item) => {
        checkSum($(item));
    });

    function changeSum(element, calculation='+') {
        let quantityBlock = element.closest(ELEMENTS_SELECTOR.quantity);
        let sumBlock = quantityBlock.find(ELEMENTS_SELECTOR.sum);
        let sum = sumBlock.data('quantity-sum');
        let min = sumBlock.data('quantity-min');

        if (min) {
            if (calculation == '-' && sum > min) {
                sum--;
            } else if (calculation == '+') {
                sum++;
            }
        } else {
            if (calculation == '+') {
                sum++;
            } else {
                sum--;
            }
        }

        sumBlock.data('quantity-sum', sum);
        sumBlock.text(sum);

        checkSum(quantityBlock);

        return sum;
    }

    $(document).on('click', ELEMENTS_SELECTOR.button, function () {
        changeSum($(this));
    });

    $(document).on('click', ELEMENTS_SELECTOR.increase, function () {
        changeSum($(this));
    });

    $(document).on('click', ELEMENTS_SELECTOR.decrease, function () {
        changeSum($(this), '-');
    });
}

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
    function checkSum() {
        let quantityBlocks = $(ELEMENTS_SELECTOR.quantity);

        quantityBlocks.each((index, item) => {
            let sumBlock = $(item).find(ELEMENTS_SELECTOR.sum);
            let decrease = $(item).find(ELEMENTS_SELECTOR.decrease);
            let increase = $(item).find(ELEMENTS_SELECTOR.increase);
            let sum = sumBlock.data('quantity-sum');
            let min = sumBlock.data('quantity-min');
            let max= sumBlock.data('quantity-max');
            
            if (sum >= max) {
                increase.prop('disabled', true);
                increase.addClass('button--disabled');
            }

            if (sum <= min) {
                decrease.prop('disabled', true);
                decrease.addClass('button--disabled');
            }

            if (sum > max) {
                sumBlock.html(max)
            }

            if (sum < min) {
                sumBlock.html(min)
            }
        })
    }

    checkSum();

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

        return sum;
    }

    $(document).on('click', ELEMENTS_SELECTOR.button, function () {
        changeSum($(this));

        $(this).closest(ELEMENTS_SELECTOR.quantity).addClass('quantity--active');
    });

    $(document).on('click', ELEMENTS_SELECTOR.increase, function () {
        let quantityBlock = $(this).closest(ELEMENTS_SELECTOR.quantity);
        let decrease = quantityBlock.find(ELEMENTS_SELECTOR.decrease);
        let max = quantityBlock.find(ELEMENTS_SELECTOR.max).data('quantity-max') || 10;
        let sum = changeSum($(this));

        if (sum == max) {
            $(this).prop('disabled', true);
            $(this).addClass('button--disabled');
        }

        decrease.prop('disabled', false);
        decrease.removeClass('button--disabled');
    });  

    $(document).on('click', ELEMENTS_SELECTOR.decrease, function () {
        let quantityBlock = $(this).closest(ELEMENTS_SELECTOR.quantity);
        let increase = quantityBlock.find(ELEMENTS_SELECTOR.increase);
        let min = quantityBlock.find(ELEMENTS_SELECTOR.min).data('quantity-min') || 0;
        let sum = changeSum($(this), '-');

        if (sum == 0) {
            quantityBlock.removeClass('quantity--active');
        }

        if (sum == min ) {
            $(this).prop('disabled', true);
            $(this).addClass('button--disabled');
        }

        increase.prop('disabled', false);
        increase.removeClass('button--disabled');
    });
}

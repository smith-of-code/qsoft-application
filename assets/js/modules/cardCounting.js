const ELEMENTS_SELECTORS = {
    card: '.card-counting',
    input: '[data-range-min]',
};

export default function () {
    $(ELEMENTS_SELECTORS.card).each(function () {
        const $card = $(this);
        const $input = $card.find(ELEMENTS_SELECTORS.input);

        $input.css('width', `${$input.val().length + 1}ch`);

        $input.on('input', function () {
            $(this).css('width', `${$input.val().length + 1}ch`);
        });
    });
};

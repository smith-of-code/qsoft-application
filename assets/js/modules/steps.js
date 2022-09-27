const ELEMENTS_SELECTOR = {
    item: '[data-steps-item]',
    indicator: '[data-steps-indicator]',
    buttonPrev: '[data-button-prev]',
    buttonNext: '[data-button-next]',
};

export default function () {
    $(document).on('click', ELEMENTS_SELECTOR.buttonNext, function () {
        let currentItem = $('.steps-counter__item--current');
        let currentCircle = $('.steps-counter__circle--current');
        let next = currentItem.next(ELEMENTS_SELECTOR.item);
        let nextIndicator = next.find(ELEMENTS_SELECTOR.indicator);

        currentItem.removeClass('steps-counter__item--current').addClass('steps-counter__item--passed');
        currentCircle.removeClass('steps-counter__circle--current').addClass('steps-counter__circle--passed');

        next.addClass('steps-counter__item--current');
        nextIndicator.addClass('steps-counter__circle--current');

    });

    $(document).on('click', ELEMENTS_SELECTOR.buttonPrev, function () {
        let currentItem = $('.steps-counter__item--current');
        let currentCircle = $('.steps-counter__circle--current');
        let prev = currentItem.prev(ELEMENTS_SELECTOR.item);
        let prevIndicator = prev.find(ELEMENTS_SELECTOR.indicator);

        currentItem.removeClass('steps-counter__item--current');
        currentCircle.removeClass('steps-counter__circle--current');

        prev.removeClass('steps-counter__item--passed').addClass('steps-counter__item--current');
        prevIndicator.removeClass('steps-counter__circle--passed').addClass('steps-counter__circle--current');
    });
}
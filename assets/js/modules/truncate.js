import dotdotdot from 'jquery.dotdotdot';

const ELEMENTS_SELECTOR = {
    truncateBox: '[data-truncate]',
};

const CLASSES = {
    truncateClass: 'truncate__link',
}

export default function() {
    $(ELEMENTS_SELECTOR.truncateBox).each(function() {
        const $truncateBox = $(this);

        $truncateBox.dotdotdot({
            watch: 'window',
            fallbackToLetter: true,
            truncate: 'letter',
        });
    });
}

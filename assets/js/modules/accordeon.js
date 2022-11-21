const ELEMENTS_SELECTOR = {
    button: '[data-accordeon-toggle]',
    accordeon: '[data-accordeon]',
    content: '[data-accordeon-content]',
};

export default function accordeon() {
    $(document).on('click', ELEMENTS_SELECTOR.button, function () {
        const $parent = $(this).closest(ELEMENTS_SELECTOR.accordeon);
        const $content = $parent.find(ELEMENTS_SELECTOR.content);

        $parent.toggleClass('accordeon__item--opened');

        if ($parent.data('accordeon') == 'mobile-accordeon') {
            $content.toggleClass('accordeon__body--mobile-active');
        }

        $content.slideToggle();
    });
}

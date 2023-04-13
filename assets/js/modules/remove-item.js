const ELEMENTS_SELECTOR = {
    item: '[data-remove-item]',
    button: '[data-remove-button]',
};

export default function () {
    $(document).on('click', ELEMENTS_SELECTOR.button, function () {
        const $item = $(this).closest(ELEMENTS_SELECTOR.item);
        $item.remove();
    });
};

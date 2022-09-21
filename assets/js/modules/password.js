const ELEMENTS_SELECTOR = {
    icon: '[data-password-toggle]',
    block: '[data-password-block]',
    input: '[data-password-input]',
};

export default function showPassword() {
    $(document).on('click', ELEMENTS_SELECTOR.icon, function () {
        const $parent = $(this).closest(ELEMENTS_SELECTOR.block);
        const $input = $parent.find(ELEMENTS_SELECTOR.input);

        if ($input.attr('type') == 'password') {
            $(this).addClass('input__icon-password--show');
            $input.attr('type', 'text');
        } else {
            $(this).removeClass('input__icon-password--show');
            $input.attr('type', 'password');
        }
    });
}

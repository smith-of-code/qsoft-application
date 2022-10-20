const ELEMENTS_SELECTOR = {
    cookie_box: '[data-cookie]',
    cookie_accept: '[data-cookie-accept]',
    cookie_more: '[data-cookie-more]',
};

export default function () {
    $(document).on('click', ELEMENTS_SELECTOR.cookie_accept, function() {
        $(ELEMENTS_SELECTOR.cookie_box).hide();
    });
}

const ELEMENTS_SELECTOR = {
    text: '[data-show-text]',
};

export default function () {
    $(document).on('click', ELEMENTS_SELECTOR.text, function() {
        let text = $(this);
        let rund = Math.floor(Math.random() * 1000);

        $(this).addClass('participant__info-show');

        $(document).on('click.text'+rund, function (e) {
            let elem = $(e.target);

            if (text.is(elem)) {
                return;
            }

            text.removeClass('participant__info-show');
            $(this).off('click.text'+rund);
        });
    });
}

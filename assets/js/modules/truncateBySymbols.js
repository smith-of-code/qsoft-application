const ELEMENTS_SELECTOR = {
    truncateBox: '[data-truncate-symbols]',
};

export default function truncateBySymbols() {
    $(ELEMENTS_SELECTOR.truncateBox).each(function(i, el) {
        const $truncateBox = $(this);
        const symbolsLimit = $truncateBox.attr('data-truncate-symbols')
        if ($truncateBox.text().trim().length > symbolsLimit) {
            $truncateBox.text($truncateBox.text().trim().slice(0, symbolsLimit) + '...')
        }
    });
}

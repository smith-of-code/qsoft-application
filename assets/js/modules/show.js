const ELEMENTS_SELECTOR = {
    block: '[data-show-cards]',
    card: '[data-show-card]',
    button: '[data-show-button]',
};

function isMobile() {
    return window.innerWidth <= 768;
}

export default function show() {
    let offset = 0;
    const blockSize = isMobile() ? 4 : 8;

    function process() {
        offset += blockSize;
        const hiddenElements = $(ELEMENTS_SELECTOR.block).find(`${ELEMENTS_SELECTOR.card}:nth-child(n + ${offset + 1})`);

        $(ELEMENTS_SELECTOR.block).find(ELEMENTS_SELECTOR.card).show();
        hiddenElements.hide();

        if (!hiddenElements.length) {
            $(ELEMENTS_SELECTOR.button).hide();
        }
    }

    $(document).on('click', ELEMENTS_SELECTOR.button, process);
    process();
}
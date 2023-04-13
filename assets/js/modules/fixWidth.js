
const ELEMENTS_SELECTOR = {
    block: '[data-fixwidth]',
};

export default function() {

    const range = document.createRange();
  
    $(ELEMENTS_SELECTOR.block).each(function (index, item) {
        const text = item.childNodes[0]

        range.setStartBefore(text);
        range.setEndAfter(text);

        const clientRect = range.getBoundingClientRect();
        item.style.width = `${clientRect.right}px`;
        const fix = clientRect.width + 15
        item.style.maxWidth = `${fix}px`;
    })
}

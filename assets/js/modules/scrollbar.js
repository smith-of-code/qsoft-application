import OverlayScrollbars from 'overlayscrollbars';

const ELEMENTS_SELECTOR = {
    scrollbar: '[data-scrollbar]',
};

const DATA_ATTRIBUTES = {
    scrollbarAutoHide: 'data-scrollbar-autoHide',
    scrollbarHideAxis: 'data-scrollbar-hide'
};

const CLASSES = {
    dragscroll: 'dragscroll',
    hideScroll: 'os-scrollbar--hide-scroll',
    container: '.os-viewport',
};

export default function scrollbarInit() {
    const $scrollbarAll = $(ELEMENTS_SELECTOR.scrollbar);

    $scrollbarAll.each(function() {
        let $scrollbar = $(this);

        let axis_x = 'scroll', axis_y = 'scroll';

        if ($scrollbar.attr(DATA_ATTRIBUTES.scrollbarHideAxis) === 'x') {
            axis_x = 'hidden';
        }

        if ($scrollbar.attr(DATA_ATTRIBUTES.scrollbarHideAxis) === 'y') {
            axis_y = 'hidden';
        }

        let oscrollInstance = OverlayScrollbars($scrollbar, {
            scrollbars: {
                autoHide: ($scrollbar.attr(DATA_ATTRIBUTES.scrollbarAutoHide))
                    ? $scrollbar.attr(DATA_ATTRIBUTES.scrollbarAutoHide)
                    : 'never',
            },
            overflowBehavior: {
                x : axis_x,
                y : axis_y
            },
            callbacks: {
                onInitialized: function() {
                    const elements = this.getElements();

                    if (elements.target.classList.contains(CLASSES.dragscroll)) {
                        elements.target.classList.remove(CLASSES.dragscroll);
                        elements.target.classList.add(CLASSES.hideScroll);
                        elements.viewport.classList.add(CLASSES.dragscroll);
                    }
                },
                onScroll: function() {
                    let $element = $(this.getElements().target);
                    let height = this.scroll().position.y;
                    let maxHeight = this.scroll().max.y;

                    $scrollbar.data('scrolled', this.scroll().position.y);

                    $element.trigger('customScroll');

                    if (height >= (maxHeight - maxHeight / 3)) {
                        $element.trigger('customScrollEnd');
                    }
                },
            },
        });

        $scrollbar.data('instance', oscrollInstance);
    });
}

window.OverlayScrollbars = OverlayScrollbars;
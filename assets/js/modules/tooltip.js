import tippy from 'tippy.js';

export default function tooltip() {
    tippy('[data-tippy-content]', {
        theme: 'light',
        arrow: false,
        appendTo: 'parent',
    });
}
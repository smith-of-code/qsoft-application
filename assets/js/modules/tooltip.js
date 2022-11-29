import tippy from 'tippy.js';

export default function tooltip() {
    const html = $('[data-tippy-html]');
    html.each(function(id, item) {
        let template = $(item).find('[data-tippy-template]');

        tippy(item, {
            theme: 'light',
            arrow: false,
            appendTo: 'parent',
            content: template[0].innerHTML,
            allowHTML: true,
        });
    });

    tippy('[data-tippy-content]', {
        theme: 'light',
        arrow: false,
        appendTo: 'parent',
    });

    window.tippy = tippy;
}
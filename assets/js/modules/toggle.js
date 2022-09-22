
export default function toggle() {
    if ($('[data-toggle-visibility-action]').length) {
        $(document).off('click', '[data-toggle-visibility-action]').on('click', '[data-toggle-visibility-action]', function () {
            let text = $(this).find('[data-toggle-visibility-action-text]');
            let textVal = text.data('toggle-visibility-action-text');
            let textState = $(this).data('toggle-visibility-action');
            let container = $(this).closest('[data-toggle-visibility-container]');
            let blocks = container.find('[data-toggle-visibility-block]');

            blocks.each(function (index, element) {
                $(element).toggle();
            });

            if (text.length) {
                text.text(textVal[textState]);
            }

            textState = (textState == 'hide') ? 'show' : 'hide';
            $(this).data('toggle-visibility-action', textState);
            $(this).toggleClass('button--hide');
        });
    }
}
const ELEMENTS_SELECTOR = {
    button: '[data-card-favourite]',
    icon: '[data-card-favourite-icon]',
};

export default function () {
    $(document).on('click', ELEMENTS_SELECTOR.button, function() {
        let currentType = $(this).data('card-favourite');

        let newType = (currentType == 'heart') ? 'heart-fill' : 'heart';

        $(this).find(ELEMENTS_SELECTOR.icon).attr('xlink:href', `/local/templates/.default/images/icons/sprite.svg#icon-${newType}`);
        $(this).data('card-favourite', newType);
    });
}

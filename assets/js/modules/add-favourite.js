const ELEMENTS_SELECTOR = {
    button: '[data-card-favourite]',
    block: '[data-card-favourite-block]',
    icon: '[data-card-favourite-icon]',
};

function changeFavourite(element) {
    let currentType = element.data('card-favourite');

    let newType = (currentType == 'heart') ? 'heart-fill' : 'heart';

    element.find(ELEMENTS_SELECTOR.icon).attr('xlink:href', `/local/templates/.default/images/icons/sprite.svg#icon-${newType}`);
    element.data('card-favourite', newType);
}

export default function () {
    $(document).on('click', ELEMENTS_SELECTOR.button, function() {
        let block = $(this).closest(ELEMENTS_SELECTOR.block);

        if (block.length > 0) {
            let currents = block.find(ELEMENTS_SELECTOR.button);

            currents.each((id, item)=>{
                changeFavourite($(item));
            });

        } else {
            changeFavourite($(this));
        }
    });
}

const ELEMENTS_SELECTOR = {
    button: '[data-card-favourite]',
    block: '[data-card-favourite-block]',
    icon: '[data-card-favourite-icon]',
};

function changeFavourite(element) {
    let currentType = element.attr('data-card-favourite');
    let newType = (currentType == 'heart') ? 'heart-fill' : 'heart';
    let newTooltip = (currentType == 'heart') ? 'Удалить из избранного' : `В\xA0избранное`;

    element.find(ELEMENTS_SELECTOR.icon).attr('xlink:href', `/local/templates/.default/images/icons/sprite.svg#icon-${newType}`);
    element.attr('data-card-favourite', newType);
    element.attr('data-tippy-content', newTooltip);
}


export default function () {
    let buttonsHeart = $(ELEMENTS_SELECTOR.button);

    buttonsHeart.each((id, item) => {
        let currentType = $(item).attr('data-card-favourite');
        let newTooltip = (currentType == 'heart') ? `В\xA0избранное` : 'Удалить из избранного';
        if ($(item).attr('data-tippy-content') !== undefined) {
            $(item).attr('data-tippy-content', newTooltip);
        }
    })
    
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

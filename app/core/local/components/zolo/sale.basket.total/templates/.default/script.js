$(document).on('click', 'button[data-quantity-decrease]', function () {
    const id = $(this).closest('[data-basket-item]').data('offer-id');
    window.stores.basketStore.decreaseItem(id);
});

$(document).on('click', 'button[data-quantity-increase]', function () {
    const id = $(this).closest('[data-basket-item]').data('offer-id');
    window.stores.basketStore.increaseItem(id);
});

$(document).on('click', 'button[data-basket-item-remove]', function () {
    const id = $(this).closest('[data-basket-item]').data('offer-id');
    window.stores.basketStore.decreaseItem(id, 0);
});

$(document).on('click', 'button[data-card-favourite]', function () {
    const id = $(this).closest('[data-basket-item]').data('offer-id');
    if ($(this).data('card-favourite') === 'heart') {
        window.stores.wishlistStore.add(id);
    } else {
        window.stores.wishlistStore.remove(id);
    }
});

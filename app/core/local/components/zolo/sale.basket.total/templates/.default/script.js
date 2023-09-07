
$(document).ready(async function () {
    await window.stores.basketStore.fetchBasketTotals();
    acceptTotal(window.stores.basketStore.basketPrice);
});

$(document).on('click', 'button[data-quantity-decrease]', async function () {
    const id = $(this).closest('[data-basket-item]').data('offer-id');
    await window.stores.basketStore.decreaseItem(id);
    acceptTotal(window.stores.basketStore.basketPrice);
});

$(document).on('click', 'button[data-quantity-increase]', async function () {
    const id = $(this).closest('[data-basket-item]').data('offer-id');
    await window.stores.basketStore.increaseItem(id);
    acceptTotal(window.stores.basketStore.basketPrice);
});

$(document).on('click', 'button[data-basket-item-remove]',async function () {
    const id = $(this).closest('[data-basket-item]').data('offer-id');
    await window.stores.basketStore.decreaseItem(id, 0);
    acceptTotal(window.stores.basketStore.basketPrice);
});

$(document).on('click', 'button[data-basket-clear]',async function () {
    await window.stores.basketStore.clear();
    acceptTotal(window.stores.basketStore.basketPrice);
});

$(document).on('click', 'button[data-card-favourite]', function () {
    const id = $(this).closest('[data-basket-item]').data('offer-id');
    if ($(this).data('card-favourite') === 'heart') {
        window.stores.wishlistStore.add(id);
    } else {
        window.stores.wishlistStore.remove(id);
    }
});

function acceptTotal(total) {
    console.log(total)
    const spanWhole = $('[data-basket-total]').find(".basket-card__total-whole");
    const spanRemains = $('[data-basket-total]').find(".basket-card__total-remains");

    let totalFixied = total.toFixed(2);
    let totalRemains = totalFixied.toString().split('.')[1];
   
    if (totalRemains === "00") {
        spanWhole.text(Math.floor(total).toLocaleString('ru-RU', {minimumFractionDigits: 0}));
        spanRemains.html('&nbsp;₽');
    } else {
        spanWhole.text(Math.floor(total).toLocaleString('ru-RU', {minimumFractionDigits: 0}) + ',');
        spanRemains.html(totalRemains.toLocaleString('ru-RU', {minimumFractionDigits: 0}) + '&nbsp;₽');
    }
}
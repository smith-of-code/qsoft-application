const ELEMENTS_SELECTOR = {
    list: '[data-basket-list]',
    item: '[data-basket-item]',

    product_total: '[data-basket-product-total]',
    amount: '[data-basket-order-amount]',
    economy: '[data-basket-economy]',
    total: '[data-basket-total]',
};

export default function () {
    let basketList = $(ELEMENTS_SELECTOR.item);
    let lengthBasket = basketList.length;

    $(ELEMENTS_SELECTOR.product_total).html(lengthBasket);

    basketList.each(function(index, item) {
        console.log(item, 'item');

        const amountProduct = $(item).find('.quantity__total-sum').text();
        const priceProduct = $(item).find('.card-cart__price-value').text();

       
  
    });

    console.log(lengthBasket);
}
const ELEMENTS_SELECTOR = {
    cart: '[data-basket]',
    list: '[data-basket-list]',
    item: '[data-basket-item]',
    item_button_remove: '[data-basket-item-remove]',
    item_button_count: '[data-basket-item-count]',
    item_remove: '[data-basket-item-remove]',

    product_total: '[data-basket-product-total]',
    amount: '[data-basket-order-amount]',
    economy: '[data-basket-economy]',
    total: '[data-basket-total]',
};

export default function () {

    checkStatusBasket();

    $(document).on('click', ELEMENTS_SELECTOR.item_button_remove, checkStatusBasket);
    $(document).on('click', ELEMENTS_SELECTOR.item_button_count, checkStatusBasket);
    
    function checkStatusBasket() {
        let basketList = $(ELEMENTS_SELECTOR.item);
        let lengthBasket = basketList.length;

        if (lengthBasket === 0) {
            $(ELEMENTS_SELECTOR.cart)
            .find('.basket__cart-null')
            .show()
        } else {
            $(ELEMENTS_SELECTOR.cart)
            .find('.basket__cart-null')
            .hide()
        }

        let basketAmoutOrder = 0;

        basketList.each(function(index, item) {
            const amountProduct = $(item)
            .find('.quantity__total-sum')
            .text();

            const priceProduct = $(item)
            .find('.card-cart__price-value')
            .text();
    
            const currentPrice = priceСalc(priceProduct, amountProduct);
    
            basketAmoutOrder += currentPrice;
        });
    
        $(ELEMENTS_SELECTOR.amount).html(basketAmoutOrder + ' ₽');
        $(ELEMENTS_SELECTOR.product_total).html(lengthBasket);
    }

    function priceСalc(price, amount) {
        const priceProduct = parseInt(amount) * parseInt(price);

        return priceProduct
    }
}
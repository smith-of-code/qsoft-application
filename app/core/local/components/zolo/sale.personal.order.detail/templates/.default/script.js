window.onload = function () {
    //Выполнить пагинацию по клику на кнопке "Показать больше". Кнопка может быть скрыта.
    let buttonShowMore = document.querySelector('.orders__button-more');
    if (buttonShowMore != null) {
        buttonShowMore.addEventListener('click', loadOrders);
    }
    document.querySelector('.card-order__button').addEventListener('click', repeatOrder);
}

function repeatOrder() {
    window.stores.basketStore.repeatOrder(orderId);
    $.fancybox.open({ src: '#thanks' });
}

//пагинация товаров
function loadOrders() {
    BX.ajax.runComponentAction('zolo:sale.personal.order.detail', 'loadProducts', {
        mode: 'class',
        data: {
            offset: offset,
            orderId: orderId
        }
    }).then(function (response) {
        console.log(response['status']);
        let data = JSON.parse(response.data).basket;
        attach(data.PRODUCTS);
        if (data.last) {
            hideShowMoreButton();
        }
        offset = data.OFFSET;
    }, function (response) {
        console.log(response['errors']);
    });
}

//Присоединение полученных товаров
function attach(products) {
    for (let i = 0; i < products.length; i++) {
        let item = products[i];
        let addition = document.querySelector('.table-list__item').cloneNode(true);
        addition.querySelector('.product-line__image-picture').setAttribute('href', item['PICTURE']);
        addition.querySelector('.product-name').innerText = item['NAME'];
        addition.querySelector('.product-article').innerText = ARTICLE + item['ARTICLE'];
        addition.querySelector('.product-price').innerText = item['PRICE'] + RUBLE_SYMBOL;
        addition.querySelector('.product-quantity').innerText = item['QUANTITY'];
        addition.querySelector('.product-bonus').innerText = item['BONUSES'] + ' ББ';
        document.querySelector('.table-list__list').appendChild(addition);
    }
}

function hideShowMoreButton() {
    document.querySelector('.orders__button-more').style.display = 'none';
}

$( document ).ready(function() {
    const orderItem = $(".cards-order__item");
    const buttonMore = $('#showMore');

    function rountedPrice(price, whole, remains) {
        let orderItemPriceNum = parseFloat(price);
        let totalFixied = orderItemPriceNum.toFixed(2);
        let totalRemains = totalFixied.toString().split('.')[1];

        if (totalRemains === "00") {
            whole.text(Math.floor(orderItemPriceNum).toLocaleString('ru-RU', {minimumFractionDigits: 0}));
            remains.html('&nbsp;₽');
        } else {
            whole.text(Math.floor(orderItemPriceNum).toLocaleString('ru-RU', {minimumFractionDigits: 0}) + ',');
            remains.html(totalRemains.toLocaleString('ru-RU', {minimumFractionDigits: 0}) + '&nbsp;₽');
        }
    }

    orderItem.each(function (index, item) {
        const orderItemPrice = $(item).find('.price__calculation-value');
        const orderItemPriceVal = orderItemPrice.attr('data-order-amount').replace(/\s/g,'').replace(/,/g, '.');
        const spanWhole = orderItemPrice.find(".price__calculation-value--whole");
        const spanRemains = orderItemPrice.find(".price__calculation-value--remains");

        if (orderItemPriceVal) {
            rountedPrice(orderItemPriceVal, spanWhole, spanRemains);
        }
    }); 
    
    const orderProductItems = $(".table-list__item");
   
    orderProductItems.each((index, item) => {
        const itemPrice = $(item).find('.product-line__params-value');
        const itemPriceVal = itemPrice.attr('data-item-price').replace(/\s/g,'').replace(/,/g, '.');
        const spanWhole = itemPrice.find(".product-line__params-value--whole");
        const spanRemains = itemPrice.find(".product-line__params-value--remains");

        if (itemPriceVal) {
            rountedPrice(itemPriceVal, spanWhole, spanRemains);
        }
    })
});

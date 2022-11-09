window.onload = function () {
    //Выполнить пагинацию по клику на кнопке "Показать больше"
    document.querySelector('.orders__button-more').addEventListener('click', loadOrders);
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
        attach(response['data']['PRODUCTS']);
        offset = response['data']['OFFSET'];
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
        addition.querySelector('.product-article').innerText = item['VENDOR_CODE'];
        addition.querySelector('.product-price').innerText = item['PRICE'] + RUBLE_SYMBOL;
        addition.querySelector('.product-quantity').innerText = item['QUANTITY'];
        addition.querySelector('.product-credit').innerText = "баллы";
        document.querySelector('.table-list__list').appendChild(addition);
    }
}


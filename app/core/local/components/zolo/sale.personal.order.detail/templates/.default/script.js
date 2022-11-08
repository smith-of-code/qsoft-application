window.onload = function () {
    //Выполнить пагинацию по клику на кнопке "Показать больше"
    document.querySelector('.orders__button-more').addEventListener('click', loadOrders);
}

//(пагинация товаров)
function loadOrders() {
    BX.ajax.runComponentAction('zolo:sale.personal.order.detail', 'loadProducts', {
        mode: 'class',
        data: {
            offset: offset,
            orderId: orderId
        }
    }).then(function (response) {
        attach(response['data']['PRODUCTS']);
        offset = response['data']['OFFSET'];
    }, function (response) {
        console.log(response);
    });
}

//Присоединение полученных товаров
function attach(products) {
    for (let i = 0; i < products.length; i++) {
        let item = products[i];
        let addition = document.querySelector('.table-list__item').cloneNode(true);
        //добавить данные
        addition.querySelector('.product-line__image-picture').setAttribute('href', item['PICTURE']);
        addition.querySelector('.product-name').innerHTML = item['NAME'];
        addition.querySelector('.product-article').innerHTML = "Арт. " + item['VENDOR_CODE'];
        addition.querySelector('.price').innerHTML = item['PRICE'];
        /*addition.querySelector('.quantity').innerHTML = item['QUANTITY'];
        addition.querySelector('.credit').innerHTML = "баллы";
        document.querySelector('.notifications__list').appendChild(addition);
        
         */
    }
}


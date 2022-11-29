window.onload = function () {
    //Выполнить пагинацию по клику на кнопке "Показать больше". Кнопка может быть скрыта.
    let buttonShowMore = document.querySelector('.orders__button-more');
    if (buttonShowMore != null) {
        buttonShowMore.addEventListener('click', loadOrders);
    }
    document.querySelector('.card-order__button').addEventListener('click', repeatOrder);
}

function repeatOrder() {
    let result = window.stores.basketStore.repeatOrder(orderId);
    console.log(result);
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
        addition.querySelector('.product-bonus').innerText = item['BONUS'];
        document.querySelector('.table-list__list').appendChild(addition);
    }
}

function hideShowMoreButton() {
    document.querySelector('.orders__button-more').style.display = 'none';
}

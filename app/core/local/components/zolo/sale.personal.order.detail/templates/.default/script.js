window.onload = function () {
    //Выполнить пагинацию по клику на кнопке "Показать больше". Кнопка может быть скрыта.
    let buttonShowMore = document.querySelector('.orders__button-more');
    if (buttonShowMore != null) {
        buttonShowMore.addEventListener('click', loadOrders);
    }
    document.querySelector('.card-order__button').addEventListener('click', repeatOrder);
}

async function repeatOrder() {
    const missedProducts = await window.stores.basketStore.repeatOrder(orderId);

    if (missedProducts.length) {
        const container = $('#orderOutStock .out-stock__list');
        container.find('li').remove();

        for (let product of missedProducts) {
            const li = createElement('li', ['out-stock__item']);
            const article = createElement('article', ['product-line']);
            const div1 = createElement('div', ['product-line__inner']);
            const div2 = createElement('div', ['product-line__info']);
            const div3 = createElement('div', ['product-line__image']);
            const img = createElement('img', ['product-line__image-picture'], [{ name: 'src', value: product.picture }, { name: 'alt', value: product.name }]);
            const div4 = createElement('div', ['product-line__wrapper']);
            const h2 = createElement('h2', ['product-line__title'], [], product.name);
            const p = createElement('p', ['product-line__subtitle'], [], `Арт. ${product.article}`);

            li.append(article);
            article.append(div1);
            div1.append(div2);
            div2.append(div3);
            div3.append(img);
            div2.append(div4);
            div4.append(h2);
            div4.append(p);

            container.append(li);
        }

        $.fancybox.open({
            src: '#orderOutStock',
            baseClass : 'modal',
            btnTpl: {
                smallBtn: '<div data-fancybox-close class="fancybox-close"><svg class="fancybox-close-icon icon icon--close-square" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.17004 14.83L14.83 9.17001" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M14.83 14.83L9.17004 9.17001" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M9 21.9997H15C20 21.9997 22 19.9997 22 14.9997V8.99973C22 3.99973 20 1.99973 15 1.99973H9C4 1.99973 2 3.99973 2 8.99973V14.9997C2 19.9997 4 21.9997 9 21.9997Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></div>',
            },
        });
    } else {
        $.fancybox.open({ src: '#thanks' });
    }
}

function createElement(elementName, elementClasses = [], elementAttributs = [], elementApendText = '') {
    let element = document.createElement(elementName);

    for (let i = 0; i < elementClasses.length; i++) {
        element.classList.add(elementClasses[i]);
    }

    for (let i = 0; i < elementAttributs.length; i++) {
        element.setAttribute(elementAttributs[i].name, elementAttributs[i].value)
    }

    element.append(elementApendText);

    return element;
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
        addition.querySelector('.product-line__image-picture').setAttribute('src', item['PICTURE']);
        addition.querySelector('.product-name').innerText = item['NAME'];
        addition.querySelector('.product-article').innerText = ARTICLE + item['ARTICLE'];
        addition.querySelector('.product-price').innerText = parseFloat(item['PRICE']) + RUBLE_SYMBOL;
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



function getBasketData(orderId, ofset) {
    BX.ajax.runComponentAction('zolo:sale.personal.order.detail', 'loadProducts', {
        mode: 'class',
        data: {
            orderId: orderId,
            offset: ofset,
        }
    }).then(function (response) {
        let basket = JSON.parse(response.data);

        if (basket.basket.PRODUCTS.length == 0) {
            $('div').find('[data-list-id=' + orderId + ']').hide();
        } else {
            setBasketList(basket.basket, orderId);
        }
    }, function (response) {
        console.log("err", response.errors);
    });
}

function setBasketList(data, orderId) {

    let basketTemplate = setBasketTemplate(data)

    $('div[data-list-id= ' + orderId + ']').append(basketTemplate)
}

function setData(data) {
    $.ajax({
        method: 'POST',
        data: {
            data: data
        },
        url: '/ajax/order_list.php',
        success: function (data) {
            $('#order_list').append(data)
        },
        error: function (error) {
            console.log(error);
        },
    });
}

function filteringValues(filterType, value, sort = '') {
    let filter = {
        by: filterType === 'sorting' ? (value != '' ? value : $('#sort').val()) : $('#sort').val(),
        status: filterType === 'status' ? value: $('#STATUS').val(),
        payd: filterType === 'payd' ? value: $('#PAYD').val(),
        order: sort !== '' ? sort: 'asc',
        filter_id: filterType === 'search' ? value : '',
    };
    showMore.style.cssText = '';

    BX.ajax.runComponentAction('zolo:sale.personal.order.list', 'reloadData', {
        mode: 'class',
        data: {
            filter:filter,
            offset: 1,
            limit: size,
        }
    }).then(function (response) {
        let orders = JSON.parse(response.data);
        
        $('#order_list').empty();
        offset = orders.offset;
        if (Object.keys(orders.orders.ORDERS).length == 0) {
            setData('Ничего не найдено');
            showMore.style.cssText = 'display:none;';
        } else {
            if (orders.last) {
                showMore.style.cssText = 'display:none;';
                setData(orders);
            } else {
                setData(orders);
            }
        }

    }, function (response) {
        console.log(123, "err", response.errors);
    });
}

function setBasketTemplate(data) {
    let basketObject = data.PRODUCTS;

    if (typeof basketObject !== 'object' || basketObject.length === 0) {
        return [];
    }

    let template = createElement('ul', ['table-list__list']);

    for (let [key, item] of Object.entries(basketObject)) {
        let li = createElement('li', ['table-list__item']);
        let article = createElement('article', ['product-line']);
        let div = createElement('div', ['product-line__inner']);
        let innerDiv = createElement('div', ['product-line__info']);
        let innerDiv2 = createElement('div', ['product-line__image']);
        let img = createElement(
            'img',
            ['product-line__image-picture'],
            [
                {name: 'alt', value: item.NAME ?? ''},
                {name: 'src', value: item.PICTURE ?? '#'}
            ]
        );

        innerDiv2.append(img);
        innerDiv.append(innerDiv2);

        delete innerDiv2;

        innerDiv2 = createElement('div', ['product-line__wrapper']);
        let h2 = createElement('h2', ['product-line__title'], [], item.NAME ?? '#');
        let p = createElement('p', ['product-line__subtitle'], [], 'Арт. ' + (item.VENDOR_CODE ?? ''));

        innerDiv2.append(h2);
        innerDiv2.append(p);
        innerDiv.append(innerDiv2);
        div.append(innerDiv);

        delete innerDiv2;
        delete innerDiv;
        delete h2;
        delete p;

        innerDiv = createElement('div', ['product-line__characteristic']);
        let innerUl = createElement('ul', ['product-line__list']);
        let innerLi = createElement('li', ['product-line__params', 'product-line__params--span']);
        p = createElement('p', ['product-line__text']);
        let span = createElement('span', ['product-line__params-name'], [], 'Цена:');

        p.append(span);

        delete span;

        span = createElement('span', ['product-line__params-value'], [], numberFormat(item.PRICE) ?? '0');

        p.append(span);

        delete span;

        innerLi.append(p);
        innerUl.append(innerLi);

        delete innerLi;
        delete p;

        innerLi = createElement( 'li', ['product-line__params']);
        p = createElement('p', ['product-line__text']);
        span = createElement('span', ['product-line__params-name'], [], 'Количество:');

        p.append(span);

        delete span;

        span = createElement('span', ['product-line__params-value'], [], numberFormat(item.QUANTITY) ?? '0');

        p.append(span);

        delete span;

        innerLi.append(p);
        innerUl.append(innerLi);

        delete innerLi;
        delete p;

        innerLi = createElement('li', ['product-line__params']);
        p = createElement('p', ['product-line__text']);
        span = createElement('span', ['product-line__params-name'], [], 'Сумма баллов:');

        p.append(span);

        delete span;

        span = createElement('span', ['product-line__params-value'], [], numberFormat(item.BONUS) ?? 0 + ' ББ');

        p.append(span);

        delete span;

        innerLi.append(p);
        innerUl.append(innerLi);

        innerDiv.append(innerUl);
        div.append(innerDiv);
        article.append(div);
        li.append(article);

        delete p;
        delete innerLi;
        delete innerUl;
        delete div;
        delete li;

        template.append(li);
    }

    return template;
}

function numberFormat(number) {
    return Intl.NumberFormat('ru-RU', {maximumSignificantDigits: 2}).format(number);
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

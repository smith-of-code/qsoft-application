

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
            console.log("err", error);
        },
    });
}

function setSortingType() {
    let orderSort = '';
    let sorting = $('#SORTING');

    if (sorting.hasClass('asc')) {
        sorting.removeClass('asc');
        sorting.addClass('desc');
        orderSort = 'ASC';
    } else {
        sorting.addClass('asc');
        sorting.removeClass('desc');
        orderSort = 'DESC';
    }

    return orderSort;
}

function clearFilters() {
    $('#PAYD').val(null).trigger('change');
    $('#STATUS').val([]).trigger('change');
    $('#SORTING_BY').val(null).trigger('change')
}

function clearSearch() {
    $('#filter_id').val(null);
}

function filteringValues(filterType, value, sort = '') {
    let filter = {};
    if (filterType === 'search') {
        filter = {by: '', status: '', payd: '', order: '', filter_id: value ?? ''};
        clearFilters();
    } else {
        filter = {
            by: filterType === 'sorting' ? (value != '' ? value : $('#SORTING_BY').val()) : $('#SORTING_BY').val(),
            status: filterType === 'status' ? value: $('#STATUS').val(),
            payd: filterType === 'payd' ? value: $('#PAYD').val(),
            order: sort !== '' ? sort: 'asc',
            filter_id: '',
        };
        clearSearch();
        window.history.replaceState(null, null, "?filter_id=" + $('#filter_id').val());
    }
    showMore.style.cssText = 'display:none;';
    console.log(filter);
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

                setTimeout(() => { showMore.style.cssText = ''; }, 1000);
                
            }
        }

    }, function (response) {
        console.log("err", response.errors);
    });
}

function showMoreDisplay(showMore) {
    showMore.style.cssText = '';
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
        let h2 = createElement('a', ['product-line__title'], [], item.NAME ?? '#');
        h2.href = item.DETAIL_PAGE;
        let p = createElement('p', ['product-line__subtitle'], [], 'Арт. ' + (item.ARTICLE ?? ''));

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

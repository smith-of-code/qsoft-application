

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
    let productCartLength = data.PRODUCTS.length;
    let maxProducts = 5;
    let basketTemplate = setBasketTemplate(data, maxProducts)

    $('div[data-list-id= ' + orderId + ']').append(basketTemplate['template'])
    if (basketTemplate['i'] === maxProducts && productCartLength > 5) {
        $('[data-look-all=' + orderId + ']').show()
    }

    $('[data-look-all=' + orderId + ']').on('click', function(e) {
        e.stopPropagation();
    })
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
        orderSort = 'DESC';
    } else {
        sorting.addClass('asc');
        sorting.removeClass('desc');
        orderSort = 'ASC';
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
            order: sort !== '' ? sort : 'desc',
            filter_id: '',
        };
        clearSearch();
        window.history.replaceState(null, null, "?filter_id=" + $('#filter_id').val());
    }
    showMore.style.cssText = 'display:none;';
    BX.ajax.runComponentAction('zolo:sale.personal.order.list', 'reloadData', {
        mode: 'class',
        data: {
            filter: filter,
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

function setBasketTemplate(data, maxProducts) {
    let basketObject = data.PRODUCTS;

    if (typeof basketObject !== 'object' || basketObject.length === 0) {
        return [];
    }

    let template = createElement('ul', ['table-list__list']);

    let i = 0
    for (let [key, item] of Object.entries(basketObject)) {
        if (i < maxProducts) {
            i++
        } else {
            break;
        }
        let li = createElement('li', ['table-list__item']);
        let article = createElement('article', isConsultant ? ['product-line'] : ['product-line', 'product-line--common']);
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
        let p = createElement('p', ['product-line__subtitle'], [], 'Арт. ' + (item.ARTICLE ?? ''));
        let a = createElement('a', ['product-line__link'], []);
        a.href = item.DETAIL_PAGE;

        innerDiv2.append(h2);
        innerDiv2.append(p);
        innerDiv.append(innerDiv2);
        div.append(innerDiv);
        article.append(a)

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

        span = createElement('span', ['product-line__params-value'], [{name: 'data-item-price', value: `${item.PRICE}` ?? '0'},]);
        spanWhole = createElement('span', ['product-line__params-value--whole'], []);
        spanRemains = createElement('span', ['product-line__params-value--remains'], []);
        
        span.append(spanWhole, spanRemains)
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

        innerLi = createElement('li', ['product-line__params', 'product-line__params--bold', !isConsultant ? 'product-line__params--hidden' : 'product-line__params--visible' ]);
        p = createElement('p', ['product-line__text']);
        span = createElement('span', ['product-line__params-name'], [], 'Сумма баллов:');

        if (isConsultant) {
            p.append(span);
        }

        delete span;

        if (isConsultant) {
            span = createElement('span', ['product-line__params-value'], [], (numberFormat(item.BONUSES) ?? 0) + ' ББ');
            p.append(span);
            delete span;
        }

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

    return {template, i};
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

$( document ).ready(function() {
    const orderItems = $(".cards-order__item");
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

    function transformValue(items, type) {
        if (type === "product") {
            items.each(function (index, item) {
                const orderItemPrice = $(item).find('.product-line__params-value');
                const orderItemPriceAttr = orderItemPrice.attr('data-item-price')
                const orderItemPriceVal = orderItemPriceAttr?.replace(/\s/g,'').replace(/,/g, '.');
                const spanWhole = orderItemPrice.find(".product-line__params-value--whole");
                const spanRemains = orderItemPrice.find(".product-line__params-value--remains");
    
                if (orderItemPriceVal) {
                    rountedPrice(orderItemPriceVal, spanWhole, spanRemains);
                }
            });
        } else {
            items.each(function (index, item) {
                const orderItemPrice = $(item).find('.price__calculation-value');
                const orderItemPriceVal = orderItemPrice.attr('data-order-price').replace(/\s/g,'').replace(/,/g, '.');
                const spanWhole = orderItemPrice.find(".price__calculation-value--whole");
                const spanRemains = orderItemPrice.find(".price__calculation-value--remains");
    
                if (orderItemPriceVal) {
                    rountedPrice(orderItemPriceVal, spanWhole, spanRemains);
                }
            });
        }
    }
    transformValue(orderItems);

    let mutationObserver = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            const targetRender = mutation.target;
            const orderItems = $(targetRender).find('.cards-order__item');
            const orderItem = $(targetRender).find('.table-list__item');
       
            transformValue(orderItems);
            transformValue(orderItem, 'product');
        });
      });

    mutationObserver.observe(document.documentElement, {
        attributes: true,
        characterData: true,
        childList: true,
        subtree: true,
        attributeOldValue: true,
        characterDataOldValue: true
    });

});

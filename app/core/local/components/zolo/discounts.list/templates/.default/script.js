window.onload = function () {
    document.querySelector('.button--show')?.addEventListener('click', loadDiscounts);
}

function loadDiscounts() {
    BX.ajax.runComponentAction('zolo:discounts.list', 'loadDiscounts', {
        mode: 'class',
        data: {
            offset: offset
        },
    }).then(function (response) {
        offset = response['data']['OFFSET'];
        attach(response['data']['ITEMS']);
        if (response['data']['LAST']) {
            hideShowMoreButton();
        }
    }, function (response) {
        console.log(response['errors']);
    });
}

function attach(discounts) {
    for (let i = 0; i < discounts.length; i++) {
        let discount = discounts[i];
        let addition = document.querySelector('.cards-sale__item').cloneNode(true);
        addition.querySelector('.card-compilation__text-accent').innerText = discount['ACCENT'];
        addition.querySelector('.sale-text').innerText = discount['TEXT'];
        addition.querySelector('.card-compilation__banner-image').setAttribute('src', discount['PICTURE']);
        addition.querySelector('.card-compilation__link').setAttribute('href', discount['CATALOG']);
        addition.querySelector('.card-compilation__label').innerText = '-' + discount['DISCOUNT'] + '%';
        addition.querySelector('.card-compilation__label').style.display = parseInt(discount['DISCOUNT']) ? 'block' : 'none';
        document.querySelector('.cards-sale__list').appendChild(addition);
    }
}

function hideShowMoreButton() {
    document.querySelector('.button--show').style.display = 'none';
}
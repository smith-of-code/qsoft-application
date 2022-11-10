window.onload = function () {
    document.querySelector('.show-more').addEventListener('click', loadDiscounts);
}

function loadDiscounts() {
    BX.ajax.runComponentAction('zolo:discounts.list', 'loadDiscounts', {
        mode: 'class',
        data: {
            offset: offset
        },
    }).then(function (response) {
        console.log(response);
        offset = response['data']['OFFSET'];
        attach(response['data']['ITEMS']);
    }, function (response) {
        console.log(response);
    });
}

function attach($discounts) {
    $titles = ['ID', 'TEXT', 'PICTURE', 'DISCOUNT', 'CATALOG'];
    let page = document.querySelector('.discounts');
    for (let i = 0; i < $discounts.length; i++) {
        let discount = document.createElement('div');
        discount.classList.add("discount-item");
        for (let j = 0; j < Object.keys($discounts[i]).length; j++) {
            let p = document.createElement('p');
            p.innerHTML = $titles[j] + " --- " + $discounts[i][$titles[j]];
            discount.appendChild(p);
        }
        page.appendChild(discount);
    }


}
export default function showSupportPopup() {
    let element = document.createElement('div');
    element.style.cssText = 'width:100%; height:100%; display:block; position:fixed; top:0; left:0;bacgrownd-color: #000000;';
    element.append('text');
    let body = $('body');
    body.append(element);
    
    BX.ajax.runComponentAction('zolo:techsupport.form.handler', 'load', {
        mode: 'class',
        data: {
            offset: offset,
            limit: size
        }
    }).then(function (response) {
        let orders = JSON.parse(response.data);

        console.log("ok", orders);
        add(orders);
        offset = orders.offset;
        if (orders.last) {
            showMore.innerHTML = 'Заказы закончились';
        }
    }, function (response) {
        console.log("err", response.errors);
    });
}
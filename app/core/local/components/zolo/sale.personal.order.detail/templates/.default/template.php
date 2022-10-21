<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>

<h3>Детали заказа</h3>
<? $details = $arResult['ORDER_DETAILS'];?>
Номер заказа - <?=$details['ORDER_ID']?></br>
Дата создания заказа - <?= $details['CREATED_AT']?></br>
Кем создан - <?=$details['CREATED_BY']?></br>
Статус заказа - <?=$details['ORDER_STATUS']?></br>
Статус оплаты - <?=$details['IS_PAID'] ? 'Оплачен' : 'Неоплачен'?></br>
Стоимость заказа - <?=$details['TOTAL_PRICE']?></br>
Акция - <?=$details['VOUCHER_USED'] ? "Да" : "Нет"?>

<div id="productList">
    <div>
        <? foreach ($arResult['PRODUCTS'] as $product) :?>
        товар:</br>
        Название - <?=$product['NAME']?></br>
        Цена - <?=$product['PRICE']?></br>
        Количество - <?=$product['QUANTITY']?></br>
        Артикул - <?=$product['ARTICLE']?></br>
        Картинка - <?=$product['PICTURE']?></br>
        <?endforeach;?>
    </div>
</div>

<button id="button" onclick="loadProducts()">Показать еще</button>

<script>
    const allProductsId = <?=json_encode($arResult['ALL_PRODUCTS_ID'])?>;
    const limit = <?=$arResult['LIMIT']?>;
    const orderId = <?=$arParams['ORDER_ID']?>;
    let offset = <?=$arResult['OFFSET']?>;

    function loadProducts() {
        BX.ajax.runComponentAction('zolo:sale.personal.order.detail', 'loadProducts', {
            mode: 'class',
            data: {
                allProductsId: allProductsId,
                offset: offset,
                limit: limit,
                orderId: orderId
            }
        }).then(function (response) {
            
            console.log(response);
            offset = response['data']['OFFSET'];
            attach(response['data']['PRODUCTS']);

        }, function (response) {
            alert("Ошибка при вызове метода компонента-контроллера")
        });
    }

    function attach(products) {
        for (let i = 0; i < Object.keys(products).length; i++) {
            let div = document.createElement('div');
            div.innerHTML += "товар:" + "<br>";
            div.innerHTML += "Название" + " - " + products[i]['NAME'] + "<br>";
            div.innerHTML += "Цена" + " - " + products[i]['PRICE'] + "<br>";
            div.innerHTML += "Количество" + " - " + products[i]['QUANTITY'] + "<br>";
            div.innerHTML += "Артикул" + " - " + products[i]['VENDOR_CODE'] + "<br>";
            div.innerHTML += "Картинка" + " - " + products[i]['PICTURE'] + "<br>";
            document.getElementById("productList").appendChild(div);
        }
    }

</script>

<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main,
	Bitrix\Main\Localization\Loc,
	Bitrix\Main\Page\Asset;

Loc::loadMessages(__FILE__);

dump($arResult['ORDERS']);
if (!empty($arResult['ERRORS']['FATAL'])) {
	foreach($arResult['ERRORS']['FATAL'] as $error) {
		ShowError($error);
	}
	$component = $this->__component;
	if ($arParams['AUTH_FORM_IN_TEMPLATE'] && isset($arResult['ERRORS']['FATAL'][$component::E_NOT_AUTHORIZED])) {
		$APPLICATION->AuthForm('', false, false, 'N', false);
	}
}
else {
	if (!empty($arResult['ERRORS']['NONFATAL'])) {
		foreach($arResult['ERRORS']['NONFATAL'] as $error) {
			ShowError($error);
		}
	}
}

?>
<a href="" id="showMore">Еще</a>
<div id="items"> </div>
<script>
    let offset = <?=$arResult['OFFSET'] ?? 1?>;
    let size = <?=$arParams['ORDERS_PER_PAGE']?>;
    showMore.onclick = function (e) {
        console.log('TT');
        e.preventDefault();
        BX.ajax.runComponentAction('zolo:sale.personal.order.list', 'load', {
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

    function add(items) {
        let s = 'ORDER: ';
        items.orders.forEach(function (order, i) {
            let item = order.ORDER;
                (Object.keys(item)).forEach(function (key,v, row) {
                    s += key + ' - ' + item[key]  + '<br>';
                    if (key == 'PROPERTIES') {
                        (Object.keys(item[key])).forEach(function (prop,v, row) {
                            s += '&nbsp;&nbsp;&nbsp;&nbsp;' +  prop + ' - ' + item[key][prop]  + '<br>';
                        });
                    }
                });
                s += '<br>';
        });
        document.getElementById('items').innerHTML += s;
    }
</script>

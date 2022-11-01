<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

if (!empty($arResult['ERRORS']['FATAL'])) {
	foreach($arResult['ERRORS']['FATAL'] as $error) {
		ShowError($error);
	}
	$component = $this->__component;
	if ($arParams['AUTH_FORM_IN_TEMPLATE'] && isset($arResult['ERRORS']['FATAL'][$component::E_NOT_AUTHORIZED])) {
		$APPLICATION->AuthForm('', false, false, 'N', false);
	}
} else {
	if (!empty($arResult['ERRORS']['NONFATAL'])) {
		foreach($arResult['ERRORS']['NONFATAL'] as $error) {
			ShowError($error);
		}
	}
}
if (!empty($arResult) && empty($arResult['ERRORS'])): ?>

<h1 class="page__heading"><?=$APPLICATION->showTitle() ?></h1>

<div class="content__main">
    <div class="private__row">
        <div class="private__col private__col--limited">
            <nav class="private__menu menu menu--private">
                <ul class="menu__list">
                    <li class="menu__item">
                        <a href="#" class="menu__link">
                            <span class="menu__icon">
                                <svg class="icon icon--profile gui__icon">
                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-profile"></use>
                                </svg>
                            </span>
                            <span class="menu__text">
                                Профиль
                            </span>
                        </a>
                    </li>

                    <li class="menu__item  menu__item--active">
                        <a href="#" class="menu__link">
                            <span class="menu__icon menu__icon--active">
                                <svg class="icon icon--receipts gui__icon">
                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-receipts"></use>
                                </svg>
                            </span>
                            <span class="menu__text">
                                История заказов
                            </span>
                        </a>
                    </li>

                    <li class="menu__item">
                        <a href="#" class="menu__link">
                            <span class="menu__icon">
                                <svg class="icon icon--calculator gui__icon">
                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-calculator"></use>
                                </svg>
                            </span>
                            <span class="menu__text">
                                Калькулятор доходности
                            </span>
                        </a>
                    </li>

                    <li class="menu__item">
                        <a href="#" class="menu__link">
                            <span class="menu__icon">
                                <svg class="icon icon--chart-square gui__icon">
                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-chart-square"></use>
                                </svg>
                            </span>
                            <span class="menu__text">
                                Отчетность по объемам продаж
                            </span>
                        </a>
                    </li>

                    <li class="menu__item">
                        <a href="#" class="menu__link">
                            <span class="menu__icon">
                                <svg class="icon icon--notification gui__icon">
                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-notification"></use>
                                </svg>
                            </span>
                            <span class="menu__text">
                                Уведомления
                            </span>
                            <span class="menu__counter">10</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="private__col private__col--full">
            <div class="orders">
                <?$APPLICATION->IncludeComponent("zolo:sale.personal.order.filter", "", []);?>
                    <section class="orders__section">
                        <div class="cards-order">
                            <ul class="cards-order__list" id="order_list">

                                <!-- Карточка заказа -->
                                <?php foreach ($arResult['ORDERS'] as $order): ?>
                                    <?php $paid = $order['ORDER']['PAYED'] == 'Y'; ?>
                                    <li class="cards-order__item">
                                        <article class="card-order card-order--green">
                                            <div class="card-order__inner">
                                                <header class="card-order__header">
                                                    <a href="#" class="card-order__link"></a>
                                                    <ul class="card-order__list">
                                                        <li class="card-order__item">
                                                            <h2 class="card-order__title">
                                                                Заказ от <?=$order['ORDER']['DATE_INSERT_FORMATED'] ?>
                                                            </h2>
                                                            <p class="card-order__subtitle">
                                                                №<?=$order['ORDER']['ID'] ?>
                                                            </p>
                                                        </li>

                                                        <li class="card-order__item card-order__item--span">
                                                            <div class="info-slot">
                                                                <p class="info-slot__name">
                                                                    Кем заказан
                                                                </p>
                                                                <p class="info-slot__value">
                                                                    <?=$order['ORDER']['FIO'] ?>
                                                                </p>
                                                            </div>
                                                        </li>

                                                        <li class="card-order__item card-order__item--delivery">
                                                            <div class="info-slot">
                                                                <p class="info-slot__name">
                                                                    Статус заказа
                                                                </p>
                                                                <p class="info-slot__value info-slot__value--marked">
                                                                    <?=$arResult['INFO']['STATUS'][$order['ORDER']['STATUS_ID']]['NAME'] ?>
                                                                </p>
                                                            </div>
                                                        </li>

                                                        <li class="card-order__item card-order__item--pay">
                                                            <div class="info-slot">
                                                                <p class="info-slot__name">
                                                                    Статус оплаты
                                                                </p>
                                                                <p class="info-slot__value info-slot__value--icon">
                                                                    <span class="info-slot__icon">
                                                                        <svg class="icon icon--credit-not-paid info-slot__icon-mark"> 
                                                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-credit-<?=$paid ? 'paid' : 'not-paid' ?>"></use>
                                                                        </svg>
                                                                    </span>
                                                                    <?=$paid ? 'Оплачен' : 'Не оплачен' ?>
                                                                </p>
                                                            </div>
                                                        </li>

                                                        <li class="card-order__item">
                                                            <div class="card-order__price price">
                                                                <div class="price__calculation price__calculation--columned">
                                                                    <p class="price__calculation-total price__calculation-total--has-icon">
                                                                        <span class="price__calculation-picture">
                                                                            <svg class="icon icon--cart-card price__calculation-icon tooltip" data-tippy-content="применена персональная акция" data-tippy-placement="bottom-start">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-cart-card"></use>
                                                                            </svg>
                                                                        </span>
                                                                        <span class="price__calculation-value">
                                                                            <?=$order['ORDER']['FORMATED_PRICE']?>
                                                                        </span>
                                                                    </p>
                                                                    <p class="price__calculation-accumulation"><?=$order['ORDER']['PROPERTIES']['POINTS'] ?? 0 ?> ББ</p>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </header>

                                                <div class="card-order__content">
                                                    <div class="accordeon__item box" data-accordeon>
                                                        <div class="accordeon__header" data-accordeon-toggle>
                                                            <h6 class="accordeon__title">Состав заказа</h6>

                                                            <button type="button" class="accordeon__toggle button button--circular button--mini button--covered button--red-white">
                                                                <span class="accordeon__toggle-icon button__icon">
                                                                    <svg class="icon icon--arrow-down">
                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-down"></use>
                                                                    </svg>
                                                                </span>
                                                            </button>

                                                        </div>

                                                        <div class="accordeon__body" data-accordeon-content>
                                                            
                                                            <div class="table-list">
                                                                <div class="table-list__head">
                                                                    <div class="table-list__cell">
                                                                        <p class="table-list__name">
                                                                            Наименование
                                                                        </p>
                                                                    </div>
                                                                    <div class="table-list__cell table-list__cell--desktop">
                                                                        <p class="table-list__name">
                                                                            Цена
                                                                        </p>
                                                                    </div>
                                                                    <div class="table-list__cell table-list__cell--desktop">
                                                                        <p class="table-list__name">
                                                                            Количество
                                                                        </p>
                                                                    </div>
                                                                    <div class="table-list__cell table-list__cell--desktop">
                                                                        <p class="table-list__name">
                                                                            Сумма баллов
                                                                        </p>
                                                                    </div>
                                                                </div>

                                                                <ul class="table-list__list">

                                                                    <?php foreach ($order['BASKET_ITEMS'] as $productId => $product): ?>
                                                                        <!-- <?//=$product['DETAIL_PAGE_URL']?> - ссылка для детальной страницы товара -->
                                                                        <li class="table-list__item">

                                                                            <article class="product-line">
                                                                                <div class="product-line__inner">
                                                                                    <div class="product-line__info">
                                                                                        <div class="product-line__image">
                                                                                            <img src="<?=$order['PRODUCT_ADDITIONAL_DATA'][$product['PRODUCT_ID']]['IMAGE_SRC']?>" alt="#" class="product-line__image-picture">
                                                                                        </div>
                                                                                        <div class="product-line__wrapper">
                                                                                            <h2 class="product-line__title">
                                                                                                <?=$product['NAME']?>
                                                                                            </h2>
                                                                                            <p class="product-line__subtitle">
                                                                                                Арт. <?=$order['PRODUCT_ADDITIONAL_DATA'][$product['PRODUCT_ID']]['ARTICLE']?>
                                                                                            </p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="product-line__characteristic">
                                                                                        <ul class="product-line__list">
                                                                                            <li class="product-line__params product-line__params--span">
                                                                                                <p class="product-line__text">
                                                                                                    <span class="product-line__params-name">
                                                                                                        Цена:
                                                                                                    </span>
                                                                                                    <span class="product-line__params-value">
                                                                                                <?=number_format($product['PRICE'], 2, '.', ' ')?> ₽
                                                                                                    </span>
                                                                                                </p>
                                                                                            </li> 
                                                                                            <li class="product-line__params">
                                                                                                <p class="product-line__text">
                                                                                                    <span class="product-line__params-name">
                                                                                                        Количество:
                                                                                                    </span>
                                                                                                    <span class="product-line__params-value">
                                                                                                <?=$product['QUANTITY']?>
                                                                                                    </span>
                                                                                                </p>
                                                                                            </li> 
                                                                                            <li class="product-line__params product-line__params--bold">
                                                                                                <p class="product-line__text">
                                                                                                    <span class="product-line__params-name">
                                                                                                        Сумма баллов:
                                                                                                    </span>
                                                                                                    <span class="product-line__params-value">
                                                                                                    <?=$product['POINTS'] ?? 0?> ББ
                                                                                                    </span>
                                                                                                </p>
                                                                                            </li> 
                                                                                        </ul>
                                                                                    </div>
                                                                                </div>
                                                                            </article>

                                                                        </li>
                                                                    <?php endforeach; ?>

                                                                </ul>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </article>
                                    </li>
                                <?php endforeach; ?>

                            </ul>
                        </div>

                        <button type="button" id="showMore" class="orders__button button button--rounded button--outlined button--green button--full">Показать больше</button>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#PAYD').on('select2:close', function(){
            filteringValues('payd', $(this).val());
                
        });

        $('#STATUS').on('select2:close', function(){
            filteringValues('status', $(this).val());
        });

        $('#SORTING').on('click', function(){
            let orderSort = '';
            if ($('#SORTING').hasClass('asc')) {
                $(this).removeClass('asc');
                $(this).addClass('desc');
                orderSort = 'ASC';
            } else {
                $(this).addClass('asc');
                $(this).removeClass('desc');
                orderSort = 'DESC';
            }
            console.log(orderSort);
            filteringValues('sorting', $('#sort').val(), orderSort);
        });
    });

    function filteringValues(filterType, value, sort = '') {
        let filter = {
            by: filterType == 'sorting' ? (value != '' ? value : $('#sort').val()) : $('#sort').val(),
            status: filterType == 'status' ? value: $('#STATUS').val(),
            payd: filterType == 'payd' ? value: $('#PAYD').val(),
            order: sort != '' ? sort: 'asc',
        };
        
        console.log(filter, $('#sort').val(), $('#STATUS').val(), $('#PAYD').val());

        BX.ajax.runComponentAction('zolo:sale.personal.order.list', 'reloadData', {
            mode: 'class',
            data: {
                filter:filter
            }
        }).then(function (response) {
            let orders = JSON.parse(response.data);
            console.log("ok", orders);
            
            $('#order_list').empty()
            setData(orders);

        }, function (response) {
            console.log(123, "err", response.errors);
        });
    }

    let offset = <?=$arResult['OFFSET'] ?? 1?>;
    let size = <?=$arParams['ORDERS_PER_PAGE']?>;

    showMore.onclick = function (e) {
        let filter = {
            by: filterType == 'sorting' ? (value != '' ? value : $('#sort').val()) : $('#sort').val(),
            status: filterType == 'status' ? value: $('#STATUS').val(),
            payd: filterType == 'payd' ? value: $('#PAYD').val(),
            order: sort != '' ? sort: 'asc',
        };
        console.log('TT');
        e.preventDefault();
        BX.ajax.runComponentAction('zolo:sale.personal.order.list', 'load', {
            mode: 'class',
            data: {
                offset: offset,
                limit: size,
                filter: filter
            }
        }).then(function (response) {
            let orders = JSON.parse(response.data);

            console.log("ok", orders);
            offset = orders.offset;
            if (orders.last) {
                showMore.innerHTML = 'Заказы закончились';
            } else {
                setData(orders);
            }
        }, function (response) {
            console.log("err", response.errors);
        });
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
</script>
<?php endif; ?>
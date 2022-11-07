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

$this->addExternalJS($this->GetFolder(). "/script.js"); 

if (!empty($arResult) && empty($arResult['ERRORS'])): ?>

    <div class="private__row">

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
                                                                <?=getMessage('ORDER_FROM') ?> <?=$order['ORDER']['DATE_INSERT_FORMATED'] ?>
                                                            </h2>
                                                            <p class="card-order__subtitle">
                                                            <?=getMessage('ORDER_NUMBER') ?><?=$order['ORDER']['ID'] ?>
                                                            </p>
                                                        </li>

                                                        <li class="card-order__item card-order__item--span">
                                                            <div class="info-slot">
                                                                <p class="info-slot__name">
                                                                    <?=getMessage('ORDER_USER') ?>
                                                                </p>
                                                                <p class="info-slot__value">
                                                                    <?=$order['ORDER']['FIO'] ?>
                                                                </p>
                                                            </div>
                                                        </li>

                                                        <li class="card-order__item card-order__item--delivery">
                                                            <div class="info-slot">
                                                                <p class="info-slot__name">
                                                                    <?=getMessage('ORDER_STATUS') ?>
                                                                </p>
                                                                <p class="info-slot__value info-slot__value--marked">
                                                                    <?=$arResult['INFO']['STATUS'][$order['ORDER']['STATUS_ID']]['NAME'] ?>
                                                                </p>
                                                            </div>
                                                        </li>

                                                        <li class="card-order__item card-order__item--pay">
                                                            <div class="info-slot">
                                                                <p class="info-slot__name">
                                                                    <?=getMessage('ORDER_PAYD_STATUS') ?>
                                                                </p>
                                                                <p class="info-slot__value info-slot__value--icon">
                                                                    <span class="info-slot__icon">
                                                                        <svg class="icon icon--credit-not-paid info-slot__icon-mark"> 
                                                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-credit-<?=$paid ? 'paid' : 'not-paid' ?>"></use>
                                                                        </svg>
                                                                    </span>
                                                                    <?=$paid ? getMessage('ORDER_PAYD') : getMessage('ORDER_NOT_PAYD') ?>
                                                                </p>
                                                            </div>
                                                        </li>

                                                        <li class="card-order__item">
                                                            <div class="card-order__price price">
                                                                <div class="price__calculation price__calculation--columned">
                                                                    <p class="price__calculation-total price__calculation-total--has-icon">
                                                                        <?php if ($order['ORDER']['PERSONAL_DISCOUNT']): ?>
                                                                            <span class="price__calculation-picture">
                                                                                <svg class="icon icon--cart-card price__calculation-icon tooltip" data-tippy-content="<?=getMessage('ORDER_PERSONAL_ACTION') ?>" data-tippy-placement="bottom-start">
                                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-cart-card"></use>
                                                                                </svg>
                                                                            </span>
                                                                        <?php endif; ?>
                                                                        <span class="price__calculation-value">
                                                                            <?=$order['ORDER']['FORMATED_PRICE']?>
                                                                        </span>
                                                                    </p>
                                                                    <p class="price__calculation-accumulation"><?=$order['ORDER']['PROPERTIES']['POINTS'] ?? 0 ?> <?=getMessage('ORDER_BB') ?></p>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </header>

                                                <div class="card-order__content">
                                                    <div class="accordeon__item box" data-accordeon>
                                                        <div class="accordeon__header" button-id="<?=$order['ORDER']['ID'] ?>" data-accordeon-toggle>
                                                            <h6 class="accordeon__title"><?=getMessage('ORDER_COMPOSITION') ?></h6>

                                                            <button type="button" class="accordeon__toggle button button--circular button--mini button--covered button--red-white">
                                                                <span class="accordeon__toggle-icon button__icon">
                                                                    <svg class="icon icon--arrow-down">
                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-down"></use>
                                                                    </svg>
                                                                </span>
                                                            </button>

                                                        </div>

                                                        <div class="accordeon__body" data-accordeon-content>
                            
                                                            <div class="table-list" data-list-id="<?=$order['ORDER']['ID'] ?>">
                                                                <div class="table-list__head">
                                                                    <div class="table-list__cell">
                                                                        <p class="table-list__name">
                                                                            <?=getMessage('PRODUCT_NAME') ?>
                                                                        </p>
                                                                    </div>
                                                                    <div class="table-list__cell table-list__cell--desktop">
                                                                        <p class="table-list__name">
                                                                            <?=getMessage('PRODUCT_PRICE') ?>
                                                                        </p>
                                                                    </div>
                                                                    <div class="table-list__cell table-list__cell--desktop">
                                                                        <p class="table-list__name">
                                                                            <?=getMessage('PRODUCT_COUNT') ?>
                                                                        </p>
                                                                    </div>
                                                                    <div class="table-list__cell table-list__cell--desktop">
                                                                        <p class="table-list__name">
                                                                            <?=getMessage('PRODUCT_BB') ?>
                                                                        </p>
                                                                    </div>
                                                                </div>
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

                        <button type="button" id="showMore" class="orders__button button button--rounded button--outlined button--green button--full"><?=getMessage('SHOW_MORE') ?></button>
                    </section>
                </div>
            </div>
        </div>
    </div>
<script>
    let offset = <?=$arResult['OFFSET'] ?? 1?>;
    let size = <?=$arParams['ORDERS_PER_PAGE']?>;
    let basketOfset = 0;
    console.log(offset);
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

        $('div').one('click', function () {
            if ($(this).attr('button-id') !== undefined) {
                getBasketData($(this).attr('button-id'), basketOfset);
            }
        });

        $('#search_button').on('click', function () {
            if ($('#filter_id').val() != '') {
                filteringValues('search', $('#filter_id').val());
            }
        });

    });

    function filteringValues(filterType, value, sort = '') {
        let filter = {
            by: filterType === 'sorting' ? (value != '' ? value : $('#sort').val()) : $('#sort').val(),
            status: filterType === 'status' ? value: $('#STATUS').val(),
            payd: filterType === 'payd' ? value: $('#PAYD').val(),
            order: sort !== '' ? sort: 'asc',
            filter_id: filterType === 'search' ? value : '',
        };
        showMore.style.cssText = '';
        console.log(filter, $('#sort').val(), $('#STATUS').val(), $('#PAYD').val());

        BX.ajax.runComponentAction('zolo:sale.personal.order.list', 'reloadData', {
            mode: 'class',
            data: {
                filter:filter,
                offset: 1,
                limit: size,
            }
        }).then(function (response) {
            let orders = JSON.parse(response.data);
            console.log("filter", orders);
            
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

    showMore.onclick = function (e) {
        let filter = {
            by:  $('#sort').val(),
            status:  $('#STATUS').val(),
            payd:  $('#PAYD').val(),
            order: $('#SORTING').hasClass('desc') ? 'desc' : 'asc',
        };

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

            console.log("page", orders);
            offset = orders.offset;
            if (orders.last) {
                showMore.style.cssText = 'display:none;';
                setData(orders);
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

    function getBasketData(orderId, ofset) {
        console.log(orderId, ofset);
        BX.ajax.runComponentAction('zolo:sale.personal.order.detail', 'loadProducts', {
            mode: 'class',
            data: {
                orderId: orderId,
                offset: ofset,
            }
        }).then(function (response) {
            let basket = JSON.parse(response.data);

            console.log("basket", basket);
            if (basket.basket.PRODUCTS.length == 0) {
                $('div').find('[data-list-id=' + orderId + ']').hide();
            }
            setBasketList(basket.basket, orderId);
        }, function (response) {
            console.log("err", response.errors);
        });
    }

    function setBasketList(data, orderId) {
        $.ajax({
            method: 'POST',
            data: {
                data: data
            },
            url: '/ajax/order_basket_list.php',
            success: function (data) {
                $('div[data-list-id= ' + orderId + ']').append(data)
            },
            error: function (error) {
                console.log(error);
            },
        });
    }
</script>
<?php endif; ?>
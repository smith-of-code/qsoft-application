<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
use QSoft\Entity\User;
use QSoft\Helper\OrderHelper;

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

$arResult['IS_CONSULTANT'] = (new User)->groups->isConsultant();

$this->addExternalJS($this->GetFolder(). "/script.js");

if (!empty($arResult['ORDERS']) && empty($arResult['ERRORS'])): ?>

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
                                        <article class="card-order card-order--<?=in_array($order['ORDER']['STATUS_ID'], OrderHelper::SUCCESS_STATUSES) ? 'green' : (in_array($order['ORDER']['STATUS_ID'], OrderHelper::FAIL_STATUSES) ? 'red' : 'blue')?>">
                                            <div class="card-order__inner">
                                                <header class="card-order__header">
                                                    <a href="<?=$arParams['SEF_FOLDER'] . $order['ORDER']['ID']?>" class="card-order__link"></a>
                                                    <ul class="card-order__list">
                                                        <li class="card-order__item card-order__item--inlined">
                                                            <h2 class="card-order__title">
                                                                <?=getMessage('ORDER_FROM') ?> <?=$order['ORDER']['DATE_INSERT_FORMATED'] ?>
                                                            </h2>
                                                            <p class="card-order__subtitle">
                                                            <?=getMessage('ORDER_NUMBER') ?><?=$order['ORDER']['ID'] ?>
                                                            </p>
                                                        </li>

                                                        <li class="card-order__item card-order__item--span">
                                                            <div class="info-slot info-slot--inlined">
                                                                <p class="info-slot__name">
                                                                    <?=getMessage('ORDER_USER') ?>
                                                                </p>
                                                                <p class="info-slot__value">
                                                                    <?=$order['ORDER']['PROPERTIES']['NAME'] ?>
                                                                </p>
                                                            </div>
                                                        </li>

                                                        <li class="card-order__item card-order__item--delivery">
                                                            <div class="info-slot">
                                                                <p class="info-slot__value info-slot__value--marked">
                                                                    <?=$arResult['INFO']['STATUS'][$order['ORDER']['STATUS_ID']]['NAME'] ?>
                                                                </p>
                                                            </div>
                                                        </li>

                                                        <li class="card-order__item card-order__item--pay">
                                                            <div class="info-slot info-slot--pay">
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
                                                                        <?php if ($order['ORDER']['PERSONAL_PROMOTION']): ?>
                                                                            <span class="price__calculation-picture">
                                                                                <svg class="icon icon--cart-card price__calculation-icon tooltip" data-tippy-content="<?=getMessage('ORDER_PERSONAL_ACTION') ?>" data-tippy-placement="bottom-start">
                                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-cart-card"></use>
                                                                                </svg>
                                                                            </span>
                                                                        <?php endif; ?>
                                                                        <span class="price__calculation-value"
                                                                            data-order-price="<?=$order['ORDER']['PRICE']?>">
                                                                            <span class="price__calculation-value--whole"></span>
                                                                            <span class="price__calculation-value--remains"></span>
                                                                        </span>
                                                                    </p>
                                                                    <?php if ($arResult['IS_CONSULTANT']):?>
                                                                        <p class="price__calculation-accumulation"><?=$order['ORDER']['BONUSES'] ? number_format($order['ORDER']['BONUSES'], 0, ' ', ' ') : 0?> <?=getMessage('ORDER_BB') ?></p>
                                                                    <?php endif;?>
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
                                                                    <?php if ($arResult['IS_CONSULTANT']):?>
                                                                        <div class="table-list__cell table-list__cell--desktop">
                                                                            <p class="table-list__name">
                                                                                <?=getMessage('PRODUCT_BB') ?>
                                                                            </p>
                                                                        </div>
                                                                    <?php endif;?>
                                                                </div>
                                                            </div>
                                                            <a href="<?=$arParams['SEF_FOLDER'] . $order['ORDER']['ID']?>" class="orders__button button button--rounded button--outlined button--green button--full" data-look-all="<?=$order['ORDER']['ID']?>" style="display:none;"><?=Loc::getMessage("LOOK_ALL")?></a>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </article>
                                    </li>
                                <?php endforeach; ?>

                            </ul>
                        </div>

                        <button type="button" id="showMore" class="orders__button button button--rounded button--outlined button--green button--full" style="<?=$arResult['IS_LAST'] ? 'display:none;' : '' ?>"><?=getMessage('SHOW_MORE') ?></button>
                        <button type="button" id="backToOrders" onClick="window.location.href = '/personal/orders/';" class="orders__button button button--rounded button--outlined button--green button--full" style="display:none;"><?=getMessage('BACK_TO_ORDERS') ?></button>
                    </section>
                </div>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="private__row">
        <div class="private__col private__col--full">
            <div class="orders">
                <?$APPLICATION->IncludeComponent("zolo:sale.personal.order.filter", "", []);?>
                <section class="orders__section">
                    <div class="cards-order">
                        <ul class="cards-order__list" id="order_list">
                            <?php if (isset($_REQUEST['filter_id'])): ?>
                                <h4><?=getMessage('ORDER_NOT_FOUND')?></h4>
                            <?php else: ?>
                                <h4><?=getMessage('EMPTY_ORDER_HISTORY')?></h4>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <?php if (isset($_REQUEST['filter_id'])): ?>
                        <button type="button" id="backToOrders" onClick="window.location.href = '/personal/orders/';" class="orders__button button button--rounded button--outlined button--green button--full"><?=getMessage('BACK_TO_ORDERS') ?></button>
                    <? else: ?>
                        <button type="button" id="showMore" class="orders__button button button--rounded button--outlined button--green button--full" style="display:none;"><?=getMessage('SHOW_MORE') ?></button>
                    <?endif;?>
                </section>
            </div>
        </div>
<?php endif; ?>
<script>
    const isConsultant = <?=$arResult['IS_CONSULTANT'] ? 'true' : 'false'?>;
    let offset = <?=$arResult['OFFSET'] ?? 1?>;
    let size = <?=$arParams['ORDERS_PER_PAGE']?>;
    let basketOfset = 0;
    const SEF_FOLDER = <?=json_encode($arParams['SEF_FOLDER'])?>;

    $(document).ready(function () {
        $('#PAYD').on('select2:close', function(){
            filteringValues('payd', $(this).val());
                
        });

        $('#STATUS').on('select2:close', function(){
            filteringValues('status', $(this).val());
        });

        $('#SORTING_BY').on('select2:close', function() {
            filteringValues('sorting', $('#SORTING_BY').val(), setSortingType());
        });

        $('#SORTING').on('click', function(){
            filteringValues('sorting', $('#SORTING_BY').val(), setSortingType());
        });

        $('div').one('click', function () {
            if ($(this).attr('button-id') !== undefined) {
                getBasketData($(this).attr('button-id'), basketOfset);
            }
        });

        $('#search_button').on('click', function () {
            filteringValues('search', $('#filter_id').val());
            window.history.replaceState(null, null, "?filter_id=" + $('#filter_id').val());
        });

    });

    showMore.onclick = function (e) {
        let filter = {
            by:  $('#SORTING_BY').val(),
            status:  $('#STATUS').val(),
            payd:  $('#PAYD').val(),
            order: $('#SORTING').hasClass('desc') ? 'DESC' : 'ASC',
        };
        // Если метод фильтрации не задан - по умолчанию сортируем по дате создания заказа
        if (filter.by.length === 0) {
            filter.by = 'DATE_INSERT';
        }

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
            orders.sefFolder = SEF_FOLDER;
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
</script>
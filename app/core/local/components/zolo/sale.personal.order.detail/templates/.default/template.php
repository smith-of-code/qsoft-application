<?php
if (! defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Localization\Loc;
use QSoft\Helper\OrderHelper;

$details = $arResult['ORDER_DETAILS'];

$APPLICATION->SetTitle("Заказ №{$details['ORDER_ID']}");

?>
<!--Кнопка "К списку заказов" -->
<a href="/personal/orders/" class="orders__transition button button--back button--simple button--red">
    <span class="button__icon">
        <svg class="icon icon--arrow-left-thin">
            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-left-thin"></use>
        </svg>
    </span>
    <span class="button__text"><?=Loc::getMessage("ORDERS_BUTTON")?></span>
</a>

<section class="orders__section">
    <div class="cards-order">
        <ul class="cards-order__list">
            <li class="cards-order__item">
                <article class="card-order card-order--<?=in_array($details['STATUS_ID'], OrderHelper::SUCCESS_STATUSES) ? 'green' : (in_array($details['STATUS_ID'], OrderHelper::FAIL_STATUSES) ? 'red' : 'blue')?> card-order--divided">
                    <!-- Детали заказа, Состав заказа (товары)-->
                    <div class="card-order__inner">

                        <!-- Детали заказа -->
                        <header class="card-order__header">
                            <ul class="card-order__list">

                                <li class="card-order__item card-order__item--inlined">
                                    <!--№ номер заказа-->
                                    <h2 class="card-order__title ">
                                        <?=Loc::getMessage("ORDER_NUMBER_DETAILS_TABLE")?><?=$details['ORDER_ID']?>
                                    </h2>
                                    <!--Заказ от-->
                                    <p class="card-order__subtitle">
                                        <?=Loc::getMessage("CREATION_DATE_DETAILS_TABLE")?><?=$details['CREATED_AT']?>
                                    </p>
                                </li>

                                <!--Кем заказан-->
                                <li class="card-order__item card-order__item--span">
                                    <div class="info-slot info-slot--inlined">
                                        <p class="info-slot__name">
                                            <?=Loc::getMessage("CREATED_BY_DETAILS_TABLE")?>
                                        </p>
                                        <p class="info-slot__value">
                                            <?=$details['CREATED_BY']?>
                                        </p>
                                    </div>
                                </li>

                                <!--Статус заказа-->
                                <li class="card-order__item card-order__item--delivery">
                                    <div class="info-slot">
                                        <p class="info-slot__value info-slot__value--marked">
                                            <?=$details['ORDER_STATUS']?>
                                        </p>
                                    </div>
                                </li>

                                <!--Статус оплаты-->
                                <li class="card-order__item card-order__item--pay">
                                    <div class="info-slot">
                                        <p class="info-slot__name">
                                            <?=Loc::getMessage("PAID_STATUS_DETAILS_TABLE")?>
                                        </p>
                                        <p class="info-slot__value info-slot__value--icon">
                                             <span class="info-slot__icon">
                                                 <svg class="icon icon--credit-not-paid info-slot__icon-mark">
                                                     <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-credit-<?=$details['IS_PAID'] ? "" : "not-"?>paid"></use>
                                                 </svg>
                                             </span>
                                            <?=$details['IS_PAID'] ? Loc::getMessage("PAID_DETAILS_TABLE") : Loc::getMessage("NOT_PAID_DETAILS_TABLE")?>
                                        </p>
                                    </div>
                                </li>

                                <li class="card-order__item">
                                    <div class="card-order__price price">
                                        <div class="price__calculation price__calculation--columned">
                                            <p class="price__calculation-total price__calculation-total--has-icon">

                                                <!-- "применена персональная акция" -->
                                                <?php if ($details['IS_PROMOTION']) { ?>
                                                    <span class="price__calculation-picture">
                                                        <svg class="icon icon--cart-card price__calculation-icon tooltip" data-tippy-content="<?=Loc::getMessage("PROMOTION_TOOLTIP_TEXT")?>" data-tippy-placement="bottom-start">
                                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-cart-card"></use>
                                                        </svg>
                                                    </span>
                                                <?php } ?>

                                                <!-- итоговая стоимость ₽ -->
                                                <span class="price__calculation-value assets"
                                                        data-order-amount="<?=$details['TOTAL_PRICE']?>">
                                                    <span class="price__calculation-value--whole"></span>
                                                    <span class="price__calculation-value--remains"></span>
                                                </span>
                                            </p>

                                            <?php if ($arResult['IS_CONSULTANT']):?>
                                                <!-- итоговое количество баллов ББ -->
                                                <p class="price__calculation-accumulation">
                                                    <?= number_format($details['BONUSES'], 0, '', ' ')?><?=Loc::getMessage("BONUS_SYMBOL")?>
                                                </p>
                                            <?php endif;?>
                                        </div>
                                    </div>
                                </li>

                            </ul>

                            <!-- Кнопка Повторить заказ -->
                            <div class="card-order__action">
                                <button type="button" class="card-order__button button button--medium button--rounded-big button--covered button--green">
                                    <span class="button__icon button__icon--right">
                                        <svg class="icon icon--rotate">
                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-rotate"></use>
                                        </svg>
                                    </span>
                                    <span class="button__text"><?=Loc::getMessage('REPEAT_ORDER_BUTTON')?></span>
                                </button>
                            </div>

                        </header>

                        <!-- Состав заказа (товары)-->
                        <div class="card-order__content">
                            <div class="accordeon__item box" data-accordeon data-accordeon-toggle>
                                <div class="accordeon__header">
                                    <h6 class="accordeon__title"><?=Loc::getMessage("ORDER_PRODUCTS_BUTTON")?></h6>
                                    <button type="button" class="accordeon__toggle button button--circular button--mini button--covered button--red-white">
                                        <span class="accordeon__toggle-icon button__icon">
                                            <svg class="icon icon--arrow-down">
                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-down"></use>
                                            </svg>
                                        </span>
                                    </button>
                                </div>

                                <!--(Поля таблицы товаров)-->
                                <div class="accordeon__body" data-accordeon-content>
                                    <div class="table-list">
                                        <div class="table-list__head">

                                            <!--Наименование-->
                                            <div class="table-list__cell">
                                                <p class="table-list__name">
                                                    <?=Loc::getMessage("NAME_PRODUCT_TABLE")?>
                                                </p>
                                            </div>

                                            <!-- Цена, Количество, Сумма баллов -->
                                            <?php foreach (['PRICE_PRODUCT_TABLE', 'QUANTITY_PRODUCT_TABLE', 'BONUS_PRODUCT_TABLE'] as $field) :?>
                                                <?php if (!$arResult['IS_CONSULTANT'] && $field === 'BONUS_PRODUCT_TABLE') continue;?>
                                                <div class="table-list__cell table-list__cell--desktop">
                                                    <p class="table-list__name">
                                                        <?=Loc::getMessage($field)?>
                                                    </p>
                                                </div>
                                            <? endforeach; ?>
                                        </div>

                                        <ul class="table-list__list">
                                            <? foreach ($arResult['PRODUCTS'] as $product) :?>
                                            <li class="table-list__item">
                                                <article class="product-line <?=($arResult['IS_CONSULTANT']) ? '' : 'product-line--common'?>">
                                                    <a class="product-line__link" href="<?=$product['DETAIL_PAGE']?>"></a>
                                                    <div class="product-line__inner">
                                                        <div class="product-line__info">
                                                            <div class="product-line__image">
                                                                <img src="<?=$product['PICTURE']?>" alt="#" class="product-line__image-picture">
                                                            </div>
                                                            <div class="product-line__wrapper">
                                                                <h2 class="product-line__title product-name">
                                                                    <?=$product['NAME']?>
                                                                </h2>
                                                                <p class="product-line__subtitle product-article">
                                                                    <?=Loc::getMessage("PRODUCT_ARTICLE")?><?=$product['ARTICLE']?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="product-line__characteristic">
                                                            <ul class="product-line__list">
                                                                <li class="product-line__params product-line__params--span">
                                                                    <p class="product-line__text">
                                                                        <span class="product-line__params-name">Цена:</span>
                                                                        <span class="product-line__params-value product-price" data-item-price="<?=$product['PRICE']?>">
                                                                            <span class="product-line__params-value--whole"></span>
                                                                            <span class="product-line__params-value--remains"></span>
                                                                        </span>
                                                                    </p>
                                                                </li>
                                                                <li class="product-line__params">
                                                                    <p class="product-line__text">
                                                                        <span class="product-line__params-name">Количество:</span>
                                                                        <span class="product-line__params-value product-quantity">
                                                                            <?=$product['QUANTITY']?>
                                                                        </span>
                                                                    </p>
                                                                </li>
                                                                <?php if ($arResult['IS_CONSULTANT']):?>
                                                                    <li class="product-line__params product-line__params--bold">
                                                                        <p class="product-line__text">
                                                                            <span class="product-line__params-name">Сумма баллов:</span>
                                                                            <span class="product-line__params-value product-credit product-bonus">
                                                                                <?= number_format($product['BONUSES'], 0, '', ' ') ?> ББ
                                                                            </span>
                                                                        </p>
                                                                    </li>
                                                                <?php endif;?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </article>
                                            </li>
                                            <?endforeach;?>
                                        </ul>
                                        <button type="button" id="showMore" class="orders__button button button--rounded button--outlined button--green button--full orders__button-more" style="<?=$arResult['last'] ? 'display:none;' : '' ?>"><?=getMessage('SHOW_MORE_BUTTON') ?></button>
                                    </div>
                                </div>
                            </div>

                            <!-- Кнопка Вернуть заказ -->
                            <button type="button" class="card-order__return button button--simple button--red" data-fancybox data-modal-type="modal"
                                    data-src="#technical-support" data-selected="REFUND_ORDER">
                                <span class="button__icon">
                                    <svg class="icon icon--return">
                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-return"></use>
                                    </svg>
                                </span>
                                <span class="button__text"><?=Loc::getMessage("RETURN_ORDER_BUTTON")?></span>
                            </button>

                        </div>
                    </div>
                </article>
            </li>
        </ul>
    </div>
</section>

<article id="orderOutStock" class="modal modal--orderout modal--centered modal--outer box box--circle box--hanging" style="display: none">
    <div class="modal__content modal__content--order" data-scrollbar>
        <section class="modal__section modal__section--content modal__section--order" >
            <div class="out-stock">
                <ul class="out-stock__list">
                    <!-- Adding in JS -->
                </ul>
                <div class="out-stock__text">К сожалению, этой продукции сейчас нет в наличии.</div>
                <div class="out-stock__node">Зато у нас есть другие интересные товары! Посмотрим?</div>
                <div class="out-stock__actions">
                    <button type="button" class="out-stock__button button button--rounded-big button--outlined button--green button--full" onclick="location.href = '/cart'">
                        Перейти в корзину
                    </button>
                    <button type="button" class="out-stock__button button button--rounded-big button--covered button--green button--full" onclick="location.href = '<?=HITS_LINK?>'">
                        Посмотреть хиты продаж
                    </button>
                </div>
            </div>

        </section>
    </div>
</article>

<article id="thanks" class="modal modal--wide modal--centered box box--circle box--hanging" style="display: none">
    <div class="modal__content">
        <section class="modal__section modal__section--content">
            <div class="notification notification--simple">
                <div class="notification__icon">
                    <svg class="icon icon--cat-serious">
                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-cat-serious"></use>
                    </svg>
                </div>

                <h4 class="notification__title">Товары из заказа были добавлены в Вашу корзину</h4>
            </div>
        </section>
    </div>
</article>

<script>
    let offset = <?=$arResult['OFFSET']?>;
    const orderId = <?=$arParams['ORDER_ID']?>;
    const RUBLE_SYMBOL = "<?=Loc::getMessage("RUBLE_SYMBOL")?>";
    const ARTICLE = "<?=Loc::getMessage("PRODUCT_ARTICLE")?>";
</script>

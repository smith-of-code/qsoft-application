<?php
if (! defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Localization\Loc;

$details = $arResult['ORDER_DETAILS'];

?>
<!--Кнопка "К списку заказов" -->
<a href="#" class="orders__transition button button--back button--simple button--red">
    <span class="button__icon">
        <svg class="icon icon--arrow-left-thin">
            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-left-thin"></use>
        </svg>
    </span>
    <span class="button__text"><?=Loc::getMessage("TO_ORDER_LIST_BUTTON")?></span>
</a>

<section class="orders__section">
    <div class="cards-order">
        <ul class="cards-order__list">
            <li class="cards-order__item">
                <article class="card-order card-order--green card-order--divided">
                    <!-- Детали заказа, Состав заказа (товары)-->
                    <div class="card-order__inner">

                        <!-- Детали заказа -->
                        <header class="card-order__header">
                            <ul class="card-order__list">

                                <li class="card-order__item">
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
                                    <div class="info-slot">
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
                                        <p class="info-slot__name">
                                            <?=Loc::getMessage("ORDER_STATUS_DETAILS_TABLE")?>
                                        </p>
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
                                                <span class="price__calculation-value">
                                                    <?=$details['TOTAL_PRICE']?><?=Loc::getMessage("RUBLE_SYMBOL")?>
                                                </span>
                                            </p>

                                            <!-- итоговое количество баллов ББ -->
                                            <p class="price__calculation-accumulation"><?=Loc::getMessage("PROMOTION_SYMBOL")?></p>
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
                            <div class="accordeon__item box" data-accordeon>
                                <div class="accordeon__header" data-accordeon-toggle>
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
                                            <?php foreach (['PRICE_PRODUCT_TABLE', 'QUANTITY_PRODUCT_TABLE', 'PROMOTION_PRODUCT_TABLE'] as $field) :?>
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
                                                <article class="product-line">
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
                                                                        <span class="product-line__params-value product-price">
                                                                            <?=$product['PRICE']?><?=Loc::getMessage("RUBLE_SYMBOL")?>
                                                                        </span>
                                                                    </p>
                                                                </li>
                                                                <li class="product-line__params">
                                                                    <p class="product-line__text">
                                                                        <span class="product-line__params-value product-quantity">
                                                                            <?=$product['QUANTITY']?>
                                                                        </span>
                                                                    </p>
                                                                </li>
                                                                <li class="product-line__params product-line__params--bold">
                                                                    <p class="product-line__text">
                                                                        <span class="product-line__params-value product-credit product-bonus">
                                                                            <?=$product['BONUS']?>
                                                                        </span>
                                                                    </p>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </article>
                                            </li>
                                            <?endforeach;?>
                                        </ul>

                                    </div>
                                    <!-- Кнопка Показать больше -->
                                    <button type="button" class="orders__button button button--rounded button--outlined button--green button--full button--middle orders__button-more"><?=Loc::getMessage("SHOW_MORE_BUTTON")?></button>
                                </div>
                            </div>

                            <!-- Кнопка Вернуть заказ -->
                            <button type="button" class="card-order__return button button--simple button--red">
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

<script>
    let offset = <?=$arResult['OFFSET']?>;
    const orderId = <?=$arParams['ORDER_ID']?>;
    const RUBLE_SYMBOL = "<?=Loc::getMessage("RUBLE_SYMBOL")?>";
    const ARTICLE = "<?=Loc::getMessage("PRODUCT_ARTICLE")?>";
</script>

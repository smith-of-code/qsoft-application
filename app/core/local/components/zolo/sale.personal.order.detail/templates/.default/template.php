<?php
if (! defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Localization\Loc;

$details = $arResult['ORDER_DETAILS'];

?>

<!-- два открывающих дива - есть во всех разметках папки lk
<div class="private__col private__col--full">
    <div class="orders">
-->
        <a href="#" class="orders__transition button button--back button--simple button--red">
            <span class="button__icon">
                <svg class="icon icon--arrow-left-thin">
                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-left-thin"></use>
                </svg>
            </span>
            <span class="button__text"><?=Loc::getMessage("RETURN_TO_ORDER_LIST")?></span><!--К списку заказов-->
        </a>


        <section class="orders__section">
            <div class="cards-order">
                <ul class="cards-order__list">
                    <li class="cards-order__item">

                        <article class="card-order card-order--green card-order--divided">
                            <div class="card-order__inner">



                                <header class="card-order__header">

                                    <ul class="card-order__list">

                                        <li class="card-order__item">
                                            <h2 class="card-order__title">
                                                <?=Loc::getMessage("ORDER_CREATION_DATE")?><?=$details['CREATED_AT']?><!--Заказ от-->
                                            </h2>
                                            <p class="card-order__subtitle">
                                                <?=Loc::getMessage("NUMBER")?><?=$details['ORDER_ID']?><!--№-->
                                            </p>
                                        </li>

                                        <li class="card-order__item card-order__item--span">
                                            <div class="info-slot">
                                                <p class="info-slot__name">
                                                    <?=Loc::getMessage("CREATED_BY")?><!--Кем заказан-->
                                                </p>
                                                <p class="info-slot__value">
                                                    <?=$details['CREATED_BY']?>
                                                </p>
                                            </div>
                                        </li>

                                        <li class="card-order__item card-order__item--delivery">
                                            <div class="info-slot">
                                                <p class="info-slot__name">
                                                    <?=Loc::getMessage("ORDER_STATUS")?><!--Статус заказа-->
                                                </p>
                                                <p class="info-slot__value info-slot__value--marked">
                                                    <?=$details['ORDER_STATUS']?>
                                                </p>
                                            </div>
                                        </li>

                                        <li class="card-order__item card-order__item--pay">
                                            <div class="info-slot">
                                                <p class="info-slot__name">
                                                    <?=Loc::getMessage("PAID_STATUS")?><!--Статус оплаты-->
                                                </p>
                                                <p class="info-slot__value info-slot__value--icon">
                                                     <span class="info-slot__icon">
                                                         <svg class="icon icon--credit-not-paid info-slot__icon-mark">
                                                             <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-credit-paid"></use>
                                                         </svg>
                                                     </span>
                                                    <?=$details['IS_PAID'] ? Loc::getMessage("PAID") : Loc::getMessage("NOT_PAID")?><!--Оплачен : Не оплачен ПРОВЕРИТЬ ИКОНКУ для НЕ ОПЛАЧЕН-->
                                                </p>
                                            </div>
                                        </li>

                                        <li class="card-order__item">
                                            <div class="card-order__price price">
                                                <div class="price__calculation price__calculation--columned">

                                                    <p class="price__calculation-total price__calculation-total--has-icon"><!-- ПРОВЕРИТЬ HAS NOT ICON-->

                                                        <!-- Вырезать следующий ниже спан, если нет персональной акции-->
                                                        <?php if ($details['VOUCHER_USED']) { ?>
                                                            <span class="price__calculation-picture">                                       <!-- применена персональная акция -->
                                                                <svg class="icon icon--cart-card price__calculation-icon tooltip" data-tippy-content="<?=Loc::getMessage("PERSONAL_PROMOTION_APPLIED")?>" data-tippy-placement="bottom-start">
                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-cart-card"></use>
                                                                </svg>
                                                            </span>
                                                        <?php } ?>

                                                        <span class="price__calculation-value">
                                                            <?=$details['TOTAL_PRICE']?><?=Loc::getMessage("RUBLE")?><!-- ₽ -->
                                                        </span>
                                                    </p>

                                                    <p class="price__calculation-accumulation">?<?=$details['CREDIT']?><?=Loc::getMessage("CREDIT")?></p><!-- ББ -->

                                                </div>
                                            </div>
                                        </li>

                                    </ul>

                                    <div class="card-order__action">
                                        <button type="button" class="card-order__button button button--medium button--rounded-big button--covered button--green">
                                            <span class="button__icon button__icon--right">
                                                <svg class="icon icon--rotate">
                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-rotate"></use>
                                                </svg>
                                            </span>
                                            <span class="button__text"><?=Loc::getMessage('REPEAT_ORDER')?></span><!-- Повторить заказ -->
                                        </button>
                                    </div>

                                </header>


                                <div class="card-order__content">
                                    <div class="accordeon__item box" data-accordeon>
                                        <div class="accordeon__header" data-accordeon-toggle>
                                            <h6 class="accordeon__title"><?=Loc::getMessage("ORDER_LIST")?></h6><!--Состав заказа-->

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
                                                            <?=Loc::getMessage("NAME")?><!--Наименование-->
                                                        </p>
                                                    </div>
                                                    <div class="table-list__cell table-list__cell--desktop">
                                                        <p class="table-list__name">
                                                            <?=Loc::getMessage("PRICE")?><!--Цена-->
                                                        </p>
                                                    </div>
                                                    <div class="table-list__cell table-list__cell--desktop">
                                                        <p class="table-list__name">
                                                            <?=Loc::getMessage("QUANTITY")?><!--Количество-->
                                                        </p>
                                                    </div>
                                                    <div class="table-list__cell table-list__cell--desktop">
                                                        <p class="table-list__name">
                                                            <?=Loc::getMessage("CREDIT_FOR_PRODUCT")?><!--Сумма баллов-->
                                                        </p>
                                                    </div>
                                                </div>
                                                <ul class="table-list__list">
                                                    <? foreach ($arResult['PRODUCTS'] as $product) :?>
                                                    <li class="table-list__item">
                                                        <article class="product-line">
                                                            <div class="product-line__inner">
                                                                <div class="product-line__info">
                                                                    <div class="product-line__image">
                                                                        <img src="<?=$product['PICTURE']?>" alt="#" class="product-line__image-picture"><!-- src="https://fakeimg.pl/366x312/"-->
                                                                    </div>
                                                                    <div class="product-line__wrapper">
                                                                        <h2 class="product-line__title">
                                                                            <?=$product['NAME']?>
                                                                        </h2>
                                                                        <p class="product-line__subtitle">
                                                                            <?=Loc::getMessage("ARTICLE")?><?=$product['VENDOR_CODE']?><!-- Арт. -->
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="product-line__characteristic">
                                                                    <ul class="product-line__list">
                                                                        <li class="product-line__params product-line__params--span">
                                                                            <p class="product-line__text">
                                                                                <span class="product-line__params-name">
                                                                                    <?=Loc::getMessage("PRICE")?><!-- Цена -->
                                                                                </span>
                                                                                <span class="product-line__params-value price">
                                                                                    <?=$product['PRICE']?><?=Loc::getMessage("RUBLE")?>
                                                                                </span>
                                                                            </p>
                                                                        </li>
                                                                        <li class="product-line__params">
                                                                            <p class="product-line__text">
                                                                                <span class="product-line__params-name">
                                                                                    <?=Loc::getMessage("QUANTITY")?><!-- Количество: -->
                                                                                </span>
                                                                                <span class="product-line__params-value ">
                                                                                    <?=$product['QUANTITY']?>
                                                                                </span>
                                                                            </p>
                                                                        </li>
                                                                        <li class="product-line__params product-line__params--bold">
                                                                            <p class="product-line__text">
                                                                                <span class="product-line__params-name">
                                                                                    <?=Loc::getMessage("CREDIT_FOR_PRODUCT")?><!-- Сумма баллов: -->
                                                                                </span>
                                                                                <span class="product-line__params-value">
                                                                                    <!-- ББ -->
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

                                            <button type="button" class="orders__button button button--rounded button--outlined button--green button--full button--middle orders__button-more"><?=Loc::getMessage("SHOW_MORE")?><!-- Показать больше --></button>
                                        </div>
                                    </div>

                                    <button type="button" class="card-order__return button button--simple button--red">
                                        <span class="button__icon">
                                            <svg class="icon icon--return">
                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-return"></use>
                                            </svg>
                                        </span>
                                        <span class="button__text"><?=Loc::getMessage("RETURN_ORDER")?></span><!-- Вернуть заказ -->
                                    </button>
                                </div>
                            </div>
                        </article>
                    </li>
                </ul>
            </div>
        </section>
    </div>
</div>

<script>
    offset = <?=$arResult['OFFSET']?>;
    const orderId = <?=$arParams['ORDER_ID']?>;
</script>
<!--
</div>
</div>
</main>
</div>
</div>
-->
<!--content-->

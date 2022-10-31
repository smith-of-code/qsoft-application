<?php require_once("$_SERVER[DOCUMENT_ROOT]/bitrix/modules/main/include/prolog_before.php");

dump($_REQUEST);

$arResult = $_REQUEST['data'];

?>

<!-- Карточка заказа -->
<?php foreach ($arResult['orders'] as $order): ?>
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
                                    <p class="price__calculation-accumulation">119 ББ</p>
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
                                        <!-- TODO: Нужно сделать ссылку на детальную страницу товара -->
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
                                                                        436 ББ
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
<!-- Карточка заказа -->
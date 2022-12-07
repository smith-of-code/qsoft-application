<?php use QSoft\Helper\OrderHelper;

require_once("$_SERVER[DOCUMENT_ROOT]/bitrix/modules/main/include/prolog_before.php");
$arResult = $_REQUEST['data']['orders'];
define('SEF_FOLDER', $_REQUEST['data']['sefFolder']);
$arResult['IS_CONSULTANT'] = (new \QSoft\Entity\User)->groups->isConsultant();
?>
<!-- Карточка заказа -->
<?php foreach ($arResult['ORDERS'] as $order): ?>
    <?php $paid = $order['ORDER']['PAYED'] == 'Y'; ?>
    <li class="cards-order__item">
        <article class="card-order card-order--<?=in_array($order['ORDER']['STATUS_ID'], OrderHelper::SUCCESS_STATUSES) ? 'green' : (in_array($order['ORDER']['STATUS_ID'], OrderHelper::FAIL_STATUSES) ? 'red' : 'blue')?>">
            <div class="card-order__inner">
                <header class="card-order__header">
                    <a href="<?=SEF_FOLDER . $order['ORDER']['ID']?>" class="card-order__link"></a>
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
                                        <?php if ($order['ORDER']['PERSONAL_PROMOTION']): ?>
                                            <span class="price__calculation-picture">
                                                <svg class="icon icon--cart-card price__calculation-icon tooltip" data-tippy-content="применена персональная акция" data-tippy-placement="bottom-start">
                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-cart-card"></use>
                                                </svg>
                                            </span>
                                        <?php endif; ?>
                                        <span class="price__calculation-value">
                                            <?=$order['ORDER']['FORMATED_PRICE']?>
                                        </span>
                                    </p>
                                    <?php if ($arResult['IS_CONSULTANT']):?>
                                        <p class="price__calculation-accumulation"><?=$order['ORDER']['BONUSES'] ?? 0 ?> ББ</p>
                                    <?php endif;?>
                                </div>
                            </div>
                        </li>
                    </ul>
                </header>

                <div class="card-order__content">
                    <div class="accordeon__item box" data-accordeon>
                        <div class="accordeon__header" button-next-id="<?=$order['ORDER']['ID'] ?>" data-accordeon-toggle>
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

                            <div class="table-list" data-list-id="<?=$order['ORDER']['ID'] ?>">
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
                                    <?php if ($arResult['IS_CONSULTANT']):?>
                                        <div class="table-list__cell table-list__cell--desktop">
                                            <p class="table-list__name">
                                                Сумма баллов
                                            </p>
                                        </div>
                                    <?php endif;?>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </article>
    </li>
<?php endforeach; ?>
<!-- Карточка заказа -->
<script>
    $('div').one('click', function () {
        if ($(this).attr('button-next-id') !== undefined) {
            getBasketData($(this).attr('button-next-id'), basketOfset);
        }
    });
</script>
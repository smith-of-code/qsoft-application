<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)  die();

global $APPLICATION;

$APPLICATION->setTitle('Корзина');?>

<h1 class="page__heading">Корзина</h1>

<div class="content__main">
    <div class="basket__row">
        <div class="basket__col basket__col--full">
            <div class="cards-cart basket__cart" data-basket>
                <div class="basket__cart-null heading heading--average">Корзина пуста</div>

                <ul class="cards-cart__list basket__list" data-basket-list>
                    <?php foreach ($arResult['BASKET_ITEMS'] as $basketItem):?>
                        <li class="cards-cart__item basket__item" data-basket-item data-remove-item>
                            <article class="card-cart">
                                <a href="#" class="card-cart__link"></a>
                                <div class="card-cart__inner">
                                    <header class="card-cart__header">
                                        <div class="card-cart__image">
                                            <img src="/local/templates/.default/images/portage.png" alt="#" class="card-cart__image-picture">
                                        </div>
                                        <div class="card-cart__info">
                                            <h2 class="card-cart__title">
                                                <?=$basketItem['NAME']?>
                                            </h2>
                                            <p class="card-cart__subtitle">
                                                Арт. <?=$basketItem['OFFER']['PROPERTY_ARTICLE_VALUE']?>
                                            </p>

                                            <ul class="card-cart__types types">
                                                <li class="types__item">
                                                    <p class="types__value">
                                                        600 г
                                                    </p>
                                                </li>
                                                <li class="types__item">
                                                    <p class="types__value">
                                                        Для средних пород
                                                    </p>
                                                </li>
                                                <li class="types__item">
                                                    <p class="types__value">
                                                        600 г
                                                    </p>
                                                </li>
                                            </ul>

                                            <ul class="card-cart__status product-status">
                                                <li class="product-status__item product-status__item--red">
                                                                        <span class="product-status__icon">
                                                                            <svg class="icon icon--personal-action product-status__icon-mark">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-personal-action"></use>
                                                                            </svg>
                                                                        </span>
                                                    <p class="product-status__name">
                                                        Персональная акция
                                                    </p>
                                                </li>
                                                <li class="product-status__item product-status__item--blue">
                                                                        <span class="product-status__icon">
                                                                            <svg class="icon icon--non-returnable product-status__icon-mark">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-non-returnable"></use>
                                                                            </svg>
                                                                        </span>
                                                    <p class="product-status__name">
                                                        Невозвратный товар
                                                    </p>
                                                </li>
                                            </ul>
                                        </div>
                                    </header>

                                    <div class="card-cart__wrapper">

                                        <div class="card-cart__block">
                                            <div class="card-cart__counter">

                                                <div class="quantity quantity--active" data-quantity>
                                                    <div class="quantity__actions">
                                                        <div class="quantity__decrease">
                                                            <button type="button" class="button button--iconed button--covered button--square button--gray-red" data-quantity-decrease data-basket-item-count>
                                                                <span class="button__icon button__icon--small">
                                                                    <svg class="icon icon--minus">
                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-minus"></use>
                                                                    </svg>
                                                                </span>
                                                            </button>
                                                        </div>

                                                        <div class="quantity__total">
                                                            <span
                                                                class="quantity__total-sum"
                                                                data-quantity-sum="<?=$basketItem['QUANTITY']?>"
                                                                data-quantity-min="1"
                                                                data-quantity-max="<?=$basketItem['OFFER']['CATALOG_QUANTITY']?>"
                                                            >
                                                                <?=(int)$basketItem['QUANTITY']?>
                                                            </span>
                                                        </div>

                                                        <div class="quantity__increase">
                                                            <button type="button" class="button button--iconed button--covered button--square button--gray-green" data-quantity-increase data-basket-item-count>
                                                                <span class="button__icon button__icon--small">
                                                                    <svg class="icon icon--plus">
                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-plus"></use>
                                                                    </svg>
                                                                </span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="card-cart__price">
                                                <p class="card-cart__price-item">
                                                    <span class="card-cart__price-value">
                                                        <?=$basketItem['PRICE']?> ₽
                                                    </span>
                                                    <span class="card-cart__price-sufix">
                                                        за шт
                                                    </span>
                                                </p>
                                            </div>

                                            <?php $needOldPrice = $basketItem['TOTAL_PRICE'] !== $basketItem['TOTAL_BASE_PRICE'];?>
                                            <div class="card-cart__total product-price">
                                                <p class="product-price__item <?=$needOldPrice ? 'product-price__item--new' : ''?>">
                                                    <?=$basketItem['PRICE'] * $basketItem['QUANTITY']?> ₽
                                                </p>
                                                <?php if ($needOldPrice):?>
                                                    <p class="product-price__item product-price__item--old">
                                                        <?=$basketItem['BASE_PRICE'] * $basketItem['QUANTITY']?> ₽
                                                    </p>
                                                <?php endif;?>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="card-cart__actions">
                                        <button type="button" class="card-cart__actions-item button button--ordinary button--iconed button--simple button--big button--red" data-card-favourite="heart" data-tippy-content="В&#160;избранное" data-tippy-placement="right-end">
                                            <span class="button__icon">
                                                <svg class="icon">
                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-heart" data-card-favourite-icon></use>
                                                </svg>
                                            </span>
                                        </button>
                                        <button type="button" class="card-cart__actions-item button button--ordinary button--iconed button--simple button--big button--red" data-remove-button data-tippy-content="Удалить" data-tippy-placement="right-end" data-basket-item-remove>
                                            <span class="button__icon">
                                                <svg class="icon">
                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-delete"></use>
                                                </svg>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </article>
                        </li>
                    <?php endforeach;?>
                </ul>
            </div>
        </div>
        <div class="basket__col basket__col--limited">
            <div class="basket__progress">
                <div class="card-progress card-progress--mini">
                    <div class="card-progress__inner">
                        <p class="card-progress__title">
                            Повышения уровня по личным покупкам
                        </p>
                        <div class="card-progress__mark">
                            <svg class="card-progress__icon icon icon--cat-serious">
                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-cat-serious"></use>
                            </svg>
                            <span class="card-progress__mark-text">
                                                    Осталось еще немного
                                                </span>
                        </div>
                        <div class="card-progress__wrapper">
                            <div class="card-progress__progress progress-bar">
                                <div style="width: 80%;" class="progress-bar__filler progress-bar__filler--red"></div>
                            </div>
                            <div class="card-progress__bottom">
                                <div class="card-progress__amount amount">
                                    <p class="amount__target amount__target--red">
                                        124 000 ₽
                                    </p>
                                    <p class="amount__total">
                                        из 175 000 ₽
                                    </p>
                                </div>

                                <div class="card-progress__status">
                                    <p class="card-progress__text">
                                        Осталось
                                    </p>
                                    <p class="card-progress__text">
                                        56 000 ₽
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="card-progress__warning warning">
                            <div class="warning__mark">
                                <button type="button"
                                        class="button button--iconed button--simple button--red"
                                        data-fancybox data-modal-type="modal"
                                        data-src="#conditions"
                                >
                                                        <span class="button__icon">
                                                            <svg class="icon icon--basket warning__icon">
                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-attention"></use>
                                                            </svg>
                                                        </span>
                                </button>
                            </div>
                            <p class="warning__text">
                                Условия повышения уровня
                            </p>
                        </div>
                    </div>
                </div>
                <article id="conditions" class="modal modal--full box box--circle box--hanging" style="display: none">
                    <div class="modal__content">
                        <header class="modal__section modal__section--header">
                            <p class="heading heading--average">Условия поддержания уровня</p>
                        </header>

                        <section class="modal__section modal__section--content">
                            <div class="conditions">
                                <div class="conditions__block">
                                    <h5 class="conditions__title">Условия поддержания уровня для К1:</h5>

                                    <ul class="conditions__list">
                                        <li class="conditions__item">
                                            Совершение личных покупок на общую сумму 5000 рублей за период в 3 последовательных месяца (квартал);
                                        </li>
                                    </ul>
                                </div>

                                <div class="conditions__block">
                                    <h5 class="conditions__title">Условия поддержания уровня для К2 (единовременное соблюдение всех условий):</h5>

                                    <ul class="conditions__list">
                                        <li class="conditions__item">
                                            Совершение личных покупок на сумму 5000 рублей каждый месяц за период в 3 последовательных месяца (квартал);
                                        </li>

                                        <li class="conditions__item">
                                            Совершение групповых покупок на сумму 7000 рублей каждый месяц за период в 3 последовательных месяца (квартал);
                                        </li>
                                    </ul>

                                    <p class="conditions__text">Переход на уровень К2 возможен в течение 3 последовательных месяцев при соблюдении условий перехода на уровень К2;
                                    </p>
                                    <p class="conditions__text">При несоблюдении условий поддержания уровня К2 будет выполняться переход на уровень К1.</p>
                                </div>

                                <div class="conditions__block">
                                    <h5 class="conditions__title">Условия поддержания уровня для К3 (единовременное соблюдение всех условий):</h5>

                                    <ul class="conditions__list">
                                        <li class="conditions__item">
                                            Совершение личных покупок на сумму 10000 рублей каждый месяц за период в 3 последовательных месяца (квартал);
                                        </li>

                                        <li class="conditions__item">
                                            Совершение групповых покупок на сумму 20000 рублей каждый месяц за период в 3 последовательных месяца (квартал);
                                        </li>
                                    </ul>

                                    <p class="conditions__text">Переход на уровень К3 возможен в течение 6 последовательных месяцев при соблюдении условий перехода на уровень К3;

                                    </p>
                                    <p class="conditions__text">При несоблюдении условий поддержания уровня К3 будет выполняться переход на уровень К2.</p>
                                </div>
                            </div>
                        </section>
                    </div>
                </article>
            </div>
            <div class="basket__order">
                <div class="basket-card" data-basket-card>
                    <div class="basket-card__title">Ваш заказ</div>

                    <div class="basket-card__wrapper">
                        <div class="basket-card__list">
                            <div class="basket-card__item">
                                <span class="basket-card__text basket-card__text--gray">Количество товаров</span>
                                <span class="basket-card__total" data-basket-product-total><?=$arResult['BASKET_COUNT']?></span>
                            </div>
                            <div class="basket-card__item">
                                <span class="basket-card__text basket-card__text--gray">Сумма НДС</span>
                                <span class="basket-card__total" data-basket-product-nds><?=$arResult['BASKET_TOTAL_VAT']?> ₽</span>
                            </div>
                            <div class="basket-card__item">
                                <span class="basket-card__text">Сумма заказа</span>
                                <span class="basket-card__total" data-basket-order-amount><?=$arResult['BASKET_BASE_PRICE']?> ₽</span>
                            </div>
                            <div class="basket-card__item">
                                <span class="basket-card__text basket-card__text--green">Экономия</span>
                                <span class="basket-card__total basket-card__total--green" data-basket-economy><?=$arResult['TOTAL_DISCOUNT']?> ₽</span>
                            </div>
                            <?php if ($arResult['IS_CONSULTANT']):?>
                                <div class="basket-card__bonus">
                                    <div class="basket-card__bonus-wrapper">
                                        <div class="basket-card__bonus-inner">
                                            <span class="basket-card__bonus-text">Сумма ББ на счету</span>
                                            <span class="basket-card__bonus-count" data-basket-bonus-balance><?=$arResult['ACTIVE_BONUSES']?> ББ</span>
                                        </div>
                                        <div class="basket-card__bonus-inner">
                                            <span class="basket-card__bonus-text">ББ за заказ</span>
                                            <span class="basket-card__bonus-count"><?=$arResult['BASKET_ITEMS_BONUS_SUM']?> ББ</span>
                                        </div>

                                        <div class="form__row">
                                            <div class="form__col">
                                                <div class="form__field">
                                                    <div class="form__field-block form__field-block--input">
                                                        <div class="input input--small input--buttoned input--placeholder" data-basket-bonus-input>
                                                            <input type="number" class="input__control" name="bonuses" id="bonuses" value="">
                                                            <span class="input__placeholder">Сколько баллов списать</span>
                                                            <button type="button" class="input__button button button--iconed button--covered button--rounded button--big button--dark" data-basket-bonus-accept>
                                                                <span class="button__icon button__icon--small">
                                                                    <svg class="icon icon--arrow">
                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-right-light"></use>
                                                                    </svg>
                                                                </span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="basket-card__bonus-error">
                                            Баллами можно оплатить до 99% от итоговой стоимости в корзине. Пожалуйста, уменьшите количество списываемых баллов
                                        </div>
                                    </div>
                                </div>
                            <?php endif;?>
                            <div class="basket-card__item">
                                <span class="basket-card__text basket-card__text--bold">Итого к оплате</span>
                                <span class="basket-card__total basket-card__total--bold" data-basket-total><?=$arResult['BASKET_PRICE']?> ₽</span>
                            </div>
                        </div>
                        <button type="button" class="basket-card__button button button--rounded button--covered button--green button--full">
                            Оформить заказ
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

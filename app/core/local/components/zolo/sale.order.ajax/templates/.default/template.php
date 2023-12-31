<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Application;

/**
 * @var array $arParams
 * @var array $arResult
 * @var CMain $APPLICATION
 * @var CUser $USER
 * @var SaleOrderAjax $component
 * @var string $templateFolder
 */
?>
<?php if (Application::getInstance()->getContext()->getRequest()->get('ORDER_ID')):
	include(Application::getDocumentRoot() . "$templateFolder/confirm.php");
elseif ($arParams['DISABLE_BASKET_REDIRECT'] === 'Y' && $arResult['SHOW_EMPTY_BASKET']):
	include(Application::getDocumentRoot() . "$templateFolder/empty.php");
else:?>
<div class="">
    <main class="page__basket-order basket-order basket">

        <h1 class="page__heading">Оформление заказа</h1>

        <div class="content__main" id="content-block">
            <div class="basket__row">
                <div class="basket__col basket__col--full">

                    <div class="basket-order__box">
                        <form class="basket-order__form form form--wraped" id="order-form">
                            <input type="hidden" value="<?=$arResult['BONUSES_SUBTRACT']?>" name="bonuses_subtract" id="bonuses_subtract">
                            <div class="basket-order__form-box box box--gray box--rounded-sm">
                                <div class="basket-order__form-wrapper">
                                    <div class="form__row">
                                        <div class="form__col">
                                            <div class="form__field">
                                                <div class="form__field-block form__field-block--label">
                                                    <label for="subname" class="form__label form__label--required">
                                                        <span class="form__label-text">Фамилия</span>
                                                    </label>
                                                </div>

                                                <div class="form__field-block form__field-block--input">
                                                    <div class="input">
                                                        <input type="text" class="input__control" value="<?=$arResult['USER']['LAST_NAME'] ?>" name="last_name" id="subname-required" placeholder="Фамилия" data-replace-input="fullName">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form__col">
                                            <div class="form__field">
                                                <div class="form__field-block form__field-block--label">
                                                    <label for="name" class="form__label form__label--required">
                                                        <span class="form__label-text">Имя</span>
                                                    </label>
                                                </div>

                                                <div class="form__field-block form__field-block--input">
                                                    <div class="input">
                                                        <input type="text" class="input__control" value="<?=$arResult['USER']['FIRST_NAME'] ?>" name="first_name" id="name-required" placeholder="Имя" data-replace-input="fullName">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form__row">
                                        <div class="form__col">
                                            <div class="form__field">
                                                <div class="form__field-block form__field-block--label">
                                                    <label for="delivery-method" class="form__label form__label--required">
                                                        <span class="form__label-text">Способ доставки</span>
                                                    </label>
                                                </div>

                                                <div class="form__field-block form__field-block--input">
                                                    <div class="form__control">
                                                        <div class="select select--mitigate" data-select>
                                                            <select class="select__control" name="delivery_service" data-select-control data-placeholder="Способ доставки">
                                                                <option><!-- пустой option для placeholder --></option>
                                                                <?php foreach ($arResult['DELIVERY'] as $deliveryType): ?>
                                                                    <option value="<?=$deliveryType['ID'] ?>" <?=$deliveryType['NAME'] == 'Самовывоз' ? 'selected' : '' ?>>
                                                                        <?=$deliveryType['NAME'] == 'Самовывоз' ? 'Самовывоз со склада Amestore' : $deliveryType['NAME'] ?>
                                                                    </option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form__col">
                                            <div class="form__field">
                                                <div class="form__field-block form__field-block--label">
                                                    <label for="delivery-date" class="form__label form__label--required">
                                                        <span class="form__label-text">Дата доставки</span>
                                                    </label>
                                                </div>

                                                <div class="form__field-block form__field-block--input">
                                                    <div class="input">
                                                        <input type="text"
                                                            class="input__control"
                                                            value="<?=$arResult['ORDER_DELIVERY_DATE'] ?>"
                                                            name="delivery_date"
                                                            id="delivery-date-required"
                                                            placeholder="Дата доставки"
                                                            placeholder="ДД.ММ.ГГГГ"
                                                            data-mask-date-delivery
                                                            readonly
                                                        >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form__row">
                                        <div class="form__col">
                                            <div class="form__field">
                                                <div class="form__field-block form__field-block--label">
                                                    <label for="city" class="form__label form__label--required">
                                                        <span class="form__label-text">Город</span>
                                                    </label>
                                                </div>

                                                <div class="form__field-block form__field-block--input">
                                                    <div class="form__control">
                                                        <div class="select select--mitigate" data-select>
                                                            <select class="select__control" name="city" data-select-control data-placeholder="Город">
                                                                <option><!-- пустой option для placeholder --></option>
                                                                <?php foreach ($arResult['CITIES'] as $city): ?>
                                                                    <option
                                                                        value="<?=$city['id'] ?>"
                                                                        <?=$arResult['USER']['CITY'] === $city['name'] ? 'selected' : ''?>
                                                                    ><?=$city['name'] ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form__col">
                                            <div class="form__field">
                                                <div class="form__field-block form__field-block--label">
                                                    <label for="address" class="form__label form__label--required">
                                                        <span class="form__label-text">Адрес доставки</span>
                                                    </label>
                                                </div>

                                                <?php foreach ($arResult['ADDRESSES'] as $cityId => $addresses): ?>
                                                    <div class="form__field-block form__field-block--input" data-city="<?=$cityId?>">
                                                        <div class="form__control">
                                                            <div class="select select--mitigate" data-select>
                                                                    <select class="select__control" name="delivery_address" data-select-control data-placeholder="Адрес доставки">
                                                                        <option><!-- пустой option для placeholder --></option>
                                                                        <?php foreach ($addresses as $addressId => $address): ?>
                                                                            <option
                                                                                value="<?=$addressId?>"
                                                                                <?=$arResult['USER']['UF_PICKUP_POINT_ID'] === $addressId ? 'selected' : ''?>
                                                                            ><?=$address['name'] ?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form__row">
                                        <div class="form__col">
                                            <div class="form__field">
                                                <div class="form__field-block form__field-block--label">
                                                    <label for="text" class="form__label form__label--required">
                                                        <span class="form__label-text">Номер телефона</span>
                                                    </label>
                                                </div>
                                                <div class="form__field-block form__field-block--input">
                                                    <div class="input">
                                                        <input type="tel" class="input__control" name="phone" id="text-required1" placeholder="+7 (___) ___-__-__" data-phone inputmode="text" value="<?=$arResult['USER']['PHONE']?>">
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="form__col">
                                            <div class="form__field">
                                                <div class="form__field-block form__field-block--label">
                                                    <label for="text-required" class="form__label form__label--required">
                                                        <span class="form__label-text">E-mail</span>
                                                    </label>
                                                </div>

                                                <div class="form__field-block form__field-block--input">
                                                    <div class="input">
                                                        <input type="text" class="input__control" name="email" id="text-required2" value="<?=$arResult['USER']['EMAIL'] ?>" placeholder="example@email.com" data-mail inputmode="email">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form__row">
                                        <div class="form__col">
                                            <div class="form__field">
                                                <div class="form__field-block form__field-block--label">
                                                    <label for="text" class="form__label">
                                                        <span class="form__label-text">Комментарий</span>
                                                    </label>
                                                </div>
                                                <div class="form__field-block form__field-block--input">
                                                    <label class="input input--textarea">
                                                        <textarea type="text" class="input__control" name="comment" id="textarea1" placeholder="Не более 1000 символов" maxlength="1000" data-textarea-input></textarea>
                                                        <div class="input__counter">
                                                            <span class="input__counter-current" data-textarea-current></span>
                                                                /
                                                            <span class="input__counter-total" data-textarea-total></span>
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="basket-order__form-actions form__row">
                                <div class="form__col">
                                    <button onclick="location.href='/cart/';" type="button" class="button button--rounded button--covered button--white-green button--full">
                                        Вернуться к корзине
                                    </button>
                                </div>
                                <div class="form__col">
                                    <button type="button" class="button button--rounded button--covered button--green button--full" data-create-order>
                                        Отправить заказ
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
                <div class="basket__col basket__col--limited">
                    <div class="basket__order">
                        <div class="basket-card">
                            <div class="basket-card__title">Ваш заказ</div>

                            <div class="basket-card__wrapper">
                                <div class="basket-card__list">
                                    <div class="basket-card__item">
                                        <span class="basket-card__text basket-card__text--gray">Количество товаров</span>
                                        <span class="basket-card__point">
                                            ................................................................................................................................................................................................................................................................................................................................................................................................
                                        </span>
                                        <span class="basket-card__total"><?=number_format($arResult['BASKET']['BASKET_COUNT'], 0, ' ', ' ')?></span>
                                    </div>
                                    <div class="basket-card__item">
                                        <span class="basket-card__text">Сумма заказа</span>
                                        <span class="basket-card__point">
                                            ................................................................................................................................................................................................................................................................................................................................................................................................
                                        </span>
                                        <span class="basket-card__total" data-order-total="<?=$arResult['BASKET']['BASKET_BASE_PRICE']?>">

                                            <span class="basket-card__total-whole"></span>
                                            <span class="basket-card__total-remains"></span>
                                        </span>
                                    </div>
                                    <div class="basket-card__item">
                                        <span class="basket-card__text basket-card__text--green">Экономия</span>
                                        <span class="basket-card__point">
                                            ................................................................................................................................................................................................................................................................................................................................................................................................
                                        </span>
                                        <span class="basket-card__total basket-card__text--green" data-order-total="<?=$arResult['BASKET']['TOTAL_DISCOUNT']?>">
                                            <span class="basket-card__total-whole"></span>
                                            <span class="basket-card__total-remains"></span>
                                        </span>
                                    </div>
                                    <?php if ($arResult['USER']['IS_CONSULTANT']):?>
                                        <div class="basket-card__item">
                                            <span class="basket-card__text">Будет начислено</span>
                                            <span class="basket-card__point">
                                                ................................................................................................................................................................................................................................................................................................................................................................................................
                                            </span>
                                            <span class="basket-card__total"><?=number_format($arResult['BASKET']['BASKET_ITEMS_BONUS_SUM'], 0, ' ', ' ')?> ББ</span>
                                        </div>
                                    <?php endif;?>
                                    <div class="basket-card__item">
                                        <span class="basket-card__text basket-card__text--bold">Итого к оплате</span>
                                        <span class="basket-card__point">
                                            ................................................................................................................................................................................................................................................................................................................................................................................................
                                        </span>
                                        <span class="basket-card__total basket-card__total--bold" data-order-total="<?=$arResult['BASKET']['BASKET_PRICE']?>">
                                            <span class="basket-card__total-whole"></span>
                                            <span class="basket-card__total-remains"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="notification hidden" id="notification-block" hidden>
            <div class="notification__icon">
                <svg class="icon icon--tick-circle">
                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-tick-circle"></use>
                </svg>
            </div>

            <h4 class="notification__title" id="number_order">
                Ваш заказ № успешно создан
            </h4>

            <div class="form__col">
                <button type="button" class="button button--rounded button--covered button--green button--full" data-order-direct>
                    Перейти к заказу
                </button>
            </div>
        </div>
    </main>
</div>
<style>
    .hidden {
        display:none!important;
    }
</style>
<?php endif;?>
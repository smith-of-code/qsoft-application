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
dump($arResult);
?>

<div class="page__content content">
    <div class="container">
        <main class="page__basket-order basket-order basket">

            <h1 class="page__heading">Оформление заказа</h1>
            
            <div class="content__main">
                <div class="basket__row">
                    <div class="basket__col basket__col--full">

                        <div class="basket-order__box box box--gray box--rounded-sm">
                            <form class="basket-order__form form form--wraped" id="order-form">
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
                                                    <input type="text" class="input__control" value="<?=$arResult['USER']['LAST_NAME'] ?>" name="last_name" id="subname-required" placeholder="Фамилия">
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
                                                    <input type="text" class="input__control" value="<?=$arResult['USER']['FIRST_NAME'] ?>" name="first_name" id="name-required" placeholder="Имя">
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
                                                                <option value="<?=$deliveryType['ID'] ?>"><?=$deliveryType['NAME'] ?></option>
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
                                                    <input type="text" class="input__control" value="<?=$arResult['ORDER_DELIVERY_DATE'] ?>" name="delivery_date" id="delivery-date-required" placeholder="Дата доставки">
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
                                                                <option value="<?=$city['ID'] ?>"><?=$city['VALUE'] ?></option>
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

                                            <div class="form__field-block form__field-block--input">
                                                <div class="form__control">
                                                    <div class="select select--mitigate" data-select>
                                                        <select class="select__control" name="address" data-select-control data-placeholder="Адрес доставки">
                                                            <option><!-- пустой option для placeholder --></option>
                                                            <?php foreach ($arResult['ADDRESSES'] as $address): ?>
                                                                <option value="<?=$address ?>"><?=$address ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
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
                                                    <input type="tel" class="input__control" name="text-required" id="text-required1" placeholder="+7 (___) ___-__-__" data-phone inputmode="text">
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
                                                    <input type="text" class="input__control" name="text-required" id="text-required2" value="<?=$arResult['USER']['EMAIL'] ?>" placeholder="example@email.com" data-mail inputmode="email">
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
                                                    <textarea type="text" class="input__control" name="textarea" id="textarea1" placeholder="Многострочное поле ввода" maxlength="1000" data-textarea-input></textarea>
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
                                <div class="form__row">
                                    <div class="form__col">
                                        <button type="button" class="button button--rounded button--covered button--white-green button--full">
                                            Вернуться к корзине
                                        </button>
                                    </div>
                                    <div class="form__col">
                                        <button type="button" class="button button--rounded button--covered button--green button--full" data-create-order>
                                            Оформить заказ
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
                                            <span class="basket-card__elipse">
                                            ......................................
                                            </span>
                                            <span class="basket-card__total" data-basket-product-total><?=$arResult['BASKET_POSITIONS']?></span> 
                                        </div>
                                        <div class="basket-card__item">
                                            <span class="basket-card__text basket-card__text--gray">Сумма НДС</span>
                                            <span class="basket-card__elipse">
                                            ............................................................
                                            </span>
                                            <span class="basket-card__total"><?=$arResult['ORDER_TAX_FORMATED']?></span> 
                                        </div>
                                        <div class="basket-card__item">
                                            <span class="basket-card__text">Сумма заказа</span>
                                            <span class="basket-card__elipse">
                                            ............................................................
                                            </span>
                                            <span class="basket-card__total" data-basket-order-amount><?=$arResult['PRICE_WITHOUT_DISCOUNT']?></span> 
                                        </div>
                                        <div class="basket-card__item">
                                            <span class="basket-card__text basket-card__text--green">Экономия</span>
                                            <span class="basket-card__elipse">
                                            ...................................................................
                                            </span>
                                            <span class="basket-card__total" data-basket-economy><?=$arResult['BASKET_PRICE_DISCOUNT_DIFF']?></span> 
                                        </div>
                                        <?php if ($arResult['USER']['IS_CONSULTANT']):?>
                                            <div class="basket-card__item">
                                                <span class="basket-card__text basket-card__text--green">Будет начислено</span>
                                                <span class="basket-card__elipse">
                                                ......................................
                                                </span>
                                                <span class="basket-card__total" data-basket-economy><?=$arResult['BASKET_PRICE_DISCOUNT_DIFF']?></span> 
                                            </div>
                                        <?php endif;?>
                                        <div class="basket-card__item">
                                            <span class="basket-card__text basket-card__text--bold">Итого к оплате</span>
                                            <span class="basket-card__elipse">
                                            ...................................................................
                                            </span>
                                            <span class="basket-card__total basket-card__total--bold" data-basket-total><?=$arResult['ORDER_PRICE_FORMATED']?></span> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
<?php if (Application::getInstance()->getContext()->getRequest()->get('ORDER_ID')):
	include(Application::getDocumentRoot() . "$templateFolder/confirm.php");
elseif ($arParams['DISABLE_BASKET_REDIRECT'] === 'Y' && $arResult['SHOW_EMPTY_BASKET']):
	include(Application::getDocumentRoot() . "$templateFolder/empty.php");
else:?>
    <div class="form">
        <input type="text" id="last_name" placeholder="Фамилия" value="<?=$arResult['USER']['LAST_NAME']?>" />
        <input type="text" id="first_name" placeholder="Имя" value="<?=$arResult['USER']['FIRST_NAME']?>" />
        <select id="delivery_service">
            <option>Способ доставки</option>
            <?php foreach($arResult['DELIVERY'] as $delivery):?>
                <option
                    value="<?=$delivery['ID']?>"
                    <?=$arResult['USER_VALS']['DELIVERY_ID'] === (int) $delivery['ID'] ? 'selected' : ''?>
                ><?=$delivery['NAME']?></option>
            <?php endforeach;?>
        </select>
        <input type="hidden" id="delivery_date" value="<?=$arResult['ORDER_DELIVERY_DATE']?>" />
        <input type="text" id="~delivery_date" placeholder="Дата доставки" value="Доступно с <?=$arResult['ORDER_DELIVERY_DATE']?>" disabled />
        <select id="city">
            <option>Город</option>
            <?php foreach($arResult['CITIES'] as $city):?>
                <option
                    value="<?=$city['XML_ID']?>"
                    <?=$arResult['USER']['CITY'] === $city['VALUE'] ? 'selected' : ''?>
                ><?=$city['VALUE']?></option>
            <?php endforeach;?>
        </select>
        <select id="delivery_address">
            <option>Адрес доставки</option>
            <?php foreach($arResult['ADDRESSES'] as $address):?>
                <option value="<?=$address?>"><?=$address?></option>
            <?php endforeach;?>
        </select>
        <input type="text" placeholder="Email" id="email" value="<?=$arResult['USER']['EMAIL']?>" />
        <input type="text" placeholder="Комментарий" id="comment" value="" />
        <input type="hidden" id="order_bonuses" value="<?=$arResult['ORDER_BONUSES']?>" />
        <input type="hidden" id="bonuses_subtract" value="<?=$arResult['BONUSES_SUBTRACT']?>" />
        <div>
            <p>Количество товаров - <?=$arResult['BASKET_POSITIONS']?></p>
            <p>Сумма НДС - <?=$arResult['ORDER_TAX']?></p>
            <p>Сумма заказа - <?=$arResult['PRICE_WITHOUT_DISCOUNT_VALUE']?></p>
            <p>Экономия - <?=$arResult['DISCOUNT_PRICE']?></p>
            <?php if ($arResult['USER']['IS_CONSULTANT']):?>
                <p>Будет начислено - <?=$arResult['ORDER_BONUSES']?></p>
            <?php endif;?>
            <p>Итого к оплате - <?=$arResult['ORDER_PRICE']?></p>
        </div>
        <button data-create-order>Оформить заказ</button>
    </div>
<?php endif;?>
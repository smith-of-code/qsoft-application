<!DOCTYPE html>
<html lang="ru">
    <head>
        <title>Оформление заказа</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1 maximum-scale=1 user-scalable=0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" type="text/css" href="/local/templates/.default/css/style.css" />
    </head>

    <body class="page">

        <!--header-->
        <? include_once("../include/header.php"); ?>
        <!--/header-->

        <!--content-->
        <div class="page__content content">
            <div class="container">
                <main class="page__basket-order basket-order basket">

                    <h1 class="page__heading">Оформление заказа</h1>
                   
                    <div class="content__main">
                        <div class="basket__row">
                            <div class="basket__col basket__col--full">

                                <div class="basket-order__box box box--gray box--rounded-sm">
                                    <form class="basket-order__form form form--wraped">
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
                                                            <input type="text" class="input__control" name="subname-required" id="subname-required" placeholder="Фамилия">
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
                                                            <input type="text" class="input__control" name="name-required" id="name-required" placeholder="Имя">
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
                                                                <select class="select__control" name="delivery-method" data-select-control data-placeholder="Способ доставки">
                                                                    <option><!-- пустой option для placeholder --></option>
                                                                    <option value="1">Самовывоз со склада Amestore</option>
                                                                    <option value="2">Доставка курьером</option>
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
                                                            <input type="text" class="input__control" name="delivery-date-required" id="delivery-date-required" placeholder="Дата доставки">
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
                                                                    <option value="1">Москва</option>
                                                                    <option value="2">Санкт-Петербург</option>
                                                                    <option value="2">Сочи</option>
                                                                    <option value="2">Саратов</option>
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
                                                                    <option value="1">Адрес доставки</option>
                                                                    <option value="2">Адрес доставки</option>
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
                                                            <input type="text" class="input__control" name="text-required" id="text-required2" placeholder="example@email.com" data-mail inputmode="email">
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
                                                <button type="button" class="button button--rounded button--covered button--green button--full">
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
                                                    <span class="basket-card__total" data-basket-product-total>0</span> 
                                                </div>
                                                <div class="basket-card__item">
                                                    <span class="basket-card__text basket-card__text--gray">Сумма НДС</span>
                                                    <span class="basket-card__elipse">
                                                        ............................................................
                                                    </span>
                                                    <span class="basket-card__total">70 ₽</span> 
                                                </div>
                                                <div class="basket-card__item">
                                                    <span class="basket-card__text">Сумма заказа</span>
                                                    <span class="basket-card__elipse">
                                                        ............................................................
                                                    </span>
                                                    <span class="basket-card__total" data-basket-order-amount>0 ₽</span> 
                                                </div>
                                                <div class="basket-card__item">
                                                    <span class="basket-card__text basket-card__text--green">Экономия</span>
                                                    <span class="basket-card__elipse">
                                                        ...................................................................
                                                    </span>
                                                    <span class="basket-card__total" data-basket-economy>0 ₽</span> 
                                                </div>
                                                <div class="basket-card__item">
                                                    <span class="basket-card__text basket-card__text--bold">Итого к оплате</span>
                                                    <span class="basket-card__elipse">
                                                        ...................................................................
                                                    </span>
                                                    <span class="basket-card__total basket-card__total--bold" data-basket-total>0 ₽</span> 
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
        <!--content-->

        <!--Футер-->
        <? include_once("../include/footer.php"); ?>
        <!--/Футер-->

        <script src="/local/templates/.default/js/script.js"></script>
    </body>

</html>
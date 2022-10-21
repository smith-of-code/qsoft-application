<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponent $component
 */

?>
<h1 class="content__heading content__heading--centered">Авторизация</h1>

<div class="registration">
    <section class="section section--limited section--centered">
        <p class="registration__subtitle">
            Логином для авторизации является e-mail или телефон, указанный при регистрации
        </p>

        <form name="form_auth" class="registration__form form" action="<?=$arResult['AUTH_URL']?>" method="post">
            <input type="hidden" name="AUTH_FORM" value="Y" />
            <input type="hidden" name="TYPE" value="AUTH" />
            <?php if ($arResult['BACKURL']):?>
                <input type="hidden" name="backurl" value="<?=$arResult['BACKURL']?>" />
            <?php endif;?>
            <?php foreach ($arResult['POST'] as $key => $value):?>
                <input type="hidden" name="<?=$key?>" value="<?=$value?>" />
            <?php endforeach;?>

            <div class="form__row">
                <div class="form__col">
                    <div class="form__field">
                        <div class="form__field-block form__field-block--label">
                            <label for="USER_LOGIN" class="form__label form__label--required">
                                <span class="form__label-text">Логин</span>
                            </label>
                        </div>

                        <div class="form__field-block form__field-block--input">
                            <div class="input">
                                <input type="text" class="input__control" name="USER_LOGIN" id="USER_LOGIN" maxlength="255" value="<?=$arResult["LAST_LOGIN"]?>" placeholder="Введите логин">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form__row">
                <div class="form__col">
                    <div class="form__field">
                        <div class="form__field-block form__field-block--label">
                            <label for="USER_PASSWORD" class="form__label form__label--required">
                                <span class="form__label-text">Пароль</span>
                            </label>
                        </div>

                        <div class="form__field-block form__field-block--input" data-password-block>
                            <div class="input input--iconed">
                                <input type="password" class="input__control" name="USER_PASSWORD" id="USER_PASSWORD" placeholder="Введите пароль" data-password-input>
                                <span class="input__icon input__icon-password" data-password-toggle>
                                    <svg class="input__icon-password-icon input__icon-password-icon--show icon icon--eye">
                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-eye"></use>
                                    </svg>
                                    <svg class="input__icon-password-icon input__icon-password-icon--hidden icon icon--eye-off">
                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-eye-off"></use>
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="registration__actions">
                <div class="registration__actions-col registration__actions-col--separated registration__actions-col--gaped">
                    <a href="<?=$arResult["AUTH_FORGOT_PASSWORD_URL"]?>" class="registration__button button button--simple button--red">
                        <span class="button__icon">
                            <svg class="icon icon--lock">
                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-lock"></use>
                            </svg>
                        </span>
                        <span class="button__text">Забыли пароль?</span>
                    </a>
                </div>

                <?php if ($arResult['POST']):?>
                    <span style="color: red;">Неверный логин или пароль</span>
                <?php endif;?>

                <div class="registration__actions-col">
                    <button type="submit" name="Login" class="button button--rounded button--covered button--red button--full">
                        <span class="button__text">Войти</span>
                    </button>
                </div>

                <div class="registration__actions-col">
                    <a href="/login?register=yes&type=buyer" class="button button--rounded button--covered button--white-green button--full">
                        <span class="button__text">Зарегистрироваться как покупатель</span>
                    </a>
                </div>

                <div class="registration__actions-col">
                    <a href="/login?register=yes&type=consultant" class="button button--rounded button--covered button--white-green button--full">
                        <span class="button__text">Зарегистрироваться как консультант</span>
                    </a>
                </div>
            </div>


        </form>
    </section>
</div>
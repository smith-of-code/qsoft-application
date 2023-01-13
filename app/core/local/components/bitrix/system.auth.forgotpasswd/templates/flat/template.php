<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

Bitrix\Main\Page\Asset::getInstance()->addJs("https://www.google.com/recaptcha/api.js");
?>

<h1 class="content__heading content__heading--centered">Восстановление пароля</h1>
<form action="" method="POST" name="formEmail">
<div class="registration" data-form>
    <section class="section section--limited section--centered">
        <p class="registration__subtitle">
            Логином для авторизации является e-mail или телефон, указанный при регистрации
        </p>
        <div class="registration__form form">
            <div class="form__row">
                <div class="form__col">
                    <div class="form__field">
                        <div class="form__field-block form__field-block--label">
                            <label for="login" class="form__label form__label--required">
                                <span class="form__label-text">Логин</span>
                            </label>
                        </div>

                        <div class="form__field-block form__field-block--input">
                            <div class="input">
                                <input type="text" class="input__control" name="login" id="login" placeholder="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="g-recaptcha" data-sitekey="<?=getenv('CAPTCHA_KEY')?>" style="margin-top: 20px;" data-callback="unlock_submit"></div>
            <div class="registration__actions">
                <div class="registration__actions-col">
                    <button type="submit" class="button button--rounded button--covered button--red button--full button--disabled" disabled data-send>
                        <span class="button__text">Отправить</span>
                    </button>
                </div>
            </div>
        </div>
    </section>
</div>
</form>
<div class="registration" data-success style="display: none">
    <section class="section section--limited-middle section--centered">
        <div class="registration__notification notification">
            <div class="notification__icon">
                <svg class="icon icon--tick-circle">
                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-tick-circle"></use>
                </svg>
            </div>

            <h4 class="notification__title">
                Заявка успешно отправлена!
            </h4>

            <p class="notification__text notification__text--small">
                Ваша заявка на восстановление пароля отправлена. Проверьте вашу электронную почту.
            </p>
        </div>

        <div class="registration__actions">
            <div class="registration__actions-col">
                <a href="/login" class="button button--rounded button--covered button--white-green button--full">
                    <span class="button__text">Назад к авторизации</span>
                </a>
            </div>
        </div>
    </section>
</div>


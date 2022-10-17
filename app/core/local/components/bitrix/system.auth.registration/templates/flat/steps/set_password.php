<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die;
/**
 * Bitrix vars
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 */
?>

<section class="section section--limited-big">
    <h4 class="section__title">Установка пароля</h4>

    <div class="registration__form form form--separated form--wraped">
        <div class="registration__requirement requirement box box--gray box--circle">
            <div class="requirement__col">
                <p class="requirement__text">
                    Требования к паролю:
                </p>
            </div>

            <div class="requirement__col requirement__col--right">
                <ul class="requirement__list">
                    <li class="requirement__item">
                        Использование только латинских букв, символов и цифр
                    </li>
                    <li class="requirement__item">
                        Не менее 8 символов
                    </li>
                    <li class="requirement__item">
                        Не менее одной заглавной буквы
                    </li>
                    <li class="requirement__item">
                        Не менее одной строчной буквы
                    </li>
                </ul>
            </div>
        </div>

        <div class="form__row">
            <div class="form__col">
                <div class="form__field">
                    <div class="form__field-block form__field-block--label">
                        <label for="password" class="form__label form__label--required">
                            <span class="form__label-text">Пароль</span>
                        </label>
                    </div>

                    <div class="form__field-block form__field-block--input" data-password-block>
                        <div class="input input--iconed">
                            <input type="password" class="input__control" name="password" id="password" placeholder="Введите пароль" data-password-input>
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

                    <button type="button" class="form__field-button button button--simple button--red button--underlined button--tiny">
                        Сгенерировать пароль
                    </button>
                </div>
            </div>


            <div class="form__col">
                <div class="form__field">
                    <div class="form__field-block form__field-block--label">
                        <label for="password_confirm" class="form__label form__label--required">
                            <span class="form__label-text">Подтвердить пароль</span>
                        </label>
                    </div>

                    <div class="form__field-block form__field-block--input" data-password-block>
                        <div class="input input--iconed">
                            <input type="password" class="input__control" name="password_confirm" id="password_confirm" placeholder="Введите пароль" data-password-input>
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
        <div class="g-recaptcha" data-sitekey="6LfALokiAAAAAM9E-k4KfUBG0puMAiQc7p1lafU_"></div>
        <div class="registration__actions registration__actions--inlined registration__actions--separated">
            <div class="registration__actions-col">
                <button class="button button--rounded button--covered button--white-green button--full" data-change-step data-direction="previous">
                    <span class="button__text">Назад</span>
                </button>
            </div>

            <div class="registration__actions-col">
                <button class="button button--rounded button--covered button--red button--full" data-register>
                    <span class="button__text">Зарегистрироваться</span>
                </button>
            </div>
        </div>
    </div>
</section>
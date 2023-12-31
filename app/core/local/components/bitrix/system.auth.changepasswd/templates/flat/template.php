<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>

<input type="hidden" name="user_id" id="user_id" value="<?=$arParams['USER_ID']?>" />
<input type="hidden" name="code" id="code" value="<?=$arParams['CONFIRM_CODE']?>" />

<h1 class="content__heading content__heading--centered">Создание нового пароля</h1>

<div class="registration">
    <section class="section section--limited-middle section--centered">
        <div class="registration__form form form--separated form--wraped-big">

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

            <div class="form__row" data-password-container>
                <div class="form__col form__col--full">
                    <div class="form__field">
                        <div class="form__field-block form__field-block--label">
                            <label for="password" class="form__label form__label--required">
                                <span class="form__label-text">Новый пароль</span>
                            </label>
                        </div>

                        <div class="form__field-block form__field-block--input" data-password-block>
                            <div class="input input--iconed">
                                <input type="password" class="input__control" name="password" id="password" placeholder="Введите пароль" data-password-input>
                                <button class="input__icon input__icon-password" data-password-toggle>
                                    <svg class="input__icon-password-icon input__icon-password-icon--show icon icon--eye">
                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-eye"></use>
                                    </svg>
                                    <svg class="input__icon-password-icon input__icon-password-icon--hidden icon icon--eye-off">
                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-eye-off"></use>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <button type="button" class="form__field-button button button--simple button--red button--underlined button--tiny" data-password-generate>
                            Сгенерировать пароль
                        </button>
                    </div>
                </div>


                <div class="form__col form__col--full">
                    <div class="form__field">
                        <div class="form__field-block form__field-block--label">
                            <label for="password_confirm" class="form__label form__label--required">
                                <span class="form__label-text">Подтверждение пароля</span>
                            </label>
                        </div>

                        <div class="form__field-block form__field-block--input" data-password-block>
                            <div class="input input--iconed">
                                <input type="password" class="input__control" name="password_confirm" id="password_confirm" placeholder="Введите пароль" data-password-input>
                                <button class="input__icon input__icon-password" data-password-toggle>
                                    <svg class="input__icon-password-icon input__icon-password-icon--show icon icon--eye">
                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-eye"></use>
                                    </svg>
                                    <svg class="input__icon-password-icon input__icon-password-icon--hidden icon icon--eye-off">
                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-eye-off"></use>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="registration__actions">
                <div class="registration__actions-col">
                    <button type="button" class="button button--rounded button--covered button--green button--full" data-submit>
                        <span class="button__text">Сохранить</span>
                    </button>
                </div>
            </div>
        </div>
    </section>
</div>
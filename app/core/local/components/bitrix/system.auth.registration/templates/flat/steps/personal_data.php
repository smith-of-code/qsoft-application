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
    <h4 class="section__title">Персональные данные</h4>

    <div class="registration__form form form--separated form--wraped">
        <div class="registration__box box box--hidden box--grayish box--rounded-sm">
            <div class="registration__box registration__box--small box box--hidden box--white box--rounded-sm">
                <!--dropzone-->
                <div class="registration__dropzone dropzone dropzone--image" data-uploader>
                    <input type="file" name="photo" class="dropzone__control">

                    <div class="dropzone__area" data-uploader-area='{"paramName": "photo", "url":"/_markup/gui.php", "images": true, "single": true}'>
                        <div class="dropzone__message dz-message needsclick">
                            <div class="dropzone__message-button dz-button link needsclick" data-uploader-previews>
                                <svg class="dropzone__message-button-icon icon icon--camera">
                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-camera"></use>
                                </svg>
                                <?php if ($arResult['photo']):?>
                                    <div class="dropzone__previews-picture dz-preview dz-processing dz-image-preview dz-success dz-complete" data-uploader-preview="" title="Заменить обложку">
                                        <div class="dropzone__previews-picture-box">
                                            <div class="dropzone__previews-picture-image">
                                                <img src="<?=$arResult['photo']['src']?>" class="dropzone__previews-picture-image-pic" data-dz-thumbnail="">
                                            </div>
                                            <div class="dropzone__previews-item-remove" data-dz-remove="">
                                                <svg class="dropzone__previews-item-remove-icon icon icon--cross"><use xlink:href="/public/images/icons/sprite.svg#icon-cross"></use></svg>
                                            </div>
                                        </div>
                                        <div class="dropzone__previews-item-error" data-dz-errormessage=""></div>
                                    </div>
                                <?php endif;?>
                            </div>

                            <div class="dropzone__message-block">
                                <div class="dropzone__message-caption needsclick">
                                    <h6 class="dropzone__message-title">Требования к фото</h6>
                                    <ul class="dropzone__message-list">
                                        <li class="dropzone__message-item">формат jpg, jpeg, png, heic</li>
                                        <li class="dropzone__message-item">размер 240 Х 320 px</li>
                                        <li class="dropzone__message-item">вес не более 1МБ</li>
                                    </ul>
                                </div>

                                <button type="button" class="dropzone__button button button--medium button--rounded button--covered button--red">
                                                        <span class="button__icon">
                                                            <svg class="icon icon--import">
                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-import"></use>
                                                            </svg>
                                                        </span>
                                    <span class="button__text">Загрузить фото</span>
                                </button>
                            </div>
                        </div>

                        <div class="dropzone__previews dz-previews" data-uploader-previews></div>
                    </div>
                </div>
                <!--/dropzone-->

                <div class="form__row">
                    <div class="form__col">
                        <div class="form__field">
                            <div class="form__field-block form__field-block--label">
                                <label for="last_name" class="form__label form__label--required">
                                    <span class="form__label-text">Фамилия</span>
                                </label>
                            </div>

                            <div class="form__field-block form__field-block--input">
                                <div class="input">
                                    <input
                                        type="text"
                                        class="input__control"
                                        name="last_name"
                                        id="last_name"
                                        placeholder="Введите фамилию"
                                        value="<?=$arResult['last_name']?>"
                                    >
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form__col">
                        <div class="form__field">
                            <div class="form__field-block form__field-block--label">
                                <label for="first_name" class="form__label form__label--required">
                                    <span class="form__label-text">Имя</span>
                                </label>
                            </div>

                            <div class="form__field-block form__field-block--input">
                                <div class="input">
                                    <input
                                        type="text"
                                        class="input__control"
                                        name="first_name"
                                        id="first_name"
                                        placeholder="Введите имя"
                                        value="<?=$arResult['first_name']?>"
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form__row form__row--centered">
                    <div class="form__col">
                        <div class="form__field">
                            <div class="form__field-block form__field-block--label">
                                <label for="second_name" class="form__label form__label--required">
                                    <span class="form__label-text">Отчество</span>
                                </label>
                            </div>

                            <div class="form__field-block form__field-block--input">
                                <div class="input">
                                    <input
                                        type="text"
                                        class="input__control"
                                        name="second_name"
                                        id="second_name"
                                        placeholder="Введите отчество"
                                        value="<?=$arResult['second_name']?>"
                                    >
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form__col">
                        <div class="form__field">
                            <div class="checkbox">
                                <input
                                    type="checkbox"
                                    class="checkbox__input"
                                    name="without_second_name"
                                    id="without_second_name"
                                    <?=$arResult['without_second_name'] ? 'checked' : ''?>
                                >

                                <label for="without_second_name" class="checkbox__label">
                                    <span class="checkbox__icon">
                                        <svg class="checkbox__icon-pic icon icon--check">
                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check">
                                        </svg>
                                    </span>

                                    <span class="checkbox__text">У меня нет отчества</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form__row">
                    <div class="form__col">
                        <div class="form__field">
                            <div class="form__field-block form__field-block--label">
                                <label for="gender" class="form__label form__label--required">
                                    <span class="form__label-text">Пол</span>
                                </label>
                            </div>

                            <div class="form__field-block form__field-block--input">
                                <div class="form__control">
                                    <div class="select select--mitigate" data-select>
                                        <select class="select__control" name="gender" id="gender" data-select-control data-placeholder="Выберите пол">
                                            <option><!-- пустой option для placeholder --></option>
                                            <option value="F" <?=$arResult['gender'] === 'F' ? 'selected' : ''?>>Женский</option>
                                            <option value="M" <?=$arResult['gender'] === 'M' ? 'selected' : ''?>>Мужской</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form__col">
                        <div class="form__field">
                            <div class="form__field-block form__field-block--label">
                                <label for="birthdate" class="form__label form__label--required">
                                    <span class="form__label-text">Дата рождения</span>
                                </label>
                            </div>

                            <div class="form__field-block form__field-block--input">
                                <div class="input input--iconed">
                                    <input inputmode="numeric"
                                           class="input__control"
                                           name="birthdate"
                                           id="birthdate"
                                           placeholder="ДД.ММ.ГГГГ"
                                           data-mask-date
                                           data-inputmask-alias="datetime"
                                           data-inputmask-inputformat="dd.mm.yyyy"
                                           value="<?=$arResult['birthdate']?>"
                                    >
                                    <span class="input__icon">
                                        <svg class="icon icon--calendar">
                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-calendar"></use>
                                        </svg>
                                    </span>
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
                                    <span class="form__label-text">Населенный пункт</span>
                                </label>
                            </div>

                            <div class="form__field-block form__field-block--input">
                                <div class="form__control">
                                    <div class="select select--mitigate" data-select>
                                        <select class="select__control" name="city" id="city" data-select-control data-placeholder="Выберите город">
                                            <option><!-- пустой option для placeholder --></option>
                                            <?php foreach ($arResult['cities'] as $city):?>
                                                <option
                                                    value="<?=$city['XML_ID']?>"
                                                    <?=$arResult['city'] === $city['XML_ID'] ? 'selected' : ''?>
                                                >
                                                    <?=$city['VALUE']?>
                                                </option>
                                            <?php endforeach;?>
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
                                <label for="phone" class="form__label form__label--required">
                                    <span class="form__label-text">Телефон</span>
                                </label>
                            </div>

                            <div class="form__field-block form__field-block--input">
                                <div class="input">
                                    <input
                                        type="tel"
                                        class="input__control"
                                        name="phone"
                                        id="phone"
                                        placeholder="+7 (___) ___-__-__"
                                        data-phone
                                        inputmode="text"
                                        value="<?=$arResult['phone']?>"
                                    >
                                </div>
                            </div>

                            <button
                                type="button"
                                class="form__field-button button button--simple button--red button--underlined button--tiny"
                                data-src="#approve-number"
                                data-send-code
                            >
                                Отправить проверочный код
                            </button>
                        </div>
                    </div>

                    <div class="form__col">
                        <div class="form__field">
                            <div class="form__field-block form__field-block--label">
                                <label for="email" class="form__label form__label--required">
                                    <span class="form__label-text">E-mail</span>
                                </label>
                            </div>

                            <div class="form__field-block form__field-block--input">
                                <div class="input">
                                    <input
                                        type="text"
                                        class="input__control"
                                        name="email"
                                        id="email"
                                        placeholder="example@email.com"
                                        data-mail
                                        inputmode="email"
                                        value="<?=$arResult['email']?>"
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="registration__checkboxes checkboxes">
                <ul class="checkboxes__list">
                    <li class="checkboxes__item">
                        <div class="checkbox">
                            <input
                                type="checkbox"
                                class="checkbox__input"
                                name="agree_with_personal_data_processing"
                                id="agree_with_personal_data_processing"
                                <?=$arResult['agree_with_personal_data_processing'] ? 'checked' : ''?>
                            >

                            <label for="agree_with_personal_data_processing" class="checkbox__label">
                                <span class="checkbox__icon">
                                    <svg class="checkbox__icon-pic icon icon--check">
                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check">
                                    </svg>
                                </span>

                                <span class="checkbox__text">Я согласен на обработку персональных данных</span>
                            </label>
                        </div>
                    </li>

                    <li class="checkboxes__item">
                        <div class="checkbox">
                            <input
                                type="checkbox"
                                class="checkbox__input"
                                name="agree_with_terms_of_use"
                                id="agree_with_terms_of_use"
                                <?=$arResult['agree_with_terms_of_use'] ? 'checked' : ''?>
                            >

                            <label for="agree_with_terms_of_use" class="checkbox__label">
                                <span class="checkbox__icon">
                                    <svg class="checkbox__icon-pic icon icon--check">
                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check">
                                    </svg>
                                </span>

                                <span class="checkbox__text">Я согласен с условиями пользования сайтом</span>
                            </label>
                        </div>
                    </li>

                    <li class="checkboxes__item">
                        <div class="checkbox">
                            <input
                                type="checkbox"
                                class="checkbox__input"
                                name="agree_with_company_rules"
                                id="agree_with_company_rules"
                                <?=$arResult['agree_with_company_rules'] ? 'checked' : ''?>
                            >

                            <label for="agree_with_company_rules" class="checkbox__label">
                                <span class="checkbox__icon">
                                    <svg class="checkbox__icon-pic icon icon--check">
                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check">
                                    </svg>
                                </span>

                                <span class="checkbox__text">Я согласен с правилами компании</span>
                            </label>
                        </div>
                    </li>

                    <li class="checkboxes__item">
                        <div class="checkbox">
                            <input
                                type="checkbox"
                                class="checkbox__input"
                                name="agree_to_receive_information__about_promotions"
                                id="agree_to_receive_information__about_promotions"
                                <?=$arResult['agree_to_receive_information__about_promotions'] ? 'checked' : ''?>
                            >

                            <label for="agree_to_receive_information__about_promotions" class="checkbox__label">
                                <span class="checkbox__icon">
                                    <svg class="checkbox__icon-pic icon icon--check">
                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check">
                                    </svg>
                                </span>

                                <span class="checkbox__text">Я согласен на получение информации о продуктах, спецпредложениях и акциях</span>
                            </label>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="registration__actions registration__actions--inlined registration__actions--separated">
                <div class="registration__actions-col">
                    <a href="/login/?login=yes" class="button button--rounded button--covered button--white-green button--full">
                        <span class="button__text">Назад к авторизации</span>
                    </a>
                </div>

                <div class="registration__actions-col">
                    <button class="button button--rounded button--covered button--red button--full <?=$arResult['phone'] ? '' : 'button--disabled'?>" <?=$arResult['phone'] ? '' : 'disabled'?> data-change-step data-direction="next">
                        <span class="button__text">Далее</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<article id="approve-number" class="modal modal--small modal--centered box box--circle box--hanging" style="display: none">
    <div class="modal__content">
        <header class="modal__section modal__section--header">
            <p class="heading heading--small">Подтверждение номера</p>
        </header>

        <section class="modal__section modal__section--content">
            <p class="modal__section-text">
                На указанный номер телефона отправлен код подтверждения. Пожалуйста, введите его в окно ниже
            </p>

            <div class="form__row">
                <div class="form__col">
                    <div class="form__field">
                        <div class="form__field-block form__field-block--input">
                            <div class="input input--tiny input--centered">
                                <input type="text" maxlength="6" class="input__control" name="verify_code" id="verify_code">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button class="button button--rounded button--covered button--red button--full" data-verify-code>
                <span class="button__text">Далее</span>
            </button>
        </section>
    </div>
</article>
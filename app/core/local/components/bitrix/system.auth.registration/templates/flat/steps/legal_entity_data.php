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
    <h4 class="section__title">Юридические данные</h4>

    <form class="registration__form ddd form form--separated form--wraped">
        <div class="section__box box box--gray box--rounded-sm">
            <div class="section__box-inner">
                <h5 class="box__heading box__heading--middle">Общее</h5>

                <div class="section__box-content box box--white box--rounded-sm box--inner">
                    <div class="section__box-block">
                        <h6 class="box__heading box__heading--small">Статус и гражданство</h6>

                        <div class="form__row">
                            <div class="form__col">
                                <div class="form__field">
                                    <div class="form__field-block form__field-block--label">
                                        <label for="r111" class="form__label form__label--required">
                                            <span class="form__label-text">Статус</span>
                                        </label>
                                    </div>

                                    <div class="form__field-block form__field-block--input">
                                        <div class="form__control">
                                            <div class="select select--mitigate" data-select>
                                                <select class="select__control" name="r111" id="r111" data-select-control data-placeholder="Выберите статус">
                                                    <option><!-- пустой option для placeholder --></option>
                                                    <option value="1">Самозанятый</option>
                                                    <option value="2">ИП</option>
                                                    <option value="3">OOO</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form__col">
                                <div class="form__field">
                                    <div class="form__field-block form__field-block--label">
                                        <label for="r11" class="form__label form__label--required">
                                            <span class="form__label-text">Гражданство</span>
                                        </label>
                                    </div>

                                    <div class="form__field-block form__field-block--input">
                                        <div class="form__control">
                                            <div class="select select--mitigate" data-select>
                                                <select class="select__control" name="r11" id="r11" data-select-control data-placeholder="Выберите пол">
                                                    <option><!-- пустой option для placeholder --></option>
                                                    <option value="1">Резидент РФ</option>
                                                    <option value="2">Незезидент РФ</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="section__box-block">
                        <h6 class="box__heading box__heading--small">Паспортные данные</h6>

                        <div class="form__row">
                            <div class="form__col">
                                <div class="form__field">
                                    <div class="form__field-block form__field-block--label">
                                        <label for="text-required" class="form__label form__label--required">
                                            <span class="form__label-text">Серия паспорта</span>
                                        </label>
                                    </div>

                                    <div class="form__field-block form__field-block--input">
                                        <div class="input">
                                            <input type="text" class="input__control" name="text-required" id="text-required" placeholder="12 34" data-passport-seria>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form__col">
                                <div class="form__field">
                                    <div class="form__field-block form__field-block--label">
                                        <label for="text-required" class="form__label form__label--required">
                                            <span class="form__label-text">Номер</span>
                                        </label>
                                    </div>

                                    <div class="form__field-block form__field-block--input">
                                        <div class="input">
                                            <input type="text" class="input__control" name="text-required" id="text-required" placeholder="Введите номер паспорта" data-passport-number>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form__row">
                            <div class="form__col">
                                <div class="form__field">
                                    <div class="form__field-block form__field-block--label">
                                        <label for="text-required" class="form__label form__label--required">
                                            <span class="form__label-text">Кем выдан</span>
                                        </label>
                                    </div>

                                    <div class="form__field-block form__field-block--input">
                                        <div class="input">
                                            <input type="text" class="input__control" name="text-required" id="text-required" placeholder="Кем выдан">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form__col">
                                <div class="form__field">
                                    <div class="form__field-block form__field-block--label">
                                        <label for="date" class="form__label">
                                            <span class="form__label-text">Дата выдачи паспорта</span>
                                        </label>
                                    </div>

                                    <div class="form__field-block form__field-block--input">
                                        <div class="input input--iconed">
                                            <input inputmode="numeric"
                                                   class="input__control"
                                                   name="date"
                                                   id="date"
                                                   placeholder="ДД.ММ.ГГГГ"
                                                   data-mask-date
                                                   data-inputmask-alias="datetime"
                                                   data-inputmask-inputformat="dd.mm.yyyy"
                                                   data-pets-date-input
                                                   data-pets-change
                                                   value="09.10.2017"
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
                    </div>

                    <div class="section__box-block">
                        <h6 class="box__heading box__heading--small">Загрузить копию паспорта</h6>

                        <div class="dropzone" data-uploader>
                            <input type="file" name="test[]" multiple class="dropzone__control">

                            <div class="dropzone__area" data-uploader-area='{"paramName": "test[]", "url":"/_markup/gui.php"}'>
                                <div class="dropzone__message dz-message needsclick">
                                    <div class="dropzone__message-caption needsclick">
                                        <h6 class="dropzone__message-title">Ограничения:</h6>
                                        <ul class="dropzone__message-list">
                                            <li class="dropzone__message-item">до 10 файлов</li>
                                            <li class="dropzone__message-item">вес каждого файла не более 5 МБ</li>
                                            <li class="dropzone__message-item">форматы файлов: PDF, JPG, JPEG, PNG, HEIC</li>
                                        </ul>
                                    </div>

                                    <button type="button" class="dropzone__button button button--medium button--rounded button--covered button--red">
                                        <span class="button__icon">
                                            <svg class="icon icon--import">
                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-import"></use>
                                            </svg>
                                        </span>
                                        <span class="button__text">Загрузить файл</span>
                                    </button>
                                </div>

                                <div class="dropzone__previews dz-previews" data-uploader-previews>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="section__box-block">
                        <h6 class="box__heading box__heading--small">Адрес регистрации</h6>

                        <div class="form__row">
                            <div class="form__col">
                                <div class="form__field">
                                    <div class="form__field-block form__field-block--label">
                                        <label for="text-required" class="form__label form__label--required">
                                            <span class="form__label-text">Населенный пункт</span>
                                        </label>
                                    </div>

                                    <div class="form__field-block form__field-block--input">
                                        <div class="input">
                                            <input type="text" class="input__control" name="text-required" id="text-required" placeholder="Населенный пункт">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form__col">
                                <div class="form__field">
                                    <div class="form__field-block form__field-block--label">
                                        <label for="text-required" class="form__label form__label--required">
                                            <span class="form__label-text">Улица</span>
                                        </label>
                                    </div>

                                    <div class="form__field-block form__field-block--input">
                                        <div class="input">
                                            <input type="text" class="input__control" name="text-required" id="text-required" placeholder="Улица">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form__row">
                            <div class="form__col">
                                <div class="form__field">
                                    <div class="form__field-block form__field-block--label">
                                        <label for="text-required" class="form__label form__label--required">
                                            <span class="form__label-text">Дом</span>
                                        </label>
                                    </div>

                                    <div class="form__field-block form__field-block--input">
                                        <div class="input">
                                            <input type="number" class="input__control" name="text-required" id="text-required" placeholder="Дом">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form__col">
                                <div class="form__field">
                                    <div class="form__field-block form__field-block--label">
                                        <label for="text-required" class="form__label form__label--required">
                                            <span class="form__label-text">Квартира</span>
                                        </label>
                                    </div>

                                    <div class="form__field-block form__field-block--input">
                                        <div class="input">
                                            <input type="number" class="input__control" name="text-required" id="text-required" placeholder="Квартира">
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="form__col">
                                <div class="form__field">
                                    <div class="form__field-block form__field-block--label">
                                        <label for="text-required" class="form__label form__label--required">
                                            <span class="form__label-text">Индекс</span>
                                        </label>
                                    </div>

                                    <div class="form__field-block form__field-block--input">
                                        <div class="input">
                                            <input type="number" class="input__control" name="text-required" id="text-required" placeholder="Индекс">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="section__box-block">
                        <h6 class="box__heading box__heading--small">Адрес проживания</h6>

                        <div class="form__row">
                            <div class="form__col">
                                <div class="form__field">
                                    <div class="form__field-block form__field-block--label">
                                        <label for="text-required" class="form__label form__label--required">
                                            <span class="form__label-text">Населенный пункт</span>
                                        </label>
                                    </div>

                                    <div class="form__field-block form__field-block--input">
                                        <div class="input">
                                            <input type="text" class="input__control" name="text-required" id="text-required" placeholder="Населенный пункт">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form__col">
                                <div class="form__field">
                                    <div class="form__field-block form__field-block--label">
                                        <label for="text-required" class="form__label form__label--required">
                                            <span class="form__label-text">Улица</span>
                                        </label>
                                    </div>

                                    <div class="form__field-block form__field-block--input">
                                        <div class="input">
                                            <input type="text" class="input__control" name="text-required" id="text-required" placeholder="Улица">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form__row">
                            <div class="form__col">
                                <div class="form__field">
                                    <div class="form__field-block form__field-block--label">
                                        <label for="text-required" class="form__label form__label--required">
                                            <span class="form__label-text">Дом</span>
                                        </label>
                                    </div>

                                    <div class="form__field-block form__field-block--input">
                                        <div class="input">
                                            <input type="number" class="input__control" name="text-required" id="text-required" placeholder="Дом">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form__col">
                                <div class="form__field">
                                    <div class="form__field-block form__field-block--label">
                                        <label for="text-required" class="form__label form__label--required">
                                            <span class="form__label-text">Квартира</span>
                                        </label>
                                    </div>

                                    <div class="form__field-block form__field-block--input">
                                        <div class="input">
                                            <input type="number" class="input__control" name="text-required" id="text-required" placeholder="Квартира">
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="form__col">
                                <div class="form__field">
                                    <div class="form__field-block form__field-block--label">
                                        <label for="text-required" class="form__label form__label--required">
                                            <span class="form__label-text">Индекс</span>
                                        </label>
                                    </div>

                                    <div class="form__field-block form__field-block--input">
                                        <div class="input">
                                            <input type="number" class="input__control" name="text-required" id="text-required" placeholder="Индекс">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form__row">
                            <div class="form__col">
                                <div class="form__field">
                                    <div class="checkbox">
                                        <input type="checkbox" class="checkbox__input" name="check[]" value="s" id="check">

                                        <label for="check" class="checkbox__label">
                                            <span class="checkbox__icon">
                                                <svg class="checkbox__icon-pic icon icon--check">
                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check">
                                                </svg>
                                            </span>

                                            <span class="checkbox__text">Адрес регистрации совпадает с адресом фактического проживания</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="section__box-inner">
                <h5 class="box__heading box__heading--middle">Самозанятый</h5>

                <div class="section__box-content box box--white box--rounded-sm box--inner">
                    <div class="section__box-block">
                        <div class="form__row">
                            <div class="form__col">
                                <div class="form__field">
                                    <div class="form__field-block form__field-block--label">
                                        <label for="text-required" class="form__label form__label--required">
                                            <span class="form__label-text">ИНН</span>
                                        </label>
                                    </div>

                                    <div class="form__field-block form__field-block--input">
                                        <div class="input">
                                            <input type="text" class="input__control" name="text-required" id="text-required" placeholder="ИНН" data-inn>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="section__box-block">
                        <h6 class="box__heading box__heading--small">Загрузить копию свидетельства о постановке на учет в налоговом органе</h6>

                        <div class="dropzone" data-uploader>
                            <input type="file" name="uploadFiles[]" multiple class="dropzone__control">

                            <div class="dropzone__area" data-uploader-area='{"paramName": "uploadFiles[]", "url":"/_markup/gui.php"}'>
                                <div class="dropzone__message dz-message needsclick">
                                    <div class="dropzone__message-caption needsclick">
                                        <h6 class="dropzone__message-title">Ограничения:</h6>
                                        <ul class="dropzone__message-list">
                                            <li class="dropzone__message-item">до 10 файлов</li>
                                            <li class="dropzone__message-item">вес каждого файла не более 5 МБ</li>
                                            <li class="dropzone__message-item">форматы файлов: PDF, JPG, JPEG, PNG, HEIC</li>
                                        </ul>
                                    </div>

                                    <button type="button" class="dropzone__button button button--medium button--rounded button--covered button--red">
                                        <span class="button__icon">
                                            <svg class="icon icon--import">
                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-import"></use>
                                            </svg>
                                        </span>
                                        <span class="button__text">Загрузить файл</span>
                                    </button>
                                </div>

                                <div class="dropzone__previews dz-previews" data-uploader-previews>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="section__box-block">
                        <h6 class="box__heading box__heading--small">Банковские реквизиты</h6>

                        <div class="form__row">
                            <div class="form__col">
                                <div class="form__field">
                                    <div class="form__field-block form__field-block--label">
                                        <label for="text-required" class="form__label form__label--required">
                                            <span class="form__label-text">Наименование банка</span>
                                        </label>
                                    </div>

                                    <div class="form__field-block form__field-block--input">
                                        <div class="input">
                                            <input type="text" class="input__control" name="text-required" id="text-required" placeholder="Наименование банка">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form__col">
                                <div class="form__field">
                                    <div class="form__field-block form__field-block--label">
                                        <label for="text-required" class="form__label form__label--required">
                                            <span class="form__label-text">БИК</span>
                                        </label>
                                    </div>

                                    <div class="form__field-block form__field-block--input">
                                        <div class="input">
                                            <input type="text" class="input__control" name="text-required" id="text-required" placeholder="БИК" data-bik>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form__row">
                            <div class="form__col">
                                <div class="form__field">
                                    <div class="form__field-block form__field-block--label">
                                        <label for="text-required" class="form__label form__label--required">
                                            <span class="form__label-text">Расчетный счет</span>
                                        </label>
                                    </div>

                                    <div class="form__field-block form__field-block--input">
                                        <div class="input">
                                            <input type="number" class="input__control" name="text-required" id="text-required" placeholder="Расчетный счет">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form__col">
                                <div class="form__field">
                                    <div class="form__field-block form__field-block--label">
                                        <label for="text-required" class="form__label form__label--required">
                                            <span class="form__label-text">Корреспондентский счет</span>
                                        </label>
                                    </div>

                                    <div class="form__field-block form__field-block--input">
                                        <div class="input">
                                            <input type="number" class="input__control" name="text-required" id="text-required" placeholder="Корреспондентский счет">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="section__box-block">
                        <h6 class="box__heading box__heading--small">Загрузить сведения о банковских реквизитах</h6>

                        <div class="dropzone" data-uploader>
                            <input type="file" name="uploadFiles[]" multiple class="dropzone__control">

                            <div class="dropzone__area" data-uploader-area='{"paramName": "uploadFiles[]", "url":"/_markup/gui.php"}'>
                                <div class="dropzone__message dz-message needsclick">
                                    <div class="dropzone__message-caption needsclick">
                                        <h6 class="dropzone__message-title">Ограничения:</h6>
                                        <ul class="dropzone__message-list">
                                            <li class="dropzone__message-item">до 10 файлов</li>
                                            <li class="dropzone__message-item">вес каждого файла не более 5 МБ</li>
                                            <li class="dropzone__message-item">форматы файлов: PDF, JPG, JPEG, PNG, HEIC</li>
                                        </ul>
                                    </div>

                                    <button type="button" class="dropzone__button button button--medium button--rounded button--covered button--red">
                                        <span class="button__icon">
                                            <svg class="icon icon--import">
                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-import"></use>
                                            </svg>
                                        </span>
                                        <span class="button__text">Загрузить файл</span>
                                    </button>
                                </div>

                                <div class="dropzone__previews dz-previews" data-uploader-previews>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="section__box-block">
                        <h6 class="box__heading box__heading--small">Загрузить копию справки о постановке на учет физического лица в качестве плательщика налога на профессиональный доход</h6>

                        <div class="dropzone" data-uploader>
                            <input type="file" name="uploadFiles[]" multiple class="dropzone__control">

                            <div class="dropzone__area" data-uploader-area='{"paramName": "uploadFiles[]", "url":"/_markup/gui.php"}'>
                                <div class="dropzone__message dz-message needsclick">
                                    <div class="dropzone__message-caption needsclick">
                                        <h6 class="dropzone__message-title">Ограничения:</h6>
                                        <ul class="dropzone__message-list">
                                            <li class="dropzone__message-item">до 10 файлов</li>
                                            <li class="dropzone__message-item">вес каждого файла не более 5 МБ</li>
                                            <li class="dropzone__message-item">форматы файлов: PDF, JPG, JPEG, PNG, HEIC</li>
                                        </ul>
                                    </div>

                                    <button type="button" class="dropzone__button button button--medium button--rounded button--covered button--red">
                                        <span class="button__icon">
                                            <svg class="icon icon--import">
                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-import"></use>
                                            </svg>
                                        </span>
                                        <span class="button__text">Загрузить файл</span>
                                    </button>
                                </div>

                                <div class="dropzone__previews dz-previews" data-uploader-previews>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form__row">
                        <div class="form__col">
                            <div class="form__field">
                                <div class="checkbox">
                                    <input type="checkbox" class="checkbox__input" name="check[]" value="s" id="check">

                                    <label for="check" class="checkbox__label">
                                        <span class="checkbox__icon">
                                            <svg class="checkbox__icon-pic icon icon--check">
                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check">
                                            </svg>
                                        </span>

                                        <span class="checkbox__text">Я подтверждаю правильность введенных данных и подлинность загруженных документов</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="registration__actions registration__actions--inlined registration__actions--separated">
            <div class="registration__actions-col">
                <button class="button button--rounded button--covered button--white-green button--full" data-change-step data-direction="previous">
                    <span class="button__text">Назад</span>
                </button>
            </div>

            <div class="registration__actions-col">
                <button type="button" class="button button--rounded button--covered button--red button--full" data-change-step data-direction="next">
                    <span class="button__text">Далее</span>
                </button>
            </div>
        </div>
    </form>
</section>
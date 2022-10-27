<?php
if (!defined('B_PROLOG_INCLUDED') || !B_PROLOG_INCLUDED) {
    die();
}
?>

<main class="page__faq faq">
    <div class="breadcrumbs">
        <ul class="breadcrumbs__list">
            <li class="breadcrumbs__item">
                <a href="#" class="breadcrumbs__link">Главная</a>
            </li>
            <li class="breadcrumbs__item breadcrumbs__item--active">
                <a class="breadcrumbs__link">FAQ</a>
            </li>
        </ul>
    </div>

    <h1 class="page__heading faq__heading">FAQ</h1>

    <div class="content__main">
        <div class="faq__wrapper">
            <section class="faq__questions questions">
                <?php foreach ($arResult['GROUPS'] as $key => $group) : ?>
                <div class="questions__item">
                    <div class="question">
                        <h3 class="question__theme"><?=$group?></h3>

                        <div class="question__accordeon accordeon">
                            <?php foreach ($arResult['QUESTIONS'][$key] as $question) :
                                $i = 1;?>
                            <div class="accordeon__item box box--rounded-sm box--hovering" data-accordeon>
                                <div class="accordeon__header" data-accordeon-toggle>
                                    <h5 class="question__accordeon-title accordeon__title">
                                        <span class="question__accordeon-number"><?=$i?>.</span>
                                        <?=$question['UF_QUESTION']?>
                                    </h5>

                                    <button type="button" class="accordeon__toggle button button--circular button--mini button--covered button--red-white" >
                                                <span class="accordeon__toggle-icon button__icon">
                                                    <svg class="icon icon--arrow-down">
                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-down"></use>
                                                    </svg>
                                                </span>
                                    </button>

                                </div>

                                <div class="accordeon__body accordeon__body--bordered" data-accordeon-content>
                                    <?=$question['UF_ANSWER']?>
                                </div>
                            </div>
                            <?php $i++;
                            endforeach;?>
                        </div>
                    </div>
                </div>
                <?php endforeach;?>
            </section>
            <div class="faq__setask setask">
                <div class="setask__image">
                    <svg class="setask__image-picture icon icon--cat-think">
                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-cat-think"></use>
                    </svg>
                </div>
                <p class="setask__text">Не нашли ответа на свой вопрос?</p>
                <p class="setask__subtext">Напишите нам</p>
                <button type="button"
                        class="setask__button button button--rounded button--covered button--green button--full"
                        data-fancybox data-modal-type="modal"
                        data-src="#technical-support"
                >
                    Задать вопрос
                </button>
                <article id="technical-support" class="modal modal--limited modal--wide modal--scrolled box box--circle box--hanging" style="display: none" data-support>
                    <div class="modal__content">
                        <header class="modal__section modal__section--header">
                            <p class="heading heading--average">Техническая поддержка</p>
                        </header>

                        <section class="modal__section modal__section--content" data-scrollbar>
                            <form action="" class="form">
                                <div class="form__row form__row--separated">
                                    <div class="form__col">
                                        <div class="form__field">
                                            <div class="form__field-block form__field-block--label">
                                                <label for="selectTp" class="form__label form__label--required">
                                                    <span class="form__label-text">Тип обращения</span>
                                                </label>
                                            </div>

                                            <div class="form__field-block form__field-block--input">
                                                <div class="form__control">
                                                    <div class="select select--mitigate" data-select>
                                                        <select class="select__control" name="selectTp" id="selectTp" data-select-control data-placeholder="Выберите город" data-option>
                                                            <option><!-- пустой option для placeholder --></option>
                                                            <option value="1" data-variant="refund">Возврат заказа</option>
                                                            <option value="2" data-variant="nonfunctional">Неработающая функциональность</option>
                                                            <option value="3" data-variant="change">Смена наставника/контактного лица</option>
                                                            <option value="4" data-variant="personal">Смена персональных данных</option>
                                                            <option value="5" data-variant="other" selected>Другое</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal__section-variant" data-variant-block="refund">
                                    <div class="form__row form__row--gaped">
                                        <div class="form__col">
                                            <div class="form__field">
                                                <div class="form__field-block form__field-block--label">
                                                    <label for="Email2" class="form__label">
                                                        <span class="form__label-text">Email</span>
                                                    </label>
                                                </div>

                                                <div class="form__field-block form__field-block--input">
                                                    <div class="input input--simple">
                                                        <input type="text" class="input__control" name="Email" id="Email2" value="Pushkin@ya.ru" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form__row form__row--closer">
                                        <div class="form__col">
                                            <div class="form__field">
                                                <div class="form__field-block form__field-block--label">
                                                    <label for="text-required7" class="form__label form__label--required">
                                                        <span class="form__label-text">Номер заказа</span>
                                                    </label>
                                                </div>

                                                <div class="form__field-block form__field-block--input">
                                                    <div class="input">
                                                        <input type="text" class="input__control" name="text-required" id="text-required7" placeholder="">
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
                                                        <textarea type="text" class="input__control" name="textarea" id="textarea3" placeholder="Не более 1000 символов" maxlength="1000" data-textarea-input=""></textarea>
                                                        <div class="input__counter">
                                                            <span class="input__counter-current" data-textarea-current="">0</span>
                                                            /
                                                            <span class="input__counter-total" data-textarea-total="">1000</span>
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal__section-variant" data-variant-block="nonfunctional">

                                    <div class="form__row form__row--gaped">
                                        <div class="form__col">
                                            <div class="form__field">
                                                <div class="form__field-block form__field-block--label">
                                                    <label for="Email1" class="form__label">
                                                        <span class="form__label-text">Email</span>
                                                    </label>
                                                </div>

                                                <div class="form__field-block form__field-block--input">
                                                    <div class="input input--simple">
                                                        <input type="text" class="input__control" name="Email" id="Email1" value="Pushkin@ya.ru" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form__row form__row--closer">
                                        <div class="form__col">
                                            <div class="form__field">
                                                <div class="form__field-block form__field-block--label">
                                                    <label for="text" class="form__label">
                                                        <span class="form__label-text">Комментарий</span>
                                                    </label>
                                                </div>
                                                <div class="form__field-block form__field-block--input">
                                                    <label class="input input--textarea">
                                                        <textarea type="text" class="input__control" name="textarea" id="textarea2" placeholder="Не более 1000 символов" maxlength="1000" data-textarea-input=""></textarea>
                                                        <div class="input__counter">
                                                            <span class="input__counter-current" data-textarea-current="">0</span>
                                                            /
                                                            <span class="input__counter-total" data-textarea-total="">1000</span>
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal__section-variant" data-variant-block="change">
                                    <div class="form__row form__row--gaped">
                                        <div class="form__col">
                                            <div class="form__field">
                                                <div class="form__field-block form__field-block--label">
                                                    <label for="Email3" class="form__label">
                                                        <span class="form__label-text">Email</span>
                                                    </label>
                                                </div>

                                                <div class="form__field-block form__field-block--input">
                                                    <div class="input input--simple">
                                                        <input type="text" class="input__control" name="Email" id="Email3" value="Pushkin@ya.ru" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form__row form__row--closer">
                                        <div class="form__col">
                                            <div class="form__field">
                                                <div class="form__field-block form__field-block--label">
                                                    <label for="ID" class="form__label">
                                                        <span class="form__label-text">ID текущего наставника</span>
                                                    </label>
                                                </div>

                                                <div class="form__field-block form__field-block--input">
                                                    <div class="input input--simple">
                                                        <input type="text" class="input__control" name="ID" id="ID" value="323213" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form__row">
                                        <div class="form__col">
                                            <div class="form__field">
                                                <div class="form__field-block form__field-block--label">
                                                    <label for="text-required9" class="form__label form__label--required">
                                                        <span class="form__label-text">ID нового наставника</span>
                                                    </label>
                                                </div>

                                                <div class="form__field-block form__field-block--input">
                                                    <div class="input">
                                                        <input type="number" class="input__control" name="text-required" id="text-required9" placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form__row">
                                        <div class="form__col">
                                            <div class="form__field">
                                                <div class="form__field-block form__field-block--label">
                                                    <label for="select4m" class="form__label form__label--required">
                                                        <span class="form__label-text">Причина</span>
                                                    </label>
                                                </div>

                                                <div class="form__field-block form__field-block--input">
                                                    <div class="form__control">
                                                        <div class="select select--mitigate" data-select>
                                                            <select class="select__control" name="select4m" id="select4m" data-select-control data-placeholder="Выберите город">
                                                                <option><!-- пустой option для placeholder --></option>
                                                                <option value="1">Возврат заказа</option>
                                                                <option value="2">Неработающая функциональность</option>
                                                                <option value="3">Смена наставника/контактного лица</option>
                                                                <option value="4">Смена персональных данных</option>
                                                                <option value="5">Другое</option>
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
                                                    <label for="text" class="form__label">
                                                        <span class="form__label-text">Комментарий</span>
                                                    </label>
                                                </div>
                                                <div class="form__field-block form__field-block--input">
                                                    <label class="input input--textarea">
                                                        <textarea type="text" class="input__control" name="textarea" id="textarea4" placeholder="Не более 1000 символов" maxlength="1000" data-textarea-input=""></textarea>
                                                        <div class="input__counter">
                                                            <span class="input__counter-current" data-textarea-current="">0</span>
                                                            /
                                                            <span class="input__counter-total" data-textarea-total="">1000</span>
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal__section-variant" data-variant-block="personal">
                                    <div class="form__row form__row--gaped">
                                        <div class="form__col">
                                            <div class="form__field">
                                                <div class="form__field-block form__field-block--label">
                                                    <label for="Email4" class="form__label">
                                                        <span class="form__label-text">Email</span>
                                                    </label>
                                                </div>

                                                <div class="form__field-block form__field-block--input">
                                                    <div class="input input--simple">
                                                        <input type="text" class="input__control" name="Email" id="Email4" value="Pushkin@ya.ru" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form__row form__row--closer">
                                        <div class="form__col">
                                            <div class="form__field">
                                                <div class="form__field-block form__field-block--label">
                                                    <label for="text-required10" class="form__label">
                                                        <span class="form__label-text">Актуальная фамилия</span>
                                                    </label>
                                                </div>

                                                <div class="form__field-block form__field-block--input">
                                                    <div class="input">
                                                        <input type="number" class="input__control" name="text-required" id="text-required10" placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form__row">
                                        <div class="form__col">
                                            <div class="form__field">
                                                <div class="form__field-block form__field-block--label">
                                                    <label for="text-required11" class="form__label">
                                                        <span class="form__label-text">Актуальное имя</span>
                                                    </label>
                                                </div>

                                                <div class="form__field-block form__field-block--input">
                                                    <div class="input">
                                                        <input type="number" class="input__control" name="text-required" id="text-required11" placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form__row">
                                        <div class="form__col">
                                            <div class="form__field">
                                                <div class="form__field-block form__field-block--label">
                                                    <label for="text-required" class="form__label">
                                                        <span class="form__label-text">Актуальное отчество</span>
                                                    </label>
                                                </div>

                                                <div class="form__field-block form__field-block--input">
                                                    <div class="input">
                                                        <input type="number" class="input__control" name="text-required" id="text-required" placeholder="">
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
                                                        <span class="form__label-text">Дата рождения</span>
                                                    </label>
                                                </div>
                                                <div class="form__field-block form__field-block--input">
                                                    <div class="input input--iconed">
                                                        <input inputmode="numeric"
                                                               class="input__control"
                                                               name="birthdate"
                                                               id="birthdate2"
                                                               placeholder="ДД.ММ.ГГГГ"
                                                               data-mask-date
                                                               data-inputmask-alias="datetime"
                                                               data-inputmask-inputformat="dd.mm.yyyy"
                                                               data-pets-date-input
                                                               data-pets-change
                                                               value="09.11.2011"
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

                                                        <button type="button" class="dropzone__button dropzone__button--wide button button--medium button--rounded button--outlined button--green">
                                                                    <span class="button__icon">
                                                                        <svg class="icon icon--import">
                                                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-import"></use>
                                                                        </svg>
                                                                    </span>
                                                            <span class="button__text button__text--required">Загрузить файл</span>
                                                        </button>
                                                    </div>

                                                    <div class="dropzone__previews dropzone__previews--small dz-previews" data-uploader-previews>
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
                                                        <textarea type="text" class="input__control" name="textarea" id="textarea5" placeholder="Не более 1000 символов" maxlength="1000" data-textarea-input=""></textarea>
                                                        <div class="input__counter">
                                                            <span class="input__counter-current" data-textarea-current="">0</span>
                                                            /
                                                            <span class="input__counter-total" data-textarea-total="">1000</span>
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal__section-variant modal__section-variant--active" data-variant-block="other">
                                    <div class="form__row form__row--gaped">
                                        <div class="form__col">
                                            <div class="form__field">
                                                <div class="form__field-block form__field-block--label">
                                                    <label for="Email1" class="form__label">
                                                        <span class="form__label-text">Email</span>
                                                    </label>
                                                </div>

                                                <div class="form__field-block form__field-block--input">
                                                    <div class="input input--simple">
                                                        <input type="text" class="input__control" name="Email" id="Email1" value="Pushkin@ya.ru" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form__row form__row--closer">
                                        <div class="form__col">
                                            <div class="form__field">
                                                <div class="form__field-block form__field-block--label">
                                                    <label for="text" class="form__label">
                                                        <span class="form__label-text">Комментарий</span>
                                                    </label>
                                                </div>
                                                <div class="form__field-block form__field-block--input">
                                                    <label class="input input--textarea">
                                                        <textarea type="text" class="input__control" name="textarea" id="textarea2" placeholder="Не более 1000 символов" maxlength="1000" data-textarea-input=""></textarea>
                                                        <div class="input__counter">
                                                            <span class="input__counter-current" data-textarea-current="">0</span>
                                                            /
                                                            <span class="input__counter-total" data-textarea-total="">1000</span>
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal__section-actions">
                                    <button type="button" class="form__footer-button button button--rounded button--covered button--red button--full">Отправить</button>
                                </div>
                            </form>
                        </section>
                    </div>
                </article>
            </div>
        </div>
    </div>
</main>

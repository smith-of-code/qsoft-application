<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);
?>
<article id="technical-support" class="modal modal--limited modal--wide modal--scrolled box box--circle box--hanging" style="display: none" data-support>
<div class="modal__content" data-support-content>

    <header class="modal__section modal__section--header">
        <p class="heading heading--average">Техническая поддержка</p>
    </header>
    <section class="modal__section modal__section--content" data-scrollbar data-modal-section>
        <form action="POST" class="form" data-validation="support" data-support-form>
            <div class="form__row form__row--separated">
                <div class="form__col">
                    <div class="form__field">
                        <div class="form__field-block form__field-block--label">
                            <label for="TICKET_TYPE" class="form__label form__label--required">
                                <span class="form__label-text">Тип обращения</span>
                            </label>
                        </div>
                        <div class="form__field-block form__field-block--input">
                            <div class="form__control">
                                <div class="select select--mitigate" data-select>
                                    <select class="select__control select__control--black js-required" name="TICKET_TYPE" id="ticket-type" data-select-control data-placeholder="Выберите вариант" data-option>
                                        <option><!-- пустой option для placeholder --></option>
                                        <option value="CHANGE_OF_PERSONAL_DATA" data-variant="CHANGE_OF_PERSONAL_DATA">Смена персональных данных</option>
                                        <option value="REFUND_ORDER" data-variant="REFUND_ORDER">Возврат заказа</option>
                                        <option value="SUPPORT" data-variant="SUPPORT">Неработающая функциональность</option>
                                        <option value="CHANGE_MENTOR" data-variant="CHANGE_MENTOR">Смена наставника/контактного лица</option>
                                        <option value="OTHER" data-variant="OTHER">Другое</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form__row form__row--gaped">
                        <div class="form__col">
                            <div class="form__field">
                                <div class="form__field-block form__field-block--label">
                                    <label for="EMAIL" class="form__label form__label--required">
                                        <span class="form__label-text">Email</span>
                                    </label>
                                </div>

                                <div class="form__field-block form__field-block--input">
                                    <div class="input input--simple">
                                        <span class="input__control input__control-static"><?=$arResult['EMAIL']?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--Смена персональных данных-->
            <div class="modal__section-variant" data-variant-block="CHANGE_OF_PERSONAL_DATA">

                <div class="form__row">
                    <div class="form__col">
                        <div class="form__field">
                            <div class="form__field-block form__field-block--label">
                                <label for="LAST_NAME" class="form__label">
                                    <span class="form__label-text">Актуальная фамилия</span>
                                </label>
                            </div>

                            <div class="form__field-block form__field-block--input">
                                <div class="input">
                                    <input type="text" class="input__control" name="LAST_NAME" id="personal-last-name" placeholder="Введите фамилию"  data-variant-value="CHANGE_OF_PERSONAL_DATA">
                                    <span class="input__control-error" style="display:none;"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form__row">
                    <div class="form__col">
                        <div class="form__field">
                            <div class="form__field-block form__field-block--label">
                                <label for="NAME" class="form__label">
                                    <span class="form__label-text">Актуальное имя</span>
                                </label>
                            </div>

                            <div class="form__field-block form__field-block--input">
                                <div class="input">
                                    <input type="text" class="input__control" name="NAME" id="personal-name" placeholder="Введите имя"  data-variant-value="CHANGE_OF_PERSONAL_DATA">
                                    <span class="input__control-error" style="display:none;"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form__row">
                    <div class="form__col">
                        <div class="form__field">
                            <div class="form__field-block form__field-block--label">
                                <label for="SECOND_NAME" class="form__label">
                                    <span class="form__label-text">Актуальное отчество</span>
                                </label>
                            </div>

                            <div class="form__field-block form__field-block--input">
                                <div class="input">
                                    <input type="text" class="input__control" name="SECOND_NAME" id="personal-second-name" placeholder="Введите отчество"  data-variant-value="CHANGE_OF_PERSONAL_DATA">
                                    <span class="input__control-error" style="display:none;"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form__row">
                    <div class="form__col">
                        <div class="form__field">
                            <div class="form__field-block form__field-block--label">
                                <label for="birthdate" class="form__label">
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
                                        data-mask-date-reg
                                        autocomplete="off"
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
                        <?php $APPLICATION->IncludeComponent('zolo:dropzone', '', [
                            'NAME' => 'files',
                            'FILES' => $arResult['files'],
                            'THEME' => 'FAQ',
                            'REQUEST_URL' => '/ajax/popup/popup-support.php'
                        ])?>
                    </div>
                </div>

                <div class="form__row">
                    <div class="form__col">
                        <div class="form__field">
                            <div class="form__field-block form__field-block--label form__field-block--label-mini">
                                <label for="MESSAGE" class="form__label">
                                    <span class="form__label-text">Комментарий</span>
                                </label>
                            </div>
                            <div class="form__field-block form__field-block--input">
                                <label class="input input--textarea">
                                    <textarea type="text" class="input__control" name="MESSAGE" id="message-personal" placeholder="Не более 1000 символов" maxlength="1000" data-textarea-input=""  data-variant-value="CHANGE_OF_PERSONAL_DATA"></textarea>
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
            <!--/Смена персональных данных-->

            <!--Возврат заказа-->
            <div class="modal__section-variant" data-variant-block="REFUND_ORDER">

                <div class="form__row form__row--closer">
                    <div class="form__col">
                        <div class="form__field">
                            <div class="form__field-block form__field-block--label">
                                <label for="ORDER_NUMBER" class="form__label form__label--required">
                                    <span class="form__label-text">Номер заказа</span>
                                </label>
                            </div>

                            <div class="form__field-block form__field-block--input">
                                <div class="input">
                                    <input type="number" class="input__control js-required js-number" name="ORDER_NUMBER" id="refund-order-id" placeholder=""  data-variant-value="REFUND_ORDER" data-replace-input="number">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form__row">
                    <div class="form__col">
                        <div class="form__field">
                            <div class="form__field-block form__field-block--label">
                                <label for="MESSAGE" class="form__label  form__label--required">
                                    <span class="form__label-text">Комментарий</span>
                                </label>
                            </div>
                            <div class="form__field-block form__field-block--input">
                                <label class="input input--textarea">
                                    <textarea type="text" class="input__control js-required" name="MESSAGE" id="message-refund" placeholder="Не более 1000 символов" maxlength="1000" data-textarea-input="" data-variant-value="REFUND_ORDER"></textarea>
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
            <!--/Возврат заказа-->

            <!--Неработающая функциональность-->
            <div class="modal__section-variant" data-variant-block="SUPPORT">

                <div class="form__row form__row--closer">
                    <div class="form__col">
                        <div class="form__field">
                            <div class="form__field-block form__field-block--label">
                                <label for="MESSAGE" class="form__label form__label--required">
                                    <span class="form__label-text">Комментарий</span>
                                </label>
                            </div>
                            <div class="form__field-block form__field-block--input">
                                <label class="input input--textarea">
                                    <textarea type="text" class="input__control js-required" name="MESSAGE" id="message-support" placeholder="Не более 1000 символов" maxlength="1000" data-textarea-input=""  data-variant-value="SUPPORT"></textarea>
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
            <!--/Неработающая функциональность-->

            <!--Смена наставника/контактного лица-->
            <div class="modal__section-variant" data-variant-block="CHANGE_MENTOR">

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
                                    <span class="input__control input__control-static"><?=$arResult['MENTHOR_ID'] ?? 'Нет наставника'?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form__row">
                    <div class="form__col">
                        <div class="form__field">
                            <div class="form__field-block form__field-block--label">
                                <label for="NEW_MENTOR_ID" class="form__label form__label--required">
                                    <span class="form__label-text">ID нового наставника</span>
                                </label>
                            </div>

                            <div class="form__field-block form__field-block--input">
                                <div class="input">
                                    <input type="number" class="input__control js-required js-number" name="NEW_MENTOR_ID" id="new-mentor-id" placeholder=""  data-variant-value="CHANGE_MENTOR" data-replace-input="number">
                                    <span class="input__control-error" style="display:none;"></span>
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
                                        <select class="select__control js-required" name="COUSES" id="couses-change" data-select-control data-placeholder="Выберите причину"  data-variant-value="CHANGE_MENTOR">
                                            <option><!-- пустой option для placeholder --></option>
                                            <option value="1">Мой наставник не связался со мной после регистрации в течение длительного времени</option>
                                            <option value="2">Мой наставник не выходит на связь</option>
                                            <option value="3">Мой наставник некорректно общается</option>
                                            <option value="4">Мой наставник переехал</option>
                                            <option value="5">Мой наставник зарегистрирован под чужим именем</option>
                                            <option value="6">Другое</option>
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
                                <label for="MESSAGE" class="form__label">
                                    <span class="form__label-text">Комментарий</span>
                                </label>
                            </div>
                            <div class="form__field-block form__field-block--input">
                                <label class="input input--textarea">
                                    <textarea type="text" class="input__control" name="MESSAGE" id="couses-message" placeholder="Не более 1000 символов" maxlength="1000" data-textarea-input=""  data-variant-value="CHANGE_MENTOR"></textarea>
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
            <!--/Смена наставника/контактного лица-->

            <!--Другое-->
            <div class="modal__section-variant" data-variant-block="OTHER">

                <div class="form__row form__row--closer">
                    <div class="form__col">
                        <div class="form__field">
                            <div class="form__field-block form__field-block--label">
                                <label for="MESSAGE" class="form__label form__label--required">
                                    <span class="form__label-text">Комментарий</span>
                                </label>
                            </div>
                            <div class="form__field-block form__field-block--input">
                                <label class="input input--textarea">
                                    <textarea type="text" class="input__control js-required" name="MESSAGE" id="other-message" placeholder="Не более 1000 символов" maxlength="1000"data-textarea-input="" data-variant-value="OTHER"></textarea>
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
            <!--/Другое-->

            <div class="modal__section-actions">
                <button type="submit" class="form__footer-button button button--rounded button--covered button--red button--full">Отправить</button>
            </div>
        </form>
    </section>
</div>

let addonsIdx = 0,
    oldValue,
    BITRIX_AJAX = '/bitrix/services/main/ajax.php?',
    query = {
        c: 'zolo:techsupport.form.handler',
        mode: 'class',
    };
// import scrollbar from './scrollbar';
// import inputRepalece from './inputReplace';
// import inputMaskInit from "./inputmask";
const SUPPORT_TYPE = ["CHANGE_MENTOR", "CHANGE_OF_PERSONAL_DATA", "SUPPORT", "REFUND_ORDER", "OTHER"];

$(document).on("change", "[data-select]", function () {
    // query.action = 'load';
    // $.ajax({
    //     url: BITRIX_AJAX + $.param(query, true),
    //     method: 'POST',
    //     cache: false,
    //     data: $('[data-select]').data('selected'),
    //     success: function (response) {
    //         console.log(3213213);
    //         let data = JSON.parse(response.data);
    //         initSelect();
    //         initSendForm();
    //
    //         if (typeof selected !== "undefined" && saveSelected !== selected) {
    //             changeForm(saveSelected, selected);
    //             saveSelected = selected;
    //         }
    //     }
    // });    let selected = $('[data-select-control]').val();
    //     console.log(selected);
    //
    //     if (typeof selected !== "undefined" && saveSelected !== selected) {
    //         changeForm(saveSelected, selected);
    //     }
    let selected = $('[data-select-control]').val();

    if (selected !== "undefined") {
        changeForm(selected);
    }
});


function initCheckbox () {
    $('input[name=without_second_name]').on('change', function() {
        const input = $('input[name=SECOND_NAME]');
        if ($(`input[name=without_second_name]:checked`).length) {
            input.val('');
            input.removeClass('input__control--error');
            input.parent().find('.input__control-error').remove();
            input.attr('disabled', true);
        } else {
            input.attr('disabled', null);
        }
    });
}

function changeForm(savedSelected) {
    for (let type in SUPPORT_TYPE) {
        let selectedForm = $('div').find('[data-variant-block='+SUPPORT_TYPE[type]+']');
        if (SUPPORT_TYPE[type] === savedSelected) {
            if (!selectedForm.hasClass('modal__section-variant--active')) {
                selectedForm.addClass('modal__section-variant--active')
            }
        } else {
            if (selectedForm.hasClass('modal__section-variant--active')) {
                selectedForm.removeClass('modal__section-variant--active')
            }
        }
    }
}

function setDataToPopup (data, selected) {
    return `
            <header class="modal__section modal__section--header">
                <p class="heading heading--average">Техническая поддержка</p>
            </header>
            <section class="modal__section modal__section--content" data-scrollbar data-modal-section>
                <form action="" class="form" data-validation="support" data-support-form>
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
                                            <select class="select__control js-required" name="TICKET_TYPE" id="ticket-type" data-select-control data-placeholder="Выберите вариант" data-option>
                                                <option><!-- пустой option для placeholder --></option>
                                                <option value="CHANGE_OF_PERSONAL_DATA" data-variant="CHANGE_OF_PERSONAL_DATA" ${selected === 'CHANGE_OF_PERSONAL_DATA' ? 'selected' : ''}>Смена персональных данных</option>
                                                <option value="REFUND_ORDER" data-variant="REFUND_ORDER" ${selected === 'REFUND_ORDER' ? 'selected' : ''}>Возврат заказа</option>
                                                <option value="SUPPORT" data-variant="SUPPORT" ${selected === 'SUPPORT' ? 'selected' : ''}>Неработающая функциональность</option>
                                                ${!data.MENTHOR_ID || data.MENTHOR_ID === 'false' ? '' : ('<option value="CHANGE_MENTOR" data-variant="CHANGE_MENTOR" ' + (selected === 'CHANGE_MENTOR' ? 'selected' : '') + '>Смена наставника/контактного лица</option>')}
                                                <option value="OTHER" data-variant="OTHER" ${selected === 'OTHER' ? 'selected' : ''}>Другое</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form__row form__row--gaped">
                                <div class="form__col">
                                    <div class="form__field">
                                        <div class="form__field-block form__field-block--label">
                                            <label for="EMAIL" class="form__label">
                                                <span class="form__label-text">Email</span>
                                            </label>
                                        </div>

                                        <div class="form__field-block form__field-block--input">
                                            <div class="input input--simple">
                                                <span class="input__control input__control-static">${data.EMAIL}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--Смена персональных данных-->
                    <div class="modal__section-variant ${selected === 'CHANGE_OF_PERSONAL_DATA' ? 'modal__section-variant--active' : ''}" data-variant-block="CHANGE_OF_PERSONAL_DATA">

                        <div class="form__row">
                            <div class="form__col">
                                <div class="form__field">
                                    <div class="form__field-block form__field-block--label">
                                        <label for="LAST_NAME" class="form__label form__label--required">
                                            <span class="form__label-text">Актуальная фамилия</span>
                                        </label>
                                    </div>

                                    <div class="form__field-block form__field-block--input">
                                        <div class="input">
                                            <input type="text" class="input__control js-required" name="LAST_NAME" id="personal-last-name" placeholder="Введите фамилию"  data-variant-value="CHANGE_OF_PERSONAL_DATA">
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
                                        <label for="LAST_NAME" class="form__label form__label--required">
                                            <span class="form__label-text">Актуальное имя</span>
                                        </label>
                                    </div>

                                    <div class="form__field-block form__field-block--input">
                                        <div class="input">
                                            <input type="text" class="input__control js-required" name="NAME" id="personal-name" placeholder="Введите имя"  data-variant-value="CHANGE_OF_PERSONAL_DATA">
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
                                        <label for="SECOND_NAME" class="form__label form__label--required">
                                            <span class="form__label-text">Актуальное отчество</span>
                                        </label>
                                    </div>

                                    <div class="form__field-block form__field-block--input">
                                        <div class="input">
                                            <input type="text" class="input__control js-required" name="SECOND_NAME" id="personal-second-name" placeholder="Введите отчество"  data-variant-value="CHANGE_OF_PERSONAL_DATA">
                                            <span class="input__control-error" style="display:none;"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form__row">
                            <div class="form__col">
                                <div class="form__field">
                                    <div class="checkbox">
                                        <input
                                                type="checkbox"
                                                class="checkbox__input"
                                                name="without_second_name"
                                                id="without_second_name"
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
                                        <label for="birthdate" class="form__label form__label--required">
                                            <span class="form__label-text">Дата рождения</span>
                                        </label>
                                    </div>
    
                                    <div class="form__field-block form__field-block--input">
                                        <div class="input input--iconed">
                                            <input inputmode="numeric"
                                                class="input__control js-required"
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
                            
                            
                            
<!--                                <div class="registration__dropzone dropzone dropzone&#45;&#45;image" data-uploader>-->
<!--                                    <input type="file" name="" class="dropzone__control">-->
<!--                                -->
<!--                                    <div class="dropzone__area">-->
<!--                                        <div class="dropzone__message dz-message needsclick">-->
<!--                                            <div class="dropzone__message-button dz-button link needsclick" data-uploader-previews>-->
<!--                                                <svg class="dropzone__message-button-icon icon icon&#45;&#45;camera">-->
<!--                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-camera"></use>-->
<!--                                                </svg>-->
<!--&lt;!&ndash;                                                <?php if ($arParams['PHOTO']):?>&ndash;&gt;-->
<!--&lt;!&ndash;                                                    <div class="dropzone__previews-picture dz-preview dz-processing dz-image-preview dz-success dz-complete" data-uploader-preview="" title="Заменить обложку">&ndash;&gt;-->
<!--&lt;!&ndash;                                                        <div class="dropzone__previews-picture-box">&ndash;&gt;-->
<!--&lt;!&ndash;                                                            <div class="dropzone__previews-picture-image">&ndash;&gt;-->
<!--&lt;!&ndash;                                                                <img src="<?=$arParams['PHOTO']['src']?>" class="dropzone__previews-picture-image-pic" data-dz-thumbnail="">&ndash;&gt;-->
<!--&lt;!&ndash;                                                            </div>&ndash;&gt;-->
<!--&lt;!&ndash;                                                            <div class="dropzone__previews-item-remove" data-dz-remove="">&ndash;&gt;-->
<!--&lt;!&ndash;                                                                <svg class="dropzone__previews-item-remove-icon icon icon&#45;&#45;cross"><use xlink:href="/public/images/icons/sprite.svg#icon-cross"></use></svg>&ndash;&gt;-->
<!--&lt;!&ndash;                                                            </div>&ndash;&gt;-->
<!--&lt;!&ndash;                                                        </div>&ndash;&gt;-->
<!--&lt;!&ndash;                                                        <div class="dropzone__previews-item-error" data-dz-errormessage=""></div>&ndash;&gt;-->
<!--&lt;!&ndash;                                                    </div>&ndash;&gt;-->
<!--&lt;!&ndash;                                                <?php endif;?>&ndash;&gt;-->
<!--                                            </div>-->
<!--                                -->
<!--                                            <div class="dropzone__message-block">-->
<!--                                                <div class="dropzone__message-caption needsclick">-->
<!--                                                    <h6 class="dropzone__message-title">Требования к фото</h6>-->
<!--                                                    <ul class="dropzone__message-list">-->
<!--                                                        <li class="dropzone__message-item">формат jpg, jpeg, png, heic</li>-->
<!--                                                        <li class="dropzone__message-item">размер 240 Х 320 px</li>-->
<!--                                                        <li class="dropzone__message-item">вес не более 1МБ</li>-->
<!--                                                    </ul>-->
<!--                                                </div>-->
<!--                                -->
<!--                                                <button type="button" class="dropzone__button button button&#45;&#45;medium button&#45;&#45;rounded button&#45;&#45;covered button&#45;&#45;red" data-uploader-area='{"url":"/_markup/gui.php", "images": true, "single": true, "acceptedFiles": ".jpg, .jpeg, .png, .heic" }'>-->
<!--                                                    <span class="button__icon">-->
<!--                                                        <svg class="icon icon&#45;&#45;import">-->
<!--                                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-import"></use>-->
<!--                                                        </svg>-->
<!--                                                    </span>-->
<!--                                                    <span class="button__text">Загрузить фото</span>-->
<!--                                                </button>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                -->
<!--                                        <div class="dropzone__previews dz-previews" data-uploader-previews></div>-->
<!--                                    </div>-->
<!--                                </div>-->
                            
                            
                            
                            
                            
<!--                                <div class="profile__avatar">-->
<!--                                    <div class="profile__avatar-box">-->
<!--                                        <div class="profile__avatar-image">-->
<!--                                            <svg class="dropzone__message-button-icon icon icon&#45;&#45;camera">-->
<!--                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-camera"></use>-->
<!--                                            </svg>-->
<!--                                        </div>-->
<!--                                    </div>-->

<!--                                    <div class="profile__dropzone dropzone dropzone&#45;&#45;image dropzone&#45;&#45;simple" data-uploader>-->
<!--                                        <input type="file" name="photo" multiple class="dropzone__control js-required">-->
<!--                                        <div class="dropzone__area">-->
<!--                                            <div class="dropzone__message dropzone__message&#45;&#45;simple dz-message needsclick">-->
<!--                                                <div class="dropzone__message-button dz-button link needsclick" data-uploader-previews>-->
<!--                                                    <svg class="dropzone__message-button-icon icon icon&#45;&#45;camera">-->
<!--                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-camera"></use>-->
<!--                                                    </svg>-->
<!--                                                </div>-->

<!--                                                <div class="profile__toggle">-->
<!--                                                    <button type="button" class="dropzone__button button button&#45;&#45;medium button&#45;&#45;rounded button&#45;&#45;outlined button&#45;&#45;green" data-uploader-area='{"paramName": "photo", "url":"/_markup/gui.php", "images": true, "single": true, "acceptedFiles": ".jpg, .jpeg, .png, .heic"}'>-->
<!--                                                        <span class="button__icon">-->
<!--                                                            <svg class="icon icon&#45;&#45;import">-->
<!--                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-import"></use>-->
<!--                                                            </svg>-->
<!--                                                        </span>-->
<!--                                                        <span class="button__text">Загрузить фото</span>-->
<!--                                                    </button>-->
<!--                                                </div>-->

<!--                                                <div class="profile__toggle dropzone__message-caption needsclick">-->
<!--                                                    <h6 class="dropzone__message-title">Требования к фото:</h6>-->
<!--                                                    <ul class="dropzone__message-list">-->
<!--                                                        <li class="dropzone__message-item">формат jpg, jpeg, png, heic</li>-->
<!--                                                        <li class="dropzone__message-item">размер 240 Х 320 px</li>-->
<!--                                                        <li class="dropzone__message-item">вес не более 1МБ</li>-->
<!--                                                    </ul>-->
<!--                                                </div>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
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
                    <div class="modal__section-variant ${selected === 'REFUND_ORDER' ? 'modal__section-variant--active' : ''}" data-variant-block="REFUND_ORDER">

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
                    <div class="modal__section-variant ${selected === 'SUPPORT' ? 'modal__section-variant--active' : ''}" data-variant-block="SUPPORT">

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
                    <div class="modal__section-variant ${selected === 'CHANGE_MENTOR' ? 'modal__section-variant--active' : ''}" data-variant-block="CHANGE_MENTOR">

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
                                            <span class="input__control input__control-static">${data.MENTHOR_ID ?? 'Нет наставника'}</span>
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
                    <div class="modal__section-variant ${selected === 'OTHER' ? 'modal__section-variant--active' : ''}" data-variant-block="OTHER">

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
    `;
}

function initSendForm() {
    $('[data-validation="support"]').validate({
        submitHandler: () => {
            let fields = {
                TICKET_TYPE: $('#ticket-type').val(),
                MESSAGE: $('#other-message').val(),
                NEW_MENTOR_ID: $('#new-mentor-id').val(),
                COUSES: $('#couses-change').find(":selected").text()
            };

            if (fields.TICKET_TYPE === "CHANGE_OF_PERSONAL_DATA") {
                fields.MESSAGE = $('#message-personal').val()
            } else if (fields.TICKET_TYPE === "CHANGE_MENTOR") {
                fields.MESSAGE = $('#couses-message').val()
            } else if (fields.TICKET_TYPE === "REFUND_ORDER") {
                fields.MESSAGE = $('#message-refund').val()
            } else if (fields.TICKET_TYPE === "SUPPORT") {
                fields.MESSAGE = $('#message-support').val()
            }

            sendForm(fields);
        }
    });
}

function sendForm(data) {
    BX.ajax.runComponentAction('zolo:techsupport.form.handler', 'sendTicket', {
        mode: 'class',
        data: {fields: data}
    }).then(function (response) {
        let data = JSON.parse(response.data);
        if (data.ticket_id > 0) {
            setSuccessMessage(data.ticket_id);
        } else {
            setErrorMessage();
            console.error("err", 'data.ticket_id равен 0');
        }
    }, function (response) {
        console.error("err", response.errors);
        let messageError =  response.errors[0].message;

        let errorsVariant = {
            sameId: 'ID нового наставника совпадает с вашим',
            noneId: 'Такого пользователя не существует',
            novalidId: 'Указанный пользователь не может быть Вашим наставником',
        }

        if (messageError === errorsVariant.sameId ) {
            errorIDInput(errorsVariant.sameId)
        } else if (messageError === errorsVariant.noneId) {
            errorIDInput(errorsVariant.noneId)
        } else if (messageError === errorsVariant.novalidId) {
            errorIDInput(errorsVariant.novalidId)
        } else {
            setErrorMessage();
        }
    });
}

function errorIDInput(errorMassage) {
    let inputIdNewMentor = $("#new-mentor-id");
    let errorBox = inputIdNewMentor.parent().find('.input__control-error');
    inputIdNewMentor.addClass('input__control--error');
    errorBox.text(errorMassage);
    errorBox.show();

    inputIdNewMentor.on('input', function() {
        if (inputIdNewMentor.val().length === 0) {
            errorBox.hide();
            inputIdNewMentor.removeClass('input__control--error');
        }
    })
}

function setSuccessMessage(id) {
    let successMessage = `
        <div class="notification">
            <div class="notification__icon">
                <svg class="icon icon--tick-circle">
                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-tick-circle"></use>
                </svg>
            </div>

            <h4 class="notification__title">
                Заявка успешно отправлена!
            </h4>

            <p class="notification__text">
                Ваша заявка отправлена. Проверьте вашу электронную почту.
            </p>
        </div>
    `;

    $('[data-support-content]').html(successMessage);
    $('[data-support-content]').addClass('modal__content--support-notification');
}

function setErrorMessage() {
    let errorMessage = `
        <div class="notification">
            <div class="notification__icon notification__icon--error">
                <svg class="icon icon--tick-circle">
                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-close-tick-circle"></use>
                </svg>
            </div>

            <h4 class="notification__title">
                Произошла непредвиденная ошибка!
            </h4>
        </div>
    `;

    $('[data-support-content]').html(errorMessage);
    $('[data-support-content]').addClass('modal__content--support-notification');
}

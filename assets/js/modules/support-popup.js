 import scrollbar from './scrollbar';
 import validation from './validation';
 import inputRepalece from './inputReplace';

export default function showSupportPopup() {
    let body = $('body');
    body.append(setPopup());
    initSupportForms();
}

function setPopup() {
    return `
    <article id="technical-support" class="modal modal--limited modal--wide modal--scrolled box box--circle box--hanging" style="display: none" data-support>
        <div class="modal__content" data-support-content>
        </div>
    </div>
    `;
}

function initSupportForms() {
    $('[data-src="#technical-support"]').on('click', function () {
        let popup = $('[data-support-content]');
        popup.removeClass('modal__content--support-notification');

        if (popup.find('[data-modal-section]').length > 0) {
            return;
        }

        setTimeout(() => {
            inputRepalece();
        }, 1000);

        let selected = $(this).data('selected');
        let saveSelected = '';

        BX.ajax.runComponentAction('zolo:techsupport.form.handler', 'load', {
            mode: 'class',
            data: {}
        }).then(function (response) {
            let data = JSON.parse(response.data);
            popup.html(setDataToPopup(data.data, selected));
            initSelect();
            scrollbar();
            initSendForm();
        }, function (response) {
            console.error("err", response.errors);
        });
        saveSelected = selected;

        if (typeof selected !== "undefined" && saveSelected !== selected) {
            changeForm(saveSelected, selected);
            saveSelected = selected;
        }
    });
}

function changeForm(Oldselected, savedSelected) {
    let selectedSuportType = $('#ticket-type');
    let oldForm = '';
    let selectedOption =  $('option[value='+savedSelected+']')

    selectedSuportType.val(savedSelected);
    selectedSuportType.trigger('change')

    if (Oldselected !== "") {
        oldForm = $('div').find('[data-variant-block='+Oldselected+']');

        if (selectedForm.hasClass('modal__section-variant--active')) {
            selectedForm.removeClass('modal__section-variant--active')
        }
    }

    let selectedForm = $('div').find('[data-variant-block='+savedSelected+']');

    if (!selectedForm.hasClass('modal__section-variant--active')) {
        selectedForm.addClass('modal__section-variant--active')
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

            if (fields.TICKET_TYPE === "CHANGE_MENTOR") {
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

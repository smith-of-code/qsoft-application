export default function showSupportPopup() {
    function getPopup() {
        let body = $('body');
        
        BX.ajax.runComponentAction('zolo:techsupport.form.handler', 'load', {
            mode: 'class',
            data: {}
        }).then(function (response) {
            let data = JSON.parse(response.data);
            body.append(setDataToPopup(data.data));
            initSelect()
            initSendForm();
            console.log("ok", data);
        }, function (response) {
            console.log("err", response.errors);
        });
    }
}

function setDataToPopup (data) {
    return `
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
                                        <label for="TICKET_TYPE" class="form__label form__label--required">
                                            <span class="form__label-text">Тип обращения</span>
                                        </label>
                                    </div>

                                    <div class="form__field-block form__field-block--input">
                                        <div class="form__control">
                                            <div class="select select--mitigate" data-select>
                                                <select class="select__control" name="TICKET_TYPE" id="ticket-type" data-select-control data-placeholder="Выберите вариант" data-option>
                                                    <option><!-- пустой option для placeholder --></option>
                                                    <option value="REFUND_ORDER" data-variant="REFUND_ORDER">Возврат заказа</option>
                                                    <option value="SUPPORT" data-variant="SUPPORT">Неработающая функциональность</option>
                                                    <option value="CHANGE_MENTOR" data-variant="CHANGE_MENTOR">Смена наставника/контактного лица</option>
                                                    <option value="OTHER" data-variant="OTHER">Другое</option>
                                                </select>
                                                <span class="input__control-error" hidden attitude-id="ticket-type">Не указан тип обращения</span>
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
                                                        <input type="text" class="input__control" name="EMAIL" id="EMAIL" value="${data.EMAIL}" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

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
                                                <input type="text" class="input__control" name="ORDER_NUMBER" id="refund-order-id" placeholder=""  data-variant-value="REFUND_ORDER">
                                                <span class="input__control-error" hidden attitude-id="refund-order-id">Не введен id заказа</span>
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
                                                <textarea type="text" class="input__control" name="MESSAGE" id="message-refund" placeholder="Не более 1000 символов" maxlength="1000" data-textarea-input="" data-variant-value="REFUND_ORDER"></textarea>
                                                <span class="input__control-error" hidden attitude-id="message-refund">Не указана причина возврата заказа</span>
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
                                            <label for="MESSAGE" class="form__label">
                                                <span class="form__label-text">Комментарий</span>
                                            </label>
                                        </div>
                                        <div class="form__field-block form__field-block--input">
                                            <label class="input input--textarea">
                                                <textarea type="text" class="input__control" name="MESSAGE" id="message-support" placeholder="Не более 1000 символов" maxlength="1000" data-textarea-input=""  data-variant-value="SUPPORT"></textarea>
                                                <span class="input__control-error" hidden attitude-id="message-support">Не указана причина обращения</span>
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
                                                <input type="text" class="input__control" name="MENTOR_ID" id="mentor_id" value="${data.MENTOR_ID ?? 'Нет наставника'}" readonly  data-variant-value="CHANGE_MENTOR">
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
                                                <input type="number" class="input__control" name="NEW_MENTOR_ID" id="new-mentor-id" placeholder=""  data-variant-value="CHANGE_MENTOR">
                                                <span class="input__control-error" hidden attitude-id="new-mentor-id">Не указан id нового наставника</span>
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
                                                    <select class="select__control" name="COUSES" id="couses-change" data-select-control data-placeholder="Выберите причину"  data-variant-value="CHANGE_MENTOR">
                                                        <option><!-- пустой option для placeholder --></option>
                                                        <option value="1">Мой наставник не связался со мной после регистрации в течение длительного времени.</option>
                                                        <option value="2">Мой наставник не выходит на связь</option>
                                                        <option value="3">Мой наставник некорректно общается</option>
                                                        <option value="4">Мой наставник переехал</option>
                                                        <option value="5">Мой наставник зарегистрирован под чужим именем</option>
                                                        <option value="6">Другое</option>
                                                    </select>
                                                    <span class="input__control-error" hidden attitude-id="couses-change">Не указана причина смены наставника</span>
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
                                                <span class="input__control-error" hidden attitude-id="couses-message">Не указан коментарий</span>
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
                        <div class="modal__section-variant modal__section-variant--active" data-variant-block="OTHER">

                            <div class="form__row form__row--closer">
                                <div class="form__col">
                                    <div class="form__field">
                                        <div class="form__field-block form__field-block--label">
                                            <label for="MESSAGE" class="form__label">
                                                <span class="form__label-text">Комментарий</span>
                                            </label>
                                        </div>
                                        <div class="form__field-block form__field-block--input">
                                            <label class="input input--textarea">
                                                <textarea type="text" class="input__control" name="MESSAGE" id="other-message" placeholder="Не более 1000 символов" maxlength="1000"data-textarea-input="" data-variant-value="OTHER"></textarea>
                                                <span class="input__control-error" hidden attitude-id="other-message">Не указана причина обращения</span>
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
                            <button type="button" id="send_suport-message" class="form__footer-button button button--rounded button--covered button--red button--full">Отправить</button>
                        </div>
                    </form>
                </section>
            </div>
        </article>
    `;
}

function initSendForm() {
    $('#send_suport-message').on('click', function() {
        let selectedSuportType = $('#ticket-type').val();
        let error = '';

        if (selectedSuportType === '') {
            $('span[attitude-id=ticket-type').removeAttr('hidden')
            return false;
        }
        let fields = {};

        fields['TICKET_TYPE'] = $('#ticket-type').val();
        fields['EMAIL'] = $('#EMAIL').val();

        $('[data-variant-value=' + selectedSuportType + ']').each(function () {
            if ($(this).prop("tagName") === 'SELECT') {
                fields[$(this).attr('name')] = $(this).find('option:selected').text();
                if ($(this).find('option:selected').text() === '') {
                    $('span[attitude-id=' + $(this).attr('id')).removeAttr('hidden')
                    error = 'Пустое поле';
                }
            } else {
                fields[$(this).attr('name')] = $(this).val();
                if ($(this).val() === '') {
                    $('span[attitude-id=' + $(this).attr('id')).removeAttr('hidden')
                    error = 'Пустое поле';
                }
            }

        });

        if (error != '') {
            return false;
        }

        sendForm(fields);
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
        }
        console.log("ok", data);
    }, function (response) {
        console.log("err", response.errors);
    });
}

function setSuccessMessage(id) {
    let successMessage = `
        <div class="gui__block">
            <header class="modal__section modal__section--header">
                <p class="heading heading--average">Техническая поддержка</p>
            </header>

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
        </div>
    `;

    $('#technical-support div.modal__content').html(successMessage);
    $('#technical-support div.modal__content').css('background-color', '#f2f1f4');
}
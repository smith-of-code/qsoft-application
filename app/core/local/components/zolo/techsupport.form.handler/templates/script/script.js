const SUPPORT_TYPE = ["CHANGE_MENTOR", "CHANGE_OF_PERSONAL_DATA", "SUPPORT", "REFUND_ORDER", "OTHER"];

$(document).on("change", "[data-select]", function () {
    initSendForm();
    initCheckbox();
    let selected = $('#ticket-type').val();
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
    for (let key in SUPPORT_TYPE) {
        let selectedForm = $('div').find('[data-variant-block='+SUPPORT_TYPE[key]+']');
        if (SUPPORT_TYPE[key] === savedSelected) {
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


function initSendForm() {
    $('[data-validation="support"]').validate({
        submitHandler: () => {
            let fields = {
                TICKET_TYPE: $('#ticket-type').val(),
                MESSAGE: $('#other-message').val(),
                ORDER_NUMBER: $('#refund-order-id').val(),
                LAST_NAME: $('#personal-last-name').val(),
                NAME: $('#personal-name').val(),
                SECOND_NAME: $('#personal-second-name').val(),
                PERSONAL_PHOTO: $('#photo-id').val(),
                PERSONAL_BIRTHDAY: $('#birthdate').val(),
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

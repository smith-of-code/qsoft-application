import validate from 'jquery-validation';

$.extend($.validator.messages, {
    required: "Это поле обязательно для заполнения",
    email: "Указан некорректный почтовый адрес",
});

$.validator.addMethod(
    "validDate",
    function(value, element) {
        return ( !value || value.match(/^\d{2}([./-])\d{2}\1\d{4}$/) )},
    "Пожалуйста, укажите дату в формате дд.мм.гггг"
);

$.validator.setDefaults({
    errorClass: 'input__control--error',
    errorElement: 'span',

    errorPlacement: function (error, element) {
        error.addClass('input__control-error').appendTo(element.closest('.form__field'));
    },
});

export default function () {}
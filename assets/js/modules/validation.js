import validate from 'jquery-validation';

const ELEMENTS_SELECTOR = {
    block: '[data-validate-dependent]',
    change: '[data-validate-dependent-change]',
};

$.extend($.validator.messages, {
    required: "Обязательное поле",
    email: "Указан некорректный почтовый адрес",
});

$.validator.setDefaults({
    errorClass: 'input__control--error',
    errorElement: 'span',

    errorPlacement: function (error, element) {
        error.addClass('input__control-error').appendTo(element.closest('.form__field'));
    },
});

$.validator.addMethod(
    "validDate",
    function(value, element) {
        return ( !value || value.match(/^\d{2}([./-])\d{2}\1\d{4}$/) )},
    "Пожалуйста, укажите дату в формате дд.мм.гггг"
);

$.validator.addMethod(
    "requiredDependent",
    function(value, element) {
        let block = $(element).closest(ELEMENTS_SELECTOR.block);
        let checkbox = block.find(ELEMENTS_SELECTOR.change);

        if (checkbox.is(":checked")) {
            return true;
        } else {
            return value != '';
        }
    },
    "Обязательное поле"
);

$.validator.addClassRules("js-required", {
    required: true,
});
$.validator.addClassRules("js-email", {
    email: true,
});
$.validator.addClassRules("js-date", {
    validDate: true,
});
$.validator.addClassRules("js-required-dependent", {
    requiredDependent: true,
});

export default function () {}
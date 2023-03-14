class BecomeConsultantComponent {
    constructor() {
        this.initListeners();
    }

    initListeners() {
        var mainInstance = this;

        $(`.form input`).on('keyup', this.removeError);
        $(`.form select, .form input[type=checkbox]`).on('change', this.removeError);
        $('select[name=status]').on('change', this.changeLegalEntity);
        $('select[name=need_proxy]').on('change', this.changeNeedProxy);
        $('input[name=without_living]').on('click', this.checkLivingBlock);

        $('button[data-submit]').on('click', this.changeStepListener);

        // Синхронизация чекбокса "Плательщик НДС"
        $("input[name=nds_payer_ip]").on('change', function() {
            $("input[name=nds_payer_ltc]").prop("checked", this.checked);
        });
        $("input[name=nds_payer_ltc]").on('change', function() {
            $("input[name=nds_payer_ip]").prop("checked", this.checked);
        });
        // Синхронизация БИК
        $("input[name=bic]").on('change', function() {
            mainInstance.synchronizeSameFields(this);
        });
    }

    synchronizeSameFields(obj) {
        var thatObj = $(obj);
        var sameName = thatObj.attr('name');
        $("input[name="+sameName+"]").each(function () {
            var otherObj = $(this);
            if (otherObj.attr('id') !== thatObj.attr('id')) {
                $(this).val(thatObj.val());
            }
        });
    }

    checkLivingBlock() {
        const isActive = $('input[name=without_living]:checked').length;

        const locality = $('#living_locality');
        const street = $('#living_street');
        const house = $('#living_house');
        const apartment = $('#living_apartment');
        const postalCode = $('#living_postal_code');

        if (isActive) {
            locality.val('');
            locality.attr('disabled', true);
            locality.removeClass('input__control--error');

            street.val('');
            street.attr('disabled', true);
            street.removeClass('input__control--error');

            house.val('');
            house.attr('disabled', true);
            house.removeClass('input__control--error');

            apartment.val('');
            apartment.attr('disabled', true);
            apartment.removeClass('input__control--error');

            postalCode.val('');
            postalCode.attr('disabled', true);
            postalCode.removeClass('input__control--error');
        } else {
            locality.attr('disabled', false);
            street.attr('disabled', false);
            house.attr('disabled', false);
            apartment.attr('disabled', false);
            postalCode.attr('disabled', false);
        }
    }

    changeNeedProxy() {
        const dropzone = $('input[name=procuration]');
        if ($(`#${$(this).attr('id')}`).val() !== 'true') {
            dropzone.parent().parent().show();
        } else {
            dropzone.parent().parent().hide();
            dropzone.parent().removeClass('dropzone--error');
        }
    }

    changeLegalEntity() {
        $('.legal_entity').hide();
        $(`.legal_entity.${$(this).val()}`).show();
    }

    removeError() {
        $(this).removeClass('input__control--error');
        $(this).parent().find('span.input__control-error').remove();
        $(this).closest('.form__field').find('span.input__control-error').remove();
    }

    async changeStepListener() {
        let data = {};

        // Перебираем поля формы
        $('.form').find('input, select').each((index, item) => {

            // Игнорируем поля для других статусов
            if (
                $(item).closest('.legal_entity').length
                && !$(item).closest('.legal_entity').hasClass(data.status)
            ) {
                return;
            }
            // Игнорируем скрытые поля
            if ($(item).attr('type') === 'hidden' || !$(item).attr('name')) {
                return;
            }

            if ($(item).attr('type') === 'file') {

                if ($(item).attr('multiple')) {
                    if ($(item).attr('name') === 'procuration' && $(item).parent().parent().css('display') === 'none') {
                        return;
                    }

                    data[$(item).attr('name')] = { files: [] };
                    $(item).parent().find('.file.dz-success.dz-complete').each((index, innerItem) => {
                        data[$(item).attr('name')].files.push({
                            id: $(innerItem).find('input[type=hidden]').val(),
                            name: $(innerItem).find('[data-uploader-preview-filename]').html(),
                            format: $(innerItem).find('[data-uploader-preview-format]').html(),
                            size: $(innerItem).find('[data-uploader-preview-size]').html(),
                        });
                    });

                    if (! data[$(item).attr('name')].files.length &&
                        (
                            (
                                $(item).attr('name') === 'usn_notification'
                                && ! $('input[name=nds_payer_ip]:checked').length
                                && ! $('input[name=nds_payer_ltc]:checked').length
                            )
                            || $(item).attr('name') !== 'usn_notification'

                        )
                    ) {
                        if ($(item).attr('name') === 'bank_details') {
                            return;
                        }
                        $(item).parent().addClass('dropzone--error');
                    } else {
                        $(item).parent().removeClass('dropzone--error');
                    }
                } else {
                    const fileContainer = $(item).parent().find('img.dropzone__previews-picture-image-pic').last();
                    if (fileContainer.attr('alt')) {
                        data[$(item).attr('name')] = {
                            name: fileContainer.attr('alt'),
                            data: fileContainer.attr('src'),
                        };
                    }
                }

            }
            else if ($(item).attr('type') === 'checkbox') {
                data[$(item).attr('name')] = !!$(`#${$(item).attr('id')}:checked`).length;
                if (!data[$(item).attr('name')] && ['correctness_confirmation_self_employed', 'correctness_confirmation_ip', 'correctness_confirmation_ltc'].includes($(item).attr('name'))) {
                    $(item).addClass('input__control--error');
                }
            }
            else if ($(item).attr('name') === 'register_postal_code') {
                let indexPost = $("input[name='register_postal_code']");
                let indexPostValue = indexPost.val().replace(/[^0-9\.]/g,'');
                if (indexPostValue.length < 6 || indexPostValue.length > 6) {
                    indexPost.addClass('input__control--error');
                } else {
                    indexPost.removeClass('input__control--error');
                    data[$(item).attr('name')] = $(item).val();
                }
                return;
            }
            else if ($(item).attr('name') === 'living_postal_code') {
                let indexPostLiving = $("input[name='living_postal_code']");
                let indexPostLivingValue = indexPostLiving.val().replace(/[^0-9\.]/g,'');
                let livingAdress = $('input[name=without_living]:checked').length;
                if (livingAdress === 0 && (indexPostLivingValue.length > 6 || indexPostLivingValue.length < 6)) {
                    indexPostLiving.addClass('input__control--error');
                } else {
                    indexPostLiving.removeClass('input__control--error');
                    data[$(item).attr('name')] = $(item).val();
                }
                return;
            }
            else if ($(item).attr('name') === 'ltc_postal_code') {
                let indexPostLtc = $("input[name='ltc_postal_code']");
                let indexPostLtcValue = indexPostLtc.val().replace(/[^0-9\.]/g,'');
                if (indexPostLtcValue.length < 6 || indexPostLtcValue.length > 6) {
                    indexPostLtc.addClass('input__control--error');
                } else {
                    indexPostLtc.removeClass('input__control--error');
                    data[$(item).attr('name')] = $(item).val();
                }
                return;
            }
            else if ($(item).attr('name') === 'passport_series') { // Проверка серии паспорта
                let passportSeries = $("input[name='passport_series']");
                let passportSeriesValue = passportSeries.val().replace(/[^0-9]/g,'');
                if (passportSeriesValue.length < 4 || passportSeriesValue.length > 4) {
                    passportSeries.addClass('input__control--error');
                } else {
                    passportSeries.removeClass('input__control--error');
                    data[$(item).attr('name')] = $(item).val();
                }
                return;
            }
            else if ($(item).attr('name') === 'passport_number') { // Проверка номера паспорта
                let passportNumber = $("input[name='passport_number']");
                let passportNumberValue = passportNumber.val().replace(/[^0-9]/g,'');
                if (passportNumberValue.length < 6 || passportNumberValue.length > 6) {
                    passportNumber.addClass('input__control--error');
                } else {
                    passportNumber.removeClass('input__control--error');
                    data[$(item).attr('name')] = $(item).val();
                }
                return;
            }
            else if ($(item).attr('name') === 'tin') { // Проверка ИНН
                let tin = $(item);
                let tinValue = tin.val().replace(/[^0-9]/g,'');
                let shortType = typeof tin.data('shortInn') != 'undefined';
                if (
                    (shortType && (tinValue.length < 10 || tinValue.length > 10))
                    || (! shortType && (tinValue.length < 12 || tinValue.length > 12))
                ) {
                    tin.addClass('input__control--error');
                } else {
                    tin.removeClass('input__control--error');
                    data[$(item).attr('name')] = $(item).val();
                }
                return;
            }
            else if ($(item).attr('name') === 'ogrnip') { // Проверка ОГРНИП
                let ogrnip = $("input[name='ogrnip']");
                let ogrnipValue = ogrnip.val().replace(/[^0-9]/g,'');
                if (ogrnipValue.length < 15 || ogrnipValue.length > 15) {
                    ogrnip.addClass('input__control--error');
                } else {
                    ogrnip.removeClass('input__control--error');
                    data[$(item).attr('name')] = $(item).val();
                }
                return;
            }
            else if ($(item).attr('name') === 'ogrn') { // Проверка ОГРН
                let ogrn = $("input[name='ogrn']");
                let ogrnValue = ogrn.val().replace(/[^0-9]/g,'');
                if (ogrnValue.length < 13 || ogrnValue.length > 13) {
                    ogrn.addClass('input__control--error');
                } else {
                    ogrn.removeClass('input__control--error');
                    data[$(item).attr('name')] = $(item).val();
                }
                return;
            }
            else if ($(item).attr('name') === 'kpp') { // Проверка КПП
                let kpp = $("input[name='kpp']");
                let kppValue = kpp.val().replace(/[^0-9]/g,'');
                if (kppValue.length < 9 || kppValue.length > 9) {
                    kpp.addClass('input__control--error');
                } else {
                    kpp.removeClass('input__control--error');
                    data[$(item).attr('name')] = $(item).val();
                }
                return;
            }
            else if ($(item).attr('name') === 'bic') { // Проверка БИК
                let bic = $("input[name='bic']");
                let bicValue = bic.val().replace(/[^0-9]/g,'');
                if (bicValue.length < 9 || bicValue.length > 9) {
                    bic.addClass('input__control--error');
                } else {
                    bic.removeClass('input__control--error');
                    data[$(item).attr('name')] = $(item).val();
                }
                return;
            }
            else {
                if (!$(item).val()) {
                    if ($(item).attr('name').indexOf('living') !== -1 && $('input[name=without_living]:checked').length) {
                        return;
                    }
                    $(item).addClass('input__control--error');
                }
                data[$(item).attr('name')] = $(item).val();
            }
        });

        if ($('.input__control--error').length || $('.dropzone--error').length) {
            return;
        }

        const response = await BX.ajax.runComponentAction('zolo:become.consultant', 'submit', {
            mode: 'class',
            data: { data },
        });

        if (!response.data || response.data.status === 'error') {
            return;
        }

        $.fancybox.open({
            src: '#thanks',
            afterClose() {
                window.location.href = '/personal';
            },
        });
    }
}

$(function() {
    new BecomeConsultantComponent();
});

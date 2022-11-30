class BecomeConsultantComponent {
    constructor() {
        this.initListeners();
    }

    initListeners() {
        $('select[name=status]').on('change', this.changeLegalEntity);

        $(`.form input`).on('keyup', this.removeError);
        $(`.form select, .form input[type=checkbox]`).on('change', this.removeError);

        $('button[data-submit]').on('click', this.changeStepListener);
    }

    changeLegalEntity() {
        $('.legal_entity').hide();
        $(`.legal_entity.${$(this).val()}`).show();
    }

    removeError() {
        $(this).removeClass('input__control--error');
        $(this).parent().find('span.input__control-error').remove();
    }

    async changeStepListener() {
        let data = {};

        $('.form').find('input, select').each((index, item) => {
            if ($(item).closest('.legal_entity').length && !$(item).closest('.legal_entity').hasClass(data.status)) {
                return;
            }
            if ($(item).attr('type') === 'hidden' || !$(item).attr('name')) {
                return;
            }

            if ($(item).attr('type') === 'file') {
                data[$(item).attr('name')] = { files: [] };
                $(item).parent().find('.file.dz-success.dz-complete').each((index, innerItem) => {
                    data[$(item).attr('name')].files.push({
                        id: $(innerItem).find('input[type=hidden]').val(),
                        name: $(innerItem).find('[data-uploader-preview-filename]').html(),
                        format: $(innerItem).find('[data-uploader-preview-format]').html(),
                        size: $(innerItem).find('[data-uploader-preview-size]').html(),
                    });
                });

                if (!data[$(item).attr('name')].files.length) {
                    $(item).parent().addClass('dropzone--error');
                } else {
                    $(item).parent().removeClass('dropzone--error');
                }
            } else if ($(item).attr('type') === 'checkbox') {
                data[$(item).attr('name')] = !!$(`#${$(item).attr('id')}:checked`).length;
                if (!data[$(item).attr('name')] && ['correctness_confirmation_self_employed', 'correctness_confirmation_ip', 'correctness_confirmation_ltc'].includes($(item).attr('name'))) {
                    $(item).addClass('input__control--error');
                }
            } else {
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

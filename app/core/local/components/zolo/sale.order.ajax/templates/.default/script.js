class SaleOrderAjaxComponent {
    constructor() {
        this.initListeners();
        this.initPage();
    }

    initListeners() {
        $('[data-create-order]').on('click', this.createOrder);
        $(`.form select`).on('change', this.removeError);
        $(`.form input`).on('keyup', this.removeError);
        $('[name=city]').on ('change', this.changePickupPointsSelect)
    }

    initPage() {
        this.changePickupPointsSelect();
    }

    changePickupPointsSelect() {
        const city = $('[name=city]').val();
        console.log(city);
        $('[data-city]').hide();
        $(`[data-city="${city}"]`).show();
    }

    removeError() {
        $(this).removeClass('input__control--error');
        $('[data-create-order]').removeAttr('disabled');
        $('[data-create-order]').removeClass('button--disabled');
        $(this).parent().find('.input__control-error').remove();
    }

    async createOrder() {
        let data = {};

        $(`.form`).find('input, select, textarea').each((index, item) => {
            if ($(item).attr('name') === 'comment' || $(item).closest('.form__field-block').css('display') === 'none') {
                return;
            }


            if ($(item).attr('type') !== 'hidden' && !$(item).val()) {
                $(item).addClass('input__control--error');

                $('[data-create-order]').attr('disabled', '');
                $('[data-create-order]').addClass('button--disabled');

                let span = $('<span class="input__control-error">Поле обязательно к заполнению</span>');
                $(item).parent().append(span);
                return;
            }

            data[$(item).attr('name') ?? $(item).attr('id')] = $(item).val() ?? $(item).text();
        });

        if ($(`.input__control--error`).length) {
            return;
        }

        const response = await BX.ajax.runComponentAction('zolo:sale.order.ajax', 'createOrder', {
            mode: 'class',
            data: { data },
        });

        let id =  response.data.id;

        if (response.status = 'success') {
            $('.content__main').addClass('hidden');
            $('.page__heading').addClass('hidden');
            let notification = $('#notification-block');

            notification.removeClass('hidden');
            notification.find('.notification__title').text('Ваш заказ № '+ response.data.id + ' успешно создан!')

            $('button[data-order-direct]').on('click', function () {
                window.location.href = '/personal/orders/' + id;
            });
        }

        console.log(response);
    }
}

$(function() {
    new SaleOrderAjaxComponent();
});

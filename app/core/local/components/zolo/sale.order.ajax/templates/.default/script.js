class SaleOrderAjaxComponent {
    constructor() {
        this.initListeners();
    }

    initListeners() {
        $('[data-create-order]').on('click', this.createOrder);
        $(`.form select`).on('change', this.removeError);
        $(`.form input`).on('keyup', this.removeError);
    }

    removeError() {
        $(this).removeClass('input__control--error');
        $('[data-create-order]').removeAttr('disabled');
        $('[data-create-order]').removeClass('button--disabled');
    }

    async createOrder() {
        let data = {};

        $(`.form`).find('input, select, textarea').each((index, item) => {

            if ($(item).attr('type') !== 'hidden' && !$(item).val()) {

                if ($(item).attr('name') !== 'comment') {
                    $(item).addClass('input__control--error');
                }

                $('[data-create-order]').attr('disabled', '');
                $('[data-create-order]').addClass('button--disabled');
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
                window.location.href = '/personal/orders/' + id + '/';
            });
        }

        console.log(response);
    }
}

$(function() {
    new SaleOrderAjaxComponent();
});

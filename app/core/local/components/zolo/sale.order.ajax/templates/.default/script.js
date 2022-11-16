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
    }

    async createOrder() {
        let data = {};
        console.log($(`.form#order-form`).find('input, select'));
        $(`.form`).find('input, select').each((index, item) => {

            if ($(item).attr('type') !== 'hidden' && !$(item).val()) {
                console.log('check', 1, [($(item).attr('name') ?? $(item).attr('id')), $(item).val()]);
                if ($(item).attr('name') !== 'comment') {
                    console.log('check', 2, [($(item).attr('name') ?? $(item).attr('id')), $(item).val()]);
                    $(item).addClass('input__control--error');
                }
                return;
            }
            console.log('arr', [($(item).attr('name') ?? $(item).attr('id')), $(item).val()]);
            data[$(item).attr('name') ?? $(item).attr('id')] = $(item).val();
        });

        if ($(`.input__control--error`).length) {                    console.log('check', 3);
            return;
        }
        console.log('check', data);
        const response = await BX.ajax.runComponentAction('zolo:sale.order.ajax', 'createOrder', {
            mode: 'class',
            data: { data },
        });

        console.log(response);
    }
}

$(function() {
    new SaleOrderAjaxComponent();
});

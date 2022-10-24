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

        $(`.form`).find('input, select').each((index, item) => {
            if ($(item).attr('type') !== 'hidden' && !$(item).val()) {
                $(item).addClass('input__control--error');
                return;
            }
            data[$(item).attr('name') ?? $(item).attr('id')] = $(item).val();
        });

        if ($(`.input__control--error`).length) {
            return;
        }

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

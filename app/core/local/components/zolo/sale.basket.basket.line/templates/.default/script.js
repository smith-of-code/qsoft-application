'use strict';

function BitrixSmallCart() {
}

BitrixSmallCart.prototype = {

    activate: function () {
        this.cartElement = BX(this.cartId);
        this.itemRemoved = false;

        BX.addCustomEvent(window, 'OnBasketChange', this.closure('refreshCart'));
    },

    closure: function (fname, data = {}) {
        const obj = this;
        return data
            ? function () {
                obj[fname](data)
            }
            : function (arg1) {
                obj[fname](arg1)
            };
    },

    refreshCart: function (data) {
        if (this.itemRemoved) {
            this.itemRemoved = false;
            return;
        }
        data.sessid = BX.bitrix_sessid();
        data.siteId = this.siteId;
        data.arParams = this.arParams;
        BX.ajax({
            url: this.ajaxPath,
            method: 'POST',
            data: data,
            onsuccess: this.setCartBodyClosure // TODO
        });
    },
};

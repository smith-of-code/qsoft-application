this.zolo = this.zolo || {};
(function (exports) {
    'use strict';

    var MiniBasket = {
      data: function data() {
        return {
          totalItemsCount: 0,
          totalPrice: 0
        };
      },
      created: function created() {
        var _this = this;

        setInterval(function () {
          return _this.counter++;
        }, 1000);
      },
      // language=Vue
      template: "\n      <button type=\"button\" class=\"button button--simple button--red button--vertical\">\n      <span class=\"button__icon button__icon--mixed\">\n                        <svg class=\"icon icon--basket\">\n                          <use xlink:href=\"/local/templates/.default/images/icons/sprite.svg#icon-basket\"></use>\n                        </svg>\n                        <span class=\"button__icon-counter button__icon-counter--dark\">{{ totalItemsCount }}</span>\n        </span>\n      <span class=\"personal__button-text button__text\">{{ totalPrice }}</span>\n      </button>\n    "
    };

    exports.MiniBasket = MiniBasket;

}((this.zolo.miniBasket = this.zolo.miniBasket || {})));
//# sourceMappingURL=component.bundle.js.map

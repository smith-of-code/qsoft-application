(function (exports) {
    'use strict';

    // import {detailOfferStore} from "../../../stores/detailOfferStore";
    var selectOffer = {
      data: function data() {
        return {};
      },
      setup: function setup() {
        // const store = useBasketStore();
        // store.fetchBasketTotals();
        return {
          item: 1111 // itemsCount: computed(() => store.itemsCount),
          // basketPrice: computed(() => store.basketPrice)

        };
      },
      // language=Vue
      template: "\n        <p class=\"specification__article\">\u0410\u0440\u0442. {{item}}</p>\n    "
    };

    exports.selectOffer = selectOffer;

}((this.Zolo = this.Zolo || {})));
//# sourceMappingURL=component.bundle.js.map

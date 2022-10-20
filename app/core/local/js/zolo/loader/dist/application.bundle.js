(function (exports,ui_vue3,ui_vue3_pinia) {
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

    var applicationsToRender = {
      '#miniBasket': MiniBasket
    };

    var Loader = /*#__PURE__*/function () {
      function Loader() {
        babelHelpers.classCallCheck(this, Loader);
      }

      babelHelpers.createClass(Loader, [{
        key: "run",
        value: function run() {
          var store = ui_vue3_pinia.createPinia();
          window.store = store;

          for (var applicationRoot in applicationsToRender) {
            this.renderApplication(applicationRoot, applicationsToRender[applicationRoot], store);
          }
        }
      }, {
        key: "renderApplication",
        value: function renderApplication(root, component, store) {
          var rootElement = document.querySelector(root); // console.log('rootElement', {...rootElement});

          if (rootElement) {
            var app = ui_vue3.BitrixVue.createApp(component);
            app.mount(rootElement);
            app.use(store);
          }
        }
      }]);
      return Loader;
    }();

    exports.Loader = Loader;

}((this.Zolo = this.Zolo || {}),BX.Vue3,BX.Vue3.Pinia));
//# sourceMappingURL=application.bundle.js.map

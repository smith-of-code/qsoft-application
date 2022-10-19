(function (exports,ui_vue3) {
    'use strict';

    var Application = /*#__PURE__*/function () {
      function Application() {
        babelHelpers.classCallCheck(this, Application);
      }

      babelHelpers.createClass(Application, [{
        key: "run",
        value: function run() {
          return ui_vue3.BitrixVue.createApp({
            name: 'zolo',
            components: {}
          });
        }
      }]);
      return Application;
    }();

    exports.Application = Application;

}((this.Zolo = this.Zolo || {}),BX.Vue3));
//# sourceMappingURL=application.bundle.js.map

this.zolo = this.zolo || {};
(function (exports,Inputmask) {
  'use strict';

  Inputmask = Inputmask && Inputmask.hasOwnProperty('default') ? Inputmask['default'] : Inputmask;

  var id = 0;
  var DateInput = {
    data: function data() {
      return {
        componentId: 'date-input-' + ++id,
        currentValue: null
      };
    },
    props: {
      name: {
        type: String,
        required: true
      },
      value: {
        type: String,
        "default": null
      }
    },
    watch: {
      currentValue: function currentValue(newValue) {
        this.$emit('custom-change', newValue);
      }
    },
    created: function created() {
      this.currentValue = this.value;
    },
    mounted: function mounted() {// inputMaskInit($(`[data-date-input-id=${this.componentId}]`), 'dateMask');
    },
    template: "\n        <div class=\"input input--iconed\" :data-date-input-id=\"componentId\">\n            <input\n                inputmode=\"numeric\"\n                class=\"input__control\"\n                :name=\"name\"\n                placeholder=\"\u0414\u0414.\u041C\u041C.\u0413\u0413\u0413\u0413\"\n                data-mask-date\n                :id=\"componentId\"\n                v-model=\"currentValue\"\n                data-pets-date-input\n                data-pets-change\n                autocomplete=\"off\"\n            >\n            <span class=\"input__control-error--mask\"></span>\n            <span class=\"input__icon\">\n                <svg class=\"icon icon--calendar\">\n                    <use xlink:href=\"/local/templates/.default/images/icons/sprite.svg#icon-calendar\"></use>\n                </svg>\n            </span>\n        </div>\n    "
  };

  exports.DateInput = DateInput;

}((this.zolo.dateInput = this.zolo.dateInput || {}),BX));
//# sourceMappingURL=component.bundle.js.map

this.zolo = this.zolo || {};
(function (exports,select2) {
    'use strict';

    select2 = select2 && select2.hasOwnProperty('default') ? select2['default'] : select2;

    function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); enumerableOnly && (symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; })), keys.push.apply(keys, symbols); } return keys; }

    function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = null != arguments[i] ? arguments[i] : {}; i % 2 ? ownKeys(Object(source), !0).forEach(function (key) { babelHelpers.defineProperty(target, key, source[key]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)) : ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } return target; }
    var ELEMENTS_SELECTOR = {
      selectBox: '[data-select]',
      selectControl: '[data-select-control]',
      select2Container: '.select2-container'
    };
    function select () {
      /**
       * Инициализирует селекты с плагином select2
       * @param jqObj объект JQuery (контейнер, в котором нужно проинициализировать селекты). Если не задан - инициализирует все селекты в BODY
       */
      function initSelect() {
        var jqObj = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : undefined;
        var baseOptions = {
          templateResult: formatState,
          templateSelection: formatState
        };

        function formatState(state) {
          var before = $(state.element).data('option-before') ? $(state.element).data('option-before') : '';
          var after = $(state.element).data('option-after') ? $(state.element).data('option-after') : '';
          var classItem = before || after ? 'select__item--inlined' : '';
          var result = $("\n                <span class=\"select__item ".concat(classItem, "\">\n                    ").concat(before, "\n                    ").concat(state.text, "\n                    ").concat(after, "\n                </span>\n            "));
          return result;
        }

        function searchDisabled(element) {
          var searchfield = element.parent().find('.select2-search__field');
          searchfield.prop('disabled', true);
        }

        var scrollOptions = {
          autohidemode: "leave",
          railpadding: {
            top: 0,
            right: 0,
            left: 6,
            bottom: 0
          }
        };
        var selectsContainer = $(document.body);

        if (typeof jqObj != 'undefined') {
          selectsContainer = jqObj;
        }

        selectsContainer.find(ELEMENTS_SELECTOR.selectControl).each(function (index, select) {
          var $selectBox = $(select).closest(ELEMENTS_SELECTOR.selectBox);
          var petsBreed = $selectBox.data('pets-breed');

          if (petsBreed != undefined) {
            baseOptions.language = {
              "noResults": function noResults() {
                return "Выберите тип питомца";
              }
            };
          }

          var placeholder = $(select).attr('data-placeholder');

          var currentOptions = _objectSpread(_objectSpread({}, baseOptions), {}, {
            placeholder: placeholder,
            dropdownParent: $selectBox
          });

          $(select).select2(currentOptions).on('select2:open', function (e) {
            var $select = $(this);
            var $selectContainer = $select.siblings('.select2-container');
            var $selectList = $selectContainer.find('.select2-results__options');
            $selectList.niceScroll(scrollOptions);
          }).on('select2:close', function () {
            var select = $(this);
            var multiple = select.attr('multiple');

            if (typeof multiple !== 'undefined' && multiple !== false) {
              select.closest('[data-select]').find('.select2-selection__rendered').html(function () {
                var counter = select.select2('data').length;

                if (counter > 0) {
                  return "<li class=\"select2-selection__rendered-item\">\u0412\u044B\u0431\u0440\u0430\u043D\u043E: ".concat(counter, "<li>");
                }
              });
            }
          }).on('select2:opening select2:closing', function () {
            searchDisabled($(this));
          });
        });
      }

      initSelect();
      window.initSelect = initSelect;
    }

    var StringFormatMixin = {
      methods: {
        uppercaseFirst: function uppercaseFirst(string) {
          return string[0].toUpperCase() + string.substring(1);
        }
      }
    };

    var id = 0;
    var Select = {
      mixins: [StringFormatMixin],
      data: function data() {
        return {
          componentId: 'select-' + ++id
        };
      },
      props: {
        name: {
          type: String,
          required: true
        },
        placeholder: {
          type: String,
          "default": null
        },
        options: {
          type: Object,
          required: true
        },
        selected: {
          type: Number,
          "default": null
        },
        iconed: {
          type: Boolean,
          "default": false
        }
      },
      mounted: function mounted() {
        var _this = this;

        select();
        $("#".concat(this.componentId)).on('change', function () {
          _this.$emit('custom-change', $("#".concat(_this.componentId)).val());
        });
      },
      methods: {
        getIconPath: function getIconPath(icon) {
          return "<svg class=\"select__item-icon icon icon--".concat(icon, "\"><use xlink:href=\"/local/templates/.default/images/icons/sprite.svg#icon-").concat(icon, "\"></use></svg>");
        }
      },
      template: "\n        <div class=\"select select--mitigate\" :class=\"{ 'select--iconed': iconed }\" data-select>\n            <select class=\"select__control\" :name=\"name\" :id=\"componentId\" data-select-control :data-placeholder=\"placeholder ?? '\u0412\u044B\u0431\u0440\u0430\u0442\u044C'\">\n                <option><!-- \u043F\u0443\u0441\u0442\u043E\u0439 option \u0434\u043B\u044F placeholder --></option>\n                <option\n                    v-for=\"(option, optionId) in options\"\n                    :key=\"optionId\"\n                    :value=\"optionId\"\n                    :data-option-before=\"iconed ? getIconPath(option.icon) : false\"\n                    :selected=\"optionId === selected\"\n                >\n                    {{ uppercaseFirst(option.name) }}\n                </option>\n            </select>\n        </div>\n    "
    };

    exports.Select = Select;

}((this.zolo.select = this.zolo.select || {}),BX));
//# sourceMappingURL=component.bundle.js.map

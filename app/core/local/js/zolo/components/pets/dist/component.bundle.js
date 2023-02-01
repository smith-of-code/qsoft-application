this.zolo = this.zolo || {};
(function (exports,ui_vue3_pinia,select2,jquery_nicescroll,Inputmask,tippy$1) {
    'use strict';

    select2 = select2 && select2.hasOwnProperty('default') ? select2['default'] : select2;
    Inputmask = Inputmask && Inputmask.hasOwnProperty('default') ? Inputmask['default'] : Inputmask;
    tippy$1 = tippy$1 && tippy$1.hasOwnProperty('default') ? tippy$1['default'] : tippy$1;

    function _regeneratorRuntime() { /*! regenerator-runtime -- Copyright (c) 2014-present, Facebook, Inc. -- license (MIT): https://github.com/facebook/regenerator/blob/main/LICENSE */ _regeneratorRuntime = function _regeneratorRuntime() { return exports; }; var exports = {}, Op = Object.prototype, hasOwn = Op.hasOwnProperty, $Symbol = "function" == typeof Symbol ? Symbol : {}, iteratorSymbol = $Symbol.iterator || "@@iterator", asyncIteratorSymbol = $Symbol.asyncIterator || "@@asyncIterator", toStringTagSymbol = $Symbol.toStringTag || "@@toStringTag"; function define(obj, key, value) { return Object.defineProperty(obj, key, { value: value, enumerable: !0, configurable: !0, writable: !0 }), obj[key]; } try { define({}, ""); } catch (err) { define = function define(obj, key, value) { return obj[key] = value; }; } function wrap(innerFn, outerFn, self, tryLocsList) { var protoGenerator = outerFn && outerFn.prototype instanceof Generator ? outerFn : Generator, generator = Object.create(protoGenerator.prototype), context = new Context(tryLocsList || []); return generator._invoke = function (innerFn, self, context) { var state = "suspendedStart"; return function (method, arg) { if ("executing" === state) throw new Error("Generator is already running"); if ("completed" === state) { if ("throw" === method) throw arg; return doneResult(); } for (context.method = method, context.arg = arg;;) { var delegate = context.delegate; if (delegate) { var delegateResult = maybeInvokeDelegate(delegate, context); if (delegateResult) { if (delegateResult === ContinueSentinel) continue; return delegateResult; } } if ("next" === context.method) context.sent = context._sent = context.arg;else if ("throw" === context.method) { if ("suspendedStart" === state) throw state = "completed", context.arg; context.dispatchException(context.arg); } else "return" === context.method && context.abrupt("return", context.arg); state = "executing"; var record = tryCatch(innerFn, self, context); if ("normal" === record.type) { if (state = context.done ? "completed" : "suspendedYield", record.arg === ContinueSentinel) continue; return { value: record.arg, done: context.done }; } "throw" === record.type && (state = "completed", context.method = "throw", context.arg = record.arg); } }; }(innerFn, self, context), generator; } function tryCatch(fn, obj, arg) { try { return { type: "normal", arg: fn.call(obj, arg) }; } catch (err) { return { type: "throw", arg: err }; } } exports.wrap = wrap; var ContinueSentinel = {}; function Generator() {} function GeneratorFunction() {} function GeneratorFunctionPrototype() {} var IteratorPrototype = {}; define(IteratorPrototype, iteratorSymbol, function () { return this; }); var getProto = Object.getPrototypeOf, NativeIteratorPrototype = getProto && getProto(getProto(values([]))); NativeIteratorPrototype && NativeIteratorPrototype !== Op && hasOwn.call(NativeIteratorPrototype, iteratorSymbol) && (IteratorPrototype = NativeIteratorPrototype); var Gp = GeneratorFunctionPrototype.prototype = Generator.prototype = Object.create(IteratorPrototype); function defineIteratorMethods(prototype) { ["next", "throw", "return"].forEach(function (method) { define(prototype, method, function (arg) { return this._invoke(method, arg); }); }); } function AsyncIterator(generator, PromiseImpl) { function invoke(method, arg, resolve, reject) { var record = tryCatch(generator[method], generator, arg); if ("throw" !== record.type) { var result = record.arg, value = result.value; return value && "object" == babelHelpers["typeof"](value) && hasOwn.call(value, "__await") ? PromiseImpl.resolve(value.__await).then(function (value) { invoke("next", value, resolve, reject); }, function (err) { invoke("throw", err, resolve, reject); }) : PromiseImpl.resolve(value).then(function (unwrapped) { result.value = unwrapped, resolve(result); }, function (error) { return invoke("throw", error, resolve, reject); }); } reject(record.arg); } var previousPromise; this._invoke = function (method, arg) { function callInvokeWithMethodAndArg() { return new PromiseImpl(function (resolve, reject) { invoke(method, arg, resolve, reject); }); } return previousPromise = previousPromise ? previousPromise.then(callInvokeWithMethodAndArg, callInvokeWithMethodAndArg) : callInvokeWithMethodAndArg(); }; } function maybeInvokeDelegate(delegate, context) { var method = delegate.iterator[context.method]; if (undefined === method) { if (context.delegate = null, "throw" === context.method) { if (delegate.iterator["return"] && (context.method = "return", context.arg = undefined, maybeInvokeDelegate(delegate, context), "throw" === context.method)) return ContinueSentinel; context.method = "throw", context.arg = new TypeError("The iterator does not provide a 'throw' method"); } return ContinueSentinel; } var record = tryCatch(method, delegate.iterator, context.arg); if ("throw" === record.type) return context.method = "throw", context.arg = record.arg, context.delegate = null, ContinueSentinel; var info = record.arg; return info ? info.done ? (context[delegate.resultName] = info.value, context.next = delegate.nextLoc, "return" !== context.method && (context.method = "next", context.arg = undefined), context.delegate = null, ContinueSentinel) : info : (context.method = "throw", context.arg = new TypeError("iterator result is not an object"), context.delegate = null, ContinueSentinel); } function pushTryEntry(locs) { var entry = { tryLoc: locs[0] }; 1 in locs && (entry.catchLoc = locs[1]), 2 in locs && (entry.finallyLoc = locs[2], entry.afterLoc = locs[3]), this.tryEntries.push(entry); } function resetTryEntry(entry) { var record = entry.completion || {}; record.type = "normal", delete record.arg, entry.completion = record; } function Context(tryLocsList) { this.tryEntries = [{ tryLoc: "root" }], tryLocsList.forEach(pushTryEntry, this), this.reset(!0); } function values(iterable) { if (iterable) { var iteratorMethod = iterable[iteratorSymbol]; if (iteratorMethod) return iteratorMethod.call(iterable); if ("function" == typeof iterable.next) return iterable; if (!isNaN(iterable.length)) { var i = -1, next = function next() { for (; ++i < iterable.length;) { if (hasOwn.call(iterable, i)) return next.value = iterable[i], next.done = !1, next; } return next.value = undefined, next.done = !0, next; }; return next.next = next; } } return { next: doneResult }; } function doneResult() { return { value: undefined, done: !0 }; } return GeneratorFunction.prototype = GeneratorFunctionPrototype, define(Gp, "constructor", GeneratorFunctionPrototype), define(GeneratorFunctionPrototype, "constructor", GeneratorFunction), GeneratorFunction.displayName = define(GeneratorFunctionPrototype, toStringTagSymbol, "GeneratorFunction"), exports.isGeneratorFunction = function (genFun) { var ctor = "function" == typeof genFun && genFun.constructor; return !!ctor && (ctor === GeneratorFunction || "GeneratorFunction" === (ctor.displayName || ctor.name)); }, exports.mark = function (genFun) { return Object.setPrototypeOf ? Object.setPrototypeOf(genFun, GeneratorFunctionPrototype) : (genFun.__proto__ = GeneratorFunctionPrototype, define(genFun, toStringTagSymbol, "GeneratorFunction")), genFun.prototype = Object.create(Gp), genFun; }, exports.awrap = function (arg) { return { __await: arg }; }, defineIteratorMethods(AsyncIterator.prototype), define(AsyncIterator.prototype, asyncIteratorSymbol, function () { return this; }), exports.AsyncIterator = AsyncIterator, exports.async = function (innerFn, outerFn, self, tryLocsList, PromiseImpl) { void 0 === PromiseImpl && (PromiseImpl = Promise); var iter = new AsyncIterator(wrap(innerFn, outerFn, self, tryLocsList), PromiseImpl); return exports.isGeneratorFunction(outerFn) ? iter : iter.next().then(function (result) { return result.done ? result.value : iter.next(); }); }, defineIteratorMethods(Gp), define(Gp, toStringTagSymbol, "Generator"), define(Gp, iteratorSymbol, function () { return this; }), define(Gp, "toString", function () { return "[object Generator]"; }), exports.keys = function (object) { var keys = []; for (var key in object) { keys.push(key); } return keys.reverse(), function next() { for (; keys.length;) { var key = keys.pop(); if (key in object) return next.value = key, next.done = !1, next; } return next.done = !0, next; }; }, exports.values = values, Context.prototype = { constructor: Context, reset: function reset(skipTempReset) { if (this.prev = 0, this.next = 0, this.sent = this._sent = undefined, this.done = !1, this.delegate = null, this.method = "next", this.arg = undefined, this.tryEntries.forEach(resetTryEntry), !skipTempReset) for (var name in this) { "t" === name.charAt(0) && hasOwn.call(this, name) && !isNaN(+name.slice(1)) && (this[name] = undefined); } }, stop: function stop() { this.done = !0; var rootRecord = this.tryEntries[0].completion; if ("throw" === rootRecord.type) throw rootRecord.arg; return this.rval; }, dispatchException: function dispatchException(exception) { if (this.done) throw exception; var context = this; function handle(loc, caught) { return record.type = "throw", record.arg = exception, context.next = loc, caught && (context.method = "next", context.arg = undefined), !!caught; } for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i], record = entry.completion; if ("root" === entry.tryLoc) return handle("end"); if (entry.tryLoc <= this.prev) { var hasCatch = hasOwn.call(entry, "catchLoc"), hasFinally = hasOwn.call(entry, "finallyLoc"); if (hasCatch && hasFinally) { if (this.prev < entry.catchLoc) return handle(entry.catchLoc, !0); if (this.prev < entry.finallyLoc) return handle(entry.finallyLoc); } else if (hasCatch) { if (this.prev < entry.catchLoc) return handle(entry.catchLoc, !0); } else { if (!hasFinally) throw new Error("try statement without catch or finally"); if (this.prev < entry.finallyLoc) return handle(entry.finallyLoc); } } } }, abrupt: function abrupt(type, arg) { for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i]; if (entry.tryLoc <= this.prev && hasOwn.call(entry, "finallyLoc") && this.prev < entry.finallyLoc) { var finallyEntry = entry; break; } } finallyEntry && ("break" === type || "continue" === type) && finallyEntry.tryLoc <= arg && arg <= finallyEntry.finallyLoc && (finallyEntry = null); var record = finallyEntry ? finallyEntry.completion : {}; return record.type = type, record.arg = arg, finallyEntry ? (this.method = "next", this.next = finallyEntry.finallyLoc, ContinueSentinel) : this.complete(record); }, complete: function complete(record, afterLoc) { if ("throw" === record.type) throw record.arg; return "break" === record.type || "continue" === record.type ? this.next = record.arg : "return" === record.type ? (this.rval = this.arg = record.arg, this.method = "return", this.next = "end") : "normal" === record.type && afterLoc && (this.next = afterLoc), ContinueSentinel; }, finish: function finish(finallyLoc) { for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i]; if (entry.finallyLoc === finallyLoc) return this.complete(entry.completion, entry.afterLoc), resetTryEntry(entry), ContinueSentinel; } }, "catch": function _catch(tryLoc) { for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i]; if (entry.tryLoc === tryLoc) { var record = entry.completion; if ("throw" === record.type) { var thrown = record.arg; resetTryEntry(entry); } return thrown; } } throw new Error("illegal catch attempt"); }, delegateYield: function delegateYield(iterable, resultName, nextLoc) { return this.delegate = { iterator: values(iterable), resultName: resultName, nextLoc: nextLoc }, "next" === this.method && (this.arg = undefined), ContinueSentinel; } }, exports; }
    var usePetStore = ui_vue3_pinia.defineStore('pet', {
      actions: {
        deletePet: function deletePet(petId) {
          return babelHelpers.asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee() {
            return _regeneratorRuntime().wrap(function _callee$(_context) {
              while (1) {
                switch (_context.prev = _context.next) {
                  case 0:
                    _context.next = 2;
                    return BX.ajax.runComponentAction('zolo:main.profile', 'deletePet', {
                      mode: 'class',
                      data: {
                        petId: petId
                      }
                    });

                  case 2:
                    return _context.abrupt("return", _context.sent);

                  case 3:
                  case "end":
                    return _context.stop();
                }
              }
            }, _callee);
          }))();
        },
        addPet: function addPet(pet) {
          return babelHelpers.asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee2() {
            return _regeneratorRuntime().wrap(function _callee2$(_context2) {
              while (1) {
                switch (_context2.prev = _context2.next) {
                  case 0:
                    _context2.next = 2;
                    return BX.ajax.runComponentAction('zolo:main.profile', 'addPet', {
                      mode: 'class',
                      data: {
                        pet: pet
                      }
                    });

                  case 2:
                    return _context2.abrupt("return", _context2.sent);

                  case 3:
                  case "end":
                    return _context2.stop();
                }
              }
            }, _callee2);
          }))();
        },
        changePet: function changePet(pet) {
          return babelHelpers.asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee3() {
            return _regeneratorRuntime().wrap(function _callee3$(_context3) {
              while (1) {
                switch (_context3.prev = _context3.next) {
                  case 0:
                    _context3.next = 2;
                    return BX.ajax.runComponentAction('zolo:main.profile', 'changePet', {
                      mode: 'class',
                      data: {
                        pet: pet
                      }
                    });

                  case 2:
                    return _context3.abrupt("return", _context3.sent);

                  case 3:
                  case "end":
                    return _context3.stop();
                }
              }
            }, _callee3);
          }))();
        }
      }
    });

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

    var id$1 = 0;
    var DateInput = {
      data: function data() {
        return {
          componentId: 'date-input-' + ++id$1,
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

    function _regeneratorRuntime$1() { /*! regenerator-runtime -- Copyright (c) 2014-present, Facebook, Inc. -- license (MIT): https://github.com/facebook/regenerator/blob/main/LICENSE */ _regeneratorRuntime$1 = function _regeneratorRuntime() { return exports; }; var exports = {}, Op = Object.prototype, hasOwn = Op.hasOwnProperty, $Symbol = "function" == typeof Symbol ? Symbol : {}, iteratorSymbol = $Symbol.iterator || "@@iterator", asyncIteratorSymbol = $Symbol.asyncIterator || "@@asyncIterator", toStringTagSymbol = $Symbol.toStringTag || "@@toStringTag"; function define(obj, key, value) { return Object.defineProperty(obj, key, { value: value, enumerable: !0, configurable: !0, writable: !0 }), obj[key]; } try { define({}, ""); } catch (err) { define = function define(obj, key, value) { return obj[key] = value; }; } function wrap(innerFn, outerFn, self, tryLocsList) { var protoGenerator = outerFn && outerFn.prototype instanceof Generator ? outerFn : Generator, generator = Object.create(protoGenerator.prototype), context = new Context(tryLocsList || []); return generator._invoke = function (innerFn, self, context) { var state = "suspendedStart"; return function (method, arg) { if ("executing" === state) throw new Error("Generator is already running"); if ("completed" === state) { if ("throw" === method) throw arg; return doneResult(); } for (context.method = method, context.arg = arg;;) { var delegate = context.delegate; if (delegate) { var delegateResult = maybeInvokeDelegate(delegate, context); if (delegateResult) { if (delegateResult === ContinueSentinel) continue; return delegateResult; } } if ("next" === context.method) context.sent = context._sent = context.arg;else if ("throw" === context.method) { if ("suspendedStart" === state) throw state = "completed", context.arg; context.dispatchException(context.arg); } else "return" === context.method && context.abrupt("return", context.arg); state = "executing"; var record = tryCatch(innerFn, self, context); if ("normal" === record.type) { if (state = context.done ? "completed" : "suspendedYield", record.arg === ContinueSentinel) continue; return { value: record.arg, done: context.done }; } "throw" === record.type && (state = "completed", context.method = "throw", context.arg = record.arg); } }; }(innerFn, self, context), generator; } function tryCatch(fn, obj, arg) { try { return { type: "normal", arg: fn.call(obj, arg) }; } catch (err) { return { type: "throw", arg: err }; } } exports.wrap = wrap; var ContinueSentinel = {}; function Generator() {} function GeneratorFunction() {} function GeneratorFunctionPrototype() {} var IteratorPrototype = {}; define(IteratorPrototype, iteratorSymbol, function () { return this; }); var getProto = Object.getPrototypeOf, NativeIteratorPrototype = getProto && getProto(getProto(values([]))); NativeIteratorPrototype && NativeIteratorPrototype !== Op && hasOwn.call(NativeIteratorPrototype, iteratorSymbol) && (IteratorPrototype = NativeIteratorPrototype); var Gp = GeneratorFunctionPrototype.prototype = Generator.prototype = Object.create(IteratorPrototype); function defineIteratorMethods(prototype) { ["next", "throw", "return"].forEach(function (method) { define(prototype, method, function (arg) { return this._invoke(method, arg); }); }); } function AsyncIterator(generator, PromiseImpl) { function invoke(method, arg, resolve, reject) { var record = tryCatch(generator[method], generator, arg); if ("throw" !== record.type) { var result = record.arg, value = result.value; return value && "object" == babelHelpers["typeof"](value) && hasOwn.call(value, "__await") ? PromiseImpl.resolve(value.__await).then(function (value) { invoke("next", value, resolve, reject); }, function (err) { invoke("throw", err, resolve, reject); }) : PromiseImpl.resolve(value).then(function (unwrapped) { result.value = unwrapped, resolve(result); }, function (error) { return invoke("throw", error, resolve, reject); }); } reject(record.arg); } var previousPromise; this._invoke = function (method, arg) { function callInvokeWithMethodAndArg() { return new PromiseImpl(function (resolve, reject) { invoke(method, arg, resolve, reject); }); } return previousPromise = previousPromise ? previousPromise.then(callInvokeWithMethodAndArg, callInvokeWithMethodAndArg) : callInvokeWithMethodAndArg(); }; } function maybeInvokeDelegate(delegate, context) { var method = delegate.iterator[context.method]; if (undefined === method) { if (context.delegate = null, "throw" === context.method) { if (delegate.iterator["return"] && (context.method = "return", context.arg = undefined, maybeInvokeDelegate(delegate, context), "throw" === context.method)) return ContinueSentinel; context.method = "throw", context.arg = new TypeError("The iterator does not provide a 'throw' method"); } return ContinueSentinel; } var record = tryCatch(method, delegate.iterator, context.arg); if ("throw" === record.type) return context.method = "throw", context.arg = record.arg, context.delegate = null, ContinueSentinel; var info = record.arg; return info ? info.done ? (context[delegate.resultName] = info.value, context.next = delegate.nextLoc, "return" !== context.method && (context.method = "next", context.arg = undefined), context.delegate = null, ContinueSentinel) : info : (context.method = "throw", context.arg = new TypeError("iterator result is not an object"), context.delegate = null, ContinueSentinel); } function pushTryEntry(locs) { var entry = { tryLoc: locs[0] }; 1 in locs && (entry.catchLoc = locs[1]), 2 in locs && (entry.finallyLoc = locs[2], entry.afterLoc = locs[3]), this.tryEntries.push(entry); } function resetTryEntry(entry) { var record = entry.completion || {}; record.type = "normal", delete record.arg, entry.completion = record; } function Context(tryLocsList) { this.tryEntries = [{ tryLoc: "root" }], tryLocsList.forEach(pushTryEntry, this), this.reset(!0); } function values(iterable) { if (iterable) { var iteratorMethod = iterable[iteratorSymbol]; if (iteratorMethod) return iteratorMethod.call(iterable); if ("function" == typeof iterable.next) return iterable; if (!isNaN(iterable.length)) { var i = -1, next = function next() { for (; ++i < iterable.length;) { if (hasOwn.call(iterable, i)) return next.value = iterable[i], next.done = !1, next; } return next.value = undefined, next.done = !0, next; }; return next.next = next; } } return { next: doneResult }; } function doneResult() { return { value: undefined, done: !0 }; } return GeneratorFunction.prototype = GeneratorFunctionPrototype, define(Gp, "constructor", GeneratorFunctionPrototype), define(GeneratorFunctionPrototype, "constructor", GeneratorFunction), GeneratorFunction.displayName = define(GeneratorFunctionPrototype, toStringTagSymbol, "GeneratorFunction"), exports.isGeneratorFunction = function (genFun) { var ctor = "function" == typeof genFun && genFun.constructor; return !!ctor && (ctor === GeneratorFunction || "GeneratorFunction" === (ctor.displayName || ctor.name)); }, exports.mark = function (genFun) { return Object.setPrototypeOf ? Object.setPrototypeOf(genFun, GeneratorFunctionPrototype) : (genFun.__proto__ = GeneratorFunctionPrototype, define(genFun, toStringTagSymbol, "GeneratorFunction")), genFun.prototype = Object.create(Gp), genFun; }, exports.awrap = function (arg) { return { __await: arg }; }, defineIteratorMethods(AsyncIterator.prototype), define(AsyncIterator.prototype, asyncIteratorSymbol, function () { return this; }), exports.AsyncIterator = AsyncIterator, exports.async = function (innerFn, outerFn, self, tryLocsList, PromiseImpl) { void 0 === PromiseImpl && (PromiseImpl = Promise); var iter = new AsyncIterator(wrap(innerFn, outerFn, self, tryLocsList), PromiseImpl); return exports.isGeneratorFunction(outerFn) ? iter : iter.next().then(function (result) { return result.done ? result.value : iter.next(); }); }, defineIteratorMethods(Gp), define(Gp, toStringTagSymbol, "Generator"), define(Gp, iteratorSymbol, function () { return this; }), define(Gp, "toString", function () { return "[object Generator]"; }), exports.keys = function (object) { var keys = []; for (var key in object) { keys.push(key); } return keys.reverse(), function next() { for (; keys.length;) { var key = keys.pop(); if (key in object) return next.value = key, next.done = !1, next; } return next.done = !0, next; }; }, exports.values = values, Context.prototype = { constructor: Context, reset: function reset(skipTempReset) { if (this.prev = 0, this.next = 0, this.sent = this._sent = undefined, this.done = !1, this.delegate = null, this.method = "next", this.arg = undefined, this.tryEntries.forEach(resetTryEntry), !skipTempReset) for (var name in this) { "t" === name.charAt(0) && hasOwn.call(this, name) && !isNaN(+name.slice(1)) && (this[name] = undefined); } }, stop: function stop() { this.done = !0; var rootRecord = this.tryEntries[0].completion; if ("throw" === rootRecord.type) throw rootRecord.arg; return this.rval; }, dispatchException: function dispatchException(exception) { if (this.done) throw exception; var context = this; function handle(loc, caught) { return record.type = "throw", record.arg = exception, context.next = loc, caught && (context.method = "next", context.arg = undefined), !!caught; } for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i], record = entry.completion; if ("root" === entry.tryLoc) return handle("end"); if (entry.tryLoc <= this.prev) { var hasCatch = hasOwn.call(entry, "catchLoc"), hasFinally = hasOwn.call(entry, "finallyLoc"); if (hasCatch && hasFinally) { if (this.prev < entry.catchLoc) return handle(entry.catchLoc, !0); if (this.prev < entry.finallyLoc) return handle(entry.finallyLoc); } else if (hasCatch) { if (this.prev < entry.catchLoc) return handle(entry.catchLoc, !0); } else { if (!hasFinally) throw new Error("try statement without catch or finally"); if (this.prev < entry.finallyLoc) return handle(entry.finallyLoc); } } } }, abrupt: function abrupt(type, arg) { for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i]; if (entry.tryLoc <= this.prev && hasOwn.call(entry, "finallyLoc") && this.prev < entry.finallyLoc) { var finallyEntry = entry; break; } } finallyEntry && ("break" === type || "continue" === type) && finallyEntry.tryLoc <= arg && arg <= finallyEntry.finallyLoc && (finallyEntry = null); var record = finallyEntry ? finallyEntry.completion : {}; return record.type = type, record.arg = arg, finallyEntry ? (this.method = "next", this.next = finallyEntry.finallyLoc, ContinueSentinel) : this.complete(record); }, complete: function complete(record, afterLoc) { if ("throw" === record.type) throw record.arg; return "break" === record.type || "continue" === record.type ? this.next = record.arg : "return" === record.type ? (this.rval = this.arg = record.arg, this.method = "return", this.next = "end") : "normal" === record.type && afterLoc && (this.next = afterLoc), ContinueSentinel; }, finish: function finish(finallyLoc) { for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i]; if (entry.finallyLoc === finallyLoc) return this.complete(entry.completion, entry.afterLoc), resetTryEntry(entry), ContinueSentinel; } }, "catch": function _catch(tryLoc) { for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i]; if (entry.tryLoc === tryLoc) { var record = entry.completion; if ("throw" === record.type) { var thrown = record.arg; resetTryEntry(entry); } return thrown; } } throw new Error("illegal catch attempt"); }, delegateYield: function delegateYield(iterable, resultName, nextLoc) { return this.delegate = { iterator: values(iterable), resultName: resultName, nextLoc: nextLoc }, "next" === this.method && (this.arg = undefined), ContinueSentinel; } }, exports; }
    var Pets = {
      components: {
        Select: Select,
        DateInput: DateInput
      },
      data: function data() {
        return {
          originalPets: {},
          mutablePets: []
        };
      },
      props: {
        pets: {
          type: Object,
          "default": {}
        },
        genders: {
          type: Object,
          required: true
        },
        breeds: {
          type: Object,
          required: true
        },
        kinds: {
          type: Object,
          required: true
        }
      },
      setup: function setup() {
        return {
          petStore: usePetStore()
        };
      },
      created: function created() {
        this.originalPets = JSON.parse(JSON.stringify(this.pets));
        this.mutablePets = JSON.parse(JSON.stringify(Object.values(this.pets)));
      },
      methods: {
        addPet: function addPet() {
          this.mutablePets.push({
            id: "new-".concat(Date.now()),
            editing: true
          });
        },
        deletePet: function deletePet(pet) {
          if (pet.id.indexOf('new') === -1) {
            this.petStore.deletePet(pet.id);
          }

          this.mutablePets.splice(this.mutablePets.indexOf(pet), 1);
        },
        checkPetAvailable: function checkPetAvailable(pet) {
          var _pet$birthdate;

          var petReplaceValue = (_pet$birthdate = pet.birthdate) === null || _pet$birthdate === void 0 ? void 0 : _pet$birthdate.replace(/[^0-9]/g, '');
          var petBirthdateLenght = petReplaceValue === null || petReplaceValue === void 0 ? void 0 : petReplaceValue.length;

          if (petBirthdateLenght < 8) {
            return;
          }

          return pet.name && pet.kind && pet.breed && pet.birthdate && pet.gender;
        },
        cancelEditing: function cancelEditing(pet, petKey) {
          if (pet.id.indexOf('new') !== -1) {
            this.deletePet(pet);
          } else {
            this.mutablePets[petKey] = JSON.parse(JSON.stringify(this.originalPets[pet.id]));
          }
        },
        savePet: function savePet(pet) {
          var _this = this;

          return babelHelpers.asyncToGenerator( /*#__PURE__*/_regeneratorRuntime$1().mark(function _callee() {
            var response;
            return _regeneratorRuntime$1().wrap(function _callee$(_context) {
              while (1) {
                switch (_context.prev = _context.next) {
                  case 0:
                    if (!(pet.id.indexOf('new') === -1)) {
                      _context.next = 5;
                      break;
                    }

                    _context.next = 3;
                    return _this.petStore.changePet(pet);

                  case 3:
                    _context.next = 9;
                    break;

                  case 5:
                    _context.next = 7;
                    return _this.petStore.addPet(pet);

                  case 7:
                    response = _context.sent;
                    pet.id = "".concat(response.data.id);

                  case 9:
                    pet.editing = false;
                    _this.originalPets[pet.id] = JSON.parse(JSON.stringify(pet));
                    setTimeout(function () {
                      tippy('button[data-tippy-content]', {
                        theme: 'light',
                        arrow: false,
                        appendTo: 'parent'
                      });
                    }, 500);

                  case 12:
                  case "end":
                    return _context.stop();
                }
              }
            }, _callee);
          }))();
        }
      },
      template: "\n        <div class=\"profile__block accordeon__item\" data-accordeon>\n            <div class=\"section__box box box--gray box--rounded\">\n                <div class=\"profile__accordeon-header accordeon__header section__header\">\n                    <h4 class=\"section__title section__title--closer\">\u0414\u0430\u043D\u043D\u044B\u0435 \u043E \u043F\u0438\u0442\u043E\u043C\u0446\u0430\u0445</h4>\n\n                    <div class=\"profile__actions\">\n                        <button type=\"button\" class=\"profile__actions-button profile__actions-button--toggle accordeon__toggle button button--circular button--mini button--covered button--red-white\" data-accordeon-toggle>\n                            <span class=\"accordeon__toggle-icon button__icon\">\n                                <svg class=\"icon icon--arrow-down\">\n                                    <use xlink:href=\"/local/templates/.default/images/icons/sprite.svg#icon-arrow-down\"></use>\n                                </svg>\n                            </span>\n                        </button>\n                    </div>\n                </div>\n\n                <div class=\"profile__accordeon-body accordeon__body accordeon__body--closer\" data-accordeon-content>\n                    <div class=\"pet-cards\">\n                        <ul class=\"pet-cards__list\" data-pets-list>\n                            <li v-for=\"(pet, petKey) in mutablePets\" :key=\"pet.id\" class=\"pet-cards__item\">\n                                <article class=\"pet-card\" :class=\"{ 'pet-card--editing': pet.editing }\" data-pets-card>\n                                    <div class=\"pet-card__main box box--circle\" data-pets-main>\n                                        <div class=\"pet-card__content\">\n                                            <div class=\"pet-card__avatar\" data-pets-type>\n                                                <svg class=\"icon\" :class=\"'icon--' + pet.kind?.code.toLowerCase().substring(5)\">\n                                                    <use :xlink:href=\"'/local/templates/.default/images/icons/sprite.svg#icon-' + pet.kind?.code.toLowerCase().substring(5)\"></use>\n                                                </svg>\n                                            </div>\n\n                                            <div class=\"pet-card__info\">\n                                                <div class=\"pet-card__name\" data-pets-name>\n                                                    {{ pet.name }}\n                                                </div>\n\n                                                <div class=\"pet-card__breed\" data-pets-breed>\n                                                    {{ pet.breed?.name }}\n                                                </div>\n\n                                                <div class=\"pet-card__info-record\">\n                                                    <div class=\"pet-card__gender\" data-pets-gender>\n                                                        <svg class=\"icon\" :class=\"'icon--' + (pet.gender?.code.indexOf('FEMALE') !== -1 ? 'woman' : 'man')\">\n                                                            <use :xlink:href=\"'/local/templates/.default/images/icons/sprite.svg#icon-' + (pet.gender?.code.indexOf('FEMALE') !== -1 ? 'woman' : 'man')\"></use>\n                                                        </svg>\n                                                    </div>\n\n                                                    <div class=\"pet-card__date\" data-pets-date>\n                                                        {{ pet.birthdate }}\n                                                    </div>\n                                                </div>\n                                            </div>\n                                        </div>\n\n                                        <div class=\"pet-card__actions\">\n                                            <div class=\"pet-card__modify\">\n                                                <button type=\"button\" class=\"pet-card__actions-button button button--iconed button--simple button--red\" data-tippy-content=\"\u0420\u0435\u0434\u0430\u043A\u0442\u0438\u0440\u043E\u0432\u0430\u0442\u044C\" @click=\"pet.editing = true\">\n                                                    <span class=\"button__icon\">\n                                                        <svg class=\"icon icon--edit\">\n                                                            <use xlink:href=\"/local/templates/.default/images/icons/sprite.svg#icon-edit\"></use>\n                                                        </svg>\n                                                    </span>\n                                                </button>\n                                            </div>\n\n                                            <div class=\"pet-card__delete\">\n                                                <button type=\"button\" class=\"pet-card__actions-button button button--iconed button--simple button--red\" data-tippy-content=\"\u0423\u0434\u0430\u043B\u0438\u0442\u044C\" @click=\"deletePet(pet)\">\n                                                    <span class=\"button__icon\">\n                                                        <svg class=\"icon icon--trash\">\n                                                            <use xlink:href=\"/local/templates/.default/images/icons/sprite.svg#icon-trash\"></use>\n                                                        </svg>\n                                                    </span>\n                                                </button>\n                                            </div>\n                                        </div>\n                                    </div>\n\n                                    <div class=\"pet-card__edit box box--rounded-sm\" data-pets-edit>\n                                        <form class=\"form\" action=\"\" method=\"post\" data-pets-form>\n                                            <div class=\"pet-card__row form__row\">\n                                                <div class=\"pet-card__col pet-card__col--1-3 pet-card__col--3 form__col\">\n                                                    <div class=\"form__field\">\n                                                        <div class=\"form__field-block form__field-block--label\">\n                                                            <label for=\"UF_KIND\" class=\"form__label\">\n                                                                <span class=\"form__label-text\">\u0422\u0438\u043F \u043F\u0438\u0442\u043E\u043C\u0446\u0430</span>\n                                                            </label>\n                                                        </div>\n\n                                                        <div class=\"form__field-block form__field-block--input\">\n                                                            <div class=\"form__control\">\n                                                                <Select\n                                                                    :name=\"UF_KIND\"\n                                                                    :options=\"kinds\"\n                                                                    :selected=\"pet.kind?.id\"\n                                                                    :iconed=\"true\"\n                                                                    @custom-change=\"(value) => { pet.kind = kinds[value]; pet.breed = null }\"\n                                                                />\n                                                            </div>\n                                                        </div>\n                                                    </div>\n                                                </div>\n\n                                                <div class=\"pet-card__col pet-card__col--1-3 form__col\">\n                                                    <div class=\"form__field\">\n                                                        <div class=\"form__field-block form__field-block--label\">\n                                                            <label for=\"UF_GENDER\" class=\"form__label\">\n                                                                <span class=\"form__label-text\">\u041F\u043E\u043B</span>\n                                                            </label>\n                                                        </div>\n\n                                                        <div class=\"form__field-block form__field-block--input\">\n                                                            <div class=\"form__control\">\n                                                                <Select\n                                                                    :name=\"UF_GENDER\"\n                                                                    :options=\"genders\"\n                                                                    :selected=\"pet.gender?.id\"\n                                                                    @custom-change=\"(value) => { pet.gender = genders[value] }\"\n                                                                />\n                                                            </div>\n                                                        </div>\n                                                    </div>\n                                                </div>\n\n                                                <div class=\"pet-card__col pet-card__col--1-3 form__col\">\n                                                    <div class=\"form__field\">\n                                                        <div class=\"form__field-block form__field-block--label\">\n                                                            <label for=\"UF_BIRTHDATE\" class=\"form__label\">\n                                                                <span class=\"form__label-text\">\u0414\u0430\u0442\u0430 \u0440\u043E\u0436\u0434\u0435\u043D\u0438\u044F</span>\n                                                            </label>\n                                                        </div>\n\n                                                        <div class=\"form__field-block form__field-block--input\">\n                                                           <DateInput\n                                                               :name=\"UF_BIRTHDATE\"\n                                                               :value=\"pet.birthdate\"\n                                                               @custom-change=\"(value) => { pet.birthdate = value }\"\n                                                           />\n                                                        </div>\n                                                    </div>\n                                                </div>\n\n                                                <div class=\"pet-card__col pet-card__col--1-2 pet-card__col--1 form__col\">\n                                                    <div class=\"form__field\">\n                                                        <div class=\"form__field-block form__field-block--label\">\n                                                            <label for=\"UF_BREED\" class=\"form__label\">\n                                                                <span class=\"form__label-text\">\u041F\u043E\u0440\u043E\u0434\u0430</span>\n                                                            </label>\n                                                        </div>\n\n                                                        <div class=\"form__field-block form__field-block--input\">\n                                                            <div class=\"form__control\">\n                                                                <Select\n                                                                    :name=\"UF_BREED\"\n                                                                    :options=\"breeds[pet.kind?.code] ?? {}\"\n                                                                    :selected=\"pet.breed?.id\"\n                                                                    @custom-change=\"(value) => { pet.breed = breeds[pet.kind.code][value] }\"\n                                                                    data-pets-breed\n                                                                />\n                                                            </div>\n                                                        </div>\n                                                    </div>\n                                                </div>\n\n                                                <div class=\"pet-card__col pet-card__col--1-2 pet-card__col--2 form__col\">\n                                                    <div class=\"form__field\">\n                                                        <div class=\"form__field-block form__field-block--label\">\n                                                            <label for=\"UF_NAME\" class=\"form__label\">\n                                                                <span class=\"form__label-text\">\u041A\u043B\u0438\u0447\u043A\u0430</span>\n                                                            </label>\n                                                        </div>\n                                                \n                                                        <div class=\"form__field-block form__field-block--input\">\n                                                            <div class=\"input\">\n                                                                <input\n                                                                    type=\"text\"\n                                                                    class=\"input__control\"\n                                                                    name=\"UF_NAME\"\n                                                                    id=\"text19\"\n                                                                    placeholder=\"\u0412\u044B\u0431\u0440\u0430\u0442\u044C\"\n                                                                    data-pets-name-input\n                                                                    v-model=\"pet.name\"\n                                                                >\n                                                            </div>\n                                                        </div>\n                                                    </div>\n                                                </div>\n                                            </div>\n\n                                            <div class=\"pet-card__buttons\">\n                                                <button type=\"button\" class=\"pet-card__button pet-card__button-save button button--rounded button--covered button--green button--full\" :class=\"{ 'button--disabled': !checkPetAvailable(pet) }\" :disabled=\"!checkPetAvailable(pet)\" @click=\"savePet(pet)\">\n                                                    \u0421\u043E\u0445\u0440\u0430\u043D\u0438\u0442\u044C \u0438\u0437\u043C\u0435\u043D\u0435\u043D\u0438\u044F\n                                                </button>\n                                            \n                                                <button type=\"button\" class=\"pet-card__button button button--rounded button--mixed button--red button--full\" @click=\"() => cancelEditing(pet, petKey)\">\n                                                    \u041E\u0442\u043C\u0435\u043D\u0438\u0442\u044C \u0438\u0437\u043C\u0435\u043D\u0435\u043D\u0438\u044F\n                                                </button>\n                                            </div>\n                                        </form>\n                                    </div>\n                                </article>\n                            </li>\n                        </ul>\n\n                        <div class=\"pet-cards__adding\">\n                            <button type=\"button\" class=\"button button--rounded button--covered button--white-green button--full\" :class=\"{ 'button--disabled': mutablePets.length >= 10 }\" :disabled=\"mutablePets.length >= 10\" @click=\"addPet\">\n                                <span class=\"button__icon button__icon--medium\">\n                                    <svg class=\"icon icon--add-circle\">\n                                        <use xlink:href=\"/local/templates/.default/images/icons/sprite.svg#icon-add-circle\"></use>\n                                    </svg>\n                                </span>\n                                <span class=\"button__text\">\u0414\u043E\u0431\u0430\u0432\u0438\u0442\u044C \u043F\u0438\u0442\u043E\u043C\u0446\u0430</span>\n                            </button>\n                        </div>\n                    </div>\n                </div>\n            </div>\n        </div>\n    "
    };

    exports.Pets = Pets;

}((this.zolo.pets = this.zolo.pets || {}),BX.Vue3.Pinia,BX,BX,BX,BX));
//# sourceMappingURL=component.bundle.js.map

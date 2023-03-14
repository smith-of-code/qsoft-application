this.zolo = this.zolo || {};
(function (exports,ui_vue3_pinia,select2) {
    'use strict';

    select2 = select2 && select2.hasOwnProperty('default') ? select2['default'] : select2;

    function _regeneratorRuntime() { /*! regenerator-runtime -- Copyright (c) 2014-present, Facebook, Inc. -- license (MIT): https://github.com/facebook/regenerator/blob/main/LICENSE */ _regeneratorRuntime = function _regeneratorRuntime() { return exports; }; var exports = {}, Op = Object.prototype, hasOwn = Op.hasOwnProperty, $Symbol = "function" == typeof Symbol ? Symbol : {}, iteratorSymbol = $Symbol.iterator || "@@iterator", asyncIteratorSymbol = $Symbol.asyncIterator || "@@asyncIterator", toStringTagSymbol = $Symbol.toStringTag || "@@toStringTag"; function define(obj, key, value) { return Object.defineProperty(obj, key, { value: value, enumerable: !0, configurable: !0, writable: !0 }), obj[key]; } try { define({}, ""); } catch (err) { define = function define(obj, key, value) { return obj[key] = value; }; } function wrap(innerFn, outerFn, self, tryLocsList) { var protoGenerator = outerFn && outerFn.prototype instanceof Generator ? outerFn : Generator, generator = Object.create(protoGenerator.prototype), context = new Context(tryLocsList || []); return generator._invoke = function (innerFn, self, context) { var state = "suspendedStart"; return function (method, arg) { if ("executing" === state) throw new Error("Generator is already running"); if ("completed" === state) { if ("throw" === method) throw arg; return doneResult(); } for (context.method = method, context.arg = arg;;) { var delegate = context.delegate; if (delegate) { var delegateResult = maybeInvokeDelegate(delegate, context); if (delegateResult) { if (delegateResult === ContinueSentinel) continue; return delegateResult; } } if ("next" === context.method) context.sent = context._sent = context.arg;else if ("throw" === context.method) { if ("suspendedStart" === state) throw state = "completed", context.arg; context.dispatchException(context.arg); } else "return" === context.method && context.abrupt("return", context.arg); state = "executing"; var record = tryCatch(innerFn, self, context); if ("normal" === record.type) { if (state = context.done ? "completed" : "suspendedYield", record.arg === ContinueSentinel) continue; return { value: record.arg, done: context.done }; } "throw" === record.type && (state = "completed", context.method = "throw", context.arg = record.arg); } }; }(innerFn, self, context), generator; } function tryCatch(fn, obj, arg) { try { return { type: "normal", arg: fn.call(obj, arg) }; } catch (err) { return { type: "throw", arg: err }; } } exports.wrap = wrap; var ContinueSentinel = {}; function Generator() {} function GeneratorFunction() {} function GeneratorFunctionPrototype() {} var IteratorPrototype = {}; define(IteratorPrototype, iteratorSymbol, function () { return this; }); var getProto = Object.getPrototypeOf, NativeIteratorPrototype = getProto && getProto(getProto(values([]))); NativeIteratorPrototype && NativeIteratorPrototype !== Op && hasOwn.call(NativeIteratorPrototype, iteratorSymbol) && (IteratorPrototype = NativeIteratorPrototype); var Gp = GeneratorFunctionPrototype.prototype = Generator.prototype = Object.create(IteratorPrototype); function defineIteratorMethods(prototype) { ["next", "throw", "return"].forEach(function (method) { define(prototype, method, function (arg) { return this._invoke(method, arg); }); }); } function AsyncIterator(generator, PromiseImpl) { function invoke(method, arg, resolve, reject) { var record = tryCatch(generator[method], generator, arg); if ("throw" !== record.type) { var result = record.arg, value = result.value; return value && "object" == babelHelpers["typeof"](value) && hasOwn.call(value, "__await") ? PromiseImpl.resolve(value.__await).then(function (value) { invoke("next", value, resolve, reject); }, function (err) { invoke("throw", err, resolve, reject); }) : PromiseImpl.resolve(value).then(function (unwrapped) { result.value = unwrapped, resolve(result); }, function (error) { return invoke("throw", error, resolve, reject); }); } reject(record.arg); } var previousPromise; this._invoke = function (method, arg) { function callInvokeWithMethodAndArg() { return new PromiseImpl(function (resolve, reject) { invoke(method, arg, resolve, reject); }); } return previousPromise = previousPromise ? previousPromise.then(callInvokeWithMethodAndArg, callInvokeWithMethodAndArg) : callInvokeWithMethodAndArg(); }; } function maybeInvokeDelegate(delegate, context) { var method = delegate.iterator[context.method]; if (undefined === method) { if (context.delegate = null, "throw" === context.method) { if (delegate.iterator["return"] && (context.method = "return", context.arg = undefined, maybeInvokeDelegate(delegate, context), "throw" === context.method)) return ContinueSentinel; context.method = "throw", context.arg = new TypeError("The iterator does not provide a 'throw' method"); } return ContinueSentinel; } var record = tryCatch(method, delegate.iterator, context.arg); if ("throw" === record.type) return context.method = "throw", context.arg = record.arg, context.delegate = null, ContinueSentinel; var info = record.arg; return info ? info.done ? (context[delegate.resultName] = info.value, context.next = delegate.nextLoc, "return" !== context.method && (context.method = "next", context.arg = undefined), context.delegate = null, ContinueSentinel) : info : (context.method = "throw", context.arg = new TypeError("iterator result is not an object"), context.delegate = null, ContinueSentinel); } function pushTryEntry(locs) { var entry = { tryLoc: locs[0] }; 1 in locs && (entry.catchLoc = locs[1]), 2 in locs && (entry.finallyLoc = locs[2], entry.afterLoc = locs[3]), this.tryEntries.push(entry); } function resetTryEntry(entry) { var record = entry.completion || {}; record.type = "normal", delete record.arg, entry.completion = record; } function Context(tryLocsList) { this.tryEntries = [{ tryLoc: "root" }], tryLocsList.forEach(pushTryEntry, this), this.reset(!0); } function values(iterable) { if (iterable) { var iteratorMethod = iterable[iteratorSymbol]; if (iteratorMethod) return iteratorMethod.call(iterable); if ("function" == typeof iterable.next) return iterable; if (!isNaN(iterable.length)) { var i = -1, next = function next() { for (; ++i < iterable.length;) { if (hasOwn.call(iterable, i)) return next.value = iterable[i], next.done = !1, next; } return next.value = undefined, next.done = !0, next; }; return next.next = next; } } return { next: doneResult }; } function doneResult() { return { value: undefined, done: !0 }; } return GeneratorFunction.prototype = GeneratorFunctionPrototype, define(Gp, "constructor", GeneratorFunctionPrototype), define(GeneratorFunctionPrototype, "constructor", GeneratorFunction), GeneratorFunction.displayName = define(GeneratorFunctionPrototype, toStringTagSymbol, "GeneratorFunction"), exports.isGeneratorFunction = function (genFun) { var ctor = "function" == typeof genFun && genFun.constructor; return !!ctor && (ctor === GeneratorFunction || "GeneratorFunction" === (ctor.displayName || ctor.name)); }, exports.mark = function (genFun) { return Object.setPrototypeOf ? Object.setPrototypeOf(genFun, GeneratorFunctionPrototype) : (genFun.__proto__ = GeneratorFunctionPrototype, define(genFun, toStringTagSymbol, "GeneratorFunction")), genFun.prototype = Object.create(Gp), genFun; }, exports.awrap = function (arg) { return { __await: arg }; }, defineIteratorMethods(AsyncIterator.prototype), define(AsyncIterator.prototype, asyncIteratorSymbol, function () { return this; }), exports.AsyncIterator = AsyncIterator, exports.async = function (innerFn, outerFn, self, tryLocsList, PromiseImpl) { void 0 === PromiseImpl && (PromiseImpl = Promise); var iter = new AsyncIterator(wrap(innerFn, outerFn, self, tryLocsList), PromiseImpl); return exports.isGeneratorFunction(outerFn) ? iter : iter.next().then(function (result) { return result.done ? result.value : iter.next(); }); }, defineIteratorMethods(Gp), define(Gp, toStringTagSymbol, "Generator"), define(Gp, iteratorSymbol, function () { return this; }), define(Gp, "toString", function () { return "[object Generator]"; }), exports.keys = function (object) { var keys = []; for (var key in object) { keys.push(key); } return keys.reverse(), function next() { for (; keys.length;) { var key = keys.pop(); if (key in object) return next.value = key, next.done = !1, next; } return next.done = !0, next; }; }, exports.values = values, Context.prototype = { constructor: Context, reset: function reset(skipTempReset) { if (this.prev = 0, this.next = 0, this.sent = this._sent = undefined, this.done = !1, this.delegate = null, this.method = "next", this.arg = undefined, this.tryEntries.forEach(resetTryEntry), !skipTempReset) for (var name in this) { "t" === name.charAt(0) && hasOwn.call(this, name) && !isNaN(+name.slice(1)) && (this[name] = undefined); } }, stop: function stop() { this.done = !0; var rootRecord = this.tryEntries[0].completion; if ("throw" === rootRecord.type) throw rootRecord.arg; return this.rval; }, dispatchException: function dispatchException(exception) { if (this.done) throw exception; var context = this; function handle(loc, caught) { return record.type = "throw", record.arg = exception, context.next = loc, caught && (context.method = "next", context.arg = undefined), !!caught; } for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i], record = entry.completion; if ("root" === entry.tryLoc) return handle("end"); if (entry.tryLoc <= this.prev) { var hasCatch = hasOwn.call(entry, "catchLoc"), hasFinally = hasOwn.call(entry, "finallyLoc"); if (hasCatch && hasFinally) { if (this.prev < entry.catchLoc) return handle(entry.catchLoc, !0); if (this.prev < entry.finallyLoc) return handle(entry.finallyLoc); } else if (hasCatch) { if (this.prev < entry.catchLoc) return handle(entry.catchLoc, !0); } else { if (!hasFinally) throw new Error("try statement without catch or finally"); if (this.prev < entry.finallyLoc) return handle(entry.finallyLoc); } } } }, abrupt: function abrupt(type, arg) { for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i]; if (entry.tryLoc <= this.prev && hasOwn.call(entry, "finallyLoc") && this.prev < entry.finallyLoc) { var finallyEntry = entry; break; } } finallyEntry && ("break" === type || "continue" === type) && finallyEntry.tryLoc <= arg && arg <= finallyEntry.finallyLoc && (finallyEntry = null); var record = finallyEntry ? finallyEntry.completion : {}; return record.type = type, record.arg = arg, finallyEntry ? (this.method = "next", this.next = finallyEntry.finallyLoc, ContinueSentinel) : this.complete(record); }, complete: function complete(record, afterLoc) { if ("throw" === record.type) throw record.arg; return "break" === record.type || "continue" === record.type ? this.next = record.arg : "return" === record.type ? (this.rval = this.arg = record.arg, this.method = "return", this.next = "end") : "normal" === record.type && afterLoc && (this.next = afterLoc), ContinueSentinel; }, finish: function finish(finallyLoc) { for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i]; if (entry.finallyLoc === finallyLoc) return this.complete(entry.completion, entry.afterLoc), resetTryEntry(entry), ContinueSentinel; } }, "catch": function _catch(tryLoc) { for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i]; if (entry.tryLoc === tryLoc) { var record = entry.completion; if ("throw" === record.type) { var thrown = record.arg; resetTryEntry(entry); } return thrown; } } throw new Error("illegal catch attempt"); }, delegateYield: function delegateYield(iterable, resultName, nextLoc) { return this.delegate = { iterator: values(iterable), resultName: resultName, nextLoc: nextLoc }, "next" === this.method && (this.arg = undefined), ContinueSentinel; } }, exports; }
    var usePersonalDataStore = ui_vue3_pinia.defineStore('personalData', {
      actions: {
        savePersonalData: function savePersonalData(data) {
          return babelHelpers.asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee() {
            return _regeneratorRuntime().wrap(function _callee$(_context) {
              while (1) {
                switch (_context.prev = _context.next) {
                  case 0:
                    _context.next = 2;
                    return BX.ajax.runComponentAction('zolo:main.profile', 'savePersonalData', {
                      mode: 'class',
                      data: {
                        userInfo: data
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
        sendCode: function sendCode(value, type) {
          return babelHelpers.asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee2() {
            return _regeneratorRuntime().wrap(function _callee2$(_context2) {
              while (1) {
                switch (_context2.prev = _context2.next) {
                  case 0:
                    _context2.next = 2;
                    return BX.ajax.runComponentAction('zolo:main.profile', 'sendCode', {
                      mode: 'class',
                      data: {
                        value: value,
                        type: type
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
        verifyCode: function verifyCode(code, type) {
          return babelHelpers.asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee3() {
            return _regeneratorRuntime().wrap(function _callee3$(_context3) {
              while (1) {
                switch (_context3.prev = _context3.next) {
                  case 0:
                    _context3.next = 2;
                    return BX.ajax.runComponentAction('zolo:main.profile', 'verifyCode', {
                      mode: 'class',
                      data: {
                        code: code,
                        type: type
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

    function _regeneratorRuntime$1() { /*! regenerator-runtime -- Copyright (c) 2014-present, Facebook, Inc. -- license (MIT): https://github.com/facebook/regenerator/blob/main/LICENSE */ _regeneratorRuntime$1 = function _regeneratorRuntime() { return exports; }; var exports = {}, Op = Object.prototype, hasOwn = Op.hasOwnProperty, $Symbol = "function" == typeof Symbol ? Symbol : {}, iteratorSymbol = $Symbol.iterator || "@@iterator", asyncIteratorSymbol = $Symbol.asyncIterator || "@@asyncIterator", toStringTagSymbol = $Symbol.toStringTag || "@@toStringTag"; function define(obj, key, value) { return Object.defineProperty(obj, key, { value: value, enumerable: !0, configurable: !0, writable: !0 }), obj[key]; } try { define({}, ""); } catch (err) { define = function define(obj, key, value) { return obj[key] = value; }; } function wrap(innerFn, outerFn, self, tryLocsList) { var protoGenerator = outerFn && outerFn.prototype instanceof Generator ? outerFn : Generator, generator = Object.create(protoGenerator.prototype), context = new Context(tryLocsList || []); return generator._invoke = function (innerFn, self, context) { var state = "suspendedStart"; return function (method, arg) { if ("executing" === state) throw new Error("Generator is already running"); if ("completed" === state) { if ("throw" === method) throw arg; return doneResult(); } for (context.method = method, context.arg = arg;;) { var delegate = context.delegate; if (delegate) { var delegateResult = maybeInvokeDelegate(delegate, context); if (delegateResult) { if (delegateResult === ContinueSentinel) continue; return delegateResult; } } if ("next" === context.method) context.sent = context._sent = context.arg;else if ("throw" === context.method) { if ("suspendedStart" === state) throw state = "completed", context.arg; context.dispatchException(context.arg); } else "return" === context.method && context.abrupt("return", context.arg); state = "executing"; var record = tryCatch(innerFn, self, context); if ("normal" === record.type) { if (state = context.done ? "completed" : "suspendedYield", record.arg === ContinueSentinel) continue; return { value: record.arg, done: context.done }; } "throw" === record.type && (state = "completed", context.method = "throw", context.arg = record.arg); } }; }(innerFn, self, context), generator; } function tryCatch(fn, obj, arg) { try { return { type: "normal", arg: fn.call(obj, arg) }; } catch (err) { return { type: "throw", arg: err }; } } exports.wrap = wrap; var ContinueSentinel = {}; function Generator() {} function GeneratorFunction() {} function GeneratorFunctionPrototype() {} var IteratorPrototype = {}; define(IteratorPrototype, iteratorSymbol, function () { return this; }); var getProto = Object.getPrototypeOf, NativeIteratorPrototype = getProto && getProto(getProto(values([]))); NativeIteratorPrototype && NativeIteratorPrototype !== Op && hasOwn.call(NativeIteratorPrototype, iteratorSymbol) && (IteratorPrototype = NativeIteratorPrototype); var Gp = GeneratorFunctionPrototype.prototype = Generator.prototype = Object.create(IteratorPrototype); function defineIteratorMethods(prototype) { ["next", "throw", "return"].forEach(function (method) { define(prototype, method, function (arg) { return this._invoke(method, arg); }); }); } function AsyncIterator(generator, PromiseImpl) { function invoke(method, arg, resolve, reject) { var record = tryCatch(generator[method], generator, arg); if ("throw" !== record.type) { var result = record.arg, value = result.value; return value && "object" == babelHelpers["typeof"](value) && hasOwn.call(value, "__await") ? PromiseImpl.resolve(value.__await).then(function (value) { invoke("next", value, resolve, reject); }, function (err) { invoke("throw", err, resolve, reject); }) : PromiseImpl.resolve(value).then(function (unwrapped) { result.value = unwrapped, resolve(result); }, function (error) { return invoke("throw", error, resolve, reject); }); } reject(record.arg); } var previousPromise; this._invoke = function (method, arg) { function callInvokeWithMethodAndArg() { return new PromiseImpl(function (resolve, reject) { invoke(method, arg, resolve, reject); }); } return previousPromise = previousPromise ? previousPromise.then(callInvokeWithMethodAndArg, callInvokeWithMethodAndArg) : callInvokeWithMethodAndArg(); }; } function maybeInvokeDelegate(delegate, context) { var method = delegate.iterator[context.method]; if (undefined === method) { if (context.delegate = null, "throw" === context.method) { if (delegate.iterator["return"] && (context.method = "return", context.arg = undefined, maybeInvokeDelegate(delegate, context), "throw" === context.method)) return ContinueSentinel; context.method = "throw", context.arg = new TypeError("The iterator does not provide a 'throw' method"); } return ContinueSentinel; } var record = tryCatch(method, delegate.iterator, context.arg); if ("throw" === record.type) return context.method = "throw", context.arg = record.arg, context.delegate = null, ContinueSentinel; var info = record.arg; return info ? info.done ? (context[delegate.resultName] = info.value, context.next = delegate.nextLoc, "return" !== context.method && (context.method = "next", context.arg = undefined), context.delegate = null, ContinueSentinel) : info : (context.method = "throw", context.arg = new TypeError("iterator result is not an object"), context.delegate = null, ContinueSentinel); } function pushTryEntry(locs) { var entry = { tryLoc: locs[0] }; 1 in locs && (entry.catchLoc = locs[1]), 2 in locs && (entry.finallyLoc = locs[2], entry.afterLoc = locs[3]), this.tryEntries.push(entry); } function resetTryEntry(entry) { var record = entry.completion || {}; record.type = "normal", delete record.arg, entry.completion = record; } function Context(tryLocsList) { this.tryEntries = [{ tryLoc: "root" }], tryLocsList.forEach(pushTryEntry, this), this.reset(!0); } function values(iterable) { if (iterable) { var iteratorMethod = iterable[iteratorSymbol]; if (iteratorMethod) return iteratorMethod.call(iterable); if ("function" == typeof iterable.next) return iterable; if (!isNaN(iterable.length)) { var i = -1, next = function next() { for (; ++i < iterable.length;) { if (hasOwn.call(iterable, i)) return next.value = iterable[i], next.done = !1, next; } return next.value = undefined, next.done = !0, next; }; return next.next = next; } } return { next: doneResult }; } function doneResult() { return { value: undefined, done: !0 }; } return GeneratorFunction.prototype = GeneratorFunctionPrototype, define(Gp, "constructor", GeneratorFunctionPrototype), define(GeneratorFunctionPrototype, "constructor", GeneratorFunction), GeneratorFunction.displayName = define(GeneratorFunctionPrototype, toStringTagSymbol, "GeneratorFunction"), exports.isGeneratorFunction = function (genFun) { var ctor = "function" == typeof genFun && genFun.constructor; return !!ctor && (ctor === GeneratorFunction || "GeneratorFunction" === (ctor.displayName || ctor.name)); }, exports.mark = function (genFun) { return Object.setPrototypeOf ? Object.setPrototypeOf(genFun, GeneratorFunctionPrototype) : (genFun.__proto__ = GeneratorFunctionPrototype, define(genFun, toStringTagSymbol, "GeneratorFunction")), genFun.prototype = Object.create(Gp), genFun; }, exports.awrap = function (arg) { return { __await: arg }; }, defineIteratorMethods(AsyncIterator.prototype), define(AsyncIterator.prototype, asyncIteratorSymbol, function () { return this; }), exports.AsyncIterator = AsyncIterator, exports.async = function (innerFn, outerFn, self, tryLocsList, PromiseImpl) { void 0 === PromiseImpl && (PromiseImpl = Promise); var iter = new AsyncIterator(wrap(innerFn, outerFn, self, tryLocsList), PromiseImpl); return exports.isGeneratorFunction(outerFn) ? iter : iter.next().then(function (result) { return result.done ? result.value : iter.next(); }); }, defineIteratorMethods(Gp), define(Gp, toStringTagSymbol, "Generator"), define(Gp, iteratorSymbol, function () { return this; }), define(Gp, "toString", function () { return "[object Generator]"; }), exports.keys = function (object) { var keys = []; for (var key in object) { keys.push(key); } return keys.reverse(), function next() { for (; keys.length;) { var key = keys.pop(); if (key in object) return next.value = key, next.done = !1, next; } return next.done = !0, next; }; }, exports.values = values, Context.prototype = { constructor: Context, reset: function reset(skipTempReset) { if (this.prev = 0, this.next = 0, this.sent = this._sent = undefined, this.done = !1, this.delegate = null, this.method = "next", this.arg = undefined, this.tryEntries.forEach(resetTryEntry), !skipTempReset) for (var name in this) { "t" === name.charAt(0) && hasOwn.call(this, name) && !isNaN(+name.slice(1)) && (this[name] = undefined); } }, stop: function stop() { this.done = !0; var rootRecord = this.tryEntries[0].completion; if ("throw" === rootRecord.type) throw rootRecord.arg; return this.rval; }, dispatchException: function dispatchException(exception) { if (this.done) throw exception; var context = this; function handle(loc, caught) { return record.type = "throw", record.arg = exception, context.next = loc, caught && (context.method = "next", context.arg = undefined), !!caught; } for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i], record = entry.completion; if ("root" === entry.tryLoc) return handle("end"); if (entry.tryLoc <= this.prev) { var hasCatch = hasOwn.call(entry, "catchLoc"), hasFinally = hasOwn.call(entry, "finallyLoc"); if (hasCatch && hasFinally) { if (this.prev < entry.catchLoc) return handle(entry.catchLoc, !0); if (this.prev < entry.finallyLoc) return handle(entry.finallyLoc); } else if (hasCatch) { if (this.prev < entry.catchLoc) return handle(entry.catchLoc, !0); } else { if (!hasFinally) throw new Error("try statement without catch or finally"); if (this.prev < entry.finallyLoc) return handle(entry.finallyLoc); } } } }, abrupt: function abrupt(type, arg) { for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i]; if (entry.tryLoc <= this.prev && hasOwn.call(entry, "finallyLoc") && this.prev < entry.finallyLoc) { var finallyEntry = entry; break; } } finallyEntry && ("break" === type || "continue" === type) && finallyEntry.tryLoc <= arg && arg <= finallyEntry.finallyLoc && (finallyEntry = null); var record = finallyEntry ? finallyEntry.completion : {}; return record.type = type, record.arg = arg, finallyEntry ? (this.method = "next", this.next = finallyEntry.finallyLoc, ContinueSentinel) : this.complete(record); }, complete: function complete(record, afterLoc) { if ("throw" === record.type) throw record.arg; return "break" === record.type || "continue" === record.type ? this.next = record.arg : "return" === record.type ? (this.rval = this.arg = record.arg, this.method = "return", this.next = "end") : "normal" === record.type && afterLoc && (this.next = afterLoc), ContinueSentinel; }, finish: function finish(finallyLoc) { for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i]; if (entry.finallyLoc === finallyLoc) return this.complete(entry.completion, entry.afterLoc), resetTryEntry(entry), ContinueSentinel; } }, "catch": function _catch(tryLoc) { for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i]; if (entry.tryLoc === tryLoc) { var record = entry.completion; if ("throw" === record.type) { var thrown = record.arg; resetTryEntry(entry); } return thrown; } } throw new Error("illegal catch attempt"); }, delegateYield: function delegateYield(iterable, resultName, nextLoc) { return this.delegate = { iterator: values(iterable), resultName: resultName, nextLoc: nextLoc }, "next" === this.method && (this.arg = undefined), ContinueSentinel; } }, exports; }

    function ownKeys$1(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); enumerableOnly && (symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; })), keys.push.apply(keys, symbols); } return keys; }

    function _objectSpread$1(target) { for (var i = 1; i < arguments.length; i++) { var source = null != arguments[i] ? arguments[i] : {}; i % 2 ? ownKeys$1(Object(source), !0).forEach(function (key) { babelHelpers.defineProperty(target, key, source[key]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)) : ownKeys$1(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } return target; }
    var PersonalData = {
      components: {
        Select: Select
      },
      data: function data() {
        return {
          mutableUserInfo: {},
          editing: false,
          phoneError: false,
          emailError: false,
          passwordError: false,
          phoneVerified: false,
          emailVerified: false,
          verifyError: false,
          confirmationType: false
        };
      },
      props: {
        userInfo: {
          type: Object,
          "default": {}
        },
        genders: {
          type: Object,
          required: true
        },
        cities: {
          type: Object,
          required: true
        },
        pickupPoints: {
          type: Object,
          required: true
        }
      },
      computed: {
        userCity: function userCity() {
          var _this = this;

          return Object.values(this.cities).find(function (city) {
            return city.name === _this.mutableUserInfo.city;
          });
        },
        validatePassword: function validatePassword() {
          switch (true) {
            case this.mutableUserInfo.password !== this.mutableUserInfo.confirm_password:
            case this.mutableUserInfo.password.length < 8:
            case this.mutableUserInfo.password.match(/[А-я]+/i):
            case this.mutableUserInfo.password.toUpperCase() === this.mutableUserInfo.password:
            case this.mutableUserInfo.password.toLowerCase() === this.mutableUserInfo.password:
              return false;
          }

          return true;
        }
      },
      setup: function setup() {
        return {
          personalDataStore: usePersonalDataStore()
        };
      },
      created: function created() {
        this.initUserInfo();
      },
      methods: {
        initUserInfo: function initUserInfo() {
          this.mutableUserInfo = JSON.parse(JSON.stringify(this.userInfo));
        },
        cancelEditing: function cancelEditing() {
          this.editing = false;
          this.initUserInfo();
        },
        saveUserInfo: function saveUserInfo() {
          this.passwordError = false;
          this.phoneError = false;
          this.emailError = false;
          var error = false;
          this.mutableUserInfo = _objectSpread$1(_objectSpread$1({}, this.mutableUserInfo), {}, {
            last_name: this.mutableUserInfo.last_name.replaceAll(/(?:(?![\x2DA-Za-z\u0401\u0410-\u044F\u0451])[\s\S])+/g, '').slice(0, 100),
            first_name: this.mutableUserInfo.first_name.replaceAll(/(?:(?![\x2DA-Za-z\u0401\u0410-\u044F\u0451])[\s\S])+/g, '').slice(0, 100),
            second_name: this.mutableUserInfo.second_name.replaceAll(/(?:(?![\x2DA-Za-z\u0401\u0410-\u044F\u0451])[\s\S])+/g, '').slice(0, 100)
          });

          if (this.userInfo.phone !== this.mutableUserInfo.phone.replaceAll(/\(|\)|\s|-+/g, '') && this.phoneVerified !== this.mutableUserInfo.phone) {
            error = true;
            this.phoneError = true;
          }

          if (this.userInfo.email !== this.mutableUserInfo.email && this.emailVerified !== this.mutableUserInfo.email) {
            error = true;
            this.emailError = true;
          }

          if ((this.mutableUserInfo.password || this.mutableUserInfo.confirm_password) && !this.validatePassword) {
            error = true;
            this.passwordError = true;
          }

          if (error) {
            return;
          }

          this.mutableUserInfo.photo_id = $('input[type=file][name=photo]').parent().find('input[type=hidden]').val();
          this.personalDataStore.savePersonalData(_objectSpread$1(_objectSpread$1({}, this.mutableUserInfo), {}, {
            phone: this.mutableUserInfo.phone.replaceAll(/\(|\)|\s|-+/g, '')
          }));
          this.editing = false;
          this.initUserInfo();
          $.fancybox.open({
            src: '#thanks'
          });
        },
        sendCode: function sendCode(value, type) {
          var _this2 = this;

          return babelHelpers.asyncToGenerator( /*#__PURE__*/_regeneratorRuntime$1().mark(function _callee() {
            var response;
            return _regeneratorRuntime$1().wrap(function _callee$(_context) {
              while (1) {
                switch (_context.prev = _context.next) {
                  case 0:
                    _context.prev = 0;
                    _context.next = 3;
                    return _this2.personalDataStore.sendCode(value, type);

                  case 3:
                    response = _context.sent;

                    if (!(!response.data || response.data.status === 'error')) {
                      _context.next = 6;
                      break;
                    }

                    throw new Error(response.data.message);

                  case 6:
                    _this2.confirmationType = type;
                    _context.next = 13;
                    break;

                  case 9:
                    _context.prev = 9;
                    _context.t0 = _context["catch"](0);
                    _this2.phoneError = _context.t0.message ? _context.t0.message : true;
                    return _context.abrupt("return");

                  case 13:
                    $.fancybox.open({
                      src: '#approve-number'
                    });

                  case 14:
                  case "end":
                    return _context.stop();
                }
              }
            }, _callee, null, [[0, 9]]);
          }))();
        },
        verifyCode: function verifyCode() {
          var _this3 = this;

          return babelHelpers.asyncToGenerator( /*#__PURE__*/_regeneratorRuntime$1().mark(function _callee2() {
            var codeInput, response;
            return _regeneratorRuntime$1().wrap(function _callee2$(_context2) {
              while (1) {
                switch (_context2.prev = _context2.next) {
                  case 0:
                    _context2.prev = 0;
                    codeInput = $('input[name=verify_code]');
                    _context2.next = 4;
                    return _this3.personalDataStore.verifyCode(codeInput.val(), _this3.confirmationType);

                  case 4:
                    response = _context2.sent;

                    if (!(!response.data || response.data.status === 'error')) {
                      _context2.next = 9;
                      break;
                    }

                    throw new Error();

                  case 9:
                    if (_this3.confirmationType === 'phone') {
                      _this3.phoneError = false;
                      _this3.phoneVerified = _this3.mutableUserInfo.phone;
                    } else if (_this3.confirmationType === 'email') {
                      _this3.emailError = false;
                      _this3.emailVerified = _this3.mutableUserInfo.email;
                    }

                  case 10:
                    codeInput.val('');
                    _context2.next = 17;
                    break;

                  case 13:
                    _context2.prev = 13;
                    _context2.t0 = _context2["catch"](0);
                    _this3.verifyError = true;
                    return _context2.abrupt("return");

                  case 17:
                    _this3.verifyError = false;
                    _this3.confirmationType = false;
                    $.fancybox.close({
                      src: '#approve-number'
                    });

                  case 20:
                  case "end":
                    return _context2.stop();
                }
              }
            }, _callee2, null, [[0, 13]]);
          }))();
        }
      },
      template: "\n        <div class=\"profile__block accordeon__item\" data-accordeon :class=\"{ 'profile__block--edit': editing }\">\n            <section class=\"section\">\n                <form class=\"form form--wraped form--separated\" action=\"\" method=\"post\" data-profile-form data-validation=\"profile\">\n                    <div class=\"section__box box box--gray box--rounded-sm\">\n                        <div class=\"profile__accordeon-header accordeon__header section__header\">\n                            <h4 class=\"section__title section__title--closer\">\u041F\u0435\u0440\u0441\u043E\u043D\u0430\u043B\u044C\u043D\u044B\u0435 \u0434\u0430\u043D\u043D\u044B\u0435</h4>\n                            <div class=\"profile__actions\">\n                                <button v-if=\"!editing\" type=\"button\" class=\"profile__actions-button profile__actions-button--edit profile__actions-button--edit-personal button button--simple button--red\" @click=\"editing = true\">\n                                    <span class=\"button__icon\">\n                                        <svg class=\"icon icon--edit\">\n                                            <use xlink:href=\"/local/templates/.default/images/icons/sprite.svg#icon-edit\"></use>\n                                        </svg>\n                                    </span>\n                                    <span class=\"button__text\">\u0420\u0435\u0434\u0430\u043A\u0442\u0438\u0440\u043E\u0432\u0430\u0442\u044C</span>\n                                </button>\n\n                                <button type=\"button\" class=\"profile__actions-button profile__actions-button--toggle accordeon__toggle button button--circular button--mini button--covered button--red-white\" data-accordeon-toggle >\n                                    <span class=\"accordeon__toggle-icon button__icon\">\n                                        <svg class=\"icon icon--arrow-down\">\n                                            <use xlink:href=\"/local/templates/.default/images/icons/sprite.svg#icon-arrow-down\"></use>\n                                        </svg>\n                                    </span>\n                                </button>\n                            </div>\n                        </div>\n\n                        <div class=\"profile__accordeon-body accordeon__body accordeon__body--closer\" data-accordeon-content>\n                            <div class=\"profile__actions profile__actions--mobile\">\n                                <button v-if=\"!editing\" type=\"button\" class=\"profile__actions-button button button--simple button--red\" @click=\"editing = true\">\n                                    <span class=\"button__icon\">\n                                        <svg class=\"icon icon--edit\">\n                                            <use xlink:href=\"/local/templates/.default/images/icons/sprite.svg#icon-edit\"></use>\n                                        </svg>\n                                    </span>\n                                    <span class=\"button__text\">\u0420\u0435\u0434\u0430\u043A\u0442\u0438\u0440\u043E\u0432\u0430\u0442\u044C</span>\n                                </button>\n                            </div>\n\n                            <div class=\"section__wrapper\">\n                                <div class=\"profile__avatar\">\n                                    <div class=\"profile__avatar-box\">\n                                        <div class=\"profile__avatar-image\">\n                                            <img v-if=\"mutableUserInfo.photo\" :src=\"mutableUserInfo.photo\" alt=\"\u041F\u0435\u0440\u0441\u043E\u043D\u0430\u043B\u044C\u043D\u043E\u0435 \u0444\u043E\u0442\u043E\" class=\"profile__avatar-image-pic\">\n                                            <svg v-else class=\"dropzone__message-button-icon icon icon--camera\">\n                                                <use xlink:href=\"/local/templates/.default/images/icons/sprite.svg#icon-camera\"></use>\n                                            </svg>\n                                        </div>\n                                    </div>\n\n                                    <div class=\"profile__dropzone dropzone dropzone--image dropzone--simple\" data-uploader>\n                                        <input type=\"file\" name=\"photo\" multiple class=\"dropzone__control js-required\">\n                                        <div class=\"dropzone__area\">\n                                            <div class=\"dropzone__message dropzone__message--simple dz-message needsclick\">\n                                                <div class=\"dropzone__message-button dz-button link needsclick\" data-uploader-previews>\n                                                    <img v-if=\"mutableUserInfo.photo\" :src=\"mutableUserInfo.photo\" alt=\"\u041F\u0435\u0440\u0441\u043E\u043D\u0430\u043B\u044C\u043D\u043E\u0435 \u0444\u043E\u0442\u043E\" class=\"profile__avatar-image-pic\">\n                                                    <svg v-else class=\"dropzone__message-button-icon icon icon--camera\">\n                                                        <use xlink:href=\"/local/templates/.default/images/icons/sprite.svg#icon-camera\"></use>\n                                                    </svg>\n                                                </div>\n\n                                                <div class=\"profile__toggle\">\n                                                    <button type=\"button\" class=\"dropzone__button button button--medium button--rounded button--outlined button--green\" data-uploader-area='{\"paramName\": \"photo\", \"url\":\"/_markup/gui.php\", \"images\": true, \"single\": true, \"acceptedFiles\": \".jpg, .jpeg, .png, .heic\" ,\"maxFiles\": \"1\", \"maxFileSize\": \"3\" }'>\n                                                        <span class=\"button__icon\">\n                                                            <svg class=\"icon icon--import\">\n                                                                <use xlink:href=\"/local/templates/.default/images/icons/sprite.svg#icon-import\"></use>\n                                                            </svg>\n                                                        </span>\n                                                        <span class=\"button__text\">\u0417\u0430\u0433\u0440\u0443\u0437\u0438\u0442\u044C \u0444\u043E\u0442\u043E</span>\n                                                    </button>\n                                                </div>\n\n                                                <div class=\"profile__toggle dropzone__message-caption needsclick\">\n                                                    <h6 class=\"dropzone__message-title\">\u0422\u0440\u0435\u0431\u043E\u0432\u0430\u043D\u0438\u044F \u043A \u0444\u043E\u0442\u043E:</h6>\n                                                    <ul class=\"dropzone__message-list\">\n                                                        <li class=\"dropzone__message-item\">\u0444\u043E\u0440\u043C\u0430\u0442 jpg, jpeg, png, heic</li>\n                                                        <li class=\"dropzone__message-item\">\u0440\u0430\u0437\u043C\u0435\u0440 720 \u0425 1280 px</li>\n                                                        <li class=\"dropzone__message-item\">\u0432\u0435\u0441 \u043D\u0435 \u0431\u043E\u043B\u0435\u0435 3\u041C\u0411</li>\n                                                    </ul>\n                                                </div>\n                                            </div>\n                                        </div>\n                                    </div>\n                                    <div class=\"profile__info\">\n                                        <span v-if=\"mutableUserInfo.is_consultant\" class=\"profile__level\">\n                                            \u0423\u0440\u043E\u0432\u0435\u043D\u044C {{ mutableUserInfo.loyalty_level }}\n                                        </span>\n                                        <span class=\"profile__id\">ID {{ mutableUserInfo.id }}</span>\n                                    </div>\n                                </div>\n\n                                <div class=\"section__box-inner section__box-inner--full\">\n                                    <div class=\"section__box-content section__box-content--collapsed box box--white box--rounded-sm box--inner\" data-identic data-validate-dependent>\n                                    <div class=\"section__box-block\">\n                                        <div class=\"form__row form__row--special\">\n                                            <div class=\"form__col\">\n                                                <div class=\"form__field\">\n                                                    <div class=\"form__field-block form__field-block--label\">\n                                                        <label for=\"last_name\" class=\"profile__label form__label form__label--required\">\n                                                            <span class=\"form__label-text\">\u0424\u0430\u043C\u0438\u043B\u0438\u044F</span>\n                                                        </label>\n                                                    </div>\n\n                                                    <div class=\"form__field-block form__field-block--input\">\n                                                        <div class=\"input\">\n                                                            <input\n                                                                type=\"text\"\n                                                                class=\"input__control js-required\"\n                                                                name=\"last_name\"\n                                                                id=\"last_name\"\n                                                                placeholder=\"\u0412\u0432\u0435\u0434\u0438\u0442\u0435 \u0444\u0430\u043C\u0438\u043B\u0438\u044E\"\n                                                                :readonly=\"!editing\"\n                                                                v-model=\"mutableUserInfo.last_name\"\n                                                                data-replace-input=\"fullName\"\n                                                            >\n                                                        </div>\n                                                    </div>\n                                                </div>\n                                            </div>\n\n                                            <div class=\"form__col\">\n                                                <div class=\"form__field\">\n                                                    <div class=\"form__field-block form__field-block--label\">\n                                                        <label for=\"first_name\" class=\"profile__label form__label form__label--required\">\n                                                            <span class=\"form__label-text\">\u0418\u043C\u044F</span>\n                                                        </label>\n                                                    </div>\n\n                                                    <div class=\"form__field-block form__field-block--input\">\n                                                        <div class=\"input\">\n                                                            <input\n                                                                type=\"text\"\n                                                                class=\"input__control js-required\" \n                                                                name=\"first_name\"\n                                                                id=\"first_name\"\n                                                                placeholder=\"\u0412\u0432\u0435\u0434\u0438\u0442\u0435 \u0438\u043C\u044F\"\n                                                                :readonly=\"!editing\"\n                                                                v-model=\"mutableUserInfo.first_name\" \n                                                                data-replace-input=\"fullName\"\n                                                            >\n                                                        </div>\n                                                    </div>\n                                                </div>\n                                            </div>\n\n                                            <div class=\"form__col\">\n                                                <div class=\"form__field\">\n                                                    <div class=\"form__field-block form__field-block--label\">\n                                                        <label for=\"second_name\" class=\"profile__label form__label form__label--required\">\n                                                            <span class=\"form__label-text\">\u041E\u0442\u0447\u0435\u0441\u0442\u0432\u043E</span>\n                                                        </label>\n                                                    </div>\n\n                                                    <div class=\"form__field-block form__field-block--input\">\n                                                        <div class=\"input\">\n                                                            <input \n                                                                type=\"text\" \n                                                                class=\"input__control js-required-dependent\" \n                                                                name=\"second_name\" \n                                                                id=\"second_name\" \n                                                                placeholder=\"\u0412\u0432\u0435\u0434\u0438\u0442\u0435 \u043E\u0442\u0447\u0435\u0441\u0442\u0432\u043E\" \n                                                                :readonly=\"!editing\" \n                                                                data-identic-input\n                                                                v-model=\"mutableUserInfo.second_name\"\n                                                                data-replace-input=\"fullName\"\n                                                            >\n                                                        </div>\n                                                    </div>\n                                                </div>\n                                            </div>\n                                        </div>\n\n                                        <!-- TODO: \u043E\u043F\u0440\u0435\u0434\u0435\u043B\u0438\u0442\u044C\u0441\u044F \u0441 \u0440\u0435\u0430\u043B\u0438\u0437\u0430\u0446\u0438\u0435\u0439 -->\n                                        <div class=\"profile__toggle form__row form__row--centered\">\n                                            <div class=\"form__col\">\n                                                <div class=\"form__field\">\n                                                    <div class=\"checkbox\">\n                                                        <input \n                                                            type=\"checkbox\" \n                                                            class=\"checkbox__input\" \n                                                            name=\"without_second_name\" \n                                                            id=\"without_second_name\" \n                                                            data-identic-change \n                                                            data-validate-dependent-change\n                                                            v-model=\"mutableUserInfo.without_second_name\"\n                                                            :checked=\"mutableUserInfo.without_second_name\" \n                                                        >\n    \n                                                        <label for=\"without_second_name\" class=\"checkbox__label\">\n                                                            <span class=\"checkbox__icon\">\n                                                                <svg class=\"checkbox__icon-pic icon icon--check\">\n                                                                    <use xlink:href=\"/local/templates/.default/images/icons/sprite.svg#icon-check\"></use>\n                                                                </svg>\n                                                            </span>\n    \n                                                            <span class=\"checkbox__text\">\u0423 \u043C\u0435\u043D\u044F \u043D\u0435\u0442 \u043E\u0442\u0447\u0435\u0441\u0442\u0432\u0430</span>\n                                                        </label>\n                                                    </div>\n                                                </div>\n                                            </div>\n                                        </div>\n\n                                        <div class=\"form__row\">\n                                            <div class=\"form__col\">\n                                                <div class=\"form__field\">\n                                                    <div class=\"form__field-block form__field-block--label\">\n                                                        <label for=\"gender\" class=\"profile__label form__label form__label--required\">\n                                                            <span class=\"form__label-text\">\u041F\u043E\u043B</span>\n                                                        </label>\n                                                    </div>\n    \n                                                    <div class=\"form__field-block form__field-block--input\">\n                                                        <div class=\"form__control\">\n                                                            <div class=\"profile__toggle-select select select--mitigate\" data-select>\n                                                                <Select\n                                                                    name=\"gender\"\n                                                                    :options=\"genders\"\n                                                                    placeholder=\"\u0412\u044B\u0431\u0435\u0440\u0438\u0442\u0435 \u043F\u043E\u043B\"\n                                                                    :selected=\"mutableUserInfo.gender\"\n                                                                    @custom-change=\"(value) => { mutableUserInfo.gender = value }\"\n                                                                />\n                                                            </div>\n                                                        </div>\n                                                    </div>\n                                                </div>\n                                            </div>\n\n                                            <div class=\"form__col\">\n                                                <div class=\"form__field\">\n                                                    <div class=\"form__field-block form__field-block--label\">\n                                                        <label for=\"birthdate\" class=\"profile__label form__label form__label--required\">\n                                                            <span class=\"form__label-text\">\u0414\u0430\u0442\u0430 \u0440\u043E\u0436\u0434\u0435\u043D\u0438\u044F</span>\n                                                        </label>\n                                                    </div>\n\n                                                    <div class=\"form__field-block form__field-block--input\">\n                                                        <div class=\"input input--iconed\">\n                                                            <input \n                                                                inputmode=\"numeric\"\n                                                                class=\"input__control js-required js-date\"\n                                                                name=\"birthdate\"\n                                                                id=\"birthdate\"\n                                                                placeholder=\"\u0414\u0414.\u041C\u041C.\u0413\u0413\u0413\u0413\"\n                                                                data-mask-date-reg\n                                                                :readonly=\"!editing\"\n                                                                v-model=\"mutableUserInfo.birthdate\"\n                                                                autocomplete=\"off\"\n                                                            >\n                                                            <span class=\"input__control-error--mask\"></span>\n                                                            <span class=\"input__icon\">\n                                                                <svg class=\"icon icon--calendar\">\n                                                                    <use xlink:href=\"/local/templates/.default/images/icons/sprite.svg#icon-calendar\"></use>\n                                                                </svg>\n                                                            </span>\n                                                        </div>\n                                                    </div>\n                                                </div>\n                                            </div>\n                                        </div>\n\n                                        <div class=\"form__row\">\n                                            <div class=\"form__col\">\n                                                <div class=\"form__field\">\n                                                    <div class=\"form__field-block form__field-block--label\">\n                                                        <label for=\"email\" class=\"profile__label form__label form__label--required\">\n                                                            <span class=\"form__label-text\">E-mail</span>\n                                                        </label>\n                                                    </div>\n\n                                                    <div class=\"form__field-block form__field-block--input\">\n                                                        <div class=\"input\">\n                                                            <input \n                                                                type=\"text\" \n                                                                class=\"input__control js-required js-email\" \n                                                                name=\"email\" \n                                                                id=\"email\" \n                                                                placeholder=\"example@email.com\" \n                                                                data-mail \n                                                                inputmode=\"email\"  \n                                                                :class=\"{ 'input__control--error': emailError }\"\n                                                                :readonly=\"!editing\"\n                                                                v-model=\"mutableUserInfo.email\" \n                                                            >\n                                                            \n                                                            <span v-if=\"typeof emailError === 'string'\" class=\"input__control-error\">\n                                                                {{ emailError }}\n                                                            </span>\n                                                        </div>\n                                                    </div>\n                                                    \n                                                    <button\n                                                        v-if=\"editing && mutableUserInfo.email.indexOf('_') === -1 && userInfo.email !== mutableUserInfo.email && emailVerified !== mutableUserInfo.email\"\n                                                        type=\"button\"\n                                                        class=\"form__field-button button button--simple button--red button--underlined button--tiny\"\n                                                        data-src=\"#approve-number\"\n                                                        @click=\"sendCode(mutableUserInfo.email, 'email')\"\n                                                        :style=\"{ color: emailError ? 'red' : 'black' }\"\n                                                    >\n                                                        \u041F\u043E\u0434\u0442\u0432\u0435\u0440\u0434\u0438\u0442\u044C\n                                                    </button>\n                                                </div>\n                                            </div>\n\n                                            <div class=\"form__col\">\n                                                <div class=\"form__field\">\n                                                    <div class=\"form__field-block form__field-block--label\">\n                                                        <label for=\"phone\" class=\"profile__label form__label form__label--required\">\n                                                            <span class=\"form__label-text\">\u0422\u0435\u043B\u0435\u0444\u043E\u043D</span>\n                                                        </label>\n                                                    </div>\n\n                                                    <div class=\"form__field-block form__field-block--input\">\n                                                        <div class=\"input\">\n                                                            <input \n                                                                type=\"tel\" \n                                                                class=\"input__control js-required\" \n                                                                name=\"phone\" \n                                                                id=\"phone\" \n                                                                placeholder=\"+7 (___) ___-__-__\" \n                                                                data-phone \n                                                                inputmode=\"text\"  \n                                                                :class=\"{ 'input__control--error': phoneError }\"\n                                                                :readonly=\"!editing\"\n                                                                v-model=\"mutableUserInfo.phone\"\n                                                            >\n                                                            \n                                                            <span v-if=\"typeof phoneError === 'string'\" class=\"input__control-error\">\n                                                                {{ phoneError }}\n                                                            </span>\n                                                        </div>\n                                                    </div>\n                                                    \n                                                    <button\n                                                        v-if=\"editing && mutableUserInfo.phone.indexOf('_') === -1 && userInfo.phone !== mutableUserInfo.phone.replaceAll(/\\(|\\)|\\s|-+/g, '') && phoneVerified !== mutableUserInfo.phone\"\n                                                        type=\"button\"\n                                                        class=\"form__field-button button button--simple button--red button--underlined button--tiny\"\n                                                        data-src=\"#approve-number\"\n                                                        @click=\"sendCode(mutableUserInfo.phone.replaceAll(/\\(|\\)|\\s|-+/g, ''), 'phone')\"\n                                                        :style=\"{ color: phoneError ? 'red' : 'black' }\"\n                                                    >\n                                                        \u041F\u043E\u0434\u0442\u0432\u0435\u0440\u0434\u0438\u0442\u044C\n                                                    </button>\n                                                </div>\n                                            </div>\n                                        </div>\n\n                                        <!-- TODO: \u043E\u043F\u0440\u0435\u0434\u0435\u043B\u0438\u0442\u044C \u0440\u0435\u0430\u043B\u0438\u0437\u0430\u0446\u0438\u044E -->\n                                        <div class=\"form__row\">\n                                            <div class=\"form__col\">\n                                                <div class=\"form__field\">\n                                                    <div class=\"form__field-block form__field-block--label\">\n                                                        <label for=\"city\" class=\"profile__label form__label form__label--required\">\n                                                            <span class=\"form__label-text\">\u041D\u0430\u0441\u0435\u043B\u0435\u043D\u043D\u044B\u0439 \u043F\u0443\u043D\u043A\u0442</span>\n                                                        </label>\n                                                    </div>\n    \n                                                    <div class=\"form__field-block form__field-block--input\">\n                                                        <div class=\"form__control\">\n                                                            <div class=\"profile__toggle-select select select--mitigate\" data-select>\n                                                                <Select\n                                                                    name=\"city\"\n                                                                    :options=\"cities\"\n                                                                    placeholder=\"\u0412\u044B\u0431\u0435\u0440\u0438\u0442\u0435 \u0433\u043E\u0440\u043E\u0434\"\n                                                                    :selected=\"userCity.id\"\n                                                                    @custom-change=\"(value) => { mutableUserInfo.city = cities[value].name }\"\n                                                                />\n                                                            </div>\n                                                        </div>\n                                                    </div>\n                                                </div>\n                                            </div>\n\n                                            <div class=\"form__col\">\n                                                <div class=\"form__field\">\n                                                    <div class=\"form__field-block form__field-block--label\">\n                                                        <label for=\"pickup_point_id\" class=\"profile__label form__label form__label--required\">\n                                                            <span class=\"form__label-text\">\u041F\u0443\u043D\u043A\u0442 \u0432\u044B\u0434\u0430\u0447\u0438 \u0437\u0430\u043A\u0430\u0437\u043E\u0432</span>\n                                                        </label>\n                                                    </div>\n    \n                                                    <div class=\"form__field-block form__field-block--input\">\n                                                        <div class=\"form__control\">\n                                                            <div class=\"profile__toggle-select select select--mitigate\" data-select>\n                                                                <Select\n                                                                    name=\"pickup_point_id\"\n                                                                    :options=\"pickupPoints[userCity.id] ?? {}\"\n                                                                    placeholder=\"\u041F\u0443\u043D\u043A\u0442 \u0432\u044B\u0434\u0430\u0447\u0438 \u0437\u0430\u043A\u0430\u0437\u043E\u0432\"\n                                                                    :selected=\"mutableUserInfo.pickup_point_id\"\n                                                                    @custom-change=\"(value) => { mutableUserInfo.pickup_point_id = value }\"\n                                                                />\n                                                            </div>\n                                                        </div>\n                                                    </div>\n                                                </div>\n                                            </div>\n                                        </div>\n\n                                        <div class=\"profile__toggle profile__toggle--row profile__toggle--inline form__row\">\n                                            <div class=\"form__col\">\n                                                <div class=\"form__field\">\n                                                    <div class=\"form__field-block form__field-block--label\">\n                                                        <label for=\"password\" class=\"form__label form__label--required\">\n                                                            <span class=\"form__label-text\">\u041F\u0430\u0440\u043E\u043B\u044C</span>\n                                                        </label>\n                                                    </div>\n            \n                                                    <div class=\"form__field-block form__field-block--input\" data-password-block>\n                                                        <div class=\"input input--iconed\">\n                                                            <input \n                                                                type=\"password\" \n                                                                class=\"input__control js-required\" \n                                                                name=\"password\" \n                                                                id=\"password\" \n                                                                placeholder=\"\u0412\u0432\u0435\u0434\u0438\u0442\u0435 \u043F\u0430\u0440\u043E\u043B\u044C\" \n                                                                data-password-input\n                                                                :class=\"{ 'input__control--error': passwordError && !validatePassword }\"\n                                                                v-model=\"mutableUserInfo.password\"\n                                                            >\n                                                            <button class=\"input__icon input__icon-password\" data-password-toggle>\n                                                                <svg class=\"input__icon-password-icon input__icon-password-icon--show icon icon--eye\">\n                                                                    <use xlink:href=\"/local/templates/.default/images/icons/sprite.svg#icon-eye\"></use>\n                                                                </svg>\n                                                                <svg class=\"input__icon-password-icon input__icon-password-icon--hidden icon icon--eye-off\">\n                                                                    <use xlink:href=\"/local/templates/.default/images/icons/sprite.svg#icon-eye-off\"></use>\n                                                                </svg>\n                                                            </button>\n                                                        </div>\n                                                    </div>\n                                                </div>\n                                            </div>\n            \n            \n                                            <div class=\"form__col\">\n                                                <div class=\"form__field\">\n                                                    <div class=\"form__field-block form__field-block--label\">\n                                                        <label for=\"confirm_password\" class=\"form__label form__label--required\">\n                                                            <span class=\"form__label-text\">\u041F\u043E\u0434\u0442\u0432\u0435\u0440\u0434\u0438\u0442\u044C \u043F\u0430\u0440\u043E\u043B\u044C</span>\n                                                        </label>\n                                                    </div>\n            \n                                                    <div class=\"form__field-block form__field-block--input\" data-password-block>\n                                                        <div class=\"input input--iconed\">\n                                                            <input \n                                                                type=\"password\" \n                                                                class=\"input__control js-required\" \n                                                                name=\"confirm_password\" \n                                                                id=\"confirm_password\" \n                                                                placeholder=\"\u0412\u0432\u0435\u0434\u0438\u0442\u0435 \u043F\u0430\u0440\u043E\u043B\u044C\" \n                                                                data-password-input\n                                                                :class=\"{ 'input__control--error': passwordError && !validatePassword }\"\n                                                                v-model=\"mutableUserInfo.confirm_password\"\n                                                            >\n                                                            <button class=\"input__icon input__icon-password\" data-password-toggle>\n                                                                <svg class=\"input__icon-password-icon input__icon-password-icon--show icon icon--eye\">\n                                                                    <use xlink:href=\"/local/templates/.default/images/icons/sprite.svg#icon-eye\"></use>\n                                                                </svg>\n                                                                <svg class=\"input__icon-password-icon input__icon-password-icon--hidden icon icon--eye-off\">\n                                                                    <use xlink:href=\"/local/templates/.default/images/icons/sprite.svg#icon-eye-off\"></use>\n                                                                </svg>\n                                                            </button>\n                                                        </div>\n                                                    </div>\n                                                </div>\n                                            </div>\n                                        </div>\n\n                                        <div class=\"profile__toggle profile__requirement requirement requirement--inlined box box--gray box--circle\">\n                                            <div class=\"requirement__col\">\n                                                <p class=\"requirement__text\">\u0422\u0440\u0435\u0431\u043E\u0432\u0430\u043D\u0438\u044F \u043A \u043F\u0430\u0440\u043E\u043B\u044E:</p>\n                                            </div>\n            \n                                            <div class=\"requirement__col requirement__col--right\">\n                                                <ul class=\"requirement__list\">\n                                                    <li class=\"requirement__item\">\n                                                        \u0418\u0441\u043F\u043E\u043B\u044C\u0437\u043E\u0432\u0430\u043D\u0438\u0435 \u0442\u043E\u043B\u044C\u043A\u043E \u043B\u0430\u0442\u0438\u043D\u0441\u043A\u0438\u0445 \u0431\u0443\u043A\u0432, \u0441\u0438\u043C\u0432\u043E\u043B\u043E\u0432 \u0438 \u0446\u0438\u0444\u0440\n                                                    </li>\n                                                    <li class=\"requirement__item\">\n                                                        \u041D\u0435 \u043C\u0435\u043D\u0435\u0435 8 \u0441\u0438\u043C\u0432\u043E\u043B\u043E\u0432\n                                                    </li>\n                                                    <li class=\"requirement__item\">\n                                                        \u041D\u0435 \u043C\u0435\u043D\u0435\u0435 \u043E\u0434\u043D\u043E\u0439 \u0437\u0430\u0433\u043B\u0430\u0432\u043D\u043E\u0439 \u0431\u0443\u043A\u0432\u044B\n                                                    </li>\n                                                    <li class=\"requirement__item\">\n                                                        \u041D\u0435 \u043C\u0435\u043D\u0435\u0435 \u043E\u0434\u043D\u043E\u0439 \u0441\u0442\u0440\u043E\u0447\u043D\u043E\u0439 \u0431\u0443\u043A\u0432\u044B\n                                                    </li>\n                                                </ul>\n                                            </div>\n                                        </div>\n                                    </div>    \n                                    </div>\n                                </div>\n                            </div>\n\n                            <div class=\"profile__toggle profile__toggle--inline section__actions\">\n                                <div class=\"section__actions-col\">\n                                    <button type=\"button\" class=\"button button--rounded button--mixed button--red button--full\" @click=\"cancelEditing\">\n                                        <span class=\"button__text\">\u041E\u0442\u043C\u0435\u043D\u0438\u0442\u044C \u0438\u0437\u043C\u0435\u043D\u0435\u043D\u0438\u044F</span>\n                                    </button>\n                                </div>\n\n                                <div class=\"section__actions-col\">\n                                    <button type=\"button\" class=\"profile__button-personal button button--rounded button--covered button--green button--full\" @click=\"saveUserInfo\">\n                                        <span class=\"button__text\">\u0421\u043E\u0445\u0440\u0430\u043D\u0438\u0442\u044C \u0438\u0437\u043C\u0435\u043D\u0435\u043D\u0438\u044F</span>\n                                    </button>\n                                </div>\n                            </div>\n                        </div>\n                    </div>\n                </form>\n            </section>\n\n            <article id=\"thanks\" class=\"modal modal--wide modal--centered box box--circle box--hanging\" style=\"display: none\">\n                <div class=\"modal__content\">\n                    <section class=\"modal__section modal__section--content\">\n                        <div class=\"notification notification--simple\">\n                            <div class=\"notification__icon\">\n                                <svg class=\"icon icon--cat-serious\">\n                                    <use xlink:href=\"/local/templates/.default/images/icons/sprite.svg#icon-cat-serious\"></use>\n                                </svg>\n                            </div>\n\n                            <h4 class=\"notification__title\">\u0421\u043F\u0430\u0441\u0438\u0431\u043E \u0437\u0430 \u043E\u0431\u0440\u0430\u0449\u0435\u043D\u0438\u0435</h4>\n                            <p class=\"notification__text\">\u041C\u044B \u043F\u0440\u043E\u0432\u0435\u0440\u0438\u043C \u043E\u0431\u043D\u043E\u0432\u043B\u0435\u043D\u043D\u044B\u0435 \u0434\u0430\u043D\u043D\u044B\u0435 \u0438 \u0443\u0432\u0435\u0434\u043E\u043C\u0438\u043C \u0412\u0430\u0441 \u043E \u0440\u0435\u0437\u0443\u043B\u044C\u0442\u0430\u0442\u0435 \u0432\u043D\u0435\u0441\u0435\u043D\u0438\u044F \u0438\u0437\u043C\u0435\u043D\u0435\u043D\u0438\u0439. </p>\n                        </div>\n                    </section>\n                </div>\n            </article>\n            \n            <article id=\"approve-number\" class=\"modal modal--small modal--centered box box--circle box--hanging\" style=\"display: none\">\n                <div class=\"modal__content\">\n                    <header class=\"modal__section modal__section--header\">\n                        <p v-if=\"this.confirmationType == 'phone'\" class=\"heading heading--small heading--centered\">\n                        \u041F\u043E\u0434\u0442\u0432\u0435\u0440\u0436\u0434\u0435\u043D\u0438\u0435 \u043D\u043E\u043C\u0435\u0440\u0430\n                        </p>\n                        <p v-else class=\"heading heading--small heading--centered\">\n                        \u041F\u043E\u0434\u0442\u0432\u0435\u0440\u0436\u0434\u0435\u043D\u0438\u0435 \u0430\u0434\u0440\u0435\u0441\u0430 \u044D\u043B\u0435\u043A\u0442\u0440\u043E\u043D\u043D\u043E\u0439 \u043F\u043E\u0447\u0442\u044B\n                        </p>\n                    </header>\n            \n                    <section class=\"modal__section modal__section--content\">\n                        <div v-if=\"this.confirmationType == 'phone'\">\n                            <p class=\"modal__section-text\">\u041D\u0430 \u0443\u043A\u0430\u0437\u0430\u043D\u043D\u044B\u0439 \u043D\u043E\u043C\u0435\u0440 \u0442\u0435\u043B\u0435\u0444\u043E\u043D\u0430 \u043E\u0442\u043F\u0440\u0430\u0432\u043B\u0435\u043D \u043A\u043E\u0434 \u043F\u043E\u0434\u0442\u0432\u0435\u0440\u0436\u0434\u0435\u043D\u0438\u044F.</p>\n                            <p class=\"modal__section-text\">\u041F\u043E\u0436\u0430\u043B\u0443\u0439\u0441\u0442\u0430, \u0432\u0432\u0435\u0434\u0438\u0442\u0435 \u0435\u0433\u043E \u0432 \u043E\u043A\u043D\u043E \u043D\u0438\u0436\u0435</p>\n                        </div>\n                        <div v-else>\n                            <p class=\"modal__section-text\">\u041D\u0430 \u0443\u043A\u0430\u0437\u0430\u043D\u043D\u044B\u0439 \u0430\u0434\u0440\u0435\u0441 \u044D\u043B\u0435\u043A\u0442\u0440\u043E\u043D\u043D\u043E\u0439 \u043F\u043E\u0447\u0442\u044B \u043E\u0442\u043F\u0440\u0430\u0432\u043B\u0435\u043D \u043A\u043E\u0434 \u043F\u043E\u0434\u0442\u0432\u0435\u0440\u0436\u0434\u0435\u043D\u0438\u044F.</p>\n                            <p class=\"modal__section-text\">\u041F\u043E\u0436\u0430\u043B\u0443\u0439\u0441\u0442\u0430, \u0432\u0432\u0435\u0434\u0438\u0442\u0435 \u0435\u0433\u043E \u0432 \u043E\u043A\u043D\u043E \u043D\u0438\u0436\u0435</p>\n                        </div>\n            \n                        <div class=\"form__row\">\n                            <div class=\"form__col\">\n                                <div class=\"form__field\">\n                                    <div class=\"form__field-block form__field-block--input\">\n                                        <div class=\"input input--tiny input--centered input--tel\">\n                                            <input\n                                                type=\"text\"\n                                                maxlength=\"6\"\n                                                class=\"input__control\"\n                                                name=\"verify_code\"\n                                                id=\"verify_code\"\n                                                :class=\"{ 'input__control--error': verifyError }\"\n                                            >\n                                        \n                                            <span v-if=\"verifyError\" class=\"input__control-error\">\u041D\u0435\u0432\u0435\u0440\u043D\u044B\u0439 \u0438\u043B\u0438 \u043F\u0440\u043E\u0441\u0440\u043E\u0447\u0435\u043D\u043D\u044B\u0439 \u043A\u043E\u0434</span>\n                                        </div>\n                                    </div>\n                                </div>\n                            </div>\n                        </div>\n            \n                        <button class=\"button button--rounded button--covered button--red button--full\" style=\"margin-top: 25px;\" @click=\"verifyCode\">\n                            <span class=\"button__text\">\u0414\u0430\u043B\u0435\u0435</span>\n                        </button>\n                    </section>\n                </div>\n            </article>\n        </div>\n    "
    };

    exports.PersonalData = PersonalData;

}((this.zolo.personalData = this.zolo.personalData || {}),BX.Vue3.Pinia,BX));
//# sourceMappingURL=component.bundle.js.map

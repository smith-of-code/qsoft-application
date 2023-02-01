this.zolo = this.zolo || {};
(function (exports,ui_vue3_pinia,ui_vue3) {
    'use strict';

    function _regeneratorRuntime() { /*! regenerator-runtime -- Copyright (c) 2014-present, Facebook, Inc. -- license (MIT): https://github.com/facebook/regenerator/blob/main/LICENSE */ _regeneratorRuntime = function _regeneratorRuntime() { return exports; }; var exports = {}, Op = Object.prototype, hasOwn = Op.hasOwnProperty, $Symbol = "function" == typeof Symbol ? Symbol : {}, iteratorSymbol = $Symbol.iterator || "@@iterator", asyncIteratorSymbol = $Symbol.asyncIterator || "@@asyncIterator", toStringTagSymbol = $Symbol.toStringTag || "@@toStringTag"; function define(obj, key, value) { return Object.defineProperty(obj, key, { value: value, enumerable: !0, configurable: !0, writable: !0 }), obj[key]; } try { define({}, ""); } catch (err) { define = function define(obj, key, value) { return obj[key] = value; }; } function wrap(innerFn, outerFn, self, tryLocsList) { var protoGenerator = outerFn && outerFn.prototype instanceof Generator ? outerFn : Generator, generator = Object.create(protoGenerator.prototype), context = new Context(tryLocsList || []); return generator._invoke = function (innerFn, self, context) { var state = "suspendedStart"; return function (method, arg) { if ("executing" === state) throw new Error("Generator is already running"); if ("completed" === state) { if ("throw" === method) throw arg; return doneResult(); } for (context.method = method, context.arg = arg;;) { var delegate = context.delegate; if (delegate) { var delegateResult = maybeInvokeDelegate(delegate, context); if (delegateResult) { if (delegateResult === ContinueSentinel) continue; return delegateResult; } } if ("next" === context.method) context.sent = context._sent = context.arg;else if ("throw" === context.method) { if ("suspendedStart" === state) throw state = "completed", context.arg; context.dispatchException(context.arg); } else "return" === context.method && context.abrupt("return", context.arg); state = "executing"; var record = tryCatch(innerFn, self, context); if ("normal" === record.type) { if (state = context.done ? "completed" : "suspendedYield", record.arg === ContinueSentinel) continue; return { value: record.arg, done: context.done }; } "throw" === record.type && (state = "completed", context.method = "throw", context.arg = record.arg); } }; }(innerFn, self, context), generator; } function tryCatch(fn, obj, arg) { try { return { type: "normal", arg: fn.call(obj, arg) }; } catch (err) { return { type: "throw", arg: err }; } } exports.wrap = wrap; var ContinueSentinel = {}; function Generator() {} function GeneratorFunction() {} function GeneratorFunctionPrototype() {} var IteratorPrototype = {}; define(IteratorPrototype, iteratorSymbol, function () { return this; }); var getProto = Object.getPrototypeOf, NativeIteratorPrototype = getProto && getProto(getProto(values([]))); NativeIteratorPrototype && NativeIteratorPrototype !== Op && hasOwn.call(NativeIteratorPrototype, iteratorSymbol) && (IteratorPrototype = NativeIteratorPrototype); var Gp = GeneratorFunctionPrototype.prototype = Generator.prototype = Object.create(IteratorPrototype); function defineIteratorMethods(prototype) { ["next", "throw", "return"].forEach(function (method) { define(prototype, method, function (arg) { return this._invoke(method, arg); }); }); } function AsyncIterator(generator, PromiseImpl) { function invoke(method, arg, resolve, reject) { var record = tryCatch(generator[method], generator, arg); if ("throw" !== record.type) { var result = record.arg, value = result.value; return value && "object" == babelHelpers["typeof"](value) && hasOwn.call(value, "__await") ? PromiseImpl.resolve(value.__await).then(function (value) { invoke("next", value, resolve, reject); }, function (err) { invoke("throw", err, resolve, reject); }) : PromiseImpl.resolve(value).then(function (unwrapped) { result.value = unwrapped, resolve(result); }, function (error) { return invoke("throw", error, resolve, reject); }); } reject(record.arg); } var previousPromise; this._invoke = function (method, arg) { function callInvokeWithMethodAndArg() { return new PromiseImpl(function (resolve, reject) { invoke(method, arg, resolve, reject); }); } return previousPromise = previousPromise ? previousPromise.then(callInvokeWithMethodAndArg, callInvokeWithMethodAndArg) : callInvokeWithMethodAndArg(); }; } function maybeInvokeDelegate(delegate, context) { var method = delegate.iterator[context.method]; if (undefined === method) { if (context.delegate = null, "throw" === context.method) { if (delegate.iterator["return"] && (context.method = "return", context.arg = undefined, maybeInvokeDelegate(delegate, context), "throw" === context.method)) return ContinueSentinel; context.method = "throw", context.arg = new TypeError("The iterator does not provide a 'throw' method"); } return ContinueSentinel; } var record = tryCatch(method, delegate.iterator, context.arg); if ("throw" === record.type) return context.method = "throw", context.arg = record.arg, context.delegate = null, ContinueSentinel; var info = record.arg; return info ? info.done ? (context[delegate.resultName] = info.value, context.next = delegate.nextLoc, "return" !== context.method && (context.method = "next", context.arg = undefined), context.delegate = null, ContinueSentinel) : info : (context.method = "throw", context.arg = new TypeError("iterator result is not an object"), context.delegate = null, ContinueSentinel); } function pushTryEntry(locs) { var entry = { tryLoc: locs[0] }; 1 in locs && (entry.catchLoc = locs[1]), 2 in locs && (entry.finallyLoc = locs[2], entry.afterLoc = locs[3]), this.tryEntries.push(entry); } function resetTryEntry(entry) { var record = entry.completion || {}; record.type = "normal", delete record.arg, entry.completion = record; } function Context(tryLocsList) { this.tryEntries = [{ tryLoc: "root" }], tryLocsList.forEach(pushTryEntry, this), this.reset(!0); } function values(iterable) { if (iterable) { var iteratorMethod = iterable[iteratorSymbol]; if (iteratorMethod) return iteratorMethod.call(iterable); if ("function" == typeof iterable.next) return iterable; if (!isNaN(iterable.length)) { var i = -1, next = function next() { for (; ++i < iterable.length;) { if (hasOwn.call(iterable, i)) return next.value = iterable[i], next.done = !1, next; } return next.value = undefined, next.done = !0, next; }; return next.next = next; } } return { next: doneResult }; } function doneResult() { return { value: undefined, done: !0 }; } return GeneratorFunction.prototype = GeneratorFunctionPrototype, define(Gp, "constructor", GeneratorFunctionPrototype), define(GeneratorFunctionPrototype, "constructor", GeneratorFunction), GeneratorFunction.displayName = define(GeneratorFunctionPrototype, toStringTagSymbol, "GeneratorFunction"), exports.isGeneratorFunction = function (genFun) { var ctor = "function" == typeof genFun && genFun.constructor; return !!ctor && (ctor === GeneratorFunction || "GeneratorFunction" === (ctor.displayName || ctor.name)); }, exports.mark = function (genFun) { return Object.setPrototypeOf ? Object.setPrototypeOf(genFun, GeneratorFunctionPrototype) : (genFun.__proto__ = GeneratorFunctionPrototype, define(genFun, toStringTagSymbol, "GeneratorFunction")), genFun.prototype = Object.create(Gp), genFun; }, exports.awrap = function (arg) { return { __await: arg }; }, defineIteratorMethods(AsyncIterator.prototype), define(AsyncIterator.prototype, asyncIteratorSymbol, function () { return this; }), exports.AsyncIterator = AsyncIterator, exports.async = function (innerFn, outerFn, self, tryLocsList, PromiseImpl) { void 0 === PromiseImpl && (PromiseImpl = Promise); var iter = new AsyncIterator(wrap(innerFn, outerFn, self, tryLocsList), PromiseImpl); return exports.isGeneratorFunction(outerFn) ? iter : iter.next().then(function (result) { return result.done ? result.value : iter.next(); }); }, defineIteratorMethods(Gp), define(Gp, toStringTagSymbol, "Generator"), define(Gp, iteratorSymbol, function () { return this; }), define(Gp, "toString", function () { return "[object Generator]"; }), exports.keys = function (object) { var keys = []; for (var key in object) { keys.push(key); } return keys.reverse(), function next() { for (; keys.length;) { var key = keys.pop(); if (key in object) return next.value = key, next.done = !1, next; } return next.done = !0, next; }; }, exports.values = values, Context.prototype = { constructor: Context, reset: function reset(skipTempReset) { if (this.prev = 0, this.next = 0, this.sent = this._sent = undefined, this.done = !1, this.delegate = null, this.method = "next", this.arg = undefined, this.tryEntries.forEach(resetTryEntry), !skipTempReset) for (var name in this) { "t" === name.charAt(0) && hasOwn.call(this, name) && !isNaN(+name.slice(1)) && (this[name] = undefined); } }, stop: function stop() { this.done = !0; var rootRecord = this.tryEntries[0].completion; if ("throw" === rootRecord.type) throw rootRecord.arg; return this.rval; }, dispatchException: function dispatchException(exception) { if (this.done) throw exception; var context = this; function handle(loc, caught) { return record.type = "throw", record.arg = exception, context.next = loc, caught && (context.method = "next", context.arg = undefined), !!caught; } for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i], record = entry.completion; if ("root" === entry.tryLoc) return handle("end"); if (entry.tryLoc <= this.prev) { var hasCatch = hasOwn.call(entry, "catchLoc"), hasFinally = hasOwn.call(entry, "finallyLoc"); if (hasCatch && hasFinally) { if (this.prev < entry.catchLoc) return handle(entry.catchLoc, !0); if (this.prev < entry.finallyLoc) return handle(entry.finallyLoc); } else if (hasCatch) { if (this.prev < entry.catchLoc) return handle(entry.catchLoc, !0); } else { if (!hasFinally) throw new Error("try statement without catch or finally"); if (this.prev < entry.finallyLoc) return handle(entry.finallyLoc); } } } }, abrupt: function abrupt(type, arg) { for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i]; if (entry.tryLoc <= this.prev && hasOwn.call(entry, "finallyLoc") && this.prev < entry.finallyLoc) { var finallyEntry = entry; break; } } finallyEntry && ("break" === type || "continue" === type) && finallyEntry.tryLoc <= arg && arg <= finallyEntry.finallyLoc && (finallyEntry = null); var record = finallyEntry ? finallyEntry.completion : {}; return record.type = type, record.arg = arg, finallyEntry ? (this.method = "next", this.next = finallyEntry.finallyLoc, ContinueSentinel) : this.complete(record); }, complete: function complete(record, afterLoc) { if ("throw" === record.type) throw record.arg; return "break" === record.type || "continue" === record.type ? this.next = record.arg : "return" === record.type ? (this.rval = this.arg = record.arg, this.method = "return", this.next = "end") : "normal" === record.type && afterLoc && (this.next = afterLoc), ContinueSentinel; }, finish: function finish(finallyLoc) { for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i]; if (entry.finallyLoc === finallyLoc) return this.complete(entry.completion, entry.afterLoc), resetTryEntry(entry), ContinueSentinel; } }, "catch": function _catch(tryLoc) { for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i]; if (entry.tryLoc === tryLoc) { var record = entry.completion; if ("throw" === record.type) { var thrown = record.arg; resetTryEntry(entry); } return thrown; } } throw new Error("illegal catch attempt"); }, delegateYield: function delegateYield(iterable, resultName, nextLoc) { return this.delegate = { iterator: values(iterable), resultName: resultName, nextLoc: nextLoc }, "next" === this.method && (this.arg = undefined), ContinueSentinel; } }, exports; }
    var useBasketStore = ui_vue3_pinia.defineStore('basket', {
      state: function state() {
        return {
          fetched: false,
          items: {},
          itemsCount: undefined,
          basketPrice: undefined,
          loading: false
        };
      },
      actions: {
        getItem: function getItem(id) {
          var _this = this;

          return babelHelpers.asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee() {
            return _regeneratorRuntime().wrap(function _callee$(_context) {
              while (1) {
                switch (_context.prev = _context.next) {
                  case 0:
                    if (_this.fetched) {
                      _context.next = 4;
                      break;
                    }

                    _context.next = 3;
                    return _this.fetchBasketTotals();

                  case 3:
                    _this.fetched = true;

                  case 4:
                    return _context.abrupt("return", _this.items[id]);

                  case 5:
                  case "end":
                    return _context.stop();
                }
              }
            }, _callee);
          }))();
        },
        fetchBasketTotals: function fetchBasketTotals() {
          var _this2 = this;

          return babelHelpers.asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee2() {
            var response;
            return _regeneratorRuntime().wrap(function _callee2$(_context2) {
              while (1) {
                switch (_context2.prev = _context2.next) {
                  case 0:
                    if (_this2.fetched) {
                      _context2.next = 13;
                      break;
                    }

                    _this2.loading = true;
                    _context2.prev = 2;
                    _context2.next = 5;
                    return BX.ajax.runComponentAction('zolo:sale.basket.basket.line', 'getBasketTotals', {
                      data: {
                        withPersonalPromotions: window.location.pathname === '/cart/' || window.location.pathname === '/order/make/'
                      }
                    }).then(function (response) {
                      return response.data;
                    });

                  case 5:
                    response = _context2.sent;
                    _this2.items = response.items;
                    _this2.itemsCount = response.itemsCount;
                    _this2.basketPrice = response.basketPrice;

                  case 9:
                    _context2.prev = 9;
                    _this2.loading = false;
                    return _context2.finish(9);

                  case 12:
                    _this2.fetched = true;

                  case 13:
                  case "end":
                    return _context2.stop();
                }
              }
            }, _callee2, null, [[2,, 9, 12]]);
          }))();
        },
        increaseItem: function increaseItem(offerId) {
          var _arguments = arguments,
              _this3 = this;

          return babelHelpers.asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee3() {
            var detailPage, nonreturnable, response;
            return _regeneratorRuntime().wrap(function _callee3$(_context3) {
              while (1) {
                switch (_context3.prev = _context3.next) {
                  case 0:
                    detailPage = _arguments.length > 1 && _arguments[1] !== undefined ? _arguments[1] : '';
                    nonreturnable = _arguments.length > 2 && _arguments[2] !== undefined ? _arguments[2] : false;
                    _this3.loading = true;
                    _context3.prev = 3;
                    _context3.next = 6;
                    return BX.ajax.runComponentAction('zolo:sale.basket.basket.line', 'increaseItem', {
                      data: {
                        offerId: offerId,
                        detailPage: detailPage,
                        nonreturnable: nonreturnable,
                        withPersonalPromotions: window.location.pathname === '/cart/'
                      }
                    }).then(function (response) {
                      return response.data;
                    });

                  case 6:
                    response = _context3.sent;
                    _this3.items = response.items;
                    _this3.itemsCount = response.itemsCount;
                    _this3.basketPrice = response.basketPrice;

                  case 10:
                    _context3.prev = 10;
                    _this3.loading = false;
                    return _context3.finish(10);

                  case 13:
                  case "end":
                    return _context3.stop();
                }
              }
            }, _callee3, null, [[3,, 10, 13]]);
          }))();
        },
        decreaseItem: function decreaseItem(offerId) {
          var _arguments2 = arguments,
              _this4 = this;

          return babelHelpers.asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee4() {
            var quantity, response;
            return _regeneratorRuntime().wrap(function _callee4$(_context4) {
              while (1) {
                switch (_context4.prev = _context4.next) {
                  case 0:
                    quantity = _arguments2.length > 1 && _arguments2[1] !== undefined ? _arguments2[1] : 1;
                    _this4.loading = true;
                    _context4.prev = 2;
                    _context4.next = 5;
                    return BX.ajax.runComponentAction('zolo:sale.basket.basket.line', 'decreaseItem', {
                      data: {
                        offerId: offerId,
                        quantity: quantity,
                        withPersonalPromotions: window.location.pathname === '/cart/'
                      }
                    }).then(function (response) {
                      return response.data;
                    });

                  case 5:
                    response = _context4.sent;
                    _this4.items = response.items;
                    _this4.itemsCount = response.itemsCount;
                    _this4.basketPrice = response.basketPrice;

                  case 9:
                    _context4.prev = 9;
                    _this4.loading = false;
                    return _context4.finish(9);

                  case 12:
                  case "end":
                    return _context4.stop();
                }
              }
            }, _callee4, null, [[2,, 9, 12]]);
          }))();
        },
        repeatOrder: function repeatOrder() {
          var _this5 = this;

          return babelHelpers.asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee5() {
            var response;
            return _regeneratorRuntime().wrap(function _callee5$(_context5) {
              while (1) {
                switch (_context5.prev = _context5.next) {
                  case 0:
                    _context5.next = 2;
                    return BX.ajax.runComponentAction('zolo:sale.basket.basket.line', 'repeatOrder', {
                      data: {
                        orderId: orderId
                      }
                    }).then(function (response) {
                      return response.data;
                    });

                  case 2:
                    response = _context5.sent;
                    _this5.items = response.items;
                    _this5.itemsCount = response.itemsCount;
                    _this5.basketPrice = response.basketPrice;
                    return _context5.abrupt("return", response.missedProducts);

                  case 7:
                  case "end":
                    return _context5.stop();
                }
              }
            }, _callee5);
          }))();
        }
      }
    });

    var NumberFormatMixin = {
      methods: {
        formatNumber: function formatNumber(number) {
          var useDecimals = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : false;
          if (!number) return 0;
          number = Math.round(parseFloat(number));
          var result = number.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, "$&\xA0");
          return useDecimals ? result : result.substring(0, result.length - 3);
        }
      }
    };

    var MiniBasket = {
      mixins: [NumberFormatMixin],
      data: function data() {
        return {};
      },
      setup: function setup() {
        var store = useBasketStore();
        store.fetchBasketTotals();
        return {
          itemsCount: ui_vue3.computed(function () {
            return store.itemsCount;
          }),
          basketPrice: ui_vue3.computed(function () {
            return store.basketPrice;
          })
        };
      },
      methods: {
        showPriceWhole: function showPriceWhole(item) {
          var number = parseFloat(item);
          var numberFloor = Math.floor(number);
          return numberFloor.toLocaleString('ru-RU', {
            minimumFractionDigits: 0
          });
        },
        showPriceRemains: function showPriceRemains(item) {
          var number = parseFloat(item);
          var numberFixed = number.toFixed(2);
          var totalRemains = numberFixed.toString().split('.')[1];

          if (totalRemains === "00") {
            return;
          } else {
            return ',' + totalRemains;
          }
        }
      },
      template: "\n      <button type=\"button\" class=\"button button--simple button--red button--vertical\">\n      <span class=\"button__icon button__icon--mixed\">\n        <svg class=\"icon icon--basket\">\n          <use xlink:href=\"/local/templates/.default/images/icons/sprite.svg#icon-basket\"></use>\n        </svg>\n        <span v-if=\"itemsCount\" class=\"button__icon-counter button__icon-counter--dark\">{{ itemsCount }}</span>\n        </span>\n      <span v-if=\"itemsCount\" class=\"personal__button-text button__text\">\n        <span class=\"personal__price-whole\">\n            {{ showPriceWhole(basketPrice) }}\n        </span>\n        <span class=\"personal__price-remains\">\n            {{ showPriceRemains(basketPrice) }}&nbsp;&#8381\n        </span>\n      </span>\n      <span v-else class=\"personal__button-text button__text\">\u041A\u043E\u0440\u0437\u0438\u043D\u0430</span>\n      </button>\n    "
    };

    exports.MiniBasket = MiniBasket;

}((this.zolo.miniBasket = this.zolo.miniBasket || {}),BX.Vue3.Pinia,BX.Vue3));
//# sourceMappingURL=component.bundle.js.map

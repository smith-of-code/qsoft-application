(function (exports,ui_vue3,ui_vue3_pinia) {
    'use strict';

    var detailOfferStore = ui_vue3_pinia.defineStore('detailOffer', {
      state: function state() {
        return {
          offers: [],
          currentOfferId: undefined
        };
      },
      getters: {
        currentOffer: function currentOffer() {
          return this.offers.OFFERS[this.currentOfferId];
        },
        article: function article() {
          return this.offers.ARTICLES[this.currentOfferId];
        },
        images: function images() {
          return this.offers.PHOTOS[this.currentOfferId];
        }
      },
      actions: {
        getOffers: function getOffers() {
          return this.offers;
        },
        checkAvailable: function checkAvailable(id) {
          return this.offers.AVAILABLE[id];
        },
        setStore: function setStore(data) {
          console.log('SetSTore', data);
          this.offers = data;
        },
        setOffer: function setOffer(id) {
          console.log('SetOffer', id);
          this.currentOfferId = id;
        }
      }
    });

    function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); enumerableOnly && (symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; })), keys.push.apply(keys, symbols); } return keys; }

    function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = null != arguments[i] ? arguments[i] : {}; i % 2 ? ownKeys(Object(source), !0).forEach(function (key) { babelHelpers.defineProperty(target, key, source[key]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)) : ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } return target; }
    var SelectOffer = {
      data: function data() {
        return {};
      },
      setup: function setup() {
        var store = detailOfferStore();
        var offers = store.getOffers();
        return {
          store: store,
          offers: offers
        };
      },
      computed: _objectSpread({}, ui_vue3_pinia.mapState(detailOfferStore, ['offers', 'currentOfferId'])),
      methods: {
        setOffer: function setOffer(event) {
          if (this.store.checkAvailable(event.target.value)) {
            this.store.setOffer(event.target.value);
          }
        }
      },
      // language=Vue
      template: "\n        <template v-if=\"offers.PACKAGINGS.length > 0\">\n        <div class=\"specification__packs packs\">\n            <p class=\"specification__category\">\u0424\u0430\u0441\u043E\u0432\u043A\u0430</p>\n            <ul class=\"packs__list\">\n                <li class=\"packs__item\" v-for=\"(item) in offers.PACKAGINGS\">\n                    <div class=\"pack pack--bordered\">\n                        <div class=\"radio\">\n                            <input type=\"radio\" class=\"pack__input radio__input\" name=\"radio_pack\"\n                                   @click=\"setOffer\"\n                                   v-bind:value=\"item.offerId\" \n                                   v-bind:id=\"'radio' + item.offerId\"\n                                   v-bind:disabled=\"!offers.AVAILABLE[item.offerId]\"\n                                   v-bind:checked=\"currentOfferId == item.offerId\"\n                            >\n                            <label v-bind:for=\"'radio' + item.offerId\">\n                                <div v-bind:class=\"'pack__item' + (offers.AVAILABLE[item.offerId] ? '': ' pack__item--disabled')\">{{item.package}}</div>\n                            </label>\n                        </div>\n                    </div>\n                </li>\n            </ul>\n        </div>\n        </template>\n        <template v-else-if=\"offers.COLORS.length > 0\">\n        <div class=\"specification__colors colors colors--big\">\n            <p class=\"specification__category\">\u0426\u0432\u0435\u0442</p>\n            <ul class=\"colors__list\">\n              <li class=\"colors__item\" v-for=\"item in offers.COLORS\" >\n                    <div v-bind:class=\"'color' + (offers.AVAILABLE[item.offerId]) ? '' : 'color--disabled'\">\n                        <div class=\"radio\">\n                            <input type=\"radio\" class=\"color__input radio__input\" name=\"radio_color\"\n                                   @click=\"setOffer\"\n                                   v-bind:value=\"item.offerId\"\n                                   v-bind:id=\"'radio' + item.offerId\"\n                                   v-bind:disabled=\"!offers.AVAILABLE[item.offerId]\"\n                                   v-bind:checked=\"currentOfferId == item.offerId\"\n                            >\n                            <label v-bind:for=\"'radio' + item.offerId\">\n                                <div v-bind:class=\"'color__item color__item--big color__item--' + item.color\"></div>\n                            </label>\n                        </div>\n                    </div>\n                </li>\n            </ul>\n        </div>\n        </template>\n    "
    };

    function ownKeys$1(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); enumerableOnly && (symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; })), keys.push.apply(keys, symbols); } return keys; }

    function _objectSpread$1(target) { for (var i = 1; i < arguments.length; i++) { var source = null != arguments[i] ? arguments[i] : {}; i % 2 ? ownKeys$1(Object(source), !0).forEach(function (key) { babelHelpers.defineProperty(target, key, source[key]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)) : ownKeys$1(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } return target; }
    var OfferArticle = {
      data: function data() {
        return {};
      },
      computed: _objectSpread$1({}, ui_vue3_pinia.mapState(detailOfferStore, ['offers', 'currentOfferId', 'article'])),
      setup: function setup() {
        var store = detailOfferStore();
        return {
          store: store
        };
      },
      // language=Vue
      template: "\n        <p class=\"specification__article\">\u0410\u0440\u0442. {{article}}</p>\n    "
    };

    function ownKeys$2(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); enumerableOnly && (symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; })), keys.push.apply(keys, symbols); } return keys; }

    function _objectSpread$2(target) { for (var i = 1; i < arguments.length; i++) { var source = null != arguments[i] ? arguments[i] : {}; i % 2 ? ownKeys$2(Object(source), !0).forEach(function (key) { babelHelpers.defineProperty(target, key, source[key]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)) : ownKeys$2(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } return target; }
    var SelectOfferMobile = {
      data: function data() {
        return {};
      },
      setup: function setup() {
        var store = detailOfferStore();
        var offers = store.getOffers();
        return {
          store: store,
          offers: offers
        };
      },
      computed: _objectSpread$2({}, ui_vue3_pinia.mapState(detailOfferStore, ['offers', 'currentOfferId'])),
      methods: {
        setOffer: function setOffer(event) {
          console.log(event);

          if (this.store.checkAvailable(event.target.value)) {
            this.store.setOffer(event.target.value);
          }
        }
      },
      // language=Vue
      template: "\n        <!-- \u0411\u043B\u043E\u043A \u0441\u0435\u043B\u0435\u043A\u0442\u0430 \u0444\u0430\u0441\u0441\u043E\u0432\u043A\u0438 \u043C\u0430\u043B\u044B\u0439 \u0432\u0430\u0440\u0438\u0430\u043D\u0442-->\n        <template v-if=\"offers.PACKAGINGS.length > 0\">\n            <div class=\"cart__packs\">\n                <p class=\"specification__category\">\u0424\u0430\u0441\u043E\u0432\u043A\u0430</p>\n                <div class=\"select select--mini\" data-select  >\n                    <select class=\"select__control\"  name=\"select1m\" data-select-control data-placeholder=\"\u0412\u044B\u0431\u0435\u0440\u0438\u0442\u0435 \u0444\u0430\u0441\u043E\u0432\u043A\u0443\" data-option >\n                        <option><!-- \u043F\u0443\u0441\u0442\u043E\u0439 option \u0434\u043B\u044F placeholder --></option>\n                        <option v-for=\"(item) in offers.PACKAGINGS\"\n                                v-bind:value=\"item.offerId\"\n                                v-bind:disabled=\"!offers.AVAILABLE[item.offerId]\"\n                                v-bind:data-option-after=\"'<span class=&quot;stock ' + (offers.AVAILABLE[item.offerId] ? 'stock--yes' : '') + '&quot;>' +  (!offers.AVAILABLE[item.offerId] ? '\u043D\u0435\u0442 ' : '') + '\u0432 \u043D\u0430\u043B\u0438\u0447\u0438\u0438</span>'\"\n                                v-on:click=\"setOffer\"\n                        >\n                            <span >{{item.package}}</span>\n                        </option>\n                    </select>\n                </div>\n            </div>\n        </template>\n        <template v-else-if=\"offers.COLORS.length > 0\">\n            <div class=\"cart__colors\">\n                <p class=\"specification__category\">\u0426\u0432\u0435\u0442</p>\n                <div class=\"select select--middle select--simple\" data-select>\n                    <select class=\"select__control\" name=\"select1p\" data-select-control data-placeholder=\"\u0412\u044B\u0431\u0435\u0440\u0438\u0442\u0435 \u0446\u0432\u0435\u0442\" data-option>\n                        <option><!-- \u043F\u0443\u0441\u0442\u043E\u0439 option \u0434\u043B\u044F placeholder --></option>\n                        <option v-for=\"item in offers.COLORS\"\n                                v-on:click=\"setOffer\"\n                                v-bind:value=\"item.offerId\"\n                                v-bind:disabled=\"!offers.AVAILABLE[item.offerId]\"\n                                v-bind:data-option-before=\"'<span class=&quot;color color--option&quot;><span class=&quot;color__item color__item--medium color__item--' + item.color + '&quot;></span></span>'\"\n                                v-bind:data-option-after=\"'<span class=&quot;stock ' + (offers.AVAILABLE[item.offerId] ? 'stock--yes' : '') + '&quot;>' +  (!offers.AVAILABLE[item.offerId] ? '\u043D\u0435\u0442 ' : '') + '\u0432 \u043D\u0430\u043B\u0438\u0447\u0438\u0438</span>'\">\n                            {{offers.COLOR_NAMES[item.color]}}\n                        </option>\n                    </select>\n                </div>\n            </div>\n        </template>\n        <!-- \u0411\u043B\u043E\u043A \u0441\u0435\u043B\u0435\u043A\u0442\u0430 \u0444\u0430\u0441\u0441\u043E\u0432\u043A\u0438 \u043C\u0430\u043B\u044B\u0439 \u0432\u0430\u0440\u0438\u0430\u043D\u0442-->\n    "
    };

    function ownKeys$3(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); enumerableOnly && (symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; })), keys.push.apply(keys, symbols); } return keys; }

    function _objectSpread$3(target) { for (var i = 1; i < arguments.length; i++) { var source = null != arguments[i] ? arguments[i] : {}; i % 2 ? ownKeys$3(Object(source), !0).forEach(function (key) { babelHelpers.defineProperty(target, key, source[key]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)) : ownKeys$3(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } return target; }
    var OfferImage = {
      data: function data() {
        return {};
      },
      computed: _objectSpread$3({}, ui_vue3_pinia.mapState(detailOfferStore, ['offers', 'currentOfferId', 'images'])),
      setup: function setup() {
        var store = detailOfferStore();
        var offers = store.getOffers();
        return {
          store: store,
          offers: offers
        };
      },
      updated: function updated() {// TODO ?
      },
      // language=Vue
      template: " \n            <div class=\"detail__card-slider slider slider--product\" data-carousel=\"product\">\n            <div class=\"swiper-container\" data-carousel-container>\n                <div class=\"swiper-wrapper\" data-card-favourite-block>\n                    <template v-if=\"images.length > 0\">\n                        <div v-for=\"(image) in images\" class=\"swiper-slide slider__slide\">\n                            <article class=\"product-card product-card--slide box box--circle box--hovering box--border\">\n                                <div class=\"product-card__header\">\n                                    <div v-if=\"offers.DISCOUNT_LABELS[currentOfferId].NAME\"\n                                         v-bind:class=\"'product-card__label label label--' +  offers.DISCOUNT_LABELS[currentOfferId].COLOR\">\n                                      {{ offers.DISCOUNT_LABELS[currentOfferId].NAME}}\n                                      </div>\n                                    <div class=\"product-card__favourite\">\n                                        <button type=\"button\" class=\"product-card__favourite-button button button--ordinary button--iconed button--simple button--big button--red\" data-card-favourite=\"heart\">\n                                            <span class=\"button__icon button__icon--big\">\n                                                <svg class=\"icon icon--heart\">\n                                                    <use xlink:href=\"/local/templates/.default/images/icons/sprite.svg#icon-heart\" data-card-favourite-icon></use>\n                                                </svg>\n                                            </span>\n                                        </button>\n                                    </div>\n\n                                    <div class=\"product-card__wrapper\">\n                                        <div class=\"product-card__image box box--circle\">\n                                            <div class=\"product-card__box\">\n                                                <img v-bind:src=\"image.SRC\" v-bind:alt=\"offers.TITLE\" class=\"product-card__pic\">\n                                            </div>\n                                        </div>\n                                    </div>\n                                </div>\n                            </article>\n                        </div>\n                    </template>\n                    <template v-else>\n                        <div class=\"swiper-slide slider__slide\">\n                            <article class=\"product-card product-card--slide box box--circle box--hovering box--border\">\n                                <div class=\"product-card__header\">\n                                  <div v-if=\"offers.DISCOUNT_LABELS[currentOfferId].NAME\"\n                                       v-bind:class=\"'product-card__label label label--' +  offers.DISCOUNT_LABELS[currentOfferId].COLOR\">\n                                    {{ offers.DISCOUNT_LABELS[currentOfferId].NAME}}\n                                  </div>\n    \n                                    <div class=\"product-card__favourite\">\n                                        <button type=\"button\" class=\"product-card__favourite-button button button--ordinary button--iconed button--simple button--big button--red\" data-card-favourite=\"heart\">\n                                            <span class=\"button__icon button__icon--big\">\n                                                <svg class=\"icon icon--heart\">\n                                                    <use xlink:href=\"/local/templates/.default/images/icons/sprite.svg#icon-heart\" data-card-favourite-icon></use>\n                                                </svg>\n                                            </span>\n                                        </button>\n                                    </div>\n    \n                                    <div class=\"product-card__wrapper\">\n                                        <div class=\"product-card__image box box--circle\">\n                                            <div class=\"product-card__box\">\n                                                <img src=\"https://fakeimg.pl/366x312/\" v-bind:alt=\"offers.TITLE\" class=\"product-card__pic\">\n                                            </div>\n                                        </div>\n                                    </div>\n                                </div>\n                            </article>\n                        </div>\n                    </template>\n                    \n                    <div v-if=\"offers.PRODUCT_VIDEO\" class=\"swiper-slide slider__slide\">\n                        <article class=\"product-card product-card--slide box box--circle box--hovering box--border\">\n                            <div class=\"product-card__header\">\n                                <div v-if=\"offers.DISCOUNT_LABELS[currentOfferId].NAME\"\n                                  v-bind:class=\"'product-card__label label label--' +  offers.DISCOUNT_LABELS[currentOfferId].COLOR\">\n                                  {{ offers.DISCOUNT_LABELS[currentOfferId].NAME}}\n                                </div>\n                                <div class=\"product-card__favourite\">\n                                    <button type=\"button\" class=\"product-card__favourite-button button button--ordinary button--iconed button--simple button--big button--red\" data-card-favourite=\"heart\">\n                                    <span class=\"button__icon button__icon--big\">\n                                        <svg class=\"icon icon--heart\">\n                                            <use xlink:href=\"/local/templates/.default/images/icons/sprite.svg#icon-heart\" data-card-favourite-icon></use>\n                                        </svg>\n                                    </span>\n                                    </button>\n                                </div>\n\n                                <div class=\"product-card__wrapper\">\n                                    <div class=\"product-card__image box box--circle\">\n                                        <div class=\"product-card__box\">\n                                            <video v-bind:src=\"offers.PRODUCT_VIDEO.path\" poster=\"/local/templates/.default/images/detail-slide.png\" controls class=\"product-card__pic\"></video>\n                                        </div>\n                                    </div>\n                                </div>\n                            </div>\n                        </article>\n                    </div>\n                </div>\n\n                <div class=\"slider__buttons\">\n                    <div class=\"slider__buttons-item swiper-button-prev\" data-carousel-prev>\n                        <button type=\"button\" class=\"slider__button slider__button--prev button button--circular button--small button--mixed button--gray-red button--shadow\">\n                            <span class=\"button__icon\">\n                                <svg class=\"icon icon--basket\">\n                                    <use xlink:href=\"/local/templates/.default/images/icons/sprite.svg#icon-angle-left\"></use>\n                                </svg>\n                            </span>\n                        </button>\n                    </div>\n\n                    <div class=\"swiper-pagination pagination pagination--image\" data-carousel-pagination></div>\n\n                    <div class=\"slider__buttons-item swiper-button-next\" data-carousel-next>\n                        <button type=\"button\" class=\"slider__button slider__button--next button button--circular button--small button--mixed button--gray-red button--shadow\">\n                            <span class=\"button__icon\">\n                                <svg class=\"icon icon--basket\">\n                                    <use xlink:href=\"/local/templates/.default/images/icons/sprite.svg#icon-angle-left\"></use>\n                                </svg>\n                            </span>\n                        </button>\n                    </div>\n                </div>\n\n            </div>\n        </div>\n    "
    };

    var applicationsToRender = {
      '#offerSelect': SelectOffer,
      '#offerArticle': OfferArticle,
      '#offerSelectMobile': SelectOfferMobile,
      '#imageSlider': OfferImage
    };

    function _classPrivateFieldInitSpec(obj, privateMap, value) { _checkPrivateRedeclaration(obj, privateMap); privateMap.set(obj, value); }

    function _checkPrivateRedeclaration(obj, privateCollection) { if (privateCollection.has(obj)) { throw new TypeError("Cannot initialize the same private elements twice on an object"); } }

    var _store = /*#__PURE__*/new WeakMap();

    var offerLoader = /*#__PURE__*/function () {
      function offerLoader() {
        babelHelpers.classCallCheck(this, offerLoader);

        _classPrivateFieldInitSpec(this, _store, {
          writable: true,
          value: void 0
        });

        babelHelpers.defineProperty(this, "data", []);
        babelHelpers.classPrivateFieldSet(this, _store, ui_vue3_pinia.createPinia());
      }

      babelHelpers.createClass(offerLoader, [{
        key: "start",
        value: function start() {
          detailOfferStore().setStore(this.data);
          detailOfferStore().setOffer(this.data.OFFER_FIRST);

          for (var root in applicationsToRender) {
            var rootElement = document.querySelector(root);

            if (rootElement) {
              var app = ui_vue3.BitrixVue.createApp(applicationsToRender[root]);
              app.use(babelHelpers.classPrivateFieldGet(this, _store));
              app.mount(root);
            }
          }
        }
      }, {
        key: "loadData",
        value: function loadData(data) {
          console.log(data);
          this.data = data;
        }
      }, {
        key: "initStorageBeforeStartApplication",
        value: function initStorageBeforeStartApplication() {
          ui_vue3_pinia.setActivePinia(babelHelpers.classPrivateFieldGet(this, _store));
        }
      }]);
      return offerLoader;
    }();

    exports.offerLoader = offerLoader;

}((this.Zolo = this.Zolo || {}),BX.Vue3,BX.Vue3.Pinia));
//# sourceMappingURL=offerLoader.bundle.js.map

(function (window){
	'use strict';

	if (window.CatalogItemHelperZolo) return;

	window.CatalogItemHelperZolo = new function ()
	{
		this.products = [];

		/**
		 * Выполнение подготовительных работ для дальнейшего взаимодействия с карточками товаров
		 * @param isLazyLoad
		 */
		this.startActions = function (isLazyLoad = false) {

			$('[data-card-favourite]').on('click', function () {
				const offerId = $(this).data('offer-id');
				if ($(this).data('card-favourite') === 'heart') {
					window.stores.wishlistStore.add(offerId);
				} else {
					window.stores.wishlistStore.remove(offerId);
				}
			});

			$('[data-quantity-button], [data-quantity-increase]').on('click', function () {
				const quantity = $(this).closest('[data-quantity]');
				const offerId = quantity.data('offer-id');
				const product = window.CatalogItemHelperZolo.products[quantity.data('product-id')];
				window.stores.basketStore.increaseItem(
					offerId,
					product.container.find('a.product-card__link').attr('href'),
					product.offers[offerId].nonreturnable
				);
			});

			$('[data-quantity-decrease]').on('click', function () {
				window.stores.basketStore.decreaseItem($(this).closest('[data-quantity]').data('offer-id'));
			});

			if (isLazyLoad === true) {
				window.CatalogItemHelperZolo.setContainers(true);
			} else {
				window.CatalogItemHelperZolo.setContainers();
			}

			window.CatalogItemHelperZolo.firstRefresh();
		}

		this.addProduct = function (item) {
			var itemContainer = $('#' + item.id);
			if (typeof item.id != 'undefined' && item.id !== null) {
				this.products[item.id] = item;
			}
		};

		/**
		 * Привязывает к каждому товару его контейнер (карточку)
		 * @param initSelects Нужно ли инициализировать селекты (с использованием select2)
		 */
		this.setContainers = function (initSelects = false) {
			for (let key in this.products) {

				if (typeof this.products[key].container != 'undefined') {
					continue;
				}

				let itemContainer = $('#' + key);
				if (itemContainer.length > 0) {
					this.products[key].container = itemContainer;

					if (initSelects === true) {
						window.initSelect(itemContainer);
					}
				}
			}
		};

		/**
		 * Обновляет карточку товара, с учетом выбранного ТП
		 * @param id ID контейнера карточки
		 * @param obj Элемент (input, select), в котором было изменение
		 * @param isMobile Изменение в мобильной верстке или нет
		 */
		this.refreshProductCard = function (id, obj, isMobile = false) {
			// Если у элемента есть флаг, запрещающий обновление параметров ТП - ничего не делаем
			if (typeof $(obj).attr('data-not-update-offers') != 'undefined') {
				return;
			}
			// Получим торговое предложение по выбранным параметрам в карточке товара
			let offerId = this.getSelectedOffer(id, isMobile);
			// Обновим отображение параметров торговых предложений
			let altOfferId = this.refreshOffersProps(id, offerId);
			if (offerId <= 0 && typeof altOfferId != 'undefined' && altOfferId !== null) {
				offerId = altOfferId;
			}
			// Обновим отображение прочих параметров
			if (offerId > 0) {
				let offer = this.products[id].offers[offerId];
				// Артикул
				$('#' + this.products[id].elementsIds.article).html(offer.article);
				// Атрибут акционного товара
				if (offer.label === 'SEASONAL_OFFER') {
					$('#' + this.products[id].elementsIds.label + '_LIMITED_OFFER').hide();
					$('#' + this.products[id].elementsIds.label + '_SEASONAL_OFFER').show();
				} else if (offer.label === 'LIMITED_OFFER') {
					$('#' + this.products[id].elementsIds.label + '_SEASONAL_OFFER').hide();
					$('#' + this.products[id].elementsIds.label + '_LIMITED_OFFER').show();
				} else {
					$('#' + this.products[id].elementsIds.label + '_LIMITED_OFFER').hide();
					$('#' + this.products[id].elementsIds.label + '_SEASONAL_OFFER').hide();
				}
				// Отображение цен
				const mainPrice = $(`#${this.products[id].elementsIds.mainPrice}`);
				mainPrice.html(`${this.formatNumber(offer.mainPrice)} ₽`);
				offer.mainPrice ? mainPrice.show() : mainPrice.hide();
				$('#' + this.products[id].elementsIds.totalPrice).html(`${this.formatNumber(offer.totalPrice)} ₽`);
				// Отображение баллов
				const bonuses = $(`#${this.products[id].elementsIds.bonuses}`);
				bonuses.html(`${this.formatNumber(offer.bonuses)} ББ`);
				offer.bonuses > 0 ? bonuses.show() : bonuses.hide();
			}
		};

		this.formatNumber = function(number, useDecimals = false) {
			if (!number) return 0;
			let result = parseInt(number).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$& ');
			return useDecimals ? result : result.substring(0, result.length - 3);
		}

		/**
		 * Начальное обновление всех карточек товаров
		 */
		this.firstRefresh = function () {
			for (let id in this.products) {
				if (typeof this.products[id].elementsIds.props == 'undefined' || this.products[id].firstlyRefreshed) {
					continue;
				}
				
				for (let propCode in this.products[id].elementsIds.props) {
					if (typeof this.products[id].elementsIds.props[propCode].desktop.name == 'undefined' || this.products[id].elementsIds.props[propCode].desktop.name === null) {
						continue;
					}
					let element = this.products[id].container.find('[name=' + this.products[id].elementsIds.props[propCode].desktop.name + ']');
					if (element.length > 0) {
						element.eq(0).trigger('change');
						break;
					}
				}
				this.products[id].firstlyRefreshed = true;
			}
		}

		/**
		 * Определение выбранного ТП и обновление параметров торговых предложений в карточке товара
		 * @param id
		 * @param offerId
		 * @returns {string}
		 */
		this.refreshOffersProps = function (id, offerId) {
			let visibilityTree = [];

			// Если нет контейнера в DOM - ничего не делаем
			if (typeof this.products[id].container == 'undefined' || this.products[id].container === null) {
				return;
			}

			// Если конкретное ТП не определено - выбираем первое из перечня ТП
			if (typeof offerId == 'undefined' || offerId === null || offerId === 0) {
				let keys = Object.keys(this.products[id].offers);
				if (keys.length > 0) {
					offerId = keys[0];
				} else { // Если и в ТП нет ничего - то ничего не делаем
					return;
				}
			}

			let offers = this.products[id].offers;
			let offer = this.products[id].offers[offerId];

			let propCounter = 0;
			// Перебираем параметры из заданных для текущего ТП
			for (let propCode in offer.tree) {
				if (typeof offer.tree[propCode] == 'undefined' || offer.tree[propCode] === null) {
					continue;
				}
				if (propCounter === 0) {
					// Для первого по порядку параметра оставляем все значения видимыми
					for (let offerId in offers) {
						if (typeof visibilityTree[propCode] == 'undefined' || visibilityTree[propCode] === null) {
							visibilityTree[propCode] = [];
						}
						visibilityTree[propCode][offers[offerId].tree[propCode]] = true;
					}
					propCounter += 1;
				}
				// Ищем среди перечня ТП такие, у которых идентичное значение параметра
				for (let offerId in offers) {
					if (offers[offerId].tree[propCode] === offer.tree[propCode]) {
						// Перебираем значения данного ТП, добавляем в перечень для отображения
						for (let propCode2 in offers[offerId].tree) {
							if (typeof offers[offerId].tree[propCode2] == 'undefined' || offers[offerId].tree[propCode2] === null) {
								continue;
							}
							if (typeof visibilityTree[propCode2] == 'undefined' || visibilityTree[propCode2] === null) {
								visibilityTree[propCode2] = [];
							}
							visibilityTree[propCode2][offers[offerId].tree[propCode2]] = true;
						}
					}
				}
				// Проверяем доступность ТП с указанным значением параметра
				for (let propCode in visibilityTree) {
					for (let propValue in visibilityTree[propCode]) {
						let isAvailable = false;

						for (let offerId in offers) {

							if (offers[offerId].available && offers[offerId].tree[propCode] == propValue) {
								isAvailable = true;
								break;
							}
						}

						if (! isAvailable) {
							visibilityTree[propCode][propValue] = undefined;
						}

					}
				}
			}

			// Применяем изменения в видимости значений параметров ТП
			for (let propCode in this.products[id].elementsIds.props) {

				if (typeof visibilityTree[propCode] == 'undefined') {
					continue;
				}

				this.refreshBasketCount(id, offer, this.products[id].container);
				this.refreshWishlistButton(id, offer, this.products[id].container, offer.inWishlist);

				// Переключаем видимость в соответствии с перечнем
				if (typeof this.products[id].elementsIds.props[propCode].desktop != 'undefined') {

					if (this.products[id].elementsIds.props[propCode].desktop.type === 'select') {

						let select = this.products[id].container.find('[name=' + this.products[id].elementsIds.props[propCode].desktop.name + ']');
						this.refreshVisibilityForSelect(id, offer, propCode, visibilityTree, select);

					} else if (this.products[id].elementsIds.props[propCode].desktop.type === 'radio') {

						let inputs = this.products[id].container.find('input[name=' + this.products[id].elementsIds.props[propCode].desktop.name + ']');
						this.refreshVisibilityForRadioButtons(id, offer, propCode, visibilityTree, inputs);

					}
				}
				if (typeof this.products[id].elementsIds.props[propCode].mobile != 'undefined') {

					if (this.products[id].elementsIds.props[propCode].mobile.type === 'select') {

						let select = this.products[id].container.find('[name=' + this.products[id].elementsIds.props[propCode].mobile.name + ']');
						this.refreshVisibilityForSelect(id, offer, propCode, visibilityTree, select);

					} else if (this.products[id].elementsIds.props[propCode].mobile.type === 'radio') {

						let inputs = this.products[id].container.find('input[name=' + this.products[id].elementsIds.props[propCode].mobile.name + ']');
						this.refreshVisibilityForRadioButtons(id, offer, propCode, visibilityTree, inputs);

					}
				}

			}

			return offerId;
		}

		this.refreshWishlistButton = function (id, offer, container, inWishlist) {
			const button = container.find('[data-card-favourite]');
			if (button && button.length) {
				const value = inWishlist ? 'heart-fill' : 'heart';
				button.find('[data-card-favourite-icon]').attr('xlink:href', `/local/templates/.default/images/icons/sprite.svg#icon-${value}`);
				button.data('card-favourite', value);
				button.data('offer-id', offer.id);
			}
		}

		this.refreshBasketCount = async function (id, offer, container) {
			const basketItem = await window.stores.basketStore.getItem(offer.id);
			const basketCount = parseInt(basketItem?.QUANTITY ?? 0);
			const quantity = container.find('[data-quantity]');
			const increase = container.find('[data-quantity-increase]');
			const sum = quantity.find('[data-quantity-sum]');
			quantity.data('product-id', id);
			quantity.data('offer-id', offer.id);
			sum.data('quantity-sum', basketCount);
			sum.data('quantity-max', offer.quantity);
			if (basketCount >= offer.quantity) {
				increase.prop('disabled', true);
				increase.addClass('button--disabled');
			} else {
				increase.prop('disabled', false);
				increase.removeClass('button--disabled');
			}
			sum.html(basketCount);
			if (basketCount > 0) {
				quantity.addClass('quantity--active');
			} else {
				quantity.removeClass('quantity--active');
			}
		}

		/**
		 * Переключение видимости параметров ТП в селекте
		 * @param id
		 * @param offer
		 * @param propCode
		 * @param visibilityTree
		 * @param select
		 */
		this.refreshVisibilityForSelect = function (id, offer, propCode, visibilityTree, select) {

			select.children('option').each(function(index) {

				let value = $(this).val();
				// Обновим видимость элементов списка
				if (typeof value == 'undefined' || value === null) {
					$(this).prop('disabled', 'disabled');
				} else {
					if (typeof visibilityTree[propCode][value] == 'undefined') {
						$(this).prop('disabled', 'disabled');
					} else {
						$(this).prop('disabled', false);
					}
				}
				// Переключим выбранный элемент, если требуется
				if (typeof visibilityTree[propCode][value] != 'undefined' && value == offer.tree[propCode]) {
					select.val(value);
					select.attr('data-not-update-offers', 'Y');
					select.trigger('change.select2');
					select.removeAttr('data-not-update-offers');
				}
			});
		}

		/**
		 * Переключение видимости параметров ТП для радиокнопок
		 * @param id
		 * @param offer
		 * @param propCode
		 * @param visibilityTree
		 * @param inputs
		 */
		this.refreshVisibilityForRadioButtons = function (id, offer, propCode, visibilityTree, inputs) {

			let thisObject = this;

			inputs.each(function(index) {

				let value = $(this).val();


				// Обновим видимость элементов списка
				if (typeof value == 'undefined' || value === null) {
					thisObject.disableRadioButton($(this));
				} else {
					if (typeof visibilityTree[propCode][value] == 'undefined') {
						thisObject.disableRadioButton($(this));
					} else {
						thisObject.enableRadioButton($(this));
					}
				}

				// Переключим выбранный элемент, если требуется
				if (typeof visibilityTree[propCode][value] == 'undefined' && $(this).is(":checked")) {
					$(this).prop('checked', false);
				}
				if (typeof visibilityTree[propCode][value] != 'undefined' && ! $(this).is(":checked") && value == offer.tree[propCode]) {
					$(this).prop('checked', 'checked');
				}
			});
		}

		/**
		 * "Включает" радиокнопку, выполняя необходимые изменения в смежных элементах
		 * @param obj объект JQuery
		 */
		this.enableRadioButton = function (obj) {
			obj.prop('disabled', false);

			// Обновляем класс для радиокнопки выбора цвета
			let colorScope = obj.closest('.color');
			if (colorScope.length > 0 && colorScope.hasClass('color--disabled')) {
				colorScope.removeClass('color--disabled');
				return;
			}
			// Обновляем параметры для радиокнопки выбора фасовки
			let packScope = obj.closest('.pack');

			if (packScope.length > 0 && packScope.attr('data-tippy-content')) {
				packScope.removeAttr('data-tippy-content');
				let packDiv = obj.closest().find('.pack__item');
				if (packDiv.length > 0 && packDiv.hasClass('pack__item--disabled')) {
					packDiv.removeClass('pack__item--disabled');
				}
				return;
			}
		}

		/**
		 * "Выключает" радиокнопку, выполняя необходимые изменения в смежных элементах
		 * @param obj объект JQuery
		 */
		this.disableRadioButton = function (obj) {
			obj.prop('disabled', 'disabled');

			// Обновляем класс для радиокнопки выбора цвета
			let colorScope = obj.closest('.color');
			if (colorScope.length > 0 && ! colorScope.hasClass('color--disabled')) {
				colorScope.addClass('color--disabled');
				return;
			}
			// Обновляем параметры для радиокнопки выбора фасовки
			let packScope = obj.closest('.pack');
			if (packScope.length > 0 && ! packScope.attr('data-tippy-content')) {
				packScope.attr('data-tippy-content', 'нет в наличии');
				let packDiv = obj.parent().find('.pack__item');
				if (packDiv.length > 0 && ! packDiv.hasClass('pack__item--disabled')) {
					packDiv.addClass('pack__item--disabled');
				}
                tippy('[data-tippy-content]', {
                    theme: 'light',
                    arrow: false,
                    appendTo: 'parent',
                });

				return;
			}
		}

		/**
		 * Получение торгового предложения по полям карточки товара
		 * @param id ID контейнера товара
		 * @param isMobile Флаг, указывающий, что нужно проверять мобильную версию поля ввода
		 * @returns {number}
		 */
		this.getSelectedOffer = function (id, isMobile = false) {
			// Получаем выбранные значения из полей ввода
			let result = [];
			let offerId = 0;

			if (typeof this.products[id].container != 'undefined' && this.products[id].container !== null) {
				for (let propCode in this.products[id].elementsIds.props) {

					let input = undefined;
					if (isMobile && typeof this.products[id].elementsIds.props[propCode].mobile != 'undefined') {
						if (this.products[id].elementsIds.props[propCode].mobile.type === 'select') {
							input = this.products[id].container.find('[name=' + this.products[id].elementsIds.props[propCode].mobile.name + ']');
						} else if (this.products[id].elementsIds.props[propCode].mobile.type === 'radio') {
							input = this.products[id].container.find('input[name=' + this.products[id].elementsIds.props[propCode].mobile.name + ']:checked');
						}

						result[propCode] = input.val();
					} else {
						if (this.products[id].elementsIds.props[propCode].desktop.type === 'select') {
							input = this.products[id].container.find('[name=' + this.products[id].elementsIds.props[propCode].desktop.name + ']');
						} else if (this.products[id].elementsIds.props[propCode].desktop.type === 'radio') {
							input = this.products[id].container.find('input[name=' + this.products[id].elementsIds.props[propCode].desktop.name + ']:checked');
						}

						result[propCode] = input.val();
					}
				}
			}

			let totalCount = Object.keys(result).length;
			let count = 1;
			// Ищем подходящее торговое предложение, постепенно увеличивая количество совпадающих параметров
			while (count <= totalCount) {
				let oId = this.searchExistingOffer(id, result, count);
				if (oId === 0) {
					break;
				}
				offerId = oId; // Записывем успешно найденное ТП
				count += 1;
			}
			return offerId;
		};

		/**
		 * Ищет подходящие торговые предложения, проверя equalPropsCount параметров
		 * @param id ID контейнера товара
		 * @param result Перечень параметров со значениями, используемый для поиска
		 * @param equalPropsCount Количество параметров, которые нужно проверить
		 * @returns {number} Торговое предложение, подходящее под заданные параметры (или 0, если подходящее ТП не найдено)
		 */
		this.searchExistingOffer = function (id, result, equalPropsCount) {
			let resultOfferId = 0;

			// Ищем торговые предложения по N-му числу совпадающих параметров
			for (let offerId in this.products[id].offers) {

				let checkedLimit = 0; // Счетчик проверенных параметров
				let count = 0; // Счетчик совпавших параметров

				// Перебираем параметры ТП
				for (let propCode in this.products[id].offers[offerId].tree) {
					if (String(result[propCode]) === String(this.products[id].offers[offerId].tree[propCode])) {
						count += 1;
					}
					checkedLimit += 1;
					// Если проверено N параметров - прерываем проверку
					if (checkedLimit >= equalPropsCount) {
						break
					}
				}

				// Если найдено ТП, совпадающее по выбранным параметрам - прерываем проверку
				if (count === equalPropsCount) {
					resultOfferId = parseInt(offerId);
					break;
				}
			}
			return resultOfferId;
		}
	};

	// После загрузки страницы выполняем подготовительные действия
	$(document).ready(function () {
		window.CatalogItemHelperZolo.startActions();
	});

})(window);

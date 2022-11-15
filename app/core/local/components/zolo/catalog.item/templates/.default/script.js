(function (window){
	'use strict';

	if (window.CatalogItemHelperZolo) return;

	window.CatalogItemHelperZolo = new function ()
	{
		this.products = [];

		this.addProduct = function (item) {
			var itemContainer = $('#' + item.id);
			if (typeof item.id != 'undefined' && item.id !== null) {
				this.products[item.id] = item;
			}
		};
		
		this.setContainers = function () {
			for (let key in this.products) {
				let itemContainer = $('#' + key);
				if (itemContainer.length > 0) {
					this.products[key].container = itemContainer;
				}
			}
		};

		this.refreshProductCard = function (id, isMobile = false) {
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
				$('#' + this.products[id].elementsIds.mainPrice).html(offer.mainPrice);
				if (offer.hasDiscount) {
					$('#' + this.products[id].elementsIds.mainPrice).show();
				} else {
					$('#' + this.products[id].elementsIds.mainPrice).hide();
				}
				$('#' + this.products[id].elementsIds.totalPrice).html(offer.totalPrice);
				// Отображение баллов
				$('#' + this.products[id].elementsIds.bonuses).html(offer.bonuses);
				if (offer.showBonuses) {
					$('#' + this.products[id].elementsIds.bonuses).show();
				} else {
					$('#' + this.products[id].elementsIds.bonuses).hide();
				}
			}
		};

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
			}

			// Применяем изменения в видимости значений параметров ТП
			for (let propCode in this.products[id].elementsIds.props) {

				if (typeof visibilityTree[propCode] == 'undefined') {
					continue;
				}

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
					/*select.select2({
						'selectControl' : false,
						'option' : false,
					});*/
				}
			});
		}

		this.refreshVisibilityForRadioButtons = function (id, offer, propCode, visibilityTree, inputs) {

			inputs.each(function(index) {

				let value = $(this).val();
				// Обновим видимость элементов списка
				if (typeof value == 'undefined' || value === null) {
					$(this).parent().hide();
				} else {
					if (typeof visibilityTree[propCode][value] == 'undefined') {
						$(this).parent().hide();
					} else {
						$(this).parent().show();
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

		this.getSelectedOffer = function (id, isMobile = false) {
			// Получаем выбранные значения из полей ввода
			let result = [];
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
			// Ищем среди торговых предложений одно, соответствующее выбранным параметрам
			for (let offerId in this.products[id].offers) {

				let count = 0;
				let totalCount = Object.keys(this.products[id].offers[offerId].tree).length;

				for (let propCode in this.products[id].offers[offerId].tree) {
					if (String(result[propCode]) === String(this.products[id].offers[offerId].tree[propCode])) {
						count += 1;
					}
				}

				if (count === totalCount) {
					return parseInt(offerId);
				}
			}
			// Находим торговое предложение, совпадающее по первому параметру
			let propCodes = Object.keys(result);
			for (let offerId in this.products[id].offers) {
				let offerProp = this.products[id].offers[offerId].tree[propCodes[0]];
				if(typeof offerProp == 'undefined' || offerProp === null) {
					return 0;
				}
				if (String(result[propCodes[0]]) === String(offerProp)) {
					return parseInt(offerId);
				}
			}
			return 0;
		};
	};

	$(document).ready(function () {
		window.CatalogItemHelperZolo.setContainers();
	});

})(window);
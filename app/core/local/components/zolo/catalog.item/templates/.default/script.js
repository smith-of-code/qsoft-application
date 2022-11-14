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
			} else { // Если торговое предложение не существует
				// Артикул
				$('#' + this.products[id].elementsIds.article).html('Арт. -');
				// Атрибут акционного товара
				$('#' + this.products[id].elementsIds.label + '_LIMITED_OFFER').hide();
				$('#' + this.products[id].elementsIds.label + '_SEASONAL_OFFER').hide();
				// Отображение цен
				$('#' + this.products[id].elementsIds.mainPrice).hide();
				$('#' + this.products[id].elementsIds.totalPrice).html('Нет в наличии');
				// Отображение баллов
				$('#' + this.products[id].elementsIds.bonuses).hide();
			}
		};

		this.getSelectedOffer = function (id, isMobile = false) {
			// Получаем выбранные значения из полей ввода
			let result = [];
			if (typeof this.products[id].container != 'undefined') {
				for (let propCode in this.products[id].elementsIds.props) {

					let input = undefined;
					if (isMobile && typeof this.products[id].elementsIds.props[propCode]['mobile'] != 'undefined') {
						input = this.products[id].container.find('[name=' + this.products[id].elementsIds.props[propCode]['mobile'] + ']');
						if (input.prop('tagName') == 'SELECT') {
							result[propCode] = input.val();
						} else if (input.prop('tagName') == 'INPUT' && input.prop('type') == 'radio') {
							input = this.products[id].container.find('input[name=' + this.products[id].elementsIds.props[propCode]['mobile'] + ']:checked');
							if (input.length > 0) {
								result[propCode] = input.val();
							}
						}
					} else {
						input = this.products[id].container.find('[name=' + this.products[id].elementsIds.props[propCode]['desktop'] + ']');
						if (input.prop('tagName') == 'SELECT') {
							result[propCode] = input.val();
						} else if (input.prop('tagName') == 'INPUT' && input.prop('type') == 'radio') {
							input = this.products[id].container.find('input[name=' + this.products[id].elementsIds.props[propCode]['desktop'] + ']:checked');
							if (input.length > 0) {
								result[propCode] = input.val();
							}
						}
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
			return 0;
		};
	};

	$(document).ready(function () {
		window.CatalogItemHelperZolo.setContainers();
	});

})(window);
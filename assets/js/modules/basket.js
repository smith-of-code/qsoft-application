import { async } from "regenerator-runtime";

const ELEMENTS_SELECTOR = {
    cart: '[data-basket]',
    list: '[data-basket-list]',
    item: '[data-basket-item]',
    card: '[data-basket-card]',
    item_button_remove: '[data-basket-item-remove]',
    item_button_count: '[data-basket-item-count]',
    item_prices: '[data-item-price]',
    item_base_prices: '[data-base-price]',
    item_bonus: '[data-item-bonuses]',
    
    productTotal: '[data-basket-product-total]',
    nds: '[data-basket-product-nds]',
    amount: '[data-basket-order-amount]',
    economy: '[data-basket-economy]',
    total: '[data-basket-total]',

    bonusBalance: '[data-basket-bonus-balance]',
    bonusInput: '[data-basket-bonus-input]',
    bonusButton: '[data-basket-bonus-accept]',
    bonusOrder: '[data-basket-bonus-order]'
};

export default async function () {
    const iconError = `
    <svg class="icon icon--close">
        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-close-tick-circle"></use>
    </svg>`

    const iconDefault = `
    <svg class="icon icon--arrow">
        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-right-light"></use>
    </svg>`

    const iconRefresh = `
    <svg class="icon icon--refresh">
        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-refresh"></use>
    </svg>
    `

    let errorCard = false;
    let bonusAccept = false;
    let totalBonus = 0;

    $(document).on('click', ELEMENTS_SELECTOR.item_button_remove, checkStatusBasket);

    $(document).on('click', ELEMENTS_SELECTOR.item_button_count, checkStatusBasket);

    $(document).on('click', ELEMENTS_SELECTOR.bonusButton, () => {
        if (!bonusAccept && !errorCard) {
            acceptBonus();
        } else if (bonusAccept) {
            resetBonus(); 
        } else if (errorCard) {
            resetInput();
        } else {
            return
        }
    });
       
    $(document).on('input', ELEMENTS_SELECTOR.bonusInput, (e) => {
        const button = $(ELEMENTS_SELECTOR.bonusButton);
        const buttonIcon = button.find('.button__icon');
        const basketCard = $(ELEMENTS_SELECTOR.card);
        const basketCardWrapper = basketCard.find('.basket-card__bonus-wrapper');
        const basketCardError = basketCard.find('.basket-card__bonus-error');
        const input = e.target

        $(input).val($(input).val().replace(/[^0-9]/g, ''));

        if (errorCard) {
            errorCard = false;
            basketCardWrapper.removeClass('basket-card__bonus-wrapper--error');
            button.removeClass('button--red').addClass('button--green');
            basketCardError.hide();
            buttonIcon.html(iconDefault);
        } else if (bonusAccept) {
            bonusAccept = false;
            buttonIcon.html(iconDefault);
            resetBonus();
        }

        button.removeClass('button--dark')
        .addClass('button--green');
    });

    async function checkPriceProduct() {
        const basketList = $(ELEMENTS_SELECTOR.item);
        const itemPrice = basketList.find(ELEMENTS_SELECTOR.item_prices);
        const itemPriceNumber = parseFloat(itemPrice.text().replace(/\s/g,''));
        const itemPriceRounted = Math.round(itemPriceNumber);
        
        basketList.each(function(index, item) {
            const priceDefault = $(item).find('.product-price__item');
            const priceOld = $(item).find('.product-price__item.product-price__item--old');
            const priceSale = $(item).find('.product-price__item.product-price__item--new');
            const priceItem = $(item).find('.card-cart__price-value').text().replace(/\s/g,'')
            const priceItemNumber = parseFloat(priceItem);
            const priceBaseItem = $(item).attr('data-base-price')
            const priceBaseItemNumber = parseFloat(priceBaseItem);
            const amountProduct = $(item)
            .find('.quantity__total-sum')
            .text();

            const currentPrice = Math.round(priceСalc(priceItemNumber, amountProduct));
            const currentPriceDefault = Math.round(priceСalc(priceBaseItemNumber, amountProduct));

            if (priceSale.length > 0) {
                priceSale.html(currentPrice.toLocaleString('ru-RU', { style: 'currency', currency: 'RUB', minimumFractionDigits: 0}))
                priceOld.html(currentPriceDefault.toLocaleString('ru-RU', { style: 'currency', currency: 'RUB', minimumFractionDigits: 0}))
            } else {
                priceDefault.html(currentPrice.toLocaleString('ru-RU', { style: 'currency', currency: 'RUB', minimumFractionDigits: 0}))
            }
        })
    }

    async function checkStatusBasket() {
        await checkPriceProduct();
        const basketList = $(ELEMENTS_SELECTOR.item);
        let lengthBasket = basketList.length;
        let basketAmoutOrder = 0;
        let basketAmoutOrderSale = 0;
        let basketProductTotal = 0;
        let baseketBonusItem = 0;
        
        if (lengthBasket === 0) {
            $(ELEMENTS_SELECTOR.cart)
            .find('.basket__cart-null')
            .show()
        } else {
            $(ELEMENTS_SELECTOR.cart)
            .find('.basket__cart-null')
            .hide()
        }

        basketList.each(function(index, item) {
            const priceDefault = $(item).find('.product-price__item');
            const priceOld = $(item).find('.product-price__item.product-price__item--old');
            const priceSale = $(item).find('.product-price__item.product-price__item--new');
            const bonusItem = $(item).find(ELEMENTS_SELECTOR.item_bonus);
            const bonusValue = parseFloat(bonusItem.attr("data-item-bonuses"));
            const amountProduct = $(item)
            .find('.quantity__total-sum')
            .text();

            let priceProductValue;
            let priceNoDiscountsValue;
            
            if (priceSale.length > 0) {
                priceProductValue = priceSale.text().replace(/\s/g,'').replace(/,/g, '.');
                priceNoDiscountsValue = priceOld.text().replace(/\s/g,'').replace(/,/g, '.');
            } else if (priceOld.length > 0) {
                priceProductValue = priceOld.text().replace(/\s/g,'').replace(/,/g, '.');
                priceNoDiscountsValue = priceOld.text().replace(/\s/g,'').replace(/,/g, '.');
            } else {
                priceProductValue = priceDefault.text().replace(/\s/g,'').replace(/,/g, '.');
                priceNoDiscountsValue  = priceDefault.text().replace(/\s/g,'',).replace(/,/g, '.');
            }
            
            let priceProductNumber = parseFloat(priceProductValue);
            let priceNoDiscounts = parseFloat(priceNoDiscountsValue);
            let currentProductTotal = Number(amountProduct);
            let bonusOrder = calcBonusOrder(bonusValue, currentProductTotal);
            
            basketAmoutOrder += priceNoDiscounts;
            basketProductTotal += currentProductTotal;
            basketAmoutOrderSale += priceProductNumber;
            baseketBonusItem += bonusOrder;
        });

        const basketTotal = Math.round(basketAmoutOrder);
        const basketTotalSale = Math.round(basketAmoutOrderSale);
        const ndsTotal = Math.round(calcNds(basketTotalSale));
        const economyTotal = Math.round(calcEconomy(basketAmoutOrder, basketTotalSale));

        acceptProductTotal(basketProductTotal);
        acceptNds(ndsTotal);
        acceptAmount(basketTotal);
        acceptEconomy(economyTotal);
        acceptTotal(basketTotalSale);
        acceptBonusOrder(baseketBonusItem);

        return basketAmoutOrder
    }
    
    async function acceptBonus() {
        const basketCard = $(ELEMENTS_SELECTOR.card)
        const basketCardWrapper = basketCard.find('.basket-card__bonus-wrapper');
        const basketCardError = basketCard.find('.basket-card__bonus-error');
        const bonusInput = $(ELEMENTS_SELECTOR.bonusInput);
        const bonusInputControl = bonusInput.find('.input__control');
        const bonusInputValue = bonusInputControl.val();
        const bonusInputValueNumber = Number(bonusInputValue);
        const bonusBalanceValue = $(ELEMENTS_SELECTOR.bonusBalance).text().replace(/\s/g,'');
        const bonusBalance = parseInt(bonusBalanceValue);
        const button = $(ELEMENTS_SELECTOR.bonusButton);
        const buttonIcon = button.find('.button__icon');
        const totalBasket = $(ELEMENTS_SELECTOR.total).text().replace(/\s/g,'');
        const percentageBonusPay = calcBonusPercent(bonusInputValueNumber, totalBasket); 

        if (!bonusInputValue) {
          return  
        }

        if (bonusBalance < bonusInputValueNumber) {
            errorCard = true;

            basketCardWrapper.addClass('basket-card__bonus-wrapper--error');
            button.removeClass('button--green').addClass('button--red');

            bonusInput.find('.input__placeholder').html('Недостаточно баллов')
            buttonIcon.html(iconError);
        } else if (percentageBonusPay >= 0.99) {
            errorCard = true;
            
            bonusInput.find('.input__placeholder').html('Некорректное число баллов')
            basketCardWrapper.addClass('basket-card__bonus-wrapper--error');
            button.removeClass('button--green').addClass('button--red');
            
            basketCardError.show();
            buttonIcon.html(iconError);
        } else {
            errorCard = false;
            bonusAccept = true;
        
            const basketAmoutOrder = await checkStatusBasket();
            const priceBasket = calcTotal(totalBasket, bonusInputValueNumber);
            const updateBalanceBonus = calcBonus(bonusBalance, bonusInputValueNumber);
            const updateEconomy = calcEconomy(basketAmoutOrder, priceBasket);
            const updateNds = calcNds(priceBasket);

            acceptNds(updateNds);
            acceptEconomy(updateEconomy);
            acceptTotal(priceBasket);
            acceptBonusBalance(updateBalanceBonus);

            totalBonus += bonusInputValueNumber;

            basketCardWrapper.removeClass('basket-card__bonus-wrapper--error');
            button.removeClass('button--red').addClass('button--green');

            bonusInput.find('.input__placeholder').html('Списано баллов')
            buttonIcon.html(iconRefresh);
            basketCardError.hide();
        }     
    }

    function priceСalc(price, amount) {
        return amount * price;
    }

    function calcNds(total) {
        return Math.round(parseInt(total) * 0.2);
    }

    function calcTotal(currentPrice, bonus) {
        return parseInt(currentPrice) -  parseInt(bonus);
    }

    function calcEconomy(currentPrice, basketTotal) {
        return parseInt(currentPrice) - parseInt(basketTotal);
    }

    function calcBonus(bonusBalance, bonusInput) {
        return parseInt(bonusBalance) - parseInt(bonusInput);
    }

    function calcBonusPercent(bonusInput, totalBalance) {
        return parseInt(bonusInput) / parseInt(totalBalance);
    }

    function calcBonusOrder(bonusValue, basketTotal) {
        return bonusValue * basketTotal;
    }

    async function resetBonus() {
        const bonusInput = $(ELEMENTS_SELECTOR.bonusInput);
        const bonusInputControl = bonusInput.find('.input__control');
        const bonusInputValue = bonusInputControl.val()
        const bonusInputValueNumber = Number(bonusInputValue);
        
        const totalEconomy = $(ELEMENTS_SELECTOR.economy).text().replace(/\s/g,'');
        const totalBonusBalance = $(ELEMENTS_SELECTOR.bonusBalance).text().replace(/\s/g,'');

        const resetBonus = parseInt(totalBonus) + parseInt(totalBonusBalance);
        const resetEconomy = parseInt(totalEconomy) - parseInt(totalEconomy);

        $(ELEMENTS_SELECTOR.bonusBalance).html(resetBonus + ' ББ');
        $(ELEMENTS_SELECTOR.economy).html(resetEconomy + ' ₽');
        bonusInput.find('.input__placeholder').html('Сколько баллов списать')

        await checkStatusBasket();
        const bonusInputValueReset = bonusInputControl.val('');
        totalBonus = 0;
    }

    function resetInput() {
        const bonusInput = $(ELEMENTS_SELECTOR.bonusInput);
        const bonusInputControl = bonusInput.find('.input__control');
        const bonusInputValue = bonusInputControl.val('');

        bonusInput.find('.input__placeholder').html('Сколько баллов списать')
    }

    function acceptNds(total) {
        $(ELEMENTS_SELECTOR.nds).html(total.toLocaleString('ru-RU', { style: 'currency', currency: 'RUB', minimumFractionDigits: 0}));
    }

    function acceptEconomy(total) {
        $(ELEMENTS_SELECTOR.economy).html(total.toLocaleString('ru-RU', { style: 'currency', currency: 'RUB', minimumFractionDigits: 0}));
    }

    function acceptTotal(total) {
        $(ELEMENTS_SELECTOR.total).html(total.toLocaleString('ru-RU', { style: 'currency', currency: 'RUB', minimumFractionDigits: 0}));
    }

    function acceptBonusBalance(total) {
        $(ELEMENTS_SELECTOR.bonusBalance).html(total.toLocaleString('ru-RU', {minimumFractionDigits: 0}) + ' ББ');
    }

    function acceptAmount(total) {
        $(ELEMENTS_SELECTOR.amount).html(total.toLocaleString('ru-RU', { style: 'currency', currency: 'RUB', minimumFractionDigits: 0}));
    }

    function acceptProductTotal(total) {
        $(ELEMENTS_SELECTOR.productTotal).html(total.toLocaleString('ru-RU'));
    }

    function acceptBonusOrder(total) {
        $(ELEMENTS_SELECTOR.bonusOrder).html(total.toLocaleString('ru-RU') + ' ББ');
    }

    await checkStatusBasket();
}
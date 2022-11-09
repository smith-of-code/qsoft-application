const ELEMENTS_SELECTOR = {
    cart: '[data-basket]',
    list: '[data-basket-list]',
    item: '[data-basket-item]',
    card: '[data-basket-card]',
    item_button_remove: '[data-basket-item-remove]',
    item_button_count: '[data-basket-item-count]',
    
    productTotal: '[data-basket-product-total]',
    nds: '[data-basket-product-nds]',
    amount: '[data-basket-order-amount]',
    economy: '[data-basket-economy]',
    total: '[data-basket-total]',

    bonusBalance: '[data-basket-bonus-balance]',
    bonusInput: '[data-basket-bonus-input]',
    bonusButton: '[data-basket-bonus-accept]',
};

export default function () {
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

    checkStatusBasket();

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
       
    $(document).on('input', ELEMENTS_SELECTOR.bonusInput, () => {
        const button = $(ELEMENTS_SELECTOR.bonusButton);
        const buttonIcon = button.find('.button__icon');
        const basketCard = $(ELEMENTS_SELECTOR.card);
        const basketCardWrapper = basketCard.find('.basket-card__bonus-wrapper');
        const basketCardError = basketCard.find('.basket-card__bonus-error');

        if (errorCard) {
            errorCard = false;
            basketCardWrapper.removeClass('basket-card__bonus-wrapper--error');
            button.removeClass('button--red').addClass('button--green');

            basketCardError.hide();
            buttonIcon.html(iconDefault);
        } else if (bonusAccept) {
            bonusAccept = false;
            buttonIcon.html(iconDefault);
        }

        button.removeClass('button--dark')
        .addClass('button--green');
    });

    function checkStatusBasket() {
        const basketList = $(ELEMENTS_SELECTOR.item);
        let lengthBasket = basketList.length;
        let basketAmoutOrder = 0;
        let basketAmoutOrderSale = 0;
        let basketProductTotal = 0;
        
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
            const amountProduct = $(item)
            .find('.quantity__total-sum')
            .text();

            let priceProductValue;
            let priceNoDiscountsValue;
            
            if (priceSale.length > 0) {
                priceProductValue = priceSale.text().replace(/\s/g,'');
                priceNoDiscountsValue = priceOld.text().replace(/\s/g,'');
            } else if (priceOld.length > 0) {
                priceProductValue = priceOld.text().replace(/\s/g,'');
                priceNoDiscountsValue = priceOld.text().replace(/\s/g,'');
            } else {
                priceProductValue = priceDefault.text().replace(/\s/g,'');
                priceNoDiscountsValue  = priceDefault.text().replace(/\s/g,'');
            }
          
            let priceProductNumber = parseInt(priceProductValue);
            let priceNoDiscounts = parseInt(priceNoDiscountsValue);
            const currentPrice = priceСalc(priceProductNumber, amountProduct);
            const currentPriceDefault = priceСalc(priceNoDiscounts, amountProduct);
            const currentProductTotal = Number(amountProduct);
        
            basketAmoutOrder += currentPriceDefault;
            basketProductTotal += currentProductTotal;
            basketAmoutOrderSale += currentPrice;
        });

        const basketTotal = basketAmoutOrder; 
        const basketTotalSale = basketAmoutOrderSale;
        const ndsTotal = calcNds(basketTotalSale);
        const economyTotal = calcEconomy(basketAmoutOrder, basketTotalSale);

        acceptProductTotal(basketProductTotal);
        acceptNds(ndsTotal);
        acceptAmount(basketAmoutOrder);
        acceptEconomy(economyTotal);
        acceptTotal(basketTotalSale);

        return basketAmoutOrder
    }
    
    function acceptBonus() {
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
            basketCardError.show();
            buttonIcon.html(iconError);
        } else if (percentageBonusPay >= 0.99) {
            errorCard = true;
            
            basketCardWrapper.addClass('basket-card__bonus-wrapper--error');
            button.removeClass('button--green').addClass('button--red');
            
            basketCardError.show();
            buttonIcon.html(iconError);
        } else {
            errorCard = false;
            bonusAccept = true;
        
            const basketAmoutOrder = checkStatusBasket();
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
            const bonusInputValue = bonusInputControl.val(totalBonus);
            buttonIcon.html(iconRefresh);
            basketCardError.hide();
        }     
    }

    function priceСalc(price, amount) {
        return parseInt(amount) * parseInt(price);
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

    function resetBonus() {
        const bonusInput = $(ELEMENTS_SELECTOR.bonusInput);
        const bonusInputControl = bonusInput.find('.input__control');
        const bonusInputValue = bonusInputControl.val()
        const bonusInputValueNumber = Number(bonusInputValue);
        
        const totalEconomy = $(ELEMENTS_SELECTOR.economy).text().replace(/\s/g,'');
        const totalBonusBalance = $(ELEMENTS_SELECTOR.bonusBalance).text().replace(/\s/g,'');

        const resetBonus = parseInt(bonusInputValueNumber) + parseInt(totalBonusBalance);
        const resetEconomy = parseInt(totalEconomy) - parseInt(totalEconomy);

        $(ELEMENTS_SELECTOR.bonusBalance).html(resetBonus + ' ББ');
        $(ELEMENTS_SELECTOR.economy).html(resetEconomy + ' ₽');
        bonusInput.find('.input__placeholder').html('Сколько баллов списать')

        checkStatusBasket();
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
        $(ELEMENTS_SELECTOR.nds).html(total.toLocaleString('ru-RU', { style: 'currency', currency: 'RUB' }));
    }

    function acceptEconomy(total) {
        $(ELEMENTS_SELECTOR.economy).html(total.toLocaleString('ru-RU', { style: 'currency', currency: 'RUB' }));
    }

    function acceptTotal(total) {
        $(ELEMENTS_SELECTOR.total).html(total.toLocaleString('ru-RU', { style: 'currency', currency: 'RUB' }));
    }

    function acceptBonusBalance(total) {
        $(ELEMENTS_SELECTOR.bonusBalance).html(total.toLocaleString('ru-RU') + ' ББ');
    }

    function acceptAmount(total) {
        $(ELEMENTS_SELECTOR.amount).html(total.toLocaleString('ru-RU', { style: 'currency', currency: 'RUB' }));
    }

    function acceptProductTotal(total) {
        $(ELEMENTS_SELECTOR.productTotal).html(total.toLocaleString('ru-RU'));
    }

}
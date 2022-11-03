const ELEMENTS_SELECTOR = {
    cart: '[data-basket]',
    list: '[data-basket-list]',
    item: '[data-basket-item]',
    card: '[data-basket-card]',
    item_button_remove: '[data-basket-item-remove]',
    item_button_count: '[data-basket-item-count]',
    
    product_total: '[data-basket-product-total]',
    nds: '[data-basket-product-nds]',
    amount: '[data-basket-order-amount]',
    economy: '[data-basket-economy]',
    total: '[data-basket-total]',

    bonus_balance: '[data-basket-bonus-balance]',
    bonus_input: '[data-basket-bonus-input]',
    bonus_button: '[data-basket-bonus-accept]',
};

export default function () {
    let errorCard = false;
    let bonusAccept = false;

    checkStatusBasket();

    $(document).on('click', ELEMENTS_SELECTOR.item_button_remove, checkStatusBasket);

    $(document).on('click', ELEMENTS_SELECTOR.item_button_count, checkStatusBasket);

    $(document).on('click', ELEMENTS_SELECTOR.bonus_button, () => {
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
       
    $(document).on('input', ELEMENTS_SELECTOR.bonus_input, () => {
        const button = $(ELEMENTS_SELECTOR.bonus_button);
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
            const amountProduct = $(item)
            .find('.quantity__total-sum')
            .text();

            const priceProduct = $(item)
            .find('.card-cart__price-value')
            .text();
    
            const currentPrice = priceСalc(priceProduct, amountProduct);
            const currentProductTotal = Number(amountProduct);
    
            basketAmoutOrder += currentPrice;
            basketProductTotal += currentProductTotal;
        });

        const basketTotal = basketAmoutOrder;
        const ndsTotal = calcNds(basketTotal);
        const economyTotal = calcEconomy(basketAmoutOrder, basketTotal)

        $(ELEMENTS_SELECTOR.product_total).html(basketProductTotal);
        $(ELEMENTS_SELECTOR.nds).html(ndsTotal + ' ₽');
        $(ELEMENTS_SELECTOR.amount).html(basketAmoutOrder + ' ₽');
        $(ELEMENTS_SELECTOR.economy).html(economyTotal + ' ₽');
        $(ELEMENTS_SELECTOR.total).html(basketTotal + ' ₽');

        return basketAmoutOrder;
    }
    
    function acceptBonus() {
        const basketCard = $(ELEMENTS_SELECTOR.card)
        const basketCardWrapper = basketCard.find('.basket-card__bonus-wrapper');
        const basketCardError = basketCard.find('.basket-card__bonus-error');
        const bonusInput = $(ELEMENTS_SELECTOR.bonus_input);
        const bonusInputControl = $(ELEMENTS_SELECTOR.bonus_input).find('.input__control');
        const bonusInputValue = bonusInputControl.val();
        const bonusBalanceValue = $(ELEMENTS_SELECTOR.bonus_balance)
        .text()
        .replace(' ', '');
        const bonusBalance = parseInt(bonusBalanceValue);
        const button = $(ELEMENTS_SELECTOR.bonus_button);
        const buttonIcon = button.find('.button__icon');
        const totalBasket = $(ELEMENTS_SELECTOR.total).text()
        const percentageBonusPay = calcBonusPercent(bonusInputValue, totalBasket);

        if (!bonusInputValue) {
          return  
        }

        if (bonusBalance < bonusInputValue) {
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
            const priceBasket = calcTotal(totalBasket, bonusInputValue);
            const updateBalanceBonus = calcBonus(bonusBalance, bonusInputValue);
            const updateEconomy = calcEconomy(basketAmoutOrder, priceBasket);
            const updateNds = calcNds(priceBasket);

            $(ELEMENTS_SELECTOR.nds).html(updateNds + ' ₽');    
            $(ELEMENTS_SELECTOR.bonus_balance).html(updateBalanceBonus + ' ББ');
            $(ELEMENTS_SELECTOR.economy).html(updateEconomy + ' ₽');
            $(ELEMENTS_SELECTOR.total).html(priceBasket + ' ₽');
           
            basketCardWrapper.removeClass('basket-card__bonus-wrapper--error');
            button.removeClass('button--red').addClass('button--green');

            bonusInput.find('.input__placeholder').html('Списано баллов')
            buttonIcon.html(iconRefresh);
            basketCardError.hide();
        }     
    }

    function priceСalc(price, amount) {
        const priceProduct = parseInt(amount) * parseInt(price);

        return priceProduct
    }

    function calcNds(total) {
        const ndsProduct = Math.round(parseInt(total) * 0.2);

        return ndsProduct
    }

    function calcTotal(currentPrice, bonus) {
        const  totalBasket = parseInt(currentPrice) -  parseInt(bonus);

        return totalBasket
    }

    function calcEconomy(currentPrice, basketTotal) {
        const  totalEconomy = parseInt(currentPrice) - parseInt(basketTotal);

        return totalEconomy
    }

    function calcBonus(bonusBalance, bonusInput) {
        const totalBonus = parseInt(bonusBalance) - parseInt(bonusInput);

        return totalBonus
    }

    function calcBonusPercent(bonusInput, totalBalance) {
        const totalBonus = parseInt(bonusInput) / parseInt(totalBalance);
        
        return totalBonus
    }

    function resetBonus() {
        const bonusInput = $(ELEMENTS_SELECTOR.bonus_input);
        const bonusInputControl = $(ELEMENTS_SELECTOR.bonus_input).find('.input__control');
        const bonusInputValueReset = bonusInputControl.val('');
        const totalEconimy = $(ELEMENTS_SELECTOR.economy).text();
        const totalBonusBalance = $(ELEMENTS_SELECTOR.bonus_balance).text();

        const resetBonus = parseInt(totalEconimy) + parseInt(totalBonusBalance);
        const resetEconomy = parseInt(totalEconimy) - parseInt(totalEconimy);

        $(ELEMENTS_SELECTOR.bonus_balance).html(resetBonus + ' ББ');
        $(ELEMENTS_SELECTOR.economy).html(resetEconomy + ' ₽');
        bonusInput.find('.input__placeholder').html('Сколько баллов списать')

        checkStatusBasket();
    }

    function resetInput() {
        const bonusInput = $(ELEMENTS_SELECTOR.bonus_input);
        const bonusInputControl = $(ELEMENTS_SELECTOR.bonus_input).find('.input__control');
        const bonusInputValue = bonusInputControl.val('');

        bonusInput.find('.input__placeholder').html('Сколько баллов списать')
    }

    const iconError = `
    <svg class="icon icon--close gui__icon">
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
}
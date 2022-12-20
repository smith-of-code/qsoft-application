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
        const button = $(ELEMENTS_SELECTOR.bonusButton);
        const buttonIcon = button.find('.button__icon');
        const basketCard = $(ELEMENTS_SELECTOR.card);
        const basketCardWrapper = basketCard.find('.basket-card__bonus-wrapper');
        const basketCardError = basketCard.find('.basket-card__bonus-error');

        if (!bonusAccept && !errorCard) {
            acceptBonus();
        } else if (bonusAccept) {
            resetBonus();
        } else if (errorCard) {
            errorCard = false;
            basketCardWrapper.removeClass('basket-card__bonus-wrapper--error');
            button.removeClass('button--red').addClass('button--green');
            basketCardError.hide();
            buttonIcon.html(iconDefault);
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
            const priceDefaultRemains = priceDefault.find('.product-price__item-remains');
            const priceDefaultWhole = priceDefault.find('.product-price__item-whole');
            const priceOld = $(item).find('.product-price__item.product-price__item--old');
            const priceSale = $(item).find('.product-price__item.product-price__item--new');
            const priceOldRemains = priceOld.find('.product-price__item-remains');
            const priceSaleRemains = priceSale.find('.product-price__item-remains');
            const priceOldWhole = priceOld.find('.product-price__item-whole');
            const priceSaleWhole = priceSale.find('.product-price__item-whole');
            const priceItem = $(item).find('.card-cart__price-value');
            const priceItemValue = priceItem.attr('data-value-item').replace(/\s/g,'');
            const priceItemNumber = parseFloat(priceItemValue);
            const priceBaseItem = $(item).attr('data-base-price')
            const priceBaseItemNumber = parseFloat(priceBaseItem);
            const amountProduct = $(item)
            .find('.quantity__total-sum')
            .text();

            const spanWhole = priceItem.find(".card-cart__price-item-whole");
            const spanRemains = priceItem.find(".card-cart__price-item-remains");

            if (priceItemValue) {
                roundetPrice(priceItemValue, spanWhole, spanRemains);
            }

            const currentPrice = priceСalc(priceItemNumber, amountProduct);
            const currentPriceDefault = priceСalc(priceBaseItemNumber, amountProduct);

            if (priceSale.length > 0) {
                roundetPrice(currentPrice, priceSaleWhole, priceSaleRemains);
                roundetPrice(currentPriceDefault, priceOldWhole, priceOldRemains);
            } else {
                roundetPrice(currentPrice, priceDefaultWhole, priceDefaultRemains);
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

        const basketTotal = basketAmoutOrder;
        const basketTotalSale = basketAmoutOrderSale;
        const ndsTotal = Math.round(calcNds(basketTotalSale));
        const economyTotal = calcEconomy(basketAmoutOrder, basketTotalSale);

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
            basketCardError.html('Недостаточно баллов. Пожалуйста, уменьшите количество списываемых баллов');
            basketCardError.show();
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
        return parseFloat(currentPrice.replace(/,/g, '.')) -  parseFloat(bonus);
    }

    function calcEconomy(currentPrice, basketTotal) {
        return parseFloat(currentPrice) - parseFloat(basketTotal);
    }

    function calcBonus(bonusBalance, bonusInput) {
        return parseFloat(bonusBalance) - parseFloat(bonusInput);
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
        const resetEconomy = parseFloat(totalEconomy.replace(/,/g, '.')) - parseFloat(totalBonus);

        $(ELEMENTS_SELECTOR.bonusBalance).html(resetBonus + ' ББ');
        acceptEconomy(resetEconomy);
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
        const spanWhole = $(ELEMENTS_SELECTOR.economy).find(".basket-card__total-whole");
        const spanRemains = $(ELEMENTS_SELECTOR.economy).find(".basket-card__total-remains");

        let totalFixied = total.toFixed(2);
        let totalRemains = totalFixied.toString().split('.')[1];
       
        if (totalRemains === "00") {
            spanWhole.text(Math.floor(total).toLocaleString('ru-RU', {minimumFractionDigits: 0}));
            spanRemains.text('₽');
        } else {
            spanWhole.text(Math.floor(total).toLocaleString('ru-RU', {minimumFractionDigits: 0}) + ',');
            spanRemains.text(totalRemains.toLocaleString('ru-RU', {minimumFractionDigits: 0}) + '₽');
        }
    }

    function acceptTotal(total) {
        const spanWhole = $(ELEMENTS_SELECTOR.total).find(".basket-card__total-whole");
        const spanRemains = $(ELEMENTS_SELECTOR.total).find(".basket-card__total-remains");

        let totalFixied = total.toFixed(2);
        let totalRemains = totalFixied.toString().split('.')[1];
       
        if (totalRemains === "00") {
            spanWhole.text(Math.floor(total).toLocaleString('ru-RU', {minimumFractionDigits: 0}));
            spanRemains.text('₽');
        } else {
            spanWhole.text(Math.floor(total).toLocaleString('ru-RU', {minimumFractionDigits: 0}) + ',');
            spanRemains.text(totalRemains.toLocaleString('ru-RU', {minimumFractionDigits: 0}) + '₽');
        }
    }

    function acceptBonusBalance(total) {
        $(ELEMENTS_SELECTOR.bonusBalance).html(total.toLocaleString('ru-RU', {minimumFractionDigits: 0}) + ' ББ');
    }

    function acceptAmount(total) {
        const spanWhole = $(ELEMENTS_SELECTOR.amount).find(".basket-card__total-whole");
        const spanRemains = $(ELEMENTS_SELECTOR.amount).find(".basket-card__total-remains");

        let totalFixied = total.toFixed(2);
        let totalRemains = totalFixied.toString().split('.')[1];
       
        if (totalRemains === "00") {
            spanWhole.text(Math.floor(total).toLocaleString('ru-RU', {minimumFractionDigits: 0}));
            spanRemains.text('₽');
        } else {
            spanWhole.text(Math.floor(total).toLocaleString('ru-RU', {minimumFractionDigits: 0}) + ',');
            spanRemains.text(totalRemains.toLocaleString('ru-RU', {minimumFractionDigits: 0}) + '₽');
        }
      
    }

    function acceptProductTotal(total) {
        $(ELEMENTS_SELECTOR.productTotal).html(total.toLocaleString('ru-RU'));
    }

    function acceptBonusOrder(total) {
        $(ELEMENTS_SELECTOR.bonusOrder).html(total.toLocaleString('ru-RU') + ' ББ');
    }

    function roundetPrice(price, whole, remains) {
        let mainPriceNum = parseFloat(price);
        let totalMainFixied = mainPriceNum.toFixed(2);
        let totalMainRemains = totalMainFixied.toString().split('.')[1];

        if (totalMainRemains === "00") {
            whole.text(Math.floor(mainPriceNum).toLocaleString('ru-RU', {minimumFractionDigits: 0}));
            remains.text('₽');
        } else {
            whole.text(Math.floor(mainPriceNum).toLocaleString('ru-RU', {minimumFractionDigits: 0}) + ',');
            remains.text(totalMainRemains.toLocaleString('ru-RU', {minimumFractionDigits: 0}) + '₽');
        }
    }

    await checkStatusBasket();
}
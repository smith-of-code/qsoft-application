import { data } from "jquery";

const ELEMENTS_SELECTOR = {
    calculator: '[data-calculator]',

    calculatorLevel: '[data-calculator-level]',
    calculatorLevelHidden: '[data-calculator-level-hidden]',

    calculatorRange: '[data-calculator-range]',
    calculatorRangeInputRub: '[data-calculator-range-input-rub]',
    calculatorRangeInputPoint: '[data-calculator-range-input-point]',
    calculatorRangePoints: '[data-calculator-range-points]',

    calculatorPersonalPointsSum: '[data-calculator-personal-points-sum]',
    calculatorGroupPointsSum: '[data-calculator-group-points-sum]',

    calculatorQuantity: '[data-calculator-quantity]',

    calculatorConsultant: '[data-calculator-consultant]',
    calculatorConsultantAdd: '[data-calculator-consultant-add]',
    calculatorConsultantWrapper: '[data-calculator-consultant-wrapper]',
    calculatorConsultantItem: '[data-calculator-consultant-item]',
    calculatorConsultantRemove: '[data-calculator-consultant-remove]',

    calculatorComputing: '[data-calculator-computing]',
    calculatorComputingSum: '[data-calculator-computing-sum]',
    calculatorComputingBlock: '[data-calculator-computing-block]',

    consultants: '[data-consultants]',
    switcher: '[data-consultants-switcher]',
    quantity: '[data-consultants-quantity]',
    quantitySum: '[data-quantity-sum]',
    quantityDecrease: '[data-quantity-decrease-temp]', // TODO
    quantityIncrease: '[data-quantity-increase-temp]', // TODO
    quantityDecreaseConsultants: '[data-quantity-decrease]',
    quantityIncreaseConsultants: '[data-quantity-increase]',

    quantityTotalSum: '.quantity__total-sum',
    profitabilitySum: '.profitability__sum',
    profitabilityHintConsultant: '.profitability__hint--consultant',

    chart: '[data-calculator-chart]',
    chartIncomeSales: '[data-calculator-chart-income-sales]',
    chartProfitPurchases: '[data-calculator-chart-profit-purchases]',
    chartIncomeGroup: '[data-calculator-chart-income-group]',
    chartOneTimeCharges: '[data-calculator-chart-onetime-charges]',
};

function getCurrentLevel(property) {
    if (property == undefined) {
        return bigData.level[bigData.currentLevel - 1];
    }

    return bigData.level[bigData.currentLevel - 1][property];
}

function setData(property, value) {
    bigData[property] = value;
}

function setDataVariables(typeCalc, rub, point) {
    if (typeCalc == 'personal') {
        setData('personalPoints', point);
        setData('personalRub', rub);
        $(ELEMENTS_SELECTOR.calculatorPersonalPointsSum).html(point.toLocaleString('ru-RU'));
    } else if (typeCalc == 'group') {
        setData('groupPoints', point);
        setData('groupRub', rub);
        calculateGroup();
    } else if (typeCalc == 'consultant') {
        setData('consultantPoints', point);
        setData('consultantRub', rub);
        calculateGroup();
    }

    $(ELEMENTS_SELECTOR.calculatorComputingBlock).hide();
    resetChart()
}

function calculateGroup() {
    let groupPoints = bigData.groupBuyer * bigData.groupPoints;
    let consultantPoints = bigData.consultant * bigData.consultantPoints;
    let consultantFixedPoints = 0;
    bigData.consultantArr.forEach((item)=>{
        if (item != undefined) {
            consultantFixedPoints += item.consultantPointsSum;
        }
    });

    let sum = groupPoints + consultantPoints + consultantFixedPoints;
    $(ELEMENTS_SELECTOR.calculatorGroupPointsSum).html(sum.toLocaleString('ru-RU'));

    return sum;
}

function getDataLevelProperty(calcRange) {
    let typeCalc = calcRange.data('calculator-range');

    let property= {
        typeCalc: typeCalc,
        minPoints: (typeCalc=='personal') ? getCurrentLevel('minPointsPersonal') : getCurrentLevel('minPointsGroup'),
        maxPoints: (typeCalc=='personal') ? getCurrentLevel('maxPointsPersonal') : getCurrentLevel('maxPointsGroup'),
        stepPoints: (typeCalc=='personal') ? getCurrentLevel('stepPointsPersonal') : getCurrentLevel('stepPointsGroup'),
        standardPoints: (typeCalc=='personal') ? getCurrentLevel('standardPersonal') : getCurrentLevel('standardGroup'),
    };

    return property;
}

function changeOneTimeCharges() {
    let oneTimeCharges = 0;
    let oneTimeChargesTransitionLevel = 0;

    if ($(ELEMENTS_SELECTOR.switcher).is(':checked')) {
        let quantity = $(ELEMENTS_SELECTOR.quantitySum).data('quantity-sum');
        let invitation = getCurrentLevel('invitation');
        oneTimeCharges = quantity * invitation;

        if (bigData.currentLevel == 2 || bigData.currentLevel == 3) {
            oneTimeChargesTransitionLevel = getCurrentLevel('transitionToLevel');
        }
    }

    setData('oneTimeCharges', oneTimeCharges);
    setData('oneTimeChargesTransitionLevel', oneTimeChargesTransitionLevel);
    $(ELEMENTS_SELECTOR.calculatorComputingBlock).hide();
    resetChart()
}

function chartSum(elem, num) {
    let sum = elem.closest('.diagramm__main').find('.diagramm__sum');
    sum.html(num.toLocaleString('ru-RU'));
}

function resetChart() {
    //Обнуляем основной график
    let chart = $(ELEMENTS_SELECTOR.chart);
    chart[0].myChart.data.datasets[0].data = [0,0,0,0];
    chart[0].myChart.update()
    chartSum(chart, 0);

     // Обнуляем диаграммы Доход от личных продаж
    let chartIncomeSales = $(ELEMENTS_SELECTOR.chartIncomeSales);
    chartIncomeSales[0].myChart.data.datasets[0].data = [0,0,0,0];
    chartIncomeSales[0].myChart.update();
    chartSum(chartIncomeSales, 0);

     // Обнуляем диаграммы Прибыль от личных покупок
    let chartProfitPurchases = $(ELEMENTS_SELECTOR.chartProfitPurchases);
    chartProfitPurchases[0].myChart.data.datasets[0].data = [0,0,0,0];
    chartProfitPurchases[0].myChart.update();
    chartSum(chartProfitPurchases, 0);

     // Обнуляем диаграммы Доход от группы
    let chartIncomeGroup = $(ELEMENTS_SELECTOR.chartIncomeGroup);
    chartIncomeGroup[0].myChart.data.datasets[0].data = [0,0,0,0];
    chartIncomeGroup[0].myChart.update();
    chartSum(chartIncomeGroup, 0);

     // Обнуляем диаграммы Разовые начисления
    let chartOneTimeCharges = $(ELEMENTS_SELECTOR.chartOneTimeCharges);
    chartOneTimeCharges[0].myChart.data.datasets[0].data = [0,0,0,0];
    chartOneTimeCharges[0].myChart.update();
    chartSum(chartOneTimeCharges, 0);
}

export default function () {

    if ($(ELEMENTS_SELECTOR.calculator).length == 0) {
        return;
    }

    // Событие изменение ползунка rub / зависимость друг от друга
    $(document).on('change changeCalculator', ELEMENTS_SELECTOR.calculatorRangeInputRub, function() {
        let value = +$(this).val().replace(/\s/g, "").replace(/,/g,"");

        let calcRange = $(this).closest(ELEMENTS_SELECTOR.calculatorRange);
        let property = getDataLevelProperty(calcRange);

        let currentPoint = value / property.standardPoints * property.stepPoints;
        currentPoint = Math.floor(currentPoint);

        let rangeInputPoint = $(this).closest(ELEMENTS_SELECTOR.calculatorRange).find(ELEMENTS_SELECTOR.calculatorRangeInputPoint);
        rangeInputPoint.val(currentPoint.toLocaleString('ru-RU'));
        rangeInputPoint.trigger('changeRange');

        setDataVariables(property.typeCalc, value, currentPoint);
    });

    // Событие изменение ползунка point / зависимость друг от друга
    $(document).on('change changeCalculator', ELEMENTS_SELECTOR.calculatorRangeInputPoint, function() {
        let value = +$(this).val().replace(/\s/g, "").replace(/,/g,"");
        let calcRange = $(this).closest(ELEMENTS_SELECTOR.calculatorRange);
        let property = getDataLevelProperty(calcRange);

        let currentRub = value / property.stepPoints * property.standardPoints;
        currentRub = Math.floor(currentRub);

        let rangeInputRub = $(this).closest(ELEMENTS_SELECTOR.calculatorRange).find(ELEMENTS_SELECTOR.calculatorRangeInputRub);
        rangeInputRub.val(currentRub.toLocaleString('ru-RU'));
        rangeInputRub.trigger('changeRange');

        setDataVariables(property.typeCalc, currentRub, value);
    });

    // Изменение уровня
    $(document).on('input', ELEMENTS_SELECTOR.calculatorLevel, function() {
        let level = +$(this).val();
        setData('currentLevel', level);

        $(ELEMENTS_SELECTOR.calculatorLevelHidden).each((id, item)=>{
            let num = +$(item).data('calculator-level-hidden');

            if (num == level) {
                $(item).show();
            } else {
                $(item).hide();
            }
        });

        $(ELEMENTS_SELECTOR.calculatorConsultantWrapper).html('');
        bigData.consultantArr.length = 0;
        calculateGroup();

        let rangeInput = $(ELEMENTS_SELECTOR.calculatorRangeInputPoint);
        rangeInput.each((id, input)=>{
            let calcRange = $(input).closest(ELEMENTS_SELECTOR.calculatorRange);
            let rangePoints = calcRange.find(ELEMENTS_SELECTOR.calculatorRangePoints);

            let property = getDataLevelProperty(calcRange);

            let currentRub = +calcRange.find(ELEMENTS_SELECTOR.calculatorRangeInputRub).val().replace(/\s/g, "").replace(/,/g,"");
            let currentPoint = currentRub / property.standardPoints * property.stepPoints;
            currentPoint = Math.floor(currentPoint);
            if (currentPoint < property.minPoints) {
                currentPoint = property.minPoints;
            } else if(currentPoint > property.maxPoints) {
                currentPoint = property.maxPoints;
            }

            $(input).val(currentPoint.toLocaleString('ru-RU'));

            rangePoints.slider('option', {
                min: property.minPoints,
                max: property.maxPoints,
                step: property.stepPoints,
                value: currentPoint,
            });

            setDataVariables(property.typeCalc, currentRub, currentPoint);
            changeOneTimeCharges();
        });
    });

    // Изменение количества покупателей и консультантов
    $(document).on('change changeCalculator', ELEMENTS_SELECTOR.calculatorQuantity, function() {
        let type = $(this).data('calculator-quantity');
        let value = +$(this).val().replace(/\s/g, "").replace(/,/g,"");

        if (type == 'buyer') {
            setData('groupBuyer', value);
        } else {
            setData('consultant', value);
        }

        calculateGroup();

        $(ELEMENTS_SELECTOR.calculatorComputingBlock).hide();
        resetChart()
    });

    // Добавление консультантов
    $(document).on('click', ELEMENTS_SELECTOR.calculatorConsultantAdd, function(e) {
        e.preventDefault();

        let length = 0;
        for(let i=0; i < bigData.consultantArr.length; i++){
            if (bigData.consultantArr[i] != undefined) {
                length++;
            }
        }
        if (length == 8) {
            return;
        }

        let consultant = {
            consultant: bigData.consultant,
            consultantRub: bigData.consultantRub,
            consultantPoints: bigData.consultantPoints,
            consultantPointsSum: bigData.consultant * bigData.consultantPoints,
        };
        let consultantLength = bigData.consultantArr.push(consultant);

        let template = `
            <li class="groups__item" data-calculator-consultant-item>
                <div class="group">
                    <div class="group__users">
                        <div class="group__users-icon">
                            <svg class="icon icon--users">
                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-users"></use>
                            </svg>
                        </div>
                        <span class="group__users-counter counter">${bigData.consultant}</span>
                    </div>

                    <div class="group__symbol">
                        <svg class="icon icon--cross">
                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-cross"></use>
                        </svg>
                    </div>

                    <div class="group__sum price price--inlined">
                        <div class="price__calculation">
                            <p class="price__calculation-total">${bigData.consultantRub.toLocaleString('ru-RU')} ₽</p>
                            <p class="price__calculation-accumulation">${bigData.consultantPoints.toLocaleString('ru-RU')} ББ</p>
                        </div>
                    </div>

                    <div class="group__delete">
                        <svg class="group__delete-icon icon icon--close-square" data-calculator-consultant-remove="${consultantLength}">
                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-close-square"></use>
                        </svg>
                    </div>
                </div>
            </li>
        `;

        $(ELEMENTS_SELECTOR.calculatorConsultantWrapper).append(template);

        let calculatorRangeInputRub = $(this).closest(ELEMENTS_SELECTOR.calculatorConsultant).find(ELEMENTS_SELECTOR.calculatorRangeInputRub);
        calculatorRangeInputRub.val(0);
        calculatorRangeInputRub.trigger('changeRange');
        let calculatorRangeInputPoint = $(this).closest(ELEMENTS_SELECTOR.calculatorConsultant).find(ELEMENTS_SELECTOR.calculatorRangeInputPoint);
        calculatorRangeInputPoint.val(0);
        calculatorRangeInputPoint.trigger('changeRange');
        let calculatorQuantity = $(this).closest(ELEMENTS_SELECTOR.calculatorConsultant).find(ELEMENTS_SELECTOR.calculatorQuantity);
        calculatorQuantity.val(1);
        calculatorQuantity.trigger('changeRange');
        setDataVariables('consultant', 0, 0);
        setData('consultant', 1);

        calculateGroup();
    });

    // Удаление консультантов
    $(document).on('click', ELEMENTS_SELECTOR.calculatorConsultantRemove, function() {
        $(this).closest(ELEMENTS_SELECTOR.calculatorConsultantItem).remove();

        let number = +$(this).data('calculator-consultant-remove');
        delete bigData.consultantArr[number-1];

        calculateGroup();
        $(ELEMENTS_SELECTOR.calculatorComputingBlock).hide();
        resetChart()
    });

    // "Учитывать разовые начисления баллов"
    $(document).on('change', ELEMENTS_SELECTOR.switcher, function() {
        $(ELEMENTS_SELECTOR.consultants).find(ELEMENTS_SELECTOR.quantity).toggleClass('profitability__consultants-quantity--hidden');

        changeOneTimeCharges();
    });

    // Добавление новых консультантов для разового расчета
    $(document).on('click', `${ELEMENTS_SELECTOR.quantityDecrease}, ${ELEMENTS_SELECTOR.quantityIncrease}`, function() {
        changeOneTimeCharges();
    });

    // Добавление новых консультантов для разового расчета
    $(document).on(
        'click',
        `${ELEMENTS_SELECTOR.quantityDecreaseConsultants}, ${ELEMENTS_SELECTOR.quantityIncreaseConsultants}`,
        function() {
        viewsAttractConsAdviser()
    });
    
    // Расчет в диаграмму
    $(document).on('click', ELEMENTS_SELECTOR.calculatorComputing, function(e) {
        e.preventDefault();

        let incomeFromPersonalSales = bigData.personalRub / 100 * getCurrentLevel('percent'); // Доход от личных продаж
        let profitFromPersonalPurchases = bigData.personalPoints; // Прибыль от личных покупок
        let incomeFromGroup = calculateGroup(); // Доход от группы
        let oneTimeCharges = bigData.oneTimeCharges + bigData.oneTimeChargesTransitionLevel; // Разовые начисления
        let sum = incomeFromPersonalSales + profitFromPersonalPurchases + incomeFromGroup + oneTimeCharges;
        
        $(ELEMENTS_SELECTOR.calculatorComputingSum).text(sum.toLocaleString('ru-RU'));

        // Обновление основной диаграммы
        let chart = $(ELEMENTS_SELECTOR.chart);
        chart[0].myChart.data.datasets[0].data = [
            incomeFromPersonalSales,
            profitFromPersonalPurchases,
            incomeFromGroup,
            oneTimeCharges
        ];
        chart[0].myChart.update();
        chartSum(chart, sum);

        // Обновление диаграммы Доход от личных продаж
        let chartIncomeSales = $(ELEMENTS_SELECTOR.chartIncomeSales);
        chartIncomeSales[0].myChart.data.datasets[0].data = [
            incomeFromPersonalSales,
            profitFromPersonalPurchases + incomeFromGroup + oneTimeCharges
        ];
        chartIncomeSales[0].myChart.update();
        chartSum(chartIncomeSales, incomeFromPersonalSales);

        // Обновление диаграммы Прибыль от личных покупок
        let chartProfitPurchases = $(ELEMENTS_SELECTOR.chartProfitPurchases);
        chartProfitPurchases[0].myChart.data.datasets[0].data = [
            profitFromPersonalPurchases,
            incomeFromPersonalSales + incomeFromGroup + oneTimeCharges
        ];
        chartProfitPurchases[0].myChart.update();
        chartSum(chartProfitPurchases, profitFromPersonalPurchases);

        // Обновление диаграммы Доход от группы
        let chartIncomeGroup = $(ELEMENTS_SELECTOR.chartIncomeGroup);
        chartIncomeGroup[0].myChart.data.datasets[0].data = [
            incomeFromGroup,
            incomeFromPersonalSales + profitFromPersonalPurchases + oneTimeCharges
        ];
        chartIncomeGroup[0].myChart.update();
        chartSum(chartIncomeGroup, incomeFromGroup);

        // Обновление диаграммы Разовые начисления
        let chartOneTimeCharges = $(ELEMENTS_SELECTOR.chartOneTimeCharges);
        chartOneTimeCharges[0].myChart.data.datasets[0].data = [
            oneTimeCharges,
            incomeFromPersonalSales + incomeFromGroup + profitFromPersonalPurchases
        ];
        chartOneTimeCharges[0].myChart.update();
        chartSum(chartOneTimeCharges, oneTimeCharges);

        $(ELEMENTS_SELECTOR.calculatorComputingBlock).show();
    });

    function viewsAttractConsAdviser() {
        let dataInput = $(ELEMENTS_SELECTOR.profitabilitySum);
        let tooltipBox = $(ELEMENTS_SELECTOR.profitabilityHintConsultant);
        let dataInputVal = dataInput.text();
        let declinationText = changeTooltipText(dataInputVal, ['нового консультанта', 'новых консультантов', 'новых консультантов'])
        let content = `
        В расчёте будут учтены баллы, которые Вы можете получить, если привлечёте ${dataInputVal} ${declinationText} в свою группу`
        
        tooltipBox.attr('data-tippy-content', content)
        
    }

    function changeTooltipText(count, text_forms) {
        // берем десятые числа и единици  
        count = Math.abs(count) % 100; 
        var unit = count % 10;

        if (count > 10 && count < 20) {
            return text_forms[2];
        }

        if (unit > 1 && unit < 5) {
            return text_forms[1];
        }

        if (unit == 1) {
            return text_forms[0];
        }

        return text_forms[2];
    }
    
    viewsAttractConsAdviser();
}

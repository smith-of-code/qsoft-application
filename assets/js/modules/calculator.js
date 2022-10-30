import { data } from "jquery";

const ELEMENTS_SELECTOR = {
    calculator: '[data-calculator]',

    calculatorLevel: '[data-calculator-level]',
    calculatorLevelHidden: '[data-calculator-level-hidden]',


    calculatorRange: '[data-calculator-range]',
    calculatorRangeInputRub: '[data-calculator-range-input-rub]',
    calculatorRangeInputPoint: '[data-calculator-range-input-point]',
    calculatorRangePoints: '[data-calculator-range-points]',

    // calculatorRangePersonal: '[data-calculator-range-personal]',
    // calculatorRangePersonalRub: '[data-calculator-range-personal-rub]',
    // calculatorRangePersonalPoints: '[data-calculator-range-personal-points]',

    calculatorPersonalPointsSum: '[data-calculator-personal-points-sum]',
    











    consultants: '[data-consultants]',
    switcher: '[data-consultants-switcher]',
    quantity: '[data-consultants-quantity]',
};

// Удалить 
function dd(item) {
    console.log(item);
}

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
        $(ELEMENTS_SELECTOR.calculatorPersonalPointsSum).html(point);
    } else if (typeCalc == 'group') {
        setData('groupPoints', point);
        setData('groupRub', rub);
    }
    
}


export default function () {
    // Показать скрыть "Учитывать разовые начисления баллов"
    $(document).on('change', ELEMENTS_SELECTOR.switcher, function() {
        $(ELEMENTS_SELECTOR.consultants).find(ELEMENTS_SELECTOR.quantity).toggleClass('profitability__consultants-quantity--hidden');
    });





    // Событие изменение ползунка rub / зависимость друг от друга
    $(document).on('change changeCalculator', ELEMENTS_SELECTOR.calculatorRangeInputRub, function() {
        let value = +$(this).val();

        let typeCalc = $(this).closest(ELEMENTS_SELECTOR.calculatorRange).data('calculator-range');
        let stepPoints = (typeCalc=='personal') ? getCurrentLevel('stepPointsPersonal') : getCurrentLevel('stepPointsGroup');
        let standardPoints = (typeCalc=='personal') ? getCurrentLevel('standardPersonal') : getCurrentLevel('standardGroup');

        // dd(bigData.currentLevel);
        
        let currentPoint = value / standardPoints * stepPoints;


        // dd(currentPoint);


        let rangeInputPoint = $(this).closest(ELEMENTS_SELECTOR.calculatorRange).find(ELEMENTS_SELECTOR.calculatorRangeInputPoint);

        rangeInputPoint.val(currentPoint);
        rangeInputPoint.trigger('changeRange');

        setDataVariables(typeCalc, value, currentPoint);
    });

    // Событие изменение ползунка point / зависимость друг от друга
    $(document).on('change changeCalculator', ELEMENTS_SELECTOR.calculatorRangeInputPoint, function() {
        let value = +$(this).val();

        let typeCalc = $(this).closest(ELEMENTS_SELECTOR.calculatorRange).data('calculator-range');
        let stepPoints = (typeCalc=='personal') ? getCurrentLevel('stepPointsPersonal') : getCurrentLevel('stepPointsGroup');
        let standardPoints = (typeCalc=='personal') ? getCurrentLevel('standardPersonal') : getCurrentLevel('standardGroup');

        let currentRub = value / stepPoints * standardPoints;

        let rangeInputRub = $(this).closest(ELEMENTS_SELECTOR.calculatorRange).find(ELEMENTS_SELECTOR.calculatorRangeInputRub);
        rangeInputRub.val(currentRub);
        rangeInputRub.trigger('changeRange');

        setDataVariables(typeCalc, currentRub, value);
    });



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






        let rangeInput = $(ELEMENTS_SELECTOR.calculatorRangeInputPoint);
        rangeInput.each((id, input)=>{
            let calcRange = $(input).closest(ELEMENTS_SELECTOR.calculatorRange);
            let rangePoints = calcRange.find(ELEMENTS_SELECTOR.calculatorRangePoints);

            let typeCalc = calcRange.data('calculator-range');
            let minPoints = (typeCalc=='personal') ? getCurrentLevel('minPointsPersonal') : getCurrentLevel('minPointsGroup');
            let maxPoints = (typeCalc=='personal') ? getCurrentLevel('maxPointsPersonal') : getCurrentLevel('maxPointsGroup');
            let stepPoints = (typeCalc=='personal') ? getCurrentLevel('stepPointsPersonal') : getCurrentLevel('stepPointsGroup');
            let standardPoints = (typeCalc=='personal') ? getCurrentLevel('standardPersonal') : getCurrentLevel('standardGroup');

            let currentRub = +calcRange.find(ELEMENTS_SELECTOR.calculatorRangeInputRub).val();
            let currentPoint = currentRub / standardPoints * stepPoints;
            if (currentPoint < minPoints) {
                currentPoint = minPoints;
            } else if(currentPoint > maxPoints) {
                currentPoint = maxPoints;
            }

            $(input).val(currentPoint);
            setDataVariables(typeCalc, currentRub, currentPoint);

            rangePoints.slider('option', {
                min: minPoints,
                max: maxPoints,
                step: stepPoints,
                value: currentPoint,
            });

            dd(rangePoints.slider('option', 'max'));
        });
    });






    //Получение объекта для расчетов
    // let data = $(ELEMENTS_SELECTOR.calculator).find(ELEMENTS_SELECTOR.calculatorData);
}

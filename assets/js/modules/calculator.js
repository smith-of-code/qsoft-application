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
        $(ELEMENTS_SELECTOR.calculatorPersonalPointsSum).html(point.toLocaleString());
    } else if (typeCalc == 'group') {
        setData('groupPoints', point);
        setData('groupRub', rub);
        calculateGroup();
    } else if (typeCalc == 'consultant') {
        setData('consultantPoints', point);
        setData('consultantRub', rub);
        calculateGroup();
    }
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
    $(ELEMENTS_SELECTOR.calculatorGroupPointsSum).html(sum.toLocaleString());
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

export default function () {
    // Показать скрыть "Учитывать разовые начисления баллов"
    $(document).on('change', ELEMENTS_SELECTOR.switcher, function() {
        $(ELEMENTS_SELECTOR.consultants).find(ELEMENTS_SELECTOR.quantity).toggleClass('profitability__consultants-quantity--hidden');
    });

    // Событие изменение ползунка rub / зависимость друг от друга
    $(document).on('change changeCalculator', ELEMENTS_SELECTOR.calculatorRangeInputRub, function() {
        let value = +$(this).val();

        let calcRange = $(this).closest(ELEMENTS_SELECTOR.calculatorRange);
        let property = getDataLevelProperty(calcRange);

        let currentPoint = value / property.standardPoints * property.stepPoints;
        currentPoint = Math.floor(currentPoint);

        let rangeInputPoint = $(this).closest(ELEMENTS_SELECTOR.calculatorRange).find(ELEMENTS_SELECTOR.calculatorRangeInputPoint);
        rangeInputPoint.val(currentPoint);
        rangeInputPoint.trigger('changeRange');

        setDataVariables(property.typeCalc, value, currentPoint);
    });

    // Событие изменение ползунка point / зависимость друг от друга
    $(document).on('change changeCalculator', ELEMENTS_SELECTOR.calculatorRangeInputPoint, function() {
        let value = +$(this).val();

        let calcRange = $(this).closest(ELEMENTS_SELECTOR.calculatorRange);
        let property = getDataLevelProperty(calcRange);

        let currentRub = value / property.stepPoints * property.standardPoints;
        currentRub = Math.floor(currentRub);

        let rangeInputRub = $(this).closest(ELEMENTS_SELECTOR.calculatorRange).find(ELEMENTS_SELECTOR.calculatorRangeInputRub);
        rangeInputRub.val(currentRub);
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

            let currentRub = +calcRange.find(ELEMENTS_SELECTOR.calculatorRangeInputRub).val();
            let currentPoint = currentRub / property.standardPoints * property.stepPoints;
            currentPoint = Math.floor(currentPoint);
            if (currentPoint < property.minPoints) {
                currentPoint = property.minPoints;
            } else if(currentPoint > property.maxPoints) {
                currentPoint = property.maxPoints;
            }

            $(input).val(currentPoint);

            rangePoints.slider('option', {
                min: property.minPoints,
                max: property.maxPoints,
                step: property.stepPoints,
                value: currentPoint,
            });

            setDataVariables(property.typeCalc, currentRub, currentPoint);
        });
    });

    // Сохраниение количества покупателей и консультантов
    $(document).on('change changeCalculator', ELEMENTS_SELECTOR.calculatorQuantity, function() {
        let type = $(this).data('calculator-quantity');
        let value = +$(this).val();

        if (type == 'buyer') {
            setData('groupBuyer', value);
        } else {
            setData('consultant', value);
        }

        calculateGroup();
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
                            <p class="price__calculation-total">${bigData.consultantRub} ₽</p>
                            <p class="price__calculation-accumulation">${bigData.consultantPoints} ББ</p>
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
    });
}

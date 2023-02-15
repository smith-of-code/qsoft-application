import "jquery-ui/ui/widgets/slider";
import "../vendors/jquery.ui.touch-punch.min.js"

const ELEMENTS_SELECTOR = {
    ranges: '[data-range]',
    rangeSlider: '[data-range-slider]',
    rangeMin: '[data-range-min]',
    rangeMax: '[data-range-max]',
};

export default function(){
    let $card = $(".card-counting");

    $card.each( function() {
        let $input = $card.find('.card-counting__value-count');

        $($input).on('input', function() {
            $(this).val($(this).val().replace(/[^0-9]/g, ''))
            return
        });
    })

    let rangeInputs = $(".range__input");
    
    rangeInputs.each( function(index, item) {
        $(item).on('input', function() {
            $(this).val($(this).val().replace(/[^0-9]/g, ''))
            return
        });
    })

    $(ELEMENTS_SELECTOR.ranges).each(function() {
        let slider = $(this).find(ELEMENTS_SELECTOR.rangeSlider),
            min = slider.data('min'),
            current = slider.data('current'), // Параметр для слайдера типа "min"
            max = slider.data('max'),
            step = slider.data('step'),
            type = slider.data('type'),
            minVal = '',
            maxVal = '';

        let params = {
            min: min,
            max: max,
            step: step,
        };

        let paramsCustom = {};

        switch (type) {
            case 'min':
                paramsCustom = {
                    range: type,
                    value: current,
                    slide: function (event, ui) {
                        let $card = $(event.target).closest('.card-counting');
                        let $input = $card.find('.card-counting__value-count');

                        $input.val(ui.value.toLocaleString('ru-RU')).css('width', `${ui.value.toLocaleString().length + 1}ch`);

                        $input.trigger('changeCalculator');
                    },
                    create: function (event, ui) {
                        let $card = $(event.target).closest('.card-counting');
                        $card.find('.card-counting__value-count').val(this.dataset.current);

                        $card.on('change changeRange', ELEMENTS_SELECTOR.rangeMin, function () {
                            minVal = +$(this).val().replace(/\s/g, "").replace(/,/g,"");
                            minVal = Math.floor(minVal);

                            let min = slider.slider('option', 'min');
                            let max = slider.slider('option', 'max');

                            if (minVal < min) {
                                minVal = min;
                            }
                            if (minVal > max) {
                                minVal = max;
                            }

                            $card.find(ELEMENTS_SELECTOR.rangeMin)
                                .val(minVal.toLocaleString('ru-RU'))
                                .css('width', `${minVal.toLocaleString().length + 1}ch`);

                            slider.slider('option','value', minVal);
                        });
                    },
                };
                break;
            default:
                minVal = +$(this).find(ELEMENTS_SELECTOR.rangeMin).val(),
                maxVal = +$(this).find(ELEMENTS_SELECTOR.rangeMax).val();

                if (minVal < min) {
                    minVal = min;
                }
                if (maxVal > max) {
                    maxVal = max;
                }
                if (minVal > maxVal) {
                    maxVal = minVal;
                }

                paramsCustom = {
                    range: true,
                    values: [minVal, maxVal],
                    slide: function(event, ui) {
                        let $parent = $(event.target).closest(ELEMENTS_SELECTOR.ranges)

                        $parent.find(ELEMENTS_SELECTOR.rangeMin).val(ui.values[0].toLocaleString('ru-RU'));
                        $parent.find(ELEMENTS_SELECTOR.rangeMax).val(ui.values[1].toLocaleString('ru-RU'));
                    },
                    create: function(event, ui) {
                        let $parent = $(event.target).closest(ELEMENTS_SELECTOR.ranges);
                        let $inputMin = $parent.find(ELEMENTS_SELECTOR.rangeMin);
                        let $inputMax = $parent.find(ELEMENTS_SELECTOR.rangeMax);
                        let $inputMinValue = parseFloat(+$inputMin.val().trim().replace(/\s/g,'')).toLocaleString('ru-RU');
                        let $inputMaxValue = parseFloat(+$inputMax.val().trim().replace(/\s/g,'')).toLocaleString('ru-RU');

                        let $filterAction = $(".filter__action");
                        let $submit = $filterAction.find('.button');
                        let $filterForm = $filterAction.closest('form');

                        $inputMin.val($inputMinValue);
                        $inputMax.val($inputMaxValue);

                        $submit.on('click', function(e) {

                            let $inputMinCurrent = $parent.find(ELEMENTS_SELECTOR.rangeMin);
                            let $inputMaxCurrent = $parent.find(ELEMENTS_SELECTOR.rangeMax);
                            let $inputMinValue = parseFloat(+$inputMinCurrent.val().trim().replace(/\s/g,''));
                            let $inputMaxValue = parseFloat(+$inputMaxCurrent.val().trim().replace(/\s/g,''));

                            $inputMinCurrent.val($inputMinValue);
                            $inputMaxCurrent.val($inputMaxValue);

                            $filterForm.submit();
                        })

                        $parent.on('change', ELEMENTS_SELECTOR.rangeMin, function(){
                            minVal = +$(this).val().trim().replace(/\s/g,'');
                            maxVal = +$parent.find(ELEMENTS_SELECTOR.rangeMax).val().trim().replace(/\s/g,'');
                            
                            let maxValNum = Math.floor(parseFloat(maxVal));
                            let minValNum = Math.floor(parseFloat(minVal));
        
                            if (minValNum < min) {
                                minValNum = min;
                            }
        
                            if (minValNum > max) {
                                minValNum = max;
                            }
        
                            if (minValNum > maxValNum) {
                                maxValNum = minValNum;
                            }
                        
                            $parent.find(ELEMENTS_SELECTOR.rangeMin).val(minValNum.toLocaleString('ru-RU'));
                            $parent.find(ELEMENTS_SELECTOR.rangeMax).val(maxValNum.toLocaleString('ru-RU'));
        
                            slider.slider( 'option','values',[minValNum,maxValNum]);
                        });
                
                        $parent.on('change', ELEMENTS_SELECTOR.rangeMax, function(){
                            maxVal = +$(this).val().trim().replace(/\s/g,'');
                            minVal = +$parent.find(ELEMENTS_SELECTOR.rangeMin).val().trim().replace(/\s/g,'');
                            let maxValNum = Math.floor(parseFloat(maxVal));
                            let minValNum = Math.floor(parseFloat(minVal));

                            if (maxValNum < minValNum) {
                                maxValNum = min;
                            }
        
                            if (maxValNum > max) {
                                maxValNum = max;
                            }
        
                            if (maxValNum < minValNum) {
                                minValNum = maxValNum;
                            }
                            
                            $parent.find(ELEMENTS_SELECTOR.rangeMin).val(minValNum.toLocaleString('ru-RU'));
                            $parent.find(ELEMENTS_SELECTOR.rangeMax).val(maxValNum.toLocaleString('ru-RU'));
        
                            slider.slider( 'option','values',[minValNum,maxValNum]);
                        });
                    },
                };
                break;
        };

        params = $.extend(params, paramsCustom);

        // Init
        slider.slider(params);
    });
};

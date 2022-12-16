import "jquery-ui/ui/widgets/slider";

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
            current = slider.data('current'),
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

                        $input.val(ui.value.toLocaleString()).css('width', `${ui.value.toLocaleString().length + 1}ch`);

                        $input.trigger('changeCalculator');
                    },
                    create: function (event, ui) {
                        let $card = $(event.target).closest('.card-counting');
                        $card.find('.card-counting__value-count').val(this.dataset.current);

                        $card.on('change changeRange', ELEMENTS_SELECTOR.rangeMin, function () {
                            minVal = +$(this).val().replace(/\s/g, "");
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
                                .val(minVal.toLocaleString())
                                .css('width', `${minVal.toLocaleString().length + 1}ch`);

                            slider.slider('option','value', minVal);
                        });
                    },
                };
                break;
            default:
                minVal = +$(this).find(ELEMENTS_SELECTOR.rangeMin).val() ? +$(this).find(ELEMENTS_SELECTOR.rangeMin).val() : min,
                maxVal = +$(this).find(ELEMENTS_SELECTOR.rangeMax).val() ? +$(this).find(ELEMENTS_SELECTOR.rangeMax).val() : max;

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
                        let $inputMinValue = parseFloat($parent.find(ELEMENTS_SELECTOR.rangeMin).val()).toLocaleString('ru-RU');
                        let $inputMaxValue = parseFloat($parent.find(ELEMENTS_SELECTOR.rangeMax).val()).toLocaleString('ru-RU');
                        let $filterAction = $(".filter__action");
                        let $submit = $filterAction.find('.button');

                        $inputMin.val($inputMinValue);
                        $inputMax.val($inputMaxValue);

                        $submit.on('click', function(e) {
                            let $inputMin = $parent.find(ELEMENTS_SELECTOR.rangeMin);
                            let $inputMax = $parent.find(ELEMENTS_SELECTOR.rangeMax);
                            let $inputMinValue = parseFloat($parent.find(ELEMENTS_SELECTOR.rangeMin).val().replace(/\s/g,''));
                            let $inputMaxValue = parseFloat($parent.find(ELEMENTS_SELECTOR.rangeMax).val().replace(/\s/g,''));

                            $inputMin.val($inputMinValue);
                            $inputMax.val($inputMaxValue);
                        })

                        $parent.on('change', ELEMENTS_SELECTOR.rangeMin, function(){
                            let maxValReplace = $parent.find(ELEMENTS_SELECTOR.rangeMax).val().replace(/\s/g,'').trim();
                            let maxValNum = parseFloat(maxValReplace);
                            let minValNum = parseFloat(minVal);

                            minVal = +$(this).val().trim();
                            maxVal = +maxValNum;
        
                            if (minVal < min) {
                                minVal = min;
                            }
        
                            if (minVal > max) {
                                minVal = max;
                            }
        
                            if (minVal > maxVal) {
                                maxVal = minVal;
                            }

                            let minValString = minVal.toLocaleString('ru-RU');
                            let maxValString =maxVal.toLocaleString('ru-RU');

                            $parent.find(ELEMENTS_SELECTOR.rangeMin).val(minValString);
                            $parent.find(ELEMENTS_SELECTOR.rangeMax).val(maxValString);
        
                            slider.slider( 'option','values',[minVal,maxVal]);
                        });
                
                        $parent.on('change', ELEMENTS_SELECTOR.rangeMax, function(){
                            let minValReplace = $parent.find(ELEMENTS_SELECTOR.rangeMin).val().replace(/\s/g,'').trim();
                            let maxValNum = parseFloat(maxVal);
                            let minValNum = parseFloat(minValReplace);
                            
                            maxVal = +$(this).val().trim();
                            minVal = +minValNum;
                            
                            if (maxVal < minVal) {
                                maxVal = min;
                            }
        
                            if (maxVal > max) {
                                maxVal = max;
                            }
        
                            if (maxVal < minVal) {
                                minVal = maxVal;
                            }

                            let minValString = minVal.toLocaleString('ru-RU');
                            let maxValString =maxVal.toLocaleString('ru-RU');
                            
                            $parent.find(ELEMENTS_SELECTOR.rangeMin).val(minValString);
                            $parent.find(ELEMENTS_SELECTOR.rangeMax).val(maxValString);
        
                            slider.slider( 'option','values',[minVal,maxVal]);
                        });
        
                        $parent.on('change', `${ELEMENTS_SELECTOR.rangeMax}, ${ELEMENTS_SELECTOR.rangeMin}`, function (e) {
                            let valReplace = $(this).val().replace(/\s/g,'').trim();
                            let valNum = parseFloat(valReplace);
                            let val = +valNum;
                            let valString = val.toLocaleString('ru-RU');
    
                            $(this).val(valString);
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

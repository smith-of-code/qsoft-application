import "jquery-ui/ui/widgets/slider";

const ELEMENTS_SELECTOR = {
    ranges: '[data-range]',
    rangeSlider: '[data-range-slider]',
    rangeMin: '[data-range-min]',
    rangeMax: '[data-range-max]',
};

export default function(){
    $(ELEMENTS_SELECTOR.ranges).each(function(){
        let slider = $(this).find(ELEMENTS_SELECTOR.rangeSlider),
            min = slider.data('min'),
            max = slider.data('max'),
            step = slider.data('step'),
            minVal = +$(this).find(ELEMENTS_SELECTOR.rangeMin).val() ? +$(this).find(ELEMENTS_SELECTOR.rangeMin).val() : min,
            maxVal = +$(this).find(ELEMENTS_SELECTOR.rangeMax).val()? +$(this).find(ELEMENTS_SELECTOR.rangeMax).val() : max;

        // Init
        slider.slider({
            range: true,
            min: min,
            max: max,
            step: step,
            values: [minVal, maxVal],
            slide: function(event, ui) {
                let $parent = $(event.target).closest(ELEMENTS_SELECTOR.ranges)
                $parent.find(ELEMENTS_SELECTOR.rangeMin).val(ui.values[0]);
                $parent.find(ELEMENTS_SELECTOR.rangeMax).val(ui.values[1]);
            },
            create: function(event, ui) {
                let $parent = $(event.target).closest(ELEMENTS_SELECTOR.ranges)

                $parent.on('change', ELEMENTS_SELECTOR.rangeMin, function(){
                    minVal = +$(this).val().trim();
                    maxVal = +$parent.find(ELEMENTS_SELECTOR.rangeMax).val().trim();

                    if (minVal < min) {
                        minVal = min;
                    }

                    if (minVal > max) {
                        minVal = max;
                    }

                    if (minVal > maxVal) {
                        maxVal = minVal;
                    }

                    $parent.find(ELEMENTS_SELECTOR.rangeMin).val(minVal);
                    $parent.find(ELEMENTS_SELECTOR.rangeMax).val(maxVal);

                    slider.slider( 'option','values',[minVal,maxVal]);
                });
        
                $parent.on('change', ELEMENTS_SELECTOR.rangeMax, function(){
                    maxVal = +$(this).val().trim();
                    minVal = +$parent.find(ELEMENTS_SELECTOR.rangeMin).val().trim();

                    if (maxVal < min) {
                        maxVal = min;
                    }

                    if (maxVal > max) {
                        maxVal = max;
                    }

                    if (maxVal < minVal) {
                        minVal = maxVal;
                    }

                    $parent.find(ELEMENTS_SELECTOR.rangeMin).val(minVal);
                    $parent.find(ELEMENTS_SELECTOR.rangeMax).val(maxVal);

                    slider.slider( 'option','values',[minVal,maxVal]);
                });

                $parent.on('change', `${ELEMENTS_SELECTOR.rangeMax}, ${ELEMENTS_SELECTOR.rangeMin}`, function (e) {
                    let val = +$(this).val().trim();
                    $(this).val(Math.floor(val));
                });
            }
        });
    })
}
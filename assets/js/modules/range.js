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

                $parent.find(ELEMENTS_SELECTOR.rangeMin).on('keyup', function(){
                    minVal = +$(this).val().trim();
                    slider.slider( 'option','values',[minVal,maxVal]);
                })
        
                $parent.find(ELEMENTS_SELECTOR.rangeMax).on('keyup', function(){
                    maxVal = +$(this).val().trim()
                    slider.slider( 'option','values',[minVal,maxVal]);
                })
            }
        });
    })
}
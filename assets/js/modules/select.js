import select2 from 'select2';
import 'jquery.nicescroll';

const ELEMENTS_SELECTOR = {
    selectBox: '[data-select]',
    selectControl: '[data-select-control]',
    select2Container: '.select2-container',
}

export default function () {
    function initSelect() {
        const baseOptions = {

        };

        const scrollOptions = {
            autohidemode: "leave",
            railpadding: { top: 0, right: 0, left: 6, bottom: 0 },
        }

        $(ELEMENTS_SELECTOR.selectControl).each(function(index, select) {
            const $selectBox = $(select).closest(ELEMENTS_SELECTOR.selectBox);

            const placeholder = $(select).attr('data-placeholder');

            const currentOptions = {
                ...baseOptions,
                placeholder,
                dropdownParent: $selectBox,
            };

            $(select)
                .select2(currentOptions)
                .on('select2:open', function(e) {
                    const $select = $(this);
                    const $selectContainer = $select.siblings('.select2-container');
                    const $selectList = $selectContainer.find('.select2-results__options');

                    $selectList.niceScroll(scrollOptions);
                });
        });
    }

    initSelect();
    window.initSelect = initSelect;
}
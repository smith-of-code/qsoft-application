import select2 from 'select2';
import 'jquery.nicescroll';

const ELEMENTS_SELECTOR = {
    selectBox: '[data-select]',
    selectControl: '[data-select-control]',
    select2Container: '.select2-container',
}

export default function () {
    /**
     * Инициализирует селекты с плагином select2
     * @param jqObj объект JQuery (контейнер, в котором нужно проинициализировать селекты). Если не задан - инициализирует все селекты в BODY
     */
    function initSelect(jqObj = undefined) {
        const baseOptions = {
            templateResult: formatState,
            templateSelection: formatState,
        };

        function formatState (state) {
            let before = $(state.element).data('option-before') ? $(state.element).data('option-before') : '';
            let after = $(state.element).data('option-after') ? $(state.element).data('option-after') : '';

            let classItem = (before || after) ? 'select__item--inlined' : '';

            let result = $(`
                <span class="select__item ${classItem}">
                    ${before}
                    ${state.text}
                    ${after}
                </span>
            `);

            return result;
        };

        function searchDisabled (element) {
            let searchfield = element.parent().find('.select2-search__field');
            searchfield.prop('disabled', true);
        }

        const scrollOptions = {
            autohidemode: "leave",
            railpadding: { top: 0, right: 0, left: 6, bottom: 0 },
        }

        var selectsContainer = $(document.body);

        if (typeof jqObj != 'undefined') {
            selectsContainer = jqObj;
        }

        selectsContainer.find(ELEMENTS_SELECTOR.selectControl).each(function(index, select) {
            const $selectBox = $(select).closest(ELEMENTS_SELECTOR.selectBox);

            const petsBreed = $selectBox.data('pets-breed');
            if (petsBreed != undefined) {
                baseOptions.language = {
                    "noResults": ()=>{
                        return "Выберите тип питомца";
                    }
                };
            }

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
                })
                .on('select2:close', function() {
                    const select = $(this);
                    const multiple = select.attr('multiple');

                    if (typeof multiple !== 'undefined' && multiple !== false) {
                        select.closest('[data-select]').find('.select2-selection__rendered').html(()=>{
                            let counter = select.select2('data').length;
                            if (counter > 0) {
                                return `<li class="select2-selection__rendered-item">Выбрано: ${counter}<li>`;
                            }
                        });
                    }
                })
                .on('select2:opening select2:closing', function() {
                    searchDisabled($(this));
                });
        });
    }

    initSelect();
    window.initSelect = initSelect;
}
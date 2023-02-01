const ELEMENTS_SELECTOR = {
    input: '[data-replace-input]',
};

export default function inputRepalece(inputItem) {
    let input = $(ELEMENTS_SELECTOR.input);
    
    input.each(function () {
        $(this).on('input', function() {
            let inputAttr = $(this).attr('data-replace-input');
            
            if (inputAttr === 'number') {
                $(this).val($(this).val().replace(/[^0-9]/g, ''));
                return
            } else if (inputAttr === 'text') {
                $(this).val($(this).val().replace(/[0-9]/g, ''));
                return  
            } else if (inputAttr === 'fullName') {
                $(this).val($(this).val().replaceAll(/[^a-zA-Zа-яА-ЯёЁ-]+/gu, '').slice(0, 100));
            }
        });
    });
}
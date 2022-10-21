const ELEMENTS_SELECTOR = {
    button: '[data-profile-edit]',
    block: '[data-profile-block]',
    readonly: '[data-profile-readonly]',
    form: '[data-profile-form]',
    cancel: '[data-profile-form-cancel]',
};

function toggleEdit(element, type='add') {
    let block = element.closest(ELEMENTS_SELECTOR.block);

    if (type == 'remove') {
        block.removeClass('profile__block--edit');
    } else {
        block.addClass('profile__block--edit');
    }

    block.find(ELEMENTS_SELECTOR.readonly).attr('readonly', (index, attr) => {
        return attr == 'readonly' ? null : 'readonly';
    });
}

export default function () {
    
    $(document).on('click', ELEMENTS_SELECTOR.button, function () {
        toggleEdit($(this));
    });

    $(document).on('submit', ELEMENTS_SELECTOR.form, function(e) {
        e.preventDefault();

        toggleEdit($(this), 'remove');
    });

    $(document).on('click', ELEMENTS_SELECTOR.cancel, function(e) {
        e.preventDefault();

        toggleEdit($(this), 'remove');
    });

}
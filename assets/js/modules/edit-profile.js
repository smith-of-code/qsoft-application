import validation from './validation';

const ELEMENTS_SELECTOR = {
    button: '[data-profile-edit]',
    block: '[data-profile-block]',
    readonly: '[data-profile-readonly]',
    form: '[data-profile-form]',
    cancel: '[data-profile-form-cancel]',
};

export default function () {
    $(document).on('click', ELEMENTS_SELECTOR.button, function () {
        let block = $(this).closest(ELEMENTS_SELECTOR.block);

        block.addClass('profile__block--edit');

        block.find(ELEMENTS_SELECTOR.readonly).attr('readonly', (index, attr) => {
            return attr == 'readonly' ? null : 'readonly';
        });
    });

    $(document).on('click', ELEMENTS_SELECTOR.cancel, function(e) {
        e.preventDefault();

        location.reload();
    });

    validate();
}

function validate() {
    let forms = $('[data-validation="profile"]');
    forms.each((id, elem)=>{
        $(elem).validate();
    });
}
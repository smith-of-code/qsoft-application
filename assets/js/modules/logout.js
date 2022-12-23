const ELEMENTS_SELECTOR = {
    button: '[data-logout]',
};

export default function() {
    $(ELEMENTS_SELECTOR.button).on('click', async function () {
        await BX.ajax.runComponentAction('zolo:logout', 'logout', { mode: 'class' });
        window.location.href = '/';
    });
};

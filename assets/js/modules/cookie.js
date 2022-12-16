const COOKIE_NAME = 'cookieConfirmed';

const ELEMENTS_SELECTOR = {
    cookie_modal: '#cookie',
    cookie_accept: '[data-cookie-accept]',
};

function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
}

function setCookie(name, value) {
    document.cookie = `${name}=${value || ''}; path=/;max-age=31536000`;
}

export default function () {
    const cookie = getCookie(COOKIE_NAME);

    if (!cookie) {
        $.fancybox.open({ src: ELEMENTS_SELECTOR.cookie_modal });

        $(document).on('click', ELEMENTS_SELECTOR.cookie_accept, function() {
            $.fancybox.close({ src: ELEMENTS_SELECTOR.cookie_modal });
            setCookie(COOKIE_NAME, true);
        });
    }
}

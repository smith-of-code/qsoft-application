const ELEMENTS_SELECTOR = {
    icon: '[data-password-toggle]',
    block: '[data-password-block]',
    container: '[data-password-container]',
    input: '[data-password-input]',
    generate: '[data-password-generate]',
};

export default function showPassword() {
    $(document).on('click', ELEMENTS_SELECTOR.icon, function () {
        const $parent = $(this).closest(ELEMENTS_SELECTOR.block);
        const $input = $parent.find(ELEMENTS_SELECTOR.input);

        if ($input.attr('type') == 'password') {
            $(this).addClass('input__icon-password--show');
            $input.attr('type', 'text');
        } else {
            $(this).removeClass('input__icon-password--show');
            $input.attr('type', 'password');
        }
    });

    $(document).on('click', ELEMENTS_SELECTOR.generate, function () {
        $(this).closest(ELEMENTS_SELECTOR.container).find(ELEMENTS_SELECTOR.input).val(Password.generate());
    });
    $(document).on('input', ELEMENTS_SELECTOR.input, function(){
        this.value = this.value.replace(/[А-Яа-я]/gi, '');
    });
}

const Password = {
    _pattern : /[a-zA-Z0-9_\-\+\.]/,

    getRandomByte() {
        let result;
        if (window.crypto && window.crypto.getRandomValues) {
            result = new Uint8Array(1);
            window.crypto.getRandomValues(result);
            return result[0];
        } else if (window.msCrypto && window.msCrypto.getRandomValues) {
            result = new Uint8Array(1);
            window.msCrypto.getRandomValues(result);
            return result[0];
        } else {
            return Math.floor(Math.random() * 256);
        }
    },

    generate(length = 8) {
        return Array
            .apply(null, { length })
            .map(() => {
                let result;
                while(true) {
                    result = String.fromCharCode(this.getRandomByte());
                    if (this._pattern.test(result)) {
                        return result;
                    }
                }
            }, this)
            .join('');
    }

};
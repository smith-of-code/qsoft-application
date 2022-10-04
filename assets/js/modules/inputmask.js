import Inputmask from "inputmask";

const ELEMENTS_SELECTOR = {
    dateMask: '[data-mask-date]',
    phoneMask: '[data-phone]',
    emailMask: '[data-mail]',
    seriaMask: '[data-passport-seria]',
    numberMask: '[data-passport-number]',
    innMask: '[data-inn]',
    bikMask: '[data-bik]',
};

const MASKS = {
    dateMask: 'дд.мм.гггг',
    phoneMask: '+7 (999) 999-99-99',
    emailMask: 'email',
    seriaMask: '99 99',
    numberMask: '99 99 99',
    innMask: '999999999999',
    bikMask: '999999999',
};

const OPTIONS = {
    placeholder: {
        placeholder: '',
    },
};


export default function inputMaskInit($container) {
    if (!($container instanceof $)){
        $container = $(document);
    }

    Inputmask(MASKS.phoneMask).mask($container.find(ELEMENTS_SELECTOR.phoneMask));
    Inputmask(MASKS.dateMask).mask($container.find(ELEMENTS_SELECTOR.dateMask));
    Inputmask(MASKS.emailMask).mask($container.find(ELEMENTS_SELECTOR.emailMask));
    Inputmask(MASKS.seriaMask).mask($container.find(ELEMENTS_SELECTOR.seriaMask));
    Inputmask(MASKS.numberMask).mask($container.find(ELEMENTS_SELECTOR.numberMask));
    Inputmask(MASKS.innMask).mask($container.find(ELEMENTS_SELECTOR.innMask));
    Inputmask(MASKS.bikMask).mask($container.find(ELEMENTS_SELECTOR.bikMask));
}
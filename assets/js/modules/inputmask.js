import Inputmask from "inputmask";

const ELEMENTS_SELECTOR = {
    dateMask: '[data-mask-date]',
    phoneMask: '[data-phone]',
    emailMask: '[data-mail]',
    seriaMask: '[data-passport-seria]',
    numberMask: '[data-passport-number]',
    kppMask: '[data-kpp]',
    innMask: '[data-inn]',
    shortInnMask: '[data-short-inn]',
    ogrnipMask: '[data-ogrnip]',
    ogrnMask: '[data-ogrn]',
    bikMask: '[data-bik]',
};

const MASKS = {
    dateMask: '99.99.9999',
    phoneMask: '+7 (999) 999-99-99',
    emailMask: 'email',
    seriaMask: '99 99',
    numberMask: '99 99 99',
    kppMask: '999999999',
    innMask: '999999999999',
    shortInnMask: '9999999999',
    ogrnipMask: '999999999999999',
    ogrnMask: '9999999999999',
    bikMask: '999999999',
};

const OPTIONS = {
    placeholder: {
        placeholder: '',
    },
};


export default function inputMaskInit($container, mask) {
    if (!($container instanceof $)){
        $container = $(document);
    }
    if (mask) {
        Inputmask(MASKS[mask])?.mask($container.find(ELEMENTS_SELECTOR[mask]));
        return;
    }

    Inputmask(MASKS.phoneMask)?.mask($container.find(ELEMENTS_SELECTOR.phoneMask));
    Inputmask(MASKS.dateMask)?.mask($container.find(ELEMENTS_SELECTOR.dateMask));
    Inputmask(MASKS.emailMask)?.mask($container.find(ELEMENTS_SELECTOR.emailMask));
    Inputmask(MASKS.seriaMask)?.mask($container.find(ELEMENTS_SELECTOR.seriaMask));
    Inputmask(MASKS.numberMask)?.mask($container.find(ELEMENTS_SELECTOR.numberMask));
    Inputmask(MASKS.kppMask)?.mask($container.find(ELEMENTS_SELECTOR.kppMask));
    Inputmask(MASKS.innMask)?.mask($container.find(ELEMENTS_SELECTOR.innMask));
    Inputmask(MASKS.shortInnMask)?.mask($container.find(ELEMENTS_SELECTOR.shortInnMask));
    Inputmask(MASKS.ogrnipMask)?.mask($container.find(ELEMENTS_SELECTOR.ogrnipMask));
    Inputmask(MASKS.ogrnMask)?.mask($container.find(ELEMENTS_SELECTOR.ogrnMask));
    Inputmask(MASKS.bikMask)?.mask($container.find(ELEMENTS_SELECTOR.bikMask));

    const addButton = $(".pet-cards__adding").find("button");

    addButton.on("click", () => {
        Inputmask(MASKS.dateMask)?.mask($container.find(ELEMENTS_SELECTOR.dateMask));
    })
}
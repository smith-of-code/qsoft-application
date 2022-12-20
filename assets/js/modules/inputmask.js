import Inputmask from "inputmask";

const ELEMENTS_SELECTOR = {
    dateMask: '[data-mask-date]',
    dateMaskReg: '[data-mask-date-reg]',
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
    dateMask: 'Dd.Mm.yyyy',
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

    const date = new Date().getFullYear();
    const dateYearSplitted = date.toString().split('');
    const dateOneNum = dateYearSplitted[0];
    const dateTwoNum = dateYearSplitted[1];
    const dateThreeNum = dateYearSplitted[2];
    const dateFourNum = dateYearSplitted[3];
  
    const addButton = $(".pet-cards__adding").find("button");

    function searchEditButton() {
        const editButton = $('[data-tippy-content="Редактировать"]');

        editButton.each((index, item) => {
            $(item).on('click', () => {
                Inputmask(MASKS.dateMask, OPTIONS_DATE)?.mask($container.find(ELEMENTS_SELECTOR.dateMask));
            })
        })
    }
    searchEditButton();
    
    addButton.on("click", () => {
        Inputmask(MASKS.dateMask, OPTIONS_DATE)?.mask($container.find(ELEMENTS_SELECTOR.dateMask));

        setTimeout(() => {
            inputChange()
        }, 500);

        const saveButton = $(".pet-card__button-save");
 
        saveButton.each((index, item) => {
            $(item).on('click', () => {
                setTimeout(() => {
                    searchEditButton();
                }, 500);
            })
        })
    })

    //Настройка маски для dateMask
    Inputmask.extendDefinitions({
        'y': {
            validator: function (chrs, buffer, pos, strict, opts) {
                let valExp

                if (pos === 6) {
                    valExp = new RegExp(`[1-${dateOneNum}]`);
                } else if (pos === 7) {
                    if (buffer.buffer[6] === "1") {
                        valExp = new RegExp("[9]");
                    } else {
                        valExp = new RegExp(`[${dateTwoNum}]`);
                    }
                } else if (pos === 8) {
                    if (buffer.buffer[7] === '9') {
                        valExp = new RegExp('[0-9]');
                    } else {
                        valExp = new RegExp(`[0-${dateThreeNum}]`);
                    }
                    
                } else if (pos === 9) {
                    if (buffer.buffer[7] === '9') {
                        valExp = new RegExp('[0-9]');
                    } else if (buffer.buffer[8] === dateThreeNum) {
                        valExp = new RegExp(`[0-${dateFourNum}]`);
                    } else {
                        valExp = new RegExp('[0-9]');
                    }
                }
                return valExp.test(chrs);
            },
          },

        "M": {
            validator: function (chrs, buffer, pos, strict, opts) { 
                let valExp = new RegExp(`[0-1]`);

                return valExp.test(chrs);
            },
        },

        "m": {
            validator: function (chrs, buffer, pos, strict, opts) {
                let valExp
                
                if (buffer.buffer[3] === '0') {
                    valExp = new RegExp(`[1-9]`);
                } else {
                    valExp = new RegExp(`[012]`);
                }
            
                return valExp.test(chrs);
            },
        },

        "D": {
            validator: function (chrs, buffer, pos, strict, opts) {
                var valExp = new RegExp("[0-3]");
                return valExp.test(chrs);
            },
        },

        "d": {
            validator: function (chrs, buffer, pos, strict, opts) {
                let valExp

                if (buffer.buffer[0] === '3') {
                    valExp = new RegExp(`[01]`);
                } else {
                    valExp = new RegExp("[0-9]");
                }

                return valExp.test(chrs);
            },
        },
    })

    
    function validInputDate(e) {
        let currVal = $(e.target).val();
        let dateSplitted = currVal.toString().split('.');
        let day = dateSplitted[0];
        let month = dateSplitted[1];
        let year = dateSplitted[2];
        let today = new Date();
        let birthDate = new Date(`${year}.${month}.${day}`);
        let age = today.getFullYear() - birthDate.getFullYear();
        let m = today.getMonth() - birthDate.getMonth();

        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        } 

        let item = $(e.target);
        let parent = item.parent();
        let message = parent.find('.input__control-error--mask');
        let buttonNext = $('[data-direction="next"]');
        let buttonSavePersonal = $('.profile__button-personal');
        
        if (age < 18) {
            item.addClass('input__control--error-mask');
            message.show();
            message.html('Некорректная дата. Вам должно быть больше 18-ти лет');
            buttonNext.prop('disabled', true).addClass('button--disabled');
            buttonSavePersonal.prop('disabled', true).addClass('button--disabled');
         
        } else {
            item.removeClass('input__control--error-mask');
            message.hide();
            buttonNext.prop('disabled', false).removeClass('button--disabled');
            buttonSavePersonal.prop('disabled', false).removeClass('button--disabled');
        }
    }

    function clearInput(e) {
        let item = $(e.target);
        let parent = item.parent();
        let message = parent.find('.input__control-error--mask');
        let buttonNext = $('[data-direction="next"]');

        item.removeClass('input__control--error-mask');
        buttonNext.prop('disabled', false).removeClass('button--disabled');
        message.hide();
    }

    function inputChange() {
        const inputDate = $(ELEMENTS_SELECTOR.dateMask);
        const inputDateReg = $(ELEMENTS_SELECTOR.dateMaskReg);
        let buttonSavePet = $(document).find('.pet-card__button-save');
        let buttonSaveProf = $(document).find('.profile__button-save');
        let buttonNext = $('[data-direction="next"]');

        inputDate?.each( (index, item) => {
            $(item).on('input', function(e) {
                const target = $(e.target);
                const attr = target.attr('id')
                const input = $(e.target).val().replace(/[^0-9]/g, '');
                const length = input.length;
                
                if (length < 8) {
                    if (attr === 'getting_date') {
                        buttonSaveProf.prop('disabled', true).addClass('button--disabled');
                    }  else if(attr === 'birthdate') {
                        buttonNext.prop('disabled', true).addClass('button--disabled');
                    }
                   
                } else {
                    buttonSaveProf.prop('disabled', false).removeClass('button--disabled');
                    buttonNext.prop('disabled', false).removeClass('button--disabled');
                }

                if(length === 0) {
                    if (attr === 'getting_date') {
                        buttonSaveProf.prop('disabled', false).removeClass('button--disabled');
                    }
                }

            })
        })

        inputDateReg?.each( (index, item) => {
            $(item).on('input', function(e) {
                const input = $(e.target).val().replace(/[^0-9]/g, '');
                const length = input.length;
                let buttonSavePersonal = $('.profile__button-personal');

                if (length < 8) {
                    buttonNext.prop('disabled', true).addClass('button--disabled');
                    buttonSavePersonal.prop('disabled', true).addClass('button--disabled');
                } else {
                    buttonNext.prop('disabled', false).removeClass('button--disabled');
                    buttonSavePersonal.prop('disabled', false).removeClass('button--disabled');
                }
            })
        })
    }
    inputChange();
   
    const OPTIONS_REG = {
        alias: "datatime", 
        "clearMaskOnLostFocus": true, 
        "clearIncomplete": true, 
        "oncomplete": validInputDate,
        "oncleared" : clearInput
    }

    const OPTIONS_DATE = {
        alias: "datatime", 
        "clearMaskOnLostFocus": true, 
        "clearIncomplete": true,
    }

    Inputmask(MASKS.phoneMask)?.mask($container.find(ELEMENTS_SELECTOR.phoneMask));
    Inputmask(MASKS.dateMask, OPTIONS_DATE)?.mask($container.find(ELEMENTS_SELECTOR.dateMask));
    Inputmask(MASKS.dateMask, OPTIONS_REG)?.mask($container.find(ELEMENTS_SELECTOR.dateMaskReg));
    Inputmask(MASKS.emailMask)?.mask($container.find(ELEMENTS_SELECTOR.emailMask));
    Inputmask(MASKS.seriaMask)?.mask($container.find(ELEMENTS_SELECTOR.seriaMask));
    Inputmask(MASKS.numberMask)?.mask($container.find(ELEMENTS_SELECTOR.numberMask));
    Inputmask(MASKS.kppMask)?.mask($container.find(ELEMENTS_SELECTOR.kppMask));
    Inputmask(MASKS.innMask)?.mask($container.find(ELEMENTS_SELECTOR.innMask));
    Inputmask(MASKS.shortInnMask)?.mask($container.find(ELEMENTS_SELECTOR.shortInnMask));
    Inputmask(MASKS.ogrnipMask)?.mask($container.find(ELEMENTS_SELECTOR.ogrnipMask));
    Inputmask(MASKS.ogrnMask)?.mask($container.find(ELEMENTS_SELECTOR.ogrnMask));
    Inputmask(MASKS.bikMask)?.mask($container.find(ELEMENTS_SELECTOR.bikMask));
}
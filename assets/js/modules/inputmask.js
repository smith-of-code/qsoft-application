import Inputmask from "inputmask";

const ELEMENTS_SELECTOR = {
    dateMask: '[data-mask-date]',
    dateMaskReg: '[data-mask-date-reg]',
    dateMaskDelivery: '[data-mask-date-delivery]',
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
    postMaskReg: '[data-mask-post-reg]',
    postMaskLiving: '[data-mask-post-living]'
};

const MASKS = {
    dateMask: 'Dd.Mm.yyyy',
    dateMaskDelivery: 'Дд.Мм.гггг',
    phoneMask: '+7 (999) 999-99-99',
    emailMask: 'email',
    seriaMask: '99 99',
    numberMask: '999999',
    kppMask: '999999999',
    innMask: '999999999999',
    shortInnMask: '9999999999',
    ogrnipMask: '999999999999999',
    ogrnMask: '9999999999999',
    bikMask: '999999999',
    postMask: '999 999'
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

    const date = new Date();
    const dateDay = date.getUTCDate();
    const dateMonth = date.getMonth() + 1;
    const dateYear = date.getFullYear();
    const dateYearSplitted = dateYear.toString().split('');
    const dateOneNum = dateYearSplitted[0];
    const dateTwoNum = dateYearSplitted[1];
    const dateThreeNum = dateYearSplitted[2];
    const dateFourNum = dateYearSplitted[3];
    const prevDateFourNum = parseInt(dateFourNum) - 1
    const nextDateFourNum = parseInt(dateFourNum) + 1
  
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
                let dataBuffer = buffer.buffer
                let getOneNumDay = dataBuffer[0];
                let getTwoNumDay = dataBuffer[1];
                let getOneNumMonth = dataBuffer[3];
                let getTwoNumMonth = dataBuffer[4];
                let getDay = `${getOneNumDay}${getTwoNumDay}`
                let getMonth = `${getOneNumMonth}${getTwoNumMonth}`

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
                        if (dateDay < getDay && dateMonth <= getMonth) {
                            valExp = new RegExp(`[0-${prevDateFourNum}]`);
                        } else {
                            valExp = new RegExp(`[0-${dateFourNum}]`);
                        }
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
                let getOneNum = buffer.buffer[0]
                let getTwoNum = buffer.buffer[1]
                let getDay = `${getOneNum}${getTwoNum}`
                
                if (buffer.buffer[3] === '0') {
                    if (getDay === '31') {
                        valExp = new RegExp(`[13578]`);
                    } else if (getDay === '30') {
                        valExp = new RegExp(`[13456789]`)
                    } else {
                        valExp = new RegExp(`[1-9]`);
                    }
                    
                } else {
                    if (getDay === '31') {
                        valExp = new RegExp(`[02]`);
                    } else {
                        valExp = new RegExp(`[012]`);
                    }
                    
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
    Inputmask.extendDefinitions({
        'г': {
            validator: function (chrs, buffer, pos, strict, opts) {
                let valExp
                let dataBuffer = buffer.buffer
                let getOneNumDay = dataBuffer[0];
                let getTwoNumDay = dataBuffer[1];
                let getOneNumMonth = dataBuffer[3];
                let getTwoNumMonth = dataBuffer[4];
                let getDay = `${getOneNumDay}${getTwoNumDay}`
                let getMonth = `${getOneNumMonth}${getTwoNumMonth}`

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
                        valExp = new RegExp(`[0-${nextDateFourNum}]`);
                    } else {
                        valExp = new RegExp('[0-9]');
                    }
                }
                return valExp.test(chrs);
            },
          },

        "М": {
            validator: function (chrs, buffer, pos, strict, opts) { 
                let valExp = new RegExp(`[0-1]`);

                return valExp.test(chrs);
            },
        },

        "м": {
            validator: function (chrs, buffer, pos, strict, opts) {
                let valExp
                let getOneNum = buffer.buffer[0]
                let getTwoNum = buffer.buffer[1]
                let getDay = `${getOneNum}${getTwoNum}`
                
                if (buffer.buffer[3] === '0') {
                    if (getDay === '31') {
                        valExp = new RegExp(`[13578]`);
                    } else if (getDay === '30') {
                        valExp = new RegExp(`[13456789]`)
                    } else {
                        valExp = new RegExp(`[1-9]`);
                    }
                    
                } else {
                    if (getDay === '31') {
                        valExp = new RegExp(`[02]`);
                    } else {
                        valExp = new RegExp(`[012]`);
                    }
                    
                }
            
                return valExp.test(chrs);
            },
        },

        "Д": {
            validator: function (chrs, buffer, pos, strict, opts) {
                var valExp = new RegExp("[0-3]");
                return valExp.test(chrs);
            },
        },

        "д": {
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

    function checkInput(e) {
        const input = $(e.target)
        const inputVal = input.val();
        const inputSplit = inputVal.split('.')

        let inputDataDay = inputSplit[0];
        let inputDataMonth = inputSplit[1];
        let inputData = inputSplit[2];
        
        if (inputDataDay == '29' && inputDataMonth == '02') {
            const isLeap = year => new Date(year, 1, 29).getDate() === 29;
            const checkDate = isLeap(inputData);

            if (checkDate) {
                return
            } else {
                inputSplit[0] = '28'
            }

            const inputJoin = inputSplit.join(".")
            const inputChange = input.val(inputJoin);
        } 
    }

    
    function validInputDate(e) {
        checkInput(e)
        let currVal = $(e.target).val();
        let dateSplitted = currVal.toString().split('.');
        let day = dateSplitted[0];
        let month = dateSplitted[1] - 1;
        let year = dateSplitted[2];
        let today = new Date();
        let birthDate = new Date(year,month,day);
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
            message.html('Вам должно быть больше 18-ти лет');
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
        "oncomplete": checkInput,
    }

    Inputmask(MASKS.phoneMask)?.mask($container.find(ELEMENTS_SELECTOR.phoneMask));
    Inputmask(MASKS.dateMask, OPTIONS_DATE)?.mask($container.find(ELEMENTS_SELECTOR.dateMask));
    Inputmask(MASKS.dateMask, OPTIONS_REG)?.mask($container.find(ELEMENTS_SELECTOR.dateMaskReg));
    Inputmask(MASKS.dateMaskDelivery, OPTIONS_DATE)?.mask($container.find(ELEMENTS_SELECTOR.dateMaskDelivery));
    Inputmask(MASKS.emailMask)?.mask($container.find(ELEMENTS_SELECTOR.emailMask));
    Inputmask(MASKS.seriaMask)?.mask($container.find(ELEMENTS_SELECTOR.seriaMask));
    Inputmask(MASKS.numberMask)?.mask($container.find(ELEMENTS_SELECTOR.numberMask));
    Inputmask(MASKS.kppMask)?.mask($container.find(ELEMENTS_SELECTOR.kppMask));
    Inputmask(MASKS.innMask)?.mask($container.find(ELEMENTS_SELECTOR.innMask));
    Inputmask(MASKS.shortInnMask)?.mask($container.find(ELEMENTS_SELECTOR.shortInnMask));
    Inputmask(MASKS.ogrnipMask)?.mask($container.find(ELEMENTS_SELECTOR.ogrnipMask));
    Inputmask(MASKS.ogrnMask)?.mask($container.find(ELEMENTS_SELECTOR.ogrnMask));
    Inputmask(MASKS.bikMask)?.mask($container.find(ELEMENTS_SELECTOR.bikMask));
    Inputmask(MASKS.postMask)?.mask($container.find(ELEMENTS_SELECTOR.postMaskReg));
    Inputmask(MASKS.postMask)?.mask($container.find(ELEMENTS_SELECTOR.postMaskLiving));

    console.log($container.find(ELEMENTS_SELECTOR.postMaskLiving));
}
class CSystemAuthRegistrationComponent {
  constructor() {
      this.initPage();
      this.initListeners();
  }

  initPage() {
      this.checkBreedSelects();
      if (registrationData.type === 'consultant') {
          $('.legal_entity').hide();
          if ($('select[name=status]').val()) {
              $(`.legal_entity.${$('select[name=status]').val()}`).show();
          }
      }
  }

  initListeners() {
      var mainInstance = this;
      $('button[data-change-step]').on('click', this.changeStepListener);

      $('input[name=first_name]').on('input', this.checkFIO);
      $('input[name=second_name]').on('input', this.checkFIO);
      $('input[name=last_name]').on('input', this.checkFIO);
      $('input[name=first_name]').trigger('input');
      $('input[name=second_name]').trigger('input');
      $('input[name=last_name]').trigger('input');
      $('input[name=without_living]').on('click', this.checkLivingBlock);
      $('button[data-send-code]').on('click', this.sendCode);
      $('button[data-verify-code]').on('click', this.verifyCode);
      $('button[data-register]').on('click', this.register);
      $(document).on('change', '.form select', this.removeError);
      $(`.form input[type=checkbox]`).on('change', this.removeError);
      $(`.form input`).on('keyup', this.removeError);
      $('input[name=without_second_name]').on('change', this.blockInputByCheckbox);
      $('select[name=need_proxy]').on('change', this.changeNeedProxy);
      $('input[name=without_mentor_id]').on('change', this.clearInputByCheckbox);
      $('select[name=status]').on('change', this.changeLegalEntity);
      $(document).on('change', 'select[data-pet-kind]', this.checkBreedSelects);
      // Синхронизация чекбокса "Плательщик НДС"
      $("input[name=nds_payer_ip]").on('change', function() {
          $("input[name=nds_payer_ltc]").prop("checked", this.checked);
      });
      $("input[name=nds_payer_ltc]").on('change', function() {
          $("input[name=nds_payer_ip]").prop("checked", this.checked);
      });
      // Синхронизация БИК
      $("input[name=bic]").on('change', function() {
          mainInstance.synchronizeSameFields(this);
      });

      $("#nationality").on('change',function (event){
          if (event.target.value === 'not_russian'){
              $('#passport_info').hide()
          }else {
              $('#passport_info').show()
          }
      })
  }

  synchronizeSameFields(obj) {
      var thatObj = $(obj);
      var sameName = thatObj.attr('name');
      $("input[name="+sameName+"]").each(function () {
          var otherObj = $(this);
          if (otherObj.attr('id') !== thatObj.attr('id')) {
              $(this).val(thatObj.val());
          }
      });
  }

    checkFIO() {
        var input = $(this);
        var value = input.val().toString();
        if (
            input.attr('name') == 'first_name'
            || input.attr('name') == 'last_name'
            || input.attr('name') == 'second_name'
        ) {
            input.val(value.replaceAll(/[^a-zA-Zа-яА-ЯёЁ-]+/gu, '').slice(0, 100));
        }
    }

  checkLivingBlock() {
      const isActive = $('input[name=without_living]:checked').length;

      const locality = $('#living_locality');
      const street = $('#living_street');
      const house = $('#living_house');
      const apartment = $('#living_apartment');
      const postalCode = $('#living_postal_code');

      if (isActive) {
          locality.val('');
          locality.attr('disabled', true);
          locality.removeClass('input__control--error');

          street.val('');
          street.attr('disabled', true);
          street.removeClass('input__control--error');

          house.val('');
          house.attr('disabled', true);
          house.removeClass('input__control--error');

          apartment.val('');
          apartment.attr('disabled', true);
          apartment.removeClass('input__control--error');

          postalCode.val('');
          postalCode.attr('disabled', true);
          postalCode.removeClass('input__control--error');
      } else {
          locality.attr('disabled', false);
          street.attr('disabled', false);
          house.attr('disabled', false);
          apartment.attr('disabled', false);
          postalCode.attr('disabled', false);
      }
  }

    changeNeedProxy() {
      const dropzone = $('input[name=procuration]');
        if ($(`#${$(this).attr('id')}`).val() !== 'true') {
            dropzone.parent().parent().show();
        } else {
            dropzone.parent().parent().hide();
            dropzone.parent().removeClass('dropzone--error');
        }
    }

    changeLegalEntity() {
      $('.legal_entity').hide();
      $(`.legal_entity.${$(this).val()}`).show();
    }

    removeError() {
      switch (true) {
          case ($(this).attr('name') === 'phone' || $(this).attr('name') === 'email') && $(this).val().indexOf('_') !== -1:
          case $(this).attr('name').indexOf('birthdate') !== -1 && !!$(this).val().match(/[A-z]+/i):
              return;
      }

      $(this).removeClass('input__control--error');
      $(this).parent().find('span.input__control-error').remove();
      $(this).closest('.form__field').find('span.input__control-error').remove();
    }

    blockInputByCheckbox() {
      const input = $(`input[name=${$(this).attr('name').replace('without_', '')}]`);
      if ($(`#${$(this).attr('id')}:checked`).length) {
          input.val('');
          input.removeClass('input__control--error');
          input.parent().find('.input__control-error').remove();
          input.attr('disabled', true);
      } else {
          input.attr('disabled', null);
      }
    }

    clearInputByCheckbox() {
        const input = $(`input[name=${$(this).attr('name').replace('without_', '')}]`);
        if ($(`#${$(this).attr('id')}:checked`).length) {
            input.val('');
            input.removeClass('input__control--error');
            input.parent().find('.input__control-error').remove();
        }
    }

    async changeStepListener() {
        if (window.blockedChangeStepListener){return}

        window.blockedChangeStepListener = true

        $('[data-send-code]').css('color', 'black');

        const mentorInput = $('#mentor_id');
        mentorInput.removeClass('input__control--error');
        mentorInput.parent().find('.input__control-error').remove();

        const emailInput = $('#email');
        emailInput.removeClass('input__control--error');
        emailInput.parent().find('.input__control-error').remove();

        const isForwardDirection = $(this).data('direction') === 'next';
        let data = registrationData;

        let notResident = $("#nationality")[0].value === 'not_russian'

        let inputBirthdate = document.querySelector('#birthdate');
        let inputBirthdateVal = $(inputBirthdate).val();
        let dateSplitted = inputBirthdateVal.toString().split('.');
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

        if (isForwardDirection) {
            if (data.currentStep === 'personal_data' && data.confirmedPhone !== $('input[name=phone]').val().replaceAll(/\(|\)|\s|-+/g, '')) {
                $('[data-send-code]').css('color', 'red');
                window.blockedChangeStepListener = false
                return;
            }

            if (data.currentStep === 'pets_data' && data.pets) {
                data.pets = {};
            }

            // Перебираем поля формы
            $(`.${registrationData.currentStep} .form`).find('input, select').each((index, item) => {

                // Игнорируем поля для других статусов
                if (
                    registrationData.currentStep === 'legal_entity_data'
                    && $(item).closest('.legal_entity').length
                    && !$(item).closest('.legal_entity').hasClass(data.status)
                ) {
                    window.blockedChangeStepListener = false
                    return;
                }


                if ($(item).parent().data('breed') === 'empty' && $(item).parent().css('display') !== 'none') {
                    window.blockedChangeStepListener = false
                    return;
                }

                if ($(item).attr('type') === 'hidden' || !$(item).attr('name')) {
                    window.blockedChangeStepListener = false
                    return;
                }

                if ($(item).attr('name').startsWith('pets')) {
                    if ($(item).closest('.pet-card--editing')?.length) {
                        window.blockedChangeStepListener = false
                        return;
                    }
                    if ($(item).attr('name').indexOf('breed') !== -1 && $(item).closest('[data-breed]').css('display') === 'none') {
                        window.blockedChangeStepListener = false
                        return;
                    }

                    const separateKey = $(item).attr('name').split('-');
                    if ($(item).attr('name').indexOf('breed') !== -1) {
                        data[separateKey[0]][separateKey[1]].breed = $(item).val();
                        window.blockedChangeStepListener = false
                        return;
                    }
                    if (!data[separateKey[0]]) data[separateKey[0]] = {};
                    if (!data[separateKey[0]][separateKey[1]]) data[separateKey[0]][separateKey[1]] = {};
                    data[separateKey[0]][separateKey[1]][separateKey[2]] = $(item).val();

                    if (separateKey[2] === 'type' || separateKey[2] === 'gender') {
                        data[separateKey[0]][separateKey[1]][`~${separateKey[2]}`] = $(item).val().split('_')[1].toLowerCase();
                        if (data[separateKey[0]][separateKey[1]][`~${separateKey[2]}`] === 'female') {
                            data[separateKey[0]][separateKey[1]][`~${separateKey[2]}`] = 'woman';
                        }
                        if (data[separateKey[0]][separateKey[1]][`~${separateKey[2]}`] === 'male') {
                            data[separateKey[0]][separateKey[1]][`~${separateKey[2]}`] = 'man';
                        }
                    }
                }
                else if ($(item).attr('type') === 'file') {
                    if ($(item).attr('multiple')) {
                        if ($(item).attr('name') === 'procuration' && $(item).parent().parent().css('display') === 'none') {
                            window.blockedChangeStepListener = false
                            return;
                        }

                        data[$(item).attr('name')] = { files: [] };
                        $(item).parent().find('.file.dz-success.dz-complete').each((index, innerItem) => {
                            data[$(item).attr('name')].files.push({
                                id: $(innerItem).find('input[type=hidden]').val(),
                                name: $(innerItem).find('[data-uploader-preview-filename]').html(),
                                format: $(innerItem).find('[data-uploader-preview-format]').html(),
                                size: $(innerItem).find('[data-uploader-preview-size]').html(),
                            });
                        });

                        if (! data[$(item).attr('name')].files.length &&
                            (
                                (
                                    $(item).attr('name') === 'usn_notification'
                                    && ! $('input[name=nds_payer_ip]:checked').length
                                    && ! $('input[name=nds_payer_ltc]:checked').length
                                )
                                || $(item).attr('name') !== 'usn_notification'

                            )
                        ) {
                            if ($(item).attr('name') === 'bank_details') {
                                window.blockedChangeStepListener = false
                                return;
                            }
                            $(item).parent().addClass('dropzone--error');
                        } else {
                            $(item).parent().removeClass('dropzone--error');
                        }
                    } else {
                        const fileContainer = $(item).parent().find('img.dropzone__previews-picture-image-pic').last();
                        if (fileContainer.attr('alt')) {
                            data[$(item).attr('name')] = {
                                name: fileContainer.attr('alt'),
                                data: fileContainer.attr('src'),
                            };
                        }
                    }
                }
                else if ($(item).attr('type') === 'checkbox') {
                    data[$(item).attr('name')] = !!$(`#${$(item).attr('id')}:checked`).length;
                    if (!data[$(item).attr('name')] && ['agree_with_personal_data_processing', 'agree_with_terms_of_use', 'agree_with_company_rules', 'correctness_confirmation_self_employed', 'correctness_confirmation_ip', 'correctness_confirmation_ltc'].includes($(item).attr('name'))) {
                        $(item).addClass('input__control--error');
                    }
                }
                else if (age < 18) {
                    let parent = $(inputBirthdate).parent();
                    let message = parent.find('.input__control-error--mask');
                    let buttonNext = $('button[data-direction="next"]');

                    $(inputBirthdate).addClass('input__control--error');
                    message.show();
                    message.html('Вам должно быть больше 18-ти лет');
                    buttonNext.prop('disabled', true).addClass('button--disabled');
                }
                else if ($(item).attr('name') === 'register_postal_code') {
                    let indexPost = $("input[name='register_postal_code']");
                    let indexPostValue = indexPost.val().replace(/[^0-9\.]/g,'');
                    if (indexPostValue.length < 6 || indexPostValue.length > 6) {
                        indexPost.addClass('input__control--error');
                    } else {
                        indexPost.removeClass('input__control--error');
                        data[$(item).attr('name')] = $(item).val();
                    }
                    window.blockedChangeStepListener = false
                    return;
                }
                else if ($(item).attr('name') === 'living_postal_code') {
                    let indexPostLiving = $("input[name='living_postal_code']");
                    let indexPostLivingValue = indexPostLiving.val().replace(/[^0-9\.]/g,'');
                    let livingAdress = $('input[name=without_living]:checked').length;
                    if (livingAdress === 0 && (indexPostLivingValue.length > 6 || indexPostLivingValue.length < 6)) {
                        indexPostLiving.addClass('input__control--error');
                    } else {
                        indexPostLiving.removeClass('input__control--error');
                        data[$(item).attr('name')] = $(item).val();
                    }
                    window.blockedChangeStepListener = false
                    return;
                }
                else if ($(item).attr('name') === 'ltc_postal_code') {
                    let indexPostLtc = $("input[name='ltc_postal_code']");
                    let indexPostLtcValue = indexPostLtc.val().replace(/[^0-9\.]/g,'');
                    if (indexPostLtcValue.length < 6 || indexPostLtcValue.length > 6) {
                        indexPostLtc.addClass('input__control--error');
                    } else {
                        indexPostLtc.removeClass('input__control--error');
                        data[$(item).attr('name')] = $(item).val();
                    }
                    window.blockedChangeStepListener = false
                    return;
                }
                else if ($(item).attr('name') === 'passport_series') { // Проверка серии паспорта
                    let passportSeries = $("input[name='passport_series']");
                    let passportSeriesValue = passportSeries.val().replace(/[^0-9]/g,'');

                    if (!notResident && (passportSeriesValue.length < 4 || passportSeriesValue.length > 4)) {
                        passportSeries.addClass('input__control--error');
                    } else {
                        passportSeries.removeClass('input__control--error');
                        data[$(item).attr('name')] = $(item).val();
                    }
                    window.blockedChangeStepListener = false
                    return;
                }
                else if ($(item).attr('name') === 'passport_number') { // Проверка номера паспорта
                    let passportNumber = $("input[name='passport_number']");
                    let passportNumberValue = passportNumber.val().replace(/[^0-9]/g,'');
                    if (!notResident && (passportNumberValue.length < 6 || passportNumberValue.length > 6) ) {
                        passportNumber.addClass('input__control--error');
                    } else {
                        passportNumber.removeClass('input__control--error');
                        data[$(item).attr('name')] = $(item).val();
                    }
                    window.blockedChangeStepListener = false
                    return;
                }else if ( $(item).attr('name') === 'who_got') {

                    if ( !notResident && !$(item).val() ) {
                        $(item).addClass('input__control--error');
                    }else {
                        $(item).removeClass('input__control--error');
                    }
                    window.blockedChangeStepListener = false
                    return;

                }else if ( $(item).attr('name') === 'getting_date') {

                    if ( !notResident && !$(item).val() ) {
                        $(item).addClass('input__control--error');
                    }else {
                        $(item).removeClass('input__control--error');
                    }
                    window.blockedChangeStepListener = false
                    return;

                }else if ($(item).attr('name') === 'tin') { // Проверка ИНН
                    let tin = $(item);
                    let tinValue = tin.val().replace(/[^0-9]/g,'');
                    let shortType = typeof tin.data('shortInn') != 'undefined';
                    if (
                        (shortType && (tinValue.length < 10 || tinValue.length > 10))
                        || (! shortType && (tinValue.length < 12 || tinValue.length > 12))
                    ) {
                        tin.addClass('input__control--error');
                    } else {
                        tin.removeClass('input__control--error');
                        data[$(item).attr('name')] = $(item).val();
                    }
                    window.blockedChangeStepListener = false
                    return;
                }
                else if ($(item).attr('name') === 'ogrnip') { // Проверка ОГРНИП
                    let ogrnip = $("input[name='ogrnip']");
                    let ogrnipValue = ogrnip.val().replace(/[^0-9]/g,'');
                    if (ogrnipValue.length < 15 || ogrnipValue.length > 15) {
                        ogrnip.addClass('input__control--error');
                    } else {
                        ogrnip.removeClass('input__control--error');
                        data[$(item).attr('name')] = $(item).val();
                    }
                    window.blockedChangeStepListener = false
                    return;
                }
                else if ($(item).attr('name') === 'ogrn') { // Проверка ОГРН
                    let ogrn = $("input[name='ogrn']");
                    let ogrnValue = ogrn.val().replace(/[^0-9]/g,'');
                    if (ogrnValue.length < 13 || ogrnValue.length > 13) {
                        ogrn.addClass('input__control--error');
                    } else {
                        ogrn.removeClass('input__control--error');
                        data[$(item).attr('name')] = $(item).val();
                    }
                    window.blockedChangeStepListener = false
                    return;
                }
                else if ($(item).attr('name') === 'kpp') { // Проверка КПП
                    let kpp = $("input[name='kpp']");
                    let kppValue = kpp.val().replace(/[^0-9]/g,'');
                    if (kppValue.length < 9 || kppValue.length > 9) {
                        kpp.addClass('input__control--error');
                    } else {
                        kpp.removeClass('input__control--error');
                        data[$(item).attr('name')] = $(item).val();
                    }
                    window.blockedChangeStepListener = false
                    return;
                }
                else if ($(item).attr('name') === 'bic') { // Проверка БИК
                    let bic = $("input[name='bic']");
                    let bicValue = bic.val().replace(/[^0-9]/g,'');
                    if (bicValue.length < 9 || bicValue.length > 9) {
                        bic.addClass('input__control--error');
                    } else {
                        bic.removeClass('input__control--error');
                        data[$(item).attr('name')] = $(item).val();
                    }
                    window.blockedChangeStepListener = false
                    return;
                }
                else if ($(item).attr('name') === 'email') { // Проверка Почты
                    const email = $("input[name='email']");
                    const emailValue = email.val();
                    const rule = emailValue.split('@')[0].replace('_','');
                    const validateFlag = emailValue.match(/^[a-zA-Z0-9_\.%\+\-]+@[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,}$/) && rule;
                    if (!validateFlag) {
                        email.addClass('input__control--error');
                    } else {
                        email.removeClass('input__control--error');
                        data[$(item).attr('name')] = $(item).val();
                    }
                    window.blockedChangeStepListener = false
                    return;
                }
                else {
                    if (!$(item).val()) {
                        if (
                            ($(item).attr('name') === 'second_name' && $('input[name=without_second_name]:checked').length)
                            || ($(item).attr('name') === 'mentor_id' && $('input[name=without_mentor_id]:checked').length)
                            || ($(item).attr('name').indexOf('living') !== -1 && $('input[name=without_living]:checked').length)
                        ) {
                            window.blockedChangeStepListener = false
                            return;
                        }
                        $(item).addClass('input__control--error');
                    }
                    data[$(item).attr('name')] = $(item).val();
                }
            });

            let petsError = $('.pets_data .input__control--error');

            if (petsError) {
                petsError.each( function(id, item) {
                    const tagItem = $(item).prop("tagName");
                   
                    if (tagItem === 'SPAN') {
                        $(item).remove();
                    }
                    $(item).removeClass('input__control--error');
                })
            }
           
            if (
                $(`.${registrationData.currentStep} .input__control--error`).length
                || $(`.${registrationData.currentStep} .dropzone--error`).length
                || $(`.${registrationData.currentStep} .file.dz-error`).length
            ) {
                window.blockedChangeStepListener = false
                return;
            }
        }

        const response = await BX.ajax.runComponentAction('bitrix:system.auth.registration', 'saveStep', {
            mode: 'class',
            data: {
                direction: $(this).data('direction'),
                data,
            },
        });

        if (!response.data || response.data.status === 'error') {
            if (data.currentStep === 'choose_mentor') {
                mentorInput.addClass('input__control--error');
                mentorInput.parent().append(`<span class="input__control-error">${response.data.message}</span>`);
            }
            if (response.data.message.indexOf('email') !== -1) {
                emailInput.addClass('input__control--error');
                emailInput.parent().append(`<span class="input__control-error">${response.data.message}</span>`);
            }
            window.blockedChangeStepListener = false
            return;
        }

        registrationData = response.data;

        let elements;
        if (isForwardDirection) {
            elements = $('.steps-counter__item');
        } else {
            elements = $($('.steps-counter__item').get().reverse());
        }

        let isBreak = false;
        let isCurrentStepPassed = false;
        elements.each(function() {
            if (isBreak) return;
            const circle = $(this).find('.steps-counter__circle');

            if (isCurrentStepPassed) {
                isBreak = true;
                $(this).addClass('steps-counter__item--current');
                circle.addClass('steps-counter__circle--current');
                if (!isForwardDirection) {
                    $(this).removeClass('steps-counter__item--passed');
                    circle.removeClass('steps-counter__circle--passed');
                }
                window.blockedChangeStepListener = false
                return;
            }

            if ($(this).hasClass('steps-counter__item--current')) {
                isCurrentStepPassed = true;
                $(this).removeClass('steps-counter__item--current');
                circle.removeClass('steps-counter__circle--current');
                if (isForwardDirection) {
                    $(this).addClass('steps-counter__item--passed');
                    circle.addClass('steps-counter__circle--passed');
                }
            }
        });

        $('.step-container').hide();
        $(`.${registrationData.currentStep}`).show();
        window.scrollTo(0, 0);

        window.blockedChangeStepListener = false
    }

    checkBreedSelects() {
      $('[data-breed-container]').each((index, item) => {
          const petKind = $(item).closest('.pet-cards__item').find('[data-pet-kind]').val();
          const needError = !!$(item).parent().find('span.input__control-error').length;

          let neededElem;
          $(item).find(`[data-breed]`).hide();
          if (petKind) {
              neededElem = $(item).find(`[data-breed=${petKind}]`);
          } else {
              neededElem = $(item).find(`[data-breed=empty]`);
          }
          neededElem.show();
          if (needError) {
              neededElem.find('select').addClass('input__control--error');
          }
      });
    }

  async sendCode() {
      const phone = $('input[name=phone]').val().replaceAll(/\(|\)|\s|-+/g, '');

      if (!phone || phone.match(/_+/i)) {
          $(this).parent().find('input[name=phone]').addClass('input__control--error');
          return;
      }

      let response = {};
      try {
          response = await BX.ajax.runComponentAction('bitrix:system.auth.registration', 'sendPhoneCode', {
              mode: 'class',
              data: { phoneNumber: phone },
          });

          if (!response.data || response.data.status === 'error') {
              throw new Error(response.data.message);
          }
      } catch (e) {
          $(this).parent().find('input[name=phone]').addClass('input__control--error');
          if (e.message && !$(this).parent().find('.input__control-error')?.length) {
              $(this).parent().find('div.input').append(`<span class="input__control-error">${e.message}</span>`)
          }
          return;
      }

      $.fancybox.open({ src: '#approve-number' });
  }

  async verifyCode() {
      const input = $('input[name=verify_code]');

      input.removeClass('input__control--error');
      input.parent().find('.input__control-error').remove();
      try {
          const response = await BX.ajax.runComponentAction('bitrix:system.auth.registration', 'verifyPhoneCode', {
              mode: 'class',
              data: {
                  code: input.val(),
              },
          });

          if (!response.data || response.data.status === 'error') {
              throw new Error();
          }
      } catch (e) {
          input.addClass('input__control--error');
          if (!input.parent().find('.input__control-error')?.length) {
              input.parent().append('<span class="input__control-error">Неверный или просроченный код</span>');
          }
          return;
      }

      input.val('');
      $('[data-send-code]').css('color', 'black');
      registrationData.confirmedPhone = $('input[name=phone]').val().replaceAll(/\(|\)|\s|-+/g, '');

      $.fancybox.close({ src: '#approve-number' });

      const continueButton = $(`.${registrationData.currentStep} [data-change-step]`);
  }

  async register() {
      $(`.${registrationData.currentStep} .form span.input__control-error`).remove();

      const password = $('input[name=password]').val();
      const confirmPassword = $('input[name=password_confirm]').val();

      $('input[name=password]').removeClass('input__control--error');
      $('input[name=password_confirm]').removeClass('input__control--error');
      $('input[name=password_confirm]').parent().find('.input__control-error').remove();

      switch (true) {
          case password !== confirmPassword:
              $('input[name=password]').addClass('input__control--error');
              $('input[name=password_confirm]').addClass('input__control--error');
              $('input[name=password_confirm]').parent().append('<span style="position: absolute" class="input__control-error">Пароли не совпадают</span>');
              grecaptcha.reset();
              return;
          case password.length < 8:
          case password.match(/[А-я]+/i):
          case password.toUpperCase() === password:
          case password.toLowerCase() === password:
              $('input[name=password]').addClass('input__control--error');
              $('input[name=password_confirm]').addClass('input__control--error');
              $('input[name=password_confirm]').parent().append('<span style="position: absolute" class="input__control-error">Пароль не удовлетворяет требованиям</span>');
              grecaptcha.reset();
              return;
      }

      let response;
      try {
          response = await BX.ajax.runComponentAction('bitrix:system.auth.registration', 'register', {
              mode: 'class',
              data: {
                  data: {
                      ...registrationData,
                      password,
                      confirm_password: confirmPassword,
                      captcha: grecaptcha.getResponse()
                  },
              },
          });
      } catch (error) {
          grecaptcha.reset();
          if (error.errors.length > 0) {
              $(`.${registrationData.currentStep} .form`).append('<span class="input__control-error">' + error.errors[0].message + '</span>');
          } else {
              $(`.${registrationData.currentStep} .form`).append('<span class="input__control-error">Неизвестная ошибка. Попробуйте позже</span>');
          }
          return;
      }

      let isBreak = false;
      let isCurrentStepPassed = false;
      $('.steps-counter__item').each(function() {
          if (isBreak) return;
          const circle = $(this).find('.steps-counter__circle');

          if (isCurrentStepPassed) {
              isBreak = true;
              $(this).addClass('steps-counter__item--current');
              circle.addClass('steps-counter__circle--current');
              return;
          }

          if ($(this).hasClass('steps-counter__item--current')) {
              isCurrentStepPassed = true;
              $(this).removeClass('steps-counter__item--current');
              circle.removeClass('steps-counter__circle--current');
              $(this).addClass('steps-counter__item--passed');
              circle.addClass('steps-counter__circle--passed');
          }
      });

      $('.step-container').hide();
      $('.final').show();
      window.scrollTo(0, 0);
  }
}

function unlock_submit() {
    let formVote = $('button[data-register]')
    formVote.attr('disabled', false);
    formVote.removeClass('button--disabled');
}

$(function() {
    new CSystemAuthRegistrationComponent();

    $('#mentor_id').on('input', function() {
        let checkbox = $('#without_mentor_id');

        setTimeout(() => {
            let inputLength = $(this).val().length

            if (inputLength > 0) {
                checkbox.prop('checked', false);
            }
        }, 500);

        $(this).val($(this).val().replace(/[^0-9]/g, ''))
        return
    });
});

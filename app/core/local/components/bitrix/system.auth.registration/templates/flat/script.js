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
      $('button[data-change-step]').on('click', this.changeStepListener);

      $('button[data-send-code]').on('click', this.sendCode);
      $('button[data-verify-code]').on('click', this.verifyCode);
      $('button[data-register]').on('click', this.register);
      $(`.form select`).on('change', this.removeError);
      $(`.form input[type=checkbox]`).on('change', this.removeError);
      $(`.form input`).on('keyup', this.removeError);
      $('input[name=without_second_name], input[name=without_mentor_id]').on('change', this.blockInputByCheckbox);
      $('select[name=status]').on('change', this.changeLegalEntity);
      $(document).on('change', 'select[data-pet-kind]', this.checkBreedSelects);
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

    async changeStepListener() {
        $('[data-send-code]').css('color', 'black');

        const mentorInput = $('#mentor_id');
        mentorInput.removeClass('input__control--error');
        mentorInput.parent().find('.input__control-error').remove();

        const emailInput = $('#email');
        emailInput.removeClass('input__control--error');
        emailInput.parent().find('.input__control-error').remove();

        const isForwardDirection = $(this).data('direction') === 'next';
        let data = registrationData;

        if (isForwardDirection) {
            if (data.currentStep === 'personal_data' && data.confirmedPhone !== $('input[name=phone]').val().replaceAll(/\(|\)|\s|-+/g, '')) {
                $('[data-send-code]').css('color', 'red');
                return;
            }

            if (data.currentStep === 'pets_data' && data.pets) {
                data.pets = {};
            }

            $(`.${registrationData.currentStep} .form`).find('input, select').each((index, item) => {
                if (
                    registrationData.currentStep === 'legal_entity_data'
                    && $(item).closest('.legal_entity').length
                    && !$(item).closest('.legal_entity').hasClass(data.status)
                ) {
                    return;
                }

                if ($(item).parent().data('breed') === 'empty') {
                    if ($(item).parent().css('display') !== 'none') {
                        $(item).parent().parent().find('[data-breed] select').addClass('input__control--error');
                        return;
                    } else {
                        $(item).parent().parent().find('[data-breed] select').removeClass('input__control--error');
                    }
                }

                if ($(item).attr('type') === 'hidden' || !$(item).attr('name')) {
                    return;
                }

                if ($(item).attr('name').startsWith('pets')) {
                    if ($(item).attr('name').indexOf('breed') !== -1 && $(item).closest('[data-breed]').css('display') === 'none') {
                        return;
                    }
                    if (!$(item).val()) {
                        $(item).addClass('input__control--error');
                        return;
                    }

                    const separateKey = $(item).attr('name').split('-');
                    if ($(item).attr('name').indexOf('breed') !== -1) {
                        data[separateKey[0]][separateKey[1]].breed = $(item).val();
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
                } else if ($(item).attr('type') === 'file') {
                    if ($(item).attr('multiple')) {
                        data[$(item).attr('name')] = { files: [] };
                        $(item).parent().find('.file.dz-success.dz-complete').each((index, innerItem) => {
                            data[$(item).attr('name')].files.push({
                                id: $(innerItem).find('input[type=hidden]').val(),
                                name: $(innerItem).find('[data-uploader-preview-filename]').html(),
                                format: $(innerItem).find('[data-uploader-preview-format]').html(),
                                size: $(innerItem).find('[data-uploader-preview-size]').html(),
                            });
                        });

                        if (!data[$(item).attr('name')].files.length) {
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
                } else if ($(item).attr('type') === 'checkbox') {
                    data[$(item).attr('name')] = !!$(`#${$(item).attr('id')}:checked`).length;
                    if (!data[$(item).attr('name')] && ['agree_with_personal_data_processing', 'agree_with_terms_of_use', 'agree_with_company_rules', 'correctness_confirmation_self_employed', 'correctness_confirmation_ip', 'correctness_confirmation_ltc'].includes($(item).attr('name'))) {
                        $(item).addClass('input__control--error');
                    }
                } else {
                    if (!$(item).val()) {
                        if (
                            ($(item).attr('name') === 'second_name' && $('input[name=without_second_name]:checked').length)
                            || ($(item).attr('name') === 'mentor_id' && $('input[name=without_mentor_id]:checked').length)
                            || ($(item).attr('name').indexOf('living') !== -1 && $('input[name=without_living]:checked').length)
                        ) {
                            return
                        }
                        $(item).addClass('input__control--error');
                    }
                    data[$(item).attr('name')] = $(item).val();
                }
            });

            if (data.currentStep === 'pets_data' && !Object.keys(data.pets).length) {
                return;
            }

            if ($(`.${registrationData.currentStep} .input__control--error`).length || $(`.${registrationData.currentStep} .dropzone--error`).length) {
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
    }

    checkBreedSelects() {
      $('[data-breed-container]').each((index, item) => {
          const petKind = $(item).closest('.pet-cards__item').find('[data-pet-kind]').val();

          $(item).find(`[data-breed]`).hide();
          if (petKind) {
              $(item).find(`[data-breed=${petKind}]`).show();
          } else {
              $(item).find(`[data-breed=empty]`).show();
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
      continueButton.removeClass('button--disabled');
      continueButton.attr('disabled', null);
  }

  async register() {
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
              return;
          case password.length < 8:
          case password.match(/[А-я]+/i):
          case password.toUpperCase() === password:
          case password.toLowerCase() === password:
              $('input[name=password]').addClass('input__control--error');
              $('input[name=password_confirm]').addClass('input__control--error');
              $('input[name=password_confirm]').parent().append('<span style="position: absolute" class="input__control-error">Пароль не удовлетворяет требованиям</span>');
              return;
      }

      await BX.ajax.runComponentAction('bitrix:system.auth.registration', 'register', {
          mode: 'class',
          data: {
              data: {
                  ...registrationData,
                  password,
                  confirm_password: confirmPassword,
              },
          },
      });

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
  }
}

$(function() {
    new CSystemAuthRegistrationComponent();
});

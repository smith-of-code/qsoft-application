class CSystemAuthRegistrationComponent {
  constructor() {
      this.initPage();
      this.initListeners();
  }

  initPage() {
      $('.legal_entity').hide();
  }

  initListeners() {
      $('button[data-change-step]').on('click', this.changeStepListener);

      $('button[data-send-code]').on('click', this.sendCode);
      $('button[data-verify-code]').on('click', this.verifyCode);
      $('button[data-register]').on('click', this.register);
      $(`.${registrationData.currentStep} .form select`).on('change', this.removeError);
      $(`.${registrationData.currentStep} .form input[type=checkbox]`).on('change', this.removeError);
      $(`.${registrationData.currentStep} .form input`).on('keyup', this.removeError);
      $('input[name=without_second_name], input[name=without_mentor_id]').on('change', this.blockInputByCheckbox);
      $('input[name=without_living]').on('change', this.hideBlockByCheckbox);
      $('select[name=status]').on('change', this.changeLegalEntity);
  }

    hideBlockByCheckbox() {
        if ($(`#${$(this).attr('id')}:checked`).length) {
            $('.block_living').hide();
        } else {
            $('.block_living').show();
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
    }

    blockInputByCheckbox() {
      const input = $(`input[name=${$(this).attr('name').replace('without_', '')}]`);
      if ($(`#${$(this).attr('id')}:checked`).length) {
          input.val('');
          input.removeClass('input__control--error');
          input.attr('disabled', true);
      } else {
          input.attr('disabled', null);
      }
    }

    async changeStepListener() {
        const isForwardDirection = $(this).data('direction') === 'next';
        let data = registrationData;

        if (isForwardDirection) {
            if (data.currentStep === 'pets_data' && data.pets) {
                data.pets = null;
            }

            $(`.${registrationData.currentStep} .form`).find('input, select').each((index, item) => {
                if ($(item).attr('name').startsWith('pets')) {
                    if (!$(item).val()) {
                        $(item).addClass('input__control--error');
                        return;
                    }

                    const separateKey = $(item).attr('name').split('-');
                    if (!data[separateKey[0]]) data[separateKey[0]] = [];
                    if (!data[separateKey[0]][separateKey[1]]) data[separateKey[0]][separateKey[1]] = {};
                    data[separateKey[0]][separateKey[1]][separateKey[2]] = $(item).val();

                    if (separateKey[2] === 'type' || separateKey[2] === 'gender') {
                        data[separateKey[0]][separateKey[1]][`~${separateKey[2]}`] = $(item).val().split('_')[1].toLowerCase();
                    }
                } else if ($(item).attr('type') === 'file') {
                    if ($(item).attr('multiple')) {
                        // TODO:: Get and validate files
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
        }

        if ($(`.${registrationData.currentStep} .input__control--error`).length) {
            return;
        }

        const response = await BX.ajax.runComponentAction('bitrix:system.auth.registration', 'saveStep', {
            mode: 'class',
            data: {
                direction: $(this).data('direction'),
                data,
            },
        });

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
          $(this).parent().find('div.input').append(`<span class="input__control-error">${e.message}</span>`)
          return;
      }

      $.fancybox.open({ src: '#approve-number' });

      registrationData = {
          ...registrationData,
          user_id: response.data.user_id,
          password: response.data.password,
      };
  }

  async verifyCode() {
      const input = $('input[name=verify_code]');

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
          input.parent().append('<span class="input__control-error">Неверный код</span>');
      }

      $.fancybox.close({ src: '#approve-number' });

      const continueButton = $(`.${registrationData.currentStep} [data-change-step]`);
      continueButton.removeClass('button--disabled');
      continueButton.attr('disabled', null);
  }

  async register() {
      const password = $('input[name=password]').val();
      const confirmPassword = $('input[name=password_confirm]').val();

      switch (true) {
          case password !== confirmPassword:
          case password.length < 8:
          case password.match(/[А-я]+/i):
          case !password.match(/[a-z]+/i):
          case !password.match(/[A-Z]+/i):
              $('input[name=password]').addClass('input__control--error');
              $('input[name=password_confirm]').addClass('input__control--error');
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
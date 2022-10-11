class CSystemAuthRegistrationComponent {
  constructor() {
      this.initListeners();
  }

  initListeners() {
      $('button[data-change-step]').on('click', this.changeStepListener);

      $('button[data-send-code]').on('click', this.sendCode);
      $('.verify-code').on('click', this.verifyCode);
      $('button[data-register]').on('click', this.register);
  }

    async changeStepListener() {
      let a = $('input[name="test[]"]');
      console.log(a.val(), a[0].files);
      return;


        const isForwardDirection = $(this).data('direction') === 'next';
        let data = registrationData;

        if (isForwardDirection) {
            if (data.currentStep === 'pets_data' && data.pets) {
                data.pets = null;
            }

            $(`.${registrationData.currentStep} .form`).find('input, select').each((index, item) => {
                if ($(item).attr('name').startsWith('pets')) {
                    const separateKey = $(item).attr('name').split('-');
                    if (!data[separateKey[0]]) data[separateKey[0]] = [];
                    if (!data[separateKey[0]][separateKey[1]]) data[separateKey[0]][separateKey[1]] = {};
                    data[separateKey[0]][separateKey[1]][separateKey[2]] = $(item).val();

                    if (separateKey[2] === 'type' || separateKey[2] === 'gender') {
                        data[separateKey[0]][separateKey[1]][`~${separateKey[2]}`] = $(item).val().split('_')[1].toLowerCase();
                    }
                } else if ($(item).attr('type') === 'file') {
                    const fileContainer = $(item).parent().find('img.dropzone__previews-picture-image-pic').last();
                    if (fileContainer.attr('alt')) {
                        data[$(item).attr('name')] = {
                            name: fileContainer.attr('alt'),
                            data: fileContainer.attr('src'),
                        };
                    }
                } else if ($(item).attr('type') === 'checkbox') {
                    data[$(item).attr('name')] = $(item).attr('checked');
                } else {
                    data[$(item).attr('name')] = $(item).val();
                }
            });
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
      const phone = $('input[name=phone]').val();

      if (!phone || phone.match(/_+/i)) {
          // Error
          return;
      }

      const response = await BX.ajax.runComponentAction('bitrix:system.auth.registration', 'sendPhoneCode', {
          mode: 'class',
          data: { phoneNumber: phone },
      });

      registrationData = {
          ...registrationData,
          user_id: response.data.user_id,
          password: response.data.password,
      };
  }

  async verifyCode() {
      const response = await BX.ajax.runComponentAction('bitrix:system.auth.registration', 'verifyPhoneCode', {
          mode: 'class',
          data: {
              code: $('input[name=verify_code]').val(),
          },
      });
      console.log(response);
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
              // Error
              return;
      }

      const response = await BX.ajax.runComponentAction('bitrix:system.auth.registration', 'register', {
          mode: 'class',
          data: {
              data: {
                  ...registrationData,
                  password,
                  confirm_password: confirmPassword,
              },
          },
      });
  }
}

$(function() {
    new CSystemAuthRegistrationComponent();
});
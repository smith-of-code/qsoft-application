class CSystemAuthRegistrationComponent {
  constructor() {
      this.initListeners();
  }

  initListeners() {
      $('.change-step').on('click', this.changeStepListener);

      $('.send-code').on('click', this.sendCode);
      $('.verify-code').on('click', this.verifyCode);
      $('.register').on('click', this.register);
  }

  async sendCode() {
      const response = await BX.ajax.runComponentAction('bitrix:system.auth.registration', 'sendPhoneCode', {
          mode: 'class',
          data: {
              phoneNumber: '+79999999985',
          },
      });
      console.log(response);

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
              code: $('.input2').val(),
          },
      });
      console.log(response);
  }

  async register() {
      const response = await BX.ajax.runComponentAction('bitrix:system.auth.registration', 'register', {
          mode: 'class',
          data: {
              data: {
                  first_name: 'First name',
                  last_name: 'Last name',
                  second_name: 'Second name',
                  email: 'ramenskiy.nikita@gmail.com',
                  birthday: '11.11.1111',
                  gender: 'M',
                  city: 'Москва',
                  password: '123123',
                  confirm_password: '123123',
                  pets: [],
              },
          },
      });
      console.log(response);
  }

  async changeStepListener() {
      let data = registrationData;
      $(`.${registrationData.currentStep} .register-form`).find('input').each((index, item) => {
          if ($(item).attr('type') === 'file') {
              data[$(item).attr('name')] = $(item).prop('files')[0];
          } else {
              data[$(item).attr('name')] = $(item).val();
          }
      });

      const response = await BX.ajax.runComponentAction('bitrix:system.auth.registration', 'saveStep', {
          mode: 'class',
          data: {
              direction: $(this).data('direction'),
              data,
          },
      });

      registrationData = response.data;

      $('.step-container').hide();
      $(`.${registrationData.currentStep}`).show();
  }
}

$(function() {
    new CSystemAuthRegistrationComponent();
});
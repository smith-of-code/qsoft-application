class CSystemAuthRegistrationComponent {
  constructor() {
      this.initListeners();
  }

  initListeners() {
      $('.change-step').on('click', this.changeStepListener);
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
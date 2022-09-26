class SystemAuthForgotPasswordComponent {
  constructor() {
      this.initListeners();
  }

  initListeners() {
      $('.send').on('click', this.sendListener);
  }

  async sendListener() {
      const response = await BX.ajax.runComponentAction('bitrix:system.auth.forgotpasswd', 'sendEmailMessage', {
          mode: 'class',
          data: {
              login: 'admin',
          },
      });
      console.log(response);
  }
}

$(function() {
    new SystemAuthForgotPasswordComponent();
});
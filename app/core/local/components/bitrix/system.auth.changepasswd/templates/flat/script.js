class SystemAuthForgotPasswordComponent {
  constructor() {
      this.initListeners();
  }

  initListeners() {
      $('.send').on('click', this.sendListener);
  }

  async sendListener() {
      const response = await BX.ajax.runComponentAction('bitrix:system.auth.changepasswd', 'changePassword', {
          mode: 'class',
          data: {
              userId: $('.userId').val(),
              password: $('.password').val(),
              confirmPassword: $('.password').val(),
          },
      });
      console.log(response);
  }
}

$(function() {
    new SystemAuthForgotPasswordComponent();
});
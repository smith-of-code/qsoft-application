class SystemAuthForgotPasswordComponent {
  constructor() {
      this.initListeners();
  }

  initListeners() {
      $('[data-send]').on('click', this.sendListener);
  }

  async sendListener() {
      const loginInput = $('#login');

      const response = await BX.ajax.runComponentAction('bitrix:system.auth.forgotpasswd', 'sendEmailMessage', {
          mode: 'class',
          data: {
              login: loginInput.val(),
          },
      });

      if (response.data && response.data.status === 'success') {
          $('[data-form]').hide();
          $('[data-success]').show();
      } else {
          loginInput.addClass('input__control--error');
          loginInput.parent().append(`<span class="input__control-error">Пользователя с таким логином не существует</span>`)
      }
  }
}

$(function() {
    new SystemAuthForgotPasswordComponent();
});
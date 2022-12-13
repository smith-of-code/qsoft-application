class SystemAuthForgotPasswordComponent {
  constructor() {
      this.initListeners();
  }

  initListeners() {
      $('[data-send]').on('click', this.sendListener);
      $('#login').on('input', this.removeError);
  }

  removeError() {
      $(this).removeClass('input__control--error');
      $(this).parent().find('span.input__control-error').remove();
  }

  async sendListener() {
      const loginInput = $('#login');

      if (!loginInput.val()) {
          loginInput.addClass('input__control--error');
          loginInput.parent().append(`<span class="input__control-error">Поле обязательно к заполнению</span>`)
          return;
      }

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
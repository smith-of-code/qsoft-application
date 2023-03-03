class SystemAuthForgotPasswordComponent {
  constructor() {
      this.initListeners();
  }

  initListeners() {
      const passwordInput = $('input[name=password]');
      const confirmPasswordInput = $('input[name=password_confirm]');
      let that = this;

      $('[data-submit]').on('click', function () {
          that.sendListener(passwordInput, confirmPasswordInput);
      });
      passwordInput.on('input', function () {
          if (passwordInput.hasClass('input__control--error')) {
              passwordInput.removeClass('input__control--error');
              passwordInput.parent().find('span.input__control-error').remove();
          }
      });
      confirmPasswordInput.on('input', function () {
          if (confirmPasswordInput.hasClass('input__control--error')) {
              confirmPasswordInput.removeClass('input__control--error');
              confirmPasswordInput.parent().find('span.input__control-error').remove();
          }
      });
  }

  async sendListener(passwordInput, confirmPasswordInput) {
      const password = passwordInput.val();
      const confirmPassword = confirmPasswordInput.val();

      let spanRequired = `<span class="input__control-error">Обязательное поле</span>`;
      let spanWrongPass = `<span class="input__control-error">Проверьте правильность заполнения поля</span>`;
      let spanNotEqual = `<span class="input__control-error">Пароли не совпадают</span>`;

      passwordInput.removeClass('input__control--error');
      passwordInput.parent().find('span.input__control-error').remove();
      confirmPasswordInput.removeClass('input__control--error');
      confirmPasswordInput.parent().find('span.input__control-error').remove();

      if (password.length === 0) {
          passwordInput.addClass('input__control--error');
          passwordInput.parent().append(spanRequired);
      }
      if (confirmPassword.length === 0) {
          confirmPasswordInput.addClass('input__control--error');
          confirmPasswordInput.parent().append(spanRequired);
      }

      if (password.length === 0 || confirmPassword.length === 0) {
          return;
      }

      switch (true) {
          case password.length < 8:
          case password.match(/[А-я]+/i):
          case password.toUpperCase() === password:
          case password.toLowerCase() === password:
              passwordInput.addClass('input__control--error');
              passwordInput.parent().append(spanWrongPass);
              return;
          case password !== confirmPassword:
              passwordInput.addClass('input__control--error');
              passwordInput.parent().append(spanNotEqual);
              confirmPasswordInput.addClass('input__control--error');
              confirmPasswordInput.parent().append(spanNotEqual);
              return;
      }

      const response = await BX.ajax.runComponentAction('bitrix:system.auth.changepasswd', 'changePassword', {
          mode: 'class',
          data: {
              userId: $('#user_id').val(),
              password,
              confirmPassword,
              code: $('#code').val(),
          },
      });

      if (response.data && response.data.status === 'success') {
          document.location.href = '/login';
      }
  }
}

$(function() {
    new SystemAuthForgotPasswordComponent();
});

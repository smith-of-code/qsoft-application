class SystemAuthForgotPasswordComponent {
  constructor() {
      this.initListeners();
  }

  initListeners() {
      $('[data-submit]').on('click', this.sendListener);
  }

  async sendListener() {
      const passwordInput = $('input[name=password]');
      const confirmPasswordInput = $('input[name=password_confirm]');

      const password = passwordInput.val();
      const confirmPassword = confirmPasswordInput.val();

      switch (true) {
          case password !== confirmPassword:
          case password.length < 8:
          case password.match(/[А-я]+/i):
          case password.toUpperCase() === password:
          case password.toLowerCase() === password:
              passwordInput.addClass('input__control--error');
              confirmPasswordInput.addClass('input__control--error');
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
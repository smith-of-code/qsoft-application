class SystemAuthComponent {
  constructor() {
      this.initListeners();
  }

  initListeners() {
      $('form[name=form_auth]').on('submit', function (e) {
          const loginInput = $('input[data-login-input]');
          const passwordInput = $('input[data-password-input]');
          let login = loginInput.val().toString();
          let password = passwordInput.val().toString();
          let span = `<span class="input__control-error">Обязательное поле</span>`;
          let hasErrors = false;

          loginInput.removeClass('input__control--error');
          passwordInput.removeClass('input__control--error');

          loginInput.parent().find('span.input__control-error').remove();
          passwordInput.parent().find('span.input__control-error').remove();

          if (login.length == 0) {
              hasErrors = true;
              loginInput.addClass('input__control--error');
              loginInput.parent().append(span);
          }
          if (password.length == 0) {
              hasErrors = true;
              passwordInput.addClass('input__control--error');
              passwordInput.parent().append(span);
          }
          if (hasErrors) {
              e.preventDefault();
          }
      });
  }
}

$(function() {
    new SystemAuthComponent();
});
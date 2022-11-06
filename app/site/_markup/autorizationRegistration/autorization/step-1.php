<!DOCTYPE html>
<html lang="ru">
    <head>
        <title>Авторизация</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1 maximum-scale=1 user-scalable=0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" type="text/css" href="/local/templates/.default/css/style.css" />
    </head>

    <body class="page page--banner">

        <!--header-->
        <? include_once("../../include/header.php"); ?>
        <!--/header-->

        <!--content-->
        <main class="page__content content">
            <div class="content__container container">
                <h1 class="content__heading content__heading--centered">Авторизация</h1>

                <div class="registration">
                    <section class="section section--limited section--centered">
                        <p class="registration__subtitle">
                            Логином для авторизации является e-mail или телефон, указанный при регистрации
                        </p>

                        <form class="registration__form form" action="" method="post">
                            <div class="form__row">
                                <div class="form__col">
                                    <div class="form__field">
                                        <div class="form__field-block form__field-block--label">
                                            <label for="text-required" class="form__label form__label--required">
                                                <span class="form__label-text">Логин</span>
                                            </label>
                                        </div>

                                        <div class="form__field-block form__field-block--input">
                                            <div class="input">
                                                <input type="text" class="input__control" name="text-required" id="text-required" placeholder="Введите логин">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form__row">
                                <div class="form__col">
                                    <div class="form__field">
                                        <div class="form__field-block form__field-block--label">
                                            <label for="password" class="form__label form__label--required">
                                                <span class="form__label-text">Пароль</span>
                                            </label>
                                        </div>

                                        <div class="form__field-block form__field-block--input" data-password-block>
                                            <div class="input input--iconed">
                                                <input type="password" class="input__control" name="password" id="password" placeholder="Введите пароль" data-password-input>
                                                <span class="input__icon input__icon-password" data-password-toggle>
                                                    <svg class="input__icon-password-icon input__icon-password-icon--show icon icon--eye">
                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-eye"></use>
                                                    </svg>
                                                    <svg class="input__icon-password-icon input__icon-password-icon--hidden icon icon--eye-off">
                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-eye-off"></use>
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="registration__actions">
                                <div class="registration__actions-col registration__actions-col--separated registration__actions-col--gaped">
                                    <a href="" class="registration__button button button--simple button--red">
                                        <span class="button__icon">
                                            <svg class="icon icon--lock">
                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-lock"></use>
                                            </svg>
                                        </span>
                                        <span class="button__text">Забыли пароль?</span>
                                    </a>
                                </div>

                                <div class="registration__actions-col">
                                    <button type="submit" class="button button--rounded button--covered button--red button--full">
                                        <span class="button__text">Войти</span>
                                    </button>
                                </div>

                                <div class="registration__actions-col">
                                    <button type="button" class="button button--rounded button--covered button--white-green button--full">
                                        <span class="button__text">Зарегистрироваться как покупатель</span>
                                    </button>
                                </div>

                                <div class="registration__actions-col">
                                    <button type="button" class="button button--rounded button--covered button--white-green button--full">
                                        <span class="button__text">Зарегистрироваться как консультант</span>
                                    </button>
                                </div>
                            </div>


                        </form>
                    </section>
                </div>
            </div>
        </main>
        <!--content-->

        <!--Футер-->
        <? include_once("../../include/footer.php"); ?>
        <!--/Футер-->

        <script src="/local/templates/.default/js/script.js"></script>
    </body>

</html>

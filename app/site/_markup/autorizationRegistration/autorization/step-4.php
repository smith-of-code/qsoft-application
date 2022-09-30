<!DOCTYPE html>
<html lang="ru">
    <head>
        <title>Восстановление пароля</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1 maximum-scale=1 user-scalable=0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" type="text/css" href="/local/templates/.default/css/style.css" />
    </head>

    <body class="page page--banner">

        <!--header-->
        <header class="page__header header" style="background-color: cadetblue">
            Хедер
        </header>
        <!--/header-->

        <!--content-->
        <main class="page__content content">
            <div class="content__container container">
                <h1 class="content__heading content__heading--centered">Создание нового пароля</h1>

                <div class="registration">
                    <section class="section section--limited-middle section--centered">
                        <form class="registration__form form" action="" method="post">

                            <div class="registration__requirement requirement box box--gray box--circle">
                                <div class="requirement__col">
                                    <p class="requirement__text">
                                        Требования к паролю:
                                    </p>
                                </div>

                                <div class="requirement__col requirement__col--right">
                                    <ul class="requirement__list">
                                        <li class="requirement__item">
                                            Использование только латинских букв, символов и цифр
                                        </li>
                                        <li class="requirement__item">
                                            Не менее 8 символов
                                        </li>
                                        <li class="requirement__item">
                                            Не менее одной заглавной буквы
                                        </li>
                                        <li class="requirement__item">
                                            Не менее одной строчной буквы
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="form__row">
                                <div class="form__col form__col--1-2">
                                    <div class="form__field">
                                        <div class="form__field-block form__field-block--label">
                                            <label for="text-required" class="form__label form__label--required">
                                                <span class="form__label-text">Новые пароль</span>
                                            </label>
                                        </div>

                                        <div class="form__field-block form__field-block--input">
                                            <div class="input">
                                                <input type="text" class="input__control" name="text-required" id="text-required" placeholder="Новые пароль">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form__col form__col--1-2">
                                    <div class="form__field">
                                        <div class="form__field-block form__field-block--label">
                                            <label for="text-required" class="form__label form__label--required">
                                                <span class="form__label-text">Подтверждение пароля</span>
                                            </label>
                                        </div>

                                        <div class="form__field-block form__field-block--input">
                                            <div class="input">
                                                <input type="text" class="input__control" name="text-required" id="text-required" placeholder="Подтверждение пароля">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="registration__actions">
                                <div class="registration__actions-col">
                                    <button type="button" class="button button--rounded button--covered button--green">
                                        <span class="button__text">Сохранить</span>
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
        <footer class="page__footer footer" style="background-color: cadetblue">
            Футер
        </footer>
        <!--/Футер-->

        <script src="/local/templates/.default/js/script.js"></script>
    </body>

</html>

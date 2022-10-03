<!DOCTYPE html>
<html lang="ru">
    <head>
        <title>Регистрация</title>

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
                <section class="section">
                        <ul class="steps-counter">
                            <li class="steps-counter__item steps-counter__item--passed" data-steps-item>
                                <div class="steps-counter__circle steps-counter__circle--passed" data-steps-indicator>
                                    <span class="steps-counter__circle-text">Персональные данные</span>
                                </div>
                            </li>

                            <li class="steps-counter__item steps-counter__item--passed" data-steps-item>
                                <div class="steps-counter__circle steps-counter__circle--passed" data-steps-indicator>
                                    <span class="steps-counter__circle-text">Данные о питомцах</span>
                                </div>
                            </li>

                            <li class="steps-counter__item steps-counter__item--passed" data-steps-item>
                                <div class="steps-counter__circle steps-counter__circle--passed" data-steps-indicator>
                                    <span class="steps-counter__circle-text">Выбор наставника</span>
                                </div>
                            </li>

                            <li class="steps-counter__item steps-counter__item--passed" data-steps-item>
                                <div class="steps-counter__circle steps-counter__circle--passed" data-steps-indicator>
                                    <span class="steps-counter__circle-text">Юридические данные</span>
                                </div>
                            </li>

                            <li class="steps-counter__item steps-counter__item--current" data-steps-item>
                                <div class="steps-counter__circle steps-counter__circle--current" data-steps-indicator>
                                    <span class="steps-counter__circle-text">Установка пароля</span>
                                </div>
                            </li>

                            <li class="steps-counter__item" data-steps-item>
                                <div class="steps-counter__circle" data-steps-indicator>
                                </div>
                            </li>
                        </ul>
                    </section>

                    <section class="section section--limited-big">
                        <h4 class="section__title">Юридические данные</h4>

                        <form class="registration__form form form--separated form--wraped" action="" method="post">

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

                                        <button type="button" class="form__field-button button button--simple button--red button--underlined button--tiny">
                                            Сгенерировать пароль
                                        </button>
                                    </div>
                                </div>


                                <div class="form__col">
                                    <div class="form__field">
                                        <div class="form__field-block form__field-block--label">
                                            <label for="password" class="form__label form__label--required">
                                                <span class="form__label-text">Подтвердить пароль</span>
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

                            <div class="registration__actions registration__actions--inlined registration__actions--separated">
                                <div class="registration__actions-col">
                                    <a href="" class="button button--rounded button--covered button--white-green">
                                        <span class="button__text">Назад</span>
                                    </a>
                                </div>

                                <div class="registration__actions-col">
                                    <a href="" class="button button--rounded button--covered button--green">
                                        <span class="button__text">Зарегистрироваться</span>
                                    </a>
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

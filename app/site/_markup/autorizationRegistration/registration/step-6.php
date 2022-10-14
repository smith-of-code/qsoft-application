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
                <h1 class="content__heading content__heading--separated">Регистрация</h1>

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

                            <li class="steps-counter__item steps-counter__item--passed" data-steps-item>
                                <div class="steps-counter__circle steps-counter__circle--passed" data-steps-indicator>
                                    <span class="steps-counter__circle-text">Установка пароля</span>
                                </div>
                            </li>

                            <li class="steps-counter__item steps-counter__item--current" data-steps-item>
                                <div class="steps-counter__circle steps-counter__circle--current" data-steps-indicator>
                                </div>
                            </li>
                        </ul>
                    </section>

                    <section class="section section--limited-big">
                        <div class="registration__notification notification">
                            <div class="notification__icon">
                                <svg class="icon icon--tick-circle">
                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-tick-circle"></use>
                                </svg>
                            </div>

                            <h4 class="notification__title">
                                Заявка успешно отправлена!
                            </h4>

                            <p class="notification__text notification__text--small">
                                Ваша заявка на регистрацию оформлена. Проверьте, пожалуйста, электронную почту
                            </p>
                        </div>
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

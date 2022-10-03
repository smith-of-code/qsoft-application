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

                            <li class="steps-counter__item steps-counter__item--current" data-steps-item>
                                <div class="steps-counter__circle steps-counter__circle--current" data-steps-indicator>
                                    <span class="steps-counter__circle-text">Выбор наставника</span>
                                </div>
                            </li>

                            <li class="steps-counter__item" data-steps-item>
                                <div class="steps-counter__circle" data-steps-indicator>
                                    <span class="steps-counter__circle-text">Юридические данные</span>
                                </div>
                            </li>

                            <li class="steps-counter__item" data-steps-item>
                                <div class="steps-counter__circle" data-steps-indicator>
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
                        <h4 class="section__title">Выбор наставника</h4>

                        <form class="registration__form form form--separated form--wraped" action="" method="post">
                            <div class="registration__box box box--hidden box--grayish box--rounded-sm">
                                <div class="registration__box registration__box--small box box--hidden box--white box--rounded-sm">
                                    <div class="form__row form__row--centered">
                                        <div class="form__col">
                                            <div class="form__field">
                                                <div class="checkbox">
                                                    <input type="checkbox" class="checkbox__input" name="check[]" value="s" id="check">

                                                    <label for="check" class="checkbox__label">
                                                        <span class="checkbox__icon">
                                                            <svg class="checkbox__icon-pic icon icon--check">
                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check">
                                                            </svg>
                                                        </span>

                                                        <span class="checkbox__text">Хочу, чтобы мне подобрали Наставника</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form__col">
                                            <div class="form__field">
                                                <div class="form__field-block form__field-block--label">
                                                    <label for="text-required" class="form__label form__label--required">
                                                        <span class="form__label-text">ID наставника</span>
                                                    </label>
                                                </div>

                                                <div class="form__field-block form__field-block--input">
                                                    <div class="input">
                                                        <input type="text" class="input__control" name="text-required" id="text-required" placeholder="Введите ID наставника">
                                                    </div>
                                                </div>
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
                                    <a href="" class="button button--rounded button--covered button--red">
                                        <span class="button__text">Далее</span>
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

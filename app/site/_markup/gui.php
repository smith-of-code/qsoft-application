<!DOCTYPE html>
<html lang="ru">
    <head>
        <title>GUI</title>

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
        <div class="page__content content">
            <div class="container">
                <main class="page__main main">
                    <!--Заголовки-->
                    <div class="gui__block">
                        <h2 class="gui__title">Заголовки</h2>

                        <h1>Заголовок 1-го уровня</h1>
                        <h2>Заголовок 2-го уровня</h2>
                        <h3>Заголовок 3-го уровня</h3>
                        <h4>Заголовок 4-го уровня</h4>
                        <h5>Заголовок 5-го уровня</h5>
                        <h6>Заголовок 6-го уровня</h6>

                        <p class="heading heading--huge">Текст как заголовок 1-го уровня</p>
                        <p class="heading heading--large">Текст как заголовок 2-го уровня</p>
                        <p class="heading heading--middle">Текст как заголовок 3-го уровня</p>
                        <p class="heading heading--average">Текст как заголовок 4-го уровня</p>
                        <p class="heading heading--small">Текст как заголовок 5-го уровня</p>
                        <p class="heading heading--tiny">Текст как заголовок 6-го уровня</p>


                    </div>
                    <!--/Заголовки-->

                    <!--Параграфы-->
                    <div class="gui__block">
                        <h2 class="gui__title">Параграфы</h2>

                        <p>Проснувшись однажды утром после беспокойного сна, Грегор Замза обнаружил, что он у себя в постели превратился в страшное насекомое. Лежа на панцирнотвердой спине, он видел, стоило ему приподнять голову, свой коричневый, выпуклый, разделенный дугообразными чешуйками живот, на верхушке которого еле держалось готовое вот-вот окончательно сползти одеяло.</p>

                        <p>Проснувшись однажды утром после <a href="#">беспокойного сна</a>, Грегор Замза обнаружил, что он у себя в постели превратился в страшное насекомое. Лежа на панцирнотвердой спине, он видел, стоило ему приподнять голову, свой коричневый, выпуклый, разделенный дугообразными чешуйками живот, на верхушке которого еле держалось готовое вот-вот окончательно сползти одеяло.</p>
                    </div>
                    <!--/Параграфы-->

                    <!--Нумерованные списки-->
                    <div class="gui__block">
                        <h2 class="gui__title">Нумерованные списки</h2>

                        <ol>
                            <li>Возможность быстро проявить себя</li>

                            <li>Более свободное отношение к графику работы, отсутствие строгих корпоративных правил</li>

                            <li>Причастность к конечному результату работы компании</li>

                            <li>Разнообразный опыт</li>
                        </ol>
                    </div>
                    <!--/Нумерованные списки-->

                    <!--Ненумерованные списки-->
                    <div class="gui__block">
                        <h2 class="gui__title">Ненумерованные списки</h2>

                        <ul>
                            <li>Возможность быстро проявить себя</li>

                            <li>Более свободное отношение к графику работы, отсутствие строгих <a href="#">корпоративных правил</a></li>

                            <li>Причастность к конечному результату работы компании</li>

                            <li>Разнообразный опыт</li>
                        </ul>
                    </div>
                    <!--/Ненумерованные списки-->

                    <!--Иконки-->
                    <div class="gui__block">
                        <h2 class="gui__title">Иконки</h2>

                        <div class="icons">
                            <ul class="icons__list">
                                <li class="icons__item" title="Icon: notification">
                                    <svg class="icon icon--notification gui__icon">
                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-notification"></use>
                                    </svg>
                                </li>

                                <li class="icons__item" title="Icon: check">
                                    <svg class="icon icon--check gui__icon">
                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check"></use>
                                    </svg>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--/Иконки-->

                    <!--Чекбоксы-->
                    <div class="gui__block">
                        <h2 class="gui__title">Чекбоксы</h2>

                        <form class="form">
                            <div class="checkboxes">
                                <ul class="checkboxes__list">
                                    <li class="checkboxes__item">
                                        <div class="checkbox">
                                            <input type="checkbox" class="checkbox__input" name="check[]" value="s" id="check">

                                            <label for="check" class="checkbox__label">
                                                <span class="checkbox__icon">
                                                    <svg class="checkbox__icon-pic icon icon--check">
                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check">
                                                    </svg>
                                                </span>

                                                <span class="checkbox__text">Чекбокс</span>
                                            </label>
                                        </div>
                                    </li>

                                    <li class="checkboxes__item">
                                        <div class="checkbox">
                                            <input type="checkbox" class="checkbox__input" name="check[]" value="s1" id="check1" checked>

                                            <label for="check1" class="checkbox__label">
                                                <span class="checkbox__icon">
                                                    <svg class="checkbox__icon-pic icon icon--check">
                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check">
                                                    </svg>
                                                </span>

                                                <span class="checkbox__text">Активный чекбокс</span>
                                            </label>
                                        </div>
                                    </li>

                                    <li class="checkboxes__item">
                                        <div class="checkbox">
                                            <input type="checkbox" class="checkbox__input" name="check[]" value="s2" id="check2">

                                            <label for="check2" class="checkbox__label">
                                                <span class="checkbox__icon">
                                                    <svg class="checkbox__icon-pic icon icon--check">
                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check">
                                                    </svg>
                                                </span>

                                                <span class="checkbox__text">Нажимая кнопку "Отправить", я предоставляю персональные данные и соглашаюсь с обработкой моих персональных данных компанией в соответствии с Политикой обработки персональных данных</span>
                                            </label>
                                        </div>
                                    </li>

                                    <li class="checkboxes__item">
                                        <div class="checkbox">
                                            <input type="checkbox" class="checkbox__input" name="check[]" value="s3" id="check3" disabled>

                                            <label for="check3" class="checkbox__label">
                                                <span class="checkbox__icon">
                                                    <svg class="checkbox__icon-pic icon icon--check">
                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check">
                                                    </svg>
                                                </span>

                                                <span class="checkbox__text">Недоступный чекбокс</span>
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </form>
                    </div>
                    <!--/Чекбоксы-->

                    <!--Свитчер-->
                    <div class="gui__block">
                        <h2 class="gui__title">Свитчеры</h2>

                        <form class="form">
                            <div class="switchers">
                                <ul class="switchers__list">
                                    <li class="switchers__item">
                                        <div class="switcher" name="switcher1">
                                            <input type="checkbox" class="switcher__input" name="switch1" id="switch1">
                                            <label for="switch1" class="switcher__label">
                                                <span class="switcher__icon"></span>
                                                <span class="switcher__text">Свитчер</span>
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </form>
                    </div>
                    <!--Свитчер-->

                </main>
            </div>
        </div>
        <!--content-->

        <!--Футер-->
        <footer class="page__footer footer" style="background-color: cadetblue">
            Футер
        </footer>
        <!--/Футер-->
    </body>

</html>

<style>
    .gui__block {
        margin-bottom: 50px;
    }

    .gui__title {
        margin-bottom: 30px;

        color: #c73c5e;
    }

    .gui__icon {
        width: 30px;
        height: 30px;
    }
</style>

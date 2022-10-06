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
                            <ul class="icons__list gui__block">
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

                                <li class="icons__item" title="Icon: eye">
                                    <svg class="icon icon--eye gui__icon">
                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-eye"></use>
                                    </svg>
                                </li>

                                <li class="icons__item" title="Icon: eye-off">
                                    <svg class="icon icon--eye-off gui__icon">
                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-eye-off"></use>
                                    </svg>
                                </li>

                                <li class="icons__item" title="Icon: basket">
                                    <svg class="icon icon--basket gui__icon">
                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-basket"></use>
                                    </svg>
                                </li>

                                <li class="icons__item" title="Icon: rotate">
                                    <svg class="icon icon--rotate gui__icon">
                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-rotate"></use>
                                    </svg>
                                </li>

                                <li class="icons__item" title="Icon: plus">
                                    <svg class="icon icon--plus gui__icon">
                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-plus"></use>
                                    </svg>
                                </li>

                                <li class="icons__item" title="Icon: minus">
                                    <svg class="icon icon--minus gui__icon">
                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-minus"></use>
                                    </svg>
                                </li>

                                <li class="icons__item" title="Icon: arrow-up">
                                    <svg class="icon icon--arrow-up gui__icon">
                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-up"></use>
                                    </svg>
                                </li>

                                <li class="icons__item" title="Icon: arrow-down">
                                    <svg class="icon icon--arrow-down gui__icon">
                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-down"></use>
                                    </svg>
                                </li>

                                <li class="icons__item" title="Icon: arrow-right">
                                    <svg class="icon icon--right gui__icon">
                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-right"></use>
                                    </svg>
                                </li>

                                <li class="icons__item" title="Icon: import">
                                    <svg class="icon icon--import gui__icon">
                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-import"></use>
                                    </svg>
                                </li>

                                <li class="icons__item" title="Icon: delete">
                                    <svg class="icon icon--delete gui__icon">
                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-delete"></use>
                                    </svg>
                                </li>

                                <li class="icons__item" title="Icon: gallery">
                                    <svg class="icon icon--gallery gui__icon">
                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-gallery"></use>
                                    </svg>
                                </li>

                                <li class="icons__item" title="Icon: camera">
                                    <svg class="icon icon--camera gui__icon">
                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-camera"></use>
                                    </svg>
                                </li>

                                <li class="icons__item" title="Icon: edit">
                                    <svg class="icon icon--edit gui__icon">
                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-edit"></use>
                                    </svg>
                                </li>

                                <li class="icons__item" title="Icon: calendar">
                                    <svg class="icon icon--calendar gui__icon">
                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-calendar"></use>
                                    </svg>
                                </li>

                                <li class="icons__item" title="Icon: add-circle">
                                    <svg class="icon icon--add-circle gui__icon">
                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-add-circle"></use>
                                    </svg>
                                </li>

                                <li class="icons__item" title="Icon: lock">
                                    <svg class="icon icon--lock gui__icon">
                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-lock"></use>
                                    </svg>
                                </li>

                                <li class="icons__item" title="Icon: tick-circle">
                                    <svg class="icon icon--tick-circle gui__icon">
                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-tick-circle"></use>
                                    </svg>
                                </li>

                                <li class="icons__item" title="Icon: close-square">
                                    <svg class="icon icon--close-square gui__icon">
                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-close-square"></use>
                                    </svg>
                                </li>

                                <li class="icons__item" title="Icon: heart">
                                    <svg class="icon icon--heart gui__icon">
                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-heart"></use>
                                    </svg>
                                </li>
                                
                                <li class="icons__item" title="Icon: arrow-left">
                                    <svg class="icon icon--arrow gui__icon">
                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-left"></use>
                                    </svg>
                                </li>
                            </ul>

                            <ul class="icons__list">
                                <li class="icons__item" title="Icon: cat">
                                    <svg class="icon icon--cat gui__icon">
                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-cat"></use>
                                    </svg>
                                </li>

                                <li class="icons__item" title="Icon: dog">
                                    <svg class="icon icon--dog gui__icon">
                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-dog"></use>
                                    </svg>
                                </li>

                                <li class="icons__item" title="Icon: pet">
                                    <svg class="icon icon--pet gui__icon">
                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-pet"></use>
                                    </svg>
                                </li>

                                <li class="icons__item" title="Icon: man">
                                    <svg class="icon icon--man gui__icon">
                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-man"></use>
                                    </svg>
                                </li>

                                <li class="icons__item" title="Icon: woman">
                                    <svg class="icon icon--woman gui__icon">
                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-woman"></use>
                                    </svg>
                                </li>

                                <li class="icons__item" title="Icon: cat-serious">
                                    <svg class="icon icon--cat-serious gui__icon">
                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-cat-serious"></use>
                                    </svg>
                                </li>

                                <li class="icons__item" title="Icon: cat-cheerful">
                                    <svg class="icon icon--cat-cheerful gui__icon">
                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-cat-cheerful"></use>
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
                                                <span class="switcher__text">Переключатель</span>
                                            </label>
                                        </div>
                                    </li>

                                    <li class="switchers__item">
                                        <div class="switcher" name="switcher2">
                                            <input type="checkbox" class="switcher__input" name="switch1" id="switch2">
                                            <label for="switch2" class="switcher__label">
                                                <span class="switcher__text switcher__text--left">Переключатель с подписью слева</span>
                                                <span class="switcher__icon"></span>
                                            </label>
                                        </div>
                                    </li>

                                    <li class="switchers__item">
                                        <div class="switcher" name="switcher3">
                                            <input type="checkbox" class="switcher__input" name="switch2" id="switch3" checked>
                                            <label for="switch3" class="switcher__label">
                                                <span class="switcher__icon"></span>
                                                <span class="switcher__text">Переключатель активный</span>
                                            </label>
                                        </div>
                                    </li>

                                    <li class="switchers__item">
                                        <div class="switcher" name="switcher2">
                                            <input type="checkbox" class="switcher__input" name="switch4" id="switch4" disabled>
                                            <label for="switch4" class="switcher__label">
                                                <span class="switcher__icon"></span>
                                                <span class="switcher__text">Переключатель недоступный</span>
                                            </label>
                                        </div>
                                    </li>

                                    <li class="switchers__item">
                                        <div class="switcher" name="switcher5">
                                            <input type="checkbox" class="switcher__input" name="switch5" id="switch5">
                                            <label for="switch5" class="switcher__label">
                                                <span class="switcher__icon"></span>
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </form>
                    </div>
                    <!--Свитчер-->

                    <!--Кнопки-->
                    <div class="gui__block">
                        <h2 class="gui__title">Кнопки</h2>

                        <div class="buttons">

                            <div class="gui__block">
                                <h3>Квадратные</h3>

                                <h4 style="margin-top: 50px;">Залитые</h4>

                                <ul class="buttons__list">
                                    <li class="buttons__item">
                                        <button type="button" class="button button--square button--covered button--green">Залитая зеленая</button>
                                    </li>

                                    <li class="buttons__item">
                                        <button type="button" class="button button--square button--covered button--red">Залитая красная</button>
                                    </li>

                                    <li class="buttons__item">
                                        <button type="button" class="button button--square button--covered button--white-green">Залитая бело-зеленая</button>
                                    </li>

                                    <li class="buttons__item">
                                        <button type="button" class="button button--square button--covered button--red button--disabled" disabled>Недоступная</button>
                                    </li>
                                </ul>

                                <h4 style="margin-top: 50px;">С обводкой</h4>

                                <ul class="buttons__list">
                                    <li class="buttons__item">
                                        <button type="button" class="button button--square button--outlined button--green">С обводкой зеленая</button>
                                    </li>

                                    <li class="buttons__item">
                                        <button type="button" class="button button--square button--outlined button--red">С обводкой красная</button>
                                    </li>

                                    <li class="buttons__item">
                                        <button type="button" class="button button--square button--outlined button--red button--disabled" disabled>Недоступная</button>
                                    </li>
                                </ul>

                                <h4 style="margin-top: 50px;">Смешанные</h4>

                                <ul class="buttons__list">
                                    <li class="buttons__item">
                                        <button type="button" class="button button--square button--mixed button--red">Смешанные красная</button>
                                    </li>

                                    <li class="buttons__item">
                                        <button type="button" class="button button--square button--mixed button--red button--disabled" disabled>Недоступная</button>
                                    </li>
                                </ul>

                            </div>

                            <div class="gui__block">

                                <h3>Cкругленные</h3>

                                <h4 style="margin-top: 50px;">Залитые</h4>

                                <ul class="buttons__list">
                                    <li class="buttons__item">
                                        <button type="button" class="button button--rounded button--covered button--green">Скругленная зеленая</button>
                                    </li>

                                    <li class="buttons__item">
                                        <button type="button" class="button button--rounded button--covered button--red">Скругленная красная</button>
                                    </li>

                                    <li class="buttons__item">
                                        <button type="button" class="button button--rounded button--covered button--white-green">Скругленная бело-зеленая</button>
                                    </li>

                                    <li class="buttons__item">
                                        <button type="button" class="button button--rounded button--covered button--white-green button--disabled" disabled>Недоступная</button>
                                    </li>
                                </ul>

                                <h4 style="margin-top: 50px;">С обводкой</h4>

                                <ul class="buttons__list">
                                    <li class="buttons__item">
                                        <button type="button" class="button button--rounded button--outlined button--green">Скругленная зеленая</button>
                                    </li>

                                    <li class="buttons__item">
                                        <button type="button" class="button button--rounded button--outlined button--red">Скругленная красная</button>
                                    </li>


                                    <li class="buttons__item">
                                        <button type="button" class="button button--rounded button--outlined button--red button--disabled" disabled>Недоступная</button>
                                    </li>
                                </ul>

                                <h4 style="margin-top: 50px;">Смешанные</h4>

                                <ul class="buttons__list">
                                    <li class="buttons__item">
                                        <button type="button" class="button button--rounded button--mixed button--red">Квадратная залитая</button>
                                    </li>

                                    <li class="buttons__item">
                                        <button type="button" class="button button--rounded button--mixed button--red button--disabled" disabled>Недоступная</button>
                                    </li>
                                </ul>

                            </div>

                            <div class="gui__block">

                                <h3>Сильно скругленные</h3>

                                <h4 style="margin-top: 50px;">Залитые</h4>

                                <ul class="buttons__list">
                                    <li class="buttons__item">
                                        <button type="button" class="button button--rounded-big button--covered button--green">Скругленная зеленая</button>
                                    </li>

                                    <li class="buttons__item">
                                        <button type="button" class="button button--rounded-big button--covered button--red">Скругленная красная</button>
                                    </li>

                                    <li class="buttons__item">
                                        <button type="button" class="button button--rounded-big button--covered button--white-green">Скругленная бело-зеленая</button>
                                    </li>

                                    <li class="buttons__item">
                                        <button type="button" class="button button--rounded-big button--covered button--white-green button--disabled" disabled>Недоступная</button>
                                    </li>
                                </ul>

                                <h4 style="margin-top: 50px;">С обводкой</h4>

                                <ul class="buttons__list">
                                    <li class="buttons__item">
                                        <button type="button" class="button button--rounded-big button--outlined button--green">Скругленная зеленая</button>
                                    </li>

                                    <li class="buttons__item">
                                        <button type="button" class="button button--rounded-big button--outlined button--red">Скругленная красная</button>
                                    </li>


                                    <li class="buttons__item">
                                        <button type="button" class="button button--rounded-big button--outlined button--red button--disabled" disabled>Недоступная</button>
                                    </li>
                                </ul>

                                <h4 style="margin-top: 50px;">Смешанные</h4>

                                <ul class="buttons__list">
                                    <li class="buttons__item">
                                        <button type="button" class="button button--rounded-big button--mixed button--red">Квадратная залитая</button>
                                    </li>

                                    <li class="buttons__item">
                                        <button type="button" class="button button--rounded-big button--mixed button--red button--disabled" disabled>Недоступная</button>
                                    </li>
                                </ul>

                            </div>

                            <div class="gui__block">

                                <h3>С иконками</h3>

                                <h4 style="margin-top: 50px;">Залитые</h4>

                                <ul class="buttons__list">
                                    <li class="buttons__item">
                                        <button type="button" class="button button--medium button--rounded button--covered button--red">
                                            <span class="button__icon">
                                                <svg class="icon icon--basket">
                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-basket"></use>
                                                </svg>
                                            </span>
                                            <span class="button__text">С иконкой слева</span>
                                        </button>
                                    </li>

                                    <li class="buttons__item">
                                        <button type="button" class="button button--medium button--rounded button--covered button--green">
                                            <span class="button__icon button__icon--right">
                                                <svg class="icon icon--basket">
                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-basket"></use>
                                                </svg>
                                            </span>
                                            <span class="button__text">С иконкой справа</span>
                                        </button>
                                    </li>

                                    <li class="buttons__item">
                                        <button type="button" class="button button--medium button--rounded button--outlined button--green">
                                            <span class="button__icon button__icon--medium">
                                                <svg class="icon icon--basket">
                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-basket"></use>
                                                </svg>
                                            </span>
                                            <span class="button__text">С небольшой иконкой слева</span>
                                        </button>
                                    </li>

                                    <li class="buttons__item">
                                        <button type="button" class="button button--medium button--rounded button--outlined button--green button--disabled" disabled>
                                            <span class="button__icon button__icon--medium">
                                                <svg class="icon icon--basket">
                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-basket"></use>
                                                </svg>
                                            </span>
                                            <span class="button__text">Недоступная</span>
                                        </button>
                                    </li>
                                </ul>

                            </div>

                            <div class="gui__block">

                                <h3>Иконочные</h3>

                                <ul class="buttons__list" style="background-color: #D0D0D0;">
                                    <li class="buttons__item">
                                        <button type="button" class="button button--circular button--mini button--mixed button--gray-red">
                                            <span class="button__icon">
                                                <svg class="icon icon--basket">
                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-basket"></use>
                                                </svg>
                                            </span>
                                        </button>
                                    </li>

                                    <li class="buttons__item">
                                        <button type="button" class="button button--circular button--small button--mixed button--gray-red button--shadow">
                                            <span class="button__icon">
                                                <svg class="icon icon--basket">
                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-basket"></use>
                                                </svg>
                                            </span>
                                        </button>
                                    </li>

                                    <li class="buttons__item">
                                        <button type="button" class="button button--covered button--square button--middle button--black-red">
                                            <span class="button__icon button__icon--medium">
                                                <svg class="icon icon--basket">
                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-basket"></use>
                                                </svg>
                                            </span>
                                        </button>
                                    </li>

                                    <li class="buttons__item">
                                        <button type="button" class="button button--iconed button--covered button--square button--small button--gray-red">
                                            <span class="button__icon button__icon--small">
                                                <svg class="icon icon--minus">
                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-minus"></use>
                                                </svg>
                                            </span>
                                        </button>
                                    </li>

                                    <li class="buttons__item">
                                        <button type="button" class="button button--iconed button--covered button--square button--small button--gray-green">
                                            <span class="button__icon button__icon--small">
                                                <svg class="icon icon--plus">
                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-plus"></use>
                                                </svg>
                                            </span>
                                        </button>
                                    </li>

                                    <li class="buttons__item">
                                        <button type="button" class="button button--iconed button--covered button--rounded button--big button--green">
                                            <span class="button__icon button__icon--small">
                                                <svg class="icon icon--plus">
                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-plus"></use>
                                                </svg>
                                            </span>
                                        </button>
                                    </li>

                                    <li class="buttons__item">
                                        <button type="button" class="button button--iconed button--covered button--rounded button--big button--red">
                                            <span class="button__icon button__icon--small">
                                                <svg class="icon icon--plus">
                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-plus"></use>
                                                </svg>
                                            </span>
                                        </button>
                                    </li>

                                    <li class="buttons__item">
                                        <button type="button" class="button button--iconed button--simple button--big button--red">
                                            <span class="button__icon">
                                                <svg class="icon icon--basket">
                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-basket"></use>
                                                </svg>
                                            </span>
                                        </button>
                                    </li>
                                </ul>

                            </div>

                            <div class="gui__block">

                                <h3>Простые</h3>

                                <ul class="buttons__list">
                                    <li class="buttons__item">
                                        <button type="button" class="button button--simple button--red">
                                            Простая кнопка
                                        </button>
                                    </li>

                                    <li class="buttons__item">
                                        <a href="#" type="button" class="button button--simple button--red button--underlined">
                                            Простая ссылка
                                        </a>
                                    </li>

                                    <li class="buttons__item">
                                        <a href="#" type="button" class="button button--simple button--red button--over">
                                            Простая ссылка
                                        </a>
                                    </li>

                                    <li class="buttons__item">
                                        <button type="button" class="button button--simple button--red button--disabled" disabled>
                                            Недоступная
                                        </button>
                                    </li>
                                </ul>

                                <h3 style="margin-top: 50px;">Простые с иконками</h3>

                                <ul class="buttons__list">
                                    <li class="buttons__item">
                                        <button type="button" class="button button--simple button--red">
                                            <span class="button__icon">
                                                <svg class="icon icon--basket">
                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-basket"></use>
                                                </svg>
                                            </span>
                                            <span class="button__text">С иконкой слева</span>
                                        </button>
                                    </li>

                                    <li class="buttons__item">
                                        <button type="button" class="button button--simple button--red">
                                            <span class="button__icon button__icon--right">
                                                <svg class="icon icon--basket">
                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-basket"></use>
                                                </svg>
                                            </span>
                                            <span class="button__text">С иконкой справа</span>
                                        </button>
                                    </li>

                                    <li class="buttons__item">
                                        <a href="#" type="button" class="button button--simple button--red">
                                            <span class="button__icon button__icon--right">
                                                <svg class="icon icon--basket">
                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-notification"></use>
                                                </svg>
                                            </span>
                                            <span class="button__text">Ссылка</span>
                                        </a>
                                    </li>

                                    <li class="buttons__item">
                                        <span type="button" class="button button--simple button--red">
                                            <span class="button__icon button__icon--right">
                                                <svg class="icon icon--basket">
                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-rotate"></use>
                                                </svg>
                                            </span>
                                            <span class="button__text">Спан</span>
                                        </span>
                                    </li>

                                    <li class="buttons__item">
                                        <button type="button" class="button button--simple button--red button--disabled" disabled>
                                            <span class="button__icon button__icon--right">
                                                <svg class="icon icon--basket">
                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-basket"></use>
                                                </svg>
                                            </span>
                                            <span class="button__text">Недоступная с иконкой справа</span>
                                        </button>
                                    </li>
                                </ul>

                            </div>
                        </div>

                    </div>
                    <!--/Кнопки-->

                    <!--Изменение количества-->
                    <div class="gui__block">
                        <h2 class="gui__title">Изменение количества</h2>

                        <div class="quantity" style="width: 230px" data-quantity>
                            <div class="quantity__button" data-quantity-button>
                                <button type="button" class="button button--full button--medium button--rounded button--covered button--white-green">
                                    <span class="button__icon">
                                        <svg class="icon icon--basket">
                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-basket"></use>
                                        </svg>
                                    </span>
                                    <span class="button__text">В корзину</span>
                                </button>
                            </div>

                            <div class="quantity__actions">
                                <div class="quantity__decrease">
                                    <button type="button" class="button button--iconed button--covered button--square button--small button--gray-red" data-quantity-decrease>
                                        <span class="button__icon button__icon--small">
                                            <svg class="icon icon--minus">
                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-minus"></use>
                                            </svg>
                                        </span>
                                    </button>
                                </div>

                                <div class="quantity__total">
                                    <span class="quantity__total-icon">
                                        <svg class="icon icon--basket">
                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-basket"></use>
                                        </svg>
                                    </span>
                                    <span class="quantity__total-sum" data-quantity-sum="0">0</span>
                                </div>

                                <div class="quantity__increase">
                                    <button type="button" class="button button--iconed button--covered button--square button--small button--gray-green" data-quantity-increase>
                                        <span class="button__icon button__icon--small">
                                            <svg class="icon icon--plus">
                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-plus"></use>
                                            </svg>
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/Изменение количества-->

                    <!--Текстовые поля ввода-->
                    <div class="gui__block">
                        <h2 class="gui__title">Текстовые поля ввода</h2>

                        <form class="form">
                            <div class="form__row">
                                <div class="form__col">
                                    <div class="form__field">
                                        <div class="form__field-block form__field-block--label">
                                            <label for="text16" class="form__label">
                                                <span class="form__label-text">Поле ввода</span>
                                            </label>
                                        </div>

                                        <div class="form__field-block form__field-block--input">
                                            <div class="input input--iconed">
                                                <input type="text" class="input__control" name="text" id="text16" placeholder="Поле ввода с лэйблом">
                                                <span class="input__icon">
                                                    <svg class="icon icon--check">
                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check"></use>
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form__row">
                                <div class="form__col">
                                    <div class="form__field">
                                        <div class="form__field-block form__field-block--input">
                                            <label class="form__field-label" for="min">
                                                от
                                            </label>
                                            <div class="input input--mini input--prefix">
                                                <input type="number" class="input__control" name="min" id="text11" placeholder="Поле ввода чисел">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form__row">
                                <div class="form__col">
                                    <div class="form__field">
                                        <div class="form__field-block form__field-block--input">
                                            <label class="form__field-label" for="max">
                                                до
                                            </label>
                                            <div class="input input--mini input--prefix">
                                                <input type="number" class="input__control" name="max" id="text12" placeholder="Поле ввода чисел">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form__row">
                                <div class="form__col">
                                    <div class="form__field">
                                        <div class="form__field-block form__field-block--label">
                                            <label for="text-required12" class="form__label form__label--required">
                                                <span class="form__label-text">Обязательное поле ввода</span>
                                            </label>
                                        </div>

                                        <div class="form__field-block form__field-block--input">
                                            <div class="input">
                                                <input type="text" class="input__control" name="text-required" id="text-required12" placeholder="Обязательное поле ввода">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form__row">
                                <div class="form__col">
                                    <div class="form__field">
                                        <div class="form__field-block form__field-block--label">
                                            <label for="text-disabled" class="form__label">
                                                <span class="form__label-text">Недоступное поле ввода</span>
                                            </label>
                                        </div>

                                        <div class="form__field-block form__field-block--input">
                                            <div class="input">
                                                <input type="text" class="input__control" name="text-disabled" id="text-disabled" placeholder="Недоступное поле ввода" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form__row">
                                <div class="form__col">
                                    <div class="form__field">
                                        <div class="form__field-block form__field-block--label">
                                            <label for="text2" class="form__label form__label--required">
                                                <span class="form__label-text">Поле ввода c ошибкой</span>
                                            </label>
                                        </div>

                                        <div class="form__field-block form__field-block--input">
                                            <div class="input input--iconed">
                                                <input type="text" class="input__control input__control--error" name="text" id="text2" placeholder="Поле ввода с лэйблом">

                                                <span class="input__control-error">Указан некорректный адрес электронной почты</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form__row">
                                <div class="form__col">
                                    <div class="form__field">
                                        <div class="form__field-block form__field-block--label">
                                            <label for="password" class="form__label">
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

                            <div class="form__row">
                                <div class="form__col">
                                    <div class="form__field">
                                        <div class="form__field-block form__field-block--input">
                                            <div class="input input--small input--buttoned input--placeholder">
                                                <input type="text" class="input__control" name="text" id="text3" value="">
                                                <span class="input__placeholder">Сколько баллов списать</span>
                                                <button type="button" class="input__button button button--iconed button--covered button--rounded button--big button--green">
                                                    <span class="button__icon button__icon--small">
                                                        <svg class="icon icon--plus">
                                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-plus"></use>
                                                        </svg>
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form__row">
                                <div class="form__col">
                                    <div class="form__field">
                                        <div class="form__field-block form__field-block--input">
                                            <div class="input input--small input--buttoned input--placeholder">
                                                <input type="text" class="input__control" name="text" id="text4" value="">
                                                <span class="input__placeholder">Сколько баллов списать</span>
                                                <button type="button" class="input__button button button--iconed button--covered button--rounded button--big button--red">
                                                    <span class="button__icon button__icon--small">
                                                        <svg class="icon icon--plus">
                                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-plus"></use>
                                                        </svg>
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form__row">
                                <div class="form__col">
                                    <div class="form__field">
                                        <div class="form__field-block form__field-block--input">
                                            <div class="input input--small input--buttoned">
                                                <input type="text" class="input__control" name="text" id="text5" placeholder="Сколько баллов списать">
                                                <button type="button" class="input__button button button--iconed button--covered button--rounded button--big button--red">
                                                    <span class="button__icon button__icon--small">
                                                        <svg class="icon icon--plus">
                                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-plus"></use>
                                                        </svg>
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form__row">
                                <div class="form__col">
                                    <div class="form__field">
                                        <div class="form__field-block form__field-block--input">
                                            <label class="form__field-label" for="min">
                                                от
                                            </label>
                                            <div class="input input--mini input--prefix">
                                                <input type="number" class="input__control" name="min" id="text13" placeholder="Поле ввода чисел">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form__row">
                                <div class="form__col">
                                    <div class="form__field">
                                        <div class="form__field-block form__field-block--input">
                                            <label class="form__field-label" for="max">
                                                до
                                            </label>
                                            <div class="input input--mini input--prefix">
                                                <input type="number" class="input__control" name="max" id="text14" placeholder="Поле ввода чисел">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form__row">
                                <div class="form__col">
                                    <div class="form__field">
                                        <div class="form__field-block form__field-block--label">
                                            <label for="text" class="form__label">
                                                <span class="form__label-text">Многострочное поле ввода</span>
                                            </label>
                                        </div>
                                        <div class="form__field-block form__field-block--input">
                                            <label class="input input--textarea">
                                                <textarea type="text" class="input__control" name="textarea" id="textarea1" placeholder="Многострочное поле ввода" maxlength="1000" data-textarea-input></textarea>
                                                <div class="input__counter">
                                                    <span class="input__counter-current" data-textarea-current></span>
                                                        /
                                                    <span class="input__counter-total" data-textarea-total></span>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form__row">
                                <div class="form__col">
                                    <div class="form__field">
                                        <div class="form__field-block form__field-block--label">
                                            <label for="text" class="form__label">
                                                <span class="form__label-text">Нередактируемое</span>
                                            </label>
                                        </div>
                                        <div class="form__field-block form__field-block--input">
                                            <div class="input input--simple">
                                                <input type="text" class="input__control" name="Email" id="Email" value="Pushkin@ya.ru" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form__row">
                                <div class="form__col">
                                    <div class="form__field">
                                        <div class="form__field-block form__field-block--label">
                                            <label for="birthdate" class="form__label">
                                                <span class="form__label-text">Дата</span>
                                            </label>
                                        </div>
                                        <div class="form__field-block form__field-block--input">
                                            <div class="input input--iconed">
                                                <input inputmode="numeric"
                                                    class="input__control"
                                                    name="birthdate"
                                                    id="birthdate"
                                                    placeholder="ДД.ММ.ГГГГ"
                                                    data-mask-date 
                                                    data-inputmask-alias="datetime"
                                                    data-inputmask-inputformat="dd.mm.yyyy"
                                                    data-pets-date-input
                                                    data-pets-change
                                                    value="09.11.2011"
                                                >
                                                <span class="input__icon">
                                                    <svg class="icon icon--calendar">
                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-calendar"></use>
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form__row">
                                <div class="form__col">
                                    <div class="form__field">
                                        <div class="form__field-block form__field-block--label">
                                            <label for="text" class="form__label">
                                                <span class="form__label-text">Телефон</span>
                                            </label>
                                        </div>
                                        <div class="form__field-block form__field-block--input">
                                            <div class="input">
                                                <input type="tel" class="input__control" name="text-required" id="text-required1" placeholder="+7 (___) ___-__-__" data-phone inputmode="text">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form__row">
                                <div class="form__col">
                                    <div class="form__field">
                                        <div class="form__field-block form__field-block--label">
                                            <label for="text-required" class="form__label form__label--required">
                                                <span class="form__label-text">E-mail</span>
                                            </label>
                                        </div>

                                        <div class="form__field-block form__field-block--input">
                                            <div class="input">
                                                <input type="text" class="input__control" name="text-required" id="text-required2" placeholder="example@email.com" data-mail inputmode="email">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form__row">
                                <div class="form__col">
                                    <div class="form__field">
                                        <div class="form__field-block form__field-block--label">
                                            <label for="text-required" class="form__label form__label--required">
                                                <span class="form__label-text">Серия паспорта</span>
                                            </label>
                                        </div>

                                        <div class="form__field-block form__field-block--input">
                                            <div class="input">
                                                <input type="text" class="input__control" name="text-required" id="text-required3" placeholder="12 34" data-passport-seria>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form__row">
                                <div class="form__col">
                                    <div class="form__field">
                                        <div class="form__field-block form__field-block--label">
                                            <label for="text-required" class="form__label form__label--required">
                                                <span class="form__label-text">Номер</span>
                                            </label>
                                        </div>

                                        <div class="form__field-block form__field-block--input">
                                            <div class="input">
                                                <input type="text" class="input__control" name="text-required" id="text-required4" placeholder="Введите номер паспорта" data-passport-number>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form__row">
                                <div class="form__col">
                                    <div class="form__field">
                                        <div class="form__field-block form__field-block--label">
                                            <label for="text-required5" class="form__label form__label--required">
                                                <span class="form__label-text">ИНН</span>
                                            </label>
                                        </div>

                                        <div class="form__field-block form__field-block--input">
                                            <div class="input">
                                                <input type="text" class="input__control" name="text-required" id="text-required5" placeholder="ИНН" data-inn>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form__row">
                                <div class="form__col">
                                    <div class="form__field">
                                        <div class="form__field-block form__field-block--label">
                                            <label for="text-required6" class="form__label form__label--required">
                                                <span class="form__label-text">БИК</span>
                                            </label>
                                        </div>

                                        <div class="form__field-block form__field-block--input">
                                            <div class="input">
                                                <input type="text" class="input__control" name="text-required" id="text-required6" placeholder="БИК" data-bik>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!--/Текстовые поля ввода-->

                    <!--Селекты-->
                    <div class="gui__block">
                        <h2 class="gui__title">Селекты</h2>

                        <form class="form">
                            <div class="form__row">
                                <div class="form__col">
                                    <div class="form__field">
                                        <div class="form__field-block form__field-block--label">
                                            <label for="select" class="form__label">
                                                <span class="form__label-text">Селект</span>
                                            </label>
                                        </div>

                                        <div class="form__field-block form__field-block--input">
                                            <div class="form__control">
                                                <div class="select" data-select>
                                                    <select class="select__control" name="select" id="select" data-select-control data-placeholder="Селект">
                                                        <option><!-- пустой option для placeholder --></option>
                                                        <option value="1">Надёжный</option>
                                                        <option value="2">Активное, пассивное, нейтральное, быстрое, медленное и разнообразное пополнение</option>
                                                        <option value="3">Открытый</option>
                                                        <option value="4" disabled>Недоступный</option>
                                                        <option value="5">Открытый</option>
                                                        <option value="6">Открытый</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form__row">
                                <div class="form__col">
                                    <div class="form__field">
                                        <div class="form__field-block form__field-block--label">
                                            <label for="select" class="form__label">
                                                <span class="form__label-text">Селект маленький</span>
                                            </label>
                                        </div>

                                        <div class="form__field-block form__field-block--input">
                                            <div class="form__control">
                                                <div class="select select--mitigate" data-select>
                                                    <select class="select__control" name="select2" id="select2" data-select-control data-placeholder="Селект">
                                                        <option><!-- пустой option для placeholder --></option>
                                                        <option value="1">Надёжный</option>
                                                        <option value="2">Активное, пассивное, нейтральное, быстрое, медленное и разнообразное пополнение</option>
                                                        <option value="3">Открытый</option>
                                                        <option value="4" disabled>Недоступный</option>
                                                        <option value="5">Открытый</option>
                                                        <option value="6">Открытый</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form__row">
                                <div class="form__col">
                                    <div class="form__field">
                                        <div class="form__field-block form__field-block--label">
                                            <label for="select" class="form__label">
                                                <span class="form__label-text">Селект ограниченный</span>
                                            </label>
                                        </div>

                                        <div class="form__field-block form__field-block--input">
                                            <div class="form__control">
                                                <div class="select select--mitigate select--small" data-select>
                                                    <select class="select__control" name="select3" id="select3" data-select-control data-placeholder="Селект">
                                                        <option><!-- пустой option для placeholder --></option>
                                                        <option value="1">Надёжный</option>
                                                        <option value="2">Активное, пассивное, нейтральное, быстрое, медленное и разнообразное пополнение</option>
                                                        <option value="3">Открытый</option>
                                                        <option value="4" disabled>Недоступный</option>
                                                        <option value="5">Открытый</option>
                                                        <option value="6">Открытый</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form__row">
                                <div class="form__col">
                                    <div class="form__field">
                                        <div class="form__field-block form__field-block--input">
                                            <div class="form__control">
                                                <div class="select select--mini" data-select>
                                                    <select class="select__control" name="select5" id="select5" data-select-control data-placeholder="Селект">
                                                        <option><!-- пустой option для placeholder --></option>
                                                        <option value="1">Надёжный</option>
                                                        <option value="2">Активное, пассивное, нейтральное, быстрое, медленное и разнообразное пополнение</option>
                                                        <option value="3">Открытый</option>
                                                        <option value="4" disabled>Недоступный</option>
                                                        <option value="5">Открытый</option>
                                                        <option value="6">Открытый</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!--/Селекты-->

                    <!--Ползунок-->
                    <div class="gui__block">
                        <h2 class="gui__title">Ползунок</h2>

                        <form class="form">
                            <div class="range" data-range>
                                <div class="range-slider" data-range-slider data-min="1000" data-max="9000" data-step="1"></div> 
                            </div>

                            <div class="range" data-range>
                                <div class="range-slider" data-range-slider data-min="1000" data-max="9000" data-step="1"></div> 
                                <div class="range__group">
                                    <div class="range__group-field form__field">
                                        <div class="form__field-block form__field-block--input">
                                            <label class="form__field-label" for="min">
                                                от
                                            </label>
                                            <div class="input input--mini input--prefix">
                                                <input type="number" data-range-min="min" value="1000" name="min" class="range__input input__control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="range__group-field form__field">
                                        <div class="form__field-block form__field-block--input">
                                            <label class="form__field-label" for="max">
                                                до
                                            </label>
                                            <div class="input input--mini input--prefix">
                                                <input type="number" data-range-max="max" value="9000" name="max" class="range__input input__control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                    <!--/Ползунок-->

                    <!--Табы-->
                    <div class="gui__block">
                        <h2 class="gui__title">Табы</h2>

                        <div class="gui__block">
                            <h3>Простые красные</h3>

                            <div class="tabs tabs--red" data-tabs>
                                <nav class="tabs__items">
                                    <ul class="tabs__list">
                                        <li class="tabs__item tabs__item--active" data-tab="block1">
                                            Описание
                                        </li>

                                        <li class="tabs__item" data-tab="block2">
                                            Состав
                                        </li>

                                        <li class="tabs__item" data-tab="block3">
                                            Рекомендации по кормлению
                                        </li>

                                        <li class="tabs__item" data-tab="block4">
                                            Документы
                                        </li>
                                    </ul>
                                </nav>

                                <div class="tabs__body" style="margin-top: 10px; margin-bottom: 20px">
                                    <div class="tabs__block tabs__block--active" data-tab-section="block1">
                                        Описание
                                    </div>

                                    <div class="tabs__block" data-tab-section="block2">
                                        Состав
                                    </div>

                                    <div class="tabs__block" data-tab-section="block3">
                                        Рекомендации по кормлению
                                    </div>

                                    <div class="tabs__block" data-tab-section="block4">
                                        Документы
                                    </div>
                                </div>
                            </div>

                            <div class="tabs tabs--small tabs--red" data-tabs>
                                <nav class="tabs__items">
                                    <ul class="tabs__list">
                                        <li class="tabs__item tabs__item--active" data-tab="block1">
                                            Описание
                                        </li>

                                        <li class="tabs__item" data-tab="block2">
                                            Состав
                                        </li>

                                        <li class="tabs__item" data-tab="block3">
                                            Рекомендации по кормлению
                                        </li>

                                        <li class="tabs__item" data-tab="block4">
                                            Документы
                                        </li>
                                    </ul>
                                </nav>

                                <div class="tabs__body" style="margin-top: 10px; margin-bottom: 20px">
                                    <div class="tabs__block tabs__block--active" data-tab-section="block1">
                                        Описание
                                    </div>

                                    <div class="tabs__block" data-tab-section="block2">
                                        Состав
                                    </div>

                                    <div class="tabs__block" data-tab-section="block3">
                                        Рекомендации по кормлению
                                    </div>

                                    <div class="tabs__block" data-tab-section="block4">
                                        Документы
                                    </div>
                                </div>
                            </div>

                            <div class="tabs tabs--small tabs--circle tabs--red" data-tabs>
                                <nav class="tabs__items">
                                    <ul class="tabs__list">
                                        <li class="tabs__item tabs__item--active" data-tab="block1">
                                            Описание
                                        </li>

                                        <li class="tabs__item" data-tab="block2">
                                            Состав
                                        </li>

                                        <li class="tabs__item" data-tab="block3">
                                            Рекомендации по кормлению
                                        </li>

                                        <li class="tabs__item" data-tab="block4">
                                            Документы
                                        </li>
                                    </ul>
                                </nav>

                                <div class="tabs__body" style="margin-top: 10px; margin-bottom: 20px">
                                    <div class="tabs__block tabs__block--active" data-tab-section="block1">
                                        Описание
                                    </div>

                                    <div class="tabs__block" data-tab-section="block2">
                                        Состав
                                    </div>

                                    <div class="tabs__block" data-tab-section="block3">
                                        Рекомендации по кормлению
                                    </div>

                                    <div class="tabs__block" data-tab-section="block4">
                                        Документы
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="gui__block">
                            <h3>С серым фоном</h3>

                            <div class="tabs tabs--covered tabs--red" data-tabs>
                                <nav class="tabs__items">
                                    <ul class="tabs__list">
                                        <li class="tabs__item tabs__item--active" data-tab="block1">
                                            Описание
                                        </li>

                                        <li class="tabs__item" data-tab="block2">
                                            Состав
                                        </li>

                                        <li class="tabs__item" data-tab="block3">
                                            Рекомендации по кормлению
                                        </li>

                                        <li class="tabs__item" data-tab="block4">
                                            Документы
                                        </li>
                                    </ul>
                                </nav>

                                <div class="tabs__body" style="margin-top: 10px; margin-bottom: 20px">
                                    <div class="tabs__block tabs__block--active" data-tab-section="block1">
                                        Описание
                                    </div>

                                    <div class="tabs__block" data-tab-section="block2">
                                        Состав
                                    </div>

                                    <div class="tabs__block" data-tab-section="block3">
                                        Рекомендации по кормлению
                                    </div>

                                    <div class="tabs__block" data-tab-section="block4">
                                        Документы
                                    </div>
                                </div>
                            </div>

                            <div class="tabs tabs--small tabs--covered tabs--red" data-tabs>
                                <nav class="tabs__items">
                                    <ul class="tabs__list">
                                        <li class="tabs__item tabs__item--active" data-tab="block1">
                                            Описание
                                        </li>
    
                                        <li class="tabs__item" data-tab="block2">
                                            Состав
                                        </li>
    
                                        <li class="tabs__item" data-tab="block3">
                                            Рекомендации по кормлению
                                        </li>
    
                                        <li class="tabs__item" data-tab="block4">
                                            Документы
                                        </li>
                                    </ul>
                                </nav>
    
                                <div class="tabs__body" style="margin-top: 10px; margin-bottom: 20px">
                                    <div class="tabs__block tabs__block--active" data-tab-section="block1">
                                        Описание
                                    </div>
    
                                    <div class="tabs__block" data-tab-section="block2">
                                        Состав
                                    </div>
    
                                    <div class="tabs__block" data-tab-section="block3">
                                        Рекомендации по кормлению
                                    </div>
    
                                    <div class="tabs__block" data-tab-section="block4">
                                        Документы
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="gui__block">
                            <h3>Черные</h3>

                            <div class="tabs tabs--black tabs--rounded" data-tabs>
                                <nav class="tabs__items">
                                    <ul class="tabs__list">
                                        <li class="tabs__item tabs__item--active" data-tab="block1">
                                            Описание
                                        </li>

                                        <li class="tabs__item" data-tab="block2">
                                            Состав
                                        </li>

                                        <li class="tabs__item" data-tab="block3">
                                            Рекомендации по кормлению
                                        </li>

                                        <li class="tabs__item" data-tab="block4">
                                            Документы
                                        </li>
                                    </ul>
                                </nav>

                                <div class="tabs__body" style="margin-top: 10px; margin-bottom: 20px">
                                    <div class="tabs__block tabs__block--active" data-tab-section="block1">
                                        Описание
                                    </div>

                                    <div class="tabs__block" data-tab-section="block2">
                                        Состав
                                    </div>

                                    <div class="tabs__block" data-tab-section="block3">
                                        Рекомендации по кормлению
                                    </div>

                                    <div class="tabs__block" data-tab-section="block4">
                                        Документы
                                    </div>
                                </div>
                            </div>

                            <div class="tabs tabs--small tabs--black tabs--rounded" data-tabs>
                                <nav class="tabs__items">
                                    <ul class="tabs__list">
                                        <li class="tabs__item tabs__item--active" data-tab="block1">
                                            Описание
                                        </li>

                                        <li class="tabs__item" data-tab="block2">
                                            Состав
                                        </li>

                                        <li class="tabs__item" data-tab="block3">
                                            Рекомендации по кормлению
                                        </li>

                                        <li class="tabs__item" data-tab="block4">
                                            Документы
                                        </li>
                                    </ul>
                                </nav>

                                <div class="tabs__body" style="margin-top: 10px; margin-bottom: 20px">
                                    <div class="tabs__block tabs__block--active" data-tab-section="block1">
                                        Описание
                                    </div>

                                    <div class="tabs__block" data-tab-section="block2">
                                        Состав
                                    </div>

                                    <div class="tabs__block" data-tab-section="block3">
                                        Рекомендации по кормлению
                                    </div>

                                    <div class="tabs__block" data-tab-section="block4">
                                        Документы
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="gui__block">
                            <h3>Перестраивающиеся</h3>

                            <div class="tabs tabs--red tabs--separated tabs--small" data-tabs>
                                <nav class="tabs__items">
                                    <ul class="tabs__list">
                                        <li class="tabs__item tabs__item--active" data-tab="block1">
                                            Уровень К1
                                        </li>

                                        <li class="tabs__item" data-tab="block2">
                                            Уровень К2
                                        </li>

                                        <li class="tabs__item" data-tab="block3">
                                            Уровень К3
                                        </li>
                                    </ul>
                                </nav>

                                <div class="tabs__body" style="margin-top: 10px; margin-bottom: 20px">
                                    <div class="tabs__block tabs__block--active" data-tab-section="block1">
                                        Описание
                                    </div>

                                    <div class="tabs__block" data-tab-section="block2">
                                        Состав
                                    </div>

                                    <div class="tabs__block" data-tab-section="block3">
                                        Рекомендации по кормлению
                                    </div>

                                    <div class="tabs__block" data-tab-section="block4">
                                        Документы
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!--/Табы-->

                    <!--Стилизованный скроллбар-->
                    <div class="gui__block">
                        <h2 class="gui__title">Стилизованный скроллбар</h2>

                        <h3 style="margin-top: 50px;">Вертикальный скроллбар</h3>

                        <div style="max-height: 150px;" data-scrollbar>
                            <p style="padding-right: 10px">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                                Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                                Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                                Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                                Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                            </p>
                        </div>

                        <h3 style="margin-top: 50px;">Горизонтальный скроллбар</h3>

                        <div data-scrollbar>
                            <p style="padding-bottom: 5px; white-space: nowrap">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                                Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                            </p>
                        </div>
                    </div>
                    <!--/Стилизованный скроллбар-->

                    <!--Тултип-->
                    <div class="gui__block">
                        <h2 class="gui__title">Тултип</h2>

                        <svg class="tooltip icon icon--plus gui__icon" data-tippy-content="нет в наличии">
                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-plus"></use>
                        </svg>

                    </div>
                    <!--/Тултип-->

                    <!--Показать еще-->
                    <div class="gui__block">
                        <h2 class="gui__title">Показать еще</h2>

                        <div data-toggle-visibility-container>
                            <p>Табличку можно определить как физически прочный, надёжный носитель письменной информации, относительно удобным способом передачи информации
                                ный носитель письменной информации, относительно удобным способом передачи информаци
                                ный носитель письменной информации, относительно удобным способом передачи информаци
                                ный носитель письменной информации, относительно удобным способом передачи информаци</p>

                            <p data-toggle-visibility-block style="display: none;">Табличку можно определить как физически прочный, надёжный носитель письменной информации, относительно удобным способом передачи информации
                                ный носитель письменной информации, относительно удобным способом передачи информаци
                                ный носитель письменной информации, относительно удобным способом передачи информаци
                                ный носитель письменной информации, относительно удобным способом передачи информаци</p>

                            <button type="button" class="button button--simple button--gray button--small" data-toggle-visibility-action="hide">
                                <span class="button__icon button__icon--mini button__icon--right">
                                    <svg class="icon icon--arrow-up">
                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-up"></use>
                                    </svg>
                                </span>
                                <span class="button__text" data-toggle-visibility-action-text="{&quot;show&quot;:&quot;Показать детализацию&quot;, &quot;hide&quot;:&quot;Скрыть детализацию&quot;}">Показать детализацию</span>
                            </button>
                        </div>
                    </div>
                    <!--/Показать еще-->

                    <!--Дропдаун-->
                    <div class="gui__block">
                        <h2 class="gui__title">Дропдаун</h2>

                        <h3>Дропдаун маленький</h3>

                        <div class="dropdown dropdown--small" data-dropdown>
                            <button type="button" class="button button--simple button--gray button--small" data-dropdown-button>
                                <span class="button__icon button__icon--mini button__icon--right">
                                    <svg class="icon icon--arrow-up">
                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-up"></use>
                                    </svg>
                                </span>
                                <span class="button__text">Показать детализацию</span>
                            </button>

                            <div class="dropdown__box box box--shadow" data-dropdown-block data-scrollbar>
                                <ul class="dropdown__list">
                                    <li class="dropdown__item">
                                        По уровню консультанта
                                    </li>

                                    <li class="dropdown__item">
                                        По дате регистрации
                                    </li>

                                    <li class="dropdown__item">
                                        По количеству личных заказов со статусом “Оплачен”
                                    </li>

                                    <li class="dropdown__item">
                                        По количеству личных заказов со статусом  “Возврат”
                                    </li>

                                    <li class="dropdown__item">
                                        По количеству личных заказов со статусом  “Возврат”
                                    </li>

                                    <li class="dropdown__item">
                                        По дате регистрации
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <h3 style="margin-top: 50px;">Дропдаун средний</h3>

                        <div class="dropdown dropdown--medium" data-dropdown>
                            <button type="button" class="button button--square button--covered button--green" data-dropdown-button>Залитая зеленая</button>

                            <div class="dropdown__box box box--shadow" data-dropdown-block data-scrollbar style="top: 50px;">
                                <ul class="dropdown__list">
                                    <li class="dropdown__item">
                                        По уровню консультанта
                                    </li>

                                    <li class="dropdown__item">
                                        По дате регистрации
                                    </li>

                                    <li class="dropdown__item">
                                        По количеству личных заказов со статусом “Оплачен”
                                    </li>

                                    <li class="dropdown__item">
                                        По количеству личных заказов со статусом  “Возврат”
                                    </li>

                                    <li class="dropdown__item">
                                        По количеству личных заказов со статусом  “Возврат”
                                    </li>

                                    <li class="dropdown__item">
                                        По дате регистрации
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!--/Дропдаун-->

                    <!--Обрезка текста-->
                    <div class="gui__block">
                        <h2 class="gui__title">Обрезка текста</h2>

                        <h3 style="margin-top: 50px;">Обрезка миксином</h3>

                        <div class="truncate truncate--mixin">
                            Обрезка текста миксином Обрезка текста миксином Обрезка текста миксином Обрезка текста миксином Обрезка текста миксином Обрезка текста миксином Обрезка текста миксином Обрезка текста миксиномОбрезка текста миксином Обрезка текста миксином Обрезка текста миксином Обрезка текста миксиномОбрезка текста миксином Обрезка текста миксином Обрезка текста миксином Обрезка текста миксиномОбрезка текста миксином Обрезка текста миксином Обрезка текста миксином Обрезка текста миксиномОбрезка текста миксином Обрезка текста миксином Обрезка текста миксином Обрезка текста миксиномОбрезка текста миксином Обрезка текста миксином Обрезка текста миксином Обрезка текста миксином
                        </div>

                        <h3 style="margin-top: 50px;">Обрезка плагином</h3>

                        <div class="truncate" style="max-height: 50px;" data-truncate>
                            Обрезка текста плагином Обрезка текста плагином Обрезка текста плагином Обрезка текста плагином Обрезка текста плагином Обрезка текста плагином Обрезка текста плагином Обрезка текста плагиномОбрезка текста плагином Обрезка текста плагином Обрезка текста плагином Обрезка текста плагиномОбрезка текста плагином Обрезка текста плагином Обрезка текста плагином Обрезка текста плагиномОбрезка текста плагином Обрезка текста плагином Обрезка текста плагином Обрезка текста плагиномОбрезка текста плагином Обрезка текста плагином Обрезка текста плагином Обрезка текста плагиномОбрезка текста плагином Обрезка текста плагином Обрезка текста плагином Обрезка текста плагиномОбрезка текста плагином Обрезка текста плагином Обрезка текста плагином Обрезка текста плагиномОбрезка текста плагином Обрезка текста плагином Обрезка текста плагином Обрезка текста плагиномОбрезка текста плагином Обрезка текста плагином Обрезка текста плагином Обрезка текста плагиномОбрезка текста плагином Обрезка текста плагином Обрезка текста плагином Обрезка текста плагином
                        </div>
                    </div>
                    <!--/Обрезка текста-->

                    <!--Хлебные крошки-->
                    <div class="gui__block">
                        <h2 class="gui__title">Хлебные крошки</h2>

                        <div class="breadcrumbs">
                            <ul class="breadcrumbs__list">
                                <li class="breadcrumbs__item">
                                    <a href="#" class="breadcrumbs__link">Главная</a>
                                </li>
                                <li class="breadcrumbs__item">
                                    <a href="#" class="breadcrumbs__link">Каталог</a>
                                </li>
                                <li class="breadcrumbs__item">
                                    <a href="#" class="breadcrumbs__link">Товары для собак</a>
                                </li>
                                <li class="breadcrumbs__item">
                                    <a href="#" class="breadcrumbs__link">Сухие корма для собак</a>
                                </li>
                                <li class="breadcrumbs__item breadcrumbs__item--active">
                                    <a class="breadcrumbs__link">AmeAppetite для мелких пород собак со вкусом сочного кролика</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--/Хлебные крошки-->

                    <!--Уведомление-->
                    <div class="gui__block">
                        <h2 class="gui__title">Уведомление</h2>

                        <div class="notification">
                            <div class="notification__icon">
                                <svg class="icon icon--tick-circle">
                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-tick-circle"></use>
                                </svg>
                            </div>

                            <h4 class="notification__title">
                                Заявка успешно отправлена!
                            </h4>

                            <p class="notification__text">
                                Ваша заявка на восстановление пароля отправлена. Проверьте вашу электронную почту.
                            </p>
                        </div>
                    </div>
                    <!--/Уведомление-->

                    <!--Варианты фасовки-->
                    <div class="gui__block">
                        <h2 class="gui__title">Варианты фасовки</h2>
                        <div class="packs">
                            <ul class="packs__list">
                                <li class="packs__item">
                                    <div class="pack">
                                        <div class="radio">
                                            <input type="radio" class="pack__input radio__input" name="radio111" value="r111" id="radio111" checked>
                                            <label for="radio111">
                                                <div class="pack__item">600 г</div>
                                            </label>
                                        </div>
                                    </div>
                                </li>

                                <li class="packs__item">
                                    <div class="pack">
                                        <div class="radio">
                                            <input type="radio" class="pack__input radio__input" name="radio111" value="r222" id="radio222">
                                            <label for="radio222">
                                                <div class="pack__item">1 кг</div>
                                            </label>
                                        </div>
                                    </div>
                                </li>

                                <li class="packs__item">
                                    <div class="pack">
                                        <div class="radio">
                                            <input type="radio" class="pack__input radio__input" name="radio111" value="r333" id="radio333">
                                            <label for="radio333">
                                                <div class="pack__item">3 кг</div>
                                            </label>
                                        </div>
                                    </div>
                                </li>

                                <li class="packs__item">
                                    <div class="pack">
                                        <div class="radio">
                                            <input type="radio" class="pack__input radio__input" name="radio111" value="r444" id="radio444">
                                            <label for="radio444">
                                                <div class="pack__item">5 кг</div>
                                            </label>
                                        </div>
                                    </div>
                                </li>

                                <li class="packs__item">
                                    <div class="pack">
                                        <div class="radio">
                                            <input type="radio" class="pack__input radio__input" name="radio111" value="r555" id="radio555">
                                            <label for="radio555">
                                                <div class="pack__item">7 кг</div>
                                            </label>
                                        </div>
                                    </div>
                                </li>

                                <li class="packs__item">
                                    <div class="pack">
                                        <div class="radio">
                                            <input type="radio" class="pack__input radio__input" name="radio111" value="r666" id="radio666">
                                            <label for="radio666">
                                                <div class="pack__item">10 кг</div>
                                            </label>
                                        </div>
                                    </div>
                                </li>

                                <li class="packs__item">
                                    <div class="pack">
                                        <div class="radio">
                                            <input type="radio" class="pack__input radio__input" name="radio111" value="r777" id="radio777">
                                            <label for="radio777">
                                                <div class="pack__item">15 кг</div>
                                            </label>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--/Варианты фасовки-->

                    <!--Варианты цветов-->
                    <div class="gui__block">
                        <h2 class="gui__title">Варианты цветов</h2>
                        <div class="colors">
                            <ul class="colors__list">
                                <li class="colors__item">
                                    <div class="color">
                                        <div class="radio">
                                            <input type="radio" class="color__input radio__input" name="radio" value="r11" id="radio11" checked>
                                            <label for="radio11">
                                                <div class="color__item color__item--pink"></div>
                                            </label>
                                        </div>
                                    </div>
                                </li>

                                <li class="colors__item">
                                    <div class="color">
                                        <div class="radio">
                                            <input type="radio" class="color__input radio__input" name="radio" value="r22" id="radio22">
                                            <label for="radio22">
                                                <div class="color__item color__item--blue"></div>
                                            </label>
                                        </div>
                                    </div>
                                </li>

                                <li class="colors__item">
                                    <div class="color">
                                        <div class="radio">
                                            <input type="radio" class="color__input radio__input" name="radio" value="r33" id="radio33">
                                            <label for="radio33">
                                                <div class="color__item color__item--green"></div>
                                            </label>
                                        </div>
                                    </div>
                                </li>

                                <li class="colors__item">
                                    <div class="color">
                                        <div class="radio">
                                            <input type="radio" class="color__input radio__input" name="radio" value="r44" id="radio44">
                                            <label for="radio44">
                                                <div class="color__item color__item--yellow"></div>
                                            </label>
                                        </div>
                                    </div>
                                </li>

                                <li class="colors__item">
                                    <div class="color">
                                        <div class="radio">
                                            <input type="radio" class="color__input radio__input" name="radio" value="r55" id="radio55">
                                            <label for="radio55">
                                                <div class="color__item color__item--red"></div>
                                            </label>
                                        </div>
                                    </div>
                                </li>

                                <li class="colors__item">
                                    <div class="color">
                                        <div class="radio">
                                            <input type="radio" class="color__input radio__input" name="radio" value="r66" id="radio66">
                                            <label for="radio66">
                                                <div class="color__item color__item--violet"></div>
                                            </label>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--/Варианты цветов-->

                    <!--Загрузчик-->
                    <div class="gui__block">
                        <h2 class="gui__title">Загрузчик</h2>

                        <h3 style="margin-top: 50px;">Загрузчик файлов</h3>

                        <div class="dropzone" data-uploader>
                            <input type="file" name="uploadFiles[]" multiple class="dropzone__control">

                            <div class="dropzone__area" data-uploader-area='{"paramName": "uploadFiles[]", "url":"/_markup/gui.php"}'>
                                <div class="dropzone__message dz-message needsclick">
                                    <div class="dropzone__message-caption needsclick">
                                        <h6 class="dropzone__message-title">Ограничения:</h6>
                                        <ul class="dropzone__message-list">
                                            <li class="dropzone__message-item">до 10 файлов</li>
                                            <li class="dropzone__message-item">вес каждого файла не более 5 МБ</li>
                                            <li class="dropzone__message-item">форматы файлов: PDF, JPG, JPEG, PNG, HEIC</li>
                                        </ul>
                                    </div>

                                    <button type="button" class="dropzone__button button button--medium button--rounded button--covered button--red">
                                        <span class="button__icon">
                                            <svg class="icon icon--import">
                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-import"></use>
                                            </svg>
                                        </span>
                                        <span class="button__text">Загрузить файл</span>
                                    </button>
                                </div>

                                <div class="dropzone__previews dz-previews" data-uploader-previews>
                                </div>
                            </div>
                        </div>

                        <h3 style="margin-top: 50px;">Загрузчик фото</h3>

                        <div class="dropzone dropzone--image" data-uploader>
                            <input type="file" name="uploadFiles[]" multiple class="dropzone__control">

                            <div class="dropzone__area" data-uploader-area='{"paramName": "uploadFiles[]", "url":"/_markup/gui.php", "images": true, "single": true}'>
                                <div class="dropzone__message dz-message needsclick">
                                    <div class="dropzone__message-button dz-button link needsclick" data-uploader-previews>
                                        <svg class="dropzone__message-button-icon icon icon--camera">
                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-camera"></use>
                                        </svg>
                                    </div>

                                    <div class="dropzone__message-block">
                                        <div class="dropzone__message-caption needsclick">
                                            <h6 class="dropzone__message-title">Требования к фото</h6>
                                            <ul class="dropzone__message-list">
                                                <li class="dropzone__message-item">формат jpg, jpeg, png, heic</li>
                                                <li class="dropzone__message-item">размер 240 Х 320 px</li>
                                                <li class="dropzone__message-item">вес не более 1МБ</li>
                                            </ul>
                                        </div>

                                        <button type="button" class="dropzone__button button button--medium button--rounded button--covered button--red">
                                            <span class="button__icon">
                                                <svg class="icon icon--import">
                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-import"></use>
                                                </svg>
                                            </span>
                                            <span class="button__text">Загрузить фото</span>
                                        </button>
                                    </div>
                                </div>

                                <div class="dropzone__previews dz-previews" data-uploader-previews>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/Загрузчик-->

                    <!--Аккордеон-->
                    <div class="gui__block">
                        <h2 class="gui__title">Аккордеон</h2>

                        <h3 style="margin-top: 50px;">Серый</h3>

                        <div class="accordeon">
                            <div class="accordeon__item box box--rounded-sm box--hovering" data-accordeon>
                                <div class="accordeon__header" data-accordeon-toggle>
                                    <h5 class="accordeon__title">1. Обязательно ли регистрироваться на сайте, чтобы заказать продукцию AmeAppetite?</h5>

                                    <button type="button" class="accordeon__toggle button button--circular button--mini button--covered button--red-white" >
                                        <span class="accordeon__toggle-icon button__icon">
                                            <svg class="icon icon--arrow-down">
                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-down"></use>
                                            </svg>
                                        </span>
                                    </button>

                                </div>

                                <div class="accordeon__body accordeon__body--bordered" data-accordeon-content>
                                    Вы можете приобрести нашу продукцию через наших партнеров - консультантов AmeAppetite в авторизованных дистрибьютерских центрах, либо зарегистрировавшись на нашем сайте. Дополнительно после регистрации Вы получите скидку на весь ассортимент товаров, а также доступ к специальным предложениям. Зарегистрируйтесь сейчас и экономьте на каждой покупке!
                                </div>
                            </div>

                            <div class="accordeon__item box box--rounded-sm box--hovering" data-accordeon>
                                <div class="accordeon__header" data-accordeon-toggle>
                                    <h5 class="accordeon__title">2. Взимается ли плата за регистрацию?</h5>

                                    <button type="button" class="accordeon__toggle button button--circular button--mini button--covered button--red-white">
                                        <span class="accordeon__toggle-icon button__icon">
                                            <svg class="icon icon--arrow-down">
                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-down"></use>
                                            </svg>
                                        </span>
                                    </button>
                                </div>

                                <div class="accordeon__body accordeon__body--bordered" data-accordeon-content>
                                    Вы можете приобрести нашу продукцию через наших партнеров - консультантов AmeAppetite в авторизованных дистрибьютерских центрах, либо зарегистрировавшись на нашем сайте. Дополнительно после регистрации Вы получите скидку на весь ассортимент товаров, а также доступ к специальным предложениям. Зарегистрируйтесь сейчас и экономьте на каждой покупке!
                                </div>
                            </div>

                            <div class="accordeon__item box box--rounded-sm box--hovering" data-accordeon>
                                <div class="accordeon__header" data-accordeon-toggle>
                                    <h5 class="accordeon__title">3. Что такое логин?</h5>

                                    <button type="button" class="accordeon__toggle button button--circular button--mini button--covered button--red-white">
                                        <span class="accordeon__toggle-icon button__icon">
                                            <svg class="icon icon--arrow-down">
                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-down"></use>
                                            </svg>
                                        </span>
                                    </button>
                                </div>

                                <div class="accordeon__body accordeon__body--bordered" data-accordeon-content>
                                    Вы можете приобрести нашу продукцию через наших партнеров - консультантов AmeAppetite в авторизованных дистрибьютерских центрах, либо зарегистрировавшись на нашем сайте. Дополнительно после регистрации Вы получите скидку на весь ассортимент товаров, а также доступ к специальным предложениям. Зарегистрируйтесь сейчас и экономьте на каждой покупке!
                                </div>
                            </div>
                        </div>

                        <h3 style="margin-top: 50px;">Простой</h3>

                        <div class="accordeon accordeon--simple">
                            <div class="accordeon__item box box--rounded-sm" data-accordeon>
                                <div class="accordeon__header" data-accordeon-toggle>
                                    <h6 class="accordeon__title">Состав заказа</h6>

                                    <button type="button" class="accordeon__toggle button button--circular button--mini button--covered button--red-white">
                                        <span class="accordeon__toggle-icon button__icon">
                                            <svg class="icon icon--arrow-down">
                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-down"></use>
                                            </svg>
                                        </span>
                                    </button>

                                </div>

                                <div class="accordeon__body" data-accordeon-content>
                                    Вы можете приобрести нашу продукцию через наших партнеров - консультантов AmeAppetite в авторизованных дистрибьютерских центрах, либо зарегистрировавшись на нашем сайте. Дополнительно после регистрации Вы получите скидку на весь ассортимент товаров, а также доступ к специальным предложениям. Зарегистрируйтесь сейчас и экономьте на каждой покупке!
                                </div>
                            </div>

                            <div class="accordeon__item box box--rounded-sm" data-accordeon>
                                <div class="accordeon__header" data-accordeon-toggle>
                                    <h6 class="accordeon__title">Состав заказа</h6>

                                    <button type="button" class="accordeon__toggle button button--circular button--mini button--covered button--red-white">
                                        <span class="accordeon__toggle-icon button__icon">
                                            <svg class="icon icon--arrow-down">
                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-down"></use>
                                            </svg>
                                        </span>
                                    </button>
                                </div>

                                <div class="accordeon__body" data-accordeon-content>
                                    Вы можете приобрести нашу продукцию через наших партнеров - консультантов AmeAppetite в авторизованных дистрибьютерских центрах, либо зарегистрировавшись на нашем сайте. Дополнительно после регистрации Вы получите скидку на весь ассортимент товаров, а также доступ к специальным предложениям. Зарегистрируйтесь сейчас и экономьте на каждой покупке!
                                </div>
                            </div>

                            <div class="accordeon__item box box--rounded-sm" data-accordeon>
                                <div class="accordeon__header" data-accordeon-toggle>
                                    <h6 class="accordeon__title">Состав заказа</h6>

                                    <button type="button" class="accordeon__toggle button button--circular button--mini button--covered button--red-white">
                                        <span class="accordeon__toggle-icon button__icon">
                                            <svg class="icon icon--arrow-down">
                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-down"></use>
                                            </svg>
                                        </span>
                                    </button>
                                </div>

                                <div class="accordeon__body" data-accordeon-content>
                                    Вы можете приобрести нашу продукцию через наших партнеров - консультантов AmeAppetite в авторизованных дистрибьютерских центрах, либо зарегистрировавшись на нашем сайте. Дополнительно после регистрации Вы получите скидку на весь ассортимент товаров, а также доступ к специальным предложениям. Зарегистрируйтесь сейчас и экономьте на каждой покупке!
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/Аккордеон-->

                    <!--Модальные окна-->
                    <div class="gui__block">
                        <h2 class="gui__title">Модальные окна</h2>

                        <ul class="buttons__list">
                            <li class="buttons__item">
                                <button type="button" 
                                        class="button button--square button--covered button--green"
                                        data-fancybox data-modal-type="modal"
                                        data-src="#technical-support"
                                    >
                                    Техническая поддержка
                                </button>
                            </li>

                            <li class="buttons__item">
                                <button type="button" 
                                        class="button button--square button--covered button--green"
                                        data-fancybox data-modal-type="modal"
                                        data-src="#approve-number"
                                    >
                                    Подтверждение номера
                                </button>
                            </li>

                            <li class="buttons__item">
                                <button type="button" 
                                        class="button button--square button--covered button--green"
                                        data-fancybox data-modal-type="modal"
                                        data-src="#conditions"
                                    >
                                    Условия поддержания уровня
                                </button>
                            </li>

                            <li class="buttons__item">
                                <button type="button" 
                                        class="button button--square button--covered button--green"
                                        data-fancybox data-modal-type="modal"
                                        data-src="#congratulate"
                                    >
                                    Поздравляем!
                                </button>
                            </li>

                            <li class="buttons__item">
                                <button type="button" 
                                        class="button button--square button--covered button--green"
                                        data-fancybox data-modal-type="modal"
                                        data-src="#thanks"
                                    >
                                    Спасибо за обращение
                                </button>
                            </li>
                        </ul>

                        <article id="technical-support" class="modal modal--limited modal--wide modal--scrolled box box--circle box--hanging" style="display: none" data-support>
                            <div class="modal__content">
                                <header class="modal__section modal__section--header">
                                    <p class="heading heading--average">Техническая поддержка</p>
                                </header>

                                <section class="modal__section modal__section--content" data-scrollbar>
                                    <form action="" class="form">
                                        <div class="form__row form__row--separated">
                                            <div class="form__col">
                                                <div class="form__field">
                                                    <div class="form__field-block form__field-block--label">
                                                        <label for="select1m" class="form__label form__label--required">
                                                            <span class="form__label-text">Тип обращения</span>
                                                        </label>
                                                    </div>
    
                                                    <div class="form__field-block form__field-block--input">
                                                        <div class="form__control">
                                                            <div class="select select--mitigate" data-select>
                                                                <select class="select__control" name="select1m" id="select1m" data-select-control data-placeholder="Выберите город" data-option>
                                                                    <option><!-- пустой option для placeholder --></option>
                                                                    <option value="1" data-variant="refund">Возврат заказа</option>
                                                                    <option value="2" data-variant="nonfunctional">Неработающая функциональность</option>
                                                                    <option value="3" data-variant="change">Смена наставника/контактного лица</option>
                                                                    <option value="4" data-variant="personal">Смена персональных данных</option>
                                                                    <option value="5" data-variant="other" selected>Другое</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!--Возврат заказа-->
                                        <div class="modal__section-variant" data-variant-block="refund">
                                            <div class="form__row form__row--gaped">
                                                <div class="form__col">
                                                    <div class="form__field">
                                                        <div class="form__field-block form__field-block--label">
                                                            <label for="Email2" class="form__label">
                                                                <span class="form__label-text">Email</span>
                                                            </label>
                                                        </div>
        
                                                        <div class="form__field-block form__field-block--input">
                                                            <div class="input input--simple">
                                                                <input type="text" class="input__control" name="Email" id="Email2" value="Pushkin@ya.ru" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
    
                                            <div class="form__row form__row--closer">
                                                <div class="form__col">
                                                    <div class="form__field">
                                                        <div class="form__field-block form__field-block--label">
                                                            <label for="text-required7" class="form__label form__label--required">
                                                                <span class="form__label-text">Номер заказа</span>
                                                            </label>
                                                        </div>
                
                                                        <div class="form__field-block form__field-block--input">
                                                            <div class="input">
                                                                <input type="text" class="input__control" name="text-required" id="text-required7" placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
    
                                            <div class="form__row">
                                                <div class="form__col">
                                                    <div class="form__field">
                                                        <div class="form__field-block form__field-block--label">
                                                            <label for="text" class="form__label">
                                                                <span class="form__label-text">Комментарий</span>
                                                            </label>
                                                        </div>
                                                        <div class="form__field-block form__field-block--input">
                                                            <label class="input input--textarea">
                                                                <textarea type="text" class="input__control" name="textarea" id="textarea3" placeholder="Не более 1000 символов" maxlength="1000" data-textarea-input=""></textarea>
                                                                <div class="input__counter">
                                                                    <span class="input__counter-current" data-textarea-current="">0</span>
                                                                        /
                                                                    <span class="input__counter-total" data-textarea-total="">1000</span>
                                                                </div>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/Возврат заказа-->

                                        <!--Неработающая функциональность-->
                                        <div class="modal__section-variant" data-variant-block="nonfunctional">

                                            <div class="form__row form__row--gaped">
                                                <div class="form__col">
                                                    <div class="form__field">
                                                        <div class="form__field-block form__field-block--label">
                                                            <label for="Email1" class="form__label">
                                                                <span class="form__label-text">Email</span>
                                                            </label>
                                                        </div>
        
                                                        <div class="form__field-block form__field-block--input">
                                                            <div class="input input--simple">
                                                                <input type="text" class="input__control" name="Email" id="Email1" value="Pushkin@ya.ru" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form__row form__row--closer">
                                                <div class="form__col">
                                                    <div class="form__field">
                                                        <div class="form__field-block form__field-block--label">
                                                            <label for="text" class="form__label">
                                                                <span class="form__label-text">Комментарий</span>
                                                            </label>
                                                        </div>
                                                        <div class="form__field-block form__field-block--input">
                                                            <label class="input input--textarea">
                                                                <textarea type="text" class="input__control" name="textarea" id="textarea2" placeholder="Не более 1000 символов" maxlength="1000" data-textarea-input=""></textarea>
                                                                <div class="input__counter">
                                                                    <span class="input__counter-current" data-textarea-current="">0</span>
                                                                        /
                                                                    <span class="input__counter-total" data-textarea-total="">1000</span>
                                                                </div>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/Неработающая функциональность-->

                                        <!--Смена наставника/контактного лица-->
                                        <div class="modal__section-variant" data-variant-block="change">
                                            <div class="form__row form__row--gaped">
                                                <div class="form__col">
                                                    <div class="form__field">
                                                        <div class="form__field-block form__field-block--label">
                                                            <label for="Email3" class="form__label">
                                                                <span class="form__label-text">Email</span>
                                                            </label>
                                                        </div>
        
                                                        <div class="form__field-block form__field-block--input">
                                                            <div class="input input--simple">
                                                                <input type="text" class="input__control" name="Email" id="Email3" value="Pushkin@ya.ru" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
    
                                            <div class="form__row form__row--closer">
                                                <div class="form__col">
                                                    <div class="form__field">
                                                        <div class="form__field-block form__field-block--label">
                                                            <label for="ID" class="form__label">
                                                                <span class="form__label-text">ID текущего наставника</span>
                                                            </label>
                                                        </div>
        
                                                        <div class="form__field-block form__field-block--input">
                                                            <div class="input input--simple">
                                                                <input type="text" class="input__control" name="ID" id="ID" value="323213" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
    
                                            <div class="form__row">
                                                <div class="form__col">
                                                    <div class="form__field">
                                                        <div class="form__field-block form__field-block--label">
                                                            <label for="text-required9" class="form__label form__label--required">
                                                                <span class="form__label-text">ID нового наставника</span>
                                                            </label>
                                                        </div>
                
                                                        <div class="form__field-block form__field-block--input">
                                                            <div class="input">
                                                                <input type="number" class="input__control" name="text-required" id="text-required9" placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
    
                                            <div class="form__row">
                                                <div class="form__col">
                                                    <div class="form__field">
                                                        <div class="form__field-block form__field-block--label">
                                                            <label for="select4m" class="form__label form__label--required">
                                                                <span class="form__label-text">Причина</span>
                                                            </label>
                                                        </div>
        
                                                        <div class="form__field-block form__field-block--input">
                                                            <div class="form__control">
                                                                <div class="select select--mitigate" data-select>
                                                                    <select class="select__control" name="select4m" id="select4m" data-select-control data-placeholder="Выберите город">
                                                                        <option><!-- пустой option для placeholder --></option>
                                                                        <option value="1">Возврат заказа</option>
                                                                        <option value="2">Неработающая функциональность</option>
                                                                        <option value="3">Смена наставника/контактного лица</option>
                                                                        <option value="4">Смена персональных данных</option>
                                                                        <option value="5">Другое</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
    
                                            <div class="form__row">
                                                <div class="form__col">
                                                    <div class="form__field">
                                                        <div class="form__field-block form__field-block--label">
                                                            <label for="text" class="form__label">
                                                                <span class="form__label-text">Комментарий</span>
                                                            </label>
                                                        </div>
                                                        <div class="form__field-block form__field-block--input">
                                                            <label class="input input--textarea">
                                                                <textarea type="text" class="input__control" name="textarea" id="textarea4" placeholder="Не более 1000 символов" maxlength="1000" data-textarea-input=""></textarea>
                                                                <div class="input__counter">
                                                                    <span class="input__counter-current" data-textarea-current="">0</span>
                                                                        /
                                                                    <span class="input__counter-total" data-textarea-total="">1000</span>
                                                                </div>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/Смена наставника/контактного лица-->

                                        <!--Смена персональных данных-->
                                        <div class="modal__section-variant" data-variant-block="personal">
                                            <div class="form__row form__row--gaped">
                                                <div class="form__col">
                                                    <div class="form__field">
                                                        <div class="form__field-block form__field-block--label">
                                                            <label for="Email4" class="form__label">
                                                                <span class="form__label-text">Email</span>
                                                            </label>
                                                        </div>
        
                                                        <div class="form__field-block form__field-block--input">
                                                            <div class="input input--simple">
                                                                <input type="text" class="input__control" name="Email" id="Email4" value="Pushkin@ya.ru" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
    
                                            <div class="form__row form__row--closer">
                                                <div class="form__col">
                                                    <div class="form__field">
                                                        <div class="form__field-block form__field-block--label">
                                                            <label for="text-required10" class="form__label">
                                                                <span class="form__label-text">Актуальная фамилия</span>
                                                            </label>
                                                        </div>
                
                                                        <div class="form__field-block form__field-block--input">
                                                            <div class="input">
                                                                <input type="number" class="input__control" name="text-required" id="text-required10" placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
    
                                            <div class="form__row">
                                                <div class="form__col">
                                                    <div class="form__field">
                                                        <div class="form__field-block form__field-block--label">
                                                            <label for="text-required11" class="form__label">
                                                                <span class="form__label-text">Актуальное имя</span>
                                                            </label>
                                                        </div>
    
                                                        <div class="form__field-block form__field-block--input">
                                                            <div class="input">
                                                                <input type="number" class="input__control" name="text-required" id="text-required11" placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
    
                                            <div class="form__row">
                                                <div class="form__col">
                                                    <div class="form__field">
                                                        <div class="form__field-block form__field-block--label">
                                                            <label for="text-required" class="form__label">
                                                                <span class="form__label-text">Актуальное отчество</span>
                                                            </label>
                                                        </div>
    
                                                        <div class="form__field-block form__field-block--input">
                                                            <div class="input">
                                                                <input type="number" class="input__control" name="text-required" id="text-required" placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
    
                                            <div class="form__row">
                                                <div class="form__col">
                                                    <div class="form__field">
                                                        <div class="form__field-block form__field-block--label">
                                                            <label for="text" class="form__label">
                                                                <span class="form__label-text">Дата рождения</span>
                                                            </label>
                                                        </div>
                                                        <div class="form__field-block form__field-block--input">
                                                            <div class="input input--iconed">
                                                                <input inputmode="numeric"
                                                                    class="input__control"
                                                                    name="birthdate"
                                                                    id="birthdate2"
                                                                    placeholder="ДД.ММ.ГГГГ"
                                                                    data-mask-date 
                                                                    data-inputmask-alias="datetime"
                                                                    data-inputmask-inputformat="dd.mm.yyyy"
                                                                    data-pets-date-input
                                                                    data-pets-change
                                                                    value="09.11.2011"
                                                                >
                                                                <span class="input__icon">
                                                                    <svg class="icon icon--calendar">
                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-calendar"></use>
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
    
                                            <div class="form__row">
                                                <div class="form__col">
                                                    <div class="dropzone" data-uploader>
                                                        <input type="file" name="uploadFiles[]" multiple class="dropzone__control">
    
                                                        <div class="dropzone__area" data-uploader-area='{"paramName": "uploadFiles[]", "url":"/_markup/gui.php"}'>
                                                            <div class="dropzone__message dz-message needsclick">
                                                                <div class="dropzone__message-caption needsclick">
                                                                    <h6 class="dropzone__message-title">Ограничения:</h6>
                                                                    <ul class="dropzone__message-list">
                                                                        <li class="dropzone__message-item">до 10 файлов</li>
                                                                        <li class="dropzone__message-item">вес каждого файла не более 5 МБ</li>
                                                                        <li class="dropzone__message-item">форматы файлов: PDF, JPG, JPEG, PNG, HEIC</li>
                                                                    </ul>
                                                                </div>
    
                                                                <button type="button" class="dropzone__button dropzone__button--wide button button--medium button--rounded button--outlined button--green">
                                                                    <span class="button__icon">
                                                                        <svg class="icon icon--import">
                                                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-import"></use>
                                                                        </svg>
                                                                    </span>
                                                                    <span class="button__text button__text--required">Загрузить файл</span>
                                                                </button>
                                                            </div>
                            
                                                            <div class="dropzone__previews dz-previews" data-uploader-previews>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
    
                                            <div class="form__row">
                                                <div class="form__col">
                                                    <div class="form__field">
                                                        <div class="form__field-block form__field-block--label">
                                                            <label for="text" class="form__label">
                                                                <span class="form__label-text">Комментарий</span>
                                                            </label>
                                                        </div>
                                                        <div class="form__field-block form__field-block--input">
                                                            <label class="input input--textarea">
                                                                <textarea type="text" class="input__control" name="textarea" id="textarea5" placeholder="Не более 1000 символов" maxlength="1000" data-textarea-input=""></textarea>
                                                                <div class="input__counter">
                                                                    <span class="input__counter-current" data-textarea-current="">0</span>
                                                                        /
                                                                    <span class="input__counter-total" data-textarea-total="">1000</span>
                                                                </div>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/Смена персональных данных-->

                                        <!--Другое-->
                                        <div class="modal__section-variant modal__section-variant--active" data-variant-block="other">
                                            <div class="form__row form__row--gaped">
                                                <div class="form__col">
                                                    <div class="form__field">
                                                        <div class="form__field-block form__field-block--label">
                                                            <label for="Email1" class="form__label">
                                                                <span class="form__label-text">Email</span>
                                                            </label>
                                                        </div>
        
                                                        <div class="form__field-block form__field-block--input">
                                                            <div class="input input--simple">
                                                                <input type="text" class="input__control" name="Email" id="Email1" value="Pushkin@ya.ru" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form__row form__row--closer">
                                                <div class="form__col">
                                                    <div class="form__field">
                                                        <div class="form__field-block form__field-block--label">
                                                            <label for="text" class="form__label">
                                                                <span class="form__label-text">Комментарий</span>
                                                            </label>
                                                        </div>
                                                        <div class="form__field-block form__field-block--input">
                                                            <label class="input input--textarea">
                                                                <textarea type="text" class="input__control" name="textarea" id="textarea2" placeholder="Не более 1000 символов" maxlength="1000" data-textarea-input=""></textarea>
                                                                <div class="input__counter">
                                                                    <span class="input__counter-current" data-textarea-current="">0</span>
                                                                        /
                                                                    <span class="input__counter-total" data-textarea-total="">1000</span>
                                                                </div>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/Другое-->

                                        <div class="modal__section-actions">
                                            <button type="button" class="form__footer-button button button--rounded button--covered button--red button--full">Отправить</button>
                                        </div>
                                    </form>
                                </section>
                            </div>
                        </article>

                        <!--Подтверждение номера-->
                        <article id="approve-number" class="modal modal--small modal--centered box box--circle box--hanging" style="display: none">
                            <div class="modal__content">
                                <header class="modal__section modal__section--header">
                                    <p class="heading heading--small">Подтверждение номера</p>
                                </header>

                                <section class="modal__section modal__section--content">
                                    <p class="modal__section-text">
                                        На указанный номер телефона отправлен код подтверждения. Пожалуйста, введите его в окно ниже
                                    </p>

                                    <div class="form__row">
                                        <div class="form__col">
                                            <div class="form__field">
                                                <div class="form__field-block form__field-block--input">
                                                    <div class="input input--tiny input--centered">
                                                        <input type="text" class="input__control" name="tel" id="tel" value="3233">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <p class="modal__section-notice">
                                        Телефон подтвержден
                                    </p>
                                </section>
                            </div>
                        </article>
                        <!--/Подтверждение номера-->

                        <!--Условия поддержания уровня-->
                        <article id="conditions" class="modal modal--full box box--circle box--hanging" style="display: none">
                            <div class="modal__content">
                                <header class="modal__section modal__section--header">
                                    <p class="heading heading--average">Условия поддержания уровня</p>
                                </header>

                                <section class="modal__section modal__section--content">
                                    <div class="conditions">
                                        <div class="conditions__block">
                                            <h5 class="conditions__title">Условия поддержания уровня для К1:</h5>

                                            <ul class="conditions__list">
                                                <li class="conditions__item">
                                                    Совершение личных покупок на общую сумму 5000 рублей за период в 3 последовательных месяца (квартал);
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="conditions__block">
                                            <h5 class="conditions__title">Условия поддержания уровня для К2 (единовременное соблюдение всех условий):</h5>

                                            <ul class="conditions__list">
                                                <li class="conditions__item">
                                                    Совершение личных покупок на сумму 5000 рублей каждый месяц за период в 3 последовательных месяца (квартал);
                                                </li>

                                                <li class="conditions__item">
                                                    Совершение групповых покупок на сумму 7000 рублей каждый месяц за период в 3 последовательных месяца (квартал);
                                                </li>
                                            </ul>

                                            <p class="conditions__text">Переход на уровень К2 возможен в течение 3 последовательных месяцев при соблюдении условий перехода на уровень К2;
                                            </p>
                                            <p class="conditions__text">При несоблюдении условий поддержания уровня К2 будет выполняться переход на уровень К1.</p>
                                        </div>

                                        <div class="conditions__block">
                                            <h5 class="conditions__title">Условия поддержания уровня для К3 (единовременное соблюдение всех условий):</h5>

                                            <ul class="conditions__list">
                                                <li class="conditions__item">
                                                    Совершение личных покупок на сумму 10000 рублей каждый месяц за период в 3 последовательных месяца (квартал);
                                                </li>

                                                <li class="conditions__item">
                                                    Совершение групповых покупок на сумму 20000 рублей каждый месяц за период в 3 последовательных месяца (квартал);
                                                </li>
                                            </ul>

                                            <p class="conditions__text">Переход на уровень К3 возможен в течение 6 последовательных месяцев при соблюдении условий перехода на уровень К3;

                                            </p>
                                            <p class="conditions__text">При несоблюдении условий поддержания уровня К3 будет выполняться переход на уровень К2.</p>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </article>
                        <!--/Условия поддержания уровня-->

                        <!--Поздравляем-->
                        <article id="congratulate" class="modal modal--wide modal--centered box box--circle box--hanging" style="display: none">
                            <div class="modal__content">
                                <section class="modal__section modal__section--content">
                                    <div class="notification notification--simple">
                                        <div class="notification__icon">
                                            <svg class="icon icon--cat-cheerful">
                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-cat-cheerful"></use>
                                            </svg>
                                        </div>

                                        <h4 class="notification__title">Поздравляем!</h4>
                                        <p class="notification__text">Вы перевыполнили план по удержанию уровня!</p>
                                    </div>
                                </section>
                            </div>
                        </article>
                        <!--/Поздравляем-->

                        <!--Спасибо за обращение-->
                        <article id="thanks" class="modal modal--wide modal--centered box box--circle box--hanging" style="display: none">
                            <div class="modal__content">
                                <section class="modal__section modal__section--content">
                                    <div class="notification notification--simple">
                                        <div class="notification__icon">
                                            <svg class="icon icon--cat-serious">
                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-cat-serious"></use>
                                            </svg>
                                        </div>

                                        <h4 class="notification__title">Спасибо за обращение</h4>
                                        <p class="notification__text">Мы проверим обновленные данные и уведомим Вас о результате внесения изменений. </p>
                                    </div>
                                </section>
                            </div>
                        </article>
                        <!--/Спасибо за обращение-->


                    </div>
                    <!--/Модальные окна-->

                    <!--Шаги-->
                    <div class="gui__block">
                        <h2 class="gui__title">Шаги</h2>

                        <ul class="steps-counter">
                            <li class="steps-counter__item steps-counter__item--passed" data-steps-item>
                                <div class="steps-counter__circle steps-counter__circle--passed" data-steps-indicator>
                                    <span class="steps-counter__circle-text">Персональные данные</span>
                                </div>
                            </li>

                            <li class="steps-counter__item steps-counter__item--current" data-steps-item>
                                <div class="steps-counter__circle steps-counter__circle--current" data-steps-indicator>
                                    <span class="steps-counter__circle-text">Данные о питомцах</span>
                                </div>
                            </li>

                            <li class="steps-counter__item" data-steps-item>
                                <div class="steps-counter__circle" data-steps-indicator>
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

                        <ul class="buttons__list gui__example">
                            <li class="buttons__item">
                                <button type="button" class="button button--square button--covered button--red" data-button-prev>Назад</button>
                            </li>

                            <li class="buttons__item">
                                <button type="button" class="button button--square button--covered button--green" data-button-next>Далее</button>
                            </li>
                        </ul>

                    </div>
                    <!--/Шаги-->

                    <!--Данные о питомцах-->
                    <div class="gui__block">
                        <h2 class="gui__title">Данные о питомцах</h2>

                        <div class="box box--gray box--rounded">
                            <h4 class="box__heading heading heading--average">
                                Данные о питомцах
                            </h4>

                            <div class="pet-cards">
                                <ul class="pet-cards__list" data-pets-list>
                                    <li class="pet-cards__item">
                                        <!--Карточка питомца-->
                                        <article class="pet-card" data-pets-card>
                                            <div class="pet-card__main box box--circle" data-pets-main>
                                                <div class="pet-card__content">
                                                    <div class="pet-card__avatar" data-pets-type>
                                                        <svg class="icon icon--dog">
                                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-dog"></use>
                                                        </svg>
                                                    </div>

                                                    <div class="pet-card__info">
                                                        <div class="pet-card__name" data-pets-name>
                                                            Мухтар Бесстрашный
                                                        </div>

                                                        <div class="pet-card__breed" data-pets-breed>
                                                            Лабрадор
                                                        </div>

                                                        <div class="pet-card__info-record">
                                                            <div class="pet-card__gender" data-pets-gender>
                                                                <svg class="icon icon--man">
                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-man"></use>
                                                                </svg>
                                                            </div>

                                                            <div class="pet-card__date" data-pets-date>
                                                                09.10.2017
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="pet-card__actions">
                                                    <div class="pet-card__modify">
                                                        <button type="button" class="pet-card__actions-button button button--iconed button--simple button--red" data-tippy-content="Редактировать" data-pets-modify>
                                                            <span class="button__icon">
                                                                <svg class="icon icon--edit">
                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-edit"></use>
                                                                </svg>
                                                            </span>
                                                        </button>
                                                    </div>

                                                    <div class="pet-card__delete">
                                                        <button type="button" class="pet-card__actions-button button button--iconed button--simple button--red" data-tippy-content="Удалить" data-pets-delete>
                                                            <span class="button__icon">
                                                                <svg class="icon icon--basket">
                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-basket"></use>
                                                                </svg>
                                                            </span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="pet-card__edit box box--rounded-sm" data-pets-edit>
                                                <form class="form" action="" method="post" data-pets-form data-validation="add-pets">
                                                    <div class="pet-card__row form__row">
                                                        <div class="pet-card__col pet-card__col--1-3 pet-card__col--3 form__col">
                                                            <div class="form__field">
                                                                <div class="form__field-block form__field-block--label">
                                                                    <label for="pet-card-select1" class="form__label">
                                                                        <span class="form__label-text">Тип питомца</span>
                                                                    </label>
                                                                </div>
                        
                                                                <div class="form__field-block form__field-block--input">
                                                                    <div class="form__control">
                                                                        <div class="select select--mitigate select--iconed" data-select>
                                                                            <select class="select__control" name="type" id="pet-card-select1" data-select-control data-placeholder="Выбрать" data-pets-type-input data-pets-change>
                                                                                <option><!-- пустой option для placeholder --></option>
                                                                                <option value="1" data-option-icon="cat">Кошка</option>
                                                                                <option value="2" data-option-icon="dog" selected>Собака</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="pet-card__col pet-card__col--1-3 form__col">
                                                            <div class="form__field">
                                                                <div class="form__field-block form__field-block--label">
                                                                    <label for="pet-card-select11" class="form__label">
                                                                        <span class="form__label-text">Пол</span>
                                                                    </label>
                                                                </div>
                        
                                                                <div class="form__field-block form__field-block--input">
                                                                    <div class="form__control">
                                                                        <div class="select select--mitigate" data-select>
                                                                            <select class="select__control" name="gender" id="pet-card-select11" data-select-control data-placeholder="Выбрать" data-pets-gender-input data-pets-change>
                                                                                <option><!-- пустой option для placeholder --></option>
                                                                                <option value="1" selected>Мальчик</option>
                                                                                <option value="2">Девочка</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="pet-card__col pet-card__col--1-3 form__col">
                                                            <div class="form__field">
                                                                <div class="form__field-block form__field-block--label">
                                                                    <label for="birthdate3" class="form__label">
                                                                        <span class="form__label-text">Дата рождения</span>
                                                                    </label>
                                                                </div>

                                                                <div class="form__field-block form__field-block--input">
                                                                    <div class="input input--iconed">
                                                                        <input inputmode="numeric"
                                                                            class="input__control"
                                                                            name="birthdate"
                                                                            id="birthdate3"
                                                                            placeholder="ДД.ММ.ГГГГ"
                                                                            data-mask-date 
                                                                            data-inputmask-alias="datetime"
                                                                            data-inputmask-inputformat="dd.mm.yyyy"
                                                                            data-pets-date-input
                                                                            data-pets-change
                                                                            value="09.10.2017"
                                                                        >
                                                                        <span class="input__icon">
                                                                            <svg class="icon icon--calendar">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-calendar"></use>
                                                                            </svg>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="pet-card__col pet-card__col--1-2 pet-card__col--1 form__col">
                                                            <div class="form__field">
                                                                <div class="form__field-block form__field-block--label">
                                                                    <label for="pet-card-select111" class="form__label">
                                                                        <span class="form__label-text">Порода</span>
                                                                    </label>
                                                                </div>
                        
                                                                <div class="form__field-block form__field-block--input">
                                                                    <div class="form__control">
                                                                        <div class="select select--mitigate" data-select>
                                                                            <select class="select__control" name="breed" id="pet-card-select111" data-select-control data-placeholder="Выбрать" data-pets-breed-input data-pets-change>
                                                                                <option><!-- пустой option для placeholder --></option>
                                                                                <option value="1" selected>Лабрадор</option>
                                                                                <option value="2">Пудель</option>
                                                                                <option value="3">Болонка</option>
                                                                                <option value="4">Мопс</option>
                                                                                <option value="5">Китайская хохлатая</option>
                                                                                <option value="6">Кавалер кинг чарльз спаниель</option>
                                                                                <option value="7">Дог</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="pet-card__col pet-card__col--1-2 pet-card__col--2 form__col">
                                                            <div class="form__field">
                                                                <div class="form__field-block form__field-block--label">
                                                                    <label for="text19" class="form__label">
                                                                        <span class="form__label-text">Кличка</span>
                                                                    </label>
                                                                </div>

                                                                <div class="form__field-block form__field-block--input">
                                                                    <div class="input">
                                                                        <input value="Мухтар Бесстрашный" type="text" class="input__control" name="nickname" id="text19" placeholder="Выбрать" data-pets-name-input data-pets-change>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="pet-card__buttons">
                                                        <button type="submit" class="pet-card__button button button--rounded button--covered button--green button--full" data-pets-save>
                                                            Сохранить изменения
                                                        </button>

                                                        <button type="button" class="pet-card__button button button--rounded button--mixed button--red button--full" data-pets-cancel>
                                                            Отменить изменения
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </article>
                                        <!--/Карточка питомца-->
                                    </li>

                                    <li class="pet-cards__item">
                                        <!--Карточка питомца-->
                                        <article class="pet-card" data-pets-card>
                                            <div class="pet-card__main box box--circle" data-pets-main>
                                                <div class="pet-card__content">
                                                    <div class="pet-card__avatar" data-pets-type>
                                                        <svg class="icon icon--cat">
                                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-cat"></use>
                                                        </svg>
                                                    </div>

                                                    <div class="pet-card__info">
                                                        <div class="pet-card__name" data-pets-name>
                                                            Мурка
                                                        </div>

                                                        <div class="pet-card__breed" data-pets-breed>
                                                            Русская голубая
                                                        </div>

                                                        <div class="pet-card__info-record">
                                                            <div class="pet-card__gender" data-pets-gender>
                                                                <svg class="icon icon--woman">
                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-woman"></use>
                                                                </svg>
                                                            </div>

                                                            <div class="pet-card__date" data-pets-date>
                                                                09.11.2011
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="pet-card__actions">
                                                    <div class="pet-card__modify">
                                                        <button type="button" class="pet-card__actions-button button button--iconed button--simple button--red" data-tippy-content="Редактировать" data-pets-modify>
                                                            <span class="button__icon">
                                                                <svg class="icon icon--edit">
                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-edit"></use>
                                                                </svg>
                                                            </span>
                                                        </button>
                                                    </div>

                                                    <div class="pet-card__delete">
                                                        <button type="button" class="pet-card__actions-button button button--iconed button--simple button--red" data-tippy-content="Удалить" data-pets-delete>
                                                            <span class="button__icon">
                                                                <svg class="icon icon--basket">
                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-basket"></use>
                                                                </svg>
                                                            </span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="pet-card__edit box box--rounded-sm" data-pets-edit>
                                                <form class="form" action="" method="post" data-validation="add-pets" data-pets-form>
                                                    <div class="pet-card__row form__row">
                                                        <div class="pet-card__col pet-card__col--1-3 pet-card__col--3 form__col">
                                                            <div class="form__field">
                                                                <div class="form__field-block form__field-block--label">
                                                                    <label for="pet-card-select2" class="form__label">
                                                                        <span class="form__label-text">Тип питомца</span>
                                                                    </label>
                                                                </div>
                        
                                                                <div class="form__field-block form__field-block--input">
                                                                    <div class="form__control">
                                                                        <div class="select select--mitigate select--iconed" data-select>
                                                                            <select class="select__control" name="type" id="pet-card-select2" data-select-control data-placeholder="Выбрать" data-pets-type-input data-pets-change>
                                                                                <option><!-- пустой option для placeholder --></option>
                                                                                <option value="1" data-option-icon="cat" selected>Кошка</option>
                                                                                <option value="2"data-pets-card data-option-icon="dog">Собака</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="pet-card__col pet-card__col--1-3 form__col">
                                                            <div class="form__field">
                                                                <div class="form__field-block form__field-block--label">
                                                                    <label for="pet-card-select22" class="form__label">
                                                                        <span class="form__label-text">Пол</span>
                                                                    </label>
                                                                </div>
                        
                                                                <div class="form__field-block form__field-block--input">
                                                                    <div class="form__control">
                                                                        <div class="select select--mitigate" data-select>
                                                                            <select class="select__control" name="gender" id="pet-card-select22" data-select-control data-placeholder="Выбрать" data-pets-gender-input data-pets-change>
                                                                                <option><!-- пустой option для placeholder --></option>
                                                                                <option value="1">Мальчик</option>
                                                                                <option value="2" selected>Девочка</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="pet-card__col pet-card__col--1-3 form__col">
                                                            <div class="form__field">
                                                                <div class="form__field-block form__field-block--label">
                                                                    <label for="birthdate4" class="form__label">
                                                                        <span class="form__label-text">Дата рождения</span>
                                                                    </label>
                                                                </div>

                                                                <div class="form__field-block form__field-block--input">
                                                                    <div class="input input--iconed">
                                                                        <input inputmode="numeric"
                                                                            class="input__control"
                                                                            name="birthdate"
                                                                            id="birthdate4"
                                                                            placeholder="ДД.ММ.ГГГГ"
                                                                            data-mask-date 
                                                                            data-inputmask-alias="datetime"
                                                                            data-inputmask-inputformat="dd.mm.yyyy"
                                                                            data-pets-date-input
                                                                            data-pets-change
                                                                            value="09.11.2011"
                                                                        >
                                                                        <span class="input__icon">
                                                                            <svg class="icon icon--calendar">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-calendar"></use>
                                                                            </svg>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="pet-card__col pet-card__col--1-2 pet-card__col--1 form__col">
                                                            <div class="form__field">
                                                                <div class="form__field-block form__field-block--label">
                                                                    <label for="pet-card-select222" class="form__label">
                                                                        <span class="form__label-text">Порода</span>
                                                                    </label>
                                                                </div>
                        
                                                                <div class="form__field-block form__field-block--input">
                                                                    <div class="form__control">
                                                                        <div class="select select--mitigate" data-select>
                                                                            <select class="select__control" name="breed" id="pet-card-select222" data-select-control data-placeholder="Выбрать" data-pets-breed-input data-pets-change>
                                                                                <option><!-- пустой option для placeholder --></option>
                                                                                <option value="1">Лабрадор</option>
                                                                                <option value="2">Пудель</option>
                                                                                <option value="3">Болонка</option>
                                                                                <option value="4">Мопс</option>
                                                                                <option value="5">Китайская хохлатая</option>
                                                                                <option value="6">Кавалер кинг чарльз спаниель</option>
                                                                                <option value="7">Дог</option>
                                                                                <option value="8" selected>Русская голубая</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="pet-card__col pet-card__col--1-2 pet-card__col--2 form__col">
                                                            <div class="form__field">
                                                                <div class="form__field-block form__field-block--label">
                                                                    <label for="text199" class="form__label">
                                                                        <span class="form__label-text">Кличка</span>
                                                                    </label>
                                                                </div>

                                                                <div class="form__field-block form__field-block--input">
                                                                    <div class="input">
                                                                        <input type="text" value="Мурка" class="input__control" name="nickname" id="text199" placeholder="Выбрать" data-pets-name-input data-pets-change>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="pet-card__buttons">
                                                        <button type="submit" class="pet-card__button button button--rounded button--covered button--green button--full" data-pets-save>
                                                            Сохранить изменения
                                                        </button>

                                                        <button type="button" class="pet-card__button button button--rounded button--mixed button--red button--full" data-pets-cancel>
                                                            Отменить изменения
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </article>
                                        <!--/Карточка питомца-->
                                    </li>
                                </ul>

                                <div class="pet-cards__adding">
                                    <button type="button" class="button button--rounded button--covered button--white-green button--full" data-pets-add>
                                        <span class="button__icon button__icon--medium">
                                            <svg class="icon icon--add-circle">
                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-add-circle"></use>
                                            </svg>
                                        </span>
                                        <span class="button__text">Добавить питомца</span>
                                    </button>
                                </div>
                                

                                <!--/Шаблон карточки для добавления на страницу-->
                                <script id="hidden-template-pet" type="text/x-custom-template">
                                    <li class="pet-cards__item">
                                        <!--Карточка питомца-->
                                        <article class="pet-card pet-card--editing" data-pets-card data-pets-new>
                                            <div class="pet-card__main box box--circle" data-pets-main>
                                                <div class="pet-card__content">
                                                    <div class="pet-card__avatar" data-pets-type>
                                                        <svg class="icon icon--dog">
                                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-dog"></use>
                                                        </svg>
                                                    </div>

                                                    <div class="pet-card__info">
                                                        <div class="pet-card__name" data-pets-name></div>

                                                        <div class="pet-card__breed" data-pets-breed></div>

                                                        <div class="pet-card__info-record">
                                                            <div class="pet-card__gender" data-pets-gender>
                                                                <svg class="icon icon--man">
                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-man"></use>
                                                                </svg>
                                                            </div>

                                                            <div class="pet-card__date" data-pets-date></div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="pet-card__actions">
                                                    <div class="pet-card__modify">
                                                        <button type="button" class="pet-card__actions-button button button--iconed button--simple button--red" data-tippy-content="Редактировать" data-pets-modify>
                                                            <span class="button__icon">
                                                                <svg class="icon icon--edit">
                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-edit"></use>
                                                                </svg>
                                                            </span>
                                                        </button>
                                                    </div>

                                                    <div class="pet-card__delete">
                                                        <button type="button" class="pet-card__actions-button button button--iconed button--simple button--red" data-tippy-content="Удалить" data-pets-delete>
                                                            <span class="button__icon">
                                                                <svg class="icon icon--basket">
                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-basket"></use>
                                                                </svg>
                                                            </span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="pet-card__edit box box--rounded-sm" data-pets-edit>
                                                <form class="form" action="" method="post" data-pets-form data-validation="add-pets">
                                                    <div class="pet-card__row form__row">
                                                        <div class="pet-card__col pet-card__col--1-3 pet-card__col--3 form__col">
                                                            <div class="form__field">
                                                                <div class="form__field-block form__field-block--label">
                                                                    <label for="type-#ID#" class="form__label">
                                                                        <span class="form__label-text">Тип питомца</span>
                                                                    </label>
                                                                </div>
                        
                                                                <div class="form__field-block form__field-block--input">
                                                                    <div class="form__control">
                                                                        <div class="select select--mitigate select--iconed" data-select>
                                                                            <select class="select__control" name="type" id="type-#ID#" data-select-control data-placeholder="Выбрать" data-pets-type-input data-pets-change>
                                                                                <option><!-- пустой option для placeholder --></option>
                                                                                <option value="1" data-option-icon="cat">Кошка</option>
                                                                                <option value="2"data-pets-card data-option-icon="dog">Собака</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="pet-card__col pet-card__col--1-3 form__col">
                                                            <div class="form__field">
                                                                <div class="form__field-block form__field-block--label">
                                                                    <label for="gender-#ID#" class="form__label">
                                                                        <span class="form__label-text">Пол</span>
                                                                    </label>
                                                                </div>
                        
                                                                <div class="form__field-block form__field-block--input">
                                                                    <div class="form__control">
                                                                        <div class="select select--mitigate" data-select>
                                                                            <select class="select__control" name="gender" id="gender-#ID#" data-select-control data-placeholder="Выбрать" data-pets-gender-input data-pets-change>
                                                                                <option><!-- пустой option для placeholder --></option>
                                                                                <option value="1">Мальчик</option>
                                                                                <option value="2">Девочка</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="pet-card__col pet-card__col--1-3 form__col">
                                                            <div class="form__field">
                                                                <div class="form__field-block form__field-block--label">
                                                                    <label for="birthdate" class="form__label">
                                                                        <span class="form__label-text">Дата рождения</span>
                                                                    </label>
                                                                </div>

                                                                <div class="form__field-block form__field-block--input">
                                                                    <div class="input input--iconed">
                                                                        <input inputmode="numeric"
                                                                            class="input__control"
                                                                            name="birthdate"
                                                                            id="birthdate"
                                                                            placeholder="ДД.ММ.ГГГГ"
                                                                            data-mask-date 
                                                                            data-inputmask-alias="datetime"
                                                                            data-inputmask-inputformat="dd.mm.yyyy"
                                                                            data-pets-date-input
                                                                            data-pets-change
                                                                        >
                                                                        <span class="input__icon">
                                                                            <svg class="icon icon--calendar">
                                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-calendar"></use>
                                                                            </svg>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="pet-card__col pet-card__col--1-2 pet-card__col--1 form__col">
                                                            <div class="form__field">
                                                                <div class="form__field-block form__field-block--label">
                                                                    <label for="breed-#ID#" class="form__label">
                                                                        <span class="form__label-text">Порода</span>
                                                                    </label>
                                                                </div>
                        
                                                                <div class="form__field-block form__field-block--input">
                                                                    <div class="form__control">
                                                                        <div class="select select--mitigate" data-select>
                                                                            <select class="select__control" name="breed" id="breed-#ID#" data-select-control data-placeholder="Выбрать" data-pets-breed-input data-pets-change>
                                                                                <option><!-- пустой option для placeholder --></option>
                                                                                <option value="1">Лабрадор</option>
                                                                                <option value="2">Пудель</option>
                                                                                <option value="3">Болонка</option>
                                                                                <option value="4">Мопс</option>
                                                                                <option value="5">Китайская хохлатая</option>
                                                                                <option value="6">Кавалер кинг чарльз спаниель</option>
                                                                                <option value="7">Дог</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="pet-card__col pet-card__col--1-2 pet-card__col--2 form__col">
                                                            <div class="form__field">
                                                                <div class="form__field-block form__field-block--label">
                                                                    <label for="text1999" class="form__label">
                                                                        <span class="form__label-text">Кличка</span>
                                                                    </label>
                                                                </div>

                                                                <div class="form__field-block form__field-block--input">
                                                                    <div class="input">
                                                                        <input type="text" class="input__control" name="nickname" id="text1999" placeholder="Выбрать" data-pets-name-input data-pets-change>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="pet-card__buttons">
                                                        <button type="submit" class="pet-card__button button button--rounded button--covered button--green button--full button--disabled" disabled data-pets-save>
                                                            Сохранить изменения
                                                        </button>

                                                        <button type="button" class="pet-card__button button button--rounded button--mixed button--red button--full" data-pets-cancel>
                                                            Отменить изменения
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </article>
                                        <!--/Карточка питомца-->
                                    </li>
                                </script>
                                <!--/Шаблон карточки для добавления на страницу-->

                            </div>

                        </div>
                    </div>
                    <!--/Данные о питомцах-->

                    <!--Карточки товара-->
                    <div class="gui__block">
                        <h2 class="gui__title">Карточки товара</h2>

                        <div class="product-cards">
                            <ul class="product-cards__list">
                                <li class="product-cards__item">
                                    <article class="product-card box box--circle box--hovering box--grayish">
                                        <a href="#" class="product-card__link"></a>
                                        <div class="product-card__header">
                                            <div class="product-card__label label label--violet">ограниченное предложение</div>

                                            <div class="product-card__favourite">
                                                <button type="button" class="product-card__favourite-button button button--ordinary button--iconed button--simple button--big button--red" data-card-favourite="heart">
                                                    <span class="button__icon button__icon--big">
                                                        <svg class="icon">
                                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-heart" data-card-favourite-icon></use>
                                                        </svg>
                                                    </span>
                                                </button>
                                            </div>

                                            <div class="product-card__wrapper">
                                                <div class="product-card__image box box--circle">
                                                    <div class="product-card__box">
                                                        <img src="/local/templates/.default/images/portage.png" alt="Название товара" class="product-card__pic">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="product-card__content">
                                            <h6 class="product-card__title">Клиппер-переноска для кошек и собак Ferplast Jet 10 серый/фиолетовый серый/фиолетовыйсерый/фиолетовый серый/фиолетовый</h6>

                                            <p class="product-card__article">Арт. СХ-С-456013</p>

                                            <div class="product-card__colors colors">
                                                <ul class="colors__list">
                                                    <li class="colors__item">
                                                        <div class="color">
                                                            <div class="radio">
                                                                <input type="radio" class="color__input radio__input" name="radio2" value="r1" id="radio" checked>
                                                                <label for="radio">
                                                                    <div class="color__item color__item--pink"></div>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </li>

                                                    <li class="colors__item">
                                                        <div class="color">
                                                            <div class="radio">
                                                                <input type="radio" class="color__input radio__input" name="radio2" value="r2" id="radio2">
                                                                <label for="radio2">
                                                                    <div class="color__item color__item--blue"></div>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </li>

                                                    <li class="colors__item">
                                                        <div class="color">
                                                            <div class="radio">
                                                                <input type="radio" class="color__input radio__input" name="radio2" value="r3" id="radio3">
                                                                <label for="radio3">
                                                                    <div class="color__item color__item--green"></div>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </li>

                                                    <li class="colors__item">
                                                        <div class="color">
                                                            <div class="radio">
                                                                <input type="radio" class="color__input radio__input" name="radio2" value="r4" id="radio4">
                                                                <label for="radio4">
                                                                    <div class="color__item color__item--yellow"></div>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </li>

                                                    <li class="colors__item">
                                                        <div class="color">
                                                            <div class="radio">
                                                                <input type="radio" class="color__input radio__input" name="radio2" value="r3" id="radio5">
                                                                <label for="radio5">
                                                                    <div class="color__item color__item--red"></div>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </li>

                                                    <li class="colors__item">
                                                        <div class="color">
                                                            <div class="radio">
                                                                <input type="radio" class="color__input radio__input" name="radio2" value="r3" id="radio6">
                                                                <label for="radio6">
                                                                    <div class="color__item color__item--violet"></div>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>

                                            <div class="product-card__breed">
                                                <div class="select select--mini" data-select>
                                                    <select class="select__control" name="select1m" id="select1m" data-select-control data-placeholder="Выберите размер" data-option>
                                                        <option><!-- пустой option для placeholder --></option>
                                                        <option value="1">Для всех пород</option>
                                                        <option value="2">Мелкие породы</option>
                                                        <option value="3">Средние породы</option>
                                                        <option value="4">Крупные породы</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="product-card__footer">
                                            <div class="product-card__price price">
                                                <p class="price__main">1 545 ₽</p>
                                                <div class="price__calculation">
                                                    <p class="price__calculation-total">1 420 ₽</p>
                                                    <p class="price__calculation-accumulation">14 ББ</p>
                                                </div>
                                            </div>

                                            <div class="product-card__cart">
                                                <div class="quantity" data-quantity>
                                                    <div class="quantity__button" data-quantity-button>
                                                        <button type="button" class="button button--full button--medium button--rounded button--covered button--white-green">
                                                            <span class="button__icon">
                                                                <svg class="icon icon--basket">
                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-basket"></use>
                                                                </svg>
                                                            </span>
                                                            <span class="button__text">В корзину</span>
                                                        </button>
                                                    </div>
                        
                                                    <div class="quantity__actions">
                                                        <div class="quantity__decrease">
                                                            <button type="button" class="button button--iconed button--covered button--square button--small button--gray-red" data-quantity-decrease>
                                                                <span class="button__icon button__icon--small">
                                                                    <svg class="icon icon--minus">
                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-minus"></use>
                                                                    </svg>
                                                                </span>
                                                            </button>
                                                        </div>
                        
                                                        <div class="quantity__total">
                                                            <span class="quantity__total-icon">
                                                                <svg class="icon icon--basket">
                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-basket"></use>
                                                                </svg>
                                                            </span>
                                                            <span class="quantity__total-sum" data-quantity-sum="0">0</span>
                                                        </div>
                        
                                                        <div class="quantity__increase">
                                                            <button type="button" class="button button--iconed button--covered button--square button--small button--gray-green" data-quantity-increase>
                                                                <span class="button__icon button__icon--small">
                                                                    <svg class="icon icon--plus">
                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-plus"></use>
                                                                    </svg>
                                                                </span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                </li>

                                <li class="product-cards__item">
                                    <article class="product-card box box--circle box--hovering box--grayish">
                                        <a href="#" class="product-card__link"></a>
                                        <div class="product-card__header">
                                            <div class="product-card__label label label--pink">сезонное предложение</div>

                                            <div class="product-card__favourite">
                                                <button type="button" class="product-card__favourite-button button button--ordinary button--iconed button--simple button--big button--red" data-card-favourite="heart">
                                                    <span class="button__icon button__icon--big">
                                                        <svg class="icon icon--heart">
                                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-heart" data-card-favourite-icon></use>
                                                        </svg>
                                                    </span>
                                                </button>
                                            </div>

                                            <div class="product-card__wrapper">
                                                <div class="product-card__image box box--circle">
                                                    <div class="product-card__box">
                                                        <img src="/local/templates/.default/images/portage.png" alt="Название товара" class="product-card__pic">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="product-card__content">
                                            <h6 class="product-card__title">Клиппер-переноска для кошек и собак Ferplast Jet 10 серый/фиолетовый серый/фиолетовыйсерый/фиолетовый серый/фиолетовый</h6>

                                            <p class="product-card__article">Арт. СХ-С-456013</p>

                                            <div class="product-card__packs product-card__packs--desktop packs">
                                                <ul class="packs__list">
                                                    <li class="packs__item">
                                                        <div class="pack">
                                                            <div class="radio">
                                                                <input type="radio" class="pack__input radio__input" name="radio11" value="r11" id="radio11" checked>
                                                                <label for="radio11">
                                                                    <div class="pack__item">600 г</div>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </li>

                                                    <li class="packs__item">
                                                        <div class="pack">
                                                            <div class="radio">
                                                                <input type="radio" class="pack__input radio__input" name="radio11" value="r22" id="radio22">
                                                                <label for="radio22">
                                                                    <div class="pack__item">1 кг</div>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </li>

                                                    <li class="packs__item">
                                                        <div class="pack">
                                                            <div class="radio">
                                                                <input type="radio" class="pack__input radio__input" name="radio11" value="r33" id="radio33">
                                                                <label for="radio33">
                                                                    <div class="pack__item">3 кг</div>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </li>

                                                    <li class="packs__item">
                                                        <div class="pack">
                                                            <div class="radio">
                                                                <input type="radio" class="pack__input radio__input" name="radio11" value="r44" id="radio44">
                                                                <label for="radio44">
                                                                    <div class="pack__item">5 кг</div>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </li>

                                                    <li class="packs__item">
                                                        <div class="pack">
                                                            <div class="radio">
                                                                <input type="radio" class="pack__input radio__input" name="radio11" value="r55" id="radio55">
                                                                <label for="radio55">
                                                                    <div class="pack__item">7 кг</div>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </li>

                                                    <li class="packs__item">
                                                        <div class="pack">
                                                            <div class="radio">
                                                                <input type="radio" class="pack__input radio__input" name="radio11" value="r66" id="radio66">
                                                                <label for="radio66">
                                                                    <div class="pack__item">10 кг</div>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </li>

                                                    <li class="packs__item">
                                                        <div class="pack">
                                                            <div class="radio">
                                                                <input type="radio" class="pack__input radio__input" name="radio11" value="r77" id="radio77">
                                                                <label for="radio77">
                                                                    <div class="pack__item">15 кг</div>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>

                                            <div class="product-card__packs product-card__packs--mobile">
                                                <div class="select select--mini" data-select>
                                                    <select class="select__control" name="select1p" id="select1p" data-select-control data-placeholder="Выберите фасовку" data-option>
                                                        <option><!-- пустой option для placeholder --></option>
                                                        <option value="1">600 г</option>
                                                        <option value="2">1 кг</option>
                                                        <option value="3">3 кг</option>
                                                        <option value="4">5 кг</option>
                                                        <option value="5">7 кг</option>
                                                        <option value="6">10 кг</option>
                                                        <option value="7">15 кг</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="product-card__footer">
                                            <div class="product-card__price price">
                                                <p class="price__main">1 545 ₽</p>
                                                <div class="price__calculation">
                                                    <p class="price__calculation-total">1 420 ₽</p>
                                                    <p class="price__calculation-accumulation">14 ББ</p>
                                                </div>
                                            </div>

                                            <div class="product-card__cart">
                                                <div class="quantity" data-quantity>
                                                    <div class="quantity__button" data-quantity-button>
                                                        <button type="button" class="button button--full button--medium button--rounded button--covered button--white-green">
                                                            <span class="button__icon">
                                                                <svg class="icon icon--basket">
                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-basket"></use>
                                                                </svg>
                                                            </span>
                                                            <span class="button__text">В корзину</span>
                                                        </button>
                                                    </div>
                        
                                                    <div class="quantity__actions">
                                                        <div class="quantity__decrease">
                                                            <button type="button" class="button button--iconed button--covered button--square button--small button--gray-red" data-quantity-decrease>
                                                                <span class="button__icon button__icon--small">
                                                                    <svg class="icon icon--minus">
                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-minus"></use>
                                                                    </svg>
                                                                </span>
                                                            </button>
                                                        </div>
                        
                                                        <div class="quantity__total">
                                                            <span class="quantity__total-icon">
                                                                <svg class="icon icon--basket">
                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-basket"></use>
                                                                </svg>
                                                            </span>
                                                            <span class="quantity__total-sum" data-quantity-sum="0">0</span>
                                                        </div>
                        
                                                        <div class="quantity__increase">
                                                            <button type="button" class="button button--iconed button--covered button--square button--small button--gray-green" data-quantity-increase>
                                                                <span class="button__icon button__icon--small">
                                                                    <svg class="icon icon--plus">
                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-plus"></use>
                                                                    </svg>
                                                                </span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                </li>

                                <li class="product-cards__item">
                                    <article class="product-card box box--circle box--hovering box--grayish">
                                        <a href="#" class="product-card__link"></a>
                                        <div class="product-card__header">
                                            <div class="product-card__favourite">
                                                <button type="button" class="product-card__favourite-button button button--ordinary button--iconed button--simple button--big button--red" data-card-favourite="heart">
                                                    <span class="button__icon button__icon--big">
                                                        <svg class="icon icon--heart">
                                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-heart" data-card-favourite-icon></use>
                                                        </svg>
                                                    </span>
                                                </button>
                                            </div>

                                            <div class="product-card__wrapper">
                                                <div class="product-card__image box box--circle">
                                                    <div class="product-card__box">
                                                        <img src="/local/templates/.default/images/portage.png" alt="Название товара" class="product-card__pic">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="product-card__content">
                                            <h6 class="product-card__title">Клиппер-переноска для кошек и собак Ferplast Jet 10 серый/фиолетовый серый/фиолетовыйсерый/фиолетовый серый/фиолетовый</h6>

                                            <p class="product-card__article">Арт. СХ-С-456013</p>

                                            <div class="product-card__colors colors">
                                                <ul class="colors__list">
                                                    <li class="colors__item">
                                                        <div class="color">
                                                            <div class="radio">
                                                                <input type="radio" class="color__input radio__input" name="radio2" value="r1" id="radio" checked>
                                                                <label for="radio">
                                                                    <div class="color__item color__item--pink"></div>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </li>

                                                    <li class="colors__item">
                                                        <div class="color">
                                                            <div class="radio">
                                                                <input type="radio" class="color__input radio__input" name="radio2" value="r2" id="radio2">
                                                                <label for="radio2">
                                                                    <div class="color__item color__item--blue"></div>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </li>

                                                    <li class="colors__item">
                                                        <div class="color">
                                                            <div class="radio">
                                                                <input type="radio" class="color__input radio__input" name="radio2" value="r3" id="radio3">
                                                                <label for="radio3">
                                                                    <div class="color__item color__item--green"></div>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </li>

                                                    <li class="colors__item">
                                                        <div class="color">
                                                            <div class="radio">
                                                                <input type="radio" class="color__input radio__input" name="radio2" value="r4" id="radio4">
                                                                <label for="radio4">
                                                                    <div class="color__item color__item--yellow"></div>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </li>

                                                    <li class="colors__item">
                                                        <div class="color">
                                                            <div class="radio">
                                                                <input type="radio" class="color__input radio__input" name="radio2" value="r3" id="radio5">
                                                                <label for="radio5">
                                                                    <div class="color__item color__item--red"></div>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </li>

                                                    <li class="colors__item">
                                                        <div class="color">
                                                            <div class="radio">
                                                                <input type="radio" class="color__input radio__input" name="radio2" value="r3" id="radio6">
                                                                <label for="radio6">
                                                                    <div class="color__item color__item--violet"></div>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>

                                            <div class="product-card__breed">
                                                <div class="select select--mini" data-select>
                                                    <select class="select__control" name="select11m" id="select11m" data-select-control data-placeholder="Выберите размер" data-option>
                                                        <option><!-- пустой option для placeholder --></option>
                                                        <option value="1">Для всех пород</option>
                                                        <option value="2">Мелкие породы</option>
                                                        <option value="3">Средние породы</option>
                                                        <option value="4">Крупные породы</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="product-card__footer">
                                            <div class="product-card__price price">
                                                <p class="price__main">1 545 ₽</p>
                                                <div class="price__calculation">
                                                    <p class="price__calculation-total">1 420 ₽</p>
                                                    <p class="price__calculation-accumulation">14 ББ</p>
                                                </div>
                                            </div>

                                            <div class="product-card__cart">
                                                <div class="quantity" data-quantity>
                                                    <div class="quantity__button" data-quantity-button>
                                                        <button type="button" class="button button--full button--medium button--rounded button--covered button--white-green">
                                                            <span class="button__icon">
                                                                <svg class="icon icon--basket">
                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-basket"></use>
                                                                </svg>
                                                            </span>
                                                            <span class="button__text">В корзину</span>
                                                        </button>
                                                    </div>
                        
                                                    <div class="quantity__actions">
                                                        <div class="quantity__decrease">
                                                            <button type="button" class="button button--iconed button--covered button--square button--small button--gray-red" data-quantity-decrease>
                                                                <span class="button__icon button__icon--small">
                                                                    <svg class="icon icon--minus">
                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-minus"></use>
                                                                    </svg>
                                                                </span>
                                                            </button>
                                                        </div>
                        
                                                        <div class="quantity__total">
                                                            <span class="quantity__total-icon">
                                                                <svg class="icon icon--basket">
                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-basket"></use>
                                                                </svg>
                                                            </span>
                                                            <span class="quantity__total-sum" data-quantity-sum="0">0</span>
                                                        </div>
                        
                                                        <div class="quantity__increase">
                                                            <button type="button" class="button button--iconed button--covered button--square button--small button--gray-green" data-quantity-increase>
                                                                <span class="button__icon button__icon--small">
                                                                    <svg class="icon icon--plus">
                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-plus"></use>
                                                                    </svg>
                                                                </span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                </li>

                                <li class="product-cards__item">
                                    <article class="product-card box box--circle box--hovering box--grayish">
                                        <a href="#" class="product-card__link"></a>
                                        <div class="product-card__header">
                                            <div class="product-card__label label label--pink">сезонное предложение</div>

                                            <div class="product-card__favourite">
                                                <button type="button" class="product-card__favourite-button button button--ordinary button--iconed button--simple button--big button--red" data-card-favourite="heart">
                                                    <span class="button__icon button__icon--big">
                                                        <svg class="icon icon--heart">
                                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-heart" data-card-favourite-icon></use>
                                                        </svg>
                                                    </span>
                                                </button>
                                            </div>

                                            <div class="product-card__wrapper">
                                                <div class="product-card__image box box--circle">
                                                    <div class="product-card__box">
                                                        <img src="/local/templates/.default/images/portage.png" alt="Название товара" class="product-card__pic">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="product-card__content">
                                            <h6 class="product-card__title">Клиппер-переноска для кошек и собак Ferplast Jet 10 серый/фиолетовый серый/фиолетовыйсерый/фиолетовый серый/фиолетовый</h6>

                                            <p class="product-card__article">Арт. СХ-С-456013</p>

                                            <div class="product-card__packs product-card__packs--desktop packs">
                                                <ul class="packs__list">
                                                    <li class="packs__item">
                                                        <div class="pack">
                                                            <div class="radio">
                                                                <input type="radio" class="pack__input radio__input" name="radio11" value="r11" id="radio11" checked>
                                                                <label for="radio11">
                                                                    <div class="pack__item">600 г</div>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </li>

                                                    <li class="packs__item">
                                                        <div class="pack">
                                                            <div class="radio">
                                                                <input type="radio" class="pack__input radio__input" name="radio11" value="r22" id="radio22">
                                                                <label for="radio22">
                                                                    <div class="pack__item">1 кг</div>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </li>

                                                    <li class="packs__item">
                                                        <div class="pack">
                                                            <div class="radio">
                                                                <input type="radio" class="pack__input radio__input" name="radio11" value="r33" id="radio33">
                                                                <label for="radio33">
                                                                    <div class="pack__item">3 кг</div>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </li>

                                                    <li class="packs__item">
                                                        <div class="pack">
                                                            <div class="radio">
                                                                <input type="radio" class="pack__input radio__input" name="radio11" value="r44" id="radio44">
                                                                <label for="radio44">
                                                                    <div class="pack__item">5 кг</div>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </li>

                                                    <li class="packs__item">
                                                        <div class="pack">
                                                            <div class="radio">
                                                                <input type="radio" class="pack__input radio__input" name="radio11" value="r55" id="radio55">
                                                                <label for="radio55">
                                                                    <div class="pack__item">7 кг</div>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </li>

                                                    <li class="packs__item">
                                                        <div class="pack">
                                                            <div class="radio">
                                                                <input type="radio" class="pack__input radio__input" name="radio11" value="r66" id="radio66">
                                                                <label for="radio66">
                                                                    <div class="pack__item">10 кг</div>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </li>

                                                    <li class="packs__item">
                                                        <div class="pack">
                                                            <div class="radio">
                                                                <input type="radio" class="pack__input radio__input" name="radio11" value="r77" id="radio77">
                                                                <label for="radio77">
                                                                    <div class="pack__item">15 кг</div>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>

                                            <div class="product-card__packs product-card__packs--mobile">
                                                <div class="select select--mini" data-select>
                                                    <select class="select__control" name="select11p" id="select11p" data-select-control data-placeholder="Выберите фасовку" data-option>
                                                        <option><!-- пустой option для placeholder --></option>
                                                        <option value="1">600 г</option>
                                                        <option value="2">1 кг</option>
                                                        <option value="3">3 кг</option>
                                                        <option value="4">5 кг</option>
                                                        <option value="5">7 кг</option>
                                                        <option value="6">10 кг</option>
                                                        <option value="7">15 кг</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="product-card__footer">
                                            <div class="product-card__price price">
                                                <p class="price__main">1 545 ₽</p>
                                                <div class="price__calculation">
                                                    <p class="price__calculation-total">1 420 ₽</p>
                                                    <p class="price__calculation-accumulation">14 ББ</p>
                                                </div>
                                            </div>

                                            <div class="product-card__cart">
                                                <div class="quantity quantity--active" data-quantity>
                                                    <div class="quantity__button" data-quantity-button>
                                                        <button type="button" class="button button--full button--medium button--rounded button--covered button--white-green">
                                                            <span class="button__icon">
                                                                <svg class="icon icon--basket">
                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-basket"></use>
                                                                </svg>
                                                            </span>
                                                            <span class="button__text">В корзину</span>
                                                        </button>
                                                    </div>
                        
                                                    <div class="quantity__actions">
                                                        <div class="quantity__decrease">
                                                            <button type="button" class="button button--iconed button--covered button--square button--small button--gray-red" data-quantity-decrease>
                                                                <span class="button__icon button__icon--small">
                                                                    <svg class="icon icon--minus">
                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-minus"></use>
                                                                    </svg>
                                                                </span>
                                                            </button>
                                                        </div>
                        
                                                        <div class="quantity__total">
                                                            <span class="quantity__total-icon">
                                                                <svg class="icon icon--basket">
                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-basket"></use>
                                                                </svg>
                                                            </span>
                                                            <span class="quantity__total-sum" data-quantity-sum="2">2</span>
                                                        </div>
                        
                                                        <div class="quantity__increase">
                                                            <button type="button" class="button button--iconed button--covered button--square button--small button--gray-green" data-quantity-increase>
                                                                <span class="button__icon button__icon--small">
                                                                    <svg class="icon icon--plus">
                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-plus"></use>
                                                                    </svg>
                                                                </span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--/Карточки товара-->

                    <!--Слайдер-->
                    <div class="gui__block">
                        <h2 class="gui__title">Слайдеры</h2>

                        <div class="gui__slider">
                            <h3 style="margin-top: 40px">Слайдер на главной</h3>

                            <div class="slider slider--main" data-carousel="main">
                                <div class="swiper-container" data-carousel-container>
                                    <div class="swiper-wrapper">

                                        <div class="swiper-slide slider__slide">
                                            <img
                                                src="https://fakeimg.pl/1920x800/"
                                                alt="#"
                                                class="slider__slide-image"
                                            />

                                            <article class="slider__slide-card card-slide">
                                                <div class="card-slide__inner">
                                                    <h2 class="card-slide__title">
                                                        Это точно понравится вам и вашим питомцам:
                                                    </h2>
                                                    <p class="card-slide__text">
                                                        Скидка на популярные товары для собак в июне
                                                    </p>

                                                    <div class="card-slide__pagination swiper-pagination pagination pagination--default" data-carousel-pagination></div>

                                                    <div class="card-slide__sale sale">
                                                        <p class="sale__text">
                                                            -50%
                                                        </p>
                                                    </div>

                                                </div>
                                            </article>
                                        </div>
                                        
                                        <div class="swiper-slide slider__slide">
                                            <img
                                                src="https://fakeimg.pl/1920x801/"
                                                alt="#"
                                                class="slider__slide-image"
                                            />

                                            <article class="slider__slide-card card-slide">
                                                <div class="card-slide__inner">
                                                    <h2 class="card-slide__title">
                                                        Это точно понравится вам и вашим питомцам:
                                                    </h2>
                                                    <p class="card-slide__text">
                                                        Скидка на популярные товары для собак в июне
                                                    </p>

                                                    <div class="card-slide__pagination swiper-pagination pagination pagination--default" data-carousel-pagination></div>

                                                    <div class="card-slide__sale sale">
                                                        <p class="sale__text">
                                                            -50%
                                                        </p>
                                                    </div>

                                                </div>
                                            </article>
                                        </div>

                                    </div>

                                    <div class="swiper-pagination pagination pagination--default" data-carousel-pagination></div>

                                    <div class="slider__buttons">
                                        <div class="slider__buttons-item swiper-button-prev" data-carousel-prev>
                                            <button type="button" class="slider__button slider__button--prev">
                                                <svg class="slider__button-icon icon icon--arrow">
                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-left"></use>
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="slider__buttons-item swiper-button-next" data-carousel-next>
                                            <button type="button" class="slider__button slider__button--next">
                                                <svg class="slider__button-icon icon icon--arrow">
                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-left"></use>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            
                            <h3 style="margin-top: 40px">Слайдер на деталке</h3>
                            
                            <div class="slider slider--pagination" data-carousel="pagination">
                                <div class="swiper-container" data-carousel-container>
                                    <div class="swiper-wrapper">

                                        <div class="swiper-slide slider__slide">
                                            <img
                                                src="https://fakeimg.pl/1920x801/"
                                                alt="#"
                                                class="slider__slide-image"
                                            />
                                        </div>

                                    </div>

                                    <div class="swiper-pagination pagination pagination--default" data-carousel-pagination></div>

                                    <div class="slider__buttons">
                                        <div class="slider__buttons-item swiper-button-prev" data-carousel-prev>
                                            <button type="button" class="slider__button slider__button--prev">
                                                <svg class="slider__button-icon icon icon--arrow">
                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-left"></use>
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="slider__buttons-item swiper-button-next" data-carousel-next>
                                            <button type="button" class="slider__button slider__button--next">
                                                <svg class="slider__button-icon icon icon--arrow">
                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-left"></use>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/Слайдер-->
                </main>
            </div>
        </div>
        <!--content-->

        <!--Футер-->
        <footer class="page__footer footer" style="background-color: cadetblue">
            Футер
        </footer>
        <!--/Футер-->

        <script src="/local/templates/.default/js/script.js"></script>
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

    .gui__example {
        margin-top: 50px;
    }

</style>

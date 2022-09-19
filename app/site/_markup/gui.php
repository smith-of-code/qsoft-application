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

                            <div style="margin-top: 50px;">
                                <h3 style="margin-top: 50px;">Квадратные</h3>

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

                            <div style="margin-top: 50px;">

                                <h3 style="margin-top: 50px;">Cкругленные</h3>

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

                            <div style="margin-top: 50px;">

                                <h3 style="margin-top: 50px;">Сильно скругленные</h3>

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

                            <div style="margin-top: 50px;">

                                <h3 style="margin-top: 50px;">С иконками</h3>

                                <h4 style="margin-top: 50px;">Залитые</h4>

                                <ul class="buttons__list">
                                    <li class="buttons__item">
                                        <button type="button" class="button button--rounded button--covered button--red">
                                            <span class="button__icon">
                                                <svg class="icon icon--basket">
                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-basket"></use>
                                                </svg>
                                            </span>
                                            <span class="button__text">С иконкой слева</span>
                                        </button>
                                    </li>

                                    <li class="buttons__item">
                                        <button type="button" class="button button--rounded button--covered button--green">
                                            <span class="button__icon button__icon--right">
                                                <svg class="icon icon--basket">
                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-basket"></use>
                                                </svg>
                                            </span>
                                            <span class="button__text">С иконкой справа</span>
                                        </button>
                                    </li>

                                    <li class="buttons__item">
                                        <button type="button" class="button button--rounded button--outlined button--green">
                                            <span class="button__icon button__icon--medium">
                                                <svg class="icon icon--basket">
                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-basket"></use>
                                                </svg>
                                            </span>
                                            <span class="button__text">С небольшой иконкой слева</span>
                                        </button>
                                    </li>

                                    <li class="buttons__item">
                                        <button type="button" class="button button--rounded button--outlined button--green button--disabled" disabled>
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

                            <div>

                                <h3 style="margin-top: 50px;">Иконочные</h3>

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
                                </ul>

                            </div>

                            <div>

                                <h3 style="margin-top: 50px;">Простые</h3>

                                <ul class="buttons__list">
                                    <li class="buttons__item">
                                        <button type="button" class="button button--simple button--red">
                                            Простая кнопка
                                        </button>
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

                    <!--Текстовые поля ввода-->
                    <div class="gui__block">
                        <h2 class="gui__title">Текстовые поля ввода</h2>

                        <form class="form">
                            <div class="form__row">
                                <div class="form__col">
                                    <div class="form__field">
                                        <div class="form__field-block form__field-block--label">
                                            <label for="text" class="form__label">
                                                <span class="form__label-text">Поле ввода</span>
                                            </label>
                                        </div>

                                        <div class="form__field-block form__field-block--input">
                                            <div class="input input--iconed">
                                                <input type="text" class="input__control" name="text" id="text" placeholder="Поле ввода с лэйблом">
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
                                        <div class="form__field-block form__field-block--label">
                                            <label for="text-required" class="form__label form__label--required">
                                                <span class="form__label-text">Обязательное поле ввода</span>
                                            </label>
                                        </div>

                                        <div class="form__field-block form__field-block--input">
                                            <div class="input">
                                                <input type="text" class="input__control" name="text-required" id="text-required" placeholder="Обязательное поле ввода">
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
                                            <label for="text" class="form__label form__label--required">
                                                <span class="form__label-text">Поле ввода c ошибкой</span>
                                            </label>
                                        </div>

                                        <div class="form__field-block form__field-block--input">
                                            <div class="input input--iconed">
                                                <input type="text" class="input__control input__control--error" name="text" id="text" placeholder="Поле ввода с лэйблом">

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
                                            <div class="input">
                                                <input type="password" class="input__control" name="password" id="text" placeholder="Введите пароль" data-password-input>
                                                <span class="input__icon input__icon-password" data-password-icon></span>
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
                                                <textarea type="text" class="input__control" name="textarea" id="textarea" placeholder="Многострочное поле ввода"></textarea>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!--/Текстовые поля ввода-->

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

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
                                    <span class="quantity__total-sum" data-quantity-sum></span>
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
                                            <label for="text1" class="form__label">
                                                <span class="form__label-text">Поле ввода</span>
                                            </label>
                                        </div>

                                        <div class="form__field-block form__field-block--input">
                                            <div class="input input--iconed">
                                                <input type="text" class="input__control" name="text" id="text1" placeholder="Поле ввода с лэйблом">
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
                                                <textarea type="text" class="input__control" name="textarea" id="textarea" placeholder="Многострочное поле ввода" maxlength="1000" data-textarea-input></textarea>
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

                            <div class="dropdown__box box" data-dropdown-block data-scrollbar>
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

                            <div class="pet-card">
                                <div class="pet-card__main">
                                    <div class="pet-card__avatar">
                                        <svg class="icon icon--dog">
                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-dog"></use>
                                        </svg>
                                    </div>

                                    <div class="pet-card__name">
                                        Мухтар Бесстрашный
                                    </div>

                                    <div class="pet-card__breed">
                                        Австралийская овчарка
                                    </div>

                                    <div class="pet-card__gender">
                                        <svg class="icon icon--man">
                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-man"></use>
                                        </svg>
                                    </div>

                                    <div class="pet-card__date">
                                        09.10.2017
                                    </div>

                                    <div class="pet-card__modify">
                                        <button type="button" class="button button--iconed button--simple button--red">
                                            <span class="button__icon">
                                                <svg class="icon icon--edit">
                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-edit"></use>
                                                </svg>
                                            </span>
                                        </button>
                                    </div>

                                    <div class="pet-card__delete">
                                        <button type="button" class="button button--iconed button--simple button--red">
                                            <span class="button__icon">
                                                <svg class="icon icon--basket">
                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-basket"></use>
                                                </svg>
                                            </span>
                                        </button>
                                    </div>
                                </div>

                                <div class="pet-card__edit"></div>
                            </div>
                        </div>
                    </div>
                    <!--/Данные о питомцах-->
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

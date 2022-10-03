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
                            <li class="steps-counter__item steps-counter__item--current" data-steps-item>
                                <div class="steps-counter__circle  steps-counter__circle--current" data-steps-indicator>
                                    <span class="steps-counter__circle-text">Персональные данные</span>
                                </div>
                            </li>

                            <li class="steps-counter__item" data-steps-item>
                                <div class="steps-counter__circle" data-steps-indicator>
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
                    </section>

                    <section class="section section--limited-big">
                        <h4 class="section__title">Персональные данные</h4>

                        <form class="registration__form form form--separated form--wraped" action="" method="post">
                            <div class="registration__box box box--hidden box--grayish box--rounded-sm">
                                <div class="registration__box registration__box--small box box--hidden box--white box--rounded-sm">
                                    <!--dropzone-->
                                    <div class="registration__dropzone dropzone dropzone--image" data-uploader>
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
                                    <!--/dropzone-->

                                    <div class="form__row">
                                        <div class="form__col">
                                            <div class="form__field">
                                                <div class="form__field-block form__field-block--label">
                                                    <label for="text-required" class="form__label form__label--required">
                                                        <span class="form__label-text">Фамилия</span>
                                                    </label>
                                                </div>

                                                <div class="form__field-block form__field-block--input">
                                                    <div class="input">
                                                        <input type="text" class="input__control" name="text-required" id="text-required" placeholder="Введите фамилию">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form__col">
                                            <div class="form__field">
                                                <div class="form__field-block form__field-block--label">
                                                    <label for="text-required" class="form__label form__label--required">
                                                        <span class="form__label-text">Имя</span>
                                                    </label>
                                                </div>

                                                <div class="form__field-block form__field-block--input">
                                                    <div class="input">
                                                        <input type="text" class="input__control" name="text-required" id="text-required" placeholder="Введите имя">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form__row form__row--centered">
                                        <div class="form__col">
                                            <div class="form__field">
                                                <div class="form__field-block form__field-block--label">
                                                    <label for="text-required" class="form__label form__label--required">
                                                        <span class="form__label-text">Отчество</span>
                                                    </label>
                                                </div>

                                                <div class="form__field-block form__field-block--input">
                                                    <div class="input">
                                                        <input type="text" class="input__control" name="text-required" id="text-required" placeholder="Введите отчество">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

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

                                                        <span class="checkbox__text">У меня нет отчества</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form__row">
                                        <div class="form__col">
                                            <div class="form__field">
                                                <div class="form__field-block form__field-block--label">
                                                    <label for="select33" class="form__label form__label--required">
                                                        <span class="form__label-text">Пол</span>
                                                    </label>
                                                </div>

                                                <div class="form__field-block form__field-block--input">
                                                    <div class="form__control">
                                                        <div class="select select--mitigate" data-select>
                                                            <select class="select__control" name="select33" id="select33" data-select-control data-placeholder="Выберите пол">
                                                                <option><!-- пустой option для placeholder --></option>
                                                                <option value="1">Женский</option>
                                                                <option value="2">Мужской</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form__col">
                                            <div class="form__field">
                                                <div class="form__field-block form__field-block--label">
                                                    <label for="birthdate" class="form__label form__label--required">
                                                        <span class="form__label-text">Дата рождения</span>
                                                    </label>
                                                </div>

                                                <div class="form__field-block form__field-block--input">
                                                    <div class="input input--iconed">
                                                        <input inputmode="numeric"
                                                            class="input__control"
                                                            name="text"
                                                            id="birthdate"
                                                            placeholder="ДД.ММ.ГГГГ"
                                                            data-mask-date 
                                                            data-inputmask-alias="datetime"
                                                            data-inputmask-inputformat="dd.mm.yyyy"
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
                                                    <label for="select22" class="form__label form__label--required">
                                                        <span class="form__label-text">Населенный пункт</span>
                                                    </label>
                                                </div>

                                                <div class="form__field-block form__field-block--input">
                                                    <div class="form__control">
                                                        <div class="select select--mitigate" data-select>
                                                            <select class="select__control" name="select22" id="select22" data-select-control data-placeholder="Выберите город">
                                                                <option><!-- пустой option для placeholder --></option>
                                                                <option value="1">Москва</option>
                                                                <option value="2">Нижний Новгород</option>
                                                                <option value="3">Самара</option>
                                                                <option value="4">Челябинск</option>
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
                                                    <label for="text-required" class="form__label form__label--required">
                                                        <span class="form__label-text">Телефон</span>
                                                    </label>
                                                </div>

                                                <div class="form__field-block form__field-block--input">
                                                    <div class="input">
                                                        <input type="number" class="input__control" name="text-required" id="text-required" placeholder="Введите телефон">
                                                    </div>
                                                </div>

                                                <button type="button" class="form__field-button button button--simple button--red button--underlined button--tiny">
                                                    Отправить проверочный код
                                                </button>
                                            </div>
                                        </div>

                                        <div class="form__col">
                                            <div class="form__field">
                                                <div class="form__field-block form__field-block--label">
                                                    <label for="text-required" class="form__label form__label--required">
                                                        <span class="form__label-text">E-mail</span>
                                                    </label>
                                                </div>

                                                <div class="form__field-block form__field-block--input">
                                                    <div class="input">
                                                        <input type="email" class="input__control" name="text-required" id="text-required" placeholder="Введите E-mail">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="registration__checkboxes checkboxes">
                                    <ul class="checkboxes__list">
                                        <li class="checkboxes__item">
                                            <div class="checkbox">
                                                <input type="checkbox" class="checkbox__input" name="check[]" value="r1" id="r1">

                                                <label for="r1" class="checkbox__label">
                                                    <span class="checkbox__icon">
                                                        <svg class="checkbox__icon-pic icon icon--check">
                                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check">
                                                        </svg>
                                                    </span>

                                                    <span class="checkbox__text">Я согласен на обработку персональных данных</span>
                                                </label>
                                            </div>
                                        </li>

                                        <li class="checkboxes__item">
                                            <div class="checkbox">
                                                <input type="checkbox" class="checkbox__input" name="check[]" value="r2" id="r2">

                                                <label for="r2" class="checkbox__label">
                                                    <span class="checkbox__icon">
                                                        <svg class="checkbox__icon-pic icon icon--check">
                                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check">
                                                        </svg>
                                                    </span>

                                                    <span class="checkbox__text">Я согласен с условиями пользования сайтом</span>
                                                </label>
                                            </div>
                                        </li>

                                        <li class="checkboxes__item">
                                            <div class="checkbox">
                                                <input type="checkbox" class="checkbox__input" name="check[]" value="r3" id="r3">

                                                <label for="r3" class="checkbox__label">
                                                    <span class="checkbox__icon">
                                                        <svg class="checkbox__icon-pic icon icon--check">
                                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check">
                                                        </svg>
                                                    </span>

                                                    <span class="checkbox__text">Я согласен с правилами компании</span>
                                                </label>
                                            </div>
                                        </li>

                                        <li class="checkboxes__item">
                                            <div class="checkbox">
                                                <input type="checkbox" class="checkbox__input" name="check[]" value="r4" id="r4">

                                                <label for="r4" class="checkbox__label">
                                                    <span class="checkbox__icon">
                                                        <svg class="checkbox__icon-pic icon icon--check">
                                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check">
                                                        </svg>
                                                    </span>

                                                    <span class="checkbox__text">Я согласен на получение информации о продуктах, спецпредложениях и акциях</span>
                                                </label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <div class="registration__actions registration__actions--inlined registration__actions--separated">
                                    <div class="registration__actions-col">
                                        <a href="" class="button button--rounded button--covered button--white-green">
                                            <span class="button__text">Назад к авторизации</span>
                                        </a>
                                    </div>

                                    <div class="registration__actions-col">
                                        <a href="" class="button button--rounded button--covered button--red">
                                            <span class="button__text">Далее</span>
                                        </a>
                                    </div>
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

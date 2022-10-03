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

                            <li class="steps-counter__item  steps-counter__item--current" data-steps-item>
                                <div class="steps-counter__circle  steps-counter__circle--current" data-steps-indicator>
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
                        <h4 class="section__title">Данные о питомцах</h4>

                        <div class="pet-cards box box--gray box--rounded">
                            <ul class="pet-cards__list">
                                <li class="pet-cards__item">
                                    <!--Карточка питомца-->
                                    <article class="pet-card" data-pets-card>
                                        <div class="pet-card__main box box--circle" data-pets-main>
                                            <div class="pet-card__content">
                                                <div class="pet-card__avatar">
                                                    <svg class="icon icon--dog">
                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-dog"></use>
                                                    </svg>
                                                </div>

                                                <div class="pet-card__info">
                                                    <div class="pet-card__name">
                                                        Мухтар Бесстрашный
                                                    </div>

                                                    <div class="pet-card__breed">
                                                        Австралийская овчарка
                                                    </div>

                                                    <div class="pet-card__info-record">
                                                        <div class="pet-card__gender">
                                                            <svg class="icon icon--man">
                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-man"></use>
                                                            </svg>
                                                        </div>

                                                        <div class="pet-card__date">
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
                                            <form class="form">
                                                <div class="pet-card__row form__row">
                                                    <div class="pet-card__col pet-card__col--1-3 pet-card__col--3 form__col">
                                                        <div class="form__field">
                                                            <div class="form__field-block form__field-block--label">
                                                                <label for="pet-card-select" class="form__label">
                                                                    <span class="form__label-text">Тип питомца</span>
                                                                </label>
                                                            </div>
                    
                                                            <div class="form__field-block form__field-block--input">
                                                                <div class="form__control">
                                                                    <div class="select select--mitigate select--iconed" data-select>
                                                                        <select class="select__control" name="select" id="pet-card-select1" data-select-control data-placeholder="Выбрать">
                                                                            <option data-option-icon="cat"><!-- пустой option для placeholder --></option>
                                                                            <option value="1" data-option-icon="cat">Кошка</option>
                                                                            <option value="2" data-option-icon="dog">Собака</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="pet-card__col pet-card__col--1-3 form__col">
                                                        <div class="form__field">
                                                            <div class="form__field-block form__field-block--label">
                                                                <label for="pet-card-select" class="form__label">
                                                                    <span class="form__label-text">Пол</span>
                                                                </label>
                                                            </div>
                    
                                                            <div class="form__field-block form__field-block--input">
                                                                <div class="form__control">
                                                                    <div class="select select--mitigate" data-select>
                                                                        <select class="select__control" name="select" id="pet-card-select" data-select-control data-placeholder="Выбрать">
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

                                                    <div class="pet-card__col pet-card__col--1-2 pet-card__col--1 form__col">
                                                        <div class="form__field">
                                                            <div class="form__field-block form__field-block--label">
                                                                <label for="pet-card-select2" class="form__label">
                                                                    <span class="form__label-text">Порода</span>
                                                                </label>
                                                            </div>
                    
                                                            <div class="form__field-block form__field-block--input">
                                                                <div class="form__control">
                                                                    <div class="select select--mitigate" data-select>
                                                                        <select class="select__control" name="select" id="pet-card-select2" data-select-control data-placeholder="Выбрать">
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
                                                                <label for="text1" class="form__label">
                                                                    <span class="form__label-text">Кличка</span>
                                                                </label>
                                                            </div>

                                                            <div class="form__field-block form__field-block--input">
                                                                <div class="input">
                                                                    <input type="text" class="input__control" name="text" id="text1" placeholder="Выбрать">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="pet-card__buttons">
                                                    <button type="button" class="pet-card__button button button--rounded button--covered button--green button--full">
                                                        Сохранить изменения
                                                    </button>

                                                    <button type="button" class="pet-card__button button button--rounded button--mixed button--red button--full">
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
                                                <div class="pet-card__avatar">
                                                    <svg class="icon icon--cat">
                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-cat"></use>
                                                    </svg>
                                                </div>

                                                <div class="pet-card__info">
                                                    <div class="pet-card__name">
                                                        Веснушка
                                                    </div>

                                                    <div class="pet-card__breed">
                                                        Абиссинская кошка
                                                    </div>

                                                    <div class="pet-card__info-record">
                                                        <div class="pet-card__gender">
                                                            <svg class="icon icon--woman">
                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-woman"></use>
                                                            </svg>
                                                        </div>

                                                        <div class="pet-card__date">
                                                            20.12.2019
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
                                    </article>
                                    <!--/Карточка питомца-->
                                </li>

                                <li class="pet-cards__item">
                                    <!--Карточка питомца-->
                                    <article class="pet-card" data-pets-card>
                                        <div class="pet-card__main box box--circle" data-pets-main>
                                            <div class="pet-card__content">
                                                <div class="pet-card__avatar">
                                                    <svg class="icon icon--cat">
                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-cat"></use>
                                                    </svg>
                                                </div>

                                                <div class="pet-card__info">
                                                    <div class="pet-card__name">
                                                        Барон Корф VI
                                                    </div>

                                                    <div class="pet-card__breed">
                                                        Американская короткошерстная кошка
                                                    </div>

                                                    <div class="pet-card__info-record">
                                                        <div class="pet-card__gender">
                                                            <svg class="icon icon--man">
                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-man"></use>
                                                            </svg>
                                                        </div>

                                                        <div class="pet-card__date">
                                                            20.12.2019
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
                                    </article>
                                    <!--/Карточка питомца-->
                                </li>
                            </ul>

                            <div class="pet-cards__adding">
                                <button type="button" class="button button--rounded button--covered button--white-green button--full">
                                    <span class="button__icon button__icon--medium">
                                        <svg class="icon icon--add-circle">
                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-add-circle"></use>
                                        </svg>
                                    </span>
                                    <span class="button__text">Добавить питомца</span>
                                </button>
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

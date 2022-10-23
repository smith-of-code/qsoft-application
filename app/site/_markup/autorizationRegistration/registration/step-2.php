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
                                <div class="steps-counter__circle steps-counter__circle--1 steps-counter__circle--passed" data-steps-indicator>
                                    <span class="steps-counter__circle-text">Персональные данные</span>
                                </div>
                            </li>

                            <li class="steps-counter__item  steps-counter__item--current" data-steps-item>
                                <div class="steps-counter__circle steps-counter__circle--2 steps-counter__circle--current" data-steps-indicator>
                                    <span class="steps-counter__circle-text">Данные о питомцах</span>
                                </div>
                            </li>

                            <li class="steps-counter__item" data-steps-item>
                                <div class="steps-counter__circle steps-counter__circle--3" data-steps-indicator>
                                    <span class="steps-counter__circle-text">Выбор наставника</span>
                                </div>
                            </li>

                            <li class="steps-counter__item" data-steps-item>
                                <div class="steps-counter__circle steps-counter__circle--4" data-steps-indicator>
                                    <span class="steps-counter__circle-text">Юридические данные</span>
                                </div>
                            </li>

                            <li class="steps-counter__item" data-steps-item>
                                <div class="steps-counter__circle steps-counter__circle--5" data-steps-indicator>
                                    <span class="steps-counter__circle-text">Установка пароля</span>
                                </div>
                            </li>

                            <li class="steps-counter__item" data-steps-item>
                                <div class="steps-counter__circle steps-counter__circle--6" data-steps-indicator>
                                </div>
                            </li>
                        </ul>
                    </section>

                    <section class="section section--limited-big">
                        <h4 class="section__title">Данные о питомцах</h4>

                        <div class="pet-cards box box--gray box--rounded">
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
                                                                            <option value="1" data-pets-species="cat" data-option-before='<svg class="select__item-icon icon icon--cat"><use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-cat"></use></svg>' >Кошка</option>
                                                                            <option value="2" data-pets-species="dog" data-option-before='<svg class="select__item-icon icon icon--dog"><use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-dog"></use></svg>' data-pets-card selected>Собака</option>
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
                                                                            <option value="1" data-pets-species="cat"  data-option-before='<svg class="select__item-icon icon icon--cat"><use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-cat"></use></svg>' selected>Кошка</option>
                                                                            <option value="2" data-pets-species="dog"  data-option-before='<svg class="select__item-icon icon icon--dog"><use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-dog"></use></svg>' data-pets-card>Собака</option>
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
                                                                <label for="text19" class="form__label">
                                                                    <span class="form__label-text">Кличка</span>
                                                                </label>
                                                            </div>

                                                            <div class="form__field-block form__field-block--input">
                                                                <div class="input">
                                                                    <input type="text" value="Мурка" class="input__control" name="nickname" id="text19" placeholder="Выбрать" data-pets-name-input data-pets-change>
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
                                                                            <option value="1" data-pets-species="cat"  data-option-before='<svg class="select__item-icon icon icon--cat"><use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-cat"></use></svg>' selected>Кошка</option>
                                                                            <option value="2" data-pets-species="dog"  data-option-before='<svg class="select__item-icon icon icon--dog"><use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-dog"></use></svg>' data-pets-card>Собака</option>
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
                                                                <label for="text19" class="form__label">
                                                                    <span class="form__label-text">Кличка</span>
                                                                </label>
                                                            </div>

                                                            <div class="form__field-block form__field-block--input">
                                                                <div class="input">
                                                                    <input type="text" class="input__control" name="nickname" id="text19" placeholder="Выбрать" data-pets-name-input data-pets-change>
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

                        <div class="registration__actions registration__actions--inlined registration__actions--separated">
                            <div class="registration__actions-col">
                                <button type="button" class="button button--rounded button--covered button--white-green button--full">
                                    <span class="button__text">Назад</span>
                                </button>
                            </div>

                            <div class="registration__actions-col">
                                <button type="submit" class="button button--rounded button--covered button--red button--full">
                                    <span class="button__text">Далее</span>
                                </button>
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

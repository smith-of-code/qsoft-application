<!DOCTYPE html>
<html lang="ru">
    <head>
        <title>Уведомления</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1 maximum-scale=1 user-scalable=0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" type="text/css" href="/local/templates/.default/css/style.css" />
    </head>

    <body class="page">

        <!--header-->
        <? include_once("../include/header.php"); ?>
        <!--/header-->

        <!--content-->
        <div class="page__content page__content--breadcrumbs content">
            <div class="container">
                <main class="page__private">

                    <div class="breadcrumbs">
                        <ul class="breadcrumbs__list">
                            <li class="breadcrumbs__item">
                                <a href="#" class="breadcrumbs__link">Главная</a>
                            </li>
                            <li class="breadcrumbs__item">
                                <a href="#" class="breadcrumbs__link">Уведомления</a>
                            </li>
                        </ul>
                    </div>

                    <h1 class="page__heading">Личный кабинет</h1>

                    <div class="content__main">
                        <div class="private__row">
                            <div class="private__col private__col--limited">
                                <nav class="private__menu notifications__menu notifications__menu--private menu menu--private">
                                    <ul class="menu__list notifications__menu-list">
                                        <li class="menu__item notifications__menu-item">
                                            <a href="#" class="menu__link">
                                                <span class="notifications__menu-icon menu__icon">
                                                    <svg class="icon icon--profile gui__icon">
                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-profile"></use>
                                                    </svg>
                                                </span>
                                                <span class="menu__text">
                                                    Профиль
                                                </span>
                                            </a>
                                        </li>

                                        <li class="menu__item notifications__menu-item">
                                            <a href="#" class="menu__link">
                                                <span class="notifications__menu-icon menu__icon">
                                                    <svg class="icon icon--receipts gui__icon">
                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-receipts"></use>
                                                    </svg>
                                                </span>
                                                <span class="menu__text">
                                                    История заказов
                                                </span>
                                            </a>
                                        </li>

                                        <li class="menu__item notifications__menu-item">
                                            <a href="#" class="menu__link">
                                                <span class="menu__icon notifications__menu-icon">
                                                    <svg class="icon icon--calculator gui__icon">
                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-calculator"></use>
                                                    </svg>
                                                </span>
                                                <span class="menu__text">
                                                    Калькулятор доходности
                                                </span>
                                            </a>
                                        </li>

                                        <li class="menu__item notifications__menu-item">
                                            <a href="#" class="menu__link">
                                                <span class="menu__icon notifications__menu-icon">
                                                    <svg class="icon icon--chart-square gui__icon">
                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-chart-square"></use>
                                                    </svg>
                                                </span>
                                                <span class="menu__text">
                                                    Отчетность по объемам продаж
                                                </span>
                                            </a>
                                        </li>

                                        <li class="menu__item notifications__menu-item menu__item--active">
                                            <a href="#" class="menu__link">
                                                <span class="notifications__menu-icon menu__icon menu__icon--active">
                                                    <svg class="icon icon--notification gui__icon">
                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-notification"></use>
                                                    </svg>
                                                </span>
                                                <span class="menu__text">
                                                    Уведомления
                                                </span>
                                                <span class="menu__counter">10</span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>

                            <div class="private__col private__col--full">
                                <div class="notifications">
                                    <h3 class="notifications__title">Уведомления</h3>

                                    <div class="notifications__cards cards-notify">
                                        <ul class="notifications__list cards-notify__list">
                                            <li class="cards-notify__item">

                                                <article class="card-notify card-notify--green">
                                                    <a href="#" class="card-notify__link"></a>
                                                
                                                    <div class="card-notify__inner">
                                                    
                                                        <header class="card-notify__header">
                                                            <div class="card-notify__mark">
                                                                <svg class="card-notify__mark-icon icon icon--notification">
                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-notification"></use>
                                                                </svg>
                                                            </div>
                                                            <p class="card-notify__title">
                                                                Статус заявки изменился
                                                            </p>
                                                        </header>

                                                        <div class="card-notify__message">
                                                            <p class="card-notify__text">
                                                                Поздравляем! Вы перевыполнили план по удержанию статуса уровня к2 в этом месяце
                                                            </p>
                                                        </div>

                                                        <footer class="card-notify__footer">
                                                            <time class="card-notify__send" datetime="2022-07-27 13:24">
                                                                <span class="card-notify__send-status">Отправлено</span>
                                                                <span class="card-notify__send-date">27.07.2022</span>
                                                                <span class="card-notify__send-time">13:24</span>
                                                            </time>

                                                            <div class="card-notify__status">
                                                                <span class="card-notify__status-mark">
                                                                    <svg class="card-notify__status-icon icon icon--tick-circle-bold">
                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-tick-circle-bold"></use>
                                                                    </svg>
                                                                </span>
                                                                <p class="card-notify__status-text">
                                                                    Прочитано
                                                                </p>
                                                            </div>
                                                        </footer>

                                                    </div>
                                                </article>

                                            </li>
                                            <li class="cards-notify__item">

                                                <article class="card-notify card-notify--orange">
                                                    <a href="#" class="card-notify__link"></a>
                                                
                                                    <div class="card-notify__inner">
                                                    
                                                        <header class="card-notify__header">
                                                            <div class="card-notify__mark">
                                                                <svg class="card-notify__mark-icon icon icon--notification">
                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-notification"></use>
                                                                </svg>
                                                            </div>
                                                            <p class="card-notify__title">
                                                                Статус заявки изменился
                                                            </p>
                                                        </header>

                                                        <div class="card-notify__message">
                                                            <p class="card-notify__text">
                                                                Ваша заявка на смену наставника была рассмотрена и одобрена. Узнать информацию о своем новом наставнике, Вы можете в Профиле личного кабинета
                                                            </p>
                                                        </div>

                                                        <footer class="card-notify__footer">
                                                            <time class="card-notify__send" datetime="2022-07-27 13:24">
                                                                <span class="card-notify__send-status">Отправлено</span>
                                                                <span class="card-notify__send-date">27.07.2022</span>
                                                                <span class="card-notify__send-time">13:24</span>
                                                            </time>

                                                            <div class="card-notify__status">
                                                                <span class="card-notify__status-mark">
                                                                    <svg class="card-notify__status-icon icon icon--attention">
                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-attention"></use>
                                                                    </svg>
                                                                </span>
                                                                <p class="card-notify__status-text">
                                                                    Ждет прочтения
                                                                </p>
                                                            </div>
                                                        </footer>

                                                    </div>
                                                </article>

                                            </li>
                                            <li class="cards-notify__item">

                                                <article class="card-notify card-notify--orange">
                                                    <a href="#" class="card-notify__link"></a>
                                                
                                                    <div class="card-notify__inner">
                                                    
                                                        <header class="card-notify__header">
                                                            <div class="card-notify__mark">
                                                                <svg class="card-notify__mark-icon icon icon--notification">
                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-notification"></use>
                                                                </svg>
                                                            </div>
                                                            <p class="card-notify__title">
                                                                Статус заявки изменился
                                                            </p>
                                                        </header>

                                                        <div class="card-notify__message">
                                                            <p class="card-notify__text">
                                                                Ваша заявка на смену наставника была рассмотрена и одобрена. Узнать информацию о своем новом наставнике, Вы можете в Профиле личного кабинета
                                                            </p>
                                                        </div>

                                                        <footer class="card-notify__footer">
                                                            <time class="card-notify__send" datetime="2022-07-27 13:24">
                                                                <span class="card-notify__send-status">Отправлено</span>
                                                                <span class="card-notify__send-date">27.07.2022</span>
                                                                <span class="card-notify__send-time">13:24</span>
                                                            </time>

                                                            <div class="card-notify__status">
                                                                <span class="card-notify__status-mark">
                                                                    <svg class="card-notify__status-icon icon icon--attention">
                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-attention"></use>
                                                                    </svg>
                                                                </span>
                                                                <p class="card-notify__status-text">
                                                                    Ждет прочтения
                                                                </p>
                                                            </div>
                                                        </footer>

                                                    </div>
                                                </article>

                                            </li>
                                            <li class="cards-notify__item">

                                                <article class="card-notify card-notify--orange">
                                                    <a href="#" class="card-notify__link"></a>
                                                
                                                    <div class="card-notify__inner">
                                                    
                                                        <header class="card-notify__header">
                                                            <div class="card-notify__mark">
                                                                <svg class="card-notify__mark-icon icon icon--notification">
                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-notification"></use>
                                                                </svg>
                                                            </div>
                                                            <p class="card-notify__title">
                                                                Статус заявки изменился
                                                            </p>
                                                        </header>

                                                        <div class="card-notify__message">
                                                            <p class="card-notify__text">
                                                                Ваша заявка на смену наставника была рассмотрена и одобрена. Узнать информацию о своем новом наставнике, Вы можете в Профиле личного кабинета
                                                            </p>
                                                        </div>

                                                        <footer class="card-notify__footer">
                                                            <time class="card-notify__send" datetime="2022-07-27 13:24">
                                                                <span class="card-notify__send-status">Отправлено</span>
                                                                <span class="card-notify__send-date">27.07.2022</span>
                                                                <span class="card-notify__send-time">13:24</span>
                                                            </time>

                                                            <div class="card-notify__status">
                                                                <span class="card-notify__status-mark">
                                                                    <svg class="card-notify__status-icon icon icon--attention">
                                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-attention"></use>
                                                                    </svg>
                                                                </span>
                                                                <p class="card-notify__status-text">
                                                                    Ждет прочтения
                                                                </p>
                                                            </div>
                                                        </footer>

                                                    </div>
                                                </article>

                                            </li>
                                        </ul>

                                        <button type="button" class="notifications__button-more button button--full button--rounded button--covered button--white-green">
                                            Показать больше
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--Сменить наставника-->
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
                                                    <label for="selectTp" class="form__label form__label--required">
                                                        <span class="form__label-text">Тип обращения</span>
                                                    </label>
                                                </div>

                                                <div class="form__field-block form__field-block--input">
                                                    <div class="form__control">
                                                        <div class="select select--mitigate" data-select>
                                                            <select class="select__control" name="selectTp" id="selectTp" data-select-control data-placeholder="Выберите город" data-option>
                                                                <option><!-- пустой option для placeholder --></option>
                                                                <option value="1" data-variant="refund">Возврат заказа</option>
                                                                <option value="2" data-variant="nonfunctional">Неработающая функциональность</option>
                                                                <option value="3" data-variant="change"  selected>Смена наставника/контактного лица</option>
                                                                <option value="4" data-variant="personal">Смена персональных данных</option>
                                                                <option value="5" data-variant="other">Другое</option>
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
                        
                                                        <div class="dropzone__previews dropzone__previews--small dz-previews" data-uploader-previews>
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
                    <!--/Сменить наставника-->
                </main>
            </div>
        </div>
        <!--content-->

        <!--Футер-->
        <? include_once("../include/footer.php"); ?>
        <!--/Футер-->

        <script src="/local/templates/.default/js/script.js"></script>
    </body>

</html>
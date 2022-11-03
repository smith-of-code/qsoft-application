<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)  die();

use Bitrix\Main\Localization\Loc;

global $APPLICATION;
$APPLICATION->setTitle('Личный Кабинет');?>

<div class="profile">
    <?php if ($arResult['USER_INFO']['USER_GROUP_XML'] == 'BUYER'): ?>
        <div class="profile__consultant consultant box box--gray box--rounded-sm">
            <div class="consultant__col consultant__col--left">
                <p class="consultant__text">Стань консультантом и получи все привилегии <span class="consultant__text-accent">AmeБизнес</span></p>
            </div>
            <div class="consultant__col">
                <button type="button" class="consultant__button button button--medium button--rounded button--covered button--red">
                    <span class="button__icon">
                        <svg class="icon icon--crown">
                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-crown"></use>
                        </svg>
                    </span>
                    <span class="button__text">Стать консультантом</span>
                </button>
            </div>
        </div>
    <?php endif; ?>

    <h3 class="profile__title">Профиль</h3>

    <div class="accordeon">

        <!--Персональные данные-->
        <div
            id="personalData"
            class="profile__block"
            prop-user-info='<?=phpToVueObject($arResult['personal_data'])?>'
            prop-genders='<?=phpToVueObject($arResult['user_genders'])?>'
            prop-cities='<?=phpToVueObject($arResult['cities'])?>'
            prop-pickup-points='<?=phpToVueObject($arResult['pickup_points'])?>'
        ></div>
        <!--/Персональные данные-->

        <!--Юридические данные-->
        <div
            id="legalEntity"
            class="profile__block"
            prop-legal-entity='<?=phpToVueObject($arResult['legal_entity'])?>'
            prop-types='<?=phpToVueObject($arResult['legal_entity_types'])?>'
        ></div>
        <!--/Юридические данные-->

        <!--Данные о питомцах-->
        <div
            id="pets"
            class="profile__block"
            prop-pets='<?=phpToVueObject($arResult['pets'])?>'
            prop-genders='<?=phpToVueObject($arResult['pet_genders'])?>'
            prop-breeds='<?=phpToVueObject($arResult['pet_breeds'])?>'
            prop-kinds='<?=phpToVueObject($arResult['pet_kinds'])?>'
        ></div>
        <!--/Данные о питомцах-->

        <!--Наставник-->
        <?php $mentor = $arResult['MENTOR_INFO']; ?>
        <div class="profile__block" data-accordeon>
            <section class="section">
                <form class="form form--wraped form--separated" action="" method="post">
                    <div class="section__box box box--gray box--rounded-sm">
                        <div class="profile__accordeon-header accordeon__header section__header">
                            <h4 class="section__title section__title--closer">Наставник</h4>

                            <div class="profile__actions">
                                <button type="button"
                                        class="profile__actions-button profile__actions-button--edit button button--simple button--red"
                                        data-fancybox data-modal-type="modal"
                                        data-src="#technical-support"
                            >
                                    <span class="button__icon">
                                        <svg class="icon icon--repeat">
                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-repeat"></use>
                                        </svg>
                                    </span>
                                    <span class="button__text">Сменить наставника</span>
                                </button>

                                <button type="button" class="profile__actions-button profile__actions-button--toggle accordeon__toggle button button--circular button--mini button--covered button--red-white" data-accordeon-toggle>
                                    <span class="accordeon__toggle-icon button__icon">
                                        <svg class="icon icon--arrow-down">
                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-down"></use>
                                        </svg>
                                    </span>
                                </button>
                            </div>
                        </div>

                        <div class="profile__accordeon-body accordeon__body accordeon__body--closer" data-accordeon-content>
                            <div class="profile__actions profile__actions--mobile">
                                <button type="button" class="profile__actions-button button button--simple button--red" data-fancybox data-modal-type="modal"
                                data-src="#technical-support">
                                    <span class="button__icon">
                                        <svg class="icon icon--repeat">
                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-repeat"></use>
                                        </svg>
                                    </span>
                                    <span class="button__text">Сменить наставника</span>
                                </button>
                            </div>

                            <div class="section__wrapper">
                                <div class="profile__avatar">
                                    <div class="profile__avatar-box">
                                        <div class="profile__avatar-image">
                                            <img src="<?=$mentor['PERSONAL_PHOTO_URL']?>" alt="Персональное фото" class="profile__avatar-image-pic">
                                        </div>
                                    </div>

                                    <div class="profile__info">
                                        <span class="profile__id">ID <?=$mentor['ID']?></span>
                                    </div>
                                </div>

                                <div class="section__box-inner section__box-inner--full">
                                    <div class="section__box-content section__box-content--collapsed box box--white box--rounded-sm box--inner">
                                        <div class="section__box-block">
                                            <div class="form__row form__row--special">
                                                <div class="form__col">
                                                    <div class="form__field">
                                                        <div class="form__field-block form__field-block--label">
                                                            <label for="text-required" class="form__label">
                                                                <span class="form__label-text">Фамилия</span>
                                                            </label>
                                                        </div>

                                                        <div class="form__field-block form__field-block--input">
                                                            <div class="input">
                                                                <input type="text" class="input__control" value="<?=$mentor['LAST_NAME']?>" name="text-required" id="text-required" placeholder="Введите фамилию" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form__col">
                                                    <div class="form__field">
                                                        <div class="form__field-block form__field-block--label">
                                                            <label for="text-required" class="form__label">
                                                                <span class="form__label-text">Имя</span>
                                                            </label>
                                                        </div>

                                                        <div class="form__field-block form__field-block--input">
                                                            <div class="input">
                                                                <input type="text" value="<?=$mentor['NAME']?>" class="input__control" name="text-required" id="text-required" placeholder="Введите имя" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form__col">
                                                    <div class="form__field">
                                                        <div class="form__field-block form__field-block--label">
                                                            <label for="text-required" class="form__label">
                                                                <span class="form__label-text">Отчество</span>
                                                            </label>
                                                        </div>

                                                        <div class="form__field-block form__field-block--input">
                                                            <div class="input">
                                                                <input type="text" class="input__control" value="<?=$mentor['SECOND_NAME']?>" name="text-required" id="text-required" placeholder="Введите отчество" readonly>
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
                                                        <label for="text-required" class="form__label">
                                                            <span class="form__label-text">E-mail</span>
                                                        </label>
                                                    </div>

                                                    <div class="form__field-block form__field-block--input">
                                                        <div class="input">
                                                            <input type="text" class="input__control" value="<?=$mentor['EMAIL']?>" name="text-required" id="text-required" placeholder="example@email.com" data-mail inputmode="email" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form__col">
                                                <div class="form__field">
                                                    <div class="form__field-block form__field-block--label">
                                                        <label for="text-required" class="form__label">
                                                            <span class="form__label-text">Телефон</span>
                                                        </label>
                                                    </div>

                                                    <div class="form__field-block form__field-block--input">
                                                        <div class="input">
                                                            <input type="tel" class="input__control" name="text-required" value="<?=$mentor['PERSONAL_PHONE']?>" id="text-required" placeholder="+7 (___) ___-__-__" data-phone inputmode="text" readonly>
                                                        </div>
                                                    </div>

                                                    <button type="button" class="form__field-button button button--simple button--red button--underlined button--tiny">
                                                        Отправить проверочный код
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form__row">
                                            <div class="form__col">
                                                <div class="form__field">
                                                    <div class="form__field-block form__field-block--label">
                                                        <label for="select22" class="form__label">
                                                            <span class="form__label-text">Населенный пункт</span>
                                                        </label>
                                                    </div>

                                                    <div class="form__field-block form__field-block--input">
                                                        <div class="input">
                                                            <input type="text" class="input__control" value="<?=$mentor['PERSONAL_CITY']?>" name="text-required" id="select22" placeholder="Населенный пункт" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form__col">
                                                <div class="form__field">
                                                    <div class="form__field-block form__field-block--label">
                                                        <label for="select22" class="form__label">
                                                            <span class="form__label-text">Пункт выдачи заказов</span>
                                                        </label>
                                                    </div>

                                                    <div class="form__field-block form__field-block--input">
                                                        <div class="input">
                                                            <input type="text" class="input__control" value="<?=$arResult['SELECT_OPTIONS']['PICK_POINT'][$mentor['UF_PICKUP_POINT_ID']]?>" name="text-required" id="select22" placeholder="Пункт выдачи заказов" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </section>
        </div>
        <!--/Наставник-->

        <!--Система лояльности-->
        <div class="profile__block" data-accordeon>
            <section class="section">
                <div class="section__box box box--gray box--rounded-sm">
                    <div class="profile__accordeon-header accordeon__header section__header">
                        <h4 class="section__title section__title--closer">Система лояльности</h4>

                        <div class="profile__actions">
                            <div class="profile__period profile__period--desktop">
                                <span class="profile__period-icon">
                                    <svg class="icon icon--calendar">
                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-calendar"></use>
                                    </svg>
                                </span>
                                <span class="profile__period-text">II квартал 2022</span>
                            </div>

                            <button type="button" class="profile__actions-button profile__actions-button--toggle accordeon__toggle button button--circular button--mini button--covered button--red-white" data-accordeon-toggle>
                                <span class="accordeon__toggle-icon button__icon">
                                    <svg class="icon icon--arrow-down">
                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-down"></use>
                                    </svg>
                                </span>
                            </button>
                        </div>
                    </div>

                    <div class="profile__accordeon-body accordeon__body accordeon__body--closer" data-accordeon-content>
                        <div class="profile__actions profile__actions--mobile">
                            <div class="profile__period">
                                <span class="profile__period-icon">
                                    <svg class="icon icon--calendar">
                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-calendar"></use>
                                    </svg>
                                </span>
                                <span class="profile__period-text">II квартал 2022</span>
                            </div>
                        </div>
                        <div class="section__box-inner">
                            <h5 class="box__heading box__heading--middle">Достижения в системе лояльности</h5>

                            <div class="success-cards">
                                <div class="success-cards__item">
                                    <div class="success-card success-card--green">
                                        <span class="success-card__title heading heading--large"><?=$arResult['USER_INFO']['UF_LOYALTY_LEVEL_NAME']?></span>
                                        <span class="success-card__info">Уровень аккаунта</span>
                                    </div>
                                </div>

                                <div class="success-cards__item">
                                    <div class="success-card success-card--red">
                                        <span class="success-card__title heading heading--large">5%</span>
                                        <span class="success-card__info">Персональная скидка</span>
                                    </div>
                                </div>

                                <div class="success-cards__item">
                                    <div class="success-card success-card--violet">
                                        <span class="success-card__title heading heading--large">808</span>
                                        <span class="success-card__info">Сумма баллов за IV квартал 2022</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="section__box-inner">
                            <h5 class="box__heading box__heading--middle">Плановые показатели</h5>

                            <div class="cards-progress">
                                <ul class="cards-progress__list">
                                    <li class="cards-progress__item">
                                        <div class="card-progress card-progress--unbordered">
                                            <div class="card-progress__inner">
                                                <p class="card-progress__title">
                                                    Удержание уровня по личным покупкам
                                                </p>
                                                <div class="card-progress__mark">
                                                    <svg class="card-progress__icon icon icon--cat-serious">
                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-cat-serious"></use>
                                                    </svg>
                                                    <span class="card-progress__mark-text">
                                                        Осталось еще немного
                                                    </span>
                                                </div>
                                                <div class="card-progress__wrapper">
                                                    <div class="card-progress__progress progress-bar">
                                                        <div style="width: 80%;" class="progress-bar__filler progress-bar__filler--red"></div>
                                                    </div>
                                                    <div class="card-progress__bottom">
                                                        <div class="card-progress__amount amount">
                                                            <p class="amount__target amount__target--red">
                                                                124 000 ₽
                                                            </p>
                                                            <p class="amount__total">
                                                                из 175 000 ₽
                                                            </p>
                                                        </div>

                                                        <div class="card-progress__status">
                                                            <p class="card-progress__text">
                                                                Осталось 56 000 ₽
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-progress__warning warning">
                                                    <div class="warning__mark">
                                                        <button type="button"
                                                            class="button button--iconed button--simple button--red"
                                                            data-fancybox data-modal-type="modal"
                                                            data-src="#conditions"
                                                        >
                                                            <span class="button__icon">
                                                                <svg class="icon icon--basket warning__icon">
                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-attention"></use>
                                                                </svg>
                                                            </span>
                                                        </button>
                                                    </div>
                                                    <p class="warning__text">
                                                        Условия повышения уровня
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                    </li>
                                    <li class="cards-progress__item">
                                        <div class="card-progress card-progress--unbordered">
                                            <div class="card-progress__inner card-progress__inner--columed">
                                                <div class="card-progress__image">
                                                    <svg class="card-progress__image-pic icon icon--cat-cheerful">
                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-cat-cheerful"></use>
                                                    </svg>
                                                </div>

                                                <p class="card-progress__text">У Вас максимальный уровень</p>
                                            </div>
                                        </div>

                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="section__box-inner">
                            <h5 class="box__heading box__heading--middle">Преимущества аккаунтов разного уровня</h5>

                            <div class="accordeon accordeon--white">
                                <div class="accordeon__item box box--circle" data-accordeon>
                                    <div class="accordeon__header" data-accordeon-toggle>
                                        <div class="accordeon__header-col">
                                            <span class="accordeon__icon">
                                                <svg class="icon icon--cup">
                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-cup"></use>
                                                </svg>
                                            </span>
                                            <h5 class="accordeon__title">Преимущества аккаунта к1</h5>
                                        </div>

                                        <button type="button" class="accordeon__toggle button button--circular button--mini button--mixed button--gray-red">
                                            <span class="accordeon__toggle-icon button__icon">
                                                <svg class="icon icon--arrow-down">
                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-down"></use>
                                                </svg>
                                            </span>
                                        </button>
                                    </div>

                                    <div class="accordeon__body" data-accordeon-content>
                                        <div class="advantages">
                                            <ul class="advantages__list">
                                                <li class="advantages__item">
                                                    <div class="advantage">
                                                        <div class="advantage__icon">
                                                            <svg class="icon icon--tick-circle">
                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-tick-circle"></use>
                                                            </svg>
                                                        </div>

                                                        <div class="advantage__content">
                                                            <h6 class="advantage__title">1 бонусный балл за каждые полные 100 рублей личных покупок</h6>
                                                            <p class="advantage__subtitle">Скидка активна в течение 14 дней после регистрации</p>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li class="advantages__item">
                                                    <div class="advantage">
                                                        <div class="advantage__icon">
                                                            <svg class="icon icon--tick-circle">
                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-tick-circle"></use>
                                                            </svg>
                                                        </div>

                                                        <div class="advantage__content">
                                                            <h6 class="advantage__title">1 бонусный балл за каждые полные 100 рублей личных покупок</h6>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li class="advantages__item">
                                                    <div class="advantage">
                                                        <div class="advantage__icon">
                                                            <svg class="icon icon--tick-circle">
                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-tick-circle"></use>
                                                            </svg>
                                                        </div>

                                                        <div class="advantage__content">
                                                            <h6 class="advantage__title">100 бонусных баллов за каждого приглашенного Вами Консультанта</h6>
                                                            <p class="advantage__subtitle">После учета применяемых скидок к заказу с этим товаром</p>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li class="advantages__item">
                                                    <div class="advantage">
                                                        <div class="advantage__icon">
                                                            <svg class="icon icon--tick-circle">
                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-tick-circle"></use>
                                                            </svg>
                                                        </div>

                                                        <div class="advantage__content">
                                                            <h6 class="advantage__title">Скидка 7% на товары в каталоге</h6>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li class="advantages__item">
                                                    <div class="advantage">
                                                        <div class="advantage__icon">
                                                            <svg class="icon icon--tick-circle">
                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-tick-circle"></use>
                                                            </svg>
                                                        </div>

                                                        <div class="advantage__content">
                                                            <h6 class="advantage__title">2 бонусных балла за каждые полные 100 рублей от стоимости товара по Персональной акции</h6>
                                                            <p class="advantage__subtitle">После учета применяемых скидок к заказу с этим товаром</p>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li class="advantages__item">
                                                    <div class="advantage">
                                                        <div class="advantage__icon">
                                                            <svg class="icon icon--tick-circle">
                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-tick-circle"></use>
                                                            </svg>
                                                        </div>

                                                        <div class="advantage__content">
                                                            <h6 class="advantage__title">1 ББ за каждые полные 100 рублей покупок Вашей группы</h6>
                                                            <p class="advantage__subtitle">после учета применяемых скидок к заказу с этим товаром</p>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordeon__item box box--circle" data-accordeon>
                                    <div class="accordeon__header" data-accordeon-toggle>
                                        <div class="accordeon__header-col">
                                            <span class="accordeon__icon">
                                                <svg class="icon icon--cup">
                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-cup"></use>
                                                </svg>
                                            </span>
                                            <h5 class="accordeon__title">Преимущества аккаунта к2</h5>
                                        </div>

                                        <button type="button" class="accordeon__toggle button button--circular button--mini button--mixed button--gray-red">
                                            <span class="accordeon__toggle-icon button__icon">
                                                <svg class="icon icon--arrow-down">
                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-down"></use>
                                                </svg>
                                            </span>
                                        </button>
                                    </div>

                                    <div class="accordeon__body" data-accordeon-content>
                                        <div class="advantages">
                                            <ul class="advantages__list">
                                                <li class="advantages__item">
                                                    <div class="advantage">
                                                        <div class="advantage__icon">
                                                            <svg class="icon icon--tick-circle">
                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-tick-circle"></use>
                                                            </svg>
                                                        </div>

                                                        <div class="advantage__content">
                                                            <h6 class="advantage__title">1 бонусный балл за каждые полные 100 рублей личных покупок</h6>
                                                            <p class="advantage__subtitle">Скидка активна в течение 14 дней после регистрации</p>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li class="advantages__item">
                                                    <div class="advantage">
                                                        <div class="advantage__icon">
                                                            <svg class="icon icon--tick-circle">
                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-tick-circle"></use>
                                                            </svg>
                                                        </div>

                                                        <div class="advantage__content">
                                                            <h6 class="advantage__title">1 бонусный балл за каждые полные 100 рублей личных покупок</h6>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li class="advantages__item">
                                                    <div class="advantage">
                                                        <div class="advantage__icon">
                                                            <svg class="icon icon--tick-circle">
                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-tick-circle"></use>
                                                            </svg>
                                                        </div>

                                                        <div class="advantage__content">
                                                            <h6 class="advantage__title">100 бонусных баллов за каждого приглашенного Вами Консультанта</h6>
                                                            <p class="advantage__subtitle">После учета применяемых скидок к заказу с этим товаром</p>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li class="advantages__item">
                                                    <div class="advantage">
                                                        <div class="advantage__icon">
                                                            <svg class="icon icon--tick-circle">
                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-tick-circle"></use>
                                                            </svg>
                                                        </div>

                                                        <div class="advantage__content">
                                                            <h6 class="advantage__title">Скидка 7% на товары в каталоге</h6>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li class="advantages__item">
                                                    <div class="advantage">
                                                        <div class="advantage__icon">
                                                            <svg class="icon icon--tick-circle">
                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-tick-circle"></use>
                                                            </svg>
                                                        </div>

                                                        <div class="advantage__content">
                                                            <h6 class="advantage__title">2 бонусных балла за каждые полные 100 рублей от стоимости товара по Персональной акции</h6>
                                                            <p class="advantage__subtitle">После учета применяемых скидок к заказу с этим товаром</p>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li class="advantages__item">
                                                    <div class="advantage">
                                                        <div class="advantage__icon">
                                                            <svg class="icon icon--tick-circle">
                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-tick-circle"></use>
                                                            </svg>
                                                        </div>

                                                        <div class="advantage__content">
                                                            <h6 class="advantage__title">1 ББ за каждые полные 100 рублей покупок Вашей группы</h6>
                                                            <p class="advantage__subtitle">после учета применяемых скидок к заказу с этим товаром</p>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordeon__item box box--circle" data-accordeon>
                                    <div class="accordeon__header" data-accordeon-toggle>
                                        <div class="accordeon__header-col">
                                            <span class="accordeon__icon">
                                                <svg class="icon icon--cup">
                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-cup"></use>
                                                </svg>
                                            </span>
                                            <h5 class="accordeon__title">Преимущества аккаунта к3</h5>
                                        </div>

                                        <button type="button" class="accordeon__toggle button button button--circular button--mini button--mixed button--gray-red">
                                            <span class="accordeon__toggle-icon button__icon">
                                                <svg class="icon icon--arrow-down">
                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-down"></use>
                                                </svg>
                                            </span>
                                        </button>
                                    </div>

                                    <div class="accordeon__body" data-accordeon-content>
                                        <div class="advantages">
                                            <ul class="advantages__list">
                                                <li class="advantages__item">
                                                    <div class="advantage">
                                                        <div class="advantage__icon">
                                                            <svg class="icon icon--tick-circle">
                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-tick-circle"></use>
                                                            </svg>
                                                        </div>

                                                        <div class="advantage__content">
                                                            <h6 class="advantage__title">1 бонусный балл за каждые полные 100 рублей личных покупок</h6>
                                                            <p class="advantage__subtitle">Скидка активна в течение 14 дней после регистрации</p>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li class="advantages__item">
                                                    <div class="advantage">
                                                        <div class="advantage__icon">
                                                            <svg class="icon icon--tick-circle">
                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-tick-circle"></use>
                                                            </svg>
                                                        </div>

                                                        <div class="advantage__content">
                                                            <h6 class="advantage__title">1 бонусный балл за каждые полные 100 рублей личных покупок</h6>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li class="advantages__item">
                                                    <div class="advantage">
                                                        <div class="advantage__icon">
                                                            <svg class="icon icon--tick-circle">
                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-tick-circle"></use>
                                                            </svg>
                                                        </div>

                                                        <div class="advantage__content">
                                                            <h6 class="advantage__title">100 бонусных баллов за каждого приглашенного Вами Консультанта</h6>
                                                            <p class="advantage__subtitle">После учета применяемых скидок к заказу с этим товаром</p>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li class="advantages__item">
                                                    <div class="advantage">
                                                        <div class="advantage__icon">
                                                            <svg class="icon icon--tick-circle">
                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-tick-circle"></use>
                                                            </svg>
                                                        </div>

                                                        <div class="advantage__content">
                                                            <h6 class="advantage__title">Скидка 7% на товары в каталоге</h6>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li class="advantages__item">
                                                    <div class="advantage">
                                                        <div class="advantage__icon">
                                                            <svg class="icon icon--tick-circle">
                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-tick-circle"></use>
                                                            </svg>
                                                        </div>

                                                        <div class="advantage__content">
                                                            <h6 class="advantage__title">2 бонусных балла за каждые полные 100 рублей от стоимости товара по Персональной акции</h6>
                                                            <p class="advantage__subtitle">После учета применяемых скидок к заказу с этим товаром</p>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li class="advantages__item">
                                                    <div class="advantage">
                                                        <div class="advantage__icon">
                                                            <svg class="icon icon--tick-circle">
                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-tick-circle"></use>
                                                            </svg>
                                                        </div>

                                                        <div class="advantage__content">
                                                            <h6 class="advantage__title">1 ББ за каждые полные 100 рублей покупок Вашей группы</h6>
                                                            <p class="advantage__subtitle">после учета применяемых скидок к заказу с этим товаром</p>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!--/Система лояльности-->

        <!--Персональные акции-->
        <div class="profile__block" data-accordeon>
            <section class="section">
                <div class="section__box box box--gray box--rounded-sm">
                    <div class="profile__accordeon-header accordeon__header section__header">
                        <h4 class="section__title section__title--closer">Персональные акции</h4>

                        <div class="profile__actions">
                            <button type="button" class="profile__actions-button profile__actions-button--toggle accordeon__toggle button button--circular button--mini button--covered button--red-white" data-accordeon-toggle>
                                <span class="accordeon__toggle-icon button__icon">
                                    <svg class="icon icon--arrow-down">
                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-down"></use>
                                    </svg>
                                </span>
                            </button>
                        </div>
                    </div>

                    <div class="profile__accordeon-body accordeon__body accordeon__body--closer" data-accordeon-content>
                        <div class="section__box-inner">
                            <h5 class="box__heading box__heading--middle">Участие в персональной акции</h5>

                            <div class="profile__order box box--white box--circle">
                                <div class="profile__order-row">
                                    <div class="profile__order-col">
                                        <h5 class="profile__order-heading heading headding--small">
                                            Заказ от 02.08.2022
                                        </h5>
                                        <span class="profile__order-number">№543268</span>
                                    </div>

                                    <div class="profile__order-col">
                                        <div class="price">
                                            <div class="price__calculation price__calculation--columned">
                                                <p class="price__calculation-total">1 420 ₽</p>
                                                <p class="price__calculation-accumulation">14 ББ</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="section__box-inner">
                            <h5 class="box__heading box__heading--middle">Актуальные акции</h5>

                            <div class="profile__stocks cards-stock">
                                <ul class="cards-stock__list">
                                    <li class="cards-stock__item">
                                        <div class="card-stock">
                                            <a href="#" class="card-stock__link"></a>
                                            <div class="card-stock__inner">
                                                <div class="card-stock__top">
                                                    <div class="card-stock__wrapper">
                                                        <div class="card-stock__image box box--circle">
                                                            <img src="https://fakeimg.pl/366x312/" alt="#" class="card-stock__image-picture">
                                                        </div>
                                                        <div class="card-stock__finish date-finish">
                                                            <span class="date-finish__icon">
                                                                <svg class="date-finish__icon icon icon--clock">
                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-clock"></use>
                                                                </svg>
                                                            </span>
                                                            <span class="date-finish__text">
                                                                <span class="date-finish__text date-finish__text--desktop">
                                                                    Действует
                                                                </span>
                                                                до
                                                                <time datetime="2022-09-20">20.09.2022</time>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="card-stock__devider dots">
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                    </div>
                                                </div>
                                                <div class="card-stock__bottom">
                                                    <p class="card-stock__title">
                                                        Скидка 15%
                                                    </p>
                                                    <p class="card-stock__text">
                                                        На развивающие игрушки для кошек Complemento
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="cards-stock__item">
                                        <div class="card-stock">
                                            <a href="#" class="card-stock__link"></a>
                                            <div class="card-stock__inner">
                                                <div class="card-stock__top">
                                                    <div class="card-stock__wrapper">
                                                        <div class="card-stock__image box box--circle">
                                                            <img src="https://fakeimg.pl/366x312/" alt="#" class="card-stock__image-picture">
                                                        </div>
                                                        <div class="card-stock__finish date-finish">
                                                            <span class="date-finish__icon">
                                                                <svg class="date-finish__icon icon icon--clock">
                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-clock"></use>
                                                                </svg>
                                                            </span>
                                                            <span class="date-finish__text">
                                                                <span class="date-finish__text date-finish__text--desktop">
                                                                    Действует
                                                                </span>
                                                                до
                                                                <time datetime="2022-09-20">20.09.2022</time>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="card-stock__devider dots">
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                    </div>
                                                </div>
                                                <div class="card-stock__bottom">
                                                    <p class="card-stock__title">
                                                        Скидка 15%
                                                    </p>
                                                    <p class="card-stock__text">
                                                        На развивающие игрушки для кошек Complemento
                                                        На развивающие игрушки для кошек Complemento
                                                        На развивающие игрушки для кошек Complemento
                                                        На развивающие игрушки для кошек Complemento
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="cards-stock__item">
                                        <div class="card-stock">
                                            <a href="#" class="card-stock__link"></a>
                                            <div class="card-stock__inner">
                                                <div class="card-stock__top">
                                                    <div class="card-stock__wrapper">
                                                        <div class="card-stock__image box box--circle">
                                                            <img src="https://fakeimg.pl/366x312/" alt="#" class="card-stock__image-picture">
                                                        </div>
                                                        <div class="card-stock__finish date-finish">
                                                            <span class="date-finish__icon">
                                                                <svg class="date-finish__icon icon icon--clock">
                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-clock"></use>
                                                                </svg>
                                                            </span>
                                                            <span class="date-finish__text">
                                                                <span class="date-finish__text date-finish__text--desktop">
                                                                    Действует
                                                                </span>
                                                                до
                                                                <time datetime="2022-09-20">20.09.2022</time>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="card-stock__devider dots">
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                    </div>
                                                </div>
                                                <div class="card-stock__bottom">
                                                    <p class="card-stock__title">
                                                        Скидка 15%
                                                    </p>
                                                    <p class="card-stock__text">
                                                        На развивающие игрушки для кошек Complemento
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="cards-stock__item">
                                        <div class="card-stock">
                                            <a href="#" class="card-stock__link"></a>
                                            <div class="card-stock__inner">
                                                <div class="card-stock__top">
                                                    <div class="card-stock__wrapper">
                                                        <div class="card-stock__image box box--circle">
                                                            <img src="https://fakeimg.pl/366x312/" alt="#" class="card-stock__image-picture">
                                                        </div>
                                                        <div class="card-stock__finish date-finish">
                                                            <span class="date-finish__icon">
                                                                <svg class="date-finish__icon icon icon--clock">
                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-clock"></use>
                                                                </svg>
                                                            </span>
                                                            <span class="date-finish__text">
                                                                <span class="date-finish__text date-finish__text--desktop">
                                                                    Действует
                                                                </span>
                                                                до
                                                                <time datetime="2022-09-20">20.09.2022</time>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="card-stock__devider dots">
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                    </div>
                                                </div>
                                                <div class="card-stock__bottom">
                                                    <p class="card-stock__title">
                                                        Скидка 15%
                                                        Скидка 15%
                                                        Скидка 15%
                                                        Скидка 15%
                                                    </p>
                                                    <p class="card-stock__text">
                                                        На развивающие игрушки для кошек Complemento
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="cards-stock__item">
                                        <div class="card-stock">
                                            <a href="#" class="card-stock__link"></a>
                                            <div class="card-stock__inner">
                                                <div class="card-stock__top">
                                                    <div class="card-stock__wrapper">
                                                        <div class="card-stock__image box box--circle">
                                                            <img src="https://fakeimg.pl/366x312/" alt="#" class="card-stock__image-picture">
                                                        </div>
                                                        <div class="card-stock__finish date-finish">
                                                            <span class="date-finish__icon">
                                                                <svg class="date-finish__icon icon icon--clock">
                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-clock"></use>
                                                                </svg>
                                                            </span>
                                                            <span class="date-finish__text">
                                                                <span class="date-finish__text date-finish__text--desktop">
                                                                    Действует
                                                                </span>
                                                                до
                                                                <time datetime="2022-09-20">20.09.2022</time>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="card-stock__devider dots">
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                    </div>
                                                </div>
                                                <div class="card-stock__bottom">
                                                    <p class="card-stock__title">
                                                        Скидка 15%
                                                    </p>
                                                    <p class="card-stock__text">
                                                        На развивающие игрушки для кошек Complemento
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="cards-stock__item">
                                        <div class="card-stock">
                                            <a href="#" class="card-stock__link"></a>
                                            <div class="card-stock__inner">
                                                <div class="card-stock__top">
                                                    <div class="card-stock__wrapper">
                                                        <div class="card-stock__image box box--circle">
                                                            <img src="https://fakeimg.pl/366x312/" alt="#" class="card-stock__image-picture">
                                                        </div>
                                                        <div class="card-stock__finish date-finish">
                                                            <span class="date-finish__icon">
                                                                <svg class="date-finish__icon icon icon--clock">
                                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-clock"></use>
                                                                </svg>
                                                            </span>
                                                            <span class="date-finish__text">
                                                                <span class="date-finish__text date-finish__text--desktop">
                                                                    Действует
                                                                </span>
                                                                до
                                                                <time datetime="2022-09-20">20.09.2022</time>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="card-stock__devider dots">
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                        <span class="dots__item"></span>
                                                    </div>
                                                </div>
                                                <div class="card-stock__bottom">
                                                    <p class="card-stock__title">
                                                        Скидка 15%
                                                    </p>
                                                    <p class="card-stock__text">
                                                        На развивающие игрушки для кошек Complemento
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
        <!--/Персональные акции-->
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
                <!-- TODO: что за почта -->
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
<!--content-->























<div hidden>
<!-- // УДАЛИТЬ -->
<div><?=Loc::getMessage('SETTINGS_PERSONAL_INFO')?></div>
<?php if ($arResult['USER_GROUP'] == 'Покупатель') :?>
    <div style="background: grey; margin: 5px;">Становись консультантом</div>
<?php endif;?>
<div style="background: grey; margin: 5px;">
    Персональные данные
    <form action="" method="post" id="user_info" enctype="multipart/form-data">
        <div style="background: whitesmoke; margin:5px">
            Фамилия: <input type="text" name="LAST_NAME" value="<?=$arResult['USER_INFO']['LAST_NAME']?>" >
            Имя: <input type="text" name="NAME" value="<?=$arResult['USER_INFO']['NAME']?>" required>
            Отчество: <input type="text" name="SECOND_NAME" value="<?=$arResult['USER_INFO']['SECOND_NAME']?>"><br>
            Пол: <select name="PERSONAL_GENDER" value="<?=$arResult['USER_INFO']['PERSONAL_GENDER']?>">
                <?php foreach ($arResult['SELECT_OPTIONS']['USER_GENDER'] as $id => $value) : ?>
                    <option value="<?= $id ?>" class="form-control__option"
                        <?= ($id == $arResult['USER_INFO']['PERSONAL_GENDER']) ? 'selected' : '' ?>>
                        <?= $value ?>
                    </option>
                <?php endforeach;?>
            </select>
            Дата рождения: <input type="text" name="PERSONAL_BIRTHDAY" value="<?=$arResult['USER_INFO']['PERSONAL_BIRTHDAY']?>" required><br>
            Email: <input type="text" name="EMAIL" value="<?=$arResult['USER_INFO']['EMAIL']?>" required>
            Телефон: <input type="text" name="PERSONAL_PHONE" value="<?=$arResult['USER_INFO']['PERSONAL_PHONE']?>" ><br>
            Населенный пункт: <input type="text" name="PERSONAL_CITY" value="<?=$arResult['USER_INFO']['PERSONAL_CITY']?>" >
            Пункт выдачи заказов: <select name="UF_PICKUP_POINT_ID" value="<?=$arResult['USER_INFO']['UF_PICKUP_POINT_ID']?>">
                <?php foreach ($arResult['SELECT_OPTIONS']['PICK_POINT'] as $id => $value) : ?>
                    <option value="<?= $id ?>" class="form-control__option"
                        <?= ($id == $arResult['USER_INFO']['UF_PICKUP_POINT_ID']) ? 'selected' : '' ?>>
                        <?= $value ?>
                    </option>
                <?php endforeach;?>
            </select><br>
            Фото:
            <img src="<?=$arResult['USER_INFO']['PERSONAL_PHOTO_URL']?>"><br>
        </div>
        <button>Отменить изменения</button>
        <button style="background: darkgreen" type="submit" value="Y">Сохранить изменения</button>
    </form>
        <?=dump($arResult)?>
</div>


<?php if ($arResult['USER_GROUP'] == 'Консультант') :?>
    <div style="background: grey; margin: 5px;">
        Юридические данные<br>
        <form action="" method="post" id="legal_entity" enctype="multipart/form-data">
            Общее<br>
            <div style="background: whitesmoke; margin:5px">
                Статус и гражданство<br>
                Статус: <select name="UF_STATUS" value="<?=$arResult['LEGAL_ENTITY']['UF_STATUS']?>">
                    <?php foreach ($arResult['SELECT_OPTIONS']['STATUS'] as $id => $value) : ?>
                        <option value="<?= $id ?>" class="form-control__option"
                            <?= ($id == $arResult['LEGAL_ENTITY']['UF_STATUS']) ? 'selected' : '' ?>>
                            <?= $value ?>
                        </option>
                    <?php endforeach;?>
                </select><br>
                Гражданство: <input type="text" name="citizenship" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['citizenship']?>" required>
                Паспортные данные<br>
                Серия: <input type="text" name="passport.series" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['passport']['series']?>" required>
                Номер: <input type="text" name="passport.number" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['passport']['number']?>" required><br>
                Кем выдан: <input type="text" name="passport.issued" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['passport']['issued']?>" required>
                Когда выдан: <input type="text" name="passport.date" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['passport']['date']?>" required><br>
                Адрес регистрации<br>
                Населенный пункт: <input type="text" name="passport.addressRegistration.locality" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['passport']['addressRegistration']['locality']?>" required>
                Улица: <input type="text" name="passport.addressRegistration.street" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['passport']['addressRegistration']['street']?>" required><br>
                Дом: <input type="text" name="passport.addressRegistration.home" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['passport']['addressRegistration']['home']?>" required>
                Квартира: <input type="text" name="passport.addressRegistration.flat" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['passport']['addressRegistration']['flat']?>" required>
                Индекс: <input type="text" name="passport.addressRegistration.index" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['passport']['addressRegistration']['index']?>" required><br>
                Адрес проживания<br>
                Адрес регистрации совпадает с адресом фактического проживания
                <input type="checkbox" name="passport.addressRegistration.index" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['passport']['addressRegistration']['index']?>"><br>
                <?php if ($arResult['LEGAL_ENTITY']['DOCUMENTS']['passport']['addressFact'] != 'Y') :?>
                    Населенный пункт: <input type="text" name="passport.addressFact.locality" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['passport']['addressFact']['locality']?>" required>
                    Улица: <input type="text" name="passport.addressFact.street" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['passport']['addressFact']['street']?>" required><br>
                    Дом: <input type="text" name="passport.addressFact.home" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['passport']['addressFact']['home']?>" required>
                    Квартира: <input type="text" name="passport.addressFact.flat" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['passport']['addressFact']['flat']?>" required>
                    Индекс: <input type="text" name="passport.addressFact.index" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['passport']['addressFact']['index']?>" required><br>
                <?php endif;?>
                Копия паспорта<br>
                <?php foreach ($arResult['LEGAL_ENTITY']['DOCUMENTS']['passport']['copyPassport'] as $file) :?>
                Файл: <input type="text" name="passport.copyPassport" value="<?=$file?>" required> <br>
                <?php endforeach;?>
            </div>
            <?php if ($arResult['STATUS'] == "Самозанятый") :?>
                Самозанятый
                <div style="background: whitesmoke; margin:5px">
                    ИНН и копия свидетельства о постановке на учет в налоговом органе<br>
                    ИНН:<br><input type="text" name="inn" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['inn']?>" required>
                    <?php foreach ($arResult['LEGAL_ENTITY']['DOCUMENTS']['innFiles'] as $file) :?>
                        Файл: <input type="text" name="innFiles" value="<?=$file?>" required> <br>
                    <?php endforeach;?>
                    Банковские реквизиты<br>
                    Наименование банка:<input type="text" name="bank.name" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['bank']['name']?>" required>
                    БИК:<input type="text" name="bank.bik" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['bank']['bik']?>" required><br>
                    Расчетный счет:<input type="text" name="bank.rAccount" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['bank']['rAccount']?>" required>
                    Корреспондентский счет:<input type="text" name="bank.kAccount" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['bank']['kAccount']?>" required><br>
                    Сведения о банковских реквизитах<br>
                    <?php foreach ($arResult['LEGAL_ENTITY']['DOCUMENTS']['bank']['bankFiles'] as $file) :?>
                        Файл: <input type="text" name="bank.bankFiles" value="<?=$file?>" required> <br>
                    <?php endforeach;?>
                    Справка о постановке на учет физического лица в качестве плательщика налога на профессиональный доход<br>
                    <?php foreach ($arResult['LEGAL_ENTITY']['DOCUMENTS']['referenceFNS'] as $file) :?>
                        Файл: <input type="text" name="referenceFNS" value="<?=$file?>" required> <br>
                    <?php endforeach;?>
                </div>
            <?php elseif ($arResult['STATUS'] == "ИП") :?>
                Индивидуальный предприниматель
                <div style="background: whitesmoke; margin:5px">
                    Наименование ИП: <input type="text" name="name" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['name']?>" required>
                    ИНН: <input type="text" name="inn" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['inn']?>" required>
                    Плательщик НДС: <input type="checkbox" name="nds" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['nds']?>" required>
                    Копия свидетельства о постановке на учет в налоговом органе:
                    <?php foreach ($arResult['LEGAL_ENTITY']['DOCUMENTS']['referenceFNS'] as $file) :?>
                        Файл: <input type="text" name="referenceFNS" value="<?=$file?>" required> <br>
                    <?php endforeach;?>
                    <?php if ($arResult['LEGAL_ENTITY']['DOCUMENTS']['nds'] == "Да") :?>
                        “Уведомление о применении УСН упрощенной системы налогоплательщика”:
                        <?php foreach ($arResult['LEGAL_ENTITY']['DOCUMENTS']['usn'] as $file) :?>
                            Файл: <input type="text" name="usn" value="<?=$file?>" required> <br>
                        <?php endforeach;?>
                    <?php endif;?>
                    ОГРНИП: <input type="text" name="ogrnip" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['ogrnip']?>" required> <br>
                    “Свидетельство о государственной регистрации ИП/листа записи ЕГРИП”;
                    <?php foreach ($arResult['LEGAL_ENTITY']['DOCUMENTS']['egrip'] as $file) :?>
                        Файл: <input type="text" name="egrip" value="<?=$file?>" required> <br>
                    <?php endforeach;?>
                    Банковские реквизиты<br>
                    Наименование банка:<input type="text" name="bank.name" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['bank']['name']?>" required>
                    БИК:<input type="text" name="bank.bik" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['bank']['bik']?>" required><br>
                    Расчетный счет:<input type="text" name="bank.rAccount" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['bank']['rAccount']?>" required>
                    Корреспондентский счет:<input type="text" name="bank.kAccount" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['bank']['kAccount']?>" required><br>
                    Сведения о банковских реквизитах<br>
                    <?php foreach ($arResult['LEGAL_ENTITY']['DOCUMENTS']['bank']['bankFiles'] as $file) :?>
                        Файл: <input type="text" name="bank.bankFiles" value="<?=$file?>" required> <br>
                    <?php endforeach;?>
                    Справка о постановке на учет физического лица в качестве плательщика налога на профессиональный доход<br>
                    <?php foreach ($arResult['LEGAL_ENTITY']['DOCUMENTS']['referenceFNS'] as $file) :?>
                        Файл: <input type="text" name="referenceFNS" value="<?=$file?>" required> <br>
                    <?php endforeach;?>
                </div>
            <?php elseif ($arResult['STATUS'] == "ООО") :?>
                Общество с ограниченной ответственностью (ООО)
                <div style="background: whitesmoke; margin:5px">
                    Наименование организации (полное): <input type="text" name="name" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['name']?>" required>
                    Наименование организации (сокращенное): <input type="text" name="nameSmall" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['nameSmall']?>" required>
                    ОГРН: <input type="text" name="ogrn" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['ogrn']?>" required> <br>
                    ИНН: <input type="text" name="inn" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['inn']?>" required>
                    Плательщик НДС: <input type="checkbox" name="nds" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['nds']?>" required>
                    Копия свидетельства о постановке на учет российской организации в налоговом органе (ИНН)
                    <?php foreach ($arResult['LEGAL_ENTITY']['DOCUMENTS']['referenceFNS'] as $file) :?>
                        Файл: <input type="text" name="referenceFNS" value="<?=$file?>" required> <br>
                    <?php endforeach;?>
                    КПП: <input type="text" name="kpp" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['kpp']?>" required>
                    “Устав ООО”
                    <?php foreach ($arResult['LEGAL_ENTITY']['DOCUMENTS']['rule'] as $file) :?>
                        Файл: <input type="text" name="rule" value="<?=$file?>" required> <br>
                    <?php endforeach;?>
                    “Протокол участников (решения участника) ООО об избрании руководителя организации”;
                    <?php foreach ($arResult['LEGAL_ENTITY']['DOCUMENTS']['leader'] as $file) :?>
                        Файл: <input type="text" name="leader" value="<?=$file?>" required> <br>
                    <?php endforeach;?>
                    Приказ о вступлении в должность ген.директора: <input type="text" name="order" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['order']?>" required>
                    “Свидетельство о государственной регистрации ООО/листа записи ЕГРЮЛ о внесении записи об ООО в ЕГРЮЛ”
                    <?php foreach ($arResult['LEGAL_ENTITY']['DOCUMENTS']['egrul'] as $file) :?>
                        Файл: <input type="text" name="egrul" value="<?=$file?>" required> <br>
                    <?php endforeach;?>
                    Право подписи: “[У меня есть право подписи документов ООО”|“У меня нет права подписи документов ООО, я хотел бы добавить уполномоченное лицо]”
                    <input type="checkbox" name="rightToSign" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['rightToSign']?>" required>
                    <?php if ($arResult['LEGAL_ENTITY']['DOCUMENTS']['rightToSign'] != "Да") :?>
                        <?php foreach ($arResult['LEGAL_ENTITY']['DOCUMENTS']['rightToSign'] as $file) :?>
                            Файл: <input type="text" name="rightToSign" value="<?=$file?>" required> <br>
                        <?php endforeach;?>
                    <?endif;?>
                    Банковские реквизиты<br>
                    Наименование банка:<input type="text" name="bank.name" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['bank']['name']?>" required>
                    БИК:<input type="text" name="bank.bik" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['bank']['bik']?>" required><br>
                    Расчетный счет:<input type="text" name="bank.rAccount" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['bank']['rAccount']?>" required>
                    Корреспондентский счет:<input type="text" name="bank.kAccount" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['bank']['kAccount']?>" required><br>
                    Сведения о банковских реквизитах<br>
                    <?php foreach ($arResult['LEGAL_ENTITY']['DOCUMENTS']['bank']['bankFiles'] as $file) :?>
                        Файл: <input type="text" name="bank.bankFiles" value="<?=$file?>" required> <br>
                    <?php endforeach;?>
                    Адрес организации<br>
                    Населенный пункт: <input type="text" name="addressOrganization.locality" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['addressOrganization']['locality']?>" required>
                    Улица: <input type="text" name="addressOrganization.street" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['addressOrganization']['street']?>" required><br>
                    Дом, корпус, строение: <input type="text" name="addressOrganization.home" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['addressOrganization']['home']?>" required>
                    Этаж, помещение, комната: <input type="text" name="addressOrganization.flat" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['addressOrganization']['flat']?>" required>
                    Индекс: <input type="text" name="addressOrganization.index" value="<?=$arResult['LEGAL_ENTITY']['DOCUMENTS']['addressOrganization']['index']?>" required><br>
                </div>
            <?php endif;?>
            <button>Отменить изменения</button>
            <button style="background: darkgreen" type="submit" value="Y">Сохранить изменения</button>
        </form>
    </div>
<?php endif;?>

    <div style="background: grey; margin: 5px;">
        Данные о питомцах
        <ul data-pet-list>
        <?php $index = 0;?>
        <?php foreach ($arResult['PETS_INFO'] as $pet) : ?>
        <li data-pet-item id="<?=$pet['ID']?>">
            <form action="" id="pet_info">
                <div style="background: whitesmoke; margin:5px">
                    <div style="background: lightgrey; margin:5px">
                        Тип питомца:<select name="UF_KIND" id="UF_KIND-<?=$index?>" value="<?=$pet['UF_KIND']?>">
                                <?php foreach ($arResult['SELECT_OPTIONS']['PET_KIND'] as $id => $value) : ?>
                                    <option value="<?= $id ?>" class="form-control__option"
                                        <?= ($id == $pet['UF_KIND']) ? 'selected' : '' ?>>
                                        <?= $value ?>
                                    </option>
                                <?php endforeach;?>
                            </select>
                        Пол:<select name="UF_GENDER" id="UF_GENDER-<?=$index?>" value="<?=$pet['UF_GENDER']?>">
                                <?php foreach ($arResult['SELECT_OPTIONS']['PET_GENDER'] as $id => $value) : ?>
                                    <option value="<?= $id ?>" class="form-control__option"
                                        <?= ($id == $pet['UF_GENDER']) ? 'selected' : '' ?>>
                                        <?= $value ?>
                                    </option>
                                <?php endforeach;?>
                            </select>
                        Дата рождения: <input type="text" name="UF_BIRTHDATE" value="<?=$pet['UF_BIRTHDATE']?>" required><br>
                        Породы кошек:<select name="UF_CAT_BREED" id="UF_CAT_BREED-<?=$index?>" value="<?=$pet['UF_BREED']?>">
                            <?php foreach ($arResult['SELECT_OPTIONS']['CAT_BREED'] as $id => $value) : ?>
                                <option value="<?= $id ?>" class="form-control__option"
                                    <?= ($id == $pet['UF_BREED']) ? 'selected' : '' ?>>
                                    <?= $value ?>
                                </option>
                            <?php endforeach;?>
                        </select>
                        Породы собак:<select name="UF_DOG_BREED" id="UF_DOG_BREED-<?=$index?>" value="<?=$pet['UF_BREED']?>">
                            <?php foreach ($arResult['SELECT_OPTIONS']['DOG_BREED'] as $id => $value) : ?>
                                <option value="<?= $id ?>" class="form-control__option"
                                    <?= ($id == $pet['UF_BREED']) ? 'selected' : '' ?>>
                                    <?= $value ?>
                                </option>
                            <?php endforeach;?>
                        </select>
                        Кличка: <input type="text" name="UF_NAME" value="<?=$pet['UF_NAME']?>" required><br>
                    </div>
                    <button delete-pet>Удалить</button>
                    <button type="submit" style="background: darkgreen" save-pet>Сохранить</button>
                </div>
            </form>
        </li>
        <?php $index++;
        endforeach;?>
        </ul>
        <button add-pet>Добавить питомца</button>
    </div>
    <div style="background: grey; margin: 5px;">
        Контактные данные наставника
        <div style="background: whitesmoke; margin:5px">
            Фамилия: <input type="text" value="<?=$mentor['LAST_NAME']?>" required>
            Имя: <input type="text" value="<?=$mentor['NAME']?>" required>
            Отчество: <input type="text" value="<?=$mentor['SECOND_NAME']?>"><br>
            Email: <input type="text" value="<?=$mentor['EMAIL']?>" required>
            Телефон: <input type="text" value="<?=$mentor['PERSONAL_PHONE']?>" required><br>
            Населенный пункт: <input type="text" value="<?=$mentor['PERSONAL_CITY']?>" required>
            Пункт выдачи заказов: <input type="text" value="<?=$mentor['']?>" required><br>
            Фото: <img src="<?=$mentor['PERSONAL_PHOTO_URL']?>"><br>
        </div>
    </div>
<?php /* БЛОК СИСТЕМА ЛОЯЛЬНОСТИ */ ?>
    <div class="loyalty_container">
        <div style="background: grey; margin: 5px; width: 100%;">
            <span class="block_title"><?=Loc::getMessage('PROFILE_PAGE_LOYALTY_SYSTEM_TITLE')?></span>
            <span style="font-weight: bold;">
                <?=Loc::getMessage(
                    'PROFILE_PAGE_LOYALTY_SYSTEM_CURRENT_QUARTER',
                    [
                        '#QUARTER#' => \QSoft\Service\DateTimeService::getQuarterFormatted(),
                        '#YEAR#' => \Carbon\Carbon::now()->year
                    ]
                )?>
            </span>
        </div>
        <?php if (! empty($arResult['LOYALTY_INFO'])) :?>
            <?php if ($arResult['USER_GROUP'] == 'Консультант') :?>

                <?php /* БЛОК "ДОСТИЖЕНИЯ" */?>
                <div style="display: flex; flex-direction: row;">
                    <div style="display: flex; flex-direction: column; height: 100px; background-color: #daf5e8">
                        <div><?=$arResult['LOYALTY_INFO']['CURRENT_LEVEL']?></div>
                        <div><?=Loc::getMessage('PROFILE_PAGE_LOYALTY_SYSTEM_ACHIEVEMENTS_LEVEL')?></div>
                    </div>
                    <div style="display: flex; flex-direction: column; height: 100px; background-color: #fdd1d8">
                        <div><?=$arResult['LOYALTY_INFO']['PERSONAL_DISCOUNT'] . '%'?></div>
                        <div><?=Loc::getMessage('PROFILE_PAGE_LOYALTY_SYSTEM_ACHIEVEMENTS_DISCOUNT')?></div>
                    </div>
                    <div style="display: flex; flex-direction: column; height: 100px; background-color: #dccee2">
                        <div><?=$arResult['LOYALTY_INFO']['CURRENT_AMOUNT_OF_BONUSES']?></div>
                        <div>
                            <?=Loc::getMessage(
                                'PROFILE_PAGE_LOYALTY_SYSTEM_ACHIEVEMENTS_BONUSES',
                                [
                                    '#QUARTER#' => \QSoft\Service\DateTimeService::getQuarterFormatted(),
                                    '#YEAR#' => \Carbon\Carbon::now()->year
                                ]
                            )?>
                        </div>
                    </div>
                </div>
                <br>
                <?php /* БЛОК "ПЛАНОВЫЕ ПОКАЗАТЕЛИ" */ ?>
                <div style="display: flex; flex-direction: row;">

                    <?php /* КАРТОЧКА УСЛОВИЙ УДЕРЖАНИЯ УРОВНЯ */ ?>
                    <div style="display: flex; flex-direction: column; height: 150px; background-color: #daf5e8">
                        <div><?=Loc::getMessage('PROFILE_PAGE_LOYALTY_SYSTEM_PLAN_LEVEL_RETENTION_PERSONAL_PURCHASES')?></div>
                        <div>
                            <div>
                                <?=Loc::getMessage(
                                    'PROFILE_PAGE_LOYALTY_SYSTEM_PLAN_LEVEL_AMOUNT',
                                    [
                                            '#AMOUNT#' => $arResult['LOYALTY_INFO']['CURRENT_LEVEL_DETAILS']['PERSONAL_PURCHASES'],
                                    ]
                                )?>
                            </div>
                            <div>
                                <?=Loc::getMessage(
                                    'PROFILE_PAGE_LOYALTY_SYSTEM_PLAN_LEVEL_AMOUNT_PLAN',
                                    [
                                        '#AMOUNT#' => $arResult['LOYALTY_INFO']['CURRENT_LEVEL_DETAILS']['PERSONAL_PURCHASES_LIMIT'],
                                    ]
                                )?>
                            </div>
                            <?php if ($arResult['LOYALTY_INFO']['CURRENT_LEVEL_DETAILS']['PERSONAL_PURCHASES_LEFT'] > 0) : ?>
                            <div>
                                <?=Loc::getMessage(
                                    'PROFILE_PAGE_LOYALTY_SYSTEM_PLAN_LEVEL_LEFT',
                                    [
                                        '#AMOUNT#' => $arResult['LOYALTY_INFO']['CURRENT_LEVEL_DETAILS']['PERSONAL_PURCHASES_LEFT'],
                                    ]
                                )?>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div>
                            <?=Loc::getMessage('PROFILE_PAGE_LOYALTY_SYSTEM_PLAN_LEVEL_RETENTION_TERMS')?>
                            <div>
                            </div>
                        </div>
                    </div>

                    <?php /* КАРТОЧКА УСЛОВИЙ ПОВЫШЕНИЯ УРОВНЯ */ ?>
                    <?php if (isset($arResult['LOYALTY_INFO']['UPGRADE_LEVEL_DETAILS'])): ?>
                        <div style="display: flex; flex-direction: column; height: 150px; background-color: #fdd1d8">
                            <div><?=Loc::getMessage('PROFILE_PAGE_LOYALTY_SYSTEM_PLAN_LEVEL_ELEVATION_PERSONAL_PURCHASES')?></div>
                            <div>
                                <div>
                                    <?=Loc::getMessage(
                                        'PROFILE_PAGE_LOYALTY_SYSTEM_PLAN_LEVEL_AMOUNT',
                                        [
                                            '#AMOUNT#' => $arResult['LOYALTY_INFO']['UPGRADE_LEVEL_DETAILS']['PERSONAL_PURCHASES'],
                                        ]
                                    )?>
                                </div>
                                <div>
                                    <?=Loc::getMessage(
                                        'PROFILE_PAGE_LOYALTY_SYSTEM_PLAN_LEVEL_AMOUNT_PLAN',
                                        [
                                            '#AMOUNT#' => $arResult['LOYALTY_INFO']['UPGRADE_LEVEL_DETAILS']['PERSONAL_PURCHASES_LIMIT'],
                                        ]
                                    )?>
                                </div>
                                <?php if ($arResult['LOYALTY_INFO']['UPGRADE_LEVEL_DETAILS']['PERSONAL_PURCHASES_LEFT'] > 0) : ?>
                                <div>
                                    <?=Loc::getMessage(
                                        'PROFILE_PAGE_LOYALTY_SYSTEM_PLAN_LEVEL_LEFT',
                                        [
                                            '#AMOUNT#' => $arResult['LOYALTY_INFO']['UPGRADE_LEVEL_DETAILS']['PERSONAL_PURCHASES_LEFT'],
                                        ]
                                    )?>
                                </div>
                                <?php endif; ?>
                            </div>
                            <div>
                                <?=Loc::getMessage('PROFILE_PAGE_LOYALTY_SYSTEM_PLAN_LEVEL_ELEVATION_TERMS')?>
                                <div>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <?php /* Показываем карточку "Вами достигнут максимальный уровень"*/ ?>
                        <div>
                            <?=Loc::getMessage('PROFILE_PAGE_LOYALTY_SYSTEM_MAX_LEVEL_REACHED')?>
                        </div>
                    <?php endif; ?>

                </div>
                <br>
                <?php /* БЛОК "ПРЕИМУЩЕСТВА АККАУНТОВ РАЗНОГО УРОВНЯ" */ ?>
                <div style="display: flex; flex-direction: row;">
                </div>
            <?php elseif ($arResult['USER_GROUP'] == 'Покупатель') :?>

                <div style="display: flex; flex-direction: row;">
                    <?php /* КАРТОЧКА ПЕРСОНАЛЬНОЙ СКИДКИ */ ?>
                    <div style="display: flex; flex-direction: column; height: 150px; background-color: #d1ddfd">
                        <div><?=$arResult['LOYALTY_INFO']['PERSONAL_DISCOUNT'] . '%'?></div>
                        <div><?=Loc::getMessage('PROFILE_PAGE_LOYALTY_SYSTEM_ACHIEVEMENTS_DISCOUNT')?></div>
                    </div>

                    <?php /* КАРТОЧКА УСЛОВИЙ ПОВЫШЕНИЯ УРОВНЯ */ ?>
                    <div style="display: flex; flex-direction: column; height: 150px; background-color: #fdd1d8">
                        <?php if (isset($arResult['LOYALTY_INFO']['UPGRADE_LEVEL_DETAILS'])): ?>
                            <div><?=Loc::getMessage('PROFILE_PAGE_LOYALTY_SYSTEM_PLAN_DISCOUNT_ELEVATION')?></div>
                            <div>
                                <div>
                                    <?=Loc::getMessage(
                                        'PROFILE_PAGE_LOYALTY_SYSTEM_PLAN_LEVEL_AMOUNT',
                                        [
                                            '#AMOUNT#' => $arResult['LOYALTY_INFO']['UPGRADE_LEVEL_DETAILS']['PERSONAL_PURCHASES'],
                                        ]
                                    )?>
                                </div>
                                <div>
                                    <?=Loc::getMessage(
                                        'PROFILE_PAGE_LOYALTY_SYSTEM_PLAN_LEVEL_AMOUNT_PLAN',
                                        [
                                            '#AMOUNT#' => $arResult['LOYALTY_INFO']['UPGRADE_LEVEL_DETAILS']['PERSONAL_PURCHASES_LIMIT'],
                                        ]
                                    )?>
                                </div>
                                <?php if ($arResult['LOYALTY_INFO']['UPGRADE_LEVEL_DETAILS']['PERSONAL_PURCHASES_LEFT'] > 0) : ?>
                                    <div>
                                        <?=Loc::getMessage(
                                            'PROFILE_PAGE_LOYALTY_SYSTEM_PLAN_LEVEL_LEFT',
                                            [
                                                '#AMOUNT#' => $arResult['LOYALTY_INFO']['UPGRADE_LEVEL_DETAILS']['PERSONAL_PURCHASES_LEFT'],
                                            ]
                                        )?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div>
                                <?=Loc::getMessage('PROFILE_PAGE_LOYALTY_SYSTEM_PLAN_DISCOUNT_RETENTION_TERMS')?>
                                <div>
                                </div>
                            </div>
                        <?php else: ?>
                            <?php /* Показываем карточку "Вами достигнут максимальный уровень"*/ ?>
                            <div>
                                <?=Loc::getMessage('PROFILE_PAGE_LOYALTY_SYSTEM_MAX_LEVEL_REACHED')?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

            <?php endif;?>
        <?php else: ?>
            <div>
                <span class="error" style="background-color: #f5b0cc; color: white; font-weight: bold;">
                    <?=Loc::getMessage('PROFILE_PAGE_LOYALTY_SYSTEM_NOT_PARTICIPANT')?>
                </span>
            </div>
        <?php endif;?>
    </div>
    <div style="background: grey; margin: 5px;">Персональные акции</div>


<div data-kind-name-list class="is-hidden">
    <?php foreach ($arResult['SELECT_OPTIONS']['PET_KIND'] as $id => $value) : ?>
        <option value="<?= $id ?>" class="form-control__option"><?= $value ?></option>
    <?php endforeach;?>
</div>
<div data-gender-name-list class="is-hidden">
    <?php foreach ($arResult['SELECT_OPTIONS']['PET_GENDER'] as $id => $value) : ?>
        <option value="<?= $id ?>" class="form-control__option"><?= $value ?></option>
    <?php endforeach;?>
</div>
<div data-cat-name-list class="is-hidden">
    <?php foreach ($arResult['SELECT_OPTIONS']['CAT_BREED'] as $id => $value) : ?>
        <option value="<?= $id ?>" class="form-control__option"><?= $value ?></option>
    <?php endforeach;?>
</div>
<div data-dog-name-list class="is-hidden">
    <?php foreach ($arResult['SELECT_OPTIONS']['DOG_BREED'] as $id => $value) : ?>
        <option value="<?= $id ?>" class="form-control__option"><?= $value ?></option>
    <?php endforeach;?>
</div>
</div>

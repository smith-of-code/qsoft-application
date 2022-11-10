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
                                <span class="profile__period-text"><?=$arResult['current_accounting_period']['name']?></span>
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
                                <span class="profile__period-text"><?=$arResult['current_accounting_period']['name']?></span>
                            </div>
                        </div>
                        <div class="section__box-inner">
                            <h5 class="box__heading box__heading--middle">Достижения в системе лояльности</h5>

                            <div class="success-cards">
                                <div class="success-cards__item">
                                    <div class="success-card success-card--green">
                                        <span class="success-card__title heading heading--large"><?=$arResult['personal_data']['loyalty_level']?></span>
                                        <span class="success-card__info">Уровень аккаунта</span>
                                    </div>
                                </div>

                                <div class="success-cards__item">
                                    <div class="success-card success-card--red">
                                        <span class="success-card__title heading heading--large"><?=$arResult['loyalty_level_info']['benefits']['personal_discount']?>%</span>
                                        <span class="success-card__info">Персональная скидка</span>
                                    </div>
                                </div>

                                <div class="success-cards__item">
                                    <div class="success-card success-card--violet">
                                        <span class="success-card__title heading heading--large"><?=$arResult['orders_report']['current_period_bonuses']?></span>
                                        <span class="success-card__info">Сумма баллов за <?=$arResult['current_accounting_period']['name']?></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="section__box-inner">
                            <h5 class="box__heading box__heading--middle">Плановые показатели</h5>

                            <div class="cards-progress">
                                <ul class="cards-progress__list">
                                    <li class="cards-progress__item">
                                        <div
                                            id="loyaltyStatusReport"
                                            prop-current-value="<?=$arResult['loyalty_status']['self']['current_value']?>"
                                            prop-target-value="<?=$arResult['loyalty_status']['self']['hold_value']?>"
                                        ></div>
                                    </li>
                                    <li class="cards-progress__item">
                                        <div
                                            id="loyaltyStatusReport"
                                            prop-current-value="<?=$arResult['loyalty_status']['self']['current_value']?>"
                                            prop-target-value="<?=$arResult['loyalty_status']['self']['upgrade_value']?>"
                                        ></div>
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

                            <?php foreach ($arResult['promotion_orders'] as $order):?>
                                <div class="profile__order box box--white box--circle">
                                    <div class="profile__order-row">
                                        <div class="profile__order-col">
                                            <h5 class="profile__order-heading heading headding--small">
                                                Заказ от <?=$order['date_insert']->format('d.m.Y')?>
                                            </h5>
                                            <span class="profile__order-number">№<?=$order['account_number']?></span>
                                        </div>

                                        <div class="profile__order-col">
                                            <div class="price">
                                                <div class="price__calculation price__calculation--columned">
                                                    <p class="price__calculation-total"><?=SaleFormatCurrency($order['price'], 'RUB')?></p>
                                                    <p class="price__calculation-accumulation"><?=SaleFormatCurrency($order['bonuses'], 'RUB', true)?> ББ</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach;?>
                        </div>

                        <div class="section__box-inner">
                            <h5 class="box__heading box__heading--middle">Актуальные акции</h5>

                            <div class="profile__stocks cards-stock">
                                <ul class="cards-stock__list">
                                    <?php foreach ($arResult['personal_promotions'] as $promotion):?>
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
                                                                <time datetime="<?=$promotion['active_to']->format('Y-m-d')?>"><?=$promotion['active_to']->format('d.m.Y')?></time>
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
                                                            <?=$promotion['name']?>
                                                        </p>
                                                        <p class="card-stock__text">
                                                            <!-- TODO Description -->
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    <?php endforeach;?>
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

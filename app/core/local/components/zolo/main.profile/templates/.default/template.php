<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)  die();
/**
 * @var $APPLICATION
 * @var $arResult
 */
use Bitrix\Main\Localization\Loc;

global $APPLICATION;
$APPLICATION->setTitle('Личный Кабинет');?>

<div class="profile">
    <?php if (! $arResult['personal_data']['is_consultant']): ?>
        <div class="profile__consultant consultant box box--gray box--rounded-sm">
            <div class="consultant__col consultant__col--left">
                <p class="consultant__text">Стань консультантом и получи все привилегии <span class="consultant__text-accent">AmeБизнес</span></p>
            </div>
            <div class="consultant__col">
                <a href="/become_consultant/" class="consultant__button button button--medium button--rounded button--covered button--red">
                    <span class="button__icon">
                        <svg class="icon icon--crown">
                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-crown"></use>
                        </svg>
                    </span>
                    <span class="button__text">Стать консультантом</span>
                </a>
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
        >
            <div class="profile__block" data-accordeon data-profile-block>
                <section class="section">
                    <form class="form form--wraped form--separated" action="" method="post" data-profile-form data-validation="profile">
                        <div class="section__box box box--gray box--rounded-sm">
                            <div class="profile__accordeon-header accordeon__header section__header">
                                <h4 class="section__title section__title--closer">Персональные данные</h4>

                                <div class="profile__actions">
                                    <button type="button" class="profile__actions-button profile__actions-button--edit profile__actions-button--edit-personal button button--simple button--red" data-profile-edit>
                                        <span class="button__icon">
                                            <svg class="icon icon--edit">
                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-edit"></use>
                                            </svg>
                                        </span>
                                        <span class="button__text">Редактировать</span>
                                    </button>

                                    <button type="button" class="profile__actions-button profile__actions-button--toggle accordeon__toggle button button--circular button--mini button--covered button--red-white" data-accordeon-toggle >
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
                                    <button type="button" class="profile__actions-button button button--simple button--red" data-profile-edit>
                                        <span class="button__icon">
                                            <svg class="icon icon--edit">
                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-edit"></use>
                                            </svg>
                                        </span>
                                        <span class="button__text">Редактировать</span>
                                    </button>
                                </div>

                                <div class="section__wrapper">
                                    <div class="profile__avatar">
                                        <div class="profile__avatar-box">
                                            <div class="profile__avatar-image">
                                                <?php if ($arResult['personal_data']['photo']):?>
                                                    <img src="<?=$arResult['personal_data']['photo']?>" alt="Персональное фото" class="profile__avatar-image-pic">
                                                <?php else:?>
                                                    <svg class="dropzone__message-button-icon icon icon--camera">
                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-camera"></use>
                                                    </svg>
                                                <?php endif;?>
                                            </div>
                                        </div>

                                        <!--dropzone-->
                                        <div class="profile__dropzone dropzone dropzone--image dropzone--simple" data-uploader>
                                            <input type="file" name="uploadFiles[]" multiple class="dropzone__control js-required">

                                            <div class="dropzone__area" data-uploader-area='{"paramName": "uploadFiles[]", "url":"/_markup/gui.php", "images": true, "single": true, "acceptedFiles": ".jpg, .jpeg, .png"}'>
                                                <div class="dropzone__message dropzone__message--simple dz-message needsclick">
                                                    <div class="dropzone__message-button dz-button link needsclick" data-uploader-previews>
                                                        <?php if ($arResult['personal_data']['photo']):?>
                                                            <img src="<?=$arResult['personal_data']['photo']?>" alt="Персональное фото" class="profile__avatar-image-pic">
                                                        <?php else:?>
                                                            <svg class="dropzone__message-button-icon icon icon--camera">
                                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-camera"></use>
                                                            </svg>
                                                        <?php endif;?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/dropzone-->
                                        <div class="profile__info">
                                            <span class="profile__level">Уровень <?=$arResult['personal_data']['loyalty_level']?></span>
                                            <span class="profile__id">ID <?=$arResult['personal_data']['id']?></span>
                                        </div>
                                    </div>

                                    <div class="section__box-inner section__box-inner--full">
                                        <div class="section__box-content section__box-content--collapsed box box--white box--rounded-sm box--inner" data-identic data-validate-dependent>
                                            <div class="form__row form__row--special">
                                                <div class="form__col">
                                                    <div class="form__field">
                                                        <div class="form__field-block form__field-block--label">
                                                            <label for="text-required" class="profile__label form__label form__label--required">
                                                                <span class="form__label-text">Фамилия</span>
                                                            </label>
                                                        </div>

                                                        <div class="form__field-block form__field-block--input">
                                                            <div class="input">
                                                                <input type="text" value="<?=$arResult['personal_data']['last_name']?>" class="input__control js-required" name="text-required3213" id="text-required" placeholder="Введите фамилию" readonly data-profile-readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form__col">
                                                    <div class="form__field">
                                                        <div class="form__field-block form__field-block--label">
                                                            <label for="text-required" class="profile__label form__label form__label--required">
                                                                <span class="form__label-text">Имя</span>
                                                            </label>
                                                        </div>

                                                        <div class="form__field-block form__field-block--input">
                                                            <div class="input">
                                                                <input type="text" value="<?=$arResult['personal_data']['first_name']?>" class="input__control js-required" name="text-required13123" id="text-required" placeholder="Введите имя" readonly data-profile-readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form__col">
                                                    <div class="form__field">
                                                        <div class="form__field-block form__field-block--label">
                                                            <label for="text-required" class="profile__label form__label form__label--required">
                                                                <span class="form__label-text">Отчество</span>
                                                            </label>
                                                        </div>

                                                        <div class="form__field-block form__field-block--input">
                                                            <div class="input">
                                                                <input type="text" value="<?=$arResult['personal_data']['second_name']?>" class="input__control js-required-dependent" name="text-required112" id="text-required112" placeholder="Введите отчество" readonly data-profile-readonly data-identic-input>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form__row">
                                                <div class="form__col">
                                                    <div class="form__field">
                                                        <div class="form__field-block form__field-block--label">
                                                            <label for="select33" class="profile__label form__label form__label--required">
                                                                <span class="form__label-text">Пол</span>
                                                            </label>
                                                        </div>

                                                        <div class="form__field-block form__field-block--input">
                                                            <div class="input">
                                                                <input type="text" value="<?=$arResult['user_genders'][$arResult['personal_data']['gender']]['name']?>" class="input__control js-required" name="text-required3213" id="text-required" placeholder="Введите фамилию" readonly data-profile-readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form__col">
                                                    <div class="form__field">
                                                        <div class="form__field-block form__field-block--label">
                                                            <label for="birthdate" class="profile__label form__label form__label--required">
                                                                <span class="form__label-text">Дата рождения</span>
                                                            </label>
                                                        </div>

                                                        <div class="form__field-block form__field-block--input">
                                                            <div class="input input--iconed">
                                                                <input inputmode="numeric"
                                                                       class="input__control js-required js-date"
                                                                       name="text13"
                                                                       id="birthdate"
                                                                       placeholder="ДД.ММ.ГГГГ"
                                                                       data-mask-date-reg
                                                                       readonly data-profile-readonly
                                                                       value="<?=$arResult['personal_data']['birthdate']?>"
                                                                       autocomplete="off"
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
                                                            <label for="text-required" class="profile__label form__label form__label--required">
                                                                <span class="form__label-text">E-mail</span>
                                                            </label>
                                                        </div>

                                                        <div class="form__field-block form__field-block--input">
                                                            <div class="input">
                                                                <input type="text" class="input__control js-required js-email" name="text-required1233" value="<?=$arResult['personal_data']['email']?>" id="text-required" placeholder="example@email.com" data-mail inputmode="email"  readonly data-profile-readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form__col">
                                                    <div class="form__field">
                                                        <div class="form__field-block form__field-block--label">
                                                            <label for="text-required" class="profile__label form__label form__label--required">
                                                                <span class="form__label-text">Телефон</span>
                                                            </label>
                                                        </div>

                                                        <div class="form__field-block form__field-block--input">
                                                            <div class="input">
                                                                <input type="tel" class="input__control js-required" name="text-required31133" value="<?=$arResult['personal_data']['phone']?>" id="text-required234324" placeholder="+7 (___) ___-__-__" data-phone inputmode="text"  readonly data-profile-readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form__row">
                                                <div class="form__col">
                                                    <div class="form__field">
                                                        <div class="form__field-block form__field-block--label">
                                                            <label for="select22" class="profile__label form__label form__label--required">
                                                                <span class="form__label-text">Населенный пункт</span>
                                                            </label>
                                                        </div>

                                                        <div class="form__field-block form__field-block--input">
                                                            <div class="input">
                                                                <input type="text" value="<?=$arResult['personal_data']['city']?>" class="input__control js-required" name="text-required3213" id="text-required" placeholder="Введите фамилию" readonly data-profile-readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form__col">
                                                    <div class="form__field">
                                                        <div class="form__field-block form__field-block--label">
                                                            <label for="select22" class="profile__label form__label form__label--required">
                                                                <span class="form__label-text">Пункт выдачи заказов</span>
                                                            </label>
                                                        </div>

                                                        <div class="form__field-block form__field-block--input">
                                                            <div class="input">
                                                                <input type="text" value="<?=$arResult['pickup_points'][array_first(array_filter($arResult['cities'], fn ($x) => $x['name'] === $arResult['personal_data']['city']))['id']][$arResult['personal_data']['pickup_point_id']]['name']?>" class="input__control js-required" name="text-required3213" id="text-required" placeholder="Введите фамилию" readonly data-profile-readonly>
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
        </div>
        <!--/Персональные данные-->

        <!--Юридические данные-->
        <?php if ($arResult['personal_data']['is_consultant']): ?>
            <div
                id="legalEntity"
                class="profile__block"
                prop-legal-entity='<?=phpToVueObject($arResult['legal_entity'])?>'
                prop-types='<?=phpToVueObject($arResult['legal_entity_types'])?>'
            >
                <div class="profile__block">
                    <div class="profile__block legal_entity_block" data-accordeon>
                        <section class="section">
                            <div class="form form--wraped form--separated">
                                <div class="section__box box box--gray box--rounded-sm">
                                    <div class="profile__accordeon-header accordeon__header section__header">
                                        <h4 class="section__title section__title--closer">Юридические данные</h4>
                                        <div class="profile__actions">
                                            <button type="button" class="profile__actions-button profile__actions-button--edit button button--simple button--red">
                                                <span class="button__icon">
                                                    <svg class="icon icon--edit">
                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-edit"></use>
                                                    </svg>
                                                </span>
                                                <span class="button__text">Редактировать</span>
                                            </button>
                                            <button
                                                type="button"
                                                class="profile__actions-button accordeon__toggle button button--circular button--mini button--covered button--red-white"
                                                data-accordeon-toggle
                                            >
                                                <span class="accordeon__toggle-icon button__icon">
                                                    <svg class="icon icon--arrow-down">
                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-down"></use>
                                                    </svg>
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <!--/Юридические данные-->

        <!--Данные о питомцах-->
        <div
            id="pets"
            class="profile__block"
            prop-pets='<?=phpToVueObject($arResult['pets'])?>'
            prop-genders='<?=phpToVueObject($arResult['pet_genders'])?>'
            prop-breeds='<?=phpToVueObject($arResult['pet_breeds'])?>'
            prop-kinds='<?=phpToVueObject($arResult['pet_kinds'])?>'
        >
            <div class="profile__block">
                <div class="profile__block" data-accordeon>
                    <div class="section__box box box--gray box--rounded">
                        <div class="profile__accordeon-header accordeon__header section__header">
                            <h4 class="section__title section__title--closer">Данные о питомцах</h4>
                            <div class="profile__actions">
                                <button
                                    type="button"
                                    class="profile__actions-button profile__actions-button--toggle accordeon__toggle button button--circular button--mini button--covered button--red-white"
                                    data-accordeon-toggle
                                >
                                    <span class="accordeon__toggle-icon button__icon">
                                        <svg class="icon icon--arrow-down">
                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-arrow-down"></use>
                                        </svg>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/Данные о питомцах-->

        <!--Наставник-->
        <?php $mentor = $arResult['MENTOR_INFO']; ?>
        <?php if ($mentor):?>
            <div class="profile__block accordeon__item" data-accordeon>
                <section class="section">
                    <form class="form form--wraped form--separated" action="" method="post">
                        <div class="section__box box box--gray box--rounded-sm">
                            <div class="profile__accordeon-header accordeon__header section__header">
                                <?php if ($arResult['personal_data']['is_consultant']):?>
                                    <h4 class="section__title section__title--closer">Наставник</h4>
                                <?php else:?>
                                    <h4 class="section__title section__title--closer">Контактное лицо</h4>
                                <?php endif;?>
                                <div class="profile__actions">
<!--                                    <a-->
<!--                                        class="profile__actions-button profile__actions-button--edit profile__actions-button--edit-mentor button button--simple button--red"-->
<!--                                        data-fancybox data-modal-type="modal"-->
<!--                                        href="javascript:" data-type="ajax" data-src="/ajax/popup/popup-support.php" data-selected="CHANGE_MENTOR"-->
<!--                                    >-->
<!--                                        <span class="button__icon">-->
<!--                                            <svg class="icon icon--repeat">-->
<!--                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-repeat"></use>-->
<!--                                            </svg>-->
<!--                                        </span>-->
<!--                                        <span class="button__text">Сменить наставника</span>-->
<!--                                    </a>-->

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
<!--                                    <a type="button" class="profile__actions-button button button--simple button--red" data-fancybox data-modal-type="modal"-->
<!--                                    href="javascript:" data-type="ajax" data-src="/ajax/popup/popup-support.php" data-selected="CHANGE_MENTOR">-->
<!--                                        <span class="button__icon">-->
<!--                                            <svg class="icon icon--repeat">-->
<!--                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-repeat"></use>-->
<!--                                            </svg>-->
<!--                                        </span>-->
<!--                                        <span class="button__text">Сменить наставника</span>-->
<!--                                    </a>-->
                                </div>

                                <div class="section__wrapper">
                                    <div class="profile__avatar">
                                        <div class="profile__avatar-box">
                                            <div class="profile__avatar-image">
                                                <?php if ($mentor['PERSONAL_PHOTO_URL']):?>
                                                    <img src="<?=$mentor['PERSONAL_PHOTO_URL']?>" alt="Персональное фото" class="profile__avatar-image-pic">
                                                <?php else:?>
                                                    <svg class="dropzone__message-button-icon icon icon--camera">
                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-camera"></use>
                                                    </svg>
                                                <?php endif;?>
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
                                                                    <input type="text" class="input__control" value="<?=$mentor['LAST_NAME']?>" name="text-required" id="text-required" placeholder="Введите фамилию" readonly data-replace-input="text">
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
                                                                    <input type="text" value="<?=$mentor['NAME']?>" class="input__control" name="text-required" id="text-required" placeholder="Введите имя" readonly data-replace-input="text">
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
                                                                    <input type="text" class="input__control" value="<?=$mentor['SECOND_NAME']?>" name="text-required" id="text-required" placeholder="Введите отчество" readonly data-replace-input="text">
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
                                                                    <input type="text" class="input__control" value="<?=$arResult['pickup_points'][array_first(array_filter($arResult['cities'], fn ($x) => $x['name'] === $arResult['personal_data']['city']))['id']][$mentor['UF_PICKUP_POINT_ID']]['name']?>" name="text-required" id="select22" placeholder="Пункт выдачи заказов" readonly>
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
                        </div>
                    </form>
                </section>
            </div>
        <?php endif;?>
        <!--/Наставник-->

        <!--Система лояльности-->
        <div class="profile__block accordeon__item" data-accordeon>
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

                        <?php if ($arResult['personal_data']['is_consultant']):?>

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
                                            <span class="success-card__title heading heading--large"><?=$arResult['orders_report']['self']['current_period_bonuses']?></span>
                                            <span class="success-card__info">Сумма баллов за <?=$arResult['current_accounting_period']['name']?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="section__box-inner">
                                <h5 class="box__heading box__heading--middle">Плановые показатели</h5>

                                <div class="cards-progress">
                                    <div class="participant__progress cards-progress">
                                        <ul class="cards-progress__list">
                                            <?php if ($arResult['loyalty_status']['self']['hold_value']):?>
                                                <li class="cards-progress__item">
                                                    <div
                                                            id="loyaltyStatusTale"
                                                            prop-current-value="<?=$arResult['loyalty_status']['self']['current_value']?>"
                                                            prop-target-value="<?=$arResult['loyalty_status']['self']['hold_value']?>"
                                                            prop-label="Поддержание уровня по личным покупкам"
                                                    ></div>
                                                </li>
                                            <?php endif;?>
                                            <li class="cards-progress__item">
                                                <div
                                                        id="loyaltyStatusTale"
                                                        prop-current-value="<?=$arResult['loyalty_status']['self']['current_value']?>"
                                                        prop-target-value="<?=$arResult['loyalty_status']['self']['upgrade_value']?>"
                                                        prop-label="Повышение уровня по личным покупкам"
                                                        prop-is-hold="<?=json_encode(false)?>"
                                                ></div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="section__box-inner">
                                <h5 class="box__heading box__heading--middle">Преимущества аккаунтов разного уровня</h5>

                                <div class="accordeon accordeon--white">
                                    <div class="accordeon__item box box--circle" data-accordeon data-accordeon-toggle>
                                        <div class="accordeon__header">
                                            <div class="accordeon__header-col">
                                            <span class="accordeon__icon">
                                                <svg class="icon icon--cup">
                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-cup"></use>
                                                </svg>
                                            </span>
                                                <h5 class="accordeon__title">Преимущества аккаунта K1</h5>
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
                                                                <h6 class="advantage__title">Персональная скидка на Стартовый набор Консультанта</h6>
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
                                                                <h6 class="advantage__title"><?=$arResult['LL']['K1']['benefits']['personal_bonuses_for_cost']['size']?> бонусный балл за каждые полные <?=$arResult['LL']['K1']['benefits']['personal_bonuses_for_cost']['step']?> рублей личных покупок</h6>
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
                                                                <h6 class="advantage__title"><?=$arResult['LL']['K1']['benefits']['referral_size']?> бонусных баллов за каждого приглашенного Вами Консультанта</h6>
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
                                                                <h6 class="advantage__title">Скидка <?=$arResult['LL']['K1']['benefits']['personal_discount']?>% на товары в каталоге</h6>
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
                                                                <h6 class="advantage__title"><?=$arResult['LL']['K1']['benefits']['personal_bonuses_for_stock']['size']?> бонусных балла за каждые полные <?=$arResult['LL']['K1']['benefits']['personal_bonuses_for_stock']['step']?> рублей от стоимости товара по Персональной акции</h6>
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
                                                                <h6 class="advantage__title"><?=$arResult['LL']['K1']['benefits']['group_bonuses_for_cost']['size']?> бонусный балл за каждые полные <?=$arResult['LL']['K1']['benefits']['group_bonuses_for_cost']['step']?> рублей покупок Вашей группы</h6>
                                                                <p class="advantage__subtitle">После учета применяемых скидок к заказу с этим товаром</p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordeon__item box box--circle" data-accordeon data-accordeon-toggle>
                                        <div class="accordeon__header">
                                            <div class="accordeon__header-col">
                                            <span class="accordeon__icon">
                                                <svg class="icon icon--cup">
                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-cup"></use>
                                                </svg>
                                            </span>
                                                <h5 class="accordeon__title">Преимущества аккаунта K2</h5>
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
                                                                <h6 class="advantage__title"><?=$arResult['LL']['K2']['benefits']['personal_bonuses_for_cost']['size']?> бонусных балла за каждые полные <?=$arResult['LL']['K2']['benefits']['personal_bonuses_for_cost']['step']?> рублей личных покупок</h6>
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
                                                                <h6 class="advantage__title"><?=$arResult['LL']['K2']['benefits']['referral_size']?> бонусных баллов за каждого приглашенного Вами Консультанта</h6>
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
                                                                <h6 class="advantage__title">Скидка <?=$arResult['LL']['K2']['benefits']['personal_discount']?>% на товары в каталоге</h6>
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
                                                                <h6 class="advantage__title"><?=$arResult['LL']['K2']['benefits']['personal_bonuses_for_stock']['size']?> бонусных балла за каждые полные <?=$arResult['LL']['K2']['benefits']['personal_bonuses_for_stock']['step']?> рублей от стоимости товара по Персональной акции</h6>
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
                                                                <h6 class="advantage__title"><?=$arResult['LL']['K2']['benefits']['group_bonuses_for_cost']['size']?> бонусных балла за каждые полные <?=$arResult['LL']['K2']['benefits']['group_bonuses_for_cost']['step']?> рублей покупок Вашей группы</h6>
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
                                                                <h6 class="advantage__title"><?=$arResult['LL']['K2']['benefits']['upgrade_level_bonuses']?> бонусных баллов за переход с уровня K1 на уровень K2</h6>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordeon__item box box--circle" data-accordeon data-accordeon-toggle>
                                        <div class="accordeon__header">
                                            <div class="accordeon__header-col">
                                            <span class="accordeon__icon">
                                                <svg class="icon icon--cup">
                                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-cup"></use>
                                                </svg>
                                            </span>
                                                <h5 class="accordeon__title">Преимущества аккаунта K3</h5>
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
                                                                <h6 class="advantage__title"><?=$arResult['LL']['K3']['benefits']['personal_bonuses_for_cost']['size']?> бонусных балла за каждые полные <?=$arResult['LL']['K3']['benefits']['personal_bonuses_for_cost']['step']?> рублей личных покупок</h6>
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
                                                                <h6 class="advantage__title"><?=$arResult['LL']['K3']['benefits']['referral_size']?> бонусных баллов за каждого приглашенного Вами Консультанта</h6>
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
                                                                <h6 class="advantage__title">Скидка <?=$arResult['LL']['K3']['benefits']['personal_discount']?>% на товары в каталоге</h6>
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
                                                                <h6 class="advantage__title"><?=$arResult['LL']['K3']['benefits']['personal_bonuses_for_stock']['size']?> бонусных балла за каждые полные <?=$arResult['LL']['K3']['benefits']['personal_bonuses_for_stock']['step']?> рублей от стоимости товара по Персональной акции</h6>
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
                                                                <h6 class="advantage__title"><?=$arResult['LL']['K3']['benefits']['group_bonuses_for_cost']['size']?> бонусных балла за каждые полные <?=$arResult['LL']['K3']['benefits']['group_bonuses_for_cost']['step']?> рублей покупок Вашей группы</h6>
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
                                                                <h6 class="advantage__title"><?=$arResult['LL']['K3']['benefits']['upgrade_level_bonuses']?> бонусных баллов за соблюдение следующих условий:</h6>
                                                                <p class="advantage__subtitle">За переход с уровня K2 на уровень K3</p>
                                                                <p class="advantage__subtitle">За выполнение условий поддержания уровня K3 в течении 6 месяцев</p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php else:?>

                            <div class="section__box-inner">
                                <div class="section__box-row">
                                    <div class="section__box-col">
                                        <div class="success-cards success-cards--full">
                                            <div class="success-cards__item success-cards__item--full">
                                                <div class="success-card success-card--red">
                                                    <span class="success-card__title heading heading--large"><?=$arResult['loyalty_level_info']['benefits']['personal_discount']?>%</span>
                                                    <span class="success-card__info">Персональная скидка</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="section__box-col">
                                        <div class="cards-progress">
                                            <div class="participant__progress cards-progress">
                                                <ul class="cards-progress__list">
                                                    <li class="cards-progress__item cards-progress__item--full">
                                                    <?php if ($arResult['personal_data']['loyalty_level'] == 'B3'):?>
                                                        <div
                                                            id="loyaltyStatusTale"
                                                            prop-is-consultant="<?=CUtil::PhpToJSObject($arResult['personal_data']['is_consultant'])?>"
                                                            prop-current-value="<?=$arResult['loyalty_status']['self']['current_value']?>"
                                                            prop-target-value="<?=$arResult['loyalty_status']['self']['hold_value']?>"
                                                            prop-label="Удержание уровня по личным покупкам"
                                                        ></div>
                                                    <?php else:?>
                                                        <div
                                                            id="loyaltyStatusTale"
                                                            prop-is-consultant="<?=CUtil::PhpToJSObject($arResult['personal_data']['is_consultant'])?>"
                                                            prop-current-value="<?=$arResult['loyalty_status']['self']['current_value']?>"
                                                            prop-target-value="<?=$arResult['loyalty_status']['self']['upgrade_value']?>"
                                                            prop-label="До повышения размера скидки"
                                                        ></div>
                                                    <?php endif;?>
                                                       
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif;?>
                    </div>
                </div>
            </section>
        </div>
        <!--/Система лояльности-->

        <!--Персональные акции-->
        <?php if ($arResult['promotion_orders'] || $arResult['personal_promotions']):?>
            <div class="profile__block accordeon__item" data-accordeon>
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
                            <?php if ($arResult['promotion_orders']):?>
                                <div class="section__box-inner">
                                    <h5 class="box__heading box__heading--middle">Участие в персональной акции</h5>

                                    <?php foreach ($arResult['promotion_orders'] as $order):?>
                                        <div class="profile__order box box--white box--circle">
                                            <a href="/personal/orders/<?=$order['id']?>" style="text-decoration: none;">
                                                <div class="profile__order-row">
                                                    <div class="profile__order-col">
                                                        <h5 class="profile__order-heading heading headding--small">
                                                            Заказ от <?=$order['date_insert']->format('d.m.Y')?>
                                                        </h5>
                                                        <span class="profile__order-number">№<?=$order['account_number']?></span>
                                                    </div>

                                                    <div class="profile__order-col">
                                                        <div class="price">
                                                            <div class="price__calculation--stock price__calculation price__calculation--columned">
                                                                <p class="price__calculation-total" data-price="<?=$order['price']?>">
                                                                    <span class="price__calculation-total--whole"></span>
                                                                    <span class="price__calculation-total--remains"></span>
                                                                </p>
                                                                <?php if ($order['bonuses']):?>
                                                                    <p class="price__calculation-accumulation">
                                                                        <?=number_format($order['bonuses'], 0, ' ', ' ')?> ББ
                                                                    </p>
                                                                <?php endif;?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    <?php endforeach;?>
                                </div>
                            <?php endif;?>

                            <?php if ($arResult['personal_promotions']):?>
                                <div class="section__box-inner">
                                    <h5 class="box__heading box__heading--middle">Актуальные акции</h5>

                                    <div class="profile__stocks cards-stock">
                                        <ul class="cards-stock__list">
                                            <?php foreach ($arResult['personal_promotions'] as $promotion):?>
                                                <li class="cards-stock__item">
                                                    <div class="card-stock">
                                                        <?php if ($promotion['link']):?>
                                                            <a href="<?=$promotion['link']?>" class="card-stock__link"></a>
                                                        <?php endif;?>
                                                        <div class="card-stock__inner">
                                                            <div class="card-stock__top">
                                                                <div class="card-stock__wrapper">
                                                                    <div class="card-stock__image box box--circle">
                                                                        <img src="<?=$promotion['image'] ?: NO_IMAGE_PLACEHOLDER_PATH?>" alt="Image" class="card-stock__image-picture">
                                                                    </div>
                                                                    <?php if ($promotion['active_to']):?>
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
                                                                    <?php endif;?>
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
                                                                    <?=$promotion['amount'] ? "Скидка {$promotion['amount']}%" : $promotion['name']?>
                                                                </p>
                                                                <?php if ($promotion['amount']):?>
                                                                    <p class="card-stock__text">
                                                                        <?=$promotion['name']?>
                                                                    </p>
                                                                <?php endif;?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php endforeach;?>
                                        </ul>
                                    </div>
                                </div>
                            <?php endif;?>
                        </div>
                    </div>
                </section>
            </div>
        <?php endif;?>
        <!--/Персональные акции-->
    </div>
</div>

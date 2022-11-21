<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die;
/**
 * Bitrix vars
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 */

if (!$arResult['pets']) {
    $arResult['pets'] = [[]];
}

?>

<h4 class="section__title">Данные о питомцах</h4>

<div class="pet-cards box box--gray box--rounded">
    <ul class="pet-cards__list" data-pets-list>
        <?php foreach ($arResult['pets'] as $index => $pet):?>
            <li class="pet-cards__item">
                <!--Карточка питомца-->
                <article class="pet-card <?=!$pet ? 'pet-card--editing' : ''?>" data-pets-card>
                    <div class="pet-card__main box box--circle" data-pets-main>
                        <div class="pet-card__content">
                            <div class="pet-card__avatar" data-pets-type>
                                <svg class="icon icon--<?=$pet['~type'] ?? $arResult['default_pet']['type']?>">
                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-<?=$pet['~type'] ?? $arResult['default_pet']['type']?>"></use>
                                </svg>
                            </div>

                            <div class="pet-card__info">
                                <div class="pet-card__name" data-pets-name>
                                    <?=$pet['name']?>
                                </div>

                                <div class="pet-card__breed" data-pets-breed>
                                    <?=$arResult['breeds'][$pet['type']][$pet['breed']]?>
                                </div>

                                <div class="pet-card__info-record">
                                    <div class="pet-card__gender" data-pets-gender>
                                        <svg class="icon icon--<?=$pet['~gender'] ?? $arResult['default_pet']['gender']?>">
                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-<?=$pet['~gender'] ?? $arResult['default_pet']['gender']?>"></use>
                                        </svg>
                                    </div>

                                    <div class="pet-card__date" data-pets-date>
                                        <?=$pet['birthdate']?>
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
                                            <svg class="icon icon--trash">
                                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-trash"></use>
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
                                            <label for="pets-<?=$index?>-type" class="form__label">
                                                <span class="form__label-text">Тип питомца</span>
                                            </label>
                                        </div>

                                        <div class="form__field-block form__field-block--input">
                                            <div class="form__control">
                                                <div class="select select--mitigate select--iconed" data-select>
                                                    <select class="select__control" name="pets-<?=$index?>-type" id="pets-<?=$index?>-type" data-select-control data-pet-kind data-placeholder="Выбрать" data-pets-type-input data-pets-change>
                                                        <option><!-- пустой option для placeholder --></option>
                                                        <?php foreach ($arResult['pet_kinds'] as $petsKind):?>
                                                            <option
                                                                value="<?=$petsKind['XML_ID']?>"
                                                                data-pets-species="<?=strtolower(str_replace('KIND_', '', $petsKind['XML_ID']))?>"
                                                                data-option-before='<svg class="select__item-icon icon icon--<?=strtolower(str_replace('KIND_', '', $petsKind['XML_ID']))?>"><use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-<?=strtolower(str_replace('KIND_', '', $petsKind['XML_ID']))?>"></use></svg>'
                                                                data-pets-card
                                                                <?=$pet['type'] === $petsKind['XML_ID'] ? 'selected' : ''?>
                                                            >
                                                                <?=mb_ucfirst($petsKind['VALUE'])?>
                                                            </option>
                                                        <?php endforeach;?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="pet-card__col pet-card__col--1-3 form__col">
                                    <div class="form__field">
                                        <div class="form__field-block form__field-block--label">
                                            <label for="pets-<?=$index?>-gender" class="form__label">
                                                <span class="form__label-text">Пол</span>
                                            </label>
                                        </div>

                                        <div class="form__field-block form__field-block--input">
                                            <div class="form__control">
                                                <div class="select select--mitigate" data-select>
                                                    <select class="select__control" name="pets-<?=$index?>-gender" id="pets-<?=$index?>-gender" data-select-control data-placeholder="Выбрать" data-pets-gender-input data-pets-change>
                                                        <option><!-- пустой option для placeholder --></option>
                                                        <?php foreach ($arResult['pet_genders'] as $petsGender):?>
                                                            <option
                                                                    value="<?=$petsGender['XML_ID']?>"
                                                                <?=$pet['gender'] === $petsGender['XML_ID'] ? 'selected' : ''?>
                                                            >
                                                                <?=mb_ucfirst($petsGender['VALUE'])?>
                                                            </option>
                                                        <?php endforeach;?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="pet-card__col pet-card__col--1-3 form__col">
                                    <div class="form__field">
                                        <div class="form__field-block form__field-block--label">
                                            <label for="pets-<?=$index?>-birthdate" class="form__label">
                                                <span class="form__label-text">Дата рождения</span>
                                            </label>
                                        </div>

                                        <div class="form__field-block form__field-block--input">
                                            <div class="input input--iconed">
                                                <input inputmode="numeric"
                                                       class="input__control"
                                                       name="pets-<?=$index?>-birthdate"
                                                       id="pets-<?=$index?>-birthdate"
                                                       placeholder="ДД.ММ.ГГГГ"
                                                       data-mask-date
                                                       data-inputmask-alias="date"
                                                       data-inputmask-inputformat="dd.mm.yyyy"
                                                       data-pets-date-input
                                                       data-pets-change
                                                       value="<?=$pet['birthdate']?>"
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
                                            <label for="pets-<?=$index?>-breed" class="form__label">
                                                <span class="form__label-text">Порода</span>
                                            </label>
                                        </div>

                                        <div class="form__field-block form__field-block--input" data-breed-container>
                                            <div class="form__control">
                                                <div class="select select--mitigate" data-select data-breed="empty">
                                                    <select class="select__control" data-select-control data-placeholder="Выбрать" data-pets-breed-input data-pets-change disabled>
                                                        <option><!-- пустой option для placeholder --></option>
                                                    </select>
                                                </div>
                                                <?php foreach($arResult['breeds'] as $kind => $breed):?>
                                                    <div class="select select--mitigate" data-select data-breed="<?=$kind?>">
                                                        <select class="select__control" name="pets-<?=$index?>-<?=$kind?>breed" id="pets-<?=$index?>-<?=$kind?>breed" data-select-control data-placeholder="Выбрать" data-pets-breed-input data-pets-change>
                                                            <option><!-- пустой option для placeholder --></option>
                                                            <?php foreach ($breed as $breedId => $breedValue):?>
                                                                <option value="<?=$breedId?>" <?=$pet['breed'] == $breedId ? 'selected' : ''?>>
                                                                    <?=$breedValue['name']?>
                                                                </option>
                                                            <?php endforeach;?>
                                                        </select>
                                                    </div>
                                                <?php endforeach;?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="pet-card__col pet-card__col--1-2 pet-card__col--2 form__col">
                                    <div class="form__field">
                                        <div class="form__field-block form__field-block--label">
                                            <label for="pets-<?=$index?>-name" class="form__label">
                                                <span class="form__label-text">Кличка</span>
                                            </label>
                                        </div>

                                        <div class="form__field-block form__field-block--input">
                                            <div class="input">
                                                <input value="<?=$pet['name']?>" type="text" class="input__control" name="pets-<?=$index?>-name" id="pets-<?=$index?>-name" placeholder="Выбрать" data-pets-name-input data-pets-change>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="pet-card__buttons">
                                <button type="submit" class="pet-card__button button button--rounded button--covered button--green button--full <?=!$pet ? 'button--disabled' : ''?>" <?=!$pet ? 'disabled' : ''?> data-pets-save>
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
        <?php endforeach;?>
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
                                        <svg class="icon icon--trash">
                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-trash"></use>
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
                                        <label for="pets-#ID#-type" class="form__label">
                                            <span class="form__label-text">Тип питомца</span>
                                        </label>
                                    </div>

                                    <div class="form__field-block form__field-block--input">
                                        <div class="form__control">
                                            <div class="select select--mitigate select--iconed" data-select>
                                                <select class="select__control" name="pets-#ID#-type" id="pets--#ID#-type" data-select-control data-pet-kind data-placeholder="Выбрать" data-pets-type-input data-pets-change>
                                                    <option><!-- пустой option для placeholder --></option>
                                                    <?php foreach ($arResult['pet_kinds'] as $petsKind):?>
                                                        <option
                                                                value="<?=$petsKind['XML_ID']?>"
                                                                data-pets-species="<?=strtolower(str_replace('KIND_', '', $petsKind['XML_ID']))?>"
                                                                data-option-before='<svg class="select__item-icon icon icon--<?=strtolower(str_replace('KIND_', '', $petsKind['XML_ID']))?>"><use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-<?=strtolower(str_replace('KIND_', '', $petsKind['XML_ID']))?>"></use></svg>'
                                                                data-pets-card
                                                        >
                                                            <?=mb_ucfirst($petsKind['VALUE'])?>
                                                        </option>
                                                    <?php endforeach;?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="pet-card__col pet-card__col--1-3 form__col">
                                <div class="form__field">
                                    <div class="form__field-block form__field-block--label">
                                        <label for="pets-#ID#-gender" class="form__label">
                                            <span class="form__label-text">Пол</span>
                                        </label>
                                    </div>

                                    <div class="form__field-block form__field-block--input">
                                        <div class="form__control">
                                            <div class="select select--mitigate" data-select>
                                                <select class="select__control" name="pets-#ID#-gender" id="pets-#ID#-gender" data-select-control data-placeholder="Выбрать" data-pets-gender-input data-pets-change>
                                                    <option><!-- пустой option для placeholder --></option>
                                                    <?php foreach ($arResult['pet_genders'] as $petsGender):?>
                                                        <option value="<?=$petsGender['XML_ID']?>">
                                                            <?=mb_ucfirst($petsGender['VALUE'])?>
                                                        </option>
                                                    <?php endforeach;?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="pet-card__col pet-card__col--1-3 form__col">
                                <div class="form__field">
                                    <div class="form__field-block form__field-block--label">
                                        <label for="pets-#ID#-birthdate" class="form__label">
                                            <span class="form__label-text">Дата рождения</span>
                                        </label>
                                    </div>

                                    <div class="form__field-block form__field-block--input">
                                        <div class="input input--iconed">
                                            <input inputmode="numeric"
                                                   class="input__control"
                                                   name="pets-#ID#-birthdate"
                                                   id="pets-#ID#-birthdate"
                                                   placeholder="ДД.ММ.ГГГГ"
                                                   data-mask-date
                                                   data-inputmask-alias="date"
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
                                        <label for="pets-#ID#-breed" class="form__label">
                                            <span class="form__label-text">Порода</span>
                                        </label>
                                    </div>

                                    <div class="form__field-block form__field-block--input" data-breed-container>
                                        <div class="form__control">
                                            <div class="select select--mitigate" data-select data-breed="empty">
                                                <select class="select__control" data-select-control data-placeholder="Выбрать" data-pets-breed-input data-pets-change disabled>
                                                    <option><!-- пустой option для placeholder --></option>
                                                </select>
                                            </div>
                                            <?php foreach($arResult['breeds'] as $kind => $breed):?>
                                                <div class="select select--mitigate" data-select data-breed="<?=$kind?>">
                                                    <select class="select__control" name="pets-#ID#-<?=$kind?>breed" id="pets-#ID#-<?=$kind?>breed" data-select-control data-placeholder="Выбрать" data-pets-breed-input data-pets-change>
                                                        <option><!-- пустой option для placeholder --></option>
                                                        <?php foreach ($breed as $breedId => $breedValue):?>
                                                            <option value="<?=$breedId?>">
                                                                <?=$breedValue['name']?>
                                                            </option>
                                                        <?php endforeach;?>
                                                    </select>
                                                </div>
                                            <?php endforeach;?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="pet-card__col pet-card__col--1-2 pet-card__col--2 form__col">
                                <div class="form__field">
                                    <div class="form__field-block form__field-block--label">
                                        <label for="pets-#ID#-name" class="form__label">
                                            <span class="form__label-text">Кличка</span>
                                        </label>
                                    </div>

                                    <div class="form__field-block form__field-block--input">
                                        <div class="input">
                                            <input type="text" class="input__control" name="pets-#ID#-name" id="pets-#ID#-name" placeholder="Выбрать" data-pets-name-input data-pets-change>
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
        <button class="button button--rounded button--covered button--white-green button--full" data-change-step data-direction="previous">
            <span class="button__text">Назад</span>
        </button>
    </div>

    <div class="registration__actions-col">
        <button class="button button--rounded button--covered button--red button--full" data-change-step data-direction="next">
            <span class="button__text">Далее</span>
        </button>
    </div>
</div>

<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die;
/**
 * Bitrix vars
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 */
?>

<section class="section section--limited-big">
    <h4 class="section__title">Выбор <?=$arResult['type'] === 'buyer' ? 'контакта' : 'наставника'?></h4>

    <div class="registration__form form form--separated form--wraped">
        <div class="registration__box box box--hidden box--grayish box--rounded-sm">
            <div class="registration__box registration__box--small box box--hidden box--white box--rounded-sm">
                <div class="form__row form__row--centered">
                    <div class="form__col">
                        <div class="form__field">
                            <div class="checkbox">
                                <input
                                        type="checkbox"
                                        class="checkbox__input"
                                        name="without_mentor"
                                        id="without_mentor"
                                    <?=$arResult['without_mentor'] ? 'checked' : ''?>
                                >

                                <label for="without_mentor" class="checkbox__label">
                                    <span class="checkbox__icon">
                                        <svg class="checkbox__icon-pic icon icon--check">
                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-check">
                                        </svg>
                                    </span>

                                    <span class="checkbox__text">Хочу, чтобы мне подобрали <?=$arResult['type'] === 'buyer' ? 'контакт' : 'наставника'?></span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form__col">
                        <div class="form__field">
                            <div class="form__field-block form__field-block--label">
                                <label for="mentor_id" class="form__label form__label--required">
                                    <span class="form__label-text">ID <?=$arResult['type'] === 'buyer' ? 'контакта' : 'наставника'?></span>
                                </label>
                            </div>

                            <div class="form__field-block form__field-block--input">
                                <div class="input">
                                    <input
                                            type="text"
                                            class="input__control"
                                            name="mentor_id"
                                            id="mentor_id"
                                            placeholder="Введите ID наставника"
                                            value="<?=$arResult['mentor_id']?>"
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
    </div>
</section>
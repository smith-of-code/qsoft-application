<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);?>
<div class="header__block header__block--search search">

    <div class="header__search header__search--tablet">
        <button type="button"
                class="button button--iconed button--simple button--red"
                data-fancybox data-modal-type="modal"
                data-src="#search"
        >
            <span class="button__icon">
                <svg class="icon icon--search">
                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-search"></use>
                </svg>
            </span>
        </button>

        <!--Попап поиска-->
        <article id="search" class="modal modal--whole" style="display: none">
            <div class="modal__content">
                <header class="modal__section modal__section--header">
                    <h4 class="heading heading--average">Поиск</h4>
                </header>

                <section class="modal__section modal__section--content">
                    <div class="form__row">
                        <div class="form__col">
                            <form action="<?=$arResult["FORM_ACTION"]?>" class="form__field" id="search">
                                <div class="form__field-block form__field-block--input">
                                    <div class="header__search-input input input--small input--buttoned">
                                        <input type="text"
                                               class="header__search-input-control input__control"
                                               name="q"
                                               id="q"
                                               placeholder="Я ищу..."
                                               value="<?=$_REQUEST['q'] ? htmlspecialcharsbx($_REQUEST['q']) : ''?>"
                                        />
                                        <button type="submit"
                                                class="input__button input__button--search button button--iconed button--covered button--square button--dark">
                                                <span class="button__icon button__icon--medium">
                                                    <svg class="icon icon--search">
                                                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-search"></use>
                                                    </svg>
                                                </span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
        </article>
        <!--/Попап поиска-->
    </div>

    <div class="header__search header__search--desktop">
        <form action="<?=$arResult["FORM_ACTION"]?>" class="form__field">
            <div class="form__field-block form__field-block--input">
                <div class="header__search-input input input--small input--buttoned">
                    <input type="text"
                           class="header__search-input-control input__control"
                           name="q"
                           id="q"
                           placeholder="Я ищу..."
                           value="<?=$_REQUEST['q'] ? htmlspecialcharsbx($_REQUEST['q']) : ''?>"
                    />
                    <button type="submit"
                            class="input__button input__button--search button button--iconed button--covered button--square button--dark">
                        <span class="button__icon button__icon--medium">
                            <svg class="icon icon--search">
                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-search"></use>
                            </svg>
                        </span>
                    </button>
                </div>
            </div>
        </form>
    </div>

</div>